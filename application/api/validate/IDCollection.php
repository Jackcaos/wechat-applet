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
        'string'=>'require|checkIDs'
    ];

    protected $message = [
        'string' => 'string必须是以逗号分隔的多个整数'
    ];
    //string = string1,string2
    protected function checkIDs($value){
        $values = explode(',',$value);
        if(empty($values)){
            return false;
        }
        foreach($values as $id) {
         if(!$this->isPositiveInteger($id)){
             return false;
         }
        }
        return true;
    }
}