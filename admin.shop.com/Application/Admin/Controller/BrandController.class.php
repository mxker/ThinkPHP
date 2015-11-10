<?php
namespace Admin\Controller;

use Think\Controller;

class BrandController extends BaseController
{
    protected $meta_title = '品牌';

    public function add()
    {
        if (IS_POST) {
            //>>1.使用模型中的create方法收集并且验证, 自动完成
            if ($this->model->create() !== false) {
                //>>3.添加到数据库中
                if ($this->model->add() !== false) {
                    $this->success('添加成功!', cookie('__forward__'));
                    return;  //防止后面的代码执行.
                }
            }
            $this->error('操作失败!' . showErrors($this->model));
        } else {
            $this->assign('meta_title', '添加' . $this->meta_title);
            $this->display('edit');
        }
    }
}