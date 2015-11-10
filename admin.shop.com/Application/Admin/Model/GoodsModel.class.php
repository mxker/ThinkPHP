<?php
namespace Admin\Model;


use Think\Model;
use Think\Page;

class GoodsModel extends BaseModel
{
    protected $_validate_1 = array(
        array('name','require','名称不能够为空!'),
        array('sn','require','货号不能够为空!'),
        array('goods_category_id','require','商品分类不能够为空!'),
        array('brand_id','require','品牌不能够为空!'),
        array('supplier_id','require','供货商不能够为空!'),
        array('shop_price','require','本店价格不能够为空!'),
        array('market_price','require','市场价格不能够为空!'),
        array('stock','require','库存不能够为空!'),
        array('is_on_sale','require','是否上架不能够为空!'),
        array('goods_status','require','商品状态不能够为空!'),
        array('keyword','require','关键字不能够为空!'),
        array('logo','require','LOGO不能够为空!'),
        array('status','require','状态不能够为空!'),
        array('sort','require','排序不能够为空!'),
    );

    /**
     * @param mixed|string $requestData 请求中的所有数据
     * @return bool|mixed
     * $this->data是通过create方法收集的数据, 该数据已经被过滤和自动完成处理了
     * $requestData: 请求中的所有数据
     */
    public function add($requestData){

        $this->startTrans();//开启事务
        //>>1.处理请求中的商品状态 转换为 一个整数
        $this->handleGoodsStatus();
        //>>2.将请求中的内容保存到数据库中
        $id = parent::add();  //一定要调用parent上的add,  因为先保存后才有id的值
        if($id===false){
            $this->rollback();
            return false;
        }
        //>>3.准备货号 并且将货号更新到数据库中       日期+八位的id   20151107000000id
        $sn = date('Ymd').str_pad($id, 8, "0", STR_PAD_LEFT);
        $result = parent::save(array('sn'=>$sn,'id'=>$id));
        if($result===false){
            $this->rollback();
            return false;
        }

        //>>4.处理商品简介
        $result = $this->handleGoodsIntro($id,$requestData['intro']);
        if($result===false){
            return false;
        }
        //>>5.处理商品相册
        $result = $this->handleGoodsGallery($id,$requestData['gallery_path']);  //$requestData['gallery']
        if($result===false){
            return false;
        }

        //>>6.处理关联文章
        $result = $this->handleGoodsArticle($id,$requestData['article_id']);
        if($result===false){
            return false;
        }
        //>>7.处理商品会员价格
        $result = $this->handleGoodsMemberPrice($id,$requestData['memberPrice']);
        if($result===false){
            return false;
        }

        $this->commit();
        return $id;  //保存成功之后返回id
    }

    /**
     * 根据请求中的所有数据进行更新
     * @param mixed|string $requestData  请求中的所有数据
     * @return bool
     */
    public function save($requestData){
        $this->startTrans();
        //>>1.计算商品状态
        $this->handleGoodsStatus();

        //>>2.需要将请求中的商品描述goods_intro中
        /* $goodsIntroModel = M('GoodsIntro');
         $result = $goodsIntroModel->where(array('goods_id'=>$this->data['id']))->setField('intro',$requestData['intro']);
         if($result===false){
             $this->rollback();
             $this->error = '商品描述更新失败!';
             return false;
         }*/
        $result = $this->handleGoodsIntro($this->data['id'],$requestData['intro']);
        if($result===false){
            return false;
        }

        //>>3.处理商品相册
        $result = $this->handleGoodsGallery($this->data['id'],$requestData['gallery_path']);
        if($result===false){
            return false;
        }


        //>>4.处理关联文章
        $result = $this->handleGoodsArticle($this->data['id'],$requestData['article_id']);
        if($result===false){
            return false;
        }
        //>>5.处理会员价格
        $result = $this->handleGoodsMemberPrice($this->data['id'],$requestData['memberPrice']);
        if($result===false){
            return false;
        }

        //>>3.进行更新
        $result = parent::save();
        if($result===false){
            $this->rollback();
            return false;
        }
        $this->commit(); //提交事物
        return $result;
    }
    /**
     * 请求请求中的商品状态的值, 计算出一个整数值代表商品状态
     */
    private function handleGoodsStatus()
    {
        //>>1.处理请求中的商品状态 转换为 一个整数
        $goods_status = 0;
        foreach ($this->data['goods_status'] as $v) {
            $goods_status = $goods_status | $v;   //相与之后得到状态
        }
        $this->data['goods_status'] = $goods_status;
    }
    /**
     * 处理上面描述
     * @param $goods_id  商品的id
     * @param $intro     商品的简介
     * @return bool
     */
    private  function handleGoodsIntro($goods_id,$intro){
        $goodsIntroModel = M('GoodsIntro');
        //先删除原来的,再保存新的, 如果没有原来的无法不用删除
        $goodsIntroModel->where(array('goods_id'=>$goods_id))->delete();
        $result = $goodsIntroModel->add(array('goods_id'=>$goods_id,'intro'=>$intro));
        if($result===false){
            $this->rollback();
            $this->error = '保存商品描述失败!';
            return false;
        }
    }
    /**
     * 将用户上传上来的图片保存保存到goods_gallery表中
     * @param $id   商品id
     * @param $gallery_paths   图片路径
     * @return bool
     */
    private function handleGoodsGallery($id,$gallery_paths){
        //每准备一个小数组将其放到rows中
        $rows = array();
        foreach($gallery_paths as $gallery_path){
            $rows[]=array('goods_id'=>$id,'path'=>$gallery_path);
        }
        if(!empty($rows)){
            $goodsGalleryModel = M('GoodsGallery');
            $result = $goodsGalleryModel->addAll($rows);   //一次性保存多行数据
            if($result===false){
                $this->rollback();
                $this->error  = '保存图片出错!';
                return false;
            }
        }
    }

    /**
     * 根据商品的id和选中的关联文章的id保存到goods_article表中
     * @param $id
     * @param $article_ids
     * @return bool
     */
    private function handleGoodsArticle($id,$article_ids){

        $rows = array();
        foreach($article_ids as $article_id){
            $rows[] =  array('goods_id'=>$id,'article_id'=>$article_id);
        }
        if(!empty($rows)){
            $goodsArticleModel =M('GoodsArticle');
            $goodsArticleModel->where(array('goods_id'=>$id))->delete();  //先删除再添加,完成更新的功能
            $result  = $goodsArticleModel->addAll($rows);
            if($result===false){
                $this->rollback();
                $this->error = '保存相关文章失败!';
                return false;
            }
        }
    }

    /**
     * 会员价格的处理
     * @param $goods_id
     * @param $memberPrices
     * @return bool
     */
    private function handleGoodsMemberPrice($goods_id,$memberPrices){
        //>>1.准备goods_member_price表中需要的数据
        $rows = array();
        foreach($memberPrices as $member_level_id=>$price){
            $rows[] = array('goods_id'=>$goods_id,'member_level_id'=>$member_level_id,'price'=>$price);
        }
        //>>2.再将rows保存到goods_member_price表中
        if(!empty($rows)){
            $goodsMemberPriceModel = M('GoodsMemberPrice');
            //先删除后添加
            $goodsMemberPriceModel->where(array('goods_id'=>$goods_id))->delete();
            $result = $goodsMemberPriceModel->addAll($rows);
            if($result===false){
                $this->error = '保存会员价格失败!';
                $this->rollback();
                return false;
            }
        }
    }
}