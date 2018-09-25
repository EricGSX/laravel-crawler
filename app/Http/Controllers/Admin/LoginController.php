<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * TODO 登录页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.login.index');
    }

    /**
     * TODO 登陆操作
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login()
    {
        $this->validate(request(),[
            'name' => 'required|min:2',
            'password' => 'required|min:5|max:20',
        ]);
        $user = request(['name','password']);
        if(\Auth::guard('admin')->attempt($user)){
            return redirect('/admin/home');
        }
        return \Redirect::back()->withErrors('用户名密码不匹配');
    }

    /**
     * TODO 退出
     * 利用了守卫（guard）admin
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
