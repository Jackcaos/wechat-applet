<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/14
 * Time: 9:29
 */

namespace app\api\controller\v1;


use app\api\validate\OrderCheck;
use app\lib\enum\ScopeEnum;
use think\Controller;
use app\api\service\Token;

class Order extends Controller
{
    protected $beforeActionList = [
      'checkUserScope' => ['only' => 'orderProduct']
    ];

    protected function checkUserScope(){
        $scope = Token::getTokenValue('scope');
        if($scope == ScopeEnum::User){
            return true;
        }
        else
        {
            return false;
        }
    }

    public function orderProduct(){
        (new OrderCheck())->goCheck();
        $product = input('post.product/a');
        $uid = Token::getUserId();

        return 111;
    }
}