<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
/*
        TODO:容器测试
        $app = app();
        $log = $app->make('log');
        $log->info('post_index',['data'=>'post test']);
        TODO:依赖注入
        TODO:门脸
*/
        $posts = Post::orderBy('created_at','desc')->paginate(6);
        return view('home.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO 验证
        $this->validate(request(),[
            'title' => 'required|string:max:100|min:5',
            'content'=> 'required|string|min:10',
        ]
//            [
//            'title.min' => '文章标题过短'
//        ]
        );
        $user_id = \Auth::id();
        $params = array_merge(request(['title','content']),compact('user_id'));
        $post = Post::create($params);
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $id)
    {
        return view('home.show',compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $id)
    {
        return view('home.edit',compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);
        $this->authorize('update',$post);
        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        return redirect("/posts/{$post->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * TODO 存储图片
     *
     * @param Request $request
     * @return string
     */
    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
        //dd(request()->all());
    }

    public function delete(Post $id)
    {
        $this->authorize('delete',$id);
        $id->delete();

        return redirect('/posts');
    }
}
