-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 06:45 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookspourie`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('A','I','D') NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `name`, `email`, `password`, `status`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$Kpr66YYBKd4wi0YGAd1pu.w8Tkfzzzhkqi4dgE41xMAW3TCChkivq', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `master_category`
--

CREATE TABLE `master_category` (
  `id` bigint(20) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('A','I','D') NOT NULL DEFAULT 'A',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_category`
--

INSERT INTO `master_category` (`id`, `category_name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Science', 'mastercategory_237871606046135.jpg', 'A', '2020-11-22 14:31:43', '2020-11-22 18:59:13'),
(2, 'test cat vcs tre', 'mastercategory_500541606051224.jpg', 'A', '2020-11-22 18:49:39', '2020-11-22 18:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `master_subcategory`
--

CREATE TABLE `master_subcategory` (
  `id` bigint(20) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `master_category_id` int(11) NOT NULL,
  `status` enum('A','I','D') NOT NULL DEFAULT 'A',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_subcategory`
--

INSERT INTO `master_subcategory` (`id`, `category_name`, `master_category_id`, `status`, `created_at`, `modified_at`) VALUES
(1, 'Masala', 2, 'A', '2020-07-02 01:00:54', '2020-07-09 02:12:30'),
(2, 'Drinks', 2, 'A', '2020-07-02 01:14:55', '2020-11-23 22:09:25'),
(3, 'd2Masalaj', 3, 'A', '2020-08-24 23:53:44', '2020-11-23 22:09:31'),
(4, 'test category', 1, 'A', '2020-11-23 21:37:51', '2020-11-23 21:39:05'),
(5, 'ggggg', 1, 'A', '2020-11-23 21:39:58', NULL),
(6, 'new work', 1, 'A', '2020-11-23 22:14:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(255) NOT NULL,
  `pro_id` bigint(20) NOT NULL,
  `master_category_id` bigint(20) NOT NULL,
  `sub_category_id` bigint(20) DEFAULT NULL,
  `company_product_id` varchar(255) DEFAULT NULL,
  `brand_id` bigint(20) DEFAULT NULL,
  `is_loose` tinyint(1) NOT NULL DEFAULT '0',
  `units` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'product name',
  `image_alt` varchar(255) NOT NULL,
  `description` longtext,
  `specification` longtext,
  `image_250` varchar(255) NOT NULL,
  `image_500` varchar(255) NOT NULL,
  `image_800` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pro_id`, `master_category_id`, `sub_category_id`, `company_product_id`, `brand_id`, `is_loose`, `units`, `name`, `image_alt`, `description`, `specification`, `image_250`, `image_500`, `image_800`, `status`, `created_at`) VALUES
('2c4b3e3ef53389cce7a2c1053b96e40099ad0d63', 2, 3, NULL, '565', NULL, 0, 'ml', 'ljnln', 'ljnln', 'klmkm kmkmk m\\\\\\;m', 'kkmkkj ', 'products_160363197686497_250.jpeg', 'products_160363197686497_500.jpeg', 'products_160363197686497_800.jpeg', '1', '2020-09-08 12:12:22'),
('8874313b0d6952a8a551ddb226befefec9313984', 3, 2, NULL, 'pordknd', NULL, 0, 'pcs', 'product 1', 'product 1', 'product 1 description', 'product one specification', 'products_160363175532986_250.jpeg', 'products_160363175532986_500.jpeg', 'products_160363175532986_800.jpeg', '1', '2020-10-25 18:45:55'),
('60ba6ee13c0e1be3a1a6d9e9e06f1c68b90e2394', 4, 1, NULL, 'lndkksl', NULL, 0, 'pcs', 'product 2', 'product 2', 'lnfklk', 'dffkf\\;', 'products_160363180782752_250.jpeg', 'products_160363180782752_500.jpeg', 'products_160363180782752_800.jpeg', '1', '2020-10-25 18:46:47'),
('566943cfe48e9efbbbd74afa55594402e83e51ca', 5, 1, NULL, 'ldfld', NULL, 0, 'pcs', 'product 3', 'product 3', 'jbdkfd ', 'dfljfld jdfndjfd ', 'products_160363183271159_250.jpeg', 'products_160363183271159_500.jpeg', 'products_160363183271159_800.jpeg', '1', '2020-10-25 18:47:12'),
('816296b9c4878db3a56dd44b493c32a506e139df', 6, 3, NULL, 'skldskl', NULL, 0, 'pcs', 'product 4', 'product 4', 'kldksmdksm  sdsd sdsdsds ds', 'sndsds msdns ds', 'products_160363186045801_250.jpeg', 'products_160363186045801_500.jpeg', 'products_160363186045801_800.jpeg', '1', '2020-10-25 18:47:41'),
('6265c4d57529a2ce8623abddb47465d1c94424f6', 7, 3, NULL, 'skd skds ', NULL, 0, 'kg', 'product 5', 'product 5', 'jddns', 'oj', 'products_160363190777985_250.jpeg', 'products_160363190777985_500.jpeg', 'products_160363190777985_800.jpeg', '1', '2020-10-25 18:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `product_cost`
--

CREATE TABLE `product_cost` (
  `id` varchar(255) NOT NULL,
  `pcost_id` bigint(20) NOT NULL,
  `pro_id` bigint(20) NOT NULL,
  `product_mrp` float NOT NULL DEFAULT '0',
  `website_cost` float NOT NULL DEFAULT '0',
  `product_discount` float NOT NULL DEFAULT '0',
  `state` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_cost`
--

INSERT INTO `product_cost` (`id`, `pcost_id`, `pro_id`, `product_mrp`, `website_cost`, `product_discount`, `state`, `created_at`, `modified_at`) VALUES
('3607051c249ba8578f249fd77fa1b2947798ad3c', 6, 2, 140, 130, 0, 'west_bengal', '2020-10-25 20:23:44', NULL),
('055eedb4ddb1beb19e0e698a070d7355cdeb2c05', 7, 3, 200, 190, 0, 'west_bengal', '2020-10-25 20:28:53', NULL),
('57507682926e31dd32998e58ef6d1b6061fa9d15', 8, 4, 350, 320, 0, 'west_bengal', '2020-10-25 20:29:05', NULL),
('62dee124c176f244c92d768522ed542a19c2b13c', 9, 5, 310, 300, 0, 'west_bengal', '2020-10-25 20:29:50', NULL),
('da62fd99aa4c0c29a3f225b245cba0ca4913a902', 10, 7, 180, 165, 0, 'west_bengal', '2020-10-25 20:30:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `total_records`
--

CREATE TABLE `total_records` (
  `id` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `total_value` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `total_records`
--

INSERT INTO `total_records` (`id`, `type`, `total_value`) VALUES
(1, 'total_users', 3),
(2, 'total_master_category', 2),
(4, 'total_subcategory', 2),
(5, 'total_products', 2),
(6, 'total_brands', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(200) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `email`, `mobile`, `gender`, `password`, `image`, `status`, `created_at`, `modified_at`) VALUES
('36259866d74ebb644b72e28b88cb442dfdd64535', 1, 'Atanu Sama', 'atanu122@sam.com', 8756215431, 'female', '$2y$10$qC.ovoUGfzhJn8GXroojBu1T.Ambf3qYZKg2KFyNIGEw9rSEnSmc.', 'userimg_159636335354811.png', '1', '2020-06-13 13:50:24', '2020-08-02 15:45:53'),
('705c0bfc1e39605281e18aaa17bc2a24714c2c42', 2, 'atanu samanta', 'root@jn.sd', 8965784531, 'male', '$2y$10$3qaB2/7J95W7K7jjeyekSOLHqTPd3w2dZpodqDKa8L/3oSUmBeHU6', NULL, '0', '2020-06-13 22:24:23', '2020-08-02 15:45:24'),
('ae90ebc540c9699935af752772dd183b2f49093d', 3, 'Atanu', 'atanu@gmail.com', 9865322154, 'male', '$2y$10$uRvGzRBwrMv6Pbk6eFFr8OBBwOJ.EbIl5jLwCiVaEraMkdU6IGVPm', NULL, '1', '2020-06-12 21:32:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `landmark` text,
  `state` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `alt_mobile` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_login_details`
--

CREATE TABLE `user_login_details` (
  `id` bigint(20) NOT NULL,
  `login_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_login_details`
--

INSERT INTO `user_login_details` (`id`, `login_id`, `user_id`, `email`, `password`, `login_time`) VALUES
(0, NULL, 'ae90ebc540c9699935af752772dd183b2f49093d', 'atanu@gmail.com', '$2y$10$uRvGzRBwrMv6Pbk6eFFr8OBBwOJ.EbIl5jLwCiVaEraMkdU6IGVPm', '2020-06-12 21:32:38'),
(0, NULL, '36259866d74ebb644b72e28b88cb442dfdd64535', 'atanu@sam.com', '$2y$10$qC.ovoUGfzhJn8GXroojBu1T.Ambf3qYZKg2KFyNIGEw9rSEnSmc.', '2020-06-13 13:50:24'),
(0, NULL, '705c0bfc1e39605281e18aaa17bc2a24714c2c42', 'root@jn.sd', '$2y$10$3qaB2/7J95W7K7jjeyekSOLHqTPd3w2dZpodqDKa8L/3oSUmBeHU6', '2020-06-13 22:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_track_details`
--

CREATE TABLE `user_track_details` (
  `id` varchar(200) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `device_id` varchar(100) NOT NULL,
  `platform` varchar(100) DEFAULT NULL,
  `browser` varchar(100) DEFAULT NULL,
  `ip` varchar(100) NOT NULL,
  `token` text NOT NULL,
  `logged_in` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logged_out` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_details`
--

CREATE TABLE `vendor_details` (
  `id` bigint(20) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `alternative_number` bigint(20) DEFAULT NULL,
  `aadhaar_no` bigint(20) NOT NULL,
  `pan_no` varchar(255) NOT NULL,
  `company_name` text,
  `company_reg_number` varchar(255) DEFAULT NULL,
  `gst_number` varchar(255) DEFAULT NULL,
  `business_type` bigint(20) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `office_address` longtext NOT NULL,
  `office_pincode` int(11) NOT NULL,
  `aadhaar_image` varchar(255) NOT NULL,
  `pancard_image` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_category`
--
ALTER TABLE `master_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_subcategory`
--
ALTER TABLE `master_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `master_category_product_index` (`master_category_id`),
  ADD KEY `sub_master_category_product_index` (`sub_category_id`);

--
-- Indexes for table `product_cost`
--
ALTER TABLE `product_cost`
  ADD PRIMARY KEY (`pcost_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `product_id_key` (`pro_id`);

--
-- Indexes for table `total_records`
--
ALTER TABLE `total_records`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `total_records` ADD FULLTEXT KEY `type` (`type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Indexes for table `user_track_details`
--
ALTER TABLE `user_track_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_details`
--
ALTER TABLE `vendor_details` ADD FULLTEXT KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_category`
--
ALTER TABLE `master_category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_subcategory`
--
ALTER TABLE `master_subcategory`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
