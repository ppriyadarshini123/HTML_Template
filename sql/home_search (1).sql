-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2020 at 10:17 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `home_search`
--

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `hID` int(3) UNSIGNED NOT NULL,
  `rsID` smallint(3) UNSIGNED NOT NULL,
  `housenumber` int(3) UNSIGNED NOT NULL,
  `streetname` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `floorplan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`hID`, `rsID`, `housenumber`, `streetname`, `city`, `postcode`, `details`, `image`, `floorplan`, `price`) VALUES
(1, 1, 45, 'Osier Way', 'London', 'CB15DE', '4 bedroom detached house for sale', 'aubrey-odom-ITzfgP77DTg-unsplash-432x239.png;inside1-432x239.png;inside2-432x239.png', 'floor-plan2.png', 455),
(2, 2, 4, 'Gherk Way', 'Birmingham', 'CB229DY', '2 bedroom bungalow house in good condition', 'florian-schmidinger-b_79nOqf95I-unsplash-432x239.png;inside3-432x239.png;inside4-432x239.png', 'floor-plan.jpg', 300),
(3, 1, 5, 'Amiye Way', 'London', 'CB72GH', '3 bedroom semi-detached house', 'house-432x239.png;inside5-432x239.png;inside6-432x239.png', 'floor-plan1.png', 290),
(4, 2, 33, 'Nostal Rd ', 'Birmingham', 'CB8FD6', '4 bedroom apartment in good condition', 'phil-hearing-IYfp2Ixe9nM-unsplash-432x239.png;houseinsideview2-432x239.png;house-insideview-432x239.png', 'floor-plan2.png', 415),
(5, 1, 76, 'Hary Close', 'London', 'CB76FD', 'Majestic house - 3 bedroom and a big garden ', 'scott-webb-1ddol8rgUH8-unsplash-432x239.png;inside7-432x239.png;inside8-432x239.png', 'floor-plan.jpg', 500),
(6, 2, 94, 'Near Gate', 'Birmingham', 'CB13SD', 'Large Bungalow with 2 balconies', 'sieuwert-otterloo-aren8nutd1Q-unsplash-432x239.png;inside10-432x239.png;inside9-432x239.png', 'floor-plan1.png', 700),
(7, 1, 2, 'Skeg close', 'London', 'CB58FG', '3 storeys large house for first time buyers', 'todd-kent-178j8tJrNlc-unsplash-432x239.png;inside4-432x239.png;inside6-432x239.png', 'floor-plan2.png', 200);

-- --------------------------------------------------------

--
-- Table structure for table `houseuser`
--

CREATE TABLE `houseuser` (
  `hID` int(3) UNSIGNED DEFAULT NULL,
  `uID` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `houseuser`
--

INSERT INTO `houseuser` (`hID`, `uID`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `rentsale`
--

CREATE TABLE `rentsale` (
  `rsID` smallint(3) UNSIGNED NOT NULL,
  `rsRentSale` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rentsale`
--

INSERT INTO `rentsale` (`rsID`, `rsRentSale`) VALUES
(1, 'Rent'),
(2, 'Sale');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uID` int(3) UNSIGNED NOT NULL,
  `rID` smallint(3) UNSIGNED NOT NULL,
  `email` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwd` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `uName` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` bigint(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uID`, `rID`, `email`, `pwd`, `uName`, `phone`) VALUES
(1, 1, 'p@p.com', 'admin', 'admin', 123),
(2, 2, 'p@p.com', 'pd', 'malcolms', 123),
(3, 3, 'p@p.com', 'cust', 'cust1', 123),
(4, 2, 'p@p.com', 'pd', 'Sharmann', 123),
(5, 3, 'p@p.com', 'cust', 'cust2', 123),
(6, 3, 'p@p.com', 'cust', 'cust3', 123),
(7, 2, 'p@p.com', 'pd', 'WHBrown', 123);

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `urID` smallint(3) UNSIGNED NOT NULL,
  `urRole` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`urID`, `urRole`) VALUES
(1, 'Admin'),
(2, 'Property Dealer'),
(3, 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`hID`),
  ADD KEY `rsID` (`rsID`),
  ADD KEY `hID` (`hID`);

--
-- Indexes for table `houseuser`
--
ALTER TABLE `houseuser`
  ADD KEY `hID` (`hID`),
  ADD KEY `uID` (`uID`);

--
-- Indexes for table `rentsale`
--
ALTER TABLE `rentsale`
  ADD PRIMARY KEY (`rsID`),
  ADD KEY `rsID` (`rsID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uID`),
  ADD KEY `rID` (`rID`),
  ADD KEY `uID` (`uID`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`urID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `hID` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rentsale`
--
ALTER TABLE `rentsale`
  MODIFY `rsID` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uID` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `urID` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `house`
--
ALTER TABLE `house`
  ADD CONSTRAINT `house_ibfk_1` FOREIGN KEY (`rsID`) REFERENCES `rentsale` (`rsID`);

--
-- Constraints for table `houseuser`
--
ALTER TABLE `houseuser`
  ADD CONSTRAINT `houseuser_ibfk_1` FOREIGN KEY (`hID`) REFERENCES `house` (`hID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `houseuser_ibfk_2` FOREIGN KEY (`uID`) REFERENCES `user` (`uID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`rID`) REFERENCES `userroles` (`urID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
