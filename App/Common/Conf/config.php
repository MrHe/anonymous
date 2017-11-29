<?php
return array(
	'URL_ROUTER_ON'   => true,
	'URL_ROUTE_RULES'=>array(
	    'v/:id' => "Home/Topic/view",
        't/:p' =>  "Home/Topic/show",
        't' => "Home/Topic/show",
        're' => "Home/Topic/reply",
        's' => "Home/Collect/show",
        'u' => "Home/User/login",
        'info' => "Home/User/info",
        'user' => "Home/User/user",
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
    'MODULE_ALLOW_LIST'    =>    array('Home','Admin'),
    'DEFAULT_MODULE'       =>    'Home',
    'TMPL_ACTION_ERROR'     =>  APP_PATH.'Home/View/error.html', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  APP_PATH.'Home/View/success.html', // 默认成功跳转对应的模板文件
);