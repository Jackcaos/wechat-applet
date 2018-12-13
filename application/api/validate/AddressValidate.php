<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/13
 * Time: 16:44
 */

namespace app\api\validate;


class AddressValidate extends BaseValidate
{
   protected $rule = [
       'name' => 'require|isNotEmpty',
       'mobile' => 'require|isNotMobile',
       'province' => 'require|isNotEmpty',
       'city' => 'require|isNotEmpty',
       'country' => 'require|isNotEmpty',
       'detail'=>'require|isNotEmpty'
   ];

}