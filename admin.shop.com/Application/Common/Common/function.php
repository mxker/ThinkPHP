<?php
/**
 * 该文件的名字必须叫做 function.php
 */


/**
 * 数据验证的错误信息展示
 * @param $model
 * @return string
 */
function showErrors($model)
{
    $errors = $model->getError();
    $msg = '<ul>';
    if(is_array($errors)){  //如果是数组,拼装
        foreach ($errors as $error) {
            $msg .= "<li>{$error}</li>";
        }
    }else{ //如果不是数组,直接拼装
        $msg .= "<li>{$errors}</li>";
    }

    $msg .= '</ul>';
    return $msg;
}

/**
 * 返回数组$rows中键值为$column_key的列
 * @param $rows
 * @param $column_key
 * @return array
 */
if(!function_exists('array_column')){
    function array_column($rows,$column_key){
        $temp = array();
        foreach($rows as $row){
            $temp[] = $row[$column_key];
        }
        return $temp;
    }

    /**
     * 根据传入的name和rows生成一个下拉列表的html
     * @param $name
     * @param $rows
     * @param $defaultValue
     * @param string $fieldValue
     * @param string $fieldName
     */
    function arr2select($name,$rows,$defaultValue,$fieldValue='id',$fieldName='name'){
        $html = "<select name='{$name}' class='{$name}'>
                    <option value=''>------请选择------</option>";
        foreach($rows as $row){
            //根据默认值比对每一行,从而生成selected='selected',然后在option中使用.
            $selected  = '';
            if($row[$fieldValue]==$defaultValue){
                $selected = "selected='selected'";
            }
            $html.="<option value='{$row[$fieldValue]}' {$selected}>{$row[$fieldName]}</option>";
        }
        $html.="</select>";
        echo $html;
    }
}