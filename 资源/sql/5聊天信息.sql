/**
  类似于微信的聊天功能
  主要用作后期开发移动端的会员聊天
 */

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户 id',
  `content` varchar(255) NOT NULL COMMENT '留言内容',
  `created_at` int(11) NOT NULL COMMENT '发布时间',
  `deleted_at` int(11) NOT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='聊天信息';