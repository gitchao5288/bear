
@extends('home.login.layout')
@section('title','登录')

@section('content')
		<h3 class="title">登录商城</h3>

        {{--错误提示信息--}}
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

		<div class="clear"></div>

		<div class="login-form">

			<form action="/home/login/dologin" method="post">
                {{ csrf_field()  }}

				<div class="user-name">
					<label for="user"><i class="am-icon-user"></i></label>
					<input type="text" value="{{old('uname')}}" name="uname" id="user" placeholder="邮箱/手机/用户名">
				</div>
				<div class="user-pass">
					<label for="password"><i class="am-icon-lock"></i></label>
					<input type="text" name="password" id="password" placeholder="请输入密码">
				</div>
                <div class="user-pass">
                    <label for="password"><i class="am-icon-lock"></i></label>
                    <input type="text" name="code" value="{{old('code')}}" id="code" placeholder="验证码" style="width: 200px;">
                    <img id="codeimg" src="{{ url('home/login/code') }}" onclick="this.src='{{ url('home/login/code') }}?'+Math.random()">
                </div>
				<div class="login-links">

					<a href="/home/getpass/forget" class="am-fr">忘记密码</a>
					<a href="{{url('home/login/index')}}" class="zcnext am-fr am-btn-default">注册</a>
					<br />
				</div>
				<div class="am-cf">
					<input type="submit" value="登 录" class="am-btn am-btn-primary am-btn-sm">
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
        *{list-style: none;}
		#remember-me{
			width: 14px;
			height: 14px;
		}
        #codeimg{
            width:100px;height:42px;float:right;
        }
        .alert-danger{
            width: 340px;
            position: fixed;
            top: 200px;
            right: 210px;
            z-index: 999;
        }
	</style>

    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(300);
    </script>


@endsection
