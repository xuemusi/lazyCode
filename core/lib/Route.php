<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/25
 * Time: 14:31
 */

namespace core\lib;
class Route
{
    public $controller;
    public $module;
    public $action;
    public $request = [];

    public function __construct()
    {
        /**
         * 1.隐藏index.php
         * 2.获取url 和参数
         */
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $pathArr = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
            if (isset($pathArr[0])) {
                $this->module = $pathArr[0];
            } else {
                $this->module = config::get('DEFAULT_MODULE', 'route');
            }
            if (isset($pathArr[1])) {
                $this->controller = $pathArr[1];
            } else {
                $this->controller = config::get('DEFAULT_CONTROLLER', 'route');
            }
            if (isset($pathArr[2])) {
                $this->action = $pathArr[2];
            } else {
                $this->action = config::get('DEFAULT_ACTION', 'route');
            }
            //处理url多余的部分
            //index/index/a/2/b/2
            if (count($pathArr) > 3) {
                $params = array_slice($pathArr, 3);
                $count = count($params);
                $i = 0;
                while ($i < $count) {
                    $_GET[$params[$i]] = isset($params[$i + 1]) ? $params[$i + 1] : '';
                    $i = $i + 2;
                }
                $this->request = array_merge($_GET, $_POST);
            }
        } else {
            $this->module = config::get('DEFAULT_MODULE', 'route');
            $this->controller = config::get('DEFAULT_CONTROLLER', 'route');
            $this->action = config::get('DEFAULT_ACTION', 'route');
        }
        //强制限定控制器首字母大写
        $this->controller = ucfirst($this->controller);
    }
}