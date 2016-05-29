-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2016 at 12:18 AM
-- Server version: 5.5.46-0ubuntu0.14.04.2-log
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `seng3150`
--
CREATE DATABASE IF NOT EXISTS `seng3150` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `seng3150`;

-- --------------------------------------------------------

--
-- Table structure for table `action_items`
--

CREATE TABLE IF NOT EXISTS `action_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `machine_general_test_id` int(11) DEFAULT NULL,
  `oil_test_id` int(11) DEFAULT NULL,
  `wear_test_id` int(11) DEFAULT NULL,
  `technician_id` int(11) DEFAULT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `issue` longtext COLLATE utf8_unicode_ci NOT NULL,
  `action` longtext COLLATE utf8_unicode_ci NOT NULL,
  `time_actioned` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6D025F123774302` (`machine_general_test_id`),
  UNIQUE KEY `UNIQ_6D025F13039B455` (`oil_test_id`),
  UNIQUE KEY `UNIQ_6D025F1E5C32A3E` (`wear_test_id`),
  KEY `IDX_6D025F1E6C5D496` (`technician_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Dumping data for table `action_items`
--

INSERT INTO `action_items` (`id`, `machine_general_test_id`, `oil_test_id`, `wear_test_id`, `technician_id`, `status`, `issue`, `action`, `time_actioned`) VALUES
(1, 1, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(2, 2, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(3, NULL, 1, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(4, NULL, 2, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(5, NULL, 3, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(6, NULL, 4, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(7, NULL, 5, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(8, NULL, 6, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(9, NULL, 7, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(10, NULL, 8, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(11, NULL, 9, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(12, NULL, 10, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(13, NULL, 11, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(14, NULL, NULL, 1, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(15, NULL, NULL, 2, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(16, NULL, NULL, 3, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(17, 3, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(18, NULL, 12, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(19, 4, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(20, NULL, 13, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(21, 5, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(22, NULL, 14, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(23, 6, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(24, NULL, 15, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(25, 7, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(26, NULL, 16, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(27, 8, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(28, NULL, 17, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(29, NULL, 18, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(30, NULL, NULL, 4, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(31, NULL, 19, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(32, NULL, NULL, 5, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(33, NULL, 20, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(34, NULL, NULL, 6, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(35, NULL, 21, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(36, NULL, NULL, 7, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(37, NULL, 22, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(38, NULL, NULL, 8, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(39, NULL, 23, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(40, NULL, NULL, 9, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(41, NULL, 24, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(42, NULL, NULL, 10, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(43, NULL, 25, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(44, NULL, NULL, 11, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` longtext COLLATE utf8_unicode_ci NOT NULL,
  `first_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `last_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `username`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'mitch', 'Mitchell', 'Davis', 'mitch@example.com', '$2a$12$1B5.xCjUpivSCNqsNCp2desyQAmGqIwDc7HTENLK6yBUBhMY0wgHO'),
(2, 'administrator', 'Administrator', 'Administrator', 'administrator@example.com', '$2a$12$2fKp5HyEmAvR8ool5/TWUeS2/xpus0gn3UbvdI9VB.jsnOi3vQfRK'),
(3, 'johnny', 'Johnny', 'Admin', 'johnny@example.com', '$2y$10$lgqGnyV8FmrzcSdV7i/eJ.wrNxSx4YCQ38MbtW1xkrpK4wq6qKP0K');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inspection_id` int(11) DEFAULT NULL,
  `major_assembly_id` int(11) DEFAULT NULL,
  `sub_assembly_id` int(11) DEFAULT NULL,
  `machine_general_test_id` int(11) DEFAULT NULL,
  `oil_test_id` int(11) DEFAULT NULL,
  `wear_test_id` int(11) DEFAULT NULL,
  `technician_id` int(11) DEFAULT NULL,
  `domain_expert_id` int(11) DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `time_commented` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5F9E962AF02F2DDF` (`inspection_id`),
  KEY `IDX_5F9E962AF50BDA8F` (`major_assembly_id`),
  KEY `IDX_5F9E962A2FD708D2` (`sub_assembly_id`),
  KEY `IDX_5F9E962AE6C5D496` (`technician_id`),
  KEY `IDX_5F9E962A23265EAA` (`domain_expert_id`),
  KEY `IDX_5F9E962A23774302` (`machine_general_test_id`),
  KEY `IDX_5F9E962A3039B455` (`oil_test_id`),
  KEY `IDX_5F9E962AE5C32A3E` (`wear_test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `inspection_id`, `major_assembly_id`, `sub_assembly_id`, `machine_general_test_id`, `oil_test_id`, `wear_test_id`, `technician_id`, `domain_expert_id`, `text`, `time_commented`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'Test comment.', '2016-05-10 17:21:00'),
(2, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 'Test comment.', '2016-05-10 17:37:00'),
(3, NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, 'Test comment.', '2016-05-10 17:37:00'),
(4, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 'Test comment.', '2016-05-10 17:37:00'),
(5, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, 'Test comment.', '2016-05-10 17:37:00'),
(6, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 'Test comment.', '2016-05-10 17:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `domain_experts`
--

CREATE TABLE IF NOT EXISTS `domain_experts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` longtext COLLATE utf8_unicode_ci NOT NULL,
  `first_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `last_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `domain_experts`
--

INSERT INTO `domain_experts` (`id`, `username`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'domainexpert', 'Domain', 'Expert', 'domainexpert@example.com', '$2a$12$uGfVGjPNWafUKRXU5zfwtuKbFsiS/oRUXvxS5JsUn6o.mAkuxV8c.'),
(2, 'frank', 'Frank', 'Expert', 'frank@example.com', '$2y$10$PHUfUAhs00UdJPFul/EFx.Mr9hP1fNkmm4FD5DPusJqCqx7od1noe');

-- --------------------------------------------------------

--
-- Table structure for table `inspections`
--

CREATE TABLE IF NOT EXISTS `inspections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `machine_id` int(11) DEFAULT NULL,
  `technician_id` int(11) DEFAULT NULL,
  `scheduler_id` int(11) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_scheduled` datetime DEFAULT NULL,
  `time_started` datetime DEFAULT NULL,
  `time_completed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_86254990F6B75B26` (`machine_id`),
  KEY `IDX_86254990E6C5D496` (`technician_id`),
  KEY `IDX_86254990A9D0F7D9` (`scheduler_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inspections`
--

INSERT INTO `inspections` (`id`, `machine_id`, `technician_id`, `scheduler_id`, `time_created`, `time_scheduled`, `time_started`, `time_completed`) VALUES
(1, 1, 1, 1, '2016-05-11 14:20:00', '2016-05-25 09:00:00', '2016-05-25 12:23:56', '2016-05-25 12:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `inspection_major_assemblies`
--

CREATE TABLE IF NOT EXISTS `inspection_major_assemblies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inspection_id` int(11) DEFAULT NULL,
  `major_assembly_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3B3925CAF02F2DDF` (`inspection_id`),
  KEY `IDX_3B3925CAF50BDA8F` (`major_assembly_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `inspection_major_assemblies`
--

INSERT INTO `inspection_major_assemblies` (`id`, `inspection_id`, `major_assembly_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `inspection_sub_assemblies`
--

CREATE TABLE IF NOT EXISTS `inspection_sub_assemblies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inspection_id` int(11) DEFAULT NULL,
  `major_assembly_id` int(11) DEFAULT NULL,
  `sub_assembly_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7EDC2D8EF02F2DDF` (`inspection_id`),
  KEY `IDX_7EDC2D8EF50BDA8F` (`major_assembly_id`),
  KEY `IDX_7EDC2D8E2FD708D2` (`sub_assembly_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `inspection_sub_assemblies`
--

INSERT INTO `inspection_sub_assemblies` (`id`, `inspection_id`, `major_assembly_id`, `sub_assembly_id`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 2, 3),
(4, 1, 2, 4),
(5, 1, 2, 5),
(6, 1, 2, 6),
(7, 1, 2, 7),
(8, 1, 2, 8),
(9, 1, 2, 9),
(10, 1, 2, 10),
(11, 1, 2, 11),
(12, 1, 2, 12),
(13, 1, 2, 13),
(14, 1, 3, 14),
(15, 1, 3, 15),
(16, 1, 3, 16),
(17, 1, 4, 17),
(18, 1, 4, 18),
(19, 1, 4, 19),
(20, 1, 4, 20),
(21, 1, 4, 21),
(22, 1, 4, 22),
(23, 1, 5, 23),
(24, 1, 5, 24),
(25, 1, 5, 25),
(26, 1, 5, 26),
(27, 1, 5, 27),
(28, 1, 5, 28),
(29, 1, 5, 29),
(30, 1, 5, 30);

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE IF NOT EXISTS `machines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_id` int(11) DEFAULT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F1CE8DED7975B7E7` (`model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`id`, `model_id`, `name`) VALUES
(1, 1, 'Machine 1'),
(2, 1, 'Machine 2');

-- --------------------------------------------------------

--
-- Table structure for table `major_assemblies`
--

CREATE TABLE IF NOT EXISTS `major_assemblies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_id` int(11) DEFAULT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CF992C667975B7E7` (`model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `major_assemblies`
--

INSERT INTO `major_assemblies` (`id`, `model_id`, `name`) VALUES
(1, 1, 'Hoist System (HST)'),
(2, 1, 'Crowd System (CWD)'),
(3, 1, 'Swing System (SWG)'),
(4, 1, 'Propel System (PPL)'),
(5, 1, 'Brakes');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE IF NOT EXISTS `models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `name`) VALUES
(1, '4100 XPC-AC Shovel');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inspection_id` int(11) DEFAULT NULL,
  `major_assembly_id` int(11) DEFAULT NULL,
  `sub_assembly_id` int(11) DEFAULT NULL,
  `machine_general_test_id` int(11) DEFAULT NULL,
  `oil_test_id` int(11) DEFAULT NULL,
  `wear_test_id` int(11) DEFAULT NULL,
  `technician_id` int(11) DEFAULT NULL,
  `domain_expert_id` int(11) DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `format` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_876E0D9F02F2DDF` (`inspection_id`),
  KEY `IDX_876E0D9F50BDA8F` (`major_assembly_id`),
  KEY `IDX_876E0D92FD708D2` (`sub_assembly_id`),
  KEY `IDX_876E0D923774302` (`machine_general_test_id`),
  KEY `IDX_876E0D93039B455` (`oil_test_id`),
  KEY `IDX_876E0D9E5C32A3E` (`wear_test_id`),
  KEY `IDX_876E0D9E6C5D496` (`technician_id`),
  KEY `IDX_876E0D923265EAA` (`domain_expert_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sub_assemblies`
--

CREATE TABLE IF NOT EXISTS `sub_assemblies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `major_assembly_id` int(11) DEFAULT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_73F3A10DF50BDA8F` (`major_assembly_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `sub_assemblies`
--

INSERT INTO `sub_assemblies` (`id`, `major_assembly_id`, `name`) VALUES
(1, 1, 'Hoist Ropes - House'),
(2, 1, 'Hoist Ropes - Equaliser'),
(3, 2, 'Crowd Motor Base'),
(4, 2, 'LH Saddle Block Bush'),
(5, 2, 'RH Saddle Block Bush'),
(6, 2, 'LV Saddle Block Wearplate'),
(7, 2, 'LH Saddle Block Wearplate'),
(8, 2, 'RV Saddle Block Wearplate'),
(9, 2, 'RH Saddle Block Wearplate'),
(10, 2, 'LH Crowd Rack'),
(11, 2, 'RH Crowd Rack'),
(12, 2, 'LH Crowd Pinion'),
(13, 2, 'RH Crowd Pinion'),
(14, 3, 'Roller Circle'),
(15, 3, 'Swing Pinion Gears'),
(16, 3, 'Swing Rear Gear'),
(17, 4, 'LHS Crawler Pads'),
(18, 4, 'RHS Crawler Pads'),
(19, 4, 'LHS Propel Idler Bush'),
(20, 4, 'RHS Propel Idler Bush'),
(21, 4, 'LHS Propel Guide Rail'),
(22, 4, 'RHS Propel Guide Rail'),
(23, 5, 'Front Hoist Brake'),
(24, 5, 'Rear Hoist Brake'),
(25, 5, 'Crowd Brake'),
(26, 5, 'Rear Swing Brake'),
(27, 5, 'RHF Swing Brake'),
(28, 5, 'LHF Swing Brake'),
(29, 5, 'RH Propel Brake'),
(30, 5, 'LH Propel Brake');

-- --------------------------------------------------------

--
-- Table structure for table `sub_assembly_tests`
--

CREATE TABLE IF NOT EXISTS `sub_assembly_tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_assembly_id` int(11) DEFAULT NULL,
  `machine_general` tinyint(1) NOT NULL,
  `machine_general_lower` decimal(10,5) DEFAULT NULL,
  `machine_general_upper` decimal(10,5) DEFAULT NULL,
  `oil` tinyint(1) NOT NULL,
  `oil_lower` decimal(10,5) DEFAULT NULL,
  `oil_upper` decimal(10,5) DEFAULT NULL,
  `wear` tinyint(1) NOT NULL,
  `wear_lower` decimal(10,5) DEFAULT NULL,
  `wear_upper` decimal(10,5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_55068B372FD708D2` (`sub_assembly_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `sub_assembly_tests`
--

INSERT INTO `sub_assembly_tests` (`id`, `sub_assembly_id`, `machine_general`, `machine_general_lower`, `machine_general_upper`, `oil`, `oil_lower`, `oil_upper`, `wear`, `wear_lower`, `wear_upper`) VALUES
(1, 1, 1, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL),
(2, 2, 1, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL),
(3, 3, 0, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(4, 4, 0, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(5, 5, 0, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(6, 6, 0, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(7, 7, 0, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(8, 8, 0, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(9, 9, 0, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(10, 10, 0, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(11, 11, 0, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(12, 12, 0, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(13, 13, 0, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(14, 14, 0, NULL, NULL, 0, NULL, NULL, 1, NULL, NULL),
(15, 15, 0, NULL, NULL, 0, NULL, NULL, 1, NULL, NULL),
(16, 16, 0, NULL, NULL, 0, NULL, NULL, 1, NULL, NULL),
(17, 17, 1, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(18, 18, 1, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(19, 19, 1, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(20, 20, 1, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(21, 21, 1, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(22, 22, 1, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(23, 23, 0, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL),
(24, 24, 0, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL),
(25, 25, 0, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL),
(26, 26, 0, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL),
(27, 27, 0, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL),
(28, 28, 0, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL),
(29, 29, 0, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL),
(30, 30, 0, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE IF NOT EXISTS `technicians` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` longtext COLLATE utf8_unicode_ci NOT NULL,
  `first_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `last_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `temporary` tinyint(1) NOT NULL,
  `login_expires_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `temporary`, `login_expires_time`) VALUES
(1, 'technician', 'Technician', 'Technician', 'technician@example.com', '$2a$12$R51y./7/iNSEZamYgC0RWuz/bSweRgw1GnBsIC0jgZRuVSy4zfzj2', 0, NULL),
(2, 'temp', 'Temporary', 'Technician', 'temporary-technician@example.com', '$2a$12$R51y./7/iNSEZamYgC0RWuz/bSweRgw1GnBsIC0jgZRuVSy4zfzj2', 1, '2016-05-31 23:59:59'),
(3, 'albert', 'Albert', 'Tech', 'albert@example.com', '$2y$10$VBH43BZ7xkYRtKMYEi2YX.rTSxPzCYb6CXc2ehnXXUWCWCRMz6h8m', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tests_machine_general`
--

CREATE TABLE IF NOT EXISTS `tests_machine_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inspection_id` int(11) DEFAULT NULL,
  `sub_assembly_id` int(11) DEFAULT NULL,
  `test_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `doc_link` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8FE60922FD708D2` (`sub_assembly_id`),
  KEY `IDX_8FE6092F02F2DDF` (`inspection_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tests_machine_general`
--

INSERT INTO `tests_machine_general` (`id`, `inspection_id`, `sub_assembly_id`, `test_type`, `doc_link`) VALUES
(1, 1, 1, 'Type A', 'ABC'),
(2, 1, 2, 'Type A', 'ABC'),
(3, 1, 17, 'Type A', 'ABC'),
(4, 1, 18, 'Type A', 'ABC'),
(5, 1, 19, 'Type A', 'ABC'),
(6, 1, 20, 'Type A', 'ABC'),
(7, 1, 21, 'Type A', 'ABC'),
(8, 1, 22, 'Type A', 'ABC');

-- --------------------------------------------------------

--
-- Table structure for table `tests_oil`
--

CREATE TABLE IF NOT EXISTS `tests_oil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inspection_id` int(11) DEFAULT NULL,
  `sub_assembly_id` int(11) DEFAULT NULL,
  `lead` int(11) NOT NULL,
  `copper` int(11) NOT NULL,
  `tin` int(11) NOT NULL,
  `iron` int(11) NOT NULL,
  `pq90` int(11) NOT NULL,
  `silicon` int(11) NOT NULL,
  `sodium` int(11) NOT NULL,
  `aluminium` int(11) NOT NULL,
  `water` decimal(10,5) DEFAULT NULL,
  `viscosity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D259A22FD708D2` (`sub_assembly_id`),
  KEY `IDX_D259A2F02F2DDF` (`inspection_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tests_oil`
--

INSERT INTO `tests_oil` (`id`, `inspection_id`, `sub_assembly_id`, `lead`, `copper`, `tin`, `iron`, `pq90`, `silicon`, `sodium`, `aluminium`, `water`, `viscosity`) VALUES
(1, 1, 3, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(2, 1, 4, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(3, 1, 5, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(4, 1, 6, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(5, 1, 7, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(6, 1, 8, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(7, 1, 9, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(8, 1, 10, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(9, 1, 11, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(10, 1, 12, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(11, 1, 13, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(12, 1, 17, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(13, 1, 18, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(14, 1, 19, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(15, 1, 20, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(16, 1, 21, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(17, 1, 22, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(18, 1, 23, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(19, 1, 24, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(20, 1, 25, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(21, 1, 26, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(22, 1, 27, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(23, 1, 28, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(24, 1, 29, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(25, 1, 30, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tests_wear`
--

CREATE TABLE IF NOT EXISTS `tests_wear` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inspection_id` int(11) DEFAULT NULL,
  `sub_assembly_id` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `new` longtext COLLATE utf8_unicode_ci NOT NULL,
  `test_limit` longtext COLLATE utf8_unicode_ci NOT NULL,
  `life_lower` longtext COLLATE utf8_unicode_ci NOT NULL,
  `life_upper` longtext COLLATE utf8_unicode_ci NOT NULL,
  `smu` int(11) NOT NULL,
  `time_started` datetime NOT NULL,
  `unique_details` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7DC817592FD708D2` (`sub_assembly_id`),
  KEY `IDX_7DC81759F02F2DDF` (`inspection_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tests_wear`
--

INSERT INTO `tests_wear` (`id`, `inspection_id`, `sub_assembly_id`, `description`, `new`, `limit`, `life_lower`, `life_upper`, `smu`, `time_started`, `unique_details`) VALUES
(1, 1, 14, 'Desc', 'New', 'Limit', 'Lower', 'Upper', 0, '2016-05-14 17:00:00', 'a:2:{s:4:"Test";s:15:"serialize here!";s:1:"A";s:1:"B";}'),
(2, 1, 15, 'Desc', 'New', 'Limit', 'Lower', 'Upper', 0, '2016-05-14 17:00:00', 'a:2:{s:4:"Test";s:15:"serialize here!";s:1:"A";s:1:"B";}'),
(3, 1, 16, 'Desc', 'New', 'Limit', 'Lower', 'Upper', 0, '2016-05-14 17:00:00', 'a:2:{s:4:"Test";s:15:"serialize here!";s:1:"A";s:1:"B";}'),
(4, 1, 23, 'Desc', 'New', 'Limit', 'Lower', 'Upper', 0, '2016-05-14 17:00:00', 'a:2:{s:4:"Test";s:15:"serialize here!";s:1:"A";s:1:"B";}'),
(5, 1, 24, 'Desc', 'New', 'Limit', 'Lower', 'Upper', 0, '2016-05-14 17:00:00', 'a:2:{s:4:"Test";s:15:"serialize here!";s:1:"A";s:1:"B";}'),
(6, 1, 25, 'Desc', 'New', 'Limit', 'Lower', 'Upper', 0, '2016-05-14 17:00:00', 'a:2:{s:4:"Test";s:15:"serialize here!";s:1:"A";s:1:"B";}'),
(7, 1, 26, 'Desc', 'New', 'Limit', 'Lower', 'Upper', 0, '2016-05-14 17:00:00', 'a:2:{s:4:"Test";s:15:"serialize here!";s:1:"A";s:1:"B";}'),
(8, 1, 27, 'Desc', 'New', 'Limit', 'Lower', 'Upper', 0, '2016-05-14 17:00:00', 'a:2:{s:4:"Test";s:15:"serialize here!";s:1:"A";s:1:"B";}'),
(9, 1, 28, 'Desc', 'New', 'Limit', 'Lower', 'Upper', 0, '2016-05-14 17:00:00', 'a:2:{s:4:"Test";s:15:"serialize here!";s:1:"A";s:1:"B";}'),
(10, 1, 29, 'Desc', 'New', 'Limit', 'Lower', 'Upper', 0, '2016-05-14 17:00:00', 'a:2:{s:4:"Test";s:15:"serialize here!";s:1:"A";s:1:"B";}'),
(11, 1, 30, 'Desc', 'New', 'Limit', 'Lower', 'Upper', 0, '2016-05-14 17:00:00', 'a:2:{s:4:"Test";s:15:"serialize here!";s:1:"A";s:1:"B";}');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action_items`
--
ALTER TABLE `action_items`
  ADD CONSTRAINT `FK_6D025F123774302` FOREIGN KEY (`machine_general_test_id`) REFERENCES `tests_machine_general` (`id`),
  ADD CONSTRAINT `FK_6D025F13039B455` FOREIGN KEY (`oil_test_id`) REFERENCES `tests_oil` (`id`),
  ADD CONSTRAINT `FK_6D025F1E5C32A3E` FOREIGN KEY (`wear_test_id`) REFERENCES `tests_wear` (`id`),
  ADD CONSTRAINT `FK_6D025F1E6C5D496` FOREIGN KEY (`technician_id`) REFERENCES `technicians` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962A23265EAA` FOREIGN KEY (`domain_expert_id`) REFERENCES `domain_experts` (`id`),
  ADD CONSTRAINT `FK_5F9E962A23774302` FOREIGN KEY (`machine_general_test_id`) REFERENCES `tests_machine_general` (`id`),
  ADD CONSTRAINT `FK_5F9E962A2FD708D2` FOREIGN KEY (`sub_assembly_id`) REFERENCES `inspection_sub_assemblies` (`id`),
  ADD CONSTRAINT `FK_5F9E962A3039B455` FOREIGN KEY (`oil_test_id`) REFERENCES `tests_oil` (`id`),
  ADD CONSTRAINT `FK_5F9E962AE5C32A3E` FOREIGN KEY (`wear_test_id`) REFERENCES `tests_wear` (`id`),
  ADD CONSTRAINT `FK_5F9E962AE6C5D496` FOREIGN KEY (`technician_id`) REFERENCES `technicians` (`id`),
  ADD CONSTRAINT `FK_5F9E962AF02F2DDF` FOREIGN KEY (`inspection_id`) REFERENCES `inspections` (`id`),
  ADD CONSTRAINT `FK_5F9E962AF50BDA8F` FOREIGN KEY (`major_assembly_id`) REFERENCES `inspection_major_assemblies` (`id`);

--
-- Constraints for table `inspections`
--
ALTER TABLE `inspections`
  ADD CONSTRAINT `FK_86254990A9D0F7D9` FOREIGN KEY (`scheduler_id`) REFERENCES `domain_experts` (`id`),
  ADD CONSTRAINT `FK_86254990E6C5D496` FOREIGN KEY (`technician_id`) REFERENCES `technicians` (`id`),
  ADD CONSTRAINT `FK_86254990F6B75B26` FOREIGN KEY (`machine_id`) REFERENCES `machines` (`id`);

--
-- Constraints for table `inspection_major_assemblies`
--
ALTER TABLE `inspection_major_assemblies`
  ADD CONSTRAINT `FK_3B3925CAF02F2DDF` FOREIGN KEY (`inspection_id`) REFERENCES `inspections` (`id`),
  ADD CONSTRAINT `FK_3B3925CAF50BDA8F` FOREIGN KEY (`major_assembly_id`) REFERENCES `major_assemblies` (`id`);

--
-- Constraints for table `inspection_sub_assemblies`
--
ALTER TABLE `inspection_sub_assemblies`
  ADD CONSTRAINT `FK_7EDC2D8E2FD708D2` FOREIGN KEY (`sub_assembly_id`) REFERENCES `sub_assemblies` (`id`),
  ADD CONSTRAINT `FK_7EDC2D8EF02F2DDF` FOREIGN KEY (`inspection_id`) REFERENCES `inspections` (`id`),
  ADD CONSTRAINT `FK_7EDC2D8EF50BDA8F` FOREIGN KEY (`major_assembly_id`) REFERENCES `inspection_major_assemblies` (`id`);

--
-- Constraints for table `machines`
--
ALTER TABLE `machines`
  ADD CONSTRAINT `FK_F1CE8DED7975B7E7` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`);

--
-- Constraints for table `major_assemblies`
--
ALTER TABLE `major_assemblies`
  ADD CONSTRAINT `FK_CF992C66F6B75B26` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`);

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `FK_876E0D923265EAA` FOREIGN KEY (`domain_expert_id`) REFERENCES `domain_experts` (`id`),
  ADD CONSTRAINT `FK_876E0D923774302` FOREIGN KEY (`machine_general_test_id`) REFERENCES `tests_machine_general` (`id`),
  ADD CONSTRAINT `FK_876E0D92FD708D2` FOREIGN KEY (`sub_assembly_id`) REFERENCES `inspection_sub_assemblies` (`id`),
  ADD CONSTRAINT `FK_876E0D93039B455` FOREIGN KEY (`oil_test_id`) REFERENCES `tests_oil` (`id`),
  ADD CONSTRAINT `FK_876E0D9E5C32A3E` FOREIGN KEY (`wear_test_id`) REFERENCES `tests_wear` (`id`),
  ADD CONSTRAINT `FK_876E0D9E6C5D496` FOREIGN KEY (`technician_id`) REFERENCES `technicians` (`id`),
  ADD CONSTRAINT `FK_876E0D9F02F2DDF` FOREIGN KEY (`inspection_id`) REFERENCES `inspections` (`id`),
  ADD CONSTRAINT `FK_876E0D9F50BDA8F` FOREIGN KEY (`major_assembly_id`) REFERENCES `inspection_major_assemblies` (`id`);

--
-- Constraints for table `sub_assemblies`
--
ALTER TABLE `sub_assemblies`
  ADD CONSTRAINT `FK_73F3A10DF50BDA8F` FOREIGN KEY (`major_assembly_id`) REFERENCES `major_assemblies` (`id`);

--
-- Constraints for table `sub_assembly_tests`
--
ALTER TABLE `sub_assembly_tests`
  ADD CONSTRAINT `FK_55068B372FD708D2` FOREIGN KEY (`sub_assembly_id`) REFERENCES `sub_assemblies` (`id`);

--
-- Constraints for table `tests_machine_general`
--
ALTER TABLE `tests_machine_general`
  ADD CONSTRAINT `FK_8FE60922FD708D2` FOREIGN KEY (`sub_assembly_id`) REFERENCES `inspection_sub_assemblies` (`id`),
  ADD CONSTRAINT `FK_8FE6092F02F2DDF` FOREIGN KEY (`inspection_id`) REFERENCES `inspections` (`id`);

--
-- Constraints for table `tests_oil`
--
ALTER TABLE `tests_oil`
  ADD CONSTRAINT `FK_D259A22FD708D2` FOREIGN KEY (`sub_assembly_id`) REFERENCES `inspection_sub_assemblies` (`id`),
  ADD CONSTRAINT `FK_D259A2F02F2DDF` FOREIGN KEY (`inspection_id`) REFERENCES `inspections` (`id`);

--
-- Constraints for table `tests_wear`
--
ALTER TABLE `tests_wear`
  ADD CONSTRAINT `FK_7DC817592FD708D2` FOREIGN KEY (`sub_assembly_id`) REFERENCES `inspection_sub_assemblies` (`id`),
  ADD CONSTRAINT `FK_7DC81759F02F2DDF` FOREIGN KEY (`inspection_id`) REFERENCES `inspections` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
