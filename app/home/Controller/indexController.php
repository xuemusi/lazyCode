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
        $model = new  Model();
        $ret = $model->query('select * from t6_user limit 1');
        dump($model);
//        session_start();
        $_SESSION['admin'] = $_SERVER;
        var_dump($_SESSION['admin']);
        $this->assign('title','标题啊');
        $this->assign('title2','标题啊2');
        $this->assign('title3','标题啊3');
        $this->display('index/index');
    }

    public function test(){
//        echo 'controller index success';
        $this->assign('title','标题啊333');
        $this->assign('title2','标题啊3333');
        $this->assign('title3','标题啊223asdf3');
        $this->display('index/index');
    }
}