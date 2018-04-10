<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="{{asset('/home/AmazeUI-2.4.2/assets/css/amazeui.min.css')}}" />
    <link href="{{asset('/home/css/dlstyle.css')}}" rel="stylesheet" type="text/css">
    <link type="text/css" rel="stylesheet" href="{{asset('/home/bs/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/bootstrap-grid.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/reset.css')}}">
    <script src="{{asset('/home/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('/home/AmazeUI-2.4.2/assets/js/amazeui.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('/home/js/bringins.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/bs/js/bootstrap.min.js')}}"></script>

    {{--<link rel="stylesheet" href="/home/layui/css/layui.css">--}}
    {{--<script src="/home/layui/layui.js"></script>--}}


    <style>
        #btn{
            float: right;
            margin-top: 15px;
            margin-right: 20px;
        }
    </style>


</head>

<body>

    <div class="login-boxtitle">

        <a href="/"><img alt="" src="/home/basic/images2/logo2.png" /></a>

        @section('login')

        @show
    </div>


<div class="res-banner">

    <div class="res-main">
        <div class="login-banner-bg"><span></span><img src="/home/images/big.jpg" /></div>

        <div class="login-box">

            @section('content')

            @show
        </div>


    </div>

    {{--公共底部 footer --}}
    @include('home.public.footer')

    <div id="sampledata2" class="bringins-content">
        <h2>懒熊平台服务协议</h2>
        <p>

            <p>提示条款</p>

            <p>欢迎您与各淘宝平台经营者（详见定义条款）共同签署本《淘宝平台服务协议》（下称“本协议”）并使用淘宝平台服务！

                本协议为《淘宝服务协议》修订版本，自本协议发布之日起，淘宝平台各处所称“淘宝服务协议”均指本协议。

                各服务条款前所列索引关键词仅为帮助您理解该条款表达的主旨之用，不影响或限制本协议条款的含义或解释。为维护您自身权益，建议您仔细阅读各条款具体表述。

                【审慎阅读】您在申请注册流程中点击同意本协议之前，应当认真阅读本协议。请您务必审慎阅读、充分理解各条款内容，特别是免除或者限制责任的条款、法律适用和争议解决条款。免除或者限制责任的条款将以粗体下划线标识，您应重点阅读。如您对协议有任何疑问，可向淘宝平台客服咨询。

                【签约动作】当您按照注册页面提示填写信息、阅读并同意本协议且完成全部注册程序后，即表示您已充分阅读、理解并接受本协议的全部内容，并与淘宝达成一致，成为淘宝平台“用户”。阅读本协议的过程中，如果您不同意本协议或其中任何条款约定，您应立即停止注册程序。</p>


            <p>一、 定义</p>

                <p>淘宝平台：指包括淘宝网（域名为 taobao.com）、天猫（域名为tmall.com）、一淘网（域名为etao.com）、聚划算（域名为ju.tmall.com）、阿里妈妈（域名为alimama.com）、阿里旅行（域名为alitrip.com）等网站及客户端。</p>

                <p>  淘宝：淘宝平台经营者的单称或合称，包括淘宝网经营者浙江淘宝网络有限公司、天猫经营者浙江天猫网络有限公司、一淘网经营者浙江淘宝网络有限公司、聚划算经营者浙江天猫网络有限公司、阿里妈妈经营者杭州阿里科技有限公司、阿里旅行经营者浙江淘宝网络有限公司等。
                </p>
                <p>淘宝平台服务：淘宝基于互联网，以包含淘宝平台网站、客户端等在内的各种形态（包括未来技术发展出现的新的服务形态）向您提供的各项服务。</p>
                <p>淘宝平台规则：包括在所有淘宝平台规则频道内已经发布及后续发布的全部规则、解读、公告等内容以及各平台在帮派、论坛、帮助中心内发布的各类规则、实施细则、产品流程说明、公告等。</p>
                <p>淘宝平台规则：包括在所有淘宝平台规则频道内已经发布及后续发布的全部规则、解读、公告等内容以及各平台在帮派、论坛、帮助中心内发布的各类规则、实施细则、产品流程说明、公告等。
                </p>
                <p>淘宝网规则：淘宝网规则频道列明的各项规则，具体详见此处。</p>

                <p>阿里平台：指包括淘宝平台、阿里巴巴中文站（域名为1688.com）、阿里巴巴国际站（域名为alibaba.com）、天猫国际网站（域名为tmall.hk）、阿里云网站（域名为aliyun.com）、速卖通（域名为aliexpress.com）、点点虫（域名为ddchong.com）、虾米（域名为xiami.com）、云OS（域名为yunos.com）、菜鸟（域名为cainiao.com）、神马搜索（域名为sm.cn）等网站及客户端。</p>

                <p>支付宝公司：指提供支付宝服务的主体支付宝（中国）网络技术有限公司。</p>

            <p>关联公司：除淘宝外阿里平台的经营者的单称或合称。</p>

            <p>同一用户：使用同一身份认证信息或经淘宝排查认定多个淘宝账户的实际控制人为同一人的，均视为同一用户。</p>


            <p>二、 协议范围</p>

            <p>2.1 签约主体</p>

            <p>【平等主体】本协议由您与淘宝平台经营者共同缔结，本协议对您与淘宝平台经营者均具有合同效力。</p>

            <p>【主体信息】淘宝平台经营者是指经营淘宝平台的各法律主体，您可随时查看淘宝平台各网站首页底部公示的证照信息以确定与您履约的淘宝主体。本协议项下，淘宝平台经营者可能根据淘宝平台的业务调整而发生变更，变更后的淘宝平台经营者与您共同履行本协议并向您提供服务，淘宝平台经营者的变更不会影响您本协议项下的权益。淘宝平台经营者还有可能因为提供新的淘宝平台服务而新增，如您使用新增的淘宝平台服务的，视为您同意新增的淘宝平台经营者与您共同履行本协议。发生争议时，您可根据您具体使用的服务及对您权益产生影响的具体行为对象确定与您履约的主体及争议相对方。</p>

            <p>2.2补充协议</p>

            <p>由于互联网高速发展，您与淘宝签署的本协议列明的条款并不能完整罗列并覆盖您与淘宝所有权利与义务，现有的约定也不能保证完全符合未来发展的需求。因此，淘宝平台法律声明及隐私权政策、淘宝平台规则均为本协议的补充协议，与本协议不可分割且具有同等法律效力。如您使用淘宝平台服务，视为您同意上述补充协议。</p>


    </div>
</body>

</html>