-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2014 at 08:06 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bulletin`
--
CREATE DATABASE `bulletin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bulletin`;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_image`
--

CREATE TABLE IF NOT EXISTS `announcement_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(255) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `announcement_image`
--

INSERT INTO `announcement_image` (`image_id`, `image_name`, `announcement_id`, `status`) VALUES
(1, '924676b0de88a4faa6f12aa740c5dc43.png', 1, 0),
(2, 'c243e29c3986b09d7706976b3bc4bab0.png', 1, 0),
(3, 'd890738612e9b92aa2497f8eff7fa942.png', 1, 1),
(4, '3876d5c807b2253b01743d00f38bb570.png', 1, 1),
(5, '6511d8c69d4fa3fcf6bc9fb54acd417e.jpg', 2, 0),
(6, '02f11545d62555d91ab20a00d22417a3.jpg', 2, 0),
(7, '4ae335b63abf14280d573e3015529323.jpg', 2, 0),
(8, 'cd50afe13187093a29f8836f68ba1937.jpg', 2, 0),
(9, '322a6081efa6692cdad3f43188e62dbb.jpg', 2, 1),
(10, '392285d8bbb5340a806e404730da440b.jpg', 2, 0),
(11, 'd562307cef6661ef6794e521125dd0d2.jpg', 2, 0),
(12, '350c884049f8f343e77f159bece97848.jpg', 2, 0),
(13, '3a9e2518568354ace3d5a6302a274434.jpg', 2, 0),
(14, '325fd8d5d0b35bb3c1925702cd6a8207.jpg', 2, 0),
(15, '29865959852366f831b81f65af414dd0.jpg', 4, 0),
(16, 'f6d7f94aa1a581def5cd429a6cf0d0fe.jpg', 4, 0),
(17, 'd16907d40c6cef8183b400b8726bb373.jpg', 4, 0),
(18, 'a216c2b6c716d2df14ad3ff34d5b755a.jpg', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bulletin`
--

CREATE TABLE IF NOT EXISTS `bulletin` (
  `announcement_id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_category` int(11) NOT NULL,
  `announcement_start` datetime NOT NULL,
  `announcement_end` datetime NOT NULL,
  `announcement_title` varchar(255) NOT NULL,
  `announcement_description` text NOT NULL,
  `announcement_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`announcement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bulletin`
--

INSERT INTO `bulletin` (`announcement_id`, `announcement_category`, `announcement_start`, `announcement_end`, `announcement_title`, `announcement_description`, `announcement_status`) VALUES
(1, 0, '2013-12-26 00:00:00', '2013-12-27 00:00:00', 'My title', 'asdasdasdasd', 1),
(2, 1, '2014-01-12 00:00:00', '2014-01-28 00:00:00', 'Test', 'Jaylord Testsz\r\n\r\n\r\nJaylord Test\r\n\r\n\r\nJaylord Test\r\n\r\n\r\nJaylord Test\r\n\r\nJaylord TestJaylord TestJaylord TestJaylord TestJaylord TestJaylord TestJaylord TestJaylord TestJaylord TestJaylord TestJaylord TestJaylord Test', 0),
(3, 1, '2014-01-19 00:00:00', '2014-01-17 00:00:00', 'Cydjay''s 4th Month', 'My son is now a 4 month old baby.', 1),
(4, 2, '2014-01-17 00:00:00', '2014-01-25 00:00:00', 'asdasdasd', 'asdasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `department_status` int(11) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `department_status`) VALUES
(1, 'IT Department', 0),
(2, 'BSBAAA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_id`
--

CREATE TABLE IF NOT EXISTS `student_id` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `student_id`
--

INSERT INTO `student_id` (`student_id`, `unique`, `id_status`, `department_id`) VALUES
(1, 1, 0, 1),
(2, 10035, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_picture` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_birthday` datetime NOT NULL,
  `user_civil_status` int(11) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_phone_number` varchar(255) NOT NULL,
  `user_status` int(11) NOT NULL,
  `user_std_id` int(11) NOT NULL,
  `user_level` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_picture`, `user_name`, `user_email`, `user_password`, `user_birthday`, `user_civil_status`, `user_address`, `user_phone_number`, `user_status`, `user_std_id`, `user_level`) VALUES
(1, '1bb625b31d9d0a9f67c73e05d5eb9777.gif', 'Administrator', 'admin@bulletin.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '0000-00-00 00:00:00', 2, '', '', 0, 0, 99),
(2, '', 'Juan Dela Cruz', 'juan@delacruz.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2013-12-27 00:00:00', 0, '', '', 0, 1, 0),
(3, '', 'Ergi', 'ergiemontalbo@yahoo.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2014-01-17 00:00:00', 0, '', '', 0, 10035, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
