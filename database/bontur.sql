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


-- Copiando estrutura do banco de dados para bontur
CREATE DATABASE IF NOT EXISTS `bontur` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `bontur`;

-- Copiando estrutura para tabela bontur.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `senha` char(32) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `email` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela bontur.usuarios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `senha`, `status`, `email`, `ip`, `data_cadastro`, `data_alteracao`) VALUES
	(1, 'Carlos', '202cb962ac59075b964b07152d234b70', '1', 'carlosasjr2003@hotmail.com', '::1', '2019-04-10 16:45:02', '2019-04-12 14:54:06'),
	(2, 'Maria Eugênia', '202cb962ac59075b964b07152d234b70', '1', 'maria@hotmail.com', '::1', '2019-04-12 15:08:50', '2019-04-12 15:11:57'),
	(3, 'Samuel Henrique', '202cb962ac59075b964b07152d234b70', '1', 'samu@hotmail.com', '::1', '2019-04-12 15:44:11', '2019-04-12 15:44:11');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Copiando estrutura para tabela bontur.usuariostoken
CREATE TABLE IF NOT EXISTS `usuariostoken` (
  `id_usuario` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(32) DEFAULT NULL,
  `used` tinyint(1) DEFAULT '0',
  `expirado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`,`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela bontur.usuariostoken: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuariostoken` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuariostoken` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
