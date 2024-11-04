-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 11, 2024 at 02:12 PM
-- Server version: 10.11.8-MariaDB
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karamelh_tradefoxdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_balance` decimal(10,2) DEFAULT 0.00,
  `bonus` decimal(15,2) NOT NULL DEFAULT 0.00,
  `eth_balance` decimal(10,2) DEFAULT 0.00,
  `btc_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `btc` decimal(10,2) NOT NULL DEFAULT 0.00,
  `eth` decimal(10,2) NOT NULL DEFAULT 0.00,
  `ltc` decimal(10,2) NOT NULL DEFAULT 0.00,
  `xrp` decimal(10,2) NOT NULL DEFAULT 0.00,
  `xmr` decimal(10,2) DEFAULT 0.00,
  `rise` decimal(10,2) NOT NULL DEFAULT 0.00,
  `bts` decimal(10,2) DEFAULT 0.00,
  `dash` decimal(10,2) NOT NULL DEFAULT 0.00,
  `demo_bal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `filename` varchar(255) DEFAULT NULL,
  `created` varchar(100) NOT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `user_id`, `account_balance`, `bonus`, `eth_balance`, `btc_balance`, `btc`, `eth`, `ltc`, `xrp`, `xmr`, `rise`, `bts`, `dash`, `demo_bal`, `filename`, `created`, `status`) VALUES
(1, 4, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2024-09-29 17:48:35', 1),
(2, 5, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, NULL, '2024-09-29 17:51:43', 0),
(3, 6, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2024-09-29 18:16:18', 0),
(4, 7, 99984.00, 220.00, 320.00, 440.00, 10.00, 20.00, 30.00, 20.00, 50.00, 40.00, 30.00, 70.00, 40000.00, 'e8de784dfbed80dfef5c2ca62edf0b12.jpg', '2024-09-29 18:34:58', 1),
(5, 8, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2024-09-29 18:37:11', 0),
(6, 9, 59764.00, 0.00, 0.00, 0.00, 599.00, 600.00, 800.00, 800.00, 678.00, 777.00, 888.00, 6777.00, 20000.00, '8e94abc6302311b8c4b4ddfebe604979.png', '2024-09-29 21:01:49', 2),
(7, 10, 3000.00, 0.00, 3000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2024-10-01 13:31:41', 0),
(8, 11, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2024-10-06 12:17:29', 0),
(9, 12, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10000.00, '18ed8f3be1874903b856d6d63cb8d69a.jpg', '2024-10-06 12:25:46', 2),
(10, 13, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2024-10-09 06:24:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `description`, `created_at`) VALUES
(0, 7, 'Account signed-in', '2024-10-06 14:44:15'),
(1, 4, 'Account was registered', '2024-09-29 17:48:35'),
(2, 5, 'Account was registered', '2024-09-29 17:51:43'),
(3, 6, 'Account was registered', '2024-09-29 18:16:18'),
(4, 7, 'Account was registered', '2024-09-29 18:34:58'),
(5, 8, 'Account was registered', '2024-09-29 18:37:11'),
(6, 9, 'Account was registered', '2024-09-29 21:01:49'),
(7, 4, 'Account signed-in', '2024-09-29 21:35:27'),
(8, 4, 'Account signed-in', '2024-09-29 21:35:38'),
(9, 5, 'Account signed-in', '2024-09-29 21:36:55'),
(10, 5, 'Account signed-in', '2024-09-29 21:37:23'),
(11, 9, 'Account signed-in', '2024-09-29 22:40:24'),
(12, 9, 'Account signed-in', '2024-09-29 22:40:44'),
(13, 10, 'Account was registered', '2024-10-01 13:31:41'),
(14, 6, 'Account signed-in', '2024-10-01 14:49:28'),
(15, 6, 'Account signed-in', '2024-10-01 14:53:49'),
(16, 7, 'Account signed-in', '2024-10-02 14:51:51'),
(17, 11, 'Account was registered', '2024-10-06 12:17:29'),
(18, 12, 'Account was registered', '2024-10-06 12:25:46'),
(19, 12, 'Account signed-in', '2024-10-06 12:30:25'),
(20, 12, 'Account signed-in', '2024-10-06 14:09:15'),
(21, 7, 'Account signed-in', '2024-10-06 14:53:19'),
(22, 7, 'Account signed-in', '2024-10-06 15:01:25'),
(23, 7, 'Account signed-in', '2024-10-06 15:15:04'),
(24, 7, 'Account signed-in', '2024-10-06 16:55:42'),
(25, 7, 'Account signed-in', '2024-10-06 17:25:39'),
(26, 12, 'Account signed-in', '2024-10-06 20:49:40'),
(27, 7, 'Account signed-in', '2024-10-07 12:56:57'),
(28, 7, 'Account signed-in', '2024-10-07 14:33:09'),
(29, 7, 'Account signed-in', '2024-10-07 14:36:31'),
(30, 7, 'Account signed-in', '2024-10-07 14:38:18'),
(31, 9, 'Account signed-in', '2024-10-07 14:41:20'),
(32, 7, 'Account signed-in', '2024-10-08 09:32:18'),
(33, 7, 'Account signed-in', '2024-10-08 10:49:51'),
(34, 9, 'Account signed-in', '2024-10-08 14:16:30'),
(35, 9, 'Account signed-in', '2024-10-08 15:44:40'),
(36, 7, 'Account signed-in', '2024-10-08 16:21:08'),
(37, 9, 'Account signed-in', '2024-10-08 16:45:26'),
(38, 9, 'Account signed-in', '2024-10-08 16:45:35'),
(39, 9, 'Account signed-in', '2024-10-08 16:47:37'),
(40, 9, 'Account signed-in', '2024-10-08 16:47:53'),
(41, 7, 'Account signed-in', '2024-10-08 16:55:36'),
(42, 7, 'Account signed-in', '2024-10-08 19:01:12'),
(43, 13, 'Account was registered', '2024-10-09 06:24:58'),
(44, 7, 'Account signed-in', '2024-10-09 11:50:31'),
(45, 7, 'Account signed-in', '2024-10-09 13:15:14'),
(46, 7, 'Account signed-in', '2024-10-09 22:35:05'),
(47, 7, 'Account signed-in', '2024-10-10 13:21:38'),
(48, 7, 'Account signed-in', '2024-10-11 06:20:25'),
(49, 7, 'Account signed-in', '2024-10-11 06:45:51'),
(50, 7, 'Account signed-in', '2024-10-11 06:51:56'),
(51, 7, 'Account signed-in', '2024-10-11 07:03:59'),
(52, 7, 'Account signed-in', '2024-10-11 07:30:56'),
(53, 7, 'Account signed-in', '2024-10-11 07:31:37'),
(54, 7, 'Account signed-in', '2024-10-11 07:32:24'),
(55, 7, 'Account signed-in', '2024-10-11 07:48:24'),
(56, 7, 'Account signed-in', '2024-10-11 10:35:51'),
(57, 7, 'Account signed-in', '2024-10-11 10:57:16'),
(58, 7, 'Account signed-in', '2024-10-11 11:00:55'),
(59, 7, 'Account signed-in', '2024-10-11 13:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2a$12$CgI3EO9lp6UgCYYwpqP4T.pfnsHUJqfBxASgN9Ymkv1Ly3MAQzfOa', '2024-09-29 11:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `demo_history`
--

CREATE TABLE `demo_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trade_type` varchar(50) NOT NULL,
  `currency_pair` varchar(20) NOT NULL,
  `trade_action` varchar(10) NOT NULL,
  `entry_price` decimal(10,2) NOT NULL,
  `stop_loss` decimal(10,2) NOT NULL,
  `take_profit` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_deposit` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_verify` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` enum('PENDING','COMPLETED','CANCELED','EXPIRED') DEFAULT 'PENDING',
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `user_id`, `payment_method`, `amount`, `total_deposit`, `payment_verify`, `created_at`, `status`, `code`) VALUES
(1, 7, 'USDT', 50000.00, 0.00, '4c9bb0bf6ad70a7b4afd40b20091b7f6.png', '2024-10-02 14:52:29', 'COMPLETED', NULL),
(2, 12, 'USDT', 60.00, 0.00, 'f706ea0ac8056deaadb67fc94e90cd05.png', '2024-10-06 12:41:24', 'COMPLETED', NULL),
(3, 7, 'USDT', 1000.00, 0.00, '5cbaac86ff8252b8972c83a5ec798e82.jpeg', '2024-10-06 17:33:05', 'COMPLETED', NULL),
(4, 9, 'USDT', 5000.00, 0.00, 'c1ed674041e0cb7cdf268530de754698.png', '2024-10-07 14:49:22', 'COMPLETED', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deposit_method`
--

CREATE TABLE `deposit_method` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposit_method`
--

INSERT INTO `deposit_method` (`id`, `address`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'USDT', 1, '2024-10-02 13:19:39', '2024-10-02 13:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `mining`
--

CREATE TABLE `mining` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(50) DEFAULT NULL,
  `deposit` decimal(10,2) NOT NULL,
  `payment_verify` varchar(255) DEFAULT NULL,
  `asset` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mining`
--

INSERT INTO `mining` (`id`, `user_id`, `amount`, `payment_method`, `deposit`, `payment_verify`, `asset`, `created_at`, `status`) VALUES
(1, 7, 0.00, 'USDT', 60.00, '1f17968c9c1b951631e8a151d1ae3cfd.png', 'XMR', '2024-10-02 18:25:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nft`
--

CREATE TABLE `nft` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nft`
--

INSERT INTO `nft` (`id`, `name`, `price`, `img_url`, `created_at`) VALUES
(1, 'mini', 23.00, 'https://app.trustworthytraders.com/nft/4d45acb903bcc174e1a8b1ba92aaacdc.jpg', '2024-10-02 18:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `notification_title` varchar(255) NOT NULL,
  `notification_message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `message`, `notification_title`, `notification_message`, `status`, `created`, `created_at`) VALUES
(1, 4, NULL, '', '', 0, '2024-09-29 17:48:35', '2024-09-29 19:48:35'),
(2, 5, NULL, '', '', 0, '2024-09-29 17:51:43', '2024-09-29 19:51:43'),
(3, 6, NULL, '', '', 0, '2024-09-29 18:16:18', '2024-09-29 20:16:18'),
(4, 7, NULL, 'Credit', 'ss', 0, '2024-09-29 18:34:58', '2024-09-29 20:34:58'),
(5, 8, NULL, '', '', 0, '2024-09-29 18:37:11', '2024-09-29 20:37:11'),
(6, 9, NULL, 'Congratulations', 'Your account has been funded with 20 000 Dollars,  click on the link below www.mybank.com to login and transfer this fund to your local bank', 1, '2024-09-29 21:01:49', '2024-09-29 23:01:49'),
(7, 10, NULL, '', '', 0, '2024-10-01 13:31:41', '2024-10-01 15:31:41'),
(8, 11, NULL, '', '', 0, '2024-10-06 12:17:29', '2024-10-06 12:17:29'),
(9, 12, NULL, '', '', 0, '2024-10-06 12:25:46', '2024-10-06 12:25:46'),
(10, 13, NULL, '', '', 0, '2024-10-09 06:24:58', '2024-10-09 06:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `minimum_deposit` decimal(10,2) NOT NULL,
  `days` int(11) NOT NULL,
  `roi` decimal(5,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `minimum_deposit`, `days`, `roi`, `created_at`, `updated_at`) VALUES
(1, 'Starter', 36.00, 12, 2.00, '2024-10-06 13:29:03', '2024-10-06 13:29:03'),
(2, 'Biz Plan', 33.00, 2, 2.00, '2024-10-06 13:46:10', '2024-10-06 13:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `rates` decimal(10,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `btc_wallet` varchar(255) NOT NULL,
  `eth_wallet` varchar(255) NOT NULL,
  `solana_wallet` varchar(255) NOT NULL,
  `ada_wallet` varchar(255) NOT NULL,
  `doge_wallet` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `btc_wallet`, `eth_wallet`, `solana_wallet`, `ada_wallet`, `doge_wallet`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 'fghjk', 'fghjfgh', 'ghjghj', 'ghjghjk', 'fghj', '', '', 'fghj', '2024-09-29 21:39:40', '2024-09-29 21:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `plan_id`, `amount`, `created_at`) VALUES
(1, 7, 2, 800.00, '2024-10-06 15:14:21'),
(2, 12, 1, 50.00, '2024-10-06 20:50:30'),
(3, 12, 1, 50.00, '2024-10-06 20:53:49'),
(4, 9, 1, 36.00, '2024-10-08 15:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `traders`
--

CREATE TABLE `traders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `win_rate` decimal(5,2) NOT NULL,
  `profit_share` decimal(5,2) NOT NULL,
  `wins` int(11) DEFAULT 0,
  `losses` int(11) DEFAULT 0,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `traders`
--

INSERT INTO `traders` (`id`, `name`, `img_url`, `win_rate`, `profit_share`, `wins`, `losses`, `status`, `created_at`) VALUES
(2, 'Muzz', 'uploads/66fd7d232aa64logo.png', 20.00, 70.00, 11, 0, 'Enable', '2024-10-02 18:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `trade_history`
--

CREATE TABLE `trade_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trade_type` varchar(50) DEFAULT NULL,
  `currency_pair` varchar(50) DEFAULT NULL,
  `lot_size` decimal(10,2) DEFAULT NULL,
  `entry_price` decimal(10,2) DEFAULT NULL,
  `stop_loss` decimal(10,2) DEFAULT NULL,
  `take_profit` decimal(10,2) DEFAULT NULL,
  `trade_action` enum('Buy','Sell') DEFAULT NULL,
  `trade_profit` decimal(10,2) DEFAULT NULL,
  `trade_result` enum('Win','Lose') DEFAULT 'Lose',
  `created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trade_history`
--

INSERT INTO `trade_history` (`id`, `user_id`, `trade_type`, `currency_pair`, `lot_size`, `entry_price`, `stop_loss`, `take_profit`, `trade_action`, `trade_profit`, `trade_result`, `created`) VALUES
(1, 10, 'Crypto/Forex', 'USDT/DOGE', 2.00, 500.00, 0.53, 1.00, 'Buy', NULL, 'Lose', '2024-10-01 13:44:34'),
(2, 10, 'Crypto/Forex', 'USDT/DOGE', 2.00, 500.00, 0.53, 1.00, 'Buy', NULL, 'Lose', '2024-10-01 13:48:12'),
(3, 10, 'Crypto/Forex', 'BTC/USD', 5.00, 5000.00, 0.53, 1.00, 'Sell', NULL, 'Lose', '2024-10-01 13:49:14'),
(4, 7, 'Crypto/Forex', 'NZD/CHF', 2.00, 5566.00, 3.00, 2.00, 'Buy', NULL, 'Lose', '2024-10-02 18:21:04'),
(5, 9, 'Crypto', 'BTC/USD', 5.00, 400.00, 1.00, 1.14, 'Buy', NULL, 'Lose', '2024-10-07 14:57:29'),
(6, 9, 'Crypto/Forex', 'BTC/USDT', 15.00, 1300.00, 2.00, 2.00, 'Sell', 56000.00, 'Win', '2024-10-08 13:06:17'),
(7, 9, 'Crypto', 'ETH/USD', 15.00, 600.00, 1.00, 1.14, 'Sell', NULL, 'Lose', '2024-10-08 15:49:08'),
(8, 7, 'Forex', 'AUD/USD', 2.00, 200.00, 1.00, 1.00, 'Buy', NULL, 'Lose', '2024-10-11 06:47:32'),
(9, 7, 'Forex', 'GBP/AUD', 2.00, 1000.00, 1.00, 1.00, 'Sell', NULL, 'Lose', '2024-10-11 07:08:31'),
(10, 7, 'Forex', 'GBP/USD', 2.00, 200.00, 1.00, 5.00, 'Buy', NULL, 'Lose', '2024-10-11 07:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `trading`
--

CREATE TABLE `trading` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `asset` varchar(100) NOT NULL,
  `count` varchar(255) NOT NULL,
  `inc` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trading`
--

INSERT INTO `trading` (`id`, `user_id`, `amount`, `asset`, `count`, `inc`, `status`, `created_at`) VALUES
(1, 7, 55.00, 'gold', '', '', 1, '2024-10-02 14:50:14'),
(4, 7, 5555.00, 'BTC', '120', '46.291666666667', 1, '2024-10-02 15:54:40'),
(5, 9, 5000.00, 'BTC', '60', '83.333333333333', 1, '2024-10-07 13:53:10'),
(6, 9, 2500.00, 'ETH', '60', '41.666666666667', 1, '2024-10-08 12:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `security_question` varchar(255) DEFAULT NULL,
  `security_answer` varchar(255) DEFAULT NULL,
  `password` varchar(500) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `last_login` varchar(100) DEFAULT NULL,
  `walletph` varchar(255) DEFAULT NULL,
  `wall_name` varchar(100) DEFAULT NULL,
  `date_registered` datetime DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `gender`, `phone`, `country`, `security_question`, `security_answer`, `password`, `password_hash`, `ip_address`, `last_login`, `walletph`, `wall_name`, `date_registered`, `status`) VALUES
(4, 'temexx6', 'Temiloluwa', 'iyiolatemiloluwa8@gmail.com', 'Male', NULL, 'Nigeria', '5', 'Graceland', '3PkEMXyETYMaJ6F', '$2y$10$WPLa5kIyKmACwf96ISKbA.Yn9bEvhrDAR87voA3i4xYs8sl.Xt1m.', '102.89.75.218', '2024-09-29 21:35:38', NULL, NULL, '2024-09-29 17:48:35', 1),
(5, 'temexx876', 'Temiloluwa', 'iyiolatemiloluwa564@gmail.com', 'Male', NULL, 'Nigeria', '5', 'Graceland', '5zHHGdzTqiZvk3U', '$2y$10$omFPnzrSnCUsr8a48KNYWOH2TgY7XcAfjsynljE5IOtUQvtjaySte', '102.89.75.218', '2024-09-29 21:37:23', NULL, NULL, '2024-09-29 17:51:43', 1),
(6, 'temexgreat', 'Temiloluwa Iyiola', 'iyiolatemiloluwa0@gmail.com', 'Male', NULL, 'Nigeria', '5', 'Graceland ', 'meC9EH8MPp28t8K', '$2y$10$2s7ghRP4Ss3/NoTbc.jtHeSN6.b3n63MnTj/v/1hDOTd.wqAK1G.W', '102.89.76.186', '2024-10-01 14:53:49', NULL, NULL, '2024-09-29 18:16:18', 1),
(7, 'user', 'user user', 'user@mail.com', 'Female', NULL, 'Cook Islands', '3', 'ccccc', '123456', '$2a$12$CgI3EO9lp6UgCYYwpqP4T.pfnsHUJqfBxASgN9Ymkv1Ly3MAQzfOa', '197.211.52.69', '2024-10-11 13:24:26', 'Fhdhdh dhdbdbdb hdjdj jdjdj hdje', 'Trust wallet', '2024-09-29 18:34:58', 1),
(8, 'luciano', 'Collins Collins', 'teamrescue251@gmail.com', 'Male', NULL, 'Nigeria', '1', 'Texas', '123456789', '$2y$10$4wVSXaSFFP6LJl0GJ2nVTeO6iPlzO7nPhZt0/Wo0mGOnrsv1ROot.', '102.90.42.239', NULL, NULL, NULL, '2024-09-29 18:37:11', 1),
(9, 'adislove', 'pro', 'gseun129@gmail.com', 'Female', NULL, 'Armenia', '1', 'ben', '12345678', '$2y$10$KUGvLc.cy4EYrM9G/NP5Ne8kWQfLI5ePCgRgPyYCSgts8cVzUnWlu', '2.98.93.181', '2024-10-08 16:47:53', 'sdvvf', 'sdvv ', '2024-09-29 21:01:49', 1),
(10, 'temexfast', 'Temiloluwa Iyiola', 'iyiolatemiloluwa34@gmail.com', 'Male', NULL, 'Nigeria', '6', 'Oba', 'N2LcfXinhbJjjdR', '$2y$10$neRUqA5anD9SBFLT73pQNe4qryD.bHpIvNxv2qO/AI/bT2ZVDpNaO', '102.89.76.186', NULL, NULL, NULL, '2024-10-01 13:31:41', 1),
(11, 'bright', 'John peter', 'bryte44e@gmail.com', 'Male', NULL, 'Ivory Coast', '1', 'benin', '12345678', '$2y$10$82exSTkfdHH9sEo484a9/eG3JJZdLddGPYmhJvP2nMW0YfNx81FD.', '1', NULL, NULL, NULL, '2024-10-06 12:17:29', 1),
(12, 'bryte', 'Eva Johnson', 'brytedree@gmail.com', 'Male', NULL, 'Antarctica', '1', 'benin', '12345678', '$2y$10$B8lkhGEyWlDnsj2DUft6petQQYNgXpWUftW2BsGOqVk3dmGmKaU4a', '105.112.209.67', '2024-10-06 20:49:40', 'dkd dkd kdkd d', 'trust', '2024-10-06 12:25:46', 1),
(13, 'Erigga', 'Danj', 'cschgga@gmail.com', 'Male', NULL, 'United States', '5', 'Okoafo', 'EriggA200@@', '$2y$10$mHHexUchXbXVIquhdszQSehoV3A8b74SrBxEXIDYoEFkdrwYiUEjy', '102.88.71.180', NULL, NULL, NULL, '2024-10-09 06:24:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_copy_trade`
--

CREATE TABLE `user_copy_trade` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_nft`
--

CREATE TABLE `user_nft` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nft_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_nft`
--

INSERT INTO `user_nft` (`id`, `user_id`, `nft_id`) VALUES
(1, 7, 1),
(2, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal`
--

CREATE TABLE `withdrawal` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `withdrawal_method` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` enum('PENDING','COMPLETED','FAILED') DEFAULT 'PENDING',
  `bitcoin_address` varchar(255) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawal`
--

INSERT INTO `withdrawal` (`id`, `user_id`, `withdrawal_method`, `amount`, `created_at`, `status`, `bitcoin_address`, `bank_name`, `account_name`, `account_number`) VALUES
(1, 7, 'usdt', 44.00, '2024-10-02 18:13:10', 'PENDING', 'xxxxxxx', 'xxxxx', 'xxxxxxxxx', 'xxxxx'),
(2, 9, 'bitcoin', 1500.00, '2024-10-08 14:18:49', 'PENDING', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `demo_history`
--
ALTER TABLE `demo_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `deposit_method`
--
ALTER TABLE `deposit_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mining`
--
ALTER TABLE `mining`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nft`
--
ALTER TABLE `nft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `traders`
--
ALTER TABLE `traders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_history`
--
ALTER TABLE `trade_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `trading`
--
ALTER TABLE `trading`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_copy_trade`
--
ALTER TABLE `user_copy_trade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `trader_id` (`trader_id`);

--
-- Indexes for table `user_nft`
--
ALTER TABLE `user_nft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `nft_id` (`nft_id`);

--
-- Indexes for table `withdrawal`
--
ALTER TABLE `withdrawal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `demo_history`
--
ALTER TABLE `demo_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deposit_method`
--
ALTER TABLE `deposit_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mining`
--
ALTER TABLE `mining`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nft`
--
ALTER TABLE `nft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `traders`
--
ALTER TABLE `traders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trade_history`
--
ALTER TABLE `trade_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trading`
--
ALTER TABLE `trading`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_copy_trade`
--
ALTER TABLE `user_copy_trade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_nft`
--
ALTER TABLE `user_nft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdrawal`
--
ALTER TABLE `withdrawal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `demo_history`
--
ALTER TABLE `demo_history`
  ADD CONSTRAINT `demo_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `deposit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mining`
--
ALTER TABLE `mining`
  ADD CONSTRAINT `mining_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `packages` (`id`);

--
-- Constraints for table `trade_history`
--
ALTER TABLE `trade_history`
  ADD CONSTRAINT `trade_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trading`
--
ALTER TABLE `trading`
  ADD CONSTRAINT `trading_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_copy_trade`
--
ALTER TABLE `user_copy_trade`
  ADD CONSTRAINT `user_copy_trade_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_copy_trade_ibfk_2` FOREIGN KEY (`trader_id`) REFERENCES `traders` (`id`);

--
-- Constraints for table `user_nft`
--
ALTER TABLE `user_nft`
  ADD CONSTRAINT `user_nft_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_nft_ibfk_2` FOREIGN KEY (`nft_id`) REFERENCES `nft` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdrawal`
--
ALTER TABLE `withdrawal`
  ADD CONSTRAINT `withdrawal_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
