<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * TODO 展示个人设置页面
     *
     * @param \App\User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setting(User $user)
    {
        return view('user.setting');
    }

    /**
     * TODO 保存用户信息
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function settingStore(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:100|min:2',
        ]);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->save();
        return back();
    }

    /**
     * TODO 个人中心页面
     */
    public function show(User $user)
    {
        //这个人的信息，包含关注/粉丝/文章数
        $user = User::withCount(['stars','fans','posts'])->find($user->id);
        //这个人的文章列表,取最新的10条
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();
        //关注的用户,包含关注用户的 关注/粉丝/文章数
        $stars = $user->stars;
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();
        //这个人的粉丝，包含粉丝用户的 关注/粉丝/文章数
        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();
        return view('user.show',compact('user', 'posts', 'susers', 'fusers'));
    }

    /**
     * TODO 关注
     */
    public function fan(User $user)
    {
        $me = \Auth::user();
        $me->doFan($user->id);
        return [
            'error' => 0,
            'msg' => ''
        ];
    }

    /**
     * TODO 取消关注
     */
    public function unfan(User $user)
    {
        $me = \Auth::user();
        $me->doUnfan($user->id);
        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}
