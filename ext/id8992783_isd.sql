-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 01, 2019 at 08:55 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id8992783_isd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `PID` int(10) NOT NULL,
  `SID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `PID`, `SID`) VALUES
(0, 6, 1),
(1, 28, 52);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `PID` int(20) NOT NULL,
  `fkSupplier` int(11) DEFAULT NULL,
  `Supplier_Company` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `PID`, `fkSupplier`, `Supplier_Company`) VALUES
('1', 3, 2, 'LBpower'),
('3ht2JvP6JqPDjhaz4DLo3rvOu8a2', 47, 29, 'InnerCity Electric'),
('696iBrfZWiPNghhAyL9SAdPoG3v1', 49, 31, 'ECTV'),
('cxGB6hOofUf87FalFVzJV554jqn2', 41, 29, 'InnerCity Electric'),
('DLOgr8vsYHdvJK6SZl8Dre5P7yF2', 58, 18, 'associated'),
('H2pNhupAqGd0XM7juJYnvtmHMgz1', 52, 32, 'FairyDust'),
('hxRIDtePVFTrrrTMQvL97b3Qwk42', 54, 28, 'Royale'),
('modWroN8R1RLzeeacmohSAH6hmS2', 53, 32, 'FairyDust'),
('RF5Sl71vawU1EOsxYPrelNz1Ish2', 46, 30, 'Abbasiye Electric'),
('RQsqtXETOWPaxAXu6l5xulVfV212', 4, 1, ''),
('tFjtHhMX5HOfthWG9yko0ePqqm62', 5, 2, 'LBPower'),
('vzSsZsG0TYZse1pArPgDLqW7sxq1', 50, 31, 'ECTV'),
('W8kDGTGRtMcU1CMgmjJDwQ5t2Pu1', 43, 30, 'Abbasiye Electric'),
('xWwINbictGaMJiPaqzzmYK010He2', 45, 18, 'associated inc.'),
('yaSwxP2i2tV55biCUMM4LaKMDgh1', 55, 28, 'Royale'),
('ZuSEmzibqJTPIl64ZrhGYMAKuFq2', 44, 18, 'associated inc.');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` int(11) NOT NULL,
  `complaint_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detials` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sender_type` int(11) DEFAULT NULL,
  `fk_sender` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`id`, `complaint_type`, `detials`, `sender_type`, `fk_sender`) VALUES
(1, 'Software', 'my login isnt working', 1, NULL),
(2, 'Other', 'asdfasdadasd', 1, 'tFjtHhMX5HOfthWG9yko0ePqqm62'),
(3, 'Other', 'asdfasdadasd', 1, 'tFjtHhMX5HOfthWG9yko0ePqqm62'),
(4, 'hardware', 'asasasas', 1, 'tFjtHhMX5HOfthWG9yko0ePqqm62'),
(5, 'hardware', 'asdasd', 1, 'tFjtHhMX5HOfthWG9yko0ePqqm62'),
(6, 'hardware', 'asdasd', 1, 'tFjtHhMX5HOfthWG9yko0ePqqm62');

-- --------------------------------------------------------

--
-- Table structure for table `credit_card`
--

CREATE TABLE `credit_card` (
  `id_cc` int(11) NOT NULL,
  `fk_user` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_holder` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc_number` bigint(20) DEFAULT NULL,
  `cvc` int(11) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `balance` decimal(15,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credit_card`
--

INSERT INTO `credit_card` (`id_cc`, `fk_user`, `name_holder`, `cc_number`, `cvc`, `expire_date`, `balance`) VALUES
(1, '1', 'ALI', 2123242413, 212, '2019-04-17', '100.0000'),
(10, 'tFjtHhMX5HOfthWG9yko0ePqqm62', 'ALI RMEITI', 3627257826928385, 222, '2020-04-16', '2800.0000'),
(11, 'tFjtHhMX5HOfthWG9yko0ePqqm62', 'alidee', 13322222222, 211, '2019-03-01', '100.0000');

-- --------------------------------------------------------

--
-- Table structure for table `cumulative`
--

CREATE TABLE `cumulative` (
  `fk_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cumulative`
--

INSERT INTO `cumulative` (`fk_id`, `value`) VALUES
('1', 2300),
('tFjtHhMX5HOfthWG9yko0ePqqm62', 345.57),
('1', 2300),
('tFjtHhMX5HOfthWG9yko0ePqqm62', 321),
('1', 2300),
('tFjtHhMX5HOfthWG9yko0ePqqm62', 321),
('1', 2300),
('tFjtHhMX5HOfthWG9yko0ePqqm62', 321),
('RF5Sl71vawU1EOsxYPrelNz1Ish2', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `day_value`
--

CREATE TABLE `day_value` (
  `id` int(11) NOT NULL,
  `fk_client` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` double DEFAULT NULL,
  `dates` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `day_value`
--

INSERT INTO `day_value` (`id`, `fk_client`, `value`, `dates`) VALUES
(1, '1', 1000, '2019-05-01'),
(2, '1', 1000, '2019-05-01'),
(3, '1', 1000, '2019-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id_device` int(11) NOT NULL,
  `device_sn` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deive_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amper_capacity` int(11) DEFAULT NULL,
  `fk_client` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `fkSupplier` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id_device`, `device_sn`, `deive_type`, `amper_capacity`, `fk_client`, `fkSupplier`) VALUES
(5, '78945123156486', 'Amper', 1000, 'ZuSEmzibqJTPIl64ZrhGYMAKuFq2', 18),
(6, '723874623756235897', 'Electric', 100, 'xWwINbictGaMJiPaqzzmYK010He2', 18);

-- --------------------------------------------------------

--
-- Table structure for table `firebase_config`
--

CREATE TABLE `firebase_config` (
  `apiKey` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `authDomain` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `databaseURL` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `projectId` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `storageBucket` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `messagingSenderId` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hour_value`
--

CREATE TABLE `hour_value` (
  `id` int(11) NOT NULL,
  `fk_client` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `val` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `month_value`
--

CREATE TABLE `month_value` (
  `id` int(11) NOT NULL,
  `fk_client` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` double DEFAULT NULL,
  `dates` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `month_value`
--

INSERT INTO `month_value` (`id`, `fk_client`, `value`, `dates`) VALUES
(1, '1', 4000, '2019-05-01'),
(2, '1', 4000, '2019-05-01'),
(3, '1', 4000, '2019-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `pass`
--

CREATE TABLE `pass` (
  `SID` int(10) NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) NOT NULL,
  `activation_code` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pass`
--

INSERT INTO `pass` (`SID`, `password`, `email`, `status`, `activation_code`) VALUES
(48, '$2y$10$fFZcOxvMY3ahb', 'aliremaitybooK@gmail.com', 0, '60b6fb28d0754e7695cf13a67a262985'),
(49, '$2y$10$1GBmyp89wYnKb', '71310004@students.liu.edu.lb', 0, 'e6826319981e6a148502b314ff4d6740'),
(50, '$2y$10$Bk4xRQ5BM2Vzf', '71630024@students.liu.edu.lb', 0, '48ad45fbf0aa5b5f8874f8dc19a4ee9e');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `fk_client` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `consumption` double DEFAULT NULL,
  `costof1` float NOT NULL,
  `Total` float NOT NULL,
  `payment_st` int(11) DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `fk_client`, `consumption`, `costof1`, `Total`, `payment_st`, `issued_date`, `payment_date`) VALUES
(12, '1', 4000, 0, 0, 0, '2019-05-01', NULL),
(13, '1', 4000, 100, 400000, 0, '2019-05-01', NULL),
(14, '1', 4000, 100, 400000, 0, '2019-05-01', NULL),
(15, 'tFjtHhMX5HOfthWG9yko0ePqqm62', 120, 22, 213, 1, '2019-05-15', '2019-05-25'),
(16, 'tFjtHhMX5HOfthWG9yko0ePqqm62', 20, 60, 1200, 0, '2019-04-15', '2019-06-02'),
(17, 'tFjtHhMX5HOfthWG9yko0ePqqm62', 22, 10, 1232, 1, '2019-08-09', NULL),
(18, 'zB8CeFp0bUb432hpWpXqZYFXRIh2', 20, 450, 9000, 1, '2019-06-03', '2019-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `PID` int(20) NOT NULL,
  `role` int(1) NOT NULL,
  `fname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`PID`, `role`, `fname`, `lname`, `city`, `street`, `phone`, `email`) VALUES
(5, 0, 'Ali', 'Remaity', 'tyre', 'Liu main street', '70083254', 'aliremaitybook@gmail.com'),
(16, 0, 'ttttttttttt', 'ttttttttt', 'tttttttttt', 'tttttttttt', '2147483647', ''),
(17, 0, 'hassan', 'Issa', 'birut', 'down', '03896401', 'hassan@gmail.com'),
(20, 0, 'ALI', 'REMAITY', 'tyre', 'bank audi ', '2147483647', ''),
(21, 0, 'ALI', 'REMAITY', 'tyre', 'bank audi ', '3333333333333', ''),
(23, 0, 'Ali', 'remaity', 'asas', 'sasasas', '123123', 'aliremaitybooK@gmail.com'),
(24, 0, 'ali ', 'remaity ', 'qawsed123', 'liu  street ', '70234234', ''),
(25, 0, 'ahamd ', 'sweid ', 'dhayra', 'saad', '71413203', ''),
(41, 0, 'Babba', 'Rrmai', 'Aaaaaa', 'Dhshsha', '700868647', ''),
(46, 0, 'ALI', 'REMAITY', 'tyre', 'bank audi ', '2147483647', '');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `SID` int(10) NOT NULL,
  `comapany_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost_1kw` double DEFAULT NULL,
  `user_capacity` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `PID`, `SID`, `comapany_name`, `cost_1kw`, `user_capacity`) VALUES
(2, 17, 41, 'sdsad', 60, 321),
(10, 16, 40, 'tttttttt', 60, 12),
(12, 18, 42, 'sdsad', 60, 321),
(13, 19, 43, 'sdsad', 60, 321),
(14, 20, 44, 'sdsad', 60, 321),
(15, 21, 45, 'sdsad', 60, 321),
(16, 40, 46, 'Dfsgshha', 60, 548),
(17, 46, 47, 'asasasas', 60, 2222),
(18, 46, 48, 'asasasas', 60, 2222),
(19, 46, 49, 'saker ', 60, 212),
(20, 25, 50, 'liu', 60, 2313);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`id_cc`);

--
-- Indexes for table `day_value`
--
ALTER TABLE `day_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id_device`);

--
-- Indexes for table `hour_value`
--
ALTER TABLE `hour_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `month_value`
--
ALTER TABLE `month_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pass`
--
ALTER TABLE `pass`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `credit_card`
--
ALTER TABLE `credit_card`
  MODIFY `id_cc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `day_value`
--
ALTER TABLE `day_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `id_device` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hour_value`
--
ALTER TABLE `hour_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `month_value`
--
ALTER TABLE `month_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pass`
--
ALTER TABLE `pass`
  MODIFY `SID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `PID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
