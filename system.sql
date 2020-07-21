-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Jul-2020 às 01:24
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `id_SC_activity` int(11) NOT NULL,
  `title_activity` varchar(30) NOT NULL,
  `desc_activity` text DEFAULT NULL,
  `id_author_activity` int(11) NOT NULL,
  `file_activity` varchar(255) DEFAULT NULL,
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
  `name_class` varchar(30) NOT NULL,
  `room` text DEFAULT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `class`
--

INSERT INTO `class` (`id_class`, `name_class`, `room`, `year`) VALUES
(1, '8A', NULL, 2020),
(4, '7C', NULL, 2020),
(7, '6B', NULL, 2020),
(9, '6D', NULL, 2020),
(11, '1A', NULL, 2020),
(14, '1F', NULL, 2020),
(15, '3F', NULL, 2020),
(16, '4D', NULL, 2020),
(19, '9A', NULL, 2020),
(21, '1B', NULL, 2020),
(24, '9D', NULL, 2020),
(25, '2E', NULL, 2020),
(27, '5C', NULL, 2020),
(29, '6N', '13', 2020);

-- --------------------------------------------------------

--
-- Estrutura da tabela `class_student`
--

CREATE TABLE `class_student` (
  `id_TA` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `turno` varchar(1) DEFAULT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `class_student`
--

INSERT INTO `class_student` (`id_TA`, `id_student`, `id_class`, `turno`, `year`) VALUES
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
  `title_site` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `img_school` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `img_featured_1` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `img_featured_2` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `img_featured_3` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `desc_school` varchar(3000) COLLATE utf8_unicode_ci NOT NULL,
  `phone_school_1` text COLLATE utf8_unicode_ci NOT NULL,
  `phone_school_2` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_school_3` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_local` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_img_1` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `txt_img_2` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `txt_img_3` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `id_config` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`title_site`, `img_school`, `img_featured_1`, `img_featured_2`, `img_featured_3`, `desc_school`, `phone_school_1`, `phone_school_2`, `phone_school_3`, `img_local`, `txt_img_1`, `txt_img_2`, `txt_img_3`, `id_config`) VALUES
('Escola XPTO', 'sistema/teacher.jpg', 'sistema/recreacao.png', 'sistema/festa.jpg', 'sistema/back_index.jpg', 'A escola XPTO foi eleita a melhor escola da cidade em 2020 e por isso estamos fazendo um super desconto na matrícula do filho em 2021. Venha conferir.', '85988309552', '85988309552', '85988309552', '', 'Recreação todo mês para que seu filho aprenda brincando', 'Saiba tudo da escola XPTO pelo seu smartphone. Agora estamos ONLINE ;)', 'Entrega dos materiais escolares de 2020', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `config_school`
--

CREATE TABLE `config_school` (
  `start_time_lesson` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time_lesson` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `avg_grade` float DEFAULT NULL,
  `max_missing` int(11) DEFAULT NULL,
  `missing_allowance` int(11) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_adm_insert` int(11) NOT NULL,
  `id_adm_update` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `config_school`
--

INSERT INTO `config_school` (`start_time_lesson`, `end_time_lesson`, `avg_grade`, `max_missing`, `missing_allowance`, `create_at`, `update_at`, `id_adm_insert`, `id_adm_update`) VALUES
('07:00/08:00/09:00', '07:50/08:50/09:50', 7, 20, 10, '2020-07-10 20:08:19', '2020-07-10 20:23:29', 1, 1);

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
  `slug_news` text NOT NULL,
  `desc_news` text NOT NULL,
  `id_author` int(11) NOT NULL,
  `img_news` varchar(255) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `news`
--

INSERT INTO `news` (`id_news`, `title_news`, `slug_news`, `desc_news`, `id_author`, `img_news`, `create_at`, `update_at`) VALUES
(15, 'Feira de Ciencias 2', 'feira-de-ciencias-2', 'Lorem ipsum    raiestar                                                                                                                                                                  ', 1, 'noticia/2020/07/linear-20200708234421-6fc57ce7.jpg', '2020-01-08 17:37:56', '2020-07-10 16:21:39'),
(16, 'Feira de Ciencias 2', 'feira-de-ciencias-2', '$err = implode(\"\", $stmt->errorInfo());', 1, 'noticia/2020/07/linear.jpg', '2020-07-08 17:37:56', NULL),
(17, 'Feira de Ciencias 3', 'feira-de-ciencias-3', '$err = implode(\"\", $stmt->errorInfo());', 1, 'noticia/2020/07/fiado-20200708223756-e69cebc2.jpg', '2020-07-08 17:37:56', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `recurrence_lesson`
--

CREATE TABLE `recurrence_lesson` (
  `id_rec_lesson` int(11) NOT NULL,
  `id_subject_class` int(11) NOT NULL,
  `day_of_week` int(11) NOT NULL,
  `start_time_lesson` time NOT NULL,
  `end_time_lesson` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `recurrence_lesson`
--

INSERT INTO `recurrence_lesson` (`id_rec_lesson`, `id_subject_class`, `day_of_week`, `start_time_lesson`, `end_time_lesson`) VALUES
(1, 83, 2, '07:00:00', '07:50:00'),
(2, 84, 2, '07:00:00', '07:50:00'),
(3, 75, 2, '07:00:00', '07:50:00'),
(4, 75, 1, '07:00:00', '07:50:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subject`
--

CREATE TABLE `subject` (
  `id_subject` int(11) NOT NULL,
  `code_subject` varchar(8) NOT NULL,
  `name_subject` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `subject`
--

INSERT INTO `subject` (`id_subject`, `code_subject`, `name_subject`) VALUES
(1, 'CK-3422', 'Matematica 1'),
(3, 'CK-3423', 'Matematica 2'),
(4, 'CK-0901', 'Informática'),
(5, 'MK-4555', 'Biologia 2'),
(6, 'CK-3421', 'Português'),
(7, 'MT-9909', 'Quimica'),
(10, 'MT-9888', 'Fisica'),
(12, 'MT-9910', 'Fisica 2'),
(13, 'CK-3428', 'Lógica'),
(110, 'CK-3456', 'Matematica'),
(139, 'MP-8736', 'SGBD'),
(141, 'CK-3233', 'Informática e Sociedade'),
(142, 'TG-7849', 'Arquitetura de Computadores'),
(144, 'CK-3444', 'Ed. Física'),
(145, 'CK-3556', 'Filosofia'),
(146, 'CK-3789', 'Musica'),
(147, 'CK-3477', 'Matematica subjectreta'),
(190, 'MH-2980', 'Finanças'),
(192, 'MH-2981', 'Gastronomia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subject_class`
--

CREATE TABLE `subject_class` (
  `id_SC` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `subject_class`
--

INSERT INTO `subject_class` (`id_SC`, `id_class`, `id_subject`, `id_teacher`, `year`, `status`) VALUES
(94, 1, 1, 133, 2020, 1);

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
  `document` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `img_profile` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `id_author_insert` int(11) NOT NULL,
  `id_author_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `last_name`, `login`, `pass`, `email`, `birth`, `blood`, `genre`, `rg`, `document`, `address`, `img_profile`, `type`, `status`, `create_at`, `update_at`, `id_author_insert`, `id_author_update`) VALUES
(1, 'Italo Ramillys', 'Benicio Silva', 'ita', '123', 'italoramillys@gmail.com', '12/04/1999', 'A+', 'M', '1342423452', '0634599902', 'Pindoretama - Centro - Rua Padre Edilson Silva 776', 'usuario/2020/06/eu.jpg', 2, 1, '2020-02-01 00:00:00', '0000-00-00 00:00:00', 1, 1),
(3, 'Marcos', 'da Silva', 'marcos', '123', 'italoramillys@gmail.com', '12/04/1999', 'O+', 'M', '13424', '234524352', 'Pindoretama - Sitio RIbeiro', 'user/avatar6.png', 0, 0, '2020-01-19 00:00:00', '0000-00-00 00:00:00', 1, 1),
(5, 'Cesar', 'Ramillys', 'csa', '123', 'italoramillys@gmail.com', '12/04/1999', '', '', '13424', '', '', 'user/icon-teacherile.png', 0, 1, '2020-02-01 00:00:00', '0000-00-00 00:00:00', 1, 1),
(8, 'Fabio Demetrio', 'Souza Carvalho', 'fabim', '123', 'fabim@gmail.com', '04/12/199', 'A+', 'm', '1234124', '23452', '', 'user/einstein.jpg', 1, 1, '2020-02-01 00:00:00', '0000-00-00 00:00:00', 1, 1),
(38, 'Ester Lopes', 'Silva', 'ester', '123', 'ester@gmail.com', '12/04/1999', '', '', '524352435', '4325423523', '', 'user/FLA.jpg', 0, 1, '2020-02-01 00:00:00', '0000-00-00 00:00:00', 1, 1),
(90, 'Marina', 'Alvez', 'marina', 'alvez', 'mairnaalves@gmail.com', '1999-08-0', '', '', '1234123414', '34142132', '', 'user/FLA.jpg', 0, 0, '2020-01-24 00:00:00', '0000-00-00 00:00:00', 1, 1),
(91, 'Carlos', 'Pedro', 'carlosP', '123', 'carlospedro@gmail.com', '1998-01-2', '', '', '12431234', '34443', '', 'user/img-teacherile-default.jpg', 0, 1, '2020-01-25 00:00:00', '0000-00-00 00:00:00', 1, 1),
(98, 'Julie', 'Ana', 'julie', '123', 'julie@gmail.com', '2019-12-1', 'b+', 'F', '13424', '134124', '', 'user/festa.jpg', 0, 0, '2020-02-01 00:00:00', '0000-00-00 00:00:00', 1, 1),
(100, 'Luana Albuquerque', 'Sousa', 'luana', '123', 'luana@gmail.com', '2003-09-0', '', '', '111344', '312444', '', 'user/img-teacherile-default.jpg', 0, 1, '2020-02-01 00:00:00', '0000-00-00 00:00:00', 1, 1),
(102, 'Pedro', 'Paulo', 'pedropaulo', '123', 'pedropaulo@gmail.com', '12/04/1999', '', '', '213421', '3412', '', 'user/FLA.jpg', 0, 1, '2020-02-02 00:00:00', '0000-00-00 00:00:00', 1, 1),
(104, 'Pedro', 'Paulo', 'pedroppaa', '123', 'pedropaulo@gmail.com', '12/04/1999', '', '', '213421', '3412', '', 'user/notebook.jpg', 0, 1, '2020-02-02 00:00:00', '0000-00-00 00:00:00', 1, 1),
(113, 'ZezÃ©', 'di Camargo', 'zeze', '123', 'zeze@gmail.com', '12/04/1999', '', '', '234523451', '23454523', 'Aquiraz - Caracara - Rua A - 881', 'user/img-teacherile-default.jpg', 0, 1, '2020-02-03 00:00:00', '0000-00-00 00:00:00', 1, 1),
(114, 'Luciano', 'Camargo', 'luciano', '123', 'luciano@gmail.com', '12/04/1999', 'a-', 'm', '89734529', '82641', 'Cascavel - MultirÃ£o - Rua 10 - 8999', 'user/FLA.jpg', 0, 1, '2020-02-04 00:00:00', '0000-00-00 00:00:00', 1, 1),
(117, 'Patricia', 'Souza', 'paty', '123', 'patricia_souza@gmail.com', '08/09/1998', 'A+', 'F', '78123461', '7182436187', 'Pindoretama - Centro', 'user/avatar6.png', 1, 1, '2020-02-05 00:00:00', '0000-00-00 00:00:00', 1, 1),
(119, 'Raimundo Vieira', 'da Silva', 'raibike', '123', 'raimundobike10@gmail.com', '17/02/1967', 'a+', 'm', '768123418', '876481724', 'Pindoretama - Centro', 'user/einstein.jpg', 1, 1, '2020-02-06 00:00:00', '0000-00-00 00:00:00', 1, 1),
(121, 'Raimundo', 'Vieira', 'rai10', '123', 'raimundobike10@gmail.com', '1967-02-17', 'a+', 'm', '82345239', '723528', 'Pindoretama - centro', 'user/ciencia.jpg', 2, 1, '2020-02-06 00:00:00', '0000-00-00 00:00:00', 1, 1),
(122, 'Paulo', 'Eduardo', 'paulo', '123', 'pauloedu@gmail.com', '05/12/1987', 'a+', 'M', '82903345', '894325', 'Pindoretama - Centro', 'user/avatar6.png', 1, 1, '2020-02-07 00:00:00', '0000-00-00 00:00:00', 1, 1),
(123, 'Guga', 'Silva', 'guga', '123', 'guga@gmail.com', '08/09/1991', 'a+', 'M', '8723534', '8923572', 'Cascavel - Centro', 'user/einstein.jpg', 1, 1, '2020-02-07 00:00:00', '0000-00-00 00:00:00', 1, 1),
(133, 'Albert', 'Dutra', 'albert', '123', 'dutra@gmail.com', '01/12/1999', 'A+', 'M', '8702935', '98723587', 'Fortaleza - Pici', 'user/einstein.jpg', 1, 1, '2020-02-07 00:00:00', '0000-00-00 00:00:00', 1, 1),
(190, 'Icaro', 'Lopes', 'icaro', '123', 'icaro@gmail.com', '09/12/1999', 'A+', 'm', '87235', '897235', 'Fortaleza - SC', 'user/back-phone.jpg', 1, 1, '2020-02-07 00:00:00', '0000-00-00 00:00:00', 1, 1),
(191, 'Lavinia', 'Lopes', 'lavinia', '123', 'ivina@gmail.com', '09/12/1999', 'A+', 'm', '87235', '897235', 'Fortaleza - SC', 'user/back-phone.jpg', 1, 1, '2020-02-07 00:00:00', '0000-00-00 00:00:00', 1, 1),
(192, 'Malu', 'Lopes', 'malu', '123', 'ivina@gmail.com', '09/12/1999', 'A+', 'm', '87235', '897235', 'Fortaleza - SC', 'user/back-phone.jpg', 1, 1, '2020-02-08 00:00:00', '0000-00-00 00:00:00', 1, 1),
(195, 'Paulim', 'Lopes', 'paulis', '123', 'ivina@gmail.com', '09/12/1999', 'A+', 'm', '87235', '897235', 'Fortaleza - SC', 'user/back-phone.jpg', 1, 1, '2020-02-08 00:00:00', '0000-00-00 00:00:00', 1, 1),
(196, 'Quincas', 'Silva', 'quincas', '123', 'quincas@gmail.com', '09/09/1999', 'a+', 'm', '98253458', '8327', 'Centro - cascavel', 'user/ambiente.jpg', 0, 1, '2020-02-08 00:00:00', '0000-00-00 00:00:00', 1, 1),
(198, 'Luamyr', 'Rodrigues de Oliveira', 'luamyr', '123', 'luamyr@gmail.com', '30/10/2009', 'a+', 'f', '', '', 'Pindoretama - JosÃ© Franco', 'user/2020/04/lulu.jpg', 0, 1, '2020-02-09 00:00:00', '0000-00-00 00:00:00', 1, 1),
(200, 'Lidi', 'Souza', 'lidi', '123', 'lidi@gmail.com', '05/09/2000', 'a+', 'f', '872345', '8923745', 'Mangueiral', 'user/img_5bc05ef323258.png', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1),
(274, 'Italo', 'Ramillys', 'Italo Ram', 'aaa', 'italoramillys@gmail.com', '01/12/1999', 'o+', 'M', '13424', '134124', 'Pindoretama', 'user/ambiente.jpg', 1, 1, '2020-03-25 00:00:00', NULL, 1, 1),
(275, 'Sandra Maria', 'Silva', 'sandrab', '123', 'sandra@gmail.com', '16/11/1966', 'a-', 'f', '1241327', '8324187', 'Pindoretama', 'user/avatar6.png', 1, 1, '2020-03-26 00:00:00', NULL, 1, 1),
(276, 'Italo', 'Ramillys', 'sasdad', '123', 'italoreeamillys@gmail.com', '01/12/1999', 'O+', 'M', '123412', '134134', 'Pindoretama', 'user/school.jpg', 1, 1, '2020-04-05 00:00:00', NULL, 1, 1),
(277, 'Sandra', 'Benicio', 'sandrinha', '1234567890', 'sandra@gmail.com', '16/11/1966', 'A+', 'F', '', '953.996.903-49', 'Pindoretama', 'noticia/2020/07/fiado.jpg', 2, 0, '2020-07-08 00:00:00', NULL, 1, 0),
(279, 'Rosangela', 'Maia', 'rosan', '8797192348791', 'rosangela_f_maia@gmail.com', '98/10/4980', 'a+', 'M', '', '812.374.819-27', 'Pindo', 'noticia/2020/07/festa.jpg', 2, 0, '2020-07-08 16:26:46', NULL, 1, 0);

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
  ADD UNIQUE KEY `id_student` (`id_student`,`year`);

--
-- Índices para tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id_config`);

--
-- Índices para tabela `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id_news`);

--
-- Índices para tabela `recurrence_lesson`
--
ALTER TABLE `recurrence_lesson`
  ADD PRIMARY KEY (`id_rec_lesson`);

--
-- Índices para tabela `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id_subject`),
  ADD UNIQUE KEY `cod_subject` (`code_subject`);

--
-- Índices para tabela `subject_class`
--
ALTER TABLE `subject_class`
  ADD PRIMARY KEY (`id_SC`),
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
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `news`
--
ALTER TABLE `news`
  MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `recurrence_lesson`
--
ALTER TABLE `recurrence_lesson`
  MODIFY `id_rec_lesson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `subject`
--
ALTER TABLE `subject`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT de tabela `subject_class`
--
ALTER TABLE `subject_class`
  MODIFY `id_SC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;