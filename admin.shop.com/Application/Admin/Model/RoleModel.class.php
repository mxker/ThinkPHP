<?php
namespace Admin\Model;


use Think\Model;
use Think\Page;

class RoleModel extends BaseModel
{
    protected $_validate = array(
        array('name','require','角色名称不能够为空!'),
array('status','require','状态不能够为空!'),
array('sort','require','排序不能够为空!'),
    );
}