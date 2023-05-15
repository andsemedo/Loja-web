-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Jan-2023 às 20:42
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja_projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Computadores'),
(2, 'Componentes'),
(3, 'Armazenamento'),
(4, 'Telemóveis'),
(5, 'Televisores'),
(6, 'Eletrodomesticos');

--
-- Acionadores `categorias`
--
DELIMITER $$
CREATE TRIGGER `categorias_BEFORE_DELETE` BEFORE DELETE ON `categorias` FOR EACH ROW BEGIN
delete from produto where categoria = old.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `codCliente` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `telefone` int(11) DEFAULT NULL,
  `endereco` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `Nif` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`codCliente`, `nome`, `telefone`, `endereco`, `user`, `Nif`) VALUES
(31, 'Anderson', 5981615, 26, 38, 1234),
(33, 'Veronica Andrade', 9658532, 28, 41, 123456789);

--
-- Acionadores `cliente`
--
DELIMITER $$
CREATE TRIGGER `cliente_AFTER_DELETE` AFTER DELETE ON `cliente` FOR EACH ROW BEGIN
DELETE FROM endereco 
    WHERE endereco.codEndereco = old.endereco;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cliente_BEFORE_DELETE` BEFORE DELETE ON `cliente` FOR EACH ROW BEGIN
	delete from encomenda where cliente = old.codCliente;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `detail_cliente`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `detail_cliente` (
`codCliente` int(11)
,`nome` varchar(80)
,`telefone` int(11)
,`endereco` int(11)
,`user` int(11)
,`id` int(11)
,`username` varchar(30)
,`email` varchar(50)
,`pass` varchar(30)
,`tipo` int(11)
,`foto` varchar(80)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `detail_encom`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `detail_encom` (
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomenda`
--

CREATE TABLE `encomenda` (
  `id` int(11) NOT NULL,
  `data` datetime DEFAULT current_timestamp(),
  `status_pag` enum('0','1') DEFAULT '0',
  `status_entrega` enum('0','1') DEFAULT '0',
  `cliente` int(11) DEFAULT NULL,
  `id_vend` int(11) DEFAULT NULL,
  `entregador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `encomenda`
--

INSERT INTO `encomenda` (`id`, `data`, `status_pag`, `status_entrega`, `cliente`, `id_vend`, `entregador`) VALUES
(21, '2023-01-27 22:28:24', '1', '1', 31, NULL, NULL),
(22, '2023-01-28 17:35:36', '1', '1', 31, NULL, NULL),
(23, '2023-01-28 18:14:04', '1', '1', 31, NULL, NULL);

--
-- Acionadores `encomenda`
--
DELIMITER $$
CREATE TRIGGER `encomenda_BEFORE_DELETE` BEFORE DELETE ON `encomenda` FOR EACH ROW BEGIN
	delete from encomenda_produtos where encomenda_id = old.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomenda_produtos`
--

CREATE TABLE `encomenda_produtos` (
  `encomenda_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `encomenda_produtos`
--

INSERT INTO `encomenda_produtos` (`encomenda_id`, `produto_id`, `quantidade`, `preco_total`) VALUES
(21, 40, 1, 33999),
(22, 42, 1, 24999),
(22, 48, 1, 99900),
(23, 41, 1, 17500);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `codEndereco` int(11) NOT NULL,
  `ilha` varchar(50) DEFAULT NULL,
  `municipio` varchar(80) DEFAULT NULL,
  `localidade` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`codEndereco`, `ilha`, `municipio`, `localidade`) VALUES
(26, 'Santiago', 'Praia', 'Bela Vista'),
(28, 'Santiago', '', 'palmarejo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `codFunc` int(11) NOT NULL,
  `nomeFunc` varchar(100) NOT NULL,
  `telefone` int(11) NOT NULL,
  `nif` int(11) NOT NULL,
  `morada` varchar(45) DEFAULT NULL,
  `user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`codFunc`, `nomeFunc`, `telefone`, `nif`, `morada`, `user`) VALUES
(1, 'Anderson Semedo', 5981615, 11182540, 'Bela Vista', 1);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `minhas_encomendas`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `minhas_encomendas` (
`nomeProduto` varchar(25)
,`imagem` varchar(80)
,`data` datetime
,`status_entrega` enum('0','1')
,`cliente` int(11)
,`quantidade` int(11)
,`preco_total` double
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `codProduto` int(11) NOT NULL,
  `nomeProduto` varchar(25) NOT NULL,
  `descricao` text NOT NULL,
  `categoria` int(11) NOT NULL,
  `preco` double NOT NULL,
  `stock` int(11) NOT NULL,
  `imagem` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codProduto`, `nomeProduto`, `descricao`, `categoria`, `preco`, `stock`, `imagem`) VALUES
(1, 'Sansung Galaxy S22', 'Os Galaxy S22 foram projetados para durar, tendo sido construídos com os melhores materiais para oferecer a máxima resistência Além disso, o seu tamanho foi otimizado, minimizando o peso e as armações para obter um dispositivo mais cómodo e ergonómico', 4, 120000, 5, 'galaxy_s22.jpg'),
(40, 'Samsung Galaxy A71 ', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?', 4, 33999, 4, 'p039768_1-removebg-preview.png'),
(41, 'BlackView', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?', 4, 17500, 4, 'p040817_1-removebg-preview.png'),
(42, 'Samsung Galaxy M23', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?', 4, 24999, 2, 'p041682_1-removebg-preview.png'),
(43, 'Samsung Galaxy A21s', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?', 4, 19999, 3, 'smartphone-removebg-preview.png'),
(46, 'Xiaomi TV Pie 55\'', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?', 5, 99999, 2, '1733-xiaomi-tv-p1e-55-led-ultrahd-4k-hdr10-removebg-preview.png'),
(47, 'LG Oled evo', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?', 5, 85000, 3, 'LG-serie-C2-SmartTV4-removebg-preview.png'),
(48, 'LG UHD AI ThinQ', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?', 5, 99900, 2, 'LG-serie-G2-gallery-edition-smart-77-removebg-preview.png'),
(49, 'Samsung NeoQLED', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae obcaecati eius tempora provident nesciunt, in voluptas incidunt rem quod. Minus quo omnis fugiat ex tempore. Deserunt non eaque enim voluptatum?', 5, 89000, 3, 'SansungQN90B-removebg-preview.png'),
(50, 'Samsung Galaxy s21', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum incidunt temporibus amet perspiciatis, dolorum quam nihil ea, omnis accusantium eaque odit dolor neque suscipit fugit est quo nam impedit laudantium.', 4, 17000, 4, 'galaxy_s22-removebg-preview.png'),
(51, 'Samsung A70', 'bd dfs', 4, 50000, 4, '1_p042787-removebg-preview.png');

--
-- Acionadores `produto`
--
DELIMITER $$
CREATE TRIGGER `produto_BEFORE_DELETE` BEFORE DELETE ON `produto` FOR EACH ROW BEGIN
	delete from encomenda_produtos where produto_id = old.codProduto;
    delete from promocao where idProd = old.codProduto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `promocao`
--

CREATE TABLE `promocao` (
  `idPromo` int(11) NOT NULL,
  `idProd` int(11) NOT NULL,
  `desconto` double NOT NULL,
  `valorPromo` double DEFAULT NULL,
  `dtInicio` text NOT NULL,
  `dtFim` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `promocao`
--

INSERT INTO `promocao` (`idPromo`, `idProd`, `desconto`, `valorPromo`, `dtInicio`, `dtFim`) VALUES
(13, 1, 5000, 115000, '2022-12-10', '2022-12-20'),
(18, 40, 1500, 32499, '2022-12-10', '2022-12-16'),
(19, 41, 5000, 12500, '2022-12-16', '2022-12-22'),
(20, 42, 5000, 19999, '2022-12-14', '2022-12-14'),
(21, 1, 5000, 115000, '2022-12-10', '2022-12-29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoutilizador`
--

CREATE TABLE `tipoutilizador` (
  `id` int(11) NOT NULL,
  `tipo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipoutilizador`
--

INSERT INTO `tipoutilizador` (`id`, `tipo`) VALUES
(1, 'Gestor'),
(2, 'Vendedor'),
(3, 'Cliente'),
(4, 'Administrador de Sistemas'),
(5, 'Serviço de entrega');

--
-- Acionadores `tipoutilizador`
--
DELIMITER $$
CREATE TRIGGER `tipoutilizador_BEFORE_DELETE` BEFORE DELETE ON `tipoutilizador` FOR EACH ROW BEGIN
delete from utilizador where tipo = old.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(30) NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  `foto` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id`, `username`, `email`, `pass`, `tipo`, `foto`) VALUES
(1, 'admin', NULL, 'admin', 5, 'alexander.jpg'),
(38, 'anderson', 'andsemedo023@gmail.com', '1234', 3, 'no_photo.png'),
(40, 'antonio', 'undefined', '1234', 3, 'no_photo.png'),
(41, 'veronica', 'undefined', '1234', 3, 'no_photo.png');

--
-- Acionadores `utilizador`
--
DELIMITER $$
CREATE TRIGGER `utilizador_BEFORE_DELETE` BEFORE DELETE ON `utilizador` FOR EACH ROW BEGIN
delete from funcionario where user = old.id;
delete from cliente where user = old.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_carrinho`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_carrinho` (
);

-- --------------------------------------------------------

--
-- Estrutura para vista `detail_cliente`
--
DROP TABLE IF EXISTS `detail_cliente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_cliente`  AS SELECT `c`.`codCliente` AS `codCliente`, `c`.`nome` AS `nome`, `c`.`telefone` AS `telefone`, `c`.`endereco` AS `endereco`, `c`.`user` AS `user`, `u`.`id` AS `id`, `u`.`username` AS `username`, `u`.`email` AS `email`, `u`.`pass` AS `pass`, `u`.`tipo` AS `tipo`, `u`.`foto` AS `foto` FROM (`cliente` `c` join `utilizador` `u` on(`c`.`user` = `u`.`id`))  ;

-- --------------------------------------------------------

--
-- Estrutura para vista `detail_encom`
--
DROP TABLE IF EXISTS `detail_encom`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_encom`  AS SELECT `c`.`id_prod` AS `id_prod`, `p`.`nomeProduto` AS `nomeProduto`, `c`.`preco_total` AS `preco_total`, `p`.`preco` AS `preco` FROM (`carrinho` `c` join `produto` `p` on(`c`.`id_prod` = `p`.`codProduto`))  ;

-- --------------------------------------------------------

--
-- Estrutura para vista `minhas_encomendas`
--
DROP TABLE IF EXISTS `minhas_encomendas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `minhas_encomendas`  AS SELECT `p`.`nomeProduto` AS `nomeProduto`, `p`.`imagem` AS `imagem`, `e`.`data` AS `data`, `e`.`status_entrega` AS `status_entrega`, `e`.`cliente` AS `cliente`, `ep`.`quantidade` AS `quantidade`, `ep`.`preco_total` AS `preco_total` FROM ((`encomenda` `e` join `encomenda_produtos` `ep` on(`e`.`id` = `ep`.`encomenda_id`)) join `produto` `p` on(`ep`.`produto_id` = `p`.`codProduto`))  ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_carrinho`
--
DROP TABLE IF EXISTS `vw_carrinho`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_carrinho`  AS SELECT `c`.`id` AS `id`, `c`.`id_prod` AS `id_prod`, `c`.`qtd` AS `qtd`, `c`.`preco_total` AS `preco_total`, `c`.`id_cliente` AS `id_cliente`, `cl`.`codCliente` AS `codCliente`, `cl`.`nome` AS `nome`, `cl`.`telefone` AS `telefone`, `cl`.`endereco` AS `endereco`, `cl`.`user` AS `user` FROM ((`carrinho` `c` join `cliente` `cl`) join `produto` `p`) WHERE `c`.`id_cliente` = `cl`.`codCliente` OR `c`.`id_cliente` is nullnull  ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codCliente`),
  ADD UNIQUE KEY `telefone_UNIQUE` (`telefone`),
  ADD KEY `endereco` (`endereco`),
  ADD KEY `cliente_ibfk_2_idx` (`user`);

--
-- Índices para tabela `encomenda`
--
ALTER TABLE `encomenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `encomenda_ibfk_2` (`cliente`),
  ADD KEY `id_vend` (`id_vend`),
  ADD KEY `entregador` (`entregador`);

--
-- Índices para tabela `encomenda_produtos`
--
ALTER TABLE `encomenda_produtos`
  ADD PRIMARY KEY (`encomenda_id`,`produto_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`codEndereco`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`codFunc`),
  ADD UNIQUE KEY `nif_UNIQUE` (`nif`),
  ADD UNIQUE KEY `telefone_UNIQUE` (`telefone`),
  ADD KEY `funcionario_ibfk_2_idx` (`user`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`codProduto`),
  ADD UNIQUE KEY `codProduto_UNIQUE` (`codProduto`),
  ADD KEY `categoria` (`categoria`);

--
-- Índices para tabela `promocao`
--
ALTER TABLE `promocao`
  ADD PRIMARY KEY (`idPromo`),
  ADD KEY `idProd` (`idProd`);

--
-- Índices para tabela `tipoutilizador`
--
ALTER TABLE `tipoutilizador`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `username` (`username`,`email`,`pass`),
  ADD KEY `utilizador_ibfk_1` (`tipo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `encomenda`
--
ALTER TABLE `encomenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `codEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `codFunc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `codProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `promocao`
--
ALTER TABLE `promocao`
  MODIFY `idPromo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `tipoutilizador`
--
ALTER TABLE `tipoutilizador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`endereco`) REFERENCES `endereco` (`codEndereco`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`user`) REFERENCES `utilizador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `encomenda`
--
ALTER TABLE `encomenda`
  ADD CONSTRAINT `encomenda_ibfk_2` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`codCliente`),
  ADD CONSTRAINT `encomenda_ibfk_3` FOREIGN KEY (`id_vend`) REFERENCES `funcionario` (`codFunc`),
  ADD CONSTRAINT `encomenda_ibfk_4` FOREIGN KEY (`entregador`) REFERENCES `funcionario` (`codFunc`);

--
-- Limitadores para a tabela `encomenda_produtos`
--
ALTER TABLE `encomenda_produtos`
  ADD CONSTRAINT `encomenda_produtos_ibfk_1` FOREIGN KEY (`encomenda_id`) REFERENCES `encomenda` (`id`),
  ADD CONSTRAINT `encomenda_produtos_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`codProduto`);

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_2` FOREIGN KEY (`user`) REFERENCES `utilizador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `promocao`
--
ALTER TABLE `promocao`
  ADD CONSTRAINT `promocao_ibfk_1` FOREIGN KEY (`idProd`) REFERENCES `produto` (`codProduto`);

--
-- Limitadores para a tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD CONSTRAINT `utilizador_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipoutilizador` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
