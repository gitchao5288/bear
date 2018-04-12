<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>搜索页面</title>

		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

		<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />

		<link href="/home/basic/css2/seastyle.css" rel="stylesheet" type="text/css" />


		<script type="text/javascript" src="/home/basic/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/home/js/script.js"></script>
		<link rel="stylesheet" href="/css/fenye.css">



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
					</div>
				</div>
			</ul>
			<ul class="message-r">
				<div class="topMessage home">
					<div class="menu-hd"><a href="/" target="_top" class="h">商城首页</a></div>
				</div>
				<div class="topMessage my-shangcheng">
					<div class="menu-hd MyShangcheng"><a href="/center" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
				</div>

				<div class="topMessage favorite">
					<div class="menu-hd"><a href="/collection" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
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
					<form action="/search/criteria" method="get">

						<input id="searchInput" name="gname" type="text" value="{{ $request->gname or '' }}" placeholder="搜索" autocomplete="off">
						<input id="ai-topsearch" class="submit am-btn"  value="搜索" index="1" type="submit">
					</form>
				</div>
			</div>

			<div class="clear"></div>
			<b class="line"></b>
           <div class="search">
			<div class="search-list">
			<div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
				@include('home.public.nav')
			</div>
			
				
					<div class="am-g am-g-fixed">
						<div class="am-u-sm-12 am-u-md-12">

							<div class="search-content">




								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes" >
									@foreach($goods as $v)
									<li>
										<div class="i-pic limit">
											<a href="/goodDetails/{{ $v->gid }}">

											<img src="{{ $v->gpic }}" /></a>
											<p class="title fl">{{ $v->gname }}</p>
											<p class="price fl">
												<b>¥</b>
												<strong>{{ $v->price }}</strong>
											</p>

										</div>
									</li>
									@endforeach
								</ul>

							</div>
							<!--分页 -->

							<div class="clear"></div>


							{{$goods->appends($request->all())->render()}}


						</div>
					</div>
				<!--底部-->
				@include('home.public.footer')
				</div>

			</div>

		<!--引导 -->
		<div class="navCir">
			<li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="../person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>


		<script>
			window.jQuery || document.write('<script src="basic/js/jquery-1.9.min.js"><\/script>');
		</script>
		<script type="text/javascript" src="../basic/js/quick_links.js"></script>

<div class="theme-popover-mask"></div>

	</body>

</html>