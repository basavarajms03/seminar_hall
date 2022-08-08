-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2022 at 05:43 AM
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
  `sem` varchar(30) NOT NULL,
  UNIQUE KEY `id_2` (`id`),
  KEY `deptId` (`deptId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `deptId`, `seminar_hall_id`, `title`, `subTitle`, `organizerName`, `from_date`, `to_date`, `guests`, `description`, `status`, `images`, `cancellation_reason`, `accessories`, `event_type`, `sem`) VALUES
(8, 1234, 7, 'Yoga and Its ', 'Yoga information and subject details', 'Computer Science', '2022-08-02 12:29:00', '2022-08-03 12:30:00', 'Sri Srinivas D', 'We are heartly welcome you to the above subject for the yoga and reference. Thank you.', 'Approved', 'uploads/Exam Application Fees Paid.pdf', NULL, 'Tables,Chairs', 'Other', ''),
(9, 12345, 7, 'Something Titla', 'Subject', 'Organizer Name', '2022-08-02 22:43:00', '2022-08-02 22:43:00', 'Seminar Infor', 'Description\r\n', 'Approved', 'uploads/DocScanner 01-Aug-2022 12-09 pm.jpg', NULL, 'Tables,Chairs', 'Seminar', ''),
(10, 12345, 7, 'Title informaion', 'Subject', 'Orgnizer Name', '2022-08-07 18:07:00', '2022-08-07 18:07:00', 'Seminar lecturer', 'No more informtion', 'Approved', NULL, NULL, '', 'Seminar', '1st'),
(11, 12345, 7, 'assasa', 'assdasa', 'adadsadss', '2022-08-08 07:37:00', '2022-08-08 08:38:00', 'gfgdfgdgf', 'yghjgjhgj jg gjhgjhgj  ', 'Approved', NULL, NULL, 'Chairs', 'Seminar', '1st');

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
(8, 12345, 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `booking_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `student_id` varchar(11) NOT NULL,
  `updated_value` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `1st` varchar(30) NOT NULL,
  `2nd` varchar(30) NOT NULL,
  `3rd` varchar(30) NOT NULL,
  `4th` varchar(30) NOT NULL,
  `5th` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`booking_id`, `feedback`, `student_id`, `updated_value`, `1st`, `2nd`, `3rd`, `4th`, `5th`) VALUES
(9, 'No more information.', '202', '2022-08-06 03:08:23', 'Extremely Helpful', 'Yes', 'No', 'No', 'Yes');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `students_list`
--

INSERT INTO `students_list` (`id`, `roll_no`, `student_name`, `student_email`, `deptId`, `sem`, `password`, `mobile_number`) VALUES
(15, '202', 'aasa', 'sasa', '12345', 1, '12345', NULL),
(16, '203', 'sasasa', 'sasas', '12345', 2, '12345', NULL);

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
(9, 12345, 'cs123');

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
