-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 10:08 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpesd_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `tracking_number` varchar(150) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `u_id` int(11) NOT NULL,
  `offi_id` int(11) NOT NULL,
  `doc_type` int(11) NOT NULL,
  `document_description` text DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `tracking_number`, `document_name`, `u_id`, `offi_id`, `doc_type`, `document_description`, `created`) VALUES
(19, '20231121001', 'asdasd', 8, 21, 1, '<p>sadasdasd</p>', '2023-11-21 15:16:42'),
(20, '20231121002', 'asdasd', 8, 21, 1, '<p>sadsadasd</p>', '2023-11-29 02:40:02'),
(21, '20231121003', 'jvjvjygvyjgfyjg', 8, 21, 1, '<p>&nbsp;mvhjgykgyukguky</p>', '2023-12-04 12:33:11'),
(22, '20231121004', 'fdasdsadasd', 8, 21, 2, NULL, '2023-12-11 03:58:18'),
(23, '20231121005', 'asdsadas', 8, 21, 1, NULL, '2023-12-11 03:58:23'),
(24, '20231121006', 'ASDADESA', 8, 21, 1, '<p>SADSADSADSAD ASDSADASDSADSADASDSAD</p>', '2023-12-25 15:52:09'),
(25, '20231121007', 'SADSA', 8, 21, 1, NULL, '2023-12-28 14:44:23'),
(26, '20231121008', 'sadasdasdasd', 9, 21, 1, NULL, '2023-12-28 14:54:10'),
(27, '20231121009', 'sadsa', 8, 21, 1, NULL, '2023-12-28 15:03:19'),
(28, '20231121010', 'sadasd', 8, 21, 2, NULL, '2023-12-29 10:07:15'),
(29, '20231121011', 'sadsadsa', 8, 21, 2, NULL, '2023-12-29 10:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(150) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document_types`
--

INSERT INTO `document_types` (`type_id`, `type_name`, `created`) VALUES
(1, 'CAFOA', '2022-04-11 03:11:59'),
(2, 'sample1', '2022-04-12 05:24:11'),
(21, 'asdasdasdsa', '2023-11-06 17:43:28'),
(38, 'sadsa', '2023-11-08 14:03:40'),
(41, 'sadas', '2023-11-15 16:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `final_actions`
--

CREATE TABLE `final_actions` (
  `action_id` int(50) NOT NULL,
  `action_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `final_actions`
--

INSERT INTO `final_actions` (`action_id`, `action_name`, `created`) VALUES
(1, 'sample', '2023-11-08 06:29:32'),
(8, 'For Approval', '2023-11-08 14:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `t_number` varchar(11) NOT NULL,
  `user1` int(11) DEFAULT NULL,
  `office1` int(11) DEFAULT NULL,
  `user2` int(11) DEFAULT NULL,
  `office2` int(11) DEFAULT NULL,
  `status` set('torec','received','to-hold','hold','to-complete','completed') NOT NULL,
  `received_status` int(11) DEFAULT NULL,
  `received_date` datetime DEFAULT NULL,
  `release_status` int(11) DEFAULT NULL,
  `release_date` datetime DEFAULT NULL,
  `final_action_taken` text DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `t_number`, `user1`, `office1`, `user2`, `office2`, `status`, `received_status`, `received_date`, `release_status`, `release_date`, `final_action_taken`, `remarks`) VALUES
(19, '20231121001', 8, 21, 8, 21, 'completed', 1, '2023-11-21 15:16:42', NULL, NULL, '8', NULL),
(20, '20231121002', 8, 21, 8, 21, 'completed', 1, '2023-11-29 02:40:02', NULL, NULL, '8', NULL),
(21, '20231121003', 8, 21, 8, 21, 'completed', 1, '2023-12-04 12:33:11', NULL, NULL, '8', NULL),
(22, '20231121004', 8, 21, 8, 21, 'received', 1, '2023-12-11 03:58:18', 1, NULL, NULL, NULL),
(23, '20231121005', 8, 21, 8, 21, 'received', 1, '2023-12-11 03:58:23', 1, NULL, NULL, NULL),
(24, '20231121005', 8, 21, 9, 21, 'received', 1, '2023-12-11 04:37:25', 1, '2023-12-11 03:58:33', NULL, NULL),
(25, '20231121004', 8, 21, 9, 21, 'received', 1, '2023-12-11 04:37:22', 1, '2023-12-11 03:58:38', NULL, NULL),
(26, '20231121005', 9, 21, 8, 21, 'received', 1, '2023-12-11 04:40:00', 1, '2023-12-11 04:39:25', NULL, NULL),
(27, '20231121004', 9, 21, 8, 21, 'received', 1, '2023-12-11 04:39:46', 1, '2023-12-11 04:39:31', NULL, NULL),
(28, '20231121005', 8, 21, 9, 21, 'received', 1, '2023-12-11 04:41:01', NULL, '2023-12-11 04:40:12', NULL, NULL),
(29, '20231121004', 8, 21, 9, 21, 'received', 1, '2023-12-11 04:40:59', NULL, '2023-12-11 04:40:17', NULL, NULL),
(30, '20231121006', 8, 21, 8, 21, 'received', 1, '2023-12-25 15:52:09', 1, NULL, NULL, NULL),
(31, '20231121006', 8, 21, 9, 21, 'received', 1, '2023-12-28 14:45:23', NULL, '2023-12-25 15:52:19', NULL, '<p>SADSAD</p>'),
(32, '20231121007', 8, 21, 8, 21, 'received', 1, '2023-12-28 14:44:23', 1, NULL, NULL, NULL),
(33, '20231121007', 8, 21, 9, 21, 'received', 1, '2023-12-28 14:45:26', 1, '2023-12-28 14:44:51', NULL, '<p>dsadsa</p>'),
(34, '20231121008', 9, 21, 9, 21, 'received', 1, '2023-12-28 14:54:10', 1, NULL, NULL, NULL),
(35, '20231121009', 8, 21, 8, 21, 'received', 1, '2023-12-28 15:03:19', 1, NULL, NULL, NULL),
(36, '20231121009', 8, 21, 9, 21, 'torec', NULL, NULL, NULL, '2023-12-28 15:03:28', NULL, NULL),
(37, '20231121008', 9, 21, 8, 21, 'completed', 1, '2023-12-29 10:14:12', NULL, '2023-12-28 15:08:21', '8', '<p>sadasdsad</p>'),
(38, '20231121007', 9, 21, 8, 21, 'completed', 1, '2023-12-29 10:14:10', NULL, '2023-12-28 15:53:27', '8', '<p>asdsadasdas</p>'),
(39, '20231121010', 8, 21, 8, 21, 'received', 1, '2023-12-29 10:07:15', 1, NULL, NULL, NULL),
(40, '20231121010', 8, 21, 9, 21, 'torec', NULL, NULL, NULL, '2023-12-29 10:07:40', NULL, NULL),
(41, '20231121011', 8, 21, 8, 21, 'received', 1, '2023-12-29 10:08:01', 1, NULL, NULL, NULL),
(42, '20231121011', 8, 21, 9, 21, 'torec', NULL, NULL, NULL, '2023-12-29 10:08:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(21, '2014_10_12_000000_create_users_table', 1),
(22, '2014_10_12_100000_create_password_resets_table', 1),
(23, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(26, '2023_09_25_024528_records', 1),
(27, '2023_09_26_043954_create_people_table', 1),
(28, '2023_09_25_022622_person', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `office_id` int(11) NOT NULL,
  `office` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `office_status` enum('inactive','active') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`office_id`, `office`, `created`, `office_status`) VALUES
(2, 'Assesor', '2022-04-06 07:54:50', 'active'),
(3, 'IT', '2022-04-06 07:55:03', 'active'),
(21, 'Peso Office', '2023-06-19 13:35:39', 'active'),
(53, 'sadsa', '2023-11-13 19:30:51', 'active'),
(58, 'sadasd', '2023-11-13 01:47:09', 'active'),
(59, 'sadsad', '2023-11-14 11:30:12', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `person_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`first_name`, `middle_name`, `last_name`, `extension`, `phone_number`, `email_address`, `address`, `age`, `created_at`, `status`, `person_id`) VALUES
('sadsa', NULL, 'dsadsad', NULL, NULL, NULL, 'Dullan Norte', 21, '2024-11-20 14:42:42', 'active', 32),
('sadsa', NULL, 'dsadsa', NULL, NULL, NULL, 'Dullan Sur', 0, '2024-11-20 14:42:42', 'active', 33),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Dullan Sur', 0, '2024-11-20 14:42:42', 'active', 34),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, '2024-11-20 14:42:42', 'active', 35),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, '2024-11-20 14:42:42', 'active', 36),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, '2024-11-20 14:42:42', 'active', 37),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, '2024-11-20 14:42:42', 'active', 38),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, '2024-11-20 14:42:42', 'active', 39),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 40),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, '2024-11-20 14:42:42', 'active', 41),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 42),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 43),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 44),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 45),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, '2024-11-20 14:42:42', 'active', 46),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 47),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, '2024-11-20 14:42:42', 'active', 48),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, '2024-11-20 14:42:42', 'active', 49),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, '2024-11-20 14:42:42', 'active', 50),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, '2024-11-20 14:42:42', 'active', 51),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, NULL, 'active', 52),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, NULL, 'inactive', 53),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, NULL, 'inactive', 54),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, NULL, 'inactive', 55),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2023-11-20 14:42:38', 'inactive', 56),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Address', 0, NULL, 'inactive', 57),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2023-11-20 14:42:38', 'inactive', 58),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2023-11-20 14:42:38', 'inactive', 59),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2023-11-20 14:42:38', 'inactive', 60),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2023-11-20 14:42:38', 'inactive', 61),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2023-11-20 14:42:38', 'inactive', 62),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2023-11-20 14:42:38', 'inactive', 63),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2023-11-20 14:42:38', 'inactive', 64),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2023-11-20 14:42:38', 'inactive', 65),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2023-11-20 14:42:38', 'inactive', 66),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2023-11-20 14:42:38', 'inactive', 67),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 68),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 69),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 70),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 71),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 72),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 73),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 74),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 75),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 76),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 77),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 78),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 79),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 80),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 81),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 82),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 83),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 84),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 85),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 86),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 87),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 88),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 89),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 90),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 91),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 92),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 93),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 94),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 95),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 96),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 97),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 98),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 99),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 100),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 101),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 102),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 103),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 104),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 105),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 106),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 107),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 108),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 109),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 110),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 111),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 112),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 113),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 114),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 115),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 116),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 117),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 118),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 119),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 120),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 121),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 122),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 123),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 124),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 125),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 126),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 127),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 128),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 129),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 130),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 131),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 132),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 133),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 134),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 135),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 136),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 137),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 138),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 139),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 140),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 141),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 142),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 143),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 144),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 145),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 146),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 147),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 148),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 149),
('sample1', '', 'Helloo', '', '123213', 'sample@gmail.com', 'Tuyabang Bajo', 0, '2024-11-20 14:42:42', 'active', 150),
('Basil John', 'Calamongay', 'Manabo', NULL, '09632381042', 'manabobasil@gmail.com', 'Tuyabang Bajo', 0, '2024-01-03 06:58:26', 'active', 151),
('sadsad', 'sds', 'sd', 'dsd', '2133213', 'asdasdasd@asdsadas', 'Layawan', 123, '2024-01-04 05:01:48', 'active', 152),
('Juan', NULL, 'Tamad', NULL, '09123213213', 'manabobassadasd@sadasd', 'Proper Langcangan', 21, '2024-01-04 06:21:13', 'active', 153),
('asdsad', NULL, 'sd', NULL, '23213213', 'sadsadsad@sadsad', 'Lower Rizal', 12, '2024-01-04 08:07:17', 'active', 154),
('sadsad', 'sadsd', 'sd', NULL, '23213', 'sadsad@asdsadsad', 'Lower Lamac', 12, '2024-01-04 08:07:51', 'active', 155),
('sdsad', 'sdad', 'sdsd', NULL, '213213', 'sadasd213213@sadsadas', 'Dullan Norte', NULL, '2024-01-04 08:08:44', 'active', 156),
('sadsa', 'dsd', 'dsds', NULL, '2132132', 'asdsadas@asdsad', 'Dullan Sur', 12, '2024-01-04 08:11:05', 'active', 157),
('sadsa', 'sd', 'dsdsd', NULL, '213213', 'sdsad@asdsad', 'Lower Langcangan', 23, '2024-01-04 08:11:47', 'active', 158),
('sadsad', 'sdsd', 'sdsd', NULL, '231321', 'sadsadas@sadsad', 'Dulapo', 12, '2024-01-04 08:15:37', 'active', 159),
('sdsad', 'sds', 'sdsd', '232', '23213213', 'sadsad@qadasd', 'Dolipos Bajo', 12, '2024-01-04 08:16:20', 'active', 160),
('sadsad', 'sadasdsad', 'sadsad', 'sds', '321323213', 'asdsad@ASDSADSA', 'Lower Lamac', NULL, '2024-01-04 08:16:34', 'active', 161),
('Tampolano', NULL, 'Jaun', NULL, '909123312321', 'asdsad@asdsadasd', 'Dulapo', 12, '2024-01-04 17:06:51', 'active', 162);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL,
  `program` varchar(255) NOT NULL,
  `program_description` text DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `program`, `program_description`, `created`) VALUES
(11, 'Jobstart Philippines', 'sample', '2024-01-03 04:36:56'),
(12, 'Senior High Scholarship', NULL, '2024-01-03 04:37:34'),
(13, 'College Scholarship', NULL, '2024-01-03 04:38:16'),
(14, 'One Family One Profession', NULL, '2024-01-03 04:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `program_block`
--

CREATE TABLE `program_block` (
  `program_block_id` int(50) NOT NULL,
  `program_id` int(50) NOT NULL,
  `person_id` int(50) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_block`
--

INSERT INTO `program_block` (`program_block_id`, `program_id`, `person_id`, `created`) VALUES
(18, 13, 41, '2024-01-04 16:30:44'),
(20, 13, 33, '2024-01-04 16:32:58'),
(21, 11, 33, '2024-01-04 16:32:58'),
(27, 13, 32, '2024-01-04 16:52:09'),
(28, 11, 32, '2024-01-04 16:52:09'),
(29, 14, 32, '2024-01-04 16:52:09'),
(30, 12, 32, '2024-01-04 16:52:09'),
(33, 13, 151, '2024-01-04 17:06:13'),
(34, 11, 151, '2024-01-04 17:06:13'),
(35, 13, 162, '2024-01-04 17:07:00'),
(36, 11, 162, '2024-01-04 17:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `record_id` int(255) NOT NULL,
  `p_id` int(255) NOT NULL,
  `record_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`record_id`, `p_id`, `record_description`, `created_at`) VALUES
(1, 1, 'Jobstart Issue', '2023-06-19 13:35:39'),
(34, 1, 'tertret', '2023-06-19 13:35:39'),
(35, 1, 'dfdfgfdg', '2023-06-19 13:35:39'),
(75, 34, 'sasadsadsa asdsadsa', '2023-12-28 14:32:07'),
(84, 34, 'sadsadsa1', '2023-12-28 14:36:20'),
(86, 40, 'sadsad', '2023-12-28 14:40:09'),
(89, 40, 'wqdsadsa', '2023-12-28 14:40:53'),
(97, 162, 'sadsad', '2024-01-04 17:07:03');

-- --------------------------------------------------------

--
-- Table structure for table `security`
--

CREATE TABLE `security` (
  `us_id` int(11) NOT NULL,
  `security_code` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `security`
--

INSERT INTO `security` (`us_id`, `security_code`, `updated`) VALUES
(8, '$2y$10$CxUFLd0TZ4XowiJ1KfXwSuWU8SroMM7mWklYsqY/P0Vu27cTNf7m2', '2023-11-18 08:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(50) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `contact_number` varchar(15) NOT NULL,
  `address` varchar(150) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `profile_pic` varchar(50) DEFAULT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `work_status` set('jo','regular') DEFAULT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `off_id` int(255) NOT NULL,
  `user_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_name`, `last_name`, `extension`, `contact_number`, `address`, `email_address`, `profile_pic`, `user_type`, `user_status`, `work_status`, `username`, `password`, `off_id`, `user_created`) VALUES
(8, 'Mark Anthony', '', 'Artigas', '', '0905788844', 'Binuangan', 'markeeboi1985@gmail.com', NULL, 'admin', 'active', NULL, 'markuser', '$2y$10$LNjjAwAdQazQMF22UnUCde32RHVohPL3QPjpQ2tJMkH4xswinXPu6', 21, '2023-04-06 16:32:32'),
(9, 'Basil John', 'C.', 'Manabo', '', '0912321321', 'Lower Rizal', 'manabobasil@gmail.com', NULL, 'user', 'active', NULL, 'basiluser', '$2y$10$NramshA6AyXZvQXyC5rtHONDg5FEITqcdfxzDkhwJ9mwQBnvNCapa', 21, '2023-04-07 03:04:02'),
(12, 'Katlyn Mary', '', 'Daraman', '', '0963936232', 'Canubay', 'daraman.cp', NULL, 'user', 'active', 'jo', 'katlyn1388', '$2y$10$HU/SEKRHDbELpPI10DLnx.EjP2uh0akDblmg0o1vES9lHPRc47xkC', 21, '2023-05-05 05:00:46'),
(13, 'Judith', 'P.', 'Abuhon', '', '09107324580', 'Villaflor', 'abuhon.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'ram_tom', '$2y$10$TE3O7GRzGKGl18SRaGV9s.u7BpPN.Fsv/YHAujQXEhROnnfAm1Xbm', 21, '2023-05-05 07:01:00'),
(14, 'Sheila Marie', '', 'Daque', '', '09516531821', 'Lower Loboc', 'daquesheilamarie@gmail.com', NULL, 'user', 'active', 'jo', 'Shelayla', '$2y$10$Md/bS.rZKXp/HDAuIkoXgOR9iwbLGGli51TY8kGiSJZZ3yyZzZsGe', 21, '2023-05-05 07:23:18'),
(15, 'Cel', 'Betero', 'Chua', '', '0912789660', 'Talairon', 'chua.cpesd', NULL, 'user', 'active', 'jo', 'Choyerns', '$2y$10$LNjjAwAdQazQMF22UnUCde32RHVohPL3QPjpQ2tJMkH4xswinXPu6', 21, '2023-05-05 07:25:12'),
(16, 'WIENGELYN', 'MILO', 'IBASAN', '', '0912367928', 'Tipan', 'ibasan.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'Wiengy ', '$2y$10$QsoMylmly4nLdJSS318MReBYY1a7wkNKdaGE/g7SsQvt4gJD2sS5O', 21, '2023-05-05 07:27:14'),
(17, 'John Rick', 'Himpayan', 'Tac-an', '', '09618058910', 'Proper Langcangan', 'jrtacanambush@gmail.com', NULL, 'user', 'active', 'jo', 'John Rick', '$2y$10$gtbD6ggrpp8YD4CKOdUkj.PXYN4J2h21Z1hUONiAzi0MzwmsMRIuy', 0, '2023-05-05 07:46:38'),
(18, 'Celrose', 'O.', 'Español', '', '09465543788', 'Mobod', 'celrose14@gmail.com', NULL, 'user', 'active', 'jo', 'CELROSE', '$2y$10$LNjjAwAdQazQMF22UnUCde32RHVohPL3QPjpQ2tJMkH4xswinXPu6', 0, '2023-05-05 08:18:24'),
(19, 'Judy Mae', 'Taberao', 'Catane', '', '09462326054', 'Pines', 'catane.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'judai09', '$2y$10$2j8deWGJKg6ftOrTRH43pudfIajE/BBn5n8mbZ2KWTzKK90gIcg1y', 0, '2023-05-09 14:24:42'),
(20, 'Dayanara Mae', 'Molina', 'Hipos', '', '09700746605', 'Villaflor', 'hipos.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'Dayanara', '$2y$10$Mgt4XlqAHBBUSokzbp1pqeSAoyslqH//3y1TZYwL/i1oOcGo8ST7m', 0, '2023-05-09 14:30:58'),
(21, 'Marilou', 'Inting', 'Gumapac ', '', '09632873186', 'Binuangan', 'gumapac.cpesdoroq@gmail.com', NULL, 'user', 'active', 'regular', 'MIG101583', '$2y$10$Mgt4XlqAHBBUSokzbp1pqeSAoyslqH//3y1TZYwL/i1oOcGo8ST7m', 0, '2023-05-10 08:49:43'),
(22, 'Reymond', 'Manlod', 'Tacastacas', '', '09090821383', 'Taboc Sur', 'verzacheboitax@gmail.com', NULL, 'user', 'active', 'jo', 'boitacs', '$2y$10$3HcPLa8XnlvpYxLpn99Xj.ZLBT5SXnfd4kl3yS3vmaPdVrIK6H05S', 0, '2023-05-10 09:26:41'),
(23, 'Richard', 'Cariaga ', 'Liberto ', '', '09383926364', 'Canubay', 'richardliberto11@gmail.com', NULL, 'user', 'active', 'regular', 'Jhong ', '$2y$10$v83WR45m3GZb9mxaqZxp5O.3Z9l3tdTPCsuU/b0Tlyc5rn5jSvldK', 0, '2023-05-10 09:28:27'),
(24, 'Dennamor', 'Tangcay', 'Markinex', '', '09300334135', 'Lower Langcangan', 'markinez.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'amoreezz', '$2y$10$lnfNauHJ/hTWRgEXSWw2g.RIGcsvIUwCqft74vSVpnUcUxJjVwY0K', 0, '2023-05-12 14:08:34'),
(25, 'SUNNY', 'IYOG', 'LUNA', '', '09516508095', 'Canubay', 'luna.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'PAGONGLUNA', '$2y$10$LNjjAwAdQazQMF22UnUCde32RHVohPL3QPjpQ2tJMkH4xswinXPu6', 0, '2023-06-19 13:35:39'),
(26, 'Cristine Grace', 'Uba', 'Masayon', '', '09124318680', 'Upper Rizal', 'uba.cpesdoroq@gmail.com', NULL, 'user', 'active', 'regular', 'richlyzoe', '$2y$10$XTXpBMzO4Y8Cp3tVOML5lO3.Uy5ZjyVzsDbJr1l5K0FZHlMM0Km1G', 0, '2023-07-20 15:48:26'),
(27, 'King Francis', '', 'Cario', '', '09100000000', 'Lower Loboc', '123@gmail.com', NULL, 'user', 'active', 'jo', 'cario1234', '$2y$10$nLHER1Djvb14TgREHn3ureWhyoRw/RQO0uZjmPK.f4WE4QGpsMIka', 0, '2023-08-14 14:20:52'),
(28, 'Joseph', 'L.', 'Buta', '', '09079187139', 'Upper Lamac', 'butajoseph8@gmail.com', NULL, 'user', 'active', 'jo', 'joseph@27', '$2y$10$y0fsDNdgBCB5ncORG.75pOAPy2uIjN0qDpwZR3/JoeEh7ng44aJ66', 0, '2023-09-15 11:29:52'),
(29, 'sadsad', 'sadsad', 'sadsad', 'jr', '3213213', 'Apil', 'asdasd@asdsad', NULL, 'user', 'inactive', NULL, 'asdsadsad', '123', 3, '2023-11-19 11:39:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `final_actions`
--
ALTER TABLE `final_actions`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `program_block`
--
ALTER TABLE `program_block`
  ADD PRIMARY KEY (`program_block_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_actions`
--
ALTER TABLE `final_actions`
  MODIFY `action_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `program_block`
--
ALTER TABLE `program_block`
  MODIFY `program_block_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `record_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
