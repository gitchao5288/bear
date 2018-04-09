<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>发布闲置</title>
		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/infstyle.css" rel="stylesheet" type="text/css">
		<link href="/home/bs/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<style>
			.am-form-content{
				float: left;
				width: 200px;
				margin-left: 13px;
			}
			.container,.alert-danger{
	            width: 900px;
	            position: fixed;
	            top: 290px;
	            left: 250px;
	            z-index: 999;
	        }



		</style>
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
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="/home/shopcart" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
							</div>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="/collection" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
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
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">发布闲置</strong> / <small>Release&nbsp;items</small></div>
						</div>
						<hr/>


						<!--填写发布信息 -->
						<div class="info-main">

				            {{--信息错误显示信息--}}
				            <div class="container">
				                @include('flash::message')

				            </div>
				            @if (count($errors) > 0)
			                    <div class="alert alert-danger">
			                        <ul>
			                            @if(is_object($errors))
			                                @foreach ($errors->all() as $error)
			                                    <li>{{ $error }}</li>
			                                @endforeach
			                            @else
			                                <li>{{ $errors }}</li>
			                        @endif
			                    </div>
			                @endif

							<form class="am-form am-form-horizontal" id="information" action="/home/addgoods/doadd" method="post">
									{{ csrf_field() }}
								<!-- 商品类别 -->
								<div class="am-form-group">
									<!-- 选择分类 -->
									<label for="user-name" class="am-form-label">所属类别</label>

									<div class="am-form-content" >
										<!-- <input type="text" name="gname" value=""  id="gname" placeholder="选择分类"> -->

										<select name="cate_name" id="one" onchange="changeOne()">
											<option value="">选择类别</option>
											@foreach($tree as $v)
											@if($v->lev==1)
											<option value="{{$v->id}}">{{$v->cate_name}}</option>
											@endif
											@endforeach
										</select>


									</div>

									<div class="am-form-content">
										<!-- <input type="text" name="gname" value=""  id="gname" placeholder="选择分类"> -->
										<select name="cate_name" id="two" onchange="changeTwo()">
											<option value="">选择类别</option>

										</select>
									</div>
									<div class="am-form-content" >
										<!-- <input type="text" name="gname" value=""  id="gname" placeholder="选择分类"> -->
										<select name="cate_name" id="three" >
											<option value="">选择类别</option>

										</select>
									</div>
									<input type="hidden" value="" name="cname" id="cate">

								</div>

								<div class="am-form-group">
									<label for="user-name" class="am-form-label">商品名称</label>
									<div class="am-form-content">
										<input type="text" id="user-name2"  name="gname" value=""  placeholder="商品名称">

									</div>
								</div>

								<div class="am-form-group">
									<label class="am-form-label">商品图片</label>
									<div class="am-form-content sex">
										<div class="layui-upload" style="position: relative;">
							                <input type="file" id="file_upload" name="file_upload"  style="opacity: 0;position: relative;z-index: 999;">
							                <img src="/admin/images/123.png" alt="" style="position:absolute;left: 0px;top: -5px;z-index: 1;">
							            </div>

									</div>
									<div class="layui-form-item">

							            <div class="layui-input-block" id="upload">
							                <div class="layui-upload-list">
							                    <input type="hidden" name="art_thumb" value="">
							                    <img  class="layui-upload-img " id="art_thumb" src="" style="width:80px;margin-top: -25px;margin-left: -20px;  ">

							                </div>
							            </div>

							        </div>
								</div>

								<div class="am-form-group">
									<label for="user-name" class="am-form-label">商品价格</label>
									<div class="am-form-content">
										<input type="text" name="price" value=""  id="user-name2" placeholder="价格">

									</div>
								</div>
								<div class="am-form-group">
									<label for="user-phone" class="am-form-label">商品描述</label>
									<div class="am-form-content">
										<!-- <input id="user-phone" placeholder="电话" name="gdesc" value="{{session('user')->phone}}" type="tel"> -->
										<textarea name="gdesc" cols="50" rows="10" placeholder="商品描述请尽量详细些(如:规格参数,大小型号,颜色种类)" style="resize: none;width: 450px;"></textarea>
									</div>
								</div>

								<div class="info-btn" style="margin-top: 140px;">
									<button class="am-btn am-btn-danger">确认提交</button>

								</div>

							</form>
						</div>

					</div>

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
		<script>

			// 提示框
			$('div.alert').not('.alert-important').delay(3000).fadeOut(350);

			// 一级类
			function changeOne()
			{
				var id = $('#one').val();
				$('#two').html('');
				$('#three').html('');

				$.get('/home/addgoods/two',{gid:id},function(data){
					// var two;
					// console.log(data);
					// option = $('<option value="">选择分类</option>');

					for (var i = 0; i < data.length; i++) {

						// console.log(data[i].cate_name);
						opt = $('<option value=""></option>');
						opt.html(data[i].cate_name);
						opt.val(data[i].id);
						$('#two').append(opt);

						// console.log(opt);

					}
					changeTwo();


				},'json')


			}

			// 二级类
			function changeTwo()
			{
				var id = $('#two').val();
				$('#three').html('');

				$.get('/home/addgoods/three',{gid:id},function(data){

					for (var i = 0; i < data.length; i++) {

						opt = $('<option value=""></option>');
						opt.html(data[i].cate_name);
						$('#three').append(opt);

					}
					var cate_name = $('#three option').html();
					$('#cate').val(cate_name);
					console.log(cate_name);

				},'json')

			}



    // 上传图片
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




			/*$('#information').submit(function(){
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
						data:{name:name,sex:sex,age:age,phone:phone,email:email},
						dataType: 'json',
						type: 'post',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						success:function(data){

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
			})*/
		</script>
	</body>

</html>