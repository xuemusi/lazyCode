<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/25
 * Time: 15:32
 */

namespace app\home\Controller;
class indexController
{
    public function index($a=2,$b=2){
        var_dump($a,$b);
        echo 'controller index success';
    }
}