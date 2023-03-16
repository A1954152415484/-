CREATE TABLE `xingyi_love_blessing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL COMMENT 'IP地址',
  `time` varchar(255) DEFAULT NULL COMMENT '祝福时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `xingyi_love_core` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wzbt` varchar(50) DEFAULT '我们的小窝' COMMENT '网站标题',
  `wzgjz` varchar(255) DEFAULT '我们的小窝,恋爱,星益云' COMMENT '网站关键字',
  `wzms` varchar(255) DEFAULT '星益云' COMMENT '网站描述',
  `bqxx` varchar(100) DEFAULT 'Copyright © 2018-2020 <a href="http://www.96xy.cn/" target="_blank">星益云</a> 版权所有',
  `admin` varchar(255) DEFAULT NULL COMMENT '后台账号',
  `pass` varchar(255) DEFAULT NULL COMMENT '后台密码',
  `boy_qq` varchar(50) DEFAULT NULL COMMENT '男孩QQ',
  `girl_qq` varchar(50) DEFAULT NULL COMMENT '女孩QQ',
  `contact_time` varchar(50) DEFAULT '2021-08-01 00:00:00' COMMENT '交往时间',
  `achievement` text COMMENT '成就',
  `img` text COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `xingyi_love_core` VALUES (1,'我们的小窝','我们的小窝,恋爱小窝,记录点滴爱情,星益云','我们的小窝是为xxx和xxx专门搭建的记录我们的爱情点滴的网站','联系QQ：1450839008<br/>Copyright © 2018-2020 <a href=\"http://www.96xy.cn/\" target=\"_blank\">星益云</a> 版权所有','admin','e10adc3949ba59abbe56e057f20f883e','1450839008','1450839008','2018-10-21 00:00:00','[{\"title\":\"\\u7b2c\\u4e00\\u6b21\\u7275\\u624b\",\"light_up_date\":\"\",\"light_up\":false},{\"title\":\"\\u7b2c\\u4e00\\u6b21\\u5403\\u996d\",\"light_up_date\":\"\",\"light_up\":false},{\"title\":\"\\u7b2c\\u4e00\\u6b21\\u7ea6\\u4f1a\",\"light_up_date\":\"\",\"light_up\":false},{\"title\":\"\\u7b2c\\u4e00\\u6b21\\u770b\\u7535\\u5f71\",\"light_up_date\":\"\",\"light_up\":false},{\"title\":\"\\u7b2c\\u4e00\\u6b21\\u63a5\\u543b\",\"light_up_date\":\"\",\"light_up\":false},{\"title\":\"\\u7b2c\\u4e00\\u6b21\\u901b\\u8857\",\"light_up_date\":\"\",\"light_up\":false},{\"title\":\"\\u7b2c\\u4e00\\u6b21\\u5408\\u7167\",\"light_up_date\":\"\",\"light_up\":false},{\"title\":\"\\u6211\\u4eec\\u7ed3\\u5a5a\\u4e86\",\"light_up_date\":\"\",\"light_up\":false}]','{\"1.jpg\":\"\\u54fc\",\"10.jpg\":\"\\u4e38\\u4e38\\u8bc1\\u4ef6\\u7167\",\"11.jpg\":\"\\u7231\\u4f60\\u54df\",\"12.jpg\":\"\\u53d1\\u5446\",\"13.jpg\":\"\\u732a\\u5d3d\\u5d3d\",\"14.jpg\":\"\\u634f\\u8138\",\"15.jpg\":\"\\u4e38\\u4e38\\u8bc1\\u4ef6\\u7167\",\"16.jpg\":\"\\u770b\\u4ec0\\u4e48\\u770b\",\"17.jpeg\":\"\\u63e1\\u4e2a\\u624b\",\"18.jpg\":\"\\u53ef\\u7231\\u4e38\\u4e38\",\"19.jpg\":\"\\u8d34\\u7eb8\\u4e38\\u4e38\",\"2.jpg\":\"\\u829c\\u6e56\",\"20.jpg\":\"\\u561a\\u745f\",\"21.jpg\":\"\\u51fb\\u4e2d\\u59d0\\u59d0\\u7684\\u5fc3\",\"22.jpeg\":\"\\u53ef\\u7231\\u4e38\\u4e38\",\"23.jpeg\":\"\\u888b\\u9f20\\u53d8\",\"24.jpg\":\"\\u9ad8\\u6e05\\u58c1\\u7eb8\",\"3.jpg\":\"\\u9ad8\\u6e05\\u58c1\\u7eb8\",\"4.jpg\":\"\\u4e38\\u4e38\\u7684\\u8bc1\\u4ef6\\u7167\",\"5.gif\":\"\\u963f\\u79cb\",\"6.jpg\":\"\\u4e38\\u4e38\\u7684\\u8bc1\\u4ef6\\u7167\",\"7.jpg\":\"\\u88c5\\u54ed\",\"8.jpg\":\"\\u8036\",\"9.gif\":\"\\u770b\\u5230\\u4f60\\u5c31\\u5f00\\u5fc3\"}');
