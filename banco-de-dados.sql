-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 28-Ago-2014 às 09:27
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
-- Estrutura da tabela `configuracao`
--

CREATE TABLE IF NOT EXISTS `configuracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tipo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `configuracao`
--

INSERT INTO `configuracao` (`id`, `nome`, `email`, `tipo`, `status`) VALUES
(3, 'Paulo Henrique', 'pudicaph17@hotmail.com', 'Fale Conosco', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=196 ;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`id`, `usuario`, `area`, `id_area`, `acao`, `datahora`, `ip`) VALUES
(192, 'Administrador', 'usuários', 1, 'saiu', '2014-08-28 08:42:23', '192.168.7.36'),
(193, 'Paulo', 'usuários', 2, 'entrou', '2014-08-28 08:47:01', '192.168.7.36'),
(194, 'Paulo', 'usuários', 2, 'alterou', '2014-08-28 08:55:56', '192.168.7.36'),
(195, 'Paulo', 'usuários', 2, 'alterou', '2014-08-28 09:20:27', '192.168.7.36');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Extraindo dados da tabela `permissao_secao_fixa`
--

INSERT INTO `permissao_secao_fixa` (`id`, `secao_fixa_id`, `usuarios_id`, `cadastrar`, `alterar`, `excluir`, `publicar`) VALUES
(25, 1, 1, 1, 1, 1, 1),
(28, 1, 2, 1, 1, 1, 1);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `secao_fixa`
--

INSERT INTO `secao_fixa` (`id`, `titulo`, `menu`, `ctrl`, `img`, `ordem`) VALUES
(1, 'Usuários', 'Usuários', '../usuarios/ctrlUsuarios.php', 'images/icons/todos/adminUser.png', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `secao_fixa_menu`
--

INSERT INTO `secao_fixa_menu` (`id`, `secao_fixa_id`, `titulo`, `url`) VALUES
(8, 1, 'Cadastrar', 'index.php?acao=frmCadUsuario&ctrl=usuarios'),
(9, 1, 'Listar', 'index.php?acao=listaUsuarios&ctrl=usuarios');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '',
  `senha` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `nivel` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `email`, `img`, `status`, `nivel`) VALUES
(1, 'Administrador', '202cb962ac59075b964b07152d234b70', 'paulo@pixelgo.com.br', '', 1, 1),
(2, 'Leonardo', '202cb962ac59075b964b07152d234b70', 'leonardo@pixelgo.com.br', '', 1, 1);


CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `permissao_secao_fixa`
--
ALTER TABLE `permissao_secao_fixa`
  ADD CONSTRAINT `permissao_secao_fixa_ibfk_2` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permissao_secao_fixa_ibfk_1` FOREIGN KEY (`secao_fixa_id`) REFERENCES `secao_fixa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `secao_fixa_menu`
--
ALTER TABLE `secao_fixa_menu`
  ADD CONSTRAINT `secao_fixa_menu_ibfk_1` FOREIGN KEY (`secao_fixa_id`) REFERENCES `secao_fixa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
