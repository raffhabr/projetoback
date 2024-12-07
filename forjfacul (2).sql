-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/12/2024 às 00:03
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `forjfacul`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `informacoes`
--

CREATE TABLE `informacoes` (
  `usuario_id` int(11) NOT NULL,
  `Nome_Completo` varchar(60) DEFAULT NULL,
  `Data_de_Nascimento` date DEFAULT NULL,
  `Sexo` varchar(20) DEFAULT NULL,
  `Nome_Materno` varchar(60) DEFAULT NULL,
  `CPF` varchar(15) DEFAULT NULL,
  `E_mail` varchar(40) DEFAULT NULL,
  `Telefone_Celular` varchar(15) DEFAULT NULL,
  `Telefone_Fixo` varchar(15) DEFAULT NULL,
  `Endereço_Completo` varchar(40) DEFAULT NULL,
  `Login` varchar(40) DEFAULT NULL,
  `Senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `informacoes`
--

INSERT INTO `informacoes` (`usuario_id`, `Nome_Completo`, `Data_de_Nascimento`, `Sexo`, `Nome_Materno`, `CPF`, `E_mail`, `Telefone_Celular`, `Telefone_Fixo`, `Endereço_Completo`, `Login`, `Senha`) VALUES
(6, 'Rafhael De Sousa Bolcao', NULL, NULL, 'MARIA JOSE DE SOUSA', NULL, 'rafha@gmail.com', NULL, NULL, NULL, NULL, NULL),
(7, 'Rafhael De Sousa Bolcao', '2004-03-03', 'M', 'MARIA JOSE DE SOUSA', '12233455667', 'devolypr2@gmail.com', '21981528408', '2198152840', 'Avenida Calombé', 'raffa', '$2y$10$er2/FG/oZBtADPSuuUZMOOiyI1W8QjHCT4bKjMSSP4/rP1G/zRqmu'),
(10, 'joao sousa', '2003-06-04', 'M', 'MARIA JOSE DE SOUSA', '12233455667', 'raffhabolcao134@gmail.com.br', '21981528408', '2198152840', 'Avenida Calombé', 'raffhas2', '$2y$10$jDzXOlpMojOeVW2UK96s0uAr8U63gceVDrVjjRp32b4y07Ya5xUp6'),
(83, 'Rafhael De Sousa Bolcao', '2003-06-04', 'M', 'MARIA JOSE DE SOUSA', '12233455667', 's.bastos826@yahoo.com', '21981528408', '2198152840', 'Avenida Calombé', 'rafhael', '$2y$10$RP6rgU3DglbJwaM14KPJaefzfc0Fe71Ed3mjh0MNUBIlm7niFvcw.'),
(84, 'Rafhael De Sousa Bolcao', '2003-06-04', 'M', 'MARIA JOSE DE SOUSA', '12233455667', 's.bastos826@yahoo.com', '21981528408', '2198152840', 'Avenida Calombé', 'raffaa', '$2y$10$cV6ydiIR6sazp4jmaZzY2OG3GxfdoZHXtJpUpVWrkXcEyJUeleJ9y'),
(85, 'Rafhael De Sousa Bolcao', '2003-06-04', 'M', 'MARIA JOSE DE SOUSA', '12233455667', 's.bastos826@yahoo.com', '21981528408', '3456788909', 'Avenida Calombé', 'raff', '$2y$10$xma/TuGj3klSbpiWNK.iyO0YZp7To.uOIqUZQveC9XZOEUIiqts1S'),
(86, 'Rafhael De Sousa Bolcao', '2003-06-04', 'M', 'MARIA JOSE DE SOUSA', '111.111.111', 's.bastos826@yahoo.com', '(21) 98152-8408', '(21) 9815-2', 'Avenida Calombé', 'raffhass2', '$2y$10$fD8n8m6fR/JjNhNrGHUs9OklOl1dpuxj9QWP8T8qrjCEnsJR.imfW'),
(87, 'Rafhael De Sousa Bolcao', '2003-06-04', 'M', 'MARIA JOSE DE SOUSA', '111.111.111-11', 's.bastos826@yahoo.com', '(21) 98152-8408', '(21) 9815-2', 'Avenida Calombé', 'raffhasss2', '$2y$10$r784yqMr4wVH4eHAOJsoSub6YocfnBKR.XJVZWI.ZkKgvBUjQGBoW');

-- --------------------------------------------------------

--
-- Estrutura para tabela `treinos`
--

CREATE TABLE `treinos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tipo_treino` enum('Treino A','Treino B','Treino C') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `treinos`
--

INSERT INTO `treinos` (`id`, `usuario_id`, `tipo_treino`) VALUES
(2, 10, 'Treino B'),
(3, 83, 'Treino B');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `informacoes`
--
ALTER TABLE `informacoes`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Índices de tabela `treinos`
--
ALTER TABLE `treinos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `informacoes`
--
ALTER TABLE `informacoes`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de tabela `treinos`
--
ALTER TABLE `treinos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `treinos`
--
ALTER TABLE `treinos`
  ADD CONSTRAINT `treinos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `informacoes` (`usuario_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
