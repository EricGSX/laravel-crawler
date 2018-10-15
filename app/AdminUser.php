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
     * TODO 判断是否有某个、某些角色
     * 两个感叹号在这里是用于返回布尔值类型的数据
     */
    public function isInRoles($roles)
    {
    	return !!$roles->intersect($this->roles)->count();
    }

    /**
     * TODO 给用户分配角色
     */
    public function assignRole($role)
    {
    	return $this->roles()->save($role);
    }

    /**
     * TODO 取消用户分配的角色
     * 
     * @param  [type] $tole [description]
     * @return [type]       [description]
     */
    public function deleteRole($tole)
    {
    	return $this->roles()->detach($role);
    }

    /**
     * TODO 用户是否有权限
     * 判断 用户的角色 跟   有这个权限的角色  他俩是否有交集
     * 也就是判断用户 是不是有（有这个权限的角色） 这个角色
     * @param  [type]  $permission [description]
     * @return boolean             [description]
     */
    public function hasPermission($permission)
    {
    	return $this->isInRoles($permission->roles);
    }

}
