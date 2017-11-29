<?php
return array(
    "WEB_NAME" => "抖机灵",//网站名字
    "key"	=>	"8a666c6473270d32c710",//github登录用到的key
    "secert" =>	"e7d14181aa11a31846a78f162eb88ed4444c7ce6",//同上
    "callbakc_url"	=>	"http://localhost:8080/index.php/Home/User/dologin",
    //github回调地址 localhost替换成自己的域名 如果开启了路由 可以把后面的/index.php/Home/User/dologin换成/info
    "page_size" => 15,//话题列表中每一页显示的条数
);