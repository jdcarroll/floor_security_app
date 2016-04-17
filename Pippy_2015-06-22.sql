# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.38)
# Database: Pippy
# Generation Time: 2015-06-22 05:11:34 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `access`;

CREATE TABLE `access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table floor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `floor`;

CREATE TABLE `floor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `floorName` varchar(11) DEFAULT NULL,
  `floorNumber` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `floor` WRITE;
/*!40000 ALTER TABLE `floor` DISABLE KEYS */;

INSERT INTO `floor` (`id`, `floorName`, `floorNumber`)
VALUES
	(1,'first',1),
	(2,'second',2),
	(3,'third',3),
	(4,'fourth',4),
	(5,'fifth',5),
	(6,'sixth',6),
	(7,'seventh',7);

/*!40000 ALTER TABLE `floor` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table group2get
# ------------------------------------------------------------

DROP TABLE IF EXISTS `group2get`;

CREATE TABLE `group2get` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `permLevel` tinyint(11) unsigned NOT NULL,
  `floorNum` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permLevel` (`permLevel`),
  KEY `floorNum` (`floorNum`),
  KEY `userid` (`userid`),
  CONSTRAINT `group2get_ibfk_2` FOREIGN KEY (`permLevel`) REFERENCES `permissions` (`id`),
  CONSTRAINT `group2get_ibfk_3` FOREIGN KEY (`floorNum`) REFERENCES `floor` (`id`),
  CONSTRAINT `group2get_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `group2get` WRITE;
/*!40000 ALTER TABLE `group2get` DISABLE KEYS */;

INSERT INTO `group2get` (`id`, `userid`, `permLevel`, `floorNum`)
VALUES
	(2,2,3,4),
	(4,3,3,6),
	(6,2,2,3);

/*!40000 ALTER TABLE `group2get` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` tinyint(11) unsigned NOT NULL AUTO_INCREMENT,
  `accessLevel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `accessLevel`)
VALUES
	(1,'None'),
	(2,'Escorted'),
	(3,'All');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `admin`)
VALUES
	(2,'jcarroll','beforePHP','Jeff','Carroll','jdcarroll22@gmail.com',1),
	(3,'erose','beforePHP','Eric','Rose','erose@fullsail.edu',0),
	(14,'mdivine','4f7b0e734483cd0795ef21d1c3dade6b','misha','devine','mdivine@FS.com',1),
	(15,'cdavenport','44e1051f930ac45519bb585271befe1a','cory','davenport','cdavenport@FS.com',0);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
