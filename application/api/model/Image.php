<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/11
 * Time: 21:33
 */
namespace app\api\model;

use think\Model;

class Image extends Model{
      protected $hidden = ['delete_time','update_time'];

      //图片读取器的编写
    public function getUrlAttr($value){   //这里取得的是图片的Url:'/banner-1a.jpg'
        return config('setting.img_prefix').$value;
    }
}