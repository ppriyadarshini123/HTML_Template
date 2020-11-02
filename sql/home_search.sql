-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2020 at 11:08 AM
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
  `uID` int(3) UNSIGNED NOT NULL,
  `price` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`hID`, `rsID`, `housenumber`, `streetname`, `city`, `postcode`, `details`, `image`, `floorplan`, `uID`, `price`) VALUES
(1, 1, 45, 'Osier Way', 'London', 'CB15DE', 'Details to fill in', 'image URL', 'floor plan URL', 1, 455),
(2, 2, 4, 'Gherkin Wa', 'Birmingham', 'CB229DY', 'Details to fill in', 'image URL', 'floor plan URL', 7, 300),
(3, 1, 5, 'Amiye Way', 'London', 'CB72GH', 'Details to fill in', 'image URL', 'floor plan URL', 4, 290),
(4, 2, 33, 'Nostalgia ', 'Birmingham', 'CB8FD6', 'Details to fill in', 'image URL', 'floor plan URL', 6, 415),
(5, 1, 76, 'Harring Cl', 'London', 'CB76FD', 'Details to fill in', 'image URL', 'floor plan URL', 5, 500),
(6, 2, 94, 'Nearly Gat', 'Birmingham', 'CB13SD', 'Details to fill in', 'image URL', 'floor plan URL', 3, 700),
(7, 1, 2, 'Skegness C', 'London', 'CB58FG', 'Details to fill in', 'image URL', 'floor plan URL', 2, 200);

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
  `hID` int(3) UNSIGNED DEFAULT NULL,
  `phone` bigint(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uID`, `rID`, `email`, `pwd`, `uName`, `hID`, `phone`) VALUES
(1, 1, 'p@p.com', 'admin', 'admin', NULL, 123),
(2, 2, 'p@p.com', 'pd', 'property d', 1, 123),
(3, 3, 'p@p.com', 'cust', 'cust1', 1, 123),
(4, 2, 'p@p.com', 'pd', 'property d', 2, 123),
(5, 3, 'p@p.com', 'cust', 'cust2', 2, 123),
(6, 3, 'p@p.com', 'cust', 'cust3', 1, 123),
(7, 2, 'p@p.com', 'pd', 'property d', 3, 123);

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
  ADD KEY `hID` (`hID`);

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
  ADD CONSTRAINT `house_ibfk_1` FOREIGN KEY (`rsID`) REFERENCES `rentsale` (`rsID`),
  ADD CONSTRAINT `house_ibfk_2` FOREIGN KEY (`uID`) REFERENCES `user` (`uID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`rID`) REFERENCES `userroles` (`urID`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`hID`) REFERENCES `house` (`hID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*Select houses*/
 SELECT `house`.`hID`, `rentsale`.`rsRentSale`, `house`.`city`, `house`.`postcode`, `house`.`price`, `house`.`streetname`,
    `house`.`details`, `house`.`image`, `house`.`floorplan`, `house`.`housenumber`
FROM `house` , `rentsale`
LEFT JOIN `house` ON `rentsale`.`rsID` = `house`.`rsID`  AND `house`.`rsID` = `rentsale`.`rsID` 
Where `house`.`rsID` = '$key' OR `house`.`postcode` = '$key' OR `house`.`price` = '$key' 