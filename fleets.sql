-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2021 at 12:43 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fleets`
--

-- --------------------------------------------------------

--
-- Table structure for table `fleet`
--

CREATE TABLE `fleet` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `maker` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `year` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fleet`
--

INSERT INTO `fleet` (`id`, `name`, `model`, `maker`, `type`, `color`, `year`) VALUES
(1, 'Matrix Salon', '404', 'Toyota', 'SUV', 'Black', '2021-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `groups` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `groups`) VALUES
(2, 'kixim Friday', 'kixim93059@relumyx.com', '$2y$10$64wRfFtBkkuN6FWoEeSB/uufvwQWOGzVLzLJN9pNRhq', 'Admin'),
(3, 'nameis', 'me@gmail.com', '$2y$10$2qWCArgGXxH267S8U6sWruKslYna0Qb23VKXrGZ5VEq', 'Admin'),
(4, 'kim@mayor.com', 'kim@mayor.com', '123456', 'Admin'),
(6, 'Oluwasegun Ajayi', 'ajayishegs@gmail.com', '$2y$10$NV9iBDx1gD0cFcA5qkW0TOZKHGIHHvIO.3eaQd7mpQZF47r2sNjDy', 'Admin'),
(7, 'Oluwasegun Ajayi', 'ajayishegs@gmail.coms', '$2y$10$wjVNanVuMfuDzKM2b7cs6.3gIqKXQpUhcKQlJWYryfrxdS4p92eAa', 'Admin'),
(8, 'kixim Friday', 'kixim93059@relumyx.comm', '$2y$10$9v5MBiCbivy2io8ljaK2o.kQeNsCoL4fopLGpwtKgjSWJuyeDQTNm', 'Admin'),
(9, 'kixim Friday', 'kixim93059@relumyx.commm', '$2y$10$y6cjHbmFAgHUHp4wsjHF3e5DcZkw3cmys39oKPLxPytoBCVOStqr2', 'User'),
(10, 'kixim Friday', 'kixim93059@relumyx.coom', '$2y$10$LmW2s4s6.q2L2iz4935O2OnZCUnxVjmA2dulqUXY3kkGD7ug2Hamm', 'Manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fleet`
--
ALTER TABLE `fleet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fleet`
--
ALTER TABLE `fleet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
