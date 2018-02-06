-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2018 at 03:30 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `parking_assist`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE IF NOT EXISTS `booking_details` (
  `id` int(11) NOT NULL,
  `booking_no` varchar(60) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_type` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `total_amount` decimal(6,2) NOT NULL,
  `booking_date` int(11) NOT NULL,
  `reservation_date` int(11) NOT NULL,
  `reservation_starttime` int(11) NOT NULL,
  `reservation_endtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parking_area`
--

CREATE TABLE IF NOT EXISTS `parking_area` (
  `id` int(11) NOT NULL,
  `location` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` varchar(600) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parking_area`
--

INSERT INTO `parking_area` (`id`, `location`, `status`, `description`) VALUES
(1, 'Kottayam', 1, 'Thirunakara Central Jn');

-- --------------------------------------------------------

--
-- Table structure for table `parking_slots`
--

CREATE TABLE IF NOT EXISTS `parking_slots` (
  `id` int(11) NOT NULL,
  `slot_name` varchar(60) NOT NULL,
  `vehicle_type` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `parking_area_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parking_slots`
--

INSERT INTO `parking_slots` (`id`, `slot_name`, `vehicle_type`, `status`, `parking_area_id`) VALUES
(8, 'Slot-1', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slot_rate`
--

CREATE TABLE IF NOT EXISTS `slot_rate` (
  `id` int(11) NOT NULL,
  `parking_area_id` int(11) NOT NULL,
  `vehicle_type` int(11) NOT NULL,
  `rate_perhour` decimal(6,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slot_rate`
--

INSERT INTO `slot_rate` (`id`, `parking_area_id`, `vehicle_type`, `rate_perhour`) VALUES
(2, 1, 2, '125.00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `gender` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`, `status`, `name`, `mobile`, `gender`) VALUES
(1, 'rahul@xxx.com', 'admin', 'admin', 1, 'Rahul V M', '9744574436', 'Male'),
(2, 'staff@xxx.com', 'staff', 'staff', 1, 'staff one', '9999999999', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE IF NOT EXISTS `vehicle_type` (
  `id` int(11) NOT NULL,
  `vehicle_type` varchar(60) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_type`
--

INSERT INTO `vehicle_type` (`id`, `vehicle_type`, `status`) VALUES
(1, 'LMV', 1),
(2, 'HMV', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `slot_id` (`slot_id`), ADD KEY `vehicle_type` (`vehicle_type`);

--
-- Indexes for table `parking_area`
--
ALTER TABLE `parking_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parking_slots`
--
ALTER TABLE `parking_slots`
  ADD PRIMARY KEY (`id`), ADD KEY `reservation_area_id` (`parking_area_id`), ADD KEY `vehicle_type` (`vehicle_type`);

--
-- Indexes for table `slot_rate`
--
ALTER TABLE `slot_rate`
  ADD PRIMARY KEY (`id`), ADD KEY `parking_area_id` (`parking_area_id`), ADD KEY `vehicle_type` (`vehicle_type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parking_area`
--
ALTER TABLE `parking_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `parking_slots`
--
ALTER TABLE `parking_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `slot_rate`
--
ALTER TABLE `slot_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `parking_slots`
--
ALTER TABLE `parking_slots`
ADD CONSTRAINT `parking_slots_ibfk_3` FOREIGN KEY (`vehicle_type`) REFERENCES `vehicle_type` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `parking_slots_ibfk_4` FOREIGN KEY (`parking_area_id`) REFERENCES `parking_area` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `slot_rate`
--
ALTER TABLE `slot_rate`
ADD CONSTRAINT `slot_rate_ibfk_1` FOREIGN KEY (`parking_area_id`) REFERENCES `parking_area` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `slot_rate_ibfk_2` FOREIGN KEY (`vehicle_type`) REFERENCES `vehicle_type` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
