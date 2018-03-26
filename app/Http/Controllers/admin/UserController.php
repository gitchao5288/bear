<?php

namespace App\Http\Controllers\admin;

use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        //获取数据库所有用户数据
//        $data = AdminUser::paginate(2);




//         return view('admin.User',['data'=>$data]);

         //分页切单个条件搜索
//        where(function($query) use($request){
//            //检测关键字
//            $username = $request->input('keywords1');
//            $email = $request->input('keywords2');
//            //如果用户名不为空
//            if(!empty($username)) {
//                $query->where('user_name','like','%'.$username.'%');
//            }
//            //如果邮箱不为空
//            if(!empty($email)) {
//                $query->where('email','like','%'.$email.'%');
//            }
//        })

        //条件查询
        $uname = $request->input('uname');

         $data = AdminUser::orderBy('uid','asc')

             ->where('uname','like','%'.$request->uname.'%')
             ->paginate(1);

          return view('admin.User',['data'=>$data,'uname'=>$uname]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Useradd');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.接收用户提交的添加信息


            $test = AdminUser::where('uname',$request->uname)->first();
            if($test){

            }else{


                $password = Crypt::encrypt($request->password);


                $data = new AdminUser;
                $data->uname = $request->uname;
                $data->password = $password;
                $data->phone = $request->phone;
                $data->sex = $request->sex;
                $data->auth = $request->auth;

                $res = $data->save();
                if(!$res){

                }else{
                    return 1;
                }
            }

        //2.表单验证 检查此用户是否重复



        //3.将数据添加到数据库

        //4.根据添加是否成功,进行页面跳转


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
        return view('admin.Useredit');
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
    }
}
