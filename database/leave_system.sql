-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 03:45 PM
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
-- Database: `leave_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_rank`
--

CREATE TABLE `academic_rank` (
  `rank_id` int(11) NOT NULL,
  `rank_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `academic_rank`
--

INSERT INTO `academic_rank` (`rank_id`, `rank_name`) VALUES
(1, 'Instructor'),
(2, 'Assistant Professor'),
(3, 'Associate Professor'),
(4, 'Professor'),
(5, 'University Professor');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `acc_status` varchar(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `contact` bigint(11) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `acc_status`, `fname`, `mname`, `lname`, `birthdate`, `address`, `contact`, `department`) VALUES
('1', 'admin', 'admin123', 'Accepted', 'Marvin', 'test mname', 'Lagasca', '2024-04-03', 'test address', 918273656, 6),
('adminId', 'test', 'test', 'Accepted', 'a', 'a', 'a', '2024-04-24', 'a', 12312321, 2),
('test', 'test', 'test123', 'Pending', 'test', 'test', 'test', '2024-04-16', 'test', 1343, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(1, 'AB English Language'),
(2, 'BS Architecture'),
(3, 'BS Civil Engineering'),
(4, 'BS Computer Engineering'),
(5, 'BS Electrical Engineering'),
(6, 'BS Information Technology'),
(7, 'BS Mathematics'),
(8, 'BS Mechanical Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_name`) VALUES
(1, 'Dean'),
(2, 'Chair'),
(3, 'VP'),
(4, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `acc_status` varchar(50) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `sick_credits` float DEFAULT NULL,
  `vacation_credits` float DEFAULT NULL,
  `birthdate` date NOT NULL,
  `contact` bigint(11) NOT NULL,
  `date_hired` date DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `department` int(11) NOT NULL,
  `employee_type` int(11) NOT NULL,
  `working_status` int(11) DEFAULT NULL,
  `academic_rank` int(11) DEFAULT NULL,
  `designation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `username`, `password`, `acc_status`, `fname`, `mname`, `lname`, `sick_credits`, `vacation_credits`, `birthdate`, `contact`, `date_hired`, `address`, `department`, `employee_type`, `working_status`, `academic_rank`, `designation`) VALUES
('21-UR-0111', 'leng', 'leng123', 'Accepted', 'Justin Gerald', 'G', 'Loleng', 14.24, 9.24, '2024-04-14', 2147483647, '2023-04-13', 'urda', 6, 2, NULL, NULL, NULL),
('21-UR-0183', 'ced', 'ced123', 'Accepted', 'Cedric Joel', 'F', 'Cayaban', 3.02, 2.02, '2024-03-11', 9099501718, '2024-01-10', 'Macarang', 6, 2, 3, 3, NULL),
('21-UR-0186', 'a', 'a', 'Accepted', 'Christopherson', 'Callo', 'Carpio', 0, 10, '2024-03-10', 2147483647, NULL, 'Mangats', 3, 1, NULL, 1, 2),
('21-UR0125', 'lianna', 'lianna123', 'Accepted', 'Lianna Jane', 'Nuto', 'Garlitos', 0, 0, '2002-09-26', 2147483647, NULL, 'Baracbac', 6, 1, 3, NULL, NULL),
('22-UR-0001', 'mak', 'mak123', 'Accepted', 'mak', 'Banga', 'biag', 0, 0, '2024-04-02', 2147483647, NULL, 'aguilar', 6, 1, 3, 1, NULL),
('a', 'a', 'a', 'Pending', 'a', 'a', 'a', 0, 0, '2024-04-14', 1, '2024-04-22', 'a', 3, 2, 1, 1, 1),
('test', 'test', 'test123', 'Pending', 'test', 'test', 'test', 0, 0, '2024-04-16', 12324, '2024-04-15', 'test', 3, 2, 3, 2, 2),
('test ID', 'test', 'test123', 'Pending', 'test name', 'test name', 'test lname', 0, 10, '2024-01-16', 918273656, NULL, 'a', 4, 1, 3, 1, 2),
('ulit', 'ulit', 'ulit123', 'Pending', 'ulit', 'ulit', 'ulit', 0, 0, '2024-04-15', 12348761, '2024-04-16', 'ulit', 4, 2, 1, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave`
--

CREATE TABLE `employee_leave` (
  `leave_id` int(11) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `leave_type` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `reason` varchar(150) NOT NULL,
  `leave_form` text NOT NULL,
  `med_cert` text DEFAULT NULL,
  `days` float NOT NULL,
  `credit_cost` float NOT NULL,
  `reject_reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee_leave`
--

INSERT INTO `employee_leave` (`leave_id`, `employee_id`, `leave_type`, `start_date`, `end_date`, `status`, `reason`, `leave_form`, `med_cert`, `days`, `credit_cost`, `reject_reason`) VALUES
(18, '21-UR-0183', 1, '2024-04-14', '2024-04-15', 'Accepted', 'sick', '', NULL, 0.5, 0.5, ''),
(19, '21-UR-0183', 1, '2024-04-13', '2024-04-14', 'Accepted', 's', '', NULL, 1, 1, ''),
(20, '21-UR-0111', 1, '2024-04-14', '2024-04-15', 'Accepted', 'tired', '', NULL, 1, 1, ''),
(21, '21-UR-0183', 1, '2024-04-14', '2024-04-15', 'Rejected', 'l', '../../images/uploads/leave_forms/Bruce Warren - voice recognition - sabbatical report 2017.pdf', '../../images/uploads/medical_certificates/549.pdf', 0.5, 0.5, ''),
(22, '21-UR-0183', 2, '2024-04-14', '2024-04-15', 'Pending', 'vgfr', '../../images/uploads/leave_forms/Endpoint_Security_Badge20240408-31-140gqf.pdf', '../../images/uploads/medical_certificates/Cyber_Threat_Management_Badge20240408-31-bwq4ba.pdf', 0.5, 0.5, ''),
(23, '21-UR-0111', 1, '2024-04-15', '2024-04-16', 'Rejected', 'yu', '../../images/uploads/leave_forms/Group 2 - Learning Huddle CH2 .pdf', '../../images/uploads/medical_certificates/Group 2 - Learning Huddle CH3.pdf', 0.5, 0.5, ''),
(24, '21-UR-0111', 1, '2024-04-15', '2024-04-16', 'Rejected', 'sa', '../../images/uploads/leave_forms/huddle 3.png', NULL, 0.5, 0.5, 'pls gumana ka na'),
(25, '21-UR-0111', 2, '2024-04-15', '2024-04-16', 'Accepted', 'dsadw', '../../images/uploads/leave_forms/huddle 1.png', '../../images/uploads/medical_certificates/GE-8-Ethics-Study-Guide-for-Module-1-Updated_09192022.pdf', 0.5, 0.5, ''),
(26, '21-UR-0111', 2, '2024-04-15', '2024-04-16', 'Rejected', 'sa', '../../images/uploads/leave_forms/Introduction_to_Cybersecurity_Badge20240407-29-ola6xb.pdf', '../../images/uploads/medical_certificates/Introduction_to_Cybersecurity_Badge20240407-29-ola6xb.pdf', 0.5, 0.5, 'ayaw ko lodi'),
(30, '21-UR-0111', 1, '2024-04-16', '2024-04-16', 'Pending', 'sick', '../../images/uploads/leave_forms/Introduction_to_Cybersecurity_Badge20240407-29-ola6xb.pdf', NULL, 1, 1, ''),
(31, '21-UR-0111', 1, '2024-04-16', '2024-04-16', 'Accepted', 'sick na, nilalagnat na si ced talaga', '../../images/uploads/leave_forms/Bruce Warren - voice recognition - sabbatical report 2017.pdf', NULL, 1, 1, ''),
(32, '21-UR-0111', 1, '2024-04-16', '2024-04-17', 'Accepted', 'pagod nako', '../../images/uploads/leave_forms/wallpapersden.com_small-memory_3840x2160.jpg', NULL, 0.5, 0.5, ''),
(33, '21-UR-0183', 2, '2024-04-16', '2024-04-16', 'Pending', 'mk', '../../images/uploads/leave_forms/Endpoint_Security_Badge20240408-31-140gqf.pdf', '../../images/uploads/medical_certificates/Group 2 - Learning Huddle CH2 .pdf', 0.5, 0.5, '');

-- --------------------------------------------------------

--
-- Table structure for table `employee_type`
--

CREATE TABLE `employee_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee_type`
--

INSERT INTO `employee_type` (`type_id`, `type_name`) VALUES
(1, 'Teaching'),
(2, 'Non-teaching');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `type_id` int(11) NOT NULL,
  `leave_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`type_id`, `leave_name`) VALUES
(1, 'Vacation leave'),
(2, 'Sick leave');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `super_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`super_id`, `username`, `password`) VALUES
(1, 'super-admin', 'super123');

-- --------------------------------------------------------

--
-- Table structure for table `working_status`
--

CREATE TABLE `working_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `working_status`
--

INSERT INTO `working_status` (`status_id`, `status_name`) VALUES
(1, 'Casual'),
(2, 'Contractual'),
(3, 'Regular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_rank`
--
ALTER TABLE `academic_rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `FK7` (`department`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `FK1` (`department`),
  ADD KEY `FK2` (`employee_type`),
  ADD KEY `FK3` (`academic_rank`),
  ADD KEY `FK4` (`designation`),
  ADD KEY `FK8` (`working_status`);

--
-- Indexes for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `Fk6` (`leave_type`),
  ADD KEY `FK5` (`employee_id`);

--
-- Indexes for table `employee_type`
--
ALTER TABLE `employee_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`super_id`);

--
-- Indexes for table `working_status`
--
ALTER TABLE `working_status`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_rank`
--
ALTER TABLE `academic_rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_leave`
--
ALTER TABLE `employee_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `employee_type`
--
ALTER TABLE `employee_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `super_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `working_status`
--
ALTER TABLE `working_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK7` FOREIGN KEY (`department`) REFERENCES `department` (`dept_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`department`) REFERENCES `department` (`dept_id`),
  ADD CONSTRAINT `FK2` FOREIGN KEY (`employee_type`) REFERENCES `employee_type` (`type_id`),
  ADD CONSTRAINT `FK3` FOREIGN KEY (`academic_rank`) REFERENCES `academic_rank` (`rank_id`),
  ADD CONSTRAINT `FK4` FOREIGN KEY (`designation`) REFERENCES `designation` (`designation_id`),
  ADD CONSTRAINT `FK8` FOREIGN KEY (`working_status`) REFERENCES `working_status` (`status_id`);

--
-- Constraints for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD CONSTRAINT `FK5` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `Fk6` FOREIGN KEY (`leave_type`) REFERENCES `leave_type` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
