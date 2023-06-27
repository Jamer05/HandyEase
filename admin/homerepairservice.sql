
DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `password` (`password`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('jamer','cute');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authoriser`
--

DROP TABLE IF EXISTS `authoriser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `adminuser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `authcity` (`request`,`location`,`city`),
  UNIQUE KEY `unuser` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authoriser`
--
--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` varchar(10) NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `area` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

--
-- Table structure for table `finance`
--

DROP TABLE IF EXISTS `finance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `tdate` date NOT NULL,
  PRIMARY KEY (`transno`),
  KEY `wid` (`wid`),
  KEY `aid` (`aid`),
  CONSTRAINT `finance_ibfk_3` FOREIGN KEY (`wid`) REFERENCES `worker` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `finance_ibfk_4` FOREIGN KEY (`aid`) REFERENCES `authoriser` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finance`
--


--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `id` varchar(10) NOT NULL DEFAULT '',
  `request` varchar(20) NOT NULL DEFAULT '',
  `dateofreq` date NOT NULL,
  `aflag` varchar(10) NOT NULL,
  `transflag` int(1) NOT NULL,
  `authid` varchar(10) NOT NULL,
  PRIMARY KEY (`id`,`request`),
  CONSTRAINT `cusreq` FOREIGN KEY (`id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--


--
-- Table structure for table `worker`
--

DROP TABLE IF EXISTS `worker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `authid` (`authid`),
  CONSTRAINT `worker_ibfk_1` FOREIGN KEY (`authid`) REFERENCES `authoriser` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worker`
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-31 19:04:18
