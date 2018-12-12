<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/12
 * Time: 15:17
 */

namespace app\api\controller\v1;

use app\api\model\Product as ProductModel;
use app\api\validate\IDMustBePostiveint;
use think\Exception;
use think\Collection;

class Product
{
      //返回最近新品数据
      public function getNew($count = 16){
           $res = ProductModel::getNewProduct($count);
           if(!$res) {
               throw new Exception("你查询的商品不存在");
           }
           $res = $res->hidden(['summary']);
           return $res;
      }

      public function getCategoryProduct($id){
          (new IDMustBePostiveint())->goCheck();
           $res = ProductModel::getCategoryPro($id);
           return $res;
      }
}