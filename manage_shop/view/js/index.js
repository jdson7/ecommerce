$(document).ready(function(){
    
    $('#manage_shop').on('click', function(){
        window.location = '../view';
    });

    $('#addProduct').on('click', function(){
        new Noty({
            type: 'success',
            text: 'Adicionar produto.'
        }).show();
    });

    loadCategories();
});

function loadCategories(){
    $.ajax({
        url: 'ajax/control.php',
        timeout: 3000,
        data: {
            action: 'readCategories'
        },
        type: "POST",
        dataType: "json",
        success: function(response) {
            if(response.success){
                $('#categoryList').html(response.categories);

                $('#addCategory').on('click', function(){
                    $('#addCategoryModal').load('modal/addCategory.php', function(){
                        $('.save_category').on('click', function(){
                            saveCategory();
                        })
                    }).modal();
                });

                $('.editCategory').on('click', function(){
                    var id = $(this).data('id');
            
                    editCategory(id);
                });
            
                $('.deleteCategory').on('click', function(){
                    var id = $(this).data('id');
            
                    deleteCategory(id);
                });
            }else{
                new Noty({
                    type: 'error',
                    text: response.message
                }).show();
            }
        },
        error: function(msg){
            //In case of error
            new Noty({
                type: 'error',
                text: msg.responseText
            }).show();
        }
    });
}

function saveCategory(){
    var category_name = $('#form_category #category_name').val();
    var category_id = $('#form_category #category_id').val();

    $.ajax({
        url: 'ajax/control.php',
        timeout: 3000,
        data: {
            action: 'saveCategory',
            category_name: category_name,
            category_id: category_id
        },
        type: "POST",
        dataType: "json",
        success: function(response) {
            if(response.success){
                loadCategories();

                $('#addCategoryModal').modal('toggle');
                
                if(category_id != ''){
                    new Noty({
                        type: 'success',
                        text: 'Categoria alterada com sucesso!'
                    }).show();
                }else{
                    new Noty({
                        type: 'success',
                        text: 'Categoria adicionada com sucesso!'
                    }).show();
                }
            }else{
                new Noty({
                    type: 'error',
                    text: response.message
                }).show();
            }
        },
        error: function(msg){
            //In case of error
            new Noty({
                type: 'error',
                text: msg.responseText
            }).show();
        }
    });
}

function editCategory(id){
    $('#addCategoryModal').load('modal/addCategory.php?category_id='+id, function(){
        $('.save_category').on('click', function(){
            saveCategory();
        })
    }).modal();
}

function deleteCategory(id){
    var n = new Noty({
        text: 'tem certeza que deseja excluir esta categoria?',
        type: 'warning',
        buttons: [
          Noty.button('Excluir', 'btn btn-success btn-sm', function () {
            $.ajax({
                url: 'ajax/control.php',
                timeout: 3000,
                data: {
                    action: 'deleteCategory',
                    category_id: id
                },
                type: "POST",
                dataType: "json",
                success: function(response) {
                    if(response.success){
                        loadCategories();
                        
                        new Noty({
                            type: 'success',
                            text: response.message
                        }).show();

                        n.close();
                    }else{
                        new Noty({
                            type: 'error',
                            text: response.message
                        }).show();

                        n.close();
                    }
                },
                error: function(msg){
                    //In case of error
                    new Noty({
                        type: 'error',
                        text: msg.responseText
                    }).show();
                }
            });
          }, {id: 'button1', 'data-status': 'ok'}),
      
          Noty.button('Cancelar', 'btn btn-danger btn-sm', function () {
              n.close();
          })
        ]
      });
    n.show();
}