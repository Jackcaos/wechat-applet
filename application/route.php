<?php

 use think\Route;

 Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');

 Route::get('api/:version/theme','api/:version.Theme/getSimpleList');
 Route::get('api/:version/theme/:id','api/:version.Theme/getTheme');

Route::get('api/:version/product/getNew','api/:version.Product/getNew');
Route::get('api/:version/product/getCategory','api/:version.Product/getCategoryProduct');

Route::get('api/:version/category/all','api/:version.Category/getAll');

Route::post('api/:version/token/user','api/:version.Token/getToken');