-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 27, 2019 at 04:49 AM
-- Server version: 5.6.38
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `channels_txt`
--

CREATE TABLE `channels_txt` (
  `id` int(10) NOT NULL,
  `code` text NOT NULL,
  `id_channel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `channels_txt`
--

INSERT INTO `channels_txt` (`id`, `code`, `id_channel`) VALUES
(778, '34635353546', 777),
(779, 'cat is a', 250575),
(780, '', 1943970),
(781, '', 27407837),
(782, 'squel', 79431153),
(783, '', 52767945);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channels_txt`
--
ALTER TABLE `channels_txt`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channels_txt`
--
ALTER TABLE `channels_txt`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=784;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
