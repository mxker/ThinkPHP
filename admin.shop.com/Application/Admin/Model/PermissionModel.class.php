<?php
namespace Admin\Model;


use Admin\Service\NestedSetsService;
use Think\Model;

class PermissionModel extends BaseModel
{
    protected $_validate = array(
        array('name','require','权限名称不能够为空!'),
        array('status','require','状态不能够为空!'),
        array('sort','require','排序不能够为空!'),
    );
    public function add(){
        //>>1.计算左右边界
        $dbMysqlInterfaceImplModel = D('DbMysqlInterfaceImpl');
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel,'permission','lft','rght','parent_id','id','level');
        //>>2.再进行保存
        return $nestedSetService->insert($this->data['parent_id'],$this->data,'bottom');
    }
    public function getList($field='id,name,parent_id'){
        return $this->where('status>=0')->field($field)->order('lft')->select();
    }

    public  function save(){
        //>>1.计算左右边界
        $dbMysqlInterfaceImplModel = D('DbMysqlInterfaceImpl');
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel,'permission','lft','rght','parent_id','id','level');

        //根据当前id查询出父权限的id(数据库中的id)  和  请求中的父权限的id进行对应

        //>>2.进行移动
        $result = $nestedSetService->moveUnder($this->data['id'],$this->data['parent_id']);
        if($result===false){
            $this->error = '移动权限失败!';
            return false;
        }
        return parent::save($this->data);
    }
}