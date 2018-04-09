<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
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
      <meta name="csrf-token" content="{{ csrf_token() }}">

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
        <form class="layui-form layui-col-md12 x-so layui-form-pane">

          <input type="text" name="rname" value="{{$request->rname}}" placeholder="请输入关键字" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>

        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>

         <button class="layui-btn" onclick="x_admin_show('添加用户','/admins/Res/create')"><i class="layui-icon"></i>添加</button>

        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>

            <th>图片名称</th>
            <th>图片简介</th>
            <th>图片链接</th>
            <th>缩略图</th>
            <th>轮播图状态</th>
            <th>操作</th>
        </thead>
        <tbody>
          @foreach($data as $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$v->rid}}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->rid}}</td>
            <td>{{$v->rname}}</td>
            <td>{{$v->rdes}}</td>
            <td>{{$v->link}}</td>
            <td><img src="{{$v->feilname}}" alt=""></td>
            
            <td class="td-status">
              <span class="layui-btn {{ ($v->rstatus==0) ? 'layui-btn-danger' : 'layui-btn-normal' }} layui-btn-mini">{{($v->rstatus==0) ? '已禁用' : '已启用'}}</span></td>
            
            <td class="td-manage">
              <a onclick="member_stop(this,{{$v->rid}})" status="{{$v->rstatus}}" href="javascript:;"  title="{{($v->rstatus==0) ? '启用' : '禁用'}}">
                <i class="layui-icon">{{ ($v->rstatus==0) ? '&#xe62f;' : '&#xe601;' }}</i>
              </a>
              <a title="编辑"  onclick="x_admin_show('编辑','{{  url('admins/Res/'.$v->rid.'/edit') }}')" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>

              <a title="删除" onclick="member_del(this,{{$v->rid }})" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">

        {!! $data->appends($request->all())->render() !!}


        </div>

      

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

          // console.log(status);

          if(status==1){
              layer.confirm('确认要禁用吗？',function(index){

                  if($(obj).attr('title')=='禁用'){

                      $.ajax({
                          type: "get",

                          url: "/admins/Res/statusup",
                          data: {id:id,status:status},
                          dataType: "json",
                          success: function(data){
                              // console.log(data);
                              //发异步把用户状态进行更改
                            console.log(data);
                              $(obj).find('i').html('&#xe62f;');

                              $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已禁用');
                              layer.msg('已禁用!',{icon: 5,time:1000});
                              location.reload(true);
                          }
                      });
                  }
              });
          }

          if( status==0 ){
              layer.confirm('确认要启用吗？',function(index){

                  if($(obj).attr('title')=='启用'){

                      $.ajax({
                          type: "get",

                          url: "/admins/Res/statusup",
                          data: {'id':id,'status':status},
                          dataType: "json",
                          success: function(data){

                              //发异步把用户状态进行更改

                              $(obj).find('i').html('&#xe601;');
                              $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn layui-btn-normal layui-btn-mini').html('已启用');
                              layer.msg('已启用!',{icon: 6,time:1000});
                              location.reload(true);


                          }
                      });
                  }
              });
          }


          /*layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');

                layer.msg('已启用!',{icon: 6,time:1000});

              }

          });*/
      }

      /*用户-删除*/
      function member_del(obj,id){

          //获取用户ID
          layer.confirm('确认要删除吗？',function(index){

              // $.post('请求的路径','携带的参数'，执行成功后的返回结果)
              $.post("{{ url('admins/Res/') }}/"+id,{'_token':"{{csrf_token()}}",'_method':'delete'},function(data){
                  //如果删除成功
                  if(data.status == 0){
                      //发异步删除数据
                      $(obj).parents("tr").remove();
                      layer.msg(data.msg,{icon:6,time:2000});
                    }else{
                      layer.msg(data.msg,{icon:5,time:2000});
                  }
              });



          });
      }
/*
      function member_del(obj,id){

          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });

      }*/



      function delAll () {

        // var data = tableCheck.getData();

          //声明一个空数组，存放所有被选中的复选框的data-id属性值
          var ids = [];
        //获取所有的被选中的复选框
          $('.layui-form-checked').not('.header').each(function(i,v){
              ids.push($(v).attr('data-id'));
          });
          // console.log(ids);


          $.get('/admins/Res/delall',{"ids":ids},function(data){
            // console.log(data);
              //后台如果删除成功，在前台上也把相关记录删除掉
              if(data.status == 0){
                  layer.msg(data.msg, {icon: 1});
                  $(".layui-form-checked").not('.header').parents('tr').remove();
              }else{
                  layer.msg(data.msg, {icon: 2});
              }
          })
  
        // layer.confirm('确认要删除吗？'+data,function(index){
        //     //捉到所有被选中的，发异步进行删除
        //     layer.msg('删除成功', {icon: 1});
        //     $(".layui-form-checked").not('.header').parents('tr').remove();
        // });

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