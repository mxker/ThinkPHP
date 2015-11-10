<?php
/**
 * Created by PhpStorm.
 * User: aa
 * Date: 2015/11/3
 * Time: 18:04
 */

namespace Admin\Controller;


use Think\Controller;

class GiiController extends Controller
{
    public function index(){
        if(IS_POST){
            header('Content-type: text/html;charser=utf-8');
//            获取表单中的值
            $table_name = I('post.table_name');
            $name = parse_name($table_name,1);//将用户输入的表名转换成规范的类名
//            通过查询表获取表名的注解
            $sql = "SELECT TABLE_COMMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA
 = '".C(DB_NAME)."' AND TABLE_NAME = '$table_name' ";
            $rows = M()->query($sql);
            $meta_title = $rows[0]['table_comment'];
            defined('TEMPLATE_PATH') or define('TEMPLATE_PATH',ROOT_PATH.'Template/');

            /**********************************生成控制器************************************/
            //            开启ob缓存,将输出到页面上的内容输出到指定的位置
            ob_start();
            require TEMPLATE_PATH.'Controller.tpl';
            $controller_content = ob_get_clean();//获取ob缓存内容并清除
            $controller_content = "<?php\r\n".$controller_content;
            $controller_path = APP_PATH."Admin/Controller/".$name."Controller.class.php";
            file_put_contents($controller_path,$controller_content);//将获取的内容放到指定的位置

            /******************获取表中的每个字段的详细信息,包括注解******************************/
            $sql = "SHOW FULL COLUMNS FROM ".$table_name;
            $fields = M()->query($sql);
            foreach($fields as &$field){
//                将表中的注解内容分离出来,实现在注解的直接使用
                $comment = $field['comment'];
                preg_match('/(.*)?@([a-z]*)\|?(.*)/',$comment,$result);
                if(!empty($result)){
                    $field['comment'] = $result[1];
                    $field['input_type'] = $result[2];
                    if(!empty($result[3])){
                        parse_str($result[3],$option_values);//将"1=是&0=否"注解分解成数组
                        $field['option_values'] = $option_values;
                    }
                }
            }
            unset($field);//避免后面在使用$field出错,因为field也是在foreach中使用

            /**********************************生成模型************************************/
            ob_start();
            require TEMPLATE_PATH.'Model.tpl';
            $model_content = ob_get_clean();//获取ob缓存内容并清除
            $model_content = "<?php\r\n".$model_content;
            $model_path = APP_PATH."Admin/Model/".$name."Model.class.php";
            file_put_contents($model_path,$model_content);//将获取的内容放到指定的位置

            /**********************************生成index页面************************************/
            ob_start();
            require TEMPLATE_PATH.'index.tpl';
            $index_content  = ob_get_clean();
            $view_dir = APP_PATH.'Admin/View/'.$name;  //控制器对应的视图文件夹的目录路径
            if(!is_dir($view_dir)){
                mkdir($view_dir,0777,true);
            }
            $index_path = $view_dir.'/index.html';
            file_put_contents($index_path,$index_content);  //将index内容输出到index.html中

            /**********************************生成edit页面************************************/
            ob_start();
            require TEMPLATE_PATH.'edit.tpl';  //将tpl当做html
            $edit_content  = ob_get_clean();
            $view_dir = APP_PATH.'Admin/View/'.$name;  //控制器对应的视图文件夹的目录路径
            if(!is_dir($view_dir)){
                 mkdir($view_dir,0777,true);
            }
            $edit_path = $view_dir.'/edit.html';
            file_put_contents($edit_path,$edit_content);  //将index内容输出到index.html中

            $this->success('代码生成成功');
        }else{
            $this->display('index');
        }
    }
}