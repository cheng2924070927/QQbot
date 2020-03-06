DROP TABLE IF EXISTS `shua_cache`;
create table `shua_cache` (
`k` varchar(32) NOT NULL,
`v` text NULL,
PRIMARY KEY  (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_qiandao`;
CREATE TABLE `shua_qiandao`(
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `qq` VARCHAR(20) DEFAULT NULL,
  `reward` decimal(10,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `time` datetime NOT NULL,
  `continue` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY zid (`zid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_message`;
CREATE TABLE `shua_message`(
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL DEFAULT '0',
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `color` VARCHAR(20) DEFAULT NULL,
  `addtime` datetime NOT NULL,
  `count` int(11) unsigned NOT NULL DEFAULT 0,
  `active` tinyint(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_price`;
CREATE TABLE `shua_price`(
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '0',
  `kind` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 ±¶Êý 1 ¼Û¸ñ',
  `name` varchar(255) NOT NULL,
  `p_0` decimal(8,2) NOT NULL DEFAULT '0.00',
  `p_1` decimal(8,2) NOT NULL DEFAULT '0.00',
  `p_2` decimal(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_workorder`;
CREATE TABLE `shua_workorder`(
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `type` int(1) unsigned NOT NULL DEFAULT '0',
  `orderid` int(11) unsigned NOT NULL DEFAULT '0',
  `content` TEXT NOT NULL,
  `addtime` datetime NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY zid (`zid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `shua_faka`
MODIFY COLUMN `km` text DEFAULT NULL,
MODIFY COLUMN `pw` text DEFAULT NULL;

ALTER TABLE `shua_tools`
CHANGE `alert` `desc` text DEFAULT NULL,
ADD COLUMN `prid` int(11) NOT NULL DEFAULT '0',
ADD COLUMN `alert` text DEFAULT NULL,
ADD COLUMN `close` tinyint(2) NOT NULL DEFAULT '0',
ADD COLUMN `permission` tinyint(2) NOT NULL DEFAULT '0',
ADD COLUMN `max` int(11) NOT NULL DEFAULT '0',
MODIFY COLUMN `input` varchar(250) DEFAULT NULL;

ALTER TABLE `shua_orders`
ADD INDEX zid (`zid`),
ADD INDEX input (`input`),
ADD INDEX userid (`userid`);

ALTER TABLE `shua_tools`
ADD INDEX cid (`cid`);

ALTER TABLE `shua_tixian`
ADD INDEX zid (`zid`);

ALTER TABLE `shua_points`
ADD INDEX zid (`zid`);

ALTER TABLE `shua_site`
MODIFY COLUMN `domain` varchar(50) DEFAULT NULL,
ADD COLUMN `msgread` varchar(255) DEFAULT NULL;

UPDATE `shua_site` SET `power`=2 WHERE `power`=1;
UPDATE `shua_site` SET `power`=1 WHERE `power`=0;

INSERT INTO `shua_config` VALUES ('user_open', '1');
INSERT INTO `shua_config` VALUES ('qiandao_reward', '0.02');
INSERT INTO `shua_config` VALUES ('qiandao_mult', '1.05');
INSERT INTO `shua_config` VALUES ('qiandao_day', '15');
UPDATE shua_config SET v='3' WHERE k='ui_background';
DELETE FROM `shua_config` WHERE `k`='cache';
DELETE FROM `shua_config` WHERE `k`='tongji_cache';
DELETE FROM `shua_config` WHERE `k`='pricejk_price';
DELETE FROM `shua_config` WHERE `k`='pricejk_cost';
DELETE FROM `shua_config` WHERE `k`='pricejk_cost2';