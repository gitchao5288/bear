@extends('home.login.layout')
@section('title','注册')

@section('login')
<a href="{{url('/home/login/login')}}" type="button" id="btn" class="btn btn-default btn-sm">我有账号</a>
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="am-tabs" id="doc-my-tabs">
        <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
            <li class="am-active"><a href="">邮箱注册</a></li>
            <li><a href="">手机号注册</a></li>
        </ul>

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
        <div class="am-tabs-bd">

            {{--邮箱注册--}}
            <div class="am-tab-panel am-active">
                <form action="doreg" method="post" class="forms">
                    {{ csrf_field()  }}
                    <div class="user-email">
                        <label for="email"><i class="am-icon-envelope-o"></i></label>
                        <input type="email" value="{{old('email')}}" name="email" id="email" placeholder="请输入邮箱账号">
                    </div>
                    <div class="user-email">
                        <label for="uname"><i class="glyphicon glyphicon-user"></i></label>
                        <input type="text" name="uname" value="{{ old('uname') }}" placeholder="设置您的用户名">

                    </div>
                    <div class="user-pass">
                        <label for="password"><i class="am-icon-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="设置密码">
                    </div>
                    <div class="user-pass">
                        <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                        <input type="password" name="repassword" id="passwordRepeat" placeholder="确认密码">
                    </div>

                    <div class="login-links">
                        <div id="emailche">
                            <input id="reader-me" type="checkbox" class="che1" value="agree" name="agree">
                            <a href="#" class="btn1"> 点击表示您同意商城《服务协议》</a>
                        </div>
                    </div>
                    <div class="am-cf" id="emailsub">
                        <input type="submit" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                    </div>
                </form>

            </div>

            {{--手机号注册--}}
            <div class="am-tab-panel">

                <form action="doreg" method="post" class="forms">
                    {{ csrf_field()  }}
                    <div class="user-phone">
                        <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                        <input type="text" name="phone" value="{{old('phone')}}" id="phone" placeholder="请输入手机号">
                    </div>
                    <div class="verification">
                        <label for="code"><i class="am-icon-code-fork"></i></label>
                        <input type="text" name="code" value="{{old('code')}}" id="code" placeholder="请输入验证码">
                        <span></span>
                        <a class="btn" href="javascript:;" id="sendMobileCode" >
                            <span id="dyMobileButton" class="btn btn-default" onclick="phone();"  data-toggle="tooltip" data-placement="right" title="点击获取验证码">获取验证码</span></a>
                    </div>
                    <div class="user-phone">
                        <label for="phone"><i class="glyphicon glyphicon-user"></i></label>
                        <input type="text" name="uname" value="{{old('uname')}}" placeholder="设置您的用户名">
                    </div>
                    <div class="user-pass">
                        <label for="password"><i class="am-icon-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="设置密码">
                    </div>
                    <div class="user-pass">
                        <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                        <input type="password" name="repassword" id="passwordRepeat" placeholder="确认密码">
                    </div>

                    <div class="login-links">
                        <div id="emailche">
                            <input id="reader-me" type="checkbox" class="che1" value="agree" name="agree">
                            <a href="#" class="btn1"> 点击表示您同意商城《服务协议》</a>
                        </div>
                    </div>
                    <div class="am-cf" id="phonesub">
                        <input type="submit"value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                    </div>

                </form>

                <hr>
            </div>

        </div>
    </div>

    <style>
        #emailche{
            display: inline-block;
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
            font-family: arial,"Lantinghei SC","Microsoft Yahei";
        }
        #reader-me{
            width: 14px;
            height: 14px;
            line-height: 14px;
        }
        .container,.alert-danger{
            width: 340px;
            position: fixed;
            top: 290px;
            right: 210px;
            z-index: 999;
        }
        input#code{
            width: 60%;
        }
        #dyMobileButton{

            color: #1a1a1a;
            width: 35%;
        }

    </style>

    {{--表单提交--------------------------------------}}
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(300);

        $('.btn1').click(function(){
            $('#sampledata2').bringins({
                "position":"left",
                "color":"#d2527f",
                "width":"40%",
                "closeButton":"white"
            });
        });

        //获取验证码
        function phone(){

            var num = $('input[name=phone]').val();
            if(!num) {
                alert('手机号不能为空');
                return;
            }

            var res = setTime();
            if(res){
                return ;
            }

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/home/login/yzm",
                data: {number:num},
                dataType: "json",
                success: function (data) {

                    console.log(data);
                    code = data;
                }
            });
        }

        var djs= 60;
        function setTime(){

            //如果在60s内，按钮显示倒计时效果，并且是禁用的灰色
            if(djs != 0){
                // $('#dyMobileButton').
                $('#dyMobileButton').text("已发送("+djs+")s").css('color','#1a1a1a');
                $('#dyMobileButton').removeAttr('onclick');
                $('#dyMobileButton').attr('disabled','disabled');
                djs--;
                setTimeout(function(){
                    setTime();
                },1000);

            }else{
                // 如果已经超过60s,将按钮的文字设置成发送验证码，并启用按钮
                $('#dyMobileButton').text("重新发送");
                $('#dyMobileButton').attr('onclick','phone()');
            }


        }

        $(function() {

            // window.location.reload(true);
            $('#doc-my-tabs').tabs();

            // 验证码做比较
            $('#code').blur(function(){

                //获取值
                var cv = $(this).val();

                if(cv == code){

                    $(this).css('border','solid 1px green');
                    $(this).next().text(' √').css('color','green');

                    CV = true;

                } else {

                    $(this).css('border','solid 2px red');
                    $(this).next().text(' *').css('color','red');

                    CV = false;

                }

            });





            $('.forms').submit(function(){
                if (CV) {

                    return true;

                }

                alert('验证码不匹配');

                return false;
            })




        });

    </script>
@endsection


