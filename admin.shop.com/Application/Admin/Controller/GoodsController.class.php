<?php
namespace Admin\Controller;

use Think\Controller;

class GoodsController extends BaseController
{
    protected $meta_title = '商品';
    /**
     * 在编辑页面展示之前向页面分配说有的 分类数据
     */
    protected function _before_edit_view(){
        //>>1.准备分类数据,分配到页面
        $goodsModel = D('GoodsCategory');
        $goodsCategoryes = $goodsModel->getList();
        $this->assign('nodes',json_encode($goodsCategoryes));
        //>>2.准备品牌数据, 分配到页面
        $brandModel = D('Brand');
        $brands = $brandModel->getShowList();
        $this->assign('brands',$brands);
        //>>3.准备供货商数据, 分配到页面
        $supplierModel = D('Supplier');
        $suppliers = $supplierModel->getShowList();
        $this->assign('suppliers',$suppliers);

        //>>5.准备会员级别的数据,分配到页面
        $memberLevelModel = D('MemberLevel');
        $memberLevels  = $memberLevelModel->getShowList('id,name');
        $this->assign('memberLevels',$memberLevels);


        //>>4.当编辑时
        $id = I('get.id','');
        if(!empty($id)){
            //>>4.1 查询出当前商品对应的描述内容
            $goodsIntroModel = M('GoodsIntro');
            $intro = $goodsIntroModel->getFieldByGoods_id($id,'intro');
            $this->assign('intro',$intro);
            //>>4.2 准备当前商品对应的商品相册
            $goodsGalleryModel = D('GoodsGallery');
            $goodsGallerys = $goodsGalleryModel->getGalleryByGoods_id($id);
            $this->assign('goodsGallerys',$goodsGallerys);

            //>>4.3准备当前上面相关的文章数据
            $goodsArticleModel = D('GoodsArticle');
            $goodsAritcles = $goodsArticleModel->getArticleByGoodsId($id);
            $this->assign('goodsAritcles',$goodsAritcles);

            //>>4.4 根据商品的id将当前商品的会员价格查询出来
            $goodsMemberPriceModel = D('GoodsMemberPrice');
            $goodsMemberPrice = $goodsMemberPriceModel->getMemberPrice($id);
            $this->assign('goodsMemberPrice',$goodsMemberPrice);

        }
    }

    public function edit($id){
        if (IS_POST) {
            //>>1.收集更新的数据
            if ($this->model->create() !== false) {
                $requestData = I('post.');
                $requestData['intro'] = I('post.intro','',false);  //通过第三个参数告知不进行额外处理
                if ($this->model->save($requestData) !== false) {
                    $this->success('更新成功!', cookie('__forward__'));
                    return;
                }
            }
            $this->error('操作失败!' . showErrors($this->model));
        } else {
            //>>2.根据id查询一行记录
            $row = $this->model->find($id);
            //>>3.将数据分配到页面上
            $this->assign($row);
            //>>4.选择视图页面显示
            $this->assign('meta_title', '编辑' . $this->meta_title);
            //>>5.调用钩子函数
            $this->_before_edit_view();

            $this->display('edit');
        }
    }

    /**
     * 根据商品相册的id删除图片
     * @param $gallery_id
     */
    public function deleteGallery($gallery_id){
        $goodsGalleryModel = D('GoodsGallery');

        $result = array('success'=>false);
        if($goodsGalleryModel->delete($gallery_id)!==false){
            $result['success'] = true;
        }
        $this->ajaxReturn($result);
    }
}