<?php
require $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/config/application.php';

if(isset($_GET['product_id'])){
    $id = $_GET['product_id'];

    // $categoryController = new CategoryController();
    // $categories = $categoryController->readCategories($_GET);

    // $name = $categories[0]['name'];
    $title = 'Editar Produto';
}else{
    $id = '';
    $name = '';
    $title = 'Adicionar Produto';
}
?>

<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addProductModalLabel"><?php echo $title;?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form name="form_product" id="form_product">
                        <div class="form-group">
                            <label for="product_name">Produto</label>
                            <input type="text" class="form-control" id="product_name" aria-describedby="product_name" placeholder="Digite o nome do produto" value="<?php echo $name;?>">
                        </div>
                        <div class="form-group">
                            <label for="product_desc">Descrição</label>
                            <input type="text" class="form-control" id="product_desc" aria-describedby="product_desc" placeholder="Digite a descrição do produto" value="<?php echo $desc;?>">
                        </div>
                        <div class="form-group">
                            <label for="product_price">Preço</label>
                            <input type="text" class="form-control" id="product_price" aria-describedby="product_price" placeholder="Digite o preço do produto" value="<?php echo $price;?>">
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="product_images">Imagens</label>
                            <small id="product_img_help" class="form-text text-muted">Você poderá adicionar até 3 imagens para o seu produto.</small>
                        </div>
                        <input type="hidden" id="product_id" value="<?php echo $id;?>"/>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary save_product">Salvar</button>
        </div>
    </div>
</div>