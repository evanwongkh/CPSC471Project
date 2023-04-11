-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 11, 2023 at 04:10 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movietheatre`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `AccID` int NOT NULL,
  `card_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expiration` varchar(255) NOT NULL,
  `cvv` varchar(255) NOT NULL,
  PRIMARY KEY (`AccID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`AccID`, `card_number`, `expiration`, `cvv`) VALUES
(2, '1234123412341234', '12/12', '123'),
(5, '1234123412341234', '12/12', '123');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE IF NOT EXISTS `discount` (
  `DiscountID` int NOT NULL AUTO_INCREMENT,
  `AccID` int NOT NULL,
  `DiscountName` varchar(255) NOT NULL,
  `DiscountPercentage` varchar(50) NOT NULL,
  PRIMARY KEY (`DiscountID`),
  KEY `AccID` (`AccID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`DiscountID`, `AccID`, `DiscountName`, `DiscountPercentage`) VALUES
(1, 2, 'Buy One General Admission and Get a 2nd General Admission Free', 'N/A'),
(2, 2, 'Buy One Get One 50% Off', '50%');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE IF NOT EXISTS `food` (
  `OrderNumber` int NOT NULL AUTO_INCREMENT,
  `AccID` int NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` varchar(50) NOT NULL,
  PRIMARY KEY (`OrderNumber`),
  KEY `AccID` (`AccID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`OrderNumber`, `AccID`, `Name`, `Price`) VALUES
(6, 3, 'Pizza', '10'),
(5, 3, 'Burger', '10'),
(7, 3, 'Pizza', '10'),
(8, 3, 'Burger', '10'),
(20, 2, 'Soda', '10'),
(12, 2, 'Popcorn', '14'),
(19, 2, 'Nachos', '7'),
(18, 2, 'Hot Dog', '5');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `MovieID` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  PRIMARY KEY (`MovieID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`MovieID`, `Title`) VALUES
(1, 'The Super Mario Bros. Movie'),
(2, 'Dungeons & Dragons: Honor Among Thieves'),
(3, 'John Wick: Chapter 4'),
(4, 'AIR'),
(5, 'Fast X');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

DROP TABLE IF EXISTS `promotion`;
CREATE TABLE IF NOT EXISTS `promotion` (
  `ReccID` int NOT NULL AUTO_INCREMENT,
  `Recommendation` varchar(255) NOT NULL,
  PRIMARY KEY (`ReccID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`ReccID`, `Recommendation`) VALUES
(1, 'The Super Mario Bros. Movie');

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

DROP TABLE IF EXISTS `showtimes`;
CREATE TABLE IF NOT EXISTS `showtimes` (
  `showtimeNo` int NOT NULL AUTO_INCREMENT,
  `theatreNo` int DEFAULT NULL,
  `time` varchar(50) NOT NULL,
  PRIMARY KEY (`showtimeNo`),
  KEY `theatreNo` (`theatreNo`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`showtimeNo`, `theatreNo`, `time`) VALUES
(1, 1, '12:00PM'),
(2, 1, '3:00PM'),
(3, 1, '6:00PM'),
(4, 1, '9:00PM'),
(5, 2, '12:00PM'),
(6, 2, '3:00PM'),
(7, 2, '6:00PM'),
(8, 2, '9:00PM'),
(9, 3, '12:00PM'),
(10, 3, '3:00PM'),
(11, 3, '6:00PM'),
(12, 3, '9:00PM'),
(13, 4, '12:00PM'),
(14, 4, '3:00PM'),
(15, 4, '6:00PM'),
(16, 4, '9:00PM'),
(17, 5, '12:00PM'),
(18, 5, '3:00PM'),
(19, 5, '6:00PM'),
(20, 5, '9:00PM'),
(21, 6, '12:00PM'),
(22, 6, '3:00PM'),
(23, 6, '6:00PM'),
(24, 6, '9:00PM'),
(25, 7, '12:00PM'),
(26, 7, '3:00PM'),
(27, 7, '6:00PM'),
(28, 7, '9:00PM'),
(29, 8, '12:00PM'),
(30, 8, '3:00PM'),
(31, 8, '6:00PM'),
(32, 8, '9:00PM'),
(33, 9, '12:00PM'),
(34, 9, '3:00PM'),
(35, 9, '6:00PM'),
(36, 9, '9:00PM'),
(37, 10, '12:00PM'),
(38, 10, '3:00PM'),
(39, 10, '6:00PM'),
(40, 10, '9:00PM');

-- --------------------------------------------------------

--
-- Table structure for table `theatre`
--

DROP TABLE IF EXISTS `theatre`;
CREATE TABLE IF NOT EXISTS `theatre` (
  `theatreNo` int NOT NULL AUTO_INCREMENT,
  `MovieID` int DEFAULT NULL,
  PRIMARY KEY (`theatreNo`),
  KEY `MovieID` (`MovieID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `theatre`
--

INSERT INTO `theatre` (`theatreNo`, `MovieID`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 3),
(7, 4),
(8, 4),
(9, 5),
(10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `ticket_id` int NOT NULL AUTO_INCREMENT,
  `AccID` int NOT NULL,
  `showtimeNo` int NOT NULL,
  `movieTitle` varchar(255) NOT NULL,
  `seat` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`ticket_id`,`AccID`),
  KEY `AccID` (`AccID`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `AccID`, `showtimeNo`, `movieTitle`, `seat`, `time`) VALUES
(46, 2, 1, 'The Super Mario Bros. Movie', 'A1', '12:00PM');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `AccID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `DOB` varchar(10) NOT NULL,
  `age` int NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`AccID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`AccID`, `username`, `password`, `Fname`, `Lname`, `DOB`, `age`, `admin`) VALUES
(1, 'admin', 'admin', 'evan', 'tony', 'johnny', 0, 1),
(2, 'nave', '$2y$10$6FptFabdBqxSjgb7Di159ODbQCWefLfKgys.7wszqMPPtK/FmwASK', 'evan', 'wong', '2002-07-31', 0, 1),
(3, 'test', '$2y$10$ILRjy0TNCX3SnrolO5AL2u/IFX1uqquPUnFL5VF9NvYtSlJbph8oi', 'test', 'test', '09/04/2023', 0, 0),
(4, 'admin2', '$2y$10$CUbt1oPy943DlpmvGZkthuUWrjSO0lVAMmuAj4yBv4X2TQPRj0Q.K', 'me', 'best', '2023-04-09', 0, 0),
(5, 'test2', '$2y$10$f5qQC4doIY553grSo9qHyelv5K/aIQNaioXPeLxse1HXur/s8tHni', 'test2', 'test2', '2004-06-05', 18, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
