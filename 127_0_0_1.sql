-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 07:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poi_database`
--
CREATE DATABASE IF NOT EXISTS `poi_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `poi_database`;

-- --------------------------------------------------------

--
-- Table structure for table `poi`
--

CREATE TABLE `poi` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `description` text NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `image` varchar(16) NOT NULL DEFAULT 'placeholder.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poi`
--

INSERT INTO `poi` (`id`, `category`, `name`, `latitude`, `longitude`, `description`, `website`, `image`) VALUES
(1, 0, 'Tuahine Lighthouse', '-38.70805203', '178.06933765', 'Description for Tuahine Lighthouse', 'https://photo.angusbodle.com/gallery.php?collection=sponge', 'placeholder.jpg'),
(2, 0, 'WWII \'Pillbox\'', '-38.67278714', '177.98815252', 'Description for WWII Bunker', 'http://www.google.com', 'placeholder.jpg'),
(3, 0, 'WWII \'Pillbox\'', '-38.66947535', '178.02218916', 'Description for WWII Bunker', 'http://www.google.com', 'placeholder.jpg'),
(4, 0, 'WWII \'Pillbox\' Bunker', '-38.66790012', '178.01999664', 'Description for WWII Bunker', 'http://www.google.com', 'placeholder.jpg'),
(5, 1, 'Waioeka Falls', '-38.32366685', '177.40531752', 'Description for xxxx`s Waterfall', 'http://www.google.com', 'placeholder.jpg'),
(6, 2, 'Kopuawhara Monument', '-38.96477653', '177.86176960', 'Description for Kopuawhara Monument', 'http://www.google.com', 'placeholder.jpg'),
(18, 2, 'Wal and Dog', '-38.66524400', '178.02562600', 'This bronze sculpture by Joanne Sullivan-Gessler, unveiled in 2017, features farmer Wal Footrot and his faithful sheepdog, Dog, capturing the spirit of rural New Zealand life.', 'https://www.reddit.com/', '1351235.jpg'),
(19, 1, 'Mt Hikurangi', '-37.91982600', '178.06057000', '', '', 'placeholder.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `poi`
--
ALTER TABLE `poi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `poi`
--
ALTER TABLE `poi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
