@extends('home.getpass.layout')
@section('title','选择找回方式')
@section('content')

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">选择找回方式</strong></div>
    </div>
    <hr/>
    <a class="am-btn am-btn-warning btn-block" href="{{url('home/getpass/emailpass')}}" target="_blank"><i class="am-icon-edge"></i>&nbsp;邮箱找回</a>

    <a class="am-btn am-btn-danger btn-block" href="{{url('home/getpass/phonepass')}}" target="_blank"><i class="am-icon-phone"></i>&nbsp;手机号找回</a>
@endsection
