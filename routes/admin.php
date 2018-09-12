<?php
//TODO 后台
Route::group(['prefix'=>'admin'],function (){
    Route::get('/login','Admin\LoginController@index');
    Route::Post('/login','Admin\LoginController@login');
    Route::get('/logout','Admin\LoginController@logout');
    Route::group(['middleware' => 'auth:admin'],function (){
        //首页
        Route::get('/home','Admin\HomeController@index');
    });

});