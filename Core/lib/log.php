<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/28
 * Time: 11:38
 */

namespace Core\lib;
class log
{
    static $class;
    static public function init(){
        //确定存储方式
        $drive = config::get('DRIVE','log');
        $class = '\Core\lib\drive\log\\' . $drive;
        self::$class = new $class;
    }

    static public function log($msg,$data =[],$path = false){
        self::$class->log($msg,$data,$path);
    }
}