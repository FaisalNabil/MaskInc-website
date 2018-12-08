-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2018 at 02:56 PM
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
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `CLIENT_ID` varchar(30) NOT NULL,
  `CLIENT_NAME` varchar(50) NOT NULL,
  `CLIENT_LOGO_URL` varchar(50) NOT NULL,
  `IS_VISIBLE` tinyint(1) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_DATE` bigint(20) NOT NULL,
  `MODIFIED_BY` int(11) NOT NULL,
  `MODIFIED_DATE` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `map_media_project`
--

CREATE TABLE `map_media_project` (
  `MAP_MEDIA_PROJECT_ID` varchar(30) NOT NULL,
  `PROJECT_ID` varchar(30) NOT NULL,
  `MEDIA_ID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `map_project_sub_category_project`
--

CREATE TABLE `map_project_sub_category_project` (
  `MAP_PROJECT_SUB_CATEGORY_PROJECT_ID` varchar(30) NOT NULL,
  `PROJECT_ID` varchar(30) NOT NULL,
  `PROJECT_SUB_CATEGORY_ID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
  `MEDIA_ID` varchar(30) NOT NULL,
  `MEDIA_TYPE` varchar(30) NOT NULL,
  `MEDIA_URL` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `PROJECT_ID` int(30) NOT NULL,
  `PROJECT_TITLE` varchar(50) NOT NULL,
  `PROJECT_START_DATE` bigint(20) NOT NULL,
  `PROJECT_END_DATE` bigint(20) DEFAULT NULL,
  `PROJECT_IS_RUNNING` tinyint(1) NOT NULL DEFAULT '0',
  `PROJECT_IS_GALLARY` tinyint(1) NOT NULL,
  `PROJECT_IS_VISIBLE` tinyint(1) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_DATE` bigint(20) NOT NULL,
  `MODIFIED_BY` int(11) NOT NULL,
  `MODIFIED_DATE` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

CREATE TABLE `project_categories` (
  `PROJECT_CATEGORY_ID` int(30) NOT NULL,
  `PROJECT_CATEGORY_NAME` varchar(50) NOT NULL,
  `IS_VISIBLE` tinyint(1) NOT NULL,
  `CREATED_BY` varchar(11) NOT NULL,
  `CREATED_DATE` bigint(20) NOT NULL,
  `MODIFIED_BY` bigint(20) DEFAULT NULL,
  `MODIFIED_DATE` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`PROJECT_CATEGORY_ID`, `PROJECT_CATEGORY_NAME`, `IS_VISIBLE`, `CREATED_BY`, `CREATED_DATE`, `MODIFIED_BY`, `MODIFIED_DATE`) VALUES
(1, 'Transportation Planning', 1, 'admin', 1544223600000, NULL, 1544223600000),
(2, 'Traffice Engineering', 1, 'admin', 1544223600000, NULL, 1544223600000);

-- --------------------------------------------------------

--
-- Table structure for table `project_sub_categories`
--

CREATE TABLE `project_sub_categories` (
  `PROJECT_SUB_CATEGORY_ID` varchar(30) NOT NULL,
  `PROJECT_SUB_CATEGORY_NAME` varchar(30) NOT NULL,
  `IS_VISIBLE` tinyint(1) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_DATE` bigint(20) NOT NULL,
  `MODIFIED_BY` int(11) NOT NULL,
  `MODIFIED_DATE` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ROLE_ID` varchar(30) NOT NULL,
  `ROLE_TYPE_ID` varchar(30) NOT NULL,
  `ROLE_NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_types`
--

CREATE TABLE `role_types` (
  `ROLE_TYPE_ID` varchar(30) NOT NULL,
  `ROLE_TYPE_NAME` varchar(50) NOT NULL,
  `PROJECT_ID` varchar(30) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_DATE` bigint(20) NOT NULL,
  `MODIFIED_BY` int(11) NOT NULL,
  `MODIFIED_DATE` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '40be4e59b9a2a2b5dffb918c0e86b3d7', 1, 1, 1, '2018-06-21 05:05:28', '2018-12-08 18:55:04', 'admin');

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
(31, 'Settings', '#', 'fa-cog', NULL, 9),
(71, 'Projects', '#', 'fa-shekel', NULL, 2),
(72, 'Manage Projects', 'admin/project/manage_project', NULL, 71, 1),
(73, 'Add New Project', 'admin/project/add_new_project', NULL, 71, 2),
(74, 'Project Category', 'admin/project/category', NULL, 71, 3);

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
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`CLIENT_ID`);

--
-- Indexes for table `map_media_project`
--
ALTER TABLE `map_media_project`
  ADD PRIMARY KEY (`MAP_MEDIA_PROJECT_ID`);

--
-- Indexes for table `map_project_sub_category_project`
--
ALTER TABLE `map_project_sub_category_project`
  ADD PRIMARY KEY (`MAP_PROJECT_SUB_CATEGORY_PROJECT_ID`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`MEDIA_ID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`PROJECT_ID`);

--
-- Indexes for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`PROJECT_CATEGORY_ID`);

--
-- Indexes for table `project_sub_categories`
--
ALTER TABLE `project_sub_categories`
  ADD PRIMARY KEY (`PROJECT_SUB_CATEGORY_ID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ROLE_ID`);

--
-- Indexes for table `role_types`
--
ALTER TABLE `role_types`
  ADD PRIMARY KEY (`ROLE_TYPE_ID`);

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
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `PROJECT_ID` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `PROJECT_CATEGORY_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `ser_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

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
