<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/28
 * Time: 11:40
 */

namespace Core\lib\drive\log;
use Core\lib\config;

class file
{
    public $basePath;
    public function __construct()
    {
        $this->basePath = config::get('OPTION.PATH','log') . '/' . date('Ymd');
    }

    public function log($msg,$data =[],$path = false){
        if(!is_dir($this->basePath)){
            mkdir($this->basePath,'777',true);
        }
        $log = implode('/',[
                __MODULE__,__CONTROLLER__,__ACCTION__
            ]) .'  ' . $msg . '：date=' . date('[Y-m-d H:i:m]', time()) . ' data= ' . json_encode($data, JSON_UNESCAPED_UNICODE) . PHP_EOL;
        $path = $path === false ? $this->basePath . '/' . date('YmdH') . '.log' : $path;
        return file_put_contents($path ,$log,FILE_APPEND);
    }
}