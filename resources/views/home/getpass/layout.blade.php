<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

        <title>@yield('title')</title>

		<link href="{{asset('home/AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('home/AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">

		<link href="{{asset('home/css/personal.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('home/css/stepstyle.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('home/bs/css/bootstrap.min.css')}}" type="text/css" rel="stylesheet">

{{--        <script src="{{asset('home/js/jquery-3.2.1.min.js')}}"></script>--}}
		<script src="{{asset('home/AmazeUI-2.4.2/assets/js/jquery.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('home/AmazeUI-2.4.2/assets/js/amazeui.js')}}" type="text/javascript"></script>
		<script src="{{asset('/home/bs/js/bootstrap.min.js')}}" type="text/javascript"></script>

	</head>
	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					<div class="am-container header">
						<ul class="message-l">
							<div class="topMessage">
								<div class="menu-hd">
									<a href="#" target="_top" class="h">亲，请登录</a>
									<a href="#" target="_top">免费注册</a>
								</div>
							</div>
						</ul>
						<ul class="message-r">
							<div class="topMessage home">
								<div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
							</div>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
						</ul>
						</div>

						<!--悬浮搜索框-->

						<div class="nav white">
							<div class="logoBig">
								<li><img src="/home/images/logobig.png" /></li>
							</div>

							<div class="search-bar pr">
								<a name="index_none_header_sysc" href="#"></a>
								<form>
									<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
								</form>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>

		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
                    @section('content')

                    @show

				</div>

				<!--底部-->

			{{--<aside class="menu">--}}
				{{--<ul>--}}
					{{--<li class="person">--}}
						{{--<a href="index.html">个人中心</a>--}}
					{{--</li>--}}
					{{--<li class="person">--}}
						{{--<a href="#">个人资料</a>--}}
						{{--<ul>--}}
							{{--<li> <a href="information.html">个人信息</a></li>--}}
							{{--<li> <a href="safety.html">安全设置</a></li>--}}
							{{--<li> <a href="address.html">收货地址</a></li>--}}
						{{--</ul>--}}
					{{--</li>--}}
					{{--<li class="person">--}}
						{{--<a href="#">我的交易</a>--}}
						{{--<ul>--}}
							{{--<li><a href="order.html">订单管理</a></li>--}}
							{{--<li> <a href="change.html">退款售后</a></li>--}}
						{{--</ul>--}}
					{{--</li>--}}
					{{--<li class="person">--}}
						{{--<a href="#">我的资产</a>--}}
						{{--<ul>--}}
							{{--<li> <a href="coupon.html">优惠券 </a></li>--}}
							{{--<li> <a href="bonus.html">红包</a></li>--}}
							{{--<li> <a href="bill.html">账单明细</a></li>--}}
						{{--</ul>--}}
					{{--</li>--}}

					{{--<li class="person">--}}
						{{--<a href="#">我的小窝</a>--}}
						{{--<ul>--}}
							{{--<li> <a href="collection.html">收藏</a></li>--}}
							{{--<li> <a href="foot.html">足迹</a></li>--}}
							{{--<li> <a href="comment.html">评价</a></li>--}}
							{{--<li> <a href="news.html">消息</a></li>--}}
						{{--</ul>--}}
					{{--</li>--}}

				{{--</ul>--}}

			{{--</aside>--}}
				@include('home.public.footer')
		</div>

	</body>

</html>