-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2015 at 02:50 AM
-- Server version: 5.6.17-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imobiliaria`
--

-- --------------------------------------------------------

--
-- Table structure for table `cadastro`
--

CREATE TABLE IF NOT EXISTS `cadastro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codTipoImovel` int(11) NOT NULL,
  `codFoto` int(11) NOT NULL,
  `rua` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `codEstado` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkEstado` (`codEstado`) COMMENT 'Estado',
  KEY `codTipoImovel` (`codTipoImovel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cadastro`
--
ALTER TABLE `cadastro`
  ADD CONSTRAINT `fkEstado` FOREIGN KEY (`codEstado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `fkTipoImovel` FOREIGN KEY (`codTipoImovel`) REFERENCES `tipoimovel` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
