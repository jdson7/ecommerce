<?php
require $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/config/application.php';

use category\controller\CategoryController;

if(isset($_GET['category_id'])){
    $id = $_GET['category_id'];

    $categoryController = new CategoryController();
    $categories = $categoryController->readCategories($_GET);

    $name = $categories[0]['name'];
    $title = 'Editar Categoria';
}else{
    $id = '';
    $name = '';
    $title = 'Adicionar Categoria';
}
?>

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addCategoryModalLabel"><?php echo $title;?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form name="form_category" id="form_category">
                        <div class="form-group">
                            <label for="category_name">Categoria</label>
                            <input type="text" class="form-control" id="category_name" aria-describedby="category_name" placeholder="Digite o nome da nova categoria" value="<?php echo $name;?>">
                        </div>
                        <input type="hidden" id="category_id" value="<?php echo $id;?>"/>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary save_category">Salvar</button>
        </div>
    </div>
</div>