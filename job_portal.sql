-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2019 at 06:00 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'atul first job', 'atul first job atul first job atul first job', '2019-01-16 10:50:05', '2019-01-16 10:50:05'),
(2, 1, 'atul second job', 'atul second job atul second job atul second job', '2019-01-16 10:50:24', '2019-01-16 10:50:24'),
(3, 2, 'amit first job', 'amit first job amit first jobamit first job', '2019-01-16 10:52:14', '2019-01-16 10:52:14'),
(4, 2, 'amit second job', 'amit second job amit second job amit second job', '2019-01-16 10:52:28', '2019-01-16 10:52:28'),
(5, 3, 'neha first job', 'neha first job neha first job neha first job', '2019-01-16 10:56:12', '2019-01-16 10:56:12'),
(6, 3, 'neha second job', 'neha second job neha second job neha second job', '2019-01-16 11:26:02', '2019-01-16 11:26:02'),
(7, 4, 'sunita first job', 'sunita first job sunita first job sunita first job', '2019-01-16 11:28:43', '2019-01-16 11:28:43'),
(8, 4, 'sunita second job', 'sunita second job sunita second job sunita second job', '2019-01-16 11:28:56', '2019-01-16 11:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `job_contacts`
--

CREATE TABLE `job_contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_messages`
--

CREATE TABLE `job_messages` (
  `id` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Atul Rathi', 'atul@gmail.com', '$2y$10$ePlO6R8D6AO8ND0WbMtXLew.StZnl0k7HQrO.utgFUdPkIwqE1Bau', 'FAscLUtKtjSPoVGQOttytTN5MkSe12ITw0Lp0IMIDR7eTHRq1AfJdoQav09S', '2019-01-14 06:00:48', '2019-01-14 06:00:48'),
(2, 'Amit Kumar', 'amit@gmail.com', '$2y$10$P0O25Ub7U/v5lD5WKv3Q8.Mj/ATzehagZ4Inr9v7fpDo7Vaskk4Cq', 'sWvEFmRpP78537pq95nbDXZVtv92xhYTA469fvphD5tiQGNUz4uoY0xlTWxu', '2019-01-14 06:05:03', '2019-01-14 06:05:03'),
(3, 'Neha', 'neha@gmail.com', '$2y$10$T0d7u0C47cbSqC93d5lfG.TNE1TBdD.961o6o5XuthVgdq1UQoH2m', 'ZxzOUxCR28CKJaJnxSAvFoFG7JAuoloOrhIBQKq90LqTkVgBaYyBn2tCYbJ2', '2019-01-14 11:46:09', '2019-01-14 11:46:09'),
(4, 'Sunita', 'sunita@gmail.com', '$2y$10$uxmR9zjGkJlS1YoJbjqmg..4ao9YM73cJ3whP0RfCsndV1vQoh4Pi', 'n5tmHELip6ImLf5xcACoMGwWkTNuBBMofDwtnIdC4OioBDqawROY3io28WfD', '2019-01-14 11:48:40', '2019-01-14 11:48:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_contacts`
--
ALTER TABLE `job_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_messages`
--
ALTER TABLE `job_messages`
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
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `job_contacts`
--
ALTER TABLE `job_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_messages`
--
ALTER TABLE `job_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
