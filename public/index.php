<?php
// 检测PHP环境
if (version_compare(PHP_VERSION, '5.6.0', '<')) die('require PHP > 5.6.0 !');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('DEBUG', True);
define('_ROOT_', realpath('/'));
define('_IS_ENCRYPTCODE', true);

// 定义应用目录
define('APP_PATH', '../Core/');
define('RUNTIME_PATH', '../Runtime/');
// 引入lazy入口文件
require '../Core/lazy.php';
