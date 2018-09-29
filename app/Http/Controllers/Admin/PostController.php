<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Post;

class PostController extends Controller
{
	/**
	 * TODO 文章列表
	 * @return [type] [description]
	 */
    public function index()
    {
    	$posts = Post::orderBy('created_at','desc')->paginate(10);
    	return view('admin.post.index',compact('posts'));
    }

    /**
     * TODO 修改文章的状态
     * @param  Post   $post [description]
     * @return [type]       [description]
     */
    public function status(Post $post)
    {
    	$this->validate(request(),[
    		'status' => 'required|in:-1,0,1'
    	]);
    	$post->mark_status = request('status');
    	$post->save();
    	return [
    		'error' => 0,
    		'msg' => ''
    	];
    }

    /**
     * TODO 回收站
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        $posts = Post::withoutGlobalScopes(['myPost'])->where('mark_status',-1)->orderBy('created_at','desc')->paginate(10);
        return view('admin.post.trash',compact('posts'));
    }

}
