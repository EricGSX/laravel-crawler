<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * 在所有的启动之后执行
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        \View::composer(['layout.sidebar','layout.nav','layout.footer'],function($view){
            $topics = \App\Topic::all();
            $friend_links = \App\FriendLink::all();
            $labels = \App\Post::where('mark_status',2)->orderBy('created_at','desc')->get();
            $feedbacks = \App\FeedbackEmail::orderBy('id','desc')->take(6)->get();
            $view->with('feedbacks',$feedbacks);
            $view->with('labels',$labels);
            $view->with('topics',$topics);
            $view->with('friend_links',$friend_links);
        });
    }

    /**
     * Register any application services.
     * 在所有的启动之前执行
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
