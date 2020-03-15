<?php
namespace category\controller;

use category\model\Category;
use Exception;

class CategoryController{
    public function readCategories($data=null){
        try{
            $categoryModel = new Category();
            if(isset($data['category_id'])){
                $categoryModel->setId($data['category_id']);
            }
            if(isset($data['category_name'])){
                $categoryModel->setName($data['category_name']);
            }
            $categories = $categoryModel->read();
            
            return $categories;
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function saveCategory($data = null){
        try{
            $edit = false;
            $categoryModel = new Category();
            if(isset($data['category_id']) && $data['category_id'] != ''){
                $categoryModel->setId($data['category_id']);
                $edit = true;
            }
            if(isset($data['category_name'])){
                $categoryModel->setName($data['category_name']);
            }
            if(!$edit){
                $id = $categoryModel->create();
            }else{
                $id = $categoryModel->update();
            }

            $categoryModel->setId($id);
            $categories = $categoryModel->read();
            
            return $categories;
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function deleteCategory($data = null){
        try{
            $categoryModel = new Category();
            if(isset($data['category_id']) && $data['category_id'] != ''){
                $categoryModel->setId($data['category_id']);
            }
            
            $return = $categoryModel->delete();
            
            return $return;
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}