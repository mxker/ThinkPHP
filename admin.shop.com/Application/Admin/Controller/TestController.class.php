<?php
/**
 * Created by PhpStorm.
 * User: aa
 * Date: 2015/11/5
 * Time: 17:55
 */

namespace Admin\Controller;


use Think\Controller;

class TestController extends Controller
{
    public function index(){
        phpinfo();
    }
}