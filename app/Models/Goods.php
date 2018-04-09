<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    protected $table = 'goods';
    protected $primaryKey = 'gid';

//    不需要时间字段
    public $timestamps = false;

//    允许批量赋值 加入黑名单
    protected $guarded = [];



//    关联用户表
    public function HomeUser()
    {
        return $this->belongsTo('App\Model\HomeUser','uid','uid');
    }

//    关联类别表
    public function Cate()
    {
        return $this->hasOne('App\Models\Cate','id','cid');
    }

}
