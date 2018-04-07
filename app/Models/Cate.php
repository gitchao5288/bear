<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //


    protected $table = 'shop_cate';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $guarded = [];

    static public function getCate()
    {
        $cates = self::all()->toArray();

       $cate =  self::subtree($cates);
        dd($cates);
       $first = [];
       $second = [];
       $third = [];
       foreach($cates as $k=>$v){


       }

    }

    static public function subtree($arr,$id=0,$lev=1)
    {
        $subs=[];
        foreach($arr as $v){
            //先找儿子
            if($v['pid']==$id){
                $v['lev']=$lev;
                $subs[]=$v;
                $subs = array_merge($subs,static::subtree($arr,$v['id'],$lev+1));
            }
        }
        return $subs;
    }

}
