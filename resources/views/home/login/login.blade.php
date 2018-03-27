
@extends('home.login.layout')
@section('title','登录')

@section('content')
		<h3 class="title">登录商城</h3>

		<div class="clear"></div>

		<div class="login-form">
			<form action="/" method="get">
				<div class="user-name">
					<label for="user"><i class="am-icon-user"></i></label>
					<input type="text" name="" id="user" placeholder="邮箱/手机/用户名">
				</div>
				<div class="user-pass">
					<label for="password"><i class="am-icon-lock"></i></label>
					<input type="password" name="" id="password" placeholder="请输入密码">
				</div>
				<div class="login-links">

					<input id="remember-me" type="checkbox">记住密码

					<a href="#" class="am-fr">忘记密码</a>
					<a href="register.html" class="zcnext am-fr am-btn-default">注册</a>
					<br />
				</div>
				<div class="am-cf">
					<input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm">
				</div>
				<div class="partner">
					<h3>合作账号</h3>
					<div class="am-btn-group">
						<li><a href="#"><i class="am-icon-qq am-icon-sm"></i><span>QQ登录</span></a></li>
						<li><a href="#"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span> </a></li>
						<li><a href="#"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span> </a></li>
					</div>
				</div>

			</form>

		</div>


	<style>
		#remember-me{
			width: 14px;
			height: 14px;
		}
	</style>
@endsection
