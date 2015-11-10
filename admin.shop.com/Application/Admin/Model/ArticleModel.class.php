<?php
namespace Admin\Model;


use Think\Model;
use Think\Page;

class ArticleModel extends BaseModel
{
    protected $_validate = array(
        array('name','require','标题不能够为空!'),
        array('article_category_id','require','文章分类不能够为空!'),
        array('times','require','浏览次数不能够为空!'),
        array('inputtime','require','录入时间不能够为空!'),
        array('status','require','状态不能够为空!'),
        array('sort','require','排序不能够为空!'),
    );
    protected $_auto = array(
        array('inputtime',NOW_TIME)
    );

}