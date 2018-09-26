<?php
//TODO 后台
Route::group(['prefix'=>'admin'],function (){
    Route::get('/login','Admin\LoginController@index');
    Route::Post('/login','Admin\LoginController@login')->name('login');
    Route::get('/logout','Admin\LoginController@logout');
    Route::group(['middleware' => 'auth:admin'],function (){
        //首页
        Route::get('/home','Admin\HomeController@index');
        //管理人员
        Route::get('/users','Admin\UserController@index');
        Route::get('/users/create','Admin\UserController@create');
        Route::post('/users','Admin\UserController@store');
    });

});