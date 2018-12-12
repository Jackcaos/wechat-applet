<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/12
 * Time: 0:32
 */

namespace app\api\model;


class Product extends BaseModel
{
    protected $hidden = ['delete_time','update_time','pivot','from','category_id',
        'create_time','update_time'];

    public function getMainImgUrlAttr($value,$data){
        return $this->prefixImgUrl($value,$data);
    }

    //获取最近新品
    public static function getNewProduct($count){
        $product = self::limit($count)->order('create_time desc')->select();
        return $product;
    }

    public static function getCategoryPro($id){
        $product = self::where('category_id','=',$id)->select();
        return $product;
    }
}