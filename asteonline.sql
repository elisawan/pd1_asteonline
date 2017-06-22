-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2017 at 09:26 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asteonline`
--
CREATE DATABASE IF NOT EXISTS `asteonline` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `asteonline`;

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `num_asta` int(11) NOT NULL,
  `valore` decimal(5,2) NOT NULL DEFAULT '1.00',
  `user_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`num_asta`, `valore`, `user_name`) VALUES
(1, '32.01', 'a@p.it');

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `thr` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utenti`
--

INSERT INTO `utenti` (`user_name`, `password`, `thr`) VALUES
('a@p.it', 'ec6ef230f1828039ee794566b9c58adc', '40.00'),
('b@p.it', '1d665b9b1467944c128a5575119d1cfd', '1.80'),
('c@p.it', '7bc3ca68769437ce986455407dab2a1f', '3.00'),
('q@q.it', 'ec6ef230f1828039ee794566b9c58adc', NULL),
('w@p.it', 'a95dcb8aebb202efeedb10d5538edeb9', '32.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`num_asta`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `num_asta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
