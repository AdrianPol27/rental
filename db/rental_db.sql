-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 04:49 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `rents_tbl`
--

CREATE TABLE `rents_tbl` (
  `rent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `unit_model` varchar(100) NOT NULL,
  `unit_cost` int(11) NOT NULL,
  `start_rent` date NOT NULL,
  `end_rent` date NOT NULL,
  `days` int(11) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rents_tbl`
--

INSERT INTO `rents_tbl` (`rent_id`, `user_id`, `fullname`, `address`, `unit_model`, `unit_cost`, `start_rent`, `end_rent`, `days`, `total`, `status`) VALUES
(8, 7, 'Adrian Pol Peligrino', 'Lunao, Gingoog City', 'Three Axle Articulated Truck', 15000, '2022-05-21', '2022-06-11', 21, '315,000.00', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `units_tbl`
--

CREATE TABLE `units_tbl` (
  `unit_id` int(11) NOT NULL,
  `unit_image` text NOT NULL,
  `unit_model` varchar(100) NOT NULL,
  `unit_cost` int(11) NOT NULL,
  `unit_description` varchar(255) NOT NULL,
  `unit_availability` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units_tbl`
--

INSERT INTO `units_tbl` (`unit_id`, `unit_image`, `unit_model`, `unit_cost`, `unit_description`, `unit_availability`) VALUES
(7, './assets/images/units/62866e8db2fb46.61875044.jpg', 'Three Axle Articulated Truck', 15000, 'Three Axle Articulated Truck Description', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `user_id` int(11) NOT NULL,
  `user_type` int(1) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`user_id`, `user_type`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 0, 'Rental', 'Admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(7, 1, 'Adrian Pol', 'Peligrino', 'adrianpolpeligrino27@gmail.com', '76d80224611fc919a5d54f0ff9fba446');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rents_tbl`
--
ALTER TABLE `rents_tbl`
  ADD PRIMARY KEY (`rent_id`);

--
-- Indexes for table `units_tbl`
--
ALTER TABLE `units_tbl`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rents_tbl`
--
ALTER TABLE `rents_tbl`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `units_tbl`
--
ALTER TABLE `units_tbl`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
