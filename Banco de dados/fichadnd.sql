-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/04/2025 às 16:52
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fichadnd`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `fichas`
--

CREATE TABLE `fichas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `classe` varchar(50) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `raca` varchar(50) DEFAULT NULL,
  `forca` int(11) DEFAULT NULL,
  `destreza` int(11) DEFAULT NULL,
  `constituicao` int(11) DEFAULT NULL,
  `inteligencia` int(11) DEFAULT NULL,
  `sabedoria` int(11) DEFAULT NULL,
  `carisma` int(11) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `pericias_treinadas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fichas`
--

INSERT INTO `fichas` (`id`, `nome`, `classe`, `nivel`, `raca`, `forca`, `destreza`, `constituicao`, `inteligencia`, `sabedoria`, `carisma`, `usuario_id`, `pericias_treinadas`) VALUES
(15, 'sadad', 'wqeq', 3213, '123123', 2413, 4123, 123, 123, 5234, 523432, 2, NULL),
(17, 'dsada', 'ssad', 4, 'sdsa', 2, 3, 1, 2, 0, 0, 1, 'Atletismo,Arcanismo,Intuição'),
(18, 'AAa', 'AAAAA', 1, 'mago', -1, 2, 0, 4, 0, 0, 5, 'Arcanismo,Religião');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `senha`, `data_criacao`) VALUES
(1, 'Rafael', 'rafael@gmail.com', '$2y$10$jr30NBM0KD2onlrrtvZ59OcfaeaB8oP0Op0TaC8GdQmRBn/8kltj.', '2025-03-28 14:32:02'),
(2, 'Ana', 'ana@gmail.com', '$2y$10$y8AaFJ2JDP5iqFrWU1u5LO/WpNo4bz7/g2OvZNhIYut8ylhgj7o/q', '2025-03-28 14:34:25'),
(3, 'rafa', 'rafa@gmail.com', '$2y$10$zvr1dy4Q5uS0RLZ6ust0JunjX86CFZOGob4ujJoHxERZi4pBm1Wd.', '2025-03-31 14:09:58'),
(4, 'Carlos', 'carlos@gmail.com', '$2y$10$.LIicaXoXEaFhYu7Z4dvmOjTd1mwE6UYxxEFwfxqZB/rhDYdal30u', '2025-04-01 12:15:38'),
(5, 'Lari', 'lari@gmail.com', '$2y$10$L0ZTFAK23OjSo8Ige2dNz.JAwpCttF0iULiF7sQDen3AAQ4T9ftUu', '2025-04-02 12:05:24'),
(6, 'AAA', 'aaa@gmail.com', '$2y$10$grxnSvZVZJWWeMq7W7E1j.f7uXqckBnsqROH6ipeI8nVN7Sj/CfRS', '2025-04-03 14:32:09');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `fichas`
--
ALTER TABLE `fichas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fichas_usuarios` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `fichas`
--
ALTER TABLE `fichas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `fichas`
--
ALTER TABLE `fichas`
  ADD CONSTRAINT `fk_fichas_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
