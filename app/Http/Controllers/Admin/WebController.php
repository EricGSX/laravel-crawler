<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\FriendLink;

class WebController extends Controller
{
    /**
     * TODO 后台展示所有的友链
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function linkList()
    {
        $links = FriendLink::get();
        return view('admin.link.index',compact('links'));
    }

    /**
     * TODO 展示添加友链界面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.link.add');
    }

    /**
     * TODO 保存友链
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $this->validate(request(),[
            'author' => 'bail|required',
            'nick' => 'bail|required',
            'link_url' => 'bail|required',
        ]);
        $author = request('author');
        $nick = request('nick');
        $link_url = request('link_url');
        FriendLink::create(compact('author','nick','link_url'));
        return redirect('admin/flinks');
    }

    /**
     * TODO 删除友链
     *
     * @param \App\FriendLink $link
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(FriendLink $link)
    {
        $link->delete();
        return redirect('admin/flinks');
    }

    /**
     * TODO 展示友链详情
     *
     * @param \App\FriendLink $link
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(FriendLink $link)
    {
        return view('admin.link.edit',compact('link'));
    }

    /**
     * TODO 跟新友链
     *
     * @param \App\FriendLink $link
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(FriendLink $link)
    {
        $this->validate(request(),[
            'author' => 'bail|required',
            'nick' => 'bail|required',
            'link_url' => 'bail|required',
        ]);
        $link->author = request('author');
        $link->nick = request('nick');
        $link->link_url = request('link_url');
        $link->save();
        return redirect('admin/flinks');
    }
}
