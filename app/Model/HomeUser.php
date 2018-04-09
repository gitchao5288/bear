<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HomeUser extends Model
{
    // 1. 模型默认的关联表
    public $table = 'homeuser';

    // 2. 模型默认主键
    public $primaryKey = 'uid';

    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
