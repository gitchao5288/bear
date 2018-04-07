<?php

namespace App\Http\Controllers\admin;
use App\Models\AD;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class Adcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function index()
    {
        $data = DB::table('ad')->paginate(1);
        return view('admin.AD',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ADadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取要添加的数据
         $input = $request->except('fileupload','_token');
         $input['atime']=time();

         $res = AD::create($input);

         if($res){

            return 1;
         }else{
            return 0;
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
        //获取数据
        $data = AD::find($id);

        return view('admin.ADedit',compact('data'));
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


//        1. 获取提交的数据
        $input = $request->except('_token','fileupload');


//        2. 根据id找到要修改的广告
        $data = AD::find($id);

//        3. 将广告的属性改成提交过来的值
        $res = $data->update($input);


//        4. 如果修改成功，返回成功信息；失败就返回失败信息
        if($res){
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else{
            $arr = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }

        return $arr;


    }
    //批量删除
    public function delall(Request $request){
         //获取请求参数中的数据

        $ids = $request -> input('ids');


        //删除ids对应的用户
        $res = AD::destroy($ids);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //获取单条数据
        $data = AD::find($id);

        $data->delete();

        return 1;
    }
}
