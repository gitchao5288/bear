<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRotation extends Model
{
    //
    protected $table = 'rotation';
    protected $primaryKey = 'rid';
    public $timestamps = false;
    public $guarded = [];
}
