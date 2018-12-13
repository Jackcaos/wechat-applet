<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/13
 * Time: 0:02
 */

namespace app\api\service;


use think\Cache;
use think\Exception;
use think\Request;

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

     public static function getTokenValue($key){
         $token = Request::instance()->header('token');
         $value = Cache::get($token);
         if(!$value){
             throw new Exception("token值读取失败");
         }
         else{
             if(!is_array($value))
             $value = json_decode($value,true);
             if(array_key_exists($key,$value)){
                 return $value[$key];
             }
             else
             {
                 throw new Exception("相关读取value值不存在");
             }
         }

     }

     public static function getUserId(){
         $uid = self::getTokenValue('uid');
         return $uid;
     }
}