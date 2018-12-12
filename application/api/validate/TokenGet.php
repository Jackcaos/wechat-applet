<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/12
 * Time: 22:40
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' =>'require|isNotEmpty'
    ];

    protected $message = [
        'code'=>'您的code为空！'
    ];
}