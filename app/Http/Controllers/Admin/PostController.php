<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Post;

class PostController extends Controller
{
	/**
	 * 
	 * @return [type] [description]
	 */
    public function index()
    {
    	$posts = Post::orderBy('created_at','desc')->paginate(10);
    	return view('admin.post.index',compact('posts'));
    }

    public function star()
    {

    }

    public function del()
    {

    }
}
