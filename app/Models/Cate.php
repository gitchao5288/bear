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
}
