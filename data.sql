# Host: localhost  (Version: 5.5.53)
# Date: 2019-09-21 15:06:22
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "data"
#

DROP TABLE IF EXISTS `data`;
CREATE TABLE `data` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `pkp` varchar(255) NOT NULL DEFAULT '',
  `creatime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

#
# Data for table "data"
#

/*!40000 ALTER TABLE `data` DISABLE KEYS */;
INSERT INTO `data` VALUES (11,'-14-23-44','2019-09-19 17:21:00'),(12,'-0-9-47','2019-09-20 00:08:01');
/*!40000 ALTER TABLE `data` ENABLE KEYS */;
