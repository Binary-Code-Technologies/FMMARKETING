-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2022 at 08:55 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fm_marketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitylogreport`
--

CREATE TABLE `activitylogreport` (
  `actid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `usertype` varchar(50) DEFAULT NULL,
  `module` varchar(100) DEFAULT NULL,
  `submodule` varchar(50) NOT NULL,
  `pagename` varchar(200) DEFAULT NULL,
  `primarykeyid` varchar(50) DEFAULT NULL,
  `tablename` varchar(50) DEFAULT NULL,
  `activitydatetime` datetime DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `sessionid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activitylogreport`
--

INSERT INTO `activitylogreport` (`actid`, `userid`, `usertype`, `module`, `submodule`, `pagename`, `primarykeyid`, `tablename`, `activitydatetime`, `action`, `sessionid`) VALUES
(1, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1085', 'saleentry', '2021-12-17 10:12:00', 'insert', 0),
(2, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1086', 'saleentry', '2021-12-17 10:12:48', 'insert', 0),
(3, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1087', 'saleentry', '2021-12-17 10:12:54', 'insert', 0),
(4, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1088', 'saleentry', '2021-12-17 10:12:43', 'insert', 0),
(5, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '0', 'saleentry', '2021-12-17 10:12:24', 'updated', 0),
(6, 1, 'admin', 'Add Purchase Entry', 'Purchase Entry', 'purchaseentry.php', '7', 'purchaseentry', '2021-12-17 11:12:46', 'insert', 0),
(7, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1089', 'saleentry', '2021-12-17 07:12:34', 'insert', 0),
(8, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1090', 'saleentry', '2021-12-17 07:12:48', 'insert', 0),
(9, 1, 'admin', 'Add Product', 'Product Master', 'master_product.php', '90', 'm_product', '2021-12-19 03:12:12', 'deleted', 0),
(10, 1, 'admin', 'Add Purchase Entry', 'Purchase Entry', 'purchaseentry.php', '8', 'purchaseentry', '2021-12-20 04:12:41', 'insert', 0),
(11, 1, 'admin', 'Add Purchase Entry', 'Purchase Entry', 'purchaseentry.php', '9', 'purchaseentry', '2021-12-20 05:12:30', 'insert', 0),
(12, 1, 'admin', 'Add Purchase Entry', 'Purchase Entry', 'purchaseentry.php', '10', 'purchaseentry', '2021-12-20 05:12:50', 'insert', 0),
(13, 1, 'admin', 'Add Purchase Entry', 'Purchase Entry', 'purchaseentry.php', '11', 'purchaseentry', '2021-12-20 05:12:11', 'insert', 0),
(14, 1, 'admin', 'Add Purchase Entry', 'Purchase Entry', 'purchaseentry.php', '12', 'purchaseentry', '2021-12-20 05:12:31', 'insert', 0),
(15, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1091', 'saleentry', '2021-12-20 07:12:09', 'insert', 0),
(16, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1092', 'saleentry', '2021-12-20 07:12:38', 'insert', 0),
(17, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1093', 'saleentry', '2021-12-20 07:12:46', 'insert', 0),
(18, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1094', 'saleentry', '2021-12-20 07:12:57', 'insert', 0),
(19, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1095', 'saleentry', '2021-12-20 07:12:50', 'insert', 0),
(20, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1096', 'saleentry', '2021-12-20 07:12:33', 'insert', 0),
(21, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1097', 'saleentry', '2021-12-20 07:12:59', 'insert', 0),
(22, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1098', 'saleentry', '2021-12-20 07:12:05', 'insert', 0),
(23, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1099', 'saleentry', '2021-12-21 00:12:22', 'insert', 0),
(24, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1100', 'saleentry', '2021-12-21 00:12:29', 'insert', 0),
(25, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1101', 'saleentry', '2021-12-21 23:12:17', 'insert', 0),
(26, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1102', 'saleentry', '2021-12-22 00:12:29', 'insert', 0),
(27, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1103', 'saleentry', '2021-12-22 05:12:23', 'insert', 0),
(28, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1104', 'saleentry', '2021-12-22 05:12:29', 'insert', 0),
(29, 1, 'admin', 'Add Product', 'Product Master', 'master_product.php', '137', 'm_product', '2021-12-22 05:12:02', 'deleted', 0),
(30, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1105', 'saleentry', '2021-12-22 05:12:33', 'insert', 0),
(31, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1106', 'saleentry', '2021-12-22 05:12:11', 'insert', 0),
(32, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1107', 'saleentry', '2021-12-22 05:12:14', 'insert', 0),
(33, 1, 'admin', 'Add Purchase Entry', 'Purchase Entry', 'purchaseentry.php', '13', 'purchaseentry', '2021-12-22 06:12:25', 'insert', 0),
(34, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1108', 'saleentry', '2021-12-22 06:12:38', 'insert', 0),
(35, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1109', 'saleentry', '2021-12-23 01:12:23', 'insert', 0),
(36, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1110', 'saleentry', '2021-12-23 02:12:49', 'insert', 0),
(37, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1111', 'saleentry', '2021-12-23 04:12:28', 'insert', 0),
(38, 1, 'admin', 'Add Purchase Entry', 'Purchase Entry', 'purchaseentry.php', '14', 'purchaseentry', '2021-12-23 04:12:06', 'insert', 0),
(39, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1112', 'saleentry', '2021-12-24 02:12:47', 'insert', 0),
(40, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1113', 'saleentry', '2021-12-24 02:12:35', 'insert', 0),
(41, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '0', 'saleentry', '2021-12-25 03:12:33', 'updated', 0),
(42, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '0', 'saleentry', '2021-12-25 03:12:03', 'updated', 0),
(43, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '0', 'saleentry', '2021-12-25 03:12:53', 'updated', 0),
(44, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '0', 'saleentry', '2021-12-25 04:12:06', 'updated', 0),
(45, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1114', 'saleentry', '2021-12-25 05:12:15', 'insert', 0),
(46, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1115', 'saleentry', '2021-12-25 23:12:56', 'insert', 0),
(47, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1116', 'saleentry', '2021-12-28 03:12:33', 'insert', 0),
(48, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1117', 'saleentry', '2021-12-28 03:12:07', 'insert', 0),
(49, 1, 'admin', 'Add Purchase Entry', 'Purchase Entry', 'purchaseentry.php', '15', 'purchaseentry', '2021-12-28 04:12:57', 'insert', 0),
(50, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1118', 'saleentry', '2021-12-28 04:12:13', 'insert', 0),
(51, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1119', 'saleentry', '2021-12-28 04:12:25', 'insert', 0),
(52, 1, 'admin', 'Add Product', 'Product Master', 'master_product.php', '147', 'm_product', '2021-12-28 06:12:58', 'deleted', 0),
(53, 1, 'admin', 'Add Product', 'Product Master', 'master_product.php', '146', 'm_product', '2021-12-28 06:12:11', 'deleted', 0),
(54, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1120', 'saleentry', '2021-12-29 06:12:23', 'insert', 0),
(55, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1121', 'saleentry', '2021-12-30 03:12:25', 'insert', 0),
(56, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1122', 'saleentry', '2021-12-31 06:12:30', 'insert', 0),
(57, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '0', 'saleentry', '2021-12-31 06:12:14', 'updated', 0),
(58, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '0', 'saleentry', '2021-12-31 06:12:32', 'updated', 0),
(59, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1123', 'saleentry', '2021-12-31 07:12:56', 'insert', 0),
(60, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '0', 'saleentry', '2021-12-31 07:12:05', 'updated', 0),
(61, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1124', 'saleentry', '2021-12-31 07:12:08', 'insert', 0),
(62, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1125', 'saleentry', '2021-12-31 08:12:13', 'insert', 0),
(63, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1126', 'saleentry', '2021-12-31 08:12:04', 'insert', 0),
(64, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1127', 'saleentry', '2021-12-31 08:12:09', 'insert', 0),
(65, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1128', 'saleentry', '2021-12-31 08:12:20', 'insert', 0),
(66, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1129', 'saleentry', '2022-01-02 03:01:48', 'insert', 0),
(67, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1130', 'saleentry', '2022-01-02 03:01:46', 'insert', 0),
(68, 1, 'admin', 'Add Purchase Entry', 'Purchase Entry', 'purchaseentry.php', '16', 'purchaseentry', '2022-01-02 06:01:13', 'insert', 0),
(69, 1, 'admin', 'Add Purchase Entry', 'Purchase Entry', 'purchaseentry.php', '17', 'purchaseentry', '2022-01-02 06:01:31', 'insert', 0),
(70, 1, 'admin', 'Add Purchase Entry', 'Purchase Entry', 'purchaseentry.php', '18', 'purchaseentry', '2022-01-02 06:01:35', 'insert', 0),
(71, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '0', 'saleentry', '2022-01-02 07:01:31', 'updated', 0),
(72, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '0', 'saleentry', '2022-01-02 07:01:51', 'updated', 0),
(73, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1131', 'saleentry', '2022-01-03 08:01:08', 'insert', 0),
(74, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1132', 'saleentry', '2022-01-03 09:01:22', 'insert', 0),
(75, 1, 'admin', 'Add Sale Entry', 'Sale Entry', 'saleentry.php', '1133', 'saleentry', '2022-01-03 09:01:15', 'insert', 0),
(76, 1, 'admin', 'Master', 'Session Master', 'master_session.php', '0', 'm_session', '2022-03-02 06:03:12', 'insert', 0),
(77, 1, 'admin', 'Add Users', 'User Master', 'user_master.php', '0', 'user', '2022-03-14 06:03:04', 'insert', 0);

-- --------------------------------------------------------

--
-- Table structure for table `billuser`
--

CREATE TABLE `billuser` (
  `userid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(10) NOT NULL,
  `enable` varchar(20) NOT NULL,
  `createdby` int(11) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `ipaddress` varchar(30) NOT NULL,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billuser`
--

INSERT INTO `billuser` (`userid`, `username`, `password`, `usertype`, `enable`, `createdby`, `mobile`, `ipaddress`, `createdate`) VALUES
(1, 'admin', '123', 'admin', 'enable', 0, '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `checklogin`
--

CREATE TABLE `checklogin` (
  `loginid` int(11) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(25) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `createdate` datetime NOT NULL,
  `lastupdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklogin`
--

INSERT INTO `checklogin` (`loginid`, `userid`, `password`, `usertype`, `ipaddress`, `createdate`, `lastupdated`) VALUES
(1, 'admin', '123', 'admin', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `company_setting`
--

CREATE TABLE `company_setting` (
  `compid` int(11) NOT NULL,
  `prifix` varchar(500) NOT NULL,
  `comp_name` varchar(100) NOT NULL,
  `imgname` varchar(200) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `address2` text NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `term_cond` text NOT NULL,
  `comp_tinno` varchar(200) NOT NULL,
  `gsttinno` varchar(100) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `bank_ac` varchar(200) NOT NULL,
  `ifsc_code` varchar(200) NOT NULL,
  `stateid` int(11) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `createdate` datetime NOT NULL,
  `lastupdated` datetime NOT NULL,
  `openbal` double NOT NULL,
  `opendate` date NOT NULL,
  `crtopendate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_setting`
--

INSERT INTO `company_setting` (`compid`, `prifix`, `comp_name`, `imgname`, `mobile`, `address`, `address2`, `email_id`, `term_cond`, `comp_tinno`, `gsttinno`, `bank_name`, `branch_name`, `bank_ac`, `ifsc_code`, `stateid`, `ipaddress`, `createdate`, `lastupdated`, `openbal`, `opendate`, `crtopendate`) VALUES
(1, '', 'Fm Marketing', '', '8810203040', 'newfuygrfeg', 'knduhf', 'komal@gmail.com', 'A Terms and Conditions agreement (T&Cs) is the agreement that includes the terms, the rules and the guidelines of acceptable behavior and other useful sections to which users must agree in order to use or access your website and mobile app', '', 'ACM1020301020', '', '', '', '', 0, '::1', '0000-00-00 00:00:00', '2022-03-14 07:03:54', 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `loginlogoutreport`
--

CREATE TABLE `loginlogoutreport` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `usertype` varchar(20) DEFAULT NULL,
  `process` varchar(10) DEFAULT NULL,
  `sessionid` int(11) NOT NULL,
  `loginlogouttime` datetime DEFAULT NULL,
  `createdate` date DEFAULT NULL,
  `ipaddress` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginlogoutreport`
--

INSERT INTO `loginlogoutreport` (`id`, `userid`, `usertype`, `process`, `sessionid`, `loginlogouttime`, `createdate`, `ipaddress`) VALUES
(1, 1, 'admin', 'Login', 0, '2021-12-17 12:56:47', '2021-12-17', '::1'),
(2, 1, 'admin', 'Login', 0, '2021-12-17 10:58:34', '2021-12-17', '49.36.32.239'),
(3, 1, 'admin', 'Login', 0, '2021-12-17 11:42:01', '2021-12-17', '49.36.32.239'),
(4, 1, 'admin', 'Login', 0, '2021-12-17 13:09:51', '2021-12-17', '103.115.130.67'),
(5, 1, 'admin', 'Login', 0, '2021-12-19 09:08:33', '2021-12-19', '103.115.128.58'),
(6, 1, 'admin', 'Logout', 0, '2021-12-19 09:40:58', '2021-12-19', '103.115.128.58'),
(7, 1, 'admin', 'Login', 0, '2021-12-19 09:41:02', '2021-12-19', '103.115.128.58'),
(8, 1, 'admin', 'Login', 0, '2021-12-19 09:46:47', '2021-12-19', '157.34.112.40'),
(9, 1, 'admin', 'Login', 0, '2021-12-20 08:24:37', '2021-12-20', '103.115.128.58'),
(10, 1, 'admin', 'Login', 0, '2021-12-20 10:36:27', '2021-12-20', '103.115.128.58'),
(11, 1, 'admin', 'Login', 0, '2021-12-20 11:52:13', '2021-12-20', '49.36.36.3'),
(12, 1, 'admin', 'Login', 0, '2021-12-20 12:09:08', '2021-12-20', '103.115.128.58'),
(13, 1, 'admin', 'Login', 0, '2021-12-20 13:42:05', '2021-12-20', '49.35.245.62'),
(14, 1, 'admin', 'Logout', 0, '2021-12-20 14:30:24', '2021-12-20', '49.35.245.62'),
(15, 1, 'admin', 'Login', 0, '2021-12-21 05:35:36', '2021-12-20', '103.115.128.58'),
(16, 1, 'admin', 'Login', 0, '2021-12-21 06:33:39', '2021-12-21', '49.36.36.3'),
(17, 1, 'admin', 'Login', 0, '2021-12-22 05:07:06', '2021-12-21', '106.76.242.148'),
(18, 1, 'admin', 'Login', 0, '2021-12-22 06:42:39', '2021-12-22', '106.76.242.230'),
(19, 1, 'admin', 'Login', 0, '2021-12-22 11:06:24', '2021-12-22', '49.35.181.201'),
(20, 1, 'admin', 'Login', 0, '2021-12-22 11:20:08', '2021-12-22', '49.35.181.201'),
(21, 1, 'admin', 'Login', 0, '2021-12-22 11:40:26', '2021-12-22', '157.34.251.147'),
(22, 1, 'admin', 'Login', 0, '2021-12-22 11:44:04', '2021-12-22', '49.36.43.214'),
(23, 1, 'admin', 'Logout', 0, '2021-12-22 13:15:34', '2021-12-22', '49.35.181.201'),
(24, 1, 'admin', 'Login', 0, '2021-12-23 06:22:56', '2021-12-23', '103.115.128.58'),
(25, 1, 'admin', 'Login', 0, '2021-12-23 07:35:09', '2021-12-23', '106.76.242.46'),
(26, 1, 'admin', 'Login', 0, '2021-12-23 08:13:54', '2021-12-23', '106.76.242.46'),
(27, 1, 'admin', 'Login', 0, '2021-12-23 10:02:08', '2021-12-23', '103.115.128.58'),
(28, 1, 'admin', 'Login', 0, '2021-12-23 11:15:26', '2021-12-23', '110.224.166.229'),
(29, 1, 'admin', 'Login', 0, '2021-12-23 12:19:26', '2021-12-23', '110.224.166.229'),
(30, 1, 'admin', 'Login', 0, '2021-12-23 12:47:20', '2021-12-23', '49.35.176.98'),
(31, 1, 'admin', 'Login', 0, '2021-12-24 07:53:37', '2021-12-24', '49.35.175.135'),
(32, 1, 'admin', 'Login', 0, '2021-12-24 11:54:48', '2021-12-24', '49.36.43.214'),
(33, 1, 'admin', 'Login', 0, '2021-12-25 09:13:08', '2021-12-25', '106.76.243.45'),
(34, 1, 'admin', 'Login', 0, '2021-12-25 10:34:13', '2021-12-25', '27.62.206.171'),
(35, 1, 'admin', 'Login', 0, '2021-12-25 10:57:16', '2021-12-25', '103.115.128.58'),
(36, 1, 'admin', 'Login', 0, '2021-12-25 11:08:43', '2021-12-25', '103.115.128.58'),
(37, 1, 'admin', 'Login', 0, '2021-12-25 17:35:26', '2021-12-25', '27.62.206.171'),
(38, 1, 'admin', 'Login', 0, '2021-12-26 05:36:03', '2021-12-25', '103.115.128.58'),
(39, 1, 'admin', 'Logout', 0, '2021-12-26 05:47:45', '2021-12-26', '103.115.128.58'),
(40, 1, 'admin', 'Login', 0, '2021-12-26 05:48:07', '2021-12-25', '103.115.128.58'),
(41, 1, 'admin', 'Login', 0, '2021-12-26 10:17:53', '2021-12-26', '27.62.206.171'),
(42, 1, 'admin', 'Login', 0, '2021-12-26 12:08:19', '2021-12-26', '27.62.206.171'),
(43, 1, 'admin', 'Login', 0, '2021-12-26 12:45:10', '2021-12-26', '47.247.221.199'),
(44, 1, 'admin', 'Login', 0, '2021-12-27 05:49:46', '2021-12-26', '103.115.128.58'),
(45, 1, 'admin', 'Login', 0, '2021-12-27 06:42:40', '2021-12-27', '103.115.128.58'),
(46, 1, 'admin', 'Login', 0, '2021-12-27 11:05:10', '2021-12-27', '110.224.187.11'),
(47, 1, 'admin', 'Login', 0, '2021-12-28 08:57:18', '2021-12-28', '27.62.213.247'),
(48, 1, 'admin', 'Login', 0, '2021-12-28 09:40:23', '2021-12-28', '27.62.213.247'),
(49, 1, 'admin', 'Login', 0, '2021-12-28 10:05:47', '2021-12-28', '103.115.128.58'),
(50, 1, 'admin', 'Login', 0, '2021-12-28 12:52:43', '2021-12-28', '103.115.128.58'),
(51, 1, 'admin', 'Login', 0, '2021-12-29 12:06:00', '2021-12-29', '157.34.21.165'),
(52, 1, 'admin', 'Login', 0, '2021-12-29 12:10:32', '2021-12-29', '47.247.204.204'),
(53, 1, 'admin', 'Login', 0, '2021-12-30 08:15:08', '2021-12-30', '103.115.128.58'),
(54, 1, 'admin', 'Login', 0, '2021-12-30 11:49:22', '2021-12-30', '103.115.128.58'),
(55, 1, 'admin', 'Login', 0, '2021-12-30 12:46:00', '2021-12-30', '103.115.128.58'),
(56, 1, 'admin', 'Login', 0, '2021-12-31 04:39:02', '2021-12-30', '47.247.213.20'),
(57, 1, 'admin', 'Login', 0, '2021-12-31 12:03:23', '2021-12-31', '47.247.213.20'),
(58, 1, 'admin', 'Login', 0, '2021-12-31 12:17:44', '2021-12-31', '49.36.46.177'),
(59, 1, 'admin', 'Logout', 0, '2021-12-31 14:07:47', '2021-12-31', '47.247.213.20'),
(60, 1, 'admin', 'Login', 0, '2022-01-01 11:24:36', '2022-01-01', '49.36.46.177'),
(61, 1, 'admin', 'Login', 0, '2022-01-02 07:27:16', '2022-01-02', '47.247.200.115'),
(62, 1, 'admin', 'Login', 0, '2022-01-02 09:09:08', '2022-01-02', '47.247.200.115'),
(63, 1, 'admin', 'Login', 0, '2022-01-02 12:00:45', '2022-01-02', '103.115.128.58'),
(64, 1, 'admin', 'Login', 0, '2022-01-02 12:02:00', '2022-01-02', '103.115.128.58'),
(65, 1, 'admin', 'Logout', 0, '2022-01-02 13:55:27', '2022-01-02', '47.247.200.115'),
(66, 1, 'admin', 'Login', 0, '2022-03-02 10:53:08', '2022-03-02', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `master_expence`
--

CREATE TABLE `master_expence` (
  `expencetypeid` int(11) NOT NULL,
  `expense_name` varchar(200) NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `createdate` date NOT NULL,
  `lastupdated` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_bank`
--

CREATE TABLE `m_bank` (
  `bankid` int(11) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_address` text NOT NULL,
  `ac_number` varchar(100) NOT NULL,
  `ifsc_code` varchar(100) NOT NULL,
  `open_bal` float NOT NULL,
  `bal_date` date NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_branch`
--

CREATE TABLE `m_branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `enable` varchar(100) NOT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_product`
--

CREATE TABLE `m_product` (
  `productid` int(11) NOT NULL,
  `prodname` varchar(200) NOT NULL,
  `hsn_no` varchar(200) NOT NULL,
  `unitid` int(11) NOT NULL,
  `rate` float NOT NULL,
  `pur_rate` float NOT NULL,
  `enable` varchar(20) NOT NULL,
  `prod_code` varchar(100) NOT NULL,
  `barcode` longtext NOT NULL,
  `opening_stock` float NOT NULL,
  `stockdate` date NOT NULL,
  `tax_id` int(11) NOT NULL,
  `mrp` float NOT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL,
  `manu_date` varchar(100) NOT NULL,
  `exp_date` varchar(100) NOT NULL,
  `batch_no` varchar(100) NOT NULL,
  `pcatid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_product`
--

INSERT INTO `m_product` (`productid`, `prodname`, `hsn_no`, `unitid`, `rate`, `pur_rate`, `enable`, `prod_code`, `barcode`, `opening_stock`, `stockdate`, `tax_id`, `mrp`, `createdby`, `ipaddress`, `lastupdated`, `createdate`, `manu_date`, `exp_date`, `batch_no`, `pcatid`) VALUES
(5, 'armani grey 2/4', '', 13, 0, 580, 'enable', '00001', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(6, 'cicilia 2/4', '', 13, 0, 680, 'enable', '00006', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(7, 'CLOUDY BLUE HIGH GLOSS STD', '', 13, 0, 680, 'enable', '00007', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(8, 'CREMA MARFIL 2/4', '', 13, 0, 0, 'enable', '00008', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '2021-12-10', '2021-12-10', '', '', '', 10),
(9, 'ANTRIX CHOCO 2/4', '', 13, 0, 0, 'enable', '00009', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(10, 'HOLLIS PARDA WHITE 2/2', '', 13, 0, 0, 'enable', '00010', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(11, 'KAJARIA KERRO C6032', '', 13, 0, 0, 'enable', '00011', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(12, 'KAJARIA K 6401', '', 13, 0, 0, 'enable', '00012', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(13, 'NOTTO 1157', '', 13, 0, 0, 'enable', '00013', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(14, 'AXISON 7002', '', 13, 0, 0, 'enable', '00014', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '2021-12-10', '2021-12-10', '', '', '', 10),
(15, 'FREEDOM 6114', '', 13, 0, 0, 'enable', '00015', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(16, 'FREEDOM 6096', '', 13, 0, 0, 'enable', '00016', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(17, 'FREEDOM 6175', '', 13, 0, 0, 'enable', '00017', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(18, 'FREEDOM 6233', '', 13, 0, 0, 'enable', '00018', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(19, 'LEXUS CELEENA BRON 2/4', '', 13, 0, 0, 'enable', '00019', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(20, 'JEETA NATURAL 2/4', '', 13, 0, 0, 'enable', '00020', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(21, 'LINEX PAR.DOTS TC', '', 13, 0, 0, 'enable', '00021', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(22, 'LINEX PAR. DOTS IV', '', 13, 0, 0, 'enable', '00022', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(23, 'WAVES PAR.TC', '', 13, 0, 0, 'enable', '00023', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(24, 'WAVES PAR. IV', '', 13, 0, 0, 'enable', '00024', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(25, 'SWEELCO 1502', '', 13, 0, 0, 'enable', '00025', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(26, 'OPTEL 1103', '', 13, 0, 0, 'enable', '00026', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(27, 'OPTEL 1010', '', 13, 0, 0, 'enable', '00027', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(28, 'SCETING 8063', '', 11, 0, 0, 'enable', '00028', '', 0, '2021-12-10', 0, 0, 1, '103.115.128.58', '2021-12-28', '2021-12-10', '', '', '', 10),
(29, 'SCETING BLACK', '', 11, 0, 0, 'enable', '00029', '', 0, '2021-12-10', 0, 0, 1, '103.115.128.58', '2021-12-28', '2021-12-10', '', '', '', 10),
(30, 'SCETING 8010', '', 11, 0, 0, 'enable', '00030', '', 0, '2021-12-10', 0, 0, 1, '103.115.128.58', '2021-12-28', '2021-12-10', '', '', '', 10),
(31, 'SCETING 8011', '', 11, 0, 0, 'enable', '00031', '', 0, '2021-12-10', 0, 0, 1, '103.115.128.58', '2021-12-28', '2021-12-10', '', '', '', 10),
(32, 'SCETING 8059', '', 11, 0, 0, 'enable', '00032', '', 0, '2021-12-10', 0, 0, 1, '103.115.128.58', '2021-12-28', '2021-12-10', '', '', '', 10),
(33, 'ELE...XENDER BEDGE', '', 13, 0, 0, 'enable', '00033', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '2021-12-10', '2021-12-10', '', '', '', 10),
(34, 'ELE...XENDER BEDGE HL', '', 13, 0, 0, 'enable', '00034', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '2021-12-10', '2021-12-10', '', '', '', 10),
(35, 'ELE...EVA SLATE', '', 13, 0, 0, 'enable', '00035', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '2021-12-10', '2021-12-10', '', '', '', 10),
(36, 'ELE...IGNIS BROWN', '', 13, 0, 0, 'enable', '00036', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '2021-12-10', '2021-12-10', '', '', '', 10),
(37, 'ELE...BORIS BROWN', '', 13, 0, 0, 'enable', '00037', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(38, 'ELE...LERRY BROWN 2', '', 13, 0, 0, 'enable', '00038', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(39, 'ELE... DENIS AZUL', '', 13, 0, 0, 'enable', '00039', '', 0, '2021-12-10', 0, 0, 1, '49.35.236.203', '0000-00-00', '2021-12-10', '', '', '', 10),
(40, 'capstone 2317 D', '', 13, 0, 0, 'enable', '00040', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(41, 'CAPSTONE 2317 LT', '', 13, 0, 0, 'enable', '00041', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(42, 'CAPSTONE 2317 HL', '', 13, 0, 0, 'enable', '00042', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(43, 'CAPSTONE 2317 FL', '', 13, 0, 0, 'enable', '00043', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(44, 'CAPSTONE 5043 D', '', 13, 0, 0, 'enable', '00044', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(45, 'CAPSTONE 5043 HL 1', '', 13, 0, 0, 'enable', '00045', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '2021-12-11', '2021-12-11', '', '', '', 10),
(46, 'CAPSTONE 5043 HL 2', '', 13, 0, 0, 'enable', '00046', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(47, 'CAPSTONE 2099 D', '', 13, 0, 0, 'enable', '00047', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(48, 'CAPSTONE 2099 L', '', 13, 0, 0, 'enable', '00048', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(49, 'CAPSTONE 2099 HL1', '', 13, 0, 0, 'enable', '00049', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(50, 'CAPSTONE 2099 HL2', '', 13, 0, 0, 'enable', '00050', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(51, 'CAPSTONE 2176 D', '', 13, 0, 0, 'enable', '00051', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(52, 'CAPSTONE 2176 LT', '', 13, 0, 0, 'enable', '00052', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(53, 'CAPSTONE 2176 K1', '', 13, 0, 0, 'enable', '00053', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(54, 'CAPSTONE 2176 K2', '', 13, 0, 0, 'enable', '00054', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(55, 'CAPSTONE 2145 D', '', 13, 0, 0, 'enable', '00055', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(56, 'CAPSTONE 2145 L', '', 13, 0, 0, 'enable', '00056', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(57, 'CAPSTONE 2145 HL', '', 13, 0, 0, 'enable', '00057', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(58, 'CAPSTONE 2145 F', '', 13, 0, 0, 'enable', '00058', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(59, 'CAPSTONE 2251 HL3', '', 13, 0, 0, 'enable', '00059', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(60, 'CAPSTONE 2251 HL1', '', 13, 0, 0, 'enable', '00060', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(61, 'CAPSTONE 2251 HL2', '', 13, 0, 0, 'enable', '00061', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(62, 'CAPSTONE 2251 HL4', '', 13, 0, 0, 'enable', '00062', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(63, 'CAPSTONE 2251D', '', 13, 0, 0, 'enable', '00063', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(64, 'CAPSTONE 2099 FL', '', 13, 0, 0, 'enable', '00064', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(65, 'CAPSTONE 2286 D', '', 13, 0, 0, 'enable', '00065', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(66, 'CAPSTONE 2286 L', '', 13, 0, 0, 'enable', '00066', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(67, 'CAPSTONE 2286 HL1', '', 13, 0, 0, 'enable', '00067', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(68, 'CAPSTONE 2286 FL', '', 13, 0, 0, 'enable', '00068', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 10),
(69, 'ADD SIVE 390', '', 8, 0, 0, 'enable', '00069', '', 0, '2021-12-11', 0, 0, 1, '49.35.236.194', '0000-00-00', '2021-12-11', '', '', '', 7),
(70, 'royal grey', '', 13, 0, 0, '', '00070', '', 0, '0000-00-00', 0, 0, 0, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(71, 'ultra gold', '', 13, 0, 0, 'enable', '00071', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(72, 'ultra cudbary', '', 13, 0, 0, 'enable', '00072', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(73, 'ultra pink', '', 13, 0, 0, 'enable', '00073', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(74, 'ultra pista', '', 13, 0, 0, 'enable', '00074', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(75, '5071 mat', '', 13, 0, 0, 'enable', '00075', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(76, 'goldn flower 3d', '', 13, 0, 0, 'enable', '00076', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(77, 'crystone stone', '', 13, 0, 0, 'enable', '00077', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(78, '3d 42', '', 13, 0, 0, 'enable', '00078', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(79, 'orbit wood', '', 13, 0, 0, 'enable', '00079', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(80, 'HEMALI', '', 15, 0, 0, 'enable', '00080', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 11),
(81, 'BHADA', '', 14, 0, 0, 'enable', '00081', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 11),
(82, 'ELE...LOUTRA NATURAL', '', 13, 0, 0, 'enable', '00082', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(83, 'ELE...EVA BONZA', '', 13, 0, 0, 'enable', '00083', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(84, 'ELE...EV GREEN', '', 13, 0, 0, 'enable', '00084', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(85, 'ELE...IRANA FERRY', '', 13, 0, 0, 'enable', '00085', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(86, 'DOMIMIKA RED', '', 13, 0, 0, 'enable', '00086', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(87, 'DOMIMIKA SLETE', '', 13, 0, 0, 'enable', '00087', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 10),
(88, 'jomt pollar', '', 8, 0, 0, 'enable', '00088', '', 0, '2021-12-14', 0, 0, 1, '49.35.247.219', '0000-00-00', '2021-12-14', '', '', '', 7),
(91, 'tronco white', '', 13, 0, 0, 'enable', '00089', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(92, 'pink fuery', '', 13, 0, 0, 'enable', '00092', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(93, 'marron emperador', '', 13, 0, 0, 'enable', '00093', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(94, 'breccia cambria', '', 13, 0, 0, 'enable', '00094', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(95, 'ocenic grey', '', 13, 0, 0, 'enable', '00095', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(96, 'armani grey grey', '', 13, 0, 0, 'enable', '00096', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(97, 'turkish brown', '', 13, 0, 0, 'enable', '00097', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(98, 'varsaco gold', '', 13, 0, 0, 'enable', '00098', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(99, 'espreda brown', '', 13, 0, 0, 'enable', '00099', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(100, 'freedom 6071', '', 13, 0, 0, 'enable', '00100', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(101, 'FREEDOM 6150', '', 13, 0, 0, 'enable', '00101', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(102, 'FREEDOM 6244', '', 13, 0, 0, 'enable', '00102', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(103, 'FREEDOM 6174', '', 8, 0, 0, 'enable', '00103', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(104, 'FREEDOM 6227', '', 13, 0, 0, 'enable', '00104', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(105, 'FREEDOM 6240', '', 13, 0, 0, 'enable', '00105', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(106, 'FREEDOM 6195', '', 13, 0, 0, 'enable', '00106', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(107, 'FREEDOM 6243', '', 13, 0, 0, 'enable', '00107', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(108, 'FREEDOM 6238', '', 13, 0, 0, 'enable', '00108', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(109, 'FREEDOM 6251', '', 13, 0, 0, 'enable', '00109', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(110, 'TRAVENTINO LIGHT GREY', '', 13, 0, 0, 'enable', '00110', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(111, 'ONYX GREY', '', 13, 0, 0, 'enable', '00111', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(112, 'TRAVENTINO DARK GREY', '', 13, 0, 0, 'enable', '00112', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(113, 'MISTA NATURAL', '', 13, 0, 0, 'enable', '00113', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(114, 'MILANO BEIGE', '', 13, 0, 0, 'enable', '00114', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(115, 'LINO BEIGE', '', 13, 0, 0, 'enable', '00115', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(116, 'ITALIAN BOTTICHINO', '', 13, 0, 0, 'enable', '00116', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(117, 'JEETA NATURAL', '', 13, 0, 0, 'enable', '00117', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(118, '3D/ 101', '', 13, 0, 0, 'enable', '00118', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(119, '3D/ 134', '', 13, 0, 0, 'enable', '00119', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(120, '3D/ 105', '', 13, 0, 0, 'enable', '00120', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(121, '3D/ 011', '', 13, 0, 0, 'enable', '00121', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(122, 'AMAZONE BLUE', '', 13, 0, 0, 'enable', '00122', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(123, 'MARBITO SPYKAR PEARL', '', 13, 0, 0, 'enable', '00123', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(124, 'MARBITO LATINA MUSK', '', 13, 0, 0, 'enable', '00124', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(125, 'MARBITO LATINA COFEE', '', 13, 0, 0, 'enable', '00125', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(126, 'MARBITO TROPIC GOLD', '', 13, 0, 0, 'enable', '00126', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(127, 'MARBITO HALLOK BROWN', '', 13, 0, 0, 'enable', '00127', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(128, 'MARBITO LATINA ASH', '', 13, 0, 0, 'enable', '00128', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(129, 'MARBITO GALAXY BLACK', '', 13, 0, 0, 'enable', '00129', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(130, 'MARBITO CORONA LENOVO', '', 13, 0, 0, 'enable', '00130', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(131, '3D/ 01', '', 13, 0, 0, 'enable', '00131', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(132, '3D/ 022', '', 13, 0, 0, 'enable', '00132', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(133, 'MARBITO GALAXY BROWN DC', '', 13, 0, 0, 'enable', '00133', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(134, 'STEP RISER 4FEET', '', 11, 0, 0, 'enable', '00134', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(135, 'STEP RISER 3FEET', '', 11, 0, 0, 'enable', '00135', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(136, 'ELE...LVAN BEISH', '', 13, 0, 0, 'enable', '00136', '', 0, '2021-12-20', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20', '', '', '', 10),
(138, '1202', '', 13, 0, 0, '', '00139', '', 0, '0000-00-00', 0, 0, 0, '49.35.181.201', '0000-00-00', '2021-12-22', '', '', '', 10),
(139, '10 brown', '', 12, 0, 0, '', '00140', '', 0, '0000-00-00', 0, 0, 0, '49.35.181.201', '0000-00-00', '2021-12-22', '', '', '', 6),
(140, 's 17  h1', '', 13, 0, 0, '', '00141', '', 0, '0000-00-00', 0, 0, 0, '49.35.181.201', '0000-00-00', '2021-12-22', '', '', '', 10),
(141, 's 17 h2', '', 13, 0, 0, '', '00142', '', 0, '0000-00-00', 0, 0, 0, '49.35.181.201', '0000-00-00', '2021-12-22', '', '', '', 10),
(142, 's 17 h3', '', 13, 0, 0, '', '00143', '', 0, '0000-00-00', 0, 0, 0, '49.35.181.201', '0000-00-00', '2021-12-22', '', '', '', 10),
(143, 'nano', '', 13, 0, 0, '', '00144', '', 0, '0000-00-00', 0, 0, 0, '103.115.128.58', '0000-00-00', '2021-12-23', '', '', '', 10),
(144, '3002', '', 13, 0, 0, '', '00145', '', 32, '0000-00-00', 0, 0, 0, '103.115.128.58', '0000-00-00', '2021-12-28', '', '', '', 10),
(145, '114', '', 13, 0, 0, '', '00146', '', 39, '0000-00-00', 0, 0, 0, '103.115.128.58', '0000-00-00', '2021-12-28', '', '', '', 10),
(148, 'marbito galaxy rubi', '', 13, 0, 0, '', '00149', '', 0, '0000-00-00', 0, 0, 0, '47.247.195.36', '0000-00-00', '2021-12-28', '', '', '', 10),
(149, 'BOND TIDE FC 180', '', 11, 0, 0, 'enable', '00149', '', 0, '2021-12-30', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-30', '', '', '', 11),
(150, 'BOND TIDE FC 90', '', 11, 0, 0, 'enable', '00150', '', 0, '2021-12-30', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-30', '', '', '', 11),
(151, 'BOND TIDE SS 90', '', 11, 0, 0, 'enable', '00151', '', 0, '2021-12-30', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-30', '', '', '', 11),
(152, 'BOND TIDE SS 180', '', 11, 0, 0, 'enable', '00152', '', 0, '2021-12-30', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-30', '', '', '', 11),
(153, 'BETRA', '', 11, 0, 0, 'enable', '00153', '', 0, '2021-12-30', 0, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-30', '', '', '', 11),
(154, 'ciment', '', 8, 0, 0, '', '00155', '', 0, '0000-00-00', 0, 0, 0, '47.247.213.20', '0000-00-00', '2021-12-31', '', '', '', 7),
(155, '1204 lexus', '', 13, 0, 0, '', '00156', '', 0, '0000-00-00', 0, 0, 0, '47.247.213.20', '0000-00-00', '2021-12-31', '', '', '', 10),
(156, 'j 680 lexus', '', 13, 0, 0, '', '00157', '', 0, '0000-00-00', 0, 0, 0, '47.247.213.20', '0000-00-00', '2021-12-31', '', '', '', 10),
(157, 'FISH BLACK', '', 12, 0, 0, '', '00158', '', 0, '0000-00-00', 0, 0, 0, '103.115.128.58', '0000-00-00', '2022-01-02', '', '', '', 6),
(158, 'PERAL BLACK', '', 12, 0, 0, '', '00159', '', 0, '0000-00-00', 0, 0, 0, '103.115.128.58', '0000-00-00', '2022-01-02', '', '', '', 6),
(159, 'M BLACK', '', 12, 0, 0, '', '00160', '', 0, '0000-00-00', 0, 0, 0, '103.115.128.58', '0000-00-00', '2022-01-02', '', '', '', 6),
(160, 'BLACK PERAL LINE', '', 12, 0, 0, '', '00161', '', 0, '0000-00-00', 0, 0, 0, '103.115.128.58', '0000-00-00', '2022-01-02', '', '', '', 6),
(161, 'GOD TILE 8X12', '', 11, 0, 0, '', '00162', '', 0, '0000-00-00', 0, 0, 0, '103.115.128.58', '0000-00-00', '2022-01-02', '', '', '', 10),
(162, 'GOD TILE 6X6', '', 11, 0, 0, '', '00163', '', 0, '0000-00-00', 0, 0, 0, '103.115.128.58', '0000-00-00', '2022-01-02', '', '', '', 10),
(163, 'LEXICON 1204 HLB', '', 13, 0, 0, 'enable', '00163', '', 0, '2022-01-02', 0, 0, 1, '103.115.128.58', '0000-00-00', '2022-01-02', '', '', '', 10),
(164, 'LEXICON 1204 DK', '', 13, 0, 0, 'enable', '00164', '', 0, '2022-01-02', 0, 0, 1, '103.115.128.58', '0000-00-00', '2022-01-02', '', '', '', 10),
(165, 'LEXICON 1204 LT', '', 13, 0, 0, 'enable', '00165', '', 0, '2022-01-02', 0, 0, 1, '103.115.128.58', '0000-00-00', '2022-01-02', '', '', '', 10),
(166, 'LXICON 1204 HL A', '', 13, 0, 0, 'enable', '00166', '', 0, '2022-01-02', 0, 0, 1, '103.115.128.58', '0000-00-00', '2022-01-02', '', '', '', 10),
(167, 'LEXICON 1050 D', '', 13, 0, 0, 'enable', '00167', '', 0, '2022-01-02', 0, 0, 1, '103.115.128.58', '0000-00-00', '2022-01-02', '', '', '', 10),
(168, 'LEXICON 1050 LT', '', 13, 0, 0, 'enable', '00168', '', 0, '2022-01-02', 0, 0, 1, '47.247.200.115', '2022-01-02', '2022-01-02', '', '', '', 10),
(169, 'LEXICON 1050 HL 1', '', 13, 0, 0, 'enable', '00169', '', 0, '2022-01-02', 0, 0, 1, '47.247.200.115', '2022-01-02', '2022-01-02', '', '', '', 10),
(170, 'LEXICON 1050 FL', '', 13, 0, 0, 'enable', '00170', '', 0, '2022-01-02', 0, 0, 1, '47.247.200.115', '0000-00-00', '2022-01-02', '', '', '', 10),
(171, 'LEXICON 1197 D', '', 13, 0, 0, 'enable', '00171', '', 0, '2022-01-02', 0, 0, 1, '47.247.200.115', '0000-00-00', '2022-01-02', '', '', '', 10),
(172, 'LEXICON 1197 L', '', 13, 0, 0, 'enable', '00172', '', 0, '2022-01-02', 0, 0, 1, '47.247.200.115', '0000-00-00', '2022-01-02', '', '', '', 10),
(173, 'LEXICON 1197 HL2', '', 13, 0, 0, 'enable', '00173', '', 0, '2022-01-02', 0, 0, 1, '47.247.200.115', '0000-00-00', '2022-01-02', '', '', '', 10),
(174, 'LEXICON 1197 HL 3', '', 13, 0, 0, 'enable', '00174', '', 0, '2022-01-02', 0, 0, 1, '47.247.200.115', '0000-00-00', '2022-01-02', '', '', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `m_product_category`
--

CREATE TABLE `m_product_category` (
  `pcatid` int(11) NOT NULL,
  `catname` varchar(150) NOT NULL,
  `enable` varchar(20) NOT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_product_category`
--

INSERT INTO `m_product_category` (`pcatid`, `catname`, `enable`, `createdby`, `ipaddress`, `lastupdated`, `createdate`) VALUES
(6, 'Granite', 'enable', 1, '::1', '2021-12-17', '2021-12-10'),
(7, 'Ciment', 'enable', 1, '::1', '2021-12-17', '2021-12-10'),
(10, 'Tiles', 'enable', 1, '::1', '2021-12-17', '2021-12-10'),
(11, 'GANPATI', 'enable', 1, '49.35.247.219', '0000-00-00', '2021-12-14'),
(12, 'grenite', 'enable', 1, '49.35.181.201', '0000-00-00', '2021-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `m_session`
--

CREATE TABLE `m_session` (
  `sessionid` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `session_name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_session`
--

INSERT INTO `m_session` (`sessionid`, `fromdate`, `todate`, `session_name`, `status`, `createdby`, `ipaddress`, `lastupdated`, `createdate`) VALUES
(1, '2021-10-14', '2022-10-14', '2022', 1, 1, '::1', '0000-00-00', '2022-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `m_state`
--

CREATE TABLE `m_state` (
  `stateid` int(11) NOT NULL,
  `state_name` varchar(200) NOT NULL,
  `state_code` varchar(200) NOT NULL,
  `enable` varchar(20) NOT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_supplier_party`
--

CREATE TABLE `m_supplier_party` (
  `suppartyid` int(11) NOT NULL,
  `stateid` int(11) DEFAULT NULL,
  `supparty_name` varchar(200) NOT NULL,
  `type_supparty` varchar(10) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `cust_type` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `district` varchar(110) NOT NULL,
  `city_name` varchar(200) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `prevbalance` double NOT NULL DEFAULT 0,
  `bank_name` varchar(100) NOT NULL,
  `bank_ac` varchar(100) NOT NULL,
  `bank_address` varchar(100) NOT NULL,
  `ifsc_code` varchar(100) NOT NULL,
  `panno` varchar(50) DEFAULT NULL,
  `credit_limit` float NOT NULL,
  `daycredit_limit` float NOT NULL,
  `tinno` varchar(50) NOT NULL,
  `prevbal_date` date NOT NULL,
  `enable` varchar(10) NOT NULL,
  `gst_type` varchar(100) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(25) DEFAULT NULL,
  `lastupdated` date DEFAULT NULL,
  `createdate` date NOT NULL,
  `aadharNo` varchar(25) DEFAULT NULL,
  `customerPhotos` varchar(100) DEFAULT NULL,
  `shopPhotos` varchar(100) DEFAULT NULL,
  `gstType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_supplier_party`
--

INSERT INTO `m_supplier_party` (`suppartyid`, `stateid`, `supparty_name`, `type_supparty`, `mobile`, `email`, `cust_type`, `address`, `district`, `city_name`, `discount`, `prevbalance`, `bank_name`, `bank_ac`, `bank_address`, `ifsc_code`, `panno`, `credit_limit`, `daycredit_limit`, `tinno`, `prevbal_date`, `enable`, `gst_type`, `createdby`, `ipaddress`, `lastupdated`, `createdate`, `aadharNo`, `customerPhotos`, `shopPhotos`, `gstType`) VALUES
(1, 0, 'Raj granite', 'supplier', '8120944444', '', '', 'saraipali', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '2021-12-03', 'enable', NULL, 1, NULL, '2021-12-10', '2021-12-10', NULL, NULL, NULL, ''),
(4, NULL, 'cash', 'party', '', '', '', '', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 0, NULL, NULL, '2021-12-11', NULL, NULL, NULL, ''),
(5, NULL, 'vishnu kesharwani', 'party', '', '', '', 'sheorinarayan', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 0, NULL, NULL, '2021-12-11', NULL, NULL, NULL, ''),
(6, 0, 'SANJAY TAILS', 'supplier', '8518922220', '', '', 'CHAMPA', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '2021-12-11', 'enable', NULL, 1, NULL, NULL, '2021-12-11', NULL, NULL, NULL, ''),
(7, NULL, 'manik lal sahu ', 'party', '6268512423', '', '', 'pawni', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 0, NULL, NULL, '2021-12-14', NULL, NULL, NULL, ''),
(8, NULL, 'MILAN CLOTH', 'party', '', '', '', 'SHEORINARAYAN', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 0, NULL, NULL, '2021-12-16', NULL, NULL, NULL, ''),
(9, 0, 'PRAMOD HARDWEYAR', 'supplier', '7722998910', '', '', 'BHBATGAON', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', '', NULL, 0, NULL, NULL, '2021-12-20', NULL, NULL, NULL, ''),
(10, NULL, 'shivkumar kewarty', 'party', '8889141914', '', '', 'devrimod', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 1, NULL, NULL, '2021-12-20', NULL, NULL, NULL, ''),
(11, NULL, 'satyaprakash yadav', 'party', '8103798122', '', '', 'kharaud', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 1, NULL, NULL, '2021-12-20', NULL, NULL, NULL, ''),
(12, NULL, 'ashok kesharwani', 'party', '', '', '', 'sheorinarayan', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 1, NULL, NULL, '2021-12-20', NULL, NULL, NULL, ''),
(13, NULL, 'rinku kesharwani', 'party', '', '', '', 'sheorianarayan', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 1, NULL, NULL, '2021-12-20', NULL, NULL, NULL, ''),
(14, NULL, 'manish kashyap', 'party', '9630644534', '', '', 'bamhindih', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 1, NULL, NULL, '2021-12-20', NULL, NULL, NULL, ''),
(15, NULL, 'SANTOSH MADHWANI', 'party', '', '', '', 'SHEORINARAYAN', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 1, NULL, NULL, '2021-12-20', NULL, NULL, NULL, ''),
(16, NULL, 'MANOJ MDHWANI', 'party', '', '', '', 'SHEORINARAYAN', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 1, NULL, NULL, '2021-12-20', NULL, NULL, NULL, ''),
(17, NULL, 'test', 'party', '9399771312', '', '', 'Raipur', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 0, NULL, NULL, '2021-12-21', NULL, NULL, NULL, ''),
(18, NULL, 'GORELAL SIDAR', 'party', '9171848290', '', '', 'KHORSHI', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 1, NULL, NULL, '2021-12-21', NULL, NULL, NULL, ''),
(19, NULL, 'aman mukim ', 'party', '', '', '', 'sheorinarayan', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 0, NULL, NULL, '2021-12-22', NULL, NULL, NULL, ''),
(20, NULL, 'krishnakant shingh', 'party', '', '', '', 'sheorinarayan', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 0, NULL, NULL, '2021-12-22', NULL, NULL, NULL, ''),
(22, NULL, 'pramod hardweyar', 'party', '', '', '', 'bhatgaon', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 0, NULL, NULL, '2021-12-23', NULL, NULL, NULL, ''),
(23, NULL, 'aman tredars', 'party', '', '', '', 'nawaghad', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 0, NULL, NULL, '2021-12-23', NULL, NULL, NULL, ''),
(24, NULL, 'chitranjan sriwash', 'party', '7222965927', '', '', 'deradih', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 0, NULL, NULL, '2021-12-27', NULL, NULL, NULL, ''),
(25, NULL, 'hanuman aditya ', 'party', '8770367166', '', '', 'odekera', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 0, NULL, NULL, '2021-12-31', NULL, NULL, NULL, ''),
(26, NULL, 'rahul kashyap', 'party', '', '', '', 'salkhan', '', NULL, NULL, 0, '', '', '', '', NULL, 0, 0, '', '0000-00-00', 'enable', NULL, 0, NULL, NULL, '2021-12-31', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `m_tax`
--

CREATE TABLE `m_tax` (
  `tax_id` int(11) NOT NULL,
  `tax_cat_id` int(11) NOT NULL,
  `taxname` varchar(100) NOT NULL,
  `tax` float NOT NULL,
  `enable` varchar(100) NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_tax`
--

INSERT INTO `m_tax` (`tax_id`, `tax_cat_id`, `taxname`, `tax`, `enable`, `ipaddress`, `lastupdated`, `createdate`) VALUES
(6, 7, 'Exempt IGST (0%)', 0, 'disable', 'fe80::6493:c651:716c:bda6', '2017-07-08', '2017-07-07'),
(7, 3, '28.0% IGST', 28, 'disable', '192.168.0.5', '0000-00-00', '2017-07-07'),
(8, 3, '18.0% IGST (18%)', 18, 'disable', '192.168.0.5', '0000-00-00', '2017-07-07'),
(9, 3, '12.0% IGST (12%)', 12, 'disable', '192.168.0.5', '0000-00-00', '2017-07-07'),
(10, 3, '5.0% IGST(5%)', 5, 'disable', '192.168.0.5', '0000-00-00', '2017-07-07'),
(11, 3, '0% IGST', 0, 'disable', '192.168.0.5', '0000-00-00', '2017-07-07'),
(12, 4, 'Exempt GST (0%)', 0, 'disable', '192.168.0.5', '0000-00-00', '2017-07-07'),
(13, 4, '28.0% GST (28%)', 28, 'enable', '192.168.0.5', '0000-00-00', '2017-07-07'),
(14, 4, '18.0% GST (18%)', 18, 'enable', '192.168.0.5', '0000-00-00', '2017-07-07'),
(15, 4, '12.0% GST (12%)', 12, 'enable', '192.168.0.5', '0000-00-00', '2017-07-07'),
(16, 4, '5.0% GST (5%)', 5, 'enable', '192.168.0.5', '0000-00-00', '2017-07-07'),
(17, 4, '0% GST (0%)', 0, 'enable', '192.168.0.5', '0000-00-00', '2017-07-07'),
(18, 5, '15.0% ST (100%)', 15, 'disable', 'fe80::6493:c651:716c:bda6', '2017-07-08', '2017-07-07'),
(19, 5, '14.5 ST (100%)', 14.5, 'disable', 'fe80::6493:c651:716c:bda6', '2017-07-08', '2017-07-07'),
(20, 5, '14.0% ST (100%)', 14, 'disable', 'fe80::6493:c651:716c:bda6', '2017-07-08', '2017-07-07'),
(21, 5, '12.36% ST (100%)', 12.36, 'disable', 'fe80::6493:c651:716c:bda6', '2017-07-08', '2017-07-07'),
(22, 5, '14.0% VAT (100%)', 14, 'disable', 'fe80::3013:93:4f85:8fba', '2017-07-14', '2017-07-07'),
(23, 5, '5.0% VAT (5%)', 5, 'disable', 'fe80::3013:93:4f85:8fba', '2017-07-14', '2017-07-07'),
(24, 5, '4.0% VAT(100%)', 4, 'disable', 'fe80::3013:93:4f85:8fba', '2017-07-14', '2017-07-07'),
(25, 8, '2.0% CST (100%)', 2, 'disable', 'fe80::6493:c651:716c:bda6', '2017-07-08', '2017-07-07'),
(26, 8, 'Out of Scope (0%)', 0, 'disable', '192.168.0.5', '0000-00-00', '2017-07-07');

-- --------------------------------------------------------

--
-- Table structure for table `m_taxt_cat`
--

CREATE TABLE `m_taxt_cat` (
  `tax_cat_id` int(11) NOT NULL,
  `tcat_name` varchar(100) NOT NULL,
  `enable` varchar(100) NOT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_taxt_cat`
--

INSERT INTO `m_taxt_cat` (`tax_cat_id`, `tcat_name`, `enable`, `createdby`, `ipaddress`, `lastupdated`, `createdate`) VALUES
(3, 'IGST', 'enable', 0, '192.168.0.5', '0000-00-00', '2017-07-07'),
(4, 'GST', 'enable', 0, '192.168.0.5', '0000-00-00', '2017-07-07'),
(5, 'ST', 'disable', 0, '192.168.0.5', '2017-07-07', '2017-07-07'),
(6, 'VAT', 'disable', 0, 'fe80::3013:93:4f85:8fba', '2017-07-14', '2017-07-07'),
(7, 'CST', 'disable', 0, '192.168.0.5', '2017-07-07', '2017-07-07'),
(8, 'None', 'enable', 0, '192.168.0.5', '0000-00-00', '2017-07-07');

-- --------------------------------------------------------

--
-- Table structure for table `m_unit`
--

CREATE TABLE `m_unit` (
  `unitid` int(11) NOT NULL,
  `unit_name` varchar(150) NOT NULL,
  `enable` varchar(20) NOT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_unit`
--

INSERT INTO `m_unit` (`unitid`, `unit_name`, `enable`, `createdby`, `ipaddress`, `lastupdated`, `createdate`) VALUES
(2, 'KG', 'enable', 1, '47.247.148.190', '0000-00-00', '2018-10-29'),
(4, 'Ltr.', 'enable', 1, '47.247.148.190', '0000-00-00', '2018-10-29'),
(6, 'PKT.', 'enable', 1, '47.247.216.5', '0000-00-00', '2019-01-07'),
(8, 'Bag', 'enable', 1, '49.15.166.184', '0000-00-00', '2019-11-12'),
(11, 'PCS', 'enable', 1, '110.224.161.214', '2021-11-10', '2021-11-09'),
(12, 'Feet', 'enable', 1, '110.224.169.60', '0000-00-00', '2021-11-12'),
(13, 'Box', 'enable', 1, '49.35.236.203', '2021-12-10', '2021-12-09'),
(14, 'BHADA', 'enable', 1, '49.35.247.219', '0000-00-00', '2021-12-14'),
(15, 'HEMALI', 'enable', 1, '49.35.247.219', '0000-00-00', '2021-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `other_expense`
--

CREATE TABLE `other_expense` (
  `expenid` int(11) NOT NULL,
  `expencetypeid` int(11) NOT NULL,
  `expen_name` varchar(200) NOT NULL,
  `expen_date` date NOT NULL,
  `amount` float NOT NULL,
  `compid` int(11) NOT NULL,
  `payto` varchar(100) NOT NULL,
  `receivedfrom` varchar(100) NOT NULL,
  `remark` text NOT NULL,
  `enable` varchar(20) NOT NULL,
  `sessionid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_expense`
--

INSERT INTO `other_expense` (`expenid`, `expencetypeid`, `expen_name`, `expen_date`, `amount`, `compid`, `payto`, `receivedfrom`, `remark`, `enable`, `sessionid`, `createdby`, `ipaddress`, `lastupdated`, `createdate`) VALUES
(2, 1, '', '2021-05-02', 18150, 0, 'AGRAWAL SIR', '', '                                           Cheq sbi account                                                                                                                                                                                                                                                                                                     ', '', 3, 1, '157.34.81.145', '2021-05-09', '2021-05-04'),
(3, 3, '', '2021-05-04', 5000, 0, 'Indra', '', '                                                                 Cash                                                                               ', '', 3, 1, '157.34.81.145', '2021-05-09', '2021-05-04'),
(4, 2, '', '2021-05-08', 6500, 0, 'swapnil', '', '                        swapnil bank account                        ', '', 3, 1, '157.34.81.145', '2021-05-09', '2021-05-09'),
(5, 4, '', '2021-05-08', 1200, 0, 'BAI', '', '                                                CASH', '', 3, 1, '49.15.163.61', '0000-00-00', '2021-05-09'),
(6, 11, '', '2021-06-09', 1200, 0, 'cash', '', '                          200+1000 advance diya hua h                       ', '', 3, 1, '27.97.234.55', '0000-00-00', '2021-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `other_income`
--

CREATE TABLE `other_income` (
  `incomid` int(11) NOT NULL,
  `incom_name` varchar(200) NOT NULL,
  `expencetypeid` int(11) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `receivedfrom` varchar(110) NOT NULL,
  `incom_date` date NOT NULL,
  `amount` float NOT NULL,
  `compid` int(11) NOT NULL,
  `enable` varchar(20) NOT NULL,
  `sessionid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_income`
--

INSERT INTO `other_income` (`incomid`, `incom_name`, `expencetypeid`, `remark`, `receivedfrom`, `incom_date`, `amount`, `compid`, `enable`, `sessionid`, `createdby`, `ipaddress`, `lastupdated`, `createdate`) VALUES
(1, '', 10, 'Piles operation..Tarun jaideen', 'cash', '2021-06-01', 16000, 0, '', 3, 1, '49.15.162.171', '2021-06-09', '2021-06-09'),
(2, '', 10, 'Shruti singh', 'cash', '2021-06-02', 9500, 0, '', 3, 1, '49.15.162.171', '2021-06-09', '2021-06-09'),
(3, '', 10, 'Ajith ekahh piles operation', 'cash', '2021-06-10', 14500, 0, '', 3, 1, '157.34.229.93', '0000-00-00', '2021-06-11'),
(4, '', 10, 'Bharti Piles', 'UPI', '2021-06-10', 6000, 0, '', 3, 1, '157.34.229.93', '0000-00-00', '2021-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `panel_expiry`
--

CREATE TABLE `panel_expiry` (
  `pexpiry_id` int(11) NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panel_expiry`
--

INSERT INTO `panel_expiry` (`pexpiry_id`, `expiry_date`) VALUES
(1, '2018-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payid` int(11) NOT NULL,
  `suppartyid` int(11) NOT NULL,
  `payamt` double NOT NULL,
  `paydate` date NOT NULL,
  `payment_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `chequeno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `refno` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `receiptno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `companyid` int(11) NOT NULL,
  `payment_description` text COLLATE utf8_unicode_ci NOT NULL,
  `pay_mode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `saleid` int(11) NOT NULL,
  `sessionid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  `lastupdated` datetime NOT NULL,
  `pay_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'credit,debit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payid`, `suppartyid`, `payamt`, `paydate`, `payment_type`, `chequeno`, `refno`, `bank_name`, `receiptno`, `companyid`, `payment_description`, `pay_mode`, `saleid`, `sessionid`, `createdby`, `createdate`, `lastupdated`, `pay_type`) VALUES
(1, 1, 300000, '2021-12-01', 'CASH', '', '', '', '00001', 0, '', 'paidtosupp', 0, 0, 1, '2021-12-20 14:04:37', '0000-00-00 00:00:00', ''),
(2, 1, 199200, '2021-12-05', 'CASH', '', '', '', '00002', 0, '', 'paidtosupp', 0, 0, 1, '2021-12-20 14:05:04', '0000-00-00 00:00:00', ''),
(3, 1, 49000, '2021-12-15', 'NEFT', 'new adity lojestic', '', '', '00003', 0, '', 'paidtosupp', 0, 0, 1, '2021-12-20 14:08:01', '0000-00-00 00:00:00', ''),
(4, 1, 100000, '2021-12-18', 'NEFT', 'vijay trending company axis bank dwro489601', '', '', '00004', 0, '', 'paidtosupp', 0, 0, 1, '2021-12-20 14:10:19', '0000-00-00 00:00:00', ''),
(5, 1, 100000, '2021-12-20', 'CASH', '', '', '', '00005', 0, '', 'paidtosupp', 0, 0, 1, '2021-12-20 14:10:39', '0000-00-00 00:00:00', ''),
(6, 7, 46720, '2021-12-20', 'CASH', '', '', '', 'Rec00001', 0, '', 'received', 0, 0, 1, '2021-12-20 14:13:39', '0000-00-00 00:00:00', ''),
(7, 5, 20000, '2021-12-09', 'QR', '', '', '', 'Rec00007', 0, '', 'received', 0, 0, 1, '2021-12-20 14:14:35', '0000-00-00 00:00:00', ''),
(8, 14, 71900, '2021-12-15', 'CASH', '', '', '', 'Rec00008', 0, '', 'received', 0, 0, 1, '2021-12-20 14:16:04', '0000-00-00 00:00:00', ''),
(9, 23, 14000, '2021-12-23', 'CASH', '', '', '', 'Rec00009', 0, '', 'received', 0, 0, 1, '2021-12-23 08:18:45', '0000-00-00 00:00:00', ''),
(10, 20, 3000, '2021-12-23', 'CASH', '', '', '', 'Rec00010', 0, '', 'received', 0, 0, 1, '2021-12-23 10:06:42', '0000-00-00 00:00:00', ''),
(11, 11, 25000, '2021-12-22', 'CASH', '', '', '', 'Rec00011', 0, '', 'received', 0, 0, 1, '2021-12-24 08:03:29', '0000-00-00 00:00:00', ''),
(12, 10, 30000, '2021-12-20', 'CASH', '', '', '', 'Rec00012', 0, '', 'received', 0, 0, 1, '2021-12-25 11:00:15', '0000-00-00 00:00:00', ''),
(13, 7, 15750, '2021-12-25', 'CASH', '', '', '', 'Rec00013', 0, '', 'received', 0, 0, 1, '2021-12-25 11:00:35', '0000-00-00 00:00:00', ''),
(14, 12, 10000, '2021-12-25', 'CASH', '', '', '', 'Rec00014', 0, '', 'received', 0, 0, 1, '2021-12-26 05:36:23', '0000-00-00 00:00:00', ''),
(15, 24, 23500, '2021-12-27', 'CASH', '', '', '', 'Rec00015', 0, '', 'received', 0, 0, 1, '2021-12-27 06:43:51', '0000-00-00 00:00:00', ''),
(16, 1, 117200, '2021-12-29', 'NEFT', '920020066331860 mahi trading axis bank', '', '', 'Rec00016', 0, '', 'paidtosupp', 0, 0, 1, '2021-12-29 12:55:05', '0000-00-00 00:00:00', ''),
(17, 16, 25830, '2021-12-30', 'CASH', '', '', '', 'Rec00016', 0, '', 'received', 0, 0, 1, '2021-12-30 10:20:33', '0000-00-00 00:00:00', ''),
(18, 25, 57320, '2021-12-31', 'CASH', '', '', '', 'Rec00018', 0, '', 'received', 0, 0, 1, '2021-12-31 14:05:27', '0000-00-00 00:00:00', ''),
(19, 26, 9300, '2021-12-31', 'CASH', '', '', '', 'Rec00019', 0, '', 'received', 0, 0, 1, '2021-12-31 14:05:51', '0000-00-00 00:00:00', ''),
(20, 23, 5000, '2021-12-31', 'CASH', '', '', '', 'Rec00020', 0, '', 'received', 0, 0, 1, '2021-12-31 14:06:45', '0000-00-00 00:00:00', ''),
(21, 18, 35150, '2022-01-02', 'CASH', '', '', '', 'Rec00021', 0, '', 'received', 0, 0, 1, '2022-01-02 09:09:59', '0000-00-00 00:00:00', ''),
(22, 1, 45000, '2022-01-02', 'CASH', '', '', '', 'Rec00022', 0, '', 'paidtosupp', 0, 0, 1, '2022-01-02 12:54:13', '0000-00-00 00:00:00', ''),
(23, 1, 33000, '2022-01-02', 'CASH', '', '', '', 'Rec00023', 0, '', 'paidtosupp', 0, 0, 1, '2022-01-02 12:54:33', '0000-00-00 00:00:00', ''),
(24, 6, 100, '2022-03-14', 'CASH', '', '', '', 'Rec00024', 0, '', 'paidtosupp', 0, 1, 1, '2022-03-14 11:43:25', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseentry`
--

CREATE TABLE `purchaseentry` (
  `purchaseid` int(11) NOT NULL,
  `suppartyid` int(11) NOT NULL,
  `billno` varchar(100) NOT NULL,
  `order_no` varchar(50) NOT NULL,
  `truckNumber` varchar(50) NOT NULL,
  `purchasedate` date NOT NULL,
  `purchase_type` varchar(100) NOT NULL,
  `billtype` varchar(100) NOT NULL,
  `disc` float NOT NULL,
  `packing_charge` float NOT NULL,
  `driverName` varchar(50) NOT NULL,
  `driverMob` varchar(50) NOT NULL,
  `freight_charge` float NOT NULL,
  `transport_name` varchar(200) NOT NULL,
  `transport_date` date NOT NULL,
  `compid` int(11) NOT NULL,
  `total_pur` float NOT NULL,
  `sessionid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseentry`
--

INSERT INTO `purchaseentry` (`purchaseid`, `suppartyid`, `billno`, `order_no`, `truckNumber`, `purchasedate`, `purchase_type`, `billtype`, `disc`, `packing_charge`, `driverName`, `driverMob`, `freight_charge`, `transport_name`, `transport_date`, `compid`, `total_pur`, `sessionid`, `createdby`, `ipaddress`, `lastupdated`, `createdate`) VALUES
(1, 1, '1115', '', '7829', '2021-12-06', 'Challan', 'Challan', 0, 0, '', '', 0, '', '0000-00-00', 0, 681785, 5, 1, '47.247.195.36', '2021-12-28', '0000-00-00'),
(2, 1, '1116', '', '7829', '2021-12-06', 'Challan', 'Challan', 0, 0, '', '', 0, '', '0000-00-00', 0, 196912, 5, 1, '103.115.128.58', '2021-12-28', '0000-00-00'),
(3, 6, '01', '', '7829', '2021-11-28', 'Challan', 'Challan', 0, 0, '', '', 0, '', '0000-00-00', 0, 329100, 5, 0, '', '0000-00-00', '0000-00-00'),
(8, 1, '1083', '', '7829', '2021-12-03', 'Challan', '', 0, 0, '', '', 0, '', '0000-00-00', 0, 25770, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20'),
(9, 1, '1082', '', '7829', '2021-12-03', 'Challan', '', 0, 0, '', '', 0, '', '0000-00-00', 0, 23432, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20'),
(10, 1, '1140', '', 'SHARDA', '2021-12-07', 'Challan', '', 0, 0, '', '', 0, '', '0000-00-00', 0, 95584, 0, 1, '103.115.128.58', '0000-00-00', '2021-12-20'),
(11, 1, '1218', '', 'CHANDRIKA', '2021-12-16', 'Challan', '', 0, 0, '', '', 0, '', '0000-00-00', 0, 78715, 0, 1, '103.115.128.58', '2021-12-30', '2021-12-20'),
(12, 1, '1257', '', 'CHANDRIKA', '2021-12-19', 'Challan', '', 0, 0, '', '', 0, '', '0000-00-00', 0, 63010, 0, 1, '103.115.128.58', '2021-12-20', '2021-12-20'),
(13, 1, '1269', '', 'shubham  yadav', '2021-12-21', 'Challan', '', 0, 0, '', '', 0, '', '0000-00-00', 0, 49524, 0, 1, '49.35.181.201', '0000-00-00', '2021-12-22'),
(14, 9, '1', '', 'narayan', '2021-12-23', 'Challan', '', 0, 0, '', '', 0, '', '0000-00-00', 0, 31100, 0, 1, '103.115.128.58', '2021-12-23', '2021-12-23'),
(15, 1, '1313', '', '7829', '2021-12-28', 'Challan', '', 0, 0, '', '', 0, '', '0000-00-00', 0, 182600, 0, 1, '47.247.195.36', '0000-00-00', '2021-12-28'),
(16, 1, '1344', '', '7829', '2021-12-27', 'Challan', '', 0, 0, '', '', 0, '', '0000-00-00', 0, 61073, 0, 1, '103.115.128.58', '0000-00-00', '2022-01-02'),
(17, 1, '1775/72', '', '7829', '2022-01-02', 'Challan', '', 0, 0, '', '', 0, '', '0000-00-00', 0, 53170, 0, 1, '103.115.128.58', '0000-00-00', '2022-01-02'),
(18, 1, '1374', '', '7829', '2021-12-30', 'Challan', '', 0, 0, '', '', 0, '', '0000-00-00', 0, 49825, 0, 1, '47.247.200.115', '0000-00-00', '2022-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `purchasentry_detail`
--

CREATE TABLE `purchasentry_detail` (
  `purdetail_id` int(11) NOT NULL,
  `purchaseid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `unitid` int(11) NOT NULL,
  `rate` double(16,2) NOT NULL,
  `disc_per` float NOT NULL,
  `disc` double(16,2) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `cgst` float NOT NULL,
  `sgst` float NOT NULL,
  `igst` float NOT NULL,
  `totalval` double(16,2) NOT NULL,
  `gst` double(16,2) NOT NULL,
  `gstAmount` double(16,2) NOT NULL,
  `qty` float NOT NULL,
  `roundoff` double(16,2) DEFAULT NULL,
  `total` double(16,2) NOT NULL,
  `createdate` date NOT NULL,
  `lastupdated` date DEFAULT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasentry_detail`
--

INSERT INTO `purchasentry_detail` (`purdetail_id`, `purchaseid`, `productid`, `unitid`, `rate`, `disc_per`, `disc`, `tax_id`, `cgst`, `sgst`, `igst`, `totalval`, `gst`, `gstAmount`, `qty`, `roundoff`, `total`, `createdate`, `lastupdated`, `ipaddress`, `createdby`) VALUES
(2, 1, 5, 13, 580.00, 0, 0.00, 0, 0, 0, 0, 29000.00, 0.00, 0.00, 50, 0.00, 29000.00, '2021-12-10', NULL, '49.35.236.203', 1),
(4, 1, 6, 13, 680.00, 0, 0.00, 0, 0, 0, 0, 40800.00, 0.00, 0.00, 60, 0.00, 40800.00, '2021-12-10', NULL, '49.35.236.203', 1),
(5, 1, 7, 13, 680.00, 0, 0.00, 0, 0, 0, 0, 42840.00, 0.00, 0.00, 63, 0.00, 42840.00, '2021-12-10', NULL, '49.35.236.203', 1),
(6, 1, 8, 13, 680.00, 0, 0.00, 0, 0, 0, 0, 40800.00, 0.00, 0.00, 60, 0.00, 40800.00, '2021-12-10', NULL, '49.35.236.203', 1),
(7, 1, 9, 13, 680.00, 0, 0.00, 0, 0, 0, 0, 27880.00, 0.00, 0.00, 41, 0.00, 27880.00, '2021-12-10', NULL, '49.35.236.203', 1),
(8, 1, 10, 13, 600.00, 0, 0.00, 0, 0, 0, 0, 36000.00, 0.00, 0.00, 60, 0.00, 36000.00, '2021-12-10', NULL, '49.35.236.203', 1),
(9, 1, 11, 13, 710.00, 0, 0.00, 0, 0, 0, 0, 42600.00, 0.00, 0.00, 60, 0.00, 42600.00, '2021-12-10', NULL, '49.35.236.203', 1),
(10, 1, 12, 13, 780.00, 0, 0.00, 0, 0, 0, 0, 46800.00, 0.00, 0.00, 60, 0.00, 46800.00, '2021-12-10', NULL, '49.35.236.203', 1),
(11, 1, 13, 13, 600.00, 0, 0.00, 0, 0, 0, 0, 36000.00, 0.00, 0.00, 60, 0.00, 36000.00, '2021-12-10', NULL, '49.35.236.203', 1),
(12, 1, 14, 13, 600.00, 0, 0.00, 0, 0, 0, 0, 50400.00, 0.00, 0.00, 84, 0.00, 50400.00, '2021-12-10', NULL, '49.35.236.203', 1),
(13, 1, 15, 13, 480.00, 0, 0.00, 0, 0, 0, 0, 28800.00, 0.00, 0.00, 60, 0.00, 28800.00, '2021-12-10', NULL, '49.35.236.203', 1),
(14, 1, 16, 13, 480.00, 0, 0.00, 0, 0, 0, 0, 28800.00, 0.00, 0.00, 60, 0.00, 28800.00, '2021-12-10', NULL, '49.35.236.203', 1),
(15, 1, 17, 13, 480.00, 0, 0.00, 0, 0, 0, 0, 28800.00, 0.00, 0.00, 60, 0.00, 28800.00, '2021-12-10', NULL, '49.35.236.203', 1),
(16, 1, 18, 13, 480.00, 0, 0.00, 0, 0, 0, 0, 28800.00, 0.00, 0.00, 60, 0.00, 28800.00, '2021-12-10', NULL, '49.35.236.203', 1),
(17, 1, 19, 13, 680.00, 0, 0.00, 0, 0, 0, 0, 10880.00, 0.00, 0.00, 16, 0.00, 10880.00, '2021-12-10', NULL, '49.35.236.203', 1),
(18, 1, 20, 13, 750.00, 0, 0.00, 0, 0, 0, 0, 2250.00, 0.00, 0.00, 3, 0.00, 2250.00, '2021-12-10', NULL, '49.35.236.203', 1),
(19, 1, 22, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 13500.00, 0.00, 0.00, 50, 0.00, 13500.00, '2021-12-10', NULL, '49.35.236.203', 1),
(20, 1, 21, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 13500.00, 0.00, 0.00, 50, 0.00, 13500.00, '2021-12-10', NULL, '49.35.236.203', 1),
(21, 1, 24, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 13500.00, 0.00, 0.00, 50, 0.00, 13500.00, '2021-12-10', NULL, '49.35.236.203', 1),
(22, 1, 23, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 13500.00, 0.00, 0.00, 50, 0.00, 13500.00, '2021-12-10', NULL, '49.35.236.203', 1),
(23, 1, 25, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 12500.00, 0.00, 0.00, 50, 0.00, 12500.00, '2021-12-10', NULL, '49.35.236.203', 1),
(24, 1, 26, 0, 250.00, 0, 0.00, 0, 0, 0, 0, 12500.00, 0.00, 0.00, 50, 0.00, 12500.00, '2021-12-10', NULL, '49.35.236.203', 1),
(25, 1, 27, 0, 250.00, 0, 0.00, 0, 0, 0, 0, 12500.00, 0.00, 0.00, 50, 0.00, 12500.00, '2021-12-10', NULL, '49.35.236.203', 1),
(26, 1, 28, 13, 22.66, 0, 0.00, 0, 0, 0, 0, 3399.00, 0.00, 0.00, 150, 0.00, 3400.00, '2021-12-10', '2021-12-28', '47.247.195.36', 1),
(27, 1, 29, 13, 22.66, 0, 0.00, 0, 0, 0, 0, 3399.00, 0.00, 0.00, 150, 0.00, 3400.00, '2021-12-10', '2021-12-28', '47.247.195.36', 1),
(28, 1, 30, 13, 22.66, 0, 0.00, 0, 0, 0, 0, 3399.00, 0.00, 0.00, 150, 0.00, 3400.00, '2021-12-10', '2021-12-28', '47.247.195.36', 1),
(29, 1, 31, 13, 22.66, 0, 0.00, 0, 0, 0, 0, 3399.00, 0.00, 0.00, 150, 0.00, 3400.00, '2021-12-10', '2021-12-28', '47.247.195.36', 1),
(31, 1, 32, 13, 22.66, 0, 0.00, 0, 0, 0, 0, 3399.00, 0.00, 0.00, 150, 0.00, 3400.00, '2021-12-10', '2021-12-28', '47.247.195.36', 1),
(32, 1, 33, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 5400.00, 0.00, 0.00, 20, 0.00, 5400.00, '2021-12-11', NULL, '49.35.236.194', 1),
(33, 1, 34, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 8100.00, 0.00, 0.00, 30, 0.00, 8100.00, '2021-12-11', NULL, '49.35.236.194', 1),
(34, 1, 35, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 8100.00, 0.00, 0.00, 30, 0.00, 8100.00, '2021-12-11', NULL, '49.35.236.194', 1),
(35, 1, 36, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 7020.00, 0.00, 0.00, 26, 0.00, 7020.00, '2021-12-11', NULL, '49.35.236.194', 1),
(36, 1, 37, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 8100.00, 0.00, 0.00, 30, 0.00, 8100.00, '2021-12-11', NULL, '49.35.236.194', 1),
(37, 1, 38, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 7020.00, 0.00, 0.00, 26, 0.00, 7020.00, '2021-12-11', NULL, '49.35.236.194', 1),
(38, 1, 39, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 8100.00, 0.00, 0.00, 30, 0.00, 8100.00, '2021-12-11', NULL, '49.35.236.194', 1),
(39, 2, 40, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(40, 2, 41, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(41, 2, 42, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(42, 2, 43, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(43, 2, 44, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 7500.00, 0.00, 0.00, 30, 0.00, 7500.00, '2021-12-11', NULL, '49.35.236.194', 1),
(44, 2, 45, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 3750.00, 0.00, 0.00, 15, 0.00, 3750.00, '2021-12-11', NULL, '49.35.236.194', 1),
(45, 2, 46, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 3750.00, 0.00, 0.00, 15, 0.00, 3750.00, '2021-12-11', NULL, '49.35.236.194', 1),
(46, 2, 47, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(47, 2, 48, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 5000.00, 0.00, 0.00, 20, 0.00, 5000.00, '2021-12-11', NULL, '49.35.236.194', 1),
(48, 2, 49, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 5000.00, 0.00, 0.00, 20, 0.00, 5000.00, '2021-12-11', NULL, '49.35.236.194', 1),
(49, 2, 50, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 5000.00, 0.00, 0.00, 20, 0.00, 5000.00, '2021-12-11', NULL, '49.35.236.194', 1),
(50, 2, 51, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(51, 2, 52, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(52, 2, 53, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(53, 2, 54, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(54, 2, 55, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(55, 2, 56, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(56, 2, 57, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(57, 2, 58, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(58, 2, 59, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 5000.00, 0.00, 0.00, 20, 0.00, 5000.00, '2021-12-11', NULL, '49.35.236.194', 1),
(59, 2, 60, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 5000.00, 0.00, 0.00, 20, 0.00, 5000.00, '2021-12-11', NULL, '49.35.236.194', 1),
(60, 2, 61, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 5000.00, 0.00, 0.00, 20, 0.00, 5000.00, '2021-12-11', NULL, '49.35.236.194', 1),
(61, 2, 62, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 5000.00, 0.00, 0.00, 20, 0.00, 5000.00, '2021-12-11', NULL, '49.35.236.194', 1),
(62, 2, 63, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 5000.00, 0.00, 0.00, 20, 0.00, 5000.00, '2021-12-11', NULL, '49.35.236.194', 1),
(64, 2, 65, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(65, 2, 66, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(66, 2, 67, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(67, 2, 68, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 6250.00, 0.00, 0.00, 25, 0.00, 6250.00, '2021-12-11', NULL, '49.35.236.194', 1),
(68, 2, 81, 14, 13500.00, 0, 0.00, 0, 0, 0, 0, 13500.00, 0.00, 0.00, 1, 0.00, 13500.00, '2021-12-14', NULL, '49.35.247.219', 1),
(69, 2, 80, 15, 3222.00, 0, 0.00, 0, 0, 0, 0, 3222.00, 0.00, 0.00, 1, 0.00, 3222.00, '2021-12-14', NULL, '49.35.247.219', 1),
(70, 2, 82, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 540.00, 0.00, 0.00, 2, 0.00, 540.00, '2021-12-14', NULL, '49.35.247.219', 1),
(71, 2, 83, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 540.00, 0.00, 0.00, 2, 0.00, 540.00, '2021-12-14', NULL, '49.35.247.219', 1),
(72, 2, 85, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 540.00, 0.00, 0.00, 2, 0.00, 540.00, '2021-12-14', NULL, '49.35.247.219', 1),
(73, 2, 84, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 540.00, 0.00, 0.00, 2, 0.00, 540.00, '2021-12-14', NULL, '49.35.247.219', 1),
(74, 2, 86, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 540.00, 0.00, 0.00, 2, 0.00, 540.00, '2021-12-14', NULL, '49.35.247.219', 1),
(75, 2, 87, 13, 270.00, 0, 0.00, 0, 0, 0, 0, 540.00, 0.00, 0.00, 2, 0.00, 540.00, '2021-12-14', NULL, '49.35.247.219', 1),
(76, 2, 88, 8, 35.00, 0, 0.00, 0, 0, 0, 0, 2100.00, 0.00, 0.00, 60, 0.00, 2100.00, '2021-12-14', NULL, '49.35.247.219', 1),
(77, 2, 80, 15, 1150.00, 0, 0.00, 0, 0, 0, 0, 1150.00, 0.00, 0.00, 1, 0.00, 1150.00, '2021-12-14', NULL, '49.35.247.219', 1),
(78, 2, 64, 13, 250.00, 0, 0.00, 0, 0, 0, 0, 3750.00, 0.00, 0.00, 15, 0.00, 3750.00, '2021-12-14', NULL, '49.35.247.219', 1),
(79, 2, 69, 8, 290.00, 0, 0.00, 0, 0, 0, 0, 8700.00, 0.00, 0.00, 30, 0.00, 8700.00, '2021-12-14', NULL, '49.35.247.219', 1),
(80, 3, 70, 13, 660.00, 0, 0.00, 0, 0, 0, 0, 33000.00, 0.00, 0.00, 50, 0.00, 33000.00, '2021-12-16', NULL, '106.77.191.16', 1),
(81, 3, 71, 13, 620.00, 0, 0.00, 0, 0, 0, 0, 37200.00, 0.00, 0.00, 60, 0.00, 37200.00, '2021-12-16', NULL, '106.77.191.16', 1),
(82, 3, 72, 13, 620.00, 0, 0.00, 0, 0, 0, 0, 37200.00, 0.00, 0.00, 60, 0.00, 37200.00, '2021-12-16', NULL, '106.77.191.16', 1),
(83, 3, 73, 13, 620.00, 0, 0.00, 0, 0, 0, 0, 43400.00, 0.00, 0.00, 70, 0.00, 43400.00, '2021-12-16', NULL, '106.77.191.16', 1),
(84, 3, 74, 13, 620.00, 0, 0.00, 0, 0, 0, 0, 32860.00, 0.00, 0.00, 53, 0.00, 32860.00, '2021-12-16', NULL, '106.77.191.16', 1),
(85, 3, 75, 13, 490.00, 0, 0.00, 0, 0, 0, 0, 24500.00, 0.00, 0.00, 50, 0.00, 24500.00, '2021-12-16', NULL, '106.77.191.16', 1),
(86, 3, 76, 13, 620.00, 0, 0.00, 0, 0, 0, 0, 47120.00, 0.00, 0.00, 76, 0.00, 47120.00, '2021-12-16', NULL, '106.77.191.16', 1),
(87, 3, 77, 13, 620.00, 0, 0.00, 0, 0, 0, 0, 42780.00, 0.00, 0.00, 69, 0.00, 42780.00, '2021-12-16', NULL, '106.77.191.16', 1),
(88, 3, 79, 13, 490.00, 0, 0.00, 0, 0, 0, 0, 6860.00, 0.00, 0.00, 14, 0.00, 6860.00, '2021-12-16', NULL, '106.77.191.16', 1),
(89, 3, 78, 13, 620.00, 0, 0.00, 0, 0, 0, 0, 24180.00, 0.00, 0.00, 39, 0.00, 24180.00, '2021-12-16', NULL, '106.77.191.16', 1),
(91, 7, 78, 13, 2.00, 12, 12.00, 17, 0, 0, 0, 21.12, 0.00, 0.00, 12, NULL, 0.00, '2021-12-17', NULL, '::1', 1),
(92, 8, 112, 13, 750.00, 0, 0.00, 17, 0, 0, 0, 750.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(93, 8, 111, 13, 750.00, 0, 0.00, 17, 0, 0, 0, 750.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(94, 8, 110, 13, 750.00, 0, 0.00, 17, 0, 0, 0, 750.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(95, 8, 113, 13, 750.00, 0, 0.00, 17, 0, 0, 0, 750.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(96, 8, 114, 13, 750.00, 0, 0.00, 17, 0, 0, 0, 750.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(97, 8, 115, 13, 750.00, 0, 0.00, 17, 0, 0, 0, 750.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(98, 8, 116, 13, 750.00, 0, 0.00, 17, 0, 0, 0, 750.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(99, 8, 20, 13, 750.00, 0, 0.00, 17, 0, 0, 0, 750.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(100, 8, 118, 13, 600.00, 0, 0.00, 17, 0, 0, 0, 1200.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', '2021-12-20', '103.115.128.58', 1),
(101, 8, 119, 13, 600.00, 0, 0.00, 17, 0, 0, 0, 1200.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', '2021-12-20', '103.115.128.58', 1),
(102, 8, 120, 13, 600.00, 0, 0.00, 17, 0, 0, 0, 1200.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', '2021-12-20', '103.115.128.58', 1),
(103, 8, 121, 13, 600.00, 0, 0.00, 17, 0, 0, 0, 1200.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', '2021-12-20', '103.115.128.58', 1),
(104, 8, 122, 13, 600.00, 0, 0.00, 17, 0, 0, 0, 1200.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(105, 8, 123, 13, 600.00, 0, 0.00, 17, 0, 0, 0, 1200.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(106, 8, 124, 13, 600.00, 0, 0.00, 17, 0, 0, 0, 1200.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(107, 8, 125, 13, 600.00, 0, 0.00, 17, 0, 0, 0, 1200.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(108, 8, 126, 13, 600.00, 0, 0.00, 17, 0, 0, 0, 1200.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(109, 8, 127, 13, 600.00, 0, 0.00, 17, 0, 0, 0, 1200.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(110, 8, 128, 13, 660.00, 0, 0.00, 17, 0, 0, 0, 1320.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', '2021-12-20', '103.115.128.58', 1),
(111, 8, 129, 13, 660.00, 0, 0.00, 17, 0, 0, 0, 1320.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', '2021-12-20', '103.115.128.58', 1),
(112, 8, 133, 13, 660.00, 0, 0.00, 17, 0, 0, 0, 1320.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', '2021-12-20', '103.115.128.58', 1),
(113, 8, 130, 13, 660.00, 0, 0.00, 17, 0, 0, 0, 1320.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', '2021-12-20', '103.115.128.58', 1),
(114, 8, 131, 13, 600.00, 0, 0.00, 17, 0, 0, 0, 1200.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(115, 8, 132, 13, 600.00, 0, 0.00, 17, 0, 0, 0, 1200.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(116, 8, 80, 15, 90.00, 0, 0.00, 17, 0, 0, 0, 90.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(117, 9, 91, 13, 740.00, 0, 0.00, 17, 0, 0, 0, 1480.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(118, 9, 92, 13, 780.00, 0, 0.00, 17, 0, 0, 0, 1560.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(119, 9, 93, 13, 780.00, 0, 0.00, 17, 0, 0, 0, 1560.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(120, 9, 94, 13, 740.00, 0, 0.00, 17, 0, 0, 0, 1480.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(121, 9, 95, 13, 740.00, 0, 0.00, 17, 0, 0, 0, 1480.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(122, 9, 96, 13, 780.00, 0, 0.00, 17, 0, 0, 0, 1560.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(123, 9, 97, 13, 740.00, 0, 0.00, 17, 0, 0, 0, 1480.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(124, 9, 99, 13, 780.00, 0, 0.00, 17, 0, 0, 0, 1560.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(125, 9, 109, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 960.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(126, 9, 100, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 960.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(127, 9, 101, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 960.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(128, 9, 102, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 960.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(129, 9, 103, 8, 480.00, 0, 0.00, 17, 0, 0, 0, 960.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(130, 9, 98, 13, 780.00, 0, 0.00, 17, 0, 0, 0, 1560.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(131, 9, 104, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 960.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(132, 9, 105, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 960.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(133, 9, 106, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 960.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(134, 9, 107, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 960.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(135, 9, 108, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 960.00, 0.00, 0.00, 2, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(136, 9, 80, 15, 112.00, 0, 0.00, 17, 0, 0, 0, 112.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(137, 10, 135, 11, 380.00, 0, 0.00, 17, 0, 0, 0, 30400.00, 0.00, 0.00, 80, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(138, 10, 134, 11, 400.00, 0, 0.00, 17, 0, 0, 0, 64800.00, 0.00, 0.00, 162, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(139, 10, 80, 15, 384.00, 0, 0.00, 17, 0, 0, 0, 384.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(140, 11, 105, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 24000.00, 0.00, 0.00, 50, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(141, 11, 25, 13, 250.00, 0, 0.00, 17, 0, 0, 0, 12500.00, 0.00, 0.00, 50, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(142, 11, 43, 13, 250.00, 0, 0.00, 17, 0, 0, 0, 2500.00, 0.00, 0.00, 10, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(143, 11, 100, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 9600.00, 0.00, 0.00, 20, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(144, 11, 116, 13, 750.00, 0, 0.00, 17, 0, 0, 0, 22500.00, 0.00, 0.00, 30, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(145, 12, 105, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 24000.00, 0.00, 0.00, 50, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(146, 12, 93, 13, 780.00, 0, 0.00, 17, 0, 0, 0, 23400.00, 0.00, 0.00, 30, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(147, 12, 25, 13, 250.00, 0, 0.00, 17, 0, 0, 0, 7500.00, 0.00, 0.00, 30, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(148, 12, 43, 13, 250.00, 0, 0.00, 17, 0, 0, 0, 3750.00, 0.00, 0.00, 15, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(149, 12, 136, 13, 270.00, 0, 0.00, 17, 0, 0, 0, 4050.00, 0.00, 0.00, 15, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(150, 12, 80, 15, 310.00, 0, 0.00, 17, 0, 0, 0, 310.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-20', NULL, '103.115.128.58', 1),
(151, 13, 55, 13, 250.00, 0, 0.00, 17, 0, 0, 0, 6250.00, 0.00, 0.00, 25, NULL, 0.00, '2021-12-22', NULL, '49.35.181.201', 1),
(152, 13, 57, 13, 250.00, 0, 0.00, 17, 0, 0, 0, 6250.00, 0.00, 0.00, 25, NULL, 0.00, '2021-12-22', NULL, '49.35.181.201', 1),
(153, 13, 56, 13, 250.00, 0, 0.00, 17, 0, 0, 0, 6250.00, 0.00, 0.00, 25, NULL, 0.00, '2021-12-22', '2021-12-22', '49.35.181.201', 1),
(154, 13, 25, 13, 250.00, 0, 0.00, 17, 0, 0, 0, 2000.00, 0.00, 0.00, 8, NULL, 0.00, '2021-12-22', NULL, '49.35.181.201', 1),
(155, 13, 138, 0, 230.00, 0, 0.00, 17, 0, 0, 0, 5750.00, 0.00, 0.00, 25, NULL, 0.00, '2021-12-22', NULL, '49.35.181.201', 1),
(156, 13, 139, 0, 78.00, 0, 0.00, 17, 0, 0, 0, 16684.20, 0.00, 0.00, 213.9, NULL, 0.00, '2021-12-22', NULL, '49.35.181.201', 1),
(157, 13, 140, 0, 195.00, 0, 0.00, 17, 0, 0, 0, 1950.00, 0.00, 0.00, 10, NULL, 0.00, '2021-12-22', NULL, '49.35.181.201', 1),
(158, 13, 141, 0, 195.00, 0, 0.00, 17, 0, 0, 0, 1950.00, 0.00, 0.00, 10, NULL, 0.00, '2021-12-22', NULL, '49.35.181.201', 1),
(159, 13, 142, 0, 195.00, 0, 0.00, 17, 0, 0, 0, 1950.00, 0.00, 0.00, 10, NULL, 0.00, '2021-12-22', NULL, '49.35.181.201', 1),
(160, 13, 80, 15, 490.00, 0, 0.00, 17, 0, 0, 0, 490.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-22', '2021-12-22', '49.35.181.201', 1),
(161, 14, 143, 0, 460.00, 0, 0.00, 17, 0, 0, 0, 23000.00, 0.00, 0.00, 50, NULL, 0.00, '2021-12-23', NULL, '103.115.128.58', 1),
(162, 14, 25, 13, 270.00, 0, 0.00, 17, 0, 0, 0, 8100.00, 0.00, 0.00, 30, NULL, 0.00, '2021-12-23', NULL, '103.115.128.58', 1),
(163, 15, 124, 13, 585.00, 0, 0.00, 17, 0, 0, 0, 29250.00, 0.00, 0.00, 50, NULL, 0.00, '2021-12-28', NULL, '27.62.213.247', 1),
(164, 15, 125, 13, 585.00, 0, 0.00, 17, 0, 0, 0, 29250.00, 0.00, 0.00, 50, NULL, 0.00, '2021-12-28', NULL, '27.62.213.247', 1),
(165, 15, 126, 13, 585.00, 0, 0.00, 17, 0, 0, 0, 29250.00, 0.00, 0.00, 50, NULL, 0.00, '2021-12-28', NULL, '27.62.213.247', 1),
(166, 15, 123, 13, 585.00, 0, 0.00, 17, 0, 0, 0, 29250.00, 0.00, 0.00, 50, NULL, 0.00, '2021-12-28', NULL, '47.247.195.36', 1),
(167, 15, 128, 13, 650.00, 0, 0.00, 17, 0, 0, 0, 32500.00, 0.00, 0.00, 50, NULL, 0.00, '2021-12-28', NULL, '47.247.195.36', 1),
(168, 15, 129, 13, 650.00, 0, 0.00, 17, 0, 0, 0, 16250.00, 0.00, 0.00, 25, NULL, 0.00, '2021-12-28', NULL, '47.247.195.36', 1),
(169, 15, 148, 0, 650.00, 0, 0.00, 17, 0, 0, 0, 16250.00, 0.00, 0.00, 25, NULL, 0.00, '2021-12-28', NULL, '47.247.195.36', 1),
(170, 15, 80, 15, 600.00, 0, 0.00, 17, 0, 0, 0, 600.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-28', NULL, '47.247.195.36', 1),
(171, 11, 153, 11, 48.00, 0, 0.00, 17, 0, 0, 0, 2400.00, 0.00, 0.00, 50, NULL, 0.00, '2021-12-30', NULL, '103.115.128.58', 1),
(172, 11, 150, 11, 210.00, 0, 0.00, 17, 0, 0, 0, 1050.00, 0.00, 0.00, 5, NULL, 0.00, '2021-12-30', NULL, '103.115.128.58', 1),
(173, 11, 149, 11, 380.00, 0, 0.00, 17, 0, 0, 0, 1900.00, 0.00, 0.00, 5, NULL, 0.00, '2021-12-30', NULL, '103.115.128.58', 1),
(174, 11, 152, 11, 245.00, 0, 0.00, 17, 0, 0, 0, 1225.00, 0.00, 0.00, 5, NULL, 0.00, '2021-12-30', NULL, '103.115.128.58', 1),
(175, 11, 151, 11, 150.00, 0, 0.00, 17, 0, 0, 0, 750.00, 0.00, 0.00, 5, NULL, 0.00, '2021-12-30', NULL, '103.115.128.58', 1),
(176, 11, 80, 15, 290.00, 0, 0.00, 17, 0, 0, 0, 290.00, 0.00, 0.00, 1, NULL, 0.00, '2021-12-30', NULL, '103.115.128.58', 1),
(177, 16, 157, 12, 100.00, 0, 0.00, 17, 0, 0, 0, 5756.00, 0.00, 0.00, 57.56, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(178, 16, 158, 0, 100.00, 0, 0.00, 17, 0, 0, 0, 4908.00, 0.00, 0.00, 49.08, NULL, 0.00, '2022-01-02', '2022-01-02', '103.115.128.58', 1),
(179, 16, 159, 0, 100.00, 0, 0.00, 17, 0, 0, 0, 5344.00, 0.00, 0.00, 53.44, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(180, 16, 160, 0, 110.00, 0, 0.00, 17, 0, 0, 0, 6105.00, 0.00, 0.00, 55.5, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(181, 16, 48, 13, 250.00, 0, 0.00, 17, 0, 0, 0, 7500.00, 0.00, 0.00, 30, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(182, 16, 47, 13, 250.00, 0, 0.00, 17, 0, 0, 0, 7500.00, 0.00, 0.00, 30, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(183, 16, 50, 0, 250.00, 0, 0.00, 17, 0, 0, 0, 2500.00, 0.00, 0.00, 10, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(184, 16, 49, 13, 250.00, 0, 0.00, 17, 0, 0, 0, 2500.00, 0.00, 0.00, 10, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(185, 16, 155, 13, 230.00, 0, 0.00, 17, 0, 0, 0, 6900.00, 0.00, 0.00, 30, NULL, 0.00, '2022-01-02', '2022-01-02', '103.115.128.58', 1),
(186, 16, 156, 13, 230.00, 0, 0.00, 17, 0, 0, 0, 11500.00, 0.00, 0.00, 50, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(187, 16, 80, 15, 560.00, 0, 0.00, 17, 0, 0, 0, 560.00, 0.00, 0.00, 1, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(188, 17, 148, 13, 660.00, 0, 0.00, 17, 0, 0, 0, 3300.00, 0.00, 0.00, 5, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(189, 17, 91, 13, 740.00, 0, 0.00, 17, 0, 0, 0, 6660.00, 0.00, 0.00, 9, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(190, 17, 104, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 15360.00, 0.00, 0.00, 32, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(191, 17, 108, 13, 480.00, 0, 0.00, 17, 0, 0, 0, 12000.00, 0.00, 0.00, 25, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(192, 17, 139, 12, 78.00, 0, 0.00, 17, 0, 0, 0, 12210.12, 0.00, 0.00, 156.54, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(193, 17, 161, 0, 38.00, 0, 0.00, 17, 0, 0, 0, 2280.00, 0.00, 0.00, 60, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(194, 17, 162, 0, 16.00, 0, 0.00, 17, 0, 0, 0, 960.00, 0.00, 0.00, 60, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(195, 17, 80, 15, 400.00, 0, 0.00, 17, 0, 0, 0, 400.00, 0.00, 0.00, 1, NULL, 0.00, '2022-01-02', NULL, '103.115.128.58', 1),
(196, 18, 163, 13, 195.00, 0, 0.00, 17, 0, 0, 0, 2925.00, 0.00, 0.00, 15, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(197, 18, 164, 13, 195.00, 0, 0.00, 17, 0, 0, 0, 5850.00, 0.00, 0.00, 30, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(198, 18, 165, 13, 195.00, 0, 0.00, 17, 0, 0, 0, 5850.00, 0.00, 0.00, 30, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(199, 18, 166, 13, 195.00, 0, 0.00, 17, 0, 0, 0, 2925.00, 0.00, 0.00, 15, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(201, 18, 167, 13, 195.00, 0, 0.00, 17, 0, 0, 0, 3900.00, 0.00, 0.00, 20, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(202, 18, 168, 13, 195.00, 0, 0.00, 17, 0, 0, 0, 3900.00, 0.00, 0.00, 20, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(203, 18, 169, 13, 195.00, 0, 0.00, 17, 0, 0, 0, 3900.00, 0.00, 0.00, 20, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(204, 18, 170, 13, 230.00, 0, 0.00, 17, 0, 0, 0, 4600.00, 0.00, 0.00, 20, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(205, 18, 171, 13, 195.00, 0, 0.00, 17, 0, 0, 0, 3900.00, 0.00, 0.00, 20, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(206, 18, 172, 13, 195.00, 0, 0.00, 17, 0, 0, 0, 3900.00, 0.00, 0.00, 20, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(207, 18, 174, 13, 195.00, 0, 0.00, 17, 0, 0, 0, 3900.00, 0.00, 0.00, 20, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(208, 18, 173, 13, 195.00, 0, 0.00, 17, 0, 0, 0, 3900.00, 0.00, 0.00, 20, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(209, 18, 80, 15, 375.00, 0, 0.00, 17, 0, 0, 0, 375.00, 0.00, 0.00, 1, NULL, 0.00, '2022-01-02', NULL, '47.247.200.115', 1),
(210, 0, 131, 13, 20.00, 20, 20.00, 13, 14, 14, 0, 409.60, 0.00, 0.00, 20, NULL, 0.00, '2022-03-14', NULL, '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pur_return`
--

CREATE TABLE `pur_return` (
  `pret_id` int(11) NOT NULL,
  `ret_date` date NOT NULL,
  `productid` int(11) NOT NULL,
  `ret_qty` float NOT NULL,
  `purchaseid` int(11) NOT NULL,
  `sessionid` int(11) NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saleentry`
--

CREATE TABLE `saleentry` (
  `saleid` int(11) NOT NULL,
  `compid` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `suppartyid` int(11) NOT NULL,
  `billno` varchar(100) NOT NULL,
  `consultancy_fees` float NOT NULL,
  `saledate` date NOT NULL,
  `receivername` varchar(100) NOT NULL,
  `billtype` varchar(100) NOT NULL,
  `disc` float NOT NULL,
  `order_no` varchar(50) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `round` float NOT NULL,
  `saletype` varchar(50) NOT NULL,
  `totalsale` float NOT NULL,
  `order_by` varchar(100) NOT NULL,
  `sessionid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saleentry`
--

INSERT INTO `saleentry` (`saleid`, `compid`, `branch_id`, `suppartyid`, `billno`, `consultancy_fees`, `saledate`, `receivername`, `billtype`, `disc`, `order_no`, `remark`, `round`, `saletype`, `totalsale`, `order_by`, `sessionid`, `createdby`, `ipaddress`, `lastupdated`, `createdate`) VALUES
(1089, 0, 0, 4, '00001', 0, '2021-12-04', '', 'Challan', 0, '', '', 0, 'Cash', 16000, 'gunja janakpur', 0, 1, '103.115.130.67', '0000-00-00', '2021-12-17'),
(1090, 0, 0, 5, '00002', 0, '2021-12-06', '', 'Challan', 100, '', '', 0, 'Cash', 16500, 'vishnu kesharwani', 0, 1, '103.115.130.67', '0000-00-00', '2021-12-17'),
(1091, 0, 0, 4, '00003', 0, '2021-12-07', '', 'Challan', 100, '', '', 0, 'Cash', 14020, '', 0, 1, '49.35.245.62', '0000-00-00', '2021-12-20'),
(1092, 0, 0, 5, '00004', 0, '2021-12-13', '', 'Challan', 200, '', '', 0, 'Cash', 12600, '', 0, 1, '49.35.245.62', '0000-00-00', '2021-12-20'),
(1093, 0, 0, 7, '00005', 0, '2021-12-14', '', 'Challan', 0, '', '', 0, 'Cash', 46720, '', 0, 1, '49.35.245.62', '0000-00-00', '2021-12-20'),
(1094, 0, 0, 14, '00006', 0, '2021-12-15', '', 'Challan', 200, '', '', 0, 'Cash', 71900, '', 0, 1, '49.35.245.62', '0000-00-00', '2021-12-20'),
(1095, 0, 0, 15, '00007', 0, '2021-12-16', '', 'Challan', 200, '', '', 0, 'Cash', 23300, 'NAVIN', 0, 1, '49.35.245.62', '0000-00-00', '2021-12-20'),
(1096, 0, 0, 16, '00008', 0, '2021-12-17', '', 'Challan', 200, '', '', 0, 'Cash', 17600, '', 0, 1, '49.35.245.62', '0000-00-00', '2021-12-20'),
(1097, 0, 0, 5, '00009', 0, '2021-12-17', '', 'Challan', 200, '', '', 0, 'Cash', 13950, '', 0, 1, '49.35.245.62', '0000-00-00', '2021-12-20'),
(1098, 0, 0, 12, '00010', 0, '2021-12-20', '', 'Challan', 200, '', '', 0, 'Cash', 31700, '', 0, 1, '49.35.245.62', '0000-00-00', '2021-12-20'),
(1099, 0, 0, 15, '00011', 0, '2021-12-20', '', 'Challan', 100, '', '', 0, 'Cash', 15840, '', 0, 1, '49.35.251.232', '0000-00-00', '2021-12-21'),
(1100, 0, 0, 13, '00012', 0, '2021-12-21', '', 'Challan', 150, '', '', 0, 'Cash', 8150, '', 0, 1, '49.35.251.232', '0000-00-00', '2021-12-21'),
(1101, 0, 0, 18, '00013', 0, '2021-12-21', '', 'Challan', 500, '', '', 0, 'Cash', 35150, '', 0, 1, '106.76.242.148', '0000-00-00', '2021-12-21'),
(1102, 0, 0, 4, '00014', 0, '2021-12-22', '', 'Challan', 0, '', '', 0, 'Cash', 700, '', 0, 1, '106.76.242.230', '0000-00-00', '2021-12-22'),
(1103, 0, 0, 19, '00015', 0, '2021-12-21', '', 'Challan', 100, '', '', 0, 'Cash', 3500, '', 0, 1, '49.35.181.201', '0000-00-00', '2021-12-22'),
(1104, 0, 0, 20, '00016', 0, '2021-12-22', '', 'Challan', 100, '', '', 0, 'Cash', 4860, '', 0, 1, '49.35.181.201', '0000-00-00', '2021-12-22'),
(1105, 0, 0, 16, '00017', 0, '2021-12-21', '', 'Challan', 0, '', '', 0, 'Cash', 2520, '', 0, 1, '49.35.181.201', '0000-00-00', '2021-12-22'),
(1106, 0, 0, 5, '00018', 0, '2021-12-21', '', 'Challan', 0, '', '', 0, 'Cash', 3000, '', 0, 1, '49.35.181.201', '0000-00-00', '2021-12-22'),
(1107, 0, 0, 10, '00019', 0, '2021-12-20', '', 'Challan', 500, '', '', 0, 'Cash', 49610, '', 0, 1, '49.35.181.201', '0000-00-00', '2021-12-22'),
(1108, 0, 0, 11, '00020', 0, '2021-12-21', '', 'Challan', 500, '', '', 0, 'Cash', 43210, '', 0, 1, '47.247.200.115', '2022-01-02', '2021-12-22'),
(1109, 0, 0, 7, '00021', 0, '2021-12-23', '', 'Challan', 700, '', '', 0, 'Cash', 15750, '', 0, 1, '27.62.206.171', '2021-12-25', '2021-12-23'),
(1110, 0, 0, 23, '00022', 0, '2021-12-23', '', 'Challan', 0, '', '', 0, 'Cash', 14070, '', 0, 1, '106.76.242.46', '0000-00-00', '2021-12-23'),
(1111, 0, 0, 22, '00023', 0, '2021-12-23', '', 'Challan', 0, '', '', 0, 'Cash', 10050, '', 0, 1, '103.115.128.58', '0000-00-00', '2021-12-23'),
(1112, 0, 0, 11, '00024', 0, '2021-12-24', '', 'Challan', 200, '', '', 0, 'Cash', 9700, '', 0, 1, '49.35.175.135', '0000-00-00', '2021-12-24'),
(1113, 0, 0, 16, '00025', 0, '2021-12-23', '', 'Challan', 100, '', '', 0, 'Cash', 4450, '', 0, 1, '49.35.175.135', '0000-00-00', '2021-12-24'),
(1114, 0, 0, 16, '00026', 0, '2021-12-25', '', 'Challan', 0, '', '', 0, 'Cash', 100, '', 0, 1, '103.115.128.58', '0000-00-00', '2021-12-25'),
(1115, 0, 0, 4, '00027', 0, '2021-12-25', '', 'Challan', 0, '', '', 0, 'Cash', 700, '', 0, 1, '103.115.128.58', '0000-00-00', '2021-12-25'),
(1118, 0, 0, 24, '00030', 0, '2021-12-28', '', 'Challan', 60, '', '', 0, 'Cash', 23500, '', 0, 1, '47.247.213.20', '2021-12-31', '2021-12-28'),
(1119, 0, 0, 10, '00031', 0, '2021-12-28', '', 'Challan', 100, '', '', 0, 'Cash', 17860, '', 0, 1, '47.247.195.36', '0000-00-00', '2021-12-28'),
(1120, 0, 0, 16, '00032', 0, '2021-12-28', '', 'Challan', 0, '', '', 0, 'Cash', 1160, '', 0, 1, '47.247.204.204', '0000-00-00', '2021-12-29'),
(1121, 0, 0, 19, '00033', 0, '2021-12-30', '', 'Challan', 0, '', '', 0, 'Cash', 1360, '', 0, 1, '103.115.128.58', '0000-00-00', '2021-12-30'),
(1122, 0, 0, 23, '00034', 0, '2021-12-31', '', 'Challan', 300, '', '', 0, 'Cash', 57230, '', 0, 1, '47.247.213.20', '0000-00-00', '2021-12-31'),
(1123, 0, 0, 25, '00035', 0, '2021-12-31', '', 'Challan', 180, '', '', 0, 'Cash', 57320, '', 0, 1, '47.247.213.20', '2021-12-31', '2021-12-31'),
(1124, 0, 0, 20, '00036', 0, '2021-12-31', '', 'Challan', 140, '', '', 0, 'Cash', 26400, '', 0, 1, '47.247.213.20', '0000-00-00', '2021-12-31'),
(1125, 0, 0, 12, '00037', 0, '2021-12-31', '', 'Challan', 0, '', '', 0, 'Cash', 1400, '', 0, 1, '47.247.213.20', '0000-00-00', '2021-12-31'),
(1126, 0, 0, 5, '00038', 0, '2021-12-31', '', 'Challan', 100, '', '', 0, 'Cash', 8200, '', 0, 1, '47.247.213.20', '0000-00-00', '2021-12-31'),
(1127, 0, 0, 26, '00039', 0, '2021-12-31', '', 'Challan', 0, '', '', 0, 'Cash', 9300, '', 0, 1, '47.247.213.20', '0000-00-00', '2021-12-31'),
(1128, 0, 0, 15, '00040', 0, '2021-12-31', '', 'Challan', 100, '', '', 0, 'Cash', 5600, '', 0, 1, '47.247.213.20', '0000-00-00', '2021-12-31'),
(1129, 0, 0, 11, '00041', 0, '2022-01-02', '', 'Challan', 200, '', '', 0, 'Credit', 14200, '', 0, 1, '47.247.200.115', '0000-00-00', '2022-01-02'),
(1131, 0, 0, 4, '00042', 0, '2022-01-03', '', 'Invoice', 20, '', 'Rahul', 0, '', 188, 'Tikam', 0, 1, '::1', '0000-00-00', '2022-01-03'),
(1132, 0, 0, 19, '00043', 0, '2022-01-03', '', 'Invoice', 20, '', '', 0, '', 240, 'yyy', 0, 1, '::1', '0000-00-00', '2022-01-03'),
(1133, 0, 0, 24, '00044', 0, '2022-01-03', '', 'Invoice', 85, '', '', 0, '', 86, 'oooo', 0, 1, '::1', '0000-00-00', '2022-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `saleentry_detail`
--

CREATE TABLE `saleentry_detail` (
  `saledetail_id` int(11) NOT NULL,
  `saleid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `unitid` int(11) NOT NULL,
  `qty` float NOT NULL,
  `rate` float NOT NULL,
  `disc_per` float NOT NULL,
  `tax` float NOT NULL,
  `tax_id` int(11) NOT NULL,
  `cgst` float NOT NULL,
  `sgst` float NOT NULL,
  `igst` float NOT NULL,
  `vat` float NOT NULL,
  `mrp` float NOT NULL,
  `qtycase` float NOT NULL,
  `sale_unit` varchar(50) NOT NULL,
  `totalval` float NOT NULL,
  `createdate` date NOT NULL,
  `lastupdated` date NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saleentry_detail`
--

INSERT INTO `saleentry_detail` (`saledetail_id`, `saleid`, `productid`, `unitid`, `qty`, `rate`, `disc_per`, `tax`, `tax_id`, `cgst`, `sgst`, `igst`, `vat`, `mrp`, `qtycase`, `sale_unit`, `totalval`, `createdate`, `lastupdated`, `ipaddress`, `createdby`) VALUES
(9, 1089, 76, 13, 25, 640, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 16000, '2021-12-17', '0000-00-00', '103.115.130.67', 1),
(10, 1090, 19, 13, 14, 800, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 11200, '2021-12-17', '0000-00-00', '103.115.130.67', 1),
(11, 1090, 20, 13, 3, 800, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2400, '2021-12-17', '0000-00-00', '103.115.130.67', 1),
(12, 1090, 69, 8, 8, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2800, '2021-12-17', '0000-00-00', '103.115.130.67', 1),
(21, 1091, 135, 11, 16, 550, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 8800, '2021-12-20', '0000-00-00', '103.115.128.58', 1),
(23, 1091, 76, 13, 8, 640, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 5120, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(25, 1092, 9, 13, 12, 800, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 9600, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(26, 1092, 43, 13, 8, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2800, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(27, 1093, 71, 13, 20, 640, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 12800, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(28, 1093, 73, 13, 53, 640, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 33920, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(29, 1094, 12, 13, 38, 840, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 31920, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(30, 1094, 7, 13, 30, 750, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 22500, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(31, 1094, 100, 13, 18, 560, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 10080, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(32, 1094, 70, 13, 10, 720, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 7200, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(33, 1095, 105, 13, 42, 550, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 23100, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(34, 1096, 25, 13, 60, 290, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 17400, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(35, 1097, 9, 13, 2, 800, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1600, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(36, 1097, 116, 13, 3, 850, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2550, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(37, 1097, 6, 13, 12, 800, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 9600, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(38, 1098, 93, 13, 28, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 25200, '2021-12-20', '2021-12-20', '49.35.245.62', 1),
(39, 1098, 43, 13, 12, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 4200, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(40, 1098, 69, 8, 6, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2100, '2021-12-20', '0000-00-00', '49.35.245.62', 1),
(41, 1099, 55, 13, 6, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1920, '2021-12-20', '0000-00-00', '103.115.128.58', 1),
(42, 1099, 56, 13, 9, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2880, '2021-12-20', '0000-00-00', '103.115.128.58', 1),
(43, 1099, 57, 13, 6, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1920, '2021-12-20', '0000-00-00', '103.115.128.58', 1),
(44, 1099, 58, 13, 7, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2240, '2021-12-20', '0000-00-00', '103.115.128.58', 1),
(45, 1099, 105, 13, 10, 550, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 5500, '2021-12-20', '0000-00-00', '103.115.128.58', 1),
(46, 1099, 51, 13, 2, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 640, '2021-12-20', '2021-12-21', '49.35.251.232', 1),
(47, 1099, 52, 13, 1, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 320, '2021-12-20', '2021-12-21', '49.35.251.232', 1),
(48, 1099, 53, 13, 1, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 320, '2021-12-21', '0000-00-00', '49.35.251.232', 1),
(49, 1100, 55, 13, 8, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2560, '2021-12-21', '0000-00-00', '49.35.251.232', 1),
(50, 1100, 57, 13, 6, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1920, '2021-12-21', '0000-00-00', '49.35.251.232', 1),
(51, 1100, 56, 13, 6, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1920, '2021-12-21', '2021-12-21', '49.35.251.232', 1),
(52, 1100, 58, 13, 5, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1600, '2021-12-21', '0000-00-00', '49.35.251.232', 1),
(57, 1101, 44, 13, 10, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 3500, '2021-12-21', '0000-00-00', '106.76.242.148', 1),
(58, 1101, 45, 13, 10, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 3500, '2021-12-21', '0000-00-00', '106.76.242.148', 1),
(59, 1101, 46, 13, 10, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 3500, '2021-12-21', '0000-00-00', '106.76.242.148', 1),
(60, 1101, 65, 13, 21, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 7350, '2021-12-21', '0000-00-00', '106.76.242.148', 1),
(61, 1101, 67, 13, 14, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 4900, '2021-12-21', '0000-00-00', '106.76.242.148', 1),
(62, 1101, 66, 13, 14, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 4900, '2021-12-21', '0000-00-00', '106.76.242.148', 1),
(63, 1101, 68, 13, 12, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 4200, '2021-12-21', '0000-00-00', '106.76.242.148', 1),
(64, 1101, 23, 13, 4, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1400, '2021-12-21', '0000-00-00', '106.76.242.148', 1),
(65, 1101, 24, 13, 4, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1400, '2021-12-21', '0000-00-00', '106.76.242.148', 1),
(66, 1102, 69, 8, 2, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 700, '2021-12-22', '0000-00-00', '106.76.242.230', 1),
(67, 1103, 33, 13, 10, 340, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 3400, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(68, 1104, 136, 13, 14, 340, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 4760, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(69, 1105, 25, 13, 8, 290, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2320, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(70, 1105, 88, 8, 2, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 200, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(71, 1106, 69, 8, 4, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1400, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(72, 1106, 6, 13, 1, 800, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 800, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(73, 1106, 20, 13, 1, 800, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 800, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(74, 1107, 105, 13, 10, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 6000, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(75, 1107, 71, 13, 18, 720, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 12960, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(76, 1107, 48, 13, 5, 330, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1650, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(77, 1107, 47, 13, 7, 330, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2310, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(78, 1107, 49, 13, 3, 330, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 990, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(79, 1107, 50, 13, 3, 330, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 990, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(80, 1107, 64, 13, 6, 330, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1980, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(81, 1107, 25, 13, 45, 340, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 15300, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(82, 1107, 56, 13, 6, 330, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1980, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(83, 1107, 55, 13, 9, 330, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2970, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(84, 1107, 57, 13, 6, 330, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1980, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(86, 1108, 72, 13, 45, 730, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 32850, '2021-12-22', '2022-01-02', '47.247.200.115', 1),
(87, 1108, 25, 13, 24, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 8400, '2021-12-22', '2022-01-02', '47.247.200.115', 1),
(88, 1108, 70, 13, 2, 730, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1460, '2021-12-22', '0000-00-00', '49.35.181.201', 1),
(89, 1109, 52, 13, 3, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 900, '2021-12-23', '0000-00-00', '103.115.128.58', 1),
(90, 1109, 54, 13, 2, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 600, '2021-12-23', '0000-00-00', '103.115.128.58', 1),
(92, 1109, 71, 13, 14, 700, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 9800, '2021-12-23', '0000-00-00', '103.115.128.58', 1),
(93, 1109, 139, 12, 30, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 3000, '2021-12-23', '0000-00-00', '103.115.128.58', 1),
(95, 1110, 14, 13, 21, 670, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 14070, '2021-12-23', '0000-00-00', '106.76.242.46', 1),
(96, 1111, 70, 13, 15, 670, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 10050, '2021-12-23', '0000-00-00', '103.115.128.58', 1),
(97, 1112, 46, 13, 2, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 700, '2021-12-24', '0000-00-00', '49.35.175.135', 1),
(98, 1112, 44, 13, 2, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 700, '2021-12-24', '0000-00-00', '49.35.175.135', 1),
(99, 1112, 139, 12, 60, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 6000, '2021-12-24', '0000-00-00', '49.35.175.135', 1),
(100, 1112, 25, 13, 6, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2100, '2021-12-24', '0000-00-00', '49.35.175.135', 1),
(101, 1113, 25, 13, 15, 290, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 4350, '2021-12-24', '0000-00-00', '49.35.175.135', 1),
(103, 1109, 129, 13, 1, 750, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 750, '2021-12-25', '0000-00-00', '106.76.243.45', 1),
(104, 1114, 88, 8, 1, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 100, '2021-12-25', '0000-00-00', '103.115.128.58', 1),
(105, 1115, 69, 8, 2, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 700, '2021-12-25', '0000-00-00', '103.115.128.58', 1),
(107, 1118, 47, 13, 4, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1280, '2021-12-28', '0000-00-00', '103.115.128.58', 1),
(108, 1118, 48, 13, 6, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1920, '2021-12-28', '0000-00-00', '103.115.128.58', 1),
(109, 1118, 49, 13, 6, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1920, '2021-12-28', '0000-00-00', '103.115.128.58', 1),
(110, 1118, 50, 13, 6, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1920, '2021-12-28', '0000-00-00', '103.115.128.58', 1),
(111, 1118, 64, 13, 6, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1920, '2021-12-28', '0000-00-00', '103.115.128.58', 1),
(112, 1118, 140, 13, 2, 270, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 540, '2021-12-28', '0000-00-00', '103.115.128.58', 1),
(113, 1118, 141, 13, 2, 270, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 540, '2021-12-28', '0000-00-00', '103.115.128.58', 1),
(114, 1118, 142, 13, 2, 270, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 540, '2021-12-28', '0000-00-00', '103.115.128.58', 1),
(115, 1118, 17, 13, 6, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 3600, '2021-12-28', '0000-00-00', '103.115.128.58', 1),
(116, 1118, 144, 13, 10, 285, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2850, '2021-12-28', '0000-00-00', '103.115.128.58', 1),
(117, 1118, 145, 13, 2, 285, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 570, '2021-12-28', '0000-00-00', '103.115.128.58', 1),
(118, 1118, 32, 11, 20, 35, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 700, '2021-12-28', '0000-00-00', '47.247.195.36', 1),
(119, 1118, 139, 12, 30, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 3000, '2021-12-28', '0000-00-00', '47.247.195.36', 1),
(120, 1118, 88, 8, 3, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 150, '2021-12-28', '0000-00-00', '47.247.195.36', 1),
(121, 1118, 69, 8, 1, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 350, '2021-12-28', '0000-00-00', '47.247.195.36', 1),
(122, 1119, 148, 13, 22, 740, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 16280, '2021-12-28', '0000-00-00', '47.247.195.36', 1),
(123, 1119, 70, 13, 2, 740, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1480, '2021-12-28', '0000-00-00', '47.247.195.36', 1),
(124, 1120, 25, 13, 4, 290, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1160, '2021-12-29', '0000-00-00', '47.247.204.204', 1),
(125, 1121, 33, 13, 4, 340, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1360, '2021-12-30', '0000-00-00', '103.115.128.58', 1),
(128, 1122, 140, 13, 6, 280, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1680, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(129, 1122, 141, 13, 6, 280, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1680, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(130, 1122, 142, 13, 6, 280, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1680, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(131, 1122, 51, 13, 6, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1800, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(132, 1122, 53, 13, 4, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1200, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(133, 1122, 54, 13, 4, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1200, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(134, 1122, 52, 13, 4, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1200, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(135, 1122, 134, 11, 20, 500, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 10000, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(136, 1122, 139, 12, 63.89, 95, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 6069.55, '2021-12-31', '2021-12-31', '47.247.213.20', 1),
(137, 1122, 108, 13, 10, 560, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 5600, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(138, 1122, 104, 13, 32, 560, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 17920, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(139, 1122, 56, 13, 7, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2100, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(140, 1122, 55, 13, 7, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2100, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(141, 1122, 57, 13, 7, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2100, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(142, 1122, 153, 11, 10, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 600, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(143, 1118, 151, 11, 1, 150, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 150, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(144, 1118, 153, 11, 2, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 140, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(146, 1118, 154, 0, 5, 270, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1350, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(147, 1123, 14, 13, 22, 650, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 14300, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(148, 1123, 123, 13, 36, 650, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 23400, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(149, 1123, 100, 13, 2, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1200, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(150, 1123, 70, 13, 2, 720, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1440, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(151, 1123, 156, 13, 14, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 4200, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(152, 1123, 48, 13, 12, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 3600, '2021-12-31', '2021-12-31', '47.247.213.20', 1),
(153, 1123, 47, 13, 18, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 5400, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(154, 1123, 49, 13, 6, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1800, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(155, 1123, 50, 13, 6, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1800, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(156, 1124, 18, 13, 20, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 12000, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(157, 1124, 60, 13, 5, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1600, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(158, 1124, 61, 13, 5, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1600, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(159, 1124, 59, 13, 5, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1600, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(160, 1124, 62, 13, 5, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1600, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(161, 1124, 155, 13, 6, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1920, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(162, 1124, 140, 13, 2, 285, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 570, '2021-12-31', '2021-12-31', '47.247.213.20', 1),
(163, 1124, 141, 13, 2, 285, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 570, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(164, 1124, 63, 13, 15, 320, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 4800, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(165, 1125, 66, 13, 4, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1400, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(166, 1126, 91, 13, 9, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 8100, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(167, 1127, 88, 8, 3, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 300, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(168, 1127, 108, 13, 14, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 8400, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(169, 1127, 32, 11, 15, 40, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 600, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(170, 1128, 105, 13, 10, 550, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 5500, '2021-12-31', '0000-00-00', '47.247.213.20', 1),
(171, 1129, 139, 12, 63, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 6300, '2022-01-02', '0000-00-00', '47.247.200.115', 1),
(172, 1129, 144, 13, 22, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 7700, '2022-01-02', '0000-00-00', '47.247.200.115', 1),
(174, 1131, 145, 13, 20, 10, 20, 5, 0, 0, 0, 0, 0, 0, 0, '', 168, '2022-01-03', '0000-00-00', '::1', 1),
(175, 1132, 155, 13, 20, 10, 2, 12, 0, 0, 0, 0, 0, 0, 0, '', 219.52, '2022-01-03', '0000-00-00', '::1', 1),
(176, 1133, 155, 13, 1, 1, 1, 5, 0, 0, 0, 0, 0, 0, 0, '', 1.0395, '2022-01-03', '0000-00-00', '::1', 1),
(177, 0, 78, 13, 4, 100, 50, 12, 0, 0, 0, 0, 0, 0, 0, '', 224, '2022-03-14', '0000-00-00', '::1', 1),
(178, 0, 138, 13, 2, 10, 10, 28, 0, 0, 0, 0, 0, 0, 0, '', 23.04, '2022-03-14', '0000-00-00', '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `salereturn`
--

CREATE TABLE `salereturn` (
  `sale_returnid` int(11) NOT NULL,
  `saleid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `ret_qty` float NOT NULL,
  `return_amt` float NOT NULL,
  `sale_retdate` date NOT NULL,
  `enable` varchar(20) NOT NULL,
  `sessionid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `lastupdated` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salereturn`
--

INSERT INTO `salereturn` (`sale_returnid`, `saleid`, `productid`, `ret_qty`, `return_amt`, `sale_retdate`, `enable`, `sessionid`, `createdby`, `ipaddress`, `lastupdated`, `createdate`) VALUES
(4, 1104, 136, 3, 0, '2021-12-23', '', 0, 1, '103.115.128.58', '0000-00-00', '2021-12-23'),
(10, 1108, 25, 23, 8050, '2022-01-02', '', 0, 1, '47.247.200.115', '0000-00-00', '2022-01-02'),
(11, 1108, 72, 2, 1460, '2022-01-02', '', 0, 1, '47.247.200.115', '0000-00-00', '2022-01-02'),
(14, 1090, 19, 5, 100, '2022-03-10', '', 0, 1, '::1', '0000-00-00', '2022-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `image`) VALUES
(1, 'DR. ABHIMANYU SAHU', 'admin@gmail.com', NULL, '$2y$10$Sv4xAO8m1RD0NcdQimf65Or99KcMkYB0RnvLlD6YT9DvHMrhFAx.C', NULL, NULL, NULL, '20210123083741.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activitylogreport`
--
ALTER TABLE `activitylogreport`
  ADD PRIMARY KEY (`actid`);

--
-- Indexes for table `billuser`
--
ALTER TABLE `billuser`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `checklogin`
--
ALTER TABLE `checklogin`
  ADD PRIMARY KEY (`loginid`);

--
-- Indexes for table `company_setting`
--
ALTER TABLE `company_setting`
  ADD PRIMARY KEY (`compid`);

--
-- Indexes for table `loginlogoutreport`
--
ALTER TABLE `loginlogoutreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_expence`
--
ALTER TABLE `master_expence`
  ADD PRIMARY KEY (`expencetypeid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_branch`
--
ALTER TABLE `m_branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `m_product`
--
ALTER TABLE `m_product`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `m_product_category`
--
ALTER TABLE `m_product_category`
  ADD PRIMARY KEY (`pcatid`);

--
-- Indexes for table `m_session`
--
ALTER TABLE `m_session`
  ADD PRIMARY KEY (`sessionid`);

--
-- Indexes for table `m_state`
--
ALTER TABLE `m_state`
  ADD PRIMARY KEY (`stateid`);

--
-- Indexes for table `m_supplier_party`
--
ALTER TABLE `m_supplier_party`
  ADD PRIMARY KEY (`suppartyid`);

--
-- Indexes for table `m_tax`
--
ALTER TABLE `m_tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `m_taxt_cat`
--
ALTER TABLE `m_taxt_cat`
  ADD PRIMARY KEY (`tax_cat_id`);

--
-- Indexes for table `m_unit`
--
ALTER TABLE `m_unit`
  ADD PRIMARY KEY (`unitid`);

--
-- Indexes for table `other_expense`
--
ALTER TABLE `other_expense`
  ADD PRIMARY KEY (`expenid`);

--
-- Indexes for table `other_income`
--
ALTER TABLE `other_income`
  ADD PRIMARY KEY (`incomid`);

--
-- Indexes for table `panel_expiry`
--
ALTER TABLE `panel_expiry`
  ADD PRIMARY KEY (`pexpiry_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payid`);

--
-- Indexes for table `purchaseentry`
--
ALTER TABLE `purchaseentry`
  ADD PRIMARY KEY (`purchaseid`);

--
-- Indexes for table `purchasentry_detail`
--
ALTER TABLE `purchasentry_detail`
  ADD PRIMARY KEY (`purdetail_id`),
  ADD KEY `fk_purchaseid` (`purchaseid`);

--
-- Indexes for table `pur_return`
--
ALTER TABLE `pur_return`
  ADD PRIMARY KEY (`pret_id`),
  ADD KEY `fk_purchaseid` (`purchaseid`);

--
-- Indexes for table `saleentry`
--
ALTER TABLE `saleentry`
  ADD PRIMARY KEY (`saleid`);

--
-- Indexes for table `saleentry_detail`
--
ALTER TABLE `saleentry_detail`
  ADD PRIMARY KEY (`saledetail_id`),
  ADD KEY `fk_saleid` (`saleid`);

--
-- Indexes for table `salereturn`
--
ALTER TABLE `salereturn`
  ADD PRIMARY KEY (`sale_returnid`),
  ADD KEY `saleid` (`saleid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activitylogreport`
--
ALTER TABLE `activitylogreport`
  MODIFY `actid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `billuser`
--
ALTER TABLE `billuser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_setting`
--
ALTER TABLE `company_setting`
  MODIFY `compid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loginlogoutreport`
--
ALTER TABLE `loginlogoutreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `master_expence`
--
ALTER TABLE `master_expence`
  MODIFY `expencetypeid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_branch`
--
ALTER TABLE `m_branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_product`
--
ALTER TABLE `m_product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `m_product_category`
--
ALTER TABLE `m_product_category`
  MODIFY `pcatid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `m_session`
--
ALTER TABLE `m_session`
  MODIFY `sessionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_state`
--
ALTER TABLE `m_state`
  MODIFY `stateid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_supplier_party`
--
ALTER TABLE `m_supplier_party`
  MODIFY `suppartyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `m_tax`
--
ALTER TABLE `m_tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `m_taxt_cat`
--
ALTER TABLE `m_taxt_cat`
  MODIFY `tax_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_unit`
--
ALTER TABLE `m_unit`
  MODIFY `unitid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `other_expense`
--
ALTER TABLE `other_expense`
  MODIFY `expenid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `other_income`
--
ALTER TABLE `other_income`
  MODIFY `incomid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `panel_expiry`
--
ALTER TABLE `panel_expiry`
  MODIFY `pexpiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `purchaseentry`
--
ALTER TABLE `purchaseentry`
  MODIFY `purchaseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `purchasentry_detail`
--
ALTER TABLE `purchasentry_detail`
  MODIFY `purdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `pur_return`
--
ALTER TABLE `pur_return`
  MODIFY `pret_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saleentry`
--
ALTER TABLE `saleentry`
  MODIFY `saleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1134;

--
-- AUTO_INCREMENT for table `saleentry_detail`
--
ALTER TABLE `saleentry_detail`
  MODIFY `saledetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `salereturn`
--
ALTER TABLE `salereturn`
  MODIFY `sale_returnid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `salereturn`
--
ALTER TABLE `salereturn`
  ADD CONSTRAINT `salereturn_ibfk_1` FOREIGN KEY (`saleid`) REFERENCES `saleentry` (`saleid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
