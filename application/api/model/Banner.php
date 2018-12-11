<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/6/25
 * Time: 11:26
 */

namespace app\api\model;

use think\Db;
use think\Model;

class Banner extends Model
{
//    protected $hidden = ['update_time','delete_time'];
//    public function items(){
//        return $this->hasMany('BannerItem','banner_id','id');
//    }
    public static function getBannerByID($id){
      $result = Db::table('banner_item')
          ->where('banner_id','=',$id)
          ->select();
      return $result;
    }
}