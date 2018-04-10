<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>个人资料</title>
		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/infstyle.css" rel="stylesheet" type="text/css">
		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
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

					<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
						</div>
						<hr/>



						<!--个人信息 -->
						<div class="info-main">
							<form class="am-form am-form-horizontal" id="information" >

								<!--头像 -->
								<div class="user-infoPic" style="position: relative">

									<div class="filePic" style="position: absolute;top: -15px;">

										<input type="hidden" name="art_thumb" value="{{ (session('user')->face) ? session('user')->face : '/home/images/getAvatar.do.jpg'}}">
										<img class="am-circle am-img-thumbnail" id="art_thumb" src="{{ (session('user')->face) ? session('user')->face : '/home/images/getAvatar.do.jpg'}}" alt="网络不好！亲！" />
										<div class="layui-upload-list">

										</div>
									</div>

									<div class="am-form-content sex" style="position: absolute;top: 100px;left: -60px;">
										<div class="layui-upload" style="position: relative;">
											<input type="file" id="file_upload" name="file_upload"  style="opacity: 0;position: relative;z-index: 999;">
											<img src="/admin/images/123.png" alt="" style="position:absolute;left: 0px;top: -5px;z-index: 1;">
										</div>


									</div>

									<p class="am-form-help">头像</p>

									<div class="info-m">
										<div><b>用户名：<i>{{session('user')->uname}}</i></b></div>

									</div>
								</div>



								<div class="am-form-group">
									<label for="user-name" class="am-form-label">姓名</label>
									<div class="am-form-content">
										<input type="text" id="user-name2"  name="name" value="{{session('user')->name}}"  placeholder="姓名">

									</div>
								</div>

								<div class="am-form-group">
									<label class="am-form-label">性别</label>
									<div class="am-form-content sex">
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="m" {{(session('user')->sex=='m') ? 'checked' : '' }}> 男
										</label>
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="w" {{(session('user')->sex=='w') ? 'checked' : '' }}> 女
										</label>
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="x" {{(session('user')->sex=='x') ? 'checked' : '' }}>保密
										</label>
									</div>
								</div>

								<div class="am-form-group">
									<label for="user-name" class="am-form-label">年龄</label>
									<div class="am-form-content">
										<input type="text" name="age" value="{{session('user')->age}}"  id="user-name2" placeholder="年龄">

									</div>
								</div>
								<div class="am-form-group">
									<label for="user-phone" class="am-form-label">电话</label>
									<div class="am-form-content">
										<input id="user-phone" placeholder="电话" name="phone" value="{{session('user')->phone}}" type="tel">

									</div>
								</div>
								<div class="am-form-group">
									<label for="user-email" class="am-form-label">电子邮件</label>
									<div class="am-form-content">
										<input id="user-email" placeholder="电子邮件" name="email" value="{{session('user')->email}}" type="email">

									</div>
								</div>

								<div class="info-btn">
									<button class="am-btn am-btn-danger">保存修改</button>

								</div>

							</form>
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
							<li class="active"> <a href="/information">个人信息</a></li>
							<li> <a href="/safety">安全设置</a></li>
							<li> <a href="/address">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的交易</a>
						<ul>

							<li><a href="/publish">我的发布</a></li>

							<li><a href="/order">订单管理</a></li>
							<li> <a href="/change">退款售后</a></li>
						</ul>
					</li>
				</ul>
			</aside>

		</div>
		<script>

            // 上传图片 **********************************************
            $(function () {
                $("#file_upload").change(function () {
                    uploadImage();
                })
            });
            function uploadImage() {
				//  判断是否有选择上传文件
                var imgPath = $("#file_upload").val();
                if (imgPath == "") {
                    alert("请选择上传图片！");
                    return;
                }
                //判断上传文件的后缀名
                var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                if (strExtension != 'jpg' && strExtension != 'gif'
                    && strExtension != 'png' && strExtension != 'bmp' && strExtension != 'jpeg') {
                    alert("请选择图片文件");
                    return;
                }
                // var formData = new FormData($('#art_form')[0]);
                var formData = new FormData();
                formData.append('file_upload', $('#file_upload')[0].files[0]);
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/upload",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);

                        $('#art_thumb').attr('src',data);
                        $("input[name='art_thumb']").val(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("上传失败，请检查网络后重试");
                    }
                });
            }


			$('#information').submit(function(){
			    //姓名
				var name = $('input[name=name]').val();
			    //性别 x m w
			    var sex = $(':radio:checked').val();
			    //年龄
				var age = $('input[name=age]').val();
				//电话
				var phone = $('input[name=phone]').val();
				//邮箱
				var email = $('input[name=email]').val();
				// 头像
                var gpic = $("input[name='art_thumb']").val();
                // console.log(gpic);

				if(!name){
				    alert('姓名不能为空！');
				    return false;
				}else if(!age){
				    alert('年龄不能为空！');
				    return false;
				}else if(!phone){
				    alert('电话不能为空！');
				    return false;
				}else if(!email){
				    alert('邮箱不能为空！');
				    return false;
				}else{


					$.ajax({
						url:'/infoupdate',
						data:{name:name,sex:sex,age:age,phone:phone,email:email,gpic:gpic},
						dataType: 'json',
						type: 'post',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						success:function(data){
						    console.log(data);

							if(data.status==1){
							    alert(data.msg);

							    window.location.reload(true);
							}else{
							    alert(data.msg);
							}
						}
					})
					return false;
				}
			})
		</script>
	</body>

</html>