<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/25
 * Time: 17:23
 */

namespace Core\lib;
class View
{

    public static $assign = [];

    static public function assign($name, $value)
    {
        self::$assign[$name] = $value;
    }

    /**
     * 渲染模板
     * Author: xuemusi
     * @param $path string 路径
     * @param string $suffix 文件后缀
     */
    static public function display($path, $suffix = 'html')
    {
        $file = __PATH__ .'/resource/views/'. __MODULE__ . '/'. $path . '.'. $suffix;
        if(!is_file($file)){
            throw new \Exception('视图文件不存在');
        }
        extract(self::$assign);
        include $file;
    }
}