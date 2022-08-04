-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2022 at 05:26 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `seminar_hall`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deptId` int(11) NOT NULL,
  `seminar_hall_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subTitle` varchar(100) NOT NULL,
  `organizerName` varchar(100) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `guests` text,
  `description` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Pending',
  `images` text,
  `cancellation_reason` text,
  `accessories` text,
  `event_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `deptId`, `seminar_hall_id`, `title`, `subTitle`, `organizerName`, `from_date`, `to_date`, `guests`, `description`, `status`, `images`, `cancellation_reason`, `accessories`, `event_type`) VALUES
(8, 1234, 7, 'Yoga and Its ', 'Yoga information and subject details', 'Computer Science', '2022-08-02 12:29:00', '2022-08-03 12:30:00', 'Sri Srinivas D', 'We are heartly welcome you to the above subject for the yoga and reference. Thank you.', 'Approved', 'uploads/Exam Application Fees Paid.pdf', NULL, 'Tables,Chairs', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deptId` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  PRIMARY KEY (`deptId`) USING BTREE,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `deptId`, `department_name`) VALUES
(8, 1234, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `booking_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `student_id` varchar(11) NOT NULL,
  `updated_value` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seminar_halls`
--

CREATE TABLE IF NOT EXISTS `seminar_halls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hall_name` varchar(100) NOT NULL,
  `hall_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `seminar_halls`
--

INSERT INTO `seminar_halls` (`id`, `hall_name`, `hall_description`) VALUES
(7, 'Netravati', 'Welcome to netravati seminar hall.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `students_list`
--

CREATE TABLE IF NOT EXISTS `students_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roll_no` varchar(100) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `deptId` varchar(100) NOT NULL,
  `sem` int(11) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT '12345',
  `mobile_number` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `students_list`
--

INSERT INTO `students_list` (`id`, `roll_no`, `student_name`, `student_email`, `deptId`, `sem`, `password`, `mobile_number`) VALUES
(13, '202CS12013', 'Basavaraj Sangur', 'basavaraj@gmail.com', '1234', 1, '12345', 9739170220),
(14, '202CS12012', 'Shreya', 'S@gmail.com', '1234', 3, '12345', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deptId` int(11) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT '12345',
  PRIMARY KEY (`id`),
  KEY `users_ibfk_1` (`deptId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `deptId`, `password`) VALUES
(9, 1234, '1234');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`deptId`) REFERENCES `departments` (`deptId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
