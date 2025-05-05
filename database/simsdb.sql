-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 06:35 AM
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
(14, 'Sample admin', 'admin@gmail.com', '$2y$10$6Iq/sUNLqFTIxFGZwNZOvOuaGULwixiTFPij9kdLUj1G209BfHvBC', 'admin', '', '2025-05-01 20:22:39'),
(26, 'MATT ANDREI G. BELANO', 'matt@gmail.com', '$2y$10$8z1dNu1e79TGRLRT49sMFuzkOASfrPbmPHoz1oG4azLATBf3pqZnq', 'COLLEGE', 'OIP.jpg', '2025-05-02 13:32:15'),
(39, 'Roselyn Sarbatiyo', 'roselyn@gmail.com', '$2y$10$bWi2ix1eAdNGQ10K0LG6dO92Vdryk0zBion2/bB0qXQahbTnvh1b.', 'HIGHSCHOOL', 'Messenger_creation_B6F17A08-15EC-4072-9E50-12D6DE366EAE.jpeg', '2025-05-04 18:38:50'),
(40, 'Another Acc', 'anothe@gmail.com', '$2y$10$gL2gwIUgGBzquE98zAylP.YheUa4CfK4hHS2KmVkZn67zm7FxNdtK', 'HIGHSCHOOL', '78677ea461877a5260ef1ad222404a16.png', '2025-05-04 21:08:31'),
(41, 'Sample', 'sample@gmail.com', '$2y$10$4Rw2OhtlqNLbd6uXCRc63.9N/tChNB/6nfiGi0kXPKt0GFpYVhHxC', 'COLLEGE', '437135706_821366699862450_5169344052376559872_n.jpg', '2025-05-04 21:32:20'),
(42, 'qwerty', 'qwerty@gmail.com', '$2y$10$tNsj4pz.tw6HWAgyhS8vnerPJ1b5mHG6YjsIt6ic9dOYURv57LtrG', 'COLLEGE', 'IMG_20250428_185100_449.jpg', '2025-05-05 00:11:11'),
(43, 'asdfg', 'asd@gmail.com', '$2y$10$6BN9/Iu.SoIBOxWANMV.juCWSK5yeE/GBlGN3UFL8L/tvmnl7WQI2', 'COLLEGE', 'Screenshot_20250504-132222.jpg', '2025-05-05 00:14:59');

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

--
-- Dumping data for table `hsrecords`
--

INSERT INTO `hsrecords` (`id`, `user_id`, `name`, `school`, `semester`, `gradelvl`, `strand`, `brgy`, `phone`, `status`) VALUES
(39, 40, 'ANOTHER ACC', 'magballo', '1ST SEMESTER', '12', 'GAS', 'BARANGAY 6', '06734313461', 'active'),
(40, 39, 'ROSELYN SARBATIYO', 'fortress', '1ST SEMESTER', '11', 'HUMSS', 'CAMUGAO', '09999999999', 'active');

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

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `created_at`, `is_read`) VALUES
(48, 39, 'Your application is being processed.', '2025-05-04 21:02:49', 1),
(49, 39, 'Your application is being processed.', '2025-05-04 21:04:56', 1),
(50, 40, 'Your application is being processed.', '2025-05-04 21:11:04', 1),
(51, 40, 'Your application is being processed.', '2025-05-04 21:13:27', 1),
(52, 39, 'Your application is being processed.', '2025-05-04 21:16:09', 1),
(53, 40, 'Your application is being processed.', '2025-05-04 21:17:27', 1),
(54, 40, 'Your application is being processed.', '2025-05-04 21:19:47', 1),
(55, 39, 'Your application is being processed.', '2025-05-04 21:20:33', 1),
(56, 39, 'Your application is being processed.', '2025-05-04 21:21:37', 1),
(57, 40, 'Your application is being processed.', '2025-05-04 21:22:18', 1),
(58, 26, 'Your application is being processed.', '2025-05-04 21:24:48', 1),
(59, 26, 'Your application is being processed.', '2025-05-04 21:26:50', 1),
(60, 26, 'Your application is being processed.', '2025-05-04 21:30:07', 1),
(61, 41, 'Your application is being processed.', '2025-05-04 21:33:12', 1),
(62, 39, 'Your application is being processed.', '2025-05-04 21:34:29', 1),
(63, 41, 'Your application is being processed.', '2025-05-04 21:38:09', 1),
(64, 41, 'Your application is being processed.', '2025-05-04 23:11:29', 1),
(65, 41, 'sasa', '2025-05-04 23:17:33', 1),
(66, 41, 'sasas', '2025-05-04 23:17:40', 1),
(67, 26, 'Your application has been approved.', '2025-05-04 23:17:45', 1),
(68, 39, 'Your high school scholarship application has been approved.', '2025-05-04 23:29:22', 1),
(69, 39, 'Your application has been approved.', '2025-05-04 23:39:19', 1),
(70, 26, 'Your application has been approved.', '2025-05-04 23:39:36', 1),
(71, 26, 'fdf', '2025-05-04 23:39:56', 1),
(72, 40, 'Your high school scholarship application has been approved.', '2025-05-04 23:40:16', 0),
(73, 39, 'Your high school scholarship application has been approved.', '2025-05-04 23:40:33', 1),
(74, 40, 'dsdsdsd', '2025-05-04 23:46:47', 0),
(75, 40, 'Your high school scholarship application has been approved.', '2025-05-04 23:46:56', 0),
(76, 39, ' i love youuu', '2025-05-04 23:47:08', 1),
(77, 41, 'ungooo ka', '2025-05-04 23:48:01', 1),
(78, 41, 'Your renewal is being process.', '2025-05-04 23:48:49', 1),
(79, 9, 'Your renewal is rejected. Reason: ungoooooooooo', '2025-05-04 23:49:48', 0),
(80, 41, 'Your renewal is being process.', '2025-05-04 23:59:07', 1),
(81, 42, 'Your renewal is being process.', '2025-05-05 00:11:58', 1),
(82, 42, 'Your application is being processed.', '2025-05-05 00:13:14', 1),
(83, 42, 'Your application has been approved.', '2025-05-05 00:13:26', 1),
(84, 42, 'Your renewal is being process.', '2025-05-05 00:13:59', 0),
(85, 43, 'Your application is being processed.', '2025-05-05 00:15:38', 1),
(86, 43, 'Your application has been approved.', '2025-05-05 00:15:47', 1),
(87, 43, 'Your renewal is being process.', '2025-05-05 00:16:22', 1),
(88, 43, 'Your renewal is being process.', '2025-05-05 00:17:09', 1),
(89, 43, 'Your renewal is being process.', '2025-05-05 00:24:16', 1),
(90, 9, 'Your renewal is rejected. Reason: qw', '2025-05-05 00:26:34', 0),
(91, 9, 'Your renewal is rejected. Reason: wqwq', '2025-05-05 00:26:39', 0),
(92, 9, 'Your renewal is rejected. Reason: wqwq', '2025-05-05 00:26:45', 0),
(93, 9, 'Your renewal is rejected. Reason: wqwqw', '2025-05-05 00:26:52', 0),
(94, 9, 'Your renewal is rejected. Reason: wqwqw', '2025-05-05 00:26:57', 0),
(95, 9, 'Your renewal is rejected. Reason: wqwqwq', '2025-05-05 00:27:03', 0),
(96, 26, 'Your application is being processed.', '2025-05-05 00:33:13', 1),
(97, 26, 'Your application was automatically rejected as you are already a beneficiary.', '2025-05-05 00:36:07', 1),
(98, 40, 'Your application was automatically rejected as you are already a beneficiary.', '2025-05-05 00:39:52', 0),
(99, 39, 'Your application was automatically rejected as you are already a beneficiary.', '2025-05-05 00:40:00', 1),
(100, 39, 'Your application was automatically rejected as you are already a beneficiary.', '2025-05-05 00:40:28', 1),
(101, 40, 'Your application was automatically rejected as you are already a beneficiary.', '2025-05-05 00:40:40', 0),
(102, 39, 'Your application is being processed.', '2025-05-05 00:42:58', 1),
(103, 39, 'Your application was automatically rejected as you are already a beneficiary.', '2025-05-05 00:43:28', 1),
(104, 26, 'Your renewal is being process.', '2025-05-05 00:47:51', 1),
(105, 9, 'Your renewal is approved.', '2025-05-05 00:48:49', 0),
(106, 26, 'Your renewal is being process.', '2025-05-05 00:53:38', 1),
(107, 9, 'Your renewal application cannot be processed as your status is already renewed.', '2025-05-05 00:53:44', 0),
(108, 26, 'Your renewal is being process.', '2025-05-05 00:56:53', 1),
(109, 9, 'Your renewal application cannot be processed as your status is already renewed.', '2025-05-05 00:57:04', 0),
(110, 26, 'Your renewal is being process.', '2025-05-05 01:02:06', 1),
(111, 9, 'Your renewal application cannot be processed as your status is already renewed.', '2025-05-05 01:02:41', 0);

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

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `user_id`, `name`, `school`, `semester`, `courseYear`, `brgy`, `phone`, `status`) VALUES
(68, 26, 'MATT ANDREI G. BELANO', 'CHMSU-BINALBAGAN', '1ST SEMESTER', 'BSIT 4', 'BARANGAY 7', '09313161818', 'renewed'),
(71, 42, 'QWERTY', 'CHMSU-ALIJIS', '1ST SEMESTER', 'BSIT 4', 'BARANGAY 6', '09313161818', 'incomplete'),
(72, 43, 'ASDFG', 'CPSU-CAUAYAN', '1ST SEMESTER', 'BSIT 4', 'BARANGAY 1', '09313161818', 'incomplete');

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
  `user_id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `semester` varchar(250) NOT NULL,
  `comelec` varchar(250) NOT NULL,
  `grades` varchar(250) NOT NULL,
  `enrollment` varchar(250) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `college_pending`
--
ALTER TABLE `college_pending`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `hspending`
--
ALTER TABLE `hspending`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hsrecords`
--
ALTER TABLE `hsrecords`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `renew_college_pending`
--
ALTER TABLE `renew_college_pending`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `renew_hs_pending`
--
ALTER TABLE `renew_hs_pending`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
