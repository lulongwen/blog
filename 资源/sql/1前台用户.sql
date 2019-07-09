/*
 前台模块表, 表前缀 blog_
*/
DROP TABLE IF EXISTS `blog_fans`;
CREATE TABLE `blog_fans` (
	`id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `username` varchar(80) not null comment '用户名',
  `auth_key` varchar(32) not null comment '自动登录key',
  `password` varchar(255) not null comment '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码 token',

  `email` varchar(80) DEFAULT NULL COMMENT '邮箱',
  `email_validate_token` varchar(255) not null comment '验证邮箱 token',
  `role` smallint(6) not null default '0' comment '角色等级',
  
  `status` smallint(6) not null default '0' comment '状态',
  `avatar` varchar(255) default null comment '头像',
  `vip` int(11) default '0' comment '会员等级',
  `point` int(11) DEFAULT '0' COMMENT '会员积分',
  `loginip` bigint(20) NOT NULL DEFAULT '0' COMMENT '登录IP',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录时间',

  `created_at` int(11) NOT NULL COMMENT '创建日期',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改日期',
  `deleted_at` int(11) DEFAULT NULL COMMENT '删除日期',

  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='前台会员表';

