-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 19, 2021 at 12:13 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.3.27-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id` int(11) NOT NULL,
  `trip_name` varchar(225) NOT NULL,
  `trip_type` tinyint(4) NOT NULL COMMENT '1=quotation,2=trip',
  `status` tinyint(4) NOT NULL COMMENT '1=in discussion, 2=accepted, 3=rejected',
  `trip_status` tinyint(4) NOT NULL COMMENT '1=started, 2=completed, 3=rejected',
  `booking_cost` float NOT NULL,
  `commission_cost` float NOT NULL,
  `trip_date` date NOT NULL,
  `booking_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id`, `trip_name`, `trip_type`, `status`, `trip_status`, `booking_cost`, `commission_cost`, `trip_date`, `booking_date`, `created_at`, `updated_at`) VALUES
(1, 'Kashmir', 1, 1, 0, 4000, 400, '2021-04-07', '2021-03-02', '2021-03-01 00:00:00', '2021-03-01 00:00:00'),
(2, 'Manali', 1, 1, 0, 6000, 1000, '2021-03-22', '2021-03-06', '2021-03-01 00:00:00', '2021-03-01 00:00:00'),
(3, 'Mandav', 1, 2, 0, 3000, 500, '2021-04-04', '2021-03-11', '2021-03-01 00:00:00', '2021-03-01 00:00:00'),
(4, 'Kerala', 1, 2, 0, 6000, 2000, '2021-03-19', '2021-03-10', '2021-03-01 00:00:00', '2021-03-01 00:00:00'),
(5, 'Thailand', 2, 2, 1, 8000, 2000, '2021-03-19', '2021-03-06', '2021-03-02 00:00:00', '2021-03-02 00:00:00'),
(6, 'Sikkim', 2, 2, 2, 4500, 1000, '2021-02-17', '2021-02-08', '2021-02-01 00:00:00', '2021-02-01 00:00:00'),
(7, 'Dubai', 2, 2, 3, 15000, 5000, '2021-03-17', '2021-03-02', '2021-03-02 00:00:00', '2021-03-01 00:00:00'),
(8, 'Europe', 1, 3, 0, 20000, 7000, '2021-03-05', '2021-03-01', '2021-02-28 00:00:00', '2021-03-01 00:00:00'),
(9, 'Saudi Arabia', 2, 2, 1, 12000, 3000, '2021-03-19', '2021-03-10', '2021-03-01 00:00:00', '2021-03-02 00:00:00'),
(10, 'Andaman', 2, 2, 3, 4000, 500, '2021-02-23', '2021-02-08', '2021-02-02 00:00:00', '2021-02-02 00:00:00'),
(11, 'Goa', 2, 2, 1, 2000, 500, '2021-03-18', '2021-03-05', '2021-03-02 00:00:00', '2021-03-02 00:00:00'),
(12, 'Maldives', 1, 2, 0, 15000, 3000, '2021-03-24', '2021-03-11', '2021-03-01 00:00:00', '2021-03-01 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
