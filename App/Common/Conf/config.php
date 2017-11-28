<?php
return array(
	'URL_ROUTER_ON'   => true,
	'URL_ROUTE_RULES'=>array(
	    't/:id' => "Home/Topic/View",
        'p' =>  "Home/Topic/Show",
        're' => "Home/Topic/reply",
        's' => "Home/Collect/Show",
        'u' => "Home/User/Login",
        
	),
	'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'anonymous',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '123456',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀
    'SHOW_PAGE_TRACE'            =>  true,
    'LOAD_EXT_CONFIG' => 'Web', 
);