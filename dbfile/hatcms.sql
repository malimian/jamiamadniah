-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2021 at 11:52 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hatcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_packages`
--

CREATE TABLE `all_packages` (
  `pid` int(11) NOT NULL,
  `ptitle` varchar(50) NOT NULL,
  `p_image` varchar(255) NOT NULL,
  `p_cost` double DEFAULT NULL,
  `packages_category` int(200) NOT NULL,
  `IsFeatured` tinyint(4) NOT NULL DEFAULT 1,
  `FeaturedText` varchar(200) NOT NULL,
  `isactive` tinyint(4) NOT NULL DEFAULT 1,
  `p_content` text NOT NULL,
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_packages`
--

INSERT INTO `all_packages` (`pid`, `ptitle`, `p_image`, `p_cost`, `packages_category`, `IsFeatured`, `FeaturedText`, `isactive`, `p_content`, `soft_delete`) VALUES
(1, 'NOT BASIC', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 69.99, 2, 0, '200 android installs', 1, '<ul class=\"listPriceBox\">\n	<li>Highest OS Version</li>\n	<li>Unique Device&rsquo;s ID/IP</li>\n	<li>Best traffic sources</li>\n	<li>Country targeting</li>\n	<li>Retention 3+ Months</li>\n	<li>Delivery - 1-3 days</li>\n</ul>\n', 1),
(2, 'STANDARD', 'http://development.hatinco.com/adsyprobackend/public/images/seoauditPrice2.png', 140.99, 8, 0, '500 android installs', 1, '<ul class=\"listPriceBox\">\n	<li>Highest OS Version</li>\n	<li>Unique Device&rsquo;s ID/IP</li>\n	<li>Best traffic sources</li>\n	<li>Country targeting</li>\n	<li>Retention 3+ Months</li>\n	<li>Delivery - 3-5 days</li>\n</ul>\n', 0),
(3, 'ADVANCED', 'http://development.hatinco.com/adsyprobackend/public/images/seoauditPrice2.png', 260.99, 8, 0, '1000 android installs', 1, '<ul class=\"listPriceBox\">\n	<li>Highest OS Version</li>\n	<li>Unique Device&rsquo;s ID/IP</li>\n	<li>Best traffic sources</li>\n	<li>Country targeting</li>\n	<li>Retention 3+ Months</li>\n	<li>Delivery - 3-5 days</li>\n</ul>\n', 0),
(4, 'PROFESSIONAL', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 480.99, 8, 0, '2000 android installs', 1, '<ul class=\"listPriceBox\">\n	<li>Highest OS Version</li>\n	<li>Unique Device&rsquo;s ID/IP</li>\n	<li>Best traffic sources</li>\n	<li>Country targeting</li>\n	<li>Retention 3+ Months</li>\n	<li>Delivery - 3-5 days</li>\n</ul>\n', 0),
(5, 'PACKAGE 1', '', 3435, 2, 0, '4v Core ', 1, '<p>asfdas</p>\n\n<p>asdfasdf</p>\n\n<p>asdfasdf</p>\n', 1),
(6, 'PACKAGE testing ', '', 12345, 2, 0, '', 1, '<p>fasdfasdf</p>\n\n<p>fasdsdafbbbbbbhnfgjh</p>\n\n<p>hfgujtyfthr</p>\n\n<p>ertert</p>\n', 1),
(7, 'BASIC', 'http://development.hatinco.com/adsyprobackend/public/images/seoauditPrice1.png', 10.99, 1, 0, '', 1, '<ul>\n	<li>5,000+ Premium Backlinks</li>\n	<li>SEO For 3 Keywords &amp; 1 URL</li>\n	<li>Quality Mixed Backlinks From Articles, Comments, Forum Proﬁles, Bookmarks, Trackbacks ETC</li>\n	<li>Mixed Do-Follow, No-Follow Backlinks</li>\n	<li>Premium Wiki Backlinks</li>\n	<li>20 Press Releases</li>\n	<li>50 Web 2.0 Links</li>\n	<li>45 Social Bookmarks and Blog Comments</li>\n	<li>5 Authority Proﬁle Links</li>\n	<li>Delivery Full Report Within 20 Working Days</li>\n	<li>100% Safe With Search Engines</li>\n	<li>Super Fast Index Process</li>\n	<li>60 Days Ping Back To Your Website</li>\n	<li>Submit To Over 1020 Different Search Engines</li>\n</ul>\n', 0),
(8, 'STANDARD', 'http://development.hatinco.com/adsyprobackend/public/images/seoauditPrice2.png', 20.99, 1, 1, 'POPULAR', 1, '<ul>\n	<li>5,000+ Premium Backlinks</li>\n	<li>SEO For 3 Keywords &amp; 1 URL</li>\n	<li>Quality Mixed Backlinks From Articles, Comments, Forum Proﬁles, Bookmarks, Trackbacks ETC</li>\n	<li>Mixed Do-Follow, No-Follow Backlinks</li>\n	<li>Premium Wiki Backlinks</li>\n	<li>20 Press Releases</li>\n	<li>50 Web 2.0 Links</li>\n	<li>45 Social Bookmarks and Blog Comments</li>\n	<li>5 Authority Proﬁle Links</li>\n	<li>Delivery Full Report Within 20 Working Days</li>\n	<li>100% Safe With Search Engines</li>\n	<li>Super Fast Index Process</li>\n	<li>60 Days Ping Back To Your Website</li>\n	<li>Submit To Over 1020 Different Search Engines</li>\n</ul>\n', 0),
(9, 'PREMIUM', 'http://development.hatinco.com/adsyprobackend/public/images/seoauditPrice3.png', 30.99, 1, 0, '', 1, '<ul>\n	<li>5,000+ Premium Backlinks</li>\n	<li>SEO For 3 Keywords &amp; 1 URL</li>\n	<li>Quality Mixed Backlinks From Articles, Comments, Forum Proﬁles, Bookmarks, Trackbacks ETC</li>\n	<li>Mixed Do-Follow, No-Follow Backlinks</li>\n	<li>Premium Wiki Backlinks</li>\n	<li>20 Press Releases</li>\n	<li>50 Web 2.0 Links</li>\n	<li>45 Social Bookmarks and Blog Comments</li>\n	<li>5 Authority Proﬁle Links</li>\n	<li>Delivery Full Report Within 20 Working Days</li>\n	<li>100% Safe With Search Engines</li>\n	<li>Super Fast Index Process</li>\n	<li>60 Days Ping Back To Your Website</li>\n	<li>Submit To Over 1020 Different Search Engines</li>\n</ul>\n', 0),
(10, 'STARTER', 'buytwitter_5f980d07ae691.png', 45.99, 2, 0, '', 1, '<ul>\n	<li>Management of 1 Ad Platform</li>\n	<li>1 Strategy Call Per Month</li>\n	<li>1 Landing Page A/B Test Per Month</li>\n	<li>CRM Integration</li>\n	<li>Dedicated Lead Generation Expert</li>\n	<li>Custom Landing Page</li>\n	<li>Conversion Tracking</li>\n	<li>CPQL Optimization</li>\n	<li>Smart Bidding</li>\n	<li>Call Tracking</li>\n	<li>Lead Nurturing</li>\n	<li>24/7 Dashboard Report</li>\n	<li>Promote Page</li>\n	<li>Boost a links</li>\n	<li>Analytics Report</li>\n</ul>\n', 0),
(11, 'PROFESSIONAL', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 55.99, 2, 0, '', 1, '<ul>\n	<li>Management of 1 Ad Platform</li>\n	<li>1 Strategy Call Per Month</li>\n	<li>1 Landing Page A/B Test Per Month</li>\n	<li>CRM Integration</li>\n	<li>Dedicated Lead Generation Expert</li>\n	<li>Custom Landing Page</li>\n	<li>Conversion Tracking</li>\n	<li>CPQL Optimization</li>\n	<li>Smart Bidding</li>\n	<li>Call Tracking</li>\n	<li>Lead Nurturing</li>\n	<li>24/7 Dashboard Report</li>\n	<li>Promote Page</li>\n	<li>Boost a links</li>\n	<li>Analytics Report</li>\n</ul>\n', 0),
(12, 'ENTERPRISE', 'http://localhost/adsypro/site_admin/post/general/images_upload/1d8ce711c47f210fe2b5a9ec33ee4dc6.png', 65.99, 2, 0, '', 1, '<ul>\n	<li>Management of 1 Ad Platform</li>\n	<li>1 Strategy Call Per Month</li>\n	<li>1 Landing Page A/B Test Per Month</li>\n	<li>CRM Integration</li>\n	<li>Dedicated Lead Generation Expert</li>\n	<li>Custom Landing Page</li>\n	<li>Conversion Tracking</li>\n	<li>CPQL Optimization</li>\n	<li>Smart Bidding</li>\n	<li>Call Tracking</li>\n	<li>Lead Nurturing</li>\n	<li>24/7 Dashboard Report</li>\n	<li>Promote Page</li>\n	<li>Boost a links</li>\n	<li>Analytics Report</li>\n</ul>\n', 0),
(13, 'ESSENTIAL AUDIT ', 'http://development.hatinco.com/adsyprobackend/public/images/seoauditPrice1.png', 995.99, 3, 0, 'Up to 5,000 indexed urls', 1, '<ul>\n	<li>36 checkpoints</li>\n	<li>1 hour consultation</li>\n</ul>\n', 0),
(14, 'COMPLETE AUDIT ', 'http://development.hatinco.com/adsyprobackend/public/images/seoauditPrice2.png', 1500.99, 3, 0, 'Up to 5,000 indexed urls', 1, '<ul>\n	<li>All checks in &lsquo;Essential&rsquo; plus:</li>\n	<li>Content Audit</li>\n	<li>BackLink Audit</li>\n	<li>Penalty Detection</li>\n	<li>Log file analysis</li>\n	<li>1 hour consultation</li>\n</ul>\n', 0),
(15, 'FULL-BLOWN AUDIT', 'http://development.hatinco.com/adsyprobackend/public/images/seoauditPrice3.png', 2200.99, 3, 0, '', 1, '<ul>\n	<li>All audit checks in &lsquo;Complete&rsquo; plus:</li>\n	<li>Deeper analysis on site structure</li>\n	<li>SERP and competitor analysis</li>\n	<li>2 hours consultation</li>\n</ul>\n', 0),
(16, 'BASIC PACKAGE ', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 44.99, 6, 0, '2,500 FOLLOWERS', 1, '<ul>\n	<li>New Followes Formula</li>\n	<li>No Password Required</li>\n	<li>Premium Profiles</li>\n	<li>Starts within 12 hours</li>\n</ul>\n', 0),
(17, 'STANDARD PACKAGE ', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 84.99, 6, 0, '5,000 FOLLOWERS', 1, '<ul>\n	<li>New Followes Formula</li>\n	<li>No Password Required</li>\n	<li>Premium Profiles</li>\n	<li>Starts within 12 hours</li>\n</ul>\n', 0),
(18, 'ADVANCED PACKAGE ', 'http://development.hatinco.com/adsyprobackend/public/images/seoauditPrice2.png', 159.99, 6, 0, '10,000 FOLLOWERS', 1, '<ul>\n	<li>New Followes Formula</li>\n	<li>No Password Required</li>\n	<li>Premium Profiles</li>\n	<li>Starts within 12 hours</li>\n</ul>\n', 0),
(19, 'PROFESSIONAL ', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 299.99, 6, 0, 'PACKAGE 25,000 FOLLOWERS', 1, '<ul>\n	<li>New Followes Formula</li>\n	<li>No Password Required</li>\n	<li>Premium Profiles</li>\n	<li>Starts within 12 hours</li>\n</ul>\n', 0),
(20, 'BASIC', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 66.99, 8, 0, '200 android installs', 1, '<ul>\n	<li>Highest OS Version</li>\n	<li>Unique Device&rsquo;s ID/IP</li>\n	<li>Best traffic sources</li>\n	<li>Country targeting</li>\n	<li>Retention 3+ Months</li>\n	<li>Delivery - 1-3 days</li>\n</ul>\n', 1),
(21, 'BASIC PACKAGE', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 29.99, 9, 0, '2,500 POST LIKES', 1, '<ul>\n	<li>WORLDWIDE FACEBOOK LIKES</li>\n	<li>No Password Required</li>\n	<li>Premium quality service</li>\n	<li>Delivery starts within 1 hour</li>\n</ul>\n', 0),
(22, 'STANDARD PACKAGE', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 55.99, 9, 0, '5,000 POST LIKES', 1, '<ul>\n	<li>WORLDWIDE FACEBOOK LIKES</li>\n	<li>No Password Required</li>\n	<li>Premium quality service</li>\n	<li>Delivery starts within 1 hour</li>\n</ul>\n', 0),
(23, 'ADVANCED PACKAGE', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 99.99, 9, 0, '10,000 POST LIKES', 1, '<ul>\n	<li>WORLDWIDE FACEBOOK LIKES</li>\n	<li>No Password Required</li>\n	<li>Premium quality service</li>\n	<li>Delivery starts within 1 hour</li>\n</ul>\n', 0),
(24, 'PROFESSIONAL PACKAGE', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 219.99, 9, 0, '25,000 POST LIKES', 1, '<ul>\n	<li>WORLDWIDE FACEBOOK LIKES</li>\n	<li>No Password Required</li>\n	<li>Premium quality service</li>\n	<li>Delivery starts within 1 hour</li>\n</ul>\n', 0),
(25, 'BASIC PACKAGE', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 5.99, 10, 1, '100 FOLLOWERS', 1, '<ul>\n	<li>NEW BEST PRICE OFFER</li>\n	<li>No Password Required</li>\n	<li>Premium Profiles</li>\n	<li>Delivery starts in 24 hours</li>\n</ul>\n', 0),
(26, 'STANDARD PACKAGE', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 25.99, 10, 0, '500 FOLLOWERS', 1, '<ul>\n	<li>NEW BEST PRICE OFFER</li>\n	<li>No Password Required</li>\n	<li>Premium Profiles</li>\n	<li>Delivery starts in 24 hours</li>\n</ul>\n', 0),
(27, 'ADVANCED PACKAGE', '1,000 FOLLOWERS', 49.99, 10, 0, '1,000 FOLLOWERS', 1, '<ul>\n	<li>NEW BEST PRICE OFFER</li>\n	<li>No Password Required</li>\n	<li>Premium Profiles</li>\n	<li>Delivery starts in 24 hours</li>\n</ul>\n', 0),
(28, 'PROFESSIONAL PACKAGE', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 109.99, 10, 0, '2,500 FOLLOWERS', 1, '<ul>\n	<li>NEW BEST PRICE OFFER</li>\n	<li>No Password Required</li>\n	<li>Premium Profiles</li>\n	<li>Delivery starts in 24 hours</li>\n</ul>\n', 0),
(29, 'BASIC PACKAGE', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 113.99, 11, 0, '25,000 VIEWS', 1, '<ul>\n	<li>HIGH RETENTION VIEWS</li>\n	<li>Great for video rankings</li>\n	<li>Premium quality views</li>\n	<li>Delivery starts in 12 hours</li>\n</ul>\n', 0),
(30, 'STANDARD PACKAGE', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 219.99, 11, 0, '50,000 VIEWS', 1, '<ul>\n	<li>HIGH RETENTION VIEWS</li>\n	<li>Great for video rankings</li>\n	<li>Premium quality views</li>\n	<li>Delivery starts in 12 hours</li>\n</ul>\n', 0),
(31, 'ADVANCED PACKAGE', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 423.99, 11, 0, '100,000 VIEWS', 1, '<ul>\n	<li>HIGH RETENTION VIEWS</li>\n	<li>Great for video rankings</li>\n	<li>Premium quality views</li>\n	<li>Delivery starts in 12 hours</li>\n</ul>\n', 0),
(32, 'PROFESSIONAL PACKAGE', 'http://localhost/adsypro/site_admin/post/general/images_upload/006b456180dd3e71327a3cdadaaeb498.png', 990.99, 11, 0, '250,000 VIEWS', 1, '<ul>\n	<li>HIGH RETENTION VIEWS</li>\n	<li>Great for video rankings</li>\n	<li>Premium quality views</li>\n	<li>Delivery starts in 12 hours</li>\n</ul>\n', 0),
(33, 'BASIC PACKAGE', 'seoauditPrice1_5f980369e80b2.png', 3435, 13, 1, '', 1, '<p>SSDGSDF</p>\n\n<p>SDFSDFSDF</p>\n\n<p>SDFSDFSD</p>\n\n<p>SDFSDFSD</p>\n\n<p>SDFSDFSDF</p>\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int(11) NOT NULL,
  `catname` varchar(50) DEFAULT NULL,
  `cat_sequence` float NOT NULL DEFAULT 1,
  `cat_url` varchar(50) DEFAULT NULL,
  `showInNavBar` tinyint(4) DEFAULT 1,
  `CreateHierarchy` tinyint(4) NOT NULL DEFAULT 1,
  `isactive` tinyint(4) NOT NULL DEFAULT 1,
  `createdon` datetime NOT NULL DEFAULT current_timestamp(),
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `catname`, `cat_sequence`, `cat_url`, `showInNavBar`, `CreateHierarchy`, `isactive`, `createdon`, `soft_delete`) VALUES
(1, 'Uncategorized', 0, 'home.html', 1, 0, 1, '2021-03-02 17:15:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loginuser`
--

CREATE TABLE `loginuser` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `usertypeid` int(11) DEFAULT NULL,
  `phonenumber` varchar(50) DEFAULT NULL,
  `phonenumber2` varchar(50) DEFAULT NULL,
  `emailaddress` varchar(50) DEFAULT NULL,
  `emailaddress2` varchar(50) DEFAULT NULL,
  `confirmation_code` varchar(50) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `isactive` int(11) DEFAULT 1,
  `createdon` datetime DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT current_timestamp(),
  `updatedby` int(11) DEFAULT NULL,
  `useraccessip` varchar(20) DEFAULT NULL,
  `lastaccessip` varchar(20) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginuser`
--

INSERT INTO `loginuser` (`id`, `username`, `password`, `usertypeid`, `phonenumber`, `phonenumber2`, `emailaddress`, `emailaddress2`, `confirmation_code`, `profile_pic`, `isactive`, `createdon`, `createdby`, `updatedon`, `updatedby`, `useraccessip`, `lastaccessip`, `fullname`, `soft_delete`) VALUES
(1, 'superadmin', '2d09b4b9eca8dbeb30023e620bd0d8b1', 1, '', NULL, 'Artheaduck1976@dayre.com', NULL, '', 'buytwitter_5f980d07ae691.png', 1, '2020-06-23 06:16:52', NULL, '2021-03-02 16:52:37', 1, NULL, '::1', 'Ali Mian', 0),
(9, 'test2', '54849ca2f37bc0febdb5299d33b691f5', 1, '123', NULL, 'test2@hatinco.com', NULL, NULL, 'Capture_603e2164cdbe6.PNG', 1, '2021-03-02 16:28:50', 1, '2021-03-02 16:28:50', NULL, '::1', '::1', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `og_dashboard`
--

CREATE TABLE `og_dashboard` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `isactive` tinyint(4) NOT NULL DEFAULT 1,
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0,
  `createdon` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `og_dashboard`
--

INSERT INTO `og_dashboard` (`id`, `title`, `url`, `isactive`, `soft_delete`, `createdon`, `createdby`, `updatedon`, `updatedby`) VALUES
(1, 'Admin', 'dashboard_admin.php', 1, 0, '2019-07-20 06:57:19', NULL, NULL, NULL),
(2, 'User', 'dashboard_user.php', 1, 0, '2019-07-30 15:08:59', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `og_module`
--

CREATE TABLE `og_module` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `hierarchy` int(11) DEFAULT NULL,
  `showInNavBar` tinyint(4) NOT NULL DEFAULT 1,
  `iconclass` varchar(50) DEFAULT NULL,
  `isactive` int(11) DEFAULT 1,
  `createdon` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedby` int(11) DEFAULT NULL,
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `og_module`
--

INSERT INTO `og_module` (`id`, `title`, `url`, `hierarchy`, `showInNavBar`, `iconclass`, `isactive`, `createdon`, `createdby`, `updatedon`, `updatedby`, `soft_delete`) VALUES
(1, 'Orders', 'order.php', 0, 0, NULL, 1, '2020-07-07 15:55:47', NULL, '2021-03-02 16:21:54', NULL, 0),
(2, 'Payments', 'payments.php', 6, 0, 'fa fa-money', 1, '2020-07-08 10:31:43', NULL, '2021-03-02 16:35:52', NULL, 0),
(3, 'Modules', 'og_packages_category.php', 5, 1, 'fa fa-archive', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:45:45', NULL, 0),
(4, 'Promo Code', 'view_promo_code.php', 4, 1, 'fa fa-gift', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:34:43', NULL, 0),
(5, 'Template', 'site_template.php', 7, 1, 'fa fa-paint-brush', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:36:32', NULL, 0),
(6, 'File Manager', 'file_manger.php', 8, 1, 'fa fa-wrench', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:37:24', NULL, 0),
(7, 'User Management ', 'user.php', 9, 1, 'fa fa-users', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:37:37', NULL, 0),
(8, 'Settings', 'og_setting.php', 10, 1, 'fa fa-cogs', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:37:58', NULL, 0),
(9, 'Gallery', 'gallery.php', 1, 1, 'fa fa-picture-o', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:32:36', NULL, 0),
(10, 'Menue', 'categories.php', 3, 1, 'fa fa-sitemap', 1, '2021-03-02 16:18:06', NULL, '2021-03-02 16:54:47', NULL, 0),
(11, 'Pages', 'pages.php', 2, 1, 'fa fa-file-text', 1, '2021-03-02 16:21:32', NULL, '2021-03-02 16:33:25', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `og_moduleactions`
--

CREATE TABLE `og_moduleactions` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `isactive` tinyint(4) NOT NULL DEFAULT 1,
  `createdon` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedby` int(11) DEFAULT NULL,
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `og_all_packages_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `location` varchar(255) NOT NULL,
  `short_code` varchar(500) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT 1,
  `soft_delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `og_packages_category`
--

INSERT INTO `og_packages_category` (`og_all_packages_id`, `title`, `location`, `short_code`, `isactive`, `soft_delete`) VALUES
(1, 'Backlinks', 'modules/module_packages.php', '{Backlinks}', 1, 0),
(12, 'Menue', 'modules/module_menue.php', '{MENUE}', 1, 0),
(14, 'Comments Section', 'modules/module_comment.php', '{comments}', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `og_settings`
--

CREATE TABLE `og_settings` (
  `settings_id` int(11) NOT NULL,
  `settings_name` varchar(255) NOT NULL,
  `settings_value` varchar(255) NOT NULL,
  `short_code` varchar(255) NOT NULL,
  `isactive` tinyint(4) NOT NULL DEFAULT 1,
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `og_settings`
--

INSERT INTO `og_settings` (`settings_id`, `settings_name`, `settings_value`, `short_code`, `isactive`, `soft_delete`) VALUES
(1, 'SITE_TITLE', 'HAT CMS', '{SITE_TITLE}', 1, 0),
(2, 'SITE_TAGLINE', '', '{SITE_TAGLINE}', 1, 0),
(3, 'SITE_BASE_URL', 'development.hatinco.com/HATCMS/', '{BASE_URL}', 1, 0),
(4, 'SITE_API_BASE_URL', 'https://api.development.hatinco.com/HATCMS/', '{API_BASE_URL}', 1, 0),
(5, 'SITE_EMAIL', 'info@hatinco.com', '{SITE_EMAIL}', 1, 0),
(6, 'SITE_KEY', '@PR0DUC70Fh@TINC', '', 1, 0),
(7, 'SITE_KEY_PASS', 'H@T!NC', '', 1, 0),
(8, 'SITE_ENV', '2', '{ENV}', 1, 0),
(9, 'SITE_LOGO', 'https://hatinco.com/images/logo2.png', '{SITE_LOGO}', 1, 0),
(10, 'SITE_IMG_PATH', '/images/', '{ABSOLUTE_IMAGEPATH}', 1, 0),
(11, 'SITE_TIME_ZONE', 'America/New_York', '{TIME_ZONE}', 1, 0),
(12, 'SITE_FILE_PATH', '', '{ABSOLUTE_FILEPATH}', 1, 0),
(13, 'FRIENDLY_URL', '1', '', 1, 0),
(14, 'PAGE_LOADER', '1', '', 1, 0),
(15, 'ERROR_404', 'home.html', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `og_template`
--

CREATE TABLE `og_template` (
  `template_id` int(11) NOT NULL,
  `template_title` varchar(255) NOT NULL,
  `template_page` varchar(255) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT current_timestamp(),
  `isactive` tinyint(4) NOT NULL DEFAULT 1,
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `og_template`
--

INSERT INTO `og_template` (`template_id`, `template_title`, `template_page`, `createdon`, `isactive`, `soft_delete`) VALUES
(1, 'Blank Page', 'template_blank.php', '2020-11-13 16:06:11', 1, 0),
(2, 'Default', 'template_general.php', '2020-11-13 16:06:11', 1, 0),
(3, 'Blog Page', 'template_blog_preview.php', '2020-11-16 20:22:36', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `og_usertype`
--

CREATE TABLE `og_usertype` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `isactive` int(11) DEFAULT NULL,
  `createdon` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedby` int(11) DEFAULT NULL,
  `soft_delete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `og_usertype`
--

INSERT INTO `og_usertype` (`id`, `title`, `isactive`, `createdon`, `createdby`, `updatedon`, `updatedby`, `soft_delete`) VALUES
(1, 'Super Admin', 1, '2019-07-20 06:59:17', 1, '2019-07-30 14:45:44', NULL, 0),
(2, 'User', 1, '2019-07-30 14:45:31', 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_dh`
--

CREATE TABLE `order_dh` (
  `order_id` int(11) NOT NULL,
  `order_summary` text DEFAULT NULL,
  `username_dh` varchar(50) NOT NULL,
  `useremail_dh` varchar(50) NOT NULL,
  `userphoneno_dh` varchar(50) NOT NULL,
  `total_price` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `promocode` int(11) DEFAULT NULL,
  `order_proof` varchar(50) DEFAULT NULL,
  `tx_id` varchar(50) DEFAULT NULL,
  `Amount_Sent` float NOT NULL DEFAULT 0,
  `payment_method` int(11) DEFAULT 0,
  `isactive` int(11) NOT NULL DEFAULT 1,
  `payment_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT ' 0 = pending , \r\n 1 = payment_sent ,\r\n 2 = payment_accepted ,\r\n 3 = payment_rejected',
  `isShown` tinyint(4) NOT NULL DEFAULT 1,
  `createdon` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `soft_delete` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_dh`
--

INSERT INTO `order_dh` (`order_id`, `order_summary`, `username_dh`, `useremail_dh`, `userphoneno_dh`, `total_price`, `discount`, `promocode`, `order_proof`, `tx_id`, `Amount_Sent`, `payment_method`, `isactive`, `payment_status`, `isShown`, `createdon`, `createdby`, `updatedon`, `soft_delete`) VALUES
(1, '<div class=\"hostingSummary\">PROFESSIONAL <span>480</span></div><h5>PROFESSIONAL</h5>\n						<ul>\n	<li>Highest OS Version</li>\n	<li>Unique Device’s ID/IP</li>\n	<li>Best traffic sources</li>\n	<li>Country targeting</li>\n	<li>Retention 3+ Months</li>\n	<li>Delivery - 3-5 days</li>\n</ul>\n					', 'Ali', 'm.ali.mamoon@hotmail.com', '03322982223', 480, 0, NULL, NULL, NULL, 0, 0, 1, 0, 1, '2020-10-24 02:37:16', NULL, NULL, 0),
(2, '<div class=\"hostingSummary\">PROFESSIONAL <span>480</span></div><h5>PROFESSIONAL</h5>\n						<ul>\n	<li>Highest OS Version</li>\n	<li>Unique Device’s ID/IP</li>\n	<li>Best traffic sources</li>\n	<li>Country targeting</li>\n	<li>Retention 3+ Months</li>\n	<li>Delivery - 3-5 days</li>\n</ul>\n					', 'Ali', 'm.ali.mamoon@hotmail.com', '03322982223', 480, 0, NULL, NULL, NULL, 0, 0, 1, 0, 1, '2020-10-24 02:37:16', NULL, NULL, 0),
(3, '<div class=\"hostingSummary\">ADVANCED <span>260</span></div><h5>ADVANCED</h5>\n						<ul>\n	<li>Highest OS Version</li>\n	<li>Unique Device’s ID/IP</li>\n	<li>Best traffic sources</li>\n	<li>Country targeting</li>\n	<li>Retention 3+ Months</li>\n	<li>Delivery - 3-5 days</li>\n</ul>\n					', 'Ali', 'm.ali.mamoon@hotmail.com', '03322982223', 260, 0, NULL, NULL, NULL, 0, 0, 1, 0, 1, '2020-10-24 02:38:14', NULL, NULL, 0),
(4, '<div class=\"hostingSummary\">ADVANCED <span>260</span></div><h5>ADVANCED</h5>\n						<ul>\n	<li>Highest OS Version</li>\n	<li>Unique Device’s ID/IP</li>\n	<li>Best traffic sources</li>\n	<li>Country targeting</li>\n	<li>Retention 3+ Months</li>\n	<li>Delivery - 3-5 days</li>\n</ul>\n					', 'Ali', 'm.ali.mamoon@hotmail.com', '03322982223', 260, 0, 0, NULL, '', 0, 0, 1, 1, 1, '2020-10-24 02:38:14', NULL, '2020-10-24 02:38:51', 0),
(5, '<div class=\"hostingSummary\">BASIC <span>69</span></div><h5>BASIC</h5>\n						<ul>\n	<li>Highest OS Version</li>\n	<li>Unique Device’s ID/IP</li>\n	<li>Best traffic sources</li>\n	<li>Country targeting</li>\n	<li>Retention 3+ Months</li>\n	<li>Delivery - 1-3 days</li>\n</ul>\n					', 'Ali', 'm.ali.mamoon@hotmail.com', '03322982223', 69, 0, NULL, NULL, NULL, 0, 0, 1, 0, 1, '2020-10-24 02:41:19', NULL, NULL, 0),
(6, '<div class=\"hostingSummary\">BASIC <span>69</span></div><h5>BASIC</h5>\n						<ul>\n	<li>Highest OS Version</li>\n	<li>Unique Device’s ID/IP</li>\n	<li>Best traffic sources</li>\n	<li>Country targeting</li>\n	<li>Retention 3+ Months</li>\n	<li>Delivery - 1-3 days</li>\n</ul>\n					', 'Ali', 'm.ali.mamoon@hotmail.com', '03322982223', 69, 0, NULL, NULL, NULL, 0, 0, 1, 0, 1, '2020-10-24 02:41:19', NULL, NULL, 0),
(7, '<div class=\"hostingSummary\">COMPLETE AUDIT  <span>1500</span></div><h5>COMPLETE AUDIT </h5>\n						<ul>\n	<li>All checks in ‘Essential’ plus:</li>\n	<li>Content Audit</li>\n	<li>BackLink Audit</li>\n	<li>Penalty Detection</li>\n	<li>Log file analysis</li>\n	<li>1 hour consultation</li>\n</ul>\n					', '', '', '', 1500, 0, NULL, NULL, NULL, 0, 0, 1, 0, 1, '2020-11-10 13:12:50', NULL, NULL, 0),
(8, '<div class=\"hostingSummary\">COMPLETE AUDIT  <span>1500</span></div><h5>COMPLETE AUDIT </h5>\n						<ul>\n	<li>All checks in ‘Essential’ plus:</li>\n	<li>Content Audit</li>\n	<li>BackLink Audit</li>\n	<li>Penalty Detection</li>\n	<li>Log file analysis</li>\n	<li>1 hour consultation</li>\n</ul>\n					', '', '', '', 1500, 0, NULL, NULL, NULL, 0, 0, 1, 0, 1, '2020-11-10 13:12:50', NULL, NULL, 0),
(9, '<div class=\"hostingSummary\">COMPLETE AUDIT  <span>1500</span></div><h5>COMPLETE AUDIT </h5>\n						<ul>\n	<li>All checks in ‘Essential’ plus:</li>\n	<li>Content Audit</li>\n	<li>BackLink Audit</li>\n	<li>Penalty Detection</li>\n	<li>Log file analysis</li>\n	<li>1 hour consultation</li>\n</ul>\n					', '', '', '', 1500, 0, NULL, NULL, NULL, 0, 0, 1, 0, 1, '2020-11-10 13:12:51', NULL, NULL, 0),
(10, '<div class=\"hostingSummary\">COMPLETE AUDIT  <span>1500</span></div><h5>COMPLETE AUDIT </h5>\n						<ul>\n	<li>All checks in ‘Essential’ plus:</li>\n	<li>Content Audit</li>\n	<li>BackLink Audit</li>\n	<li>Penalty Detection</li>\n	<li>Log file analysis</li>\n	<li>1 hour consultation</li>\n</ul>\n					', '', '', '', 1500, 0, NULL, NULL, NULL, 0, 0, 1, 0, 1, '2020-11-10 13:12:51', NULL, NULL, 0),
(11, '<div class=\"hostingSummary\">BASIC <span>10</span></div><h5>BASIC</h5>\n						<ul>\n	<li>5,000+ Premium Backlinks</li>\n	<li>SEO For 3 Keywords &amp; 1 URL</li>\n	<li>Quality Mixed Backlinks From Articles, Comments, Forum Pro?les, Bookmarks, Trackbacks ETC</li>\n	<li>Mixed Do-Follow, No-Follow Backlinks</li>\n	<li>Premium Wiki Backlinks</li>\n	<li>20 Press Releases</li>\n	<li>50 Web 2.0 Links</li>\n	<li>45 Social Bookmarks and Blog Comments</li>\n	<li>5 Authority Pro?le Links</li>\n	<li>Delivery Full Report Within 20 Working Days</li>\n	<li>100% Safe With Search Engines</li>\n	<li>Super Fast Index Process</li>\n	<li>60 Days Ping Back To Your Website</li>\n	<li>Submit To Over 1020 Different Search Engines</li>\n</ul>\n					', 'itdaftar', 'm.ali.mamoon@hotmail.com', '03322982223', 10, 0, NULL, NULL, NULL, 0, 0, 1, 0, 1, '2020-11-23 11:22:41', NULL, NULL, 0),
(12, '<div class=\"hostingSummary\">BASIC <span>10</span></div><h5>BASIC</h5>\n						<ul>\n	<li>5,000+ Premium Backlinks</li>\n	<li>SEO For 3 Keywords &amp; 1 URL</li>\n	<li>Quality Mixed Backlinks From Articles, Comments, Forum Pro?les, Bookmarks, Trackbacks ETC</li>\n	<li>Mixed Do-Follow, No-Follow Backlinks</li>\n	<li>Premium Wiki Backlinks</li>\n	<li>20 Press Releases</li>\n	<li>50 Web 2.0 Links</li>\n	<li>45 Social Bookmarks and Blog Comments</li>\n	<li>5 Authority Pro?le Links</li>\n	<li>Delivery Full Report Within 20 Working Days</li>\n	<li>100% Safe With Search Engines</li>\n	<li>Super Fast Index Process</li>\n	<li>60 Days Ping Back To Your Website</li>\n	<li>Submit To Over 1020 Different Search Engines</li>\n</ul>\n					', 'Ali', 'm.ali.mamoon@hotmail.com', '03322982223', 10, 0, NULL, NULL, NULL, 0, 0, 1, 0, 1, '2020-11-23 11:25:41', NULL, NULL, 0),
(13, '<div class=\"hostingSummary\">BASIC PACKAGE <span>3435</span></div><h5>BASIC PACKAGE</h5>\n						<p>SSDGSDF</p>\n\n<p>SDFSDFSDF</p>\n\n<p>SDFSDFSD</p>\n\n<p>SDFSDFSD</p>\n\n<p>SDFSDFSDF</p>\n					', 'Ali', 'm.ali.mamoon@hotmail.com', '03322982223', 3435, 0, NULL, NULL, NULL, 0, 0, 1, 0, 1, '2020-11-30 14:38:35', NULL, NULL, 0),
(14, '<div class=\"hostingSummary\">BASIC <span>10</span></div><h5>BASIC</h5>\n						<ul>\n	<li>5,000+ Premium Backlinks</li>\n	<li>SEO For 3 Keywords &amp; 1 URL</li>\n	<li>Quality Mixed Backlinks From Articles, Comments, Forum Pro?les, Bookmarks, Trackbacks ETC</li>\n	<li>Mixed Do-Follow, No-Follow Backlinks</li>\n	<li>Premium Wiki Backlinks</li>\n	<li>20 Press Releases</li>\n	<li>50 Web 2.0 Links</li>\n	<li>45 Social Bookmarks and Blog Comments</li>\n	<li>5 Authority Pro?le Links</li>\n	<li>Delivery Full Report Within 20 Working Days</li>\n	<li>100% Safe With Search Engines</li>\n	<li>Super Fast Index Process</li>\n	<li>60 Days Ping Back To Your Website</li>\n	<li>Submit To Over 1020 Different Search Engines</li>\n</ul>\n					', 'Ali', 'm.ali.mamoon@hotmail.com', '03322982223', 10, 0, 0, NULL, '', 0, 1, 1, 1, 1, '2020-11-30 14:48:12', NULL, '2020-11-30 14:49:56', 0),
(15, '<div class=\"hostingSummary\">STARTER <span>45</span></div><h5>STARTER</h5>\n						<ul>\n	<li>Management of 1 Ad Platform</li>\n	<li>1 Strategy Call Per Month</li>\n	<li>1 Landing Page A/B Test Per Month</li>\n	<li>CRM Integration</li>\n	<li>Dedicated Lead Generation Expert</li>\n	<li>Custom Landing Page</li>\n	<li>Conversion Tracking</li>\n	<li>CPQL Optimization</li>\n	<li>Smart Bidding</li>\n	<li>Call Tracking</li>\n	<li>Lead Nurturing</li>\n	<li>24/7 Dashboard Report</li>\n	<li>Promote Page</li>\n	<li>Boost a links</li>\n	<li>Analytics Report</li>\n</ul>\n					', 'Ali', 'm.ali.mamoon@hotmail.com', '03322982223', 45, 0, 0, NULL, '123', 0, 1, 1, 1, 1, '2020-12-01 11:09:41', NULL, '2020-12-01 11:13:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `site_template_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `page_url` varchar(100) DEFAULT NULL,
  `page_title` varchar(200) DEFAULT NULL,
  `header` text DEFAULT NULL,
  `page_desc` longtext DEFAULT NULL,
  `page_meta_title` varchar(100) DEFAULT NULL,
  `page_meta_keywords` varchar(200) DEFAULT NULL,
  `page_meta_desc` varchar(300) DEFAULT NULL,
  `showInNavBar` tinyint(4) NOT NULL DEFAULT 1,
  `pages_sequence` float NOT NULL DEFAULT 1,
  `isactive` tinyint(4) NOT NULL DEFAULT 1,
  `featured_image` varchar(255) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedon` datetime NOT NULL DEFAULT current_timestamp(),
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pid`, `catid`, `site_template_id`, `template_id`, `page_url`, `page_title`, `header`, `page_desc`, `page_meta_title`, `page_meta_keywords`, `page_meta_desc`, `showInNavBar`, `pages_sequence`, `isactive`, `featured_image`, `createdby`, `createdon`, `updatedon`, `soft_delete`) VALUES
(1, 1, 1, 1, 'home.html', 'home', '', '', 'home', '', '', 1, 0, 1, '', 1, '2021-03-02 17:20:13', '2021-04-15 12:13:31', 0),
(2, 1, 1, 3, 'blog.html', 'blog', '', '<header>\n<h1 itemprop=\"headline\">Examples of Blogs &ndash; Inspiration for New Bloggers</h1>\n\n<p>by&nbsp;<a href=\"https://makeawebsitehub.com/author/makeaw9_wp/\" itemprop=\"url\" rel=\"author\" title=\"View all posts by Jamie\">Jamie</a></p>\n</header>\n\n<p><img alt=\"examples of blogs\" data-ll-status=\"loaded\" height=\"645\" itemprop=\"image\" sizes=\"(max-width: 1200px) 100vw, 1200px\" src=\"https://makeawebsitehub.com/wp-content/uploads/2017/03/examples-of-blog.jpg\" srcset=\"https://makeawebsitehub.com/wp-content/uploads/2017/03/examples-of-blog.jpg 1200w, https://makeawebsitehub.com/wp-content/uploads/2017/03/examples-of-blog-300x161.jpg 300w, https://makeawebsitehub.com/wp-content/uploads/2017/03/examples-of-blog-768x413.jpg 768w, https://makeawebsitehub.com/wp-content/uploads/2017/03/examples-of-blog-1024x550.jpg 1024w, https://makeawebsitehub.com/wp-content/uploads/2017/03/examples-of-blog-700x376.jpg 700w\" width=\"1200\" /></p>\n\n<p>If you&rsquo;re thinking of starting a blog of your own, but just don&rsquo;t have a clue on what to blog about, then fear not!</p>\n\n<p>In this article, I have included a whole load of blog examples from a wide variety of different niches, all run on different&nbsp;<a href=\"https://makeawebsitehub.com/choose-right-blogging-platform/\">blogging platforms</a>&nbsp;like WordPress, Joomla! and Drupal.</p>\n\n<p>Since the beginning of the internet, millions and millions and millions of blogs have been created. Many have died due to lost interest or their owners giving up on the idea, while others have thrived and continue to grow,&nbsp;<a href=\"https://makeawebsitehub.com/how-to-make-money-blogging/\" rel=\"noopener noreferrer\" target=\"_blank\">making money</a>&nbsp;and earning their owners a steady income. It&rsquo;s a constant evolution of content that keeps people coming back for more, especially if these blogs contact highly resourceful material that people find useful and interesting.</p>\n\n<p>Each example listed in this blog post are all different in some way and all bring something unique to their readers &amp; subscribers. I want to show you what is possible and how you can take inspiration from them and create an awesome blog of your own.</p>\n\n<p>Some of these blogs make over $100k a month, others are just a hobby for their owners, but all have the same purpose&nbsp;at their core&hellip; the love of writing and sharing information.</p>\n', 'blog', '', '', 1, 1, 1, 'buytwitter_5f980d07ae691.png', 1, '2021-03-02 19:41:41', '2021-03-07 17:21:38', 0),
(3, 1, 1, 3, 'blog2.html', 'blog2', '', '', 'blog2', '', '', 1, 2, 1, '', 1, '2021-03-07 19:59:57', '2021-03-07 19:59:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_id` int(11) NOT NULL,
  `payment_Title` varchar(50) DEFAULT NULL,
  `payment_detail` text NOT NULL,
  `payment_sequence` float NOT NULL DEFAULT 0,
  `isactive` tinyint(4) NOT NULL DEFAULT 1,
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `payment_Title`, `payment_detail`, `payment_sequence`, `isactive`, `soft_delete`) VALUES
(1, 'Paypal - m.ali.mamoon@hotmail.com', '<p>Paypal - m.ali.mamoon@hotmail.com</p>\n', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `promocode`
--

CREATE TABLE `promocode` (
  `p_id` int(11) NOT NULL,
  `p_title` varchar(200) NOT NULL,
  `p_percent` int(11) NOT NULL,
  `p_code` varchar(200) NOT NULL,
  `p_desc` text NOT NULL,
  `p_validity` date NOT NULL,
  `p_used_times` int(11) NOT NULL,
  `createdon` datetime DEFAULT current_timestamp(),
  `isactive` tinyint(4) DEFAULT 0,
  `createdby` int(11) DEFAULT 0,
  `updatedon` datetime DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `activatedon` datetime DEFAULT NULL,
  `activatedby` int(11) DEFAULT 0,
  `soft_delete` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promocode`
--

INSERT INTO `promocode` (`p_id`, `p_title`, `p_percent`, `p_code`, `p_desc`, `p_validity`, `p_used_times`, `createdon`, `isactive`, `createdby`, `updatedon`, `updatedby`, `activatedon`, `activatedby`, `soft_delete`) VALUES
(1, '', 0, '', '&lt;p&gt;mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm&lt;/p&gt;\n', '0000-00-00', 0, '2020-11-06 15:09:18', 0, 1, '2021-03-15 16:22:23', 1, NULL, 0, 0),
(2, '', 0, '', '', '0000-00-00', 0, '2020-11-06 15:09:48', 0, 1, NULL, NULL, NULL, 0, 1),
(3, '', 0, '', '', '0000-00-00', 0, '2020-11-06 16:01:54', 0, 1, NULL, NULL, NULL, 0, 1),
(4, 'Winter Promo Code', 1, '1', '&lt;p&gt;1&lt;/p&gt;\n', '2021-06-16', 123, '2021-06-19 09:52:58', 1, 1, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_template`
--

CREATE TABLE `site_template` (
  `st_id` int(11) NOT NULL,
  `st_name` varchar(255) NOT NULL,
  `st_header` text NOT NULL,
  `st_menue` text NOT NULL,
  `st_footer` text NOT NULL,
  `st_script` text NOT NULL,
  `isactive` tinyint(4) NOT NULL DEFAULT 1,
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_template`
--

INSERT INTO `site_template` (`st_id`, `st_name`, `st_header`, `st_menue`, `st_footer`, `st_script`, `isactive`, `soft_delete`) VALUES
(1, 'Basic', '<meta charset=\"utf-8\" />\n <meta name=\"viewport\" content=\"width=device-width\">\n<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\">\n<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css\">\n<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css\">\n<!-- <link rel=\"stylesheet\" href=\"css/bootstrap.min.css\"> -->\n<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js\"></script>\n<script src=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js\"></script>\n<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js\"></script>\n<!-- <script src=\"js/bootstrap.min.js\"></script> -->\n<link href=\"css/main.css\" rel=\"stylesheet\">\n<!-- send data -->\n <script src=\"js/API/senddata.js\"></script>\n<!-- general function --> \n<script src=\"js/API/general_function.js\"></script> \n<link href=\"css/modals/loading.css\" rel=\"stylesheet\">        ', '<header>\n  <div class=\"menuArea\">\n    <div class=\"container-fluid\">\n      <div class=\"row\">\n        <div class=\"col-sm-3 col-xs-12\">\n          <div class=\"logoArea\"><a href=\"index.html\"><img class=\"img-responsive\" src=\"images/logo.png\" /></a>\n          </div>\n        </div>\n        <div class=\"col-sm-9 col-xs-12\">\n          <div class=\"row mobileNav\">\n            <div class=\"col-xs-4 visible-xs xs-marker\"><a href=\"https://goo.gl/maps/iE4esX3uT4hkjbuE9\" target=\"_blank\" title=\"Google Map\">Find</a>\n            </div>\n            <div class=\"col-xs-4 visible-xs xs-phone\">\n              <a href=\"tel:+92-21-38897770\" target=\"_blank\" title=\"Contact Number\">Call</a>\n            </div>\n            <div class=\"col-xs-4 visible-xs\">\n              <button class=\"navbar-toggle fa fa-bars fa-2x collapsed\" data-target=\".navbar-collapse\" data-toggle=\"collapse\" id=\"mnav-button\" type=\"button\"><span>Menu</span>\n              </button>\n            </div>\n          </div>\n          <nav>\n            <div class=\"jump\">{MENUE}\n            </div>\n            <!-- .container --></nav>\n        </div>\n      </div>\n    </div>\n  </div>\n</header>\n', '<footer>\n  <div class=\"footerArea\">\n    <div class=\"container-fluid\">\n      <div class=\"row\">\n        <div class=\"col-sm-4\">\n          <div class=\"block1\">\n            <h3>{SITE_TITLE}</h3>\n            <p> With more than 11 years in the business and 100,063 satisfied customers who placed 156,505 orders, {SITE_BASE_URL} became one of the most reliable and trusted source for different Services.</p>\n          </div>\n          <div class=\"block1\">\n            <h3>CONTACT US</h3>\n            <p>Call: +44 2476 98 1088</p>\n            <p>Email: {SITE_EMAIL}</p>\n          </div>\n        </div>\n        <div class=\"col-sm-4\">\n          <div class=\"block2\">\n            <h3>MENU</h3>\n            {MENUE}\n          </div>\n          <div class=\"block2\">\n            <h3>LEGAL</h3>\n            <a href=\"\">Terms of Use & Privacy</a>\n          </div>\n          <div class=\"block2\">\n            <h3>SOCIAL MEDIA</h3>\n            <div class=\"ftrSocialIcons\">\n              <a href=\"#\"><i class=\"fa fa-twitter\" aria-hidden=\"true\"></i></a>\n              <a href=\"#\"><i class=\"fa fa-instagram\" aria-hidden=\"true\"></i></a>\n              <a href=\"#\"><i class=\"fa fa-facebook-square\" aria-hidden=\"true\"></i></a>\n              <a href=\"#\"><i class=\"fa fa-youtube\" aria-hidden=\"true\"></i></a>\n            </div>\n          </div>\n        </div>\n        <div class=\"col-sm-4\">\n          <div class=\"block3\">\n            <h3>NEWSLETTER</h3>\n            <p>Keep yourself updated about the Changing Property Trends. Get Subscribed!</p>\n          </div>\n          <div class=\"supportArea\">\n            <div class=\"form-group\">\n              <input type=\"text\" class=\"form-control inputsupport\" placeholder=\"{SITE_EMAIL}\" name=\"support\">\n            </div>\n            <div class=\"btnSupportArea\">\n              <button type=\"submit\" class=\"btn btn-primary orderNowBtn\">Submit</button>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n  <div class=\"copyRightArea\">\n    <div class=\"container-fluid\">\n      <div class=\"row\">\n        <div class=\"col-sm-8\">\n          <div class=\"copyRightText\">\n            Copyright © 2020 {SITE_TITLE} | All Rights Reserved | Designed by Hatinco.com\n          </div>  \n        </div>\n        <div class=\"col-sm-4\">\n          <img src=\"images/ftrLogo.png\" class=\"img-responsive\">\n        </div>\n      </div>\n    </div>  \n  </div>\n</footer>\n\n<link href=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/4.10.1/bootstrap-social.min.css\" rel=\"stylesheet\">\n\n<script src=\"js/index.js\" type=\"text/javascript\"></script>\n\n\n<!-- Google Analytics -->\n\n\n<!-- Google Analytics END -->\n\n<!--Start of Tawk.to Script-->\n<script type=\"text/javascript\">\n// var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\n// (function(){\n// var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\n// s1.async=true;\n// s1.src=\'https://embed.tawk.to/5e4a43f1a89cda5a18865423/default\';\n// s1.charset=\'UTF-8\';\n// s1.setAttribute(\'crossorigin\',\'*\');\n// s0.parentNode.insertBefore(s1,s0);\n// })();\n</script>\n<!--End of Tawk.to Script-->\n\n\n\n<!-- \n<script async id=\"slcLiveChat\" src=\"https://widget.sonetel.com/SonetelWidget.min.js\" data-account-id=\"207143381\"></script>\n -->\n</body>\n</html>\n', '<script>\n\n\n\nfunction toggleIcon(e) {\n    $(e.target)\n        .prev(\'.panel-heading\')\n        .find(\".more-less\")\n        .toggleClass(\'glyphicon-plus glyphicon-minus\');\n}\n$(\'.panel-group\').on(\'hidden.bs.collapse\', toggleIcon);\n$(\'.panel-group\').on(\'shown.bs.collapse\', toggleIcon);          \n</script>    ', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertype_dashboard`
--

CREATE TABLE `usertype_dashboard` (
  `id` int(11) NOT NULL,
  `og_usertype_id` int(11) NOT NULL,
  `og_dashboard_id` int(11) NOT NULL,
  `isactive` tinyint(4) NOT NULL DEFAULT 1,
  `createdon` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedby` int(11) DEFAULT NULL,
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype_dashboard`
--

INSERT INTO `usertype_dashboard` (`id`, `og_usertype_id`, `og_dashboard_id`, `isactive`, `createdon`, `createdby`, `updatedon`, `updatedby`, `soft_delete`) VALUES
(1, 1, 1, 1, '2019-07-20 07:00:15', NULL, NULL, NULL, 0),
(2, 2, 2, 1, '2019-07-30 15:00:39', NULL, '2020-07-07 16:06:58', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_module`
--

CREATE TABLE `user_module` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `og_module_id` int(11) NOT NULL,
  `isactive` tinyint(4) NOT NULL DEFAULT 1,
  `createdon` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedby` int(11) DEFAULT NULL,
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_module`
--

INSERT INTO `user_module` (`id`, `uid`, `og_module_id`, `isactive`, `createdon`, `createdby`, `updatedon`, `updatedby`, `soft_delete`) VALUES
(21, 1, 1, 1, '2021-03-02 16:52:37', NULL, NULL, NULL, 0),
(22, 1, 9, 1, '2021-03-02 16:52:37', NULL, NULL, NULL, 0),
(23, 1, 11, 1, '2021-03-02 16:52:37', NULL, NULL, NULL, 0),
(24, 1, 10, 1, '2021-03-02 16:52:37', NULL, NULL, NULL, 0),
(25, 1, 4, 1, '2021-03-02 16:52:37', NULL, NULL, NULL, 0),
(26, 1, 3, 1, '2021-03-02 16:52:37', NULL, NULL, NULL, 0),
(27, 1, 2, 1, '2021-03-02 16:52:37', NULL, NULL, NULL, 0),
(28, 1, 5, 1, '2021-03-02 16:52:37', NULL, NULL, NULL, 0),
(29, 1, 6, 1, '2021-03-02 16:52:37', NULL, NULL, NULL, 0),
(30, 1, 7, 1, '2021-03-02 16:52:37', NULL, NULL, NULL, 0),
(31, 1, 8, 1, '2021-03-02 16:52:37', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE `user_rights` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `og_moduleactions_id` int(11) NOT NULL,
  `isactive` tinyint(4) NOT NULL DEFAULT 1,
  `createdon` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updatedby` int(11) DEFAULT NULL,
  `soft_delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(26, 9, 5, 1, '2021-03-02 16:28:50', NULL, NULL, NULL, 0);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`);

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
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loginuser`
--
ALTER TABLE `loginuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `og_dashboard`
--
ALTER TABLE `og_dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `og_module`
--
ALTER TABLE `og_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `og_moduleactions`
--
ALTER TABLE `og_moduleactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `og_packages_category`
--
ALTER TABLE `og_packages_category`
  MODIFY `og_all_packages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `og_settings`
--
ALTER TABLE `og_settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `og_template`
--
ALTER TABLE `og_template`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `og_usertype`
--
ALTER TABLE `og_usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_dh`
--
ALTER TABLE `order_dh`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `promocode`
--
ALTER TABLE `promocode`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `site_template`
--
ALTER TABLE `site_template`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usertype_dashboard`
--
ALTER TABLE `usertype_dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_module`
--
ALTER TABLE `user_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_rights`
--
ALTER TABLE `user_rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
