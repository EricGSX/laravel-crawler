<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\OauthThird;
use App\User;
use Illuminate\Support\Facades\DB;

class OauthController extends Controller
{

    public function baiduOauth()
    {
    	$clientId = env('BAIDU_API_KEY');
        $redirectUri = env('BAIDU_REDIRECT_URI');
        header("location:https://openapi.baidu.com/oauth/2.0/authorize?response_type=code&client_id=$clientId&redirect_uri=$redirectUri&display=popup");
    }

    public function baiduCallback()
    {
        $oauth = new OauthThird();
        $token = $oauth->getBaiduAccessToken();
        $userinfo = $oauth->getBaiduUserinfo($token);
        $platform_uid = $userinfo['uid'];
        $name = $userinfo['uname'];
        $user_img = 'http://tb.himg.baidu.com/sys/portraitn/item/'.$userinfo['portrait'];
        $platform_type = 'Baidu';
        $password = bcrypt($platform_type);
        $user = User::updateOrCreate(compact('platform_uid','platform_type'),compact('platform_uid','platform_type','name','user_img','password'));
        session(['baidu_access_token'=>$token]);
        $user_data = compact('platform_uid','password','name');
        $is_remember = boolval(0);
        DB::enableQueryLog();
        $result2 = \Auth::attempt($user_data,$is_remember);
        $result = response()->json(DB::getQueryLog());
        dump($result2);
        dd($result);
        if(\Auth::attempt($user_data,$is_remember)){
            return redirect('/posts');
        }else{

        }
    }

    public function baiduLogout()
    {
        $oauth = new OauthThird();
        $access_token = session('baidu_access_token');
        $result =$oauth->baiduLogout($access_token);
        dump($result);
    }
    
}
