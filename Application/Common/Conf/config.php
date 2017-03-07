<?php
return array(
    //模板常量
    'TMPL_PARSE_STRING' => array(
        '__ADMIN__' => __ROOT__.'/Public/Admin'
    ),
    
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'oa',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'oa_',    // 数据库表前缀
    
    //显示跟踪信息
    'SHOW_PAGE_TRACE'       =>  true,   //默认为false，开启则改写成true
);