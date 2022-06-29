-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 29, 2022 at 05:59 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seminar_hall`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deptId` int(11) NOT NULL,
  `seminar_hall_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subTitle` varchar(100) NOT NULL,
  `organizerName` varchar(100) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `guests` text NOT NULL,
  `description` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Pending',
  `images` text,
  `cancellation_reason` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `deptId`, `seminar_hall_id`, `title`, `subTitle`, `organizerName`, `from_date`, `to_date`, `guests`, `description`, `status`, `images`, `cancellation_reason`) VALUES
(4, 123, 5, 'Seminar Title', 'Subject of the seminar', 'Organizer Name', '2022-06-27 20:00:00', '2022-06-27 21:00:00', 'karthik@gmail.com, seema@gmail.com', 'Description is added', 'Approved', 'uploads/unnamed.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deptId` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  PRIMARY KEY (`deptId`) USING BTREE,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `deptId`, `department_name`) VALUES
(6, 123, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
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

DROP TABLE IF EXISTS `seminar_halls`;
CREATE TABLE IF NOT EXISTS `seminar_halls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hall_name` varchar(100) NOT NULL,
  `hall_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seminar_halls`
--

INSERT INTO `seminar_halls` (`id`, `hall_name`, `hall_description`) VALUES
(5, 'Seminar Hall Name', 'Just for the information');

-- --------------------------------------------------------

--
-- Table structure for table `students_list`
--

DROP TABLE IF EXISTS `students_list`;
CREATE TABLE IF NOT EXISTS `students_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roll_no` varchar(100) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `deptId` varchar(100) NOT NULL,
  `sem` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deptId` int(11) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT '12345',
  PRIMARY KEY (`id`),
  KEY `users_ibfk_1` (`deptId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `deptId`, `password`) VALUES
(4, 123, '12345');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`deptId`) REFERENCES `departments` (`deptId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
