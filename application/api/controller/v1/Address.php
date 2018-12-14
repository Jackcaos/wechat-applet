<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/13
 * Time: 16:38
 */

namespace app\api\controller\v1;

use app\api\service\Token as TokenService;
use app\api\model\User as UserModel;
use app\api\validate\AddressValidate;
use think\Exception;

class Address
{
     public function addOrChangeAddress(){
         (new AddressValidate())->goCheck();
         $uid = TokenService::getUserId();
         $user = UserModel::get($uid);
         if(!$user){
             throw new Exception("用户不存在");
         }
         $data = (new AddressValidate())->getDataByRule(input('post.')); //获取所有传递过来的参数并过虑

         $userAddress = $user->address;               //读取用户的地址
         if(!$userAddress){
             $user->address()->save($data);
         }
         else{
             $user->address->save($data);
         }
         return $user;
     }
}