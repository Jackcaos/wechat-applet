<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/6/27
 * Time: 23:11
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule = [
        'id'=>'require|checkIDs'
    ];

    protected $message = [
        'id' => 'id必须是以逗号分隔的多个整数'
    ];
    protected function checkIDs($value){
        $values = explode(',',$value);
        if(empty($values)){
            return false;
        }
        foreach($values as $ids) {
         if(!$this->isPositiveInteger($ids)){
             return false;
         }
        }
        return true;
    }
}