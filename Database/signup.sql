-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2023 at 09:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workers`
--

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `name` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`name`, `id`, `email`, `password`, `type`) VALUES
('ahmed amsa', 2, 'amsa@gmail.com', 'amsa 2004', 'user'),
('jo', 3, 'ahmed.mohammed733@gmail.com', '5678', 'user'),
('ahmed', 4, 'ahmed.mohammed609@gmail.com', '8901', 'user'),
('Ahmed_Sokrat', 6, 'ahmed.mohameed733@gmail.com', 'amsa', 'user'),
('ahmed', 11, 'ahmed.mohammed@gmail.com', 'a', 'user'),
('ahmed sayed ahmed', 12, 'ahmed.mohammed789@gmail.com', 'ahmed7271', 'user'),
('admin', 13, 'admin@gmail.com', 'admin', 'admin'),
('ds', 15, 'kkkkk@gmail.com', 'sdsddsds', 'user'),
('ahmed', 16, 'kkkoooo@gmail.com', 's', 'user'),
('salao', 17, 'ahmed.kkk@gmail.com', '8901343', 'user'),
('ahmed sayed ahmed', 19, 'ahmed.io@gmail.com', 'amsa2002@', 'user'),
('ahmed moh sayed', 20, 'ahmed.mohammed700@gmail.com', 'amsa2002@', 'user'),
('ahmed moh sayed ahmed', 22, 'ahmed.mohammed787@gmail.com', '8888888', 'user'),
('cdx', 23, 'ahmed.mohammed5665@gmail.com', 'a', 'user'),
('ahmed sayeddd', 24, 'ahmed.mohammed7890@gmail.com', 'a', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
