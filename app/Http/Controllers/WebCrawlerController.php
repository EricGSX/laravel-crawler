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

    /**
     * TODO 模拟登陆github
     */
    public function github()
    {
        $ql = QueryList::getInstance();
        //手动设置cookie
        $jar = new \GuzzleHttp\Cookie\CookieJar();
        //获取到登录表单
        $form = $ql->get('https://github.com/login',[],[
            'cookies' => $jar
        ])->find('form');
        //填写GitHub用户名和密码
        $form->find('input[name=login]')->val('EricGSX');
        $form->find('input[name=password]')->val('EricGSX2016222');
        //序列化表单数据
        $fromData = $form->serializeArray();
        $postData = [];
        foreach ($fromData as $item) {
            $postData[$item['name']] = $item['value'];
        }
        //提交登录表单
        $actionUrl = 'https://github.com'.$form->attr('action');
        $ql->post($actionUrl,$postData,[
            'cookies' => $jar
        ]);
        //判断登录是否成功
        // echo $ql->getHtml();
        $userName = $ql->find('.header-nav-current-user>.css-truncate-target')->text();
        if($userName)
        {
            echo '登录成功!欢迎你:'.$userName;
            $content_url = "https://github.com/settings/profile";
            $rules=[
                'name' => ['h2','text'],
                //'img'  => ['.avatar-upload-container>img','src'],
            ];
            $ql = (new QueryList)->get($content_url);
            echo $ql->getHtml();die;
            $ql = (new QueryList)->get($content_url)->rules($rules)->query();
            $data = $ql->getData();
            $return = $data->all();
            return $return;
        }else{
            echo '登录失败!';
        }
    }
}
