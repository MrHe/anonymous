# Host: localhost  (Version: 5.5.53)
# Date: 2017-11-28 17:24:54
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='回复表';

#
# Data for table "post"
#

/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,1511857009,0,NULL,1),(2,1511858000,0,NULL,1),(3,1511858009,0,NULL,1),(4,1511858023,0,NULL,1),(5,1511858029,0,NULL,1),(6,1511859197,0,NULL,1);
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
INSERT INTO `post_text` VALUES (1,'的撒大'),(2,'V大市场'),(3,'&lt;p&gt;测试&lt;/p&gt;'),(4,'&lt;p&gt;继续测试&lt;/p&gt;'),(5,'&lt;p&gt;可劲测试&lt;/p&gt;'),(6,'&lt;p&gt;&amp;lt;sc&lt;x&gt;ript&amp;gt;alert(&amp;quot;11&amp;quot;);&amp;lt;/sc&lt;x&gt;ript&amp;gt;&lt;/p&gt;');
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='话题表';

#
# Data for table "topic"
#

/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` VALUES (1,'test',1501741000,1,0,NULL,0),(2,'测试问题',1511860004,0,0,NULL,0),(3,'测试问题2',1511860057,0,0,NULL,0),(4,'测试问题3',1511860208,0,0,NULL,0),(5,'继续测试',1511860226,0,0,NULL,0),(6,'测试测试',1511860285,0,0,NULL,0),(7,'测试自动关闭',1511860765,0,0,NULL,0),(8,'测试自动那个关闭啊',1511860847,0,0,NULL,0),(9,'测试那个测试啊',1511861071,0,0,NULL,0);
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
INSERT INTO `topic_text` VALUES (1,'fsadasd'),(2,'测试'),(3,'测试'),(4,'测试'),(5,'测试测试'),(6,'测试'),(7,'测试'),(8,'测试'),(9,'测试');
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
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'dilu',NULL,NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
