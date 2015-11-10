<?php
namespace Admin\Controller;

use Think\Controller;

class ArticleController extends BaseController
{
    protected $meta_title = '文章';
    /**
     *准备文章分类数据
     */
    protected function _before_edit_view(){
        $articleCategoryModel = D('ArticleCategory');
        $articleCategorys  = $articleCategoryModel->getShowList();
        $this->assign('articleCategorys',$articleCategorys);
    }

    /**
     *
     */
    public function add(){
        if (IS_POST) {
            //>>1.使用模型中的create方法收集并且验证, 自动完成
            if (($data = $this->model->create()) !== false) {
                $data['content'] = I('post.content','',false);
                //>>3.添加到数据库中
                if ($this->model->add($data) !== false) {
                    $this->success('添加成功!', cookie('__forward__'));
                    return;  //防止后面的代码执行.
                }
            }
            $this->error('操作失败!' . showErrors($this->model));
        } else {
            $this->_before_edit_view();
            $this->assign('meta_title', '添加' . $this->meta_title);
            $this->display('edit');
        }
    }

    /**
     * 根据关键字搜索
     * @param $keyword
     */
    public function search($keyword){
        $articleModel = D('Article');
        $wheres = array();
        $wheres['name'] = array('like',"%".$keyword."%");
        $rows = $articleModel->getShowList("id,name",$wheres);
        $this->ajaxReturn($rows);
    }
}