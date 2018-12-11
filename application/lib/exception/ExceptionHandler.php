<?php
/**
 * Created by PhpStorm.
 * User: 七月
 * Date: 2017/2/12
 * Time: 19:44
 */

namespace app\lib\exception;

use think\exception\Handle;
use think\Log;
use think\Request;
use think\Exception;

/*
 * 重写Handle的render方法，实现自定义异常消息
 */
class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errCode;
    // 并且返回URL路径
 public function render(Exception $e){
       if($e instanceof BaseException){
      $this->code = $e->code;
      $this->msg = $e->msg;
      $this->errCode = $e->errorCode;
       }else{
           if(config('app_debug')){
               return parent::render($e);
           }
           else {
               $this->code = 500;
               $this->msg = '服务器内部错误';
               $this->errCode = 999;
               $this->recordErrorLog($e);
           }
       }
       $request = Request::instance();
       $result = [
           'msg'=>$this->msg,
           'error_code'=>$this->errCode,
           'request_url'=>$request->url()
       ];
       return json($result,$this->code);
      }

      private function recordErrorLog(Exception $e){
       Log::init([
           'type'=>'File',
           'path'=>LOG_PATH,
           'level'=>['error']
       ]);
        Log::record($e->getMessage(),'error');
      }
}