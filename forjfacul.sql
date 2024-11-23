-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 02:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forjfacul`
--

-- --------------------------------------------------------

--
-- Table structure for table `informacoes`
--

CREATE TABLE `informacoes` (
  `usuario_id` int(11) NOT NULL,
  `Nome_Completo` varchar(60) DEFAULT NULL,
  `Data_de_Nascimento` date DEFAULT NULL,
  `Sexo` varchar(20) DEFAULT NULL,
  `Nome_Materno` varchar(60) DEFAULT NULL,
  `CPF` varchar(11) DEFAULT NULL,
  `E_mail` varchar(40) DEFAULT NULL,
  `Telefone_Celular` varchar(11) DEFAULT NULL,
  `Telefone_Fixo` varchar(11) DEFAULT NULL,
  `Endereço_Completo` varchar(40) DEFAULT NULL,
  `Login` varchar(40) DEFAULT NULL,
  `Senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `informacoes`
--

INSERT INTO `informacoes` (`usuario_id`, `Nome_Completo`, `Data_de_Nascimento`, `Sexo`, `Nome_Materno`, `CPF`, `E_mail`, `Telefone_Celular`, `Telefone_Fixo`, `Endereço_Completo`, `Login`, `Senha`) VALUES
(6, 'Rafhael De Sousa Bolcao', NULL, NULL, 'MARIA JOSE DE SOUSA', NULL, 'rafha@gmail.com', NULL, NULL, NULL, NULL, NULL),
(7, 'Rafhael De Sousa Bolcao', '2004-03-03', 'M', 'MARIA JOSE DE SOUSA', '12233455667', 'devolypr2@gmail.com', '21981528408', '2198152840', 'Avenida Calombé', 'raffa', '$2y$10$er2/FG/oZBtADPSuuUZMOOiyI1W8QjHCT4bKjMSSP4/rP1G/zRqmu'),
(8, 'Rafhael De Sousa Bolcao', '2222-02-11', 'M', 'MARIA JOSE DE SOUSA', '12233455667', 's.bastos826@yahoo.com', '21981528408', '2198152840', 'Avenida Calombé', 'raffha', '$2y$10$zrMazA0Bj75eHqDVKOJiQOQVG5codhwPYysSfVl2X5lspgFv/m4rC'),
(10, 'joao sousa', '2003-06-04', 'M', 'MARIA JOSE DE SOUSA', '12233455667', 'raffhabolcao134@gmail.com.br', '21981528408', '2198152840', 'Avenida Calombé', 'raffhas2', '$2y$10$9ln/cgrac3zYprLxMN3xmuagyaYK0MMo0EWt7ypiFfMuCe8UJfJIC'),
(18, 'Rafhael De Sousa', '2003-06-04', 'M', 'MARIA JOSE DE SOUSA', '12233455667', 'raffhabolcao134@gmail.com.br', '21981528408', '2198152840', 'Avenida Calombé', 'raffhas2', '$2y$10$0J6AeaexCIfyfDpKaxzmtuAdY5kDbFrDrowG78RiQlP7oS5NgpXfa'),
(33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$OVahRwD0WOMzXpBJxgJbfunjDSYiO.OzRYi0q9yNDEkapZ9c2JjmO'),
(34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$6RWl7.s1qBp7PR9Yd3v4oewgP9XctIOZjUAWhSLTF3twvazWozr6G'),
(35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$NjgyGRFjc20OgsiMkz.TWObBy1x8qDYY11F.gNvz2NVBFNO7hqOG6'),
(36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$8q8.F6Mw/3C28pVzstXHc.FC.0TgSEYaB4kDAZJ8IrhQElxBaICNy'),
(37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$2JUiIzxFuU5lb7FwkbeO4eSIr2p.vJMxB/VyrWJhztuHk3IzgADky'),
(38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$zOzq.Otn2u7ljrsx6Aw/yeKbejxmDi8662lfPC484XCYucePlGKMC'),
(39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Wx34toJ67L1ctnU45pHQNeXVMZvE58SaIPgKUY7qphc0.eaTj/.Pi'),
(40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$jAlQbQrsmZO1JMv6ZBTL7eIfonwDRDEuJof3Kmligh0A1kE2VRK3a'),
(43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$l9LaM7HbhpbAwzoRphDEF.eeu9Irolu7wi0NNRVSlU6AQe4Kfbeya'),
(44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$cIt/XgcaG6oR2tlScNGIt.fDJek4YFzXZbnF6WdJQRAgJq9sgOmcC'),
(45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$41FCbFRq0v6DIuupwG7K8O8zpHCzxfsMx6CUJo4ycAkO3S/DECTAe'),
(46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$WiUfr3N29Ta7/P/.K23FNOcZk5xfQcF3pxzUvEA0d6DLiyh/0OGI.'),
(55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$fMJTVtKwbmYqIORhedkf5ueB6GSWwwJj4KP47WRDrw.RGQIlP7IFe'),
(56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$FcKChJNjjlBcEhEKFyi/u.OFLe.o7DV83Ll3g.Y4Q.B0.pjnsfZKe'),
(57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$vOR8xDcGNPjGOHhKxY6rgO2bA4P1IOfC2hlxO9xBMy1ktRpFVfBzm'),
(59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$U4KJz49B4kzEi2kbcbM5qeKWHzl3cfTNF1GtzN8IZ6SmpicoRVBka'),
(66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$n3JtU.i.iS7oab/eRClymu5dYVG2jX7EZTX.yDQG5MJbwM3SrhJEm'),
(67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$.c4fBKZh/S6dm1JlvcVdcuzvZEPbvFmNihITb10O//O/7Nkp1eXW.'),
(70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$lLbRuosNIT4WNjrVk5MIEu6NHFaM2..26h3VSS0WWPH1YC4f7fZle'),
(71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$remj21s48Y9NTFQMfSjpkeNV4Zt8CD5g7c9aca9QyCT5r6y1L6zGy'),
(72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$xGPrnTKnVodHMyjQOGsINuVPCJKv0heE3BdxVTAQBoUfKf1YyBX7e'),
(73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ZSpZRbsCzNLpvlCWrVdnOeKzOxhj6y8q4M4SzXKHhQsdG2dh6a2De'),
(74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$p/bGCTTMweogwma4pYklV.4YbXuz3G.4miNNTE51c8vRVPPvMi6LC'),
(75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$4mZSeZSpUtxmRp.z3TNXsefg4IyD4blvdKTv0uugxRp4sKb7JVB3q'),
(76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$UntgAsiTb2Aq59IPughIZ.HlPLB1KSuUBGODbSbL8o.RNIDfsZDQ.'),
(81, 'Rafhael De Sousa Bolcao', '2003-06-04', 'M', 'MARIA JOSE DE SOUSA', '12233455667', 'daadad@gmail.com', '21981528408', '2198152840', 'Avenida Calombé', 'raffhas2', '$2y$10$jD8aYmByH7.ekwt4581XwOuEeTzhB9XcM3cx5PpVVOGFTWC0eYC4u'),
(83, 'Rafhael De Sousa Bolcao', '2003-06-04', 'M', 'MARIA JOSE DE SOUSA', '12233455667', 's.bastos826@yahoo.com', '21981528408', '2198152840', 'Avenida Calombé', 'rafhael', '$2y$10$RP6rgU3DglbJwaM14KPJaefzfc0Fe71Ed3mjh0MNUBIlm7niFvcw.');

-- --------------------------------------------------------

--
-- Table structure for table `treinos`
--

CREATE TABLE `treinos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tipo_treino` enum('Treino A','Treino B','Treino C') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treinos`
--

INSERT INTO `treinos` (`id`, `usuario_id`, `tipo_treino`) VALUES
(2, 10, 'Treino A'),
(3, 83, 'Treino B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `informacoes`
--
ALTER TABLE `informacoes`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Indexes for table `treinos`
--
ALTER TABLE `treinos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `informacoes`
--
ALTER TABLE `informacoes`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `treinos`
--
ALTER TABLE `treinos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `treinos`
--
ALTER TABLE `treinos`
  ADD CONSTRAINT `treinos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `informacoes` (`usuario_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
