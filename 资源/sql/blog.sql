/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MariaDB
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : blog

 Target Server Type    : MariaDB
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 13/07/2019 19:07:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blog_adminuser
-- ----------------------------
DROP TABLE IF EXISTS `blog_adminuser`;
CREATE TABLE `blog_adminuser`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 ID',
  `username` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '用户名',
  `nickname` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '昵称',
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '密码',
  `email` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `avatar` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '头像',
  `level` smallint(2) NULL DEFAULT NULL COMMENT '级别',
  `profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '介绍',
  `auth_key` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '用户 key',
  `password_hash` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '密码',
  `password_reset_token` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '重置密码 token',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '管理员表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of blog_adminuser
-- ----------------------------
INSERT INTO `blog_adminuser` VALUES (1, 'longwen', '卢珑文', '$2y$13$RZ20K81ZdERPDyFq2EM31e6KjmmdNRtGmCC6Fq9NST3hWhcgoPqUy', 'webmaster@example.com.cn', NULL, NULL, 'hello,this is my profile', 'pG7TRyTIXlEbcenpi34TzmMYS2zDsMTF', '$2y$13$4Y5KRDHPFYF.rYumLe6rx.34gBLpK6HROMklh9A8.TZwRFNrM5RyW', NULL);
INSERT INTO `blog_adminuser` VALUES (2, 'anhaiyin', '安海音', '$2y$13$RZ20K81ZdERPDyFq2EM31e6KjmmdNRtGmCC6Fq9NST3hWhcgoPqUy', 'tim@u2000.com', NULL, NULL, 'a testing user', 'pG7TRyTIXlEbcenpi34TzmMYS2zDsMTF', '$2y$13$HtJqGRmc76KIRIwokii8AOQ1XZljXiuWCKUGFnH9vkTnfBpHtqgFu', NULL);
INSERT INTO `blog_adminuser` VALUES (3, 'tutu', '兔兔', '$2y$13$RZ20K81ZdERPDyFq2EM31e6KjmmdNRtGmCC6Fq9NST3hWhcgoPqUy', 'heyx@hotmail.com', NULL, NULL, 'a testing user', 'pG7TRyTIXlEbcenpi34TzmMYS2zDsMTF', '$2y$13$HtJqGRmc76KIRIwokii8AOQ1XZljXiuWCKUGFnH9vkTnfBpHtqgFu', NULL);

-- ----------------------------
-- Table structure for blog_category
-- ----------------------------
DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '分类名称',
  `position` int(11) NULL DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '文章分类表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of blog_category
-- ----------------------------
INSERT INTO `blog_category` VALUES (1, '前端开发', NULL);
INSERT INTO `blog_category` VALUES (2, 'HTML5', NULL);
INSERT INTO `blog_category` VALUES (3, 'JavaScript', NULL);
INSERT INTO `blog_category` VALUES (4, 'CSS3', NULL);
INSERT INTO `blog_category` VALUES (5, 'PHP', NULL);
INSERT INTO `blog_category` VALUES (6, 'Mysql', NULL);
INSERT INTO `blog_category` VALUES (7, 'Redis', NULL);
INSERT INTO `blog_category` VALUES (8, '后端开发', NULL);
INSERT INTO `blog_category` VALUES (9, '项目经理', NULL);
INSERT INTO `blog_category` VALUES (10, '帮你学会', NULL);
INSERT INTO `blog_category` VALUES (11, '产品经理', NULL);
INSERT INTO `blog_category` VALUES (12, '网络营销', NULL);
INSERT INTO `blog_category` VALUES (13, '数据库营销', NULL);

-- ----------------------------
-- Table structure for blog_chat
-- ----------------------------
DROP TABLE IF EXISTS `blog_chat`;
CREATE TABLE `blog_chat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 ID',
  `userid` int(11) NOT NULL COMMENT '用户 ID',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '留言内容',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `deleted_at` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '聊天信息' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blog_chat
-- ----------------------------
INSERT INTO `blog_chat` VALUES (1, 2, '五一来找我拍照', 1525132800, NULL);
INSERT INTO `blog_chat` VALUES (2, 1, '啥时候来这边呢', 1559567657, NULL);
INSERT INTO `blog_chat` VALUES (3, 2, '学习有进步，要有目标感', 1559654677, NULL);

-- ----------------------------
-- Table structure for blog_comment
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论自增 id',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '评论内容',
  `userid` int(11) NULL DEFAULT 0 COMMENT '用户 id',
  `email` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `url` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '评论链接',
  `postid` int(11) NULL DEFAULT NULL COMMENT '文章 id',
  `remind` smallint(4) NULL DEFAULT 0 COMMENT '0 未提醒，1 已提醒',
  `status` int(11) NULL DEFAULT 0 COMMENT '评论状态，0-未审核，1-已审核',
  `created_at` int(11) NULL DEFAULT NULL COMMENT '评论创建日期',
  `updated_at` int(11) NULL DEFAULT NULL COMMENT '修改日期',
  `deleted_at` smallint(2) NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `comment_postId`(`postid`) USING BTREE,
  INDEX `comment_fansId`(`userid`) USING BTREE,
  INDEX `commentstatus`(`status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '评论表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of blog_comment
-- ----------------------------
INSERT INTO `blog_comment` VALUES (1, '假设你想通过 RESTful 风格的 API 来展示用户数据。用户数据被存储在用户DB表， 你已经创建了 yii\\db\\ActiveRecord 类 app\\models\\User 来访问该用户数据.', 1, 'sxb@hotmail.com', '', 41, 1, 2, 1443004317, NULL, NULL);
INSERT INTO `blog_comment` VALUES (2, 'yii\\db\\Query::one() 方法只返回查询结果当中的第一条数据， 条件语句中不会加上 LIMIT 1 条件。如果你清楚的知道查询将会只返回一行或几行数据 （例如， 如果你是通过某些主键来查询的），这很好也提倡这样做。但是，如果查询结果 有机会返回大量的数据时，那么你应该显示调用 limit(1) 方法，以改善性能。 例如， (new \\yii\\db\\Query())->from(\'user\')->limit(1)->one()。', 1, 'somuchfun@gmail.com', '', 39, 1, 2, 1443004455, NULL, NULL);
INSERT INTO `blog_comment` VALUES (3, '传说中的沙发', 1, 'lsf@ggoc.com', '', 34, 1, 2, 1443004561, NULL, NULL);
INSERT INTO `blog_comment` VALUES (4, '当你在调用 yii\\db\\Query::all() 方法时，它将返回一个以连续的整型数值为索引的数组。 而有时候你可能希望使用一个特定的字段或者表达式的值来作为索引结果集数组。那么你可以在调用 yii\\db\\Query::all() 之前使用 yii\\db\\Query::indexBy() 方法来达到这个目的。', 1, 'ctq@qq.com', '', 39, 1, 2, 1443047988, NULL, NULL);
INSERT INTO `blog_comment` VALUES (5, '如需使用表达式的值做为索引，那么只需要传递一个匿名函数给 yii\\db\\Query::indexBy() 方法即可', 1, 'kiki@qq.com', '', 39, 1, 1, 1443049673, NULL, NULL);
INSERT INTO `blog_comment` VALUES (6, 'yii\\db\\Query::one() 方法只返回查询结果当中的第一条数据， 条件语句中不会加上 LIMIT 1 条', 2, 'csc@bing.com', '', 39, 1, 2, 1443927141, NULL, NULL);
INSERT INTO `blog_comment` VALUES (7, '你应该在 响应格式 部分中过滤掉这些字段。', 1, 'wj@163.com', 'www.wj.com', 41, 1, 1, 1444267750, NULL, NULL);
INSERT INTO `blog_comment` VALUES (8, '适合用常规格式显示一个模型（例如在一个表格的一行中显示模型的每个属性）。', 1, 'tester@example.com', 'www.baidu.com', 36, 1, 2, 1444377054, NULL, NULL);
INSERT INTO `blog_comment` VALUES (9, '魏老师，看了你的视频深入浅出，受益匪浅。真的非常非常感谢您！', 2, 'mchael@163.com', NULL, 42, 1, 2, 1479353395, NULL, NULL);
INSERT INTO `blog_comment` VALUES (10, '老师权限控制讲的很好，想听老师讲下 管理员操作日志和数据库备份', 2, 'mchael@163.com', NULL, 42, 1, 2, 1479353438, NULL, NULL);
INSERT INTO `blog_comment` VALUES (11, '魏老师,看了你的视频学到了很多,真心不错.咱们这套视频学完,有用户搜索文章的功能么?', 2, 'mchael@163.com', NULL, 42, 1, 2, 1479353455, NULL, NULL);
INSERT INTO `blog_comment` VALUES (12, '魏老师，看了你的视频深入浅出，受益匪浅。真的非常非常感谢您！', 2, 'mchael@163.com', NULL, 42, 1, 1, 1479353617, NULL, NULL);
INSERT INTO `blog_comment` VALUES (13, '点赞学生自学党，实战课程在很多网站都要钱。', 2, 'mchael@163.com', NULL, 42, 1, 1, 1479364784, NULL, NULL);
INSERT INTO `blog_comment` VALUES (15, NULL, 0, NULL, NULL, 23, 0, 0, NULL, NULL, NULL);
INSERT INTO `blog_comment` VALUES (16, NULL, 0, NULL, NULL, 20, 0, 0, NULL, NULL, NULL);
INSERT INTO `blog_comment` VALUES (17, NULL, 0, NULL, NULL, 25, 0, 0, NULL, NULL, NULL);
INSERT INTO `blog_comment` VALUES (18, NULL, 0, NULL, NULL, 21, 0, 0, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for blog_comment_status
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment_status`;
CREATE TABLE `blog_comment_status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '评论 name',
  `position` tinyint(2) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tag_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '评论状态表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of blog_comment_status
-- ----------------------------
INSERT INTO `blog_comment_status` VALUES (1, '待审核', 1);
INSERT INTO `blog_comment_status` VALUES (2, '已审核', 2);

-- ----------------------------
-- Table structure for blog_migration
-- ----------------------------
DROP TABLE IF EXISTS `blog_migration`;
CREATE TABLE `blog_migration`  (
  `version` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apply_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of blog_migration
-- ----------------------------
INSERT INTO `blog_migration` VALUES ('m000000_000000_base', 1562764731);
INSERT INTO `blog_migration` VALUES ('m130524_201442_init', 1562764755);
INSERT INTO `blog_migration` VALUES ('m190124_110200_add_verification_token_column_to_user_table', 1562764755);

-- ----------------------------
-- Table structure for blog_post
-- ----------------------------
DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE `blog_post`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '文章标题',
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '文章摘要',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '文章内容',
  `thumbnail` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '缩略图片',
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '标签',
  `userid` int(11) NULL DEFAULT 0 COMMENT '作者 ID',
  `username` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '作者',
  `categoryid` int(11) NULL DEFAULT NULL COMMENT '分类 ID',
  `status` int(11) NULL DEFAULT 0 COMMENT '是否发布，0-草稿，1-已发布，2-已归档',
  `created_at` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  `deleted_at` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '文章主表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of blog_post
-- ----------------------------
INSERT INTO `blog_post` VALUES (1, 'Yii2小部件详解', 'yii组件 widget', '<p>小部件是在视图中使用的可重用单元，使用面向对象方式创建复杂和可配置用户界面单元。\r\n例如，日期选择器小部件可生成一个精致的允许用户选择日期的日期选择器</p>', '', '', 3, NULL, 1, 2, 1442998314, 1563000133, NULL);
INSERT INTO `blog_post` VALUES (2, 'Yii2安装 ', NULL, '使用Composer安装 Yii，只需执行一条简单的命令就可以安装新的扩展或更新 Yii 了一个应用程序的基本骨架', NULL, NULL, 2, NULL, 3, 1, 1558334670, 1558334677, NULL);
INSERT INTO `blog_post` VALUES (3, 'Active Record 详解', NULL, 'AR的生命周期，理解AR的生命周期对于你操作数据库非常重要。生命周期通常都会有些典型的事件存在。对于开发AR的behaviors来说非常有用。</p>\r\n<p>当你li>yii\\db\\ActiveRecord::init(): 会触发一个 yii\\db\\ActiveRecord::EVENT_INIT 事件</li>\r\n</ol><p>当你通过 yii\\db\\ActiveRecord::find() 方法查询数据时，每个AR实例都将有以下生命周期：</p>', NULL, NULL, 2, NULL, 5, 0, 1443781778, 1443001892, NULL);
INSERT INTO `blog_post` VALUES (4, 'ListView', NULL, '<p>yii\\widgets\\ListView 小部件用于显示数据提供者 data provider提供的数据。\r\n每个数据模型用指定的视图文件 yii\\widgets\\ListView:，所以它可以很方便地为最终用户显示信息并同时创建数据管理界面。</p>', NULL, NULL, 1, NULL, 7, 0, 1443002869, 1443002869, NULL);
INSERT INTO `blog_post` VALUES (5, 'Yii 教程', NULL, '请用超清模式播放介绍和教程讲解安排', NULL, NULL, 1, NULL, 9, 1, 1445512144, 1479262717, NULL);
INSERT INTO `blog_post` VALUES (6, '商业模式就是资源整合', '商业模式就是资源整合', '<p>商业模式就是资源整合商业模式就是资源整合商业模式就是资源整合商业模式就是资源整合</p>', '/images/20190601/1.jpg', '商业模式,资源整合,资源', 1, 'haiyin', 10, 0, 1559355445, 1562980638, NULL);
INSERT INTO `blog_post` VALUES (7, '找到关键点，爆破就见效', '找到关键点，爆破就见效找到关键点，爆破就见效找到关键点，爆破就见效找到关键点', '<ol><li>找到关键点，爆破就见效找到关键点，爆破就见效</li><li>找到关键点，爆破就见效</li><li>找到关键点</li></ol>', '/images/20190601/2.jpg', NULL, 1, 'haiyin', 7, 0, 1559355866, 1559355866, NULL);
INSERT INTO `blog_post` VALUES (8, '12', '123', '123123', NULL, NULL, 0, NULL, 3, 1, 1559358900, NULL, NULL);
INSERT INTO `blog_post` VALUES (9, '换一个思维方式，不一样的好机会', 'asdfasdf', '<p>asdf asdf </p>', '', NULL, 1, 'haiyin', 7, 1, 1559360600, 1559360600, NULL);
INSERT INTO `blog_post` VALUES (10, '学会享受写文章，好处多的超出你的期望', '学会享受写文章，好处多的超出你的期望学会享受写文章', '<p>学会享受写文章，好处多的超出你的期望</p><p>学会享受写文章</p>', '/images/20190601/3.jpg', NULL, 1, 'haiyin', 7, 1, 1559360646, 1559360646, NULL);
INSERT INTO `blog_post` VALUES (11, '学会享受写文章，好处多的超出你的期望', 'asfdafsdasdffda', '<p>asfd afsd </p><p>asdf  fda</p>', '', NULL, 1, 'haiyin', 7, 1, 1559361106, 1559361106, NULL);
INSERT INTO `blog_post` VALUES (17, '阿斯顿发', '阿斯顿发', '<p>阿斯顿发撒地方</p>', '', NULL, 1, 'haiyin', 4, 1, 1559363296, 1559363296, NULL);
INSERT INTO `blog_post` VALUES (18, '胆大是秘笈，讲一个神奇的人', '胆大是秘笈，讲一个神奇的人', '<p>胆大是秘笈，讲一个神奇的人</p><p>胆大是秘笈，讲一个神奇的人</p>', '', NULL, 1, 'haiyin', 2, 1, 1559443615, 1559443615, NULL);
INSERT INTO `blog_post` VALUES (19, '胆大是秘笈，讲一个神奇的人', '胆大是秘笈，讲一个神奇的人', '<p>asfads asd asd ad </p>', '', NULL, 1, 'haiyin', 2, 1, 1559444212, 1559444212, NULL);
INSERT INTO `blog_post` VALUES (20, '幸运女神', '幸运女神', '<p>幸运幸运女神</p>', '', NULL, 1, 'haiyin', 2, 1, 1559444370, 1559444370, NULL);
INSERT INTO `blog_post` VALUES (21, 'asdf ', 'asdf ', '<p>asdf asdf </p>', '', NULL, 1, 'haiyin', 4, 1, 1559448850, 1559448850, NULL);
INSERT INTO `blog_post` VALUES (22, 'asdf ', 'asdf ', '<p>asdf asdf </p>', '', NULL, 1, 'haiyin', 4, 1, 1559448876, 1559448876, NULL);
INSERT INTO `blog_post` VALUES (23, '让你发一下朋友圈，半小时内收到钱的绝招', '如何不沟通就收钱，我觉得收款二维码太棒了，收款二维码加上一个细节的处理，别人一看，不用思维，条件反射，3秒钟就可以完成付款', '<ol><li>ceshiquanxian</li><li>ceshide</li><li>cehsi</li></ol>', '/images/20190602/1559449766538865.jpg', NULL, 1, 'haiyin', 4, 1, 1559449769, 1559449769, NULL);
INSERT INTO `blog_post` VALUES (24, '能量和信息决定着运气和命运，我们要改变命运和运气', '变命运和运气，就需要从信息和能量入手', '<p>	能量和信息决定着运气和命运，我们要改变命运和运气，就需要从这两点入手，分三步操作：观、止、变。</p><p>	&nbsp;</p><p>	（一）观</p><p>	影响一个人最重要的两个因素是：</p><p>	1.&nbsp;能量：行动</p><p>	2.&nbsp;信息：思想</p><p>	我用行动和思想组合一下，出现四个象限，可以代表人的四种状态：</p><p>	第一象限：</p><p>	思想积极、行动积极。这种人的运气必然会越来越好。</p><p>	第二象限：</p><p>	思想积极、行动懒惰。这种人肯定都是眼高手低不得志。</p><p>	第三象限：</p><p>	思想消极、行动懒惰。这种人基本处于悲摧抑郁的状态。</p><p>	第四象限：</p><p>	思想消极、行动积极。这种人很努力但是收获很少。</p><p>	检查一下，你处于哪一象限，并且在朝着哪个方向走呢？状态的发展，一般都是两种情况：恶性循环、良性循环。</p><p>	这个世界上，任何一件大的坏事都是由一件小事恶性循环逐步被放大的，大到世界大战，小到我们生活中的小事：一个眼神引起的吵架，一句话引起的命案，等等。</p><p>	&nbsp;</p><p>	（二）止</p><p>	了解了自己所处的状态，想要改变的话，首先要学会的就是停止恶性循环。在许多方面，停止错误，就是进步。“止”是修行最重要的方法！</p><p>	1.&nbsp;体验放空</p><p>	现在，你可以深呼吸几次，然后屏住呼吸，眼神不动，表情不动，全身也一动不动，这种状态持续得越久，你就放得越空，让自己处于归零的状态，多练习几次，你会感觉越来越好。</p><p>	&nbsp;</p><p>	2.&nbsp;停止错误</p><p>	反思一下自己过去的习惯和行为，如果你的某个行为正在把事情朝负面激化，就要立刻停止。</p><p>	几年前，我有次开车进办公楼下的停车场时，管理人员就是不让我进去。我问原因，他说我的停车费到期了，我说我进去后就交，他说不行，交了才能进。僵持了几分钟，我一生气，就下车走人了。</p><p>	等我上楼忙了二十分钟，突然想起这件事，赶紧下楼。这时候整个保安部的人都被气炸了，因为我的车堵在门口，想出的车出不去，想进的车进不来。</p><p>	我走到车前，保安队长气势汹汹地过来推了我一下，一副想打架的样子。我一看对方有十几个人，忍住了。</p><p>	如果我不忍住，如果我有宝珠（我一个功夫很厉害的哥们儿）的功夫，一分钟就可以把他们十几个人撂倒。不过，就算把他们打倒了又能怎样呢？我有可能被拘留，还有可能要赔偿一大笔医疗费用，耽误很多的事情。</p><p>	所以尽管对方推了我一下，我理都没理他，立刻开车走人，走为上策。不过呢，心里依然不爽，于是开始调节自己的情绪，检讨自己的行为，同时往积极的方向去想。</p><p>	这件事情既然发生了，而我终止了其恶性激化，我就需要往积极的方向去思考，这件事能够给自己带来哪些收获？</p><p>	一番总结之后，还真有了很多收获。</p><p>	首先，通过这件事情，再结合生活中的其他事情，我发现，不管好事还是坏事，大部分都是由一件事激化引发的连锁反应造成的。我深刻地意识到了“止”的重要性。</p><p>	其次，我第一次画出了前面的那种运气状态图，同时设想，如果做一个简单的APP，每天给自己的情绪和行动力打个分，一段时间后，就可以看到自己的运势走向图，然后给出调整建议。</p><p>	除了和外界相处，我们还要和自己相处，你的饮食习惯、作息习惯、工作习惯等，如果有给自己带来恶性循环的习惯，请赶快终止。</p><p>	例如，我有好几年都不吃早饭，还天天熬夜，导致身体越来越差，甚至坐半小时出租车后下车就会吐。后来意识到了这个问题，我就开始坚持吃早饭。</p><p>	&nbsp;</p><p>	（三）变</p><p>	几年前，我和一位电影导演谈合作。在吃饭聊天过程中，我发现他人比较善良朴实，但是性格急躁，声音干涩，气色非常差，简直像欲死之人的脸一样。</p><p>	我就对他直言，我感觉你气色很差，好像活不过三个月了似的。</p><p>	那个导演立刻傻了，盯了我半分钟说，你是怎么知道的？</p><p>	后来，他告诉我，其实已经想自杀很久了，如果不是女儿还在上大学，他早就想自杀了。我问为什么，他也说不清，就是感觉很累、很无奈，每天晚上都睡不着……</p><p>	饭后，我深入了解了一下他的状态：他最初是写剧本的，后来尝试做导演，虽然没有大才华，但是很努力，导演过两部小成本的烂片，事业一直不是很理想。</p><p>	并且，他生活非常不规律，很少喝水，每天熬夜攒剧本。头发乱糟糟，衣服惨淡淡，看起来怎么都无法和导演联系到一起，倒像一个流浪汉。</p><p>	我跟他说，哥们儿，咱先不谈电影了，你连自己都导演不好，还导演什么电影呢？咱们应该想想，怎么把你的状态调整过来。现在，我让你十分钟之内，立刻变得不觉得累，并且会非常兴奋。</p><p>	于是，我先教了他一招我中学时创造的呼吸调整法，他练习了不到五分钟，就感到浑身充满力量，发麻发胀，甚至有想打架的冲动，非常兴奋。</p><p>	然后，我就让他坐下喝茶，开始分析他的状态。</p><p>	&nbsp;</p><p>	首先，他有点儿抑郁。</p><p>	其次，要治疗抑郁，必须从身体开始，他气色差的原因是有两个非常不好的生活习惯。</p><p>	&nbsp;</p><p>	习惯一：长期熬夜</p><p>	为了写剧本，他天天晚上不睡觉，不管有没有灵感，都要熬到早上7点才睡。长期熬夜，首先伤的就是肝脏，最直接的表现就是肝脏的解毒功能下降，内脏毒素积累过多，容易上火，使人烦躁不安，皮肤干燥，眼睛干涩，性格麻木，失眠多梦，容易与人顶撞等。</p><p>	同时，长期熬夜还会导致肾功能和脾胃功能下降，引发更多的健康问题，身体不舒服了，精神自然也不舒服，长期下去，就会抑郁。</p><p>	&nbsp;</p><p>	习惯二：喝水太少</p><p>	他喝水很少，按照一个人每天正常的饮水量，喝四升水比较健康，而他几乎不喝水。身体缺水就会造成上火，上火严重就会喉咙发炎、眼睛和皮肤干涩、头昏脑涨，整个人都不自在。</p><p>	喝水太少是西北很多人身体不好的罪魁祸首，因为西北缺水，人们没有喝茶的习惯。我也曾在很长一段时间内，因为不爱喝水，身体严重上火，每天脸干、眼干、喉咙干、鼻子不透气等。一直到我上了高二，天天喝大量的茶，配合其他的方法，不仅那些问题都没了，而且整个人的精气神都彻底变了。</p><p>	&nbsp;</p><p>	再次，是他的气场问题。</p><p>	他的气场存在着严重的问题，从发型、服装到习惯，都不像一个导演，必须改变。他一听，觉得有道理，问我如何改变。</p><p>	&nbsp;</p><p>	我给了他几点建议：</p><blockquote>1.&nbsp;立刻把乱糟糟的头发剃掉，理成圆寸。</blockquote><blockquote>2.&nbsp;不要再穿灰黑色的西服了，多穿浅颜色的衣服。</blockquote><blockquote>3.&nbsp;每天最少喝四升白开水或者茶，反正没事就喝。</blockquote><blockquote>4.&nbsp;每天练习我教他的几个简单的导引动作，配合呼吸法，早晚练习半个小时就成。</blockquote><blockquote>5.&nbsp;必须晚上11点前睡觉，早晨7点前起床。一开始睡不着，也要躺到床上，通过调整呼吸方法放松自己。</blockquote><p>	因为我刚刚教他呼吸法，让他体验到了从来没有过的充满清醒的力量感，所以他对我的建议深信不疑，回去后立刻就执行了。</p><p>	过了几个月，他突然给我打电话，声音洪亮，精神兴奋，要请我吃饭。他说过去几个月，他的状态发生了翻天覆地的变化，朋友都觉得他像换了一个人，并且事业运也起来了，有老板投资，他成立了一家影视公司。</p><p>	作为导演，他已经改变了生活方式，开始导演自己的生活。前段时间他还给我打电话，说有几家公司投资了5000万，请他在四川拍一个玄幻片，看看我能不能给他找一些植入广告。刚刚在网上搜索了一下关于他的新闻，发现他已经新拍了好几部电影，整个人也活泛了起来，大胡子都留起来了。</p><p>	亲爱的读者，如果你也处于人生的低谷，对目前的自己不够满意，你是否想过改变一下呢？</p><p>	改变一下发型、表情、服装、色彩、作息、饮食、姿势、呼吸、环境……</p><p>	你尝试一下，这是很好玩的事情！它可以让我们平凡的人生变得精彩。我们必须相信，每个平凡的人，都有不平凡的命运。</p><p>	人生如戏，被动去演，就是受折磨！不信你去看大街上的人，是不是很多的人越来越麻木，被无形的力量推着，去庸庸碌碌地打发每一天？</p><p>	人生如戏，自己导演，你就是在享受！你可以去体验各种角色，你可以变得越来越有灵性和活力，然后用自己的强大力量，去影响周围，积极地变化！</p><p>	&nbsp;</p><p>	任何事情都有两面，你把注意力聚焦到哪一面，事物就朝着哪一面去发展。</p><p>	当我们觉察到恶性循环的时候，立刻止住，然后调整自身的信息和能量，然后开始积极循环，运气和命运都将发生改变。</p><p>	&nbsp;</p><p>	想要更加快速的改变自己，可以学习框架思维引爆点课程：</p><p>	掌握框架思维之后：</p><p>	1、自己会变强</p><p>	2、做事超高效</p><p>	3、客户会追你</p><p>	4、异性会追你</p><p>	5、赚钱很轻松</p><p>	6、生活很潇洒</p><p><br></p><p>	课程名称：《框架思维引爆点》</p><p>	课程时间：4月27~28号晚上9点</p><p>	课程费用：3000元</p><p>	课程方式：微信群直播课学习，学完后可以反复温习。</p>', '', NULL, 1, 'haiyin', 9, 1, 1559453126, 1559453126, NULL);
INSERT INTO `blog_post` VALUES (25, '能量和信息决定着运气和命运，我们要改变命运和运气', '变命运和运气，就需要从信息和能量入手', '<p>	能量和信息决定着运气和命运，我们要改变命运和运气，就需要从这两点入手，分三步操作：观、止、变。</p><p>	&nbsp;</p><p>	（一）观</p><p>	影响一个人最重要的两个因素是：</p><p>	1.&nbsp;能量：行动</p><p>	2.&nbsp;信息：思想</p><p>	我用行动和思想组合一下，出现四个象限，可以代表人的四种状态：</p><p>	第一象限：</p><p>	思想积极、行动积极。这种人的运气必然会越来越好。</p><p>	第二象限：</p><p>	思想积极、行动懒惰。这种人肯定都是眼高手低不得志。</p><p>	第三象限：</p><p>	思想消极、行动懒惰。这种人基本处于悲摧抑郁的状态。</p><p>	第四象限：</p><p>	思想消极、行动积极。这种人很努力但是收获很少。</p><p>	检查一下，你处于哪一象限，并且在朝着哪个方向走呢？状态的发展，一般都是两种情况：恶性循环、良性循环。</p><p>	这个世界上，任何一件大的坏事都是由一件小事恶性循环逐步被放大的，大到世界大战，小到我们生活中的小事：一个眼神引起的吵架，一句话引起的命案，等等。</p><p>	&nbsp;</p><p>	（二）止</p><p>	了解了自己所处的状态，想要改变的话，首先要学会的就是停止恶性循环。在许多方面，停止错误，就是进步。“止”是修行最重要的方法！</p><p>	1.&nbsp;体验放空</p><p>	现在，你可以深呼吸几次，然后屏住呼吸，眼神不动，表情不动，全身也一动不动，这种状态持续得越久，你就放得越空，让自己处于归零的状态，多练习几次，你会感觉越来越好。</p><p>	&nbsp;</p><p>	2.&nbsp;停止错误</p><p>	反思一下自己过去的习惯和行为，如果你的某个行为正在把事情朝负面激化，就要立刻停止。</p><p>	几年前，我有次开车进办公楼下的停车场时，管理人员就是不让我进去。我问原因，他说我的停车费到期了，我说我进去后就交，他说不行，交了才能进。僵持了几分钟，我一生气，就下车走人了。</p><p>	等我上楼忙了二十分钟，突然想起这件事，赶紧下楼。这时候整个保安部的人都被气炸了，因为我的车堵在门口，想出的车出不去，想进的车进不来。</p><p>	我走到车前，保安队长气势汹汹地过来推了我一下，一副想打架的样子。我一看对方有十几个人，忍住了。</p><p>	如果我不忍住，如果我有宝珠（我一个功夫很厉害的哥们儿）的功夫，一分钟就可以把他们十几个人撂倒。不过，就算把他们打倒了又能怎样呢？我有可能被拘留，还有可能要赔偿一大笔医疗费用，耽误很多的事情。</p><p>	所以尽管对方推了我一下，我理都没理他，立刻开车走人，走为上策。不过呢，心里依然不爽，于是开始调节自己的情绪，检讨自己的行为，同时往积极的方向去想。</p><p>	这件事情既然发生了，而我终止了其恶性激化，我就需要往积极的方向去思考，这件事能够给自己带来哪些收获？</p><p>	一番总结之后，还真有了很多收获。</p><p>	首先，通过这件事情，再结合生活中的其他事情，我发现，不管好事还是坏事，大部分都是由一件事激化引发的连锁反应造成的。我深刻地意识到了“止”的重要性。</p><p>	其次，我第一次画出了前面的那种运气状态图，同时设想，如果做一个简单的APP，每天给自己的情绪和行动力打个分，一段时间后，就可以看到自己的运势走向图，然后给出调整建议。</p><p>	除了和外界相处，我们还要和自己相处，你的饮食习惯、作息习惯、工作习惯等，如果有给自己带来恶性循环的习惯，请赶快终止。</p><p>	例如，我有好几年都不吃早饭，还天天熬夜，导致身体越来越差，甚至坐半小时出租车后下车就会吐。后来意识到了这个问题，我就开始坚持吃早饭。</p><p>	&nbsp;</p><p>	（三）变</p><p>	几年前，我和一位电影导演谈合作。在吃饭聊天过程中，我发现他人比较善良朴实，但是性格急躁，声音干涩，气色非常差，简直像欲死之人的脸一样。</p><p>	我就对他直言，我感觉你气色很差，好像活不过三个月了似的。</p><p>	那个导演立刻傻了，盯了我半分钟说，你是怎么知道的？</p><p>	后来，他告诉我，其实已经想自杀很久了，如果不是女儿还在上大学，他早就想自杀了。我问为什么，他也说不清，就是感觉很累、很无奈，每天晚上都睡不着……</p><p>	饭后，我深入了解了一下他的状态：他最初是写剧本的，后来尝试做导演，虽然没有大才华，但是很努力，导演过两部小成本的烂片，事业一直不是很理想。</p><p>	并且，他生活非常不规律，很少喝水，每天熬夜攒剧本。头发乱糟糟，衣服惨淡淡，看起来怎么都无法和导演联系到一起，倒像一个流浪汉。</p><p>	我跟他说，哥们儿，咱先不谈电影了，你连自己都导演不好，还导演什么电影呢？咱们应该想想，怎么把你的状态调整过来。现在，我让你十分钟之内，立刻变得不觉得累，并且会非常兴奋。</p><p>	于是，我先教了他一招我中学时创造的呼吸调整法，他练习了不到五分钟，就感到浑身充满力量，发麻发胀，甚至有想打架的冲动，非常兴奋。</p><p>	然后，我就让他坐下喝茶，开始分析他的状态。</p><p>	&nbsp;</p><p>	首先，他有点儿抑郁。</p><p>	其次，要治疗抑郁，必须从身体开始，他气色差的原因是有两个非常不好的生活习惯。</p><p>	&nbsp;</p><p>	习惯一：长期熬夜</p><p>	为了写剧本，他天天晚上不睡觉，不管有没有灵感，都要熬到早上7点才睡。长期熬夜，首先伤的就是肝脏，最直接的表现就是肝脏的解毒功能下降，内脏毒素积累过多，容易上火，使人烦躁不安，皮肤干燥，眼睛干涩，性格麻木，失眠多梦，容易与人顶撞等。</p><p>	同时，长期熬夜还会导致肾功能和脾胃功能下降，引发更多的健康问题，身体不舒服了，精神自然也不舒服，长期下去，就会抑郁。</p><p>	&nbsp;</p><p>	习惯二：喝水太少</p><p>	他喝水很少，按照一个人每天正常的饮水量，喝四升水比较健康，而他几乎不喝水。身体缺水就会造成上火，上火严重就会喉咙发炎、眼睛和皮肤干涩、头昏脑涨，整个人都不自在。</p><p>	喝水太少是西北很多人身体不好的罪魁祸首，因为西北缺水，人们没有喝茶的习惯。我也曾在很长一段时间内，因为不爱喝水，身体严重上火，每天脸干、眼干、喉咙干、鼻子不透气等。一直到我上了高二，天天喝大量的茶，配合其他的方法，不仅那些问题都没了，而且整个人的精气神都彻底变了。</p><p>	&nbsp;</p><p>	再次，是他的气场问题。</p><p>	他的气场存在着严重的问题，从发型、服装到习惯，都不像一个导演，必须改变。他一听，觉得有道理，问我如何改变。</p><p>	&nbsp;</p><p>	我给了他几点建议：</p><blockquote>1.&nbsp;立刻把乱糟糟的头发剃掉，理成圆寸。</blockquote><blockquote>2.&nbsp;不要再穿灰黑色的西服了，多穿浅颜色的衣服。</blockquote><blockquote>3.&nbsp;每天最少喝四升白开水或者茶，反正没事就喝。</blockquote><blockquote>4.&nbsp;每天练习我教他的几个简单的导引动作，配合呼吸法，早晚练习半个小时就成。</blockquote><blockquote>5.&nbsp;必须晚上11点前睡觉，早晨7点前起床。一开始睡不着，也要躺到床上，通过调整呼吸方法放松自己。</blockquote><p>	因为我刚刚教他呼吸法，让他体验到了从来没有过的充满清醒的力量感，所以他对我的建议深信不疑，回去后立刻就执行了。</p><p>	过了几个月，他突然给我打电话，声音洪亮，精神兴奋，要请我吃饭。他说过去几个月，他的状态发生了翻天覆地的变化，朋友都觉得他像换了一个人，并且事业运也起来了，有老板投资，他成立了一家影视公司。</p><p>	作为导演，他已经改变了生活方式，开始导演自己的生活。前段时间他还给我打电话，说有几家公司投资了5000万，请他在四川拍一个玄幻片，看看我能不能给他找一些植入广告。刚刚在网上搜索了一下关于他的新闻，发现他已经新拍了好几部电影，整个人也活泛了起来，大胡子都留起来了。</p><p>	亲爱的读者，如果你也处于人生的低谷，对目前的自己不够满意，你是否想过改变一下呢？</p><p>	改变一下发型、表情、服装、色彩、作息、饮食、姿势、呼吸、环境……</p><p>	你尝试一下，这是很好玩的事情！它可以让我们平凡的人生变得精彩。我们必须相信，每个平凡的人，都有不平凡的命运。</p><p>	人生如戏，被动去演，就是受折磨！不信你去看大街上的人，是不是很多的人越来越麻木，被无形的力量推着，去庸庸碌碌地打发每一天？</p><p>	人生如戏，自己导演，你就是在享受！你可以去体验各种角色，你可以变得越来越有灵性和活力，然后用自己的强大力量，去影响周围，积极地变化！</p><p>	&nbsp;</p><p>	任何事情都有两面，你把注意力聚焦到哪一面，事物就朝着哪一面去发展。</p><p>	当我们觉察到恶性循环的时候，立刻止住，然后调整自身的信息和能量，然后开始积极循环，运气和命运都将发生改变。</p><p>	&nbsp;</p><p>	想要更加快速的改变自己，可以学习框架思维引爆点课程：</p><p>	掌握框架思维之后：</p><p>	1、自己会变强</p><p>	2、做事超高效</p><p>	3、客户会追你</p><p>	4、异性会追你</p><p>	5、赚钱很轻松</p><p>	6、生活很潇洒</p><p><br></p><p>	课程名称：《框架思维引爆点》</p><p>	课程时间：4月27~28号晚上9点</p><p>	课程费用：3000元</p><p>	课程方式：微信群直播课学习，学完后可以反复温习。</p>', '', NULL, 1, 'haiyin', 9, 1, 1559453761, 1559453761, NULL);
INSERT INTO `blog_post` VALUES (26, '理清思路，整合资源', '垄断式营销，霸屏式推广，垄断式营销，霸屏式推广，打造个人品牌，建立销售渠道，打造个人品牌，建立销售渠道', '第一步：垄断式营销，霸屏式推广\r\n\r\n直接借用黄友军的模式，直接对天猫、淘宝、阿里巴巴、百度、58同城等平台，进行霸屏式的推广。\r\n\r\n这样的话，其他做网络推广的都不会是他的对手，于是可以获得最多的前端客户资源。\r\n\r\n然后自己有产品，每个地区都可以招募自己的合作服务商，做到轻资产的运营，规模可以迅速做大。\r\n\r\n第二步：做海外推广，获得领先机会\r\n\r\nGoogle搜索了一下他们的行业关键词，发现竞争对手，搜索第一页仅一个英国公司，其他都是一些B2B网站的信息，SEO很容易。\r\n\r\n细分领域海外市场机会是非常大的，就像深圳的绿联，2015年加入秦王会的时候，目标是年销售额2亿元。\r\n\r\n为此，他们还投入了500万做了一个自己的平台，后来做诊断的时候，我建议他放弃自己的平台，开始进军海外的亚马逊。\r\n\r\n结果，他们采用了我的建议，获得了超速的发展，现在已经年销售额几十亿元了。\r\n\r\n无论是B端，还是C端，很多细分领域都有很大的机会。\r\n\r\n第三步：打造个人品牌，建立销售渠道\r\n\r\n这个行业市场巨大，但是整个行业人士思维落伍，王毕把用的非常熟练的互联网思维套用到他们这个行业，就是降维打击。\r\n\r\n例如把牧场理论教给那些门店小老板，靠微信就可以迅速提升销售业绩，然后就可以整合他们变成自己的渠道。\r\n\r\n第四步：创建行业联盟，整个行业资源\r\n\r\n当一个行业需要变革的时候，谁最早创办行业发展论坛，建立行业联盟，就可以获得最好的整合资源机会。\r\n\r\n他们这个行业很大，但是没有人这么做，他接下来要开始做的话，可以获得最好的机会，快速打造自己的整个行业的影响力。\r\n\r\n由于当地每年都会有30%的工厂倒闭，也会有新的工厂诞生，所以生产性企业竞争惨烈。\r\n\r\n王毕把整个营销渠道建立好了之后，可以很轻松的收编工厂，整合更多的额上下游资源。\r\n\r\n第五步：跨行业合作，借力做市场\r\n\r\n想要成功，理清的思路之后，更重要的是资源，于是我就帮他对接了一些合作资源。\r\n\r\n例如我的学员中，有和他们有共同客户，产品不同，但是有上万个渠道的，我对接他们合作，可以借力做市场。\r\n\r\n理清思路，整合资源；睡前半小时，就写这么多，抽空再和大家分享\r\n', '', NULL, 1, NULL, 10, 0, 1562891150, 1562891249, NULL);
INSERT INTO `blog_post` VALUES (27, 'qweqe', 'qewqew', '<p>adda</p><p>ad</p><p>ad</p><p>ads</p><p>ads</p><p>ads</p><p>ads</p><p>ads</p><p>asd</p><p>asd</p><p>asd</p><p>das</p>', '', NULL, NULL, NULL, NULL, 0, 1562939278, 1562939278, NULL);
INSERT INTO `blog_post` VALUES (28, 'Yii2.0-图片上传，富文本编辑器，标签组件', 'Yii2.0-图片上传，富文本编辑器，标签组件', '<p>将下载的yii2-tags-master 修改 tags ；</p><p><br/></p><p>注意：修改成其他文件名请修改插件内对应的命名空间，</p><p><br/></p><p>将文件放在 根目录/common/widgets 下即可</p><p><br/></p><p>标签样式添加到 ：frontend\\web\\css\\site.css</p><p><br/></p><p>&lt;?=$form-&gt;field($model,&#39;tags&#39;)-&gt;widget(&#39;common\\widgets\\tags\\TagWidget&#39;)?&gt;</p><p><br/></p>', '', NULL, 3, NULL, 3, 0, 1562941551, 1562941843, NULL);

-- ----------------------------
-- Table structure for blog_post_status
-- ----------------------------
DROP TABLE IF EXISTS `blog_post_status`;
CREATE TABLE `blog_post_status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `postid` int(11) NOT NULL COMMENT '文章 id',
  `position` int(11) NOT NULL COMMENT '排序',
  `pv` int(11) NULL DEFAULT 1 COMMENT 'pv 网页浏览量',
  `praise` int(11) NULL DEFAULT 0 COMMENT '点赞',
  `collect` int(11) NULL DEFAULT 0 COMMENT '收藏',
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '文章状态，0草稿，1已发布，2已归档',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '文章状态表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of blog_post_status
-- ----------------------------
INSERT INTO `blog_post_status` VALUES (1, 3, 0, 1, 0, 0, '草稿');
INSERT INTO `blog_post_status` VALUES (2, 12, 1, 23, 0, 0, '已发布');
INSERT INTO `blog_post_status` VALUES (3, 15, 2, 29, 0, 0, '已归档');

-- ----------------------------
-- Table structure for blog_post_tag
-- ----------------------------
DROP TABLE IF EXISTS `blog_post_tag`;
CREATE TABLE `blog_post_tag`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `post_id` int(11) NULL DEFAULT NULL COMMENT '文章 id',
  `tag_id` int(11) NULL DEFAULT NULL COMMENT '标签 id',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `post_id`(`post_id`, `tag_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '文章和标签的关联' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of blog_post_tag
-- ----------------------------
INSERT INTO `blog_post_tag` VALUES (1, 21, 17);
INSERT INTO `blog_post_tag` VALUES (2, 21, 18);
INSERT INTO `blog_post_tag` VALUES (3, 22, 17);
INSERT INTO `blog_post_tag` VALUES (4, 22, 18);
INSERT INTO `blog_post_tag` VALUES (8, 23, 1);
INSERT INTO `blog_post_tag` VALUES (5, 23, 17);
INSERT INTO `blog_post_tag` VALUES (6, 23, 19);
INSERT INTO `blog_post_tag` VALUES (7, 23, 20);
INSERT INTO `blog_post_tag` VALUES (9, 24, 21);
INSERT INTO `blog_post_tag` VALUES (10, 24, 22);
INSERT INTO `blog_post_tag` VALUES (11, 24, 23);
INSERT INTO `blog_post_tag` VALUES (12, 25, 21);
INSERT INTO `blog_post_tag` VALUES (13, 25, 22);
INSERT INTO `blog_post_tag` VALUES (14, 25, 23);

-- ----------------------------
-- Table structure for blog_tag
-- ----------------------------
DROP TABLE IF EXISTS `blog_tag`;
CREATE TABLE `blog_tag`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '标签 ID',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '标签名称',
  `frequency` int(11) NULL DEFAULT 1 COMMENT '关联文章数量, 标签出现的频率',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tag_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '文章标签表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of blog_tag
-- ----------------------------
INSERT INTO `blog_tag` VALUES (1, 'Yii', 26);
INSERT INTO `blog_tag` VALUES (2, 'RESTful Web服务', 6);
INSERT INTO `blog_tag` VALUES (3, 'Yii2', 32);
INSERT INTO `blog_tag` VALUES (4, 'Gii', 9);
INSERT INTO `blog_tag` VALUES (5, '查询构建器', 2);
INSERT INTO `blog_tag` VALUES (6, 'DAO', 8);
INSERT INTO `blog_tag` VALUES (7, 'GridView', 11);
INSERT INTO `blog_tag` VALUES (8, 'ListView', 5);
INSERT INTO `blog_tag` VALUES (9, 'DetailView', 5);
INSERT INTO `blog_tag` VALUES (10, 'ActiveRecord', 27);
INSERT INTO `blog_tag` VALUES (11, '安装', 4);
INSERT INTO `blog_tag` VALUES (12, 'Composer', 4);
INSERT INTO `blog_tag` VALUES (13, '小部件', 1);
INSERT INTO `blog_tag` VALUES (14, 'widget', 1);
INSERT INTO `blog_tag` VALUES (15, '视频教程', 1);
INSERT INTO `blog_tag` VALUES (16, '教程', 1);
INSERT INTO `blog_tag` VALUES (17, 'adsf', 3);
INSERT INTO `blog_tag` VALUES (18, 'xing', 2);
INSERT INTO `blog_tag` VALUES (19, 'ceshi', 1);
INSERT INTO `blog_tag` VALUES (20, 'quanxian', 1);
INSERT INTO `blog_tag` VALUES (21, '改变错误', 2);
INSERT INTO `blog_tag` VALUES (22, '信息和能量', 2);
INSERT INTO `blog_tag` VALUES (23, '命运', 2);
INSERT INTO `blog_tag` VALUES (25, '商业模式,资源整合,资源', 1);

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '认证的 key',
  `password_hash` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `password_reset_token` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '重置密码token',
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '邮箱',
  `status` smallint(6) NOT NULL DEFAULT 10 COMMENT '状态,10注册已验证，9注册未验证',
  `avatar` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '用户头像',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  `verification_token` varchar(180) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '认证token',
  `deleted_at` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `password_reset_token`(`password_reset_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of blog_user
-- ----------------------------
INSERT INTO `blog_user` VALUES (1, 'longwen', 'Fd4CCY9DHop-vtpdoyLO_gruh3WaUsxJ', '$2y$13$1p3sk3KPOW/kvfPE6S6.1eOH0ICZY7bPDxv4rqFbYqGhMxnjheZ4m', NULL, '1348551496@qq.com', 10, NULL, 1562765351, 1562765351, '8TQQ7UVUeyYxViV5Oaf4Olf4KTbapbxi_1562765351', NULL);
INSERT INTO `blog_user` VALUES (2, 'tutu', 'Fd4CCY9DHop-vtpdoyLO_gruh3WaUsTU', '$2y$13$1p3sk3KPOW/kvfPE6S6.1eOH0ICZY7bPDxv4rqFbYqGhMxnjheZ4m', NULL, 'tutu@live.com', 10, NULL, 1562768900, 1562778351, '', NULL);
INSERT INTO `blog_user` VALUES (3, 'haiyin', 'Fd4CCY9DHop-vtpdoyLO_gruh3WaUYin', '$2y$13$1p3sk3KPOW/kvfPE6S6.1eOH0ICZY7bPDxv4rqFbYqGhMxnjheZ4m', NULL, 'haiyin@live.com', 10, NULL, 1562885351, 1562789351, '', NULL);

SET FOREIGN_KEY_CHECKS = 1;
