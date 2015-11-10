<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/8
 * Time: 14:26
 */

namespace Admin\Model;


use Think\Model;

class GoodsGalleryModel extends Model
{
    /**
     * 根据商品的id查询出当前商品的相册数据
     * @param $goods_id
     * @return mixed
     */
    public function getGalleryByGoods_id($goods_id){
          return  $this->field('id,path')->where(array('goods_id'=>$goods_id))->select();
    }
}