/**
  后台模块表，表前缀 blog_
  1 字段名不用下划线，尽量简短，所见即所得
*/
-- 后台用户表
DROP TABLE IF EXISTS `blog_adminuser`;
CREATE TABLE `blog_adminuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `username` varchar(80) NOT NULL COMMENT '用户名',
  `nickname` varchar(80) NOT NULL COMMENT '昵称',
  `email` varchar(120) DEFAULT NULL COMMENT '邮箱',
  `email_validate_token` varchar(255) not null comment '验证邮箱 token',

  `avatar` varchar(200) DEFAULT NULL COMMENT '头像',
  `level` smallint(2) DEFAULT NULL COMMENT '级别',
  `profile` text COMMENT '介绍',
  `auth_key` varchar(32) DEFAULT NULL COMMENT '自动登录key',
  `password` varchar(200) DEFAULT NULL COMMENT '加密密码',
  `password_reset_token` varchar(200) DEFAULT NULL COMMENT '重置密码 token',

  `role` smallint(6) not null default '0' comment '角色等级',
  `status` smallint(6) not null default '0' comment '状态',
  `vip` int(11) default '0' comment '会员等级',
  `point` int(11) DEFAULT '0' COMMENT '积分',

  `created_at` int(11) NOT NULL COMMENT '创建日期',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改日期',
  `deleted_at` int(11) DEFAULT NULL COMMENT '删除日期',

  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='后台管理员表';



INSERT INTO `blog_adminuser` (`id`, `username`, `nickname`, `password`, `email`, `profile`, `auth_key`, `password_hash`, `password_reset_token`) VALUES
(1, 'longwen', '卢珑文', '$2y$13$RZ20K81ZdERPDyFq2EM31e6KjmmdNRtGmCC6Fq9NST3hWhcgoPqUy', 'webmaster@example.com.cn', 'hello,this is my profile', 'pG7TRyTIXlEbcenpi34TzmMYS2zDsMTF', '$2y$13$4Y5KRDHPFYF.rYumLe6rx.34gBLpK6HROMklh9A8.TZwRFNrM5RyW', NULL),
(2, 'anhaiyin', '安海音', '$2y$13$RZ20K81ZdERPDyFq2EM31e6KjmmdNRtGmCC6Fq9NST3hWhcgoPqUy', 'tim@u2000.com', 'a testing user', 'pG7TRyTIXlEbcenpi34TzmMYS2zDsMTF', '$2y$13$HtJqGRmc76KIRIwokii8AOQ1XZljXiuWCKUGFnH9vkTnfBpHtqgFu', NULL),
(3, 'tutu', '兔兔', '$2y$13$RZ20K81ZdERPDyFq2EM31e6KjmmdNRtGmCC6Fq9NST3hWhcgoPqUy', 'heyx@hotmail.com', 'a testing user', 'pG7TRyTIXlEbcenpi34TzmMYS2zDsMTF', '$2y$13$HtJqGRmc76KIRIwokii8AOQ1XZljXiuWCKUGFnH9vkTnfBpHtqgFu', NULL);






















