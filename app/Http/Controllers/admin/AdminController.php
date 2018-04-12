<?php

namespace App\Http\Controllers\admin;

use App\Models\AdminUser;
use App\Models\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use App\Models\Goods;


class AdminController extends Controller
{
   //首页
   public function index(){

      // 统计审核通过的数量
      $count = count(Goods::all()->where('status','==','0'));

      return view('admin.index',compact('count'));

   }
   public function wel(){
      return view('welcome');
   }


   //前台用户浏览
   //  public function Huser(){
   //    return view('admin.Huser');
   // }
   /* public function Huseradd(){
      return view('admin.Huseradd');
    }
    public function Huseredit(){
      return view('admin.Huseredit');
    }*/


   //后台用户浏览
   public function Auser(){

      return view('admin.Auser');
   }
   //后台用户添加
   public function Useradd(){
      return view('admin.Useradd');
   }
   //后台用户修改
   public function Useredit(){
      return view('admin.Useredit');
   }


   //类别管理
   public function Cate(){



       $a = Cate::get();
        $arr = [];
       foreach($a as $v){


           $arr[] = $v;

       }
//       dd($arr[0]['pid']);




       function subtree($arr,$id=0,$lev=1)
       {
           $subs=[];
           foreach($arr as $v){
               if($v['pid']==$id){
                   $v['lev']=$lev;
                   $subs[]=$v;
                   $subs = array_merge($subs,subtree($arr,$v['id'],$lev+1));
               }
           }
           return $subs;
       }
       $res = subtree($arr);
       $arrs = [];
       foreach($res as $k=>$v){
           $arrs[$k]['id'] = $v['id'];
           $arrs[$k]['cate_name'] = $v['cate_name'];
           $arrs[$k]['pid'] = $v['pid'];
           $arrs[$k]['lev'] = $v['lev'];
       }

       //分页实现：
       $currentPage = LengthAwarePaginator::resolveCurrentPage();

       $collection = new Collection($arrs);
       $perPage = 10;
       $currentPageSearchResults = $collection->slice(($currentPage-1) * $perPage, $perPage)->all();
       $paginatedSearchResults = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
       $paginatedSearchResults = $paginatedSearchResults->setPath('/admins/Cate');

      return view('admin.Cate',['arrs'=>$paginatedSearchResults,'countarr'=>$arrs]);
   }


   //增加一级类别
    public function CateAddFirst()
    {
        return view('admin.CateAddFirst');
    }

    public function CateDoAddFirst(Request $request)
    {   $arr = [];
        $s = Cate::where('cate_name',$request->cate_name)->get();

        if($s->count()!=0){
            $arr['status'] = 0;
            $arr['msg'] = '该分类已存在！';
            return $arr;
        }



        $cate = new Cate;

        $cate->pid = 0;
        $cate->cate_name = $request->cate_name;
        $res  = $cate->save();

        if($res){
            $arr['status'] = 1;
            $arr['msg'] = '添加成功';
        }else{
            $arr['status'] = 0;
            $arr['msg'] = '添加失败';
        }
        return $arr;

    }

   //增加子类页面
    public function CateAdd($id)
    {

        $res = Cate::find($id);



        return view('admin.CateAdd',compact('res'));
    }



    //处理类别增加
    public function CatedoAdd(Request $request)
    {

        $arr = [];
        $s = Cate::where('cate_name',$request->cate_name)->get();

        if($s->count()!=0){
            $arr['status'] = 0;
            $arr['msg'] = '该分类已存在！';
            return $arr;
        }

        $cate = new Cate;

        $cate->pid = $request->pid;
        $cate->cate_name = $request->cate_name;
        $res  = $cate->save();

        if($res){
            $arr['status'] = 1;
            $arr['msg'] = '添加成功';
        }else{
            $arr['status'] = 0;
            $arr['msg'] = '添加失败';
        }
        return $arr;
    }


    //类别修改页面
    public function CateEdit($id)
    {
        $data = Cate::find($id);

        return view('admin.CateEdit',compact('data'));
    }

    //执行修改方法
    public function CateUpdate(Request $request)
    {
        $arr = [];
        $rea = Cate::where('cate_name',$request->cate_name)->get();

        if($rea->count()!=0){
            $arr['status'] = 0;
            $arr['msg'] = '该类别已经存在';
            return $arr;
        }
        $a = Cate::find($request->id);
        $a->cate_name = $request->cate_name;
        $res = $a->save();

        if($res){
            $arr['status'] = 1;
            $arr['msg'] = '修改成功';
            return $arr;
        }else{
            $arr['status'] = 0;
            $arr['msg'] = '修改失败';
            return $arr;
        }
    }


    //类别删除
    public function CateDel(Request $request)
    {
        $data = Cate::where('pid',$request->id)->get();
        $arr = [];
        if($data->count()==0){
            $res = Cate::find($request->id)->delete();
            if($res){
                $arr['status'] = 1;
                $arr['msg'] = '删除成功';
            }else{
                $arr['status'] = 0;
                $arr['msg'] = '删除失败';
            }
        }else{
            $arr['status'] = 0;
            $arr['msg'] = '此类别下还有子分类，不能删除！';
        }
        return $arr;
    }



   //订单管理
   public function Order(){
      return view('admin.Order');
   }

   //广告管理
   public function AD(){
      return view('admin.AD');
   }

   //轮播图管理
    public function RC(){
      return view('admin.RC');
   }

   //客服管理


   //数据统计
   public function Data(){
      return view('admin.Data');
   }

}
