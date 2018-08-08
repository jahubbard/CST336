-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 08, 2018 at 03:23 AM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `channel_islands`
--

-- --------------------------------------------------------

--
-- Table structure for table `aircraft`
--

CREATE TABLE `aircraft` (
  `aircraft_id` char(7) NOT NULL,
  `aircraft_type` char(35) DEFAULT NULL,
  `color` char(50) DEFAULT NULL,
  `aircraft_operator` char(50) DEFAULT NULL,
  `price_per_day` decimal(9,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`aircraft_id`, `aircraft_type`, `color`, `aircraft_operator`, `price_per_day`) VALUES
('N111TL', 'LNC4', 'Purple Strip', 'Sue Thompson', '250.00'),
('N135TL', 'C172', 'Blue', 'CIA', '200.00'),
('N32177', 'C310', 'White', 'Kate Johnson', '275.00'),
('N335AS', 'BE35', 'Red Stripe', 'Andy Ortega', '250.00'),
('N356ND', 'P28A', 'Yellow', 'CIA', '175.00'),
('N407HP', 'BE36', 'Orange Stripe', 'CIA', '250.00'),
('N444YZ', 'PA24', 'Brown', 'CIA', '175.00'),
('N59DL', 'BE76', 'Yellow', 'CIA', '350.00'),
('N6265A', 'BE50', 'Blue Stripe', 'Greg Ringer', '300.00'),
('N626DL', 'LGEZ', 'White', 'EAA', '200.00'),
('N626SS', 'C210', 'Brown', 'CIA', '250.00'),
('N6530C', 'BE35', 'Green', 'CIA', '250.00'),
('N65411', 'C172', 'White', 'CIA', '200.00'),
('N65872', 'C182', 'Blue Stripe', 'CIA', '280.00'),
('N6588P', 'BE58', 'White', 'CIA', '325.00'),
('N66215', 'C172', 'Blue Stripe', 'CIA', '200.00'),
('N696NS', 'C172', 'Brown', 'Kate Johnson', '175.00'),
('N724DL', 'C550', 'White', 'CIA', '950.00'),
('N85745', 'C208', 'White', 'CIA', '200.00'),
('N954VT', 'C182', 'White', 'CIA', '200.00');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `cert_type` char(35) NOT NULL,
  `required_flight_hours` int(10) DEFAULT NULL,
  `price` decimal(9,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`cert_type`, `required_flight_hours`, `price`) VALUES
('Cross Country', 100, '3000.00'),
('IFR', 200, '2000.00'),
('Multi Engine', 300, '4000.00'),
('Single Engine', 500, '1800.00');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructorid` int(10) NOT NULL,
  `firstname` char(35) DEFAULT NULL,
  `lastname` char(35) DEFAULT NULL,
  `cert_type` char(20) DEFAULT NULL,
  `address` char(50) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `locker_number` int(10) DEFAULT NULL,
  `years_of_employment` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructorid`, `firstname`, `lastname`, `cert_type`, `address`, `phone_number`, `locker_number`, `years_of_employment`) VALUES
(2001, 'Jake', 'Marcot', 'Multi Engine', '1483 Chain Bridge Rd, Ste 202', '(559)-555-8060', 1, 4),
(2002, 'Will', 'Franklin', 'Single Engine', '60 Madison Ave', '(213)-555-4322', 2, 2),
(2003, 'Kate', 'Johnson', 'Single Engine', '500 East Lorain Street', '(508)-555-6351', 4, 4),
(2004, 'Wendy', 'Dobler', 'Cross Country', '415 E Olive Ave', '(612)-555-0057', 5, 1),
(2005, 'Gerry', 'Strickland', 'IFR', '1033 N Sycamore Ave', '(515)-555-6130', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentid` int(10) NOT NULL,
  `firstname` char(35) DEFAULT NULL,
  `lastname` char(35) DEFAULT NULL,
  `instructorid` int(10) DEFAULT NULL,
  `aircraft_id` char(7) DEFAULT NULL,
  `cert_type` char(20) DEFAULT NULL,
  `address` char(50) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `feedback` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentid`, `firstname`, `lastname`, `instructorid`, `aircraft_id`, `cert_type`, `address`, `phone_number`, `password`, `feedback`) VALUES
(1001, 'Ariel', 'Myers', 2004, 'N66215', 'Cross Country', '1990 Westwood Blvd', '(800)-555-1205', '00cafd126182e8a9e7c01bb2f0dfd00496be724f', 'No'),
(1002, 'Robin', 'Kyle', 2005, 'N66215', 'IFR', '3000 Cindel Drive', '(301)-555-8950', '00cafd126182e8a9e7c01bb2f0dfd00496be724f', 'Yes'),
(1003, 'Charles', 'Sears', 2001, 'N724DL', 'Multi Engine', '3255 Ramos Cir', '(916)-555-6670', '00cafd126182e8a9e7c01bb2f0dfd00496be724f', 'Unsure'),
(1004, 'Jeffery', 'Pearson', 2002, 'N66215', 'Single Engine', '3441 W Macarthur Blvd', '(559)-555-1551', '00cafd126182e8a9e7c01bb2f0dfd00496be724f', ''),
(1005, 'Miguel', 'Jackson', 2005, 'N59DL', 'IFR', '4669 N Fresno', '(559)-555-9375', '00cafd126182e8a9e7c01bb2f0dfd00496be724f', ''),
(1006, 'Leah', 'Green', 2003, 'N65872', 'Single Engine', '4583 E Home', '(559)-555-5106', '00cafd126182e8a9e7c01bb2f0dfd00496be724f', ''),
(1007, 'Lynda', 'Johnson', 2003, 'N66215', 'Single Engine', '4420 N. First Street, Suite 108', '(559)-555-9999', '00cafd126182e8a9e7c01bb2f0dfd00496be724f', ''),
(1008, 'Zickafoos', 'Grenda', 2002, 'N65872', 'Single Engine', '1528 N Sierra Vista', '(214)-555-3647', '00cafd126182e8a9e7c01bb2f0dfd00496be724f', ''),
(1009, 'Darkenwald', 'Anthony', 2002, 'N696NS', 'Single Engine', '27371 Valderas', '(559)-555-3005', '00cafd126182e8a9e7c01bb2f0dfd00496be724f', ''),
(1010, 'Curry', 'Sarah', 2001, 'N59DL', 'Multi Engine', '1952 \"H\" Street', '(559)-555-7473', '00cafd126182e8a9e7c01bb2f0dfd00496be724f', ''),
(1111, 'Admin', 'Admin', NULL, NULL, NULL, NULL, NULL, 'e5e9fa1ba31ecd1ae84f75caaa474f3a663f05f4', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`aircraft_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`cert_type`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructorid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
