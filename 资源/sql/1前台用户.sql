/*
 前台模块表, 表前缀 blog_
*/
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
	`id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `username` varchar(80) not null comment '用户名',
  `auth_key` varchar(60) not null comment '自动登录key',
  `password_hash` varchar(60) not null comment '加密密码',
  `password_reset_token` varchar(60) DEFAULT NULL COMMENT '重置密码 token',

  `email` varchar(80) DEFAULT NULL COMMENT '邮箱',
  `email_validate_token` varchar(60) not null comment '验证邮箱 token',
  `role` smallint(6) not null default '0' comment '角色等级',
  
  `status` smallint(6) not null default '0' comment '状态',
  `avatar` varchar(120) default null comment '头像',
  `vip` int(11) default '0' comment '会员等级',
  `point` int(11) DEFAULT '0' COMMENT '会员积分',
  `loginip` bigint(20) NOT NULL DEFAULT '0' COMMENT '登录IP',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录时间',

  `created_at` int(11) NOT NULL COMMENT '创建日期',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改日期',
  `deleted_at` int(11) DEFAULT NULL COMMENT '删除日期',

  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='前台会员表';


INSERT INTO `blog_user` VALUES (1, 'longwen', 'pG7TRyTIXlEbcenpi34TzmMYS2zDsMTF', '$2y$13$.2b6jpz877wYXXKPHBDaOeJfCeY525zkM.ynqXa/4JH2CjS0rd1SK', NULL, 'admin@longwen.com', 10, 1462597929, 1462597929, NULL);

INSERT INTO `blog_user` VALUES (2, 'haiyin', 'pG7TRyTIXlEbcenpi34TzmMYS2zDsMTF', '$2y$13$HtJqGRmc76KIRIwokii8AOQ1XZljXiuWCKUGFnH9vkTnfBpHtqgFu', NULL, 'weixi@weixistyle.com', NULL, 2, NULL, 0, 0, 10, 1462597929, 1477554091);

INSERT INTO `blog_user` VALUES (3, 'tutu', 'xqGDBMlylihvNddSQgDkjAdpJwV4d02C', '$2y$13$bJC0vECI9EPLq/kia9CAmOT060fxoT/HopseOnY.C9siZJDOoQguK', NULL, 'mchael@163.com', NULL, 2, NULL, 0, 0, 10, 1475850924, 1475850924);
COMMIT;

