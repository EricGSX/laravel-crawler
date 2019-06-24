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
    /**
     * TODO 获取百度CODE
     *
     * @return mixed
     */
	public function getBaiduCode()
	{
        $code = request()->get('code');
        return $code;
	}

    /*
    * 接口数据传输的万能函数
    */
    public static function https_request($url, $data = null){
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
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);  //执行一个cURL会话并且获取相关回复
        curl_close($curl);  //释放cURL句柄,关闭一个cURL会话
        return $response;
    }
}