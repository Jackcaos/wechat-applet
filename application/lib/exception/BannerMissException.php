<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/6/25
 * Time: 18:57
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
  public $code = 400;
  public $msg = '请求的Banner不存在';
  public $errorCode = 40000;
}