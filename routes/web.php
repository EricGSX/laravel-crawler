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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','Home\PostController@index');
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
    //天气
    Route::get('/weather','Home\PostController@weather');
    //搜索
    Route::get('/search','Home\PostController@search');
    //创建文章
    Route::get('/create','Home\PostController@create');
    Route::post('/','Home\PostController@store');
    //提交评论
    Route::post('/{post}/comment','Home\PostController@comment');
    //赞
    Route::get('/{post}/zan','Home\PostController@zan');
    Route::get('/{post}/unzan','Home\PostController@unzan');
    //文章详情页
    Route::get('/{id}','Home\PostController@show');
    //编辑文章
    Route::get('/{id}/edit','Home\PostController@edit');
    Route::put('/{post}','Home\PostController@update');
    //删除文章
    Route::get('/{id}/delete','Home\PostController@delete');
    //图片上传
    Route::post('/image/upload','Home\PostController@imageUpload');
});

//TODO 后台界面

//TODO 用户模块
Route::group(['prefix'=>'user'],function(){
    //注册
    Route::get('/register','User\RegisterController@index');
    Route::post('/register','User\RegisterController@register');
    //登陆
    Route::get('/login','User\LoginController@index');
    Route::post('/login','User\LoginController@login');
    //登出
    Route::get('/logout','User\LoginController@logout');
    //个人设置
    Route::get('/me/setting','User\UserController@setting');
    Route::post('/me/setting','User\UserController@settingStore');
});


