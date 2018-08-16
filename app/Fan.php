<?php

namespace App;

use App\Model;

class Fan extends Model
{
    /**
     * TODO 通过Fan获取粉丝用户信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fuser()
    {
        return $this->hasOne(\App\User::class,'id','fan_id');
    }

    /**
     * TODO 通过Fan获取关注用户信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function suser()
    {
        return $this->hasOne(\App\User::class,'id','star_id');
    }
}
