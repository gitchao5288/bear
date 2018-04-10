<?php

namespace App\Http\Controllers\Admin;

use App\Model\HomeUser;
use App\Models\Cate;

use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//use Illuminate\Support\Facades\Validator;
use App\Models\Goods;

class GoodsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取商品数据
//        $goods = Goods::with('Goodsdetail')->paginate(3);

//        1.获得数据(第一种方法)
//        $goods = Goods::with('HomeUser','Cate')->paginate(2);
//        dd($goods);

//        return view('admin.goods.good',compact('goods'));

//        2.第二种方法(带搜索条件)
//        \DB::connection()->enableQueryLog();
//        $count = Goods::verified()->count();

//        统计审核通过的数量
        $count = count(Goods::all()->where('status','!=','0'));

        $catename = $request->input('keywords1');
//        dd($catename);
        if(!empty($catename)){
            $cateid = Cate::where('cate_name','like','%'.$catename.'%')->pluck('id')->all();
        }else{
            $cateid =0;
        }
//        dd($cateid);

        $gname = $request->input('keywords2');

        $goods = Goods::with(['Cate','HomeUser'])
            ->where(function($query){
                $query->where('status','!=','0');

            })
           ->where(function($query) use($cateid){
                    if($cateid != 0){
                        $query->whereIn('cid',$cateid);
                    }

            })
            ->where(function($query) use($gname){
                if(!empty($gname)){
                    $query->where('gname','like','%'.$gname.'%');
                }
            })

//            分页
            ->paginate($request->input('num', 2));
//        $count = count($goods);

//        打印sql语句
//        $sql = \DB::connection()->getQueryLog();
//        \DB::connection()->disableQueryLog();
//        dd($sql);
//        dd($goods);
        return view('admin.goods.good',['goods'=>$goods, 'request'=> $request,'count'=>$count]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($gid)
    {
//        $goods = Goods::find($gid);

        $good = Goods::with('Cate','HomeUser')
            ->where('gid',$gid)->first();


        //查询所有类别
        $cate = Cate::get();
        $tree = Cate::subtree($cate);

//        $threeid = $good->cate->id;
//        分类名字
        $three_name = $good->cate->cate_name;

//        二级分类id
        $twoid = $good->cate->pid;
        $two = Cate::where('id',$twoid)->first();
//        二级分类名字
        $two_name = $two->cate_name;

        $one = Cate::where('id',$two->pid)->first();
        $one_id = $one->id;
//        dd($good);


//        dd($good->cate->id);

        return view('admin.goods.goodsedit',compact('good','tree','one_id','two_name','three_name'));
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
        // 获取提交的数据
        $data = $request->all();
//        return $data['cname'];



//        根据类名找id并修改商品的cid
        $cate = Cate::where('cate_name',$data['cname'])->first();

//        修改商品信息
        $row_goods = Goods::where('gid',$id)
                ->update(['gname'=>$data['gname'],
                        'cid'=>$cate->id,
                        'gpic'=>$data['thumb'],
                        'price'=>$data['price'],
                        'gdesc'=>$data['gdesc'],
                        'status'=>$data['status'],
                    ]);

//        return $cate;
        if ( $row_goods ) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $good = Goods::find($id);

        $res = $good->delete();
        if($res){
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
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
//        return $ids;
//        删除ids里存储的用户的id对应的用户
        $res = Goods::destroy($ids);

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

//    上架下架
    public function changestatus(Request $request)
    {
//        return $request;
        // 商品id
        $gid = $request->input('id');
        //用户的状态
        $status =  ($request->input('status') == 1) ? 2 : 1;

        //修改状态
//        return $status;
//        $goods = Goods::find($uid);
        $res = Goods::where('gid',$gid) ->update(['status'=>$status]);
//return $res;
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

//    待审核
    public function stating(Request $request)
    {
//        统计审核通过的数量
        $count = count(Goods::all()->where('status','==','0'));

        $catename = $request->input('keywords1');
//        dd($catename);
        if(!empty($catename)){
            $cateid = Cate::where('cate_name','like','%'.$catename.'%')->pluck('id')->all();
        }else{
            $cateid =0;
        }
//        dd($cateid);

        $gname = $request->input('keywords2');

        $goods = Goods::with(['Cate','HomeUser'])
            ->where(function($query){
                $query->where('status','=','0');

            })
            ->where(function($query) use($cateid){
                if($cateid != 0){
                    $query->whereIn('cid',$cateid);
                }

            })
            ->where(function($query) use($gname){
                if(!empty($gname)){
                    $query->where('gname','like','%'.$gname.'%');
                }
            })

//            分页
            ->paginate($request->input('num', 2));
//        dd($goods);

        return view('admin.goods.stating',['goods'=>$goods, 'request'=> $request,'count'=>$count]);
    }
//    上架下架
    public function state(Request $request)
    {
       // return $request;
        // 商品id
        $gid = $request->input('id');
        //用户的状态
        // $status =  ($request->input('status') == 0) ? 1 : 0;

        //修改状态
        //        return $status;
        //        $goods = Goods::find($uid);
        $res = Goods::where('gid',$gid) ->update(['status'=>1]);
//        return $res;
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

    // 类别联动  二级类 ***************************************************
    public function two(Request $request)
    {
        $gid = $request->input('gid');
        //查询所有类别
//         return $gid;

        $two = Cate::where('pid',$gid)->get();

        return $two;
    }

    // 三级类
    public function three(Request $request)
    {
        $gid = $request->input('gid');
        //查询所有类别
        // return $gid;

        $three = Cate::where('pid',$gid)->get();

        return $three;
    }



}
