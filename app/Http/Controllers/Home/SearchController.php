<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Cate;

class SearchController extends Controller
{
    //
    public function search($id)
    {

        //判断传过来是子还是父
        $cates = Cate::where('pid',$id)->get();

        if (!$cates->isEmpty()){
            //设置一个空数组
            $data = [];
            foreach ($cates as $v){
                $data[] = $v->id;
            }
            //获取所有在这个类别里的所有商品
            $goods = Goods::whereIn('cid',$data )->paginate(15);
        } else {
            $goods = Goods::where('cid',$id )->paginate(15);
        }

        return view('/home/search',compact('goods'));


    }


    public function searchs(Request $request)
    {
//        dd($request);
        $goods = Goods::where('gname','like','%'.$request->rname.'%')->paginate(2);

        return view('/home/search',compact('goods','request'));

    }
}
