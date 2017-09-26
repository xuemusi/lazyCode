<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/25
 * Time: 15:32
 */

namespace app\home\Controller;
use Core\lib\Controller;
use Core\lib\Model;

class indexController extends Controller
{
    public function index(){
//        echo 'controller index success';
//        $model = new  Model();
//        $ret = $model->query('select * from t6_user limit 1');
//        dump($model);
//        session_start();
//        var_dump($_COOKIE);
//        if(isset($_COOKIE['session_id']) && session_id() != $_COOKIE['session_id']){
//            session_destroy();
//            session_id($_COOKIE['session_id']);
//            session_start();
//            echo 1;
//        }else{
//            echo 2;
//        }
//        session_regenerate_id();
//        setcookie('session_id',session_id(),time() + 300000,'/','');
//        $_SESSION['admin'] = 55;
//        dump(session_id());
//        dump($_SESSION,date('Y-m-d H:i:s'));die;
//        $this->assign('title','标题啊');
//        $this->assign('title2','标题啊2');
//        $this->assign('title3','标题啊3');
        $this->display('index/index');
    }

    public function test(){
//        echo 'controller index success';
        $this->assign('title','标题啊333');
        $this->assign('title2','标题啊3333');
        $this->assign('title3','标题啊223asdf3');
        $this->display('index/index');
    }

    public function session_page1(){
        $_SESSION['admin'] = 55555;
//        dump(session_id());
//        session_register_shutdown ();
//        echo '<a >'
        $this->display('index/index');
    }

    public function session_page2(){
//        session_register_shutdown ();
//        session_destroy ();
//        $_SESSION['admin'] = 55;
//        dump(session_id());
        dump($_SESSION,date('Y-m-d H:i:s'));die;
    }
}