<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/6/25
 * Time: 0:58
 */

namespace app\api\validate;
use app\lib\exception\BannerMissException;
use app\lib\exception\ParameterException;
use think\Exception;
use think\Validate;
use think\Request;
class BaseValidate extends Validate
{
  public function goCheck(){
      //获取参数
      //对参数做校验
      $request = Request::instance();
      $param = $request->param();

      $res = $this->check($param);
      if(!$res){
          $error = $this->error;
          throw new Exception($error);
      }else{
          return true;
      }
  }

    protected function isPositiveInteger($value='',$field=''){
        if(is_numeric($value)&&is_int($value+0)&&($value>0)){
            return true;
        } else{
            return false;
        }
    }

    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    protected function isNotEmpty($value,$rule = '',$data = '',$field=''){
          if(empty($value)){
              return $field . '不允许为空';
          }else{
              return true;
          }
    }

    public function getDataByRule($arrays){
      if(array_key_exists('user_id',$arrays)|array_key_exists('uid',$arrays)){
          throw new Exception("恶意请求");
      }
      $newArray = [];
      foreach ($this->rule as $key =>$value){
          $newArray[$key] = $arrays[$key];
      }
      return $newArray;
    }
}