<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/11
 * Time: 21:33
 */
namespace app\api\model;

use think\Model;

class Image extends Model{
      protected $hidden = ['delete_time','update_time'];
}