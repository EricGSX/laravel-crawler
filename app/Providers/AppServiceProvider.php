<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
//        Schema::defaultStringLength(191);
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
