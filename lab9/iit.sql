-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2025 at 01:43 AM
-- Server version: 10.11.11-MariaDB-0ubuntu0.24.04.2
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iit`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `actorid` int(10) UNSIGNED NOT NULL,
  `first_names` varchar(40) NOT NULL,
  `last_name` char(40) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`actorid`, `first_names`, `last_name`, `dob`) VALUES
(1, 'Christ', 'Hemsworth', '1983-08-11'),
(2, 'Scarlett', 'Johansson', '1984-11-22'),
(3, 'George', 'Clooney', '1961-05-06'),
(4, 'Elijah', 'Wood', '1981-01-28'),
(6, 'Anna', 'Kendrick', '1985-08-09'),
(7, 'Bradley', 'Cooper', '1975-01-05'),
(8, 'Joaquin', 'Phoenix', '1974-10-28'),
(9, 'Natalie', 'Portman', '1981-06-09'),
(10, 'Tom', 'Hanks', '1956-07-09'),
(14, 'Robert', 'Duvall', '1931-01-05'),
(15, 'Morgan', 'Freeman', '1937-06-01'),
(17, 'Adrian', 'Corujo', '1999-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movieid` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `year` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieid`, `title`, `year`) VALUES
(2, 'Black Widow', '2021'),
(3, 'Oh Brother Where Art Thou?', '2000'),
(4, 'The Lord of the Rings: The Fellowship of the Ring', '2001'),
(5, 'Up in the Air', '2009'),
(12, 'The Godfather', '1972'),
(15, 'Scarface', '1800'),
(16, 'Thor Ragnarok', '2021'),
(17, 'Joker 2', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `movie_actors`
--

CREATE TABLE `movie_actors` (
  `id` int(11) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_actors`
--

INSERT INTO `movie_actors` (`id`, `last_name`, `title`) VALUES
(1, 'Clooney', 'Black Widow'),
(3, 'Clooney', 'The Lord of the Rings: The Fellowship of the Ring'),
(7, 'Cooper', 'The Godfather'),
(11, 'Corujo', 'Scarface'),
(15, 'Duvall', 'The Godfather'),
(5, 'Freeman', 'The Godfather'),
(18, 'Hanks', 'Up in the Air'),
(17, 'Hemsworth', 'Up in the Air'),
(9, 'Johansson', 'Up in the Air'),
(21, 'Phoenix', 'Joker 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`actorid`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieid`);

--
-- Indexes for table `movie_actors`
--
ALTER TABLE `movie_actors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_relationship` (`last_name`,`title`),
  ADD KEY `idx_last_name` (`last_name`),
  ADD KEY `idx_movie` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `actorid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `movie_actors`
--
ALTER TABLE `movie_actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
