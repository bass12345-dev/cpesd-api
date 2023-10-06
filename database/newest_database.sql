-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2023 at 01:03 PM
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
(1, '500987727', '', 11, 3, 1, 'QR-1559432582.png', '2022-04-18 10:23:27'),
(2, '1291939210', '', 11, 3, 1, 'QR-1581740473.png', '2022-04-18 11:32:16'),
(3, '123', 'sadsad', 9, 1, 2, NULL, '2023-06-19 13:35:39'),
(4, '123', 'asdsad', 9, 1, 2, 'asdsad', '2023-06-19 13:35:39'),
(5, '123', 'asdasd', 9, 1, 2, 'asdasd', '2023-06-19 13:35:39'),
(6, '123', 'sample', 9, 1, 2, 'asdasdasdsad', '2023-06-19 13:35:39');

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
(7, 'DASDSA', '2022-04-19 15:37:31'),
(8, 'asdas', '2023-06-19 13:35:39'),
(11, 'wqewqeqw', '2023-06-19 13:35:39');

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
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `t_number` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `typ_id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `office1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `office2` int(11) NOT NULL,
  `status` set('to-receive','received','to-hold','hold','to-complete','completed') NOT NULL,
  `received_status` int(11) NOT NULL,
  `received_date` datetime NOT NULL,
  `release_status` int(11) NOT NULL,
  `release_date` datetime NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `t_number`, `f_id`, `typ_id`, `user1`, `office1`, `user2`, `office2`, `status`, `received_status`, `received_date`, `release_status`, `release_date`, `remarks`) VALUES
(1, 500987727, 1, 1, 11, 3, 11, 3, 'received', 1, '2022-04-18 10:23:28', 1, '2022-04-18 10:23:28', '');

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
(1, 'hey', '2022-04-06 07:52:52', 'active'),
(2, 'Assesor', '2022-04-06 07:54:50', 'active'),
(3, 'IT', '2022-04-06 07:55:03', 'active'),
(17, 'asdsa', '2023-06-19 13:35:39', 'active'),
(18, 'asdasd', '2023-06-19 13:35:39', 'active');

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
  `created_at` datetime DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `person_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`first_name`, `middle_name`, `last_name`, `extension`, `phone_number`, `email_address`, `address`, `created_at`, `status`, `person_id`) VALUES
('Basil John', 'C.', 'Manabo', '', '0912323213', 'manabobasil@gmail.com', 'Tuyabang Bajo', '2023-06-19 13:35:39', 'active', 1),
('juan', NULL, 'manabo', NULL, NULL, NULL, 'Lower Lamac', '2023-06-19 13:35:39', 'inactive', 9),
('Basil John', 'C.', 'Manabo', NULL, '0912323213', 'manabobasil@gmail.com', 'Tuyabang Bajo', NULL, 'active', 11),
('Juan', NULL, 'manabo', NULL, NULL, NULL, 'Lower Lamac', NULL, 'active', 12),
('Juan', NULL, 'manabo', NULL, NULL, NULL, 'Lower Lamac', NULL, 'active', 13),
('asdsad', NULL, 'sdsd', NULL, NULL, NULL, 'Mialen', '2023-06-19 13:35:39', 'active', 14);

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
(10, 1, 'asdsadasdasdas asdasdasdasdsad asdasdasdasdsadas asdasdasdsadsad asdasdasdsad asdasd', '2023-06-19 13:35:39'),
(11, 1, 'xzdxZxcZX', '2023-06-19 13:35:39'),
(19, 1, 'asdasd', '2023-06-19 13:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `security`
--

CREATE TABLE `security` (
  `security_code` int(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `security`
--

INSERT INTO `security` (`security_code`, `updated`) VALUES
(123, '2023-10-03 03:11:38');

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
(8, 'Mark Anthony', '', 'Artigas', '', '0905788844', 'Binuangan', 'markeeboi1985@gmail.com', NULL, 'admin', 'active', NULL, 'markuser', '$2y$10$LNjjAwAdQazQMF22UnUCde32RHVohPL3QPjpQ2tJMkH4xswinXPu6', 0, '2023-04-06 16:32:32'),
(9, 'Basil John', 'C.', 'Manabo', '', '0912321321', 'Lower Rizal', 'manabobasil@gmail.com', NULL, 'user', 'active', NULL, 'basiluser', '$2y$10$NramshA6AyXZvQXyC5rtHONDg5FEITqcdfxzDkhwJ9mwQBnvNCapa', 1, '2023-04-07 03:04:02'),
(12, 'Katlyn Mary', '', 'Daraman', '', '0963936232', 'Canubay', 'daraman.cp', NULL, 'user', 'active', 'jo', 'katlyn1388', '$2y$10$HU/SEKRHDbELpPI10DLnx.EjP2uh0akDblmg0o1vES9lHPRc47xkC', 0, '2023-05-05 05:00:46'),
(13, 'Judith', 'P.', 'Abuhon', '', '09107324580', 'Villaflor', 'abuhon.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'ram_tom', '$2y$10$TE3O7GRzGKGl18SRaGV9s.u7BpPN.Fsv/YHAujQXEhROnnfAm1Xbm', 0, '2023-05-05 07:01:00'),
(14, 'Sheila Marie', '', 'Daque', '', '09516531821', 'Lower Loboc', 'daquesheilamarie@gmail.com', NULL, 'user', 'active', 'jo', 'Shelayla', '$2y$10$Md/bS.rZKXp/HDAuIkoXgOR9iwbLGGli51TY8kGiSJZZ3yyZzZsGe', 0, '2023-05-05 07:23:18'),
(15, 'Cel', 'Betero', 'Chua', '', '0912789660', 'Talairon', 'chua.cpesd', NULL, 'user', 'active', 'jo', 'Choyerns', '$2y$10$LNjjAwAdQazQMF22UnUCde32RHVohPL3QPjpQ2tJMkH4xswinXPu6', 0, '2023-05-05 07:25:12'),
(16, 'WIENGELYN', 'MILO', 'IBASAN', '', '0912367928', 'Tipan', 'ibasan.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'Wiengy ', '$2y$10$QsoMylmly4nLdJSS318MReBYY1a7wkNKdaGE/g7SsQvt4gJD2sS5O', 0, '2023-05-05 07:27:14'),
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
(28, 'Joseph', 'L.', 'Buta', '', '09079187139', 'Upper Lamac', 'butajoseph8@gmail.com', NULL, 'user', 'active', 'jo', 'joseph@27', '$2y$10$y0fsDNdgBCB5ncORG.75pOAPy2uIjN0qDpwZR3/JoeEh7ng44aJ66', 0, '2023-09-15 11:29:52');

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
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `person_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `record_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
