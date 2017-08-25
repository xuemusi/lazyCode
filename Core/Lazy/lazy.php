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
        $ctrFile = __APP__  . '/' . $route->module ;
        if(!is_dir($ctrFile)){
            throw new \Exception('模块不存在');
        }
        $ctrFile .= '/Controller/' . $controller . 'Controller.php';
//        var_dump($ctrFile);die;
        if(is_file($ctrFile)){
            include $ctrFile;
            $class = '\app\\' . $route->module .'\Controller\\' . $controller . 'Controller';
//            $classname = $controller . 'Controller';
            $reflector = new \ReflectionClass($class);
            if(!$reflector->hasMethod($action)){
                throw new \Exception('找不到方法');
            }
            $action = $reflector->getMethod($action);
            $params = $action->getParameters();
            $method_params = [];
            if($params){
                foreach ($params as $v){
                    if(isset($route->request[$v->name])){
                        $method_params[] = $route->request[$v->name];
                    }else{
                        $method_params[] = $v->getDefaultValue();
                    }
                }
            }
            //待优化，采用反射优化
            $init = new $class();
            $action->invokeArgs($init,$method_params);
//            $init->$action();
        }else{
            throw new \Exception('找不到控制器' . $controller);
        }
    }

    static public function load($class)
    {
        //自动加载类
        //new \Core\route();
        if (isset(self::$classMap[$class])) {
            return true;
        } else {
            $class = str_replace('\\', '/', $class);
            $file = __PATH__ . '/' . $class . '.php';

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