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
include_once('admin.php');
include_once('./debug.php');
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','Home\PostController@index');
//定义路由组
Route::get('/test','Other\WebCrawlerController@test');


//TODO Other
Route::group(['prefix'=>'others'],function(){
    Route::get('/product','Other\WebCrawlerController@product');
    Route::get('/productDetail','Other\WebCrawlerController@productDetail');
    Route::get('/add','Other\WebCrawlerController@addDbData');
    Route::get('/csv','Other\WebCrawlerController@exportCsv');
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
});

//TODO 开始爬虫
// Route::group(['prefix'=>'spiders'],function (){
//     Route::get('/','Other\SpiderController@index');
//     Route::get('/gitee','Other\SpiderController@gitee');
//     Route::get('/zhihu','Other\SpiderController@zhihu');
//     Route::get('/sf','Other\SpiderController@sf');
//     Route::get('/sina','Other\SpiderController@sina');
//     Route::get('/baidu','Other\SpiderController@baidu');
//     Route::get('/email','Other\SpiderController@email2');
// });

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
Route::group(['prefix'=>'users'],function(){
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

    //个人中心
    Route::get('/{user}','User\UserController@show');
    Route::post('/{user}/fan','User\UserController@fan');
    Route::post('/{user}/unfan','User\UserController@unfan');
});

//TODO 专题模块
Route::group(['prefix'=>'topics'],function(){
    Route::get('/{topic}','Topic\TopicController@show');
    Route::post('/{topic}/submit','Topic\TopicController@submit');
});
//TODO 导航栏分类（专题）
Route::group(['prefix'=>'categories'],function(){
    Route::get('/{topic}','Topic\TopicController@postList');
});

//TODO 碎碎念
Route::group(['prefix'=>'tottles'],function(){
    Route::get('/show','Home\TottleController@show');
    Route::get('/create','Home\TottleController@create');
    Route::post('/','Home\TottleController@store');
});
//TODO 邮件
Route::group(['prefix'=>'emails'],function(){
    Route::post('/','Home\EmailController@feedback');
});

//TODO 通知模块
Route::get('/notices','Home\NoticeController@index');


