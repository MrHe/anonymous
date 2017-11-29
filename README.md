## 简介

anonymous是基于ThinkPHP3.2.3开发的匿名提问社区

使用PHP+MySQL数据库 开发 前端页面使用layui

## 特性

- 所有操作均匿名(发布话题、回复)
- 不会记录IP(良心保证，不信自己看代码)
- 可以匿名用户的每天提问次数、回复次数，提问回复的时间间隔。
- 根据需要可以将缓存放到redis中(在配置文件中修改)
- 使用github登录 可以同步头像(别的信息懒得搞了)
- 登录后可以收藏问题(暂时不完善)
- 支持MarkDown
- 支持xss过滤等乱起八糟的搞站方式
- 暂时没有后台
- 没有安装程序 需要自己修改代码 动手能力差的可别找我啊(手动滑稽)
- 暂时不支持楼中楼
- 暂时就想到这么多 后面更不更新看心情

### 界面预览

![问题列表](http://upload-images.jianshu.io/upload_images/5227517-e2a47de9c94f93f0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![提问](http://upload-images.jianshu.io/upload_images/5227517-4f170b5967ebecef.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![问题详情](http://upload-images.jianshu.io/upload_images/5227517-84a9d01becc0422a.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![回复](http://upload-images.jianshu.io/upload_images/5227517-acb7ac0a16e7fb19.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![用户界面](http://upload-images.jianshu.io/upload_images/5227517-af0127e2a4635ee3.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


#### 第一步、下载源码

能在这个全球最大的同性交友网站上混的，应该都会吧

为了防止有人不会 还是简单讲一讲吧

两种方法:

- git方式下载

找到你的web目录或者虚拟站点目录 执行

```shell
git clone https://github.com/cutephp/anonymous
```

- 网页下载

![下载源码包](http://upload-images.jianshu.io/upload_images/5227517-5345420d47bab659.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


#### 第二步、导入数据库文件

在源码中有一个anonymous.sql文件，随便建一个数据库，然后导入即可

如果你是用的是phpMyAdmin，有可能会出错

但是我想，都是基佬，打开sql文件一行行去拷贝执行总会吧

因为功能简单，所以只有下面这几个表：

![](http://upload-images.jianshu.io/upload_images/5227517-a08b2f1d742fe8b6.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

表结构都有注释的

#### 第三步、修改配置文件

配置文件总共有两个

- App/Common/Conf/Config.php

这个文件中包含了短路由设置和数据库信息设置，根据自己的环境填写。
![配置文件](http://upload-images.jianshu.io/upload_images/5227517-9a40a53c90282314.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

- App/Common/Conf/Web.php

![配置文件2](http://upload-images.jianshu.io/upload_images/5227517-b99b0ce715d120fc.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


这个文件主要配置网站名字、github登录相关key等 每个配置项后面都有注释，自己搞，我相信你们撸码(搞基)的能力。![](http://upload-images.jianshu.io/upload_images/5227517-ab601cada1a45017.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

然后就可以正常使用啦!

#### 关于github登录

首先你要自己申请一个应用，替换掉我的key和secert

回调地址填写http://yourdomain.com/u即可

#### 关于底部版权

你随便改，文件就在App/Home/View/Public/base.html里面

#### 最后

是的 这个网站暂时没有后台，因为我懒~~~

毕竟两天搞完的东西，要啥自行车

可能有些小bug或者别的东东 有问题请提交issue 我快要下班了 

还要去陪女朋友(其实没有)，不像你们这群死基佬

![](http://upload-images.jianshu.io/upload_images/5227517-e60c618636368ef3.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
