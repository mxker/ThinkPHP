$(function(){
  //列表中复选框的特效
    //>>通过全选的状态控制下面的状态
    $('.all').change(function(){
        $('.id').prop('checked',$(this).prop('checked'));
    });
    //>>在所有的class=id的复选框上加上change事件
    $('.id').change(function(){
        $('.all').prop('checked',$('.id:not(:checked)').length==0);
    });


//>>1.向带有class='ajax-get'的标签上加上点击事件,事件处理函数发送ajax的get请求
    $('.ajax-get').click(function () {
        var url = $(this).attr('href'); //获取标签上面的href的url地址,该地址就是我们要发送的请求地址
        $.get(url, function (data) {
            //>>2.使用layer提示
            showLayer(data);
        });
        return false;//取消默认操作
    });


//>>2.页面加载完之后找到 class='ajax-post' 的标签加上点击事件,并且发送ajax的post请求
    $('.ajax-post').click(function () {
        var form = $(this).closest('form');//如果找到form,说明提交的是表单
        var url = form.length==0?$(this).attr('url'):form.attr('action');  //找到form上的action属性作为url
        var param = form.length==0?$('.id').serialize():form.serialize();  //获取form上的所有请求参数
        //>>2.1发送post请求
        $.post(url, param, function (data) {
            //>>2.使用layer提示
            showLayer(data);
        });
        return false;//取消默认提交
    });

    /**
     * 根据data中的值弹出提示框
     * @param data
     */
     function showLayer(data){
         layer.msg(data.info, {
             icon: data.status ? 1 : 0,
             offset: 0,
             shift: 10,
             time: 1500  //1.5秒钟之后执行下面的函数
         }, function () {
             if (data.status) {  //成功的时候跳转到指定的url地址
                 location.href = data.url;
             }
         });
     }






});