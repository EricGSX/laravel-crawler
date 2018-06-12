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
use App\Libs\Snoopy;

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
        //dd($postData);die;
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

    /**
     * TODO 码云模拟登陆
     */
    public function gitee()
    {
        $ql = QueryList::getInstance();
        //手动设置cookie
        $jar = new \GuzzleHttp\Cookie\CookieJar();
        //获取到登录表单
        $form = $ql->get('https://gitee.com/login',[],[
            'cookies' => $jar
        ])->find('form');
        //填写GitHub用户名和密码
        $form->find('input[name=user[login]]')->val('3234655977@qq.com');
        $form->find('input[name=user[password]]')->val('18337177020');
        //序列化表单数据
        $fromData = $form->serializeArray();
        $postData = [];
        foreach ($fromData as $item) {
            $postData[$item['name']] = $item['value'];
        }
        //dd($postData);die;
        //提交登录表单
        $actionUrl = 'https://gitee.com/login';
        $ql->post($actionUrl,$postData,[
            'cookies' => $jar
        ]);
        //判断登录是否成功
         echo $ql->getHtml();
        $userName = $ql->find('.header-nav-current-user>.css-truncate-target')->text();
        if($userName)
        {
            echo '登录成功!欢迎你:'.$userName;
        }else{
            echo '登录失败!';
        }
    }

    /**
     * TODO 测试snoopy是否引入
     */
    public function snooy()
    {
        $snoopy=new Snoopy();

        $snoopy->referer='https://github.com';//例如：http://www.baidu.com/你要模拟登陆的域名

        // $snoopy->agent="Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0"; //定义浏览器根
        $snoopy->agent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.62 Safari/537.36"; //定义浏览器根

        $post['login'] ='EricGSX';//根据你要模拟登陆的网站具体的传值 名称来定

        $post['password'] ='EricGSX2016222';//根据你要模拟登陆的网站具体的传值 名称来定

        $url='https://github.com/login';//登陆数据提交的URL地址

        $snoopy->submit($url,$post);

        $snoopy->fetch("https://github.com/settings/profile");//希望获取的页面数据

        var_dump($snoopy->results);//输出结果，登陆成功
    }

    /**
     * TODO AmazonBest Sellers
     *
     * @return array
     */
    public function amazon()
    {
        $url = 'https://www.amazon.com/gp/bestsellers/books?pd_rd_wg=h7RpR&pd_rd_r=06159414-17e8-4c7c-87ab-2a1353007c2b&pd_rd_w=63F0s&ref_=pd_gw_ri&pf_rd_r=DYCZEKVE1R7E7GCTEKNM&pf_rd_p=a76d819d-d46f-5d89-be3e-dc07c7b5bb0c';
        $rules = [
            //'title'   => ['p13n-sc-truncated','text'],
            'user' => ['.a-size-small>a','text'],
            //'price'  => ['.p13n-sc-price','html'],
            'img'     => ['.a-spacing-mini>img','src'],
        ];
        $ql = QueryList::get($url)->rules($rules)->query();
        $data = $ql->getData();
        $return = $data->all();
        dd($return);
        return $return;
    }

    public function cookie()
    {
        $url = 'https://gitee.com/EricGuosx/events';
        $cookie = 'user_locale=zh-CN; remote_way=http; Hm_lvt_7783e85c2ed70224593599fbefdc168a=1521093352,1521093434; oschina_new_user=false; aliyungf_tc=AQAAAC/nJUt46gsAGUBMLdE0nsVKX616; tz=Asia%2FShanghai; Hm_lvt_24f17767262929947cc3631f99bfd274=1528789358; __lnkrntdmcvrd=-1; Hm_lpvt_24f17767262929947cc3631f99bfd274=1528789590; gitee-session-n=BAh7CkkiD3Nlc3Npb25faWQGOgZFVEkiJTAxNzlhMDY0OTYzZDE2OWY3MDljZDgyNjA3NTRiMGUzBjsAVEkiF21vYnlsZXR0ZV9vdmVycmlkZQY7AEY6CG5pbEkiGXdhcmRlbi51c2VyLnVzZXIua2V5BjsAVFsHWwZpAzXhEkkiIiQyYSQxMCRvaFpJVG9vaWJ2cTZ6VXdUeWNKTTAuBjsAVEkiHXdhcmRlbi51c2VyLnVzZXIuc2Vzc2lvbgY7AFR7BkkiFGxhc3RfcmVxdWVzdF9hdAY7AFRJdToJVGltZQ2HlR3AlUMAsgk6DW5hbm9fbnVtaQHJOg1uYW5vX2RlbmkGOg1zdWJtaWNybyIHIBA6CXpvbmVJIghVVEMGOwBUSSIQX2NzcmZfdG9rZW4GOwBGSSIxVGs1OWRpOFNnRTMvOTMzU0Y0WFVSSUtHRG1zWHBvRWtvQ09QNGo4cldIZz0GOwBG--aa060bacacef04a3a223d4e2750422262c03328a';
        $ql = QueryList::get($url,[],[
            'headers'=>[
                'Cookie'    => $cookie,
            ]
        ]);
        echo $ql->getHtml();
    }
}
