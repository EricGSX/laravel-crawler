<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QL\QueryList;

class Test1Controller extends Controller
{
    public function index()
    {
        //采集某页面所有的图片
        $data = QueryList::get('https://www.sputtertargets.net')->find('img')->attrs('src');
        //打印结果
        echo '<pre>';
        print_r($data->all());
    }
}
