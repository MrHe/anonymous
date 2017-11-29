#
# Structure for table "collect"
#

DROP TABLE IF EXISTS `collect`;
CREATE TABLE `collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `topic_id` int(11) DEFAULT NULL COMMENT '收藏的话题ID',
  `收藏的时间` bigint(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收藏表';

#
# Data for table "collect"
#

/*!40000 ALTER TABLE `collect` DISABLE KEYS */;
/*!40000 ALTER TABLE `collect` ENABLE KEYS */;

#
# Structure for table "post"
#

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '回复ID',
  `post_time` bigint(12) DEFAULT NULL COMMENT '回复时间',
  `post_poster` int(11) DEFAULT '0' COMMENT '回复人 0为匿名',
  `post_reply` int(11) DEFAULT NULL COMMENT '楼中楼回复的ID',
  `topic_id` int(11) DEFAULT NULL COMMENT '回复的ID',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='回复表';

#
# Data for table "post"
#

/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,1511857009,0,NULL,1),(2,1511858000,0,NULL,1),(3,1511858009,0,NULL,1),(4,1511858023,0,NULL,1),(5,1511858029,0,NULL,1),(6,1511859197,0,NULL,1),(7,1511873173,0,NULL,9),(8,1511921630,0,NULL,9),(9,1511922637,0,NULL,10),(10,1511922734,0,NULL,10),(11,1511927428,7,NULL,17),(12,1511927474,7,NULL,17),(13,1511927492,7,NULL,17),(14,1511927563,7,NULL,17),(15,1511927685,7,NULL,18),(16,1511927710,7,NULL,18),(17,1511939056,0,NULL,17),(18,1511939060,0,NULL,17),(19,1511939064,0,NULL,17),(20,1511939315,0,NULL,17);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

#
# Structure for table "post_text"
#

DROP TABLE IF EXISTS `post_text`;
CREATE TABLE `post_text` (
  `post_id` int(11) NOT NULL DEFAULT '0' COMMENT '回复内容ID',
  `post_text` text COMMENT '回复的内容',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='回复内容表';

#
# Data for table "post_text"
#

/*!40000 ALTER TABLE `post_text` DISABLE KEYS */;
INSERT INTO `post_text` VALUES (1,'的撒大'),(2,'V大市场'),(3,'&lt;p&gt;测试&lt;/p&gt;'),(4,'&lt;p&gt;继续测试&lt;/p&gt;'),(5,'&lt;p&gt;可劲测试&lt;/p&gt;'),(6,'&lt;p&gt;&amp;lt;sc&lt;x&gt;ript&amp;gt;alert(&amp;quot;11&amp;quot;);&amp;lt;/sc&lt;x&gt;ript&amp;gt;&lt;/p&gt;'),(7,'&lt;p&gt;厕所&lt;/p&gt;'),(8,''),(9,'&lt;pre&gt;&lt;code class=&quot;language-shell&quot;&gt;echo &amp;amp;quot;a&amp;amp;quot;;&lt;/code&gt;&lt;/pre&gt;'),(10,'<pre><code class=\"language-php\">echo &amp;amp;quot;hello&amp;amp;quot;;</code></pre>'),(11,NULL),(12,'<p>测试回复</p>'),(13,'<p>&amp;lt;sc&lt;x&gt;ript&amp;gt;alert(11);&amp;lt;/sc&lt;x&gt;ript&amp;gt;</p>'),(14,'&lt;p&gt;&amp;lt;sc&lt;x&gt;ript&amp;gt;alert(11);&amp;lt;/sc&lt;x&gt;ript&amp;gt;&lt;/p&gt;'),(15,'&lt;p&gt;&amp;lt;sc&lt;x&gt;ript&amp;gt;alert(11);&amp;lt;/sc&lt;x&gt;ript&amp;gt;&lt;/p&gt;'),(16,'&lt;p&gt;&amp;lt;sc&lt;x&gt;ript&amp;gt;alert(11);&amp;lt;/sc&lt;x&gt;ript&amp;gt;&lt;/p&gt;'),(17,'&lt;p&gt;dawdasdas&lt;/p&gt;'),(18,'&lt;p&gt;wdasdawdwa&lt;/p&gt;'),(19,'&lt;p&gt;fasdawdawdas&lt;/p&gt;'),(20,'&lt;p&gt;fdaewdasd&lt;/p&gt;');
/*!40000 ALTER TABLE `post_text` ENABLE KEYS */;

#
# Structure for table "topic"
#

DROP TABLE IF EXISTS `topic`;
CREATE TABLE `topic` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '话题ID',
  `topic_title` varchar(255) DEFAULT NULL COMMENT '话题内容',
  `topic_time` bigint(12) DEFAULT NULL COMMENT '话题时间',
  `topic_poster` int(11) DEFAULT '0' COMMENT '话题作者 0为匿名',
  `topic_reply` int(11) DEFAULT '0' COMMENT '回复数',
  `last_edit_time` bigint(12) DEFAULT NULL COMMENT '最后编辑时间',
  `topic_click` int(11) DEFAULT '0' COMMENT '点击数',
  PRIMARY KEY (`topic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='话题表';

#
# Data for table "topic"
#

/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` VALUES (1,'test',1501741000,7,0,NULL,0),(2,'测试问题',1511860004,0,0,NULL,2),(3,'测试问题2',1511860057,0,0,NULL,0),(4,'测试问题3',1511860208,0,0,NULL,0),(5,'继续测试',1511860226,0,0,NULL,0),(6,'测试测试',1511860285,0,0,NULL,0),(7,'测试自动关闭',1511860765,0,0,NULL,0),(8,'测试自动那个关闭啊',1511860847,0,0,NULL,0),(9,'测试那个测试啊',1511861071,0,0,NULL,0),(10,'测试code',1511922018,0,0,NULL,0),(14,'testest',1511925369,0,0,NULL,0),(15,'&amp;lt;sc&lt;x&gt;ript&amp;gt;alert(11);&amp;lt;/sc&lt;x&gt;ript&amp;gt;',1511925397,0,0,NULL,4),(16,'测试测试',1511927094,0,0,NULL,0),(17,'测试发布',1511927219,7,8,NULL,23),(18,'&amp;lt;sc&lt;x&gt;ript&amp;gt;alert(11);&amp;lt;/sc&lt;x&gt;ript&amp;gt;',1511927603,7,2,NULL,40),(19,'测试问题',1511939285,0,0,NULL,0),(20,'继续测试',1511939358,0,0,NULL,0),(21,'还是测试',1511939369,0,0,NULL,0),(22,'用户发布问题测试',1511940523,7,0,NULL,0),(23,'继续测试',1511940534,7,0,NULL,0),(24,'测试啊测试',1511940545,7,0,NULL,1);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

#
# Structure for table "topic_text"
#

DROP TABLE IF EXISTS `topic_text`;
CREATE TABLE `topic_text` (
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `topic_text` text COMMENT '话题内容',
  PRIMARY KEY (`topic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='话题内容表';

#
# Data for table "topic_text"
#

/*!40000 ALTER TABLE `topic_text` DISABLE KEYS */;
INSERT INTO `topic_text` VALUES (1,'fsadasd'),(2,'测试'),(3,'测试'),(4,'测试'),(5,'测试测试'),(6,'测试'),(7,'测试'),(8,'测试'),(9,'测试'),(10,'```php\necho &quot;HelloWorld&quot;;\n```'),(14,'&lt;p&gt;testest&lt;/p&gt;'),(15,'&lt;p&gt;&amp;lt;sc&lt;x&gt;ript&amp;gt;alert(11);&amp;lt;/sc&lt;x&gt;ript&amp;gt;&lt;/p&gt;'),(16,'&lt;p&gt;测试测试&lt;/p&gt;'),(17,'&lt;p&gt;测试发布&lt;/p&gt;'),(18,'&lt;p&gt;&amp;lt;sc&lt;x&gt;ript&amp;gt;alert(11);&amp;lt;/sc&lt;x&gt;ript&amp;gt;&lt;/p&gt;'),(19,'&lt;p&gt;测试问题&lt;/p&gt;'),(20,'&lt;p&gt;继续测试&lt;/p&gt;'),(21,'&lt;p&gt;还是测试&lt;/p&gt;'),(22,'&lt;p&gt;用户发布问题测试&lt;/p&gt;'),(23,'&lt;p&gt;继续测试&lt;/p&gt;'),(24,'&lt;p&gt;测试啊测试&lt;/p&gt;');
/*!40000 ALTER TABLE `topic_text` ENABLE KEYS */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `user_salt` varchar(4) DEFAULT NULL COMMENT 'salt值',
  `user_avatar` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `github_id` int(11) DEFAULT NULL COMMENT 'github用户ID',
  `register_time` bigint(12) DEFAULT NULL COMMENT '注册时间',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (7,'cutephp',NULL,NULL,'https://avatars2.githubusercontent.com/u/3415206?v=4',3415206,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
