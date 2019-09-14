<?php
/**
 * Created by PhpStorm.
 * User: xumusi
 * Date: 2017/8/28
 * Time: 11:39
 */

return [
    /* SESSION设置 */
    'SESSION_AUTO_START'    =>  true,    // 是否自动开启Session
    'SESSION_OPTIONS'       =>  array(), // session 配置数组 支持type name id path expire domain 等参数
    'SESSION_TYPE'          =>  '', // session hander类型 默认无需设置 除非扩展了session hander驱动
    'SESSION_PREFIX'        =>  '', // session 前缀
    'SESSION_DOMAIN'        =>  '.lazy.app', // session 共享设置域名，这里设置的是一级域名。 如果想要 baidu.com 和 a.baidu.com 、b.baidu.com 那么请设置为 .baidu.com
    'SESSION_REDIS' => array(
        'handler' => null, //数据库连接句柄
        'host' => '127.0.0.1',
        'port' => 6379,
        'lifeTime' => null,
        'prefix'   => 'PHPREDIS_SESSION:'
    ), //配置redis的属性
];