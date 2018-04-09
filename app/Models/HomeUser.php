<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeUser extends Model
{
    //
   protected $table = 'homeuser';
    protected $primaryKey = 'uid';
    public $timestamps = false;
    public $guarded = [];
}
