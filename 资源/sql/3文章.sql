/**
文章主表
  文章标签
  文章分类
    文章和标签的关联
    文章和分类的关联
 */

DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `title` varchar(200) DEFAULT NULL COMMENT '标题',
  `summary` text COMMENT '摘要',
  `content` text COMMENT '文章内容',
  `thumbnail` varchar(120) DEFAULT NULL COMMENT '缩略图',
  `userid` int(11) DEFAULT '0' COMMENT '作者 id',
  `username` varchar(80) DEFAULT NULL COMMENT '用户名',
  `categoryid` int(11) DEFAULT NULL COMMENT '分类 id',
  `status` int(11) DEFAULT '0' COMMENT '是否发布，0-未发布，1-已发布',
  
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `deleted_at` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COMMENT='文章主表';


DROP TABLE IF EXISTS `blog_tag`;
CREATE TABLE `blog_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `name` varchar(40) NOT NULL COMMENT '标签名称',
  `frequency` int(11) DEFAULT '0' COMMENT '关联文章数量, 标签出现的频率',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tagname` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COMMENT='标签表';


DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `name` varchar(80) DEFAULT NULL COMMENT '分类名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='分类表';


DROP TABLE IF EXISTS `blog_post_tag`;
CREATE TABLE `blog_post_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `post_id` int(11) DEFAULT NULL COMMENT '文章 id',
  `tag_id` int(11) DEFAULT NULL COMMENT '标签 id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `postid` (`post_id`,`tag_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COMMENT='文章和标签的关联';


DROP TABLE IF EXISTS `blog_post_status`;
CREATE TABLE `blog_post_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `postid` int(11) not null comment '文章 id',
  `name` varchar(40) NOT NULL COMMENT 'name',
  `position` int(11) NOT NULL COMMENT 'position',
  
  `pv` int(11) DEFAULT '1' COMMENT '网页浏览量',
  `praise` int(11) DEFAULT '0' COMMENT '点赞',
  `collect` int(11) DEFAULT '0' COMMENT '收藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='文章状态表';




-- blog_post
INSERT INTO `blog_post` VALUES (1, 'Yii2小部件详解', 'YII 小部件内容', 1, 'Yii2,小部件,widget', 2, 1442998314, 1442998314, NULL);
INSERT INTO `blog_post` VALUES (2, 'Yii2安装 ', '你可以通过两种方式安装 Yii：使用 <a href=\"https://getcomposer.org/\">Composer</a> 或下载一个归档文件。推荐使用前者，这样只需执行一条简单的命令就可以安装新', 1, '安装 ,Yii2,Composer', 1, 1442998501, 1442999620, NULL);
INSERT INTO `blog_post` VALUES (3, 'ActiveRecord 详解', '<a href=\"http://zh.wikipedia.org/wiki/Active_Record\">Active Record</a> （活动记录，以下简称AR）提供了一个面向对象的接口', 3, 'Yii,ActiveRecord,', 2, 1443000145, 1443000145, NULL);
INSERT INTO `blog_post` VALUES (4, 'ListView', '小部件用于显示数据提供者 <a href=\"/doc/guide/2.0/output-data-providers\">data provider</a> 提供的数据。\r\n每个数据模型用指定的视图文件 yii\\widgets\\ListView::$itemView 来渲染', 1, 'Yii2,ListView', 1, 1443001837, 1443001878, NULL);
INSERT INTO `blog_post` VALUES (5, 'GridView', '数据网格或者说 GridView 小部件是Yii中最强大的部件之一。如果你需要快速建立系统的管理后台', 1, 'Yii2,GridView', 2, 1443001924, 1443001924, NULL);
INSERT INTO `blog_post` VALUES (6, '查询构建器', '查询构建器建立在', 2, '查询构建器,DAO,', 1, 1443002072, 1443002072, NULL);
INSERT INTO `blog_post` VALUES (7, '使用 Gii 生成代码', '本章将介绍如何使用 <a href=\"http://www.yiichina.comhttp://www.yiichina.com/doc/guide/2.0/tool-gii\">Gii</a> 去自动生成 Web 站点常用功能的代码', 3, 'Yii2,Gii', 2, 1443002396, 1443002507, NULL);
INSERT INTO `blog_post` VALUES (8, 'RESTful Web服务', 'Yii 提供了一整套用来简化实现 RESTful 风格的 Web Service 服务的 API', 1, 'Yii,RESTful Web服务', 1, 1443002869, 1443002869, NULL);
INSERT INTO `blog_post` VALUES (9, 'Yii2.0视频教程', '结合了个人博客的例子，高效、系统、完整地讲解了Yii2.0框架的核心知识点，让学习Yii框架的过程变得轻松一点、愉快一点', 3, 'Yii2,视频教程,教程', 2, 1445512144, 1445512144, NULL);


-- blog_tag
INSERT INTO `blog_tag` VALUES (1, 'Yii', 113);
INSERT INTO `blog_tag` VALUES (2, 'RESTful Web服务', 57);
INSERT INTO `blog_tag` VALUES (3, 'Yii2', 293);
INSERT INTO `blog_tag` VALUES (4, 'Gii', 59);
INSERT INTO `blog_tag` VALUES (5, '查询构建器', 54);
INSERT INTO `blog_tag` VALUES (6, 'DAO', 54);
INSERT INTO `blog_tag` VALUES (7, 'GridView', 57);
INSERT INTO `blog_tag` VALUES (8, 'ListView', 57);
INSERT INTO `blog_tag` VALUES (9, 'DetailView', 57);
INSERT INTO `blog_tag` VALUES (10, 'ActiveRecord', 113);
INSERT INTO `blog_tag` VALUES (11, '安装', 4);
INSERT INTO `blog_tag` VALUES (12, 'Composer', 3);
INSERT INTO `blog_tag` VALUES (13, '小部件', 1);
INSERT INTO `blog_tag` VALUES (14, 'widget', 1);
INSERT INTO `blog_tag` VALUES (15, '视频教程', 3);
INSERT INTO `blog_tag` VALUES (16, '教程', 1);


-- blog_post_status
INSERT INTO `blog_post_status` VALUES (1, '草稿', 1);
INSERT INTO `blog_post_status` VALUES (2, '已发布', 2);
INSERT INTO `blog_post_status` VALUES (3, '已归档', 3);
