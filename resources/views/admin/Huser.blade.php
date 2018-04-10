<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.style')
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
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" action="/admins/Huser" method="get">

          <input type="text" name="uname" value="{{$uname}}"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <span class="x-right" style="line-height:40px">共有数据：{{$data->count()}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>登录名</th>
            <th>手机</th>
            <th>状态</th>
            <th>邮箱</th>
            <th>创建时间</th>
            <th>操作</th>
        </thead>
        <tbody>
        @foreach($data as $v)
          <tr>
            <td>{{$v->uid}}</td>
            <td>{{$v->uname}}</td>
            <td>{{$v->phone}}</td>

            <td class="td-status">
              @if($v->status==1)
              <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
              @else
              <span class="layui-btn layui-btn-normal layui-btn-mini layui-btn-disabled">已停用</span>
              @endif
            </td>
            <td>{{$v->email}}</td>
            <td>{{date('Y-m-d H:i:s',$v->maketime)}}</td>
            <td class="td-manage">
               <a onclick="member_stop(this,{{ $v->uid }})" href="javascript:;" status="{{ $v->status }}"  title="{{ ($v['status']==1) ? '停用' : '启用' }}">
                <i class="layui-icon">{!! ($v['status']==1) ? '&#xe601;' : '&#xe62f;' !!}</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        {{--{!!$data->links()!!}--}}
        {{--{{ $data->appends($request)->rander() }}--}}
        {!! $data->appends(['uname' => $uname])->links() !!}
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

       /*用户-停用*/
      function member_stop(obj,id){
            var status = $(obj).attr('status');
        if(status==1){
          layer.confirm('确认要停用吗？',function(index){

           if($(obj).attr('title')=='停用'){


              $.ajax({
                  type: "POST",
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: "/admins/Huser/changestatus",
                  data: {'id':id,'status':status},
                  dataType: "json",
                  success: function(data){
                      //发异步把用户状态进行更改

                      $(obj).find('i').html('&#xe62f;');


                      layer.msg('已停用!',{icon: 5,time:1000});
                      location.reload(true);
                  }
              });
              }
          });
        }
       if(status=='0'){
             layer.confirm('确认要启用吗？',function(index){

           if($(obj).attr('title')=='启用'){


              $.ajax({
                  type: "POST",
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: "/admins/Huser/changestatus",
                  data: {'id':id,'status':status},
                  dataType: "json",
                  success: function(data){
                      //发异步把用户状态进行更改

                      $(obj).find('i').html('&#xe601;');


                      layer.msg('已启用!',{icon: 6,time:1000});
                      location.reload(true);
                  }
              });
              }
          });
        }
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }



      function delAll (argument) {

        var data = tableCheck.getData();

        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
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