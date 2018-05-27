<?php

//后台首页控制器
class IndexController extends Controller{
    //生成验证码
    public function codeAction()
    {
        //载入验证码类
        $this->library('Captcha');
        $c = new Captcha();
        $c->generateCode();
    }
    public function indexAction(){
        include CUR_VIEW_PATH . 'index.html';
    }

    public function topAction(){
        include CUR_VIEW_PATH . 'top.html';
    }

    public function menuAction(){
        include CUR_VIEW_PATH . 'menu.html';
    }

    public function dragAction(){
        include CUR_VIEW_PATH . 'drag.html';
    }

    public function mainAction(){
        //实例化模型
        $adminModel = new AdminModel('admin');
        $admins = $adminModel->getAdmins();
        var_dump($admins);
        include CUR_VIEW_PATH . 'main.html';
    }
}






















