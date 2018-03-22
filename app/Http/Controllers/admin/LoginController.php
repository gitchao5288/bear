<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Session;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view('admin.login');
    }




    public function dologin(Request $request){




        $userInput = $request->get('code');

        if (strtolower(Session('milkcaptcha')) != strtolower($userInput)) {
            //用户输入验证码错误
            return redirect('/admins/login')->withErrors('你输入的验证码不正确');
        }

        //接受表单传过来的信息
        $req = $request->except('_token');


        //数据库查询匹配用户信息（没有结果返回NULL）
        $data = AdminUser::where('uname',$req['uname'])->first();

        //如果没有此用户，返回登录页弹窗（请用正确的方式登录）
        if(!$data) {
            return redirect('/admins/login')->withErrors('没有此用户');
        }



        //如果密码错误，返回登录页弹窗（您输入的密码不正确）
        $repass  = $data->password;

        $cry_str = Crypt::decrypt($repass);


        if($req['password'] != $cry_str){

            return redirect('/admins/login')->withErrors('密码错误');
        }


        return redirect('/admins/index');

    }
}
