<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/11
 * Time: 21:33
 */
namespace app\api\model;

class Image extends BaseModel
{
      protected $hidden = ['delete_time','update_time','from','id'];

      //与基类BaseModel的preImgUrl构建成读取器
      public function getUrlAttr($value,$data){
          return $this->prefixImgUrl($value,$data);
      }
}