-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2026 at 07:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mineguard`
--

-- --------------------------------------------------------

--
-- Table structure for table `ai_detections`
--

CREATE TABLE `ai_detections` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `detections` text DEFAULT NULL,
  `safety` varchar(20) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ai_detections`
--

INSERT INTO `ai_detections` (`id`, `employee_id`, `detections`, `safety`, `image_path`, `created_at`) VALUES
(1, 'EMP001', 'no_glove, suit, no_glove, no_glove, no_glove, no-suit, no_glove, suit, no_glove, no_glove, no-suit, no_glove, no_glove, no-suit', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\test.jpg', '2026-04-15 06:37:57'),
(2, 'EMP001', 'no_glove, suit, no_glove, no_glove, no_glove, no-suit, no_glove, suit, no_glove, no_glove, no-suit, no_glove, no_glove, no-suit', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\test.jpg', '2026-04-16 10:25:53'),
(3, '', 'no_glove, no_glove, no_glove, no_glove, no_glove, suit, no_glove, no_glove, no-suit, no-suit, no_glove, no_glove, no_glove, no_glove, suit, no_glove', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\image.jpg', '2026-04-16 11:48:56'),
(4, '', 'no_glove, no_glove, no_glove, no_glove, no_glove, suit, no_glove, no_glove, no-suit, no-suit, no_glove, no_glove, no_glove, no_glove, suit, no_glove', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\image.jpg', '2026-04-16 11:48:57'),
(5, 'EMP001', 'no_glove, no_glove, no_glove, no_glove, no_glove, suit, no_glove, no_glove, no-suit, no-suit, no_glove, no_glove, no_glove, no_glove, suit, no_glove', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\1776340802_image.jpg', '2026-04-16 12:00:03'),
(6, 'EMP001', 'no_glove, no_glove, no_glove, no_glove, no_glove, suit, no_glove, no_glove, no-suit, no-suit, no_glove, no_glove, no_glove, no_glove, suit, no_glove', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\1776341240_image.jpg', '2026-04-16 12:07:21'),
(7, 'EMP001', 'no_glove, no_glove, no_glove, no_glove, no_glove, suit, no_glove, no_glove, no-suit, no-suit, no_glove, no_glove, no_glove, no_glove, suit, no_glove', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\1776341995_image.jpg', '2026-04-16 12:19:56'),
(8, 'EMP001', 'no_glove, no_glove, no_glove, no_glove, no_glove, suit, no_glove, no_glove, no-suit, no-suit, no_glove, no_glove, no_glove, no_glove, suit, no_glove', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\1776342484_image.jpg', '2026-04-16 12:28:05'),
(9, 'EMP001', 'no_glove, no_glove, no_glove, no_glove, no_glove, suit, no_glove, no_glove, no-suit, no-suit, no_glove, no_glove, no_glove, no_glove, suit, no_glove', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\1776342494_image.jpg', '2026-04-16 12:28:14'),
(10, 'EMP001', 'no_glove, no_glove, no_glove, no_glove, no_glove, suit, no_glove, no_glove, no-suit, no-suit, no_glove, no_glove, no_glove, no_glove, suit, no_glove', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\1776342828_image.jpg', '2026-04-16 12:33:49'),
(11, 'EMP001', 'no_glove, no_glove, no_glove, no_glove, no_glove, suit, no_glove, no_glove, no-suit, no-suit, no_glove, no_glove, no_glove, no_glove, suit, no_glove', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\1776345373_image.jpg', '2026-04-16 13:16:14'),
(12, 'EMP001', 'no_glove, suit, no_glove, no_glove, no_glove, no-suit, no_glove, suit, no_glove, no_glove, no-suit, no_glove, no_glove, no-suit', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\test.jpg', '2026-04-17 04:29:25'),
(13, 'EMP001', 'no_glove, suit, no_glove, no_glove, no_glove, no-suit, no_glove, suit, no_glove, no_glove, no-suit, no_glove, no_glove, no-suit', 'UNSAFE', 'C:\\xampp\\htdocs\\mineguard\\uploads\\test.jpg', '2026-04-17 04:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `worker_id` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `worker_id`, `message`, `status`, `created_at`) VALUES
(1, 'EMP001', '⚠ Unsafe condition detected', 'pending', '2026-04-16 13:16:14'),
(2, 'EMP001', '⚠ Unsafe condition detected', 'pending', '2026-04-17 04:29:25'),
(3, 'EMP001', '⚠ Unsafe condition detected', 'pending', '2026-04-17 04:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `name`, `email`) VALUES
(1, 'Abhinaya', '+918309092769');

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE `checklist` (
  `id` int(11) NOT NULL,
  `worker_id` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hazards`
--

CREATE TABLE `hazards` (
  `id` int(11) NOT NULL,
  `worker_id` varchar(50) DEFAULT NULL,
  `hazard_type` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `priority` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hazards`
--

INSERT INTO `hazards` (`id`, `worker_id`, `hazard_type`, `description`, `status`, `created_at`, `priority`) VALUES
(1, 'EMP001', 'Blocked Tunnel', 'the tunnel is blocked', 'Resolved', '2026-04-15 07:05:47', NULL),
(2, 'EMP001', 'Electrical Risk', 'm,nk', 'Resolved', '2026-04-15 08:36:52', NULL),
(3, 'EMP001', 'PPE Violation', 'ppe violation', 'Resolved', '2026-04-15 08:37:44', NULL),
(4, 'EMP001', 'Unsafe Machinery', 'THE MACHINE BROKE', 'Pending', '2026-04-15 09:13:22', NULL),
(5, 'EMP001', 'Gas Leak', 'THE GAS WAS LEAKING VERY HIGH', 'Pending', '2026-04-15 09:13:40', NULL),
(6, 'EMP001', 'PPE Violation', 'Low PPE compliance', 'Pending', '2026-04-15 10:19:27', NULL),
(7, 'SUP001', 'PPE Violation', 'Low PPE compliance', 'Pending', '2026-04-15 10:19:27', NULL),
(8, 'EMP001', 'PPE Violation', 'Low PPE compliance', 'Pending', '2026-04-16 13:15:02', NULL),
(9, 'SUP001', 'PPE Violation', 'Low PPE compliance', 'Pending', '2026-04-16 13:15:02', NULL),
(10, 'EMP001', 'PPE Violation', 'Low PPE compliance', 'Pending', '2026-04-16 13:25:02', NULL),
(11, 'SUP001', 'PPE Violation', 'Low PPE compliance', 'Pending', '2026-04-16 13:25:02', NULL),
(12, 'EMP001', 'PPE Violation', 'Low PPE compliance', 'Pending', '2026-04-16 13:34:22', NULL),
(13, 'SUP001', 'PPE Violation', 'Low PPE compliance', 'Pending', '2026-04-16 13:34:22', NULL),
(14, 'EMP001', 'PPE Violation', 'Low PPE compliance', 'Pending', '2026-04-16 13:39:35', NULL),
(15, 'SUP001', 'PPE Violation', 'Low PPE compliance', 'Pending', '2026-04-16 13:39:35', NULL),
(16, 'EMP001', 'PPE Violation', 'Low PPE compliance', 'Pending', '2026-04-17 04:15:23', NULL),
(17, 'SUP001', 'PPE Violation', 'Low PPE compliance', 'Pending', '2026-04-17 04:15:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scan_results`
--

CREATE TABLE `scan_results` (
  `id` int(11) NOT NULL,
  `worker_name` varchar(100) DEFAULT NULL,
  `helmet` varchar(20) DEFAULT NULL,
  `vest` varchar(20) DEFAULT NULL,
  `fatigue` varchar(20) DEFAULT NULL,
  `risk_score` int(11) DEFAULT NULL,
  `scan_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scan_results`
--

INSERT INTO `scan_results` (`id`, `worker_name`, `helmet`, `vest`, `fatigue`, `risk_score`, `scan_time`, `created_at`) VALUES
(1, 'Worker User', 'OK', 'OK', 'Low', 20, '2026-04-15 06:37:57', '2026-04-15 06:37:57'),
(2, 'Worker User', 'OK', 'OK', 'Low', 20, '2026-04-16 10:24:41', '2026-04-16 10:24:41'),
(3, 'Worker User', 'OK', 'OK', 'Low', 20, '2026-04-16 10:25:53', '2026-04-16 10:25:53'),
(4, '', 'OK', 'OK', 'Low', 20, '2026-04-16 10:46:48', '2026-04-16 10:46:48'),
(5, '', 'OK', 'OK', 'Low', 20, '2026-04-16 11:48:56', '2026-04-16 11:48:56'),
(6, '', 'OK', 'OK', 'Low', 20, '2026-04-16 11:48:57', '2026-04-16 11:48:57'),
(7, 'Worker User', 'OK', 'OK', 'Low', 20, '2026-04-17 04:29:25', '2026-04-17 04:29:25'),
(8, 'Worker User', 'OK', 'OK', 'Low', 20, '2026-04-17 04:56:33', '2026-04-17 04:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Employee_id` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `fatigue` int(11) DEFAULT NULL,
  `ppe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Employee_id`, `name`, `password`, `role`, `fatigue`, `ppe`) VALUES
(1, 'EMP001', 'Worker User', '123456', 'worker', NULL, NULL),
(2, 'SUP001', 'Supervisor User', '123456', 'supervisor', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ai_detections`
--
ALTER TABLE `ai_detections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hazards`
--
ALTER TABLE `hazards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scan_results`
--
ALTER TABLE `scan_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ai_detections`
--
ALTER TABLE `ai_detections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hazards`
--
ALTER TABLE `hazards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `scan_results`
--
ALTER TABLE `scan_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
