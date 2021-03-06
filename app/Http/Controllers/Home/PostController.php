<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Post;
use \App\Comment;
use \App\Zan;
use App\Libs\Parser;
use \App\Topic;
use App\Libs\QiniuCloud;

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
        TODO:Facade门面模式
*/
        $posts = Post::with(['topics','comments','zans'])->orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(6);
        $star_posts = Post::where('mark_status',1)->orderBy('created_at','desc')->get();
        return view('home.index',compact('posts','star_posts'));
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
//         $this->validate(request(),[
//             'title' => 'required|string|max:100|min:5',
//             'description'=> 'required|string|min:5',
//             'content'=> 'required|string|min:10',
//             'encoding_type' => 'required',
//         ]
// //            [
// //            'title.min' => '文章标题过短'
// //        ]
//         );
        $request->validate([
            'title' => 'required|string|max:100|min:5',
            'description'=> 'required|string|min:5',
            'content'=> 'required|string|min:10',
            'encoding_type' => 'required',    
        ]);
        $user_id = \Auth::id();
        $params = array_merge(request(['title','content','description','encoding_type']),compact('user_id'));
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
        $id->load('comments'); //写了就是预加载，不写就是逻辑直接在view层里面处理了，不符合MVC的模式思想，但是也是正确的
        $content = $id->content;
        $type = $id->encoding_type;
        $web_title = $id->title;
        $parser = new Parser();
        $html = $parser->makeHtml($content);
        $id->update(['view_count'=>$id->view_count + 1]);
        return view('home.show',compact('id','html','type','web_title'));
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
            'title' => 'required|string|max:100|min:5',
            'description'=> 'required|string|min:5',
            'content'=> 'required|string|min:10',
            'encoding_type' => 'required',
        ]);
        $this->authorize('update',$post);
        $post->title = request('title');
        $post->content = request('content');
        $post->description = request('description');
        $post->encoding_type = request('encoding_type');
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
//        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
//        return asset('storage/'.$path);
        $filePath = $_FILES['wangEditorH5File']['tmp_name'];
        $key = $_FILES['wangEditorH5File']['name'];
        $qiniu = new QiniuCloud();
        $result = $qiniu->upload($filePath,$key);
        $file_url = 'http://files.guosx.com/' . $result['key'];
        return $file_url;
    }

    public function delete(Post $id)
    {
        $this->authorize('delete',$id);
        $id->delete();

        return redirect('/posts');
    }

    /**
     * 天气预报
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function weather()
    {
        return view('home.weather');
    }


    public function comment(Post $post)
    {
        $this->validate(request(),[
            'content'=>'required|min:3',
        ]);
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);
        //直接返回详情页
        return back();
    }

    /**
     * TODO 点赞
     *
     * @param Post $post
     */
    public function zan(Post $post)
    {
        $params = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];
        Zan::firstOrCreate($params);
        return back();
    }

    /**
     * TODO 取消赞
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();
        return back();
    }

    /**
     * TODO Search
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        $this->validate(request(),[
            's' => "required",
        ]);
        $s = request('s');
        $posts = Post::where('title', 'like', "%$s%")
            ->orWhere('content','like',"%$s%")
            ->orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(6);
        return view('home.search',compact('posts','s'));
    }

}
