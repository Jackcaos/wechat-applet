<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/12
 * Time: 22:46
 */

namespace app\api\service;


use think\Exception;

class UserToken
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),$this->wxAppID,$this->wxAppSecret,$this->code);
    }

    public function get(){
      $result = curl_get($this->wxLoginUrl);      //对微信发送HTTP请求
      $wxResult = json_decode($result,true);     //返回的是一个字符串用json_decode转义成数组
       if(empty($wxResult)){
           throw new Exception('未能成功获取open_id等参数');
       }
       else{
           $loginFail = array_key_exists('errcode',$wxResult);
           if($loginFail){
               $this->processLoginError($wxResult);
           }else{
               $this->grantToken($wxResult);
           }
       }
    }

    private function grantToken($wxResult){
        //拿到openid
        //去数据库查找是否已经存在
        //如果存在则不处理，如果不存在则新增一条记录
        //保存相关信息
        //生成令牌，并返回到客户端
        //写缓存，key是令牌，value是wxResult和uid,scope
        $openid = $wxResult['openid'];
    }

    private function processLoginError($wxResult){
        throw new Exception("微信端出现错误");
    }
}