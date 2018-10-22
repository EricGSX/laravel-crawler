<?php

namespace App;

use App\Model;

class AdminRole extends Model
{
    protected $table = 'admin_roles';

    protected $guarded = [];

    /**
     * TODO 当前角色的所有权限
     * 
     * @return [type] [description]
     */
    public function permissions()
    {
    	return $this->belongsToMany(\App\AdminPermission::class,'admin_permission_role','role_id','permission_id')->withPivot(['permission_id','role_id']);
    }

    /**
     * TODO 角色赋予权限
     * 
     * @param  [type] $permission [description]
     * @return [type]             [description]
     */
    public function grantPermission($permission)
    {
    	return $this->permissions()->save($permission);
    }

    /**
     * TODO 取消角色赋予的权限
     * 
     * @param  [type] $permission [description]
     * @return [type]             [description]
     */
    public function deletePermission($permission)
    {
    	return $this->permissions()->detach($permission);
    }

    /**
     * TODO 判断角色是否有权限
     * 
     * @param  [type]  $permission [description]
     * @return boolean             [description]
     */
    public function hasPermission($permission)
    {
    	return $this->permissions()->contains($permission);
    }
}
