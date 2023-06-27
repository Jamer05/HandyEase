-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2023 at 03:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;



-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `authoriser`
--

CREATE TABLE `authoriser` (
  `id` varchar(10) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `request` varchar(20) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `location` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `adminuser` varchar(20) DEFAULT NULL,
  `otp`varchar(255) DEFAULT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `authoriser`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` varchar(10) NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `area` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `transno` varchar(20) NOT NULL,
  `cid` varchar(10) NOT NULL,
  `amount` int(5) NOT NULL,
  `wid` varchar(10) NOT NULL,
  `wage` int(5) NOT NULL,
  `aid` varchar(10) DEFAULT NULL,
  `request` varchar(20) DEFAULT NULL,
  `cust_name` varchar(30) DEFAULT NULL,
  `auth_name` varchar(30) DEFAULT NULL,
  `worker_name` varchar(30) DEFAULT NULL,
  `tdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


CREATE TABLE `service` (
  `id` varchar(10) NOT NULL DEFAULT '',
  `request` varchar(20) NOT NULL DEFAULT '',
  `dateofreq` date NOT NULL,
  `aflag` varchar(10) NOT NULL,
  `transflag` int(1) NOT NULL,
  `authid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `service`
--


-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `id` varchar(10) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `profession` varchar(20) NOT NULL,
  `authid` varchar(10) DEFAULT NULL,
  `adminuser` varchar(20) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `area` varchar(20) DEFAULT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `worker`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `authoriser`
--
ALTER TABLE `authoriser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `authcity` (`request`,`location`,`city`),
  ADD UNIQUE KEY `unuser` (`username`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`transno`),
  ADD KEY `wid` (`wid`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`,`request`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authid` (`authid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `finance`
--
ALTER TABLE `finance`
  ADD CONSTRAINT `finance_ibfk_3` FOREIGN KEY (`wid`) REFERENCES `worker` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `finance_ibfk_4` FOREIGN KEY (`aid`) REFERENCES `authoriser` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `cusreq` FOREIGN KEY (`id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `worker`
--
ALTER TABLE `worker`
  ADD CONSTRAINT `worker_ibfk_1` FOREIGN KEY (`authid`) REFERENCES `authoriser` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
