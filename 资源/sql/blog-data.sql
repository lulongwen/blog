-- adminuser
INSERT INTO `blog)_adminuser` (`id`, `username`, `nickname`, `password`, `email`, `profile`, `auth_key`, `password_hash`, `password_reset_token`) VALUES
(1, 'longwen', '卢珑文', '$2y$13$RZ20K81ZdERPDyFq2EM31e6KjmmdNRtGmCC6Fq9NST3hWhcgoPqUy', 'webmaster@example.com.cn', 'hello,this is my profile', 'pG7TRyTIXlEbcenpi34TzmMYS2zDsMTF', '$2y$13$4Y5KRDHPFYF.rYumLe6rx.34gBLpK6HROMklh9A8.TZwRFNrM5RyW', NULL),
(2, 'anhaiyin', '安海音', '$2y$13$RZ20K81ZdERPDyFq2EM31e6KjmmdNRtGmCC6Fq9NST3hWhcgoPqUy', 'tim@u2000.com', 'a testing user', 'pG7TRyTIXlEbcenpi34TzmMYS2zDsMTF', '$2y$13$HtJqGRmc76KIRIwokii8AOQ1XZljXiuWCKUGFnH9vkTnfBpHtqgFu', NULL),
(3, 'tutu', '兔兔', '$2y$13$RZ20K81ZdERPDyFq2EM31e6KjmmdNRtGmCC6Fq9NST3hWhcgoPqUy', 'heyx@hotmail.com', 'a testing user', 'pG7TRyTIXlEbcenpi34TzmMYS2zDsMTF', '$2y$13$HtJqGRmc76KIRIwokii8AOQ1XZljXiuWCKUGFnH9vkTnfBpHtqgFu', NULL);


-- blog_user
INSERT INTO `blog_user` VALUES (1, 'longwen', 'pG7TRyTIXlEbcenpi34TzmMYS2zDsMTF', '$2y$13$.2b6jpz877wYXXKPHBDaOeJfCeY525zkM.ynqXa/4JH2CjS0rd1SK', NULL, 'admin@longwen.com', 10, 1462597929, 1462597929, NULL);


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



-- blog_migration
INSERT INTO `blog_migration` VALUES ('m000000_000000_base', 1462597684);
INSERT INTO `blog_migration` VALUES ('m130524_201442_init', 1462597693);