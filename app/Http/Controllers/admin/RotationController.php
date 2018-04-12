<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminRotation;
class RotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function statusup(Request $request)
    {
        // 轮播图id
        $rid = $request->input('id');
        //轮播图的状态
        $status =  ($request->input('status') == 1) ? '0' : '1';

        //修改状态
//        return $status;
//        $goods = Goods::find($uid);

        $ress = AdminRotation::find($rid);
        $ress->rstatus = $status;
        $res = $ress->save();
//        ->update(['rstatus'=>$status]);
//return $res;

        if($res){
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status'=>1,
                'msg'=>'修改成功'
            ];
        }else{
            $arr = [
                'status'=>0,
                'msg'=>'修改失败'
            ];
        }

        return $arr;
    }
    
    public function upload(Request $request)
    {
        $file = $request->file('fileupload');
        // dd ($file);
        //如果是有效的上传文件
        if($file->isValid()){
            //获取原文件的文件类型
            $ext = $file->getClientOriginalExtension();
            //文件扩展名 生成新文件名
            $newfile = md5(date('YmdHis').rand(1000,9999).uniqid()).'.'.$ext;
            //移动路径
            $path = $file->move(public_path().'/admin/upload',$newfile);
        }
        return $newfile;
    }


    public function index(Request $request)
    {
        //
        $AdminRotation = AdminRotation::orderBy('rid','asc')->where(function($query) use($request){

            //检测关键字
            $rname = $request->input('rname');
            //如果图片关键字不为空
            if (!empty($rname)) {
                $query->where('rname','like','%'.$rname.'%');
            }
        })->paginate(4);

        return view('admin.RC',['data'=>$AdminRotation,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.RCadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $input = $request->except('fileupload');
       // return($input);
       $res = AdminRotation::create($input);

       if($res){
           return 0;
       }else{
           return 1; 
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = AdminRotation::find($id);
        return view('admin.RCedit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        //
        // echo 1111;
         $data = AdminRotation::find($id);
         // return $data;
         // var_dump($data);

                    $data->rname = $request->rname;
                    $data->link = $request->link;
                    $data->rdes = $request->rdes;


                    $data->feilname = $request->feilname;

                    $data->rstatus = $request->rstatus;
                  $res = $data->save();
                  if($res){
                    return 1;
                  }else{

                    return 0;
                  }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $AdminRotation = AdminRotation::find($id);
        $res = $AdminRotation->delete();
        if($res){
        // json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $arr = [
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }

        return $arr;

    }

    public function delall(Request $request)
    {
        //获取请求参数中，要删除的用户的id
        $ids = $request->input('ids');
       // return $ids;
//        删除ids里存储的用户的id对应的用户
        $res = AdminRotation::destroy($ids);
        // return $res;
        if($res){
            $data = [
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }


        return $data;

    }
}
