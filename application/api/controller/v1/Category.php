<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/12
 * Time: 16:12
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;

class Category
{
     public function getAll(){
       $product = CategoryModel::getAllCategories();
       return $product;
     }

     public function getMain(){
         $res = CategoryModel::getMainImg()->hidden(['topic_img_id','description','main_img_id']);
         return $res;
     }
}