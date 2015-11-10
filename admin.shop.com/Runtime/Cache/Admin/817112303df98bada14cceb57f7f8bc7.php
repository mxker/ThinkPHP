<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - <?php echo ($meta_title); ?> </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />

    <!--预留的一个块. 为了让子模板覆盖它加入自己的css-->

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>"><?php echo mb_substr($meta_title,2,null,'utf-8');?>列表</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?></span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
   
    <form method="post" action="<?php echo U();?>">
        <table cellspacing="1" cellpadding="3" width="100%">
                        <tr>
                <td class="label">名称</td>
                <td>
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>">                    <span class="require-field">*</span>
                </td>
            </tr>
                        <tr>
                <td class="label">经验值下限</td>
                <td>
                    <input type="text" name="bottom" maxlength="60" value="<?php echo ($bottom); ?>">                    <span class="require-field">*</span>
                </td>
            </tr>
                        <tr>
                <td class="label">经验值上限</td>
                <td>
                    <input type="text" name="top" maxlength="60" value="<?php echo ($top); ?>">                    <span class="require-field">*</span>
                </td>
            </tr>
                        <tr>
                <td class="label">折扣率</td>
                <td>
                    <input type="text" name="discount" maxlength="60" value="<?php echo ($discount); ?>">                    <span class="require-field">*</span>
                </td>
            </tr>
                        <tr>
                <td class="label">摘要</td>
                <td>
                    <textarea name="intro" cols="60" rows="4"><?php echo ($intro); ?></textarea>
                    <span class="require-field">*</span>
                </td>
            </tr>
                        <tr>
                <td class="label">状态</td>
                <td>
                    <input type="radio" class="status" value="1" name="status"/>是<input type="radio" class="status" value="0" name="status"/>否                    <span class="require-field">*</span>
                </td>
            </tr>
                        <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>">                    <span class="require-field">*</span>
                </td>
            </tr>
                        <tr>
                <td colspan="2" align="center"><br />
                    <input type="hidden"  name="id" value="<?php echo ($id); ?>" />
                    <input type="submit" class="button ajax-post" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
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

    <!--预留的一个块. 为了让子模板覆盖它加入自己的css-->

</body>
</html>