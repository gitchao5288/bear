<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate;
class IndexController extends Controller
{
   public function index(){
         //查询所有类别数据转换成数组
      $cate=Cate::get()->toArray();
         //调用子树方法赋值给变量
       $arr=$this->subtree($cate);
         //返回视图层并携带数据
      return view('home.index',compact('arr'));
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




}
