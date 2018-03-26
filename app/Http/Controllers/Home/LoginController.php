<?php

namespace App\Http\Controllers\Home;

use App\MyClass\PhoneCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Mail;
use DB;
use Naux\Mail\SendCloudTemplate;

use App\Model;



class LoginController extends Controller
{

    // 注册  ========================================
    public function index()
    {
//      显示注册页面
        return view('home.login.index');

    }

    // 表单传过来数据
    public function doreg(Request $request)
    {

        // 除去_token -> 获取用户信息
        $data = $request->except('_token');
//        $uname = $request->old('uname');


        $name = $data['uname'];
        $pass = $data['password'];
        $repass = $data['repassword'];
        $email = !empty($data['email']) ? $data['email'] : '';
        $phone = !empty($data['phone']) ? $data['phone'] : '';

        if (empty($name) || empty($pass)) {
            flash('必填项不能为空')->error();
            return redirect('/home/login/index');
        }


//        判断是邮箱注册还是手机号注册
//        邮箱注册
        if (!empty($data['email'])) {
            if (empty($email)) {
                flash('请输入邮箱')->error();
                return redirect('/home/login/index');
            }

//      邮箱注册给一个随机数
            $rand = $data['rand'] = str_random(50);
//            dd($data);


            $user = '';
            $user_email = '';
            $user = Model\HomeUser::where('uname', $name)->first();
            $user_email = Model\HomeUser::where('email', $email)->first();


            if ($user && $name == $user->uname) {

                flash('此用户名已被注册')->error();
                return redirect('/home/login/index');
            }

            if ($user_email && $email == $user_email->email) {
                flash('此邮箱已被注册')->error();
                return redirect('/home/login/index');
            }

            if ($pass !== $repass) {
                flash('两次密码输入不一致')->error();
                return redirect('/home/login/index');
            }

//            销毁确认密码
            unset($repass);

            $res = new Model\HomeUser;
            $res->uname = $name;
            $res->email = $email;
            $res->password = Crypt::encrypt($pass);
            $res->rand = $rand;

            $res->maketime = time();


//            添加到数据库
            $rows = $res->save();
//            dd($res);

            // 发送邮件 携带随机数($rand)
            $bind_data = [
                'url' => route('log', ['token' => $rand]),
                'name' => $name,
            ];
            $template = new SendCloudTemplate('test_template_active', $bind_data);

            Mail::raw($template, function ($message) use ($data) {
                $message->from('determined_xw@126.com', '懒熊 提醒您');
                $message->to($data['email']);
            });


//            判断邮件是否发送成功
            if ($rows) {
//              成功跳转登录页面
                return redirect('/home/login/email');
            } else {
//            失败跳转原页面
                return redirect('/home/login/index');

            }

        }

//      手机号注册
        if (!empty($data['phone'])) {

//        1. 对提交的数据进行验证 (Validater)

            $rule = [
                'phone' => 'required|digits:11|numeric',
                'code' => 'required',
                'uname' => 'required|between:2,16',
                'password' => 'required|between:6,10',
                'repassword' => 'required|same:password'

            ];

            $msg = [
                'phone.required' => '手机号不能为空',
                'phone.digits' => '手机号为11位',
                'phone.numeric' => '手机号必须为数字',
                'code.required' => '验证码不能为空',
                'uname.required' => '用户名不能为空',
                'uname.between' => '用户名必须在2-16位之间',
                'password.required' => '密码不能为空',
                'password.between' => '密码必须在6-10位之间',
                'repassword.required' => '确认密码不能为空',
                'repassword.same' => '两次密码输入不一致'
            ];

            $validator = Validator::make($data, $rule, $msg);

//         2. 如果验证失败
            if ($validator->fails()) {
                return redirect('home/login/index')
                    ->withErrors($validator)
                    ->withInput();
            }


//         3. 判断是否有此用户
            $user_name = Model\HomeUser::where('uname', $data['uname'])->first();
            if ($user_name) {
                return redirect('home/login/index')->with('errors', '该用户名已被注册');
            }

//          4. 判断手机号是否被注册
            $user_phone = Model\HomeUser::where('phone', $data['phone'])->first();
            if ($user_phone) {
                return redirect('home/login/index')->with('errors', '此手机号已被注册');
            }
//            dd($data);

//           5. 销毁确认密码
            unset($repass);

            $res = new Model\HomeUser;
            $res->uname = $name;
            $res->phone = $phone;
            $res->password = Crypt::encrypt($pass);
            $res->rand = $data['rand'] = str_random(50);
            $res->maketime = time();

//            添加到数据库
            $row = $res->save();

//            判断是否注册成功
            if ($row) {
//              成功跳转登录页面
                return redirect('/home/login/phone');
            }
//            失败跳转原页面
            return redirect('/home/login/index');

        }
    }


//    手机验证码
    public function yzm(Request $request)
    {

        //初始化必填
        $options['accountsid']='d06c149ab0d5ed7503cc76233e3c1275';
        $options['token']='faf058f4d5636129763ac1c6c232bd73';


        //初始化 $options必填
        $ucpass = new PhoneCode($options);

        //开发者账号信息查询默认为json或xml

        $ucpass->getDevinfo('xml');

        $code = rand(111111,999999);

//        $toNumber = $_POST['number'];
        $roNumber = $request->number;

//        $_SESSION['code'] = $code;
        session()->put('code',$code);

        $appId = "68054d38f4bd458f95ad87c0dd2363e0";
        $templateId = "297138";
        $param=$code;

        $ucpass->templateSMS($appId,$roNumber,$templateId,$param);

        return $code;

    }

//    邮件发送成功跳转页面
    public function email(){

        return view('home.login.email');

    }

    //    短信发送成功跳转页面
    public function phone(){

        return view('home.login.phone');

    }

//    点击邮件链接跳转
    public function log($rand)
    {
        $res= DB::table('homeuser')->where('rand',$rand)->first();

        if (!$res) {
            return redirect()->route('/home/login/index');
        }
        $row = DB::table('homeuser')
            ->where('uid',$res->uid)
            ->update(['status'=>'1']);

        return redirect('/home/login/login');
    }

//    登录 ============================================
    public function login()
    {
//        显示登录页
        return view('home.login.login');
    }


}

