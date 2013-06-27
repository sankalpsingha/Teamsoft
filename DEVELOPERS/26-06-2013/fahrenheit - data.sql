-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2013 at 09:16 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fahrenheit`
--

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `category`, `description`, `created_on`, `updated_on`) VALUES
(6, 'Laptop', 'sdc', '2013-06-26 02:26:50', '2013-06-26 02:26:50');

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`, `username`, `password`, `about`, `created_on`, `updated_on`, `ip`, `active`, `power`, `ban`, `sec_ques`, `answer`, `course`, `profilepic`, `thumbnail`, `email`, `mobile`, `slug`) VALUES
(10, 'Parry', 'Singh', 'parry', 'f970e2767d0cfe75876ea857f92e319b', 'asdad', '2013-06-26 02:22:16', '2013-06-26 02:22:16', '127.0.0.1', 0, 0, 1, 'What is my aunt''s name?', 'Mary', 'Diploma', NULL, NULL, 'parry@ymail.com', NULL, 'parry'),
(11, 'Sankalp', 'Singha', 'sankalp', 'f970e2767d0cfe75876ea857f92e319b', 'asdasd', '2013-06-26 02:25:47', '2013-06-26 02:25:47', '127.0.0.1', 0, 0, 1, 'What is my aunt''s name?', 'Mary', 'B. Tech (Hons)', NULL, NULL, 'sankalpsingha@gmail.com', NULL, 'sankalp'),
(12, 'Neeraj', 'Rana', 'neeraj', 'f970e2767d0cfe75876ea857f92e319b', 'asdfasd', '2013-06-26 02:26:14', '2013-06-26 02:26:14', '127.0.0.1', 0, 0, 1, 'What is my dad''s name?', 'Papa', 'B. Tech (Hons)', NULL, NULL, 'neeraj@neeraj.com', NULL, 'neeraj');

--
-- Dumping data for table `user_has_module`
--

INSERT INTO `user_has_module` (`user_id`, `module_id`) VALUES
(10, 6),
(11, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
