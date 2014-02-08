-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 08, 2014 at 04:48 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(1, 1, 0, 1);

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
(1, '', 'Administrator', 'admin@bulletin.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '0000-00-00 00:00:00', 2, '', '', 0, 0, 99);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
