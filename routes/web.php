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
//首页
Route::any('/','IndexController@index');
//详情
Route::any('shopcontent/{id}','IndexController@shopcontent');
//
Route::any('shopdo','IndexController@index');
//分类数据
Route::any('allshops','AllshopsController@index');
Route::any('cate','AllshopsController@cate');//点击分类
Route::any('sortshop','AllshopsController@sortshop');
Route::any('default','AllshopsController@default');//价格 库存
Route::any('cateshop/{id}','AllshopsController@cateshop');//点击分类
//购物车
Route::any('shopcart','ShopCartController@index')->middleware('login');
Route::any('cart/add','ShopCartController@add')->middleware('login');
Route::any('cart/del','ShopCartController@del')->middleware('login');
Route::any('cartnum','ShopCartController@cartnum')->middleware('login');
//我的
Route::any('userindex','UserController@index');
route::any('edituser',"UserController@edituser")->middleware('login');
route::any('set','UserController@set')->middleware('login');
route::any('edit',"UserController@edit");//退出
//晒单
Route::any('share','ShareController@index');
//登录
Route::any('login','LoginController@index');
Route::any('login/do','LoginController@do');
route::any('doregister',"LoginController@doregister");

//注册
Route::any('register','RegisterController@index');
Route::any('register/do','RegisterController@do');
Route::any('phone','LoginController@phone');
//验证码
route::any('verify/create','CaptchaController@create');
//收货地址
Route::prefix('address')->group(function () {
    Route::get('index', 'Order\addressController@index');
    Route::any('writeaddr', 'Order\addressController@writeaddr');
    Route::any('add', 'Order\addressController@add');
    Route::any('del', 'Order\addressController@del');
    Route::any('edit/{id}', 'Order\addressController@edit');
    Route::any('editdo', 'Order\addressController@editdo');
    Route::any('setdefalt', 'Order\addressController@setdefalt');
});

//结算
Route::any('order', 'Order\patmentController@patment');
Route::any('order/pat/{id}', 'Order\patmentController@pay');

//潮购记录
Route::any('buyrecord', 'User\buyrecordController@buyrecord');
//我的钱包
Route::any('mywallet', 'User\mywalletController@mywallet')->middleware('login');
Route::any('safeset', 'User\safesetController@safeset')->middleware('login');
Route::any('loginpwd', 'User\safesetController@loginpwd')->middleware('login');//修改密码
Route::any('pwd', 'User\safesetController@pwd')->middleware('login');


