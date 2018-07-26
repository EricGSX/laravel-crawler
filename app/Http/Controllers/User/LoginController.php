<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return view('user.login');
    }

    public function login()
    {
        $this->validate(request(),[
            'email' => 'required|email',
            'password' => 'required|min:5|max:20',
            'is_remember' => 'integer'
        ]);
        $user = request(['email','password']);
        $is_remember = boolval(request('is_remember'));
        if(\Auth::attempt($user,$is_remember)){
            return redirect('/posts');
        }
        return \Redirect::back()->withErrors('邮箱密码不匹配');
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/user/login');
    }
}
