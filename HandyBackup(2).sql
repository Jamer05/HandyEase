-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 17, 2023 at 03:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `HandyBackup`
--

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
  `otp` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `p_p` varchar(255) DEFAULT 'user-default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `authoriser`
--

INSERT INTO `authoriser` (`id`, `firstname`, `lastname`, `request`, `phone`, `location`, `city`, `username`, `password`, `email`, `adminuser`, `otp`, `image`, `p_p`) VALUES
('AUTH000000', 'Jamer', 'Ramiro', 'Plumber', 9777325694, 'Nueva Ecija', 'Sumacab', 'Jamer1', '$2y$10$tfPi15xLvU/J/xt.0vd9UOaidHetLDeExqqH9D1uRKs5y.IhNY9aa', 'jamerkelly09877@protonmail.com', 'admin', '$2y$10$juDRCY8On1xPsGCOJAeuBOF0RACmvk/V4KrySMtFEfgRdiy5zdXMW', '312126064_849626026482157_7857235127843595193_n.jpg', 'user-default.png'),
('AUTH000001', 'Art', 'Bal', 'Electrician', 9777325694, 'Nueva Ecija', 'Sumacab', 'Jamer2', '$2y$10$x2xKYZLI/RDjmgOoNMFIEORLE4T8IcFDbJ3AZvZgcg2srsQVVJGGG', 'jamerkelly09877@protonmail.com', 'admin', NULL, 'fred.jpeg', 'user-default.png'),
('AUTH000002', 'Ramram', 'Mermer', 'Carpenter', 9777325694, 'Nueva Ecija', 'Sumacab', 'Jamer3', '$2y$10$m2Bg4qcghknkiu3kDhI2c.QAaSmkc5/zuwcpuRjjL0bOIVZ2Oke5W', 'jamerkelly09877@protonmail.com', 'admin', NULL, 'me.jpg', 'user-default.png'),
('AUTH000003', 'Bilog ', 'Dirty', 'Washing Machine', 9777325694, 'Nueva Ecija', 'Sumacab', 'Jamer4', '$2y$10$uw4b7gcd36wdGr9CXHNHRu3rJwGACXSjIUvXR4LwVFTYsgXb2YiSu', 'jamerkelly09877@protonmail.com', 'admin', NULL, '312126064_849626026482157_7857235127843595193_n.jpg', 'user-default.png');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT 0,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `from_id`, `to_id`, `message`, `opened`, `create_at`) VALUES
(95, 1, 2, 'hello\n', 1, '2023-09-17 20:49:35'),
(96, 2, 1, 'hello po', 1, '2023-09-17 20:50:07'),
(97, 1, 2, 'hi\n', 1, '2023-09-17 20:51:05'),
(98, 2, 1, 'kayo na po ba yung worker?', 1, '2023-09-17 20:51:14'),
(99, 1, 2, 'yes po', 1, '2023-09-17 20:51:18'),
(100, 2, 1, 'ok po', 1, '2023-09-17 20:52:59'),
(101, 4, 2, 'ad', 1, '2023-09-17 21:00:55'),
(102, 2, 4, 'hello', 1, '2023-09-17 21:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`conversation_id`, `user_1`, `user_2`) VALUES
(32, 1, 2),
(33, 4, 2);

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

INSERT INTO `customer` (`id`, `firstname`, `lastname`, `phone`, `email`, `area`, `city`) VALUES
('CUS0000000', 'april1', 'adasd', 9777325694, 'jamerkelly09877@protonmail.com', 'Sumacab', 'Nueva Ecija'),
('CUS0000001', 'april1', 'bsnsn', 9777325694, 'jamerkelly09877@gmail.com', 'Sumacab', 'Nueva Ecija'),
('CUS0000002', 'april1', 'hdhshs', 9777325694, 'jamerkelly09877@gmail.com', 'Sumacab', 'Nueva Ecija');

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

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`transno`, `cid`, `amount`, `wid`, `wage`, `aid`, `request`, `cust_name`, `auth_name`, `worker_name`, `tdate`) VALUES
('TRN0000000', 'CUS0000000', 1000, 'WORK000000', 200, 'AUTH000000', 'Plumber', 'CUS0000000', 'Plumber', 'WORK000000 Hemerson', '2023-09-17'),
('TRN0000001', 'CUS0000001', 1000, 'WORK000002', 200, 'AUTH000000', 'Plumber', 'CUS0000001', 'Plumber', 'WORK000002 Piolo', '2023-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` varchar(10) NOT NULL DEFAULT '',
  `username` varchar(100) NOT NULL,
  `request` varchar(20) NOT NULL DEFAULT '',
  `dateofreq` date NOT NULL,
  `aflag` varchar(10) NOT NULL,
  `transflag` int(1) NOT NULL,
  `authid` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `username`, `request`, `dateofreq`, `aflag`, `transflag`, `authid`, `status`) VALUES
('CUS0000000', 'april1', 'Plumber', '2023-09-17', 'WORK000000', 1, 'AUTH000000', 'Approved'),
('CUS0000001', 'april1', 'Plumber', '2023-09-17', 'WORK000002', 1, 'AUTH000000', 'Approved'),
('CUS0000002', 'april1', 'Plumber', '2023-09-17', 'WORK000000', 0, 'AUTH000000', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `p_p` varchar(255) DEFAULT 'user-default.png',
  `last_seen` datetime NOT NULL DEFAULT current_timestamp(),
  `staff` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `password`, `p_p`, `last_seen`, `staff`) VALUES
(1, 'Hemerson', 'Jamer', '$2y$10$.X5yWkXzvr2qtFdRnK4LGO0E9YK0pdob0Wvk0WHP2iTUMA8TNO.GC', 'user-default.png', '2023-09-17 21:18:20', 'TRUE'),
(2, 'April', 'april1', '$2y$10$Fp5LUry9Nu/7GX.jkrjZ/Ox/MAXU.Tr2JEFElGosBBCTEmDqrBC9i', 'user-default.png', '2023-09-17 21:14:53', 'WORK000000'),
(3, 'Rowell', 'Rowell', '$2y$10$F9CyTCXYG8f.vJz5.aec1.gwWQkP82FLD5.//W7SAfeW9fYDmxtoq', 'user-default.png', '2023-09-17 20:52:30', 'TRUE'),
(4, 'Piolo', 'Piolo', '$2y$10$fZ4rAr/aukQ6rG98Ny4Vi.oboUJxw.QyrMwGTFC399YU.xxL0mBJe', 'user-default.png', '2023-09-17 21:01:29', 'TRUE');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `id` varchar(10) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
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

INSERT INTO `worker` (`id`, `firstname`, `lastname`, `username`, `password`, `phone`, `profession`, `authid`, `adminuser`, `location`, `area`, `email`) VALUES
('WORK000000', 'Hemerson', 'Ramiro', 'Jamer', '$2y$10$.X5yWkXzvr2qtFdRnK4LGO0E9YK0pdob0Wvk0WHP2iTUMA8TNO.GC', 9777325694, 'Plumber', 'AUTH000000', 'admin', 'Nueva Ecija', 'Sumacab', 'jamerkelly09877@protonmail.com'),
('WORK000001', 'Rowell', 'Ongjiangco', 'Rowell', '$2y$10$F9CyTCXYG8f.vJz5.aec1.gwWQkP82FLD5.//W7SAfeW9fYDmxtoq', 9777325694, 'Plumber', 'AUTH000000', 'admin', 'Nueva Ecija', 'Sumacab', 'jamerkelly09877@protonmail.com'),
('WORK000002', 'Piolo', 'Bernardino', 'Piolo', '$2y$10$fZ4rAr/aukQ6rG98Ny4Vi.oboUJxw.QyrMwGTFC399YU.xxL0mBJe', 9777325694, 'Plumber', 'AUTH000000', 'admin', 'Nueva Ecija', 'Palayan City', 'jamerkelly09877@protonmail.com');

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
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authid` (`authid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
