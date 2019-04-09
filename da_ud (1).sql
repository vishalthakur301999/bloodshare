-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2019 at 11:58 AM
-- Server version: 10.1.38-MariaDB
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
-- Database: `da_ud`
--

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `ID` int(50) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Uname` varchar(50) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `bloodgroup` varchar(2) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Locality` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Address_Type` varchar(10) NOT NULL,
  `LAT` double(13,10) NOT NULL,
  `LNG` double(13,10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`ID`, `Fname`, `Lname`, `Uname`, `pass`, `mobile`, `email`, `dob`, `bloodgroup`, `Address`, `Locality`, `City`, `Address_Type`, `LAT`, `LNG`, `timestamp`) VALUES
(13, 'Vishal', 'Thakur', 'vishal', 'qwerty', '9654474702', 'vishalthakur301999@gmail.com', '1999-10-30', 'O+', 'FARMERS APARTMENT', 'Rohini', 'Delhi', 'Home', 28.6754660000, 77.1029810000, '2019-03-27 06:24:52'),
(14, 'Samarth', 'Raj', 'qqqq', 'qwerty', '9654474702', 'vishalthakur301999@gmail.com', '2019-04-08', 'A+', 'E-205, E-Block, Vellore Institute of Technology', 'VELLORE', 'VELLORE', 'Home', 28.6902770000, 77.1048690000, '2019-04-07 10:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `reciever`
--

CREATE TABLE `reciever` (
  `ID` int(50) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Uname` varchar(50) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `bloodgroup` varchar(2) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Locality` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Address_Type` varchar(10) NOT NULL,
  `LAT` double(13,10) NOT NULL,
  `LNG` double(13,10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reciever`
--

INSERT INTO `reciever` (`ID`, `Fname`, `Lname`, `Uname`, `pass`, `mobile`, `email`, `dob`, `bloodgroup`, `Address`, `Locality`, `City`, `Address_Type`, `LAT`, `LNG`, `timestamp`) VALUES
(14, 'Patel', 'Chir', 'chir', 'chir', '8200394603', 'patelchir@gmail.com', '1999-02-23', 'A+', 'L-21, Netaji Subhash Chandra Bose Block, Vellore I', 'Katpadi', 'Vellore', 'Home', 28.7118800000, 77.1113920000, '2019-03-27 06:25:21'),
(15, 'Arpan', 'Luhadiya', 'arpan', 'qwerty', '9999888899', '17BIT0171.2017@vit.ac.in', '2019-03-24', 'A-', 'N-536, VIT', 'Vijaynagar', 'Jaipur', 'Home', 28.7039420000, 77.0402450000, '2019-03-27 06:25:21'),
(16, 'Akanksha', 'Kumari', 'ak', 'qwerty', '7486801157', 'vishalthakur301999@gmail.com', '2018-08-09', 'A+', 'E102, Sarthak Sankalp Flats, Gandhinagar Bypass Rd', 'Kudasan', 'Kudasan', 'Home', 28.6881390000, 77.1125940000, '2019-04-09 04:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `recieverdata`
--

CREATE TABLE `recieverdata` (
  `rdataid` int(50) NOT NULL,
  `rid` int(50) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `desorspc` varchar(200) NOT NULL,
  `bquantity` varchar(50) NOT NULL,
  `filled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recieverdata`
--

INSERT INTO `recieverdata` (`rdataid`, `rid`, `reason`, `desorspc`, `bquantity`, `filled`) VALUES
(4, 15, '', 'Accident', '2 units', 1),
(5, 16, 'Road Accident', 'Accident', '2 Units', 1),
(6, 14, '3rd week of dengue need platelets', 'Mild dengue', '1 unit', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(50) NOT NULL,
  `requesteruname` varchar(50) NOT NULL,
  `requesteduname` varchar(50) NOT NULL,
  `dateofreq` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accept` tinyint(1) NOT NULL DEFAULT '0',
  `acceptedby` varchar(50) DEFAULT NULL,
  `reject` tinyint(1) NOT NULL DEFAULT '0',
  `rejectedby` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `requesteruname`, `requesteduname`, `dateofreq`, `accept`, `acceptedby`, `reject`, `rejectedby`) VALUES
(10, 'vishal', 'arpan', '2019-03-28 10:28:45', 1, 'arpan', 0, NULL),
(14, 'arpan', 'vishal', '2019-04-09 04:09:41', 0, NULL, 1, 'arpan'),
(15, 'vishal', 'ak', '2019-04-09 07:15:09', 0, NULL, 1, 'vishal'),
(16, 'arpan', 'vishal', '2019-04-09 07:23:35', 1, 'vishal', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `ID` int(11) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `Username` varchar(25) DEFAULT NULL,
  `Pass` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Uname` (`Uname`);

--
-- Indexes for table `reciever`
--
ALTER TABLE `reciever`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Uname` (`Uname`);

--
-- Indexes for table `recieverdata`
--
ALTER TABLE `recieverdata`
  ADD PRIMARY KEY (`rdataid`),
  ADD UNIQUE KEY `rid_2` (`rid`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reciever`
--
ALTER TABLE `reciever`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `recieverdata`
--
ALTER TABLE `recieverdata`
  MODIFY `rdataid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recieverdata`
--
ALTER TABLE `recieverdata`
  ADD CONSTRAINT `recieverdata_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `reciever` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
