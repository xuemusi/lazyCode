<?php
// 检测PHP环境
if (version_compare(PHP_VERSION, '5.6.0', '<')) die('require PHP > 5.6.0 !');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('DEBUG', True); //调试模式
define('__PATH__', realpath('../')); //文件根目录
define('__APP__', realpath('../app')); //项目根目录
define('__CORE__', __PATH__ . '/Core/'); //框架目录
// 定义应用目录
//define('APP_PATH', );
define('RUNTIME_PATH',  './Runtime/'); //缓存目录
// 引入lazy入口文件
require '../Core/lazy.php';
