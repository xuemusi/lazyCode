<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/23
 * Time: 13:56
 */
if(DEBUG){
    ini_set('display_errors','On');
}else{
    ini_set('display_errors','Off');
}
//var_dump( __CORE__ . 'Common/helper.php');die;
//引入函数
include __CORE__ . 'Common/helper.php';
//引入核心类
include __CORE__ . 'Lazy/lazy.php';
spl_autoload_register('\Core\Lazy::load');
\Core\Lazy::run();