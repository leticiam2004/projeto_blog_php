-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.3.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES latin1 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for database
CREATE DATABASE IF NOT EXISTS `database` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */;
USE `database`;

-- Dumping structure for table database.contato
CREATE TABLE IF NOT EXISTS `contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `assunto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `situacao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'Novo',
  `problema` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table database.contato: ~3 rows (approximately)
INSERT IGNORE INTO `contato` (`id`, `nome_completo`, `email`, `assunto`, `situacao`, `problema`) VALUES
	(1, 'Ash Ketchum', 'ash@pallet.com', 'Questões sobre entrega', 'Em andamento', 'Estou aguardando a entrega de 10 Pokébolas e 5 Poções para uma missão urgente em Johto. Já passaram 5 dias e ainda não recebi nenhuma atualização sobre o status do pedido. Poderiam verificar, por favor?'),
	(2, 'Misty Waterflower', 'misty@cerulean.com', 'Sugestões de novos produtos', 'Novo', 'Seria incrível se vocês pudessem adicionar itens específicos para treinadores de Pokémon de água, como Poções especiais para recuperação rápida após batalhas subaquáticas. Isso ajudaria muito em treinamentos intensos!'),
	(3, 'Brock Harrison', 'brock@pewtergym.com', 'Suporte técnico', 'Novo', 'Comprei uma Pokébola personalizada, mas ela parece estar com defeito, pois não está funcionando corretamente ao tentar capturar Pokémon. Vocês poderiam me orientar sobre o que fazer ou trocar o item?');

-- Dumping structure for table database.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `preco` float NOT NULL DEFAULT 0,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table database.produtos: ~17 rows (approximately)
INSERT IGNORE INTO `produtos` (`id`, `nome`, `preco`, `image`) VALUES
	(1, 'Pokéball', 200, 'https://iili.io/2b9Lvqu.png'),
	(2, 'GreatBall', 600, 'https://iili.io/2b9LSgj.png'),
	(3, 'UltraBall', 1200, 'https://iili.io/2b9L80b.png'),
	(4, 'Cura Veneno', 100, 'https://iili.io/2b9L6mB.png'),
	(5, 'Cura Paralisia', 200, 'https://iili.io/2b9L4eV.png'),
	(6, 'Cura Sono', 200, 'https://iili.io/2b9LizP.png'),
	(7, 'Cura Gelo', 200, 'https://iili.io/2b9Lr5Q.png'),
	(8, 'Cura Queimadura', 200, 'https://iili.io/2b9Lese.png'),
	(9, 'Cura Total', 600, 'https://iili.io/2b9Lgdx.png'),
	(10, 'Poção', 300, 'https://iili.io/2b9LsX1.png'),
	(11, 'Super Poção', 700, 'https://iili.io/2b9Lt1a.png'),
	(12, 'Hiper Poção', 1200, 'https://iili.io/2b9LLLF.png'),
	(13, 'Max Poção', 2500, 'https://iili.io/2b9LZqg.png'),
	(14, 'Repelente', 350, 'https://iili.io/2b9LDrJ.png'),
	(15, 'Super Repelente', 500, 'https://iili.io/2b9Lp7R.png'),
	(16, 'Max Repelente', 700, 'https://iili.io/2b9Lmdv.png'),
	(17, 'Reviver', 1500, 'https://iili.io/2b9Lyep.png');

-- Dumping structure for table database.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(250) NOT NULL DEFAULT '0',
  `admin` tinyint(4) NOT NULL DEFAULT 0,
  `telefone` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table database.users: ~7 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `username`, `email`, `password`, `admin`, `telefone`) VALUES
	(1, 'admin', 'admin@admin.com', '$2y$10$Yeiq48lwUcVjAu/.yaDnxOI27TF.hnxV/P..S.M37rUgiPNY7MI4e', 1, '11987654321'),
	(2, 'mistycerulean', 'misty@cerulean.com', '$2y$10$wwhJ1lFjcaSnoMzaokJvr.03Kn8GijXa42xkIxu4AROXsZP2soh96', 0, '31998765432'),
	(3, 'brockpewtergym', 'brock@pewtergym.com', '$2y$10$Bolc3ZKT96m0ZziccdnGye0bUYcbd4PlbkDm2FJ.wsyaNGY7dV0Ge', 0, '41956781234'),
	(4, 'ashpallet', 'ash@pallet.com', '$2y$10$fz167xnfi2zo507Auvhqk.aH.NXf5y2JxgpbW5eznPLjtthfxILWO', 0, '21912345678'),
	(5, 'garyoak', 'gary@pallet.com', '$2y$10$1ZghXN2D4jm/JK.isefjvepE8NC55oPLNfsHvYehHsh/2/q1O2JnG', 0, '21987654321'),
	(6, 'serenakalos', 'serena@kalos.com', '$2y$10$5Ft5KmXLsvKflcqV12UppeKH0V4NqxFMuWl.lCXssS4A3YciJTojG', 0, '22998765432'),
	(7, 'mayhoenn', 'may@hoenn.com', '$2y$10$gFpaFg9EJcLxhVfWYP8G3.8WbNtsrqDRKZrHrtCtAhvkcHgUJuAfC', 0, '23912345678');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
