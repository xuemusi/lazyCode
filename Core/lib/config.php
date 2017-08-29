<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/28
 * Time: 10:52
 */

namespace Core\lib;
class config
{
    static public $config = [];
    static public function get($name,$file){
        if(isset(self::$config[$name.$file])){
            return self::$config[$name.$file];
        }
        $file = __CORE__ . 'config/' . $file . '.php';
//        var_dump($file);die;
        if(!is_file($file)){
            throw new \Exception('不存在配置文件'.$file);
        }
        $config = include $file;
        if(!$name){
            return $config;
        }
        $ret = get_multi_arr($name,$config);
//        var_dump($name,$ret);
        if($ret){
            self::$config[$name.$file] = $ret;
            return $ret;
        }else{
            throw new \Exception($name . '配置不存在');
        }
    }
}