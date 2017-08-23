<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/23
 * Time: 14:26
 */
namespace Lazy;
class Lazy {
    public static function run(){
        echo 'run ok!';
    }

    public static function load($class){
        //自动加载类
        $class = str_replace('\\','/',$class);
        if(is_file(APP_PATH . $class . '.php')){

        }
    }
}