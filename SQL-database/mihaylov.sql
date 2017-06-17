-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 04, 2015 at 03:57 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mihaylov`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `latitude` double NOT NULL,
  `longatude` double NOT NULL,
  `city` text NOT NULL,
  `country` text NOT NULL,
  `difficulty` text NOT NULL,
  `rating` int(11) NOT NULL,
  `img_url` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `name`, `latitude`, `longatude`, `city`, `country`, `difficulty`, `rating`, `img_url`) VALUES
(2, 'Corn', 43.853104, -79.179722, 'Scarborough', 'Canada', 'Easy', 5, 'img-res/geo-items/01.jpg'),
(3, 'Want to play?', 43.94983, -78.899114, 'Oshawa', 'Canada', 'Medium', 3, 'img-res/geo-items/02.jpg'),
(4, 'MCP Waterfront', 43.586564, -79.543349, 'Mississauga', 'Canada', 'Medium', 4, 'img-res/geo-items/03.jpg'),
(5, 'Oak Ridges Moraine Earthcache', 44.013149, -79.103849, 'Uxbridge', 'Canada', 'Hard', 5, 'img-res/geo-items/04.jpg'),
(6, 'For The Birds', 43.969784, -78.295531, 'Port Hope', 'Canada', 'Hard', 2, 'img-res/geo-items/05.jpg'),
(7, 'Toronto Meet and Greet', 43.725142, -79.449228, 'Toronto', 'Canada', 'Easy', 5, 'img-res/geo-items/06.jpg'),
(8, 'AMR Top of Ambatoloaka', -13.398744, 48.207367, 'Madirokely', 'Madagascar', 'Hard', 4, 'img-res/geo-items/07.jpg'),
(9, 'The Old Church', 42.697863, 23.322067, 'Sofia', 'Bulgaria', 'Medium', 4, 'img-res/geo-items/08.jpg'),
(10, 'Green Monster Walk', 10.772089, 106.698405, 'Ho Chi Minh City', 'Vietnam', 'Easy', 3, 'img-res/geo-items/09.jpg'),
(11, 'Tux #1: The Rocks', 45.510285, -73.588134, 'Montreal', 'Canada', 'Medium', 1, 'img-res/geo-items/10.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`) VALUES
(8, 'testUser', '098f6bcd4621d373cade4e832627b4f6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
