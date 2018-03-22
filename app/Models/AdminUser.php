<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    //
    protected $table = 'adminuser';
    protected $primaryKey = 'uid';
    public $timestamps = false;
}
