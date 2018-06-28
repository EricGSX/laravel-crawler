<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//定义路由组
Route::get('/test','WebCrawlerController@test');


//TODO TEST
//Route::get('/baidu','WebCrawlerController@baidu');
//
//Route::get('/wxarticle','WebCrawlerController@article');
//
//Route::get('/github','WebCrawlerController@github');
//
//Route::get('/gitee','WebCrawlerController@gitee');
//
//Route::get('/snoopy','WebCrawlerController@snooy');
//
//Route::get('/amazon','WebCrawlerController@amazon');
//
//Route::get('/cookie','WebCrawlerController@cookie');
//
//Route::get('/checkcurl','WebCrawlerController@checkcurl');
//
//Route::get('/zhihu','WebCrawlerController@zhihu');
//
//Route::get('/test_spider','WebCrawlerController@test_spider');

//TODO 开始爬虫
Route::group(['prefix'=>'spider'],function (){
    Route::get('/','SpiderController@index');
    Route::get('/gitee','SpiderController@gitee');
    Route::get('/zhihu','SpiderController@zhihu');
    Route::get('/sf','SpiderController@sf');
    Route::get('/sina','SpiderController@sina');
    Route::get('/baidu','SpiderController@baidu');
});

//TODO 前台界面
Route::group(['prefix'=>'posts'],function(){
    //文章列表页
    Route::get('/','Home\PostController@index');
    //创建文章
    Route::get('/create','Home\PostController@create');
    Route::post('/','Home\PostController@stroe');
    //文章详情页
    Route::get('/{post}','Home\PostController@show');
    //编辑文章
    Route::get('/{post}/edit','Home\PostController@edit');
    Route::put('/{post}','Home\PostController@update');
    //删除文章
    Route::get('/delete','Home\PostController@delete');
});

//TODO 后台界面


