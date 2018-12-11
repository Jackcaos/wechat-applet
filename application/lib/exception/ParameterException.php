<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/6/26
 * Time: 17:12
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
 public $code = 400;
 public $msg = '参数错误';
 public $errorCode = 10000;
}