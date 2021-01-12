# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.29)
# Database: exercise
# Generation Time: 2021-01-12 02:13:18 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table articles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;

INSERT INTO `articles` (`id`, `title`, `author_id`, `description`)
VALUES
	(1,'My life as a developer',2,'lorem ipsum ahasd lfahs aoishdg dgaosdhg asd f asdgha  asdg asdg asdg asd gjhlkh kjasdigwvvas waega aw asjadgh aagrg a dfwlorem ipsum ahasd lfahs aoishdg dgaosdhg asd f asdgha  asdg asdg asdg asd gjhlkh kjasdigwvvas waega aw asjadgh aagrg a dfw'),
	(2,'I never seen two beautifull best friendswe',1,'lorem ipsum ahasd lfahs aoishdg dgaosdhg asd f asdgha  asdg asdg asdg asd gjhlkh kjasdigwvvas waega aw asjadgh aagrg a dfwlorem ipsum ahasd lfahs aoishdg dgaosdhg asd f asdgha  asdg asdg asdg asd gjhlkh kjasdigwvvas waega aw asjadgh aagrg a dfwlorem ipsum ahasd lfahs aoishdg dgaosdhg asd f asdgha  asdg asdg asdg asd gjhlkh kjasdigwvvas waega aw asjadgh aagrg a dfw'),
	(3,'My name is Jeff',2,NULL),
	(4,'hello kitty',1,NULL),
	(5,'All arround rambo',2,NULL),
	(6,'I don\'t care ok ?',2,NULL),
	(7,'Marry me Lol',2,NULL),
	(8,'Let\'s try a new thing',1,NULL);

/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table articles_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `articles_categories`;

CREATE TABLE `articles_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articles_id` int(11) DEFAULT NULL,
  `categories_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `articles_categories` WRITE;
/*!40000 ALTER TABLE `articles_categories` DISABLE KEYS */;

INSERT INTO `articles_categories` (`id`, `articles_id`, `categories_id`)
VALUES
	(1,1,3),
	(2,2,1),
	(3,3,2),
	(4,4,1),
	(5,5,1),
	(6,6,2);

/*!40000 ALTER TABLE `articles_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table authors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `authors`;

CREATE TABLE `authors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;

INSERT INTO `authors` (`id`, `name`)
VALUES
	(1,'Ionel'),
	(2,'Donuc');

/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categorie` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `categorie`)
VALUES
	(1,'news'),
	(2,'horror'),
	(3,'educational');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
