<?php
namespace core\lib;

class session{
    public static $config;
    static public function init(){
        self::$config = config::get('','session');
        //判断session共享
        if(self::$config['SESSION_DOMAIN']){
            //多主机共享保存 SESSION ID 的 COOKIE,因为我是本地服务器测试所以设置$domain=''
//            ini_set('session.cookie_domain', self::$config['SESSION_DOMAIN']);
            $domain = self::$config['SESSION_DOMAIN'];
            //不使用 GET/POST 变量方式
//            ini_set('session.use_trans_sid', 0);
//            //设置垃圾回收最大生存时间
//            ini_set('session.gc_maxlifetime', 60*60*24);
            //使用 COOKIE 保存 SESSION ID 的方式
//            ini_set('session.use_cookies', 1);
//            ini_set('session.cookie_path', '/');
            ini_set('session.cookie_domain', $domain);
            //将 session.save_handler 设置为 user，而不是默认的 files
//            session_set_cookie_params (60*60*24,'/',$domain);
//            session_module_name('user');
        }
        //判断驱动
        if(self::$config['SESSION_TYPE']){
            //确定session驱动
            $class = '\core\lib\drive\session\\' . self::$config['SESSION_TYPE'];
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