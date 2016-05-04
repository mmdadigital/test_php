-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: teste_mmda
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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
-- Table structure for table `contatos`
--

DROP TABLE IF EXISTS `contatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contatos` (
  `idcontatos` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcontatos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contatos`
--

LOCK TABLES `contatos` WRITE;
/*!40000 ALTER TABLE `contatos` DISABLE KEYS */;
INSERT INTO `contatos` VALUES (1,'Emilson José');
/*!40000 ALTER TABLE `contatos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails_contato`
--

DROP TABLE IF EXISTS `emails_contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails_contato` (
  `idemails_contato` int(11) NOT NULL AUTO_INCREMENT,
  `id_contato` int(11) DEFAULT NULL,
  `email_contato` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idemails_contato`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails_contato`
--

LOCK TABLES `emails_contato` WRITE;
/*!40000 ALTER TABLE `emails_contato` DISABLE KEYS */;
INSERT INTO `emails_contato` VALUES (1,1,'jose@email.com'),(2,1,'emilson@emailcom');
/*!40000 ALTER TABLE `emails_contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagens_imovel`
--

DROP TABLE IF EXISTS `imagens_imovel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagens_imovel` (
  `idimagens_imovel` int(11) NOT NULL AUTO_INCREMENT,
  `id_imovel` int(11) DEFAULT NULL,
  `imagem_filename` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idimagens_imovel`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagens_imovel`
--

LOCK TABLES `imagens_imovel` WRITE;
/*!40000 ALTER TABLE `imagens_imovel` DISABLE KEYS */;
INSERT INTO `imagens_imovel` VALUES (1,1,'maria-lavinia-boulevard_4 (1).jpg'),(2,1,'maria-lavinia-teaser_0.jpg'),(3,2,'inicio_da_fachada_1.jpg'),(4,2,'inicio_da_fachada_2.jpg');
/*!40000 ALTER TABLE `imagens_imovel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imoveis`
--

DROP TABLE IF EXISTS `imoveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imoveis` (
  `idimoveis` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) DEFAULT NULL,
  `rua` varchar(45) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `descricao` text,
  PRIMARY KEY (`idimoveis`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imoveis`
--

LOCK TABLES `imoveis` WRITE;
/*!40000 ALTER TABLE `imoveis` DISABLE KEYS */;
INSERT INTO `imoveis` VALUES (1,1,'Rua alfa','123','São Paulo','sp','Maria Livina'),(2,2,'rua beta','425','Recife','pe','Maria Lígia');
/*!40000 ALTER TABLE `imoveis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` char(23) NOT NULL,
  `username` varchar(65) NOT NULL DEFAULT '',
  `password` varchar(65) NOT NULL DEFAULT '',
  `email` varchar(65) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `mod_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `password_UNIQUE` (`password`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES ('01','admin','123456','email@email.com',1,'2016-05-04 19:42:37');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relacao_imovel_contato`
--

DROP TABLE IF EXISTS `relacao_imovel_contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relacao_imovel_contato` (
  `id_imovel` int(11) NOT NULL,
  `id_contato` int(11) NOT NULL,
  PRIMARY KEY (`id_imovel`,`id_contato`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relacao_imovel_contato`
--

LOCK TABLES `relacao_imovel_contato` WRITE;
/*!40000 ALTER TABLE `relacao_imovel_contato` DISABLE KEYS */;
INSERT INTO `relacao_imovel_contato` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `relacao_imovel_contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefones_contato`
--

DROP TABLE IF EXISTS `telefones_contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefones_contato` (
  `idtelefone` int(11) NOT NULL AUTO_INCREMENT,
  `id_contato` int(11) DEFAULT NULL,
  `telefone_numero` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtelefone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefones_contato`
--

LOCK TABLES `telefones_contato` WRITE;
/*!40000 ALTER TABLE `telefones_contato` DISABLE KEYS */;
INSERT INTO `telefones_contato` VALUES (1,1,'81 99999-9999'),(2,1,'81 98888-9999');
/*!40000 ALTER TABLE `telefones_contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_imovel`
--

DROP TABLE IF EXISTS `tipo_imovel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_imovel` (
  `idtipo_imovel` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtipo_imovel`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_imovel`
--

LOCK TABLES `tipo_imovel` WRITE;
/*!40000 ALTER TABLE `tipo_imovel` DISABLE KEYS */;
INSERT INTO `tipo_imovel` VALUES (1,'Tipo residencial'),(2,'tipo comercial');
/*!40000 ALTER TABLE `tipo_imovel` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-04 18:04:36
