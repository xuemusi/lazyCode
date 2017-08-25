<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/25
 * Time: 16:47
 */

namespace Core\lib;
class Controller
{
    public $assign = [];

    public function assign($name, $value)
    {
        $this->assign[$name] = $value;
    }

    public function display($path, $suffix = 'html')
    {
//        $file =
    }
}