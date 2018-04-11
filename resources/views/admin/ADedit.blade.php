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
    <div class="x-body">
        <form class="layui-form">
            <input type="hidden" name="aid" value="{{$data->aid}}">
          <div class="layui-form-item">
              {{csrf_field()}}
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>广告名字
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="username" name="aname" required="" lay-verify="required"
                  autocomplete="off" class="layui-input" value="{{$data->aname}}">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>成为您广告的名字
              </div>
          </div>
          <div class="layui-form-item">
              <label for="phone" class="layui-form-label">
                  <span class="x-red">*</span>广告信息
              </label>
              <div class="layui-input-inline">
                  <input type="text"  name="amse" required="" lay-verify="required"
                  autocomplete="off" class="layui-input" value="{{$data->amse}}">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>务必填写
              </div>
          </div>
            <div class="layui-form-item">
                <label for="phone" class="layui-form-label">
                    <span class="x-red">*</span>广告链接
                </label>
                <div class="layui-input-inline">
                    <input type="text"  name="link" required="" lay-verify="required"
                           autocomplete="off" class="layui-input" value="{{$data->link}}">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>务必填写
                </div>
            </div>
          <div class="layui-upload">
                <label class="layui-form-label">缩略图上传</label>

                <div class="layui-upload-list" style="position: relative;">
                    <input id="file_upload" type="file" name="fileupload"  value="" style="opacity:0.0;position: relative;z-index:99999999"   >
                    <img style="with:60px;height:30px;position: absolute;left:120px;top:0px;z-index:1;cursor: pointer;" class="layui-upload-img" id="demo1" src="/admin/images/774bca3f2fc12a59ddecd3dc693990b3.png">
                    <p id="demoText"></p>
                </div>
            </div>
          <!-- 隐藏 -->
           <div class="layui-form-item layui-form-text">
                <label class="layui-form-label"></label>
                <div class="layui-input-block">
                    <input type="hidden" name="aimg" value="{{$data->aimg}}">
                    <img id="art_thumb" src="{{$data->aimg}}" style="width:60px;">
                </div>
            </div>

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  修改
              </button>
          </div>
      </form>
    </div>

    <script>

        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;

          //自定义验证规则
          form.verify({
            nikename: function(value){
              if(value.length < 5){
                return '昵称至少得5个字符啊';
              }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
          });

          //图片上传
             $(function () {
                    $("#file_upload").change(function () {
                        uploadImage();
                    })
                })
                function uploadImage() {
                    //  判断是否有选择上传文件
                    var imgPath = $("#file_upload").val();
                    if (imgPath == "") {
                        alert("请选择上传图片！");
                        return;
                    }
                    //判断上传文件的后缀名
                    var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                    if (strExtension != 'jpg' && strExtension != 'gif'
                        && strExtension != 'png' && strExtension != 'bmp') {
                        alert("请选择图片文件");
                        return;
                    }
                    // var formData = new FormData($('#art_form')[0]);
                    var formData = new FormData();
                    formData.append('fileupload',$('#file_upload')[0].files[0]);

                    $.ajax({
                        type: "POST",
                        cache: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/admins/AD/upload",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log(data);
                            $('#art_thumb').attr('src', '/admin/upload/'+data);
                            $("input[name='aimg']").val('/admin/upload/'+data);

                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert("上传失败，请检查网络后重试");
                        }
                    });
                }
          //监听提交
          form.on('submit(add)', function(data){

            //AJAX
              $.ajax({
                  type:"PUT",
                  url:"/admins/AD/"+{{$data->aid}},
                  dataType:"json",
                  data:data.field,
                  headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                  success:function(data){
                      if(data.status==0) {
                          //发异步，把数据提交给php
                          layer.alert("修改成功", {icon: 6}, function () {

                              // 获得frame索引
                              var index = parent.layer.getFrameIndex(window.name);
                              //关闭当前frame
                              parent.layer.close(index);
                              parent.location.reload(true);
                          });
                      }
                  },
                  error:function(){
                      layer.alert("修改失败", {icon: 5},function () {
                          // 获得frame索引
                          var index = parent.layer.getFrameIndex(window.name);
                          //关闭当前frame
                          parent.layer.close(index);
                      });
                  }


                });
            return false;
          });


        });
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>