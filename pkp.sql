# Host: localhost  (Version: 5.5.53)
# Date: 2018-01-31 22:04:30
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "data"
#

/*!40000 ALTER TABLE `data` DISABLE KEYS */;
INSERT INTO `data` VALUES (1,'-52-28-1-26-45-20-9-34-2-27','2017-10-20 11:17:57'),(2,'-38-15-8-12-4-17-46-41-14-24','2017-10-21 11:20:27'),(3,'-27-50-18-41-14-39-36-33-35-47','2017-10-22 11:21:04'),(4,'-17-43-2-25-42-50-28-45-9-18','2017-10-23 11:21:32'),(5,'-31-28-19-33-44-45-6-10-52-32','2017-10-24 11:22:19');
/*!40000 ALTER TABLE `data` ENABLE KEYS */;
