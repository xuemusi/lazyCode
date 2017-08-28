<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/23
 * Time: 14:26
 */

namespace Core;
use Core\lib\log;
use Core\lib\Route;

class Lazy
{

    public static $classMap = [];

    static public function run()
    {
        log::init();//log初始化
        log::log('初始化');
        $route = new Route(); //实例化路由
//        $controller = $route->controller;
//        $action = $route->action;
        define('__MODULE__',$route->module);//模块常量
        define('__CONTROLLER__',$route->controller);//控制器常量
        define('__ACCTION__',$route->action);//方法常量

        $ctrFile = __APP__  . '/' . __MODULE__ ;
        if(!is_dir($ctrFile)){
            throw new \Exception('模块不存在');
        }
        $ctrFile .= '/Controller/' . __CONTROLLER__ . 'Controller.php';
//        var_dump($ctrFile);die;
        if(is_file($ctrFile)){
            include $ctrFile;
            $class = '\app\\' . __MODULE__ .'\Controller\\' . __CONTROLLER__ . 'Controller';
//            $classname = $controller . 'Controller';
            $reflector = new \ReflectionClass($class);
            if(!$reflector->hasMethod(__ACCTION__)){
                throw new \Exception('找不到方法');
            }
            $action = $reflector->getMethod(__ACCTION__);
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
            throw new \Exception('找不到控制器' . __CONTROLLER__);
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