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
//Route::get('/search','Home\IndexController@search');
//商品详情页面
Route::get('/click/search/{id}','Home\IndexController@clickSearch');
Route::get('search/criteria','Home\IndexController@searchCriteria');

//Route::get('/goodDetails','Home\IndexController@goodDetails');
Route::get('/mygoodDetail/{gid}','Home\IndexController@mygoodDetail');

//商品详情页面
Route::get('/goodDetails/{id}','Home\IndexController@goodDetails');

Route::prefix('/home')->group(function () {

    //退出登录
    Route::get('exit','Home\LoginController@exit');

    // 发布闲置
    Route::get('addgoods','Home\AddController@index')->middleware('Home');
    //结算页面
    Route::get('pay/{id}','Home\IndexController@pay')->middleware('Home');
//加入购物车
    Route::post('storecart','Home\IndexController@storecart');
//结算完成
    Route::post('success','Home\IndexController@success')->middleware('Home');
//地址改变
    Route::get('Achange','Home\IndexController@Achange')->middleware('Home');


    Route::get('addgoods/two','Home\AddController@two')->middleware('Home');
    Route::get('addgoods/three','Home\AddController@three')->middleware('Home');
// 提交发布
    Route::post('addgoods/doadd','Home\AddController@doadd')->middleware('Home');

    // 前台 ============================================================================
    // 注册
    Route::get('login/index','Home\LoginController@index');
//    邮箱注册
    Route::post('login/doreg','Home\LoginController@doreg');
    Route::get('login/log/{token}','Home\LoginController@log')->name('log');

    //邮件注册发送成功跳转路由
    Route::get('login/email','Home\LoginController@email');
    //手机号注册成功跳转路由
    Route::get('login/phone','Home\LoginController@phone');

    // 手机验证码
    Route::post('login/yzm','Home\LoginController@yzm');

    ///*前台登录 **********************************/
    Route::get('login/login','Home\LoginController@login');

});


Route::prefix('/admins')->group(function(){


    //后台中间件
//后台主页

    Route::get('index','admin\AdminController@index')->middleware('Admin');
    Route::get('wel','admin\AdminController@wel')->middleware('Admin');

    /*分类管理*/
    //类别浏览

    Route::get('Cate','admin\AdminController@Cate')->middleware('Admin');
    Route::get('goods/add/{id}','admin\AdminController@CateAdd')->middleware('Admin');
    Route::post('goods/doadd','admin\AdminController@CatedoAdd')->middleware('Admin');
    //修改分类
    Route::get('goods/edit/{id}','admin\AdminController@CateEdit')->middleware('Admin');
    //执行修改
    Route::post('goods/update','admin\AdminController@CateUpdate')->middleware('Admin');
    //删除分类
    Route::get('goods/del','admin\AdminController@CateDel')->middleware('Admin');
    Route::get('goods/addfirst','admin\AdminController@CateAddFirst')->middleware('Admin');
    Route::post('goods/doaddfirst','admin\AdminController@CateDoAddFirst')->middleware('Admin');
    /*商品管理*/
    //商品浏览
    //Route::get('/admins/Good','admin\AdminController@Good');
    //上架下架
    Route::post('Good/changestatus','Admin\GoodsController@changestatus')->middleware('Admin');
    //批量删除
    Route::get('Good/delall','Admin\GoodsController@delall')->middleware('Admin');
    //待审核商品
    Route::get('Good/stating','Admin\GoodsController@stating')->middleware('Admin');
    // 审核通过并上架

    Route::post('Good/state','Admin\GoodsController@state')->middleware('Admin');


    //商品类别联动 二级two 和三级three
    Route::get('Good/two','Admin\GoodsController@two')->middleware('Admin');
    Route::get('Good/three','Admin\GoodsController@three')->middleware('Admin');

    Route::resource('Good','Admin\GoodsController')->middleware('Admin');





});



//个人中心页面
Route::get('/center','Home\IndexController@center')->middleware('Home');
//个人信息页面
Route::get('/information','Home\IndexController@information')->middleware('Home');
//修改个人信息
Route::post('/infoupdate','Home\IndexController@infoupdate')->middleware('Home');
//安全设置
Route::get('/safety','Home\IndexController@safety')->middleware('Home');

//我的发布
Route::get('/publish','Home\IndexController@publish')->middleware('Home');

//收货地址
Route::get('/address','Home\IndexController@address')->middleware('Home');
//添加收货地址
Route::post('/doaddress','Home\IndexController@doaddress')->middleware('Home');
//设置默认收货地址
Route::post('/dodefault','Home\IndexController@dodefault')->middleware('Home');
Route::post('/deladd','Home\IndexController@deladd')->middleware('Home');

//订单管理
Route::get('/order','Home\IndexController@order')->middleware('Home');

Route::get('/orderDisplay','Home\IndexController@orderDisplay')->middleware('Home');

//退款售后
Route::get('/change','Home\IndexController@change')->middleware('Home');
//收藏页面
Route::get('/collection','Home\IndexController@collection')->middleware('Home');











/*
 * 前台页面
 */

    // 生成验证码路由
    Route::get('home/login/code','Home\LoginController@code');

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





// 文件上传路由
Route::post('/upload','UploadController@upload');




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

/*Route::get('/admins/RC','admin\AdminController@RC')->middleware('Admin');*/

///轮播图资源控制器
/// 文件上传
Route::post('/admins/Res/upload','admin\RotationController@upload');
//删除所有
Route::get('/admins/Res/delall','admin\RotationController@delall');
//修改轮播图状态
Route::get('/admins/Res/statusup','admin\RotationController@statusup');
//轮播资源控制器
Route::resource('/admins/Res','admin\RotationController')->middleware('Admin');



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



//后台用户修改

Route::get('/admins/User/delall','admin\UserController@delall')->middleware('Admin');
Route::get('/admins/User/Repass','admin\UserController@Repass')->middleware('Admin');
Route::post('/admins/User/pedit','admin\UserController@pedit')->middleware('Admin');
Route::get('/admins/exit','admin\LoginController@exit')->middleware('Admin');
Route::resource('/admins/User','admin\UserController')->middleware('Admin');



//后台退出登录
Route::get('/admins/exit','admin\LoginController@exit');







