-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 02:54 PM
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
  `image` varchar(255) NOT NULL DEFAULT 'placeholder.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poi`
--

INSERT INTO `poi` (`id`, `category`, `name`, `latitude`, `longitude`, `description`, `website`, `image`) VALUES
(18, 2, 'Wal and Dog', '-38.66524400', '178.02562600', 'This bronze sculpture by Joanne Sullivan-Gessler, unveiled in 2017, features farmer Wal Footrot and his faithful sheepdog, Dog, capturing the spirit of rural New Zealand life.', 'https://www.reddit.com/', '1351235.jpg'),
(39, 1, 'Oldest Pohutukawa', '-37.63258600', '178.36694200', 'Te Waha o Rerekohu is thought to be the largest pōhutukawa tree in New Zealand. At least 600 years old, it had a branch span of more than 37 metres when measured in 1950.', NULL, '../media/uploaded_images/0cebd0b49c447f38b7e80871ef8b5151.jpg'),
(40, 0, 'Tuahine Lighthouse', '-38.70806000', '178.06937300', 'Tuahine Lighthouse, built in 1905, was vital for guiding ships along Poverty Bay&rsquo;s rugged coast. Though decommissioned in 1925 and replaced by the East Cape Lighthouse, it remains a historical landmark offering stunning coastal views.', NULL, '../media/uploaded_images/9b59d99af2866f8c409fd1daf2956b79.png'),
(41, 2, 'Rhythm &amp; Vines', '-38.58998200', '177.96585600', 'Rhythm and Vines is a three day music festival held in Gisborne, New Zealand on December 29-31. It is globally known as the first festival in the world to welcome in the first sunrise of the new year.', NULL, '../media/uploaded_images/210362f749ea4bf17e6465506c5ab562.jpg'),
(42, 1, 'Rere Rockslide', '-38.53897700', '177.59064700', 'Viewed by millions on screens around the globe, be one of the many thrill-seekers to ride Rere Rockslide. Natural forces have conspired to create 60 metres of sheer exhilaration and pure adrenaline, best experienced on an inflatable device or boogie board. Just around the bend from the gorgeous Rere Falls.', NULL, '../media/uploaded_images/15149ee788c5dfac534673e9593008a2.jpg'),
(43, 1, 'Te Kuri Farm Walkway', '-38.64465400', '178.04458400', 'Te Kuri Farm Walkway is located on a private farm on the northern outskirts of Gisborne. The walkway has a well defined track that is suitable for people with average physical fitness. It is a 2-3 hour loop that can be walked in either direction.', NULL, '../media/uploaded_images/4fa03d3f05fc644275790049d731444a.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
