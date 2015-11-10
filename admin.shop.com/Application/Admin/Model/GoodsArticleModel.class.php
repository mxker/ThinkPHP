<?php

namespace Admin\Model;


use Think\Model;

class GoodsArticleModel extends Model
{
    /**
     * 根据商品的id查询相关联的文章
     * @param $goods_id
     * @return mixed
     */
    public function getArticleByGoodsId($goods_id){
        $sql = "SELECT  a.id,a.name  FROM goods_article as ga  join article as a on ga.article_id = a.id  where  ga.goods_id = $goods_id;";
        return $this->query($sql);
    }

}