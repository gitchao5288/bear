<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AD extends Model
{
    protected $table = 'ad';
    protected $primaryKey = 'aid';
    public $timestamps = false;
    public $guarded = [];
}
