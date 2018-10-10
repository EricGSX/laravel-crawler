<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    //TODO 这里取消了remembertoken字段
    protected $rememberTokenName = '';

    //TODO 设置不可注入的字段为空
    protected $guarded = [];

    /**
     * TODO 用户有哪些角色
     * @return [type] [description]
     */
    public function roles()
    {
    	return $this->belongsToMany(\App\AdminRole::class,'admin_role_user','user_id','role_id')->withPivot(['user_id','role_id']);
    }

    /**
     * 判断是否有某个、某些角色
     */
    public function isInRoles($roles)
    {
    	return !!$roles->intersect($this->roles)->count();
    }

    /**
     * 给用户分配角色
     */
    public function assignRole($role)
    {
    	return $this->roles()->save($role);
    }

    /**
     * 取消用户分配的角色
     * 
     * @param  [type] $tole [description]
     * @return [type]       [description]
     */
    public function deleteRole($tole)
    {
    	return $this->roles()->detach($role);
    }

    public function hasPermission($permission)
    {
    	//TODO 
    }

}
