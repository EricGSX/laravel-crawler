<?php
/**
 * SpiderController.php
 * User: Eric.Guo
 * Date: 2018/6/11
 * Time: 16:02
 * Project: OceaniaWebCrawler
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QL\QueryList;
class SpiderController extends Controller
{
    /**
     * TODO 展示SPIDER首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function index()
    {
        $return = [

        ];
        return view('spider.index');
    }


    public function gitee()
    {
        return 'You Are Right';
    }
}