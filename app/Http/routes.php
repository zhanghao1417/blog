<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|后台管理员：admin
|管理员密码：123456
*/



Route::get('/','Home\IndexController@index');
Route::get('/cate/{id}', 'Home\IndexController@cate');
Route::get('/a/{id}', 'Home\IndexController@article');

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function() {

    Route::any('login', 'LoginController@login');
    Route::get('code', 'LoginController@code');

});

Route::group(['middleware' => ['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function() {

    Route::get('info', 'IndexController@info');
    Route::get('index', 'IndexController@index');
    Route::any('pass', 'IndexController@pass');
    Route::get('quit', 'LoginController@quit');

//    分类路由
    Route::post('cate/changeorder', 'CategoryController@changeOrder');
    Route::resource('category','CategoryController');

//    文章路由
    Route::resource('article','ArticleController');

//    友情链接路由
    Route::post('links/changeorder', 'LinksController@changeOrder');
    Route::resource('links','LinksController');

//    导航路由
    Route::post('navs/changeorder', 'NavsController@changeOrder');
    Route::resource('navs','NavsController');

//    配置项路由
    Route::post('config/changeorder', 'ConfigController@changeOrder');
    Route::post('config/changeContent', 'ConfigController@changeContent');
    Route::get('config/putfile', 'ConfigController@putFile');
    Route::resource('config','ConfigController');

//    上传图片
    Route::any('upload', 'CommonController@upload');

});


