/**

 */

DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论自增 id',
  `content` text COMMENT '评论内容',
  `status` int(11) DEFAULT '0' COMMENT '1 评论已发布，0 未发布',
  `fansid` int(11) DEFAULT '0' COMMENT '前台用户 id',
  `email` varchar(80) DEFAULT NULL COMMENT '邮箱',
  `url` varchar(120) DEFAULT NULL COMMENT '评论链接',
  `postid` int(11) DEFAULT NULL COMMENT '文章 id',
  `remind` smallint(4) DEFAULT '0' COMMENT '0 未提醒，1 已提醒',
  
  `created_at` int(11) DEFAULT NULL COMMENT '评论日期',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改日期',
  `deleted_at` int(11) DEFAULT NULL COMMENT '是否删除',
  
  PRIMARY KEY (`id`),
  KEY `comment_postId` (`post_id`),
  KEY `comment_fansId` (`fans_id`),
  KEY `comment_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COMMENT='评论表';



DROP TABLE IF EXISTS `blog_comment_status`;
CREATE TABLE `blog_comment_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `name` varchar(40) NOT NULL COMMENT '评论 name',
  `position` tinyint(2) NOT NULL COMMENT '是否发表',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='评论状态表';