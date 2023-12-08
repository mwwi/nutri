-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 07:21 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nutri`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `a_last_name` varchar(55) NOT NULL,
  `a_first_name` varchar(55) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `u_firstName` varchar(55) NOT NULL,
  `u_lastName` varchar(55) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(55) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `age` int(2) NOT NULL,
  `height_feet` int(2) NOT NULL,
  `height_inches` int(2) NOT NULL,
  `weight` float NOT NULL,
  `height_in_m` double NOT NULL,
  `height_in_cm` int(11) NOT NULL,
  `dbw_bmi` int(5) NOT NULL,
  `dbw_hamwi` int(5) NOT NULL,
  `dbw_tann` int(5) NOT NULL,
  `pal` int(5) NOT NULL,
  `harris` int(5) NOT NULL,
  `mifflin` int(5) NOT NULL,
  `oxford` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `u_firstName`, `u_lastName`, `email`, `password`, `create_datetime`, `gender`, `age`, `height_feet`, `height_inches`, `weight`, `height_in_m`, `height_in_cm`, `dbw_bmi`, `dbw_hamwi`, `dbw_tann`, `pal`, `harris`, `mifflin`, `oxford`) VALUES
(20, 'iwam', 'maw', 'avenido', 'm@test.com', '81dc9bdb52d04dc20036dbd8313ed055', '2023-11-05 14:43:26', 'Female', 20, 5, 4, 51, 1.6256, 163, 58, 104, 56, 1740, 1351, 1250, 1250),
(22, 'jc', 'jessie', 'calvo', 'j@calvo.com', '202cb962ac59075b964b07152d234b70', '2023-11-10 07:50:38', 'Male', 22, 5, 7, 55, 1.7018, 170, 63, 113, 63, 1890, 1525, 1500, 1450),
(23, 'wy', 'wy', 'wy', 'wy@test.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-11-16 15:25:47', 'Male', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, 'test', 'test', 'test', 'test@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-12-01 06:54:02', 'Male', 21, 5, 4, 51, 1.6256, 163, 58, 0, 0, 2030, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
