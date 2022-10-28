-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2022 at 10:06 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demo4u_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE IF NOT EXISTS `activity_log` (
  `ID` int(11) NOT NULL,
  `WORK_ORDER_NUMBER` varchar(50) NOT NULL,
  `COMMENT` varchar(100) NOT NULL,
  `TIME` time NOT NULL,
  `SYSTEM_TIME` datetime NOT NULL,
  `USER` varchar(50) NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`ID`, `WORK_ORDER_NUMBER`, `COMMENT`, `TIME`, `SYSTEM_TIME`, `USER`, `CREATED_AT`) VALUES
(1, 'GTW1', 'work order created', '00:00:00', '2022-10-28 19:19:05', 'Admin', '2022-10-28 19:19:05'),
(2, 'GTW1', 'work order updated', '00:00:00', '2022-10-28 19:40:49', 'Admin', '2022-10-28 19:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `SURNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `COMPANY` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `ID` int(11) NOT NULL,
  `WORK_ORDER_NUMBER` varchar(50) NOT NULL,
  `TITLE` varchar(50) NOT NULL,
  `FILE` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL,
  `ATTACHED_BY` varchar(50) NOT NULL,
  `SIGNED_BY` varchar(50) NOT NULL,
  `SIGNATURE` text NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `controller_prefix`
--

CREATE TABLE IF NOT EXISTS `controller_prefix` (
  `ID` int(11) NOT NULL,
  `PREFIX` varchar(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `controller_prefix`
--

INSERT INTO `controller_prefix` (`ID`, `PREFIX`) VALUES
(1, 'CON'),
(2, 'ACC');

-- --------------------------------------------------------

--
-- Table structure for table `controller_user`
--

CREATE TABLE IF NOT EXISTS `controller_user` (
  `ID` int(11) NOT NULL,
  `REFERENCE_NUMBER` varchar(20) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `SURNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PHONE` varchar(20) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `USER_TYPE` varchar(50) NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  `PRINT_FROM` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `controller_user`
--

INSERT INTO `controller_user` (`ID`, `REFERENCE_NUMBER`, `FIRST_NAME`, `SURNAME`, `EMAIL`, `PHONE`, `PASSWORD`, `USER_TYPE`, `CREATED_AT`, `UPDATED_AT`, `PRINT_FROM`) VALUES
(1, '', 'Admin', 'User', 'admin@test.com', '', '123456', 'admin', '2022-10-28 17:33:50', '2022-10-28 17:33:50', '2022-10-28'),
(2, 'DRV1', 'DRIVER1', 'DRIVER1', 'driver@test.com', '0123456789', '123456', 'mobile', '2022-10-28 18:56:14', '2022-10-28 18:56:14', '2022-10-28'),
(3, 'CON1', 'Controller', 'User', 'controller@test.com', '0123456789', '123456', 'controller', '2022-10-28 19:47:03', '2022-10-28 19:47:03', '2022-10-28'),
(4, 'ACC2', 'Account', 'User', 'account@test.com', '0123456789', '123456', 'account', '2022-10-28 19:49:10', '2022-10-28 19:49:10', '2022-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `customer_list`
--

CREATE TABLE IF NOT EXISTS `customer_list` (
  `ID` int(11) NOT NULL,
  `ACC_NO` varchar(255) NOT NULL,
  `COMPANY` varchar(100) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `SURNAME` varchar(50) NOT NULL,
  `PHONE` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL,
  `SUBURB` varchar(100) NOT NULL,
  `CITY` varchar(100) NOT NULL,
  `PROVINCE` varchar(100) NOT NULL,
  `COUNTRY` varchar(100) NOT NULL,
  `POSTAL_CODE` varchar(50) NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_list`
--

INSERT INTO `customer_list` (`ID`, `ACC_NO`, `COMPANY`, `FIRST_NAME`, `SURNAME`, `PHONE`, `EMAIL`, `ADDRESS`, `SUBURB`, `CITY`, `PROVINCE`, `COUNTRY`, `POSTAL_CODE`, `CREATED_AT`, `UPDATED_AT`) VALUES
(1, 'ACC001', 'COMPANY1', 'FIRSTNAME1', 'SURNAME1', '0123456789', 'client1@gmail.com', 'ADRESS1', 'SUBURB1', 'CITY1', 'PROVINCE1', 'COUNTRY1', '001', '2022-10-28 18:01:08', '0000-00-00 00:00:00'),
(2, 'ACC002', 'COMPANY2', 'FIRSTNAME2', 'SURNAME2', '0123456789', 'client2@gmail.com', 'ADRESS2', 'SUBURB2', 'CITY2', 'PROVINCE2', 'COUNTRY2', '002', '2022-10-28 18:29:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `deleted`
--

CREATE TABLE IF NOT EXISTS `deleted` (
  `ID` int(11) NOT NULL,
  `WORK_ORDER_NUMBER` varchar(50) NOT NULL,
  `TIME` datetime NOT NULL,
  `USER` varchar(50) NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `ID` int(11) NOT NULL,
  `WORK_ORDER_NUMBER` varchar(50) NOT NULL,
  `DESCRIPTION` varchar(50) NOT NULL,
  `DATE` date NOT NULL,
  `TIME` time NOT NULL,
  `SIGNED_BY` varchar(100) NOT NULL,
  `SIGNATURE` text NOT NULL,
  `DELIVERED_BY` varchar(50) NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery2`
--

CREATE TABLE IF NOT EXISTS `delivery2` (
  `ID` int(11) NOT NULL,
  `WORK_ORDER_NUMBER` varchar(50) NOT NULL,
  `DESCRIPTION` varchar(50) NOT NULL,
  `DATE` date NOT NULL,
  `TIME` time NOT NULL,
  `SIGNED_BY` varchar(100) NOT NULL,
  `SIGNATURE` text NOT NULL,
  `DELIVERED_BY` varchar(50) NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_one`
--

CREATE TABLE IF NOT EXISTS `delivery_one` (
  `ID` int(11) NOT NULL,
  `COMPANY` varchar(255) NOT NULL,
  `OFFLOAD_POINT` varchar(50) NOT NULL,
  `SUBURB` varchar(50) NOT NULL,
  `POSTAL_CODE` varchar(50) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `SURNAME` varchar(50) NOT NULL,
  `PHONE` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `CARGO_TYPE` varchar(255) NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_one`
--

INSERT INTO `delivery_one` (`ID`, `COMPANY`, `OFFLOAD_POINT`, `SUBURB`, `POSTAL_CODE`, `FIRST_NAME`, `SURNAME`, `PHONE`, `EMAIL`, `CARGO_TYPE`, `CREATED_AT`, `UPDATED_AT`) VALUES
(1, 'COMPANY1', 'OFFLOAD1', 'SUBURB1', '001', 'FIRSTNAME1', 'SURNAME1', '0123456789', 'delivery1@gmail.com', 'Bulk', '2022-10-28 18:49:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_two`
--

CREATE TABLE IF NOT EXISTS `delivery_two` (
  `ID` int(11) NOT NULL,
  `OFFLOAD_POINT` varchar(50) NOT NULL,
  `POSTAL_CODE` varchar(50) NOT NULL,
  `CUSTOMER_NAME` varchar(50) NOT NULL,
  `CONTACT_PERSON` varchar(50) NOT NULL,
  `PHONE` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gps`
--

CREATE TABLE IF NOT EXISTS `gps` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `LONGTITUDE` varchar(200) NOT NULL,
  `LATITUDE` varchar(200) NOT NULL,
  `DATE` date NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mobile_prefix`
--

CREATE TABLE IF NOT EXISTS `mobile_prefix` (
  `ID` int(11) NOT NULL,
  `PREFIX` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobile_prefix`
--

INSERT INTO `mobile_prefix` (`ID`, `PREFIX`) VALUES
(1, 'DRV');

-- --------------------------------------------------------

--
-- Table structure for table `pickup`
--

CREATE TABLE IF NOT EXISTS `pickup` (
  `ID` int(11) NOT NULL,
  `WORK_ORDER_NUMBER` varchar(50) NOT NULL,
  `PRODUCT` varchar(100) NOT NULL,
  `QUANTITY` varchar(50) NOT NULL,
  `TONNAGE` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL,
  `DATE` date NOT NULL,
  `TIME` time NOT NULL,
  `PICKED_UP_BY` varchar(50) NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pickup_point`
--

CREATE TABLE IF NOT EXISTS `pickup_point` (
  `ID` int(11) NOT NULL,
  `COMPANY` varchar(255) NOT NULL,
  `OFFLOAD_POINT` varchar(50) NOT NULL,
  `POSTAL_CODE` varchar(50) NOT NULL,
  `CUSTOMER_NAME` varchar(50) NOT NULL,
  `CONTACT_PERSON` varchar(50) NOT NULL,
  `PHONE` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `CARGO_TYPE` varchar(255) NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pickup_point`
--

INSERT INTO `pickup_point` (`ID`, `COMPANY`, `OFFLOAD_POINT`, `POSTAL_CODE`, `CUSTOMER_NAME`, `CONTACT_PERSON`, `PHONE`, `EMAIL`, `CARGO_TYPE`, `UPDATED_AT`, `CREATED_AT`) VALUES
(1, 'COMPANY1', 'PICKUP1', '001', 'CUSTOMER1', 'CONTACT1', '0123456789', 'pickup1@gmail.com', 'Bulk', '0000-00-00 00:00:00', '2022-10-28 18:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE IF NOT EXISTS `product_type` (
  `ID` int(11) NOT NULL,
  `PRODUCT_NAME` varchar(100) NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`ID`, `PRODUCT_NAME`, `CREATED_AT`) VALUES
(1, 'PAPER', '2022-10-28 19:25:46'),
(2, 'Acid', '2022-10-28 19:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `security`
--

CREATE TABLE IF NOT EXISTS `security` (
  `ID` int(11) NOT NULL,
  `DRIVER` varchar(255) NOT NULL,
  `WORK_ORDER_NUMBER` varchar(255) NOT NULL,
  `SECURITY_NAME` varchar(255) NOT NULL,
  `GATE_SIGNATURE` text NOT NULL,
  `GATE_TIME` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stops`
--

CREATE TABLE IF NOT EXISTS `stops` (
  `ID` int(11) NOT NULL,
  `WORK_ORDER_NUMBER` varchar(50) NOT NULL,
  `TITLE` varchar(50) NOT NULL,
  `DESCRIPTION` varchar(50) NOT NULL,
  `DATE` date NOT NULL,
  `TIME` time NOT NULL,
  `POSTED_BY` varchar(50) NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table1`
--

CREATE TABLE IF NOT EXISTS `table1` (
  `ID` int(11) NOT NULL,
  `PREFIX` varchar(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table1`
--

INSERT INTO `table1` (`ID`, `PREFIX`) VALUES
(1, 'GTW');

-- --------------------------------------------------------

--
-- Table structure for table `tanker`
--

CREATE TABLE IF NOT EXISTS `tanker` (
  `ID` int(11) NOT NULL,
  `VEHICLE_REG` varchar(50) NOT NULL,
  `VEHICLE_MAKE` varchar(50) NOT NULL,
  `VIN_NO` varchar(50) NOT NULL,
  `EXPIRY_DATE` date NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `REFERENCE` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tanker`
--

INSERT INTO `tanker` (`ID`, `VEHICLE_REG`, `VEHICLE_MAKE`, `VIN_NO`, `EXPIRY_DATE`, `CREATED_AT`, `UPDATED_AT`, `STATUS`, `REFERENCE`) VALUES
(1, 'ND 12345', 'VHC 001', 'VIN 001', '2023-06-23', '2022-10-28 19:07:01', '2022-10-28 19:07:01', 'out', 'GTW1');

-- --------------------------------------------------------

--
-- Table structure for table `tanker_2`
--

CREATE TABLE IF NOT EXISTS `tanker_2` (
  `ID` int(11) NOT NULL,
  `VEHICLE_REG` varchar(50) NOT NULL,
  `VEHICLE_MAKE` varchar(50) NOT NULL,
  `VIN_NO` varchar(50) NOT NULL,
  `EXPIRY_DATE` date NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `REFERENCE` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tanker_2`
--

INSERT INTO `tanker_2` (`ID`, `VEHICLE_REG`, `VEHICLE_MAKE`, `VIN_NO`, `EXPIRY_DATE`, `CREATED_AT`, `UPDATED_AT`, `STATUS`, `REFERENCE`) VALUES
(1, 'ND 12345', 'VHC 001', 'VIN 001', '2023-12-15', '2022-10-28 19:07:18', '2022-10-28 19:07:18', 'out', 'GTW1');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `ID` int(11) NOT NULL,
  `VEHICLE_REG` varchar(50) NOT NULL,
  `VEHICLE_FLEET_NO` varchar(50) NOT NULL,
  `VEHICLE_MAKE` varchar(50) NOT NULL,
  `VIN_NO` varchar(50) NOT NULL,
  `EXPIRY_DATE` date NOT NULL,
  `MODEL_YEAR` varchar(4) NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trailer`
--

CREATE TABLE IF NOT EXISTS `trailer` (
  `ID` int(11) NOT NULL,
  `VEHICLE_REG` varchar(50) NOT NULL,
  `VEHICLE_MAKE` varchar(50) NOT NULL,
  `VIN_NO` varchar(50) NOT NULL,
  `EXPIRY_DATE` date NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `REFERENCE` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trailer`
--

INSERT INTO `trailer` (`ID`, `VEHICLE_REG`, `VEHICLE_MAKE`, `VIN_NO`, `EXPIRY_DATE`, `CREATED_AT`, `UPDATED_AT`, `STATUS`, `REFERENCE`) VALUES
(1, 'ND 12345', 'VHC 001', 'VIN 001', '2023-08-18', '2022-10-28 19:06:06', '2022-10-28 19:06:06', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `trailer_2`
--

CREATE TABLE IF NOT EXISTS `trailer_2` (
  `ID` int(11) NOT NULL,
  `VEHICLE_REG` varchar(50) NOT NULL,
  `VEHICLE_MAKE` varchar(50) NOT NULL,
  `VIN_NO` varchar(50) NOT NULL,
  `EXPIRY_DATE` date NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `REFERENCE` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trailer_2`
--

INSERT INTO `trailer_2` (`ID`, `VEHICLE_REG`, `VEHICLE_MAKE`, `VIN_NO`, `EXPIRY_DATE`, `CREATED_AT`, `UPDATED_AT`, `STATUS`, `REFERENCE`) VALUES
(1, 'ND 12345', 'VHC 001', 'VIN 001', '2024-01-19', '2022-10-28 19:06:40', '2022-10-28 19:06:40', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `truck`
--

CREATE TABLE IF NOT EXISTS `truck` (
  `ID` int(11) NOT NULL,
  `VEHICLE_REG` varchar(50) NOT NULL,
  `VEHICLE_FLEET_NO` varchar(50) NOT NULL,
  `VEHICLE_MAKE` varchar(50) NOT NULL,
  `VIN_NO` varchar(50) NOT NULL,
  `EXPIRY_DATE` date NOT NULL,
  `MODEL_YEAR` varchar(20) NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `REFERENCE` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `truck`
--

INSERT INTO `truck` (`ID`, `VEHICLE_REG`, `VEHICLE_FLEET_NO`, `VEHICLE_MAKE`, `VIN_NO`, `EXPIRY_DATE`, `MODEL_YEAR`, `CREATED_AT`, `UPDATED_AT`, `STATUS`, `REFERENCE`) VALUES
(1, 'ND 12345', 'FLEET 0001', 'VHC 001', 'VIN 001', '2023-09-17', '2019', '2022-10-28 19:00:02', '2022-10-28 19:00:02', 'out', 'GTW1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL,
  `DRIVER` varchar(255) NOT NULL,
  `WORK_ORDER_NUMBER` varchar(255) NOT NULL,
  `STOPS` varchar(255) NOT NULL,
  `WO_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `work_order`
--

CREATE TABLE IF NOT EXISTS `work_order` (
  `ID` int(11) NOT NULL,
  `ATTACHMENT` varchar(100) NOT NULL,
  `WORK_ORDER_NUMBER` varchar(50) NOT NULL,
  `SHIPMENT_REFERENCE` varchar(50) NOT NULL,
  `IMPORT_REFERENCE` varchar(50) NOT NULL,
  `CONTAINER_NUMBER` varchar(255) NOT NULL,
  `BILL_CLIENT` varchar(50) NOT NULL,
  `CARGO_TYPE` varchar(255) NOT NULL,
  `PRODUCT_TYPE` varchar(50) NOT NULL,
  `QUANTITY` varchar(50) NOT NULL,
  `TONNAGE` varchar(50) NOT NULL,
  `PICKUP_POINT` varchar(50) NOT NULL,
  `PICKUP_DATE` date NOT NULL,
  `PICKUP_TIME` time NOT NULL,
  `DELIVERY_POINT_1` varchar(100) NOT NULL,
  `DELIVERY_POINT_2` varchar(100) NOT NULL,
  `TRUCK_ALLOCATION` varchar(100) NOT NULL,
  `TRAILER_ALLOCATION` varchar(100) NOT NULL,
  `TRAILER_ALLOCATION_2` varchar(100) NOT NULL,
  `TANKER_ALLOCATION` varchar(100) NOT NULL,
  `TANKER_ALLOCATION_2` varchar(100) NOT NULL,
  `VIEW` varchar(255) NOT NULL,
  `DRIVER_ASSIGNED` varchar(50) NOT NULL,
  `DRIVER_RESPONSE` varchar(255) NOT NULL,
  `REJECT_REASON` varchar(255) NOT NULL,
  `REJECTED_BY` varchar(255) NOT NULL,
  `CREATED_BY` varchar(50) NOT NULL,
  `ASSIGNED_BY` varchar(50) NOT NULL,
  `UPDATED_BY` varchar(50) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `GATE_TIME` time NOT NULL,
  `GATE_SIGNATURE` text NOT NULL,
  `SECURITY_NAME` varchar(255) NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  `PRINT_FROM` date NOT NULL,
  `DELIVERED_AT` date NOT NULL,
  `QUANTITY_1` int(11) NOT NULL,
  `QUANTITY_2` int(11) NOT NULL,
  `ACCOUNT` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order`
--

INSERT INTO `work_order` (`ID`, `ATTACHMENT`, `WORK_ORDER_NUMBER`, `SHIPMENT_REFERENCE`, `IMPORT_REFERENCE`, `CONTAINER_NUMBER`, `BILL_CLIENT`, `CARGO_TYPE`, `PRODUCT_TYPE`, `QUANTITY`, `TONNAGE`, `PICKUP_POINT`, `PICKUP_DATE`, `PICKUP_TIME`, `DELIVERY_POINT_1`, `DELIVERY_POINT_2`, `TRUCK_ALLOCATION`, `TRAILER_ALLOCATION`, `TRAILER_ALLOCATION_2`, `TANKER_ALLOCATION`, `TANKER_ALLOCATION_2`, `VIEW`, `DRIVER_ASSIGNED`, `DRIVER_RESPONSE`, `REJECT_REASON`, `REJECTED_BY`, `CREATED_BY`, `ASSIGNED_BY`, `UPDATED_BY`, `STATUS`, `GATE_TIME`, `GATE_SIGNATURE`, `SECURITY_NAME`, `CREATED_AT`, `UPDATED_AT`, `PRINT_FROM`, `DELIVERED_AT`, `QUANTITY_1`, `QUANTITY_2`, `ACCOUNT`) VALUES
(1, 'attachment/28-10-2022-1666977545logo.png', 'GTW1', '001', '123', '', 'COMPANY1', 'Bulk', 'Acid', '10000', '1000', 'CUSTOMER1, PICKUP1', '2022-10-22', '02:05:00', 'OFFLOAD1, SUBURB1', 'OFFLOAD1, SUBURB1', 'ND 12345', '', '', 'ND 12345', 'ND 12345', '', 'DRV1', '', '', '', 'Admin', '', 'Admin', 'created', '00:00:00', '', '', '2022-10-28 19:19:05', '2022-10-28 19:40:49', '2022-10-28', '0000-00-00', 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `controller_prefix`
--
ALTER TABLE `controller_prefix`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `controller_user`
--
ALTER TABLE `controller_user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer_list`
--
ALTER TABLE `customer_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `deleted`
--
ALTER TABLE `deleted`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `delivery2`
--
ALTER TABLE `delivery2`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `delivery_one`
--
ALTER TABLE `delivery_one`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `delivery_two`
--
ALTER TABLE `delivery_two`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gps`
--
ALTER TABLE `gps`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mobile_prefix`
--
ALTER TABLE `mobile_prefix`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pickup`
--
ALTER TABLE `pickup`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pickup_point`
--
ALTER TABLE `pickup_point`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `security`
--
ALTER TABLE `security`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stops`
--
ALTER TABLE `stops`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table1`
--
ALTER TABLE `table1`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tanker`
--
ALTER TABLE `tanker`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tanker_2`
--
ALTER TABLE `tanker_2`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `trailer`
--
ALTER TABLE `trailer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `trailer_2`
--
ALTER TABLE `trailer_2`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `truck`
--
ALTER TABLE `truck`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `work_order`
--
ALTER TABLE `work_order`
  ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `WORK_ORDER_NUMBER` (`WORK_ORDER_NUMBER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `controller_prefix`
--
ALTER TABLE `controller_prefix`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `controller_user`
--
ALTER TABLE `controller_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customer_list`
--
ALTER TABLE `customer_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `deleted`
--
ALTER TABLE `deleted`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery2`
--
ALTER TABLE `delivery2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery_one`
--
ALTER TABLE `delivery_one`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `delivery_two`
--
ALTER TABLE `delivery_two`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gps`
--
ALTER TABLE `gps`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mobile_prefix`
--
ALTER TABLE `mobile_prefix`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pickup`
--
ALTER TABLE `pickup`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pickup_point`
--
ALTER TABLE `pickup_point`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `security`
--
ALTER TABLE `security`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stops`
--
ALTER TABLE `stops`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table1`
--
ALTER TABLE `table1`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tanker`
--
ALTER TABLE `tanker`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tanker_2`
--
ALTER TABLE `tanker_2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trailer`
--
ALTER TABLE `trailer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `trailer_2`
--
ALTER TABLE `trailer_2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `truck`
--
ALTER TABLE `truck`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_order`
--
ALTER TABLE `work_order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
