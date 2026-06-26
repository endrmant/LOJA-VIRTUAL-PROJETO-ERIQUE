-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/06/2026 às 16:11
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
-- Banco de dados: `clientes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(150) NOT NULL,
  `TIPO` varchar(30) NOT NULL,
  `PRECO` decimal(10,2) NOT NULL,
  `DESCRICAO` text DEFAULT NULL,
  `CLIENTE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`ID`, `NOME`, `TIPO`, `PRECO`, `DESCRICAO`, `CLIENTE_ID`) VALUES
(10, 'banco retrátil', 'móveis', 20.00, 'Cadeirinha que dobra', 3),
(20, 'mel', 'outros', 39.00, 'Mel Flores Silvestre 500 gramas', 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `EMAIL` varchar(320) NOT NULL,
  `DATANASCI` date NOT NULL,
  `SENHA` varchar(255) NOT NULL,
  `USUARIO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`ID`, `EMAIL`, `DATANASCI`, `SENHA`, `USUARIO`) VALUES
(1, 'n@gmail.com', '2022-02-12', '81dc9bdb52d04dc20036dbd8313ed055', 'niemowie'),
(2, 'jubs@gmail.com', '2022-02-12', '2b24d495052a8ce66358eb576b8912c8', 'jubileu'),
(3, 'fulano.cicrano@gmail.com', '1973-08-20', 'e09c80c42fda55f9d992e59ca6b3307d', 'fulano'),
(6, 'ililil@hotmail.com', '2000-01-14', '25d55ad283aa400af464c76d713c07ad', 'elneua'),
(7, 'edugamesremember1@gmail.com', '2013-08-01', '50e566834e250332e5e5155f59e34f10', 'Fuzz'),
(10, 'eunaosei@gmail.com', '2001-09-11', '27ba0428649dc180e98846eee42ed4f0', 'Sonic123'),
(11, 'nicolaspedroso058@gmail.com', '2008-09-13', 'f7346abc6242650d36ea77bd4b03c9a1', 'nicolas.wy01');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_produtos_clientes` (`CLIENTE_ID`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `idx_email` (`EMAIL`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_clientes` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
