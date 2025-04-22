-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2025 at 01:38 AM
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
-- Database: `mySite`
--

-- --------------------------------------------------------

--
-- Table structure for table `myFooter`
--

CREATE TABLE `myFooter` (
  `footer_id` smallint(5) UNSIGNED NOT NULL,
  `copyright_text` varchar(255) NOT NULL,
  `contact_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `myFooter`
--

INSERT INTO `myFooter` (`footer_id`, `copyright_text`, `contact_email`) VALUES
(1, '© 2025 Pablo Semidey. All rights reserved.', 'semidp@rpi.edu');

-- --------------------------------------------------------

--
-- Table structure for table `myLabs`
--

CREATE TABLE `myLabs` (
  `lab_id` smallint(5) UNSIGNED NOT NULL,
  `lab_name` varchar(100) NOT NULL,
  `lab_readme` varchar(255) DEFAULT NULL,
  `lab_page` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `myLabs`
--

INSERT INTO `myLabs` (`lab_id`, `lab_name`, `lab_readme`, `lab_page`) VALUES
(1, 'Lab 1 - GitHub and Azure VM Setup', '../Lab 1/README.md', '../Lab 1/semidp-AzureStatus.png'),
(2, 'Lab 2 - Create Your Resume', '../Lab2/README.md', '../Lab2/Resume.html'),
(3, 'Lab 3 - Create a Website', '../Lab 3/README.md', '../../index.php'),
(4, 'Lab 4 - XML (RSS and Atom)', '../lab4/README.md', '../lab4/labs-rss.xml'),
(5, 'Lab 5 - JavaScript Form', '../lab5/README.md', '../lab5/lab5.html'),
(6, 'Lab 6 - JQuery Practice', '../lab6/README.md', '../lab6/lab6.html'),
(7, 'Lab 7 - Term Project Mockup', '../../../../team12/README.md', '../../../../team12/html/homepage.html'),
(8, 'Lab 8 - JSON and AJAX', '../lab8/README.md', '../lab8/menu.json'),
(9, 'Lab 9 - PHP and MySQL', '../lab9/README.md', '../lab9/inclassexample/index.php'),
(10, 'Lab 10 - Move Servers to Production', '../lab10/README.md', '../lab10/index.php');

-- --------------------------------------------------------

--
-- Table structure for table `myProjects`
--

CREATE TABLE `myProjects` (
  `project_id` smallint(5) UNSIGNED NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_page` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `myProjects`
--

INSERT INTO `myProjects` (`project_id`, `project_name`, `project_page`) VALUES
(1, 'ITWS Term Project', '../../../../team12/html/homepage.html');

-- --------------------------------------------------------

--
-- Table structure for table `mySiteUsers`
--

CREATE TABLE `mySiteUsers` (
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` enum('admin','viewer') DEFAULT 'viewer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mySiteUsers`
--

INSERT INTO `mySiteUsers` (`user_id`, `username`, `user_password`, `user_role`) VALUES
(1, 'pablo', 'password', 'admin'),
(2, 'random', 'password123', 'viewer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `myFooter`
--
ALTER TABLE `myFooter`
  ADD PRIMARY KEY (`footer_id`);

--
-- Indexes for table `myLabs`
--
ALTER TABLE `myLabs`
  ADD PRIMARY KEY (`lab_id`);

--
-- Indexes for table `myProjects`
--
ALTER TABLE `myProjects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `mySiteUsers`
--
ALTER TABLE `mySiteUsers`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `myFooter`
--
ALTER TABLE `myFooter`
  MODIFY `footer_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `myLabs`
--
ALTER TABLE `myLabs`
  MODIFY `lab_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `myProjects`
--
ALTER TABLE `myProjects`
  MODIFY `project_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mySiteUsers`
--
ALTER TABLE `mySiteUsers`
  MODIFY `user_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
