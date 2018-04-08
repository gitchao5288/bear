<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>首页</title>

		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

		<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />

		<link href="/home/basic/css2/hmstyle.css" rel="stylesheet" type="text/css"/>
		<link href="/home/basic/css2/skin.css" rel="stylesheet" type="text/css" />
		<link href="/home/basic/css2/footer_img.css" rel="stylesheet" type="text/css" />
		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
        <script type="text/javascript" src="/home/js/jquery-3.2.1.min"></script>

	</head>

	<body>
		<div class="hmtop">
			<!--顶部导航条 -->
			<div style="width: 100%; background-color: rgb(245,245,245); ">
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
				</div>
				<!--悬浮搜索框-->

				<div class="nav white">
					<div class="logo"><img src="/home/basic/images2/logo.png" /></div>
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


			<div class="banner">
                      <!--轮播 -->
						<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
							
							<ul class="am-slides">
								@foreach($Res as $v)
								<li><a href="{{$v->link}}"><img src="{{$v->feilname}}" /></a></li>
								@endforeach
							</ul>
							
						</div>


			<div class="clear"></div>
			</div>



			<div class="shopNav">
				<div class="slideall">

					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="/">首页</a></li>
                                <li class="qc"><a href="#">手机二手</a></li>
                                <li class="qc"><a href="#">女朋友二手</a></li>
                                <li class="qc"><a href="#">降降降</a></li>
                                <li class="qc last"><a href="#">发布闲置</a></li>
							</ul>
						</div>

						<!--侧边导航 -->
						<div id="nav" class="navfull">
							<div class="area clearfix">
								<div class="category-content" id="guide_2">

									<div class="category">
										<ul class="category-list" id="js_climit_li">

											@foreach($Cate as $a)
												@if($a->pid==0)
											<li class="appliance js_toggle relative first">
												<div class="category-info">
													<h3 class="category-name b-category-name"><i><img src="/home/basic/images2/cake.png"></i><a class="ml-22" title="{{$a->cate_name}}">{{$a->cate_name}}</a></h3>
													<em>&gt;</em></div>
												<div class="menu-item menu-in top">
													<div class="area-in">
														<div class="area-bg">

															<div class="menu-srot">

																<div class="sort-side">
																	@foreach($Cate as $b)
																		@if($b->pid==$a->id)
																	<dl class="dl-sort">
																		<dt><span title="{{$b->cate_name}}">{{$b->cate_name}}</span></dt>

																				@foreach($Cate as $c)
																					@if($c->pid==$b->id)
																		<dd><a title="{{$c->cate_name}}" href="#"><span>{{$c->cate_name}}</span></a></dd>
																					@endif
																				@endforeach

																	</dl>
																		@endif
																	@endforeach
																</div>



														</div>
													</div>
												</div>
											<b class="arrow"></b>	
											</li>
												@endif
												@endforeach

										</ul>
									</div>
								</div>

							</div>
						</div>


						<!--轮播-->

						<script type="text/javascript">
							(function() {
								$('.am-slider').flexslider();
							});
							$(document).ready(function() {
								$("li").hover(function() {
									$(".category-content .category-list li.first .menu-in").css("display", "none");
									$(".category-content .category-list li.first").removeClass("hover");
									$(this).addClass("hover");
									$(this).children("div.menu-in").css("display", "block")
								}, function() {
									$(this).removeClass("hover")
									$(this).children("div.menu-in").css("display", "none")
								});
							})
						</script>



					<!--小导航 -->
<!-- 					<div class="am-g am-g-fixed smallnav">
						<div class="am-u-sm-3">
							<a href="sort.html"><img src="../images/navsmall.jpg" />
								<div class="title">商品分类</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="../images/huismall.jpg" />
								<div class="title">大聚惠</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="../images/mansmall.jpg" />
								<div class="title">个人中心</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="../images/moneysmall.jpg" />
								<div class="title">投资理财</div>
							</a>
						</div>
					</div> -->

					<!--走马灯 -->

					<div class="marqueen">
						<span class="marqueen-title">商城头条</span>
						<div class="demo">

							<ul>
								<li class="title-first"><a target="_blank" href="#">
									<img src="/home/basic/images2/TJ2.jpg"></img>
									<span>[特惠]</span>商城爆品1分秒
								</a></li>
								<li class="title-first"><a target="_blank" href="#">
									<span>[公告]</span>商城与广州市签署战略合作协议
								     <img src="/home/basic/images2/TJ.jpg"></img>
								     <p>XXXXXXXXXXXXXXXXXX</p>
							    </a></li>

						<div class="mod-vip">
							<div class="m-baseinfo">
								<a href="../person/index.html">
									<img src="/home/basic/images2/getAvatar.do.jpg">
								</a>
								<em>
									Hi,<span class="s-name">小叮当</span>
									<a href="#"><p>点击更多优惠活动</p></a>
								</em>
							</div>
							<div class="member-logout">
								<a class="am-btn-warning btn" href="login.html">登录</a>
								<a class="am-btn-warning btn" href="register.html">注册</a>
							</div>
							<div class="member-login">
								<a href="#"><strong>0</strong>待收货</a>
								<a href="#"><strong>0</strong>待发货</a>
								<a href="#"><strong>0</strong>待付款</a>
								<a href="#"><strong>0</strong>待评价</a>
							</div>
							<div class="clear"></div>
						</div>

								<li><a target="_blank" href="#"><span>[特惠]</span>洋河年末大促，低至两件五折</a></li>
								<li><a target="_blank" href="#"><span>[公告]</span>华北、华中部分地区配送延迟</a></li>
								<li><a target="_blank" href="#"><span>[特惠]</span>家电狂欢千亿礼券 买1送1！</a></li>

							</ul>
                        <div class="advTip"><img src="/home/basic/images2/advTip.jpg"/></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>


<!-- 				<script type="text/javascript">
					if ($(window).width() < 640) {
						function autoScroll(obj) {
							$(obj).find("ul").animate({
								marginTop: "-39px"
							}, 500, function() {
								$(this).css({
									marginTop: "0px"
								}).find("li:first").appendTo(this);
							})
						}
						$(function() {
							setInterval('autoScroll(".demo")', 3000);
						})
					}
				</script> -->
			</div>



			<div class="shopMainbg">
				<div class="shopMain" id="shopmain">

					<!--今日推荐 -->

					<div class="am-g am-g-fixed recommendation">
						<div class="clock am-u-sm-3" ">
							<img src="/home/basic/images2/2016.png "></img>
							<p>今日<br>推荐</p>
						</div>
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3>真的有鱼</h3>
								<h4>开年福利篇</h4>
							</div>
							<div class="recommendationMain one">
								<a href="introduction.html"><img src="/home/basic/images2/tj.png "></img></a>
							</div>
						</div>
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3>囤货过冬</h3>
								<h4>让爱早回家</h4>
							</div>
							<div class="recommendationMain two">
								<img src="/home/basic/images2/tj1.png "></img>
							</div>
						</div>
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3>浪漫情人节</h3>
								<h4>甜甜蜜蜜</h4>
							</div>
							<div class="recommendationMain three">
								<img src="/home/basic/images2/tj2.png "></img>
							</div>
						</div>

					</div>
					<div class="clear "></div>

				@foreach($Cate as $v)
                @if($v->pid==0)
                <div id="f1">
					<!--分类标题-->

					<div class="am-container ">
						<div class="shopTitle ">

							<h4>{{$v->cate_name}}</h4>

							
							<h3>每一道甜品都有一个故事</h3>
							<div class="today-brands ">
                                @foreach($Cate as $vv)
                                @if($vv->pid==$v->id)
								<a href="# ">{{$vv->cate_name}}</a>
								@endif
                                @endforeach

							</div>
							<span class="more ">
                    <a href="# ">更多美味<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					</div>



					<!-- 具体分类 -->
					<div class="am-g am-g-fixed floodFour">
						<div class="am-u-sm-5 am-u-md-4 text-one list ">
							<div class="word">

								@foreach($Cate as $vv)
								@if($vv->pid==$v->id)
								@foreach($Cate as $vvv)
								@if($vvv->pid==$vv->id)
								<a class="outer" href="#"><span class="inner"><b class="text">{{$vvv->cate_name}}</b></span></a>
								@endif
								@endforeach
								@endif
								@endforeach

							</div>
							<a href="# ">
								<div class="outer-con ">
									<div class="title ">
									开抢啦！
									</div>
									<div class="sub-title ">
										零食大礼包
									</div>
								</div>
                                  <img src="/home/basic/images2/act1.png " />
							</a>
							<div class="triangle-topright"></div>
						</div>

							<div class="am-u-sm-7 am-u-md-4 text-two sug">
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>
									<div class="sub-title ">
										¥13.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="# "><img src="/home/basic/images2/2.jpg" /></a>
							</div>

							<div class="am-u-sm-7 am-u-md-4 text-two">
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>
									<div class="sub-title ">
										¥13.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="# "><img src="/home/basic/images2/1.jpg" /></a>
							</div>



							<div class="am-u-sm-3 am-u-md-2 text-three big">

								<div class="outer-con ">
									<div class="title ">
										小优布丁
									</div>
									<div class="sub-title ">
										¥4.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>

								<a href="# "><img src="/home/basic/images2/5.jpg" /></a>
							</div>

							<div class="am-u-sm-3 am-u-md-2 text-three sug">
								<div class="outer-con ">
									<div class="title ">
										小优布丁
									</div>

									<div class="sub-title ">
										¥4.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>

								<a href="# "><img src="/home/basic/images2/3.jpg" /></a>
							</div>

							<div class="am-u-sm-3 am-u-md-2 text-three ">

								<div class="outer-con ">
									<div class="title ">
										小优布丁
									</div>
									<div class="sub-title ">
										¥4.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="# "><img src="/home/basic/images2/4.jpg" /></a>
							</div>

							<div class="am-u-sm-3 am-u-md-2 text-three last big ">
								<div class="outer-con ">
									<div class="title ">

										小优布丁

									</div>
									<div class="sub-title ">
										¥4.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>

								<a href="# "><img src="/home/basic/images2/5.jpg" /></a>
							</div>


					</div>

                 	<div class="clear "></div>



                </div>
                @endif
				@endforeach







				<!-- APP下载 -->
		                <div class="idle-footer-download">
		                	<div ckass="bcolor">
		                    <span class="idle-footer-slogan">
		                        <img src="/home/basic/images2/tb1nao0ifxxxxxsxfxxiu.inxxx-332-76.png" alt="闲置能换钱"
		                        width="299">
		                    </span>
		                    <a href="https://itunes.apple.com/cn/app/tao-bao-tiao-zao-jie-qing/id510909506"
		                    target="_blank" class="idle-download-ios">
		                        <img src="/home/basic/images2/tb1vo4whvxxxxckxfxxfbbihxxx-200-62.png" alt="闲鱼ios客户端下载"
		                        width="200" height="62">
		                    </a>
		                    <a href="#nogo" target="_self" class="idle-download-android">
		                        <img src="/home/basic/images2/tb1aokthvxxxxxdxpxxfbbihxxx-200-62.png" alt="闲鱼android客户端下载"
		                        width="200" height="62">
		                    </a>
		                    <span class="idle-qrcode">
		                        <img src="/home/basic/images2/tb1nbl3hvxxxxakxfxx07tltxxx-200-200.png" alt="闲鱼"
		                        height="130px" width="130px" >
		                    </span>
		                    </div>
		                </div>

		                <div>
		                	<img src="/home/basic/images2/xxoo1.png" alt="">
		                </div>








					<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="# ">恒望科技</a>
								<b>|</b>
								<a href="/">商城首页</a>
								<b>|</b>
								<a href="# ">支付宝</a>
								<b>|</b>
								<a href="# ">物流</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="# ">关于恒望</a>
								<a href="# ">合作伙伴</a>
								<a href="# ">联系我们</a>
								<a href="# ">网站地图</a>
								<em>© 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em>
							</p>
						</div>
					</div>

		</div>
		</div>
		<!--引导 -->
<!-- 		<div class="navCir">
			<li class="active"><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
			<li><a href="../person/index.html"><i class="am-icon-user"></i>我的</a></li>
		</div> -->


		<!--右侧菜单 -->
		<div class=tip>
			<div id="sidebar">
				<div id="wrap">
					<div id="prof" class="item ">
						<a href="# ">
							<span class="setting "></span>
						</a>
						<div class="ibar_login_box status_login ">
							<div class="avatar_box ">
								<p class="avatar_imgbox "><img src="/home/basic/images2/no-img_mid_.jpg " /></p>
								<ul class="user_info ">
									<li>用户名sl1903</li>
									<li>级&nbsp;别普通会员</li>
								</ul>
							</div>
							<div class="login_btnbox ">
								<a href="# " class="login_order ">我的订单</a>
								<a href="# " class="login_favorite ">我的收藏</a>
							</div>
							<i class="icon_arrow_white "></i>
						</div>

					</div>
					<div id="shopCart " class="item ">
						<a href="# ">
							<span class="message "></span>
						</a>
						<p>
							购物车
						</p>
						<p class="cart_num ">0</p>
					</div>
					<div id="asset " class="item ">
						<a href="# ">
							<span class="view "></span>
						</a>
						<div class="mp_tooltip ">
							我的资产
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="foot " class="item ">
						<a href="# ">
							<span class="zuji "></span>
						</a>
						<div class="mp_tooltip ">
							我的足迹
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="brand " class="item ">
						<a href="#">
							<span class="wdsc "><img src="/home/basic/images2/wdsc.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我的收藏
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="broadcast " class="item ">
						<a href="# ">
							<span class="chongzhi "><img src="/home/basic/images2/chongzhi.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我要充值
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div class="quick_toggle ">
						<li class="qtitem ">
							<a href="# "><span class="kfzx "></span></a>
							<div class="mp_tooltip ">客服中心<i class="icon_arrow_right_black "></i></div>
						</li>
						<!--二维码 -->
						<li class="qtitem ">
							<a href="#none "><span class="mpbtn_qrcode "></span></a>
							<div class="mp_qrcode " style="display:none; "><img src="/home/basic/images2/weixin_code_145.png " /><i class="icon_arrow_white "></i></div>
						</li>
						<li class="qtitem ">
							<a href="#top " class="return_top "><span class="top "></span></a>
						</li>
					</div>

					<!--回到顶部 -->
					<div id="quick_links_pop " class="quick_links_pop hide "></div>

				</div>

			</div>
			<div id="prof-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					我
				</div>
			</div>
			<div id="shopCart-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					购物车
				</div>
			</div>
			<div id="asset-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					资产
				</div>

				<div class="ia-head-list ">
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">优惠券</div>
					</a>
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">红包</div>
					</a>
					<a href="# " target="_blank " class="pl money ">
						<div class="num ">￥0</div>
						<div class="text ">余额</div>
					</a>
				</div>

			</div>
			<div id="foot-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					足迹
				</div>
			</div>
			<div id="brand-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					收藏
				</div>
			</div>
			<div id="broadcast-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					充值
				</div>
			</div>
		</div>
		<script>
			window.jQuery || document.write('<script src="/home/basic/js/jquery.min.js "><\/script>');

			$('.word').each(function(){

                var a  = $(this).find('.outer');
                var i = 0;
                a.each(function () {
                    i++;
                    if(i>6){

                       $(this) .css('display', 'none');
                    }
                });

            })
		</script>
		<script type="text/javascript " src="/home/basic/js/quick_links.js "></script>
	</body>

</html>