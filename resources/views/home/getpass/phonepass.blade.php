@extends('home.getpass.layout')
@section('title','邮箱找回密码')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        *{
            list-style: none;
        }
        .container{
            width: 700px;
            position: fixed;
            top: 230px;
            left: 400px;
            z-index: 999;
        }
    </style>

    <script>
        // alert($);
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

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
                url: "/home/getpass/yzm",
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
                if ( CV ) {
                    return true;
                }

                alert('请您认真阅读服务协议');

                return false;
            })




        });


    </script>
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">验证身份/重置密码</strong></div>
    </div>
    <hr/>
    <!--进度条-->
    <div class="m-progress">
        <div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">验证身份/重置密码</p>
                            </span>

            <span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">3<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
            <span class="u-progress-placeholder"></span>
        </div>
        <div class="u-progress-bar total-steps-2">
            <div class="u-progress-bar-inner"></div>
        </div>
    </div>

    {{--显示错误信息--}}
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

<form class="am-form am-form-horizontal" action="{{url('home/getpass/phoneget')}}" method="post">
    {{ csrf_field() }}
    <div class="am-form-group">
        <label for="user-old-password" class="am-form-label">手机号</label>
        <div class="am-form-content">
            <input type="text" name="phone" value="{{old('phone')}}" id="user-old-password" placeholder="请输入您的手机号">
        </div>
    </div>
    <div class="am-form-group">
        <label for="user-old-password" class="am-form-label">验证码</label>
        <div class="am-form-content" >
            <input type="text" name="code" value="{{old('phone')}}" id="code" style="width:70%;float: left;" placeholder="输入验证码">
            <span></span>
            <a class="btn" href="javascript:;" id="sendMobileCode" >
                <span id="dyMobileButton"  style="float: right; margin-top: -8px; " class="btn btn-default" onclick="phone();"  data-toggle="tooltip" data-placement="right" title="点击获取验证码">获取验证码</span></a>

        </div>

    </div>
    <div class="am-form-group">
        <label for="user-new-password" class="am-form-label">新密码</label>
        <div class="am-form-content">
            <input type="password" name="password" id="user-new-password" placeholder="由数字、字母组合">
        </div>
    </div>
    <div class="am-form-group">
        <label for="user-confirm-password" class="am-form-label">确认密码</label>
        <div class="am-form-content">
            <input type="password" name="repassword" id="user-confirm-password" placeholder="请再次输入上面的密码">
        </div>
    </div>

    <div class="info-btn">
        <input type="submit" class="am-btn am-btn-danger" value="提交">
    </div>
</form>

@endsection