<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ORDER extends Model
{
    //
    protected $table = 'order';
    protected $primaryKey = 'oid';
    public $timestamps = false;
    public $guarded = [];

       public function detail()
    {
        return $this->hasOne('App\Models\ORDERDETAIL','oid','oid');
    }
}
