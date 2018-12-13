<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/13
 * Time: 14:51
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
   protected $hidden = ['delete_time','img_id','product_id'];

   public function connectImg(){
       return $this->belongsTo('Image','img_id','id');
   }
}