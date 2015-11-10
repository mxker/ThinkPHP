<?php
/**
 * Created by PhpStorm.
 * User: aa
 * Date: 2015/11/3
 * Time: 15:39
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BaseModel extends Model
{
    protected $patchValidate = true;

    /**
     * 分页工具条和列表分页功能
     */
    public function getPageResult($wheres = array()){//设置默认值是为了当没有传入条件时,该方法继续使用
//        构建分页工具条
        $wheres['status'] = array('neq', -1);//存放条件,状态不等于-1的情况实现伪删除
        $totalRows = $this->where($wheres)->count();//获取总条数
        $listRows = C('PAGE_SIZE') ? C('PAGE_SIZE') : 10;
        $page = new Page($totalRows, $listRows);
        $pageHtml = $page->show();
//        构建列表数据
        $rows = $this->where($wheres)->limit($page->firstRow, $page->listRows)->select();
        return array('pageHtml' => $pageHtml, 'rows' => $rows);
    }

    /**
     * 实现伪删除
     * @param $id
     * @param $status
     * @return bool
     */
    public function changeStatus($id, $status)
    {
        $data = array('status' => $status);
        if ($status == -1) {
            //表示删除, 将name原始值修改为
            $data['name'] = array('exp', "concat(name,'_del' )");
        }
//        设置更新的条件
        $this->where(array('id' => array('in', $id)));
        return parent::save($data);
    }
    /**
     * 获取status=1并且通过sort排序的数据
     * @return mixed
     */
    public function getShowList($field="*",$wheres=array()){
        $wheres['status'] = 1;
        return $this->where($wheres)->field($field)->order('sort')->select();
    }
}