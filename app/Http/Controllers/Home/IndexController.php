<?php



namespace App\Http\Controllers\Home;

use App\Models\AdminRotation;
use App\Model\HomeUser;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Cate;
class IndexController extends Controller
{

    //前台首页
    public function index(){
        //轮播图
    	$Res = AdminRotation::get();

        //查询所有类别数据
        $Cate = Cate::get();


    	return view('/home/index',['Res'=>$Res,'Cate'=>$Cate]);
    }
    //定义一个子树方法 (全部信息,id,标记)
    public function subtree($arr,$id=0,$lev=1)
    {
        //定义一个空数组把值放进去
        $subs=[];
        foreach($arr as $v){
            //判断如果值的父ID等于ID
            if($v['pid']==$id){
                //给相同值添加一个下标相同lev标记
                $v['lev']=$lev;
                //把值放入数组
                $subs[]=$v;
                //合并数组递归合并,调用自身子树方法(数据,值的ID,标记遍历一次就加一)
                $subs = array_merge($subs,$this->subtree($arr,$v['id'],$lev+1));
            }
        }
        return $subs;
    }


/*    //商品列表页
    public function search()
    {
        return view('home.search');
    }*/

    //商品详情
    public function goodDetails()
    {
        return view('home.goodDetails');
    }

    public function center()
    {
        return view('home.center');
    }

    //个人信息页面
    public function information()
    {
        return view('home.information');
    }
    //修改个人信息
    public function infoupdate(Request $request)
    {
        $arr = [];
        //修改数据库个人信息
        $user = HomeUser::where('uname',session('user')->uname)->first();

        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->sex = $request->sex;
        $user->age = $request->age;
        $res = $user->save();
        if($res){
            $arr['status'] = 1;
            $arr['msg'] = '修改成功';
            $ses = HomeUser::where('uname',session('user')->uname)->first();
            session()->put('user',$ses);
        }else{
            $arr['status'] = 0;
            $arr['msg'] = '修改失败';


        }
        return $arr;
    }

    //安全设置页面    账号安全
    public function safety()
    {
        return view('home.safety');
    }

    //收货地址页面
    public function address()
    {
        //查询地址表内用户的地址信息
        $add = Address::where('uid',session('user')->uid)->orderBy('default','desc')->get();

        return view('home.address',compact('add'));
    }

    //添加收货地址
    public function doaddress(Request $request)
    {
        $arr = [];
        $add = $request->except('_token');


        $address = new Address();
        $address->uid = session('user')->uid;
        $address->add = $add['add'];
        $address->phone = $add['phone'];
        $address->addname = $add['addname'];
        $res = $address->save();
        if($address){
            $arr['status'] = 1;
            $arr['msg'] = '添加地址成功！';
        }else{
            $arr['status'] = 0;
            $arr['msg'] = '添加地址失败！';
        }

        return $arr;
    }

    //设为默认收货地址
    public function dodefault(Request $request)
    {

        Address::where('uid',session('user')->uid)
            ->update(['default'=>'0']);
        $default = Address::find($request->addid);
        $default->default = '1';
        $res = $default->save();

        /*$dodefault = Address::find($request->id);
        $dodefault->*/
        return $request->except('_token');
    }

    //删除地址
    public function deladd()
    {
        return 1;
    }

    //订单管理
    public function order()
    {
        return view('home.order');
    }
    //退款售后
    public function change()
    {
        return view('home.change');
    }

    //我的收藏页面
    public function collection()
    {
        return view('home.collection');
    }

//    return view('home.index');

}
