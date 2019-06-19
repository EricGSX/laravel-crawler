<?php
/**
 * QiniuCloud.php
 * User: Eric.Guo
 * Date: 2019/6/19
 * Time: 17:05
 *
 * TODO：七牛云工具类
 */
namespace App\Libs;
use Qiniu\Auth as QiniuAuth;
use Qiniu\Storage\UploadManager;
class QiniuCloud
{
	protected $token;

	public function __construct()
	{
        $accessKey = env('QINIU_AK');
        $secretKey = env('QINIU_SK');
        // 初始化签权对象
        $auth = new QiniuAuth($accessKey, $secretKey);
        $expires = 3600;
        $policy = null;
        $bucket = 'eric-guo';
        $this->token = $auth->uploadToken($bucket, null, $expires, $policy, true);
	}

	/**
	 * TODO 上传七牛云
	 * 
	 * @param  string $filepath [本地路径]
	 * @param  [type] $key      [文件名]
	 * @return [type]           [description]
	 */
	public function qiniu_upload($filePath='',$key='default.jpg')
	{
        try{
	        // 要上传文件的本地路径
	        $filePath = $filePath;
	        if(!$filePath){
	        	return 'File Path not be null';
	        }
	        // 上传到七牛后保存的文件名
	        $key = $filename;
	        // 初始化 UploadManager 对象并进行文件的上传。
	        $uploadMgr = new UploadManager();
	        // 调用 UploadManager 的 putFile 方法进行文件的上传。
	        list($ret, $err) = $uploadMgr->putFile($this->token, $key, $filePath);
	        unlink($filePath);
	        if ($err !== null) {
	            return($err);
	        } else {
	            return($ret);
	        }
        }catch(\Exception $e){
        	return $e->getMessage();
        }
	}
}