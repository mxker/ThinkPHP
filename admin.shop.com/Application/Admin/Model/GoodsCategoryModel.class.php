<?php
namespace Admin\Model;


use Admin\Service\NestedSetsService;
use Think\Model;
use Think\Page;

class GoodsCategoryModel extends BaseModel
{
    protected $_validate = array(
        array('name','require','名称不能够为空!'),
        array('lft','require','左边界不能够为空!'),
        array('rght','require','右边界不能够为空!'),
        array('level','require','级别不能够为空!'),
        array('status','require','状态不能够为空!'),
        array('sort','require','排序不能够为空!'),
    );

    /**
     * 获取所有的数据
     * @return mixed
     */
    public function getList(){
        return $this->where('status>=0')->order('lft')->select();
    }
    /**
     * 覆盖add方法加入自己的业务逻辑
     */
    public function add(){
        //>>1.使用NestedSetService业务类完成 边界的运算
        $dbMysqlInterfaceImplModel  = new DbMysqlInterfaceImplModel();
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel,'goods_category','lft','rght','parent_id','id','level');
        //>>2.才将数据添加到数据表中
        return $nestedSetService->insert($this->data['parent_id'],$this->data,'bottom');
    }

    /**
     * 覆盖父类中的sava方法
     * @return bool
     */
    public function save(){
        //>>1.使用NestedSetService业务类完成 边界的运算
        $dbMysqlInterfaceImplModel  = new DbMysqlInterfaceImplModel();
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel,'goods_category','lft','rght','parent_id','id','level');
        //>>2.移动分类(仅仅移动)
        $result = $nestedSetService->moveUnder($this->data['id'],$this->data['parent_id']);
        if($result===false){
            $this->error = '不能够将父分类作为自己的子分类!';
            return false;
        }
        //>>3.修改改分类的数据(将请求中的数据更新到数据库中)
        return parent::save();
    }

    /**
     * 将id以及id的子分类的状态修改掉
     * @param $id
     * @param $status
     * @return bool
     */
    public function changeStatus($id, $status){
        //>>1.找到id以及子分类的id
        $sql = "select  child.id   from goods_category as parent,goods_category as child where child.lft>=parent.lft and child.rght<=parent.rght and parent.id=$id";
        $rows = $this->query($sql);
        $ids =  array_column($rows,"id");
        //>>2.然后再修改其状态
        return parent::changeStatus($ids,$status);
    }
}