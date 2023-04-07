-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para loja_api
CREATE DATABASE IF NOT EXISTS `loja_api` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `loja_api`;

-- Copiando estrutura para tabela loja_api.admin_users
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id_admin` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `passwrd` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela loja_api.admin_users: ~0 rows (aproximadamente)
INSERT INTO `admin_users` (`id_admin`, `username`, `passwrd`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'admin', '$2y$10$rSHaP.owkh6ffp7kkDVyMuX.I3GZRmYJXYmqujT1V31cKbmIeVcKK', '2023-04-05 15:50:32', '2023-04-05 15:50:32', NULL);

-- Copiando estrutura para tabela loja_api.authentication
CREATE TABLE IF NOT EXISTS `authentication` (
  `id_client` int unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(50) DEFAULT NULL,
  `access_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `passwrd` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela loja_api.authentication: ~5 rows (aproximadamente)
INSERT INTO `authentication` (`id_client`, `client_name`, `access_key`, `passwrd`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Empresa A', 'LgzP6wcxxSc6EK7oGlxrDah8RnPii4g4', '$2y$10$0CfoPzni0URbp8Nbk2QDYOh6K2EpCMbhSBtAPDLjqn9zci5ndVTKa', '2023-04-05 13:30:37', '2023-04-05 13:30:37', '2023-04-06 18:16:25'),
	(2, 'Empresa B', 'GCnhmnubnxpdrKT8Rj2Lm19VLuuG0uXm', '$2y$10$oa8uwv96bqx1zGwMwiUt7e.faCV6sPJIYUcd.EYOoA.dqJ3RCxqoK', '2023-04-05 14:00:32', '2023-04-06 21:04:13', NULL),
	(4, 'Empresa D', 'Xfzg35pIXfUNIACUf8cCZ4oR5OPLYzbg', '$2y$10$e0jeC9hC1iAB1DaR.C3Az.biSM8uaK1XJIrLOV74gkUPS9eeHlo56', '2023-04-06 15:54:37', '2023-04-06 15:54:37', '2023-04-06 17:36:28'),
	(6, 'Empresa F', 'FhnIMmyL5kPQJ9LJTH2fkokEnm2OAf4B', '$2y$10$DATpe.WVLai/rFXdqjhMXucnpOrH2LCpugCImqQ5Z4l3JylUNXuw.', '2023-04-06 16:02:20', '2023-04-06 16:02:20', NULL),
	(9, 'Empresa Z', '8iZ4O32P10PfK0CYfvAHvIORaS2cLJuq', '$2y$10$etIH46ifWXSJzgcAbbkRHeLCO1OLcRRYFPMObamq6ziLajuPpFQCm', '2023-04-06 16:13:01', '2023-04-06 16:13:01', NULL);

-- Copiando estrutura para tabela loja_api.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela loja_api.clientes: ~4 rows (aproximadamente)
INSERT INTO `clientes` (`id_cliente`, `nome`, `email`, `telefone`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 'ana', 'ana@gmail.com', '222333', '2023-03-29 14:10:47', '2023-03-29 14:10:48', '2023-04-01 17:01:29'),
	(5, 'Horacio Teste', 'horacio@email.com', '51333111222', '2023-04-01 12:06:41', '2023-04-03 12:10:54', NULL),
	(6, 'Horacio', 'teste@teste.com', '51333111222', '2023-04-01 12:18:12', '2023-04-01 12:18:12', '2023-04-01 17:02:56'),
	(10, 'joão', 'joao@email.com', '123456', '2023-04-03 12:09:35', '2023-04-03 12:09:35', NULL);

-- Copiando estrutura para tabela loja_api.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_produto` int unsigned NOT NULL AUTO_INCREMENT,
  `produto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `quantidade` int DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela loja_api.produtos: ~3 rows (aproximadamente)
INSERT INTO `produtos` (`id_produto`, `produto`, `quantidade`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'pregos', 100, '2023-03-29 14:11:18', '2023-03-29 14:11:18', '2023-04-01 17:48:03'),
	(2, 'parafusos', 255, '2023-03-29 14:11:28', '2023-04-03 14:27:47', NULL),
	(3, 'alfinetes', 300, '2023-03-29 14:11:44', '2023-03-29 14:11:44', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
