-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 12, 2024 at 04:07 PM
-- Server version: 8.0.37-cll-lve
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jamia_madnia123`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_packages`
--

CREATE TABLE `all_packages` (
  `pid` int NOT NULL,
  `ptitle` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `p_image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `p_cost` double DEFAULT NULL,
  `packages_category` int NOT NULL,
  `IsFeatured` tinyint NOT NULL DEFAULT '1',
  `FeaturedText` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `p_content` text COLLATE utf8mb4_general_ci NOT NULL,
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_packages`
--

INSERT INTO `all_packages` (`pid`, `ptitle`, `p_image`, `p_cost`, `packages_category`, `IsFeatured`, `FeaturedText`, `isactive`, `p_content`, `soft_delete`) VALUES
(1, '6kW', '6-kw_64f06d56a350b.jpg', 900000, 30, 1, 'Average Homes', 1, '<div class=\"save-box\">\n<p class=\"p-text\"><b>Save up to Rs.380,000/year</b></p>\n\n<p class=\"p-text\">7500 units/year</p>\n</div>\n\n<div class=\"text-box\">\n<p style=\"font-size: 20px;\"><b>Just right for average homes</b></p>\n\n<p>6 x Fans</p>\n\n<p>20 x Lights</p>\n\n<p>1 x Refrigerator</p>\n\n<p>1 x Inverter AC 1.5 ton</p>\n\n<p>1 x Water Pump 1HP</p>\n\n<p><b>Tier 1 Products and Brands</b></p>\n\n<p style=\"margin-bottom: 50px;\"><b>Payback Period less than 4&nbsp;yrs.</b></p>\n</div>\n', 0),
(2, '10kW', '1 (2)_64e7634885017.jpg', 900000, 30, 1, 'Standard Homes', 1, '<div class=\"save-box\">\n<p><strong>Save up to Rs.650,000/year</strong></p>\n\n<p class=\"p-text\">14,000 units/year</p>\n</div>\n\n<div class=\"text-box\">\n<p style=\"font-size: 20px;\"><b>Just right for standard homes</b></p>\n\n<p>8 x Fans</p>\n\n<p>25 x Lights</p>\n\n<p>1 x Refrigerator</p>\n\n<p>3 x Inverter AC 1.5 ton</p>\n\n<p>1 x Water Pump 1HP</p>\n\n<p><b>Tier 1 Products and Brands</b></p>\n\n<p style=\"margin-bottom: 50px;\"><b>Payback Period less than 3 yrs.</b></p>\n</div>\n', 0),
(3, '15kW', '3_64e7635dcf9fd.jpg', 900000, 30, 1, 'Spacious Homes', 1, '<div class=\"save-box\">\n<p class=\"p-text\"><b>Save up to Rs.380,000/year</b></p>\n\n<p class=\"p-text\">7500 units/year</p>\n</div>\n\n<div class=\"text-box\">\n<p style=\"font-size: 20px;\"><b>Just right for S</b><strong>pacious homes</strong></p>\n\n<p>15 x Fans</p>\n\n<p>35 x Lights</p>\n\n<p>2 x Refrigerator</p>\n\n<p>4 x Inverter AC 1.5 ton</p>\n\n<p>1 x Water Pump 1HP</p>\n\n<p><b>Tier 1 Products and Brands</b></p>\n\n<p style=\"margin-bottom: 50px;\"><b>Payback Period less than 3 yrs.</b></p>\n</div>\n', 0),
(4, '20kW', '4_64e87c39ccfbc.jpg', 900000, 31, 1, 'Large Homes & Small Businesses', 1, '<div class=\"save-box\">\n<p><strong>Save up to Rs.1350,000 Rs/year</strong></p>\n\n<p>28,500 units/year</p>\n</div>\n\n<div class=\"text-box\">\n<p style=\"font-size: 20px;\"><strong>For larger homes &amp; small Businesses</strong></p>\n\n<p>Tier 1 Solar Modules</p>\n\n<p>20kW Solar Inverter</p>\n\n<p>20,165W&nbsp; Tier 1 Solar Panels</p>\n\n<p><strong>Tier 1 Products and Brands</strong></p>\n\n<p><strong>Payback Period of 2.6 yrs.</strong></p>\n</div>\n', 0),
(5, '30kW', '8_64e87c8fc76cd.jpg', 900000, 31, 1, 'Small to medium scale Businesses', 1, '<div class=\"save-box\">\n<p><strong>Save up to Rs.1350,000 Rs/year</strong></p>\n\n<p>28,500 units/year</p>\n</div>\n\n<div class=\"text-box\">\n<p style=\"font-size: 20px;\"><strong>For larger homes &amp; small Businesses</strong></p>\n\n<p>Tier 1 Solar Modules</p>\n\n<p>30kW Solar Inverter</p>\n\n<p>29,975W&nbsp; Tier 1 Solar Panels</p>\n\n<p><strong>Tier 1 Products and Brands</strong></p>\n\n<p><strong>Payback Period of 2.6 yrs.</strong></p>\n</div>\n', 0),
(6, '50kW', '6_64e87cbca33c9.jpg', 900000, 31, 1, 'Right for Industrial to large business', 1, '<div class=\"save-box\">\n<p><strong>Save up to 3,380,000 Rs/year</strong></p>\n\n<p>70,000 units/year</p>\n</div>\n\n<div class=\"text-box\">\n<p style=\"font-size: 20px;\"><strong>Right for industrial to large business</strong></p>\n\n<p>Tier 1 Solar Modules</p>\n\n<p>50kW Solar Inverter</p>\n\n<p>50,140W&nbsp; Tier 1 Solar Panels</p>\n\n<p><strong>Tier 1 Products and Brands</strong></p>\n\n<p><strong>Payback Period of 2.6 yrs.</strong></p>\n</div>\n', 0),
(7, '6 KW (Hybrid)', '6kw_6501890da286a.jpg', 850000, 35, 1, 'System Details', 1, '<ul>\n	<li>10 x 555w&nbsp;<strong>Tier 1 Solar Modules</strong></li>\n	<li>1 x 6kW&nbsp;<strong>Solarmax Orion&nbsp;</strong>Solar Inverter (48v)</li>\n	<li>4 x 180AH(12v) TR-1600&nbsp;<strong>Osaka Tubular Batteries</strong></li>\n	<li>Mounting Structure G.I Sheet 14 Gage</li>\n	<li>DC Wire, AC &amp; DC Breakers,Box etc.</li>\n	<li>Installation and 02 Year Free After Sales Services</li>\n	<li><strong>Battery Prices are not Included.</strong></li>\n</ul>\n', 0),
(8, '3 KW (Hybrid)', '3kw_650188ddedbbd.jpg', 545000, 35, 1, 'System Details', 1, '<ul>\n	<li>6 x 555ww&nbsp;<strong>Tier 1 Solar Modules</strong></li>\n	<li>1 x 3kW&nbsp;<b>Solarmax Orion&nbsp;</b>Solar Inverter (24v)</li>\n	<li>2 x 185AH (12v)&nbsp;<strong>Tubular Batteries</strong></li>\n	<li>Mounting Structure G.I Sheet 14 Gage</li>\n	<li>DC Wire, AC &amp; DC Breakers, Box etc.</li>\n	<li>Installation and 02 Year Free After Sales Services</li>\n	<li><strong>Battery Prices are not Included.</strong></li>\n</ul>\n', 0),
(9, '8 KW (Hybrid)', '8kw_65018932dac47.jpg', 1370000, 35, 1, 'System Details', 1, '<ul>\n	<li>15 x 555w&nbsp;<strong>Tier 1 Solar Module</strong></li>\n	<li>1 x 8kW&nbsp;<strong>Solarmax Orion</strong>&nbsp;Solar Inverter (48v)</li>\n	<li>4 x 180AH(12v) TR-1600&nbsp;<strong>Osaka Tubular Batteries</strong></li>\n	<li>Mounting Structure G.I Sheet 14 Gage</li>\n	<li>DC Wire, AC &amp; DC Breakers,Box etc.</li>\n	<li>Installation and 02 Year Free After Sales Services</li>\n	<li><strong>Battery Prices are not Included.</strong></li>\n</ul>\n', 0),
(10, '10 KW (Hybrid)', '10a-kw_650189593b704.jpg', 1750000, 35, 1, 'System Details', 1, '<ul>\n	<li>18 x 555w&nbsp;<strong>Tier 1 Solar Module</strong></li>\n	<li>2 x 6kW&nbsp;<strong>Solarmax Orion</strong>&nbsp;Solar Inverter (48v)</li>\n	<li>4 x 230AH(12v) TR-1800&nbsp;<strong>Osaka Tubular Batteries</strong></li>\n	<li>Mounting Structure G.I Sheet 14 Gage</li>\n	<li>DC Wire, AC &amp; DC Breakers,Box etc.</li>\n	<li>Installation and 02 Year Free After Sales Services</li>\n	<li><strong>Battery Prices are not Included.</strong></li>\n</ul>\n', 0),
(11, '12 KW (Hybrid)', '12kw_650189930ab20.jpg', 2135000, 35, 1, 'System Details', 1, '<ul>\n	<li>18 x 555w&nbsp;<strong>Tier 1 Solar Module</strong></li>\n	<li>2 x 6kW&nbsp;<strong>Solarmax Orion</strong>&nbsp;Solar Inverter (48v)</li>\n	<li>4 x 230AH(12v) TR-1800&nbsp;<strong>Osaka Tubular Batteries</strong></li>\n	<li>Mounting Structure G.I Sheet 14 Gage</li>\n	<li>DC Wire, AC &amp; DC Breakers,Box etc.</li>\n	<li>Installation and 02 Year Free After Sales Services</li>\n	<li><strong>Battery Prices are not Included.</strong></li>\n</ul>\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int NOT NULL,
  `catname` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cat_sequence` float NOT NULL DEFAULT '1',
  `cat_url` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `showInNavBar` tinyint DEFAULT '1',
  `CreateHierarchy` tinyint NOT NULL DEFAULT '1',
  `ParentCategory` int NOT NULL DEFAULT '0' COMMENT '0 means no parent (main)',
  `isactive` tinyint NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `catname`, `cat_sequence`, `cat_url`, `showInNavBar`, `CreateHierarchy`, `ParentCategory`, `isactive`, `createdon`, `soft_delete`) VALUES
(1, 'Home', 0, 'index.php', 1, 0, 0, 1, '2021-03-02 17:15:16', 0),
(2, 'About', 1, 'about-us.html', 1, 0, 0, 1, '2022-05-13 18:24:16', 0),
(7, 'Contact', 6, 'contact-us.html', 1, 0, 0, 1, '2022-05-13 18:26:29', 0),
(115, 'products', 87, 'products.html', 0, 0, 0, 1, '2024-08-30 12:38:55', 0),
(116, 'Pages', 4, '#', 1, 1, 0, 1, '2024-10-29 16:20:24', 0),
(117, 'Annocements', 5, '#', 1, 1, 0, 1, '2024-10-30 12:45:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `docu_id` int NOT NULL,
  `document_Title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `document_detail` text COLLATE utf8mb4_general_ci NOT NULL,
  `d_shortlink` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `document_sequence` float NOT NULL DEFAULT '0',
  `document_page` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'sdocument.php' COMMENT 'sdocument withoutstamp , p document with protiter , stdocument.php with hatinc',
  `isactive` tinyint NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `evid` int NOT NULL,
  `f_name` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `address1` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `l_name` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `event_name` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `address2` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `zip` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`evid`, `f_name`, `email`, `address1`, `l_name`, `event_name`, `phone`, `address2`, `city`, `state`, `zip`, `isactive`, `soft_delete`) VALUES
(1, 'Ali', 'm.ali.mamoon@hotmail.com', 'Shadman Town North Karachi', 'Mian', 'Together Again Event For Year 2023', '+923322982223', 'Shadman Town North Karachi', 'Karachi', '1', '74600', 1, 0),
(2, 'jacob', 'ibotoempire@gmail.com', '15603 Sesame Seed Avanue', 'oroks', 'Together Again Event For Year 2023', '9095599031', '15603 Sesame Seed Avanue', 'Fontana', '5', '92336', 1, 0),
(3, 'jacob', 'ibotoempire@gmail.com', '15603 Sesame Seed Avanue', 'oroks', 'Together Again Event For Year 2023', '9095599031', '15603 Sesame Seed Avanue', 'Fontana', '5', '92336', 1, 0),
(4, 'Ekemini', 'loveaflame1@gmail.com', '15603 Sesame Seed Avanue', 'Oroks', 'Together Again Event For Year 2023', '9095599031', '15603 Sesame Seed Avanue', 'Fontana', '14', '92336', 1, 0),
(5, 'jacob', 'jacoboroks@yahoo.com', '15603 Sesame Seed Avanue', 'Oroks', 'Together Again Event For Year 2023', '9095599031', '15603 Sesame Seed Avanue', 'Fontana', '14', '92336', 1, 0),
(6, 'Ete', 'jacoboroks@yahoo.com', '15603 Sesame Seed Avanue', 'Otu', 'Together Again Event For Year 2023', '9095599031', '15603 Sesame Seed Avanue', 'Fontana', '14', '92336', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `i_id` int NOT NULL,
  `pid` int NOT NULL,
  `i_name` varchar(200) COLLATE utf8mb3_unicode_ci NOT NULL,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loginuser`
--

CREATE TABLE `loginuser` (
  `id` int NOT NULL,
  `username` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usertypeid` int DEFAULT NULL,
  `phonenumber` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phonenumber2` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emailaddress` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emailaddress2` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `confirmation_code` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isactive` int DEFAULT '1',
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdby` int DEFAULT NULL,
  `updatedon` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedby` int DEFAULT NULL,
  `useraccessip` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastaccessip` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `soft_delete` tinyint NOT NULL DEFAULT '0',
  `country` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `home_phone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mobile_phone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `other_email_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `company_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `company_phone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `toll_phone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loginuser`
--

INSERT INTO `loginuser` (`id`, `username`, `password`, `usertypeid`, `phonenumber`, `phonenumber2`, `emailaddress`, `emailaddress2`, `confirmation_code`, `profile_pic`, `isactive`, `createdon`, `createdby`, `updatedon`, `updatedby`, `useraccessip`, `lastaccessip`, `fullname`, `soft_delete`, `country`, `city`, `state`, `zip`, `home_phone`, `mobile_phone`, `fax`, `other_email_address`, `website`, `company`, `company_title`, `company_phone`, `toll_phone`, `address`) VALUES
(1, 'superadmin', '2d09b4b9eca8dbeb30023e620bd0d8b1', 1, '', NULL, 'info@hatinco.com', NULL, '3c9a4c4ef63c27edafb84b2212638c32', 'buytwitter_5f980d07ae691.png', 1, '2020-06-23 06:16:52', NULL, '2023-03-27 05:24:16', 1, NULL, '102.129.252.162', 'Ali Mian', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'test2', '54849ca2f37bc0febdb5299d33b691f5', 1, '123', NULL, 'test2@hatinco.com', NULL, NULL, 'Capture_603e2164cdbe6.PNG', 1, '2021-03-02 16:28:50', 1, '2021-03-02 16:28:50', NULL, '::1', '::1', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `og_dashboard`
--

CREATE TABLE `og_dashboard` (
  `id` int NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `soft_delete` tinyint NOT NULL DEFAULT '0',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `og_dashboard`
--

INSERT INTO `og_dashboard` (`id`, `title`, `url`, `isactive`, `soft_delete`, `createdon`, `createdby`, `updatedon`, `updatedby`) VALUES
(1, 'Admin', 'dashboard_admin.php', 1, 0, '2019-07-20 06:57:19', NULL, NULL, NULL),
(2, 'User', 'dashboard_user.php', 1, 0, '2019-07-30 15:08:59', NULL, NULL, NULL),
(3, 'Member', 'dashboard_member.php', 1, 0, '2022-09-12 04:06:33', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `og_module`
--

CREATE TABLE `og_module` (
  `id` int NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hierarchy` float DEFAULT NULL,
  `showInNavBar` tinyint NOT NULL DEFAULT '1',
  `iconclass` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isactive` int DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` int DEFAULT NULL,
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `og_module`
--

INSERT INTO `og_module` (`id`, `title`, `url`, `hierarchy`, `showInNavBar`, `iconclass`, `isactive`, `createdon`, `createdby`, `updatedon`, `updatedby`, `soft_delete`) VALUES
(1, 'Orders', 'order.php', 0, 0, NULL, 1, '2020-07-07 15:55:47', NULL, '2021-03-02 16:21:54', NULL, 0),
(2, 'Payments', 'payments.php', 6, 0, 'fa fa-money', 1, '2020-07-08 10:31:43', NULL, '2021-03-02 16:35:52', NULL, 0),
(3, 'Modules', 'og_packages_category.php', 5, 1, 'fa fa-archive', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:45:45', NULL, 0),
(4, 'Promo Code', 'view_promo_code.php', 4, 1, 'fa fa-gift', 1, '2021-03-02 16:18:06', NULL, '2022-06-28 15:07:30', NULL, 1),
(5, 'Template', 'site_template.php', 7, 1, 'fa fa-paint-brush', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:36:32', NULL, 0),
(6, 'File Manager', 'file_manger.php', 8, 1, 'fa fa-wrench', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:37:24', NULL, 0),
(7, 'User Management ', 'user.php', 9, 1, 'fa fa-users', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:37:37', NULL, 0),
(8, 'Settings', 'og_setting.php', 10, 1, 'fa fa-cogs', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:37:58', NULL, 0),
(9, 'Gallery', 'gallery.php', 1, 1, 'fa fa-picture-o', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:32:36', NULL, 0),
(10, 'Menue', 'categories.php', 3, 1, 'fa fa-sitemap', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:54:47', NULL, 0),
(11, 'Pages', 'pages.php', 2.2, 1, 'fa fa-file-text', 1, '2021-03-02 16:21:32', NULL, '2022-06-27 18:21:56', NULL, 0),
(14, 'Blogs', 'pages.php?temp=3&cat=12', 2.3, 1, 'fa fa-rss', 1, '2022-06-27 19:47:46', NULL, '2024-04-24 20:32:15', NULL, 0),
(15, 'Memberships', 'member.php', 3.1, 1, 'fa fa-user-plus', 1, '2022-06-27 20:07:03', NULL, '2022-07-26 04:24:59', NULL, 0),
(16, 'Data Export', 'db-migration.php', NULL, 1, 'fa fa-database', 1, '2022-06-28 15:01:27', NULL, NULL, NULL, 0),
(17, 'Shop', 'products.php', 3.2, 1, 'fa fa-shopping-basket', 0, '2022-08-30 07:14:34', NULL, '2024-04-24 13:25:02', NULL, 0),
(18, 'Event Members', 'event_registration.php', 0, 1, 'fa fa-calendar', 1, '2023-03-27 05:23:55', NULL, '2023-03-27 05:25:21', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `og_moduleactions`
--

CREATE TABLE `og_moduleactions` (
  `id` int NOT NULL,
  `title` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` int DEFAULT NULL,
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `og_moduleactions`
--

INSERT INTO `og_moduleactions` (`id`, `title`, `isactive`, `createdon`, `createdby`, `updatedon`, `updatedby`, `soft_delete`) VALUES
(1, 'View', 1, '2019-07-20 06:58:54', NULL, NULL, NULL, 0),
(2, 'Add', 1, '2019-07-20 06:58:54', NULL, NULL, NULL, 0),
(3, 'Edit', 1, '2019-07-20 06:58:54', NULL, NULL, NULL, 0),
(4, 'Delete', 1, '2019-07-20 06:58:54', NULL, NULL, NULL, 0),
(5, 'Status', 1, '2019-07-20 06:58:54', NULL, '2019-07-29 19:58:42', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `og_packages_category`
--

CREATE TABLE `og_packages_category` (
  `og_all_packages_id` int NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `short_code` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `isactive` int NOT NULL DEFAULT '1',
  `soft_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `og_packages_category`
--

INSERT INTO `og_packages_category` (`og_all_packages_id`, `title`, `location`, `short_code`, `isactive`, `soft_delete`) VALUES
(1, 'Backlinks', 'modules/module_packages.php', '{Backlinks}', 1, 1),
(12, 'Menue', 'modules/module_menue.php', '{PRODUCT_MENUE_SHOW}', 1, 0),
(14, 'Comments Section', 'modules/module_comment.php', '{comments}', 1, 0),
(15, 'BLOG LISTING', 'modules/module_box.php', '{ALL_BLOGS}', 1, 0),
(16, 'Items List', 'modules/module_solar_list.php', '{SOLAR ITEM LIST}', 1, 0),
(17, 'LATEST BLOGS', 'modules/module_latest_blogs.php', '{LATEST BLOGS}', 1, 0),
(18, 'INVERTER LIST', 'modules/module_inverter_list.php', '{SOLAR INVERTER LIST}', 1, 1),
(19, 'SOLAR BATTERY LIST', 'modules/module_battery_list.php', '{SOLAR BATTERY LIST}', 1, 1),
(20, 'ALL LATEST NEWS', 'modules/module_box.php', '{ALL_LATEST_NEWS}', 1, 0),
(21, 'MEMBERSHIP', 'modules/module_packages.php', '{MEMBERSHIP}', 1, 0),
(22, 'DONATE', 'modules/module_donate.php', '{DONATE_ONLINE}', 1, 0),
(23, 'EVENTS', 'modules/module_box.php', '{EVENTS}', 1, 0),
(24, 'Net Metering Meters', 'modules/module_net_metering.php', '{NET METER LIST}', 1, 1),
(25, 'Shop', 'modules/module_shop_list.php', '{Shop_listing}', 1, 0),
(26, 'CROUSAL BANNER', 'modules/module_slider.php', '{CROUSAL}', 1, 0),
(27, 'Net Metering Meters', 'modules/module_meter_list.php', '{Net Metering Meters}', 1, 1),
(28, 'Solar Mounting Structures List', 'modules/module_structure_list.php', '{Solar Mounting Structures}', 1, 1),
(29, 'Solar Accessories', 'modules/module_solar_accessories.php', '{Solar Accessories}', 1, 1),
(30, 'Residential Packages', 'modules/module_packages.php', '{Packages}', 1, 1),
(31, 'Commercial Packages', 'modules/module_packages.php', '{Commercial Packages}', 1, 1),
(32, 'Quote', 'modules/module_quote.php', '{Quote}', 1, 0),
(33, 'WhatsApp plugin', 'modules/module_whatsapp.php', '{WhatsApp Plugin}', 1, 0),
(34, 'Contact Us', 'modules/module_contactus.php', '{Contact Us}', 1, 0),
(35, 'Residential Packages System', 'modules/module_packages.php', '{Residential Packages System}', 1, 1),
(36, 'MENUE_HIDE', 'modules/module_menue.php', '{PRODUCT_MENUE_HIDE}', 1, 0),
(37, 'CROWSAL', 'modules/module_crowsal.php', '{CROWSAL}', 1, 0),
(38, 'PAGE_MENUE', 'modules/module_page_menue.php', '{PAGE_MENUE}', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `og_settings`
--

CREATE TABLE `og_settings` (
  `settings_id` int NOT NULL,
  `settings_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `settings_value` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `short_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `og_settings`
--

INSERT INTO `og_settings` (`settings_id`, `settings_name`, `settings_value`, `short_code`, `isactive`, `soft_delete`) VALUES
(1, 'SITE_TITLE', 'Jamia Madniah', '{SITE_TITLE}', 1, 0),
(2, 'SITE_TAGLINE', ' Online Centre for Islamic learning', '{SITE_TAGLINE}', 1, 0),
(3, 'SITE_BASE_URL', 'jamiamadniah.com/', '{BASE_URL}', 1, 0),
(4, 'SITE_API_BASE_URL', 'https://api.development.hatinco.com/HATCMS/', '{API_BASE_URL}', 1, 0),
(5, 'SITE_EMAIL', 'info@hatinco.com', '{SITE_EMAIL}', 1, 0),
(6, 'SITE_KEY', '@PR0DUC70Fh@TINC', '', 1, 0),
(7, 'SITE_KEY_PASS', 'H@T!NC', '', 1, 0),
(8, 'SITE_ENV', '2', '{ENV}', 1, 0),
(9, 'SITE_LOGO', 'https://hatinco.com/images/logo2.png', '{SITE_LOGO}', 1, 0),
(10, 'SITE_IMG_PATH', 'images/', '{ABSOLUTE_IMAGEPATH}', 1, 0),
(11, 'SITE_TIME_ZONE', 'Asia/Karachi', '{TIME_ZONE}', 1, 0),
(12, 'SITE_FILE_PATH', 'files/', '{ABSOLUTE_FILEPATH}', 1, 0),
(13, 'FRIENDLY_URL', '1', '', 1, 0),
(14, 'PAGE_LOADER', '0', '', 1, 0),
(15, 'ERROR_404', 'error404.html', '', 1, 0),
(16, 'LOGS', '0', '', 1, 0),
(17, 'SITE_TELNO', '+0123 456 789', '{SITE_TELNO}', 1, 0),
(18, 'SHOP_LOCATION', 'NO. 342 - London Oxford Street.\r\n012 United Kingdom.', '{SHOP_LOCATION}', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `og_template`
--

CREATE TABLE `og_template` (
  `template_id` int NOT NULL,
  `template_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `template_page` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `og_template`
--

INSERT INTO `og_template` (`template_id`, `template_title`, `template_page`, `createdon`, `isactive`, `soft_delete`) VALUES
(1, 'Blank Page', 'template_blank.php', '2020-11-13 16:06:11', 1, 0),
(2, 'Default', 'template_general.php', '2020-11-13 16:06:11', 1, 0),
(3, 'Blog Page', 'template_blog_preview.php', '2020-11-16 20:22:36', 1, 0),
(4, 'Shop', 'template_shop_preview.php', '2022-06-27 13:19:51', 1, 0),
(5, 'Simple Page', 'template_blank2.php', '2024-10-29 16:27:59', 1, 0),
(11, 'Product Page', 'template_product_preview.php', '2024-08-18 04:11:22', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `og_usertype`
--

CREATE TABLE `og_usertype` (
  `id` int NOT NULL,
  `title` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isactive` int DEFAULT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` int DEFAULT NULL,
  `soft_delete` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `og_usertype`
--

INSERT INTO `og_usertype` (`id`, `title`, `isactive`, `createdon`, `createdby`, `updatedon`, `updatedby`, `soft_delete`) VALUES
(1, 'Super Admin', 1, '2019-07-20 06:59:17', 1, '2019-07-30 14:45:44', NULL, 0),
(2, 'User', 1, '2019-07-30 14:45:31', 1, NULL, NULL, 0),
(3, 'Member', 1, '2022-09-12 04:07:13', 1, '2022-09-12 04:09:19', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_dh`
--

CREATE TABLE `order_dh` (
  `order_id` int NOT NULL,
  `order_title` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_summary` text COLLATE utf8mb4_general_ci,
  `currency` varchar(500) COLLATE utf8mb4_general_ci DEFAULT 'PKR',
  `username_dh` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `useremail_dh` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `userphoneno_dh` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` varchar(256) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `discount` varchar(256) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `promocode` varchar(256) COLLATE utf8mb4_general_ci DEFAULT '0',
  `order_proof` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tx_id` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Amount_Sent` varchar(256) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `payment_method` varchar(256) COLLATE utf8mb4_general_ci DEFAULT '0',
  `isactive` varchar(256) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  `payment_status` tinyint NOT NULL DEFAULT '0' COMMENT ' 0 = pending , \r\n 1 = payment_sent ,\r\n 2 = payment_accepted ,\r\n 3 = payment_rejected',
  `isShown` tinyint NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `soft_delete` smallint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pid` int NOT NULL,
  `catid` int NOT NULL,
  `site_template_id` int NOT NULL,
  `template_id` int NOT NULL,
  `page_url` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_title` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sku` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `UniqueCode` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Inventory ID',
  `inventory_number` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `barcode` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `plistprice` varchar(500) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `pprice` varchar(500) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT 'old price',
  `whole_sale_unit_price` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `stock_status` tinyint NOT NULL DEFAULT '1',
  `stock_qty` int NOT NULL DEFAULT '0',
  `new_arrivals` tinyint NOT NULL DEFAULT '0',
  `featured_product` tinyint NOT NULL DEFAULT '0',
  `on_sale` tinyint NOT NULL DEFAULT '0',
  `best_seller` tinyint NOT NULL DEFAULT '0',
  `trending_item` tinyint NOT NULL DEFAULT '0',
  `hot_item` tinyint NOT NULL DEFAULT '0',
  `header` text COLLATE utf8mb4_general_ci,
  `page_desc` longtext COLLATE utf8mb4_general_ci,
  `page_meta_title` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_meta_keywords` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_meta_desc` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pages_sequence` float NOT NULL DEFAULT '1',
  `isactive` tinyint NOT NULL DEFAULT '1',
  `featured_image` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isFeatured` tinyint NOT NULL DEFAULT '0',
  `views` int NOT NULL DEFAULT '0',
  `showInNavBar` tinyint NOT NULL DEFAULT '1',
  `createdby` int NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pid`, `catid`, `site_template_id`, `template_id`, `page_url`, `page_title`, `sku`, `UniqueCode`, `inventory_number`, `barcode`, `plistprice`, `pprice`, `whole_sale_unit_price`, `stock_status`, `stock_qty`, `new_arrivals`, `featured_product`, `on_sale`, `best_seller`, `trending_item`, `hot_item`, `header`, `page_desc`, `page_meta_title`, `page_meta_keywords`, `page_meta_desc`, `pages_sequence`, `isactive`, `featured_image`, `isFeatured`, `views`, `showInNavBar`, `createdby`, `createdon`, `updatedon`, `soft_delete`) VALUES
(1, 1, 1, 1, 'index.php', 'home', NULL, NULL, NULL, NULL, '0', '0', '0', 1, 0, 1, 1, 1, 1, 1, 0, '', '', 'home', '', '', 0, 1, 'WhatsApp Image 2024-09-05 at 11_66d978d0a9e3f.jpeg', 0, 0, 1, 1, '2021-03-02 17:20:13', '2024-10-29 16:04:35', 0),
(15, 1, 1, 1, 'shop.html', 'shop', NULL, NULL, NULL, NULL, '0', '0', '0', 1, 0, 1, 0, 1, 0, 1, 0, '        <link rel=\"stylesheet\" href=\"css/Shop.css\" type=\"text/css\">', '<!-- HOME / SHOP -->\n<div class=\"third-row\">\n<div class=\"container\">\n<div class=\"row\">\n<div class=\"col-12\">\n<p><a href=\"../HTML/EFIK.html\">Home &gt;</a><span class=\"text-secondary\">Shop</span></p>\n</div>\n</div>\n</div>\n</div>\n\n<div class=\"jumbotron jumbotron-fluid shop-banner\">\n<div class=\"container\">\n<div class=\"row\">\n<div class=\"col-12\">\n<h2>The Products , Gift items and Novelties that you find at ENA marketplace are rare handcrafted ART made possible by a collaboration with great Artists in Efik world.</h2>\n</div>\n\n<div class=\"col-12\">\n<h2>This program and the generous discount provided by these Artists allow ENA to raise money for our Humanitarian work. If you frequent this shop as a habit, you never know what you may find.</h2>\n</div>\n\n<div class=\"col-12\">\n<h2>we are constantly engaged with new and emerging Artists so that we can bring our community and friends excellent functional ideas. We count on your support</h2>\n</div>\n</div>\n</div>\n</div>\n<!-- SHOP-->\n\n<div class=\"container shop-section\">{Shop_listing}</div>\n<!-- BOT STRIP-->\n\n<div class=\"container\"><img class=\"img-fluid bot-strip\" src=\"images/bot-strp.png\" /></div>\n', 'shop', '', 'Pak SolarGrid is a Solar Company in Pakistan Pakistan sell Solar System in Pakistan Pakistan. Go for Solar with No.1 Solar Company in Pakistan sell Solar System in Pakistan. Book Now!', 14, 1, '', 0, 0, 1, 1, '2022-05-13 16:23:36', '2022-08-30 06:01:13', 1),
(28, 1, 1, 2, 'breaking-news.html', 'Breaking News', NULL, NULL, NULL, NULL, '0', '0', '0', 1, 0, 1, 0, 1, 0, 1, 0, '', '{ALL_BREAKING_NEWS}', 'Breaking News', 'Pak SolarGrid, leading solar energy company in lahore pakistan, solar system companies in lahore, best solar energy Company in lahore pakistan, Pak Solar Grid top solar company in lahore pakistan, solar services company in pakistan, no 1 solar company in lahore pakistan, pakistan solar services, Pak Solar Grid systems, renewable eneergy solutions provider in lahore pakistan, residential solar System solutions provider in lahore pakistan, commercial solar system provider in lahore pakistan, roof top solar companies in pakistan, solar panel company in pakistan, solar system company in system, solar energy companies in pakistan, solar power companies in pakistan, turnkey solar energy system', 'Pak SolarGrid is a Solar Company in Pakistan Pakistan sell Solar System in Pakistan Pakistan. Go for Solar with No.1 Solar Company in Pakistan sell Solar System in Pakistan. Book Now!', 26, 1, '', 0, 0, 1, 1, '2022-06-27 13:25:46', '2022-06-27 17:03:19', 1),
(38, 1, 1, 2, 'membership.html', 'Membership', NULL, NULL, NULL, NULL, '0', '0', '0', 1, 0, 1, 0, 1, 0, 1, 0, '<link href=\"css/modals/packages.css\" rel=\"stylesheet\">', '<p>The Efik National Association, Inc. &nbsp;serves as a consortium to all Efik Organizations, otherwise known as &lsquo;local chapters&rsquo;, which are located in different states within the USA. &nbsp;The local chapters provide opportunity for Efik people throughout the USA to enroll and congregate routinely, close to their places of residence, and thus promote grassroots activities.</p>\n\n<p>ENA-USA draws its members directly from all members of the local chapters, and individuals cannot register as a member of ENA-USA without being a registered/dues-paying member of one of its local chapters. &nbsp;Individuals are also free to join any chapter of their choosing as an at-large member, if there is no chapter close to their geographical area of residence; or where the person prefers to be active in a different chapter.</p>\n\n<p>{MEMBERSHIP}</p>\n', 'Membership', 'Pak SolarGrid, leading solar energy company in lahore pakistan, solar system companies in lahore, best solar energy Company in lahore pakistan, Pak Solar Grid top solar company in lahore pakistan, solar services company in pakistan, no 1 solar company in lahore pakistan, pakistan solar services, Pak Solar Grid systems, renewable eneergy solutions provider in lahore pakistan, residential solar System solutions provider in lahore pakistan, commercial solar system provider in lahore pakistan, roof top solar companies in pakistan, solar panel company in pakistan, solar system company in system, solar energy companies in pakistan, solar power companies in pakistan, turnkey solar energy system', 'Pak SolarGrid is a Solar Company in Pakistan Pakistan sell Solar System in Pakistan Pakistan. Go for Solar with No.1 Solar Company in Pakistan sell Solar System in Pakistan. Book Now!', 36, 1, '', 0, 0, 1, 1, '2022-06-27 20:01:31', '2022-06-28 10:36:05', 1),
(47, 8, 1, 4, 'news.html', 'News', NULL, NULL, NULL, NULL, '0', '0', '0', 1, 0, 1, 0, 1, 0, 1, 0, '', '<p><a href=\"https://www.youtube.com/watch?v=BYJ6Rjh-56Q\" target=\"_self\">https://www.youtube.com/watch?v=BYJ6Rjh-56Q&nbsp;</a></p>\n', 'News', 'Pak SolarGrid, leading solar energy company in lahore pakistan, solar system companies in lahore, best solar energy Company in lahore pakistan, Pak Solar Grid top solar company in lahore pakistan, solar services company in pakistan, no 1 solar company in lahore pakistan, pakistan solar services, Pak Solar Grid systems, renewable eneergy solutions provider in lahore pakistan, residential solar System solutions provider in lahore pakistan, commercial solar system provider in lahore pakistan, roof top solar companies in pakistan, solar panel company in pakistan, solar system company in system, solar energy companies in pakistan, solar power companies in pakistan, turnkey solar energy system', 'Pak SolarGrid is a Solar Company in Pakistan Pakistan sell Solar System in Pakistan Pakistan. Go for Solar with No.1 Solar Company in Pakistan sell Solar System in Pakistan. Book Now!', 44, 1, '', 0, 0, 1, 1, '2022-06-30 18:17:59', '2022-06-30 18:20:13', 1),
(64, 14, 1, 3, 'photo.html', 'Photo', NULL, NULL, NULL, NULL, '0', '0', '0', 1, 0, 1, 0, 1, 0, 1, 0, '', '<p>Test</p>\r\n', 'Photo', 'Pak SolarGrid, leading solar energy company in lahore pakistan, solar system companies in lahore, best solar energy Company in lahore pakistan, Pak Solar Grid top solar company in lahore pakistan, solar services company in pakistan, no 1 solar company in lahore pakistan, pakistan solar services, Pak Solar Grid systems, renewable eneergy solutions provider in lahore pakistan, residential solar System solutions provider in lahore pakistan, commercial solar system provider in lahore pakistan, roof top solar companies in pakistan, solar panel company in pakistan, solar system company in system, solar energy companies in pakistan, solar power companies in pakistan, turnkey solar energy system', 'Pak SolarGrid is a Solar Company in Pakistan Pakistan sell Solar System in Pakistan Pakistan. Go for Solar with No.1 Solar Company in Pakistan sell Solar System in Pakistan. Book Now!', 55, 1, 'Efik ekom doooo 2_62e1793a2c2b9.jpg', 0, 0, 1, 1, '2022-09-20 11:39:45', '2022-09-23 10:29:05', 1),
(65, 14, 1, 1, 'video.html', 'Video', NULL, NULL, NULL, NULL, '0', '0', '0', 1, 0, 1, 0, 1, 0, 1, 0, '', '', 'Video', 'Pak SolarGrid, leading solar energy company in lahore pakistan, solar system companies in lahore, best solar energy Company in lahore pakistan, Pak Solar Grid top solar company in lahore pakistan, solar services company in pakistan, no 1 solar company in lahore pakistan, pakistan solar services, Pak Solar Grid systems, renewable eneergy solutions provider in lahore pakistan, residential solar System solutions provider in lahore pakistan, commercial solar system provider in lahore pakistan, roof top solar companies in pakistan, solar panel company in pakistan, solar system company in system, solar energy companies in pakistan, solar power companies in pakistan, turnkey solar energy system', 'Pak SolarGrid is a Solar Company in Pakistan Pakistan sell Solar System in Pakistan Pakistan. Go for Solar with No.1 Solar Company in Pakistan sell Solar System in Pakistan. Book Now!', 56, 1, '', 0, 0, 1, 1, '2022-09-22 09:37:47', '2022-09-22 09:37:47', 1),
(5610, 1, 1, 1, 'error404.html', 'error404', '66d2034bef291', NULL, NULL, NULL, '', '', '0', 1, 0, 1, 0, 1, 0, 1, 0, '', '', 'error404', '', '', 2497, 1, '', 0, 0, 1, 1, '2024-08-30 22:37:38', '2024-08-30 22:37:38', 0),
(7724, 116, 1, 5, 'darse-nazami.html', 'درس نظامی بنین (لڑکوں کیلئے)', '67210b5144b4e', NULL, NULL, NULL, '', '', '0', 1, 0, 0, 0, 0, 0, 0, 0, ' <link rel=\"stylesheet\" href=\"css/darse-nazami.css\" />\r\n', '<p class=\"text-1\">عربی و دینی علوم کا آٹھ سالہ نصاب جو &rsquo;&rsquo;درس نظامی&lsquo;&lsquo; کہلاتا ہے، یہ نصاب دو دو سال پر مشتمل چار مراحل کی شکل میں ہے، عامہ، خاصہ، عالیہ اور عالمیہ۔ ہر دوسرے سال وفاق کا امتحان لیا جاتاہے</p>\r\n\r\n<div class=\"an\">۱۔عامہ(Secondary Stage) ۲سال</div>\r\n\r\n<div class=\"an\">۲۔خاصہ(Intermediate Stage) ۲سال</div>\r\n\r\n<div class=\"an\">۳۔عالیہ(Graduation Stage) ۲سال</div>\r\n\r\n<div class=\"an\">۴۔عالمیہ(Post Graduation Stage) ۲سال</div>\r\n\r\n<ul class=\"another\">\r\n</ul>\r\n\r\n<p class=\"text-2\">:شرائطِ داخلہ</p>\r\n\r\n<div class=\"an txt_ali\">&nbsp;\r\n<ol>\r\n	<li dir=\"RTL\">شعبۂ درسِ نظامی میں داخلہ کی کاروائی کا آغاز عید الفطر کی تعطیلات کے بعد 6 شوال سے ہوتا ہے، اس لئے داخلہ کے خواہش مند حضرات 6 شوال سے داخلہ کاروائی کے لئے رجوع فرمائیں۔</li>\r\n	<li dir=\"RTL\">اگر کوئی طالب علم درجۂِ اُولیٰ میں داخلے کی خواہش رکھتا ہو تو اس کے لئے کم از کم مڈل کی استعداد کا حامل ہونا ضروری ہے،۔</li>\r\n	<li dir=\"RTL\">کسی بھی درجہ میں داخلہ کے لئے اس سے پچھلے درجہ کی تمام &rsquo;&rsquo;معیاری کتب&lsquo;&lsquo; کا امتحان لیا جاتا ہے۔مثلاًدرجۂ ثانیہ میں داخلہ کے لئے درجۂ اُولیٰ کی معیاری کتب کا امتحان لیا جائے گا۔</li>\r\n	<li dir=\"RTL\">داخلہ کمیٹی ہر جدید امیدوار کا پہلے تحریری امتحان لیتی ہے، پھر اس میں کامیاب طلبہ کا تقریری (زبانی) جائزہ لیا جاتا ہے، اس کے بعد امیدوار کی استعداد سامنے آجانے پر :(الف) داخلہ دینے یا نہ دینے، (ب) مطلوبہ درجہ میں داخلہ منظور کرنے (ج) یا کوئی اور درجہ تجویز کرنے کا فیصلہ کیا جاتا ہے۔</li>\r\n	<li dir=\"RTL\">ہر درجہ کے لئے طلبہ کی تعداد متعین ہے، اسی کے مطابق داخلے کیے جاتے ہیں، اگر کسی درجہ میں گنجائش بالکل نہ ہو یا محدود ہو تو اس کا اعلان پہلے ہی سے کردیا جاتا ہے، البتہ بہت ممتاز صلاحیت کے حامل طلبہ کے معاملہ پر غور کیا جاسکے گا۔</li>\r\n	<li dir=\"RTL\">اگر دارالطلبہ میں رہائش کی گنجائش نہ ہو یا رہائش کا کوئی مانع موجود ہو یا کوئی مصلحت سامنے ہو، تو ان مخصوص حالات میں طالبِ علم کو داخلہ بلارہائش دیا جاسکے گا۔</li>\r\n</ol>\r\n\r\n<p class=\"text-2\">:تعلیمی دورانیہ و تعطیلات</p>\r\nجامعہ مدنیہ کراچی میں تعلیمی دورانیہ ۱۶ شوال تا ۱۵ شعبان ہے، دورانِ سال ہفت روزہ تعطیل صرف جمعہ کے دن ہوتی ہے، بقیہ ایام میں تعلیم کا کام تسلسل کے ساتھ جاری رہتا ہے ۔\r\n\r\n<p class=\"text-2\">:امتحانات</p>\r\nتعلیمی سال کے دوران تین امتحانات لئے جاتے ہیں: عموماً سہماہی امتحان ماہِ صفر کے پہلے ہفتہ میں، ششماہی امتحان جمادی الاولیٰ کے پہلے ہفتہ میں اور سالانہ امتحان شعبان کے پہلے عشرے میں ہوتا ہے۔ مطالعہ اور تکرار(اسباق کی دہرائی) ہرسبق سے متعلق دو کام طلبہ کے لئے لازمی ہیں۔ ایک اگلے دن کے سبق کے لئے کتاب کا مطالعہ، تاکہ طالب علم کا ذہن سبق کے لئے تیار ہوجائے اور وہ بصیرت اور تیقظ کے ساتھ استاذ کے سامنے سبق سمجھ سکے۔ دوسرا کام پڑھے ہوئے سبق کا تکرار کرنا ہے۔ &rsquo;&rsquo;تکرار&lsquo;&lsquo; مدارس کی ایک اصطلاح ہے، طلبہ استاذ سے سبق پڑھنے کے بعد دوپہر 2 بجے سے 4 بجے تک اور عموماً رات کے اوقات میں چھوٹے چھوٹے حلقوں میں بیٹھ جاتے ہیں۔ ان طلبہ میں سے ایک طالب علم پڑھے ہوئے سبق کو استاذ کے پڑھائے ہوئے طریقے کے مطابق دہراتا ہے۔ یہ طریقہ درس نظامی کی ممتاز خصوصیت ہے جس کے ذریعے ہر طالب علم کے ذہن میں نہ صرف پڑھا ہوا سبق مستحکم ہو جاتاہے، بلکہ ساتھ ہی ساتھ اسے پڑھانے اور اظہار مافی الضمیر کی عملی تربیت بھی حاصل ہوتی ہے۔ تکرار تقریباً ہر جماعت کے طلبہ کے لئے لازمی ہے۔\r\n\r\n<p class=\"text-2\">:سہولیات</p>\r\nدرسِ نظامی کے طالبِ علم کے لئے جامعہ جامعه مدنیہ کراچی میں تعلیم کی کوئی فیس نہیں ہے، نیز ان طلبہ کو رہائش، طعام ، ابتدائی طبی امداد اور کسی حد تک علاج و معالجہ کی سہولیات جامعہ کی طرف سے بلا معاوضہ مہیا کی جاتی ہیں،</div>\r\n', 'درس نظامی بنین (لڑکوں کیلئے)', '', '', 2, 1, '1.png', 0, 0, 1, 1, '2024-10-29 16:23:27', '2024-10-29 16:51:24', 0),
(7725, 116, 1, 5, 'Hafiza-Arbic.html', 'حفاظ عربی (جامعہ مدنیہ م کے زیر اہتمام بچوں کے لیے خصوصا حفاظ کرام کے لیے چار سالہ کورس)', 'undefined', NULL, NULL, NULL, 'undefined', 'undefined', '0', 0, 0, 0, 0, 0, 0, 0, 0, ' <link rel=\"stylesheet\" href=\"css/Hafiza-Arbic.css\" />\r\n', '    <p class=\"text-tre\">تعارف</p>\r\n                        <p class=\"text-1\">\r\n\r\n                            حفاظ کورسز کے تحت حافظ طلبہ کے لیے 4 سالہ دورانئے پر مشتمل ایک پروگرام ترتیب دیا گیا ہے، جس میں انہیں دینی اور\r\n                            عصری تعلیم میں مضبوط بنیاد فراہم کرنے کے لیے میٹرک کی تعلیم دی جاتی ہے۔ کورس کی\r\n                            خصوصیت یہ ہے کہ اس میں طلبہ دینی تعلیم مکمل عربی ماحول اور عصری تعلیم مکمل انگریزی ماحول میں حاصل کرتے ہیں۔\r\n                            طلبہ کی تخلیقی صلاحیتوں کو نکھارنے کے لیے انہیں جامعہ سے باہر مختلف نصابی اور ہم نصابی سرگرمیوں میں شرکت کا\r\n                            موقع دیا جاتا ہے، جن میں طلبہ اب تک مختلف مقابلوں میں الحمدللہ کئی ایوارڈز، ٹرافیاں اور میڈلز حاصل کرچکے ہیں نیز طلبہ\r\n                            کو 4 سال کے دوران خطابت بھی سکھائی جاتی ہے۔</p>\r\n                           <div class=\"container-fluid\">\r\n                            <div class=\"row\">\r\n                              <div class=\"form-big\">\r\n                              <div class=\"col-md-6\">\r\n                                <p class=\"p-1\">سال دوم : حفاظ انگلش کورس +8 کلاسth </p>\r\n                                <p class=\"para-11\">Writing, reading, Speaking Listening اس\r\n                                  کی تعلیم کے ساتھ درج ذیل چیزوں کا اہتمام کیا جاتا ہے۔<br>\r\n                                  گرامر اور ریڈنگ پر مکمل توجہ    (1)<br>\r\n                                  (2)      انگریزی کیلی گرافی کے ذریعے لکھائی پر خصوصی توجہ<br>\r\n                                  (3)     مڈل کلاس تک ریاضی اور جنرل سائنس کی تعلیم<br>\r\n                                  (4)    انگریزی زبان میں خطابت کی مشق<br>\r\n                                  (5)   انگلش بول چال کا مکمل ماحول<br>\r\n                                  (6)       ملٹی میڈیا کا استعمال کرتے ہوئے English Accent پر توجہ\r\n                                </p>\r\n                              </div>\r\n                              <div class=\"col-md-6\">\r\n                                <p class=\"p-1\">سال اول : حفاظ عربک کورس</p>\r\n                                <P class=\"para-11\">اس سال عربی زبان کی چاروں مہارتوں ( لکھنا، پڑھنا، بولنا اور سمجھنا ) کی تعلیم,\r\n                                   کے ساتھ درج ذیل چیزوں کا اہتمام کیا جاتا ہے۔<br>\r\n                                   (1)    قرآنی عربی کی مدد سے قرآن فہمی اور ترجمہ کی مشق<br>\r\n                                   (2)    سینکڑوں احادیث حفظ کروانا<br>\r\n                                   (3)    ملٹی میڈیا کا استعمال کرتے ہوئے لب ولہجہ پر خصوصی توجہ<br>\r\n                                   (4)    عربی زبان میں خطابت کی مشق<br>\r\n                                   (5)    عربی مضمون نویسی کے لیے مجلة جدارية کا اجراء<br>\r\n                                   (6)     عربی بول چال کا مکمل ماحول<br>\r\n                                   (7)     سال کے آخر میں ریاضی اور انگلش کا چھٹیوں میں ہوم ورک</P>\r\n                              </div>\r\n                            </div>\r\n                          </div>\r\n                          <div class=\"row\">\r\n                            <div class=\"form-big\">\r\n                            <div class=\"col-md-6\">\r\n                              <p class=\"p-1\">سال چهارم : درجہ اولی + 10th کلاس</p> \r\n                              <p class=\"para-11\">سال درس نظامی کے سال اول ( درجہ اولی ) کے ساتھ ساتھ دسویں کلاس\r\n                               ( میٹرک سائنس ) کی تعلیم کے ساتھ درج ذیل چیزوں کا اہتمام کیا جاتا ہے۔۔<br>\r\n                              (1)  درس نظامی کے سال اول کی ایڈوانس صرف و نحو کی تعلیم<br>\r\n                              (2) اردو اور انگلش خوشخطی کی مشق<br>\r\n                              (3)     مشق Debate and Declamation اردو<br>\r\n                              (4)    عربی اور انگلش میں مزید بہتری کے لیے مستقل ایک پیریڈ<br>\r\n                              (5)     سال کے آخر میں مختلف شارٹ کورسز بھی کروائے جاتے ہیں۔\r\n                                \r\n                              </p>\r\n                            </div>\r\n                            <div class=\"col-md-6\">\r\n                              <p class=\"p-1\">سال سوم : درجه متقدم + 9th کلاس</p>\r\n                              <P class=\"para-11\">اس سال نویں کلاس انگلش میڈیم سائنس گروپ ( بائیولوجی، کمپیوٹر سائنس، کیمسٹری)\r\n                                کے مضامین کی تعلیم کے ساتھ درج ذیل چیزوں کا اہتمام کیا جاتاہے۔<br>\r\n                             (1)   درس نظامی کے سال اول کی صرف و نحو کی تعلیم<br>\r\n                             (2)   اردو اور انگلش خوشخطی کی مشق<br>\r\n                             (3)   مشق Debate and Declamation اردو<br>\r\n                             (4)        عربی زبان میں خطابت کی مشق<br>\r\n                             (5)        عربی اور انگلش میں مزید بہتری کے لیے مستقل ایک پیریڈ<br>\r\n                            </div>\r\n                          </div>\r\n                        </div>\r\n                           </div>\r\n                           <div class=\"container-fluid\">\r\n                            <div class=\"box\">\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-6\">\r\n                                  <p class=\"p-3\">شرائط داخله </p>\r\n                                  <div class=\"points-container\">\r\n                                    <p class=\"text-point\">(1) پختہ حفظ قرآن کریاں</p>\r\n                                    <p class=\"text-point\">(2) پرائمری انگریزی کی استعداد</p>\r\n                                    <p class=\"text-point\">(3) عمر 13 سال سے زیادہ نہ ہو</p>\r\n                                </div>\r\n                                </div>\r\n                              <div class=\"col-md-6\">\r\n                                <p class=\"p-3\">خصوصيات </p>\r\n                                <div class=\"points-container\">\r\n                                  <p class=\"text-point\">(1) اخلاقی تربیت پر خصوصی توجہ</p>\r\n                                  <p class=\"text-point\">(2) اساتذہ کی نگرانی میں منزل کی دہرائی</p>\r\n                                  <p class=\"text-point\">(3) فہم قرآن اور حفظ حدیث کا اہتمام</p>\r\n                                  <p class=\"text-point\">(4) شہری ماحول اور صاف ستھری درسگاہیں</p>\r\n                                  <p class=\"text-point\">(5) CCTV کیمروں سے نگرانی کا اہتمام</p>\r\n                                  <p class=\"text-point\">(6) فزیکل فٹنس پر خاص توجہ</p>\r\n                                  <p class=\"text-point\">(7) عصری تقاضوں سے ہم آہنگ سرگرمیاں</p>\r\n                              </div>\r\n                              </div>\r\n                            </div>\r\n                            </div>\r\n                           </div>', 'حفاظ عربی (جامعہ مدنیہ م کے زیر اہتمام بچوں کے لیے خصوصا حفاظ کرام کے لیے چار سالہ کورس)', '', '', 3, 1, '2.png', 0, 0, 1, 1, '2024-10-29 16:59:53', '2024-10-29 16:59:53', 0),
(7726, 116, 1, 2, 'Thakiko-Tasanif.html', 'تحقیق و تصانیف', 'undefined', NULL, NULL, NULL, 'undefined', 'undefined', '0', 0, 0, 0, 0, 0, 0, 0, 0, ' <link rel=\"stylesheet\" href=\"css/Thakiko-Tasanif.css\" />\r\n', '<div class=\"tab\"><button class=\"tablinks\" onclick=\"openTab(event, \'تحقیق و تصانیف\')\">تحقیق و تصانیف</button><button class=\"tablinks\" onclick=\"openTab(event, \'علمی کتب خانہ\')\">علمی کتب خانہ</button></div>\r\n\r\n<div class=\"tabcontent\" id=\"تحقیق و تصانیف\">\r\n<div class=\"main-box\">\r\n<div class=\"top-center-box\">\r\n<div class=\"img-large\">\r\n<div class=\"img-book\"><img class=\"img-responsive\" src=\"./images/5.png\" /></div>\r\n\r\n<p class=\"par-1\">تحقیق و تصانیف</p>\r\n</div>\r\n</div>\r\n\r\n<p class=\"text-2 text-1\">اسلام میں تحقیق تصنیف کی اہمیت</p>\r\n\r\n<p class=\"para-1\">حضوراکرم صلی اللہ علیہ وسلم نے امت کی رہنمائی کے لیے اپنے بعد دو چیزیں چھوڑیں ،کتاب اللہ اور سنت جن کو مضبوطی سے تھامنے کا حکم دیا گیا۔چنانچہ اصحاب رسول صلی اللہ علیہ وسلم اور ان کے تلامذہ تابعین، تبع تابعین ،ائمہ مجتہدین نے اپنی تمام تر تحقیقات میں مرکزی حیثیت قران وحدیث کودی۔اس لیے کہ قرآن کریم اجمال ہے تو حدیث اس کی تفصیل ہے۔ قرآن کریم متن ہے تو حدیث اس کی تشریح ہے۔قرآن وسنت جس طرح دیگر اہم دینی معاملات کی طرف رہنمائی کرتے ہیں اس طرح تحقیق وتفکر اور تدبر کے بارے میں بھی واضح احکاما ت دیتے ہیں۔</p>\r\n\r\n<p class=\"points\">&nbsp;</p>\r\n\r\n<p class=\"text-2\">تحقیق کے فوائد</p>\r\n\r\n<p class=\"para-1\">تحقیق کے بہت سے فوائد ہیں جن میں سے چند ایک درج ذیل ہیں: ۱- نئی معلومات کاحصول ۲- اصل ماخذ تک رسائی ۳- کارکردگی میں اضافہ ۴- حقیقت سے آگاہی ۵- توہمات سے چھٹکارہ ۶- تعصبات کاخاتمہ ۷- صحیح وغلط کی پہچان ۸- ندامت سے بچاو ۹- علم میں وسعت وگہرائی کا پیدا ہونا ۱۰- صلاحیتوں کا نکھرنا ۱۱-صحیح نتائج تک رہنمائی ۱۲- جمود کا خاتمہ ۱۳- صحیح نظریات کی سچائی کا ادراک ۱۴- باطل اور جھوٹ کا رد ۱۵-قوت فیصلہ کا پیدا ہونا ۱۶- آلام ومصائب سے نجات ۱۷-ترقی میں ممد ومعاون ۱۸- پرسکون زندگی گزارنے کے طریقوں کا علم ۱۹- کائنات کے رازوں اور بھیدوں کا علم ۲۰- شکو ک وشبہات کی فضاء کا خاتمہ اور سب سے اہم یہ کہ قرآن وسنت کی صحیح تعلیمات کا حصول</p>\r\n\r\n<div class=\"an\">الحمدللہ جامع مدنیہ میں بھی تحقیق و تصنیف کا سلسلہ کسی نہ کسی درجے میں جاری رہتا ہے اب تک جو تصنیفات سامنے آئی ہیں وہ درج ذیل ہیں ۔\r\n<div class=\"text_list\">\r\n<div class=\"RTL\">1) مشارق الانوار</div>\r\n\r\n<div class=\"RTL\">2) تحفہ والدین</div>\r\n\r\n<div class=\"RTL\">3) تیسیرنحمی</div>\r\n\r\n<div class=\"RTL\">4) آسان فقہ</div>\r\n</div>\r\n</div>\r\n\r\n<ul class=\"another\">\r\n</ul>\r\n</div>\r\n</div>\r\n\r\n<div class=\"tabcontent\" id=\"علمی کتب خانہ\" style=\"display:none;\">\r\n<div class=\"backgroynd white\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-md-12\">\r\n<p class=\"heading\">علمی کتب خانہ</p>\r\n\r\n<p class=\"head-2\"><br />\r\nکتب خانوں کی ضرورت ہر دور میں اہمیت کی حامل یے کتب خانہ جس کو انگریزی میں (لائبریری) کہتے ہیں در حقیقت ان کتب خانوں کا بنیادی مقصد علم کی حفاظت اور اس کی ترسیل ہے &lsquo; کتب خانوں کو کا نام در اصل مسلمان نے معلوماتی مرکز کا نام دیا تھا کیونکہ ان میں بے شمار کتب موجود ہوتی ہے &lsquo; تاریخ شاید ہے کہ بنی نوع انسان کے تہذیب یافتہ دور میں قدم رکھتے ہی کتن خانوں کا آغاز ہوگیا تھا اور ان کتب خانوں کے کتابوں سے علماء و فقہاء و محدثین کرام کی ایک بڑی جماعت نے استفادہ کیا اور ان کتب خانوں کا مقام بہت بلند و برتر کردیا</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"section\">\r\n<div class=\"custom-slider-wrapper\">\r\n<div class=\"custom-slider\">\r\n<div class=\"custom-slide-card\">\r\n<div class=\"slide-img\"><img alt=\"Image 1\" class=\"img-responsive\" src=\"./images/kitab.jpg\" /></div>\r\n\r\n<div class=\"content-background\">\r\n<div class=\"line-2\">&nbsp;</div>\r\n\r\n<div class=\"info-box\">یعلمی کتب خانه</div>\r\n\r\n<p class=\"description\">جامعہ در لے کر اپنی کا طبی کتب خانہ بفضلہ تعالی ملک کے متاز ترین علمی کتب خانوں میں سے ہے بلکہ اسلامی علوم کے بارے میں یہ ملک کا کی اجامع ترین کتب خانہ ہے جس میں ایک لاکھ سے اور کتابوں کا رریع وغیرہ موجود ہے۔</p>\r\n<!-- PDF download button --><button id=\"custom-btn\">مزید تفصیل</button></div>\r\n</div>\r\n\r\n<div class=\"custom-slide-card\">\r\n<div class=\"slide-img\"><img alt=\"Image 2\" class=\"img-responsive\" src=\"./images/kitab.jpg\" /></div>\r\n\r\n<div class=\"content-background\">\r\n<div class=\"box-line\">\r\n<div class=\"line-2\">&nbsp;</div>\r\n\r\n<div class=\"info-box\">طریقہ تعاون</div>\r\n</div>\r\n\r\n<p class=\"description\">جامعہ در لے کر اپنی کا طبی کتب خانہ بفضلہ تعالی ملک کے متاز ترین علمی کتب خانوں میں سے ہے بلکہ اسلامی علوم کے بارے میں یہ ملک کا کی اجامع ترین کتب خانہ ہے جس میں ایک لاکھ سے اور کتابوں کا رریع وغیرہ موجود ہے۔</p>\r\n<!-- PDF download button --><button id=\"custom-btn\">مزید تفصیل</button></div>\r\n</div>\r\n\r\n<div class=\"custom-slide-card\">\r\n<div class=\"slide-img\"><img alt=\"Image 3\" class=\"img-responsive\" src=\"./images/kitab.jpg\" /></div>\r\n\r\n<div class=\"content-background\">\r\n<div class=\"line-2\">&nbsp;</div>\r\n\r\n<div class=\"info-box\">فتوی معلوم کیجئے</div>\r\n\r\n<p class=\"description\">جامعہ در لے کر اپنی کا طبی کتب خانہ بفضلہ تعالی ملک کے متاز ترین علمی کتب خانوں میں سے ہے بلکہ اسلامی علوم کے بارے میں یہ ملک کا کی اجامع ترین کتب خانہ ہے جس میں ایک لاکھ سے اور کتابوں کا رریع وغیرہ موجود ہے۔</p>\r\n<!-- PDF download button --><button id=\"custom-btn\">مزید تفصیل</button></div>\r\n</div>\r\n</div>\r\n</div>\r\n<button class=\"custom-prev-btn\" onclick=\"prevSlide()\">❮</button><button class=\"custom-next-btn\" onclick=\"nextSlide()\">❯</button></div>\r\n</div>\r\n', 'تحقیق و تصانیف', '', '', 4, 1, '5.png', 0, 0, 1, 1, '2024-10-29 17:02:18', '2024-10-29 17:03:13', 0),
(7727, 1, 2, 4, 'books.html', 'books', '67222a59a781c', NULL, NULL, NULL, '', '', '0', 1, 0, 0, 0, 0, 0, 0, 0, '', '<header data-navigation-offset=\"75px\">\r\n<p>&nbsp;</p>\r\n</header>\r\n', 'books', '', '', 5, 1, '', 0, 0, 1, 1, '2024-10-30 12:47:39', '2024-10-30 12:48:29', 1),
(7728, 117, 1, 3, 'announcement1.html', 'اعلان 1', '67264bfee7252', NULL, NULL, NULL, '', '', '0', 1, 0, 0, 0, 0, 0, 0, 0, '', '<p><img alt=\"elaan\" src=\"https://www.farooqia.com/wp-content/uploads/elaan-scaled.jpg\" /></p>\r\n', 'اعلان 1', '', '', 5, 1, '', 0, 0, 1, 1, '2024-11-02 16:01:04', '2024-11-02 16:20:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `page_category`
--

CREATE TABLE `page_category` (
  `pcid` int NOT NULL,
  `page_id` int NOT NULL,
  `cat_id` int NOT NULL,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_id` int NOT NULL,
  `payment_Title` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_detail` text COLLATE utf8mb4_general_ci NOT NULL,
  `payment_sequence` float NOT NULL DEFAULT '0',
  `isactive` tinyint NOT NULL DEFAULT '1',
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `payment_Title`, `payment_detail`, `payment_sequence`, `isactive`, `soft_delete`) VALUES
(1, 'Paypal - m.ali.mamoon@hotmail.com', '<p>Paypal - m.ali.mamoon@hotmail.com</p>\n', 0, 1, 1),
(2, 'Cash in hand', '', 0, 1, 0),
(3, ' Bank Transfer', '', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `vid` int NOT NULL,
  `ParentCategory` int NOT NULL DEFAULT '0',
  `variation_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `variation_value` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(100) COLLATE utf8mb4_general_ci DEFAULT '0' COMMENT '0 no price change',
  `istype` tinyint NOT NULL DEFAULT '1' COMMENT '1 text , 2 image',
  `isactive` tinyint NOT NULL DEFAULT '1',
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`vid`, `ParentCategory`, `variation_type`, `variation_value`, `price`, `istype`, `isactive`, `soft_delete`) VALUES
(1, 0, 'Color', 'sssssssss', '0', 1, 1, 0),
(2, 1, 'Color', 'Blue', '0', 1, 1, 0),
(3, 1, 'Color', 'Green', '0', 1, 1, 0),
(4, 1, 'Color', 'Orange', '0', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `promocode`
--

CREATE TABLE `promocode` (
  `p_id` int NOT NULL,
  `p_title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `p_percent` int NOT NULL,
  `p_code` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `p_desc` text COLLATE utf8mb4_general_ci NOT NULL,
  `p_validity` date NOT NULL,
  `p_used_times` int NOT NULL,
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `isactive` tinyint DEFAULT '0',
  `createdby` int DEFAULT '0',
  `updatedon` datetime DEFAULT NULL,
  `updatedby` int DEFAULT NULL,
  `activatedon` datetime DEFAULT NULL,
  `activatedby` int DEFAULT '0',
  `soft_delete` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promocode`
--

INSERT INTO `promocode` (`p_id`, `p_title`, `p_percent`, `p_code`, `p_desc`, `p_validity`, `p_used_times`, `createdon`, `isactive`, `createdby`, `updatedon`, `updatedby`, `activatedon`, `activatedby`, `soft_delete`) VALUES
(1, '', 0, '', '&lt;p&gt;mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm&lt;/p&gt;\n', '0000-00-00', 0, '2020-11-06 15:09:18', 0, 1, '2021-03-15 16:22:23', 1, NULL, 0, 1),
(2, '', 0, '', '', '0000-00-00', 0, '2020-11-06 15:09:48', 0, 1, NULL, NULL, NULL, 0, 1),
(3, '', 0, '', '', '0000-00-00', 0, '2020-11-06 16:01:54', 0, 1, NULL, NULL, NULL, 0, 1),
(4, 'Winter Promo Code', 1, '1', '&lt;p&gt;1&lt;/p&gt;\n', '2021-06-16', 123, '2021-06-19 09:52:58', 1, 1, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_template`
--

CREATE TABLE `site_template` (
  `st_id` int NOT NULL,
  `st_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `st_header` text COLLATE utf8mb4_general_ci NOT NULL,
  `st_menue` text COLLATE utf8mb4_general_ci NOT NULL,
  `st_footer` text COLLATE utf8mb4_general_ci NOT NULL,
  `st_script` text COLLATE utf8mb4_general_ci NOT NULL,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_template`
--

INSERT INTO `site_template` (`st_id`, `st_name`, `st_header`, `st_menue`, `st_footer`, `st_script`, `isactive`, `soft_delete`) VALUES
(1, 'Basic', '<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js\"></script>\n<script src=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js\"></script>\n<!-- send data -->\n <script src=\"js/API/senddata.js\"></script>\n<!-- general function --> \n<script src=\"js/API/general_function.js\"></script> \n    <link\n      rel=\"stylesheet\"\n      href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css\"\n    />\n    <link\n      rel=\"stylesheet\"\n      href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css\"\n    />\n\n    <link\n      rel=\"stylesheet\"\n      href=\"https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css\"\n    />\n    <link\n      rel=\"stylesheet\"\n      href=\"https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css\"\n    />\n    <link\n      href=\"https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu&display=swap\"\n      rel=\"stylesheet\"\n    />\n    <link\n      rel=\"stylesheet\"\n      href=\"https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0\"\n    />\n    <link rel=\"stylesheet\" href=\"css/main.css\" />\n    <link\n      rel=\"stylesheet\"\n      type=\"text/css\"\n      href=\"//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css\"\n    />\n    <script\n      type=\"text/javascript\"\n      src=\"https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit\"\n    ></script>\n    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js\"></script>\n    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js\"></script>\n    <script\n      type=\"text/javascript\"\n      src=\"//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js\"\n    ></script>\n    <link\n      rel=\"icon\"\n      href=\"./images/favicon_io/favicon.ico\"\n      type=\"image/x-icon\"\n    />\n\n\n  <link rel=\"stylesheet\" href=\"css/style.css\" />\n', '<header>\n      <div class=\"nav-bar\">\n        <div class=\"container-fluid\">\n          <div class=\"row\">\n            <div class=\"col-md-2 col-sm-2 col-xs-6\">\n              <a href=\"./index.html\">\n                <div class=\"logo\">\n                  <img\n                    class=\"img-responsive\"\n                    src=\"./images/logo.png\"\n                    alt=\"Logo\"\n                  />\n                </div>\n              </a>\n            </div>\n\n<style>\n.nav_mar {\n    margin-top: 25px;\n}\n</style>\n\n{PRODUCT_MENUE_SHOW}	\n\n      <!-- Search overlay -->\n      <div class=\"search-overlay\" id=\"searchOverlay\">\n        <div class=\"search-bar-container\">\n          <input\n            type=\"text\"\n            class=\"search-input\"\n            id=\"searchInput\"\n            placeholder=\"Search here...\"\n          />\n          <button class=\"close-btn\" id=\"closeSearch\">×</button>\n        </div>\n      </div>\n\n    </header>', '<footer>\n      <div id=\"about\">\n        <div class=\"fotter-2nd\">\n          <div class=\"container\">\n            <div class=\"row\">\n              <div class=\"col-md-5\">\n                <div class=\"about-section\">\n                  <h2>ABOUT US</h2>\n                  <div class=\"underline\"></div>\n                  <!-- Blue line under the heading -->\n                  <p>\n                    Jamia Madniah is an online centre for traditional <br>\n                    Islamic learning and spiritual sciences under the<br>\n                    supervision of Molana Naeem Sahb (db).<br>\n                    The institute draws its strength from its experienced<br>\n                    and qualified staff – the parent<br>\n                    institution with more than 700 students offering hifz,<br>\n                    Dars e Nizami, Takhassus fil Ifta and Hifz ul Hadtih<br>\n                    programs.\n                  </p>\n                </div>\n              </div>\n              <div class=\"col-md-3\">\n                <div class=\"pages-section\">\n                  <h2>PAGES</h2>\n                  <div class=\"underline\"></div>\n                  <!-- Blue line under the heading -->\n                  <ul class=\"pages-list\">\n                    <a href=\"./darse-nazami.html\">\n                      <li><i class=\"icon fas fa-check\"></i>Dars-e-Nizami</li></a>\n                    \n                    <!-- Gray line under each point -->\n\n                    <a href=\"./Hafiza-Arbic.html\"><li><i class=\"icon fas fa-check\"></i> Huffaz-Arabic</li></a>\n                    \n                    <!-- Gray line under each point -->\n\n                    <a href=\"./Thakiko-Tasanif.html\">\n                      <li><i class=\"icon fas fa-check\"></i>Thakik-o-Tasanif</li></a>\n                    \n                    <!-- Gray line under each point -->\n\n                    <a href=\"./fifz-ul-quran.html\">\n                      <li><i class=\"icon fas fa-check\"></i>Tahfeez-ul-Quran</li></a>\n                    \n                    <!-- Gray line under each point -->\n                    <a href=\"./fatawa.html\">\n                      <li><i class=\"icon fas fa-check\"></i>Dar-ul-Ifta</li></a>\n                    \n                    <!-- Gray line under each point -->\n                    <a href=\"./Darsat.html\">\n                      <li><i class=\"icon fas fa-check\"></i>Short Courses</li></a>\n                    \n                    <!-- Gray line under each point -->\n                    <a href=\"./khidmata-khalq.html\">\n                      <li><i class=\"icon fas fa-check\"></i> khidmata-khalq</li></a>\n                    \n                    <a href=\"./taeerka_tawun.html\">\n                      <li><i class=\"icon fas fa-check\"></i>tarika-e-tawon</li></a>\n                    \n                  </ul>\n                </div>\n              </div>\n              <div class=\"col-md-4\">\n                <div class=\"pages-section\">\n                  <h2>QUICK CONTACT</h2>\n                  <div class=\"underline2\"></div>\n                  <!-- Blue line under the heading -->\n                  <ul class=\"pages-list\">\n                    <li>+92 321 27 25000</li>\n                    <div class=\"gray-line\"></div>\n                    <!-- Gray line under each point -->\n\n                    <li>info@jamiamadniah.com</li>\n                    <div class=\"gray-line\"></div>\n                    <!-- Gray line under each point -->\n\n                    <li>\n                      S/T-4 Block I North-Nazimabad<br>\n                      Karachi Pakistan\n                    </li>\n                    <div class=\"gray-line\"></div>\n                    <!-- Gray line under each point -->\n                  </ul>\n                </div>\n              </div>\n              <div class=\"col-md-4\">\n                <div class=\"newsletter-container\">\n                  <h3 class=\"newsletter-heading\">\n                    Subscribe to our newsletter\n                  </h3>\n                  <div class=\"email-search-bar\">\n                    <input type=\"email\" class=\"email-input\" placeholder=\"Enter your email\">\n                    <button type=\"submit\" class=\"subscribe-button\">\n                      Subscribe\n                    </button>\n                  </div>\n                </div>\n              </div>\n            </div>\n          </div>\n        </div>\n      </div>\n\n      <div class=\"LAST-FOOTER\">\n        <p class=\"last-para-foter\">\n          Copyright  2024 jamiamadniah. All Rights Reserved\n        </p>\n      </div>\n    </footer>', '    <!-- JavaScript Libraries -->\n    <script src=\"https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap\"></script>\n    <script src=\"js/script.js\"></script>\n    <!-- Template Javascript -->', 1, 0),
(2, 'Shop Page Template', '<meta charset=\"utf-8\" />\n<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js\"></script>\n<script src=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js\"></script>\n<link href=\"css/main.css\" rel=\"stylesheet\">\n<!-- send data -->\n <script src=\"js/API/senddata.js\"></script>\n<!-- general function --> \n<script src=\"js/API/general_function.js\"></script> \n<link href=\"css/modals/loading.css\" rel=\"stylesheet\">    \n\n<!-- Favicon -->\n    <link href=\"img/favicon.ico\" rel=\"icon\">\n\n    <!-- Google Web Fonts -->\n    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\">\n    <link href=\"https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap\" rel=\"stylesheet\"> \n\n    <!-- Font Awesome -->\n    <link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css\" rel=\"stylesheet\">\n\n    <!-- Libraries Stylesheet -->\n    <link href=\"lib/owlcarousel/assets/owl.carousel.min.css\" rel=\"stylesheet\">\n\n    <!-- Customized Bootstrap Stylesheet -->\n    <link href=\"css/style.css\" rel=\"stylesheet\">\n', '  <!-- Topbar Start -->\n    <div class=\"container-fluid\">\n        <div class=\"row bg-secondary py-2 px-xl-5\">\n            <div class=\"col-lg-6 d-none d-lg-block\">\n                <div class=\"d-inline-flex align-items-center\">\n                    <a class=\"text-dark\" href=\"\">FAQs</a>\n                    <span class=\"text-muted px-2\">|</span>\n                    <a class=\"text-dark\" href=\"\">Help</a>\n                    <span class=\"text-muted px-2\">|</span>\n                    <a class=\"text-dark\" href=\"\">Support</a>\n                </div>\n            </div>\n            <div class=\"col-lg-6 text-center text-lg-right\">\n                <div class=\"d-inline-flex align-items-center\">\n                    <a class=\"text-dark px-2\" href=\"\">\n                        <i class=\"fab fa-facebook-f\"></i>\n                    </a>\n                    <a class=\"text-dark px-2\" href=\"\">\n                        <i class=\"fab fa-twitter\"></i>\n                    </a>\n                    <a class=\"text-dark px-2\" href=\"\">\n                        <i class=\"fab fa-linkedin-in\"></i>\n                    </a>\n                    <a class=\"text-dark px-2\" href=\"\">\n                        <i class=\"fab fa-instagram\"></i>\n                    </a>\n                    <a class=\"text-dark pl-2\" href=\"\">\n                        <i class=\"fab fa-youtube\"></i>\n                    </a>\n                </div>\n            </div>\n        </div>\n        <div class=\"row align-items-center py-3 px-xl-5\">\n            <div class=\"col-lg-3 d-none d-lg-block\">\n                <a href=\"\" class=\"text-decoration-none\">\n                    <h1 class=\"m-0 display-5 font-weight-semi-bold\"><span class=\"text-primary font-weight-bold border px-3 mr-1\">E</span>Shopper</h1>\n                </a>\n            </div>\n            <div class=\"col-lg-6 col-6 text-left\">\n                <form action=\"\">\n                    <div class=\"input-group\">\n                        <input type=\"text\" class=\"form-control\" placeholder=\"Search for products\">\n                        <div class=\"input-group-append\">\n                            <span class=\"input-group-text bg-transparent text-primary\">\n                                <i class=\"fa fa-search\"></i>\n                            </span>\n                        </div>\n                    </div>\n                </form>\n            </div>\n            <div class=\"col-lg-3 col-6 text-right\">\n                <a href=\"\" class=\"btn border\">\n                    <i class=\"fas fa-heart text-primary\"></i>\n                    <span class=\"badge\">0</span>\n                </a>\n                <a href=\"\" class=\"btn border\">\n                    <i class=\"fas fa-shopping-cart text-primary\"></i>\n                    <span class=\"badge\">0</span>\n                </a>\n            </div>\n        </div>\n    </div>\n    <!-- Topbar End -->\n<!-- Navbar Start -->\n    <div class=\"container-fluid mb-5\">\n        <div class=\"row border-top px-xl-5\">\n            {PRODUCT_MENUE_SHOW}\n            <div class=\"col-lg-9\">\n                <nav class=\"navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0\">\n                    <a href=\"\" class=\"text-decoration-none d-block d-lg-none\">\n                        <h1 class=\"m-0 display-5 font-weight-semi-bold\"><span class=\"text-primary font-weight-bold border px-3 mr-1\">E</span>Shopper</h1>\n                    </a>\n                    <button type=\"button\" class=\"navbar-toggler\" data-toggle=\"collapse\" data-target=\"#navbarCollapse\">\n                        <span class=\"navbar-toggler-icon\"></span>\n                    </button>\n                        <!-- PAGE_MENUE -->\n\n                    	{PAGE_MENUE}\n\n                </nav>\n                {CROWSAL}\n            </div>\n        </div>\n    </div>\n    <!-- Navbar End -->', ' <!-- Footer Start -->\n    <div class=\"container-fluid bg-secondary text-dark mt-5 pt-5\">\n        <div class=\"row px-xl-5 pt-5\">\n            <div class=\"col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5\">\n                <a href=\"\" class=\"text-decoration-none\">\n                    <h1 class=\"mb-4 display-5 font-weight-semi-bold\"><span class=\"text-primary font-weight-bold border border-white px-3 mr-1\">E</span>Shopper</h1>\n                </a>\n                <p>{SITE_TAGLINE}</p>\n                <p class=\"mb-2\"><i class=\"fa fa-map-marker-alt text-primary mr-3\"></i>{SHOP_LOCATION}</p>\n                <p class=\"mb-2\"><i class=\"fa fa-envelope text-primary mr-3\"></i>{SITE_EMAIL}</p>\n                <p class=\"mb-0\"><i class=\"fa fa-phone-alt text-primary mr-3\"></i>{SITE_TELNO}</p>\n            </div>\n            <div class=\"col-lg-8 col-md-12\">\n                <div class=\"row\">\n                    <div class=\"col-md-4 mb-5\">\n                        <h5 class=\"font-weight-bold text-dark mb-4\">Quick Links</h5>\n                        <div class=\"d-flex flex-column justify-content-start\">\n                            <a class=\"text-dark mb-2\" href=\"index.html\"><i class=\"fa fa-angle-right mr-2\"></i>Home</a>\n                            <a class=\"text-dark mb-2\" href=\"shop.html\"><i class=\"fa fa-angle-right mr-2\"></i>Our Shop</a>\n                            <a class=\"text-dark mb-2\" href=\"detail.html\"><i class=\"fa fa-angle-right mr-2\"></i>Shop Detail</a>\n                            <a class=\"text-dark mb-2\" href=\"cart.html\"><i class=\"fa fa-angle-right mr-2\"></i>Shopping Cart</a>\n                            <a class=\"text-dark mb-2\" href=\"checkout.html\"><i class=\"fa fa-angle-right mr-2\"></i>Checkout</a>\n                            <a class=\"text-dark\" href=\"contact.html\"><i class=\"fa fa-angle-right mr-2\"></i>Contact Us</a>\n                        </div>\n                    </div>\n                    <div class=\"col-md-4 mb-5\">\n                        <h5 class=\"font-weight-bold text-dark mb-4\">Quick Links</h5>\n                        <div class=\"d-flex flex-column justify-content-start\">\n                            <a class=\"text-dark mb-2\" href=\"index.html\"><i class=\"fa fa-angle-right mr-2\"></i>Home</a>\n                            <a class=\"text-dark mb-2\" href=\"shop.html\"><i class=\"fa fa-angle-right mr-2\"></i>Our Shop</a>\n                            <a class=\"text-dark mb-2\" href=\"detail.html\"><i class=\"fa fa-angle-right mr-2\"></i>Shop Detail</a>\n                            <a class=\"text-dark mb-2\" href=\"cart.html\"><i class=\"fa fa-angle-right mr-2\"></i>Shopping Cart</a>\n                            <a class=\"text-dark mb-2\" href=\"checkout.html\"><i class=\"fa fa-angle-right mr-2\"></i>Checkout</a>\n                            <a class=\"text-dark\" href=\"contact.html\"><i class=\"fa fa-angle-right mr-2\"></i>Contact Us</a>\n                        </div>\n                    </div>\n                    <div class=\"col-md-4 mb-5\">\n                        <h5 class=\"font-weight-bold text-dark mb-4\">Newsletter</h5>\n                        <form action=\"\">\n                            <div class=\"form-group\">\n                                <input type=\"text\" class=\"form-control border-0 py-4\" placeholder=\"Your Name\" required=\"required\" />\n                            </div>\n                            <div class=\"form-group\">\n                                <input type=\"email\" class=\"form-control border-0 py-4\" placeholder=\"Your Email\"\n                                    required=\"required\" />\n                            </div>\n                            <div>\n                                <button class=\"btn btn-primary btn-block border-0 py-3\" type=\"submit\">Subscribe Now</button>\n                            </div>\n                        </form>\n                    </div>\n                </div>\n            </div>\n        </div>\n        <div class=\"row border-top border-light mx-xl-5 py-4\">\n            <div class=\"col-md-6 px-xl-0\">\n                <p class=\"mb-md-0 text-center text-md-left text-dark\">\n                    Copyright <a class=\"text-dark font-weight-semi-bold\" href=\"#\">{SITE_TITLE}</a>. All Rights Reserved. \n					Designed by <a class=\"text-dark font-weight-semi-bold\" href=\"https://hatinco.com\">HAT INC</a>\n                </p>\n            </div>\n            <div class=\"col-md-6 px-xl-0 text-center text-md-right\">\n                <img class=\"img-fluid\" src=\"img/payments.png\" alt=\"\">\n            </div>\n        </div>\n    </div>\n    <!-- Footer End -->\n\n\n    <!-- Back to Top -->\n    <a href=\"#\" class=\"btn btn-primary back-to-top\"><i class=\"fa fa-angle-double-up\"></i></a>', '    <!-- JavaScript Libraries -->\n    <script src=\"https://code.jquery.com/jquery-3.4.1.min.js\"></script>\n    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js\"></script>\n    <script src=\"lib/easing/easing.min.js\"></script>\n    <script src=\"lib/owlcarousel/owl.carousel.min.js\"></script>\n\n    <!-- Contact Javascript File -->\n    <script src=\"mail/jqBootstrapValidation.min.js\"></script>\n    <script src=\"mail/contact.js\"></script>\n\n    <!-- Template Javascript -->\n    <script src=\"js/main.js\"></script>', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertype_dashboard`
--

CREATE TABLE `usertype_dashboard` (
  `id` int NOT NULL,
  `og_usertype_id` int NOT NULL,
  `og_dashboard_id` int NOT NULL,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` int DEFAULT NULL,
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertype_dashboard`
--

INSERT INTO `usertype_dashboard` (`id`, `og_usertype_id`, `og_dashboard_id`, `isactive`, `createdon`, `createdby`, `updatedon`, `updatedby`, `soft_delete`) VALUES
(1, 1, 1, 1, '2019-07-20 07:00:15', NULL, NULL, NULL, 0),
(2, 2, 2, 1, '2019-07-30 15:00:39', NULL, '2020-07-07 16:06:58', NULL, 0),
(3, 3, 3, 1, '2022-09-12 04:07:28', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_module`
--

CREATE TABLE `user_module` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `og_module_id` int NOT NULL,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` int DEFAULT NULL,
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_module`
--

INSERT INTO `user_module` (`id`, `uid`, `og_module_id`, `isactive`, `createdon`, `createdby`, `updatedon`, `updatedby`, `soft_delete`) VALUES
(132, 13, 9, 1, '2022-07-27 15:05:13', NULL, NULL, NULL, 0),
(133, 13, 13, 1, '2022-07-27 15:05:13', NULL, NULL, NULL, 0),
(134, 13, 12, 1, '2022-07-27 15:05:13', NULL, NULL, NULL, 0),
(135, 13, 11, 1, '2022-07-27 15:05:13', NULL, NULL, NULL, 0),
(136, 13, 14, 1, '2022-07-27 15:05:13', NULL, NULL, NULL, 0),
(137, 13, 15, 1, '2022-07-27 15:05:13', NULL, NULL, NULL, 0),
(138, 14, 9, 1, '2022-07-27 15:05:26', NULL, NULL, NULL, 0),
(139, 14, 13, 1, '2022-07-27 15:05:26', NULL, NULL, NULL, 0),
(140, 14, 12, 1, '2022-07-27 15:05:26', NULL, NULL, NULL, 0),
(141, 14, 11, 1, '2022-07-27 15:05:26', NULL, NULL, NULL, 0),
(142, 14, 14, 1, '2022-07-27 15:05:26', NULL, NULL, NULL, 0),
(143, 14, 15, 1, '2022-07-27 15:05:26', NULL, NULL, NULL, 0),
(144, 15, 16, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(145, 15, 1, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(146, 15, 9, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(147, 15, 13, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(148, 15, 12, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(149, 15, 11, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(150, 15, 14, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(151, 15, 15, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(152, 15, 4, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(153, 15, 2, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(154, 15, 5, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(155, 15, 7, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(156, 16, 16, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(157, 16, 1, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(158, 16, 9, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(159, 16, 13, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(160, 16, 12, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(161, 16, 14, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(162, 16, 15, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(163, 16, 2, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(164, 16, 7, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(165, 17, 16, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(166, 17, 1, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(167, 17, 9, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(168, 17, 13, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(169, 17, 12, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(170, 17, 11, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(171, 17, 14, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(172, 17, 10, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(173, 17, 15, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(174, 17, 4, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(175, 17, 3, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(176, 17, 2, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(177, 17, 5, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(178, 17, 6, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(179, 17, 7, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(180, 17, 8, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(197, 19, 16, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(198, 19, 1, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(199, 19, 9, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(200, 19, 13, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(201, 19, 12, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(202, 19, 11, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(203, 19, 14, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(204, 19, 10, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(205, 19, 15, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(206, 19, 4, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(207, 19, 3, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(208, 19, 2, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(209, 19, 5, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(210, 19, 6, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(211, 19, 7, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(212, 19, 8, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(330, 12, 16, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(331, 12, 1, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(332, 12, 9, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(333, 12, 13, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(334, 12, 12, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(335, 12, 11, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(336, 12, 14, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(337, 12, 10, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(338, 12, 15, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(339, 12, 17, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(340, 12, 4, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(341, 12, 3, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(342, 12, 2, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(343, 12, 5, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(344, 12, 6, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(345, 12, 7, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(346, 12, 8, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(364, 1, 16, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(365, 1, 18, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(366, 1, 1, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(367, 1, 9, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(368, 1, 13, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(369, 1, 12, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(370, 1, 11, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(371, 1, 14, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(372, 1, 10, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(373, 1, 15, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(374, 1, 17, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(375, 1, 4, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(376, 1, 3, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(377, 1, 2, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(378, 1, 5, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(379, 1, 6, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(380, 1, 7, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(381, 1, 8, 1, '2023-03-27 05:24:16', NULL, NULL, NULL, 0),
(418, 18, 16, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(419, 18, 18, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(420, 18, 1, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(421, 18, 9, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(422, 18, 13, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(423, 18, 12, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(424, 18, 11, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(425, 18, 14, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(426, 18, 10, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(427, 18, 15, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(428, 18, 17, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(429, 18, 4, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(430, 18, 3, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(431, 18, 2, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(432, 18, 5, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(433, 18, 6, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(434, 18, 7, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(435, 18, 8, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE `user_rights` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `og_moduleactions_id` int NOT NULL,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` int DEFAULT NULL,
  `soft_delete` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_rights`
--

INSERT INTO `user_rights` (`id`, `uid`, `og_moduleactions_id`, `isactive`, `createdon`, `createdby`, `updatedon`, `updatedby`, `soft_delete`) VALUES
(1, 3, 1, 1, '2020-07-03 08:47:46', NULL, NULL, NULL, 0),
(2, 3, 2, 1, '2020-07-03 08:47:46', NULL, NULL, NULL, 0),
(3, 3, 3, 1, '2020-07-03 08:47:46', NULL, NULL, NULL, 0),
(4, 3, 4, 1, '2020-07-03 08:47:46', NULL, NULL, NULL, 0),
(5, 3, 5, 1, '2020-07-03 08:47:46', NULL, NULL, NULL, 0),
(6, 4, 1, 1, '2020-07-03 10:27:02', NULL, NULL, NULL, 0),
(7, 5, 1, 1, '2020-07-03 10:39:09', NULL, NULL, NULL, 0),
(8, 5, 2, 1, '2020-07-03 10:39:10', NULL, NULL, NULL, 0),
(9, 5, 3, 1, '2020-07-03 10:39:10', NULL, NULL, NULL, 0),
(10, 5, 4, 1, '2020-07-03 10:39:10', NULL, NULL, NULL, 0),
(11, 5, 5, 1, '2020-07-03 10:39:10', NULL, NULL, NULL, 0),
(12, 6, 1, 1, '2020-07-03 12:30:17', NULL, NULL, NULL, 0),
(13, 6, 2, 1, '2020-07-03 12:30:17', NULL, NULL, NULL, 0),
(14, 6, 3, 1, '2020-07-03 12:30:17', NULL, NULL, NULL, 0),
(15, 6, 4, 1, '2020-07-03 12:30:17', NULL, NULL, NULL, 0),
(16, 6, 5, 1, '2020-07-03 12:30:17', NULL, NULL, NULL, 0),
(17, 7, 1, 1, '2020-09-22 15:36:54', NULL, NULL, NULL, 0),
(18, 7, 2, 1, '2020-09-22 15:36:54', NULL, NULL, NULL, 0),
(19, 7, 3, 1, '2020-09-22 15:36:54', NULL, NULL, NULL, 0),
(20, 7, 4, 1, '2020-09-22 15:36:54', NULL, NULL, NULL, 0),
(21, 7, 5, 1, '2020-09-22 15:36:54', NULL, NULL, NULL, 0),
(22, 9, 1, 1, '2021-03-02 16:28:50', NULL, NULL, NULL, 0),
(23, 9, 2, 1, '2021-03-02 16:28:50', NULL, NULL, NULL, 0),
(24, 9, 3, 1, '2021-03-02 16:28:50', NULL, NULL, NULL, 0),
(25, 9, 4, 1, '2021-03-02 16:28:50', NULL, NULL, NULL, 0),
(26, 9, 5, 1, '2021-03-02 16:28:50', NULL, NULL, NULL, 0),
(27, 13, 1, 1, '2022-07-27 15:05:13', NULL, NULL, NULL, 0),
(28, 13, 2, 1, '2022-07-27 15:05:13', NULL, NULL, NULL, 0),
(29, 13, 3, 1, '2022-07-27 15:05:13', NULL, NULL, NULL, 0),
(30, 13, 5, 1, '2022-07-27 15:05:13', NULL, NULL, NULL, 0),
(31, 14, 1, 1, '2022-07-27 15:05:26', NULL, NULL, NULL, 0),
(32, 14, 2, 1, '2022-07-27 15:05:26', NULL, NULL, NULL, 0),
(33, 14, 3, 1, '2022-07-27 15:05:26', NULL, NULL, NULL, 0),
(34, 14, 5, 1, '2022-07-27 15:05:26', NULL, NULL, NULL, 0),
(35, 15, 1, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(36, 15, 2, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(37, 15, 3, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(38, 15, 5, 1, '2022-07-27 15:09:46', NULL, NULL, NULL, 0),
(39, 16, 1, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(40, 16, 2, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(41, 16, 3, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(42, 16, 5, 1, '2022-07-27 15:19:59', NULL, NULL, NULL, 0),
(43, 17, 1, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(44, 17, 2, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(45, 17, 3, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(46, 17, 4, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(47, 17, 5, 1, '2022-08-29 14:21:55', NULL, NULL, NULL, 0),
(53, 19, 1, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(54, 19, 2, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(55, 19, 3, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(56, 19, 4, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(57, 19, 5, 1, '2022-08-29 14:29:27', NULL, NULL, NULL, 0),
(78, 12, 1, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(79, 12, 2, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(80, 12, 3, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(81, 12, 4, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(82, 12, 5, 1, '2022-12-03 09:44:42', NULL, NULL, NULL, 0),
(98, 18, 1, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(99, 18, 2, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(100, 18, 3, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(101, 18, 4, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0),
(102, 18, 5, 1, '2023-03-27 11:49:01', NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_packages`
--
ALTER TABLE `all_packages`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`docu_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`evid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `loginuser`
--
ALTER TABLE `loginuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `og_dashboard`
--
ALTER TABLE `og_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `og_module`
--
ALTER TABLE `og_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `og_moduleactions`
--
ALTER TABLE `og_moduleactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `og_packages_category`
--
ALTER TABLE `og_packages_category`
  ADD PRIMARY KEY (`og_all_packages_id`);

--
-- Indexes for table `og_settings`
--
ALTER TABLE `og_settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `og_template`
--
ALTER TABLE `og_template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `og_usertype`
--
ALTER TABLE `og_usertype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_dh`
--
ALTER TABLE `order_dh`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `page_category`
--
ALTER TABLE `page_category`
  ADD PRIMARY KEY (`pcid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `promocode`
--
ALTER TABLE `promocode`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `site_template`
--
ALTER TABLE `site_template`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `usertype_dashboard`
--
ALTER TABLE `usertype_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_module`
--
ALTER TABLE `user_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rights`
--
ALTER TABLE `user_rights`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_packages`
--
ALTER TABLE `all_packages`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `docu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `evid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `i_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loginuser`
--
ALTER TABLE `loginuser`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `og_dashboard`
--
ALTER TABLE `og_dashboard`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `og_module`
--
ALTER TABLE `og_module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `og_moduleactions`
--
ALTER TABLE `og_moduleactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `og_packages_category`
--
ALTER TABLE `og_packages_category`
  MODIFY `og_all_packages_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `og_settings`
--
ALTER TABLE `og_settings`
  MODIFY `settings_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `og_template`
--
ALTER TABLE `og_template`
  MODIFY `template_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `og_usertype`
--
ALTER TABLE `og_usertype`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_dh`
--
ALTER TABLE `order_dh`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7729;

--
-- AUTO_INCREMENT for table `page_category`
--
ALTER TABLE `page_category`
  MODIFY `pcid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `vid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promocode`
--
ALTER TABLE `promocode`
  MODIFY `p_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `site_template`
--
ALTER TABLE `site_template`
  MODIFY `st_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usertype_dashboard`
--
ALTER TABLE `usertype_dashboard`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_module`
--
ALTER TABLE `user_module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT for table `user_rights`
--
ALTER TABLE `user_rights`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
