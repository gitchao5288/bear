@extends('home.getpass.layout')
@section('title','邮箱找回密码')
@section('content')
    <style>
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
    </script>
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">验证身份</strong></div>
    </div>
    <hr/>
    <!--进度条-->
    <div class="m-progress">
        <div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">验证身份</p>
                            </span>
            <span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">重置密码</p>
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
<form class="am-form am-form-horizontal" action="{{url('home/getpass/emailget')}}" method="post">
    {{ csrf_field() }}
    <div class="am-form-group">
        <label for="user-old-password" class="am-form-label">邮箱</label>
        <div class="am-form-content">
            <input type="email" name="email" value="{{old('email')}}" id="user-old-password" placeholder="请输入您的邮箱">
        </div>
    </div>

    <div class="info-btn">
        <input type="submit" class="am-btn am-btn-danger" value="提交">
    </div>
</form>

@endsection