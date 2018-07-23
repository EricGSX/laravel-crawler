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

    }

    public function logout()
    {

    }
}
