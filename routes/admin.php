<?php
//TODO 后台
Route::group(['prefix'=>'admin'],function (){
    Route::get('/login','Admin\LoginController@index');
    Route::Post('/login','Admin\LoginController@login')->name('login');
    Route::get('/logout','Admin\LoginController@logout');
    Route::group(['middleware' => 'auth:admin'],function (){
        //首页
        Route::get('/home','Admin\HomeController@index');
//        Route::group(['middleware' => 'can:system'],function(){
            //管理人员
            Route::get('/users','Admin\UserController@index');
            Route::get('/users/create','Admin\UserController@create');
            Route::post('/users','Admin\UserController@store');
            Route::get('/users/{user}/update','Admin\UserController@detail');
            Route::post('/users/{user}','Admin\UserController@update');
            Route::get('/users/{user}/delete','Admin\UserController@delete');
            Route::get('/users/{user}/role','Admin\UserController@role');
            Route::post('/users/{user}/role','Admin\UserController@storeRole');
            //角色
            Route::get('/roles','Admin\RoleController@index');
            Route::get('/roles/create','Admin\RoleController@create');
            Route::post('/roles/store','Admin\RoleController@store');
            Route::get('/roles/{role}/permission','Admin\RoleController@permission');
            Route::post('/roles/{role}/permission','Admin\RoleController@storePermission');
            //权限
            Route::get('/permissions','Admin\PermissionController@index');
            Route::get('/permissions/create','Admin\PermissionController@create');
            Route::post('/permissions/store','Admin\PermissionController@store');
            //友链
            Route::get('/flinks','Admin\WebController@linkList');
            Route::get('/flinks/create','Admin\WebController@create');
            Route::get('/flinks/{link}/update','Admin\WebController@detail');
            Route::get('/flinks/{link}/delete','Admin\WebController@delete');
            Route::post('/flinks','Admin\WebController@store');
            Route::post('/flinks/{link}','Admin\WebController@update');
//        });
//        Route::group(['middleware' => 'can:post'],function(){
            //审核文章
            Route::get('/posts','Admin\PostController@index');
            Route::get('/posts/trash','Admin\PostController@trash');
            Route::post('/posts/{post}/status','Admin\PostController@status');
//        });
    });

});