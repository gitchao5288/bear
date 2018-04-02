<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ORDERDETAIL extends Model
{
    protected $table = 'orderdetail';
    protected $primaryKey = 'oid';
    public $timestamps = false;
    public $guarded = [];

    public function order()
    {
      return $this->belongsto('App\Models\ORDER','oid','oid');
    }

}
