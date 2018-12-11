<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/6/27
 * Time: 13:00
 */

namespace app\api\model;

use think\Model;
class BannerItem extends Model
{
    protected $hidden = ['update_time','delete_time','img_id','id','banner_id'];
    public function img(){
        return $this->belongsTo('Image','img_id','id');   //一对一的关系
    }
}