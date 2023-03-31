-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Jan-2023 às 17:27
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto.reddit`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comunidades`
--

CREATE TABLE `comunidades` (
  `id` int(11) NOT NULL,
  `enviou` int(11) NOT NULL,
  `recebeu` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `comunidades`
--

INSERT INTO `comunidades` (`id`, `enviou`, `recebeu`, `status`) VALUES
(1, 3, 4, 1),
(3, 5, 3, 1),
(4, 5, 4, 1),
(5, 5, 6, 0),
(6, 5, 7, 0),
(7, 4, 7, 0),
(8, 8, 3, 1),
(9, 8, 4, 0),
(10, 8, 7, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `post` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `post`
--

INSERT INTO `post` (`id`, `usuario_id`, `post`, `date`) VALUES
(1, 4, '<p>teste</p>', '2023-01-19 20:36:01'),
(2, 4, '<p>teste</p>', '2023-01-19 20:36:08'),
(3, 4, '<p>rrrr</p>', '2023-01-19 20:36:24'),
(4, 4, '<p>rrrr</p>', '2023-01-19 20:38:27'),
(5, 4, '<p>Ola a todos </p>', '2023-01-19 20:41:35'),
(6, 5, '<p>Ola </p>', '2023-01-20 19:16:57'),
(7, 3, '<p>texto&nbsp;</p>', '2023-01-20 19:37:45'),
(8, 3, '<p>texto&nbsp;</p>', '2023-01-20 19:37:50'),
(9, 3, '<p></p>', '2023-01-20 19:38:22'),
(10, 4, '<p>https://www.reddit.com/r/Persona5/</p>', '2023-01-20 19:47:52'),
(11, 4, '<p>https://www.reddit.com/r/Persona5/</p>', '2023-01-20 19:51:43'),
(12, 4, '<p>https://www.reddit.com/r/Persona5/</p>', '2023-01-20 19:59:06'),
(13, 4, '<p></p>', '2023-01-20 19:59:37'),
(14, 4, '<p>Meu site criado </p><img src=\"https://preview.redd.it/ghg90yykg3da1.png?width=640&amp;crop=smart&amp;auto=webp&amp;v=enabled&amp;s=bdae9d648fa347d3a28fe14abc8f098768362b86\" /> ', '2023-01-20 20:12:05'),
(15, 4, '<p>reddit.com/r/Persona5/</p>', '2023-01-20 20:12:46'),
(16, 3, '<p>Que legal </p><img src=\"https://preview.redd.it/yh9t3k5wy0da1.png?width=640&amp;crop=smart&amp;auto=webp&amp;v=enabled&amp;s=3e08653fb82d1000d8a07f3f8b7ddbe17ddfe551\" />', '2023-01-20 20:14:08'),
(17, 8, '<p>Ola a todos. Estou realizado um teste na rede social clone Reddit </p>', '2023-01-21 17:57:01'),
(18, 3, '<p>Que bacana. Olhei o meu projeto que fiz </p><img src=\"https://preview.redd.it/yh9t3k5wy0da1.png?width=640&crop=smart&auto=webp&v=enabled&s=3e08653fb82d1000d8a07f3f8b7ddbe17ddfe551\'\" />', '2023-01-21 17:59:30'),
(19, 3, '<p></p><img src=\"data:image/jpeg;base64,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\'\" />', '2023-01-21 18:01:53'),
(20, 3, '<p></p><img src=\"https://ciclovivo.com.br/wp-content/uploads/2018/10/iStock-536613027.jpg\" />', '2023-01-21 18:02:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_amizades`
--

CREATE TABLE `tb_amizades` (
  `id` int(11) NOT NULL,
  `enviou` int(11) NOT NULL,
  `recebeu` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` text NOT NULL,
  `ultimo_post` int(11) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `nome`, `email`, `senha`, `ultimo_post`, `img`) VALUES
(3, 'Norian 2', 'NorianHenrique@hotmail.com', '$2a$08$MTIxMDM2NzAxNDYzYzljMOM6E.I2n10fVnN8Od0LsoSU/0K74wSXe', 2023, '63cc526cccc94.png'),
(4, 'Norian Henrique', 'ConhecimentoGame@hotmail.com', '$2a$08$ODA5MDQ1MjcyNjNjODkxOOZUfoeixzGr5dm2VlYGrtYjqhz287Kwu', 2023, ''),
(5, 'Guilherme', 'contato@nadsistemas.com', '$2a$08$MzQ4NDc2MjM5NjNjYjA0O.hTID71tX.qa5bsR44F5V1e39dKePBZO', 2023, '63cb1071bf9a7.png'),
(7, 'Norian', 'NorianHenrique2001@hotmail.com', '$2a$08$OTMyMTMwMjkxNjNjYjIwOOVilr5M0G/r9y4YITeNGBhQfzCTku9Ou', 0, ''),
(8, 'Norian Teste', 'NADSistemas@hotmail.com', '$2a$08$NjQ2MzgwNDcyNjNjYzUxMeWgDfQl4GX8qAQvl1deEIJ/UtUhax.4W', 2023, '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comunidades`
--
ALTER TABLE `comunidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_amizades`
--
ALTER TABLE `tb_amizades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comunidades`
--
ALTER TABLE `comunidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tb_amizades`
--
ALTER TABLE `tb_amizades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
