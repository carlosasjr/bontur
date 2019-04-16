-- --------------------------------------------------------
-- Servidor:                     162.241.203.82
-- Versão do servidor:           5.7.23-23 - Percona Server (GPL), Release 23, Revision 500fcf5
-- OS do Servidor:               Linux
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela carlo019_bontur.perfil: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`id`, `descricao`, `permissoes`, `data_cadastro`, `data_alteracao`) VALUES
	(1, 'ADMIN', '', '2019-04-20 12:36:18', '2019-04-20 12:36:18');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

-- Copiando estrutura para tabela carlo019_bontur.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `senha` char(32) NOT NULL,
  `apelido` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `email` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_perfil` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_USUARIOS_PERFIL` (`id_perfil`),
  CONSTRAINT `FK_USUARIOS_PERFIL` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela carlo019_bontur.usuarios: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `senha`, `apelido`, `status`, `email`, `ip`, `data_cadastro`, `data_alteracao`, `id_perfil`) VALUES
	(1, 'Carlos', '202cb962ac59075b964b07152d234b70', '', '1', 'carlosasjr2003@hotmail.com', '179.157.106.221', '2019-04-10 16:45:02', '2019-04-20 16:19:23', 1),
	(2, 'Maria Eugênia', '202cb962ac59075b964b07152d234b70', '', '1', 'maria@hotmail.com', '::1', '2019-04-12 15:08:50', '2019-04-20 12:40:04', 1),
	(3, 'Samuel Henrique', '202cb962ac59075b964b07152d234b70', '', '1', 'samu@hotmail.com', '::1', '2019-04-12 15:44:11', '2019-04-20 12:40:04', 1),
	(4, 'teste', '202cb962ac59075b964b07152d234b70', '', '1', 'teste@teste.com.br', '179.157.106.221', '2019-04-15 08:35:11', '2019-04-20 12:40:04', 1),
	(5, 'Carlos The Place', '68053af2923e00204c3ca7c6a3150cf7', '', '1', 'carlos@theplace.com.br', '179.157.106.221', '2019-04-15 09:10:18', '2019-04-20 12:40:04', 1),
	(6, 'Renan Lima', '0d5f465e9cdb70997516931177164e66', '', '1', 'renanpipipi@gmail.com', '177.62.217.222', '2019-04-15 09:30:15', '2019-04-20 17:00:05', 1),
	(7, 'Gabriel', '202cb962ac59075b964b07152d234b70', '', '1', 'gabriel@hotmail.com', '179.157.106.221', '2019-04-15 12:44:18', '2019-04-20 12:40:04', 1),
	(8, 'Fatec', '202cb962ac59075b964b07152d234b70', '', '1', 'fatec@gmail.com', '177.95.190.181', '2019-04-15 19:10:00', '2019-04-20 12:40:04', 1),
	(9, 'Juliana', 'f70d697e7cc68667d8b64cddc716a9e0', '', '1', 'ju_paris19@hotmail.com', '177.65.210.252', '2019-04-19 13:22:32', '2019-04-20 12:40:04', 1),
	(10, 'Elton', 'b054a1e13342a6dd4c5e6964b7354288', '', '1', 'elton.ruzene@gmail.com', '189.40.72.119', '2019-04-21 18:22:38', '2019-04-21 18:22:58', 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela carlo019_bontur.usuariostoken: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuariostoken` DISABLE KEYS */;
INSERT INTO `usuariostoken` (`id_usuario`, `id`, `hash`, `used`, `expirado_em`) VALUES
	(1, 2, '50e8d7ed57a1d253dfc1caad0d44ee66', 0, '2019-05-15 18:56:00'),
	(5, 1, '29d5e937f72e4192fb36cfba95dd09f1', 0, '2019-05-15 17:41:00'),
	(5, 3, '0bf2ba992a2d1c83fdb7bd986040eaef', 1, '2019-05-15 18:56:00'),
	(6, 4, '7f0fe9c9210922d9b2d60b98defe1b7f', 1, '2019-05-15 20:27:00');
/*!40000 ALTER TABLE `usuariostoken` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
