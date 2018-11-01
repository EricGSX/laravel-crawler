<?php

namespace App\Http\Controllers\Topic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Topic;

class TopicController extends Controller
{
    /**
     * TODO 专题详情页
     *
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Topic $topic)
    {
        //带文章数的专题
        $topic = Topic::withCount('postTopics')->find($topic->id);
        //专题文章列表，按照时间倒序排列，前十个
        $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();
        //属于我的文章但是未投稿,且不属于某个专题的文章
        $myposts = \App\Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();
        return view('topic.show',compact('topic','posts','myposts'));
    }

    /**
     * TODO 将文章投到某个专题下
     *
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Topic $topic)
    {
        $this->validate(request(),[
            'post_ids' => 'required|array'
        ]);
        $post_ids = request('post_ids');
        $topic_id = $topic->id;
        foreach ($post_ids as $post_id){
            \App\PostTopic::firstOrCreate(compact('topic_id','post_id'));
        }
        return back();
    }

    /**
     * TODO 对分类进行展示
     *
     * @param \App\Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postList(Topic $topic)
    {
        $topic = Topic::find($topic->id);
        $star_posts = '';
        //专题文章列表，按照时间倒序排列，前十个
        $posts = $topic->posts()->orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(6);
        return view('home.index',compact('posts','star_posts'));
    }
}
