@extends('home.getpass.layout')
@section('title','邮箱找回密码')
@section('content')
    <style>
        .step-10 .u-stage-icon-inner .bg{
            background-image: url(/home/images/sprite.png);
            background-position: -103px -135px;
            width: 19px;
            height: 19px;
        }
        .container,.alert-danger{
            width: 700px;
            position: fixed;
            top: 230px;
            left: 400px;
            z-index: 999;
        }
    </style>
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">重置密码</strong></div>
    </div>
    <hr/>
    <!--进度条-->
    <div class="m-progress">
        <div class="m-progress-list">

            <span class="step-10 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg" ></em></i>
                                <p class="stage-name">验证身份</p>
                            </span>
                            </span>
            <span class="step-1 step">
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
<form class="am-form am-form-horizontal" action="{{url('home/getpass/eget')}}" method="post">
    {{ csrf_field() }}
    {{--随机数添加隐藏域--}}
    <input type="hidden" value="{{$rand}}" name="rand">
    {{--<div class="am-form-group">
        <label for="user-old-password" class="am-form-label">邮箱</label>
        <div class="am-form-content">
            <input type="email" name="email" id="user-old-password" placeholder="请输入您的邮箱">
        </div>
    </div>--}}

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