<?php
return array(
    "WEB_NAME" => "抖机灵",//网站名字
    "key"	=>	"8a666c6473270d32c710",//github登录用到的key
    "secert" =>	"",//同上
    "page_size" => 15,//话题列表中每一页显示的条数
    "user_max_topic" => 2,//匿名用户每天可以提问的最大次数
    'user_max_post'	=> 50,//匿名用户每天可以回复的最大次数
    'topic_time' => 10,//新发布问题的时间间隔 单位:秒
    'post_time' => 10,//新发布回复的时间间隔 单位:秒
    'DATA_CACHE_PREFIX'     =>  'lalala',     // 缓存前缀 可以随便填写
    'DATA_CACHE_TYPE'       =>  'File',  // 缓存类型 根据需要填写 如果有redis或者memcached更好
);