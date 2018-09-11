<?php
//TODO 后台
Route::group(['prefix'=>'admin'],function (){
    Route::get('/login','Admin\LoginController@index');
    Route::Post('/login','Admin\LoginController@login');
    Route::get('/logout','Admin\LoginController@logout');
    Route::get('/home','Admin\HomeController@index');
});