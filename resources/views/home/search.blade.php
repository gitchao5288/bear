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
		<link rel="stylesheet" href="/home/css/fenye.css">

		<script type="text/javascript" src="/home/basic/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/home/js/script.js"></script>
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
				<div class="topMessage mini-cart">
					<div class="menu-hd"><a id="mc-menu-hd" href="/home/shopcart" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
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
					<form action="/home/Searchs" method="get">
						{{ csrf_field() }}
						<input id="searchInput" name="rname" value="{{ $request->rname or '' }}" type="text" placeholder="搜索" autocomplete="off" >
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
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
							</ul>
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>
			</div>
			
				
					<div class="am-g am-g-fixed">
						<div class="am-u-sm-12 am-u-md-12">
	                  	<div class="theme-popover">														

							<div class="clear"></div>
                        </div>
							<div class="search-content">
								<div class="sort">
									<li class="first"><a title="综合">综合排序</a></li>
									<li><a title="价格">价格优先</a></li>
								</div>
								<div class="clear"></div>

								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
									@foreach($goods as $v)
									<li>
										<div class="i-pic limit">
											<a href="/gooddetails/{{$v->gid}}">
											<img src="{{$v->gpic}}" />
											<p class="title fl">【{{$v->gname}}】{{$v->gdesc}}</p>
											<p class="price fl">
												<b>¥</b>
												<strong>{{$v->price}}</strong>
											</p>
											</a>
										</div>
									</li>
									@endforeach
								</ul>
							</div>
							<!--分页 -->


							<div class="clear"></div>

							{!! $goods->appends($request->all())->render() !!}

						</div>
					</div>
					<div class="footer">
						<div class="footer-hd">
							<p>
								<a href="#">恒望科技</a>
								<b>|</b>
								<a href="/">商城首页</a>
								<b>|</b>
								<a href="#">支付宝</a>
								<b>|</b>
								<a href="#">物流</a>
							</p>
						</div>
						<div class="footer-bd">
							<p>
								<a href="#">关于恒望</a>
								<a href="#">合作伙伴</a>
								<a href="#">联系我们</a>
								<a href="#">网站地图</a>
								<em>© 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em>
							</p>
						</div>
					</div>
				</div>

			</div>

		<!--引导 -->
		<div class="navCir">
			<li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="../person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>

		<!--菜单 -->
		<div class=tip>
			<div id="sidebar">
				<div id="wrap">
					<div id="prof" class="item">
						<a href="#">
							<span class="setting"></span>
						</a>
						<div class="ibar_login_box status_login">
							<div class="avatar_box">
								<p class="avatar_imgbox"><img src="/home/basic/images2/no-img_mid_.jpg" /></p>
								<ul class="user_info">
									<li>用户名：sl1903</li>
									<li>级&nbsp;别：普通会员</li>
								</ul>
							</div>
							<div class="login_btnbox">
								<a href="#" class="login_order">我的订单</a>
								<a href="#" class="login_favorite">我的收藏</a>
							</div>
							<i class="icon_arrow_white"></i>
						</div>

					</div>
					<div id="shopCart" class="item">
						<a href="#">
							<span class="message"></span>
						</a>
						<p>
							购物车
						</p>
						<p class="cart_num">0</p>
					</div>
					<div id="asset" class="item">
						<a href="#">
							<span class="view"></span>
						</a>
						<div class="mp_tooltip">
							我的资产
							<i class="icon_arrow_right_black"></i>
						</div>
					</div>

					<div id="foot" class="item">
						<a href="#">
							<span class="zuji"></span>
						</a>
						<div class="mp_tooltip">
							我的足迹
							<i class="icon_arrow_right_black"></i>
						</div>
					</div>

					<div id="brand" class="item">
						<a href="#">
							<span class="wdsc"><img src="/home/basic/images2/wdsc.png" /></span>
						</a>
						<div class="mp_tooltip">
							我的收藏
							<i class="icon_arrow_right_black"></i>
						</div>
					</div>

					<div id="broadcast" class="item">
						<a href="#">
							<span class="chongzhi"><img src="/home/basic/images2/chongzhi.png" /></span>
						</a>
						<div class="mp_tooltip">
							我要充值
							<i class="icon_arrow_right_black"></i>
						</div>
					</div>

					<div class="quick_toggle">
						<li class="qtitem">
							<a href="#"><span class="kfzx"></span></a>
							<div class="mp_tooltip">客服中心<i class="icon_arrow_right_black"></i></div>
						</li>
						<!--二维码 -->
						<li class="qtitem">
							<a href="#none"><span class="mpbtn_qrcode"></span></a>
							<div class="mp_qrcode" style="display:none;"><img src="/home/basic/images2/weixin_code_145.png" /><i class="icon_arrow_white"></i></div>
						</li>
						<li class="qtitem">
							<a href="#top" class="return_top"><span class="top"></span></a>
						</li>
					</div>

					<!--回到顶部 -->
					<div id="quick_links_pop" class="quick_links_pop hide"></div>

				</div>

			</div>
			<div id="prof-content" class="nav-content">
				<div class="nav-con-close">
					<i class="am-icon-angle-right am-icon-fw"></i>
				</div>
				<div>
					我
				</div>
			</div>
			<div id="shopCart-content" class="nav-content">
				<div class="nav-con-close">
					<i class="am-icon-angle-right am-icon-fw"></i>
				</div>
				<div>
					购物车
				</div>
			</div>
			<div id="asset-content" class="nav-content">
				<div class="nav-con-close">
					<i class="am-icon-angle-right am-icon-fw"></i>
				</div>
				<div>
					资产
				</div>

				<div class="ia-head-list">
					<a href="#" target="_blank" class="pl">
						<div class="num">0</div>
						<div class="text">优惠券</div>
					</a>
					<a href="#" target="_blank" class="pl">
						<div class="num">0</div>
						<div class="text">红包</div>
					</a>
					<a href="#" target="_blank" class="pl money">
						<div class="num">￥0</div>
						<div class="text">余额</div>
					</a>
				</div>

			</div>
			<div id="foot-content" class="nav-content">
				<div class="nav-con-close">
					<i class="am-icon-angle-right am-icon-fw"></i>
				</div>
				<div>
					足迹
				</div>
			</div>
			<div id="brand-content" class="nav-content">
				<div class="nav-con-close">
					<i class="am-icon-angle-right am-icon-fw"></i>
				</div>
				<div>
					收藏
				</div>
			</div>
			<div id="broadcast-content" class="nav-content">
				<div class="nav-con-close">
					<i class="am-icon-angle-right am-icon-fw"></i>
				</div>
				<div>
					充值
				</div>
			</div>
		</div>
		<script>
			window.jQuery || document.write('<script src="basic/js/jquery-1.9.min.js"><\/script>');
		</script>
		<script type="text/javascript" src="../basic/js/quick_links.js"></script>

<div class="theme-popover-mask"></div>

	</body>

</html>