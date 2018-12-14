<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/14
 * Time: 10:08
 */

namespace app\api\validate;


use think\Exception;

class OrderCheck extends BaseValidate
{
  protected $rule = [
       'products' => 'checkProductItem'
  ];

  protected $otherRule = [
      'product_id' => 'require|isPositiveInteger',
      'count' => 'require|isPositiveInteger'
  ];

  protected function checkProductItem($value){
     if(!$value){
         throw new Exception("商品不能为空");
     }
     if(!is_array($value)){
         throw new Exception("商品数据所传递格式出错");
     }
      foreach ($value as $valueNum){
         $this->checkProduct($valueNum);
      }
      return true;
  }

  protected function checkProduct($valueNum){
      $validate = new BaseValidate($this->otherRule);
      $res = $validate->check($valueNum);
      if(!$res){
          throw new Exception("商品参数错误");
      }
  }

}