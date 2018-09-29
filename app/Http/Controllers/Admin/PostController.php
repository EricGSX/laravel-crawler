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
    public function status(Request $request)
    {
        $this->validate(request(),[
            'status' => 'required|in:-1,0,1'
        ]);
        $action = $request->e_post_action;
        if($action == 'star'){
            Post::where('id', $request->post_id)->update(['mark_status' => 1]);
        }elseif($action == 'del'){
            Post::where('id', $request->post_id)->delete();
        }elseif($action == 'restore'){
            Post::withTrashed()->where('id', $request->post_id)->restore();
        }elseif ($action == 'destroy'){
            Post::where('id', $request->post_id)->forceDelete();
        }else{
            return [
                'error' => 80001,
                'msg' => '非法的请求'
            ];
        }
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
        $posts = Post::onlyTrashed()->orderBy('created_at','desc')->paginate(10);
        return view('admin.post.trash',compact('posts'));
    }

}
