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
        //$data = QueryList::get('https://www.sputtertargets.net')->find('img')->attrs('src');
        //dd($data->all());
        $html = file_get_contents('https://querylist.cc/');
        $ql = QueryList::html($html);
        //$ql->setHtml($html);
        $html = $ql->getHtml();
        echo $html;
    }

    /**
     * TODO 采集百度搜索首页内容
     *
     * @return array
     */
    public function baidu()
    {
        $url = 'http://www.baidu.com/s?wd=QueryList';
        $rules = [
            'img'     => ['img','src'],
            'title'   => ['h3>a','text'],
            'content' => ['.c-abstract','text'],
            'ad_url'  => ['.f13>a','src'],
        ];
        $ql = QueryList::get($url)->rules($rules)->query();
        $data = $ql->getData();
        $return = $data->all();
        return $return;
    }
}
