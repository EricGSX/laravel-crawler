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
Route::get('/baidu','WebCrawlerController@baidu');

Route::get('/wxarticle','WebCrawlerController@article');

Route::get('/github','WebCrawlerController@github');

Route::get('/gitee','WebCrawlerController@gitee');

Route::get('/snoopy','WebCrawlerController@snooy');

Route::get('/amazon','WebCrawlerController@amazon');

Route::get('/cookie','WebCrawlerController@cookie');

Route::get('/checkcurl','WebCrawlerController@checkcurl');

Route::get('/zhihu','WebCrawlerController@zhihu');

Route::get('/test_spider','WebCrawlerController@test_spider');

//TODO 开始爬虫
Route::group(['prefix'=>'spider'],function (){
    Route::get('/','SpiderController@index');
    Route::get('/gitee','SpiderController@gitee');
    Route::get('/zhihu','SpiderController@zhihu');
    Route::get('/sf','SpiderController@sf');
    Route::get('/sina','SpiderController@sina');
    Route::get('/baidu','SpiderController@baidu');
});

