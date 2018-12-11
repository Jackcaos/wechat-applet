<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/11
 * Time: 23:48
 */

namespace app\api\model;
use think\Model;

class BaseModel extends Model
{
    //图片读取器的编写，若from==1为本地图片反之为网络图片
    protected function prefixImgUrl($value,$data){   //这里取得的是图片的Url:'/banner-1a.jpg'
        $url = $value;
        if($data['from'] == 1){
            $url = config('setting.img_prefix').$value;
        }
        return $url;
    }

}