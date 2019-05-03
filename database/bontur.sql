-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.14 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para carlo019_bontur
CREATE DATABASE IF NOT EXISTS `carlo019_bontur` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `carlo019_bontur`;

-- Copiando estrutura para tabela carlo019_bontur.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela carlo019_bontur.categorias: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `descricao`, `data_criacao`, `data_alteracao`) VALUES
	(1, 'Adulto', '2019-05-01 14:09:26', '2019-05-01 14:09:58'),
	(2, 'Infantil (6 a 12)', '2019-05-03 10:52:42', '2019-05-03 10:53:05'),
	(3, 'Terceira Idade', '2019-05-03 10:52:51', '2019-05-03 10:52:51'),
	(4, 'Infantil (0 a 5)', '2019-05-03 10:53:23', '2019-05-03 10:53:23');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Copiando estrutura para tabela carlo019_bontur.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `permissoes` longtext,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `permissoes` (`permissoes`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela carlo019_bontur.perfil: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`id`, `descricao`, `permissoes`, `data_cadastro`, `data_alteracao`) VALUES
	(1, 'Administrador', 'ADMIN', '2019-04-23 17:16:08', '2019-04-26 22:36:59'),
	(2, 'Cliente', 'ADMIN', '2019-04-27 20:02:28', '2019-05-01 12:47:08'),
	(3, 'DBA', 'ADMIN', '2019-04-26 22:36:46', '2019-05-01 00:19:23');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

-- Copiando estrutura para tabela carlo019_bontur.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `preco` float NOT NULL,
  `pontos` int(11) NOT NULL DEFAULT '1',
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `detalhes` text NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_produtos_categorias` (`id_categoria`),
  CONSTRAINT `FK_produtos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela carlo019_bontur.produtos: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` (`id`, `descricao`, `preco`, `pontos`, `data_criacao`, `data_alteracao`, `detalhes`, `id_categoria`) VALUES
	(1, 'Bondinho (Somente Ida)', 16, 1, '2019-05-03 12:33:59', '2019-05-03 12:54:42', '', 1),
	(2, 'Bondinho (Ida e Volta)', 26, 1, '2019-05-03 12:34:25', '2019-05-03 12:34:25', '', 1),
	(3, 'Bondinho (Somente Ida)', 8, 1, '2019-05-03 12:35:17', '2019-05-03 12:35:17', 'Mediante apresentação de documento', 2),
	(4, 'Bondinho (Ida e Volta)', 13, 1, '2019-05-03 12:35:46', '2019-05-03 12:35:46', 'Mediante apresentação de documento', 2),
	(5, 'Bondinho (Somente Ida)', 8, 1, '2019-05-03 12:37:00', '2019-05-03 12:54:50', 'Apartir de 60 anos - mediante apresentação de documento', 3),
	(6, 'Bondinho (Ida e Volta)', 13, 1, '2019-05-03 12:37:36', '2019-05-03 12:37:36', 'Apartir de 60 anos - mediante apresentação de documento', 3);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;

-- Copiando estrutura para tabela carlo019_bontur.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `senha` char(32) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `email` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_perfil` int(11) NOT NULL DEFAULT '1',
  `endereco` varchar(100) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `celular` varchar(14) DEFAULT NULL,
  `observacoes` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_USUARIOS_PERFIL` (`id_perfil`),
  CONSTRAINT `FK_USUARIOS_PERFIL` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela carlo019_bontur.usuarios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `senha`, `status`, `email`, `ip`, `data_cadastro`, `data_alteracao`, `id_perfil`, `endereco`, `numero`, `bairro`, `cidade`, `estado`, `pais`, `telefone`, `celular`, `observacoes`) VALUES
	(1, 'Carlos Antônio dos Santos Júnior', '7363a0d0604902af7b70b271a0b96480', '1', 'carlosasjr2003@hotmail.com', '127.0.0.1', '2019-04-26 10:41:55', '2019-05-03 14:41:07', 1, 'Rua Isaac Júlio Barreto', '229', 'Ponte Alta', 'Aparecida', 'SP', 'Brasil', '(12)981544374', '', 'Teste de observação'),
	(2, 'Maria Eugenia dos Santos', '202cb962ac59075b964b07152d234b70', '0', 'maria_gena_@hotmail.com', '::1', '2019-04-29 09:11:16', '2019-05-01 00:18:48', 2, 'Rua Isaac Julio Barreto', '229', 'Ponte Alta', 'Aparecida', 'SP', 'Brasil', '', '', 'teste de área'),
	(3, 'Isabela Gianna dos Santos', '202cb962ac59075b964b07152d234b70', '1', 'isabela@hotmail.com', '::1', '2019-04-30 16:02:27', '2019-05-01 00:18:48', 1, '', '', '', '', 'SP', 'Brasil', '', '', ''),
	(4, 'Samuel Henrique dos Santos', '123', '1', 'samuca@hotmail.com', '127.0.0.1', '2019-05-03 10:23:02', '2019-05-03 10:23:02', 2, '', '', '', '', 'SP', '', '(12)3311-1714', '(12)98154-4374', 'Teste de observação');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Copiando estrutura para tabela carlo019_bontur.usuariostoken
CREATE TABLE IF NOT EXISTS `usuariostoken` (
  `id_usuario` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(32) DEFAULT NULL,
  `used` tinyint(1) DEFAULT '0',
  `expirado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`,`id`),
  KEY `id` (`id`),
  CONSTRAINT `FK_USUARIOSTOKEN_USUARIO` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela carlo019_bontur.usuariostoken: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuariostoken` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuariostoken` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
