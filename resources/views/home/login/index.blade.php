@extends('home.login.layout')
@section('title','注册')

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
                            <input id="reader-me" type="checkbox" class="che1" value="0" >
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
                        <a class="btn" href="javascript:void(0);" id="sendMobileCode">
                            <span id="dyMobileButton" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="点击获取验证码">获取</span></a>
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
                            <input id="reader-me" type="checkbox" class="che1" value="1">
                            <a href="#" class="btn1"> 点击表示您同意商城《服务协议》</a>
                        </div>
                    </div>
                    <div class="am-cf" id="phonesub">
                        <input type="submit"value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                    </div>

                </form>

                <hr>
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
                    width: 75%;
                }
                #dyMobileButton{
                    color: #ee3495;
                    width: 20%;
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

                $(function() {
                    $('#doc-my-tabs').tabs();

                    //获取验证码
                    $('#sendMobileCode').click(function(){

                        var number = $('input[name=phone]').val();

                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "/home/login/yzm",
                            data: {number:number},
                            dataType: "json",
                            success: function (data) {

                                console.log(data);
                                code = data;
                            }

                        });

                        if ( number ) {

                            $('#dyMobileButton').html('已发送').css('color','green');

                        }

                        //阻止默认行为
                        return false;

                    });

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

                    // if(confirm('同意协议'));
                    // 点击同意才能注册通过
                    var che1;
                    var che2;

                    $("input[type='checkbox']").eq(0).click(function(){

                        che1 = $("input[type='checkbox']").eq(0).is(':checked');
                        // console.log(che1);
                    });

                    $('input[type="checkbox"]').eq(1).click(function(){

                        che2 = $('input[type="checkbox"]').eq(1).is(':checked');

                        // console.log(che2)
                    });



                    $('.forms').submit(function(){
                        if ( che1 || ( che2 && CV ) ) {

                            return true;

                        }

                        alert('请您认真阅读服务协议');

                        return false;
                    })




                });

            </script>

        </div>
    </div>
@endsection


