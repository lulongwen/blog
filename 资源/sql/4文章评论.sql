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



-- comment
INSERT INTO `comment` (`id`, `content`, `status`, `create_time`, `userid`, `email`, `url`, `post_id`, `remind`) VALUES
(null, '假设你想通过 RESTful 风格的 API 来展示用户数据。用户数据被存储在用户DB表， 你已经创建了 yii\\db\\ActiveRecord 类 app\\models\\User 来访问该用户数据.', 2, 1443004317, 1, 'sxb@hotmail.com', '', 41, 1),
(null, 'yii\\db\\Query::one() 方法只返回查询结果当中的第一条数据， 条件语句中不会加上 LIMIT 1 条件。如果你清楚的知道查询将会只返回一行或几行数据 （例如， 如果你是通过某些主键来查询的），这很好也提倡这样做。但是，如果查询结果 有机会返回大量的数据时，那么你应该显示调用 limit(1) 方法，以改善性能。 例如， (new \\yii\\db\\Query())->from(''user'')->limit(1)->one()。', 2, 1443004455, 1, 'somuchfun@gmail.com', '', 39, 1),
(null, '传说中的沙发', 2, 1443004561, 1, 'lsf@ggoc.com', '', 34, 1),
(null, '当你在调用 yii\\db\\Query::all() 方法时，它将返回一个以连续的整型数值为索引的数组。 而有时候你可能希望使用一个特定的字段或者表达式的值来作为索引结果集数组。那么你可以在调用 yii\\db\\Query::all() 之前使用 yii\\db\\Query::indexBy() 方法来达到这个目的。', 2, 1443047988, 1, 'ctq@qq.com', '', 39, 1),
(null, '如需使用表达式的值做为索引，那么只需要传递一个匿名函数给 yii\\db\\Query::indexBy() 方法即可', 1, 1443049673, 1, 'kiki@qq.com', '', 39, 1),
(null, 'yii\\db\\Query::one() 方法只返回查询结果当中的第一条数据， 条件语句中不会加上 LIMIT 1 条', 2, 1443927141, 2, 'csc@bing.com', '', 39, 1),
(null, '你应该在 响应格式 部分中过滤掉这些字段。', 1, 1444267750, 1, 'wj@163.com', 'www.wj.com', 41, 1),
(null, '适合用常规格式显示一个模型（例如在一个表格的一行中显示模型的每个属性）。', 2, 1444377054, 1, 'tester@example.com', 'www.baidu.com', 36, 1),
(null, '魏老师，看了你的视频深入浅出，受益匪浅。真的非常非常感谢您！', 2, 1479353395, 2, 'mchael@163.com', NULL, 42, 1),
(null, '老师权限控制讲的很好，想听老师讲下 管理员操作日志和数据库备份', 2, 1479353438, 2, 'mchael@163.com', NULL, 42, 1),
(null, '魏老师,看了你的视频学到了很多,真心不错.咱们这套视频学完,有用户搜索文章的功能么?', 2, 1479353455, 2, 'mchael@163.com', NULL, 42, 1),
(null, '魏老师，看了你的视频深入浅出，受益匪浅。真的非常非常感谢您！', 1, 1479353617, 2, 'mchael@163.com', NULL, 42, 1),
(null, ' 点赞，学生自学党，实战课程在很多网站都要钱。', 1, 1479364784, 2, 'mchael@163.com', NULL, 42, 1);


-- blog_comment_status
INSERT INTO `commentstatus` (`id`, `name`, `position`) VALUES
(1, '待审核', 1),
(2, '已审核', 2);
-- INSERT INTO `blog_comment_status` VALUES (1, '待审核', 1);