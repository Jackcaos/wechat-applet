<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/6/25
 * Time: 0:28
 */

namespace app\api\validate;

class IDMustBePostiveint extends BaseValidate
{
protected $rule = [
    'id'=>'require|isPositiveInteger'
];

protected $message = ['id'=>'id必须是正整数'];
}