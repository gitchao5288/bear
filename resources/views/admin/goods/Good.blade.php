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
          <cite>商品浏览</cite></a>
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
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
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
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$v->gid}}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td style="width: 30px;">{{$v['gid']}}</td>
            <td style="width: 60px;">{{$v['HomeUser']['uname']}}</td>
            <td>{{$v['Cate']['cate_name']}}</td>
            <td style="width: 100px;">{{$v['gname']}}</td>
            <td >
                <img src="{{$v['gpic']}}" alt="" style="width: 70px;">
            </td>
            <td>{{$v['price']}}</td>
            <td style="width: 150px;">{{$v['gdesc']}}</td>
            <td>{{ date('Y-m-d H:i:s',$v['addtime']) }}</td>

             <td class="td-status">
              @if ( $v['status'] == 1 )

                  <span class="layui-btn layui-btn-normal layui-btn-mini">上架</span>

              @elseif($v['status'] == 2)

                  <span class="layui-btn layui-btn-danger layui-btn-mini">下架</span>
              @endif
              </td>

            <td class="td-manage">
                <a onclick="member_stop(this,{{$v['gid']}})" status="{{$v['status']}}" href="javascript:;"  title="{{ ($v['status']==1) ? '下架' : '上架' }}">
                    <i class="layui-icon">{!! ($v['status']==1) ? '&#xe601;' : '&#xe62f;' !!}</i>
                </a>
              <a title="编辑"  onclick="x_admin_show('编辑','/admins/Good/{{ $v['gid'] }}/edit')" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a title="删除" onclick="member_del(this,{{ $v['gid'] }})" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
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

       /*商品-下架*/
      function member_stop(obj,id){
          var status = $(obj).attr('status');

          // console.log(status);

          if(status==1){
              layer.confirm('确认要下架吗？',function(index){

                  if($(obj).attr('title')=='下架'){

                      $.ajax({
                          type: "POST",
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          url: "/admins/Good/changestatus",
                          data: {'id':id,'status':status},
                          dataType: "json",
                          success: function(data){
                            // console.log(data);
                              //发异步把用户状态进行更改

                              $(obj).find('i').html('&#xe62f;');


                              layer.msg('已下架!',{icon: 5,time:1000});
                              location.reload(true);
                          }
                      });
                  }
              });
          }
          if( status==2 ){
              layer.confirm('确认要上架吗？',function(index){

                  if($(obj).attr('title')=='上架'){

                      $.ajax({
                          type: "POST",
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          url: "/admins/Good/changestatus",
                          data: {'id':id,'status':status},
                          dataType: "json",
                          success: function(data){

                                  //发异步把用户状态进行更改

                                  $(obj).find('i').html('&#xe601;');

                                  layer.msg('已上架!',{icon: 6,time:1000});
                                  location.reload(true);


                          }
                      });
                  }
              });
          }
      }

      /*用户-删除*/
      function member_del(obj,id){
          // 获取商品id

          layer.confirm('确认要删除吗？',function(index){

              $.post("{{ url('admins/Good/') }}/"+id,{'_token':"{{csrf_token()}}",'_method':'delete'},function(data){
                  //如果删除成功
                  if(data.status == 0){
                      //发异步删除数据
                      $(obj).parents("tr").remove();
                      layer.msg('已删除!',{icon:1,time:1000});
                      location.reload(true);
                  }else{
                      layer.msg('删除失败!',{icon:1,time:1000});
                      location.reload(true);
                  }
              });

              //发异步删除数据
              // $(obj).parents("tr").remove();
              // layer.msg('已删除!',{icon:1,time:1000});
          });
      }



      function delAll (argument) {

        // var data = tableCheck.getData();
          //声明一个空数组，存放所有被选中的复选框的data-id属性值
          var ids = [];

          //获取所有的被选中的复选框
          $('.layui-form-checked').not('.header').each(function(i,v){
              ids.push($(v).attr('data-id'));
          });
          // console.log(ids);

          $.get('/admins/Good/delall',{"ids":ids},function(data){
              //后台如果删除成功，在前台上也把相关记录删除掉
              console.log(data);
              if(data.status == 0){
                  layer.msg('删除成功', {icon: 1});
                  $(".layui-form-checked").not('.header').parents('tr').remove();
              }else{
                  layer.msg('删除失败', {icon: 2});
              }
          })

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