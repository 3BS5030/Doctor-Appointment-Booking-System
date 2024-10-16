-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 07:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_db`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `booking`
-- (See below for the actual view)
--
CREATE TABLE `booking` (
`doctor_id` int(11)
,`doctor_name` varchar(100)
,`department_id` int(11)
,`department_name` varchar(100)
,`patient_id` int(11)
,`patient_name` varchar(150)
,`time` varchar(150)
,`day` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`) VALUES
(21, 'Gastrology'),
(22, 'Dentistry');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `time` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `day` varchar(50) NOT NULL,
  `image` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `department_id`, `time`, `day`, `image`) VALUES
(29, 'abdelrahman Ali ', NULL, '12 PM', 'wednesday', '463download (1).jpeg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `doctors_and_departments`
-- (See below for the actual view)
--
CREATE TABLE `doctors_and_departments` (
`id` int(11)
,`name` varchar(100)
,`department_id` int(11)
,`time` varchar(50)
,`day` varchar(50)
,`image` varchar(150)
,`doctor_id` int(11)
,`department_name` varchar(100)
,`doctor_image` varchar(150)
);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `time` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `day` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `doctor_id`, `time`, `day`) VALUES
(4, 'Jerome Gibson', 29, '12 PM', 'wednesday'),
(5, 'ahmed', 29, '12 PM', 'wednesday'),
(6, '', NULL, '7 PM', 'wednesday'),
(7, 'Elmo Rice', NULL, '7 PM', 'wednesday'),
(8, '', NULL, '3 PM', 'wednesday'),
(9, '', NULL, '1 AM', 'saturday'),
(10, 'abdelrahman Ali ', NULL, '2 PM', 'saturday'),
(11, 'ahmed ali', NULL, '2 PM', 'saturday'),
(12, 'Charles Clemons', NULL, '1 AM', 'sunday'),
(13, 'Anne Cohen', NULL, '7 AM', 'monday');

-- --------------------------------------------------------

--
-- Structure for view `booking`
--
DROP TABLE IF EXISTS `booking`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `booking`  AS SELECT `doctors`.`id` AS `doctor_id`, `doctors`.`name` AS `doctor_name`, `department`.`id` AS `department_id`, `department`.`department_name` AS `department_name`, `patient`.`id` AS `patient_id`, `patient`.`name` AS `patient_name`, `patient`.`time` AS `time`, `patient`.`day` AS `day` FROM ((`doctors` join `department` on(`doctors`.`department_id` = `department`.`id`)) join `patient` on(`patient`.`doctor_id` = `doctors`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `doctors_and_departments`
--
DROP TABLE IF EXISTS `doctors_and_departments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `doctors_and_departments`  AS SELECT `doctors`.`id` AS `id`, `doctors`.`name` AS `name`, `doctors`.`department_id` AS `department_id`, `doctors`.`time` AS `time`, `doctors`.`day` AS `day`, `doctors`.`image` AS `image`, `doctors`.`id` AS `doctor_id`, `department`.`department_name` AS `department_name`, `doctors`.`image` AS `doctor_image` FROM (`doctors` join `department` on(`doctors`.`department_id` = `department`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
