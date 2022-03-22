-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2017 at 02:39 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `su`
--

-- --------------------------------------------------------

--
-- Table structure for table `catering_highland`
--

CREATE TABLE `catering_highland` (
  `id` int(11) NOT NULL,
  `catering_id` int(11) DEFAULT NULL,
  `burrito_12` tinyint(4) DEFAULT '0',
  `burrito_8` tinyint(4) DEFAULT '0',
  `extra_salsa` tinyint(4) DEFAULT '0',
  `extra_sourcream` tinyint(4) DEFAULT '0',
  `extra_guacamole` tinyint(4) DEFAULT '0',
  `upgrade` tinyint(4) DEFAULT '0',
  `coke` int(100) NOT NULL DEFAULT '0',
  `diet_coke` int(100) NOT NULL DEFAULT '0',
  `sprite` int(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catering_highland`
--
ALTER TABLE `catering_highland`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catering_highland`
--
ALTER TABLE `catering_highland`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
