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
    	return view('admin.permission.index');
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

    }
}
