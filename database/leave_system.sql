-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 01:46 PM
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
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `contact` int(11) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `fname`, `mname`, `lname`, `birthdate`, `address`, `contact`, `department`) VALUES
(1, 'admin', 'admin123', 'test fname', 'test mname', 'test lname', NULL, 'test address', 918273656, 3),
(10, 'test', 'test', 'test', 'test', 'test', '2024-03-12', 'test', 1, 2),
(11, 'a', 'a', 'a', 'a', 'a', '2024-03-19', 'a', 1, 2);

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
  `credits` int(11) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `contact` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `department` int(11) NOT NULL,
  `employee_type` int(11) NOT NULL,
  `academic_rank` int(11) DEFAULT NULL,
  `designation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `username`, `password`, `acc_status`, `fname`, `mname`, `lname`, `credits`, `birthdate`, `contact`, `address`, `department`, `employee_type`, `academic_rank`, `designation`) VALUES
('21-UR-0183', 'ced', 'ced123', 'Accepted', 'Cedric Joel', 'Fernandez', 'Cayaban', NULL, '2024-03-11', 2147483647, 'Macarang', 5, 2, 3, NULL),
('21-UR-0186', 'a', 'a', 'Accepted', 'Christopherson', 'Callo', 'Carpio', NULL, '2024-03-10', 2147483647, 'Mangats', 3, 1, 1, 2),
('test ID', 'test', 'test123', 'Pending', 'test name', 'test name', 'test lname', NULL, '2024-01-16', 918273656, 'a', 4, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave`
--

CREATE TABLE `employee_leave` (
  `leave_id` int(11) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `leave_type` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `reason` varchar(150) NOT NULL,
  `days` decimal(10,1) NOT NULL,
  `credit_cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee_leave`
--

INSERT INTO `employee_leave` (`leave_id`, `employee_id`, `leave_type`, `date`, `status`, `reason`, `days`, `credit_cost`) VALUES
(5, '21-UR-0183', 1, '2024-03-17', 'Accepted', 'sick', 0.5, 1),
(6, '21-UR-0186', 2, '2024-03-19', 'Accepted', 'sick na', 1.0, 1),
(7, '21-UR-0183', 1, '2024-03-12', 'Rejected', 'pagod na', 1.0, 1),
(8, '21-UR-0186', 1, '2024-03-05', 'Pending', 'im sick as heck', 1.0, 1),
(9, '21-UR-0183', 1, '2024-02-06', 'Pending', 'dunno', 1.0, 1);

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
  ADD KEY `FK4` (`designation`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_rank`
--
ALTER TABLE `academic_rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `FK4` FOREIGN KEY (`designation`) REFERENCES `designation` (`designation_id`);

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
