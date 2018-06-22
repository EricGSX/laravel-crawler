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
use App\Libs\Spider;
use App\Libs\Parser;

class WebCrawlerController extends Controller
{
    /**
     * TODO: 测试QueryList是否能在laravel平台运行
     */
    public function test()
    {
        ////$data = QueryList::get('https://www.sputtertargets.net')->find('img')->attrs('src');
        ////dd($data->all());
        //$html = file_get_contents('https://querylist.cc/');
        //$ql = QueryList::html($html);
        ////$ql->setHtml($html);
        //$html = $ql->getHtml();
        //echo $html;
        //$rules = [
        //    'test' => ['.ContentItem-title>.QuestionItem-title>a','text']
        //];
        //$ql = QueryList::get('http://www.zhihu.com/people/Guo_ShiXin',[],[
        //    'headers' => [
        //        //填写从浏览器获取到的cookie
        //        'Cookie' => "q_c1=5f1cf0c484dc4602acc55a9ad251d150|1528795371000|1520322132000; _zap=cc130f68-9308-48de-99ac-3d93a2afc03f; __DAYU_PP=2V26urVRjNRaNQeBrYeq2cc9c91f7786; d_c0=\"AABg-4JZjg2PTnNF6CamCrDUztLgt4k43TI=|1525671223\"; __utma=51854390.651866715.1526024126.1526024126.1526024126.1; __utmz=51854390.1526024126.1.1.utmcsr=zhihu.com|utmccn=(referral)|utmcmd=referral|utmcct=/people/Guo_ShiXin/activities; __utmv=51854390.100--|2=registration_date=20170606=1^3=entry_date=20170606=1; tgw_l7_route=1c2b7f9548c57cd7d5a535ac4812e20e; _xsrf=e420bc32-4167-4740-bcce-99275b572966"
        //    ]
        //]);
        //->rules($rules)->query();
        //echo $ql->getHtml();
        //$data = $ql->getData();
        //$return = $data->all();
        //return $return;
        $parser = new Parser();
        $test = '## About US
Laravel5.5+Bootstrop3.0开发的SPIDER框架
## Follow me
开源是一种精神
* github：https://github.com/EricGSX/spider.git
* gitee：https://gitee.com/EricGuosx/spider.git';
        $html = $parser->makeHtml($test);
        //dd($html);
        return view('welcome',compact('html'));
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
        $form->find('input[name=login]')->val('...');
        $form->find('input[name=password]')->val('...');
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
            //$rules=[
            //    'name' => ['h2','text'],
            //    //'img'  => ['.avatar-upload-container>img','src'],
            //];
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

        $post['login'] ='...';//根据你要模拟登陆的网站具体的传值 名称来定

        $post['password'] ='...';//根据你要模拟登陆的网站具体的传值 名称来定

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

    /**
     * TODO COOKIE
     */
    public function cookie()
    {
        $url = 'https://gitee.com/EricGuosx/events';
        //$cookie1 = '__guid=58162108.337714553932506300.1528768899751.9749; _octo=GH1.1.989997131.1528768901; _gat=1; logged_in=no; _gh_sess=RkRHTmZ3TmFqZjJqU3h1MjdwU3VrcVZzL1ZwM25EQWhDaFBiSkQybTA4UGZDZmZoMEtNQlJBWVZKeVRpaTFlUlkwdzZIWE5Rakt0OCtZK0JOSWJBMmpxZnUwdFg5ZXZKa3RzLzRTazJteHBQY01TVE01endoQWd3RWJYN0RiVzk1TUJiNHV1OFdKaUhSdmJuSHpoSm5Xd0ZiZmpMckduSDkrQWN2WDZtaytscGl1NTFxNmRHWURhRGlUN1VhZ1MxZWdtWGZYb3k4YWNxNWM1S3FNUUUwRUJEVDY4blhxeDcyalJvYUJ4NGhYSmlPZGxXNHluSFY0d2FhYXg1Tk1xUk5jOWI4MEpTaysrTmRTaGJvdjd4QXhVM3lCK3pIcERYSWRxMmg3dEgvK3J6ekV0YzdnVDliTXpRSnNFUGhVcDB3NndqYUFpSUYvcWRGWmtac3pZVzUzeVZoUm5iM0JVbGE1L1hpMnBVeEtYOVhvdE5vekgrbjhGNXp0OUkySjlSQXhZbnJjeStQRDhyQk1ucGNIUXllZz09LS04V2hNN2JyUWEwYm1Dd0ZDaDRlcTJnPT0%3D--eb9458685fdc2f56f9698bf0bc5680f988316a12; monitor_count=7; _ga=GA1.2.1633717949.1528768901; tz=Asia%2FShanghai';
        $cookie = 'user_locale=zh-CN; remote_way=http; Hm_lvt_7783e85c2ed70224593599fbefdc168a=1521093352,1521093434; oschina_new_user=false; aliyungf_tc=AQAAAC/nJUt46gsAGUBMLdE0nsVKX616; tz=Asia%2FShanghai; Hm_lvt_24f17767262929947cc3631f99bfd274=1528789358; __lnkrntdmcvrd=-1; Hm_lpvt_24f17767262929947cc3631f99bfd274=1528789590; gitee-session-n=BAh7CkkiD3Nlc3Npb25faWQGOgZFVEkiJTAxNzlhMDY0OTYzZDE2OWY3MDljZDgyNjA3NTRiMGUzBjsAVEkiF21vYnlsZXR0ZV9vdmVycmlkZQY7AEY6CG5pbEkiGXdhcmRlbi51c2VyLnVzZXIua2V5BjsAVFsHWwZpAzXhEkkiIiQyYSQxMCRvaFpJVG9vaWJ2cTZ6VXdUeWNKTTAuBjsAVEkiHXdhcmRlbi51c2VyLnVzZXIuc2Vzc2lvbgY7AFR7BkkiFGxhc3RfcmVxdWVzdF9hdAY7AFRJdToJVGltZQ2HlR3AlUMAsgk6DW5hbm9fbnVtaQHJOg1uYW5vX2RlbmkGOg1zdWJtaWNybyIHIBA6CXpvbmVJIghVVEMGOwBUSSIQX2NzcmZfdG9rZW4GOwBGSSIxVGs1OWRpOFNnRTMvOTMzU0Y0WFVSSUtHRG1zWHBvRWtvQ09QNGo4cldIZz0GOwBG--aa060bacacef04a3a223d4e2750422262c03328a';
        //$cookie2 = '__guid=58162108.337714553932506300.1528768899751.9749; _octo=GH1.1.989997131.1528768901; _gat=1; monitor_count=7; _ga=GA1.2.1633717949.1528768901; tz=Asia%2FShanghai; user_session=aILEzzroQoBOpbtO0pEUxUGXGVrnXWlzDH-6YLiqH3Uq5Ha3; __Host-user_session_same_site=aILEzzroQoBOpbtO0pEUxUGXGVrnXWlzDH-6YLiqH3Uq5Ha3; logged_in=yes; dotcom_user=EricGSX; _gh_sess=R1V3ZGxsQm9IemI0TkJ6SkdJQllxUXJ0K3dXSWMzSWRCeEhVMUI3NnlLN3V0dlpCMmhSUTVlZERsNlRudC96ZFo0SGdSdlczaFFSWW1NeWhrMWpHQkZLVW9nWndxTGVJOXUrZFlVMXJjTE9pSU5SN2ZxMjE4aFpKM0d5c2RaQ3NzNHdoeU15TEQ3STNFOVJSeVFoZUxQbndkZGtSTGN5L2I4MzlBTXdmNnpvRnRWYmtEdGZpam1vTjNHeDFGSmp2dllISlY2VGJXemlqeTE4VjVpdUVHZlB0a0ROajJsMW5XRVdkenBSZ05CUT0tLXNjOVhMQnpwVVhGNjdnNzR1cjFKSFE9PQ%3D%3D--6cf14242a7fcecb2ecdee28c6fac403e26791453';
        $ql = QueryList::get($url,[],[
            'headers'=>[
                'Cookie'    => $cookie,
            ]
        ]);
        echo $ql->getHtml();
    }

    /**
     * TODO 验证curl
     */
    public function checkcurl()
    {
        $curl = curl_init();// 初始化
        // 准备提交的表单数据之账号和密码。（这个是根据表单选项来的）
        $data = "login=...&password=6481485" ;
        // 这个配置是为了防盗链，
        curl_setopt($curl,CURLOPT_REFERER,"...");
        // 基本配置
        curl_setopt($curl, CURLOPT_URL, 'https://github.com/login');// 网址
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);// 不输出
        curl_setopt($curl, CURLOPT_POST, 1);// POST方式
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data);// POST数据
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(// 头部信息类型
            "content-type: application/x-www-form-urlencoded",
        ));
        // Cookie相关设置
        date_default_timezone_set("PRC");
        curl_setopt($curl,CURLOPT_COOKIESESSION,TRUE);// 开启cookie和session
        curl_setopt($curl,CURLOPT_COOKIEFILE,"cookiefile");// 存储名称
        curl_setopt($curl,CURLOPT_COOKIEJAR,"cookiefile");// 存储名称
        curl_setopt($curl,CURLOPT_COOKIE,session_name()."=".session_id());// 存储的是session_name()和session_id()
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);// 设置可以跳转
        curl_setopt($curl,CURLOPT_HEADER,0);// 不去打印头部信息

        curl_setopt($curl,CURLOPT_REFERER,"https://github.com");
        // 设置一下跳转页面
        // curl_setopt($curl,CURLOPT_URL,"http://www.ydma.cn/user/52897/learn");
        curl_setopt($curl,CURLOPT_URL,"https://github.com/settings/profile");
        curl_setopt($curl,CURLOPT_POST,0);
        curl_setopt($curl,CURLOPT_HTTPHEADER,array("Content-type:text/html"));
        curl_setopt($curl,CURLOPT_REFERER,"https://github.com");
        $res = curl_exec($curl);
        curl_close($curl);

        dd($res);
    }

    /**
     * TODO 爬取知乎信息
     */
    public function zhihu()
    {
        $username = 'Guo_ShiXin';
        $cookie = 'q_c1=5f1cf0c484dc4602acc55a9ad251d150|1528795371000|1520322132000; _zap=cc130f68-9308-48de-99ac-3d93a2afc03f; __DAYU_PP=2V26urVRjNRaNQeBrYeq2cc9c91f7786; d_c0=\"AABg-4JZjg2PTnNF6CamCrDUztLgt4k43TI=|1525671223\"; __utma=51854390.651866715.1526024126.1526024126.1526024126.1; __utmz=51854390.1526024126.1.1.utmcsr=zhihu.com|utmccn=(referral)|utmcmd=referral|utmcct=/people/Guo_ShiXin/activities; __utmv=51854390.100--|2=registration_date=20170606=1^3=entry_date=20170606=1; tgw_l7_route=8605c5a961285724a313ad9c1bbbc186; _xsrf=208a6e97-d82a-4aca-a3e7-2b95ca595896';
        $url_info = 'http://www.zhihu.com/people/' . $username; //此处cui-xiao-zhuai代表用户ID,可以直接看url获取本人id
        $ch = curl_init($url_info); //初始化会话
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  //取消SSL验证
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);  //设置请求COOKIE
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727;http://www.baidu.com)');
        $result = curl_exec($ch);
        curl_close($ch);          // 关闭cURL
//var_dump($result);die;// var_dump(curl_errno($ch));
        // $info = curl_getinfo($ch);
        // var_dump(curl_error($ch));
        //file_put_contents('./'.$username.'.html',$result);
        $result = html_entity_decode($result);
        //file_put_contents('./'.$username.'.html',$result);
        //dd($result);
//        return true;
        // TODO 细分数据
        preg_match("/ data-state=\"{\".+}}}\"/", $result,$b);
        //dd($b);
        $json_data = str_replace(' data-state="','',$b);
        //print_r($json_data[0]);
        $json = $json_data[0];
        $json = rtrim($json,'"');
        //print_r($json);
        $arr = json_decode($json,true);
        dd($arr);
    }

    /**
     * 测试自动引入的类是否执行
     *
     * @return string
     */
    public function test_spider()
    {
        $test =new Spider();
        $result = $test->test();
        return $result;
    }
}
