<?php
/**
 * Created by PhpStorm.
 * User: aa
 * Date: 2015/11/5
 * Time: 0:01
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Upload;

class UploaderController extends Controller
{
    /**
     * 利用uploadify插件实现图片的上传
     */
    public function index(){
//        获取图片上传的参数
        $dir = I('post.dir');
//        判断路径是否存在,不存在就实现递归创建
        if(!is_dir(ROOT_PATH.'Uploads/'.$dir)){
            mkdir(ROOT_PATH.'Uploads/'.$dir,0777,true);
        }
//        接受上传的文件保存到上面指定的文件中
        $config = array(
            'exts'         => array(), //允许上传的文件后缀
            'rootPath'     => ROOT_PATH.'Uploads/',
//            'rootPath'     => './', //  ./代表又拍云的每个空间的根目录, 必须是./
            'savePath'     => $dir.'/', //保存路径
//            'driver'       => 'Upyun', // 文件上传驱动
//            'driverConfig' =>  array(   // 上传驱动配置
//                'host'     => 'v0.api.upyun.com', //又拍云服务器
//                'username' => 'itsource', //又拍云操作员用户
//                'password' => 'itsource', //又拍云操作员密码
//                'bucket'   => 'itsource-'.$dir, //空间名称   //itsource-brand
//                'timeout'  => 90, //超时时间
//            )
        );
        $uploader = new Upload($config);
        $info = $uploader->uploadOne($_FILES['Filedata']);
        if($info!==false){
            echo $info['savepath'].$info['savename'];
        }else{
            echo $uploader->getError();
        }
    }
}