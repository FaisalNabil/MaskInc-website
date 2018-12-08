-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2018 at 08:02 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maskinc`
--

-- --------------------------------------------------------

--
-- Table structure for table `aauth_groups`
--

CREATE TABLE `aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_groups`
--

INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
(1, 'admin', 'Super admin'),
(4, 'Management', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_app_log`
--

CREATE TABLE `tbl_app_log` (
  `ser_id` int(11) NOT NULL,
  `log_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'created by user: from session',
  `log_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `login_id` bigint(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `login_status` int(11) NOT NULL DEFAULT '0',
  `change_pass_status` int(1) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tbl_user_user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`login_id`, `password`, `status`, `login_status`, `change_pass_status`, `created_on`, `last_login`, `tbl_user_user_id`) VALUES
(1, '40be4e59b9a2a2b5dffb918c0e86b3d7', 1, 1, 1, '2018-06-21 05:05:28', '2018-12-08 15:43:26', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `ser_id` int(8) NOT NULL,
  `menu_label` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `menu_url` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_icon` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_menu` int(8) DEFAULT NULL,
  `menu_level` int(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`ser_id`, `menu_label`, `menu_url`, `menu_icon`, `parent_menu`, `menu_level`) VALUES
(2, 'Admin Console', NULL, 'fa-cog', NULL, 10),
(3, 'Group', 'admin/auth/group', NULL, 2, 3),
(6, 'Menu', 'admin/auth/menu', NULL, 2, 0),
(8, 'Permission', 'admin/auth/permission', NULL, 2, 0),
(21, 'Home', 'admin/home', 'fa-home', NULL, 0),
(24, 'Admin', NULL, NULL, 23, 0),
(28, 'User', '#', 'fa-users', NULL, 2),
(29, 'Add User', 'add_new_user', NULL, 28, 1),
(30, 'Manage Users', 'manage_users', NULL, 28, 2),
(31, 'Settings', '#', 'fa-cog', NULL, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_to_group`
--

CREATE TABLE `tbl_menu_to_group` (
  `ser_id` int(10) NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL,
  `menu_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` varchar(20) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '1=male; 0=female',
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `status` int(1) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_code` varchar(10) NOT NULL,
  `parent_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `gender`, `phone_number`, `email`, `designation`, `address`, `status`, `group_id`, `user_code`, `parent_code`) VALUES
('admin', 'MaskInc Dev', 1, '01111111111', 'info@maskinc.com', 'Super Admin', '', 1, 1, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_app_log`
--
ALTER TABLE `tbl_app_log`
  ADD PRIMARY KEY (`ser_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `tbl_user_user_id` (`tbl_user_user_id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`ser_id`),
  ADD KEY `fk_tbl_menu_parent_menu_id` (`parent_menu`);

--
-- Indexes for table `tbl_menu_to_group`
--
ALTER TABLE `tbl_menu_to_group`
  ADD PRIMARY KEY (`ser_id`),
  ADD KEY `fk_aauth_groups_id` (`group_id`),
  ADD KEY `fk_tbl_menu_ser_id` (`menu_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `parent_code` (`parent_code`),
  ADD KEY `user_code` (`user_code`),
  ADD KEY `aauth_groups_id` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_app_log`
--
ALTER TABLE `tbl_app_log`
  MODIFY `ser_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `login_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `ser_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_menu_to_group`
--
ALTER TABLE `tbl_menu_to_group`
  MODIFY `ser_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_menu_to_group`
--
ALTER TABLE `tbl_menu_to_group`
  ADD CONSTRAINT `fk_aauth_groups_id` FOREIGN KEY (`group_id`) REFERENCES `aauth_groups` (`id`),
  ADD CONSTRAINT `fk_tbl_menu_ser_id` FOREIGN KEY (`menu_id`) REFERENCES `tbl_menu` (`ser_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
