<?php

 use think\Route;

 //获取轮播图
Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');

//获取分类主题和单个主题下的商品
Route::get('api/:version/theme','api/:version.Theme/getSimpleList');
Route::get('api/:version/theme/:id','api/:version.Theme/getTheme');

//最新商品，分类商品，商品详情，
Route::get('api/:version/product/getNew','api/:version.Product/getNew');
Route::get('api/:version/product/getCategory','api/:version.Product/getCategoryProduct');
Route::get('api/:version/product/:id','api/:version.Product/getProduct',[],['id'=>'\d+']);

//获取所有的分类
Route::get('api/:version/category/all','api/:version.Category/getAll');

//增加或修改用户的地址信息
Route::post('api/:version/address','api/:version.Address/addOrChangeAddress');

//下单加入购物车
Route::post('api/:version/order','api/:version.Order/orderProduct');

//添加微信验证token
Route::post('api/:version/token/user','api/:version.Token/getToken');