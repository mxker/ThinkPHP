<?php
defined('WEB_URL') or define('WEB_URL','http://admin.shop.com');
return array(
    'TMPL_PARSE_STRING'  =>array(
//        css|js|img 的网络绝对路径
        '__CSS__' => WEB_URL.'/Public/Admin/css',
        '__JS__'     => WEB_URL.'/Public/Admin/js',
        '__IMG__' => WEB_URL.'/Public/Admin/images',
        '__LAYER__' => WEB_URL.'/Public/Admin/layer/layer.js', // 增加新的上传路径替换规则
        '__UPLOADIFY__' => WEB_URL.'/Public/Admin/uploadify',
        '__ONE__' => "http://mxker-one.b0.upaiyun.com", // one又拍云空间中的地址
        '__BRAND__' => "http://itsource-brand.b0.upaiyun.com", // brand又拍云空间中的地址
        '__GOODS__' => "http://itsource-goods.b0.upaiyun.com", // goods又拍云空间中的地址
        '__TREEGRID__' => WEB_URL.'/Public/Admin/treegrid',//树状结构插件
        '__ZTREE__' =>  WEB_URL.'/Public/Admin/ztree',//树状插件
        '__UEDITOR__'=> WEB_URL.'/Public/Admin/ueditor',//在线编辑器
    )
);