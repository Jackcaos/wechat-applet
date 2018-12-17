<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/16
 * Time: 17:50
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
   public $code = 401;
   public $msg = "Token过期或者无效";
   public $errCode = 10001;
}