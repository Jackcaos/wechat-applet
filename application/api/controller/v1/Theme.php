<?php
/**
 * Created by PhpStorm.
 * User: aaa
 * Date: 2018/12/12
 * Time: 0:30
 */

namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePostiveint;
use think\Controller;
use think\Exception;

class Theme extends Controller
{
    //需要传递一个字符串形式的string例如 /theme?1,2,3
    public function getSimpleList($string = ''){
        (new IDCollection())->goCheck();
        $arr = explode(',',$string);
        $result = ThemeModel::with('topicImg','headImg')
            ->select($arr);
        if(!$result){
            throw new Exception("指定的theme主题不存在");
        }
        return $result;
    }

    //进入具体专题theme页面
    public function getTheme($id){
        (new IDMustBePostiveint())->goCheck();
        $result = ThemeModel::getThemeProduct($id);
        if(!$result){
           throw new Exception("指定相关商品主题不存在");
        }
        return $result;
    }
}