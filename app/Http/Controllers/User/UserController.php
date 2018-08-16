<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function setting()
    {
        return view('user.setting');
    }

    public function settingStore()
    {

    }

    /**
     * TODO 个人中心页面
     */
    public function show()
    {
        return view('user.show');
    }

    /**
     * TODO 关注
     */
    public function fan()
    {

    }

    /**
     * TODO 取消关注
     */
    public function unfan()
    {

    }
}
