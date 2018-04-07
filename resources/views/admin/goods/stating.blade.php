<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
      <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/index/css/font.css">
    <link rel="stylesheet" href="/admin/index/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/index/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/index/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">商品管理</a>
        <a>
          <cite>待审核</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">

      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so layui-form-pane">
            <tr >
                <th ></th>
                <th >
                    <div class="layui-input-inline">
                    {{--每页条数：--}}
                    <select name="num" >
                        <option value="2"
                                @if($request['num'] == 2)  selected  @endif
                        >2
                        </option>
                        <option value="5"
                                @if($request['num'] == 5)  selected  @endif
                        >5
                        </option>
                    </select>
                    </div>
                </th>
                {{--<th  class="layui-input" width="70">类别名:</th>--}}
                <td><input class="layui-input" type="text" name="keywords1" value="{{$request->keywords1}}" placeholder="类别名"></td>
                {{--<th width="70">商品名称:</th>--}}
                <td><input class="layui-input" type="text" name="keywords2" value="{{$request->keywords2}}" placeholder="商品名称"></td>
                <td><input class="layui-btn" type="submit"  value="查询"></td>
            </tr>
          {{--<input class="layui-input" placeholder="分类名" name="cate_name">--}}
          {{--<button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon"></i>增加</button>--}}
        </form>
      </div>
      <xblock>

        <span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>

            <th>ID</th>
            <th>发布人</th>
            <th>分类名</th>
            <th>商品名称</th>
            <th>商品图片</th>
            <th>商品单价</th>
            <th>商品描述</th>
            <th>发布时间</th>
            <th>商品状态</th>
            <th>操作</th>
        </thead>
        <tbody>
        @foreach($goods as $v)
          <tr>

            <td style="width: 30px;">{{$v['gid']}}</td>
            <td style="width: 60px;">{{$v->HomeUser->uname}}</td>
              <td>{{$v->Cate->cate_name}}</td>
            <td style="width: 100px;">{{$v['gname']}}</td>
            <td >
                <img src="{{$v['gpic']}}" alt="" style="width: 70px;">
            </td>
            <td>{{$v['price']}}</td>
            <td style="width: 150px;">{{$v['gdesc']}}</td>
            <td>{{ date('Y-m-d H:i:s',$v['addtime']) }}</td>

             <td class="td-status">

                  <span class="layui-btn layui-btn-danger layui-btn-mini">待审核</span>

              </td>

            <td class="td-manage">
                <a class="layui-btn layui-btn-mini layui-btn-normal" onclick="member_stop(this,{{ $v['gid'] }})" href="javascript:;" status="{{ $v->status }}"  title="上架">上架

              </a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
      <div class="page page_list">

          {!! $goods->appends($request->all())->render() !!}
      </div>

    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*商品-上架*/
      function member_stop(obj,id){
          //获取要改变状态的用户的id

          //获取当前改变用户的状态
          var status = $(obj).attr('status');

          layer.confirm('确认要上架吗？',function(index){

              // if($(obj).attr('title')=='上架'){
              if( status == 0 ){

                  $.ajax({
                      type: "POST",
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url: "/admins/Good/state",
                      data: {'id':id,'status':status},
                      dataType: "json",
                      success: function(data){
                        // console.log(data);

                        //发异步把用户状态进行更改

                          $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已上架');
                          layer.msg('已上架!');
                          location.reload(true);
                          // parent.location.reload(true);
                      }
                  });

              }

          });
      }



    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>