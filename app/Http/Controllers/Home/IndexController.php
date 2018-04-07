<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminRotation;
use App\Models\Cate;
class IndexController extends Controller
{
    //
    public function index()
    {
    	//轮播图
    	$Res = AdminRotation::get();
    	//分类展示
        $Cate = Cate::get();
//        dd($Cate);

    	// dd($FirstCate);
    	return view('/home.index',['Res'=>$Res,'Cate'=>$Cate]);

    }
}
    
