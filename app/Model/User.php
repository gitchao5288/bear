<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // 1. 模型默认的关联表
    public $table = 'user';

    // 2. 模型默认主键
    public $primaryKey = 'user_id';

    // 是否维护 created_at updated_at 字段
    public $timetamps = false;

    // 是否允许批量操作字段
    public $guarded = [];
}
