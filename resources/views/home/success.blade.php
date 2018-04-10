<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>付款成功页面</title>
<link rel="stylesheet"  type="text/css" href="../AmazeUI-2.4.2/assets/css/amazeui.css"/>
<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />

<link href="/home/basic/css2/sustyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/home/basic/js/jquery-1.7.min.js"></script>

</head>

<body>


<!--顶部导航条 -->
<div class="am-container header">
  <ul class="message-l">
    <div class="topMessage">
     <div class="menu-hd">
         {{--如果用户没有登录，显示登录链接，如果已经登录，显示用户账号--}}
         @if(!session('user'))
             <a href="/home/login/login" target="_top" class="h">亲，请登录</a>
             <a href="/home/login/index" target="_top">免费注册</a>
         @else
             <span target="_top" class="h">{{session('user')->uname}}</span>
             <span target="_top" >您好！</span>
             <a href="/home/exit" target="_top" class="h">[退出]</a>
         @endif
     </div></div>
  </ul>
  <ul class="message-r">
    <div class="topMessage home"><div class="menu-hd"><a href="/" target="_top" class="h">商城首页</a></div></div>
    <div class="topMessage my-shangcheng"><div class="menu-hd MyShangcheng"><a href="/center" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div></div>

    <div class="topMessage favorite"><div class="menu-hd"><a href="/collection" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
  </ul>
</div>

<!--悬浮搜索框-->

<div class="nav white">
	<div class="logo"><img src="/home/basic/images2/logo.png" /></div>
    <div class="logoBig">
      <li><img src="/home/basic/images2/logobig.png" /></li>
    </div>
    
    <div class="search-bar pr">
        <a name="index_none_header_sysc" href="#"></a>       
        <form>
        <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
        <input id="ai-topsearch" class="submit" value="搜索" index="1" type="submit"></form>
    </div>     
</div>

<div class="clear"></div>



<div class="take-delivery">
 <div class="status">
   <h2>您已成功付款</h2>
   <div class="successInfo">
     <ul>
       <li>付款金额<em>¥{{$ormb}}</em></li>
       <div class="user-info">
         <p>收货人: {{$add->addname}}</p>
         <p>联系电话：{{$add->phone}}</p>
         <p>收货地址：{{$add->add}}</p>
       </div>
             请认真核对您的收货信息，如有错误请联系客服
                               
     </ul>
     <div class="option">
       <span class="info">您可以</span>
        <a href="/order" class="J_MakePoint">查看<span>已买到的宝贝</span></a>

     </div>
    </div>
  </div>
</div>


<!--底部-->
@include('home.public.footer')


</body>
</html>
