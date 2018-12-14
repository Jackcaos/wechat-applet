<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/14
 * Time: 10:47
 */

namespace app\api\service;


use app\api\model\Product;
use app\api\model\UserAddress;
use think\Exception;

class Order
{
    //数据库中的products数量
    protected $allProducts;
    //传递的products数量
    protected $products;
    //用户的id
    protected $uid;

   public function orderProducts($uid,$products){
     $this->products = $products;       //初始化购物车商品数量
     $this->uid = $uid;                 //获得用户的id
     $this->allProducts = $this->getProductsMsg($products);     //获得数据所有商品的信息
     $orderStatus = $this->getOrderStatus();
     if(!$orderStatus['pass']){
         $orderStatus['order_id'] = -1;
         return $orderStatus;
     }

     //订单快照的生成
       $orderSnap = $this->snapOrder();
   }

   protected function getProductsMsg($products){
       //$pidList为所以商品的集合
       //查询所有商品的id,price,name,main_img_url,stock
       $pidList = [];
       foreach ($products as $product){
           array_push($pidList,$product['product_id']);
       }
       $allProducts = Product::all($pidList)
           ->visible(['id','price','name','stock','main_img_url'])->toArray();
       return $allProducts;
   }

   //检测购物车的物品数量是否足够，计算金额及商品数量
   private function getOrderStatus(){
       $status = [
           'pass' => true,
           'orderPrice' => 0,
           'totalCount' => 0,
           'productArray' => []
       ];
       foreach ($this->products as $product){
          $productStatus = $this->compareProductNum($product['product_id'],$product['count'],$this->allProducts);
           if(!$productStatus['haveStock']){
               $status['pass'] = false;
           }
           $status['totalCount'] += $productStatus['count'];
           $status['orderPrice'] += $productStatus['totalPrice'];
           array_push($status['productArray'],$productStatus);
       }
       return $status;
   }

   //比较相关的商品数量
    private function compareProductNum($pid,$productCount,$allProducts){
       $productIndex = -1;
       $status = [
          'id' => null,
          'haveStock' => false,
          'count' => 0,
          'name' => '',
          'totalPrice' => 0
        ];
       for($i = 0; $i < count($allProducts);$i++){
           if($pid == $allProducts[$i]['id']){
               $productIndex = $i;
           }
       }
       if($productIndex == -1){
           throw new Exception("商品不存在");
       }
       else{
           $status['id'] = $allProducts['id'];
           $status['count'] = $productCount;
           $status['name'] = $allProducts['name'];
           $status['totalPrice'] = $allProducts['price'] * $productCount;
           if($allProducts['stock'] >= $productCount)
           {
               $status['haveStock'] = true;
    }
}
       return $status;
    }

    //获取用户的地址
    protected function getUserAddress(){
       $userAddress = UserAddress::where('user_id',$this->uid)->find();
       if(!$userAddress){
           throw new Exception("用户收获地址不存在");
       }
       return $userAddress->toArray();
    }

    //订单代码快照的构建
    protected function snapOrder($orderStatus){
       $snap = [
           'orderPrice' => 0,
           'totalCount' =>  0,
           'status' => [],
           'snapAddress' => '',
           'snapName' => '',
           'snapImg' =>''
       ];
       $snap['orderPrice'] = $orderStatus['orderPrice'];
       $snap['totalCount'] = $orderStatus['totalCount'];
       $snap['status'] = $orderStatus['productArray'];
       $snap['snapAddress'] = json_encode($this->getUserAddress());
       //TODO
    }
}