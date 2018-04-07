<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OSS;

class UploadController extends Controller
{
    // 文件上传
    public function upload(Request $request)
    {
        $file = $request->file('file_upload');
//        return $file;
//        如果上传文件有效
        if ( $file->isValid() ) {
//            return $file;
            $ext = $file->getClientOriginalExtension();    //文件拓展名
            $newfile = date('YmdHis').rand(11111,99999).'-'.uniqid().'.'.$ext;  //新文件名

            // 1. 将文件上传到本地服务器
            //将文件从临时目录移动到指定目录
            // $path = $file->move(public_path().'/uploads/goods',$newfile);

            // 2. 将文件上传到 alioss 存储
            $oldfile = $file->getRealPath();
            $row = OSS::upload($newfile,$oldfile);

            $path = env('ALIOSS_DOMAIN');
            // 将上传文件的新路径返回给客户端
            // return '/uploads/goods/'.$newfile;
            return $path.'/'.$newfile;

        }


    }


}
