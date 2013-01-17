-- MySQL dump 10.13  Distrib 5.1.49, for apple-darwin10.3.0 (i386)
--
-- Host: localhost    Database: phpmysqlsite
-- ------------------------------------------------------
-- Server version	5.1.49

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `phpmysqlsite`
--

CREATE USER 'phpuser'@'localhost' IDENTIFIED BY 'phppass';
CREATE USER 'phpuser'@'%' IDENTIFIED BY 'phppass';

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `phpmysqlsite` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

GRANT ALL PRIVILEGES ON phpmysqlsite.* TO 'phpuser'@'localhost';
GRANT ALL PRIVILEGES ON phpmysqlsite.* TO 'phpuser'@'%';

USE `phpmysqlsite`;

--
-- Table structure for table `content`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `ContentId` int(11) NOT NULL AUTO_INCREMENT,
  `ColumnId` int(11) NOT NULL COMMENT '0 for top, 1 for left, 2 for center, 3 for right, 4 for bottom',
  `Content` varchar(4000) NOT NULL,
  `SortSeq` int(11) NOT NULL,
  PRIMARY KEY (`ContentId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,0,'This is the top of the page.',0),(2,1,'This is the left side.',0),(3,1,'More on the left.',1),(4,2,'This is the center.',0),(5,2,'More in the center after this.',1),(6,3,'This is the right.',0),(7,4,'This is the bottom.',0);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `PageId` int(11) NOT NULL AUTO_INCREMENT,
  `PageName` varchar(255) NOT NULL,
  `PageUrl` varchar(255) NOT NULL,
  PRIMARY KEY (`PageId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,'Test Page 1','testpage1.php?parm=123456'),(2,'Test Page 2','testpage2.php?a=XYZ&b=ABC');
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(150) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `Password` varchar(150) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `FirstName` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `LastName` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `Email` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `Date_Added` date NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM AUTO_INCREMENT=7841 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'test2','§«'Ê™Wïte‘h‰ÅH','Test','Two','none@anywhere.com','2007-09-05'),(3,'test3','§«'Ê™Wïte‘h‰ÅH','Test','Three','none@anywhere.com','2007-09-05'),(1,'test1','§«'Ê™Wïte‘h‰ÅH','Test','One','none@anywhere.com','2010-03-11');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-16 16:46:00
