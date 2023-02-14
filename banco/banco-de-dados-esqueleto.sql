-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 05-Mar-2015 às 14:50
-- Versão do servidor: 5.1.69
-- versão do PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `padrao_pdo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `banner`
--

INSERT INTO `banner` (`id`, `titulo`, `url`, `imagem`, `status`) VALUES
(1, 'Banner 1', '', 'arq_banner/banner_1424216608.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracao`
--

CREATE TABLE IF NOT EXISTS `configuracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tipo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `configuracao`
--

INSERT INTO `configuracao` (`id`, `nome`, `email`, `tipo`, `status`) VALUES
(3, 'Paulo Henrique', 'lucas@netsuprema.com.br', 'Fale Conosco', 1),
(4, 'Lucas', 'lucas@netsuprema.com.br', 'Curriculum', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `titulo`, `img`, `texto`, `status`) VALUES
(1, 'fsad', '', 'teste', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe`
--

CREATE TABLE IF NOT EXISTS `equipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `acao` varchar(50) DEFAULT NULL,
  `datahora` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=366 ;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`id`, `usuario`, `area`, `id_area`, `acao`, `datahora`, `ip`) VALUES
(192, 'Administrador', 'usuários', 1, 'saiu', '2014-08-28 08:42:23', '192.168.7.36'),
(193, 'Paulo', 'usuários', 2, 'entrou', '2014-08-28 08:47:01', '192.168.7.36'),
(194, 'Paulo', 'usuários', 2, 'alterou', '2014-08-28 08:55:56', '192.168.7.36'),
(195, 'Paulo', 'usuários', 2, 'alterou', '2014-08-28 09:20:27', '192.168.7.36'),
(196, 'Paulo', 'usuários', 2, 'saiu', '2014-08-28 09:28:03', '192.168.7.36'),
(197, 'Administrador', 'usuários', 1, 'entrou', '2014-08-29 13:09:46', '192.168.7.36'),
(198, 'Administrador', 'usuários', 1, 'entrou', '2014-08-29 13:10:05', '192.168.7.36'),
(199, 'Administrador', 'usuários', 1, 'entrou', '2014-09-03 17:07:01', '192.168.7.126'),
(200, 'Administrador', 'usuários', 2, 'deletou', '2014-09-03 17:07:17', '192.168.7.126'),
(201, 'Administrador', 'usuários', 1, 'alterou senha', '2014-09-03 17:07:49', '192.168.7.126'),
(202, 'Administrador', 'usuários', 1, 'alterou senha', '2014-09-03 17:07:54', '192.168.7.126'),
(203, 'Administrador', 'usuários', 1, 'alterou', '2014-09-03 17:07:54', '192.168.7.126'),
(204, 'Administrador', 'Módulo', 1, 'Cadastrou', '2014-09-03 17:11:24', '192.168.7.126'),
(205, 'Administrador', 'usuários', 1, 'alterou senha', '2014-09-03 17:11:48', '192.168.7.126'),
(206, 'Administrador', 'usuários', 1, 'alterou', '2014-09-03 17:11:48', '192.168.7.126'),
(207, 'Administrador', 'usuários', 1, 'entrou', '2014-09-04 15:26:01', '192.168.7.126'),
(208, 'Administrador', 'usuários', 1, 'entrou', '2014-09-05 09:52:52', '192.168.7.126'),
(209, 'Administrador', 'Configuração', 1, 'Alterou', '2014-09-05 09:53:13', '192.168.7.126'),
(210, 'Administrador', 'Configuração', 1, 'Cadastrou', '2014-09-05 09:57:40', '192.168.7.126'),
(211, 'Administrador', 'usuários', 1, 'entrou', '2014-09-05 14:22:28', '192.168.7.36'),
(212, 'Administrador', 'Módulo', 1, 'Deletou', '2014-09-05 14:22:50', '192.168.7.36'),
(213, 'Administrador', 'usuários', 3, 'deletou', '2014-09-05 14:27:01', '192.168.7.36'),
(214, 'Administrador', 'usuários', 4, 'deletou', '2014-09-05 14:29:12', '192.168.7.36'),
(215, 'Administrador', 'usuários', 1, 'saiu', '2014-09-05 15:29:56', '192.168.7.36'),
(216, 'Administrador', 'usuários', 1, 'entrou', '2014-09-19 15:14:52', '192.168.7.36'),
(217, 'Administrador', 'usuários', 1, 'entrou', '2014-12-30 16:22:37', '192.168.7.36'),
(218, 'Administrador', 'usuários', 1, 'entrou', '2015-01-05 11:58:14', '192.168.7.36'),
(219, 'Administrador', 'usuários', 1, 'entrou', '2015-01-05 16:22:51', '192.168.7.36'),
(220, 'Administrador', 'usuários', 1, 'entrou', '2015-01-05 16:23:15', '192.168.7.36'),
(221, 'Administrador', 'usuários', 1, 'entrou', '2015-01-05 16:34:47', '192.168.7.36'),
(222, 'Administrador', 'usuários', 1, 'entrou', '2015-01-05 16:35:44', '192.168.7.36'),
(223, 'Administrador', 'usuários', 1, 'entrou', '2015-01-06 08:01:15', '192.168.7.36'),
(224, 'Administrador', 'usuários', 1, 'entrou', '2015-01-08 09:30:22', '192.168.7.36'),
(225, 'Administrador', 'usuários', 1, 'entrou', '2015-01-09 12:40:53', '192.168.7.36'),
(226, 'Administrador', 'usuários', 1, 'entrou', '2015-01-12 08:42:45', '192.168.7.36'),
(227, 'Administrador', 'usuários', 1, 'alterou', '2015-01-12 08:45:45', '192.168.7.36'),
(228, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 11:39:55', '192.168.7.36'),
(229, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 11:43:18', '192.168.7.36'),
(230, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 11:46:51', '192.168.7.36'),
(231, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 12:36:37', '192.168.7.36'),
(232, 'Administrador', 'Email', 1, 'Deletou', '2015-01-12 12:37:16', '192.168.7.36'),
(233, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 12:38:52', '192.168.7.36'),
(234, 'Administrador', 'Email', 1, 'Deletou', '2015-01-12 12:39:12', '192.168.7.36'),
(235, 'Administrador', 'Conta de Email', 1, 'Alterou a Senha', '2015-01-12 13:08:56', '192.168.7.36'),
(236, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 13:09:21', '192.168.7.36'),
(237, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:09:46', '192.168.7.36'),
(238, 'Administrador', 'Conta de Email', 1, 'Alterou a Senha', '2015-01-12 13:09:47', '192.168.7.36'),
(239, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:10:46', '192.168.7.36'),
(240, 'Administrador', 'Conta de Email', 1, 'Alterou a Senha', '2015-01-12 13:10:47', '192.168.7.36'),
(241, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:12:05', '192.168.7.36'),
(242, 'Administrador', 'Conta de Email', 1, 'Alterou a Senha', '2015-01-12 13:12:06', '192.168.7.36'),
(243, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:12:41', '192.168.7.36'),
(244, 'Administrador', 'Conta de Email', 1, 'Alterou a Senha', '2015-01-12 13:12:42', '192.168.7.36'),
(245, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:13:12', '192.168.7.36'),
(246, 'Administrador', 'Conta de Email', 1, 'Alterou a Senha', '2015-01-12 13:13:13', '192.168.7.36'),
(247, 'Administrador', 'Email', 1, 'Deletou', '2015-01-12 13:14:04', '192.168.7.36'),
(248, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 13:14:59', '192.168.7.36'),
(249, 'Administrador', 'Email', 1, 'Deletou', '2015-01-12 13:15:14', '192.168.7.36'),
(250, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:17:47', '192.168.7.36'),
(251, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:18:17', '192.168.7.36'),
(252, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:22:25', '192.168.7.36'),
(253, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:22:36', '192.168.7.36'),
(254, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:23:52', '192.168.7.36'),
(255, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:37:17', '192.168.7.36'),
(256, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 14:59:08', '192.168.7.36'),
(257, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 14:59:36', '192.168.7.36'),
(258, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 15:03:08', '192.168.7.36'),
(259, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 15:05:20', '192.168.7.36'),
(260, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 15:13:42', '192.168.7.36'),
(261, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:03:34', '192.168.7.36'),
(262, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:03:37', '192.168.7.36'),
(263, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:04:49', '192.168.7.36'),
(264, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:04:51', '192.168.7.36'),
(265, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:06:57', '192.168.7.36'),
(266, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:06:59', '192.168.7.36'),
(267, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:12:21', '192.168.7.36'),
(268, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:12:24', '192.168.7.36'),
(269, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:16:58', '192.168.7.36'),
(270, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:24:32', '192.168.7.36'),
(271, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:24:43', '192.168.7.36'),
(272, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:24:45', '192.168.7.36'),
(273, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:25:20', '192.168.7.36'),
(274, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:25:22', '192.168.7.36'),
(275, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:26:19', '192.168.7.36'),
(276, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:33:54', '192.168.7.36'),
(277, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:37:39', '192.168.7.36'),
(278, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:38:08', '192.168.7.36'),
(279, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:39:42', '192.168.7.36'),
(280, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:40:06', '192.168.7.36'),
(281, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:51:43', '192.168.7.36'),
(282, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:55:41', '192.168.7.36'),
(283, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:55:49', '192.168.7.36'),
(284, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:56:24', '192.168.7.36'),
(285, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:57:56', '192.168.7.36'),
(286, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:58:21', '192.168.7.36'),
(287, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:58:57', '192.168.7.36'),
(288, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:59:17', '192.168.7.36'),
(289, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:00:51', '192.168.7.36'),
(290, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:02:30', '192.168.7.36'),
(291, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:02:37', '192.168.7.36'),
(292, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:04:16', '192.168.7.36'),
(293, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:04:54', '192.168.7.36'),
(294, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:05:36', '192.168.7.36'),
(295, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:15:42', '192.168.7.36'),
(296, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:17:02', '192.168.7.36'),
(297, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:19:58', '192.168.7.36'),
(298, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:20:18', '192.168.7.36'),
(299, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:21:18', '192.168.7.36'),
(300, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:21:43', '192.168.7.36'),
(301, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:22:02', '192.168.7.36'),
(302, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:23:37', '192.168.7.36'),
(303, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:28:15', '192.168.7.36'),
(304, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:28:24', '192.168.7.36'),
(305, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:29:34', '192.168.7.36'),
(306, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:29:47', '192.168.7.36'),
(307, 'Administrador', 'usuários', 1, 'entrou', '2015-01-13 10:31:52', '192.168.7.36'),
(308, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-01-13 11:52:22', '192.168.7.36'),
(309, 'Administrador', 'usuários', 1, 'alterou', '2015-01-13 11:52:37', '192.168.7.36'),
(310, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-01-13 14:44:06', '192.168.7.36'),
(311, 'Administrador', 'usuários', 1, 'alterou', '2015-01-13 14:44:40', '192.168.7.36'),
(312, 'Administrador', 'Email', 1, 'Deletou', '2015-01-13 15:18:30', '192.168.7.36'),
(313, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-13 15:20:49', '192.168.7.36'),
(314, 'Administrador', 'usuários', 1, 'entrou', '2015-01-13 17:07:17', '192.168.7.36'),
(315, 'Administrador', 'usuários', 1, 'entrou', '2015-01-13 17:34:24', '192.168.7.36'),
(316, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 08:08:37', '192.168.7.36'),
(317, 'Administrador', 'usuários', 1, 'saiu', '2015-01-14 08:35:48', '192.168.7.36'),
(318, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 08:37:37', '192.168.7.36'),
(319, 'Administrador', 'usuários', 1, 'saiu', '2015-01-14 08:42:02', '192.168.7.36'),
(320, '0', 'usuários', 0, 'saiu', '2015-01-14 08:43:24', '192.168.7.36'),
(321, '0', 'usuários', 0, 'saiu', '2015-01-14 08:43:51', '192.168.7.36'),
(322, '0', 'usuários', 0, 'saiu', '2015-01-14 08:45:41', '192.168.7.36'),
(323, '0', 'usuários', 0, 'saiu', '2015-01-14 08:45:51', '192.168.7.36'),
(324, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 08:47:37', '192.168.7.36'),
(325, 'Administrador', 'usuários', 1, 'saiu', '2015-01-14 09:14:08', '192.168.7.36'),
(326, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 09:14:25', '192.168.7.36'),
(327, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 09:36:40', '192.168.7.36'),
(328, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 09:37:57', '192.168.7.36'),
(329, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 09:41:33', '192.168.7.36'),
(330, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 09:58:19', '192.168.7.36'),
(331, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 10:00:27', '192.168.7.36'),
(332, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 10:02:34', '192.168.7.36'),
(333, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 10:03:30', '192.168.7.36'),
(334, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 10:04:51', '192.168.7.36'),
(335, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 10:07:29', '192.168.7.36'),
(336, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 15:31:54', '192.168.7.36'),
(337, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 15:37:35', '192.168.7.36'),
(338, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 16:55:56', '192.168.7.36'),
(339, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 17:10:05', '192.168.7.36'),
(340, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 17:14:43', '192.168.7.36'),
(341, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 17:18:44', '192.168.7.36'),
(342, 'Administrador', 'usuários', 1, 'entrou', '2015-01-15 08:07:00', '192.168.7.36'),
(343, 'Administrador', 'usuários', 1, 'entrou', '2015-01-15 08:08:33', '192.168.7.36'),
(344, 'Administrador', 'usuários', 1, 'entrou', '2015-02-19 08:44:28', '192.168.7.36'),
(345, 'Administrador', 'usuários', 1, 'entrou', '2015-02-19 08:44:33', '192.168.7.36'),
(346, 'Administrador', 'usuários', 1, 'entrou', '2015-02-19 08:44:45', '192.168.7.36'),
(347, 'Administrador', 'usuários', 1, 'saiu', '2015-02-19 08:55:42', '192.168.7.36'),
(348, 'Administrador', 'usuários', 1, 'entrou', '2015-02-25 15:05:33', '192.168.7.36'),
(349, 'Administrador', 'usuários', 1, 'entrou', '2015-02-25 17:10:00', '192.168.7.36'),
(350, 'Administrador', 'Empresa', 1, 'Alterou', '2015-02-25 17:18:55', '192.168.7.36'),
(351, 'Administrador', 'usuários', 1, 'entrou', '2015-03-05 13:27:40', '192.168.7.36'),
(352, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-03-05 14:09:51', '192.168.7.36'),
(353, 'Administrador', 'usuários', 1, 'alterou', '2015-03-05 14:12:52', '192.168.7.36'),
(354, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-03-05 14:19:00', '192.168.7.36'),
(355, 'Administrador', 'usuários', 1, 'alterou', '2015-03-05 14:22:40', '192.168.7.36'),
(356, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-03-05 14:26:51', '192.168.7.36'),
(357, 'Administrador', 'usuários', 1, 'alterou', '2015-03-05 14:27:18', '192.168.7.36'),
(358, 'Administrador', 'Categoria', 1, 'Cadastrou', '2015-03-05 14:27:34', '192.168.7.36'),
(359, 'Administrador', 'Categoria', 1, 'Deletou', '2015-03-05 14:27:39', '192.168.7.36'),
(360, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-03-05 14:28:38', '192.168.7.36'),
(361, 'Administrador', 'usuários', 1, 'alterou', '2015-03-05 14:29:08', '192.168.7.36'),
(362, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-03-05 14:37:20', '192.168.7.36'),
(363, 'Administrador', 'usuários', 1, 'alterou', '2015-03-05 14:37:54', '192.168.7.36'),
(364, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-03-05 14:44:13', '192.168.7.36'),
(365, 'Administrador', 'usuários', 1, 'alterou', '2015-03-05 14:44:39', '192.168.7.36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao_secao_fixa`
--

CREATE TABLE IF NOT EXISTS `permissao_secao_fixa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secao_fixa_id` int(11) NOT NULL DEFAULT '0',
  `usuarios_id` int(11) NOT NULL,
  `cadastrar` int(1) NOT NULL DEFAULT '0',
  `alterar` int(1) NOT NULL DEFAULT '0',
  `excluir` int(1) NOT NULL DEFAULT '0',
  `publicar` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `permissao_secao_fixa_FKIndex1` (`usuarios_id`),
  KEY `permissao_secao_fixa_FKIndex2` (`secao_fixa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Extraindo dados da tabela `permissao_secao_fixa`
--

INSERT INTO `permissao_secao_fixa` (`id`, `secao_fixa_id`, `usuarios_id`, `cadastrar`, `alterar`, `excluir`, `publicar`) VALUES
(67, 1, 1, 1, 1, 1, 1),
(68, 2, 1, 1, 1, 1, 1),
(69, 3, 1, 1, 1, 1, 1),
(70, 4, 1, 1, 1, 1, 1),
(71, 5, 1, 1, 1, 1, 1),
(72, 6, 1, 1, 1, 1, 1),
(73, 7, 1, 1, 1, 1, 1),
(74, 8, 1, 1, 1, 1, 1),
(75, 9, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `video` varchar(400) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `destaque` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_categoria`
--

CREATE TABLE IF NOT EXISTS `produto_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_foto`
--

CREATE TABLE IF NOT EXISTS `produto_foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `produto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `secao_fixa`
--

CREATE TABLE IF NOT EXISTS `secao_fixa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `menu` varchar(255) NOT NULL,
  `ctrl` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `ordem` int(11) NOT NULL,
  `ativar` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `secao_fixa`
--

INSERT INTO `secao_fixa` (`id`, `titulo`, `menu`, `ctrl`, `img`, `ordem`, `ativar`) VALUES
(1, 'Usuários', 'Usuários', '../usuarios/ctrlUsuarios.php', 'images/icons/todos/adminUser.png', 0, 1),
(2, 'email', 'Emails', '../ctrlEmail.php', 'images/icons/todos/mail.png', 0, 1),
(3, 'empresa', 'Empresa', '../ctrlEmpresa.php', 'images/icons/todos/expose.png', 0, 1),
(4, 'banner', 'Banners', '../ctrlBanner.php', 'images/icons/todos/application-split-tile.png', 0, 1),
(5, 'equipe', 'Equipe', '../ctrlEquipe.php', 'images/icons/todos/adminUser2.png', 0, 1),
(6, 'categoria', 'Produto Categoria', '../ctrlCategoria.php', 'images/icons/todos/archive.png', 0, 1),
(7, 'produto', 'Produtos', '../ctrlProduto.php', 'images/icons/todos/basket.png', 0, 1),
(8, 'cliente', 'Clientes', '../ctrlCliente.php', 'images/icons/todos/users2.png', 0, 1),
(9, 'servico', 'Serviços', '../ctrlServico.php', 'images/icons/todos/blocks.png', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `secao_fixa_menu`
--

CREATE TABLE IF NOT EXISTS `secao_fixa_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secao_fixa_id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `url` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_secao_fixa` (`secao_fixa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `secao_fixa_menu`
--

INSERT INTO `secao_fixa_menu` (`id`, `secao_fixa_id`, `titulo`, `url`) VALUES
(8, 1, 'Cadastrar', 'index.php?acao=frmCadUsuario&ctrl=usuarios'),
(9, 1, 'Listar', 'index.php?acao=listaUsuarios&ctrl=usuarios'),
(10, 2, 'Listar', 'index.php?acao=listar&ctrl=email'),
(11, 3, 'Listar / Alterar', 'index.php?acao=frmAlterar&ctrl=empresa&id=1'),
(12, 4, 'Cadastrar', 'index.php?acao=frmCad&ctrl=banner'),
(13, 4, 'Listar', 'index.php?acao=listar&ctrl=banner'),
(14, 5, 'Cadastrar', 'index.php?acao=frmCad&ctrl=equipe'),
(15, 5, 'Listar', 'index.php?acao=listar&ctrl=equipe'),
(16, 6, 'Cadastrar', 'index.php?acao=frmCad&ctrl=categoria'),
(17, 6, 'Listar', 'index.php?acao=listar&ctrl=categoria'),
(18, 7, 'Cadastrar', 'index.php?acao=frmCad&ctrl=produto'),
(19, 7, 'Listar', 'index.php?acao=listar&ctrl=produto'),
(20, 8, 'Cadastrar', 'index.php?acao=frmCad&ctrl=cliente'),
(21, 8, 'Listar', 'index.php?acao=listar&ctrl=cliente'),
(22, 9, 'Cadastrar', 'index.php?acao=frmCad&ctrl=servico'),
(23, 9, 'Listar', 'index.php?acao=listar&ctrl=servico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE IF NOT EXISTS `servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '',
  `usuario_cpanel` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `nivel` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario_cpanel`, `senha`, `email`, `img`, `status`, `nivel`) VALUES
(1, 'Administrador', '', '89794b621a313bb59eed0d9f0f4e8205', 'paulophpweb@gmail.com', '', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `permissao_secao_fixa`
--
ALTER TABLE `permissao_secao_fixa`
  ADD CONSTRAINT `permissao_secao_fixa_ibfk_1` FOREIGN KEY (`secao_fixa_id`) REFERENCES `secao_fixa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permissao_secao_fixa_ibfk_2` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `secao_fixa_menu`
--
ALTER TABLE `secao_fixa_menu`
  ADD CONSTRAINT `secao_fixa_menu_ibfk_1` FOREIGN KEY (`secao_fixa_id`) REFERENCES `secao_fixa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
