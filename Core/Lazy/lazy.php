<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/23
 * Time: 14:26
 */

namespace Core;
use Core\lib\Route;

class Lazy
{

    public static $classMap = [];

    static public function run()
    {
        $route = new Route(); //实例化路由
        $controller = $route->controller;
        $action = $route->action;
        $ctrFile = __APP__  . '/home/Controller/' . $controller . 'Controller.php';
        if(is_file($ctrFile)){
            include $ctrFile;
            $class = '\app\home\Controller\\' . $controller . 'Controller';
            $init = new $class();
            $init->$action();
        }else{
            throw new \Exception('找不到控制器' . $controller);
        }
    }

    static public function load($class)
    {
        //自动加载类
        //new \Core\route();
        if (isset($classMap[$class])) {
            echo 2;
            return true;
        } else {
            echo 1;
            $class = str_replace('\\', '/', $class);
            $file = __PATH__ . '/' . $class . '.php';
//        var_dump($class,$file);die;
            if (is_file($file)) {
                include $file;
                self::$classMap[$class] = $class;
                return true;
            } else {
                return false;
            }
        }
    }
}