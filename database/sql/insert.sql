-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2016 at 05:53 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2-log
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Dumping data for table `action_items`
--

INSERT INTO `action_items` (`machine_general_test_id`, `oil_test_id`, `wear_test_id`, `technician_id`, `status`, `issue`, `action`, `time_actioned`) VALUES
(1, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(2, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 1, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 2, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 3, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 4, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 5, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 6, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 7, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 8, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 9, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 10, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 11, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, NULL, 1, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, NULL, 2, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, NULL, 3, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(3, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 12, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(4, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 13, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(5, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 14, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(6, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 15, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(7, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 16, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(8, NULL, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 17, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 18, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, NULL, 4, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 19, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, NULL, 5, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 20, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, NULL, 6, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 21, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, NULL, 7, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 22, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, NULL, 8, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 23, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, NULL, 9, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 24, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, NULL, 10, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, 25, NULL, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00'),
(NULL, NULL, 11, 1, 'OK', 'Issue', 'Action', '2016-05-14 17:00:00');

-- --------------------------------------------------------

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`username`, `first_name`, `last_name`, `email`, `password`, `deleted`, `time_deleted`) VALUES
('mitch', 'Mitchell', 'Davis', 'mitch@example.com', '$2a$12$1B5.xCjUpivSCNqsNCp2desyQAmGqIwDc7HTENLK6yBUBhMY0wgHO', 0, NULL),
('administrator', 'Administrator', 'Administrator', 'administrator@example.com', '$2a$12$2fKp5HyEmAvR8ool5/TWUeS2/xpus0gn3UbvdI9VB.jsnOi3vQfRK', 0, NULL),
('johnny', 'Johnny', 'Admin', 'johnny@example.com', '$2y$10$lgqGnyV8FmrzcSdV7i/eJ.wrNxSx4YCQ38MbtW1xkrpK4wq6qKP0K', 0, NULL);

-- --------------------------------------------------------

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`inspection_id`, `major_assembly_id`, `sub_assembly_id`, `machine_general_test_id`, `oil_test_id`, `wear_test_id`, `technician_id`, `domain_expert_id`, `text`, `time_commented`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'Test comment.', '2016-05-10 17:21:00'),
(NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 'Test comment.', '2016-05-10 17:37:00'),
(NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, 'Test comment.', '2016-05-10 17:37:00'),
(NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 'Test comment.', '2016-05-10 17:37:00'),
(NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, 'Test comment.', '2016-05-10 17:37:00'),
(NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 'Test comment.', '2016-05-10 17:37:00');

-- --------------------------------------------------------

--
-- Dumping data for table `domain_experts`
--

INSERT INTO `domain_experts` (`username`, `first_name`, `last_name`, `email`, `password`, `deleted`, `time_deleted`) VALUES
('domainexpert', 'Domain', 'Expert', 'mitch@wingmanwebdesign.com.au', '$2a$12$uGfVGjPNWafUKRXU5zfwtuKbFsiS/oRUXvxS5JsUn6o.mAkuxV8c.', 0, NULL),
('frank', 'Frank', 'Expert', 'frank@example.com', '$2y$10$PHUfUAhs00UdJPFul/EFx.Mr9hP1fNkmm4FD5DPusJqCqx7od1noe', 0, NULL);

-- --------------------------------------------------------

--
-- Dumping data for table `downtime_data`
--

INSERT INTO `downtime_data` (`machine_id`, `systemName`, `downTimeHours`, `reason`) VALUES
(1, 'S343', '0.10000', 'ELECTRICAL'),
(1, 'S343', '0.50000', 'SCHED MAINT'),
(1, 'S343', '0.20000', 'BUCKET'),
(1, 'S343', '0.00000', 'BUCKET'),
(1, 'S343', '0.90000', 'BUCKET'),
(1, 'S343', '0.30000', 'PRE-MAINT INSPECT'),
(1, 'S343', '11.20000', 'SCHED MAINT'),
(1, 'S343', '11.00000', 'SCHED MAINT'),
(1, 'S343', '2.90000', 'SL OVERRUN'),
(1, 'S343', '0.20000', 'ENGINE'),
(1, 'S343', '3.70000', 'SCHED MAINT'),
(1, 'S343', '0.50000', 'SWING SYS'),
(1, 'S343', '1.20000', 'ELECTRICAL'),
(1, 'S343', '4.20000', 'SCHED MAINT'),
(1, 'S343', '0.70000', 'BOOM'),
(1, 'S343', '1.90000', 'BOOM'),
(1, 'S343', '0.90000', 'ELECTRICAL');

-- --------------------------------------------------------

--
-- Dumping data for table `inspections`
--

INSERT INTO `inspections` (`machine_id`, `technician_id`, `scheduler_id`, `schedule_id`, `time_created`, `time_scheduled`, `time_started`, `time_completed`, `deleted`, `time_deleted`) VALUES
(1, 1, 1, NULL, '2016-08-26 10:00:00', '2016-08-26 12:00:00', '2016-08-26 12:00:00', '2016-08-26 14:00:00', 0, NULL),
(1, 3, 1, NULL, '2016-10-18 19:10:03', '2016-10-25 19:09:40', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Dumping data for table `inspection_major_assemblies`
--

INSERT INTO `inspection_major_assemblies` (`inspection_id`, `major_assembly_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 1);

-- --------------------------------------------------------

--
-- Dumping data for table `inspection_schedules`
--

INSERT INTO `inspection_schedules` (`inspection_id`, `value`, `period`, `time_deleted`, `deleted`) VALUES
(2, 1, 'years', NULL, 0);

-- --------------------------------------------------------

--
-- Dumping data for table `inspection_sub_assemblies`
--

INSERT INTO `inspection_sub_assemblies` (`inspection_id`, `major_assembly_id`, `sub_assembly_id`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 2, 3),
(1, 2, 4),
(1, 2, 5),
(1, 2, 6),
(1, 2, 7),
(1, 2, 8),
(1, 2, 9),
(1, 2, 10),
(1, 2, 11),
(1, 2, 12),
(1, 2, 13),
(1, 3, 14),
(1, 3, 15),
(1, 3, 16),
(1, 4, 17),
(1, 4, 18),
(1, 4, 19),
(1, 4, 20),
(1, 4, 21),
(1, 4, 22),
(1, 5, 23),
(1, 5, 24),
(1, 5, 25),
(1, 5, 26),
(1, 5, 27),
(1, 5, 28),
(1, 5, 29),
(1, 5, 30),
(2, 7, 1);

-- --------------------------------------------------------

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`model_id`, `name`, `deleted`, `time_deleted`) VALUES
(1, 'Machine 1', 0, NULL),
(1, 'Machine 2', 0, NULL),
(2, 'Machine 4', 0, NULL),
(5, 'Machine 5', 0, NULL);

-- --------------------------------------------------------

--
-- Dumping data for table `major_assemblies`
--

INSERT INTO `major_assemblies` (`model_id`, `name`, `time_deleted`, `deleted`) VALUES
(1, 'Hoist System (HST)', NULL, 0),
(1, 'Crowd System (CWD)', NULL, 0),
(1, 'Swing System (SWG)', NULL, 0),
(1, 'Propel System (PPL)', NULL, 0),
(1, 'Brakes', NULL, 0),
(5, 'Major Assembly 1', NULL, 0),
(5, 'Major Assembly 2', NULL, 0),
(5, 'Major Assembly 3', NULL, 0),
(5, 'Major Assembly 4', NULL, 0),
(5, 'Major Assembly 5', NULL, 0),
(5, 'Major Assembly 6', NULL, 0),
(4, 'Major Assembly 1', NULL, 0);

-- --------------------------------------------------------

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`name`, `deleted`, `time_deleted`) VALUES
('4100 XPC-AC Shovel', 0, NULL),
('Model 2', 0, NULL),
('Model 3', 0, NULL),
('Model 4', 0, NULL),
('Model 5', 0, NULL);

-- --------------------------------------------------------

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`inspection_id`, `major_assembly_id`, `sub_assembly_id`, `machine_general_test_id`, `oil_test_id`, `wear_test_id`, `technician_id`, `domain_expert_id`, `text`, `format`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'jpeg');

-- --------------------------------------------------------

--
-- Dumping data for table `sub_assemblies`
--

INSERT INTO `sub_assemblies` (`major_assembly_id`, `name`, `machine_general`, `oil`, `wear`, `unique_details`, `time_deleted`, `deleted`) VALUES
(1, 'Hoist Ropes - House', 1, 0, 0, 'a:0:{}', NULL, 0),
(1, 'Hoist Ropes - Equaliser', 1, 0, 0, 'a:0:{}', NULL, 0),
(2,'Crowd Motor Base', 0, 1, 0, 'a:0:{}', NULL, 0),
(2, 'LH Saddle Block Bush', 0, 1, 0, 'a:0:{}', NULL, 0),
(2, 'RH Saddle Block Bush', 0, 1, 0, 'a:0:{}', NULL, 0),
(2, 'LV Saddle Block Wearplate', 0, 1, 0, 'a:0:{}', NULL, 0),
(2, 'LH Saddle Block Wearplate', 0, 1, 0, 'a:0:{}', NULL, 0),
(2, 'RV Saddle Block Wearplate', 0, 1, 0, 'a:0:{}', NULL, 0),
(2, 'RH Saddle Block Wearplate', 0, 1, 0, 'a:0:{}', NULL, 0),
(2, 'LH Crowd Rack', 0, 1, 0, 'a:0:{}', NULL, 0),
(2, 'RH Crowd Rack', 0, 1, 0, 'a:0:{}', NULL, 0),
(2, 'LH Crowd Pinion', 0, 1, 0, 'a:0:{}', NULL, 0),
(2, 'RH Crowd Pinion', 0, 1, 0, 'a:0:{}', NULL, 0),
(3, 'Roller Circle', 0, 0, 1, 'a:2:{i:0;s:7:"Field 1";i:1;s:7:"Field 2";}', NULL, 0),
(3, 'Swing Pinion Gears', 0, 0, 1, 'a:2:{i:0;s:7:"Field 1";i:1;s:7:"Field 2";}', NULL, 0),
(3, 'Swing Rear Gear', 0, 0, 1, 'a:2:{i:0;s:7:"Field 1";i:1;s:7:"Field 2";}', NULL, 0),
(4, 'LHS Crawler Pads', 1, 1, 0, 'a:0:{}', NULL, 0),
(4, 'RHS Crawler Pads', 1, 1, 0, 'a:0:{}', NULL, 0),
(4, 'LHS Propel Idler Bush', 1, 1, 0, 'a:0:{}', NULL, 0),
(4, 'RHS Propel Idler Bush', 1, 1, 0, 'a:0:{}', NULL, 0),
(4, 'LHS Propel Guide Rail', 1, 1, 0, 'a:0:{}', NULL, 0),
(4, 'RHS Propel Guide Rail', 1, 1, 0, 'a:0:{}', NULL, 0),
(5, 'Front Hoist Brake', 0, 1, 1, 'a:2:{i:0;s:7:"Field 1";i:1;s:7:"Field 2";}', NULL, 0),
(5, 'Rear Hoist Brake', 0, 1, 1, 'a:2:{i:0;s:7:"Field 1";i:1;s:7:"Field 2";}', NULL, 0),
(5, 'Crowd Brake', 0, 1, 1, 'a:2:{i:0;s:7:"Field 1";i:1;s:7:"Field 2";}', NULL, 0),
(5, 'Rear Swing Brake', 0, 1, 1, 'a:2:{i:0;s:7:"Field 1";i:1;s:7:"Field 2";}', NULL, 0),
(5, 'RHF Swing Brake', 0, 1, 1, 'a:2:{i:0;s:7:"Field 1";i:1;s:7:"Field 2";}', NULL, 0),
(5, 'LHF Swing Brake', 0, 1, 1, 'a:2:{i:0;s:7:"Field 1";i:1;s:7:"Field 2";}', NULL, 0),
(5, 'RH Propel Brake', 0, 1, 1, 'a:2:{i:0;s:7:"Field 1";i:1;s:7:"Field 2";}', NULL, 0),
(5, 'LH Propel Brake', 0, 1, 1, 'a:2:{i:0;s:7:"Field 1";i:1;s:7:"Field 2";}', NULL, 0),
(6, 'Sub Assembly 1', 1, 0, 0, 'a:0:{}', NULL, 0),
(12, '1', 0, 1, 0, 'a:0:{}', NULL, 0);

-- --------------------------------------------------------

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`username`, `first_name`, `last_name`, `email`, `password`, `temporary`, `login_expires_time`, `deleted`, `time_deleted`) VALUES
('technician', 'Technician', 'Technician', 'technician@example.com', '$2a$12$R51y./7/iNSEZamYgC0RWuz/bSweRgw1GnBsIC0jgZRuVSy4zfzj2', 0, NULL, 0, NULL),
('temp', 'Temporary', 'Technician', 'temporary-technician@example.com', '$2a$12$R51y./7/iNSEZamYgC0RWuz/bSweRgw1GnBsIC0jgZRuVSy4zfzj2', 1, '2016-05-31 23:59:59', 0, NULL),
('albert', 'Albert', 'Tech', 'albert@example.com', '$2y$10$VBH43BZ7xkYRtKMYEi2YX.rTSxPzCYb6CXc2ehnXXUWCWCRMz6h8m', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Dumping data for table `tests_machine_general`
--

INSERT INTO `tests_machine_general` (`inspection_id`, `sub_assembly_id`) VALUES
(1, 1),
(1, 2),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(2, 7);

-- --------------------------------------------------------

--
-- Dumping data for table `tests_oil`
--

INSERT INTO `tests_oil` (`inspection_id`, `sub_assembly_id`, `lead`, `copper`, `tin`, `iron`, `pq90`, `silicon`, `sodium`, `aluminium`, `water`, `viscosity`) VALUES
(1, 3, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 4, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 5, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 6, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 7, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 8, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 9, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 10, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 11, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 12, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 13, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 17, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 18, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 19, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 20, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 21, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 22, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 23, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 24, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 25, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 26, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 27, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 28, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 29, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(1, 30, 1, 2, 3, 4, 5, 6, 7, 8, 9.50000, 10),
(2, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0.00000', 0);

-- --------------------------------------------------------

--
-- Dumping data for table `tests_wear`
--

INSERT INTO `tests_wear` (`inspection_id`, `sub_assembly_id`, `smu`, `unique_details`) VALUES
(1, 14, 0, 'a:2:{s:7:"Field 1";s:7:"Value 1";s:7:"Field 2";s:7:"Value 2";}'),
(1, 15, 0, 'a:2:{s:7:"Field 1";s:7:"Value 1";s:7:"Field 2";s:7:"Value 2";}'),
(1, 16, 0, 'a:2:{s:7:"Field 1";s:7:"Value 1";s:7:"Field 2";s:7:"Value 2";}'),
(1, 23, 0, 'a:2:{s:7:"Field 1";s:7:"Value 1";s:7:"Field 2";s:7:"Value 2";}'),
(1, 24, 0, 'a:2:{s:7:"Field 1";s:7:"Value 1";s:7:"Field 2";s:7:"Value 2";}'),
(1, 25, 0, 'a:2:{s:7:"Field 1";s:7:"Value 1";s:7:"Field 2";s:7:"Value 2";}'),
(1, 26, 0, 'a:2:{s:7:"Field 1";s:7:"Value 1";s:7:"Field 2";s:7:"Value 2";}'),
(1, 27, 0, 'a:2:{s:7:"Field 1";s:7:"Value 1";s:7:"Field 2";s:7:"Value 2";}'),
(1, 28, 0, 'a:2:{s:7:"Field 1";s:7:"Value 1";s:7:"Field 2";s:7:"Value 2";}'),
(1, 29, 0, 'a:2:{s:7:"Field 1";s:7:"Value 1";s:7:"Field 2";s:7:"Value 2";}'),
(1, 30, 0, 'a:2:{s:7:"Field 1";s:7:"Value 1";s:7:"Field 2";s:7:"Value 2";}'),
(2, 1, 0, 'a:2:{s:7:"Field 1";s:7:"Value 1";s:7:"Field 2";s:7:"Value 2";}');