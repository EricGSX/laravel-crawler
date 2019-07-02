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
        if(\Auth::attempt(['platform_uid'=>$platform_uid,'password'=>$platform_type],1)){
            return redirect('/posts');
        }
    }

    public function baiduLogout()
    {
        $oauth = new OauthThird();
        $access_token = session('baidu_access_token');
        $result =$oauth->baiduLogout($access_token);
        dump($result);
    }

    public function githubOauth()
    {
        $clientId = env('GITHUB_CLIENTID');
        header("location:https://github.com/login/oauth/authorize?client_id=$clientId");
    }

    public function githubCallback()
    {
        $oauth = new OauthThird();
        $token = $oauth->getGithubAccessToken();
        $userinfo = $oauth->getGithubUserinfo($token);
        $platform_uid = $userinfo['id'];
        $name = $userinfo['login'];
        $user_img = $userinfo['avatar_url'];
        $platform_type = 'Github';
        $password = bcrypt($platform_type);
        $user = User::updateOrCreate(compact('platform_uid','platform_type'),compact('platform_uid','platform_type','name','user_img','password'));
        session(['baidu_access_token'=>$token]);
        if(\Auth::attempt(['platform_uid'=>$platform_uid,'password'=>$platform_type],1)){
            return redirect('/posts');
        }
    }

    public function giteeOauth()
    {
        $clientId = env('GITEE_CLIENTID');
        $redirect_uri = env('GITEE_REDIRECT_URI');
        header("location:https://gitee.com/oauth/authorize?client_id=$clientId&redirect_uri=$redirect_uri&response_type=code");
    }

    public function giteeCallback()
    {
        $oauth = new OauthThird();
        $token = $oauth->getGiteeAccessToken();
        $userinfo = $oauth->getGiteeUserinfo($token);
        $platform_uid = $userinfo['id'];
        $name = $userinfo['login'];
        $user_img = $userinfo['avatar_url'];
        $platform_type = 'Gitee';
        $password = bcrypt($platform_type);
        $user = User::updateOrCreate(compact('platform_uid','platform_type'),compact('platform_uid','platform_type','name','user_img','password'));
        session(['baidu_access_token'=>$token]);
        if(\Auth::attempt(['platform_uid'=>$platform_uid,'password'=>$platform_type],1)){
            return redirect('/posts');
        }
    }

    public function qqOauth()
    {
        $app_id = env('QQ_APP_ID');
        $redirect_uri = env('QQ_REDIRECT_URI');
        header("location:https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=$app_id&redirect_uri=$redirect_uri");
    }

    public function qqCallback()
    {
        $oauth = new OauthThird();
        $token = $oauth->getQqAccessToken();
        var_dump($token);
        $openid = $oauth->getQqOpenID($token);
        $userinfo = $oauth->getQqUserinfo($token,$openid);
        dd($userinfo);
    }

}
