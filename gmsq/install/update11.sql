ALTER TABLE `shua_tools`
ADD COLUMN `min` int(11) NOT NULL DEFAULT '0',
ADD COLUMN `uptime` int(11) NOT NULL DEFAULT '0';
INSERT INTO `shua_config` VALUES ('pricejk_time', '600');

ALTER TABLE `shua_site`
ADD COLUMN `class` varchar(255) DEFAULT NULL;

ALTER TABLE `shua_tools`
ADD COLUMN `prices` VARCHAR(100) DEFAULT NULL;