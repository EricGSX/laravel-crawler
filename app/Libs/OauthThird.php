<?php
/**
 * OauthThird.php
 * User: Eric.Guo
 * Date: 2019/6/19
 * Time: 17:05
 *
 * TODO：第三方登陆
 */
namespace App\Libs;
class OauthThird
{
    
	private function getBaiduCode()
	{
	    //DOC http://developer.baidu.com/wiki/index.php?title=docs/oauth/rest/file_data_apis_list

        $code = request()->get('code');
        return $code;
	}

    public function getBaiduAccessToken()
    {
        $code = $this->getBaiduCode();
        $redirect_uri  = env('BAIDU_REDIRECT_URI');
        $client_secret = env('BAIDU_SECRET_KEY');
        $client_id     = env('BAIDU_API_KEY');
        $url           = "https://openapi.baidu.com/oauth/2.0/token?grant_type=authorization_code&code=$code&client_id=$client_id&client_secret=$client_secret&redirect_uri=$redirect_uri";
        # 发送CURL，获得Access_Token
        $res           = $this->https_request($url);
        $data          = json_decode($res, true);
        return $data['access_token'];
    }

    public function getBaiduUserinfo($accessToken='')
    {
        $access_token = $accessToken;
        $url  = 'https://openapi.baidu.com/rest/2.0/passport/users/getLoggedInUser?access_token='.$access_token;
        $res  = $this->https_request($url);
        $userinfo = json_decode($res, true);
        return $userinfo;
    }

    public function baiduLogout($accessToken='')
    {
        $access_token = $accessToken;
        $url  = 'https://openapi.baidu.com/rest/2.0/passport/auth/revokeAuthorization?access_token='.$access_token;
        $res  = $this->https_request($url);
        $result = json_decode($res, true);
        return $result;
    }

    public function getGithubCode()
    {
        $code = request()->get('code');
        return $code;
    }

    public function getGithubAccessToken()
    {
        //https://alone88.cn/archives/525.html
        $code = $this->getGithubCode();
        $data = [
            'client_id'=>env('GITHUB_CLIENTID'),
            'client_secret'=>env('GITHUB_SECRET_KEY'),
            'code'=>$code,
            'redirect_uri'=>env('GITHUB_REDIRECT_URI'),
            'grant_type'=>'authorization_code',
        ];
        $url = "https://github.com/login/oauth/access_token";
        $res = $this->https_request($url,$data);
        return $res;
    }

    public function getGithubUserinfo($accessToken='')
    {
        $access_token = $accessToken;
        $url  = 'https://api.github.com/user?'.$access_token;
        $res  = $this->https_request($url,null,true);
        $result = json_decode($res, true);
        return $result;
    }

    public function getGiteeCode()
    {
        $code = request()->get('code');
        return $code;
    }

    public function getGiteeAccessToken()
    {
        //https://www.whongbin.cn/index/article/detail/id/26.html
        $code = $this->getGiteeCode();
        $data = [
            'client_id'=>env('GITEE_CLIENTID'),
            'client_secret'=>env('GITEE_SECRET_KEY'),
            'code'=>$code,
            'redirect_uri'=>env('GITEE_REDIRECT_URI'),
            'grant_type'=>'authorization_code',
        ];
        $url = "https://gitee.com/oauth/token";
        $res = $this->https_request($url,$data);
        return json_decode($res,true)['access_token'];
    }

    public function getGiteeUserinfo($accessToken='')
    {
        $access_token = $accessToken;
        $url  = 'https://gitee.com/api/v5/user?access_token='.$access_token;
        $res  = $this->https_request($url);
        $result = json_decode($res, true);
        return $result;
    }

    public function getQqCode()
    {
        //DOC https://wiki.connect.qq.com/%E5%BC%80%E5%8F%91%E6%94%BB%E7%95%A5_server-side
        $code = request()->get('code');
        return $code;
    }

    public function getQqAccessToken()
    {
        $client_id = env('QQ_APP_ID');
        $client_secret = env('QQ_APP_KEY');
        $redirect_uri = env('QQ_REDIRECT_URI');
        $code = $this->getQqCode();
        $url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=$client_id&client_secret=$client_secret&code=$code&redirect_uri=$redirect_uri";
        $res = $this->https_request($url);
        return $res;
    }

    public function getQqOpenID($token='')
    {
        $token = $token;
        $url = "https://graph.qq.com/oauth2.0/me?access_token=$token";
        $res = $this->https_request($url);
        $callback = trim(trim($res),'callback');
        $callback = ltrim($callback,'(');
        $callback = rtrim($callback,');');
        return json_decode($callback,TRUE);
    }

    public function getQqUserinfo($token='',$openid=[])
    {
        $token = $token;
        $client_id = $openid['client_id'];
        $openid_str = $openid['openid'];
        $url = "https://graph.qq.com/user/get_user_info?access_token=$token&oauth_consumer_key=$client_id&openid=$openid_str";
        $res = $this->https_request($url);
        return $res;
    }

    public function getWeiboCode()
    {
        //DOC https://open.weibo.com/wiki/2/users/show
        $code = request()->get('code');
        return $code;
    }

    public function getWeiboAccessToken()
    {
        $code = $this->getWeiboCode();
        $data = [
                'user_post' => 'null_post'
        ];
        $client_id = env('WEIBO_APP_KEY');
        $client_secret = env('WEIBO_APP_SECRET');
        $redirect_uri = env('WEIBO_REDIRECT_URI');
        $url = "https://api.weibo.com/oauth2/access_token?client_id=$client_id&client_secret=$client_secret&grant_type=authorization_code&code=$code&redirect_uri=$redirect_uri";
        $res = $this->https_request($url,$data);
        return json_decode($res,true);
    }

    public function getWeiboUserinfo($accessToken=[])
    {
        $token = $accessToken['access_token'];
        $uid = $accessToken['uid'];
        $url = "https://api.weibo.com/2/users/show.json?access_token=$token&uid=$uid";
        $userinfo = $this->https_request($url);
        return $userinfo;
    }

    public static function https_request($url, $data = null,$ua=null){
        # 初始化一个cURL会话
        $curl = curl_init();
        //设置请求选项, 包括具体的url
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  //禁用后cURL将终止从服务端进行验证
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);  //设置为post请求类型
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);  //设置具体的post数据
        }
        if($ua){
            $useragent = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11";
            curl_setopt($curl, CURLOPT_USERAGENT, $useragent);        //模拟常用浏览器的useragent
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);  //执行一个cURL会话并且获取相关回复
        curl_close($curl);  //释放cURL句柄,关闭一个cURL会话
        return $response;
    }

}