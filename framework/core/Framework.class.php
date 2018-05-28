<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/26
 * Time: 23:22
 */
class Framework{
    public static function run(){
        self::init();
        self::autoload();
        self::dispatch();
    }

    //初始化方法
    private static function init(){
        //定义路径常量
        define("DS",DIRECTORY_SEPARATOR);
        define("ROOT", getcwd() . DS);
        define("APP_PATH", ROOT . 'application' . DS);
        define("FRAMEWORK_PATH", ROOT . 'framework' . DS);
        define("PUBLIC_PATH", ROOT . 'public' . DS);
        define("CONFIG_PATH", APP_PATH . 'config' . DS);
        define("CONTROLLER_PATH",APP_PATH . 'controllers' . DS);
        define("MODEL_PATH", APP_PATH . 'models' . DS);
        define("VIEW_PATH",APP_PATH . 'views' . DS);
        define("CORE_PATH",FRAMEWORK_PATH . 'core' .DS);
        define("DB_PATH",FRAMEWORK_PATH . 'databases' .DS);
        define("HELPER_PATH",FRAMEWORK_PATH . 'helpers' .DS);
        define("LIB_PATH",FRAMEWORK_PATH . 'libraries' .DS);
        define("UPLOAD_PATH",PUBLIC_PATH . 'uploads' .DS);
        //获取参数p/c/a 如index.php?p=admin&c=goods&a=add GoodsController中的addAction动作
        define("PLATFORM",isset($_GET['p']) ? $_GET['p'] : 'admin');
        define("CONTROLLER",isset($_GET['c']) ? ucfirst($_GET['c']) : 'Index');
        define("ACTION",isset($_GET['a']) ? $_GET['a'] : 'index');
        //设置当前控制器和视图目录
        define("CUR_CONTROLLER_PATH",CONTROLLER_PATH . PLATFORM . DS);
        define("CUR_VIEW_PATH",VIEW_PATH . PLATFORM . DS);

        //载入配置文件
        $GLOBALS['config'] = include CONFIG_PATH . 'config.php';
        //载入核心类
        include CORE_PATH . "Controller.class.php";
        include CORE_PATH . "Model.class.php";
        include DB_PATH . "Mysql.class.php";

        session_start();//开启session

//        define("CSS_PATH",PUBLIC_PATH . 'css' .DS);
//        define("IMG_PATH",PUBLIC_PATH . 'images' .DS);
//        define("JS_PATH",PUBLIC_PATH . 'js' .DS);



    }

    //路由方法
    private static function dispatch(){
        //获取控制器名称
        $controller_name = CONTROLLER . 'Controller';
        //取得方法名
        $action_name = ACTION . 'Action';
        //实例化控制器对象
        $controller = new $controller_name();
        //调用方法
        $controller->$action_name();
    }

    //注册为自动加载
    private static function autoload(){
//        $arr = [__CLASS__,'load'];
        spl_autoload_register('self::load');
    }

    private static function load($classname){
        if(substr($classname,-10) == 'Controller'){
            //载入控制器
            include CUR_CONTROLLER_PATH . "{$classname}.class.php";
        }elseif(substr($classname,-5) == 'Model'){
            //载入模型
            include MODEL_PATH . "{$classname}.class.php";
        }else{

        }
    }

}








































