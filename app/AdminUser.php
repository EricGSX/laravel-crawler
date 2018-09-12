<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    //TODO 这里取消了remembertoken字段
    protected $rememberTokenName = '';
}
