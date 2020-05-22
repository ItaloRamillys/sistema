-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Maio-2020 às 08:29
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `system`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `activity`
--

CREATE TABLE `activity` (
  `id_activity` int(11) NOT NULL,
  `id_SC` int(11) NOT NULL,
  `title_activity` varchar(30) NOT NULL,
  `desc_activity` text DEFAULT NULL,
  `id_author` int(11) NOT NULL,
  `path_img` varchar(255) DEFAULT NULL,
  `create_at` date NOT NULL,
  `update_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `adjunct_student`
--

CREATE TABLE `adjunct_student` (
  `parent1` varchar(120) DEFAULT NULL,
  `phone_parent_1` varchar(18) DEFAULT NULL,
  `parent2` varchar(120) DEFAULT NULL,
  `phone_parent_2` varchar(18) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `registration` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `adjunct_student`
--

INSERT INTO `adjunct_student` (`parent1`, `phone_parent_1`, `parent2`, `phone_parent_2`, `comments`, `id_user`, `registration`) VALUES
('Jorge Carlas', '9082374895207', 'Paula', '12341423', '', 114, '1232'),
('Geane', '9231', 'Marcos', '234525', '', 200, '34252'),
('RosÃ¢ngela', '', 'Titia Sandra', '988931268', '', 198, '3452'),
('Italo Ramillys', '12344', 'Sandra Maria BenÃ­cio Silva', '141342', '', 196, '6654');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adjunct_teacher`
--

CREATE TABLE `adjunct_teacher` (
  `id_teacher` int(11) NOT NULL,
  `salary` decimal(7,2) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `graduation` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `validate` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `adjunct_teacher`
--

INSERT INTO `adjunct_teacher` (`id_teacher`, `salary`, `id_user`, `graduation`, `description`, `validate`) VALUES
(1, '1500.00', 133, 'FÃ­sica', 'O melhor teacheressor de fÃ­sica da cidade de Pindoretama', '4/maio'),
(2, '3000.00', 190, 'CC', 'O melhor teacheressor de matematica da cidade de Pindoretama', '4'),
(3, '3000.00', 191, 'CC', 'O melhor teacheressor de portugues da cidade de Pindoretama', '4'),
(4, '3000.00', 192, 'CC', 'O melhor teacheressor de quimica da cidade de Pindoretama', '4'),
(5, '3000.00', 195, 'CC', 'O melhor teacheressor de artes da cidade de Pindoretama', '04/maio'),
(419, '1400.00', 8, '', 'O melhor teacheressor de fÃ­sica da cidade de Pindoretama. O FÃ¡bio Ã© formado em MatemÃ¡tica pela UFC e tem mestrado em Teoria dos NÃºmeros pela Universidade de Cambridge.', ''),
(420, '1600.00', 117, '', 'O melhor teacheressor de fÃ­sica da cidade de Pindoretama', ''),
(421, '0.00', 119, '', 'O melhor teacheressor de fÃ­sica da cidade de Pindoretama. Conhecimentos avanÃ§ados em informÃ¡tica e programaÃ§Ã£o. Ele tambÃ©m ajeita bicicleta.', ''),
(422, '0.00', 122, '', 'O melhor teacheressor de fÃ­sica da cidade de Pindoretama', ''),
(423, '0.00', 123, '', 'O melhor teacheressor de fÃ­sica da cidade de Pindoretama', ''),
(427, '1500.00', 274, 'FÃ­sica', 'adff', '04/maio'),
(428, '3500.00', 275, 'FÃ­sica', 'Melhor teacheressora da cidade', '04/maio'),
(429, '0.00', 276, 'faswer', 'qwerqwer', '04/maio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `attendance`
--

CREATE TABLE `attendance` (
  `id_attendance` int(11) NOT NULL,
  `id_SC` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(1) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `attendance`
--

INSERT INTO `attendance` (`id_attendance`, `id_SC`, `id_user`, `date`, `type`, `create_at`) VALUES
(1, 75, 38, '2020-02-06', 'j', '2020-02-04 00:00:00'),
(2, 75, 100, '2020-02-14', 'j', '2020-02-04 00:00:00'),
(3, 75, 102, '2020-02-14', 'f', '2020-02-04 00:00:00'),
(4, 75, 114, '2020-02-14', 'f', '2020-02-04 00:00:00'),
(5, 75, 90, '2020-02-06', 'f', '2020-02-04 00:00:00'),
(6, 75, 91, '2020-02-06', 'j', '2020-02-04 00:00:00'),
(8, 75, 102, '2020-02-06', 'j', '2020-02-04 00:00:00'),
(9, 75, 102, '2020-02-05', 'j', '2020-02-04 00:00:00'),
(12, 75, 113, '2020-02-06', 'f', '2020-02-04 00:00:00'),
(16, 75, 38, '2020-03-13', 'f', '2020-02-04 17:40:00'),
(17, 75, 113, '2020-02-13', 'f', '2020-02-04 17:40:00'),
(24, 89, 38, '2020-02-07', 'f', '2020-02-05 12:07:50'),
(27, 84, 90, '2020-02-21', 'j', '2020-02-05 12:08:34'),
(28, 75, 38, '2020-02-19', 'f', '2020-02-09 19:45:15'),
(29, 75, 100, '2020-02-19', 'j', '2020-02-09 19:45:15'),
(32, 91, 3, '2020-02-03', 'f', '2020-02-09 20:08:48'),
(33, 91, 98, '2020-02-03', 'f', '2020-02-09 20:08:48'),
(34, 92, 98, '2020-02-05', 'f', '2020-02-09 20:15:01'),
(35, 92, 198, '2020-02-05', 'j', '2020-02-09 20:15:01'),
(36, 91, 198, '2020-02-24', 'f', '2020-02-13 18:02:01'),
(37, 91, 3, '2020-02-24', 'f', '2020-02-13 18:03:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `class`
--

CREATE TABLE `class` (
  `id_class` int(11) NOT NULL,
  `name_class` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `class`
--

INSERT INTO `class` (`id_class`, `name_class`) VALUES
(11, '1A'),
(21, '1B'),
(14, '1F'),
(25, '2E'),
(15, '3F'),
(16, '4D'),
(27, '5C'),
(7, '6B'),
(9, '6D'),
(4, '7C'),
(1, '8A'),
(19, '9A'),
(24, '9D');

-- --------------------------------------------------------

--
-- Estrutura da tabela `class_student`
--

CREATE TABLE `class_student` (
  `id_TA` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `turno` varchar(1) DEFAULT NULL,
  `ano` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `class_student`
--

INSERT INTO `class_student` (`id_TA`, `id_student`, `id_class`, `turno`, `ano`) VALUES
(47, 38, 11, NULL, 2020),
(48, 100, 11, NULL, 2020),
(49, 102, 11, NULL, 2020),
(50, 113, 11, NULL, 2020),
(51, 114, 11, NULL, 2020),
(52, 90, 25, NULL, 2020),
(53, 91, 25, NULL, 2020),
(54, 104, 21, NULL, 2020),
(55, 196, 21, NULL, 2020),
(56, 3, 27, NULL, 2020),
(57, 98, 27, NULL, 2020),
(58, 198, 27, NULL, 2020),
(59, 5, 15, NULL, 2020),
(60, 200, 15, NULL, 2020);

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE `config` (
  `title_site` varchar(25) NOT NULL,
  `img_school` varchar(200) NOT NULL,
  `img_featured_1` text NOT NULL,
  `img_featured_2` text NOT NULL,
  `img_featured_3` text NOT NULL,
  `desc_school` varchar(3000) NOT NULL,
  `phone_school` varchar(500) NOT NULL,
  `img_local` text NOT NULL,
  `txt_img_1` varchar(400) NOT NULL,
  `txt_img_2` varchar(400) NOT NULL,
  `txt_img_3` varchar(400) NOT NULL,
  `id_config` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`title_site`, `img_school`, `img_featured_1`, `img_featured_2`, `img_featured_3`, `desc_school`, `phone_school`, `img_local`, `txt_img_1`, `txt_img_2`, `txt_img_3`, `id_config`) VALUES
('Escola XPTO', 'sistema/teacher.jpg', 'sistema/recreacao.png', 'sistema/festa.jpg', 'sistema/back_index.jpg', 'A Escola XPTO foi considerada a melhor da regiÃ£o.\nAmplo espaÃ§o para as crianÃ§as, biblioteca, praÃ§a de alimentaÃ§Ã£o, salas de leitura e informÃ¡tica.\nTemos excelentes teacherissionais que darÃ£o todo o suporte aos subjectentes.\nVenha conhecer nossa escola.\nTemos aulas de inglÃªs e espanhol para students a partir do quinto ano.', 'Telefone: 999999999\nEmail: manoeldias@gmail.com', '', 'RecreaÃ§Ã£o todo mÃªs para que seu filho aprenda brincando', 'Saiba tudo da escola XPTO pelo seu smartphone. Agora estamos ONLINE ;)', 'Entrega dos materiais escolares de 2020', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grade`
--

CREATE TABLE `grade` (
  `id_grade` int(11) NOT NULL,
  `id_SC` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `period` int(1) NOT NULL,
  `value_grade` decimal(4,2) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grade`
--

INSERT INTO `grade` (`id_grade`, `id_SC`, `id_student`, `period`, `value_grade`, `create_at`) VALUES
(2, 75, 195, 1, '4.00', '2020-02-11 09:58:28'),
(3, 75, 38, 1, '7.00', '2020-02-11 10:04:34'),
(4, 75, 100, 1, '6.00', '2020-02-11 10:04:34'),
(5, 75, 102, 1, '8.00', '2020-02-11 10:04:34'),
(6, 75, 113, 1, '9.00', '2020-02-11 10:04:34'),
(7, 75, 114, 1, '0.00', '2020-02-11 10:04:34'),
(8, 92, 3, 1, '7.50', '2020-02-12 20:29:37'),
(9, 92, 98, 1, '6.00', '2020-02-12 20:29:37'),
(10, 92, 198, 1, '9.00', '2020-02-12 20:29:37'),
(11, 92, 198, 2, '7.00', '2020-02-13 09:31:05'),
(12, 92, 198, 3, '5.00', '2020-02-13 10:06:20'),
(13, 92, 198, 4, '6.00', '2020-02-13 10:06:20'),
(15, 92, 198, 5, '8.00', '2020-02-13 17:55:50'),
(16, 93, 5, 1, '7.00', '2020-04-03 19:41:18'),
(17, 93, 200, 1, '9.00', '2020-04-03 19:41:18'),
(18, 91, 3, 1, '7.00', '2020-04-03 19:42:35'),
(19, 91, 98, 1, '9.00', '2020-04-03 19:42:35'),
(20, 91, 198, 1, '7.00', '2020-04-03 19:42:35'),
(21, 91, 3, 2, '7.00', '2020-04-03 19:42:47'),
(22, 91, 98, 2, '7.00', '2020-04-03 19:42:47'),
(23, 91, 198, 2, '7.00', '2020-04-03 19:42:47'),
(24, 91, 3, 3, '8.00', '2020-04-03 19:42:59'),
(25, 91, 98, 3, '8.00', '2020-04-03 19:42:59'),
(26, 91, 198, 3, '9.00', '2020-04-03 19:42:59'),
(27, 91, 3, 4, '6.00', '2020-04-03 19:43:14'),
(28, 91, 98, 4, '3.00', '2020-04-03 19:43:14'),
(29, 91, 198, 4, '4.00', '2020-04-03 19:43:14'),
(35, 75, 38, 3, '6.00', '2020-04-10 12:02:10'),
(36, 75, 100, 3, '5.00', '2020-04-10 12:02:11'),
(37, 75, 102, 3, '4.00', '2020-04-10 12:02:11'),
(38, 75, 113, 3, '6.00', '2020-04-10 12:02:11'),
(39, 75, 114, 3, '7.00', '2020-04-10 12:02:11'),
(2, 75, 195, 1, '4.00', '2020-02-11 09:58:28'),
(3, 75, 38, 1, '7.00', '2020-02-11 10:04:34'),
(4, 75, 100, 1, '6.00', '2020-02-11 10:04:34'),
(5, 75, 102, 1, '8.00', '2020-02-11 10:04:34'),
(6, 75, 113, 1, '9.00', '2020-02-11 10:04:34'),
(7, 75, 114, 1, '0.00', '2020-02-11 10:04:34'),
(8, 92, 3, 1, '7.50', '2020-02-12 20:29:37'),
(9, 92, 98, 1, '6.00', '2020-02-12 20:29:37'),
(10, 92, 198, 1, '9.00', '2020-02-12 20:29:37'),
(11, 92, 198, 2, '7.00', '2020-02-13 09:31:05'),
(12, 92, 198, 3, '5.00', '2020-02-13 10:06:20'),
(13, 92, 198, 4, '6.00', '2020-02-13 10:06:20'),
(15, 92, 198, 5, '8.00', '2020-02-13 17:55:50'),
(16, 93, 5, 1, '7.00', '2020-04-03 19:41:18'),
(17, 93, 200, 1, '9.00', '2020-04-03 19:41:18'),
(18, 91, 3, 1, '7.00', '2020-04-03 19:42:35'),
(19, 91, 98, 1, '9.00', '2020-04-03 19:42:35'),
(20, 91, 198, 1, '7.00', '2020-04-03 19:42:35'),
(21, 91, 3, 2, '7.00', '2020-04-03 19:42:47'),
(22, 91, 98, 2, '7.00', '2020-04-03 19:42:47'),
(23, 91, 198, 2, '7.00', '2020-04-03 19:42:47'),
(24, 91, 3, 3, '8.00', '2020-04-03 19:42:59'),
(25, 91, 98, 3, '8.00', '2020-04-03 19:42:59'),
(26, 91, 198, 3, '9.00', '2020-04-03 19:42:59'),
(27, 91, 3, 4, '6.00', '2020-04-03 19:43:14'),
(28, 91, 98, 4, '3.00', '2020-04-03 19:43:14'),
(29, 91, 198, 4, '4.00', '2020-04-03 19:43:14'),
(35, 75, 38, 3, '6.00', '2020-04-10 12:02:10'),
(36, 75, 100, 3, '5.00', '2020-04-10 12:02:11'),
(37, 75, 102, 3, '4.00', '2020-04-10 12:02:11'),
(38, 75, 113, 3, '6.00', '2020-04-10 12:02:11'),
(39, 75, 114, 3, '7.00', '2020-04-10 12:02:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grades_aux`
--

CREATE TABLE `grades_aux` (
  `grade` decimal(4,2) NOT NULL,
  `id_student_class` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `motivo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `news`
--

CREATE TABLE `news` (
  `id_news` int(11) NOT NULL,
  `title_news` varchar(30) NOT NULL,
  `desc_news` text NOT NULL,
  `id_author` int(11) NOT NULL,
  `path_img` varchar(255) DEFAULT NULL,
  `create_at` varchar(19) NOT NULL,
  `update_at` varchar(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `news`
--

INSERT INTO `news` (`id_news`, `title_news`, `desc_news`, `id_author`, `path_img`, `create_at`, `update_at`) VALUES
(4, 'DanÃ§as Estrangeira', '        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', 2, 'noticia/2020/04/school.jpg', '15/12/2019', '06/01/2020'),
(5, 'DanÃ§as Estrangeira', '  Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', 2, 'noticia/2020/04/school.jpg', '15/12/2019', '06/01/2020'),
(6, 'Semana EcolÃ³gica 2021', '  Venha participar conosco deste grande evento', 2, 'noticia/2020/04/school.jpg', '15/12/2019', '06/01/2020'),
(8, 'Folclore', '  Venha participar do nosso folclore Ã s 17h. Venha participar do nosso folclore Ã s 17h. Venha participar do nosso folclore Ã s 17h. Venha participar do nosso folclore Ã s 17h.', 2, 'noticia/2020/04/school.jpg', '15/12/2019', '06/01/2020'),
(9, 'Entrega de Notebooks', 'Venha participar da entrega de notebooks referentes ao rendimento escolar de 2018. Pais, familiares e amigos serÃ£o bem vindos.', 6, 'noticia/2020/04/school.jpg', '20/12/2019', '20/12/2019'),
(11, 'Gincana Esportiva 2020', '   Toda a escola irÃ¡ participar de uma gincana que trarÃ¡ os jogos OlÃ­mpicos como foco das brincadeiras.', 2, 'noticia/2020/04/school.jpg', '25/12/2019', '06/01/2020'),
(12, 'Volta Ã s aulas', 'A escola XPTO vem por meio deste comunicado anunciar a volta Ã s aulas no dia 27/01/2020', 1, 'noticia/2020/04/school.jpg', '02/01/2020', '02/01/2020'),
(13, 'Folclore', ' Venha participar do nosso folclore Ã s 17h. Venha participar do nosso folclore Ã s 17h. Venha participar do nosso folclore Ã s 17h. Venha participar do nosso folclore Ã s 17h.', 1, 'noticia/2020/04/school.jpg', '06/01/2020', '06/01/2020'),
(14, 'Matriculas Aberta', 'Venha matricular seu filho em nossa escola.', 1, 'noticia/2020/04/school.jpg', '12/02/2020', '12/02/2020'),
(15, 'Escola XPTO', 'sa', 1, 'noticia/2020/04/school.jpg', '27/03/2020', '27/03/2020'),
(16, 'Escola Manoel Dias', 'Aulas aos sabados', 1, 'noticia/2020/04/school.jpg', '27/03/2020', '27/03/2020');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subject`
--

CREATE TABLE `subject` (
  `id_subject` int(11) NOT NULL,
  `cod_subject` varchar(8) NOT NULL,
  `name_subject` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `subject`
--

INSERT INTO `subject` (`id_subject`, `cod_subject`, `name_subject`) VALUES
(1, 'CK-3422', 'Matematica 1'),
(3, 'CK-3423', 'Matematica 2'),
(4, 'CK-0901', 'InformÃ¡tica'),
(5, 'MK-4555', 'Biologia'),
(6, 'CK-3421', 'PortuguÃªs'),
(7, 'MT-9909', 'Quimica'),
(10, 'MT-9888', 'Fisica'),
(12, 'MT-9910', 'Fisica 2'),
(13, 'CK-3428', 'LÃ³gica'),
(110, 'CK-3456', 'Matematica'),
(139, 'MP-8736', 'SGBD'),
(141, 'CK-3233', 'InformÃ¡tica e Sociedade'),
(142, 'TG-7849', 'Arquitetura de Computadores'),
(144, 'CK-3444', 'Ed. FÃ­sica'),
(145, 'CK-3556', 'Filosofia'),
(146, 'CK-3789', 'Musica'),
(147, 'CK-3477', 'Matematica subjectreta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subject_class`
--

CREATE TABLE `subject_class` (
  `id_SC` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `day_of_week` varchar(3) NOT NULL,
  `hour` varchar(13) NOT NULL,
  `year` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `subject_class`
--

INSERT INTO `subject_class` (`id_SC`, `id_class`, `id_subject`, `id_teacher`, `day_of_week`, `hour`, `year`, `status`) VALUES
(75, 11, 4, 133, '2', '11:00 - 12:00', 2020, 1),
(82, 21, 5, 190, '2', '07:00 - 08:00', 2020, 1),
(83, 21, 7, 195, '3', '08:00 - 09:00', 2020, 1),
(84, 25, 1, 133, '2', '07:00 - 08:00', 2020, 1),
(86, 11, 7, 191, '2', '09:00 - 10:00', 2020, 1),
(88, 25, 7, 195, '2', '10:00 - 11:00', 2020, 1),
(89, 11, 6, 133, '4', '07:00 - 08:00', 2020, 1),
(91, 27, 4, 8, '2', '13:00 - 14:00', 2020, 1),
(92, 27, 6, 191, '4', '16:00 - 17:00', 2020, 1),
(93, 15, 12, 119, '2', '07:00 - 08:00', 2020, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `login` varchar(16) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `birth` varchar(10) NOT NULL,
  `blood` varchar(3) DEFAULT NULL,
  `genre` varchar(1) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `address` varchar(255) NOT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp(),
  `update_at` date DEFAULT NULL,
  `type` int(11) NOT NULL,
  `img_profile` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `last_name`, `login`, `pass`, `email`, `birth`, `blood`, `genre`, `rg`, `cpf`, `address`, `create_at`, `update_at`, `type`, `img_profile`, `status`) VALUES
(1, 'Italo Ramillys', 'Benicio Silva', 'ita', '123', 'italoramillys@gmail.com', '12/04/1999', 'A+', 'M', '1342423452', '0634599902', 'Pindoretama - Centro - Rua Padre Edilson Silva 776', '2020-02-01', '0000-00-00', 2, 'user/eu.jpg', 1),
(3, 'Marcos', 'da Silva', 'marcos', '123', 'italoramillys@gmail.com', '12/04/1999', 'O+', 'M', '13424', '234524352', 'Pindoretama - Sitio RIbeiro', '2020-01-19', '0000-00-00', 0, 'user/avatar6.png', 0),
(5, 'Cesar', 'Ramillys', 'csa', '123', 'italoramillys@gmail.com', '12/04/1999', '', '', '13424', '', '', '2020-02-01', '0000-00-00', 0, 'user/icon-teacherile.png', 1),
(8, 'Fabio Demetrio', 'Souza Carvalho', 'fabim', '123', 'fabim@gmail.com', '04/12/199', 'A+', 'm', '1234124', '23452', '', '2020-02-01', '0000-00-00', 1, 'user/einstein.jpg', 1),
(38, 'Ester Lopes', 'Silva', 'ester', '123', 'ester@gmail.com', '12/04/1999', '', '', '524352435', '4325423523', '', '2020-02-01', '0000-00-00', 0, 'user/FLA.jpg', 1),
(90, 'Marina', 'Alvez', 'marina', 'alvez', 'mairnaalves@gmail.com', '1999-08-0', '', '', '1234123414', '34142132', '', '2020-01-24', '0000-00-00', 0, 'user/FLA.jpg', 0),
(91, 'Carlos', 'Pedro', 'carlosP', '123', 'carlospedro@gmail.com', '1998-01-2', '', '', '12431234', '34443', '', '2020-01-25', '0000-00-00', 0, 'user/img-teacherile-default.jpg', 1),
(98, 'Julie', 'Ana', 'julie', '123', 'julie@gmail.com', '2019-12-1', 'b+', 'F', '13424', '134124', '', '2020-02-01', '0000-00-00', 0, 'user/festa.jpg', 0),
(100, 'Luana Albuquerque', 'Sousa', 'luana', '123', 'luana@gmail.com', '2003-09-0', '', '', '111344', '312444', '', '2020-02-01', '0000-00-00', 0, 'user/img-teacherile-default.jpg', 1),
(102, 'Pedro', 'Paulo', 'pedropaulo', '123', 'pedropaulo@gmail.com', '12/04/1999', '', '', '213421', '3412', '', '2020-02-02', '0000-00-00', 0, 'user/FLA.jpg', 1),
(104, 'Pedro', 'Paulo', 'pedroppaa', '123', 'pedropaulo@gmail.com', '12/04/1999', '', '', '213421', '3412', '', '2020-02-02', '0000-00-00', 0, 'user/notebook.jpg', 1),
(113, 'ZezÃ©', 'di Camargo', 'zeze', '123', 'zeze@gmail.com', '12/04/1999', '', '', '234523451', '23454523', 'Aquiraz - Caracara - Rua A - 881', '2020-02-03', '0000-00-00', 0, 'user/img-teacherile-default.jpg', 1),
(114, 'Luciano', 'Camargo', 'luciano', '123', 'luciano@gmail.com', '12/04/1999', 'a-', 'm', '89734529', '82641', 'Cascavel - MultirÃ£o - Rua 10 - 8999', '2020-02-04', '0000-00-00', 0, 'user/FLA.jpg', 1),
(117, 'Patricia', 'Souza', 'paty', '123', 'patricia_souza@gmail.com', '08/09/1998', 'A+', 'F', '78123461', '7182436187', 'Pindoretama - Centro', '2020-02-05', '0000-00-00', 1, 'user/avatar6.png', 1),
(119, 'Raimundo Vieira', 'da Silva', 'raibike', '123', 'raimundobike10@gmail.com', '17/02/1967', 'a+', 'm', '768123418', '876481724', 'Pindoretama - Centro', '2020-02-06', '0000-00-00', 1, 'user/einstein.jpg', 1),
(121, 'Raimundo', 'Vieira', 'rai10', '123', 'raimundobike10@gmail.com', '1967-02-17', 'a+', 'm', '82345239', '723528', 'Pindoretama - centro', '2020-02-06', '0000-00-00', 2, 'user/ciencia.jpg', 1),
(122, 'Paulo', 'Eduardo', 'paulo', '123', 'pauloedu@gmail.com', '05/12/1987', 'a+', 'M', '82903345', '894325', 'Pindoretama - Centro', '2020-02-07', '0000-00-00', 1, 'user/avatar6.png', 1),
(123, 'Guga', 'Silva', 'guga', '123', 'guga@gmail.com', '08/09/1991', 'a+', 'M', '8723534', '8923572', 'Cascavel - Centro', '2020-02-07', '0000-00-00', 1, 'user/einstein.jpg', 1),
(133, 'Albert', 'Dutra', 'albert', '123', 'dutra@gmail.com', '01/12/1999', 'A+', 'M', '8702935', '98723587', 'Fortaleza - Pici', '2020-02-07', '0000-00-00', 1, 'user/einstein.jpg', 1),
(190, 'Icaro', 'Lopes', 'icaro', '123', 'icaro@gmail.com', '09/12/1999', 'A+', 'm', '87235', '897235', 'Fortaleza - SC', '2020-02-07', '0000-00-00', 1, 'user/back-phone.jpg', 1),
(191, 'Lavinia', 'Lopes', 'lavinia', '123', 'ivina@gmail.com', '09/12/1999', 'A+', 'm', '87235', '897235', 'Fortaleza - SC', '2020-02-07', '0000-00-00', 1, 'user/back-phone.jpg', 1),
(192, 'Malu', 'Lopes', 'malu', '123', 'ivina@gmail.com', '09/12/1999', 'A+', 'm', '87235', '897235', 'Fortaleza - SC', '2020-02-08', '0000-00-00', 1, 'user/back-phone.jpg', 1),
(195, 'Paulim', 'Lopes', 'paulis', '123', 'ivina@gmail.com', '09/12/1999', 'A+', 'm', '87235', '897235', 'Fortaleza - SC', '2020-02-08', '0000-00-00', 1, 'user/back-phone.jpg', 1),
(196, 'Quincas', 'Silva', 'quincas', '123', 'quincas@gmail.com', '09/09/1999', 'a+', 'm', '98253458', '8327', 'Centro - cascavel', '2020-02-08', '0000-00-00', 0, 'user/ambiente.jpg', 1),
(198, 'Luamyr', 'Rodrigues de Oliveira', 'luamyr', '123', 'luamyr@gmail.com', '30/10/2009', 'a+', 'f', '', '', 'Pindoretama - JosÃ© Franco', '2020-02-09', '0000-00-00', 0, 'user/2020/04/lulu.jpg', 1),
(200, 'Lidi', 'Souza', 'lidi', '123', 'lidi@gmail.com', '05/09/2000', 'a+', 'f', '872345', '8923745', 'Mangueiral', '0000-00-00', '0000-00-00', 0, 'user/img_5bc05ef323258.png', 1),
(274, 'Italo', 'Ramillys', 'Italo Ram', 'aaa', 'italoramillys@gmail.com', '01/12/1999', 'o+', 'M', '13424', '134124', 'Pindoretama', '2020-03-25', NULL, 1, 'user/ambiente.jpg', 1),
(275, 'Sandra Maria', 'Silva', 'sandrab', '123', 'sandra@gmail.com', '16/11/1966', 'a-', 'f', '1241327', '8324187', 'Pindoretama', '2020-03-26', NULL, 1, 'user/avatar6.png', 1),
(276, 'Italo', 'Ramillys', 'sasdad', '123', 'italoreeamillys@gmail.com', '01/12/1999', 'O+', 'M', '123412', '134134', 'Pindoretama', '2020-04-05', NULL, 1, 'user/school.jpg', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`),
  ADD UNIQUE KEY `name_class` (`name_class`);

--
-- Índices para tabela `class_student`
--
ALTER TABLE `class_student`
  ADD PRIMARY KEY (`id_TA`),
  ADD UNIQUE KEY `id_student` (`id_student`,`ano`);

--
-- Índices para tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id_config`);

--
-- Índices para tabela `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id_subject`),
  ADD UNIQUE KEY `cod_subject` (`cod_subject`);

--
-- Índices para tabela `subject_class`
--
ALTER TABLE `subject_class`
  ADD PRIMARY KEY (`id_SC`),
  ADD UNIQUE KEY `uq_day_of_week` (`day_of_week`,`hour`,`year`,`id_class`) USING BTREE,
  ADD UNIQUE KEY `uq_subject_class` (`id_class`,`id_subject`),
  ADD KEY `fk_subject` (`id_subject`),
  ADD KEY `fk_teacher` (`id_teacher`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_nickname` (`login`) USING BTREE;

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `class`
--
ALTER TABLE `class`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `subject`
--
ALTER TABLE `subject`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT de tabela `subject_class`
--
ALTER TABLE `subject_class`
  MODIFY `id_SC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
