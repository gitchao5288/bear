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



//前台首页
Route::get('/','Home\IndexController@index');
//商品列表页
Route::get('/search/{id}','Home\SearchController@search');
Route::get('home/Searchs','Home\SearchController@searchs');
//商品详情页面
Route::get('/goodDetails/{id}','Home\IndexController@goodDetails');
//个人中心页面
Route::get('/center','Home\IndexController@center');
//个人信息页面
Route::get('/information','Home\IndexController@information');
//修改个人信息
Route::post('/infoupdate','Home\IndexController@infoupdate');
//安全设置
Route::get('/safety','Home\IndexController@safety');
//收货地址
Route::get('/address','Home\IndexController@address');
//添加收货地址
Route::post('/doaddress','Home\IndexController@doaddress');
//设置默认收货地址
Route::post('/dodefault','Home\IndexController@dodefault');
Route::post('/deladd','Home\IndexController@deladd');

//订单管理
Route::get('/order','Home\IndexController@order');
//退款售后
Route::get('/change','Home\IndexController@change');
//收藏页面
Route::get('/collection','Home\IndexController@collection');




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


//后台中间件

//后台主页
Route::get('/admins/index','admin\AdminController@index')->middleware('Admin');
Route::get('/admins/wel','admin\AdminController@wel')->middleware('Admin');



/*分类管理*/
//类别浏览

Route::get('/admins/Cate','admin\AdminController@Cate')->middleware('Admin');

Route::get('/admins/goods/add/{id}','admin\AdminController@CateAdd')->middleware('Admin');

Route::post('/admins/goods/doadd','admin\AdminController@CatedoAdd')->middleware('Admin');

//修改分类
Route::get('/admins/goods/edit/{id}','admin\AdminController@CateEdit')->middleware('Admin');
//执行修改
Route::post('/admins/goods/update','admin\AdminController@CateUpdate')->middleware('Admin');

//删除分类
Route::get('/admins/goods/del','admin\AdminController@CateDel')->middleware('Admin');


Route::get('/admins/goods/addfirst','admin\AdminController@CateAddFirst')->middleware('Admin');

Route::post('admins/goods/doaddfirst','admin\AdminController@CateDoAddFirst')->middleware('Admin');
/*商品管理*/
//商品浏览
//Route::get('/admins/Good','admin\AdminController@Good');
//上架下架
Route::post('/admins/Good/changestatus','Admin\GoodsController@changestatus')->middleware('Admin');
//批量删除
Route::get('/admins/Good/delall','Admin\GoodsController@delall')->middleware('Admin');
//待审核商品
Route::get('admins/Good/stating','Admin\GoodsController@stating')->middleware('Admin');
// 审核通过并上架
Route::post('/admins/Good/state','Admin\GoodsController@state')->middleware('Admin');

Route::resource('admins/Good','Admin\GoodsController')->middleware('Admin');

// 文件上传路由
Route::post('/upload','UploadController@upload')->middleware('Admin');



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
/*Route::get('/admins/RC','admin\AdminController@RC')->middleware('Admin');*/
///轮播图资源控制器
/// 文件上传
Route::post('/admins/Res/upload','admin\RotationController@upload');
//删除所有
Route::get('/admins/Res/delall','admin\RotationController@delall');
//修改轮播图状态
Route::get('/admins/Res/statusup','admin\RotationController@statusup');
//轮播资源控制器
Route::resource('/admins/Res','admin\RotationController');


/*数据统计*/
Route::get('/admins/Data','admin\AdminController@Data')->middleware('Admin');


/*用户管理*/

/*//管理前台用户添加
Route::get('/admins/Huseradd','admin\AdminController@Huseradd')->middleware('Admin');
//前台用户修改
Route::get('/admins/Huseredit','admin\AdminController@Huseredit')->middleware('Admin');*/




//管理前台用户
Route::post('/admins/Huser/changestatus','Home\Husercontroller@changestatus')->middleware('Admin');

Route::resource('/admins/Huser','Home\Husercontroller')->middleware('Admin');



//后台用户浏览页面
//Route::get('/admins/User','admin\AdminController@Auser');
//后台用户添加


/*Route::get('/admins/Useradd','admin\AdminController@Useradd')->middleware('Admin');

//后台用户修改
//Route::get('/admins/Useredit','admin\AdminController@Useredit');



Route::resource('/admins/User','admin\UserController')->middleware('Admin');*/


//后台用户修改
Route::get('/admins/User/delall','admin\UserController@delall');
Route::get('/admins/User/Repass','admin\UserController@Repass');
Route::post('/admins/User/pedit','admin\UserController@pedit');
Route::get('/admins/exit','admin\LoginController@exit');
Route::resource('/admins/User','admin\UserController');

// Route::get('/admins/Huser','admin\AdminController@Huser');

//后台退出登录
Route::get('/admins/exit','admin\LoginController@exit');







