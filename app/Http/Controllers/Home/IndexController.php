<?php



namespace App\Http\Controllers\Home;

use App\Models\AD;
use App\Models\AdminRotation;
use App\Model\HomeUser;
use App\Models\Address;

use App\Models\Goods;
use App\Models\ORDER;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Cate;


use App\Models\ORDERDETAIL;

class IndexController extends Controller
{

    //前台首页
    public function index(){
        //轮播图
    	$Res = AdminRotation::get();

        //查询所有类别数据
        $Cate = Cate::get();
        $arr = [];
        $fc = Cate::where('pid',0)->get();
        $firstCate = Cate::where('pid',0)->get()->toArray();
        foreach($firstCate as $v){

            $arr[]= Cate::where('pid',$v['id'])->first()->id;
        }
        $brr = [];
        foreach($arr as $v){
            $brr[] = Cate::where('pid',$v)->first()->id;
        }
        $goods = [];
        foreach($brr as $v){
            $goods[] = Goods::where('cid',$v)->where('status','1')->get()->toArray();
        }
//        dd($goods);
        //广告
        $data = AD::where('astatus','1')->first();


    	return view('/home/index',['Res'=>$Res,'Cate'=>$Cate,'goods'=>$goods,'firstCate'=>$fc,'data'=>$data]);
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


    //点击条件查询方法展示列表页
    public function clickSearch(Request $request,$id)
    {
        $goods = Goods::where('cid',$id)->where('status','1')->paginate(12);
//        $goods = Goods::where('cid',$id)->get();
//        dd($goods);

        return view('home.search',compact('goods','request'));


    }

    //搜索条件查询方法展示列表页
    public function searchCriteria(Request $request)
    {
        $goods = Goods::where('gname','like','%'.$request->gname.'%')->paginate(12);

        return view('home.search',compact('goods','request'));
    }


    //购物车页面
    public function shopCart()
    {

//        $shopcart = session('shopcart');

//        return view('home.shopcart',compact('shopcart'));
    }


    //商品详情
    public function goodDetails($id)
    {   
        $data = Goods::where('gid',$id)->first();
       
        return view('home.goodDetails',compact('data','id'));
    }
    //加入购物车
    public function storecart(Request $request)
    {   
        $data = $request->except('_token');
        $arr = [];
        $arr['gid'] = $data->gid;
        $arr['uid'] = $data->uid;
        $arr['gname'] = $data->gname;
        $arr['cid'] = $data->cid;
        $arr['gpic'] = $data->gpic;
        $arr['gdesc'] = $data->gdesc;
        

        session()->push('shopcart',$arr);
        dd($arr);
        // return view('home.shopcart');   
    }
    
    //地址联动
    public function Achange(Request $request)
    {
        $Adata=Address::where('addid',$request->id)->first();
        return $Adata;
    }

    //确认订单页面
    public function pay($id)
    { 
        $data = Goods::where('gid',$id)->first();
        $udata = Address::where('uid',session('user')->uid)->get();
        $default = Address::where('uid',session('user')->uid)->where('default','1')->first();
        return view('home.pay',compact('data','udata','default'));
    }
    //提交订单页面
    public function success(Request $request)
    {
        $gid = $request->gid;
        //修改商品为已经售出状态  状态码 3
        $goods = Goods::find($gid);
        if($goods->status==3){
            header('refresh:2;url="/"');
            die('宝贝已经售出，请浏览其他宝贝！');

        }

        $goods->status = '3';
        $goods->save();



        // dd($request->ormb);
        //生成订单号

        $oid = time().rand('1111','9999');
        $ormb = $request->ormb;
        $otime = time();
        $bid = session('user')->uid;

        $bmsg = $request->bmsg;
        $sids = Goods::where('gid',$gid)->first();
        $sid = $sids->uid;
        $add = Address::find($request->addid);


        $order = new ORDER();
        $order->oid = $oid;
        $order->ormb = $ormb;
        $order->otime = $otime;
        $order->bid = $bid;
        $order->gid = $gid;
        $order->save();

        $orderdetail = new ORDERDETAIL();
        $orderdetail->oid = $oid;
        $orderdetail->gid = $gid;
        $orderdetail->bmsg = $bmsg;
        $orderdetail->addid = $request->addid;
        $orderdetail->bid = $bid;
        $orderdetail->sid = $sid;
        $orderdetail->save();





         return view('home.success',compact('add','ormb'));
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
        $user->face = $request->gpic;

        $res = $user->save();


        if($res){

            $arr= [
                'status'=>1,
                'msg'=>'保存成功'
            ];
            $ses = HomeUser::where('uname',session('user')->uname)->first();
            session()->put('user',$ses);
        }else{

            $arr= [
                'status'=>0,
                'msg'=>'保存失败'
            ];


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

        $id = session('user')->uid;
        $orders = ORDER::where('bid',$id)->where('display','1')->get();

        $goods = [];
        foreach($orders as $k=>$v){
            $goods[$k] = Goods::where('gid',$v->gid)->first();
        }
//        dd($goods);

        return view('home.order',compact('orders','goods'));
    }

    //前台删除订单
    public function orderDisplay(Request $request)
    {
        $oid = $request->oid;
        $order = ORDER::where('id',$oid)->first();

        $order->display = '0';
        $res = $order->save();
        if($res){
            return 1;
        }

    }

    //我的发布页面
    public function publish()
    {

        //获取本用户发布的商品
        $goods = Goods::where('uid',session('user')->uid)->get();

        return view('home.publish',compact('goods'));
    }

    //我的发布商品详情
    public function mygoodDetail($gid)
    {
        $goods = Goods::find($gid);
        $cid = $goods->cid;
        $cate = Cate::find($cid);
        //三级分类名称
        $thirdCate = $cate->cate_name;
        //二级分类名称
        $second = Cate::find($cate->pid);
        $secondCate = $second->cate_name;
        //一级分类名称
        $first = Cate::find($second->pid);
        $firstCate = $first->cate_name;


        return view('home.mygoodDetail',compact('goods','firstCate','secondCate','thirdCate'));
        //return view('home.order');
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
