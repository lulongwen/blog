/**
数据搬家用的表, 自动创建的
 */

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(120) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='数据搬家用的表';