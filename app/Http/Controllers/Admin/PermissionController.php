<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\AdminPermission;

class PermissionController extends Controller
{
	/**
	 * TODO 权限列表页面
	 * 
	 * @return [type] [description]
	 */
    public function index()
    {
        $permissions = \App\AdminPermission::paginate(10);
    	return view('admin.permission.index',compact('permissions'));
    }

    /**
     * TODO 创建权限
     * 
     * @return [type] [description]
     */
    public function create()
    {
    	return view('admin.permission.add');
    }

    /**
     * TODO 储存权限
     * 
     * @return [type] [description]
     */
    public function store()
    {
        $this->validate(request(),[
            'name' => 'required:min:3',
            'description' => 'required'
        ]);
        \App\AdminPermission::create(request(['name','description']));
        return redirect('/admin/permissions');
    }
}
