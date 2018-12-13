<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/13
 * Time: 14:51
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden = ['update_time','delete_time','product_id'];
}