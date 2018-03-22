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

//后台登录路由
Route::get('/admins/login','admin\LoginController@login');
//后台处理登录路由
Route::post('/admins/dologin','admin\LoginController@dologin');
//验证码路由
Route::get('/kit/captcha/{tmp}','KitController@captcha');
