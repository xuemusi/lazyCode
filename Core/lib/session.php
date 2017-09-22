<?php
namespace Core\lib;
class session{
    static public $config;
    static public function init(){
        self::$config = config::get('','session');
        //判断驱动
        if(self::$config['SESSION_AUTO_START']){
            session_start();
        }
    }
}