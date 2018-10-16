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
        return view('admin.role.index');
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

    }

    /**
     * TODO 角色权限的关系界面
     * 
     * @return [type] [description]
     */
    public function permission()
    {
        return view('admin.role.permission');
    }

    /**
     * TODO 储存角色行为
     * 
     * @return [type] [description]
     */
    public function storePermission()
    {

    }
}
