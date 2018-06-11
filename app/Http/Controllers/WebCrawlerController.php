<?php
/**
 * webcrowler.php  for test
 * User: Eric.Guo
 * Date: 2018/6/8
 * Time: 13:53
 * Project: OceaniaWebCrawler
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QL\QueryList;

class WebCrawlerController extends Controller
{
    /**
     * TODO: 测试QueryList是否能在laravel平台运行
     */
    public function test()
    {
        $data = QueryList::get('https://www.sputtertargets.net')->find('img')->attrs('src');
        dd($data->all());
    }
}
