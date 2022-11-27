-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Nov-2022 às 12:58
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

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
  `desc_activity` varchar(5000) DEFAULT NULL,
  `references_activity` varchar(500) DEFAULT NULL,
  `id_author_activity` int(11) NOT NULL,
  `deadline_activity` date DEFAULT NULL,
  `file_activity` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `activity`
--

INSERT INTO `activity` (`id_activity`, `id_SC_activity`, `title_activity`, `desc_activity`, `references_activity`, `id_author_activity`, `deadline_activity`, `file_activity`, `created_at`, `updated_at`) VALUES
(10, 1, 'Exercícios sobre trigonometria', 'fk_id_sc_activityfk_id_sc_activityfk_id_sc_activity', 'Nenhuma', 8, NULL, 'atividade/2020/09/APS - Beauty Home-20200904135456-ece01258.pdf', '2020-09-04 08:54:56', NULL),
(11, 1, 'Exercícios sobre trigonometria', 'Podemos já vislumbrar o modo pelo qual a hegemonia do ambiente político apresenta tendências no sentido de aprovar a manutenção de todos os recursos funcionais envolvidos. Podemos já vislumbrar o modo pelo qual a hegemonia do ambiente político apresenta tendências no sentido de aprovar a manutenção de todos os recursos funcionais envolvidos. Podemos já vislumbrar o modo pelo qual a hegemonia do ambiente político apresenta tendências no sentido de aprovar a manutenção de todos os recursos funcionais envolvidos.', 'Estudar pelo Youtube', 8, '2020-09-11', 'atividade/2020/09/Prova de algebra.pdf', '2020-09-08 08:55:05', NULL);

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
(1, '1500.00', 133, 'FÃ­sica', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '4/maio'),
(2, '3000.00', 190, 'CC', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '4'),
(3, '3000.00', 191, 'CC', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '4'),
(4, '3000.00', 192, 'CC', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '4'),
(5, '3000.00', 195, 'CC', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '04/maio'),
(419, '1400.00', 8, '', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', ''),
(420, '1600.00', 117, '', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', ''),
(421, '0.00', 119, '', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', ''),
(422, '0.00', 122, '', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', ''),
(423, '0.00', 123, '', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', ''),
(427, '1500.00', 274, 'FÃ­sica', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '04/maio'),
(428, '3500.00', 275, 'FÃ­sica', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '04/maio'),
(429, '0.00', 276, 'faswer', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '04/maio');

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
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `attendance`
--

INSERT INTO `attendance` (`id_attendance`, `id_SC`, `id_user`, `date`, `type`, `created_at`) VALUES
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
(37, 91, 3, '2020-02-24', 'f', '2020-02-13 18:03:23'),
(38, 1, 198, '2020-09-12', 'f', '2020-09-23 20:11:19'),
(39, 1, 198, '2020-09-04', 'f', '2020-09-23 20:11:40'),
(40, 5, 200, '2022-11-11', 'f', '2022-11-13 10:31:02'),
(41, 5, 114, '2022-11-11', 'j', '2022-11-13 10:31:02'),
(42, 5, 200, '2022-11-09', 'f', '2022-11-13 10:31:39'),
(43, 5, 198, '2022-11-09', 'f', '2022-11-13 10:31:39'),
(44, 5, 283, '2022-11-09', 'j', '2022-11-13 10:31:39'),
(45, 5, 200, '2022-11-08', 'f', '2022-11-13 10:32:48'),
(46, 5, 198, '2022-11-08', 'f', '2022-11-13 10:32:48'),
(47, 3, 198, '2022-11-11', 'f', '2022-11-13 10:50:31'),
(48, 3, 114, '2022-11-11', 'j', '2022-11-13 10:50:31'),
(49, 3, 200, '2022-11-01', 'f', '2022-11-13 10:50:46'),
(50, 3, 198, '2022-11-01', 'f', '2022-11-13 10:50:46'),
(51, 3, 114, '2022-11-01', 'f', '2022-11-13 10:50:46'),
(52, 3, 283, '2022-11-01', 'f', '2022-11-13 10:50:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `class`
--

CREATE TABLE `class` (
  `id_class` int(11) NOT NULL,
  `name_class` varchar(30) NOT NULL,
  `room` text DEFAULT NULL,
  `shift` int(1) NOT NULL,
  `year` int(11) NOT NULL,
  `id_author_insert` int(11) NOT NULL,
  `id_author_update` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `class`
--

INSERT INTO `class` (`id_class`, `name_class`, `room`, `shift`, `year`, `id_author_insert`, `id_author_update`, `created_at`, `updated_at`) VALUES
(1, '8A', NULL, 1, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-28 10:25:38'),
(4, '7C', NULL, 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(7, '6B', NULL, 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(9, '6D', NULL, 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(11, '1A', NULL, 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(14, '1F', NULL, 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(15, '3F', NULL, 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(16, '4D', NULL, 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(19, '9A', NULL, 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(21, '1B', NULL, 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(24, '9D', NULL, 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(25, '2E', NULL, 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(27, '5C', NULL, 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(29, '6N', '13', 0, 2020, 1, 1, '2020-07-17 15:14:54', '2020-07-17 15:17:29'),
(30, '9C', 'Sala 02', 0, 2020, 0, NULL, '2020-08-26 13:43:00', NULL),
(31, '1V', 'Sala 01', 0, 2020, 0, NULL, '2020-08-26 13:51:36', NULL),
(32, '7T', 'Sala 01', 0, 2020, 0, NULL, '2020-08-26 14:10:59', NULL),
(33, '8U', 'Sala 04', 0, 2020, 0, NULL, '2020-08-26 14:20:57', NULL),
(34, '9V', '27', 0, 2022, 0, NULL, '2022-11-13 10:24:34', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `class_student`
--

CREATE TABLE `class_student` (
  `id_CS` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `turno` varchar(1) DEFAULT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `class_student`
--

INSERT INTO `class_student` (`id_CS`, `id_student`, `id_class`, `turno`, `year`) VALUES
(9, 5, 1, NULL, 2020),
(10, 283, 1, NULL, 2020),
(11, 198, 4, NULL, 2020),
(12, 200, 1, NULL, 2020),
(13, 38, 4, NULL, 2020),
(14, 100, 4, NULL, 2020),
(15, 114, 31, NULL, 2020),
(18, 200, 34, NULL, 2022),
(19, 198, 34, NULL, 2022),
(20, 114, 34, NULL, 2022),
(21, 283, 34, NULL, 2022);

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
  `style` int(11) NOT NULL,
  `id_config` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`title_site`, `img_school`, `img_featured_1`, `img_featured_2`, `img_featured_3`, `desc_school`, `phone_school_1`, `phone_school_2`, `phone_school_3`, `img_local`, `txt_img_1`, `txt_img_2`, `txt_img_3`, `style`, `id_config`) VALUES
('Faculdade V&V', 'sistema/teacher.jpg', 'sistema/recreacao.png', 'sistema/festa.jpg', 'sistema/back_index.jpg', 'A Faculdade V&V foi eleita a melhor do Brasil em 2021 e por isso estamos fazendo um super desconto nas matrículas de 2022. Venha conferir e se torne um profissional altamente capacitado.', '40028922', '40028922', '40028922', '', 'Recreação todo mês para que seu filho aprenda brincando', 'Saiba tudo da Faculdade V&V pelo seu smartphone. Agora estamos ONLINE ;)', 'Entrega dos materiais escolares de 2020', 3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `config_school`
--

CREATE TABLE `config_school` (
  `avg_grade` float DEFAULT NULL,
  `max_missing` int(11) DEFAULT NULL,
  `missing_allowance` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `id_adm_insert` int(11) NOT NULL,
  `id_adm_update` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `config_school`
--

INSERT INTO `config_school` (`avg_grade`, `max_missing`, `missing_allowance`, `created_at`, `updated_at`, `id_adm_insert`, `id_adm_update`) VALUES
(7, 20, 10, '2020-07-10 20:08:19', '2020-07-10 20:23:29', 1, 1);

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
(1, 1, 198, 1, '9.00', '2021-01-19 17:49:39'),
(3, 1, 198, 2, '8.90', '2021-01-19 17:52:06'),
(4, 1, 198, 3, '7.70', '2022-11-13 10:22:59'),
(5, 1, 38, 3, '8.15', '2022-11-13 10:22:59'),
(6, 1, 100, 3, '3.00', '2022-11-13 10:22:59'),
(7, 4, 200, 1, '2.00', '2022-11-13 10:26:52'),
(8, 4, 198, 1, '5.00', '2022-11-13 10:26:52'),
(9, 4, 114, 1, '8.00', '2022-11-13 10:26:52'),
(10, 4, 283, 1, '7.00', '2022-11-13 10:26:52'),
(11, 4, 200, 2, '7.80', '2022-11-13 10:27:24'),
(12, 4, 198, 2, '9.10', '2022-11-13 10:27:24'),
(13, 4, 114, 2, '3.75', '2022-11-13 10:27:24'),
(14, 4, 283, 2, '4.50', '2022-11-13 10:27:24'),
(15, 5, 200, 1, '8.00', '2022-11-13 10:28:20'),
(16, 5, 198, 1, '9.00', '2022-11-13 10:28:20'),
(17, 5, 114, 1, '6.00', '2022-11-13 10:28:20'),
(18, 5, 283, 1, '6.00', '2022-11-13 10:28:20'),
(19, 5, 200, 2, '10.00', '2022-11-13 10:28:44'),
(20, 5, 198, 2, '6.50', '2022-11-13 10:28:44'),
(21, 5, 114, 2, '4.25', '2022-11-13 10:28:44'),
(22, 5, 283, 2, '6.40', '2022-11-13 10:28:44'),
(23, 3, 200, 1, '3.00', '2022-11-13 10:50:11'),
(24, 3, 198, 1, '5.00', '2022-11-13 10:50:11'),
(25, 3, 114, 1, '7.00', '2022-11-13 10:50:11'),
(26, 3, 283, 1, '8.70', '2022-11-13 10:50:11'),
(27, 3, 200, 3, '3.60', '2022-11-13 12:34:16'),
(28, 3, 198, 3, '7.25', '2022-11-13 12:34:16'),
(29, 3, 114, 3, '9.15', '2022-11-13 12:34:16'),
(30, 3, 283, 3, '2.00', '2022-11-13 12:34:16');

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
  `img_news` varchar(255) DEFAULT NULL,
  `id_author` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `news`
--

INSERT INTO `news` (`id_news`, `title_news`, `slug_news`, `desc_news`, `img_news`, `id_author`, `created_at`, `updated_at`) VALUES
(22, 'Festa', 'festa', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae justo sit amet arcu aliquam facilisis ut vitae mauris. Nam auctor dignissim risus, vel dapibus erat egestas ut. Vestibulum a nibh maximus, lobortis est ut, cursus purus. Phasellus eu metus mattis, bibendum augue quis, elementum enim. Duis tincidunt, urna non tempus fermentum, ligula lorem volutpat justo, a congue metus sem convallis diam. Quisque gravida nibh id scelerisque commodo. Fusce suscipit semper aliquam. Nam ultricies, elit ac iaculis tristique, metus arcu auctor velit, at lobortis ex metus quis eros. Quisque maximus ligula eros, nec placerat erat efficitur vitae.', 'noticia/2020/07/linear.jpg', 1, '2020-07-17 16:58:32', NULL),
(23, 'Nescau Imitador', 'nescau-imitador', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae justo sit amet arcu aliquam facilisis ut vitae mauris. Nam auctor dignissim risus, vel dapibus erat egestas ut. Vestibulum a nibh maximus, lobortis est ut, cursus purus. Phasellus eu metus mattis, bibendum augue quis, elementum enim. Duis tincidunt, urna non tempus fermentum, ligula lorem volutpat justo, a congue metus sem convallis diam. Quisque gravida nibh id scelerisque commodo. Fusce suscipit semper aliquam. Nam ultricies, elit ac iaculis tristique, metus arcu auctor velit, at lobortis ex metus quis eros. Quisque maximus ligula eros, nec placerat erat efficitur vitae.', 'noticia/2020/07/back_index.jpg', 1, '2020-07-17 16:59:30', NULL),
(24, 'Feira de Ciencias', 'feira-de-ciencias', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae justo sit amet arcu aliquam facilisis ut vitae mauris. Nam auctor dignissim risus, vel dapibus erat egestas ut. Vestibulum a nibh maximus, lobortis est ut, cursus purus. Phasellus eu metus mattis, bibendum augue quis, elementum enim. Duis tincidunt, urna non tempus fermentum, ligula lorem volutpat justo, a congue metus sem convallis diam. Quisque gravida nibh id scelerisque commodo. Fusce suscipit semper aliquam. Nam ultricies, elit ac iaculis tristique, metus arcu auctor velit, at lobortis ex metus quis eros. Quisque maximus ligula eros, nec placerat erat efficitur vitae.', 'noticia/2020/10/Green-Anonymous.jpg', 1, '2020-10-29 19:22:21', NULL),
(25, 'Festa', 'festa-1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae justo sit amet arcu aliquam facilisis ut vitae mauris. Nam auctor dignissim risus, vel dapibus erat egestas ut. Vestibulum a nibh maximus, lobortis est ut, cursus purus. Phasellus eu metus mattis, bibendum augue quis, elementum enim. Duis tincidunt, urna non tempus fermentum, ligula lorem volutpat justo, a congue metus sem convallis diam. Quisque gravida nibh id scelerisque commodo. Fusce suscipit semper aliquam. Nam ultricies, elit ac iaculis tristique, metus arcu auctor velit, at lobortis ex metus quis eros. Quisque maximus ligula eros, nec placerat erat efficitur vitae.', 'noticia/2020/10/dev.jpg', 1, '2020-10-30 11:54:23', NULL),
(26, 'Festa', 'festa-1-2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae justo sit amet arcu aliquam facilisis ut vitae mauris. Nam auctor dignissim risus, vel dapibus erat egestas ut. Vestibulum a nibh maximus, lobortis est ut, cursus purus. Phasellus eu metus mattis, bibendum augue quis, elementum enim. Duis tincidunt, urna non tempus fermentum, ligula lorem volutpat justo, a congue metus sem convallis diam. Quisque gravida nibh id scelerisque commodo. Fusce suscipit semper aliquam. Nam ultricies, elit ac iaculis tristique, metus arcu auctor velit, at lobortis ex metus quis eros. Quisque maximus ligula eros, nec placerat erat efficitur vitae.', 'noticia/2020/10/2mi.png', 1, '2020-10-30 11:54:41', NULL),
(27, 'Festa', 'festa-2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae justo sit amet arcu aliquam facilisis ut vitae mauris. Nam auctor dignissim risus, vel dapibus erat egestas ut. Vestibulum a nibh maximus, lobortis est ut, cursus purus. Phasellus eu metus mattis, bibendum augue quis, elementum enim. Duis tincidunt, urna non tempus fermentum, ligula lorem volutpat justo, a congue metus sem convallis diam. Quisque gravida nibh id scelerisque commodo. Fusce suscipit semper aliquam. Nam ultricies, elit ac iaculis tristique, metus arcu auctor velit, at lobortis ex metus quis eros. Quisque maximus ligula eros, nec placerat erat efficitur vitae.', 'noticia/2020/10/fiado.jpg', 1, '2020-10-30 11:55:34', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `recurrence_lesson`
--

CREATE TABLE `recurrence_lesson` (
  `id_recurrence_lesson` int(11) NOT NULL,
  `id_sc` int(11) NOT NULL,
  `order_lesson` int(11) NOT NULL,
  `day_of_week` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `recurrence_lesson`
--

INSERT INTO `recurrence_lesson` (`id_recurrence_lesson`, `id_sc`, `order_lesson`, `day_of_week`) VALUES
(2, 1, 2, 3),
(4, 1, 3, 3),
(5, 1, 3, 4),
(6, 2, 2, 1),
(7, 2, 2, 2),
(8, 5, 1, 1),
(9, 4, 3, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `subject`
--

CREATE TABLE `subject` (
  `id_subject` int(11) NOT NULL,
  `code_subject` varchar(8) NOT NULL,
  `name_subject` varchar(30) NOT NULL,
  `id_author_insert` int(11) NOT NULL,
  `id_author_update` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `subject`
--

INSERT INTO `subject` (`id_subject`, `code_subject`, `name_subject`, `id_author_insert`, `id_author_update`, `created_at`, `updated_at`) VALUES
(1, 'CK-3422', 'Matematica 1', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(3, 'CK-3423', 'Matematica 2', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(4, 'CK-0901', 'Informática', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(5, 'MK-4555', 'Biologia 2', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(6, 'CK-3421', 'Português', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(7, 'MT-9909', 'Quimica', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(10, 'MT-9888', 'Fisica', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(12, 'MT-9910', 'Fisica 2', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(13, 'CK-3428', 'Lógica', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(110, 'CK-3456', 'Matematica', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(139, 'MP-8736', 'SGBD', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(141, 'CK-3233', 'Informática e Sociedade', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(142, 'TG-7849', 'Arquitetura de Computadores', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(144, 'CK-3444', 'Ed. Física', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(145, 'CK-3556', 'Filosofia', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(146, 'CK-3789', 'Musica', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(147, 'CK-3477', 'Matematica subjectreta', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(190, 'MH-2980', 'Finanças', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(192, 'MH-2981', 'Gastronomia', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(199, 'MH-2983', 'Psicologia', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(202, 'MH-2989', 'Otica', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(203, 'FE-2983', 'Finanças 2', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(204, 'FI-2983', 'Economia 3', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(205, 'MH-2977', 'Grafos', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(207, 'MH-2956', 'Biologia 9', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(208, 'MH-4444', 'Otica 5', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(209, 'MH-2675', 'Psicologia', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(210, 'MH-1441', 'Finanças 4', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(211, 'FE-2980', 'Biologia 0', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(212, 'MJ-2977', 'Psicologia', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(213, 'HH-2980', 'Psicologia', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(214, 'MH-6755', 'PsicologiaCAD', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(215, 'MH-5555', 'Psicologia', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(216, 'MH-2970', 'Finanças', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(217, 'MH-3546', 'Finanças 6', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(218, 'MH-2988', 'Otica 9', 1, 1, '2020-07-17 14:59:38', '2020-07-17 15:05:14'),
(219, 'MH-2890', 'Engenharia Química', 1, NULL, '2020-08-26 14:25:57', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `subject_class_lesson`
--

CREATE TABLE `subject_class_lesson` (
  `id_sc` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `subject_class_lesson`
--

INSERT INTO `subject_class_lesson` (`id_sc`, `id_subject`, `id_class`, `id_teacher`, `year`, `status`) VALUES
(1, 3, 4, 8, 2020, 1),
(2, 4, 11, 276, 2020, 1),
(3, 12, 34, 192, 2022, 1),
(4, 141, 34, 8, 2022, 1),
(5, 192, 34, 122, 2022, 1);

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
  `img_profile` varchar(255) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `std_style` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_author_insert` int(11) NOT NULL,
  `id_author_update` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `last_name`, `login`, `pass`, `email`, `birth`, `blood`, `genre`, `rg`, `document`, `address`, `img_profile`, `type`, `std_style`, `status`, `created_at`, `updated_at`, `id_author_insert`, `id_author_update`) VALUES
(1, 'Italo Ramillys', 'Benicio Silva', 'ita', '123', 'italoramillys@gmail.com', '20/04/1999', 'B-', 'M', '1342423452', '063.345.923-27', 'Pindoretama - Centro - Rua Padre Edilson Silva 776', 'usuario/2020/08/FLA-20200825142744-90c04c96.jpg', 2, NULL, 1, '2020-02-01 00:00:00', '2020-10-09 13:52:30', 1, 1),
(5, 'Cesar', 'Ramillys', 'csa', '123', 'i2taloramillys@gmail.com', '12/04/1999', '', '', '13424', '', '', NULL, 0, NULL, 1, '2020-02-01 00:00:00', '2020-08-01 14:00:22', 1, 1),
(8, 'Fabio Demetrio', 'Souza Carvalho', 'fabim', '123', 'fabim@gmail.com', '04/12/199', 'A+', 'm', '1234124', '23452', '', NULL, 1, NULL, 1, '2020-02-01 00:00:00', '2020-07-20 09:40:06', 1, 1),
(38, 'Ester da Silva', 'Lopes', 'ester', '123', 'ester@gmail.com', '12/04/1999', '', '', '524352435', '432.542.352-36', 'Coaçu - Cascavel', 'usuario/2020/08/FLA-20200809145330-2fbc1830.jpg', 0, NULL, 1, '2020-02-01 00:00:00', '2020-10-13 16:08:57', 1, 1),
(100, 'Luana ', 'Sousa', 'luana', '123', 'luana@gmail.com', '2003-09-0', '', '', '111344', '312444', '', NULL, 0, NULL, 1, '2020-02-01 00:00:00', '2020-08-26 13:42:09', 1, 1),
(114, 'Luciano', 'Camargo', 'luciano', '123', 'luciano@gmail.com', '12/04/1999', 'a-', 'm', '89734529', '82641', 'Cascavel - MultirÃ£o - Rua 10 - 8999', NULL, 0, NULL, 1, '2020-02-04 00:00:00', '2020-07-20 09:40:06', 1, 1),
(122, 'Paulo', 'Eduardo', 'paulo', '123', 'pauloedu@gmail.com', '05/12/1987', 'a+', 'M', '82903345', '894325', 'Pindoretama - Centro', NULL, 1, NULL, 1, '2020-02-07 00:00:00', '2020-07-20 09:40:06', 1, 1),
(123, 'Guga', 'Silva', 'guga', '123', 'guga@gmail.com', '08/09/1991', 'a+', 'M', '8723534', '8923572', 'Cascavel - Centro', NULL, 1, NULL, 1, '2020-02-07 00:00:00', '2020-07-20 09:40:06', 1, 1),
(133, 'Albert', 'Dutra', 'albert_dutra', '123', 'dutra@gmail.com', '01/12/1999', 'A+', 'M', '8702935', '98723587', 'Fortaleza - Pici', 'usuario/2020/07/FLA-20200724202038-61374aec.jpg', 1, NULL, 1, '2020-02-07 00:00:00', '2020-08-14 12:41:13', 1, 133),
(191, 'Lavinia', 'Lopes', 'lavinia', '123', 'iv0ina@gmail.com', '09/12/1999', 'A+', 'm', '87235', '897235', 'Fortaleza - SC', NULL, 1, NULL, 1, '2020-02-07 00:00:00', '2020-08-01 14:01:15', 1, 1),
(192, 'Marcus', 'Lopes', 'malu', '123', 'ivina@gmail.com', '09/12/1999', 'A+', 'm', '87235', '897235', 'Fortaleza - SC', NULL, 1, NULL, 1, '2020-02-08 00:00:00', '2020-08-26 13:42:30', 1, 1),
(198, 'Luamyr', 'Rodrigues de Oliveira', 'luamyr', '123', 'luamyr@gmail.com', '30/10/2009', 'a+', 'f', '', '', 'Pindoretama - José Franco', 'usuario/2021/01/acidente.jpg', 0, NULL, 1, '2020-02-09 00:00:00', '2021-01-16 20:40:14', 1, 198),
(200, 'Lidi', 'Souza', 'lidi', '123', 'lidi@gmail.com', '05/09/2000', 'a+', 'f', '872345', '8923745', 'Mangueiral', NULL, 0, NULL, 1, '0000-00-00 00:00:00', '2020-07-20 09:40:06', 1, 1),
(276, 'Italo', 'Ramillys', 'sasdad', '123', 'italoreeamillys@gmail.com', '01/12/1999', 'O+', 'M', '123412', '134134', 'Pindoretama', NULL, 1, NULL, 1, '2020-04-05 00:00:00', '2020-07-20 09:40:06', 1, 1),
(277, 'Sandra', 'Benicio', 'sandrinha', '1234567890', 'sandra@gmail.com', '16/11/1966', 'A+', 'F', '', '953.996.903-49', 'Pindoretama', NULL, 2, NULL, 1, '2020-07-08 00:00:00', '2020-08-08 09:42:24', 1, 0),
(282, 'Andre', 'Ports', 'andre', '123', 'andre@gmail.com', '07/02/1992', 'a+', 'M', '', '091.782.341-20', 'Campinas', 'usuario/2020/08/dev.jpg', 2, NULL, 1, '2020-08-02 14:57:59', '2022-09-28 14:45:46', 1, NULL),
(283, 'Ubirtan', 'Junior', 'ubirap', 'bira1234567890', 'ubiratanj@gmail.com', '05/06/1999', 'a+', 'M', '', '809.128.341-09', 'Itapipoca', 'usuario/2020/08/FLA.jpg', 0, NULL, 1, '2020-08-02 15:01:38', '2022-08-31 09:08:40', 1, NULL),
(286, 'Valeria', 'Lelli', 'valeria', 'leli', 'valeria@gmail.com', '09/08/1996', 'A+', 'F', '', '823.491.489-89', 'Fortaleza', 'usuario/2022/09/294135483880061_01-12-2021_1022.jpg', 0, NULL, 1, '2022-09-03 10:47:36', NULL, 1, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id_activity`),
  ADD KEY `fk_id_user_activity` (`id_author_activity`);

--
-- Índices para tabela `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id_attendance`);

--
-- Índices para tabela `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`),
  ADD UNIQUE KEY `name_class` (`name_class`,`year`) USING BTREE;

--
-- Índices para tabela `class_student`
--
ALTER TABLE `class_student`
  ADD PRIMARY KEY (`id_CS`),
  ADD UNIQUE KEY `id_student` (`id_student`,`year`);

--
-- Índices para tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id_config`);

--
-- Índices para tabela `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id_grade`),
  ADD UNIQUE KEY `uq_grade` (`id_SC`,`id_student`,`period`);

--
-- Índices para tabela `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id_news`),
  ADD UNIQUE KEY `uq_slug` (`slug_news`) USING HASH;

--
-- Índices para tabela `recurrence_lesson`
--
ALTER TABLE `recurrence_lesson`
  ADD PRIMARY KEY (`id_recurrence_lesson`);

--
-- Índices para tabela `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id_subject`),
  ADD UNIQUE KEY `cod_subject` (`code_subject`);

--
-- Índices para tabela `subject_class_lesson`
--
ALTER TABLE `subject_class_lesson`
  ADD PRIMARY KEY (`id_sc`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_nickname` (`login`) USING BTREE,
  ADD UNIQUE KEY `uq_email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `activity`
--
ALTER TABLE `activity`
  MODIFY `id_activity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id_attendance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `class`
--
ALTER TABLE `class`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `class_student`
--
ALTER TABLE `class_student`
  MODIFY `id_CS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `grade`
--
ALTER TABLE `grade`
  MODIFY `id_grade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `news`
--
ALTER TABLE `news`
  MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `recurrence_lesson`
--
ALTER TABLE `recurrence_lesson`
  MODIFY `id_recurrence_lesson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `subject`
--
ALTER TABLE `subject`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT de tabela `subject_class_lesson`
--
ALTER TABLE `subject_class_lesson`
  MODIFY `id_sc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `fk_id_user_activity` FOREIGN KEY (`id_author_activity`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `class_student`
--
ALTER TABLE `class_student`
  ADD CONSTRAINT `fk_student_class` FOREIGN KEY (`id_student`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
