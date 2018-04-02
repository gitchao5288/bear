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
    return view('home.index');
});

// 前台 ============================================================================
    // 注册
    Route::get('home/login/index','Home\LoginController@index');
    Route::post('home/login/doreg','Home\LoginController@doreg');
    Route::get('home/login/log/{token}','Home\LoginController@log')->name('log');

    //邮件注册发送成功跳转路由
    Route::get('home/login/email','Home\LoginController@email');
    //手机号注册成功跳转路由
    Route::get('home/login/phone','Home\LoginController@phone');

    // 手机验证码
    Route::post('home/login/yzm','Home\LoginController@yzm');


    //前台登录
    Route::get('home/login/login','Home\LoginController@login');


/*
 * 前台页面
 */

//购物车页面
Route::get('/home/shopcart',function(){
    return view('home.shopcart');
});

//结算页面
Route::get('/home/pay',function(){
    return view('home.pay');
});
Route::get('/home/success',function(){
    return view('home.success');
});



//后台登录路由
Route::get('/admins/login','admin\LoginController@login');
//后台处理登录路由
Route::post('/admins/dologin','admin\LoginController@dologin');
//验证码路由
Route::get('/kit/captcha/{tmp}','KitController@captcha');


//后台主页
Route::get('/admins/index','admin\AdminController@index');
Route::get('/admins/wel','admin\AdminController@wel');


/*分类管理*/
//类别浏览
Route::get('/admins/Cate','admin\AdminController@Cate');

Route::get('/admins/cate/add/{id}','admin\AdminController@CateAdd');

Route::post('/admins/cate/doadd','admin\AdminController@CatedoAdd');

//修改分类
Route::get('/admins/cate/edit/{id}','admin\AdminController@CateEdit');
//执行修改
Route::post('/admins/cate/update','admin\AdminController@CateUpdate');

//删除分类
Route::get('/admins/cate/del','admin\AdminController@CateDel');


Route::get('/admins/cate/addfirst','admin\AdminController@CateAddFirst');

Route::post('admins/cate/doaddfirst','admin\AdminController@CateDoAddFirst');
/*商品管理*/
//商品浏览
Route::get('/admins/Good','admin\AdminController@Good');



/*订单管理*/
//订单浏览
Route::get('/admins/Order','admin\AdminController@Order');
/*订单管理*/
//订单浏览
Route::get('/admins/Order/delall','admin\OrderController@delall');
Route::resource('/admins/Order','admin\OrderController');



/*广告管理*/
//广告浏览
Route::get('/admins/AD/delall','admin\Adcontroller@delall');
Route::post('/admins/AD/upload','admin\Adcontroller@upload');
Route::resource('/admins/AD','admin\Adcontroller');

/*轮播图管理*/
//轮播图浏览
Route::get('/admins/RC','admin\AdminController@RC');


/*数据统计*/
Route::get('/admins/Data','admin\AdminController@Data');


/*用户管理*/


//管理前台用户添加
Route::get('/admins/Huseradd','admin\AdminController@Huseradd');
//前台用户修改
Route::get('/admins/Huseredit','admin\AdminController@Huseredit');



//后台用户浏览页面
//Route::get('/admins/User','admin\AdminController@Auser');
//后台用户添加
Route::get('/admins/Useradd','admin\AdminController@Useradd');
//后台用户修改
//Route::get('/admins/Useredit','admin\AdminController@Useredit');


Route::resource('/admins/User','admin\UserController');
// Route::get('/admins/Huser','admin\AdminController@Huser');








