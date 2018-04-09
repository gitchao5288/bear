<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>地址管理</title>

		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/addstyle.css" rel="stylesheet" type="text/css">
		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<meta name="csrf-token" content="{{ csrf_token() }}">
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
			<div class="nav-cont">
				<ul>
					<li class="index"><a href="#">首页</a></li>
					<li class="qc"><a href="#">闪购</a></li>
					<li class="qc"><a href="#">限时抢</a></li>
					<li class="qc"><a href="#">团购</a></li>
					<li class="qc last"><a href="#">大包装</a></li>
				</ul>

			</div>
		</div>
		<b class="line"></b>

		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-address">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
						</div>
						<hr/>
						<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
							@if($add->count()!=0)
								@foreach($add as $v)

								@if($v->default==1)
								<li class="user-addresslist defaultAddr" style="margin-bottom:10px">
								<span class="new-option-r"><i class="am-icon-check-circle"></i>默认地址</span>
								@else
								<li class="user-addresslist">
								<span class="new-option-r default" a="{{ $v->addid }}" ><i class="am-icon-check-circle"></i>设为默认</span>
								@endif
								<p class="new-tit new-p-re">
									<span class="new-txt">{{ $v->addname }}</span>
									<span class="new-txt-rd2">{{ $v->phone }}</span>
								</p>
								<div class="new-mu_l2a new-p-re">
									<p class="new-mu_l2cw">
										<span class="title">地址：{{$v->add}}</span></p>
								</div>
								<div class="new-addr-btn">
									<a href="#"><i class="am-icon-edit"></i>编辑</a>
									<span class="new-addr-bar">|</span>
									<a class="deladd " style="cursor: pointer" addid="{{ $v->addid }}" ><i class="am-icon-trash"></i>删除</a>
								</div>
							</li>
								@endforeach
							@endif

						</ul>
						<div class="clear"></div>
						<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
						<!--例子-->
						<div class="am-modal am-modal-no-btn" id="doc-modal-1">

							<div class="add-dress">

								<!--标题 -->
								<div class="am-cf am-padding">
									<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
								</div>
								<hr/>

								<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
									<form class="am-form am-form-horizontal" id="addressd">

										<div class="am-form-group">
											<label for="user-name" class="am-form-label">收货人</label>
											<div class="am-form-content">
												<input type="text" name="addname" id="user-name" placeholder="收货人">
											</div>
										</div>

										<div class="am-form-group">
											<label for="user-phone" class="am-form-label">手机号码</label>
											<div class="am-form-content">
												<input id="user-phone" name="phone" placeholder="手机号必填" type="text">
											</div>
										</div>


										<div class="am-form-group">
											<label for="user-intro" class="am-form-label">详细地址</label>
											<div class="am-form-content">

												<textarea class="" rows="3" name="address" style="resize:none;" id="user-intro" placeholder="输入详细地址"></textarea>

												<small>100字以内写出你的详细地址...</small>
											</div>
										</div>

										<div class="am-form-group">
											<div class="am-u-sm-9 am-u-sm-push-3">

												<button class="am-btn am-btn-danger">添加</button>

											</div>
										</div>
									</form>
								</div>

							</div>

						</div>

					</div>
					<script>
						$('#addressd').submit(function(data){

							/*$.post('/doaddress',data.field,function(data){
								console.log(data);
							})*/
							var addname = $('input[name=addname]').val();
							var phone = $('input[name=phone]').val();
							var address = $('textarea[name=address]').val();

							if(!addname || !phone || !address){
							    alert('请填写每一项！');
							    return false;
							}


							$.ajax({
								url:'/doaddress',
								type:'post',
								data:{addname:addname,phone:phone,add:address},
								dataType:'json',
								success:function(data){
								    if(data.status==0){
								        alert(data.msg);

									}else{
										alert(data.msg);
									}
                                    window.location.reload(true);
								},
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
							})

						    return false;
						})
						//设为默认地址
						$('.default').click(function(){
							var addid = $(this).attr('a');
							$.ajax({
							    url:'/dodefault',
								data:{addid:addid},
								dataType:'json',
								type:'post',
								success:function(data){
							        console.log(data);
								},
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
							})
						})
						//删除地址
						$('.deladd').click(function(){
						    var addid = $(this).attr('addid');
                            $.ajax({
                                url:'/deladd',
                                data:{addid:addid},
                                dataType:'json',
                                type:'post',
                                success:function(data){
                                    console.log(data);
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            })
						})
					</script>
					<script type="text/javascript">
						$(document).ready(function() {							
							$(".new-option-r").click(function() {
								$(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
							});
							
							var $ww = $(window).width();
							if($ww>640) {
								$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
							}
							
						})
					</script>

					<div class="clear"></div>

				</div>
				<!--底部-->
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

			@include('home.public.centerlayout')
		</div>

	</body>

</html>