<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/25
 * Time: 16:24
 */
namespace Core\lib;
use Medoo\Medoo;

class Model extends Medoo {
    public function __construct()
    {
        $config = config::get('','db');
        try{
//            var_dump($dsn, $username, $passwd);die;
            parent::__construct($config);
        }catch (\PDOException $e){
            echo $e->getMessage();
        }
    }
}