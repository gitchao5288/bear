<?php

/*
 *
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
//    邮箱注册
    Route::post('home/login/doreg','Home\LoginController@doreg');
    Route::get('home/login/log/{token}','Home\LoginController@log')->name('log');

    //邮件注册发送成功跳转路由
    Route::get('home/login/email','Home\LoginController@email');
    //手机号注册成功跳转路由
    Route::get('home/login/phone','Home\LoginController@phone');

    // 手机验证码
    Route::post('home/login/yzm','Home\LoginController@yzm');

    ///*前台登录 **********************************/
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

    // 生成验证码路由
    Route::get('home/login/code','Home\loginController@code');

    // 前台登录处理路由
    Route::post('home/login/dologin','Home\LoginController@dologin');

    /*忘记密码路由 **************************************/
    Route::get('home/getpass/forget','Home\GetpassController@forget');
    // 邮箱找回 ------------------------/
    Route::get('home/getpass/emailpass','Home\GetpassController@emailpass');
//    验证身份
    Route::post('home/getpass/emailget','Home\GetpassController@emailget');
//    发送验证邮件
    Route::get('home/getpass/erepass/{rand}','Home\GetpassController@erepass')->name('erepass');
//    找回密码邮件跳转路由
    Route::get('home/getpass/epass/{token}','Home\GetpassController@epass')->name('epass');
//    执行重置密码路由
    Route::post('home/getpass/eget','Home\GetpassController@eget');
    Route::get('home/getpass/emaildone','Home\GetpassController@emaildone');

    // 手机号找回 ------------------------/
    Route::get('home/getpass/phonepass','Home\GetpassController@phonepass');
    // 手机验证码
    Route::post('home/getpass/yzm','Home\GetpassController@yzm');
//    执行找回
    Route::post('home/getpass/phoneget','Home\GetpassController@phoneget');
//    手机号找回成功
    Route::get('home/getpass/phonedone','Home\GetpassController@phonedone');




//后台登录路由
Route::get('/admins/login','admin\LoginController@login');
//后台处理登录路由
Route::post('/admins/dologin','admin\LoginController@dologin');
//验证码路由
Route::get('/kit/captcha/{tmp}','KitController@captcha');


//后台主页
Route::get('/admins/index','admin\AdminController@index')->middleware('Admin');
Route::get('/admins/wel','admin\AdminController@wel')->middleware('Admin');


/*分类管理*/
//类别浏览
Route::get('/admins/Cate','admin\AdminController@Cate')->middleware('Admin');

Route::get('/admins/cate/add/{id}','admin\AdminController@CateAdd')->middleware('Admin');

Route::post('/admins/cate/doadd','admin\AdminController@CatedoAdd')->middleware('Admin');

//修改分类
Route::get('/admins/cate/edit/{id}','admin\AdminController@CateEdit')->middleware('Admin');
//执行修改
Route::post('/admins/cate/update','admin\AdminController@CateUpdate')->middleware('Admin');

//删除分类
Route::get('/admins/cate/del','admin\AdminController@CateDel')->middleware('Admin');


Route::get('/admins/cate/addfirst','admin\AdminController@CateAddFirst')->middleware('Admin');

Route::post('admins/cate/doaddfirst','admin\AdminController@CateDoAddFirst')->middleware('Admin');
/*商品管理*/
//商品浏览
Route::get('/admins/Good','admin\AdminController@Good')->middleware('Admin');



/*订单管理*/
//订单浏览
Route::get('/admins/Order','admin\AdminController@Order')->middleware('Admin');
/*订单管理*/
//订单浏览
Route::get('/admins/Order/delall','admin\OrderController@delall')->middleware('Admin');
Route::resource('/admins/Order','admin\OrderController')->middleware('Admin');



/*广告管理*/
//广告浏览
Route::get('/admins/AD/delall','admin\Adcontroller@delall')->middleware('Admin');
Route::post('/admins/AD/upload','admin\Adcontroller@upload')->middleware('Admin');
Route::resource('/admins/AD','admin\Adcontroller')->middleware('Admin');

/*轮播图管理*/
//轮播图浏览
Route::get('/admins/RC','admin\AdminController@RC')->middleware('Admin');


/*数据统计*/
Route::get('/admins/Data','admin\AdminController@Data')->middleware('Admin');


/*用户管理*/


//管理前台用户添加
Route::get('/admins/Huseradd','admin\AdminController@Huseradd')->middleware('Admin');
//前台用户修改
Route::get('/admins/Huseredit','admin\AdminController@Huseredit')->middleware('Admin');



//后台用户浏览页面
//Route::get('/admins/User','admin\AdminController@Auser');
//后台用户添加
Route::get('/admins/Useradd','admin\AdminController@Useradd')->middleware('Admin');
//后台用户修改
//Route::get('/admins/Useredit','admin\AdminController@Useredit');


Route::resource('/admins/User','admin\UserController')->middleware('Admin');
// Route::get('/admins/Huser','admin\AdminController@Huser');

//后台退出登录
Route::get('/admins/exit','admin\LoginController@exit');






