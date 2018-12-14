<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/12
 * Time: 22:43
 */

namespace app\api\model;


class User extends BaseModel
{
    protected $hidden = ['update_time','delete_time','create_time'];

    public static function getOpenId($openid){
        $user = self::where('openid','=',$openid)->find();
        return $user;
    }

    //有外键的表中定义一对一用belongsTo没有外键的表中用hasOne
    public function address(){
        return $this->hasOne('UserAddress','user_id','id');
    }
}