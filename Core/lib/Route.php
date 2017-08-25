<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/25
 * Time: 14:31
 */

namespace Core\lib;
class Route
{
    public $controller;
    public $action;

    public function __construct()
    {
        /**
         * 1.隐藏index.php
         * 2.获取url 和参数
         * 3.
         */
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $pathArr = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
            if ($pathArr[0]) {
                $this->controller = $pathArr[0];
            }
            if($pathArr[1]){
                $this->action = $pathArr[1];
            }else{
                $this->action = 'index';
            }
            //处理url多余的部分
            //index/index/a/2/b/2
            if(count($pathArr) > 2){
                $params = array_slice($pathArr,2);
                $count = count($params);
                $i = 0;
                while ($i < $count){
                    $_GET[$params[$i]] = isset($params[$i +1]) ? $params[$i +1] : '';
                    $i = $i +2;
                }
            }
        } else {
            $this->controller = 'index';
            $this->action = 'index';
        }
    }
}