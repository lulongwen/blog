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
  `position` int(11) NOT NULL COMMENT 'position',
  
  `pv` int(11) DEFAULT '1' COMMENT '网页浏览量',
  `praise` int(11) DEFAULT '0' COMMENT '点赞',
  `collect` int(11) DEFAULT '0' COMMENT '收藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='文章状态表';
