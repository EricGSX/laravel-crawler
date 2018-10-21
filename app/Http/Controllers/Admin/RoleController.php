<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\AdminRole;


class RoleController extends Controller
{
	/**
	 * TODO 角色列表
	 *
	 * @return [type] [description]
	 */
    public function index()
    {
        $roles = \App\AdminRole::paginate(10);
        return view('admin.role.index',compact('roles'));
    }

    /**
     * TODO 创建角色页面
     *
     * @return [type] [description]
     */
    public function create()
    {
        return view('admin.role.add');
    }

    /**
     * TODO 创建角色行为
     *
     * @return [type] [description]
     */
    public function store()
    {
        $this->validate(request(),[
            'name' => 'required:min:3',
            'description' => 'required'
        ]);
        \App\AdminRole::create(request(['name','description']));
        return redirect('/admin/roles');
    }

    /**
     * TODO 角色权限的关系界面
     *
     * @return [type] [description]
     */
    public function permission(\App\AdminRole $role)
    {
        //获取所有权限
        $permissions = \App\AdminPermission::all();
        //获取当前角色的权限
        $myPermissions = $role->permissions;
        return view('admin.role.permission',compact('permissions','myPermissions','role'));
    }

    /**
     * TODO 储存角色行为
     *
     * @return [type] [description]
     */
    public function storePermission(\App\AdminRole $role)
    {
        $this->validate(request(),[
            'permissions' => 'required|array',
        ]);
        $permissions = \App\AdminPermission::findMany(request('permissions'));
        $myPermissions = $role->permissions;
        $addPermissions = $permissions->diff($myPermissions);
        foreach ($addPermissions as $permission){
            $role->grantPermission($permission);
        }
        $deletePermissions = $myPermissions->diff($permissions);
        foreach($deletePermissions as $permission){
            $role->deletePermission($permission);
        }
        return back();
    }
}
