<?php
/**
 * Created by PhpStorm.
 * User: aa
 * Date: 2015/11/2
 * Time: 19:05
 */

namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller
{
//      统一创建模型对象
    protected $model;
    public function _initialize()
    {
        $this->model = D(CONTROLLER_NAME);//CONTROLLER_NAME当前控制器
    }

    /**
     * 供货商列表展示
     */
    public function index()
    {
//        搜索功能,将查找条件放进一个数组,实现后期更多条件的加入
        $wheres = array();
        $keyword = I('get.keyword');
        if (!empty($keyword)) {
            $wheres['name'] = array('like', "%$keyword%");
        }

        $pageResult = $this->model->getPageResult($wheres);
        $this->assign($pageResult);
        $this->assign('meta_title',$this->meta_title); //分配到列表页面上显示
        //将当前列表的url保存到cookie中,为了 删除,添加,修改状态,编辑 之后跳转到该地址
        cookie('__forward__', $_SERVER['REQUEST_URI']);
        $this->display('index');
    }

    /**供货商删除
     * @param $id
     */
    public function delete($id)
    {
        $result = $this->model->changeStatus($id, -1);
        if ($result !== false) {
            $this->success('删除成功', cookie('__forward__'));
        } else {
            $this->error('删除失败' . showErrors($this->model));
        }
    }

    /**
     * 添加供货商
     */
    public function add()
    {
        if (IS_POST) {
//           判断是否获取数据
            if ($this->model->create() !== false) {
//                判断添加是否成功
                if ($this->model->add() !== false) {
                    $this->success('添加成功', cookie('__forward__'));
                    return;//防止后面代码继续执行
                }
            }
            $this->error('添加失败' . showErrors($this->model));
        } else {
            $this->_before_edit_view();
            $this->assign('meta_title', '添加' . $this->meta_title);
            $this->display('edit');
        }
    }
    /**
     * 主要是被子类覆盖..  在编辑页面展示之前向编辑页面上分配数据
     */
    protected function _before_edit_view(){
//        所谓的钩子方法
    }
    /**
     * 供货商信息的更改
     * @param $id
     */
    public function edit($id)
    {
        if (IS_POST) {
            if ($this->model->create() !== false) {
                if ($this->model->save() !== false) {
                    $this->success('更新成功', cookie('__forward__'));
                    return;
                }
            }
            $this->error('更新失败' . showErrors($this->model));
        } else {
            $this->_before_edit_view();
            $row = $this->model->find($id);
            $this->assign($row);
            $this->assign('meta_title', '编辑' . $this->meta_title);
            $this->display('edit');
        }
    }

    /**
     * 根据status的值变更显示图标,同时实现数据的移除功能
     * @param $id
     * @param int $status
     */
    public function changeStatus($id, $status = -1)
    {
        //直接使用SupplierModel中的changeStatus方法修改
        $result = $this->model->changeStatus($id, $status);
        if ($result !== false) {
            $this->success('操作成功!', cookie('__forward__'));
        } else {
            $this->error('操作失败!');
        }
    }
}