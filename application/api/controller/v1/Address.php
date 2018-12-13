<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/13
 * Time: 16:38
 */

namespace app\api\controller\v1;

use app\api\service\Token as TokenService;
use app\api\validate\AddressValidate;

class Address
{
     public function addOrChangeAddress(){
         (new AddressValidate())->goCheck();
         TokenService::getUserId();
     }
}