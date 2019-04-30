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
	(2, 'Cliente', 'USER', '2019-04-27 20:02:28', '2019-04-27 20:02:28'),
	(3, 'DBA Master', 'ADMIN', '2019-04-26 22:36:46', '2019-04-27 18:47:08');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

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
  `foto` text,
  `observacoes` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_USUARIOS_PERFIL` (`id_perfil`),
  CONSTRAINT `FK_USUARIOS_PERFIL` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela carlo019_bontur.usuarios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `senha`, `status`, `email`, `ip`, `data_cadastro`, `data_alteracao`, `id_perfil`, `endereco`, `numero`, `bairro`, `cidade`, `estado`, `pais`, `telefone`, `celular`, `foto`, `observacoes`) VALUES
	(1, 'Carlos Antônio dos Santos Júnior', 'f36a76e0b977af58f3006d944e26583a', '1', 'carlosasjr2003@hotmail.com', '127.0.0.1', '2019-04-26 10:41:55', '2019-04-30 16:24:10', 1, 'Rua Isaac Júlio Barreto', '229', 'Ponte Alta', 'Aparecida', 'SP', 'Brasil', '(12)981544374', '', NULL, 'Teste de observação'),
	(2, 'Maria Eugenia dos Santos', '7363a0d0604902af7b70b271a0b96480', '0', 'maria_gena_@hotmail.com', '::1', '2019-04-29 09:11:16', '2019-04-30 16:02:04', 2, 'Rua Isaac Julio Barreto', '229', 'Ponte Alta', 'Aparecida', 'SP', 'Brasil', '', '', NULL, 'teste de área'),
	(3, 'Isabela Gianna dos Santos', '7363a0d0604902af7b70b271a0b96480', '1', 'isabela@hotmail.com', '::1', '2019-04-30 16:02:27', '2019-04-30 16:08:12', 1, '', '', '', '', 'SP', 'Brasil', '', '', NULL, '');
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
