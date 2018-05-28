<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/28
 * Time: 17:33
 */
class LoginController extends Controller{
    public function loginAction()
    {
        include CUR_VIEW_PATH.'login.html';
    }

    public function signinAction()
    {
        //1.获取用户名密码
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        //转义用户名和密码过滤特殊字符
        $username = addslashes($username);
        $password = addslashes($password);
        $captcha = trim($_POST['captcha']);
        if(strtolower($_SESSION['captcha']) != $captcha){
            $this->jump('index.php?p=admin&c=login&a=login','验证码错误重新输入');
        }
        //2.验证

        //3.调用模型处理数据
        $adminModel = new AdminModel('admin');
        $user = $adminModel->checkUser($username,$password);

        if($user){
            $_SESSION['admin'] = $user;//登录成功保存标识符
            $this->jump('index.php?p=admin&c=index&a=index','',0);
        }else{
            $this->jump('index.php?p=admin&c=login&a=login','用户名或密码错误');
        }

    }

    public function logoutAction()
    {//删除session中的变量
        unset($_SESSION['admin']);
        //销毁session
        session_destroy();
        $this->jump('index.php?p=admin&c=login&a=login','',0);
    }
//生成验证码
    public function captchaAction()
    {
        //引入验证码类
        $this->library('Captcha');
        //实例化对象
        $captcha = new Captcha();
        $captcha->generateCode();
        $_SESSION['captcha'] = $captcha->getCode();
    }
}


















































