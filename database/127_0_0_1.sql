-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 12:19 PM
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
-- Database: `campus_eatery`
--
CREATE DATABASE IF NOT EXISTS `campus_eatery` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `campus_eatery`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_type` varchar(250) NOT NULL DEFAULT 'customer',
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `created_at`) VALUES
(2, 'Matt Andrei Belano', 'mattandrei@gmail.com', '$2y$10$No/pqbivDwGIfBBh8RfQq.egPMYHmG/MDOYWDX9qvtUjBWRPJZF8C', 'customer', '2025-03-12 16:21:07.000000'),
(3, 'Carlo Cahoy', 'carlo@gmail.com', '$2y$10$ezkGryiE.NM9Zk7mISCjq.s6I0bI1hHZg1lRK2G3sOKSKL31bx41q', 'eatery_owner', '2025-03-12 16:52:20.000000'),
(4, 'Rianne Aguilar', 'rianne@gmail.com', '$2y$10$0cyRUR18Nu0zA97QiZjIBu370oi/TOUR3c1zfz/tuErzyG/OHfwaC', 'customer', '2025-03-20 13:45:45.000000'),
(5, 'qwer', 'qwer@gmail.com', '$2y$10$fGSvLnp5NxWvpQFLOoV1/eqCPTbqdSthTsF8KcEv3NbRH0S96bosS', 'eatery_owner', '2025-03-20 13:46:24.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Database: `fooddeliverydb`
--
CREATE DATABASE IF NOT EXISTS `fooddeliverydb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fooddeliverydb`;

-- --------------------------------------------------------

--
-- Table structure for table `accountdb`
--

CREATE TABLE `accountdb` (
  `id` int(30) NOT NULL,
  `Fullname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `Usertype` varchar(250) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountdb`
--

INSERT INTO `accountdb` (`id`, `Fullname`, `email`, `username`, `password`, `Usertype`) VALUES
(0, 'matt', 'matt@gmail.com', 'matt', '$2y$10$jo5NkSdkCN2nKRJzLGYEfOQFQpS7GiF4j0xE4FuvN5cMW8IgOpnOy', 'user'),
(16, 'Matt Andrei Belano', 'belanomatt@gmail.com', 'admin', '$2y$10$d8//XL5QdC4uURLbl2GV0.btCoNZ/mArf7Y.SEmYvSaRiALtCDRuy', 'admin'),
(29, 'Sheane Galeno', 'sheane@gmail.com', 'sheane', '$2y$10$xp1YqB2fIuzsobFGv.QyR.xK6po3XrxNWab8fLDtKPNl3iCTYqpsa', 'user'),
(30, 'Riyann Aguilar', 'riyann@gmail.com', 'riyann', '$2y$10$aqCKHJO.bTQG.eti5MBeW.B0Y23C/LBf.QgBJ/WAbl.AhZbGAq60K', 'user'),
(0, 'Matt aka', 'aka@gmail.com', 'aka', '$2y$10$qNsj4O6Gur9Rb1P1TQd6MeafVDl6trKJlLAj33sYICtTl9FM.JZ2C', 'user'),
(0, 'lk', 'ghjk@gmail.com', 'lkj', '$2y$10$MVr/TbXOVOAGpskFF.hZ8uVaPaz5T5LX9R6EBsF9t5XtwenXpLQP.', 'user'),
(0, 'matt', 'asasasas@gmail.com', 'mattmatt', '$2y$10$j6dT6wAGO6UDyRSfxzgsvOJifS//pGVHaXdSNs.Fys88ZOTzzYnse', 'user'),
(0, 'qas', 'qas@gmail.com', 'qas', '$2y$10$l2FPwLjDMB2crUnNGR1Tvu4D/Kmos9UZF7nEAbNmYWLJhTqNjhXvm', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `quantity` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(250) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `address1` varchar(250) NOT NULL,
  `address2` varchar(250) NOT NULL,
  `payment_method` varchar(250) NOT NULL,
  `total_product` varchar(250) NOT NULL,
  `total_price` int(250) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `user_id` int(250) NOT NULL,
  `order_id` int(250) NOT NULL,
  `product_id` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `fullname`, `phone`, `city`, `address1`, `address2`, `payment_method`, `total_product`, `total_price`, `order_date`, `user_id`, `order_id`, `product_id`) VALUES
(0, 'fdfdf', '09665028048', 'Kabankalan', 'brgy. tagoc', 'purok mahogany', 'Cod', 'Royal (1) , Fries-bbq flavor (1) , Ice cream-ube (1) , Leche flan (1) ', 235, '2025-02-22 06:35:22', 0, 67, 0),
(0, 'Matt andrei belano', '09665028048', 'Kabankalan', 'brgy. tagoc', 'purok mahogany', 'Cod', 'Royal (87) , Fries-bbq flavor (87) ', 5655, '2025-02-25 05:09:48', 0, 67, 0);

-- --------------------------------------------------------

--
-- Table structure for table `productdb`
--

CREATE TABLE `productdb` (
  `id` int(250) NOT NULL,
  `ProductTitle` varchar(250) NOT NULL,
  `ProductPrice` varchar(250) NOT NULL,
  `Quantity` int(250) NOT NULL,
  `Category` varchar(250) NOT NULL,
  `ProductPicture` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productdb`
--

INSERT INTO `productdb` (`id`, `ProductTitle`, `ProductPrice`, `Quantity`, `Category`, `ProductPicture`) VALUES
(96, 'Royal', '30', 0, 'Drinks', 'royal.jpg'),
(97, 'Fries-bbq flavor', '35', 1, 'Fries', 'bbq.jpg'),
(98, 'Ice cream-ube', '120', 98, 'Desert', 'dessert ube.jpg'),
(99, 'Leche flan', '50', 118, 'Desert', 'download (1).jpg'),
(100, 'Pizza - plain', '80', 99, 'Pizza', 'download (3).jpg'),
(101, 'Burger king', '99', 99, 'Sandwich', 'download.jpg'),
(102, 'Pizza - hawaiian', '80', 100, 'Pizza', 'hawaiian.jpg'),
(103, 'Pizza-pepperoni', '80', 100, 'Pizza', 'margarita.jpg'),
(104, 'Fries - sour & cream', '35', 100, 'Fries', 'sour & cream.jpg'),
(105, 'Coke', '35', 111, 'Drinks', 's-l1200.webp'),
(106, 'Sprite', '30', 111, 'Drinks', 'sprite.webp'),
(107, 'Tempura shrimp', '79', 100, 'Fried', 'side-view-tempura-shrimps-with-sweet-chili-sauce-board.jpg'),
(108, 'Chicken nuggets', '79', 100, 'Fried', 'pexels-leonardo-luz-338722550-14001637.jpg'),
(109, 'Fried chicken', '99', 100, 'Fried', 'pexels-pixabay-60616.jpg'),
(110, 'Fried rice', '50', 30, 'Fried', 'pexels-rickyrecap-1630495.jpg'),
(111, 'Strawberry cake', '49', 50, 'Desert', 'pexels-suzyhazelwood-1098592.jpg'),
(112, '3 burger w/ fries', '119', 114, 'Combo meal', 'Burger with fries.jpg');
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-04-28 10:18:47', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `simsdb`
--
CREATE DATABASE IF NOT EXISTS `simsdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `simsdb`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL DEFAULT 'student',
  `created_at` datetime(6) DEFAULT NULL,
  `profile` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `email`, `password`, `user_type`, `created_at`, `profile`) VALUES
(9, 'kceap', 'kceap@gmail.com', '$2y$10$sfA7g9QpdAY9pDC.RAZRH.NB9RyI4w9exXJP8Yh.9es7VWgdNazva', 'staff', '2025-03-23 16:22:02.000000', ''),
(12, 'Carlo Cahoy', 'carlo@gmail.com', '$2y$10$bOQxsDVYhkx96iIcloFpWu/yclmi.jXSIp9ChwkPt0PaxDHCa.ZVS', 'staff', '2025-03-23 17:02:28.000000', ''),
(14, 'Sample admin', 'admin@gmail.com', '$2y$10$6Iq/sUNLqFTIxFGZwNZOvOuaGULwixiTFPij9kdLUj1G209BfHvBC', 'admin', '2025-03-23 17:52:27.000000', ''),
(18, 'Qwerty', 'qwer@gmail.com', '$2y$10$9hpimf/5GwAg8Bd2jI3SLOrpVyMFxWCmFka7vZveO4SjgkHDRrrFK', 'student', '2025-04-20 21:19:46.000000', ''),
(20, 'John lawrence', 'john@gmail.com', '$2y$10$OqTpMyksIrRO9Ei5z3Z2PO1VWkF6aE8NgFJMWnKzYoL24l6Pupbu6', 'student', '2025-04-20 21:21:35.000000', ''),
(22, 'Matt andrei belano', 'mattandrei@gmail.com', '$2y$10$SHnfyIR4XeC4ij6lApEceOxfv2L.ARGiXZ6CGbrVcz9BPcR5QafBm', 'student', '2025-04-25 21:37:47.000000', 'IMG_20230214_064432_526.jpg'),
(23, 'Roselyn Sarbatiyo', 'roselyn@gmail.com', '$2y$10$pTrDYBko3mh9D3zcItC0KOw4ESmxwYbhWz7TjnTLVwQKeEIQHGBdy', 'student', '2025-04-25 21:39:46.000000', '350483722_581038634162065_3769412834548162492_n.jpg');

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
  `number` varchar(250) NOT NULL,
  `address` varchar(110) NOT NULL,
  `income` varchar(110) NOT NULL,
  `birthcert` varchar(110) NOT NULL,
  `comelec` varchar(110) NOT NULL,
  `card` varchar(110) NOT NULL,
  `moral` varchar(110) NOT NULL,
  `submitted_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hsrecords`
--

CREATE TABLE `hsrecords` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `school` varchar(250) NOT NULL,
  `gradelvl` varchar(250) NOT NULL,
  `strand` varchar(250) NOT NULL,
  `brgy` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hsrecords`
--

INSERT INTO `hsrecords` (`id`, `name`, `school`, `gradelvl`, `strand`, `brgy`, `phone`) VALUES
(37, 'BELANO, MATT ANDREI G.', 'SC-HIGHSCHOOL', '12', 'STEM', 'DAAN BANUA', '09665028045');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `school` varchar(250) NOT NULL,
  `courseYear` varchar(250) NOT NULL,
  `brgy` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `name`, `school`, `courseYear`, `brgy`, `phone`) VALUES
(31, 'AGUILAR, RIANNE CRISTOPHER J.', 'CPSU-MAIN', 'BSIT 3', 'TAGOC', '09758320544'),
(32, 'ACEBRON, JEZREL B.', 'CPSU-ILOG', 'BSIT 4', 'TABUGON', '09089391251'),
(33, 'BALINAS, KEN T.', 'CPSU-MAIN', 'BSIT 3', 'LINAO', '09978264253'),
(44, 'BELANO, MATT ANDREI G.', 'CPSU-MAIN', 'BSIT 4', 'TAGOC', '09665028045'),
(45, 'sdsd', 'CPSU-MAIN', 'dsd', 'dsd', '09089391251'),
(46, 'cxcsdf', 'CPSU-MAIN', 'BSIT 4', 'BINICUIL', '09665028045'),
(47, 'dsdsdsdd', 'CPSU-MAIN', 'sdsd', 'sdsd', '98'),
(48, 'dsdsdsd', 'CPSU-MAIN', 'dsdsd', 'sd', '09665028045'),
(49, 'dsdsdsdddsds', 'CPSU-MAIN', 'dsd', 'dsdsd', '09089391251'),
(50, 'dsdxcxFesfd', 'CPSU-MAIN', 'erere', 'ree', '09'),
(51, 'dsdssdsdsd', 'CPSU-MAIN', 'sdsdsd', 'sdsdsd', '7867'),
(52, 'Matt', 'CPSU-MAIN', 'ada', 'dad', '09665028045'),
(53, 'assasin', 'CPSU-MAIN', 'BSIT 2', 'BARANGAY 3', '09665028045'),
(54, 'BERNABE, ROSE ANN', 'CPSU-MAIN', 'BSIT 3', 'TAGOC', '09778736032'),
(55, 'WQSXC', 'CPSU-MAIN', 'BSIT 3', 'TAGOC', '09665028045'),
(56, 'lkfjjfff', 'FBC', 'wfffa', 'CAMANSI', '09');

-- --------------------------------------------------------

--
-- Table structure for table `renew_college_pending`
--

CREATE TABLE `renew_college_pending` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `school` varchar(250) NOT NULL,
  `comelec_certificate` varchar(250) NOT NULL,
  `grades` varchar(250) NOT NULL,
  `enrollment_certificate` varchar(250) NOT NULL
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
-- Indexes for table `hsrecords`
--
ALTER TABLE `hsrecords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renew_college_pending`
--
ALTER TABLE `renew_college_pending`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `college_pending`
--
ALTER TABLE `college_pending`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hsrecords`
--
ALTER TABLE `hsrecords`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `renew_college_pending`
--
ALTER TABLE `renew_college_pending`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
