<?php
require $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/config/application.php';

use category\controller\CategoryController;

if(isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'readCategories':
            try{
                $categoryController = new CategoryController();
                $categories = $categoryController->readCategories();

                $html = '<a id="addCategory" href="#" class="list-group-item active">Adicionar Categoria <i class="fas fa-plus"></i></a>';
                foreach($categories as $category){
                    $html .= '<span class="list-group-item">'. $category['name'] .' <a href="#" data-id="'.$category['id'].'" class="text-warning editCategory" title="Editar"><i class="fas fa-edit"></i></a> <a href="#" data-id="'.$category['id'].'" class="text-danger deleteCategory" title="Remover"><i class="fas fa-trash-alt"></i></a></span>';
                }

                echo json_encode(array(
                    'success' => true,
                    'categories' => $html
                ));
            }catch (Exception $e) {
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Erro ao recuperar categorias. ' . $e->getMessage()
                ));
            }
            break;

        case 'saveCategory':
            try{
                $categoryController = new CategoryController();
                $categories = $categoryController->saveCategory($_REQUEST);

                $html = '';
                
                echo json_encode(array(
                    'success' => true,
                    'categories' => $html
                ));
            }catch (Exception $e) {
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Erro ao salvar categoria. ' . $e->getMessage()
                ));
            }
            break;

        case 'deleteCategory':
            try{
                $categoryController = new CategoryController();
                $return = $categoryController->deleteCategory($_REQUEST);
                
                if($return){
                    echo json_encode(array(
                        'success' => true,
                        'message' => 'Categoria excluída com sucesso!'
                    ));
                }else{
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Problemas ao excluir a categoria.'
                    ));
                }
            }catch (Exception $e) {
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Erro ao salvar categoria. ' . $e->getMessage()
                ));
            }
            break;
    }
}