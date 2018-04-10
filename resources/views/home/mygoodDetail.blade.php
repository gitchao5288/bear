<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>商品页面</title>

    <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />
    <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
    <link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="/home/basic/css2/optstyle.css" rel="stylesheet" />
    <link type="text/css" href="/home/basic/css2/style.css" rel="stylesheet" />

    <script type="text/javascript" src="/home/basic/js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="/home/basic/js/quick_links.js"></script>

    <script type="text/javascript" src="/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
    <script type="text/javascript" src="/home/js/jquery.imagezoom.min.js"></script>
    <script type="text/javascript" src="/home/js/jquery.flexslider.js"></script>
    <script type="text/javascript" src="/home/js/list.js"></script>

</head>

<body>


<!--顶部导航条 -->
<div class="am-container header">
    <ul class="message-l">
        <div class="topMessage">
            <div class="menu-hd">
                {{--如果用户没有登录，显示登录链接，如果已经登录，显示用户账号--}}
                @if(!session('user'))
                    <a href="/home/login/login" target="_top" class="h">亲，请登录</a>
                    <a href="/home/login/index" target="_top">免费注册</a>
                @else
                    <span target="_top" class="h">{{session('user')->uname}}</span>
                    <span target="_top" >您好！</span>
                    <a href="/home/exit" target="_top" class="h">[退出]</a>
                @endif
            </div>
        </div>
    </ul>
    <ul class="message-r">
        <div class="topMessage home">
            <div class="menu-hd"><a href="/" target="_top" class="h">商城首页</a></div>
        </div>
        <div class="topMessage my-shangcheng">
            <div class="menu-hd MyShangcheng"><a href="/center" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
        </div>

        <div class="topMessage favorite">
            <div class="menu-hd"><a href="/collection" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
    </ul>
</div>

<!--悬浮搜索框-->

<div class="nav white">
    <div class="logo"><img src="/home/images/logo.png" /></div>
    <div class="logoBig">
        <li><img src="/home/basic/images2/logo2.png" /></li>
    </div>
    <div class="search-bar pr">
        <a name="index_none_header_sysc" href="#"></a>
        <form>
            <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
            <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
        </form>
    </div>
</div>

<div class="clear"></div>
<b class="line"></b>
<div class="listMain">

    <!--分类-->
    <div class="nav-table">
        <div class="long-title"><span class="all-goods">全部分类</span></div>
        <div class="nav-cont">
            <ul>
                <li class="index"><a href="#">首页</a></li>
                <li class="qc"><a href="#">闪购</a></li>
                <li class="qc"><a href="#">限时抢</a></li>
                <li class="qc"><a href="#">团购</a></li>
                <li class="qc last"><a href="#">大包装</a></li>
            </ul>

        </div>
    </div>
    <ol class="am-breadcrumb am-breadcrumb-slash">
        <li><a>{{$firstCate}}</a></li>
        <li><a>{{$secondCate}}</a></li>
        <li class="am-active">{{$thirdCate}}</li>
    </ol>
    <script type="text/javascript">
        $(function() {});
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                start: function(slider) {
                    $('body').removeClass('loading');
                }
            });
        });
    </script>
    <div class="scoll">
        <section class="slider">
            <div class="flexslider">

            </div>
        </section>
    </div>

    <!--放大镜-->

    <div class="item-inform">
        <div class="clearfixLeft" id="clearcontent">

            <div class="box">
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".jqzoom").imagezoom();
                        $("#thumblist li a").click(function() {
                            $(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
                            $(".jqzoom").attr('src', $(this).find("img").attr("mid"));
                            $(".jqzoom").attr('rel', $(this).find("img").attr("big"));
                        });
                    });
                </script>

                <div class="tb-booth tb-pic tb-s310">
                    <a href="{{$goods->gpic}}"><img src="{{$goods->gpic}}" alt="细节展示放大镜特效" rel="{{$goods->gpic}}" class="jqzoom" /></a>
                </div>

            </div>

            <div class="clear"></div>
        </div>

        <div class="clearfixRight">

            <!--规格属性-->
            <!--名称-->
            <div class="tb-detail-hd">
                <h1>
                    {{$goods->gname}}
                </h1>
            </div>
            <div class="tb-detail-list">
                <!--价格-->
                <div class="tb-detail-price">
                    <li class="price iteminfo_price">
                        <dt>价格</dt>
                        <dd><em>¥</em><b class="sys_item_price">{{$goods->price}}.00</b>  </dd>
                    </li>

                    <div class="clear"></div>
                </div>




                <!--各种规格-->

            <div class="clear"></div>


        </div>


        </form>
    </div>
</div>

</dd>
</dl>
<div class="clear"></div>
<!--活动	-->

</div>



</div>





<!-- introduce-->

<div class="introduce">

    <div class="introduceMain">
        <div class="am-tabs" data-am-tabs>
            <ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active">
                    <a href="#">

                        <span class="index-needs-dt-txt">宝贝详情</span></a>

                </li>


            </ul>

            <div class="am-tabs-bd">

                <div class="am-tab-panel am-fade am-in am-active">
                    <div class="J_Brand">

                        <div class="attr-list-hd tm-clear">
                            <h4>商品描述：</h4></div>
                        <div class="clear"></div>
                        <ul id="J_AttrUL">
                            {{--<li title="">产品类型:&nbsp;烘炒类</li>
                            <li title="">原料产地:&nbsp;巴基斯坦</li>
                            <li title="">产地:&nbsp;湖北省武汉市</li>
                            <li title="">配料表:&nbsp;进口松子、食用盐</li>
                            <li title="">产品规格:&nbsp;210g</li>
                            <li title="">保质期:&nbsp;180天</li>
                            <li title="">产品标准号:&nbsp;GB/T 22165</li>
                            <li title="">生产许可证编号：&nbsp;QS4201 1801 0226</li>
                            <li title="">储存方法：&nbsp;请放置于常温、阴凉、通风、干燥处保存 </li>
                            <li title="">食用方法：&nbsp;开袋去壳即食</li>--}}
                            <li>{{$goods->gdesc}}</li>
                        </ul>
                        <div class="clear"></div>
                    </div>


                    <div class="clear"></div>

                </div>



            </div>

        </div>

        <div class="clear"></div>

        <!--底部-->
        @include('home.public.footer')
    </div>

</div>
</div>


</body>

</html>