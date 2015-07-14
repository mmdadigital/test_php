-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: test_php
-- ------------------------------------------------------
-- Server version	5.6.21

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
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'Fulano da Silva'),(2,'Ciclano da Silva'),(3,'Pedro da Silva');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_email`
--

DROP TABLE IF EXISTS `contact_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `contact_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_idx` (`contact_id`),
  CONSTRAINT `contact_id_email` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_email`
--

LOCK TABLES `contact_email` WRITE;
/*!40000 ALTER TABLE `contact_email` DISABLE KEYS */;
INSERT INTO `contact_email` VALUES (1,'joao@email.com',1),(2,'joao@outroemail.com',1),(3,'mario@email.com',2),(4,'pedro@emil.com',3);
/*!40000 ALTER TABLE `contact_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_phone`
--

DROP TABLE IF EXISTS `contact_phone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL,
  `contact_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_idx` (`contact_id`),
  CONSTRAINT `contact_id_phone` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_phone`
--

LOCK TABLES `contact_phone` WRITE;
/*!40000 ALTER TABLE `contact_phone` DISABLE KEYS */;
INSERT INTO `contact_phone` VALUES (1,'1533332222',1),(2,'11223322112',2),(3,'11223322111',2),(4,'21332222333',3);
/*!40000 ALTER TABLE `contact_phone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `realty`
--

DROP TABLE IF EXISTS `realty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `realty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `street` varchar(150) NOT NULL,
  `number` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` enum('RS','SP','RJ','SC') NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id_realty_idx` (`type`),
  CONSTRAINT `type_id_realty` FOREIGN KEY (`type`) REFERENCES `realty_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `realty`
--

LOCK TABLES `realty` WRITE;
/*!40000 ALTER TABLE `realty` DISABLE KEYS */;
INSERT INTO `realty` VALUES (1,1,'Av. Ipiranga',10,'Porto Alegre','RS','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed blandit lectus. Maecenas ultricies nibh ligula, id aliquet sem gravida sit amet. Maecenas rutrum tempus interdum. Praesent vel nisl ut justo euismod mollis. Nam sed erat eget diam vehicula commodo. Etiam leo orci, scelerisque ac tincidunt eget, imperdiet id massa. Vestibulum et dolor lobortis, luctus ex lacinia, posuere lorem. Duis diam quam, cursus efficitur ornare sit amet, hendrerit id urna. Curabitur luctus, libero id venenatis convallis, est ex ornare tortor, venenatis dapibus tortor erat id lorem. Nam eu nibh at lectus tincidunt ornare.'),(2,3,'Av. Carlos Gomes',1399,'Porto Alegre','RS','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed blandit lectus. Maecenas ultricies nibh ligula, id aliquet sem gravida sit amet. Maecenas rutrum tempus interdum. Praesent vel nisl ut justo euismod mollis. Nam sed erat eget diam vehicula commodo. Etiam leo orci, scelerisque ac tincidunt eget, imperdiet id massa. Vestibulum et dolor lobortis, luctus ex lacinia, posuere lorem. Duis diam quam, cursus efficitur ornare sit amet, hendrerit id urna. Curabitur luctus, libero id venenatis convallis, est ex ornare tortor, venenatis dapibus tortor erat id lorem. Nam eu nibh at lectus tincidunt ornare.'),(3,2,'Av. Tijuca',1200,'Rio de Janeiro','RJ','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed blandit lectus. Maecenas ultricies nibh ligula, id aliquet sem gravida sit amet. Maecenas rutrum tempus interdum. Praesent vel nisl ut justo euismod mollis. Nam sed erat eget diam vehicula commodo. Etiam leo orci, scelerisque ac tincidunt eget, imperdiet id massa. Vestibulum et dolor lobortis, luctus ex lacinia, posuere lorem. Duis diam quam, cursus efficitur ornare sit amet, hendrerit id urna. Curabitur luctus, libero id venenatis convallis, est ex ornare tortor, venenatis dapibus tortor erat id lorem. Nam eu nibh at lectus tincidunt ornare.'),(4,2,'Anita Garibaldi',232,'Porto Alegre','RS','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed blandit lectus. Maecenas ultricies nibh ligula, id aliquet sem gravida sit amet. Maecenas rutrum tempus interdum. Praesent vel nisl ut justo euismod mollis. Nam sed erat eget diam vehicula commodo. Etiam leo orci, scelerisque ac tincidunt eget, imperdiet id massa. Vestibulum et dolor lobortis, luctus ex lacinia, posuere lorem. Duis diam quam, cursus efficitur ornare sit amet, hendrerit id urna. Curabitur luctus, libero id venenatis convallis, est ex ornare tortor, venenatis dapibus tortor erat id lorem. Nam eu nibh at lectus tincidunt ornare.'),(5,1,'Av. Brasil',1231,'Rio de Janeiro','RJ','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed blandit lectus. Maecenas ultricies nibh ligula, id aliquet sem gravida sit amet. Maecenas rutrum tempus interdum. Praesent vel nisl ut justo euismod mollis. Nam sed erat eget diam vehicula commodo. Etiam leo orci, scelerisque ac tincidunt eget, imperdiet id massa. Vestibulum et dolor lobortis, luctus ex lacinia, posuere lorem. Duis diam quam, cursus efficitur ornare sit amet, hendrerit id urna. Curabitur luctus, libero id venenatis convallis, est ex ornare tortor, venenatis dapibus tortor erat id lorem. Nam eu nibh at lectus tincidunt ornare.'),(6,2,'Av. Brasil',312,'Rio de Janeiro','RJ','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed blandit lectus. Maecenas ultricies nibh ligula, id aliquet sem gravida sit amet. Maecenas rutrum tempus interdum. Praesent vel nisl ut justo euismod mollis. Nam sed erat eget diam vehicula commodo. Etiam leo orci, scelerisque ac tincidunt eget, imperdiet id massa. Vestibulum et dolor lobortis, luctus ex lacinia, posuere lorem. Duis diam quam, cursus efficitur ornare sit amet, hendrerit id urna. Curabitur luctus, libero id venenatis convallis, est ex ornare tortor, venenatis dapibus tortor erat id lorem. Nam eu nibh at lectus tincidunt ornare.');
/*!40000 ALTER TABLE `realty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `realty_contact`
--

DROP TABLE IF EXISTS `realty_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `realty_contact` (
  `realty_id` int(11) NOT NULL,
  `realty_contact` int(11) NOT NULL,
  KEY `contact_id_realty_idx` (`realty_contact`),
  KEY `realty_id_realty_idx` (`realty_id`),
  CONSTRAINT `contact_id_realty` FOREIGN KEY (`realty_contact`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `realty_id_realty` FOREIGN KEY (`realty_id`) REFERENCES `realty` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `realty_contact`
--

LOCK TABLES `realty_contact` WRITE;
/*!40000 ALTER TABLE `realty_contact` DISABLE KEYS */;
INSERT INTO `realty_contact` VALUES (1,1),(1,2),(1,3),(2,3),(3,2),(4,2),(5,3),(6,1);
/*!40000 ALTER TABLE `realty_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `realty_gallery`
--

DROP TABLE IF EXISTS `realty_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `realty_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `realty_id` int(11) NOT NULL,
  `img_file` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `realty_id_gallery_idx` (`realty_id`),
  CONSTRAINT `realty_id_gallery` FOREIGN KEY (`realty_id`) REFERENCES `realty` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `realty_gallery`
--

LOCK TABLES `realty_gallery` WRITE;
/*!40000 ALTER TABLE `realty_gallery` DISABLE KEYS */;
INSERT INTO `realty_gallery` VALUES (1,1,'1.jpg'),(2,1,'11.jpg'),(3,1,'12.jpg'),(4,1,'13.jpg'),(5,4,'2.jpg'),(6,2,'3.jpg'),(7,3,'4.jpg'),(8,5,'5.jpg'),(9,6,'6.jpg');
/*!40000 ALTER TABLE `realty_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `realty_type`
--

DROP TABLE IF EXISTS `realty_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `realty_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `realty_type`
--

LOCK TABLES `realty_type` WRITE;
/*!40000 ALTER TABLE `realty_type` DISABLE KEYS */;
INSERT INTO `realty_type` VALUES (1,'Apartamento'),(2,'Casa'),(3,'Loja'),(4,'Terreno');
/*!40000 ALTER TABLE `realty_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-14  9:40:54
