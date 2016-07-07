-- MySQL dump 10.13  Distrib 5.5.42, for osx10.6 (i386)
--
-- Host: localhost    Database: teste2
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `picture_index`
--

DROP TABLE IF EXISTS `picture_index`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `picture_index` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `realty_id` int(10) unsigned NOT NULL,
  `picture_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `picture_index`
--

LOCK TABLES `picture_index` WRITE;
/*!40000 ALTER TABLE `picture_index` DISABLE KEYS */;
INSERT INTO `picture_index` VALUES (1,1,1,'2016-07-05 20:48:41','2016-07-05 20:48:41'),(2,1,2,'2016-07-05 20:48:41','2016-07-05 20:48:41'),(3,1,3,'2016-07-05 20:48:41','2016-07-05 20:48:41'),(4,2,4,'2016-07-05 20:53:53','2016-07-05 20:53:53'),(5,2,5,'2016-07-05 20:53:53','2016-07-05 20:53:53'),(6,2,6,'2016-07-05 20:53:53','2016-07-05 20:53:53'),(7,3,7,'2016-07-05 20:57:40','2016-07-05 20:57:40'),(8,3,8,'2016-07-05 20:57:40','2016-07-05 20:57:40'),(9,4,9,'2016-07-05 21:02:57','2016-07-05 21:02:57'),(10,4,10,'2016-07-05 21:02:57','2016-07-05 21:02:57'),(11,4,11,'2016-07-05 21:02:57','2016-07-05 21:02:57');
/*!40000 ALTER TABLE `picture_index` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `realties`
--

DROP TABLE IF EXISTS `realties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `realties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `realty_type` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `contacts` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `realties`
--

LOCK TABLES `realties` WRITE;
/*!40000 ALTER TABLE `realties` DISABLE KEYS */;
INSERT INTO `realties` VALUES (1,1,'Alameda Pérola',15,'Campos do Jordão','SP','Casa mobiliada, com duas suítes, bem localizada.','\"[\\\"3\\\",\\\"1\\\"]\"','2016-07-05 20:48:41','2016-07-05 20:48:41'),(2,2,'Avenida Gastão Vidigal',1200,'Campos do Jordão','SP','Belo apartamento, no centro da cidade, perto de tudo. 1 suíte e ampla sacada.','\"[\\\"4\\\"]\"','2016-07-05 20:53:53','2016-07-05 20:53:53'),(3,3,'Avenida Dr Januário Miráglia',3000,'Campos do Jordão','SP','Terreno amplo. Documentação em dia.','\"[\\\"5\\\",\\\"2\\\",\\\"6\\\"]\"','2016-07-05 20:57:40','2016-07-05 20:57:40'),(4,4,'Estrada da Lagoinha',900,'Campos do Jordão','SP','Chácara com muita área verde e pomares de laranja. Lago de pesca.','\"[\\\"3\\\"]\"','2016-07-05 21:02:56','2016-07-05 21:02:56');
/*!40000 ALTER TABLE `realties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `realty_contacts`
--

DROP TABLE IF EXISTS `realty_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `realty_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phones` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emails` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `realty_contacts`
--

LOCK TABLES `realty_contacts` WRITE;
/*!40000 ALTER TABLE `realty_contacts` DISABLE KEYS */;
INSERT INTO `realty_contacts` VALUES (1,'José','{\"1\":{\"phone\":\"11 99130-7861\"},\"0\":{\"phone\":\"11 2301-1714\"}}','[{\"email\":\"jose-aldo@gmail.com\"}]','2016-07-05 19:54:18','2016-07-05 19:54:18'),(2,'Ana Paula','[{\"phone\":\"11 3571-1444\"}]','[{\"email\":\"anapaula.ero@gmail.com\"}]','2016-07-05 20:08:43','2016-07-05 20:08:43'),(3,'Albert','{\"1\":{\"phone\":\"11 3456-7554\"},\"0\":{\"phone\":\"42 1345-4567\"}}','[{\"email\":\"albertero@gmail.com\"}]','2016-07-05 20:16:13','2016-07-05 20:16:13'),(4,'Ciano','[{\"phone\":\"12 94948-4994\"}]','[{\"email\":\"cianomagento@gmail.com\"}]','2016-07-05 20:18:17','2016-07-05 20:18:17'),(5,'Marcel','[{\"phone\":\"11 3455-5434\"}]','[{\"email\":\"marcel@gmail.com\"}]','2016-07-05 20:26:55','2016-07-05 20:26:55'),(6,'Mariana','[{\"phone\":\"11 3455-5464\"}]','[{\"email\":\"mariana@gmail.com\"}]','2016-07-05 20:37:23','2016-07-05 20:37:23');
/*!40000 ALTER TABLE `realty_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `realty_pictures`
--

DROP TABLE IF EXISTS `realty_pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `realty_pictures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `realty_pictures`
--

LOCK TABLES `realty_pictures` WRITE;
/*!40000 ALTER TABLE `realty_pictures` DISABLE KEYS */;
INSERT INTO `realty_pictures` VALUES (1,'images/577c1d2993adc--casa2.jpg','Piscina',1,'2016-07-05 20:48:41','2016-07-05 20:48:41'),(2,'images/577c1d299711f--casa1.jpg','Vegetação',1,'2016-07-05 20:48:41','2016-07-05 20:48:41'),(3,'images/577c1d299785b--casa.jpeg','Fachada',1,'2016-07-05 20:48:41','2016-07-05 20:48:41'),(4,'images/577c1e61339e1--apartamento2.jpg','Lareira no quarto',1,'2016-07-05 20:53:53','2016-07-05 20:53:53'),(5,'images/577c1e6134cb5--apartamento1.jpg','Suíte',1,'2016-07-05 20:53:53','2016-07-05 20:53:53'),(6,'images/577c1e613526c--apartamento.jpg','Prédio',1,'2016-07-05 20:53:53','2016-07-05 20:53:53'),(7,'images/577c1f44d0043--terreno1.jpg','Linda vista',1,'2016-07-05 20:57:40','2016-07-05 20:57:40'),(8,'images/577c1f44d2480--terreno.jpg','Fácil acesso',1,'2016-07-05 20:57:40','2016-07-05 20:57:40'),(9,'images/577c20811a471--chacara2.jpg','Lago',1,'2016-07-05 21:02:57','2016-07-05 21:02:57'),(10,'images/577c20811c926--chacara1.jpg','Pomares',1,'2016-07-05 21:02:57','2016-07-05 21:02:57'),(11,'images/577c20811d5e0--chacara.jpg','Muito espaço',1,'2016-07-05 21:02:57','2016-07-05 21:02:57');
/*!40000 ALTER TABLE `realty_pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `realty_types`
--

DROP TABLE IF EXISTS `realty_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `realty_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `realty_types`
--

LOCK TABLES `realty_types` WRITE;
/*!40000 ALTER TABLE `realty_types` DISABLE KEYS */;
INSERT INTO `realty_types` VALUES (1,'Casa',1,'2016-07-04 22:39:59','2016-07-04 22:39:59'),(2,'Apartamento',1,'2016-07-04 22:39:59','2016-07-04 22:39:59'),(3,'Terreno',1,'2016-07-04 22:39:59','2016-07-04 22:39:59'),(4,'Chácara',1,'2016-07-04 22:39:59','2016-07-04 22:39:59'),(5,'Sítio',1,'2016-07-04 22:39:59','2016-07-04 22:39:59'),(6,'Sobrado',1,'2016-07-04 22:39:59','2016-07-04 22:39:59');
/*!40000 ALTER TABLE `realty_types` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-06 23:56:51
