-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 07:43 AM
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
-- Database: `balbal`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `id` int(30) NOT NULL,
  `schedule_id` int(30) NOT NULL,
  `ref_no` text NOT NULL,
  `name` varchar(250) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '1=Paid, 0- Unpaid',
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `bus_number` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = inactive, 1 = active',
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `name`, `bus_number`, `status`, `date_updated`) VALUES
(1, 'Greyhound', 'ADG4455', 0, '2024-01-05 13:44:07'),
(2, 'Greyhound', 'ADG7782', 0, '2024-01-05 13:44:10'),
(3, 'Greyhound', 'ADG6657', 0, '2024-01-05 13:44:09'),
(4, 'Greyhound', 'ADG1769', 0, '2024-01-05 13:44:06'),
(5, 'BoltBus', 'SFH2587', 0, '2024-01-05 13:44:14'),
(6, 'BoltBus', 'SFH7777', 0, '2024-01-05 13:44:16'),
(7, 'RedCoach', 'QWE8787', 0, '2024-01-05 13:44:13'),
(8, 'Jefferson', 'ERE2585', 0, '2024-01-05 13:44:11'),
(9, 'Vamoze', 'TWE8969', 0, '2024-01-05 13:44:20'),
(10, 'FlixB', 'TTY5874', 0, '2024-01-05 13:44:17'),
(11, 'Vamoze', 'TWE1258', 0, '2024-01-05 13:44:18'),
(12, 'ORDINARY BUS', 'NO.1', 1, '2024-01-05 13:44:34'),
(13, 'AIRCON', 'NO.2', 1, '2024-01-05 13:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(30) NOT NULL,
  `terminal_name` text NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0= inactive , 1= active',
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `terminal_name`, `city`, `state`, `status`, `date_updated`) VALUES
(1, 'Flouburn', 'Wig Hills', 'P One', 0, '2024-01-05 13:39:34'),
(2, 'Osebury', 'Meoculdap Hills', 'P Two', 0, '2024-01-05 13:39:39'),
(3, 'Ertontin', 'Xod Vale', 'P Four', 0, '2024-01-05 13:39:31'),
(4, 'Oreta', 'Tiolt Cross', 'P One', 0, '2024-01-05 13:39:37'),
(5, 'Agosving', 'Xod Vale', 'P Two', 0, '2024-01-05 13:39:25'),
(6, 'Buufield', 'Little Swarrum', 'P Three', 0, '2024-01-05 13:39:28'),
(7, 'Adamery', 'Smepealgok Heights', 'P Three', 0, '2024-01-05 13:39:21'),
(8, 'Ikleim', 'Bayside Threggac', 'P Three', 0, '2024-01-05 13:39:35'),
(9, 'Feeloshis Grove', 'D Eig', 'P Four', 0, '2024-01-05 13:39:32'),
(10, 'Agoford', 'Plogelliag West', 'P Five', 0, '2024-01-05 13:39:24'),
(11, 'Cramery', 'Drorveac Cross', 'P Six', 0, '2024-01-05 13:39:30'),
(12, 'Athewell', 'Strugad Vale', 'P Six', 0, '2024-01-05 13:39:27'),
(13, 'Metro Manila', 'Parañaque  PITX', '', 1, '2024-01-05 13:40:00'),
(14, 'Metro Manila', 'Cubao', '', 1, '2024-01-05 13:40:23'),
(15, 'Metro Manila', 'Pasay', '', 1, '2024-01-05 13:41:31'),
(16, 'Tabaco', 'Albay', 'Bicol', 1, '2024-01-05 13:42:55'),
(17, 'Legazpi', 'Albay', 'Bicol', 1, '2024-01-05 13:42:35'),
(18, 'Tiwi', 'Albay', 'Bicol', 1, '2024-01-05 13:43:29'),
(19, 'Naga', 'Camarines Sur', 'Bicol', 0, '2024-01-05 14:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `bus_id` int(30) NOT NULL,
  `from_location` int(30) NOT NULL,
  `to_location` int(30) NOT NULL,
  `departure_time` datetime NOT NULL,
  `eta` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `availability` int(11) NOT NULL,
  `price` text NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `bus_id`, `from_location`, `to_location`, `departure_time`, `eta`, `status`, `availability`, `price`, `date_updated`) VALUES
(1, 11, 1, 5, '2022-06-25 15:00:00', '2022-06-25 20:00:00', 0, 25, '50', '2024-01-05 05:43:36'),
(2, 6, 1, 4, '2022-06-25 20:00:00', '2022-06-25 01:00:00', 0, 30, '26', '2024-01-05 05:43:38'),
(3, 1, 3, 9, '2022-06-26 10:00:00', '2022-06-26 16:00:00', 0, 32, '33', '2024-01-05 05:43:39'),
(4, 9, 4, 1, '2022-06-26 08:00:00', '2022-06-26 19:00:00', 0, 30, '65', '2024-01-05 05:43:41'),
(5, 7, 8, 10, '2022-06-27 10:00:00', '2022-06-27 19:00:00', 0, 33, '80', '2024-01-05 05:43:45'),
(6, 4, 7, 6, '2022-06-26 11:00:00', '2022-06-25 13:00:00', 0, 35, '43', '2024-01-05 05:43:42'),
(7, 8, 9, 4, '2022-06-27 15:00:00', '2022-06-27 23:00:00', 0, 34, '75', '2024-01-05 05:43:47'),
(8, 3, 6, 2, '2022-06-27 12:00:00', '2022-06-25 17:00:00', 0, 31, '68', '2024-01-05 05:43:48'),
(9, 10, 11, 12, '2022-06-26 10:00:00', '2022-06-26 13:00:00', 0, 38, '65', '2024-01-05 05:43:44'),
(10, 12, 16, 13, '2024-01-05 16:00:00', '2024-01-06 06:00:00', 1, 30, '760', '2024-01-05 05:56:14'),
(11, 13, 16, 13, '2024-01-05 16:00:00', '2024-01-06 06:00:00', 1, 30, '960', '2024-01-05 05:57:24'),
(12, 12, 17, 13, '2024-01-05 17:00:00', '2024-01-06 05:00:00', 1, 30, '760', '2024-01-05 06:04:10'),
(13, 13, 17, 13, '2024-01-05 17:00:00', '2024-01-06 05:00:00', 1, 30, '960', '2024-01-05 06:05:35'),
(14, 12, 18, 13, '2024-01-05 15:00:00', '2024-01-06 13:00:00', 1, 30, '760', '2024-01-05 06:02:56'),
(15, 13, 18, 13, '2024-01-05 15:00:00', '2024-01-06 05:00:00', 1, 30, '960', '2024-01-05 06:06:35'),
(16, 13, 13, 16, '2024-01-05 18:30:00', '2024-01-06 07:00:00', 0, 30, '960', '2024-01-05 06:21:30'),
(17, 12, 13, 16, '2024-01-05 09:00:00', '2024-01-05 23:00:00', 1, 30, '760', '2024-01-05 06:21:44'),
(18, 13, 13, 16, '2024-01-05 18:30:00', '2024-01-06 07:30:00', 1, 30, '960', '2024-01-05 06:23:58'),
(19, 12, 14, 18, '2024-01-05 07:30:00', '2024-01-05 21:00:00', 1, 30, '760', '2024-01-05 06:29:30'),
(20, 13, 14, 18, '2024-01-05 17:00:00', '2024-01-06 05:00:00', 1, 30, '960', '2024-01-05 06:32:50'),
(21, 12, 15, 17, '2024-01-05 16:00:00', '2024-01-06 05:00:00', 1, 30, '760', '2024-01-05 06:36:51'),
(22, 13, 15, 17, '2024-01-05 19:00:00', '2024-01-06 08:00:00', 1, 30, '960', '2024-01-05 06:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(150) NOT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT 1,
  `username` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT ' 0 = incative , 1 = active',
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type`, `username`, `password`, `status`, `date_updated`) VALUES
(1, 'Administrator', 1, 'admin', 'f2d0ff370380124029c2b807a924156c', 1, '2022-06-25 20:13:42'),
(3, 'AdminWilly', 2, 'willy', 'f2d0ff370380124029c2b807a924156c', 1, '2022-06-25 20:14:01'),
(4, 'AdminLea', 1, 'leadmin', 'f2d0ff370380124029c2b807a924156c', 1, '2022-06-25 20:14:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
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
-- AUTO_INCREMENT for table `booked`
--
ALTER TABLE `booked`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
