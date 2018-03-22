<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
   //首页
   public function index(){
      return view('admin.index');
   }
   public function wel(){
      return view('admin.wel');
   }


   //前台用户浏览
   //  public function Huser(){
   //    return view('admin.Huser');
   // }
    public function Huseradd(){
      return view('admin.Huseradd');
    }
    public function Huseredit(){
      return view('admin.Huseredit');
    }


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
      return view('admin.Cate');
   }

   //商品管理
   public function Good(){
      return view('admin.Good');
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
