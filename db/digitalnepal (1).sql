-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2018 at 06:15 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digitalnepal`
--

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `channel_id` int(11) NOT NULL,
  `channel_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `channel_type` enum('F','P') COLLATE utf8_unicode_ci NOT NULL,
  `channel_record` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `channel_finger` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `channel_grade` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `channel_preview` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `channel_acdata` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `channel_flag` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`channel_id`, `channel_name`, `channel_type`, `channel_record`, `channel_finger`, `channel_grade`, `channel_preview`, `channel_acdata`, `channel_flag`, `created_at`, `updated_at`) VALUES
(1, 'Sports HD', 'F', '0', '1', '0', '1', 'what', '1', '2018-09-09 01:32:22', '2018-09-09 01:32:22'),
(2, 'Sony HD', 'P', '1', '1', '1', '1', 'what data', '1', '2018-09-09 03:34:18', '2018-09-09 03:42:05'),
(3, 'HBO', 'F', '1', '1', '1', '1', 'dfa', '1', '2018-09-11 01:45:09', '2018-09-11 01:45:09'),
(4, 'MTV', 'F', '1', '1', '1', '1', 's', '1', '2018-09-11 01:45:30', '2018-09-11 01:45:30'),
(5, 'VH1', 'F', '1', '1', '1', '1', 'a', '1', '2018-09-11 01:45:42', '2018-09-11 01:45:42'),
(6, 'Cinemax', 'P', '1', '0', '0', '1', 'dfa', '1', '2018-09-11 01:51:39', '2018-09-11 01:51:39'),
(7, 'AXN', 'F', '1', '1', '1', '1', 'ds', '1', '2018-09-24 01:31:44', '2018-09-24 01:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `commission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `commission_amount` float NOT NULL,
  `commission_from` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `purchase_type` enum('P','T') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `commission`
--

INSERT INTO `commission` (`commission_id`, `user_id`, `commission_amount`, `commission_from`, `purchase_id`, `purchase_type`, `created_at`, `updated_at`) VALUES
(31, 1, 1000, 2, 30, 'P', '2018-11-02 08:43:13', '2018-11-02 08:43:13'),
(32, 5, 150, 8, 30, 'P', '2018-11-02 08:43:13', '2018-11-02 08:43:13'),
(33, 2, 500, 3, 30, 'P', '2018-11-02 08:43:13', '2018-11-02 08:43:13'),
(34, 3, 250, 5, 30, 'P', '2018-11-02 08:43:13', '2018-11-02 08:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `commission_rate`
--

CREATE TABLE `commission_rate` (
  `rate_id` int(11) NOT NULL,
  `rate_percent` float NOT NULL,
  `user_type` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `commission_rate`
--

INSERT INTO `commission_rate` (`rate_id`, `rate_percent`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 10, 'F', '2018-10-29 08:22:19', '2018-10-29 08:22:19'),
(2, 5, 'D', '2018-10-29 08:22:19', '2018-10-29 08:22:19'),
(3, 3, 'S', '2018-10-29 08:22:19', '2018-10-29 08:22:19'),
(4, 20, 'A', '2018-11-02 06:21:21', '2018-11-02 06:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `deposit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deposit_amount` float NOT NULL,
  `deposit_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`deposit_id`, `user_id`, `deposit_amount`, `deposit_type`, `created_at`, `updated_at`) VALUES
(1, 1, 200000, 'T', '2018-10-02 01:19:45', '2018-10-04 04:59:59'),
(2, 5, 100000, 'D', '2018-11-05 00:04:29', '2018-11-05 00:04:29'),
(3, 5, 100000, 'S', '2018-11-05 00:04:55', '2018-11-05 00:04:55'),
(4, 5, 200000, 'T', '2018-11-05 00:05:08', '2018-11-05 00:05:08'),
(5, 2, 40000000, 'S', '2018-11-05 00:08:32', '2018-11-05 00:11:12'),
(6, 2, 10000000, 'D', '2018-11-05 00:08:43', '2018-11-05 00:08:43'),
(7, 2, 200000000, 'T', '2018-11-05 00:08:52', '2018-11-05 00:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `package_price` float NOT NULL,
  `package_activeprice` float NOT NULL,
  `package_sage` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `package_order` int(11) NOT NULL,
  `package_status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `package_autoactive` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `package_name`, `package_price`, `package_activeprice`, `package_sage`, `package_order`, `package_status`, `package_autoactive`, `created_at`, `updated_at`) VALUES
(1, 'Free Package', 0, 0, 'test', 1, '1', 1, '2018-09-10 23:24:50', '2018-09-11 05:09:50'),
(2, 'HD Package', 5000, 0, 'HD', 2, '1', 1, '2018-09-10 23:25:34', '2018-09-12 05:28:31'),
(3, 'Sports', 1000, 0, 'daf', 3, '1', 1, '2018-09-12 02:05:40', '2018-09-12 07:50:40'),
(7, 'Music', 200, 0, 'dfs', 4, '1', 1, '2018-09-12 02:11:57', '2018-09-12 07:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `package_channel`
--

CREATE TABLE `package_channel` (
  `pc_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `package_channel`
--

INSERT INTO `package_channel` (`pc_id`, `package_id`, `channel_id`, `created_at`, `updated_at`) VALUES
(18, 2, 2, '2018-09-11 10:50:05', '2018-09-11 10:50:05'),
(19, 2, 1, '2018-09-11 10:50:05', '2018-09-11 10:50:05'),
(20, 1, 6, '2018-09-11 10:50:13', '2018-09-11 10:50:13'),
(21, 1, 3, '2018-09-11 10:50:13', '2018-09-11 10:50:13'),
(22, 1, 4, '2018-09-11 10:50:13', '2018-09-11 10:50:13'),
(23, 1, 5, '2018-09-11 10:50:13', '2018-09-11 10:50:13'),
(31, 7, 4, '2018-09-12 07:57:05', '2018-09-12 07:57:05'),
(32, 7, 5, '2018-09-12 07:57:05', '2018-09-12 07:57:05'),
(35, 3, 1, '2018-09-14 06:12:25', '2018-09-14 06:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `package_stb`
--

CREATE TABLE `package_stb` (
  `ps_id` int(11) NOT NULL,
  `stb_no` bigint(20) NOT NULL,
  `buy_date` date NOT NULL,
  `start_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `price_id` int(11) NOT NULL,
  `price_rate` float NOT NULL,
  `price_type` enum('D','E') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price_id`, `price_rate`, `price_type`, `created_at`, `updated_at`) VALUES
(1, 3500, 'D', '2018-11-02 06:56:02', '2018-11-02 06:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `stb`
--

CREATE TABLE `stb` (
  `stb_id` int(11) NOT NULL,
  `stb_number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `stb_status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stb`
--

INSERT INTO `stb` (`stb_id`, `stb_number`, `stb_status`, `created_at`, `updated_at`) VALUES
(1, '100000', '1', '2018-10-12 02:14:06', '2018-10-12 02:14:06'),
(2, '100001', '1', '2018-10-12 02:14:06', '2018-10-12 02:14:06'),
(3, '100002', '1', '2018-10-12 02:14:06', '2018-10-12 02:14:06'),
(4, '100003', '1', '2018-10-12 02:14:06', '2018-10-12 02:14:06'),
(5, '100004', '1', '2018-10-12 02:14:06', '2018-10-12 02:14:06'),
(6, '100005', '1', '2018-10-12 02:14:06', '2018-10-12 02:14:06'),
(7, '100006', '1', '2018-10-12 02:14:06', '2018-10-12 02:14:06'),
(8, '100007', '1', '2018-10-12 02:14:06', '2018-10-12 02:14:06'),
(9, '100008', '1', '2018-10-12 02:14:06', '2018-10-12 02:14:06'),
(10, '200000', '1', '2018-10-12 02:19:51', '2018-10-12 02:19:51'),
(11, '200001', '1', '2018-10-12 02:19:51', '2018-10-12 02:19:51'),
(12, '200002', '1', '2018-10-12 02:19:51', '2018-10-12 02:19:51'),
(13, '200003', '1', '2018-10-12 02:19:51', '2018-10-12 02:19:51'),
(14, '200004', '1', '2018-10-12 02:19:51', '2018-10-12 02:19:51'),
(15, '200005', '1', '2018-10-12 02:19:51', '2018-10-12 02:19:51'),
(16, '200006', '1', '2018-10-12 02:19:51', '2018-10-12 02:19:51'),
(17, '200007', '1', '2018-10-12 02:19:51', '2018-10-12 02:19:51'),
(18, '200008', '1', '2018-10-12 02:19:51', '2018-10-12 02:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `stb_card`
--

CREATE TABLE `stb_card` (
  `card_id` int(11) NOT NULL,
  `card_number` bigint(20) NOT NULL,
  `card_status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stb_purchase`
--

CREATE TABLE `stb_purchase` (
  `purchase_id` int(11) NOT NULL,
  `stb_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_expire` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stb_purchase`
--

INSERT INTO `stb_purchase` (`purchase_id`, `stb_id`, `user_id`, `seller_id`, `package_id`, `purchase_date`, `purchase_expire`, `created_at`, `updated_at`) VALUES
(30, 1, 8, 5, 2, '2018-11-02', '2018-11-30', '2018-11-02 02:58:13', '2018-11-02 02:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `stb_record`
--

CREATE TABLE `stb_record` (
  `stb_id` int(11) NOT NULL,
  `stb_no` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stb_status` tinyint(4) NOT NULL,
  `exec_date` date NOT NULL,
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `expire_date` date NOT NULL DEFAULT '0000-00-00',
  `assigned_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stb_record`
--

INSERT INTO `stb_record` (`stb_id`, `stb_no`, `user_id`, `stb_status`, `exec_date`, `start_date`, `expire_date`, `assigned_by`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 1, '2018-11-02', '2018-11-02', '2019-03-20', 1, '2018-11-01 23:21:27', '2018-11-01 23:21:27'),
(3, 2, 2, 1, '2018-11-02', '2018-11-02', '2019-03-31', 1, '2018-11-01 23:31:01', '2018-11-01 23:31:01'),
(4, 3, 2, 1, '2018-11-02', '2018-11-02', '2018-11-30', 1, '2018-11-01 23:41:01', '2018-11-01 23:41:01'),
(5, 1, 3, 1, '2018-11-02', '2018-11-02', '2018-11-30', 2, '2018-11-01 23:58:38', '2018-11-01 23:58:38'),
(6, 2, 3, 1, '2018-11-02', '2018-11-02', '2018-11-30', 2, '2018-11-02 00:06:32', '2018-11-02 00:06:32'),
(7, 1, 5, 1, '2018-11-02', '2018-11-02', '2018-11-30', 3, '2018-11-02 00:07:13', '2018-11-02 00:07:13'),
(8, 2, 5, 1, '2018-11-02', '2018-11-02', '2018-11-30', 3, '2018-11-02 00:07:27', '2018-11-02 00:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('A','G','S','D','F','R') COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `parent`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$NN5Mttw2pM4Tg8Zsvn.JveAzsGFO1yeRdVn6CGfhOChVcPqnOY1nG', 'A', 0, 'v0erSYN9PsPCLTlT7kRocTEcb3rmgh7i8MO5ZXbabijiGstOeWHewY5PW3yG', '2018-08-08 23:19:34', '2018-08-08 23:19:34'),
(2, 'Digicon', 'contact@digicon.com', '$2y$10$8pTLWEZAiNCsisPIVPxqpu73TALTrbtYtjHMBn5E5yKRtKzG5qByC', 'F', 1, 'bF5EgCe7nUDJfD0Kte6gFrFnbCpFQir2eWrrdsfwOthfJFrZaFuIdoXWycpG', '2018-08-21 03:13:47', '2018-10-31 23:19:00'),
(3, 'Krishna Distributors', 'krishnadistributor@gmail.com', '$2y$10$bKYJmA/ZtGXmvuyF/Q7fKOXOjf4wKDKrlSais9XYRNAoTdm6c37Ie', 'D', 2, '3CgOnosT8zC812ODBbqs491OKCobakwBNlLhERfXEunsriJltr0sQECbd9fm', '2018-09-07 00:23:49', '2018-10-31 23:29:08'),
(4, 'Akshya Shrestha', 'akshya@gmail.com', '$2y$10$Pgv6ixXypA0zvD6fVpsyneTC9N6ZX.L1cRh.SznvjGpeRQWAc2LgG', 'R', 1, NULL, '2018-09-07 00:28:04', '2018-09-14 01:09:53'),
(5, 'babita enterprise', 'info@babita.com', '$2y$10$EoLLJ66rKX6.ibHtym43aOW9Asw7Z2KBX.rwmdZRB2TYPm.p.lVKG', 'S', 3, NULL, '2018-10-31 23:30:05', '2018-10-31 23:30:05'),
(6, 'Radhakirshna Shrestha', 'radha@gmail.com', '$2y$10$V2uao9BjaT/ZOjY0NqAfkOZQSmFbLQT/KswkaHow8Bp4SPPtLifPq', 'R', 5, NULL, '2018-10-31 23:31:03', '2018-10-31 23:31:03'),
(7, 'Balkrishna Manandhar', 'bal@gmail.com', '$2y$10$67WFAgim9How2V2xnhEis..KVguav5K5BMCEWXm4ll.9yE4ZjFOW6', 'R', 5, NULL, '2018-11-02 01:54:27', '2018-11-02 01:54:27'),
(8, 'Diya Maskey', 'maskey.diya@gmail.com', '$2y$10$H8whE3NZDcT9k6ADKWTHQuNd3ONrAXwha2nMGWWzJd/QySkJlBofK', 'R', 5, NULL, '2018-11-02 02:46:56', '2018-11-02 02:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `wallet_id` int(11) NOT NULL,
  `wallet_amount` float NOT NULL,
  `wallet_from` int(11) NOT NULL,
  `wallet_to` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`wallet_id`, `wallet_amount`, `wallet_from`, `wallet_to`, `created_at`, `updated_at`) VALUES
(1, 40000, 1, 2, '2018-10-02 05:09:05', '2018-10-02 05:22:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`channel_id`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`commission_id`);

--
-- Indexes for table `commission_rate`
--
ALTER TABLE `commission_rate`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`deposit_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `package_channel`
--
ALTER TABLE `package_channel`
  ADD PRIMARY KEY (`pc_id`);

--
-- Indexes for table `package_stb`
--
ALTER TABLE `package_stb`
  ADD PRIMARY KEY (`ps_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `stb`
--
ALTER TABLE `stb`
  ADD PRIMARY KEY (`stb_id`);

--
-- Indexes for table `stb_card`
--
ALTER TABLE `stb_card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `stb_purchase`
--
ALTER TABLE `stb_purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `stb_record`
--
ALTER TABLE `stb_record`
  ADD PRIMARY KEY (`stb_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `commission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `commission_rate`
--
ALTER TABLE `commission_rate`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `deposit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `package_channel`
--
ALTER TABLE `package_channel`
  MODIFY `pc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `package_stb`
--
ALTER TABLE `package_stb`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stb`
--
ALTER TABLE `stb`
  MODIFY `stb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `stb_card`
--
ALTER TABLE `stb_card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stb_purchase`
--
ALTER TABLE `stb_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `stb_record`
--
ALTER TABLE `stb_record`
  MODIFY `stb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
