@extends('home.getpass.layout')
@section('title','邮箱找回密码')
@section('content')
    <style>
        .step-10 .u-stage-icon-inner .bg,.step-11 .u-stage-icon-inner .bg,.step-12 .u-stage-icon-inner .bg{
            background-image: url(/home/images/sprite.png);
            background-position: -103px -135px;
            width: 19px;
            height: 19px;
        }
        .container,.alert-danger{
            width: 340px;
            position: fixed;
            top: 290px;
            right: 210px;
            z-index: 999;
        }
    </style>
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">完成</strong></div>
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
            <span class="step-11 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">重置密码</p>
                            </span>
            <span class="step-12 step">
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

    <a href="{{url('home/login/login')}}" type="button" class="btn btn-primary btn-lg btn-block">恭喜您重置密码成功&nbsp;(点击登录)</a>


@endsection