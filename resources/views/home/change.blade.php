<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>退换货管理</title>

		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/orstyle.css" rel="stylesheet" type="text/css">

		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>

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
					<div class="logoBig">

						<li><img src="/home/basic/images2/logo2.png" /></li>

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
            <div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
				@include('home.public.nav')
			</div>
			<b class="line"></b>		
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-order">

						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">退换货管理</strong> / <small>Change</small></div>
						</div>
						<hr/>

						<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

							<ul class="am-avg-sm-2 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active"><a href="#tab1">退款管理</a></li>
								<li><a href="#tab2">售后管理</a></li>

							</ul>

							<div class="am-tabs-bd">
								<div class="am-tab-panel am-fade am-in am-active" id="tab1">
									<div class="order-top">
										<div class="th th-item">
											<td class="td-inner">商品</td>
										</div>
										<div class="th th-orderprice th-price">
											<td class="td-inner">交易金额</td>
										</div>
										<div class="th th-changeprice th-price">
											<td class="td-inner">退款金额</td>
										</div>
										<div class="th th-status th-moneystatus">
											<td class="td-inner">交易状态</td>
										</div>
										<div class="th th-change th-changebuttom">
											<td class="td-inner">交易操作</td>
										</div>
									</div>

									<div class="order-main">
										<div class="order-list">
											<div class="order-title">
												<div class="dd-num">退款编号：<a href="javascript:;">1601430</a></div>
												<span>申请时间：2015-12-20</span>
												<!--    <em>店铺：小桔灯</em>-->
											</div>
											<div class="order-content">
												<div class="order-left">
													<ul class="item-list">
														<li class="td td-item">
															<div class="item-pic">
																<a href="#" class="J_MakePoint">
																	<img src="/home/images/kouhong.jpg_80x80.jpg" class="itempic J_ItemImg">
																</a>
															</div>
															<div class="item-info">
																<div class="item-basic-info">
																	<a href="#">
																		<p>美康粉黛醉美唇膏 持久保湿滋润防水不掉色</p>
																		<p class="info-little">颜色：12#川南玛瑙
																			<br/>包装：裸装 </p>
																	</a>
																</div>
															</div>
														</li>

														<ul class="td-changeorder">
															<li class="td td-orderprice">
																<div class="item-orderprice">
																	<span>交易金额：</span>72.00
																</div>
															</li>
															<li class="td td-changeprice">
																<div class="item-changeprice">
																	<span>退款金额：</span>70.00
																</div>
															</li>
														</ul>
														<div class="clear"></div>
													</ul>

													<div class="change move-right">
														<li class="td td-moneystatus td-status">
															<div class="item-status">
																<p class="Mystatus">退款成功</p>

															</div>
														</li>
													</div>
													<li class="td td-change td-changebutton">
														<a href="record.html">
														<div class="am-btn am-btn-danger anniu">
															钱款去向</div>
														</a>
													</li>

												</div>
											</div>
										</div>

									</div>

								</div>
								<div class="am-tab-panel am-fade" id="tab2">
									<div class="order-top">
										<div class="th th-item">
											<td class="td-inner">商品</td>
										</div>
										<div class="th th-orderprice th-price">
											<td class="td-inner">交易金额</td>
										</div>
										<div class="th th-changeprice th-price">
											<td class="td-inner">退款金额</td>
										</div>
										<div class="th th-status th-moneystatus">
											<td class="td-inner">交易状态</td>
										</div>
										<div class="th th-change th-changebuttom">
											<td class="td-inner">交易操作</td>
										</div>
									</div>

									<div class="order-main">
										<div class="order-list">
											<div class="order-title">
												<div class="dd-num">退款编号：<a href="javascript:;">1601430</a></div>
												<span>申请时间：2015-12-20</span>
												<!--    <em>店铺：小桔灯</em>-->
											</div>
											<div class="order-content">
												<div class="order-left">
													<ul class="item-list">
														<li class="td td-item">
															<div class="item-pic">
																<a href="#" class="J_MakePoint">
																	<img src="/home/images/kouhong.jpg_80x80.jpg" class="itempic J_ItemImg">
																</a>
															</div>
															<div class="item-info">
																<div class="item-basic-info">
																	<a href="#">
																		<p>美康粉黛醉美唇膏 持久保湿滋润防水不掉色</p>
																		<p class="info-little">颜色：12#川南玛瑙
																			<br/>包装：裸装 </p>
																	</a>
																</div>
															</div>
														</li>

														<ul class="td-changeorder">
															<li class="td td-orderprice">
																<div class="item-orderprice">
																	<span>交易金额：</span>72.00
																</div>
															</li>
															<li class="td td-changeprice">
																<div class="item-changeprice">
																	<span>退款金额：</span>70.00
																</div>
															</li>
														</ul>
														<div class="clear"></div>
													</ul>

													<div class="change move-right">
														<li class="td td-moneystatus td-status">
															<div class="item-status">
																<p class="Mystatus">退款成功</p>

															</div>
														</li>
													</div>
													<li class="td td-change td-changebutton">
                                                        <a href="record.html">
														    <div class="am-btn am-btn-danger anniu">
															钱款去向</div>
														</a>
													</li>

												</div>
											</div>
										</div>
									</div>

								</div>

							</div>

						</div>
					</div>

				</div>
				<!--底部-->
				@include('home.public.footer')
			</div>

			<aside class="menu">
				<ul>
					<li class="person">
						<a href="/center">个人中心</a>
					</li>
					<li class="person">

						<ul>
							<li> <a href="/information">个人信息</a></li>
							<li> <a href="/safety">安全设置</a></li>
							<li> <a href="/address">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的交易</a>
						<ul>

							<li><a href="/publish">我的发布</a></li>

							<li><a href="/order">订单管理</a></li>
							<li class="active"> <a href="/change">退款售后</a></li>
						</ul>
					</li>
				</ul>
			</aside>

		</div>

	</body>

</html>