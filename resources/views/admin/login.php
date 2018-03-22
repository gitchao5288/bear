
<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>Fullscreen Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="/admin/login/css/reset.css">
        <link rel="stylesheet" href="/admin/login/css/supersized.css">
        <link rel="stylesheet" href="/admin/login/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body oncontextmenu="return false">

        <div class="page-container">
            <h1>登录</h1>
            <form action="" method="post">
				<div>
					<input type="text" name="username" class="username" placeholder="用户名" autocomplete="off"/>
				</div>
                <div>
					<input type="password" name="password" class="password" placeholder="用户密码" oncontextmenu="return false" onpaste="return false" />
                </div>
                <div>
                    <input type="text" name="code" style="width:100px;position: relative;left:-85px" class="code" placeholder="验证码" oncontextmenu="return false" onpaste="return false" />
                </div>
                <button id="submit" type="button">登录</button>
            </form>
            <div class="connect">
                <p>Welcome to the background management system.</p>
				<p style="margin-top:20px;">欢迎登陆后台管理系统</p>
            </div>
        </div>
		<div class="alert" style="display:none">
			<h2>消息</h2>
			<div class="alert_con">
				<p id="ts"></p>
				<p style="line-height:70px"><a class="btn">确定</a></p>
			</div>
		</div>

        <!-- Javascript -->
		<script src="http://apps.bdimg.com/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
        <script src="/admin/login/js/supersized.3.2.7.min.js"></script>
        <script src="/admin/login/js/supersized-init.js"></script>
		<script>
		$(".btn").click(function(){
			is_hide();
		})
		var u = $("input[name=username]");
		var p = $("input[name=password]");
		$("#submit").live('click',function(){
			if(u.val() == '' || p.val() =='')
			{
				$("#ts").html("用户名或密码不能为空~");
				is_show();
				return false;
			}
			else{
				var reg = /^[0-9A-Za-z]+$/;
				if(!reg.exec(u.val()))
				{
					$("#ts").html("用户名错误");
					is_show();
					return false;
				}
			}
		});
		window.onload = function()
		{
			$(".connect p").eq(0).animate({"left":"0%"}, 600);
			$(".connect p").eq(1).animate({"left":"0%"}, 400);
		}
		function is_hide(){ $(".alert").animate({"top":"-40%"}, 300) }
		function is_show(){ $(".alert").show().animate({"top":"45%"}, 300) }
		</script>
    </body>

</html>

