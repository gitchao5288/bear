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
    <link rel="stylesheet" href="{{asset('admin/index/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('admin/index/css/xadmin.css')}}">
    {{--<link rel="stylesheet" href="{{asset('admin/index/lib/layui/css/layui.css')}}')}}">--}}
    <script type="text/javascript" src="{{asset('admin/index/js/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/index/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('admin/index/js/xadmin.js')}}"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <!--<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>-->
    {{--<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>--}}
    <![endif]-->
</head>

<body>

<div class="x-body">
    <form id="art_form" class="layui-form"  enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>发布人
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" readonly value="{{$good->HomeUser->uname}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
                <input type="hidden" name="gid" value="{{ $good->gid }}">
            </div>
            <div class="layui-form-mid layui-word-aux">不可修改</div>

        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red"></span>分类名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="cate_name" value="{{$good->Cate->cate_name}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>

        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red"></span>商品名称
            </label>
            <div class="layui-input-block">
                <input type="text" id="username" name="gname" value="{{$good->gname}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>

        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red"></span>商品图片
            </label>
            <div class="layui-upload" style="position: relative;">
                <input type="file" id="file_upload" name="file_upload"  style="opacity: 0;position: relative;z-index: 999;">
                <img src="/admin/images/123.png" alt="" style="position:absolute;left: 110px;top: -5px;z-index: 1;">
            </div>

        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red"></span>
            </label>
            <div class="layui-input-block" id="upload">
                <div class="layui-upload-list">
                    <input type="hidden" name="art_thumb" value="{{$good->gpic}}">
                    <img  class="layui-upload-img " id="art_thumb" src="{{$good->gpic}}" id="demo1" style="width:70px;">

                </div>
            </div>

        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red"></span>商品单价
            </label>
            <div class="layui-input-inline">
                <input type="text" id="phone" name="price" value="{{$good->price}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>

        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red"></span>商品描述
            </label>
            <div class="layui-input-block">
                <textarea  name="gdesc" class="layui-textarea">{{$good->gdesc}}</textarea>
            </div>
        </div>


        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red"></span>商品状态
            </label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="上架" {!! $good->status==1 ? 'checked' : '' !!}>
                <input type="radio" name="status" value="2" title="下架" {!! $good->status==2 ? 'checked' : '' !!}>
            </div>

        </div>


        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="edit" lay-submit="">
                修改
            </button>
        </div>
    </form>
</div>

<script>

    // 修改


    $(function () {
        $("#file_upload").change(function () {
            uploadImage();
        })
    });
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
        formData.append('file_upload', $('#file_upload')[0].files[0]);
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/upload",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);

                $('#art_thumb').attr('src',data);
                $("input[name='art_thumb']").val(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("上传失败，请检查网络后重试");
            }
        });
    }

    // 文件上传js效果
    // $(function(){
    //     $('#upload').Huploadify({
    //         auto:true,
    //         fileTypeExts:'*.wmv;*.jpg;*.png;*.exe',
    //         multi:true,
    //         formData:{key:123456,key2:'vvvv'},
    //         fileSizeLimit:9999999999999,
    //         showUploadedPercent:true,//是否实时显示上传的百分比，如20%
    //         showUploadedSize:true,
    //         removeTimeout:9999999,
    //         uploader:'/uploads/up/upload.php',
    //         onUploadStart:function(){
    //             //alert('开始上传');
    //         },
    //         onInit:function(){
    //             //alert('初始化');
    //         },
    //         onUploadComplete:function(){
    //             //alert('上传完成');
    //         },
    //         onDelete:function(file){
    //             console.log('删除的文件：'+file);
    //             console.log(file);
    //         }
    //     });
    // });


    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;

        //监听提交
        form.on('submit(edit)', function(data){

            //获取当前要修改的用户的id
            var uid = $("input[type='hidden']").val();
            // console.log(uid);
            $.ajax({
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admins/Good/"+uid,
                data: data.field,
                dataType: "json",
                success: function(data){
                    // console.log(data);
                    // 如果添加成功
                    if(data.status == 0){
                        layer.alert(data.msg,{icon:6,time:3000},function(){
                            //关闭弹层，刷新父页面

                        })
                        parent.location.reload(true);
                    }else{
                        layer.alert(data.msg,{icon:6,time:3000},function(){
                            //关闭弹层，刷新父页面

                        })
                        parent.location.reload(true);
                    }
                }
            });

            return false;
        });


        //监听提交
        // form.on('submit(edit)', function(data){
        //
        //     //ajax处理添加
        //     $.post('/admins/goods/update',data.field,function(data){
        //         console.log(data);
        //         if(data.status==1){
        //             layer.alert(data.msg, {icon: 6},function () {
        //                 // 获得frame索引
        //                 var index = parent.layer.getFrameIndex(window.name);
        //                 //关闭当前frame
        //                 parent.layer.close(index);
        //                 parent.location.reload(true);
        //             });
        //         } else {
        //             layer.alert(data.msg, {icon: 5},function () {
        //                 // 获得frame索引
        //                 var index = parent.layer.getFrameIndex(window.name);
        //                 //关闭当前frame
        //                 parent.layer.close(index);
        //
        //             });
        //         }
        //     });
        //
        //
        //
        //     // console.log(data);
        //     //发异步，把数据提交给php
        //
        //     return false;
        // });


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