<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/6/24
 * Time: 23:35
 */
namespace app\api\controller\v1;
use app\api\validate\IDMustBePostiveint;
use app\api\model\Banner as BannerModel;
use think\Exception;

class Banner {
    public function getBanner($id)
    {
        (new IDMustBePostiveint())->goCheck();     //检测数据id
        $banner = BannerModel::getBannerByID($id);    //调用获取Banner的model方法
        if(!$banner){
            throw new Exception("未取得相关banner");
        }
        return $banner;
    }
}