-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 11:31 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

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
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cnum` varchar(50) NOT NULL,
  `paid_ref` varchar(50) NOT NULL DEFAULT 'AWAITING PAYMENT',
  `discount` int(1) DEFAULT 0 COMMENT '1- discounted / 0 - Not discounted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`id`, `schedule_id`, `ref_no`, `name`, `qty`, `status`, `date_updated`, `cnum`, `paid_ref`, `discount`) VALUES
(12, 10, '202401316263', 'test', 1, 1, '2024-02-24 13:44:26', '09504059787', '20240224064426', 0),
(15, 17, '202401314052', 'Joseph Garcia', 3, 1, '2024-01-31 21:41:59', '09397126139', 'AWAITING PAYMENT', 0),
(16, 10, '202402101275', 'test', 1, 1, '2024-02-10 17:50:26', '123123123123', '20240210105026', 0),
(17, 10, '202402106867', 'terry', 2, 1, '2024-02-10 18:04:51', '123123123', '20240210110451', 0),
(18, 11, '202402107582', 'balbal', 2, 1, '2024-02-10 18:17:03', '123123', '20240210111703', 0),
(19, 17, '202402105212', 'kenny', 2, 1, '2024-02-10 18:19:29', '123123', '20240210111929', 0),
(20, 23, '202403068085', 'test', 1, 1, '2024-03-10 12:38:49', '123123', '20240310053849', 0),
(21, 29, '202403103386', 'terry', 1, 1, '2024-03-10 11:00:04', '123123', '20240310040004', 0),
(22, 23, '20240310576', 'claire', 2, 1, '2024-03-10 12:19:55', '12312312312', '20240310051955', 0),
(23, 29, '202403104400', 'bal', 12, 1, '2024-03-10 12:47:00', '123123', '20240310054700', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `driver` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `bus_id`, `from_location`, `to_location`, `departure_time`, `eta`, `status`, `availability`, `price`, `date_updated`, `driver`) VALUES
(23, 12, 13, 13, '2024-02-15 17:00:00', '2024-02-24 18:00:00', 1, 24, '250', '2024-02-24 06:28:48', 'test'),
(27, 13, 13, 13, '2024-02-02 14:37:00', '2024-02-23 14:37:00', 0, 123, '123', '2024-02-24 06:40:36', ''),
(28, 13, 13, 13, '2024-02-14 14:38:00', '2024-03-02 20:00:00', 0, 24, '256', '2024-02-24 06:40:39', 'Erwin Smith'),
(29, 12, 14, 14, '2024-02-24 19:00:00', '2024-02-24 19:00:00', 1, 2, '4', '2024-02-24 06:40:54', 'Erwin Smith');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver`
--

CREATE TABLE `tbl_driver` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `ID` int(11) NOT NULL,
  `Type` varchar(20) DEFAULT NULL,
  `feedback` varchar(500) NOT NULL,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`ID`, `Type`, `feedback`, `Fname`, `Lname`, `email`, `date_created`) VALUES
(3, 'Question', 'test@test1', 'test@test1', 'test@test1', 'test@test1', '2024-02-24 11:24:00'),
(4, 'Question', 'test2@test', 'test2@test', 'test2@test', 'test2@test', '2024-02-24 11:30:43'),
(5, 'Comment', 'bal@baltest', 'bal@baltest', 'bal@baltest', 'bal@baltest', '2024-02-24 11:36:57'),
(6, 'Question', '1231232@123', '1231232@123', '1231232@123', '1231232@123', '2024-02-24 11:46:11'),
(7, 'Suggestion', 'L RATIOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO', 'Erwin', 'Smith', 'erwinlovetitans@gmail.com', '2024-02-24 14:10:02'),
(8, 'Comment', '121212', '121', '21212', '1212@12312', '2024-03-10 16:39:38'),
(9, 'Comment', '121212', '121', '21212', '1212@12312', '2024-03-10 16:42:26'),
(10, 'Suggestion', 'asd', 'asd', 'asd', 'asd@asd', '2024-03-10 16:42:40');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type`, `username`, `password`, `status`, `date_updated`) VALUES
(1, 'Administrator', 1, 'admin', 'f2d0ff370380124029c2b807a924156c', 1, '2022-06-25 20:13:42'),
(3, 'AdminWilly', 2, 'willy', 'f2d0ff370380124029c2b807a924156c', 1, '2022-06-25 20:14:01'),
(5, 'Gerald Balasta', 1, 'gerald_admin', '123456', 0, '2024-01-29 22:53:21'),
(6, 'test', 1, 'test', 'test', 0, '2024-01-29 22:53:19'),
(7, 'Test', 1, 'test', '098f6bcd4621d373cade4e832627b4f6', 1, '2024-01-29 22:53:29');

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
-- Indexes for table `tbl_driver`
--
ALTER TABLE `tbl_driver`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_driver`
--
ALTER TABLE `tbl_driver`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
