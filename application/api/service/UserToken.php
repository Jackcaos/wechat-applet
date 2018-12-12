<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/12
 * Time: 22:46
 */

namespace app\api\service;

use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
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
              return $this->grantToken($wxResult);     //一定要进行返回
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
        $user = UserModel::getOpenId($openid);
        if($user){
            $uid = $user->id;
        }else{
            $uid = $this->createUser($openid);
        }

        $cache = $this->createCache($wxResult,$uid);
        $token = $this->writeCache($cache);
        return $token;
    }

    private function writeCache($cache){
        $key = self::getToken();
        $value = json_encode($cache);
        $expire_in = config('setting.token_expire_in');

        $res = cache($key,$value,$expire_in);    //tp5的助手函数生成一个cache
        if(!$res){
            throw new Exception("缓存出现异常，请稍后重试");
        }
        return $key;
    }

    private function createCache($wxResult,$uid){
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = 16;
        return $cacheValue;
    }

    //创建新用户，并将其的新id返回
    private function createUser($openid){
        $user = UserModel::create(['openid' => $openid]);
        return $user->id;
    }

    private function processLoginError($wxResult){
        throw new Exception("微信端出现错误");
    }
}