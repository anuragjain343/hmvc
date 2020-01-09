-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2019 at 06:52 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MyVeganTrainer`
--

-- --------------------------------------------------------

--
-- Table structure for table `answerLike`
--

CREATE TABLE `answerLike` (
  `id` int(11) NOT NULL,
  `answerId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answerLike`
--

INSERT INTO `answerLike` (`id`, `answerId`, `userId`, `crd`, `upd`, `status`) VALUES
(2, 20, 304, '2019-03-09 03:45:45', '2019-03-09 03:45:45', 1),
(4, 13, 304, '2019-03-09 03:46:07', '2019-03-09 03:46:07', 1),
(6, 12, 304, '2019-03-09 03:46:30', '2019-03-09 03:46:30', 1),
(7, 22, 304, '2019-03-09 03:52:15', '2019-03-09 03:52:15', 1),
(9, 27, 304, '2019-03-09 03:53:32', '2019-03-09 03:53:32', 1),
(10, 20, 310, '2019-03-09 04:28:35', '2019-03-09 04:28:35', 1),
(11, 29, 310, '2019-03-09 04:40:44', '2019-03-09 04:40:44', 1),
(12, 30, 310, '2019-03-09 04:41:34', '2019-03-09 04:41:34', 1),
(19, 32, 310, '2019-03-09 04:50:02', '2019-03-09 04:50:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `addedBy` varchar(50) NOT NULL COMMENT 'added by- admin ,trainer',
  `addedById` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  `isDisableComment` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `description`, `addedBy`, `addedById`, `crd`, `upd`, `status`, `isDisableComment`) VALUES
(6, 'this  is  my  artivl', '<p>t only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>', 'admin', 1, '2019-02-12 08:16:22', '2019-02-22 09:03:04', 0, 0),
(36, 'dsadsad asd sad', '<p>xcxzcxzczc</p>', 'admin', 1, '2019-03-07 06:50:59', '2019-03-07 06:50:59', 0, 0),
(39, 'DSFDSFSDFSD', '<p>fdsdfdsfsdfsdf sdfsdf</p>', 'trainer', 301, '2019-03-07 07:04:34', '2019-03-07 07:04:34', 0, 0),
(40, 'sdfsdf', '<p>sdfsdf</p>', 'admin', 1, '2019-03-09 00:58:44', '2019-03-09 00:58:44', 0, 0),
(41, 'gdffdgdf', '<p>gdfgfdg</p>', 'admin', 1, '2019-03-09 00:59:37', '2019-03-09 00:59:37', 0, 0),
(47, 'hffhgh', '<p>dfdf</p>', 'trainer', 303, '2019-03-09 07:44:25', '2019-03-09 07:44:25', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `articleAnswer`
--

CREATE TABLE `articleAnswer` (
  `id` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `answerBy` varchar(20) NOT NULL,
  `answerById` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `isDisable` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articleAnswer`
--

INSERT INTO `articleAnswer` (`id`, `articleId`, `answer`, `answerBy`, `answerById`, `crd`, `upd`, `status`, `isDisable`) VALUES
(112, 36, 'kjkh', 'user', 304, '2019-03-09 00:14:20', '2019-03-09 00:14:20', 1, 0),
(113, 41, 'hfghfhg', 'user', 304, '2019-03-09 01:47:19', '2019-03-09 01:47:19', 1, 0),
(114, 36, 'sdfsdfsf', 'user', 304, '2019-03-09 03:57:04', '2019-03-09 03:57:04', 1, 0),
(115, 41, 'ssgfdgdg', 'user', 304, '2019-03-09 04:15:25', '2019-03-09 04:15:25', 1, 0),
(116, 41, 'dfdf33', 'user', 304, '2019-03-11 03:37:53', '2019-03-11 03:37:53', 1, 0),
(117, 41, 'nhnhnhn56', 'user', 304, '2019-03-11 03:39:40', '2019-03-11 03:39:40', 1, 0),
(118, 41, 'nhnhnanurag', 'user', 304, '2019-03-11 03:39:50', '2019-03-11 03:39:50', 1, 0),
(119, 41, 'bre', 'user', 304, '2019-03-11 03:40:08', '2019-03-11 03:40:08', 1, 0),
(120, 41, 'dfsd sdfsdfds sdfsdf ssdfsd sdf', 'user', 304, '2019-03-11 03:40:47', '2019-03-11 03:40:47', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `articleAnswerLike`
--

CREATE TABLE `articleAnswerLike` (
  `id` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `answerId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articleAnswerLike`
--

INSERT INTO `articleAnswerLike` (`id`, `articleId`, `answerId`, `userId`, `crd`, `upd`, `status`) VALUES
(20, 13, 46, 272, '2019-02-18 02:56:34', '2019-02-18 02:56:34', 1),
(24, 15, 74, 272, '2019-02-19 03:51:17', '2019-02-19 03:51:17', 1),
(34, 15, 62, 272, '2019-02-19 04:09:51', '2019-02-19 04:09:51', 1),
(36, 15, 61, 272, '2019-02-19 04:09:54', '2019-02-19 04:09:54', 1),
(39, 11, 1, 272, '2019-02-19 04:13:20', '2019-02-19 04:13:20', 1),
(74, 33, 96, 1, '2019-02-23 02:13:59', '2019-02-23 02:13:59', 1),
(75, 16, 97, 1, '2019-02-23 02:14:06', '2019-02-23 02:14:06', 1),
(76, 16, 39, 1, '2019-02-23 02:14:07', '2019-02-23 02:14:07', 1),
(77, 16, 38, 1, '2019-02-23 02:14:11', '2019-02-23 02:14:11', 1),
(78, 34, 99, 239, '2019-02-23 02:46:06', '2019-02-23 02:46:06', 1),
(147, 11, 110, 304, '2019-03-06 08:01:37', '2019-03-06 08:01:37', 1),
(151, 11, 1, 304, '2019-03-06 08:02:43', '2019-03-06 08:02:43', 1),
(155, 36, 112, 1, '2019-03-09 01:38:27', '2019-03-09 01:38:27', 1),
(158, 41, 113, 304, '2019-03-09 03:09:09', '2019-03-09 03:09:09', 1),
(159, 36, 112, 304, '2019-03-09 03:55:42', '2019-03-09 03:55:42', 1),
(160, 36, 114, 304, '2019-03-09 03:57:07', '2019-03-09 03:57:07', 1),
(164, 33, 95, 304, '2019-03-09 04:12:47', '2019-03-09 04:12:47', 1),
(165, 33, 96, 304, '2019-03-09 04:12:56', '2019-03-09 04:12:56', 1),
(166, 33, 98, 304, '2019-03-09 04:13:00', '2019-03-09 04:13:00', 1),
(174, 42, 116, 304, '2019-03-09 04:27:51', '2019-03-09 04:27:51', 1),
(192, 16, 97, 304, '2019-03-09 05:52:42', '2019-03-09 05:52:42', 1),
(197, 16, 97, 310, '2019-03-09 05:54:39', '2019-03-09 05:54:39', 1),
(210, 33, 96, 310, '2019-03-09 05:58:59', '2019-03-09 05:58:59', 1),
(213, 33, 95, 310, '2019-03-09 05:59:03', '2019-03-09 05:59:03', 1),
(215, 42, 116, 310, '2019-03-09 06:00:33', '2019-03-09 06:00:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `articleLike`
--

CREATE TABLE `articleLike` (
  `id` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articleLike`
--

INSERT INTO `articleLike` (`id`, `articleId`, `userId`, `crd`, `upd`, `status`) VALUES
(5, 13, 272, '2019-02-15 07:32:24', '2019-02-15 07:32:24', 1),
(231, 16, 269, '2019-02-16 05:39:24', '2019-02-16 05:39:24', 1),
(233, 16, 262, '2019-02-16 05:40:28', '2019-02-16 05:40:28', 1),
(235, 16, 278, '2019-02-16 05:41:42', '2019-02-16 05:41:42', 1),
(248, 11, 272, '2019-02-19 04:13:40', '2019-02-19 04:13:40', 1),
(250, 10, 272, '2019-02-19 04:16:33', '2019-02-19 04:16:33', 1),
(252, 15, 272, '2019-02-19 05:35:03', '2019-02-19 05:35:03', 1),
(253, 16, 272, '2019-02-19 07:46:43', '2019-02-19 07:46:43', 1),
(254, 22, 281, '2019-02-21 08:08:15', '2019-02-21 08:08:15', 1),
(259, 11, 1, '2019-02-23 00:54:16', '2019-02-23 00:54:16', 1),
(268, 33, 1, '2019-02-23 01:05:44', '2019-02-23 01:05:44', 1),
(270, 24, 253, '2019-02-23 02:44:40', '2019-02-23 02:44:40', 1),
(271, 34, 239, '2019-02-23 02:46:07', '2019-02-23 02:46:07', 1),
(320, 35, 304, '2019-03-06 04:45:52', '2019-03-06 04:45:52', 1),
(412, 37, 304, '2019-03-06 07:28:47', '2019-03-06 07:28:47', 1),
(413, 15, 304, '2019-03-06 07:29:04', '2019-03-06 07:29:04', 1),
(424, 11, 304, '2019-03-08 05:56:09', '2019-03-08 05:56:09', 1),
(430, 41, 304, '2019-03-09 02:00:26', '2019-03-09 02:00:26', 1),
(450, 35, 310, '2019-03-09 04:33:05', '2019-03-09 04:33:05', 1),
(457, 16, 304, '2019-03-09 05:50:15', '2019-03-09 05:50:15', 1),
(473, 33, 310, '2019-03-09 05:59:08', '2019-03-09 05:59:08', 1),
(475, 42, 310, '2019-03-09 06:00:26', '2019-03-09 06:00:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `articleView`
--

CREATE TABLE `articleView` (
  `id` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articleView`
--

INSERT INTO `articleView` (`id`, `articleId`, `userId`, `crd`, `upd`, `status`) VALUES
(1, 16, 272, '2019-02-16 03:20:23', '2019-02-16 03:20:23', 1),
(2, 16, 265, '2019-02-16 03:26:51', '2019-02-16 03:26:51', 1),
(3, 16, 269, '2019-02-16 04:48:06', '2019-02-16 04:48:06', 1),
(4, 16, 262, '2019-02-16 05:40:13', '2019-02-16 05:40:13', 1),
(5, 16, 278, '2019-02-16 05:41:30', '2019-02-16 05:41:30', 1),
(6, 15, 272, '2019-02-18 00:01:46', '2019-02-18 00:01:46', 1),
(7, 11, 272, '2019-02-18 00:17:55', '2019-02-18 00:17:55', 1),
(8, 13, 272, '2019-02-18 02:03:28', '2019-02-18 02:03:28', 1),
(9, 10, 272, '2019-02-18 02:03:34', '2019-02-18 02:03:34', 1),
(10, 6, 272, '2019-02-18 02:03:41', '2019-02-18 02:03:41', 1),
(11, 15, 275, '2019-02-18 05:06:02', '2019-02-18 05:06:02', 1),
(12, 13, 279, '2019-02-20 03:27:44', '2019-02-20 03:27:44', 1),
(13, 15, 279, '2019-02-20 04:07:55', '2019-02-20 04:07:55', 1),
(14, 10, 279, '2019-02-20 05:38:59', '2019-02-20 05:38:59', 1),
(15, 16, 281, '2019-02-21 08:06:48', '2019-02-21 08:06:48', 1),
(16, 22, 281, '2019-02-21 08:08:12', '2019-02-21 08:08:12', 1),
(17, 10, 282, '2019-02-22 04:16:07', '2019-02-22 04:16:07', 1),
(18, 33, 272, '2019-02-22 23:58:31', '2019-02-22 23:58:31', 1),
(19, 24, 283, '2019-02-23 00:09:12', '2019-02-23 00:09:12', 1),
(20, 33, 283, '2019-02-23 00:09:29', '2019-02-23 00:09:29', 1),
(21, 10, 283, '2019-02-23 00:15:33', '2019-02-23 00:15:33', 1),
(22, 32, 283, '2019-02-23 00:17:41', '2019-02-23 00:17:41', 1),
(23, 6, 283, '2019-02-23 00:17:54', '2019-02-23 00:17:54', 1),
(24, 37, 272, '2019-02-27 00:14:04', '2019-02-27 00:14:04', 1),
(25, 37, 304, '2019-02-27 23:29:47', '2019-02-27 23:29:47', 1),
(26, 11, 304, '2019-03-05 00:27:11', '2019-03-05 00:27:11', 1),
(27, 37, 309, '2019-03-05 07:51:19', '2019-03-05 07:51:19', 1),
(28, 36, 309, '2019-03-05 07:51:48', '2019-03-05 07:51:48', 1),
(29, 35, 304, '2019-03-06 04:26:34', '2019-03-06 04:26:34', 1),
(30, 6, 304, '2019-03-06 04:47:03', '2019-03-06 04:47:03', 1),
(31, 36, 304, '2019-03-06 05:00:34', '2019-03-06 05:00:34', 1),
(32, 33, 304, '2019-03-06 05:00:58', '2019-03-06 05:00:58', 1),
(33, 16, 304, '2019-03-06 05:04:10', '2019-03-06 05:04:10', 1),
(34, 15, 304, '2019-03-06 07:29:01', '2019-03-06 07:29:01', 1),
(35, 10, 304, '2019-03-06 07:54:04', '2019-03-06 07:54:04', 1),
(36, 16, 309, '2019-03-06 23:29:41', '2019-03-06 23:29:41', 1),
(37, 37, 311, '2019-03-07 03:01:59', '2019-03-07 03:01:59', 1),
(38, 13, 304, '2019-03-09 00:16:13', '2019-03-09 00:16:13', 1),
(39, 41, 304, '2019-03-09 01:47:05', '2019-03-09 01:47:05', 1),
(40, 42, 304, '2019-03-09 04:16:19', '2019-03-09 04:16:19', 1),
(41, 42, 310, '2019-03-09 04:32:55', '2019-03-09 04:32:55', 1),
(42, 35, 310, '2019-03-09 04:33:04', '2019-03-09 04:33:04', 1),
(43, 41, 310, '2019-03-09 04:41:51', '2019-03-09 04:41:51', 1),
(44, 16, 310, '2019-03-09 05:53:08', '2019-03-09 05:53:08', 1),
(45, 40, 310, '2019-03-09 05:57:53', '2019-03-09 05:57:53', 1),
(46, 33, 310, '2019-03-09 05:58:04', '2019-03-09 05:58:04', 1),
(47, 40, 309, '2019-03-11 05:21:13', '2019-03-11 05:21:13', 1),
(48, 41, 308, '2019-03-11 05:38:45', '2019-03-11 05:38:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `addedBy` varchar(50) NOT NULL COMMENT 'added by- admin ,trainer',
  `addedById` int(11) NOT NULL COMMENT 'admin id,trainer id',
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `title`, `description`, `addedBy`, `addedById`, `crd`, `upd`, `status`) VALUES
(19, 'dfsdfsdf', 'fsdfdsfdsf', 'admin', 1, '2019-02-25 00:59:57', '2019-02-25 00:59:57', 1),
(20, 'fnysdfsdf', 'fd nfgnd', 'admin', 1, '2019-02-25 01:02:08', '2019-02-25 01:02:08', 1),
(21, 'hjghjg', 'ghjghjghj', 'admin', 1, '2019-02-25 01:10:28', '2019-02-25 01:10:28', 1),
(22, 'sdfsdf mere bhai', 'sdfsdfsdf', 'admin', 1, '2019-02-26 00:43:02', '2019-02-26 00:43:02', 1),
(23, 'If you are ', 'If you are ahh', 'admin', 1, '2019-03-04 13:39:13', '2019-03-04 07:11:22', 1),
(24, 'hgh', 'fgfg', 'admin', 1, '2019-03-09 00:04:23', '2019-03-09 00:04:23', 1),
(25, 'fgfdgfdg', 'gdfgfd', 'admin', 1, '2019-03-09 00:30:24', '2019-03-09 00:30:24', 1),
(26, 'fdgfdgd', 'gfdgfdgg', 'admin', 1, '2019-03-09 00:30:35', '2019-03-09 00:30:35', 1),
(27, 'hgghfh', 'ghfghfgh', 'admin', 1, '2019-03-09 00:33:34', '2019-03-09 00:33:34', 1),
(28, 'sdfdf', 'sfdsdfsd', 'admin', 1, '2019-03-09 00:49:37', '2019-03-09 00:49:37', 1),
(29, 'dsad', 'sadsad', 'admin', 1, '2019-03-09 00:55:44', '2019-03-09 00:55:44', 1),
(30, 'jghjghj', 'ghjghj', 'admin', 1, '2019-03-09 00:55:55', '2019-03-09 00:55:55', 1),
(31, 'gfdgdg', 'fdgfdg', 'admin', 1, '2019-03-09 00:56:10', '2019-03-09 00:56:10', 1),
(32, 'sadsad', 'asdsadsa', 'admin', 1, '2019-03-09 04:34:42', '2019-03-09 04:34:42', 1),
(33, 'dsadsad fdgfdf new', 'gfdf newgfdf new', 'admin', 1, '2019-03-09 04:41:03', '2019-03-09 04:41:03', 1),
(34, 'sdadsada', 'sdsadsaa', 'user', 310, '2019-03-09 08:08:11', '2019-03-09 08:08:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forumAnswer`
--

CREATE TABLE `forumAnswer` (
  `id` int(11) NOT NULL,
  `forumId` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `answerBy` varchar(20) NOT NULL,
  `answerById` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forumAnswer`
--

INSERT INTO `forumAnswer` (`id`, `forumId`, `answer`, `answerBy`, `answerById`, `crd`, `upd`, `status`) VALUES
(11, 22, 'fsdfsdfs', 'trainer', 1, '2019-02-26 00:45:29', '2019-02-26 00:45:29', 1),
(12, 22, 'ghfhfghfh', 'trainer', 1, '2019-03-04 03:21:07', '2019-03-04 03:21:07', 1),
(13, 22, 'yyyy', 'trainer', 1, '2019-03-04 03:21:13', '2019-03-04 03:21:13', 1),
(14, 23, 'uiyuiyi', 'user', 304, '2019-03-04 07:20:17', '2019-03-04 07:20:17', 1),
(15, 23, 'uioyuy', 'user', 304, '2019-03-04 07:20:26', '2019-03-04 07:20:26', 1),
(16, 23, 'sfsdfd sdfdsf', 'user', 304, '2019-03-05 00:42:23', '2019-03-05 00:42:23', 1),
(17, 23, 'nhhnmhn  gb', 'user', 304, '2019-03-05 00:42:30', '2019-03-05 00:42:30', 1),
(18, 23, 'sdsadsad', 'trainer', 1, '2019-03-07 04:38:16', '2019-03-07 04:38:16', 1),
(19, 23, 'anurag', 'trainer', 1, '2019-03-07 04:38:30', '2019-03-07 04:38:30', 1),
(20, 31, 'dfgfd', 'user', 304, '2019-03-09 03:41:46', '2019-03-09 03:41:46', 1),
(21, 22, 'sdfsdfsdf', 'user', 304, '2019-03-09 03:46:43', '2019-03-09 03:46:43', 1),
(22, 30, 'hfghhfg', 'user', 304, '2019-03-09 03:49:48', '2019-03-09 03:49:48', 1),
(23, 29, 'sdsadasd', 'user', 304, '2019-03-09 03:51:09', '2019-03-09 03:51:09', 1),
(24, 29, 'dfsf', 'user', 304, '2019-03-09 03:51:12', '2019-03-09 03:51:12', 1),
(25, 25, 'sadsadsad', 'user', 304, '2019-03-09 03:51:39', '2019-03-09 03:51:39', 1),
(26, 25, 'fdfsfsf', 'user', 304, '2019-03-09 03:51:43', '2019-03-09 03:51:43', 1),
(27, 30, 'dgfd', 'user', 304, '2019-03-09 03:53:28', '2019-03-09 03:53:28', 1),
(28, 30, 'fgfgdfgfdg', 'user', 304, '2019-03-09 03:53:44', '2019-03-09 03:53:44', 1),
(29, 32, 'asdsada dfdfs', 'user', 310, '2019-03-09 04:38:19', '2019-03-09 04:38:19', 1),
(30, 33, 'this is nw frm', 'user', 310, '2019-03-09 04:41:24', '2019-03-09 04:41:24', 1),
(31, 33, 'this is adsadada', 'user', 310, '2019-03-09 04:42:32', '2019-03-09 04:42:32', 1),
(32, 32, 'thius is nw answer', 'user', 310, '2019-03-09 04:50:00', '2019-03-09 04:50:00', 1),
(33, 31, 'dsfsd', 'user', 310, '2019-03-09 06:36:14', '2019-03-09 06:36:14', 1),
(34, 34, 'bvcbvc', 'user', 304, '2019-03-11 03:37:12', '2019-03-11 03:37:12', 1),
(35, 34, 'cvxvx', 'user', 304, '2019-03-11 03:37:16', '2019-03-11 03:37:16', 1),
(36, 34, 'gfgd44', 'user', 304, '2019-03-11 03:37:44', '2019-03-11 03:37:44', 1),
(37, 34, 'sdfsdf', 'user', 304, '2019-03-11 03:40:27', '2019-03-11 03:40:27', 1),
(38, 34, 'bte3', 'user', 304, '2019-03-11 03:40:32', '2019-03-11 03:40:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forumLike`
--

CREATE TABLE `forumLike` (
  `id` int(11) NOT NULL,
  `forumId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forumLike`
--

INSERT INTO `forumLike` (`id`, `forumId`, `userId`, `crd`, `upd`, `status`) VALUES
(3, 23, 304, '2019-03-05 00:51:31', '2019-03-05 00:51:31', 1),
(5, 22, 304, '2019-03-09 02:05:44', '2019-03-09 02:05:44', 1),
(6, 23, 309, '2019-03-09 02:06:14', '2019-03-09 02:06:14', 1),
(8, 23, 299, '2019-03-09 02:12:47', '2019-03-09 02:12:47', 1),
(12, 30, 299, '2019-03-09 02:14:34', '2019-03-09 02:14:34', 1),
(22, 31, 304, '2019-03-09 03:26:00', '2019-03-09 03:26:00', 1),
(24, 31, 310, '2019-03-09 04:32:19', '2019-03-09 04:32:19', 1),
(25, 32, 310, '2019-03-09 04:40:41', '2019-03-09 04:40:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forumView`
--

CREATE TABLE `forumView` (
  `id` int(11) NOT NULL,
  `forumId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forumView`
--

INSERT INTO `forumView` (`id`, `forumId`, `userId`, `crd`, `upd`, `status`) VALUES
(1, 22, 304, '2019-03-01 03:21:19', '2019-03-01 03:21:19', 1),
(3, 23, 304, '2019-03-04 07:20:12', '2019-03-04 07:20:12', 1),
(4, 23, 309, '2019-03-05 07:51:41', '2019-03-05 07:51:41', 1),
(5, 22, 309, '2019-03-06 23:29:07', '2019-03-06 23:29:07', 1),
(6, 21, 309, '2019-03-06 23:29:12', '2019-03-06 23:29:12', 1),
(7, 19, 309, '2019-03-06 23:29:18', '2019-03-06 23:29:18', 1),
(8, 31, 304, '2019-03-09 01:47:26', '2019-03-09 01:47:26', 1),
(9, 23, 299, '2019-03-09 02:07:32', '2019-03-09 02:07:32', 1),
(10, 30, 299, '2019-03-09 02:14:03', '2019-03-09 02:14:03', 1),
(11, 27, 304, '2019-03-09 03:09:55', '2019-03-09 03:09:55', 1),
(12, 30, 304, '2019-03-09 03:49:45', '2019-03-09 03:49:45', 1),
(13, 29, 304, '2019-03-09 03:50:19', '2019-03-09 03:50:19', 1),
(14, 25, 304, '2019-03-09 03:51:37', '2019-03-09 03:51:37', 1),
(15, 31, 310, '2019-03-09 04:28:31', '2019-03-09 04:28:31', 1),
(16, 32, 310, '2019-03-09 04:34:49', '2019-03-09 04:34:49', 1),
(17, 33, 310, '2019-03-09 04:41:10', '2019-03-09 04:41:10', 1),
(18, 26, 304, '2019-03-11 03:36:02', '2019-03-11 03:36:02', 1),
(19, 34, 304, '2019-03-11 03:36:06', '2019-03-11 03:36:06', 1),
(20, 34, 309, '2019-03-11 05:29:08', '2019-03-11 05:29:08', 1),
(21, 33, 308, '2019-03-11 05:37:32', '2019-03-11 05:37:32', 1),
(22, 34, 308, '2019-03-11 06:35:08', '2019-03-11 06:35:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `homeContent`
--

CREATE TABLE `homeContent` (
  `id` int(11) NOT NULL,
  `contentName` varchar(255) NOT NULL,
  `contentValue` text NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeContent`
--

INSERT INTO `homeContent` (`id`, `contentName`, `contentValue`, `crd`, `upd`) VALUES
(1, 'content', '{\"banner\":[{\"b_title\":\"About My Vegan Trainer\",\"b_image\":\"bXql0gvPoc6u4Sxk.jpg\"},{\"b_title\":\"About My Vegan Trainer\",\"b_image\":\"TV1JXmbIZUCfeAWL.jpg\"},{\"b_title\":\"About My Vegan Trainer\",\"b_image\":\"36C9p7kbPGR0sMnF.jpg\"},{\"b_title\":\"About My Vegan Trainer\",\"b_image\":\"dUpi3lCxbtngX2cf.jpg\"},{\"b_title\":\"About My Vegan Trainer\",\"b_image\":\"CIcuEWVfzgA3F7pS.jpg\"}],\"about\":{\"subtitle\":\"About My Vegan Trainer\",\"title\":\"WELCOME TO MYVEGANTRAINER.COM\",\"infotitle\":\"Discover the hidden alter ego of your body\",\"infodesc\":\"<p>My Vegan Trainer is a professional fitness training center. We provide all kinds of fitness training and we have all modern instruments. On the other hand, we denounce with righteous indignation the foult anuals dislike men who are so beguiled and demoralized by the nuhaiicharms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound toen sue; and equal blame belongs to those who fail in their duty. On the other hand, we denounce with righteous indignation the foult anuals dislike men who are so beguiled and demoralized by the nuhaiicharms of pleasure of the moment, so blinded by desire.<\\/p>\",\"image\":\"I1tdqHuxrO23FGmU.jpg\"},\"video1\":{\"title\":\"New Videos Every Week\",\"desc\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters\"},\"video2\":{\"subtitle\":\"Watch A Video\",\"title\":\"LOREM IPSUM IS SIMPLY DUMMY TEXT OF THE PRINTING AND TYPESETTING INDUSTRY\"},\"trainer\":{\"title\":\"ONLINE COACHING\"}}', '2019-02-27 10:13:26', '2019-03-04 07:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `informationalVideo`
--

CREATE TABLE `informationalVideo` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `informationalVideo` varchar(255) NOT NULL,
  `videoThumb` varchar(255) NOT NULL,
  `videoLevelType` varchar(50) NOT NULL,
  `postedBy` varchar(20) NOT NULL,
  `postedById` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `informationalVideo`
--

INSERT INTO `informationalVideo` (`id`, `title`, `informationalVideo`, `videoThumb`, `videoLevelType`, `postedBy`, `postedById`, `crd`, `upd`, `status`, `isDelete`) VALUES
(16, 'vbvcbvb new one', 'OrGQ4oV2HyavM03h.mp4', 'WBG4rROZm6kcuiLb.png', 'level1,level2', 'admin', 1, '2019-03-08 06:03:18', '2019-03-01 08:58:54', 1, 0),
(17, 'vbvcbvb bb', 'xmioneJd2bFj0hEu.mp4', 'cv9GxRQCwyNW0fXV.png', 'level1,level2', 'admin', 1, '2019-03-08 05:54:52', '2019-03-01 09:00:09', 1, 0),
(18, 'gtgtvsdfsa aadsa my', 'PToQp0CSHLUlX74a.mp4', 'Aro3TEP4hvicXsjL.png', 'level1,level2', 'admin', 1, '2019-03-08 05:55:05', '2019-03-01 09:05:49', 1, 0),
(19, 'dsadsad in4', '2OEM0wVZszkg9eGp.mp4', 'g1cHhnjt8N3zRPEF.png', 'level3,level4', 'admin', 1, '2019-03-08 13:39:07', '2019-03-08 08:09:07', 1, 0),
(20, 'newone', 'Q3vZKw2JPo5BhiHl.mp4', 'uJixcOlD3vXFP2k7.png', 'level1,level3', 'trainer', 302, '2019-03-05 07:44:19', '2019-03-05 07:44:19', 1, 0),
(21, 'vbvcbvb lll4', 'xQKSpeFNzRUoD6Ht.mp4', 'b9HfJj7qWwYxKU5v.png', 'level3,level4', 'admin', 1, '2019-03-08 13:39:32', '2019-03-08 08:09:32', 1, 0),
(22, 'dfsdbbb edit', '1OjdEBMg2AW8xNFf.mp4', 'mJHSuhftolPAqnv9.png', 'level1,level2,level3', 'admin', 1, '2019-03-07 13:53:23', '2019-03-07 08:23:23', 1, 0),
(23, 'fsdfsd', 'qRZ1rUVngPGi4tch.mp4', 'YPcpDeEbLQ3r97xo.png', 'level2,level3,level4', 'admin', 1, '2019-03-09 00:58:02', '2019-03-09 00:58:02', 1, 0),
(24, 'sfdfds test info', 'rCVvcAz8LmS3tPG1.mp4', 'IkoXZNDTegVLKnrG.png', 'level3,level4', 'trainer', 301, '2019-03-09 05:44:45', '2019-03-09 05:44:45', 1, 0),
(25, 'sadsad sad aas', 'nFrWiD4xIy2OgNG5.mp4', '2NLQtwkainZgydjl.png', 'level3,level4', 'trainer', 303, '2019-03-09 06:43:08', '2019-03-09 06:43:08', 1, 0),
(26, 'fdgfdgd', 'AQ32VnhfSxPj7zEC.mp4', 'Bfc5sKmYikDSrUwx.png', 'level3,level4', 'admin', 1, '2019-03-13 00:14:05', '2019-03-13 00:14:05', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notificationBy` int(11) NOT NULL,
  `notificationFor` int(11) NOT NULL,
  `referenceId` int(11) NOT NULL,
  `notificationType` varchar(100) NOT NULL,
  `notificationMessage` varchar(500) NOT NULL,
  `isRead` int(11) NOT NULL DEFAULT '0' COMMENT '0:unread 1:read',
  `webNotify` int(11) NOT NULL DEFAULT '0' COMMENT '0:not notify,1:notify',
  `status` varchar(100) NOT NULL DEFAULT '1' COMMENT '1:active 0:inactive',
  `createdOn` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notificationBy`, `notificationFor`, `referenceId`, `notificationType`, `notificationMessage`, `isRead`, `webNotify`, `status`, `createdOn`) VALUES
(1, 230, 1, 30, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is interested in Delete article\",\"notificationType\":\"delete_article\",\"referenceId\":\"30\"}', 1, 1, '1', '2019-02-22 10:01:48'),
(2, 1, 230, 30, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is  Deleted article\",\"notificationType\":\"delete_article\",\"referenceId\":\"30\"}', 1, 1, '1', '2019-02-22 10:02:02'),
(7, 230, 1, 29, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is interested in Delete article\",\"notificationType\":\"delete_article\",\"referenceId\":\"29\"}', 1, 1, '1', '2019-02-22 10:09:00'),
(8, 1, 230, 29, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is  Deleted article\",\"notificationType\":\"delete_article\",\"referenceId\":\"29\"}', 1, 1, '1', '2019-02-22 10:09:28'),
(9, 230, 1, 31, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is interested in Delete article\",\"notificationType\":\"delete_article\",\"referenceId\":\"31\"}', 1, 1, '1', '2019-02-22 11:12:47'),
(10, 1, 230, 31, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is  Deleted article\",\"notificationType\":\"delete_article\",\"referenceId\":\"31\"}', 1, 1, '1', '2019-02-22 12:07:09'),
(15, 1, 230, 33, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is  Deleted article\",\"notificationType\":\"delete_article\",\"referenceId\":\"33\"}', 1, 1, '1', '2019-02-22 12:52:05'),
(25, 302, 1, 9, 'delete_informational_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is interested in Delete informational video\",\"notificationType\":\"delete_informational_video\",\"referenceId\":\"9\"}', 1, 1, '1', '2019-03-01 11:22:18'),
(26, 1, 302, 9, 'delete_informational_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is deleted video\",\"notificationType\":\"delete_informational_video\",\"referenceId\":\"9\"}', 1, 1, '1', '2019-03-01 11:22:31'),
(28, 1, 302, 10, 'delete_informational_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is deleted video\",\"notificationType\":\"delete_informational_video\",\"referenceId\":\"10\"}', 1, 1, '1', '2019-03-01 11:24:24'),
(30, 1, 302, 12, 'delete_informational_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is deleted video\",\"notificationType\":\"delete_informational_video\",\"referenceId\":\"12\"}', 1, 1, '1', '2019-03-01 11:27:39'),
(33, 302, 1, 2, 'delete_training_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is interested in Delete training video\",\"notificationType\":\"delete_training_video\",\"referenceId\":\"2\"}', 1, 1, '1', '2019-03-01 12:25:22'),
(36, 302, 1, 3, 'delete_training_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is interested in Delete training video\",\"notificationType\":\"delete_training_video\",\"referenceId\":\"3\"}', 1, 1, '1', '2019-03-01 12:36:03'),
(37, 1, 302, 3, 'delete_informational_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is deleted video\",\"notificationType\":\"delete_informational_video\",\"referenceId\":\"3\"}', 1, 1, '1', '2019-03-01 12:36:18'),
(39, 1, 302, 13, 'delete_informational_video', '{\"title\":\"Video delete request rejected by admin\",\"body\":\"[UNAME] is rejected deleted video\",\"notificationType\":\"delete_informational_video\",\"referenceId\":\"13\"}', 1, 1, '1', '2019-03-01 12:38:51'),
(41, 1, 302, 4, 'delete_training_video', '{\"title\":\"Video delete request rejected by admin\",\"body\":\"[UNAME] is rejected deleted video\",\"notificationType\":\"delete_training_video\",\"referenceId\":\"4\"}', 1, 1, '1', '2019-03-01 12:45:56'),
(42, 302, 1, 5, 'delete_training_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is interested in Delete training video\",\"notificationType\":\"delete_training_video\",\"referenceId\":\"5\"}', 1, 1, '1', '2019-03-01 12:51:41'),
(43, 302, 1, 6, 'delete_training_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is interested in Delete training video\",\"notificationType\":\"delete_training_video\",\"referenceId\":\"6\"}', 1, 1, '1', '2019-03-01 12:52:44'),
(44, 1, 302, 6, 'delete_informational_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is deleted video\",\"notificationType\":\"delete_informational_video\",\"referenceId\":\"6\"}', 1, 1, '1', '2019-03-01 12:52:56'),
(47, 302, 1, 10, 'delete_training_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is interested in Delete training video\",\"notificationType\":\"delete_training_video\",\"referenceId\":\"10\"}', 1, 1, '1', '2019-03-05 12:53:03'),
(49, 302, 1, 20, 'delete_informational_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is interested in Delete informational video\",\"notificationType\":\"delete_informational_video\",\"referenceId\":\"20\"}', 1, 1, '1', '2019-03-05 13:14:50'),
(50, 1, 302, 11, 'delete_training_video', '{\"title\":\"Video delete request rejected by admin\",\"body\":\"[UNAME] is rejected deleted video\",\"notificationType\":\"delete_training_video\",\"referenceId\":\"11\"}', 0, 0, '1', '2019-03-05 13:15:32'),
(51, 1, 1, 10, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is  Deleted article\",\"notificationType\":\"delete_article\",\"referenceId\":\"10\"}', 1, 1, '1', '2019-03-07 10:15:53'),
(53, 301, 1, 12, 'delete_training_video', '{\"title\":\"Delete video\",\"body\":\"[UNAME] is interested in Delete training video\",\"notificationType\":\"delete_training_video\",\"referenceId\":\"12\"}', 1, 1, '1', '2019-03-09 11:15:00'),
(54, 1, 302, 12, 'delete_training_video', '{\"title\":\"Video delete request rejected by admin\",\"body\":\"[UNAME] is rejected deleted video\",\"notificationType\":\"delete_training_video\",\"referenceId\":\"12\"}', 0, 0, '1', '2019-03-09 12:08:01'),
(56, 1, 303, 25, 'delete_informational_video', '{\"title\":\"Video delete request rejected by admin\",\"body\":\"[UNAME] is rejected deleted video\",\"notificationType\":\"delete_informational_video\",\"referenceId\":\"25\"}', 1, 1, '1', '2019-03-09 12:52:57'),
(57, 1, 301, 39, 'delete_article', '{\"title\":\"Article delete request rejected by admin\",\"body\":\"[UNAME] is rejected deleted article\",\"notificationType\":\"delete_article\",\"referenceId\":\"39\"}', 0, 0, '1', '2019-03-09 12:55:25'),
(58, 303, 1, 43, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is interested in Delete article\",\"notificationType\":\"delete_article\",\"referenceId\":\"43\"}', 1, 1, '1', '2019-03-09 12:58:07'),
(59, 303, 1, 44, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is interested in Delete article\",\"notificationType\":\"delete_article\",\"referenceId\":\"44\"}', 1, 1, '1', '2019-03-09 13:02:41'),
(60, 303, 1, 45, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is interested in Delete article\",\"notificationType\":\"delete_article\",\"referenceId\":\"45\"}', 1, 1, '1', '2019-03-09 13:09:00'),
(61, 1, 303, 45, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is  Deleted article\",\"notificationType\":\"delete_article\",\"referenceId\":\"45\"}', 1, 1, '1', '2019-03-09 13:11:30'),
(62, 1, 303, 44, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is  Deleted article\",\"notificationType\":\"delete_article\",\"referenceId\":\"44\"}', 1, 1, '1', '2019-03-09 13:12:14'),
(63, 1, 303, 43, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is  Deleted article\",\"notificationType\":\"delete_article\",\"referenceId\":\"43\"}', 1, 1, '1', '2019-03-09 13:12:21'),
(65, 303, 1, 46, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is interested in Delete article\",\"notificationType\":\"delete_article\",\"referenceId\":\"46\"}', 1, 1, '1', '2019-03-09 13:14:34'),
(66, 1, 303, 46, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is  Deleted article\",\"notificationType\":\"delete_article\",\"referenceId\":\"46\"}', 1, 1, '1', '2019-03-09 13:14:48'),
(69, 303, 1, 48, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is interested in Delete article\",\"notificationType\":\"delete_article\",\"referenceId\":\"48\"}', 1, 1, '1', '2019-03-09 13:16:59'),
(70, 1, 303, 48, 'delete_article', '{\"title\":\"Delete article\",\"body\":\"[UNAME] is  Deleted article\",\"notificationType\":\"delete_article\",\"referenceId\":\"48\"}', 1, 1, '1', '2019-03-09 13:17:14'),
(71, 1, 303, 47, 'delete_article', '{\"title\":\"Article delete request rejected by admin\",\"body\":\"[UNAME] is rejected deleted article\",\"notificationType\":\"delete_article\",\"referenceId\":\"47\"}', 1, 1, '1', '2019-03-09 13:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `nutritionguidance`
--

CREATE TABLE `nutritionguidance` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `video` text NOT NULL,
  `videoThumb` text NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `addedBy` varchar(50) NOT NULL,
  `addedById` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nutritionguidance`
--

INSERT INTO `nutritionguidance` (`id`, `title`, `description`, `image`, `video`, `videoThumb`, `pdf`, `categoryId`, `addedBy`, `addedById`, `crd`, `upd`) VALUES
(1, 'fdsdfdsf', 'sdfsdf sdfsdf sdsd', '[\"JIlA0O4VLichb5zG.jpg\",\"WBQk9GXol5PtTagw.jpeg\"]', '[\"7sg1OL0fhdq9TBpF.mp4\",\"6gvfltbaPGjOMpLF.mp4\"]', '[\"ZxVA639SjJC0wMus.png\",\"AQKdlGRuSPsr8mVw.png\",\"j5kLEXqpbm0JeUr3.png\",\"9kjQiPV48DwldMYN.png\"]', '', 1, 'admin', 1, '2019-03-12 23:50:32', '2019-03-12 23:50:32'),
(2, 'asdsad', 'sdsadsad', '[\"ErJsf9cgPSU68LW3.jpg\"]', '[\"azgYGf5d3hAU2HKs.mp4\",\"uTGZjiAYQDaBgMy5.mp4\"]', '[\"HJV19AvXeytkgC8B.png\",\"2nKF7kAYy0WzC1md.png\",\"ulF94b23DWhNwYLQ.png\",\"67oHZvgxImDfrdGt.png\"]', '', 3, 'admin', 1, '2019-03-13 00:08:35', '2019-03-13 00:08:35'),
(3, 'dfsdf', 'sdfsdf', '[]', '[\"6LSpwcjrqZIH87ul.mp4\",\"QCWmg9SHEetjb7fT.mp4\"]', '[\"qsHinAzt6Mel8PpO.png\",\"i1eVhcHq9k6rxYDX.png\",\"wzGVRbcYBKJrtjpS.png\",\"gh8iNmKt5dEJRwYD.png\"]', '', 1, 'admin', 1, '2019-03-13 00:09:45', '2019-03-13 00:09:45'),
(4, 'dfsdf', 'sdfsdf', '[]', '[\"xrYnQ9H1eGoXTb6P.mp4\",\"NXAaULSEnGcCWsow.mp4\"]', '[\"yEtVWMaCR75Nvh9H.png\",\"UyrZ0s9uxfo3IHVA.png\",\"QGAuNdh1wjVfcZy4.png\",\"s7BCS8Uw5xEOyngD.png\"]', '', 1, 'admin', 1, '2019-03-13 00:10:59', '2019-03-13 00:10:59'),
(5, 'dfsdf', 'sdfsdf', '[]', '[\"Nbt5C3YkVGqH02dP.mp4\",\"J9oiMcqQzarPy4OG.mp4\",\"BLpErnPjZcQ9OhSm.mp4\"]', '[\"coQ38fbx2a6NTvJW.png\",\"n4mMiEJT9ge8Q0O1.png\",\"0BSPslVRUrmkEdGW.png\",\"BYM7G3bc5Sed1qfn.png\"]', '', 1, 'admin', 1, '2019-03-13 00:11:11', '2019-03-13 00:11:11'),
(6, 'dsfsdf', 'fddsfdsf', '[]', '[\"RuOMLKHx19Q43rkJ.mp4\"]', '[\"ZQ2dCpMXD4YxRzv7.png\",\"rGbjFOUx3k70QKBi.png\",\"YmdqMLQTNJ5G6IUC.png\",\"hP6jSnegFD2tvmqU.png\"]', '', 3, 'admin', 1, '2019-03-13 00:12:14', '2019-03-13 00:12:14'),
(7, 'fsdfsdf', 'sdfsdf', '[]', '[\"BPcJRF19IvUt4kOu.mp4\"]', '[\"hUCzd9Qsemxv83ER.png\",\"CqLUzQbTARunW4KE.png\",\"mKJBrvzPVWDHaAXb.png\",\"6R5jk4mvfy7T2rSh.png\"]', '', 1, 'admin', 1, '2019-03-13 00:12:48', '2019-03-13 00:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `nutritionguidanceCategories`
--

CREATE TABLE `nutritionguidanceCategories` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nutritionguidanceCategories`
--

INSERT INTO `nutritionguidanceCategories` (`id`, `categoryName`, `crd`, `upd`, `status`) VALUES
(1, 'How Does MyVegan Trainer Diet Works', '2019-03-12 06:01:05', '2019-03-12 06:01:05', 1),
(2, 'Which Diet Style', '2019-03-12 06:01:05', '2019-03-12 06:01:05', 1),
(3, 'Supplements', '2019-03-12 06:01:05', '2019-03-12 06:01:05', 1),
(4, 'Macro Tracking', '2019-03-12 06:01:05', '2019-03-12 06:01:05', 1),
(5, 'Digestive Disorders', '2019-03-12 06:01:05', '2019-03-12 06:01:05', 1),
(6, 'Special Dietary Requirements', '2019-03-12 06:01:05', '2019-03-12 06:01:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recepie`
--

CREATE TABLE `recepie` (
  `id` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `video` text NOT NULL,
  `videoThumb` varchar(255) NOT NULL,
  `addedBy` varchar(255) NOT NULL,
  `addedById` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recepie`
--

INSERT INTO `recepie` (`id`, `categoryId`, `title`, `description`, `image`, `video`, `videoThumb`, `addedBy`, `addedById`, `crd`, `upd`, `status`) VALUES
(1, 1, 'fdgdfgfdg', 'fdgfdgfdg', 'qfrUiSTWzFoBwvC6.jpg', '5M9aInrQxUjpXsS8.mp4', 'xu2HXIjG9NS3W6Cn.png', 'admin', 1, '2019-02-07 00:41:16', '2019-02-07 00:41:16', 1),
(2, 2, 'mjmjmjmjm', 'mjmjmjmjmjmjmjmj', 'SoEXap8csnriHVK1.png', 'LFWRnt8SvPou7OkB.mp4', 'mhM1L2BjqdJ4En7K.png', 'admin', 1, '2019-02-13 05:32:09', '2019-02-13 05:32:09', 1),
(3, 2, 'SDSFGFDGFD', 'gfdfgfdgfdgfdg', '0yZf7ebziYR9IB1M.jpg', 'aJ1ywOr7lXfGi4BV.mp4', 'PuM64n5m0sj2DfKJ.png', 'admin', 1, '2019-02-07 01:06:29', '2019-02-07 01:06:29', 1),
(4, 1, 'asdsadsad', 'dsadsadsadsad', 'BjHDfAiRl3y47hIP.jpg', '6jnk1OiNTulGUdB8.mp4', 'Q7iJDG0O8djToC49.png', 'admin', 1, '2019-02-08 05:55:15', '2019-02-08 05:55:15', 1),
(5, 1, 'fsdfdsf', 'sdfsdfsdfsdf', '', 'Sp0Vn6Njviu5WDKe.mp4', 'EG0aBVSR36K9Jpjr.png', 'admin', 1, '2019-02-08 06:58:20', '2019-02-08 06:58:20', 1),
(6, 1, 'this is my respce', 'sdsadsadsa', 'DKdOmVwuv1Wo3TSs.png', '7EiZpq01rPcAxtlo.mp4', 'pKsuoXZTJR3j4N65.png', 'admin', 1, '2019-02-08 07:02:19', '2019-02-08 07:02:19', 1),
(8, 1, 'this                  is        my            respce', 'gfdgfdgfdg', 'SkI9lTNQMGRqseUi.png', 'XY2W5vu1QpLR0J7O.mp4', 'REuytX9dLG5HaoK4.png', 'admin', 1, '2019-02-08 07:04:16', '2019-02-08 07:04:16', 1),
(9, 1, 'this                    is              my       respce', 'gdffgfgfgfgfgfgfgfg', '', '', '8vYzWNg0nLMoVJ7Q.png', 'admin', 1, '2019-02-08 07:06:55', '2019-02-08 07:06:55', 1),
(10, 1, 'fgfg dfbfdgfd dbfdgfd', 'cvxcvxcvxcv ffdgfdgfdgfdgd dfgfdgfdgfdgfd dffdgfdgfd', 'PmklwHMydo0N64xS.png', 'oYOTkiXsbSpDHBZq.mp4', 'HJxSMTUh5i1tr3dj.png', 'admin', 1, '2019-02-08 07:20:27', '2019-02-08 07:20:27', 1),
(11, 2, 'ngnghghghg', 'sdfsdfsdf ssfsdfsdfsdf', 'CM64PxlDm0kZt7EF.jpg', 'hbS3KoipjTDzql4G.mp4', 'Ozc6a2snhI4Nvbx3.png', 'admin', 1, '2019-02-08 23:52:26', '2019-02-08 23:52:26', 1),
(12, 1, 'sdfsdfsdf', 'sdfsdf', '', '', 'tkDCVgxrh1Xm84FY.png', 'admin', 1, '2019-02-25 01:11:57', '2019-02-25 01:11:57', 1),
(13, 1, 'sdsad', 'sdsadsad', 'KmABxnziIMCwfDle.jpg', '', '6jzevkQrVG1Owql3.png', 'admin', 1, '2019-02-25 02:06:46', '2019-02-25 02:06:46', 1),
(14, 1, 'dfdf', 'dfsdf sdfdsfds sdfvsd dfds s', 'v2Ax5VOXMJP4Hdlj.jpg', 'Tb3kn4aqxWdLGwt5.mp4', 'kIAcpGYRnNS69ZDf.png', 'admin', 1, '2019-02-25 03:10:44', '2019-02-25 03:10:44', 1),
(15, 1, 'dsd dfsdfsd', 'fsdfds sdfdsf sdfdfds sdfdsf', 'LSF1gfE9RQlkAHOv.jpg', '9gnHVahTmP74jq6I.mp4', 'lB2JUNMpKzFgfW9s.png', 'admin', 1, '2019-02-25 03:20:37', '2019-02-25 03:20:37', 1),
(16, 1, 'fdf sd sdf nbb new', 'fds dsfdf sdfsdf', 'hI9nrHXLRdfk5ywe.jpg', 'vkqzR8N1LbsZaCFe.mp4', 'hzM8KOIwUmrv6ECH.png', 'admin', 1, '2019-02-25 03:58:54', '2019-02-25 03:58:54', 1),
(17, 1, 'fsdfds', 'sdfds sdfd sd', 'KZhn9gLrsQmAIpiS.jpg', 'tSIXu1UwcRqGaEjm.mp4', 'erEOo8VD7WUICAjv.png', 'admin', 1, '2019-03-05 03:59:37', '2019-03-05 03:59:37', 1),
(18, 1, 'thisu g', 'this new resp', 'CVun8EtBqa3xgGP2.jpeg', 'mw8KztBio5U3sxgL.mp4', 'zUWtZnDcVF2lhI1O.png', 'admin', 1, '2019-03-05 04:01:04', '2019-03-05 04:01:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recepieCategory`
--

CREATE TABLE `recepieCategory` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `categoryImage` text NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recepieCategory`
--

INSERT INTO `recepieCategory` (`id`, `categoryName`, `categoryImage`, `crd`, `upd`) VALUES
(1, 'Savory', '', '2019-01-22 09:27:10', '2019-01-22 09:27:10'),
(2, 'Sweets', '', '2019-01-22 09:27:10', '2019-01-22 09:27:10'),
(3, 'breakfast', '', '2019-01-24 12:24:40', '2019-01-24 12:24:40'),
(4, 'Snack', '', '2019-03-08 05:53:33', '2019-03-08 05:53:33'),
(5, 'Salads', '', '2019-03-08 05:53:33', '2019-03-08 05:53:33'),
(6, 'Desserts', '', '2019-03-08 05:53:33', '2019-03-08 05:53:33'),
(7, 'Dinner', '', '2019-03-08 05:53:33', '2019-03-08 05:53:33'),
(8, 'Drink', '', '2019-03-08 05:53:33', '2019-03-08 05:53:33'),
(9, 'Soups', '', '2019-03-08 05:54:22', '2019-03-08 05:54:22'),
(10, 'Smoothies', '', '2019-03-11 05:48:32', '2019-03-11 05:48:32'),
(11, 'Lunch', '', '2019-03-11 05:48:43', '2019-03-11 05:48:43'),
(12, 'hghgg', '', '2019-03-11 07:17:12', '2019-03-11 07:17:12'),
(13, 'yyyt', '', '2019-03-11 07:17:12', '2019-03-11 07:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `recepieCategoryMap`
--

CREATE TABLE `recepieCategoryMap` (
  `id` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `recepieId` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recepieCategoryMap`
--

INSERT INTO `recepieCategoryMap` (`id`, `categoryId`, `recepieId`, `crd`) VALUES
(1, 1, 1, '2019-02-07 06:10:18'),
(2, 1, 2, '2019-02-07 06:19:54'),
(3, 2, 2, '2019-02-07 06:36:29'),
(4, 1, 4, '2019-02-08 11:25:15'),
(5, 1, 5, '2019-02-08 12:28:20'),
(6, 1, 6, '2019-02-08 12:32:19'),
(8, 1, 8, '2019-02-08 12:34:16'),
(9, 1, 9, '2019-02-08 12:36:55'),
(10, 1, 10, '2019-02-08 12:50:27'),
(11, 1, 11, '2019-02-08 12:51:31'),
(12, 1, 12, '2019-02-25 06:41:57'),
(13, 1, 13, '2019-02-25 07:36:46'),
(14, 1, 14, '2019-02-25 08:40:44'),
(15, 1, 15, '2019-02-25 08:50:37'),
(16, 1, 16, '2019-02-25 08:51:38'),
(17, 1, 17, '2019-02-25 08:52:10'),
(18, 1, 18, '2019-03-05 09:30:13');

-- --------------------------------------------------------

--
-- Table structure for table `recepieLike`
--

CREATE TABLE `recepieLike` (
  `id` int(11) NOT NULL,
  `recepieId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recepieView`
--

CREATE TABLE `recepieView` (
  `id` int(11) NOT NULL,
  `recepieId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recepieView`
--

INSERT INTO `recepieView` (`id`, `recepieId`, `userId`, `crd`, `upd`, `status`) VALUES
(1, 16, 304, '2019-02-27 23:28:49', '2019-02-27 23:28:49', 1),
(2, 2, 304, '2019-02-27 23:29:03', '2019-02-27 23:29:03', 1),
(3, 3, 304, '2019-02-27 23:29:12', '2019-02-27 23:29:12', 1),
(4, 1, 304, '2019-02-27 23:29:21', '2019-02-27 23:29:21', 1),
(5, 16, 305, '2019-03-04 01:34:51', '2019-03-04 01:34:51', 1),
(6, 18, 309, '2019-03-06 23:24:07', '2019-03-06 23:24:07', 1),
(7, 18, 304, '2019-03-08 01:00:25', '2019-03-08 01:00:25', 1),
(8, 8, 304, '2019-03-08 01:16:17', '2019-03-08 01:16:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainerMeta`
--

CREATE TABLE `trainerMeta` (
  `id` int(11) NOT NULL,
  `trainerId` int(11) NOT NULL,
  `showTrainer` enum('0','1','2') NOT NULL COMMENT '0-only trainer,1- trainer and 2-3 other,2-trainer and all',
  `commissionFree` float NOT NULL,
  `commissionLevel1` float NOT NULL,
  `commissionLevel2` float NOT NULL,
  `commissionLevel3Same` float NOT NULL,
  `commissionLevel3Other` float NOT NULL,
  `commissionLevel4Same` float NOT NULL,
  `commissionLevel4Other` float NOT NULL,
  `discountLevel1` float NOT NULL,
  `discountLevel2` float NOT NULL,
  `discountLevel3Same` float NOT NULL,
  `discountLevel3Other` float NOT NULL,
  `discountLevel4Same` float NOT NULL,
  `discountLevel4Other` float NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainerMeta`
--

INSERT INTO `trainerMeta` (`id`, `trainerId`, `showTrainer`, `commissionFree`, `commissionLevel1`, `commissionLevel2`, `commissionLevel3Same`, `commissionLevel3Other`, `commissionLevel4Same`, `commissionLevel4Other`, `discountLevel1`, `discountLevel2`, `discountLevel3Same`, `discountLevel3Other`, `discountLevel4Same`, `discountLevel4Other`, `crd`, `upd`, `status`) VALUES
(4, 301, '1', 1, 1, 1, 1, 1, 1, 1, 1, 1, 3, 1, 4, 1, '2019-02-27 12:42:53', '2019-02-27 07:12:53', 1),
(5, 302, '1', 1, 1, 1, 1, 1, 1, 1, 1, 1, 3.1, 2, 4.2, 2, '2019-02-27 12:42:39', '2019-02-27 07:12:39', 1),
(6, 303, '1', 1, 1, 1, 1, 1, 1, 1, 1, 1, 3.4, 1.5, 3.9, 4.2, '2019-02-27 12:42:25', '2019-02-27 07:12:25', 1),
(7, 316, '1', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2019-03-09 00:05:29', '2019-03-09 00:05:29', 1),
(8, 317, '1', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2019-03-09 00:27:39', '2019-03-09 00:27:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainingVideo`
--

CREATE TABLE `trainingVideo` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `trainingVideo` varchar(255) NOT NULL,
  `videoThumb` varchar(255) NOT NULL,
  `videoLevelType` varchar(50) NOT NULL,
  `postedBy` varchar(20) NOT NULL,
  `postedById` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainingVideo`
--

INSERT INTO `trainingVideo` (`id`, `title`, `trainingVideo`, `videoThumb`, `videoLevelType`, `postedBy`, `postedById`, `crd`, `upd`, `status`, `isDelete`) VALUES
(8, 'vbvcbvb lv4', 'RsJVOSH1tiYwCcd8.mp4', 's30uokd7NhWnlGtK.png', 'level2,level3,level4', 'admin', 1, '2019-03-08 13:38:43', '2019-03-08 08:08:43', 1, 0),
(9, 'vbvcbvb fsdfds', 'YNyEOFnpazC1Trmu.mp4', 'VOCrieDBxcbN1hsM.png', 'level1,level2,level3', 'admin', 1, '2019-03-01 09:20:57', '2019-03-01 09:20:57', 1, 0),
(10, 'sadsad', 'fa6etSN1LOruWQPc.mp4', 'eBKnkF9wYcfyoTHb.png', 'level1,level3', 'trainer', 302, '2019-03-05 07:20:16', '2019-03-05 07:20:16', 1, 0),
(11, 'new tr one', 'iM8bW9Qv2ZmKRU4l.mp4', 'F5utYGZN4UgV8Kjw.png', 'level1,level2,level3,level4', 'admin', 1, '2019-03-08 13:38:15', '2019-03-08 08:08:15', 1, 0),
(12, 'dfsdfsdf new trinj', '9qCr7uUm0MdztGVl.mp4', 'u5qf1OAcHVtjr87y.png', 'level3', 'trainer', 301, '2019-03-09 11:14:57', '2019-03-09 05:44:57', 1, 0),
(13, 'dsfsdf', 'I31tiYxFNzkaODZs.mp4', 'on5fYStU7e2aKu96.png', 'level3,level4', 'trainer', 303, '2019-03-09 06:43:22', '2019-03-09 06:43:22', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profileImage` varchar(255) NOT NULL,
  `bannerImage` varchar(255) NOT NULL,
  `userRole` varchar(255) NOT NULL COMMENT 'admin,trainer,users',
  `details` varchar(255) NOT NULL,
  `showSliderTrainer` tinyint(4) NOT NULL COMMENT '1-yes ,0- No',
  `promote` int(11) NOT NULL,
  `allPrivileges` int(11) NOT NULL,
  `assignTrainer` int(11) NOT NULL COMMENT 'trainer Id',
  `userPlan` varchar(50) NOT NULL COMMENT 'free,level1,level2,level3',
  `socialId` varchar(255) NOT NULL,
  `socialType` varchar(255) NOT NULL,
  `deviceType` tinyint(4) NOT NULL DEFAULT '0',
  `deviceToken` varchar(255) NOT NULL,
  `authToken` varchar(255) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `email`, `password`, `profileImage`, `bannerImage`, `userRole`, `details`, `showSliderTrainer`, `promote`, `allPrivileges`, `assignTrainer`, `userPlan`, `socialId`, `socialType`, `deviceType`, `deviceToken`, `authToken`, `crd`, `upd`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$.4FM6DDvXvoV8wtAqcveJOow/rDBi07gXjPks1dwsjK5YqqsZlgmW', '', '', 'admin', '', 0, 0, 0, 0, '', '', '', 0, '', '', '2018-12-17 11:22:55', '2018-12-17 07:12:51', 1),
(299, 'new user', 'newuser@gmail.com', '$2y$10$vr.zQm/t3e0nY/i7VO4PjeAOLqFe5ECCHJ7W8Y11qaV5JQ9OULsHa', '', '', 'user', '', 0, 0, 0, 1, 'level2', '', '', 0, '', '', '2019-02-27 11:03:03', '2019-02-27 04:58:10', 1),
(300, 'dsad', 'asdsa@gmail.com', '$2y$10$7FfFpLWMATcQXTuhE5eK3OkdbCvpt05yEqTPD8p7XHT3KIPBo.DcG', '', '', 'user', '', 0, 0, 0, 1, 'level1', '', '', 0, '', '', '2019-02-27 11:02:57', '2019-02-27 05:29:04', 1),
(301, 'anurag', 'anurag@gmail.com', '$2y$10$NTHYaRzphB/So0UEW050BOEH17PFfqK2zSXwJOuCoc9UBnX.vcylO', 'uiwnN5QFLvMaO7XW.jpg', '', 'trainer', 'i am gym trainer', 1, 1, 1, 0, '', '', '', 0, '', '', '2019-02-27 12:42:53', '2019-02-27 07:12:53', 1),
(302, 'sachin', 'sachin@gmail.com', '$2y$10$CbOfqHX3uAh/B5GvY9LTV.3Jxh76JddFsp/EiTa/hExVXjuiq4RYq', 'pM3b5gEj48oNdikL.jpg', '', 'trainer', 'this trainer provide all type of faculty to our tranie', 1, 1, 1, 0, '', '', '', 0, '', '', '2019-02-27 12:42:39', '2019-02-27 07:12:39', 1),
(303, 'bhaskar', 'bhaskar@gmail.com', '$2y$10$S55zDA0BAVYeVo60RK838eeY05zpXS9MM2yhDJ8gXNS4IPk2/a/bm', 'dqzCRIFn2Xa1Ty0S.jpg', '', 'trainer', 'bhaskar provide gym training.in which you don\'t have to do anything.', 1, 1, 1, 0, '', '', '', 0, '', '', '2019-02-27 12:42:25', '2019-02-27 07:12:25', 1),
(304, 'levelone', 'levelone@gmail.com', '$2y$10$CiHAcgGjyGG0H7qCWWe0xeHUePSgrFBnl5i1QryAaTf5WxylNR69.', 'XEG57k0BrauCbI32.jpg', '', 'user', '', 0, 0, 0, 1, 'level1', '', '', 0, '', '', '2019-02-27 12:48:15', '2019-02-27 07:17:16', 1),
(308, 'new user', 'linkuser@gmail.com', '$2y$10$nRcML.UNg69P3qyrchWrwe2kK0y6QB8gc0VGAKZ7B3g6cxf/rVvk.', '', '', 'user', '', 0, 0, 0, 1, 'level1', '', '', 0, '', '', '2019-03-11 11:07:20', '2019-02-28 01:38:05', 1),
(309, 'free', 'freeuser@gmail.com', '$2y$10$d1.XeUf5EKyKVCV/vCzhEOnECgw4KNxTbpvmixbi34yDX8WsCOq2S', '', '', 'user', '', 0, 0, 0, 1, 'level2', '', '', 0, '', '', '2019-03-07 04:53:36', '2019-02-28 02:05:59', 1),
(310, 'anuuser', 'anuuser@gmail.com', '$2y$10$58Q0ImMWVT1f/W1zULmbfOPY4muIm3TysD8nnL1XhqO8VzBy07ZbW', 'ifuYXPvKtDeQF1hb.JPG', '', 'user', '', 0, 0, 0, 301, 'level3', '', '', 0, '', '', '2019-03-11 09:39:04', '2019-03-07 00:22:12', 0),
(311, 'newur', 'testuser12@gmail.com', '$2y$10$1O2t0j/4PB1KXAFmF6eAOOIvzV6vLewCQX426WP5d1xvtFaBPlVPy', '', '', 'user', '', 0, 0, 0, 0, 'free', '', '', 0, '', '', '2019-03-07 01:39:23', '2019-03-07 01:39:23', 1),
(312, 'dsad', 'sdsad@gmail.com', '$2y$10$ie4t9ICgPfNyCDMdfpmuLeRZBAMqYF53xk6wyV2fM20PfNaTsh68e', '', '', 'user', '', 0, 0, 0, 0, 'free', '', '', 0, '', '', '2019-03-07 03:48:21', '2019-03-07 03:48:21', 1),
(313, 'sdsad', 'gngn@gmail.com', '$2y$10$E.NR3CrN5V0cqzwL93GxPeclCBlcsZ39/ffH0OYGTwjmGBAmp62wm', '', '', 'user', '', 0, 0, 0, 1, 'level2', '', '', 0, '', '', '2019-03-07 09:54:05', '2019-03-07 04:23:16', 1),
(314, 'asdsad', 'dfd@gmail.com', '$2y$10$8BEOz9Qpj6CY.UCcP92mP.OMva.Pj14xxCq7GahL6wZdvViy55kb6', '', '', 'user', '', 0, 0, 0, 0, 'free', '', '', 0, '', '', '2019-03-07 04:24:57', '2019-03-07 04:24:57', 1),
(316, 'asdsa', 'admin45@gmail.com', '$2y$10$lGmc1TORpBeMqJFT4pkMweYE4mjhy6V4cKwk10tZC7NXvoYWqxmm6', '', '', 'trainer', 'xfsdfv dvfdv fgfg', 1, 1, 1, 0, '', '', '', 0, '', '', '2019-03-09 00:05:29', '2019-03-09 00:05:29', 1),
(317, 'sdfsd', 'sdsadsd@gmail.com', '$2y$10$uuHc4i3p3/K4PJruviZdrOri0eGIAqgD10SjW292ISWgBF7ez3R4m', '', '', 'trainer', 'sdfsdf', 1, 1, 1, 0, '', '', '', 0, '', '', '2019-03-09 00:27:39', '2019-03-09 00:27:39', 1),
(319, 'dsad', 'sadsadgt@gmail.com', '$2y$10$v8g1HXKtm9Xy4lEztnRMIud4rkqTmXaR4mEzyAJB4fRXcB9sEdQWO', '', '', 'user', '', 0, 0, 0, 302, 'level3', '', '', 0, '', '', '2019-03-11 13:04:38', '2019-03-11 07:34:26', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answerLike`
--
ALTER TABLE `answerLike`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answerId` (`answerId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addedById` (`addedById`);

--
-- Indexes for table `articleAnswer`
--
ALTER TABLE `articleAnswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aricleId` (`articleId`),
  ADD KEY `answerById` (`answerById`);

--
-- Indexes for table `articleAnswerLike`
--
ALTER TABLE `articleAnswerLike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articleLike`
--
ALTER TABLE `articleLike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articleView`
--
ALTER TABLE `articleView`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addedById` (`addedById`);

--
-- Indexes for table `forumAnswer`
--
ALTER TABLE `forumAnswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forumId` (`forumId`),
  ADD KEY `answerById` (`answerById`);

--
-- Indexes for table `forumLike`
--
ALTER TABLE `forumLike`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forumId` (`forumId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `forumView`
--
ALTER TABLE `forumView`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forumId` (`forumId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `homeContent`
--
ALTER TABLE `homeContent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informationalVideo`
--
ALTER TABLE `informationalVideo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postedById` (`postedById`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_for` (`notificationFor`),
  ADD KEY `notification_by` (`notificationBy`);

--
-- Indexes for table `nutritionguidance`
--
ALTER TABLE `nutritionguidance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutritionguidanceCategories`
--
ALTER TABLE `nutritionguidanceCategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recepie`
--
ALTER TABLE `recepie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recepieCategory`
--
ALTER TABLE `recepieCategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recepieCategoryMap`
--
ALTER TABLE `recepieCategoryMap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recepieId` (`recepieId`);

--
-- Indexes for table `recepieLike`
--
ALTER TABLE `recepieLike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recepieView`
--
ALTER TABLE `recepieView`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainerMeta`
--
ALTER TABLE `trainerMeta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainerId` (`trainerId`);

--
-- Indexes for table `trainingVideo`
--
ALTER TABLE `trainingVideo`
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
-- AUTO_INCREMENT for table `answerLike`
--
ALTER TABLE `answerLike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `articleAnswer`
--
ALTER TABLE `articleAnswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `articleAnswerLike`
--
ALTER TABLE `articleAnswerLike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `articleLike`
--
ALTER TABLE `articleLike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=476;

--
-- AUTO_INCREMENT for table `articleView`
--
ALTER TABLE `articleView`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `forumAnswer`
--
ALTER TABLE `forumAnswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `forumLike`
--
ALTER TABLE `forumLike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `forumView`
--
ALTER TABLE `forumView`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `homeContent`
--
ALTER TABLE `homeContent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `informationalVideo`
--
ALTER TABLE `informationalVideo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `nutritionguidance`
--
ALTER TABLE `nutritionguidance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nutritionguidanceCategories`
--
ALTER TABLE `nutritionguidanceCategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recepie`
--
ALTER TABLE `recepie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `recepieCategory`
--
ALTER TABLE `recepieCategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `recepieCategoryMap`
--
ALTER TABLE `recepieCategoryMap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `recepieLike`
--
ALTER TABLE `recepieLike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recepieView`
--
ALTER TABLE `recepieView`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `trainerMeta`
--
ALTER TABLE `trainerMeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `trainingVideo`
--
ALTER TABLE `trainingVideo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answerLike`
--
ALTER TABLE `answerLike`
  ADD CONSTRAINT `answerLike_ibfk_1` FOREIGN KEY (`answerId`) REFERENCES `forumAnswer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answerLike_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`addedById`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `articleAnswer`
--
ALTER TABLE `articleAnswer`
  ADD CONSTRAINT `articleAnswer_ibfk_1` FOREIGN KEY (`answerById`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articleAnswer_ibfk_2` FOREIGN KEY (`articleId`) REFERENCES `article` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`addedById`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forumAnswer`
--
ALTER TABLE `forumAnswer`
  ADD CONSTRAINT `forumAnswer_ibfk_1` FOREIGN KEY (`forumId`) REFERENCES `forum` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forumAnswer_ibfk_2` FOREIGN KEY (`answerById`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forumLike`
--
ALTER TABLE `forumLike`
  ADD CONSTRAINT `forumLike_ibfk_1` FOREIGN KEY (`forumId`) REFERENCES `forum` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forumLike_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forumView`
--
ALTER TABLE `forumView`
  ADD CONSTRAINT `forumView_ibfk_1` FOREIGN KEY (`forumId`) REFERENCES `forum` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forumView_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `informationalVideo`
--
ALTER TABLE `informationalVideo`
  ADD CONSTRAINT `informationalVideo_ibfk_1` FOREIGN KEY (`postedById`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recepieCategoryMap`
--
ALTER TABLE `recepieCategoryMap`
  ADD CONSTRAINT `recepieCategoryMap_ibfk_1` FOREIGN KEY (`recepieId`) REFERENCES `recepie` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainerMeta`
--
ALTER TABLE `trainerMeta`
  ADD CONSTRAINT `trainerMeta_ibfk_1` FOREIGN KEY (`trainerId`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
