<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/28
 * Time: 17:24
 */
class BaseController extends Controller{
    public function __construct(){
        $this->checkLogin();
    }
    
    //验证用户是否登录
    public function checkLogin()
    {
        //admin是登录成功的时候保存的标识符
        if(!isset($_SESSION['admin'])){
            $this->jump('index.php?p=admin&c=login&a=login','你没登录,请登录!');
        }
    }
}

























