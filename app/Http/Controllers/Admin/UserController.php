<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\AdminUser;

class UserController extends Controller
{
	/**
	 * 管理员列表
	 * @return [type] [description]
	 */
    public function index()
    {
    	$users = AdminUser::paginate(10);
    	return view('admin.user.index',compact('users'));
    }

	/**
	 * 管理员创建界面
	 * @return [type] [description]
	 */
    public function create()
    {
    	return view('admin.user.add');
    }

    /**
     * 具体创建操作
     * @return [type] [description]
     */
    public function store()
    {
    	$this->validate(request(),[
    		'name' => 'bail|required|unique:admin_users,name|min:3',
    		'password' => 'bail|required'
    		]);
    	$name = request('name');
    	$password = bcrypt(request('password'));
    	AdminUser::create(compact('name','password'));
    	return redirect('admin/users');
    }

    /**
     * TODO 展示用户信息
     */
    public function detail(AdminUser $user)
    {
        return view('admin.user.edit',compact('user'));
    }

    /**
     * TODO 更新用户信息
     */
    public function update(AdminUser $user)
    {
        $this->validate(request(),[
            'name' => 'bail|required|min:3',
            'password' => 'bail|required'
        ]);
        $user->name = request('name');
        $user->password = bcrypt(request('password'));
        $user->save();
        return redirect('admin/users');
    }

    /**
     * TODO 删除用户
     *
     * @param \App\AdminUser $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(AdminUser $user)
    {
        $user->delete();
        return redirect('admin/users');
    }

    /**
     * TODO 用户角色页面
     * 
     * @return [type] [description]
     */
    public function role(\App\AdminUser $user)
    {
        $roles = \App\AdminRole::all();
        $myRoles = $user->roles;
        return view('admin.user.role',compact('roles','myRoles','user'));
    }

    /**
     * TODO 保存用户角色
     * 
     * @return [type] [description]
     */
    public function storeRole(\App\AdminUser $user)
    {
        $this->validate(request(),[
            'roles' => 'required|array',
            ]);
        $roles = \App\AdminRole::findMany(request('roles'));
        //之前已经有的角色
        $myRoles = $user->roles;
        //要增加的（表单提交的，跟现在拥有的 的差集）
        $addRoles = $roles->diff($myRoles);
        foreach($addRoles as $role){
            $user->assignRole($role);
        }
        //要删除的(现在有的，但是表单里面没有的，这些要删除)
        $deleteRoles = $myRoles->diff($roles);
        foreach($deleteRoles as $role){
            $user->deleteRole($role);
        }
        return back();
    }
}
