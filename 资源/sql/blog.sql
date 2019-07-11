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

 Date: 11/07/2019 09:06:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blog_adminuser
-- ----------------------------
DROP TABLE IF EXISTS `blog_adminuser`;
CREATE TABLE `blog_adminuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `username` varchar(80) NOT NULL COMMENT '用户名',
  `nickname` varchar(80) NOT NULL COMMENT '昵称',
  `password` varchar(200) DEFAULT NULL COMMENT '密码',
  `email` varchar(120) DEFAULT NULL COMMENT '邮箱',
  `avatar` varchar(120) DEFAULT NULL COMMENT '头像',
  `level` smallint(2) DEFAULT NULL COMMENT '级别',
  `profile` text COMMENT '介绍',
  `auth_key` varchar(32) DEFAULT NULL COMMENT '用户 key',
  `password_hash` varchar(200) DEFAULT NULL COMMENT '加密密码',
  `password_reset_token` varchar(200) DEFAULT NULL COMMENT '重置密码 token',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

-- ----------------------------
-- Table structure for blog_category
-- ----------------------------
DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `name` varchar(80) DEFAULT NULL COMMENT '分类名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='文章分类表';

-- ----------------------------
-- Table structure for blog_chat
-- ----------------------------
DROP TABLE IF EXISTS `blog_chat`;
CREATE TABLE `blog_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户 id',
  `content` varchar(255) NOT NULL COMMENT '留言内容',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='聊天信息';

-- ----------------------------
-- Table structure for blog_comment
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论自增 id',
  `content` text COMMENT '评论内容',
  `status` int(11) DEFAULT '0' COMMENT '1 评论已发布，0 未发布',
  `user_id` int(11) DEFAULT '0' COMMENT '前台用户 id',
  `email` varchar(80) DEFAULT NULL COMMENT '邮箱',
  `url` varchar(120) DEFAULT NULL COMMENT '评论链接',
  `post_id` int(11) DEFAULT NULL COMMENT '文章 id',
  `remind` smallint(4) DEFAULT '0' COMMENT '0 未提醒，1 已提醒',
  `created_at` int(11) DEFAULT NULL COMMENT '评论创建日期',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改日期',
  `deleted_at` smallint(2) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `comment_postId` (`post_id`),
  KEY `comment_userId` (`user_id`),
  KEY `commentstatus` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COMMENT='评论表';

-- ----------------------------
-- Table structure for blog_comment_status
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment_status`;
CREATE TABLE `blog_comment_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `name` varchar(40) NOT NULL COMMENT '评论 name',
  `position` tinyint(2) NOT NULL COMMENT '是否发表',
  `pv` int(11) DEFAULT '1' COMMENT 'page view 浏览量',
  `praise` int(11) DEFAULT '0' COMMENT '点赞',
  `collect` int(11) DEFAULT '0' COMMENT '收藏',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='评论状态表';

-- ----------------------------
-- Table structure for blog_migration
-- ----------------------------
DROP TABLE IF EXISTS `blog_migration`;
CREATE TABLE `blog_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for blog_post
-- ----------------------------
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
  `status` int(11) DEFAULT '0' COMMENT '是否发布, 0-未发布, 1-已发布, 2-已归档',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `deleted_at` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COMMENT='文章主表';

-- ----------------------------
-- Table structure for blog_post_status
-- ----------------------------
DROP TABLE IF EXISTS `blog_post_status`;
CREATE TABLE `blog_post_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `postid` int(11) NOT NULL COMMENT '文章 id',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `position` int(11) NOT NULL COMMENT 'position',
  `pv` int(11) DEFAULT '1' COMMENT '网页浏览量',
  `praise` int(11) DEFAULT '0' COMMENT '点赞',
  `collect` int(11) DEFAULT '0' COMMENT '收藏',
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='文章状态表';

-- ----------------------------
-- Table structure for blog_post_tag
-- ----------------------------
DROP TABLE IF EXISTS `blog_post_tag`;
CREATE TABLE `blog_post_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `post_id` int(11) DEFAULT NULL COMMENT '文章 id',
  `tag_id` int(11) DEFAULT NULL COMMENT '标签 id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_id` (`post_id`,`tag_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COMMENT='文章和标签的关联';

-- ----------------------------
-- Table structure for blog_tag
-- ----------------------------
DROP TABLE IF EXISTS `blog_tag`;
CREATE TABLE `blog_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 id',
  `name` varchar(40) NOT NULL COMMENT '标签名称',
  `frequency` int(11) DEFAULT '1' COMMENT '关联文章数量, 标签出现的频率',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COMMENT='文章标签表';

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `password_reset_token` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  `deleted_at` int(11) NOT NULL COMMENT '删除时间',
  `verification_token` varchar(180) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`, `userid`) USING BTREE,
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
