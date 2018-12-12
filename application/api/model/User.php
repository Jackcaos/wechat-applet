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
    public static function getOpenId($openid){
        $user = self::where('openid','=',$openid)->find();
        return $user;
    }
}