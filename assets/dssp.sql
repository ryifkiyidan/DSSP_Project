-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2020 at 03:12 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dssp`
--

-- --------------------------------------------------------

--
-- Table structure for table `direksi`
--

CREATE TABLE `direksi` (
  `direksi_id` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `direksi`
--

INSERT INTO `direksi` (`direksi_id`, `role`, `email`, `password`, `first_name`, `last_name`, `address`, `phone_number`) VALUES
('dir1', 'direksi', 'surya.mulyono@gmail.com', '7b19aa24dd711cf18a48d887014d6017', 'surya', 'mulyono', 'jl. majapahit raya no. 105', '081122334455');

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `dokumen_id` varchar(10) NOT NULL,
  `finance_id` varchar(10) NOT NULL,
  `direksi_id` varchar(10) NOT NULL,
  `signature_id` varchar(10) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `upload_date` varchar(20) NOT NULL,
  `due_date` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `finance_id` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`finance_id`, `role`, `email`, `password`, `first_name`, `last_name`, `address`, `phone_number`) VALUES
('fin1', 'finance', 'sri.mulyani@gmail.com', '3c63aa72800afefcda35494c90476ef7', 'sri', 'mulyani', 'jl. ken arok ii no. 6', '081234567890');

-- --------------------------------------------------------

--
-- Table structure for table `signature`
--

CREATE TABLE `signature` (
  `signature_id` varchar(10) NOT NULL,
  `direksi_id` varchar(10) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `direksi`
--
ALTER TABLE `direksi`
  ADD PRIMARY KEY (`direksi_id`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`dokumen_id`),
  ADD KEY `finance_id` (`finance_id`),
  ADD KEY `direksi_id` (`direksi_id`),
  ADD KEY `signature_id` (`signature_id`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`finance_id`);

--
-- Indexes for table `signature`
--
ALTER TABLE `signature`
  ADD PRIMARY KEY (`signature_id`),
  ADD KEY `direksi_id` (`direksi_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`finance_id`) REFERENCES `finance` (`finance_id`),
  ADD CONSTRAINT `dokumen_ibfk_2` FOREIGN KEY (`direksi_id`) REFERENCES `direksi` (`direksi_id`),
  ADD CONSTRAINT `dokumen_ibfk_3` FOREIGN KEY (`signature_id`) REFERENCES `signature` (`signature_id`);

--
-- Constraints for table `signature`
--
ALTER TABLE `signature`
  ADD CONSTRAINT `signature_ibfk_1` FOREIGN KEY (`direksi_id`) REFERENCES `direksi` (`direksi_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
