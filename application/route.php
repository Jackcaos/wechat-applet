<?php

 use think\Route;

Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');

Route::get('api/:version/theme','api/:version.Theme/getSimpleList');
Route::get('api/:version/theme/:id','api/:version.Theme/getTheme');

//最新商品，分类商品，商品详情，
Route::get('api/:version/product/getNew','api/:version.Product/getNew');
Route::get('api/:version/product/getCategory','api/:version.Product/getCategoryProduct');
Route::get('api/:version/product/:id','api/:version.Product/getProduct',[],['id'=>'\d+']);

Route::get('api/:version/category/all','api/:version.Category/getAll');

Route::get('api/:version/address','api/:version.Address/addOrChangeAddress');

Route::post('api/:version/token/user','api/:version.Token/getToken');