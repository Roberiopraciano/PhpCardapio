-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Out-2020 às 15:23
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `delivery`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairros_delivery`
--

CREATE TABLE `bairros_delivery` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cidade` varchar(150) NOT NULL,
  `bairro` varchar(150) NOT NULL,
  `taxa` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bairros_delivery`
--

INSERT INTO `bairros_delivery` (`id`, `user_id`, `uf`, `cidade`, `bairro`, `taxa`) VALUES
(2, 1, 'AL', 'Arapiraca', 'Santos Dumont ', '6.00'),
(3, 4, 'SE', 'Barra dos Coqueiros', 'Centro ', '4.50'),
(4, 5, 'RJ', 'Rio de Janeiro', 'Santissimo ', '3.00'),
(6, 5, 'RJ', 'Rio de Janeiro', 'Estrada do Mendanha ', '6.00'),
(7, 5, 'RJ', 'Rio de Janeiro', 'Estrada da Posse ', '3.00'),
(8, 5, 'RJ', 'Rio de Janeiro', 'Senador Vasconcelos ', '5.00'),
(11, 5, 'RJ', 'Rio de Janeiro', 'Estrada Das Capoeiras ', '5.00'),
(12, 5, 'RJ', 'Rio de Janeiro', 'Marco 7 ', '5.00'),
(13, 5, 'RJ', 'Rio de Janeiro', 'Estrada do Lameir', '3.00'),
(14, 5, 'RJ', 'Rio de Janeiro', 'Senador Camara ', '10.00'),
(15, 1, 'SE', 'Aracaju', 'Siqueira Campos ', '4.50'),
(16, 1, 'SE', 'Aracaju', 'Centro ', '8.00'),
(17, 1, 'SE', 'Aracaju', 'Cidade Nova ', '3.50'),
(18, 1, 'SE', 'Aracaju', 'Porto Dantas ', '7.00'),
(22, 9, 'DF', 'Brasília', 'Santa Maria ', '4.00'),
(23, 9, 'DF', 'Brasília', 'Gama ', '8.00'),
(24, 9, 'DF', 'Brasília', 'Total Ville ', '4.00'),
(25, 9, 'DF', 'Brasília', 'Santos Dumont ', '4.00'),
(26, 9, 'GO', 'Novo Gama', 'Novo Gama ', '5.00'),
(27, 11, 'SP', 'Mogi das Cruzes', 'Vila 4 ', '2.00'),
(28, 1, 'SE', 'Aracaju', '13 de Julho ', '10.00'),
(29, 1, 'SE', 'Aracaju', 'Salgado Filho ', '8.50'),
(30, 1, 'SE', 'Aracaju', 'Grajeru ', '9.00'),
(31, 12, 'DF', 'Brasília', 'Águas Claras ', '5.00'),
(32, 14, 'MG', 'Timóteo', 'Cachoeira do Vale ', '0.00'),
(33, 14, 'MG', 'Timóteo', 'Alvorada ', '5.00'),
(35, 17, 'SP', 'Eldorado', 'Bimba ', '1.00'),
(36, 17, 'SP', 'Eldorado', 'Monte Libano ', '2.00'),
(37, 17, 'SP', 'São Paulo', 'Vila Lola ', '2.00'),
(38, 17, 'SP', 'São Paulo', 'Ferradura ', '2.00'),
(39, 17, 'SP', 'São Paulo', 'Conego ', '2.00'),
(40, 17, 'SP', 'São Paulo', 'Guacuri ', '3.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracoes_site`
--

CREATE TABLE `configuracoes_site` (
  `id_config` int(11) NOT NULL,
  `nome_site` varchar(100) NOT NULL,
  `titulo_site` varchar(250) NOT NULL,
  `descricao_site` varchar(250) NOT NULL,
  `palavas_chaves` varchar(500) NOT NULL,
  `tel_adm` varchar(100) NOT NULL,
  `tel_financeiro` varchar(100) NOT NULL,
  `email_suporte` varchar(250) NOT NULL,
  `h_suporte` varchar(250) NOT NULL,
  `btn_link_youtube` varchar(250) NOT NULL,
  `link_do_face` varchar(500) NOT NULL,
  `link_do_insta` varchar(500) NOT NULL,
  `link_do_youtube` varchar(500) NOT NULL,
  `nome_plano_um` varchar(100) NOT NULL,
  `v_plano_um` int(11) NOT NULL,
  `dias_plano_um` int(11) NOT NULL,
  `nome_plano_dois` varchar(100) NOT NULL,
  `v_plano_dois` int(11) NOT NULL,
  `dias_plano_dois` int(11) NOT NULL,
  `nome_plano_tres` varchar(100) NOT NULL,
  `v_plano_tres` int(11) NOT NULL,
  `dias_plano_tres` int(11) NOT NULL,
  `dias_testes` int(11) NOT NULL,
  `public_key_mp` varchar(500) NOT NULL,
  `access_token_mp` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `configuracoes_site`
--

INSERT INTO `configuracoes_site` (`id_config`, `nome_site`, `titulo_site`, `descricao_site`, `palavas_chaves`, `tel_adm`, `tel_financeiro`, `email_suporte`, `h_suporte`, `btn_link_youtube`, `link_do_face`, `link_do_insta`, `link_do_youtube`, `nome_plano_um`, `v_plano_um`, `dias_plano_um`, `nome_plano_dois`, `v_plano_dois`, `dias_plano_dois`, `nome_plano_tres`, `v_plano_tres`, `dias_plano_tres`, `dias_testes`, `public_key_mp`, `access_token_mp`) VALUES
(1, 'Pedido Top', 'Delivery online via WhatsApp.', 'Crie um cardápio online atraente que inspire o apetite.', 'pizza, delivery food, fast food, sushi, take away, chinese, italian food', '79991322619', '79991322619', 'contato@pedido.top', '09:00hs ás 18:00hs', 'https://www.youtube.com/watch?v=9RUpolxiTIE&t=1s', 'facebook', 'instagram', 'youtube', 'PLANO MENSAL', 50, 30, 'PLANO TRIMESTRAL', 160, 90, 'PLANO ANUAL', 390, 365, 5, 'APP_USR-d6d696f6-2db2-4693-a6c0-08ce23636da1', 'APP_USR-1625076714913746-053018-f8a18770f28fbcfc221029a2b530711a-281362235');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom_desconto`
--

CREATE TABLE `cupom_desconto` (
  `id_cupom` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ativacao` varchar(50) NOT NULL,
  `porcentagem` int(11) NOT NULL,
  `data_validade` date NOT NULL,
  `total_vezes` int(11) NOT NULL,
  `mostrar_site` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cupom_desconto`
--

INSERT INTO `cupom_desconto` (`id_cupom`, `user_id`, `ativacao`, `porcentagem`, `data_validade`, `total_vezes`, `mostrar_site`) VALUES
(3, 1, 'cupom5', 5, '2025-06-30', 916, 1),
(6, 11, 'cupom5', 5, '2020-06-17', 3, 0),
(7, 20, 'Cupom 5', 5, '2020-08-07', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `views`
--

CREATE TABLE `views` (
  `id_views` int(11) NOT NULL,
  `contar` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `views`
--

INSERT INTO `views` (`id_views`, `contar`, `user_id`) VALUES
(1, 6, 4),
(5, 1370, 1),
(6, 25, 5),
(7, 5, 6),
(8, 20, 9),
(9, 2, 10),
(10, 113, 11),
(11, 42, 12),
(12, 20, 14),
(13, 11, 15),
(14, 31, 17),
(15, 2, 16),
(16, 3, 18),
(17, 34, 20),
(18, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_adicionais_itens`
--

CREATE TABLE `ws_adicionais_itens` (
  `id_adicionais` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `categorias_adicional` varchar(1000) NOT NULL,
  `nome_adicional` varchar(250) NOT NULL,
  `valor_adicional` decimal(10,2) NOT NULL,
  `medida_adicional` varchar(10) NOT NULL,
  `status_adicional` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_adicionais_itens`
--

INSERT INTO `ws_adicionais_itens` (`id_adicionais`, `user_id`, `categorias_adicional`, `nome_adicional`, `valor_adicional`, `medida_adicional`, `status_adicional`) VALUES
(126, 1, '45', 'Bacon', '2.00', 'UN', 1),
(127, 1, '45', 'ovo', '2.00', 'UN', 1),
(124, 1, '48, 49', 'Com Leite', '2.00', 'UN', 1),
(121, 1, '44', 'bacon', '2.00', 'UN', 0),
(123, 1, '44, 45, 47', 'chaddar', '3.00', 'UN', 1),
(147, 17, '83, 90', 'Tomate', '2.00', 'UN', 1),
(146, 17, '83, 90', 'Catupiry', '2.00', 'UN', 1),
(143, 17, '83, 90', 'Mussarela', '5.00', 'UN', 1),
(144, 17, '83, 90', 'Bacon', '5.00', 'UN', 1),
(145, 17, '83, 90', 'Calabresa', '5.00', 'UN', 1),
(137, 17, '85', 'Chocolate', '4.00', 'UN', 1),
(138, 17, '85', 'Goiabada', '2.50', 'UN', 1),
(139, 17, '85, 90', 'Doce leite', '3.00', 'UN', 1),
(140, 17, '83, 91', 'Borda catupiry', '2.00', 'UN', 1),
(141, 17, '83, 91', 'Borda cheddar', '3.00', 'UN', 1),
(142, 17, '83, 91', 'Borda catupiry especial', '4.00', 'UN', 1),
(148, 17, '83, 90', 'Azeitona', '1.00', 'UN', 1),
(149, 17, '83, 90', 'Atum', '6.00', 'UN', 1),
(150, 17, '83, 89', 'Cebola', '1.50', 'UN', 1),
(151, 17, '83, 90', 'Cheddar', '3.00', 'UN', 1),
(152, 17, '83, 90', 'Meia Mussarela (coloque na observação qual a parte desejada)', '3.00', 'UN', 1),
(153, 17, '83, 90', 'Meia Bacon  (coloque na observação qual a parte desejada)', '3.00', 'UN', 1),
(154, 17, '83, 90', 'Meia Catupiry  (coloque na observação qual a parte desejada)', '2.50', 'UN', 1),
(155, 17, '83, 90', 'Meia Calabresa  (coloque na observação qual a parte desejada)', '3.50', 'UN', 1),
(156, 17, '83, 90', 'Meia Tomate  (coloque na observação qual a parte desejada)', '1.50', 'UN', 1),
(157, 17, '83, 90', 'Meia Atum  (coloque na observação qual a parte desejada)', '4.00', 'UN', 1),
(158, 17, '83, 90', 'Meia cebola  (coloque na observação qual a parte desejada)', '1.50', 'UN', 1),
(162, 18, '92', 'portuguesa', '0.00', 'UN', 1),
(163, 18, '92', 'mussarela', '0.00', 'UN', 1),
(164, 18, '92', 'lombo', '0.00', 'UN', 1),
(165, 18, '92', 'bacon', '0.00', 'UN', 1),
(166, 18, '93', 'leite em po', '1.50', 'UN', 1),
(167, 18, '93', 'leite condensado', '1.50', 'UN', 1),
(168, 18, '93', 'chocolate', '2.00', 'UN', 1),
(169, 18, '92', 'carne seca', '0.00', 'UN', 1),
(170, 20, '94', 'Bacon', '1.00', 'UN', 1),
(171, 20, '94', 'Catupiry', '0.00', 'UN', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_admin`
--

CREATE TABLE `ws_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `admin_senha` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `admin_ultimoacesso` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `admin_level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `ws_admin`
--

INSERT INTO `ws_admin` (`admin_id`, `admin_email`, `admin_senha`, `admin_ultimoacesso`, `admin_level`) VALUES
(1, 'alexdasilvalima2110@gmail.com', '4e57a14e36c079e5db014c0dd1d64e7d', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_cat`
--

CREATE TABLE `ws_cat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nome_cat` varchar(250) NOT NULL,
  `desc_cat` varchar(500) NOT NULL,
  `icon_cat` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_cat`
--

INSERT INTO `ws_cat` (`id`, `user_id`, `nome_cat`, `desc_cat`, `icon_cat`) VALUES
(44, 1, 'hambúrgueres', 'Nossos hambúrgueres artesanais, são preparados com o melhor blend de carnes, feito na churrasqueira, com um sabor típico, e acompanhado de produtos de ALTÍSSIMA qualidade. Peça seu hambúrguer artesanal hoje mesmo.', 'img/burger.png'),
(45, 1, 'PIZZAS', 'null', 'img/pizza.png'),
(46, 1, 'REFRIGERANTES', 'null', 'img/refrigerantes.png'),
(47, 1, 'SALGADOS', 'null', 'img/bitterballen2.png'),
(48, 1, 'SUCOS', 'null', 'img/lemonade.png'),
(49, 1, 'AÇAI', 'null', 'img/acai.png'),
(50, 5, 'BURGUERS TRADICIONAIS', 'NOSSOS BURGUERS TRADICIONAIS SÃO PREPARADOS COM CARNE 100% BOVINA DE 90GR.', 'img/burger.png'),
(51, 5, 'BURGUERS ARTESANAIS', 'NOSSOS BURGUERS ARTESANAIS SÃO PREPARADOS COM CARNE 100% BOVINA DE 150GR', 'img/burger.png'),
(52, 5, 'COMBOS TRADICIONAIS', 'COMBO - BURGUER TRADICIONAL + BATATA M + REFRIGERANTE LATA', 'img/combohamburgue.png'),
(53, 5, 'COMBOS ARTESANAIS', 'COMBO - BURGUER ARTESANAL + BATATA M + REFRIGERANTE LATA', 'img/combohamburgue.png'),
(54, 5, 'PIZZAS 35CM - 8 PEDAÇOS', 'PIZZA TOTALMENTE ARTESANAL.', 'img/pizza.png'),
(55, 5, 'ESFIHAS DOCES', 'ESFIHA PREPARADA ARTESANALMENTE', 'null'),
(56, 6, 'Refrigerantes', 'Escolha seu refri', 'img/can.png'),
(57, 5, 'PORÇÕES', 'PORÇÕES DE BATATA, PORCÕES DE PASTEIS, PORÇÕES DE ONIONS RINGS.', 'img/carvao.png'),
(58, 5, 'PASTÉIS', 'PASTEIS DOCES E SALGADOS', 'img/sacola.png'),
(59, 5, 'BEBIDAS', 'REFRIGERANTES LATA, REFRIGERANTES 2L E REFRIGERANTES 1,5L', 'img/refrigerantes.png'),
(60, 9, 'Blend especial assado na brasa', 'Hambúrguer artesanal , blend de costela e fraldinha, queijo cheddar ou prato, bacon, molho da casa, salada da casa', 'img/burger.png'),
(61, 9, 'Hambúrguer de frango assado na brasa ou empanado', 'Hambúrguer de frango empanado', 'img/burger.png'),
(63, 10, 'HAMBÚRGUER', 'null', 'img/burger.png'),
(64, 11, 'Pizzas Gourmet', 'Pizza 35cm, 8 pedaços, linha gourmet', 'img/pizza.png'),
(65, 11, 'Pizzas Gourmet Doce', 'Pizza 35cm, 8 pedaços, linha gourmet', 'img/pizza.png'),
(67, 11, 'Bebidas', 'null', 'img/can.png'),
(68, 11, 'Lanches', 'Todos os lanches  acompanha catchup, mostarda, molho barbecue e maionese', 'img/burger.png'),
(69, 11, 'Sorvetes', 'Sabores', 'null'),
(70, 12, 'FEIJOADA COMPLETA', 'Marmitex', 'null'),
(71, 12, 'KIT FEIJOADA', 'null', 'null'),
(72, 12, 'PORÇÕES EXTRAS', 'null', 'null'),
(74, 14, 'Hambúrgueres', 'Tradicionais', 'img/burger.png'),
(75, 14, 'Macarrão na chapa', 'Macarrão', 'null'),
(76, 14, 'Refrigerante', '2L', 'img/refrigerantes.png'),
(77, 15, 'Teste 1', 'Teste 1', 'null'),
(78, 15, 'Teste 2', 'Teste 2', 'null'),
(79, 15, 'A', 'A', 'null'),
(80, 11, 'Pizza Executiva meio a meio', 'null', 'img/pizza.png'),
(83, 17, 'Pizzas salgadas', 'Pizza 8 pedaços', 'img/pizza.png'),
(85, 17, 'Pizzas doces', 'null', 'img/cupcake.png'),
(86, 17, 'Calzones', 'Pizza fechada 4 pedaços', 'img/pizza.png'),
(87, 17, 'Bebidas', 'Bebidas', 'img/refrigerantes.png'),
(88, 17, 'Pizzas Brotinhos', 'Brotinhos 4 pedaços', 'img/pizza.png'),
(89, 17, 'Combos', 'null', 'img/combopizza.png'),
(90, 17, 'Adicionais', 'Recheios extra', 'img/bandeja.png'),
(91, 17, 'Borda adicional', 'Borda adicional', 'null'),
(92, 18, 'PIZZA', 'pizzas', 'img/pizza.png'),
(93, 18, 'AÇAI', 'melhor do açai', 'img/acai.png'),
(94, 20, '01 ESPETINHOS SIMPLES', 'Espetos comuns', 'img/espetinho.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_datas_close`
--

CREATE TABLE `ws_datas_close` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_datas_close`
--

INSERT INTO `ws_datas_close` (`id`, `user_id`, `data`) VALUES
(18, 1, '14/01/2019'),
(20, 1, '12/01/2019'),
(22, 1, '03/05/2020'),
(24, 1, '16/05/2020');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_empresa`
--

CREATE TABLE `ws_empresa` (
  `id_empresa` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nome_empresa` varchar(250) NOT NULL,
  `descricao_empresa` varchar(200) NOT NULL,
  `nome_empresa_link` varchar(250) NOT NULL,
  `cnpj_empresa` varchar(250) NOT NULL,
  `email_empresa` varchar(250) NOT NULL,
  `telefone_empresa` varchar(250) NOT NULL,
  `end_rua_n_empresa` varchar(250) NOT NULL,
  `end_bairro_empresa` varchar(250) NOT NULL,
  `cidade_empresa` varchar(250) NOT NULL,
  `end_uf_empresa` varchar(250) NOT NULL,
  `cep_empresa` varchar(250) NOT NULL,
  `img_logo` varchar(300) NOT NULL,
  `img_header` varchar(400) NOT NULL,
  `facebook_status` int(11) NOT NULL,
  `twitter_status` int(11) NOT NULL,
  `instagram_status` int(11) NOT NULL,
  `facebook_empresa` varchar(600) NOT NULL,
  `instagram_empresa` varchar(600) NOT NULL,
  `twitter_empresa` varchar(600) NOT NULL,
  `genero_empresa` varchar(255) NOT NULL,
  `config_segunda` varchar(250) NOT NULL,
  `config_terca` varchar(250) NOT NULL,
  `config_quarta` varchar(250) NOT NULL,
  `config_quinta` varchar(250) NOT NULL,
  `config_sexta` varchar(250) NOT NULL,
  `config_sabado` varchar(250) NOT NULL,
  `config_domingo` varchar(250) NOT NULL,
  `config_segundaa` varchar(50) NOT NULL,
  `config_tercaa` varchar(50) NOT NULL,
  `config_quartaa` varchar(50) NOT NULL,
  `config_quintaa` varchar(50) NOT NULL,
  `config_sextaa` varchar(50) NOT NULL,
  `config_sabadoo` varchar(50) NOT NULL,
  `config_domingoo` varchar(50) NOT NULL,
  `segunda_manha_de` varchar(250) NOT NULL,
  `segunda_manha_ate` varchar(250) NOT NULL,
  `segunda_tarde_de` varchar(250) NOT NULL,
  `segunda_tarde_ate` varchar(250) NOT NULL,
  `terca_manha_de` varchar(250) NOT NULL,
  `terca_manha_ate` varchar(250) NOT NULL,
  `terca_tarde_de` varchar(250) NOT NULL,
  `terca_tarde_ate` varchar(250) NOT NULL,
  `quarta_manha_de` varchar(250) NOT NULL,
  `quarta_manha_ate` varchar(250) NOT NULL,
  `quarta_tarde_de` varchar(250) NOT NULL,
  `quarta_tarde_ate` varchar(250) NOT NULL,
  `quinta_manha_de` varchar(250) NOT NULL,
  `quinta_manha_ate` varchar(250) NOT NULL,
  `quinta_tarde_de` varchar(250) NOT NULL,
  `quinta_tarde_ate` varchar(250) NOT NULL,
  `sexta_manha_de` varchar(250) NOT NULL,
  `sexta_manha_ate` varchar(250) NOT NULL,
  `sexta_tarde_de` varchar(250) NOT NULL,
  `sexta_tarde_ate` varchar(250) NOT NULL,
  `sabado_manha_de` varchar(250) NOT NULL,
  `sabado_manha_ate` varchar(250) NOT NULL,
  `sabado_tarde_de` varchar(250) NOT NULL,
  `sabado_tarde_ate` varchar(250) NOT NULL,
  `domingo_manha_de` varchar(250) NOT NULL,
  `domingo_manha_ate` varchar(250) NOT NULL,
  `domingo_tarde_de` varchar(250) NOT NULL,
  `domingo_tarde_ate` varchar(250) NOT NULL,
  `config_delivery` decimal(10,2) NOT NULL,
  `config_delivery_free` decimal(10,2) NOT NULL,
  `op_entrar_btn` int(11) NOT NULL,
  `empresa_data_renovacao` date NOT NULL,
  `msg_tempo_delivery` varchar(150) NOT NULL,
  `msg_tempo_buscar` varchar(150) NOT NULL,
  `minimo_delivery` decimal(10,2) NOT NULL,
  `confirm_delivery` varchar(20) NOT NULL,
  `confirm_balcao` varchar(20) NOT NULL,
  `confirm_mesa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_empresa`
--

INSERT INTO `ws_empresa` (`id_empresa`, `user_id`, `nome_empresa`, `descricao_empresa`, `nome_empresa_link`, `cnpj_empresa`, `email_empresa`, `telefone_empresa`, `end_rua_n_empresa`, `end_bairro_empresa`, `cidade_empresa`, `end_uf_empresa`, `cep_empresa`, `img_logo`, `img_header`, `facebook_status`, `twitter_status`, `instagram_status`, `facebook_empresa`, `instagram_empresa`, `twitter_empresa`, `genero_empresa`, `config_segunda`, `config_terca`, `config_quarta`, `config_quinta`, `config_sexta`, `config_sabado`, `config_domingo`, `config_segundaa`, `config_tercaa`, `config_quartaa`, `config_quintaa`, `config_sextaa`, `config_sabadoo`, `config_domingoo`, `segunda_manha_de`, `segunda_manha_ate`, `segunda_tarde_de`, `segunda_tarde_ate`, `terca_manha_de`, `terca_manha_ate`, `terca_tarde_de`, `terca_tarde_ate`, `quarta_manha_de`, `quarta_manha_ate`, `quarta_tarde_de`, `quarta_tarde_ate`, `quinta_manha_de`, `quinta_manha_ate`, `quinta_tarde_de`, `quinta_tarde_ate`, `sexta_manha_de`, `sexta_manha_ate`, `sexta_tarde_de`, `sexta_tarde_ate`, `sabado_manha_de`, `sabado_manha_ate`, `sabado_tarde_de`, `sabado_tarde_ate`, `domingo_manha_de`, `domingo_manha_ate`, `domingo_tarde_de`, `domingo_tarde_ate`, `config_delivery`, `config_delivery_free`, `op_entrar_btn`, `empresa_data_renovacao`, `msg_tempo_delivery`, `msg_tempo_buscar`, `minimo_delivery`, `confirm_delivery`, `confirm_balcao`, `confirm_mesa`) VALUES
(21, 1, 'DEMONSTRAÇÃO', 'Desde 2020 entregando os lanches mais sinistros da cidade!', 'Demo', '', 'alexdasilvalima2110@gmail.com', '79991322619', 'Rua Silvio Barbini', 'Itaquera', 'Itaporanga d´Ajuda', 'SE', '08200-030', 'images/2020/05/img-teste.png', 'images/2020/07/unnamed.png', 2, 2, 2, 'https://www.facebook.com/cobantracker/', 'https://www.instagram.com/alexsilva1727/', 'https://www.facebook.com/cobantracker/', '', 'true', 'false', 'true', 'true', 'true', 'true', 'false', 'true', 'false', 'true', 'true', 'true', 'false', 'true', '06:00', '12:00', '17:00', '00:00', '04:00', '12:00', '00:00', '00:00', '06:00', '14:00', '17:00', '00:00', '06:00', '12:00', '14:00', '00:00', '06:00', '14:00', '17:00', '00:00', '01:00', '14:00', '00:00', '00:00', '00:00', '00:00', '17:00', '23:59', '6.00', '50.00', 1, '2030-10-21', 'Entre 30 e 60 minutos.', 'Em 30 minutos.', '15.00', 'true', 'true', 'true'),
(24, 4, 'isabela', '', 'lojaisabela', '', 'isabelasilvasantos1101@gmail.com', '79991323022', 'avenida oceânica, 800', 'centro', 'Barra dos Coqueiros', 'SE', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '0.00', 0, '2020-10-19', '', '', '0.00', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_formas_pagamento`
--

CREATE TABLE `ws_formas_pagamento` (
  `id_f_pagamento` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `f_pagamento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_formas_pagamento`
--

INSERT INTO `ws_formas_pagamento` (`id_f_pagamento`, `user_id`, `f_pagamento`) VALUES
(1, 1, 'Dinheiro'),
(3, 1, 'Cartão Crédito'),
(4, 18, 'dinheiro, credito, debito, vale.'),
(5, 1, 'Cartão Debito'),
(6, 20, 'Dinheiro'),
(7, 20, 'Cartão débito'),
(8, 20, 'Cartão crédito');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_impressora`
--

CREATE TABLE `ws_impressora` (
  `id_impressora` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nome_impressora` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `ws_impressora`
--

INSERT INTO `ws_impressora` (`id_impressora`, `user_id`, `nome_impressora`) VALUES
(1, 1, 'COM6');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_itens`
--

CREATE TABLE `ws_itens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `img_item` varchar(500) NOT NULL,
  `nome_item` varchar(250) NOT NULL,
  `descricao_item` varchar(500) NOT NULL,
  `preco_item` decimal(10,2) NOT NULL,
  `config_total_s` int(11) NOT NULL,
  `disponivel` int(11) NOT NULL,
  `dia_semana` varchar(500) NOT NULL,
  `number_adicional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_itens`
--

INSERT INTO `ws_itens` (`id`, `user_id`, `id_cat`, `img_item`, `nome_item`, `descricao_item`, `preco_item`, `config_total_s`, `disponivel`, `dia_semana`, `number_adicional`) VALUES
(96, 1, 44, 'images/2020/06/hamburguer-shutterstock.jpg', 'Ô CABRUNCO', 'Pão burger  e quentinho, hambúrguer, cebola, Bacon, cheddar e picles com ketchup e mostarda.', '8.00', 4, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 1),
(97, 1, 44, 'images/2020/06/1-ja74qpri-9hvdmgjsdj-sq.jpg', 'AMOSTRADO', 'São 3 saborosas fatias de bacon, alface, cebola, hambúrguer de 120 gramas de carne bovina, queijo derretido, tomate e um trio de delícias.', '13.00', 4, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 0),
(98, 1, 44, 'images/2020/06/shutterstock-hamburgueres-1.jpg', 'AVEXADO', 'Dois deliciosos hambúrgueres de carne 100% bovina, queijo cheddar derretido, picles, cebola picada, ketchup e mostarda.', '15.00', 4, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 0),
(99, 1, 44, 'images/2020/06/1-jsegxjp6agqldxwxlhbj6w.jpg', 'EXIBIDO', 'Dois hambúrgueres, alface, queijo e molho especial, cebola e picles num pão com gergelim.', '18.00', 4, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 0),
(100, 1, 44, 'false', 'CAMPEÃO', 'Pão, burger 100gr, queijo prato, barbecue picante caseiro, bacon, cebola, salada e maionese da casa.', '6.00', 4, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 0),
(101, 1, 45, 'images/2020/05/pizzaqueijos.jpg', 'Pizza Média', 'Pizza M com 6 fatias - 2 sabores', '30.00', 2, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 0),
(102, 1, 45, 'images/2020/05/pizza-de-atum-e-mussarela.jpg', 'Pizza 5 Queijos Especiais', 'Requeijão Cremoso Danubio, Queijo Parmesão Ralado Vigor, Queijo Gouda Ralado, Queijo Gruyère Ralado, Queijo Gorgonzola Picado e Orégano.', '20.00', 0, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 2),
(103, 1, 45, 'images/2020/05/pizza-1590176697.jpg', 'Pizza Presunto', 'Mussarela, Presunto, rodelas de tomate, azeitona e cebola', '27.90', 1, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 0),
(104, 1, 46, 'images/2020/05/download-1585609494.jpg', 'Coca Cola', 'Lata 350ml', '4.00', 0, 0, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 0),
(105, 1, 46, 'images/2020/05/coca-cola-zero.jpg', 'Coca Cola Zero', 'Lata 350ml', '5.00', 0, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 0),
(106, 1, 46, 'images/2020/05/31dcd357a6.jpg', 'Fanta Laranja', 'Lata 350ml', '3.50', 0, 1, 'null', 32),
(107, 1, 46, 'images/2020/05/download-1.jpg', 'Guaraná Antarctica', 'Lata 350ml', '3.50', 0, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 32),
(108, 1, 47, 'images/2020/05/img-pao-de-queijo.jpg', 'Pão de queijo', 'Pão de queijo de liquidificador', '2.00', 0, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 32),
(109, 1, 47, 'images/2020/05/img-coxinha-simples.jpg', 'Coxinha', 'Coxinha de frango', '2.00', 0, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 10),
(110, 1, 47, 'images/2020/05/201907021158-cda1.jpeg', 'Dupla de acarajé puro tradicional', 'Dois acarajés puros tradicional. O acarajé é feito de massa de feijão fradinho triturado, temperado com cebola e sal.', '18.00', 0, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 12),
(111, 1, 48, 'images/2020/05/bebidas-suco-de-laranjajpg-600x600.jpg', 'Suco de laranja', 'Suco de Laranja 350 ml', '4.00', 1, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 1),
(112, 1, 48, 'images/2020/07/suco-acerola-300x300w-1.png', 'Suco de acerola', 'Suco de Acerola 350 ml', '4.00', 1, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 0),
(113, 1, 45, 'false', 'Pizza de sardinha', 'sardinha e oregano e molho de tomate  e frango.', '18.00', 0, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 0),
(121, 1, 44, 'false', 'samdubateste', 'descrição sanduba teste', '20.00', 0, 1, 'Domingo,Segunda,Terça,Quarta,Quinta,Sexta,Sabado', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_observacoes`
--

CREATE TABLE `ws_observacoes` (
  `id_obs` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nome_observacao` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_observacoes`
--

INSERT INTO `ws_observacoes` (`id_obs`, `user_id`, `id_categoria`, `nome_observacao`) VALUES
(1, 1, 44, 'Sem cebola'),
(3, 1, 44, 'Bem passado'),
(4, 1, 44, 'Mal passado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_opcoes_itens`
--

CREATE TABLE `ws_opcoes_itens` (
  `id_option` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `nome_option` varchar(250) NOT NULL,
  `valor_tamanho` decimal(10,2) NOT NULL,
  `meio_a_meio` varchar(50) NOT NULL,
  `meio_a_meio_tipo` int(11) NOT NULL,
  `total_qtd_itens` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_opcoes_itens`
--

INSERT INTO `ws_opcoes_itens` (`id_option`, `user_id`, `id_tipo`, `nome_option`, `valor_tamanho`, `meio_a_meio`, `meio_a_meio_tipo`, `total_qtd_itens`) VALUES
(35, 1, 28, 'Meio a Meio ou Inteira', '15.50', 'true', 2, '2'),
(36, 1, 28, 'Médio', '30.00', 'null', 0, 'null'),
(37, 1, 29, 'Pequeno', '10.00', 'null', 0, 'null'),
(38, 1, 29, 'Médio', '15.00', 'null', 0, 'null'),
(39, 1, 29, 'Grande', '20.00', 'null', 0, 'null'),
(40, 11, 31, 'Meio a Meio ou Inteira', '0.00', 'true', 1, '2'),
(43, 17, 34, 'Broto', '10.00', 'null', 0, 'null'),
(44, 17, 35, 'MEIO A MEIO', '0.00', 'true', 1, '2'),
(46, 17, 35, 'Grande', '0.00', 'true', 1, '2'),
(48, 17, 39, 'Médio', '15.00', 'null', 0, 'null'),
(49, 1, 40, 'Mal passada', '0.00', 'null', 0, 'null'),
(50, 1, 40, 'Bem passada', '0.00', 'null', 0, 'null'),
(51, 1, 40, 'Ao ponto', '0.00', 'null', 0, 'null'),
(52, 1, 41, 'Pão com gergelin', '10.00', 'null', 0, 'null'),
(53, 1, 41, 'Pão sem gergelin', '5.00', 'null', 0, 'null'),
(54, 1, 28, 'Pequena', '20.00', 'null', 0, 'null'),
(57, 18, 45, 'AÇAI 300 ML', '8.00', 'null', 0, 'null'),
(58, 18, 45, 'AÇAI 500 ML', '12.00', 'null', 0, 'null'),
(59, 18, 45, 'AÇAI 700 ML', '15.00', 'null', 0, 'null'),
(60, 18, 46, 'pizza grande até 4 sabores', '0.00', 'true', 1, '4'),
(61, 18, 46, 'pizza media até 3 sabores', '0.00', 'true', 1, '3'),
(62, 18, 46, 'pizza pequena até 2 sabores', '0.00', 'true', 1, '2'),
(63, 18, 46, 'meio a meio', '0.00', 'true', 1, '2'),
(64, 20, 47, 'Meio a meio', '0.00', 'true', 1, '2'),
(65, 20, 48, 'Só teste', '5.00', 'null', 0, 'null'),
(66, 20, 48, 'Teste dois', '4.00', 'null', 0, 'null'),
(67, 20, 47, 'Teste dois', '2.00', 'null', 0, 'null'),
(68, 20, 49, 'meio carne meio frango', '0.00', 'true', 1, '2'),
(69, 1, 28, '3 sabores', '0.00', 'true', 1, '3'),
(70, 1, 28, 'promoção 4 sabores', '40.00', 'true', 2, '3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_pedidos`
--

CREATE TABLE `ws_pedidos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `codigo_pedido` varchar(150) NOT NULL,
  `data` datetime NOT NULL,
  `data_chart` varchar(100) NOT NULL,
  `data_chart2` date NOT NULL,
  `resumo_pedidos` longtext NOT NULL,
  `forma_pagamento` varchar(150) NOT NULL,
  `valor_troco` decimal(10,2) NOT NULL,
  `opcao_delivery` varchar(50) NOT NULL,
  `valor_taxa` decimal(10,2) NOT NULL,
  `telefone_empresa` varchar(200) NOT NULL,
  `adicionais` varchar(250) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `telefone` varchar(150) NOT NULL,
  `rua` varchar(250) NOT NULL,
  `unidade` int(11) NOT NULL,
  `bairro` varchar(150) NOT NULL,
  `cidade` varchar(150) NOT NULL,
  `uf` varchar(10) NOT NULL,
  `complemento` varchar(250) NOT NULL,
  `observacao` varchar(250) NOT NULL,
  `name_observacao_mesa` varchar(250) NOT NULL,
  `status` varchar(150) NOT NULL,
  `mes` varchar(5) NOT NULL,
  `ano` varchar(5) NOT NULL,
  `view` int(11) NOT NULL,
  `desconto` int(11) NOT NULL,
  `confirm_whatsapp` varchar(50) NOT NULL,
  `msg_delivery_false` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_pedidos`
--

INSERT INTO `ws_pedidos` (`id`, `user_id`, `codigo_pedido`, `data`, `data_chart`, `data_chart2`, `resumo_pedidos`, `forma_pagamento`, `valor_troco`, `opcao_delivery`, `valor_taxa`, `telefone_empresa`, `adicionais`, `sub_total`, `total`, `nome`, `telefone`, `rua`, `unidade`, `bairro`, `cidade`, `uf`, `complemento`, `observacao`, `name_observacao_mesa`, `status`, `mes`, `ano`, `view`, `desconto`, `confirm_whatsapp`, `msg_delivery_false`) VALUES
(10, 1, 'PED0920-1', '2020-09-26 15:47:12', '2020-09', '2020-09-26', '<b>Qtd:</b> 1x AMOSTRADO<br /><b>Adicionais:</b> chaddar, <br /><b>Valor:</b> R$ 16,00<br /><b>OBS:</b> Não<br /><br /><b>Qtd:</b> 1x Coca Cola<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 4,00<br /><b>OBS:</b> Não<br /><br />', 'Cartão Crédito', '0.00', 'false', '0.00', '79991322619', '3', '20.00', '20.00', 'Jjjteste', '79913226199', '', 0, '', '', '', '*Não informado*', '*Não informado*', '', 'Aberto', '09', '20', 0, 0, 'false', 'Retirada no Balcão'),
(11, 1, 'PED0920-2', '2020-09-26 16:01:16', '2020-09', '2020-09-26', '<b>Qtd:</b> 2x Pizza Presunto<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 55,80<br /><b>OBS:</b> Não<br /><br />', 'Cartão Crédito', '0.00', 'false', '0.00', '79991322619', '0', '55.80', '55.80', 'Alex', '79991322619', '', 0, '', '', '', '*Não informado*', '*Não informado*', '', 'Aberto', '09', '20', 0, 0, 'false', 'Retirada no Balcão'),
(12, 1, 'PED0920-3', '2020-09-26 16:04:17', '2020-09', '2020-09-26', '<b>Qtd:</b> 2x Pizza Presunto<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 55,80<br /><b>OBS:</b> Não<br /><br />', 'Cartão Crédito', '0.00', 'true', '6.00', '79991322619', '0', '55.80', '61.80', 'Alex', '79991322619', 'rua 3', 32, 'Santos Dumont', 'Arapiraca', 'AL', '*Não informado*', '*Não informado*', '', 'Aberto', '09', '20', 0, 0, 'false', ''),
(13, 1, 'PED0920-4', '2020-09-26 16:06:13', '2020-09', '2020-09-26', '<b>Qtd:</b> 2x Pizza Presunto<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 55,80<br /><b>OBS:</b> Não<br /><br />', 'Cartão Crédito', '0.00', 'false', '0.00', '79991322619', '0', '55.80', '55.80', 'Alex', '79991322619', '', 0, '', '', '', '*Não informado*', '*Não informado*', '', 'Aberto', '09', '20', 0, 0, 'false', 'Retirada no Balcão'),
(14, 1, 'PED0920-5', '2020-09-26 16:07:04', '2020-09', '2020-09-26', '<b>Qtd:</b> 1x Ô CABRUNCO<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 8,00<br /><b>OBS:</b> Não<br /><br /><b>Qtd:</b> 2x Coca Cola<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 8,00<br /><b>OBS:</b> Não<br /><br />', 'Cartão Crédito', '0.00', 'false', '0.00', '79991322619', '0', '16.00', '16.00', 'Alex', '79991322619', '', 0, '', '', '', '*Não informado*', '*Não informado*', '', 'Aberto', '09', '20', 0, 0, 'false', 'Retirada no Balcão'),
(15, 1, 'PED0920-6', '2020-09-26 16:08:29', '2020-09', '2020-09-26', '<b>Qtd:</b> 5x AMOSTRADO<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 65,00<br /><b>OBS:</b> Não<br /><br /><b>Qtd:</b> 3x Pizza Média<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 90,00<br /><b>OBS:</b> Não<br /><br /><b>Qtd:</b> 5x Coca Cola<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 20,00<br /><b>OBS:</b> Não<br /><br /><b>Qtd:</b> 15x Pizza 5 Queijos Especiais<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 300,00<br /><b>OBS:</b> Não<br /><br />', 'Cartão Debito', '0.00', 'true', '6.00', '79991322619', '0', '475.00', '481.00', 'Alex', '79991322619', 'rua 3', 32, 'Santos Dumont', 'Arapiraca', 'AL', '*Não informado*', '*Não informado*', '', 'Aberto', '09', '20', 0, 0, 'false', ''),
(16, 1, 'PED1020-1', '2020-10-01 15:52:02', '2020-10', '2020-10-01', '<b>Qtd:</b> 3x CAMPEÃO<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 18,00<br /><b>OBS:</b> Não<br /><br /><b>Qtd:</b> 1x Pizza 5 Queijos Especiais<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 20,00<br /><b>OBS:</b> Não<br /><br />', 'Cartão Crédito', '0.00', 'true', '6.00', '79991322619', '0', '38.00', '44.00', 'Alex', '79991322619', 'rua 3', 32, 'Santos Dumont', 'Arapiraca', 'AL', '*Não informado*', '*Não informado*', '', 'Aberto', '10', '20', 0, 0, 'false', ''),
(17, 1, 'PED1020-2', '2020-10-01 15:53:24', '2020-10', '2020-10-01', '<b>Qtd:</b> 3x AVEXADO<br /><b>Adicionais:</b> Sem Adicionais<br /><b>Valor:</b> R$ 45,00<br /><b>OBS:</b> Não<br /><br />', 'Cartão Debito', '0.00', 'true', '6.00', '79991322619', '0', '45.00', '51.00', 'Alex', '79991322619', 'rua 3', 32, 'Santos Dumont', 'Arapiraca', 'AL', '*Não informado*', '*Não informado*', '', 'Aberto', '10', '20', 0, 0, 'false', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_pedidos_itens`
--

CREATE TABLE `ws_pedidos_itens` (
  `ID_TABELA` int(11) NOT NULL,
  `ID_WS_PEDIDOS` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `CODIGO_PEDIDO` varchar(100) NOT NULL,
  `ID_PRODUTO` int(11) NOT NULL,
  `QTDE` int(11) NOT NULL,
  `VALOR` decimal(10,2) NOT NULL,
  `ADICIONAIS` varchar(250) NOT NULL,
  `OBS` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_pedidos_itens`
--

INSERT INTO `ws_pedidos_itens` (`ID_TABELA`, `ID_WS_PEDIDOS`, `USER_ID`, `CODIGO_PEDIDO`, `ID_PRODUTO`, `QTDE`, `VALOR`, `ADICIONAIS`, `OBS`) VALUES
(20, 16, 1, 'PED1020-1', 100, 3, '18.00', '', 'Não'),
(21, 16, 1, 'PED1020-1', 102, 1, '20.00', '', 'Não'),
(22, 17, 1, 'PED1020-2', 98, 3, '45.00', '', 'Não');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_relacao_tamanho`
--

CREATE TABLE `ws_relacao_tamanho` (
  `id_relacao` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_tamanho` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_relacao_tamanho`
--

INSERT INTO `ws_relacao_tamanho` (`id_relacao`, `id_user`, `id_item`, `id_tipo`, `id_tamanho`) VALUES
(1, 1, 103, 28, '69,54,36,35'),
(2, 1, 120, 41, '53,52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_tipo_produto`
--

CREATE TABLE `ws_tipo_produto` (
  `id_tipo_produto` int(11) NOT NULL,
  `nome_tipo_produto` varchar(250) NOT NULL,
  `user_tipo_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_tipo_produto`
--

INSERT INTO `ws_tipo_produto` (`id_tipo_produto`, `nome_tipo_produto`, `user_tipo_produto`) VALUES
(28, 'Pizza', 1),
(29, 'Sorvetes', 1),
(30, 'Açai', 1),
(31, 'Pizza', 11),
(34, 'Pizza Broto', 17),
(35, 'Meio a meio', 17),
(39, 'Calzone', 17),
(40, 'Ponto da Carne', 1),
(41, 'Tipo de pão', 1),
(45, 'AÇAI', 18),
(46, 'PIZZA', 18),
(47, 'Pizza', 20),
(48, 'Complemento', 20),
(49, 'Super Largo', 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_users`
--

CREATE TABLE `ws_users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_lastname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_cpf` varchar(250) NOT NULL,
  `user_telefone` varchar(250) NOT NULL,
  `user_img_perfil` varchar(250) NOT NULL,
  `user_password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_registration` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_ultimoacesso` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL DEFAULT 1,
  `user_plano` int(1) NOT NULL,
  `user_status` varchar(255) NOT NULL,
  `user_cont` int(11) NOT NULL,
  `user_nome_plano` varchar(300) NOT NULL,
  `user_dias_plano` int(11) NOT NULL,
  `status_assinatura_plano` varchar(300) NOT NULL,
  `codigo_assinante` varchar(60) NOT NULL,
  `user_data_renova` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_users`
--

INSERT INTO `ws_users` (`user_id`, `user_name`, `user_lastname`, `user_email`, `user_cpf`, `user_telefone`, `user_img_perfil`, `user_password`, `user_registration`, `user_ultimoacesso`, `user_level`, `user_plano`, `user_status`, `user_cont`, `user_nome_plano`, `user_dias_plano`, `status_assinatura_plano`, `codigo_assinante`, `user_data_renova`) VALUES
(1, 'Alex', 'Silva', 'alexdasilvalima2110@gmail.com', '217.745.568-55', '(79).9124.6346', 'images/2018/07/cd-img-3.png', '4e57a14e36c079e5db014c0dd1d64e7d', '2014-02-11 13:14:04', ' Último acesso em: 14/10/2020 22:51 IP: ::1 ', 3, 1, '', 0, '', 0, '', '', '0000-00-00'),
(4, 'isabela', 'santos', 'isabelasilvasantos1101@gmail.com', '', '(79) 99132-3022', '', '7a617048de134cc3fe8163dba4610837', '2020-10-15 01:17:06', '', 3, 2, '', 0, '', 0, '', '', '0000-00-00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bairros_delivery`
--
ALTER TABLE `bairros_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `configuracoes_site`
--
ALTER TABLE `configuracoes_site`
  ADD PRIMARY KEY (`id_config`);

--
-- Índices para tabela `cupom_desconto`
--
ALTER TABLE `cupom_desconto`
  ADD PRIMARY KEY (`id_cupom`);

--
-- Índices para tabela `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id_views`);

--
-- Índices para tabela `ws_adicionais_itens`
--
ALTER TABLE `ws_adicionais_itens`
  ADD PRIMARY KEY (`id_adicionais`);

--
-- Índices para tabela `ws_admin`
--
ALTER TABLE `ws_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Índices para tabela `ws_cat`
--
ALTER TABLE `ws_cat`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ws_datas_close`
--
ALTER TABLE `ws_datas_close`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ws_empresa`
--
ALTER TABLE `ws_empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices para tabela `ws_formas_pagamento`
--
ALTER TABLE `ws_formas_pagamento`
  ADD PRIMARY KEY (`id_f_pagamento`);

--
-- Índices para tabela `ws_impressora`
--
ALTER TABLE `ws_impressora`
  ADD PRIMARY KEY (`id_impressora`);

--
-- Índices para tabela `ws_itens`
--
ALTER TABLE `ws_itens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ws_observacoes`
--
ALTER TABLE `ws_observacoes`
  ADD PRIMARY KEY (`id_obs`);

--
-- Índices para tabela `ws_opcoes_itens`
--
ALTER TABLE `ws_opcoes_itens`
  ADD PRIMARY KEY (`id_option`);

--
-- Índices para tabela `ws_pedidos`
--
ALTER TABLE `ws_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ws_pedidos_itens`
--
ALTER TABLE `ws_pedidos_itens`
  ADD PRIMARY KEY (`ID_TABELA`);

--
-- Índices para tabela `ws_relacao_tamanho`
--
ALTER TABLE `ws_relacao_tamanho`
  ADD PRIMARY KEY (`id_relacao`);

--
-- Índices para tabela `ws_tipo_produto`
--
ALTER TABLE `ws_tipo_produto`
  ADD PRIMARY KEY (`id_tipo_produto`);

--
-- Índices para tabela `ws_users`
--
ALTER TABLE `ws_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bairros_delivery`
--
ALTER TABLE `bairros_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `configuracoes_site`
--
ALTER TABLE `configuracoes_site`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cupom_desconto`
--
ALTER TABLE `cupom_desconto`
  MODIFY `id_cupom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `views`
--
ALTER TABLE `views`
  MODIFY `id_views` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `ws_adicionais_itens`
--
ALTER TABLE `ws_adicionais_itens`
  MODIFY `id_adicionais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT de tabela `ws_admin`
--
ALTER TABLE `ws_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ws_cat`
--
ALTER TABLE `ws_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de tabela `ws_datas_close`
--
ALTER TABLE `ws_datas_close`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `ws_empresa`
--
ALTER TABLE `ws_empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `ws_formas_pagamento`
--
ALTER TABLE `ws_formas_pagamento`
  MODIFY `id_f_pagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `ws_impressora`
--
ALTER TABLE `ws_impressora`
  MODIFY `id_impressora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ws_itens`
--
ALTER TABLE `ws_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de tabela `ws_observacoes`
--
ALTER TABLE `ws_observacoes`
  MODIFY `id_obs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ws_opcoes_itens`
--
ALTER TABLE `ws_opcoes_itens`
  MODIFY `id_option` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `ws_pedidos`
--
ALTER TABLE `ws_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `ws_pedidos_itens`
--
ALTER TABLE `ws_pedidos_itens`
  MODIFY `ID_TABELA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `ws_relacao_tamanho`
--
ALTER TABLE `ws_relacao_tamanho`
  MODIFY `id_relacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `ws_tipo_produto`
--
ALTER TABLE `ws_tipo_produto`
  MODIFY `id_tipo_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `ws_users`
--
ALTER TABLE `ws_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
