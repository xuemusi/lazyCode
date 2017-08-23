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

//引入函数
include APP_PATH . 'Common/helper.php';
//引入核心类
include APP_PATH . 'Lazy/lazy.php';
spl_autoload_register('Lazy::load');
\Lazy\Lazy::run();