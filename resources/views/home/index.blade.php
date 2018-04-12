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
				</div>
				<!--悬浮搜索框-->

				<div class="nav white">
					<div class="logo"><img src="/home/basic/images2/logo.png" /></div>
					<div class="logoBig">
						<li><img src="/home/basic/images2/logo2.png" /></li>
					</div>

					<div class="search-bar pr">
						<a name="index_none_header_sysc" href="#"></a>
						<form action="/search/criteria" method="get">

							<input id="searchInput" name="gname" type="text" placeholder="搜索" value="" autocomplete="off">
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
									@if($v->rstatus==1)
										<li><a href="https://{{$v->link}}"><img src="{{$v->feilname}}" /></a></li>
									@endif
								@endforeach
							</ul>

						</div>


			<div class="clear"></div>
			</div>



			<div class="shopNav">
				<div class="slideall">

					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   @include('home.public.nav')

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
																		<dd><a href="/click/search/{{$c->id}}" title="{{$c->cate_name}}" href="#"><span>{{$c->cate_name}}</span></a></dd>
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

							{{--如果用户没有登录，显示登录链接，如果已经登录，显示用户账号--}}
							@if(!session('user'))
							        Hi,<span class="s-name">请您先登录</span>
									<a href="#"><p>点击更多优惠活动</p></a>
							@else
								Hi,<span class="s-name">{{session('user')->uname}}</span>
									<a href="#"><p>点击更多优惠活动</p></a>
							@endif

								</em>
							</div>
							@if(!session('user'))
							<div class="member-logout">
								<a class="am-btn-warning btn" href="/home/login/login">登录</a>
								<a class="am-btn-warning btn" href="/home/login/index">注册</a>
							</div>
							@endif
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



			</div>



			<div class="shopMainbg">
				<div class="shopMain" id="shopmain">

					<!--今日推荐 -->


					<div class="clear "></div>

				@foreach($firstCate as $k=>$v)

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
										{{$goods[$k][0]['gname'] or '雪之恋和风大福'}}
									</div>
									<div class="sub-title ">
										¥{{$goods[$k][0]['price']}}.00
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="/goodDetails/{{$goods[$k][0]['gid'] or '1'}}"><img style="width: 200px;height:180px;" src="{{$goods[$k][0]['gpic'] or '/home/basic/images2/1.jpg'}}" /></a>
							</div>

							<div class="am-u-sm-7 am-u-md-4 text-two">
								<div class="outer-con ">
									<div class="title ">
										{{$goods[$k][1]['gname'] or '雪之恋和风大福'}}
									</div>
									<div class="sub-title ">
										¥{{$goods[$k][1]['price']}}.00
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="/goodDetails/{{$goods[$k][1]['gid'] or '1'}} "><img style="width: 200px;height:160px;" src="{{$goods[$k][1]['gpic'] or '/home/basic/images2/1.jpg'}}" /></a>
							</div>



							<div class="am-u-sm-3 am-u-md-2 text-three big">

								<div class="outer-con ">
									<div class="title ">
										{{$goods[$k][2]['gname'] or '小优布丁'}}
									</div>
									<div class="sub-title ">
										¥{{$goods[$k][2]['price']}}.00
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>

								<a href="/goodDetails/{{$goods[$k][2]['gid'] or '1'}}"><img style="width: 200px;height:180px;" src="{{$goods[$k][2]['gpic'] or '/home/basic/images2/1.jpg'}}" /></a>
							</div>



							<div class="am-u-sm-3 am-u-md-2 text-three ">

								<div class="outer-con ">
									<div class="title ">

										{{$goods[$k][4]['gname'] or '小优布丁'}}
									</div>
									<div class="sub-title ">
										¥{{$goods[$k][4]['price'] or '123'}}.00
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="/goodDetails/{{$goods[$k][4]['gid'] or '1'}}"><img style="width: 150px;height:120px;" src="{{$goods[$k][4]['gpic'] or '/home/basic/images2/1.jpg'}}" /></a>
							</div>
						<div class="am-u-sm-3 am-u-md-2 text-three sug">
							<div class="outer-con ">
								<div class="title ">
									{{$goods[$k][3]['gname'] or '小优布丁'}}
								</div>

								<div class="sub-title ">
									¥{{$goods[$k][3]['price'] or '123'}}.00
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>

							<a href="/goodDetails/{{$goods[$k][3]['gid'] or '1'}}"><img style="width: 200px;height:180px;" src="{{$goods[$k][3]['gpic'] or '/home/basic/images2/1.jpg'}}" /></a>
						</div>
							<div class="am-u-sm-3 am-u-md-2 text-three last big ">
								<div class="outer-con ">
									<div class="title ">

										{{$goods[$k][5]['gname'] or '小优布丁'}}

									</div>
									<div class="sub-title ">
										¥{{$goods[$k][5]['price'] or '123'}}.00
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>

								<a href="/goodDetails/{{$goods[$k][5]['gid'] or '1'}}"><img src="{{$goods[$k][5]['gpic'] or '/home/basic/images2/1.jpg'}}" /></a>
							</div>


					</div>

                 	<div class="clear "></div>



                </div>

				@endforeach



			<!-- 广告 -->

				<div id="AD">
					<a href="{{$data->link}}">
						<img src="{{$data->aimg}}" alt="" style="width:200px;height:200px;position:fixed;top:75%;z-index: 999;" />
					</a>
				</div>



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








				<!--底部-->
				@include('home.public.footer')

		</div>
		</div>



		<!--右侧菜单 -->

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
		<script type='text/javascript'>
            (function(m, ei, q, i, a, j, s) {
                m[i] = m[i] || function() {
                    (m[i].a = m[i].a || []).push(arguments)
                };
                j = ei.createElement(q),
                    s = ei.getElementsByTagName(q)[0];
                j.async = true;
                j.charset = 'UTF-8';
                j.src = 'https://static.meiqia.com/dist/meiqia.js?_=t';
                s.parentNode.insertBefore(j, s);
            })(window, document, 'script', '_MEIQIA');
            _MEIQIA('entId', 102652);
		</script>
	</body>

</html>