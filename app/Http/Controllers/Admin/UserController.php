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
    public function role()
    {

    }

    /**
     * TODO 保存用户角色
     * 
     * @return [type] [description]
     */
    public function storeRole()
    {

    }
}
