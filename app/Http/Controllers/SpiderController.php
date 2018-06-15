<?php
/**
 * SpiderController.php
 * User: Eric.Guo
 * Date: 2018/6/11
 * Time: 16:02
 * Project: OceaniaWebCrawler
 */
namespace App\Http\Controllers;

use App\Libs\Spider;
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

    }

    /**
     * TODO 获取知乎信息
     */
    public function zhihu()
    {
        $username = 'Guo_ShiXin';
        $cookie = 'q_c1=5f1cf0c484dc4602acc55a9ad251d150|1528795371000|1520322132000; _zap=cc130f68-9308-48de-99ac-3d93a2afc03f; __DAYU_PP=2V26urVRjNRaNQeBrYeq2cc9c91f7786; d_c0=\"AABg-4JZjg2PTnNF6CamCrDUztLgt4k43TI=|1525671223\"; __utma=51854390.651866715.1526024126.1526024126.1526024126.1; __utmz=51854390.1526024126.1.1.utmcsr=zhihu.com|utmccn=(referral)|utmcmd=referral|utmcct=/people/Guo_ShiXin/activities; __utmv=51854390.100--|2=registration_date=20170606=1^3=entry_date=20170606=1; tgw_l7_route=8605c5a961285724a313ad9c1bbbc186; _xsrf=208a6e97-d82a-4aca-a3e7-2b95ca595896';
        $curl_url = 'http://www.zhihu.com/people/' . $username; //此处
        $referurl = 'http://www.zhihu.com/';
        $Spider = new Spider();
        $data = $Spider->fakelogin($cookie,$curl_url,$referurl);
        $result = html_entity_decode($data);
        //dd($result);
        preg_match("/data-state=.+}}}\"/", $result,$b);
        $data = $b[0];
        $data = ltrim($data,'data-state=');
        $data = trim($data,'\"');
        dd($data);
    }

    /**
     * TODO segmentfault
     */
    public function sf()
    {
        $curl_url = 'https://segmentfault.com/u/huiwushudedigua/about';
        $referurl = 'https://segmentfault.com/u/huiwushudedigua';
        $cookie = "profile__init--hide=1; PHPSESSID=web2~3bnicjvd6flrlmhivbetj8ckoi; afpCT=1; sf_remember=57e067648103cb08e44d166638b07243; Hm_lvt_e23800c454aa573c0ccb16b52665ac26=1528882490,1528882509,1528939197,1529024942; Hm_lpvt_e23800c454aa573c0ccb16b52665ac26=1529034234; _ga=GA1.2.1252986435.1520478251; _gid=GA1.2.599720607.1528681493; _gat=1";
        $spider = new Spider();
        $data = $spider->fakelogin($cookie,$curl_url,$referurl);
        dd($data);
    }
}