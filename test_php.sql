-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2015 at 05:57 AM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `contatos`
--

CREATE TABLE IF NOT EXISTS `contatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contatos`
--

INSERT INTO `contatos` (`id`, `nome`) VALUES
(2, 'Ricardo'),
(3, 'Bruna'),
(4, 'Marcelo');

-- --------------------------------------------------------

--
-- Table structure for table `contatos_emails`
--

CREATE TABLE IF NOT EXISTS `contatos_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_contato` int(11) NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `contatos_emails`
--

INSERT INTO `contatos_emails` (`id`, `id_contato`, `email`) VALUES
(5, 2, 'ricardo@gmail.com'),
(4, 3, 'bruna@gmail.com'),
(6, 2, 'ricardo@hotmail.com'),
(7, 4, 'marcelo@uol.com.br');

-- --------------------------------------------------------

--
-- Table structure for table `contatos_fones`
--

CREATE TABLE IF NOT EXISTS `contatos_fones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_contato` int(11) NOT NULL,
  `fone` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `contatos_fones`
--

INSERT INTO `contatos_fones` (`id`, `id_contato`, `fone`) VALUES
(1, 2, '98295745'),
(2, 2, '32456578'),
(4, 3, '32321456'),
(5, 4, '92455321');

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `sigla` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `estados`
--

INSERT INTO `estados` (`id`, `nome`, `sigla`) VALUES
(1, 'Acre', 'AC'),
(2, 'Alagoas', 'AL'),
(3, 'Amapá', 'AP'),
(4, 'Amazonas', 'AM'),
(5, 'Bahia', 'BA'),
(6, 'Ceará', 'CE'),
(7, 'Distrito Federal', 'DF'),
(8, 'Espírito Santo', 'ES'),
(9, 'Goiás', 'GO'),
(10, 'Maranhão', 'MA'),
(11, 'Mato Grosso', 'MT'),
(12, 'Mato Grosso do Sul', 'MS'),
(13, 'Minas Gerais', 'MG'),
(14, 'Pará', 'PA'),
(15, 'Paraíba', 'PB'),
(16, 'Paraná', 'PR'),
(17, 'Pernambuco', 'PE'),
(18, 'Piauí', 'PI'),
(19, 'Rio de Janeiro', 'RJ'),
(20, 'Rio Grande do Norte', 'RN'),
(21, 'Rio Grande do Sul', 'RS'),
(22, 'Rondônia', 'RO'),
(23, 'Roraima', 'RR'),
(24, 'Santa Catarina', 'SC'),
(25, 'São Paulo', 'SP'),
(26, 'Sergipe', 'SE'),
(27, 'Tocantins', 'TO');

-- --------------------------------------------------------

--
-- Table structure for table `imoveis`
--

CREATE TABLE IF NOT EXISTS `imoveis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo` int(2) DEFAULT NULL,
  `numero` int(6) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `descricao` text NOT NULL,
  `data_cadastro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `cidade` (`cidade`),
  FULLTEXT KEY `cidade_2` (`cidade`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `imoveis`
--

INSERT INTO `imoveis` (`id`, `id_tipo`, `numero`, `rua`, `cidade`, `estado`, `descricao`, `data_cadastro`) VALUES
(3, 1, 335, 'Riachuelo', 'Porto Alegre', '', 'Casa muito boa, aluguel 950. Taxas não inclusas.', '2015-10-30 20:38:05'),
(2, 2, 457, 'Andradas', 'Porto Alegre', '21', 'Apartamento mobiliado, 950 reais de aluguel, taxa de condominio de R$ 200,00', '2015-10-30 14:28:53'),
(8, 4, 12345, 'Teste', 'Porto Alegre', '', 'Sala Comercial no centro de Porto Alegre.', '2015-10-31 02:45:13'),
(6, 2, 502, 'Padre Cacique', 'Porto Alegre', '', 'Apartamento na padre cacique.', '2015-10-30 20:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `imoveis_fotos`
--

CREATE TABLE IF NOT EXISTS `imoveis_fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_imovel` int(11) NOT NULL,
  `arquivo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `imoveis_fotos`
--

INSERT INTO `imoveis_fotos` (`id`, `id_imovel`, `arquivo`) VALUES
(4, 2, '56343c85c83cb.jpg'),
(3, 8, '56341dea24604.jpg'),
(5, 2, '56343c8928dc3.jpg'),
(6, 2, '56343c8bf2cdc.jpg'),
(7, 6, '56343d9a75eb3.jpg'),
(8, 3, '56343e5ac5824.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `imoveis_tipos`
--

CREATE TABLE IF NOT EXISTS `imoveis_tipos` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `imoveis_tipos`
--

INSERT INTO `imoveis_tipos` (`id`, `nome`) VALUES
(1, 'Casa'),
(2, 'Apartamento'),
(4, 'Sala Comercial');

-- --------------------------------------------------------

--
-- Table structure for table `imoveis_x_contatos`
--

CREATE TABLE IF NOT EXISTS `imoveis_x_contatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_imovel` int(11) NOT NULL,
  `id_contato` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `imoveis_x_contatos`
--

INSERT INTO `imoveis_x_contatos` (`id`, `id_imovel`, `id_contato`) VALUES
(2, 8, 2),
(6, 3, 4),
(4, 2, 2),
(5, 2, 3),
(7, 6, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
