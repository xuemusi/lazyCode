<?php
namespace Core\lib\drive\session;
//类定义
class mysql
{
    function init()
    {
        $domain = '.infor96.com';
        //不使用 GET/POST 变量方式
        ini_set('session.use_trans_sid',    0);
        //设置垃圾回收最大生存时间
        ini_set('session.gc_maxlifetime',   MY_SESS_TIME);
        //使用 COOKIE 保存 SESSION ID 的方式
        ini_set('session.use_cookies',      1);
        ini_set('session.cookie_path',      '/');
        //多主机共享保存 SESSION ID 的 COOKIE
        ini_set('session.cookie_domain',    $domain);
        //将 session.save_handler 设置为 user，而不是默认的 files
        session_module_name('user');
        //定义 SESSION 各项操作所对应的方法名：
        session_set_save_handler(
            array('\Core\lib\drive\session\mysql', 'open'),   //对应于静态方法 My_Sess::open()，下同。
            array('\Core\lib\drive\session\mysql', 'close'),
            array('\Core\lib\drive\session\mysql', 'read'),
            array('\Core\lib\drive\session\mysql', 'write'),
            array('\Core\lib\drive\session\mysql', 'destroy'),
            array('\Core\lib\drive\session\mysql', 'gc')
        );
    }   //end function
    function open($save_path, $session_name) {
        return true;
    }   //end function
    function close() {
        global $MY_SESS_CONN;

        if ($MY_SESS_CONN) {    //关闭数据库连接
            $MY_SESS_CONN->Close();
        }
        return true;
    }   //end function

    function read($sesskey) {
        global $MY_SESS_CONN;

        $sql = 'SELECT data FROM sess WHERE sesskey=' . $MY_SESS_CONN->qstr($sesskey) . ' AND expiry>=' . time();
        $rs =& $MY_SESS_CONN->Execute($sql);
        if ($rs) {
            if ($rs->EOF) {
                return '';
            } else {    //读取到对应于 SESSION ID 的 SESSION 数据
                $v = $rs->fields[0];
                $rs->Close();
                return $v;
            }   //end if
        }   //end if
        return '';
    }   //end function

    function write($sesskey, $data) {
        global $MY_SESS_CONN;

        $qkey = $MY_SESS_CONN->qstr($sesskey);
        $expiry = time() + My_SESS_TIME;    //设置过期时间

        //写入 SESSION
        $arr = array(
            'sesskey' => $qkey,
            'expiry'  => $expiry,
            'data'    => $data);
        $MY_SESS_CONN->Replace('sess', $arr, 'sesskey', $autoQuote = true);
        return true;
    }   //end function

    function destroy($sesskey) {
        global $MY_SESS_CONN;

        $sql = 'DELETE FROM sess WHERE sesskey=' . $MY_SESS_CONN->qstr($sesskey);
        $rs =& $MY_SESS_CONN->Execute($sql);
        return true;
    }   //end function

    function gc($maxlifetime = null) {
        global $MY_SESS_CONN;

        $sql = 'DELETE FROM sess WHERE expiry<' . time();
        $MY_SESS_CONN->Execute($sql);
        //由于经常性的对表 sess 做删除操作，容易产生碎片，
        //所以在垃圾回收中对该表进行优化操作。
        $sql = 'OPTIMIZE TABLE sess';
        $MY_SESS_CONN->Execute($sql);
        return true;
    }   //end function
}   ///:~
define('MY_SESS_TIME', 3600);   //SESSION 生存时长

//使用 ADOdb 作为数据库抽象层。
require_once('adodb/adodb.inc.php');
//数据库配置项，可放入配置文件中（如：config.inc.php）。
$db_type = 'mysql';
$db_host = '192.168.212.1';
$db_user = 'sess_user';
$db_pass = 'sess_pass';
$db_name = 'sess_db';
//创建数据库连接，这是一个全局变量。
$GLOBALS['MY_SESS_CONN'] =& ADONewConnection($db_type);
$GLOBALS['MY_SESS_CONN']->Connect( $db_host, $db_user, $db_pass, $db_name);
//初始化 SESSION 设置，必须在 session_start() 之前运行！！
My_Sess::init();
?>