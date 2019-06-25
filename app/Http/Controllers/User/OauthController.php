<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OauthController extends Controller
{
    public function baiduOauth()
    {
    	$clientId = env('BAIDU_API_KEY');
        $clientSecret = env('BAIDU_SECRET_KEY');
        $redirectUri = env('BAIDU_REDIRECT_URI');
        header("location:https://openapi.baidu.com/oauth/2.0/authorize?response_type=code&client_id=$clientId&redirect_uri=$redirectUri&display=popup");
    }
}
