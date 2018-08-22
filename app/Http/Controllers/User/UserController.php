<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function setting(User $user)
    {
        return view('user.setting');
    }

    public function settingStore(Request $request)
    {

    }

    /**
     * TODO 个人中心页面
     */
    public function show(User $my)
    {
        //这个人的信息，包含关注/粉丝/文章数
        $user = User::withCount(['stars','fans','posts'])->find($my->id);
        //这个人的文章列表,取最新的10条
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();
        //关注的用户,包含关注用户的 关注/粉丝/文章数
        $stars = $user->stars;
        $suser = User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts']);
        //这个人的粉丝，包含粉丝用户的 关注/粉丝/文章数
        $fans = $user->fans;
        $fuser = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts']);
        return view('user.show',compact('user', 'posts', 'fuser', 'suser'));
    }

    /**
     * TODO 关注
     */
    public function fan(User $user)
    {
        echo 1;
    }

    /**
     * TODO 取消关注
     */
    public function unfan()
    {

    }
}
