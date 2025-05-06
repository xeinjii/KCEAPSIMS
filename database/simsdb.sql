-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2025 at 03:42 PM
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
-- Database: `simsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL DEFAULT 'college',
  `profile` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `email`, `password`, `user_type`, `profile`, `created_at`) VALUES
(9, 'kceap', 'kceap@gmail.com', '$2y$10$sfA7g9QpdAY9pDC.RAZRH.NB9RyI4w9exXJP8Yh.9es7VWgdNazva', 'staff', '', '2025-05-01 20:22:39'),
(14, 'Sample admin', 'admin@gmail.com', '$2y$10$6Iq/sUNLqFTIxFGZwNZOvOuaGULwixiTFPij9kdLUj1G209BfHvBC', 'admin', '', '2025-05-01 20:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `college_pending`
--

CREATE TABLE `college_pending` (
  `id` int(110) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(110) NOT NULL,
  `school` varchar(110) NOT NULL,
  `courseYear` varchar(250) NOT NULL,
  `semester` varchar(250) NOT NULL,
  `number` varchar(250) NOT NULL,
  `address` varchar(110) NOT NULL,
  `income` varchar(110) NOT NULL,
  `birthcert` varchar(110) NOT NULL,
  `comelec` varchar(110) NOT NULL,
  `card` varchar(110) NOT NULL,
  `moral` varchar(110) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hspending`
--

CREATE TABLE `hspending` (
  `id` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `school` varchar(250) NOT NULL,
  `gradelvl` varchar(250) NOT NULL,
  `strand` varchar(250) NOT NULL,
  `semester` varchar(250) NOT NULL,
  `number` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `income` varchar(250) NOT NULL,
  `birthcert` varchar(250) NOT NULL,
  `comelec` varchar(250) NOT NULL,
  `card` varchar(250) NOT NULL,
  `moral` varchar(250) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hsrecords`
--

CREATE TABLE `hsrecords` (
  `id` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `school` varchar(250) NOT NULL,
  `semester` varchar(250) NOT NULL,
  `gradelvl` varchar(250) NOT NULL,
  `strand` varchar(250) NOT NULL,
  `brgy` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `school` varchar(250) NOT NULL,
  `semester` varchar(250) NOT NULL,
  `courseYear` varchar(250) NOT NULL,
  `brgy` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `renew_college_pending`
--

CREATE TABLE `renew_college_pending` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `semester` varchar(250) NOT NULL,
  `comelec_certificate` varchar(250) NOT NULL,
  `grades` varchar(250) NOT NULL,
  `enrollment_certificate` varchar(250) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `renew_hs_pending`
--

CREATE TABLE `renew_hs_pending` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `semester` varchar(250) NOT NULL,
  `comelec` varchar(250) NOT NULL,
  `grades` varchar(250) NOT NULL,
  `enrollment` varchar(250) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `logo`) VALUES
(1, 'CPSU - MAIN', 'school_6819f9d34b77d.jpg'),
(2, 'SASAS', 'school_6819fa2ad2e1f.jpg'),
(3, 'SASA', 'school_6819fa37ad427.jpg'),
(5, 'qwerty', 'school_681a005554291.jpg'),
(6, 'dssd', 'school_681a005bf0f14.jpg'),
(7, 'qwq', 'school_681a043d663a5.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `college_pending`
--
ALTER TABLE `college_pending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hspending`
--
ALTER TABLE `hspending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hsrecords`
--
ALTER TABLE `hsrecords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `renew_college_pending`
--
ALTER TABLE `renew_college_pending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renew_hs_pending`
--
ALTER TABLE `renew_hs_pending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `college_pending`
--
ALTER TABLE `college_pending`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `hspending`
--
ALTER TABLE `hspending`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hsrecords`
--
ALTER TABLE `hsrecords`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `renew_college_pending`
--
ALTER TABLE `renew_college_pending`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `renew_hs_pending`
--
ALTER TABLE `renew_hs_pending`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
