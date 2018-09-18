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
        \View::composer(['layout.sidebar','layout.nav'],function($view){
            $topics = \App\Topic::all();
            $view->with('topics',$topics);
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
