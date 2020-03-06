ALTER TABLE `shua_tools`
ADD COLUMN `prices` VARCHAR(100) DEFAULT NULL;

DROP TABLE IF EXISTS `shua_cart`;
CREATE TABLE `shua_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(32) NOT NULL,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `tid` int(11) NOT NULL,
  `input` text NOT NULL,
  `num` int(11) unsigned NOT NULL DEFAULT '1',
  `money` varchar(32) NULL,
  `addtime` datetime NULL,
  `endtime` datetime NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY userid (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `yc_kami` (
  `id` int(11) NOT NULL,
  `km` varchar(50) NOT NULL,
  `value` int(11) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `lasttime` datetime DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `shua_config` VALUES ('shoppingcart', '1');