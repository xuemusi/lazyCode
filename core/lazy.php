<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/23
 * Time: 13:56
 */
include __PATH__ .'/vendor/autoload.php';
if(DEBUG){
    $whoop = new \Whoops\Run;
    $erroTitle = 'lazyCode 框架出错了';
    $option = new \Whoops\Handler\PrettyPageHandler();
    $option->setPageTitle($erroTitle);
    $whoop->pushHandler($option);
    $whoop->register();
    ini_set('display_errors','On');
}else{
    ini_set('display_errors','Off');
}
//var_dump( __CORE__ . 'Common/helper.php');die;
//引入函数
include __CORE__ . 'common/helper.php';
//引入核心类
include __CORE__ . 'Lazy/lazy.php';
spl_autoload_register('\core\Lazy::load');
\core\Lazy::run();