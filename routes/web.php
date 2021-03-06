<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//登录页面显示
Route::get('admin/login', 'admin\LoginController@login');
//登录操作
Route::post('Login/login_to', 'admin\LoginController@login_to');
Route::group(['middleware' => 'admin.login', 'prefix' => 'admin'], function (){
    //无权限页面
    Route::get('/no_permission', 'admin\IndexController@no_permission');
    //退出登录
    Route::get('/logout', 'admin\LoginController@logout');
    //图片上传接口
    Route::post('/index/uploads', 'admin\IndexController@uploads');
    //首页显示和欢迎页面显示
    Route::get('/index', 'admin\IndexController@index');
    Route::get('/welcome', 'admin\IndexController@welcome');

    //轮播图
    Route::get('/banner/index', 'admin\BannerController@index');
    Route::get('/banner/create', 'admin\BannerController@create');
    Route::post('/banner/store', 'admin\BannerController@store');
    Route::get('/banner/edit/{banner_id}', 'admin\BannerController@edit');
    Route::post('/banner/update', 'admin\BannerController@update');
    Route::post('/banner/destroy', 'admin\BannerController@destroy');
});