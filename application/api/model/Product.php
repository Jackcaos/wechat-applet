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

    //关联商品和商品图片
    public function img(){
        return $this->hasMany('ProductImage','product_id','id');
    }

    //关联商品及商品简介
    public function productIntroduce(){
        return $this->hasMany('ProductProperty','product_id','id');
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

    public static function getProductResource($id){
         $product = self::with([
             'img'=>function($query){
                 $query->with(['connectImg'])->order('order','asc');
             }
         ])->with(['productIntroduce'])->find($id);
         return $product;
    }
}