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
        $dsn = 'mysql:host=localhost;dbname=dev_db_et';
        $username = 'root';
        $passwd = 'secret';
        try{
            parent::__construct($dsn, $username, $passwd);
        }catch (\PDOException $e){
            echo $e->getMessage();
        }
    }
}