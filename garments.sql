-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2016 at 04:06 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `garments`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
`id` int(11) NOT NULL,
  `attendance` int(11) NOT NULL,
  `date` date NOT NULL,
  `userid` int(11) NOT NULL,
  `deptid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
`id` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `dept_info` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_name`, `dept_info`, `date`) VALUES
(1, 'sweing', 'this is a sewing department. People doing sewing here. ', '0000-00-00'),
(2, 'iron', 'This is Iron Department\r\n', '0000-00-00'),
(3, 'managing', 'Managing people and other stuff.', '0000-00-00'),
(4, 'techinician', 'this is a tech department', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hiredate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `username`, `password`, `email`, `hiredate`) VALUES
(1, 'wohhie', '123', 'wohhie@mail.com', '2016-03-09'),
(2, 'rakib', '1234', 'rakib@mail.com', '2016-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `manager_info`
--

CREATE TABLE IF NOT EXISTS `manager_info` (
`id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager_info`
--

INSERT INTO `manager_info` (`id`, `firstname`, `lastname`, `address`, `gender`, `date`, `userid`) VALUES
(1, 'Wohhie ', 'Mahmud', '4/D Gulshan-2,Dhaka ', 'male', '2016-03-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'wohhie', 'wohhie@mail.com', '1234'),
(2, 'rakib', 'rakib@mail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE IF NOT EXISTS `worker` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(50) NOT NULL,
  `active` int(11) DEFAULT '0',
  `hiredate` date NOT NULL,
  `deptid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`id`, `username`, `password`, `email`, `department`, `active`, `hiredate`, `deptid`) VALUES
(1, 'shohan', '123', 'shohan@mail.com', 'sweing', 0, '2016-03-09', 1),
(2, 'monika', '1234', 'monika@mail.com', 'iron', 0, '2016-03-10', 0),
(6, 'wohhie', 'weg', 'acxygrl@yahoo.com', 'iron', 0, '0000-00-00', 0),
(7, 'asif', 'ac123', 'cheksyria@live.com', 'sweing', 0, '0000-00-00', 1),
(26, 'maria', 'abc123', 'marzia@mail.com', 'iron', 0, '0000-00-00', 0),
(27, 'hosne', '123456', 'hosnear@mail.com', 'sweing', 0, '0000-00-00', 1),
(31, 'sazia23', '123', 'sazia@mail.com', 'managing', 0, '0000-00-00', 0),
(32, 'nobita13', '122', 'nobo@mail.com', 'techinician', 0, '0000-00-00', 0),
(33, 'kaled23', '123', 'kaled@mail.com', 'techinician', 0, '0000-00-00', 0),
(34, 'helan23', '12345', 'hela@mail.com', 'techinician', 0, '0000-00-00', 0),
(35, 'joshim', '1234', 'joshim@mail.com', 'techinician', 0, '0000-00-00', 0),
(36, 'illiash', '1234', 'illiash@mail.com', 'iron', 0, '2016-03-12', 0),
(37, 'mozi', '123', 'mojib@mail.com', 'iron', 0, '2016-03-12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `worker_info`
--

CREATE TABLE IF NOT EXISTS `worker_info` (
`id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker_info`
--

INSERT INTO `worker_info` (`id`, `firstname`, `lastname`, `address`, `gender`, `date`, `userid`) VALUES
(1, 'Shohan', 'Hossain', '54/D, Panthapath.', 'male', '2016-03-05', 1),
(2, 'Monika', 'Khan', '43D, Uttra Dhaka - 1206', 'female', '2016-03-09', 2),
(3, 'Morzina', 'Katun', 'Dhaka, Motijeel', 'male', '0000-00-00', 0),
(10, 'Marzia', 'Khan', 'maria vial,calt', 'male', '0000-00-00', 26),
(11, 'hosneara', 'mujib', 'dhaka, motijeel', 'female', '0000-00-00', 27),
(15, 'sazia', 'ahmhed', 'saiv Uttra,Dhaka', 'male', '0000-00-00', 31),
(16, 'nobita', 'shaha', '45,Uttra , Dhaka', 'female', '0000-00-00', 32),
(17, 'Khaled', 'Khan', '45/D', 'male', '0000-00-00', 33),
(18, 'joshim', 'islam', 'uttra , Dhaka', 'male', '0000-00-00', 35),
(19, 'illiash', 'khan', 'uttra,Dhaka', 'female', '0000-00-00', 36),
(20, 'mojib', 'hossain', 'uttra,Dhaka', 'male', '0000-00-00', 37);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager_info`
--
ALTER TABLE `manager_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker_info`
--
ALTER TABLE `worker_info`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `manager_info`
--
ALTER TABLE `manager_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `worker_info`
--
ALTER TABLE `worker_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
