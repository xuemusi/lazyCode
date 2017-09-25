<?php
namespace Core\lib;

class session{
    public static $config;
    static public function init(){
        self::$config = config::get('','session');
        //判断驱动
        if(self::$config['SESSION_TYPE']){
            //确定session驱动
            $class = '\Core\lib\drive\session\\' . self::$config['SESSION_TYPE'];
            $handler = new $class();
            if(!$handler){
                throw new \Exception('session驱动不存在');
            }
            session_set_save_handler($handler, true);
        }
        //自动开启session_start();
        if(self::$config['SESSION_AUTO_START']){
            session_start();
        }
    }
}