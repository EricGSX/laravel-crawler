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
}
