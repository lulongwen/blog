/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50725
 Source Host           : localhost:3306
 Source Schema         : blog

 Target Server Type    : MySQL
 Target Server Version : 50725
 File Encoding         : 65001

 Date: 19/07/2019 08:42:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blog_adminuser
-- ----------------------------
DROP TABLE IF EXISTS `blog_adminuser`;
CREATE TABLE `blog_adminuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 ID',
  `username` varchar(80) NOT NULL COMMENT '用户名',
  `nickname` varchar(80) NOT NULL COMMENT '昵称',
  `password_hash` varchar(200) DEFAULT NULL COMMENT '密码',
  `email` varchar(120) DEFAULT NULL COMMENT '邮箱',
  `avatar` varchar(120) DEFAULT NULL COMMENT '头像',
  `level` smallint(2) DEFAULT NULL COMMENT '级别',
  `profile` text COMMENT '介绍',
  `auth_key` varchar(32) DEFAULT NULL COMMENT '用户 key',
  `password_reset_token` varchar(200) DEFAULT NULL COMMENT '重置密码 token',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='管理员表';

-- ----------------------------
-- Table structure for blog_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `blog_auth_assignment`;
CREATE TABLE `blog_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `blog_idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `blog_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `blog_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for blog_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `blog_auth_item`;
CREATE TABLE `blog_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `blog_idx-auth_item-type` (`type`),
  CONSTRAINT `blog_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `blog_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for blog_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `blog_auth_item_child`;
CREATE TABLE `blog_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `blog_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `blog_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blog_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `blog_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for blog_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `blog_auth_rule`;
CREATE TABLE `blog_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for blog_category
-- ----------------------------
DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `name` varchar(80) DEFAULT NULL COMMENT '分类名称',
  `position` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='文章分类表';

-- ----------------------------
-- Table structure for blog_chat
-- ----------------------------
DROP TABLE IF EXISTS `blog_chat`;
CREATE TABLE `blog_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 ID',
  `userid` int(11) NOT NULL COMMENT '用户 ID',
  `content` text NOT NULL COMMENT '留言内容',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `deleted_at` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='聊天信息';

-- ----------------------------
-- Table structure for blog_comment
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论自增 id',
  `content` text COMMENT '评论内容',
  `userid` int(11) DEFAULT '0' COMMENT '用户 id',
  `email` varchar(80) DEFAULT NULL COMMENT '邮箱',
  `url` varchar(120) DEFAULT NULL COMMENT '评论链接',
  `postid` int(11) DEFAULT NULL COMMENT '文章 id',
  `remind` smallint(4) DEFAULT '0' COMMENT '0 未提醒，1 已提醒',
  `status` int(11) DEFAULT '0' COMMENT '评论状态，0-未审核，1-已审核',
  `created_at` int(11) DEFAULT NULL COMMENT '评论创建日期',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改日期',
  `deleted_at` smallint(2) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `comment_postId` (`postid`) USING BTREE,
  KEY `comment_fansId` (`userid`) USING BTREE,
  KEY `commentstatus` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='评论表';

-- ----------------------------
-- Table structure for blog_comment_status
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment_status`;
CREATE TABLE `blog_comment_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `name` varchar(40) NOT NULL COMMENT '评论 name',
  `position` tinyint(2) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `tag_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='评论状态表';

-- ----------------------------
-- Table structure for blog_migration
-- ----------------------------
DROP TABLE IF EXISTS `blog_migration`;
CREATE TABLE `blog_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for blog_post
-- ----------------------------
DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `title` varchar(200) DEFAULT NULL COMMENT '文章标题',
  `summary` text COMMENT '文章摘要',
  `content` text COMMENT '文章内容',
  `thumbnail` varchar(120) DEFAULT NULL COMMENT '缩略图片',
  `tags` text COMMENT '标签',
  `userid` int(11) DEFAULT '0' COMMENT '作者 ID',
  `username` varchar(80) DEFAULT NULL COMMENT '作者',
  `categoryid` int(11) DEFAULT NULL COMMENT '分类 ID',
  `status` int(11) DEFAULT '0' COMMENT '是否发布，0-草稿，1-已发布，2-已归档',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `deleted_at` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='文章主表';

-- ----------------------------
-- Table structure for blog_post_status
-- ----------------------------
DROP TABLE IF EXISTS `blog_post_status`;
CREATE TABLE `blog_post_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `postid` int(11) NOT NULL COMMENT '文章 id',
  `position` int(11) NOT NULL COMMENT '排序',
  `pv` int(11) DEFAULT '1' COMMENT 'pv 网页浏览量',
  `praise` int(11) DEFAULT '0' COMMENT '点赞',
  `collect` int(11) DEFAULT '0' COMMENT '收藏',
  `name` varchar(20) DEFAULT NULL COMMENT '文章状态，0草稿，1已发布，2已归档',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='文章状态表';

-- ----------------------------
-- Table structure for blog_post_tag
-- ----------------------------
DROP TABLE IF EXISTS `blog_post_tag`;
CREATE TABLE `blog_post_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `post_id` int(11) DEFAULT NULL COMMENT '文章 id',
  `tag_id` int(11) DEFAULT NULL COMMENT '标签 id',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `post_id` (`post_id`,`tag_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='文章和标签的关联';

-- ----------------------------
-- Table structure for blog_tag
-- ----------------------------
DROP TABLE IF EXISTS `blog_tag`;
CREATE TABLE `blog_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '标签 ID',
  `name` varchar(40) NOT NULL COMMENT '标签名称',
  `frequency` int(11) DEFAULT '1' COMMENT '关联文章数量, 标签出现的频率',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `tag_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='文章标签表';

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '认证的 key',
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `password_reset_token` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '重置密码token',
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '邮箱',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态,10注册已验证，9注册未验证',
  `avatar` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户头像',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  `verification_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '认证token',
  `deleted_at` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

SET FOREIGN_KEY_CHECKS = 1;
