-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Apr 11, 2024 at 10:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scholarship_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `admin_id` varchar(128) NOT NULL,
  `admin_name` varchar(128) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`admin_id`, `admin_name`, `password`) VALUES
('kushallgowda97@gmail.com', 'Kushal', 'admin@1234');

-- --------------------------------------------------------

--
-- Table structure for table `issued`
--

CREATE TABLE `issued` (
  `user_id` int(10) NOT NULL,
  `applicant_name` varchar(128) NOT NULL,
  `applied_clause` varchar(2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_issued` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `issued`
--
DELIMITER $$
CREATE TRIGGER `date_update` AFTER INSERT ON `issued` FOR EACH ROW UPDATE issued
SET date_issued = CURRENT_TIMESTAMP
WHERE user_id = new.user_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pgapplication`
--

CREATE TABLE `pgapplication` (
  `user_id` int(10) NOT NULL,
  `applicant_name` varchar(128) NOT NULL,
  `email` varchar(225) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `father_name` varchar(128) NOT NULL,
  `mother_name` varchar(128) NOT NULL,
  `dob` date NOT NULL,
  `12th_reg_no` int(6) NOT NULL,
  `12th_percent` varchar(5) NOT NULL,
  `12th_college_name` varchar(255) NOT NULL,
  `applied_clause` char(2) NOT NULL,
  `degree` varchar(128) NOT NULL,
  `course` varchar(200) NOT NULL,
  `uni_name` varchar(150) NOT NULL,
  `college_name` varchar(50) NOT NULL,
  `college_city` varchar(20) NOT NULL,
  `uni_reg_no` int(14) NOT NULL,
  `course_dur` int(11) NOT NULL,
  `curr_study_year` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Submitted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `pgapplication`
--
DELIMITER $$
CREATE TRIGGER `status_trigger_1` AFTER UPDATE ON `pgapplication` FOR EACH ROW INSERT INTO issued (
    SELECT user_id, applicant_name, applied_clause, 		status 
    FROM pgapplication WHERE new.status = "issued"
	)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ugapplication`
--

CREATE TABLE `ugapplication` (
  `user_id` int(10) NOT NULL,
  `applicant_name` varchar(128) NOT NULL,
  `email` varchar(225) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `father_name` varchar(128) NOT NULL,
  `mother_name` varchar(128) NOT NULL,
  `dob` date NOT NULL,
  `12th_reg_no` int(6) NOT NULL,
  `12th_percent` varchar(5) NOT NULL,
  `12th_college_name` varchar(255) NOT NULL,
  `applied_clause` char(2) NOT NULL,
  `degree` varchar(128) NOT NULL,
  `course` varchar(200) NOT NULL,
  `uni_name` varchar(150) NOT NULL,
  `college_name` varchar(50) NOT NULL,
  `college_city` varchar(20) NOT NULL,
  `uni_reg_no` int(14) NOT NULL,
  `course_dur` int(11) NOT NULL,
  `curr_study_year` varchar(11) NOT NULL,
  `date_applied` timestamp NULL DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Submitted, Under Verification'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ugapplication`
--

INSERT INTO `ugapplication` (`user_id`, `applicant_name`, `email`, `gender`, `father_name`, `mother_name`, `dob`, `12th_reg_no`, `12th_percent`, `12th_college_name`, `applied_clause`, `degree`, `course`, `uni_name`, `college_name`, `college_city`, `uni_reg_no`, `course_dur`, `curr_study_year`, `date_applied`, `status`) VALUES
(2024000006, 'Kushal L Gowda', 'kushallgowda97@gmail.com', 'Male', 'Lokesh T', 'Manjula M G', '2003-08-23', 636456, '82', 'ST Joseph\'s Indian Composite PU College', 'UG', 'Bachelors of Engineering', 'Information Science and Engineering', 'Visvesvaraya Technological University (VTU)', 'Sambhram Institute of Technology', 'Bangalore', 1, 4, '3', '2024-04-11 07:38:36', 'Submitted, Under Verification'),
(2024000011, 'Darshan G S', 'gsd99689@gmail.com', 'Male', 'Siddaraju', 'Savitha M S', '2003-12-26', 645756, '95', 'HTK PU College', 'UG', 'Bachelors of Engineering', 'Information Science and Engineering', 'Visvesvaraya Technological University (VTU)', 'Sambhram Institute of Technology', 'Bangalore', 1, 4, '3', '2024-04-11 07:42:08', 'Submitted, Under Verification');

--
-- Triggers `ugapplication`
--
DELIMITER $$
CREATE TRIGGER `status_trigger` AFTER UPDATE ON `ugapplication` FOR EACH ROW INSERT INTO issued (
    SELECT user_id, applicant_name, applied_clause, 		status 
    FROM ugapplication WHERE new.status = "issued"
	)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `email` varchar(225) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_name`, `email`, `dob`, `password`) VALUES
(2024000006, 'Kushal L Gowda', 'kushallgowda97@gmail.com', '2003-08-23', '$2y$10$Vg4Yamu5GH/VCdjvGotJrOEY2hwhonWL3VQBf52TvRTIM1NlGWdc.'),
(2024000011, 'Darshan G S', 'gsd99689@gmail.com', '2003-12-26', '$2y$10$DYGHUAnHaD4uMdHLcuYMAOnFEyvgI9jLDxK29XqgAxkaOjLMV.GU6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `issued`
--
ALTER TABLE `issued`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `pgapplication`
--
ALTER TABLE `pgapplication`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id_fk` (`user_id`),
  ADD KEY `email_fk` (`email`),
  ADD KEY `email_2` (`email`);

--
-- Indexes for table `ugapplication`
--
ALTER TABLE `ugapplication`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id_fk` (`user_id`),
  ADD KEY `email_fk` (`email`),
  ADD KEY `email_2` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2024000015;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issued`
--
ALTER TABLE `issued`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `ugapplication` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `pgapplication`
--
ALTER TABLE `pgapplication`
  ADD CONSTRAINT `pg_email` FOREIGN KEY (`email`) REFERENCES `user_details` (`email`),
  ADD CONSTRAINT `pgfk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ugapplication`
--
ALTER TABLE `ugapplication`
  ADD CONSTRAINT `appli_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `email_fk` FOREIGN KEY (`email`) REFERENCES `user_details` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
