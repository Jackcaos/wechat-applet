<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/13
 * Time: 0:02
 */

namespace app\api\service;


class Token
{
     public static function getToken(){
         //生成随机字符串
         $rand = getRandChar(32);
         //生成时间戳
         $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
         //盐
         $salt = config('secure.token_salt');

         return md5($rand.$timestamp.$salt);
     }
}