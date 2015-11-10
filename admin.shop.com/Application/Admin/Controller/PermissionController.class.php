<?php
namespace Admin\Controller;

use Think\Controller;

class PermissionController extends BaseController
{
    protected $meta_title = '权限';

    public function index(){
        $rows = $this->model->getList("id,name,parent_id,status,level,sort,url,intro");
        $this->assign('rows',$rows);
        $this->assign('meta_title',$this->meta_title);
        $this->display('index');
    }


    public function _before_edit_view(){
        //>>1.准备页面上的树需要的数据
        $rows = $this->model->getList();
        $this->assign('nodes',json_encode($rows));
    }
}