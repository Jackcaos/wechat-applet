<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/7/28
 * Time: 13:24
 */

namespace app\lib\enum;


class OrderStatusEnum
{
    const UNPAID = 1;
    //未支付
    const PAID = 2;
    //已支付
    const DELIVERED = 3;
    //已发货
    const PAID_BUT_OUT_OF =4;
    //已支付但是库存不足
}