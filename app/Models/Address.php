<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table = 'address';
    protected $primaryKey = 'addid';
    public $timestamps = false;
    public $guarded = [];
}
