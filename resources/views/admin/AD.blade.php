<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>欢迎页面-X-admin2.0</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
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

  <xblock>
    <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
    <button class="layui-btn" onclick="x_admin_show('上传广告','/admins/AD/create')"><i class="layui-icon"></i>上传广告</button>
    <span class="x-right" style="line-height:40px">共有数据：88 条</span>
  </xblock>
  <table class="layui-table">
    <thead>
    <tr>
      <th>
        <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
      </th>
      <th>ID</th>
      <th>广告名</th>
      <th>广告内容</th>
      <th>广告图片</th>
      <th>添加时间</th>
      <th>广告状态</th>
      <th>跳转链接</th>
      <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $v)
      <tr>
        <td>
          <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$v->aid}}'><i class="layui-icon">&#xe605;</i></div>
        </td>
        <td>{{$v->aid}}</td>
        <td>{{$v->aname}}</td>
        <td>{{$v->amse}}</td>
        <td><img src="{{$v->aimg}}"></td>
        <td>{{date("Y-m-d H:i:s",$v->atime)}}</td>
        <td class="td-status">
          @if($v->astatus==1)
            <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
          @else
            <span class="layui-btn layui-btn-normal layui-btn-mini layui-btn-disabled">已停用</span>
          @endif
        </td>
        <td>{{$v->link}}</td>
        <td class="td-manage">
          <a onclick="member_stop(this,{{ $v->aid }})" href="javascript:;" status="{{ $v->astatus }}"  title="{{($v->astatus==1)?'禁用':'启用'}}">
            <i class="layui-icon">&#xe601;</i>
          </a>
          <a title="编辑"  onclick="x_admin_show('编辑','/admins/AD/'+{{$v->aid}}+'/edit')" href="javascript:;">
            <i class="layui-icon">&#xe642;</i>
          </a>
          <a title="删除" onclick="member_del(this,{{$v->aid}})" href="javascript:;">
            <i class="layui-icon">&#xe640;</i>
          </a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  <div class="page">
    <div>
      {{$data->links()}}
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

    /*广告-上架*/
    function member_stop(obj,id){
        //获取要改变状态的用户的id

        //获取当前改变用户的状态
        var status = $(obj).attr('status');
        if( status == '0' ){
            layer.confirm('确认要启用吗？',function(index){

                // if($(obj).attr('title')=='上架'){


                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admins/AD/changestatus",
                    data: {'id':id,'status':status},
                    dataType: "json",
                    success: function(data){
                        console.log(data);

                        //发异步把用户状态进行更改

                        $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                        layer.msg('已启用!');
                        location.reload(true);
                        // parent.location.reload(true);
                    }
                });


            });
        }
        if( status == '1' ){
            layer.confirm('确认要停用吗？',function(index){

                // if($(obj).attr('title')=='上架'){


                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admins/AD/changestatus",
                    data: {'id':id,'status':status},
                    dataType: "json",
                    success: function(data){
                        console.log(data);

                        //发异步把用户状态进行更改

                        $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已停用');
                        layer.msg('已停用!');
                        location.reload(true);
                        // parent.location.reload(true);
                    }
                });


            });
        }

    }


    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            console.log(id);
            $.ajax({
                type:"DELETE",
                url:"/admins/AD/"+id,
                dataType:"json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                success:function(data){
                    console.log(data);
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }

            });

        });
    }

    function delAll () {

        //var data = tableCheck.getData();
        //声明一个空数组,存放所有被选中的复选框的data-id的属性值
        var ids = [];
        //获取所有的被选中的复选框
        $('.layui-form-checked').not('.header').each(function(i,v){
            ids.push($(v).attr('data-id'))
        })
        // console.log(ids);
        $.get('/admins/AD/delall',{"ids":ids},function(data){
            //后台删除成功,在前台上也删除
            if(data.status==0){
                layer.msg('删除成功', {icon: 1});
                $(".layui-form-checked").not('.header').parents('tr').remove();
            }else{
                layer.msg('删除失败',{icon: 1});
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