<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/12
 * Time: 0:23
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden = ['delete_time','update_time'];

    //获取分类主题图
    public function getTopicImg(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
    //获取所有的分类
    public static function getAllCategories(){
        $res = self::all([],'getTopicImg');
        return $res;
    }
}