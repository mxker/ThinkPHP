<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - <?php echo ($meta_title); ?> </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />

    <link href="http://admin.shop.com/Public/Admin/ztree/css/zTreeStyle/zTreeStyle.css" rel="stylesheet" type="text/css"/>
    <link href="http://admin.shop.com/Public/Admin/uploadify/uploadify.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .upload-pre-item{
            width: 900px;
            border: 1px #0daa1a dashed;
            position: relative;
        }
        .upload-pre-item a{
            position: absolute;
            color: #0daa1a;
            font-size: 18px;
            border: 1px #0daa1a dashed;
            top: 0px;
            right: 0px;
            display: block;
            /*background-color: #5bfffc;*/
        }
    </style>

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>"><?php echo mb_substr($meta_title,2,null,'utf-8');?>列表</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?></span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
   
    <div id="tabbar-div">
        <p>
            <span class="tab-front">通用信息</span>
            <span class="tab-back">商品描述</span>
            <span class="tab-back">会员价格</span>
            <span class="tab-back">商品属性</span>
            <span class="tab-back">商品相册</span>
            <span class="tab-back">关联文章</span>
        </p>
    </div>
    <form method="post" action="<?php echo U();?>">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">名称</td>
                <td>
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>"> <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">商品分类</td>
                <td>
                    <input type="hidden" name="goods_category_id" class="goods_category_id" maxlength="60" value="<?php echo ($goods_category_id); ?>">
                    <input type="text" disabled="disabled" name="goods_category_text" class="goods_category_text" maxlength="60" value="请选择下面的分类">
                    <span   class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td>
                    <ul id="treeDemo" class="ztree"></ul>
                </td>
            </tr>
            <tr>
                <td class="label">品牌</td>
                <td>
                    <?php echo arr2select('brand_id',$brands,$brand_id);?>
                    <span   class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">供货商</td>
                <td>
                    <?php echo arr2select('supplier_id',$suppliers,$supplier_id);?>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">本店价格</td>
                <td>
                    <input type="text" name="shop_price" maxlength="60" value="<?php echo ($shop_price); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">市场价格</td>
                <td>
                    <input type="text" name="market_price" maxlength="60" value="<?php echo ($market_price); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">库存</td>
                <td>
                    <input type="text" name="stock" maxlength="60" value="<?php echo ($stock); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">是否上架</td>
                <td>
                    <input type="radio" class="is_on_sale" value="1" name="is_on_sale"/>是
                    <input type="radio" class="is_on_sale"  value="0" name="is_on_sale"/>否
                    <span  class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">商品状态</td>
                <td>
                    <input type="checkbox" class="goods_status" name="goods_status[]" value="1">精品
                    <input type="checkbox" class="goods_status" name="goods_status[]" value="2">新品
                    <input type="checkbox" class="goods_status" name="goods_status[]" value="4">热销
                    <span   class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">关键字</td>
                <td>
                    <input type="text" name="keyword" maxlength="60" value="<?php echo ($keyword); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">LOGO</td>
                <td>
                    <input type="file" name="upload-logo" id="upload-logo" maxlength="60">
                    <input type="hidden" class="logo" name="logo" value="<?php echo ($logo); ?>">
                    <div class="upload-img-box" style="display: <?php echo ($logo?'block':'none'); ?>">
                        <div class="upload-pre-item">
                            <img src="/Uploads/<?php echo ($logo); ?>">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label">状态</td>
                <td>
                    <input type="radio" class="status" value="1" name="status"/>是
                    <input type="radio" class="status"  value="0" name="status"/>否 <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100" style="display: none;">
            <tr align="center">
                <td>
                    <textarea name="intro" id="intro"><?php echo ($intro); ?></textarea>
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
            <?php if(is_array($memberLevels)): $i = 0; $__LIST__ = $memberLevels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$memberLevel): $mod = ($i % 2 );++$i;?><tr>
                    <td class="label"><?php echo ($memberLevel["name"]); ?></td>
                    <td>
                        <input type="text" name="memberPrice[<?php echo ($memberLevel["id"]); ?>]" maxlength="60" value="<?php echo ($goodsMemberPrice[$memberLevel['id']]); ?>">
                        <span class="require-field">*</span>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
            <tr>
                <td class="label">商品属性</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="900"  style="display: none">
            <tr align="center">
                <td>
                    <div class="upload-img-box upload-gallery-box">
                        <?php if(is_array($goodsGallerys)): $i = 0; $__LIST__ = $goodsGallerys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsGallery): $mod = ($i % 2 );++$i;?><div class="upload-pre-item" style="display: inline-block">
                                <img src="/Uploads/<?php echo ($goodsGallery["path"]); ?>">
                                <a dbid="<?php echo ($goodsGallery["id"]); ?>" href="javascript:;">X</a>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </td>
            </tr>
            <td>
                <input type="file" id="upload-gallery">
            </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
            <tr>
                <td style="text-align: left">搜索文章：<input type="text" name="keyword" class="keyword"/><input class="search_article" type="button" value="搜索"/></td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: left;width: 50%">
                    <select multiple="multiple" class="left_select" style="width: 80%;height: 300px">
                    </select>
                </td>
                <td  style="text-align: left">
                    <div class="selectedOption">
                        <?php if(is_array($goodsAritcles)): $i = 0; $__LIST__ = $goodsAritcles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsAritcle): $mod = ($i % 2 );++$i;?><input type="hidden" name="article_id[]" value="<?php echo ($goodsAritcle["id"]); ?>"/><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <select multiple="multiple" class="right_select" style="width: 80%;height: 300px">
                        <?php if(is_array($goodsAritcles)): $i = 0; $__LIST__ = $goodsAritcles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsAritcle): $mod = ($i % 2 );++$i;?><option value="<?php echo ($goodsAritcle["id"]); ?>"><?php echo ($goodsAritcle["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
        </table>
        <div style="text-align: center">
            <input type="hidden" name="id" value="<?php echo ($id); ?>"/>
            <input type="submit" class="button" value=" 确定 "/>
            <input type="reset" class="button" value=" 重置 "/>
        </div>
    </form>

</div>

<div id="footer">
共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/common.js"></script>
<script type="text/javascript">
    $(function(){
        //选中是否显示的状态
        $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
    });
</script>

    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/ztree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/uploadify/jquery.uploadify.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://admin.shop.com/Public/Admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://admin.shop.com/Public/Admin/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript">
        $(function(){
            $('.is_on_sale').val([1]);
// ----------------------------------------导航栏效果切换---------------------------------//
            $('#tabbar-div span').click(function(){
//                先改变所有的class属性,再改变点击的class属性
                $('#tabbar-div span').removeClass('tab-front').addClass('tab-back');
                $(this).removeClass('tab-back').addClass('tab-front');
                //找到from中的所有table新让全部隐藏, 然后再将对应的显示出来
                $('form>table').hide();
                var index = $(this).index();//代表点击的第几个span
                $('form>table').eq(index).show();
                if(index==1){
// ----------------------------------------商品在线编辑插件---------------------------------//
                    UE.getEditor('intro',{
                        initialFrameWidth:1100,  //初始化编辑器宽度,默认1000
                        initialFrameHeight:500  //初始化编辑器高度,默认320
                    });
                }
            })

// ----------------------------------------商品分类的树状结构---------------------------------//
            $(function(){
                var setting = {
                    data: {
                        simpleData: {
                            enable: true,
                            pIdKey: "parent_id",
                        },
                    },
                    callback: {
//                        实现分类的点击选择
                        onClick: function(event, treeId, treeNode){
                            $('.goods_category_id').val(treeNode.id);
                            $('.goods_category_text').val(treeNode.name);
                        }
                    }
                };
//              >>2.准备树中需要的数据
                var zNodes = <?php echo ($nodes); ?>;
                //>>3.将id为treeDemo的ul变为一个树, 返回值就是该树的对象
                var treeObject = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
                <?php if(!empty($id)): ?>//下面的代码是编辑时要执行的, 选中商品分类
                    var goods_category_id = <?php echo ($goods_category_id); ?>;
                    var node  = treeObject.getNodeByParam('id',goods_category_id);
                    treeObject.selectNode(node);
                    //并且将选中的节点的id,name设置
                    $('.goods_category_id').val(node.id);
                    $('.goods_category_text').val(node.name);
                    <?php else: ?>
                    //>>4.使用对象中的方法让其展开
                    treeObject.expandAll(true);<?php endif; ?>
            });
// ----------------------------------------商品上传插件---------------------------------//
            window.setTimeout(function(){                 //让上传表单10毫秒之后再加载..
                $("#upload-logo").uploadify({
                    height        : 25,    //指定删除插件的高和宽
                    width         : 145,
                    swf           : 'http://admin.shop.com/Public/Admin/uploadify/uploadify.swf',  //指定swf的地址
                    uploader      : '<?php echo U("Uploader/index");?>',   //在服务器上处理上传的代码
                    'buttonText' : '选择图片',   //上传按钮上面的文字
//            'fileObjName' : 'the_files',  //上传文件时, name的值 ,  默认值为  Filedata     $_FIELS['Filedata']
                    'formData'      : {'dir' : 'goods'},   //通过post方式传递的额外参数 ,, dir表示上传到又拍云的空间  itsource_ $dir的值
                    'multi'    : true,   //是否支持多文件上传
                    'onUploadSuccess' : function(file, data, response) {   //上传成功时执行的方法
                        $('.logo').val(data);
                        $('.upload-img-box').show();
                        $('.upload-img-box img').attr('src',"/Uploads/"+data);
                    },
                    'onUploadError' : function(file, errorCode, errorMsg, errorString) {   //上传失败时该方法执行
                        alert('该文件上传失败!错误信息为:' + errorString);
                    }
                });
            },10)
// ----------------------------------------编辑时回显商品状态---------------------------------//
            <?php if(!empty($id)): ?>var goods_status = <?php echo ($goods_status); ?>;  //该值是一个整数
            var goods_status_values = new Array();
            if((goods_status & 1) > 0){
                goods_status_values.push(1);
            }
            if((goods_status & 2) > 0){
                goods_status_values.push(2);
            }
            if((goods_status & 4) > 0){
                goods_status_values.push(4);
            }
            $('.goods_status').val(goods_status_values);<?php endif; ?>

// ----------------------------------------商品相册上传插件---------------------------------//
            window.setTimeout(function(){                 //让上传表单10毫秒之后再加载..
                $("#upload-gallery").uploadify({
                    height        : 25,    //指定删除插件的高和宽
                    width         : 145,
                    swf           : 'http://admin.shop.com/Public/Admin/uploadify/uploadify.swf',  //指定swf的地址
                    uploader      : '<?php echo U("Uploader/index");?>',   //在服务器上处理上传的代码
                    'buttonText' : '选择图片(支持批量上传)',   //上传按钮上面的文字
                    'fileSizeLimit' : '100KB',  //限制大小
//            'fileObjName' : 'the_files',  //上传文件时, name的值 ,  默认值为  Filedata     $_FIELS['Filedata']
                    'formData'      : {'dir' : 'goods'},   //通过post方式传递的额外参数 ,, dir表示上传到又拍云的空间  itsource_ $dir的值
                    'multi'    : true,   //是否支持多文件上传
                    'onUploadSuccess' : function(file, data, response) {   //上传成功时执行的方法
                        var itemHtml = '<div class="upload-pre-item" style="display: inline-block">\
                                <img src="/Uploads/'+data+'">\
                                <input type="hidden" name="gallery_path[]" value="'+data+'"/> \
                                <a href="javascript:;">X</a>\
                                </div>';
                        $(itemHtml).appendTo('.upload-gallery-box');

                    },
                    'onUploadError' : function(file, errorCode, errorMsg, errorString) {   //上传失败时该方法执行
                        alert('该文件上传失败!错误信息为:' + errorString);
                    }
                });
            },10)

            //删除商品相册的数据
            $('.upload-gallery-box').on('click','a',function(){
                //>>1.判定该图片是否在数据库中存在
                var dbid = $(this).attr('dbid');
                if(dbid){
                    var that = $(this);
                    //>>2. 如果存在,需要发送ajax请求让服务器删除数据库中数据
                    $.post('<?php echo U("deleteGallery");?>',{gallery_id:dbid},function(data){
                        if(data.success){
                            that.closest('div').remove();
                        }
                    });
                }else{
                    //>>3.如果不存在直接从页面上删除
                    $(this).closest('div').remove();
                }
            })

// ---------------------------------------商品关联文章---------------------------------//
            $('.keyword').keypress(function(event){
                if(event.keyCode==13){
                    loadArticle();
                    return false;  //当按回车键的时候取消默认操作
                }
            });
            $('.search_article').click(function(){
                loadArticle();
            });

            //根据关键字查询文章
            function loadArticle(){
                $('.left_select').empty();
                //发送ajax请求
                $.getJSON('<?php echo U("Article/search");?>',{keyword:$('.keyword').val()},function(rows){
                    var option_html = '';
                    $(rows).each(function(){
                        option_html+="<option value='"+this.id+"'>"+this.name+"</option>"
                    });
                    $(option_html).appendTo(".left_select");

                });
            }

            $(".left_select").on('dblclick','option',function(){
                $(this).appendTo('.right_select');
                select2Hidden();
            });
            $('.right_select').on('dblclick','option',function(){
                $(this).appendTo('.left_select');
                select2Hidden();
            });


            //将右边的下拉框中的内容取出生成隐藏域,放到class='selectedOption'的div中
            function select2Hidden(){
                var hiddenHtml = '';
                $('.right_select option').each(function(){
                    hiddenHtml+="<input type='hidden' name='article_id[]' value='"+this.value+"'/>"
                });
                $('.selectedOption').empty();//将隐藏域放到div中之前先清空
                $(hiddenHtml).appendTo(".selectedOption");
            }
        })
    </script>

</body>
</html>