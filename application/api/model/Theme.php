<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/12
 * Time: 0:32
 */

namespace app\api\model;


class Theme extends BaseModel
{
    protected $hidden = ['update_time','delete_time'];
      //通过一对一关系解析出主题图
    public function topicImg(){
          return $this->belongsTo('Image','topic_img_id','id');
      }

      //通过一对一关系返回头图
    public function headImg(){
          return $this->belongsTo('Image','head_img_id','id');
      }

      //通过多对多进入具体的theme页面
    public function products(){
        return $this->belongsToMany('Product','theme_product',
            'product_id','theme_id');
    }

    public static function getThemeProduct($id){
        $res = self::with(['products','topicImg','headImg'])->find($id);
        return $res;
    }
}