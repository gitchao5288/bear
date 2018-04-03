<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\HomeUser;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

use Mail;
use DB;
use Naux\Mail\SendCloudTemplate;
use App\MyClass\PhoneCode;

class GetpassController extends Controller
{
    //    忘记密码
    public function forget()
    {
        return view('home.getpass.forget');
    }

//    邮箱找回密码 *******************************
    public function emailpass()
    {
        return view('home.getpass.emailpass');
    }
//    验证身份   发送找回邮件
    public function emailget(Request $request)
    {
        // 获取数据
        $data = $request->except('_token');
//        dd($data);
//        查数据库
        $user = HomeUser::where('email',$data['email'])->first();


        if ( $user && $user['status'] == 1 ) {
            $name = $user['uname'];
//      邮箱注册给一个随机数
//          更新随机数
            $user->rand = str_random(50);
            $user->save();
            $rand = $user['rand'];

//            发送邮件
            $bind_data = [
                'url' => route('epass', ['token' => $rand]),
                'name' => $name,
            ];
//                                                填写邮箱模板
            $template = new SendCloudTemplate('bear_template_repass', $bind_data);
            Mail::raw($template, function ($message) use ($data) {
                $message->from('determined_xw@126.com', '懒熊宝宝 提醒您');
                $message->to($data['email']);
            });
            flash('找回邮件已发送至您的邮箱')->important();
            return redirect('/home/getpass/emailpass');
        } else {

            flash('邮箱未激活,请先激活')->error();
            return redirect('/home/login/index');
        }

    }

    //    点击邮件链接跳转
    public function epass($rand)
    {
        $res= DB::table('homeuser')->where('rand',$rand)->first();

        if ( $res ) {
            return redirect()->route('erepass',['rand'=>$rand]);
        } else {

            flash('找回失败')->error();
            return redirect()->route('/home/getpass/emailpass');
        }

    }
//    重置密码页面
    public function erepass($rand)
    {
//        dd($rand);

        return view('home.getpass.erepass',compact('rand'));
    }

    public function eget(Request $request)
    {
//        接收数据

        $input = $request->except('_token');

        $pass = Crypt::encrypt($input['password']);
        $rand = $input['rand'];

//         dd($pass);
//        验证
        $rule = [
            'rand'=>'required',
            'password'=>'required|between:6,10',
            'repassword' => 'required|same:password'
        ];
        $msg = [
            'password.required' => '密码不能为空',
            'password.between' => '密码必须在6-10位之间',
            'repassword.required' => '两次密码输入不一致',
            'repassword.same' => '两次密码输入不一致'
        ];

        $validator = Validator::make($input, $rule, $msg);

//         2. 如果验证失败
        if ($validator->fails()) {
            return redirect()->route('erepass',compact('rand'))
                ->withErrors($validator)
                ->withInput();
        }
//        3. 销毁确认密码
        $repass = $input['repassword'];
        unset($repass);



//        修改密码
        $row = HomeUser::where('rand',$rand)
                        ->update(['password'=>$pass]);

//        dd($row);
//        判断是否修改成功
        if ( $row ) {
            return redirect('home/getpass/emaildone');
        }
//        否则跳转回原页面
        flash('重置密码失败')->error();
        return redirect('/home/getpass/erepass');

    }
//    邮箱重置密码成功
    public function emaildone()
    {
        return view('home.getpass.emaildone');
    }


//    手机号找回密码 ********************************
    public function phonepass()
    {
        return view('home.getpass.phonepass');
    }

    //    验证身份   发送验证码
    public function phoneget(Request $request)
    {
        $data = $request->except('_token');
//        dd($data);
        $pass = $data['password'];
        $repass = $data['repassword'];

//        1. 对提交的数据进行验证 (Validater)
        $rule = [
            'phone' => 'required|digits:11|numeric',
            'code' => 'required',
            'password' => 'required|between:6,10',
            'repassword' => 'required|same:password'
        ];

        $msg = [
            'phone.required' => '手机号不能为空',
            'phone.digits' => '手机号为11位',
            'phone.numeric' => '手机号必须为数字',
            'code.required' => '验证码不能为空',
            'password.required' => '密码不能为空',
            'password.between' => '密码必须在6-10位之间',
            'repassword.required' => '两次密码输入不一致',
            'repassword.same' => '两次密码输入不一致'
        ];

        $validator = Validator::make($data, $rule, $msg);

//         2. 如果验证失败
        if ($validator->fails()) {
            return redirect('home/getpass/phonepass')
                ->withErrors($validator)
                ->withInput();
        }
//         3. 判断是否有此用户
        $user = HomeUser::where('phone', $data['phone'])->first();
        if (!$user) {
            return redirect('home/getpass/phonepass')->with('errors', '该手机号未注册');
        }
//         5. 销毁确认密码
        unset($repass);

        $phone = $data['phone'];
        $pass = Crypt::encrypt($pass);

//        修改密码
        $row = HomeUser::where('phone',$phone)
                ->update(['password'=>$pass]);

//        判断是否修改成功
        if ( $row ) {
            return redirect('home/getpass/phonedone');
        }
//        否则跳转回原页面
        flash('重置密码失败')->error();
        return redirect('/home/getpass/phonepass');

    }

    //    邮箱重置密码成功
    public function phonedone()
    {
        return view('home.getpass.phonedone');
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
        $templateId = "299390";
        $param=$code;

        $ucpass->templateSMS($appId,$roNumber,$templateId,$param);
//        dd(session()->get('code'));
        return $code;

    }





}
