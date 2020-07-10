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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
