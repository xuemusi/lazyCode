<?php
namespace Core\lib\drive\session;
//类定义
use Core\lib\config;

/**
 * session数据库引擎
 * Author: xuemusi
 * Class mysql
 * @package Core\lib\drive\session
 * *********************************
 * 如果数据库不存在，请先创建数据库
 *
    CREATE TABLE `Session` (
    `Session_Id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `Session_Expires` datetime NOT NULL,
    `Session_Data` text COLLATE utf8_unicode_ci,
    PRIMARY KEY (`Session_Id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 */
class mysql implements \SessionHandlerInterface
{
    private $link;

    public function open($savePath, $sessionName)
    {
        $config = config::get('','db');
        $link = mysqli_connect($config['server'],$config['username'],$config['password'],$config['database_name']);
        if($link){
            $this->link = $link;
            return true;
        }else{
            return false;
        }
    }
    public function close()
    {
        mysqli_close($this->link);
        return true;
    }
    public function read($id)
    {
        $result = mysqli_query($this->link,"SELECT Session_Data FROM Session WHERE Session_Id = '".$id."' AND Session_Expires > '".date('Y-m-d H:i:s')."'");
        if($row = mysqli_fetch_assoc($result)){
            return $row['Session_Data'];
        }else{
            return "";
        }
    }
    public function write($id, $data)
    {
        $DateTime = date('Y-m-d H:i:s');
        $NewDateTime = date('Y-m-d H:i:s',strtotime($DateTime.' + 1 hour'));
        $result = mysqli_query($this->link,"REPLACE INTO Session SET Session_Id = '".$id."', Session_Expires = '".$NewDateTime."', Session_Data = '".$data."'");
        if($result){
            // var_dump("REPLACE INTO Session SET Session_Id = '".$id."', Session_Expires = '".$NewDateTime."', Session_Data = '".$data."'");
            return true;
        }else{
            return false;
        }
    }
    public function destroy($id)
    {
        $result = mysqli_query($this->link,"DELETE FROM Session WHERE Session_Id ='".$id."'");
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function gc($maxlifetime)
    {
        $result = mysqli_query($this->link,"DELETE FROM Session WHERE ((UNIX_TIMESTAMP(Session_Expires) + ".$maxlifetime.") < ".$maxlifetime.")");
        if($result){
            return true;
        }else{
            return false;
        }
    }
}

