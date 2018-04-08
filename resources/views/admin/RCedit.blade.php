<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <![endif]-->
  </head>

  <body>

    <div class="x-body">
        <form class="layui-form">
        	<input type="hidden" name="rid" value="{{$data->rid}}" >
        	<input type="hidden" name="oldfeilname" value="{{$data->feilname}}" >
          <div class="layui-form-item">
              <label for="rname" class="layui-form-label">
                  <span class="x-red">*</span>轮播名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="username" name="rname" required="" lay-verify="required"
                  autocomplete="off" class="layui-input" value="{{$data->rname}}">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>必填
              </div>
          </div>
         
          <div class="layui-form-item">
              <label for="rdes" class="layui-form-label">
                  <span class="x-red">*</span>轮播信息
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="username" name="rdes" required="" lay-verify="required"
                  autocomplete="off" class="layui-input" value="{{$data->rdes}}">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>必填
              </div>
          </div>     

           <div class="layui-form-item">
              <label for="rdes" class="layui-form-label">
                  <span class="x-red">*</span>轮播链接
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="" name="link" required="" lay-verify="required"
                  autocomplete="off" class="layui-input" value="{{$data->link}}">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>必填
              </div>
            </div>

          <div class="layui-upload">
                <label class="layui-form-label">
                  <span class="x-red">*</span>
                缩略图上传</label>
          
                <div class="layui-upload-list" style="position: relative;">
                    <input id="file_upload" type="file" name="fileupload"  value="{{$data->fileupload}}" style="opacity:0.0;position: relative;z-index:99999999"   >
                    <img style="with:92px;height:38px;position: absolute;left:110px;top:0px;z-index:1;cursor: pointer;" class="layui-upload-img" id="demo1" src="/admin/index/images/wjsc.png">
                    <p id="demoText"></p>
                </div>
            </div>


          <!-- <隐藏 -->
           <div class="layui-form-item layui-form-text">
                <label class="layui-form-label"></label>
                <div class="layui-input-block">
                    <input type="hidden" name='feilname' value="{{$data->feilname}}">
                    <img id="art_thumb" src="{{ $data->feilname }}" style="width:500px; position: absolute; left: 300px; top: -200px;">
                </div>
            </div>

          <div class="layui-form-item">
              <label class="layui-form-label"><span class="x-red">*</span>轮播状态</label>
              <div class="layui-input-block">
                  <input type="radio" name="rstatus" value="1" {!!  ($data->rstatus==1) ? 'checked' : '' !!}  lay-skin="primary" title="开启">
                  <input type="radio" name="rstatus" value="0" {!!  ($data->rstatus==0) ? 'checked' : '' !!} lay-skin="primary" title="关闭">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="edit" lay-submit="">
                  提交修改
              </button>
          </div>
          
      </form>
    </div>

    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;

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
                        url: "/admins/Res/upload",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {


                            $('#art_thumb').attr('src', '/admin/upload/'+data);
                            $("input[name='feilname']").val('/admin/upload/'+data);


                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert("上传失败，请检查网络后重试");
                        }
                    });

                }



          //监听提交
          form.on('submit(edit)', function(data){
          	var rid = $("input[type='hidden']").val();
          	// console.log(rid);
            //AJAX
              $.ajax({
                  headers:{
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type:"PUT",
                  url:"/admins/Res/"+rid,
                  data:data.field,
                  dataType:"json",
                 success: function(data){
                    console.log(data);
                      // 如果添加成功
                        if(data == 1){
                            layer.alert('修改成功',{icon:6},function(){
                              parent.location.reload(true);
                            })
                        }else{
                            layer.alert('修改失败',{icon:5},function(){
                               parent.location.reload(true);
                            })
                        }
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