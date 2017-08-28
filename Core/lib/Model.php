<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/25
 * Time: 16:24
 */
namespace Core\lib;
class Model extends \PDO{
    public function __construct()
    {
        $config = config::get('','db');
        $dsn = 'mysql:host=' . $config ['DB_HOST'].';dbname=' . $config['DB_NAME'];
        $username = $config['DB_USER'];
        $passwd = $config['DB_PWD'];
        try{
//            var_dump($dsn, $username, $passwd);die;
            parent::__construct($dsn, $username, $passwd);
        }catch (\PDOException $e){
            echo $e->getMessage();
        }
    }
}