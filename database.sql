-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2018 at 05:46 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game4fun3`
--

-- --------------------------------------------------------

--
-- Table structure for table `belong`
--

DROP TABLE IF EXISTS `belong`;
CREATE TABLE IF NOT EXISTS `belong` (
  `gameID` int(16) NOT NULL,
  `cName` char(20) NOT NULL,
  PRIMARY KEY (`gameID`,`cName`),
  KEY `cName` (`cName`),
  KEY `gameID` (`gameID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `businessuser`
--

DROP TABLE IF EXISTS `businessuser`;
CREATE TABLE IF NOT EXISTS `businessuser` (
  `userID` int(16) NOT NULL,
  `userName` char(16) NOT NULL,
  `password` char(16) NOT NULL,
  `mail` text NOT NULL,
  `notification` tinyint(1) NOT NULL,
  `officialSite` text,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cName` char(20) NOT NULL,
  PRIMARY KEY (`cName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commentary`
--

DROP TABLE IF EXISTS `commentary`;
CREATE TABLE IF NOT EXISTS `commentary` (
  `cID` int(16) NOT NULL,
  `text` text,
  `userID` int(16) NOT NULL,
  `rID` int(16) NOT NULL,
  PRIMARY KEY (`cID`),
  KEY `userID` (`userID`),
  KEY `rID` (`rID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `gameID` int(16) NOT NULL,
  `gName` char(20) NOT NULL,
  `userID` int(16) NOT NULL,
  `since` date NOT NULL,
  `gameInfo` text NOT NULL,
  PRIMARY KEY (`gameID`),
  UNIQUE KEY `gName` (`gName`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personaluser`
--

DROP TABLE IF EXISTS `personaluser`;
CREATE TABLE IF NOT EXISTS `personaluser` (
  `country` char(20) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `userName` char(20) NOT NULL,
  `password` char(30) NOT NULL,
  `mail` text NOT NULL,
  `notification` tinyint(1) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userName` (`userName`),
  CHECK (age >= 0 AND age <= 100)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `rID` int(8) NOT NULL,
  `title` char(100) NOT NULL,
  `text` text NOT NULL,
  `userID` int(11) NOT NULL,
  `gameID` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rID`),
  KEY `userID` (`userID`),
  KEY `gameID` (`gameID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thumbup`
--

DROP TABLE IF EXISTS `thumbup`;
CREATE TABLE IF NOT EXISTS `thumbup` (
  `userID` int(11) NOT NULL,
  `rID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`rID`),
  KEY `rID` (`rID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `webadmin`
--

DROP TABLE IF EXISTS `webadmin`;
CREATE TABLE IF NOT EXISTS `webadmin` (
  `userID` int(11) NOT NULL,
  `userName` char(20) NOT NULL,
  `password` char(30) NOT NULL,
  `mail` text NOT NULL,
  `notification` tinyint(1) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webadmin`
--

INSERT INTO `webadmin` (`userID`, `userName`, `password`, `mail`, `notification`) VALUES
(1, 'admin', 'admin', 'test@mail.com', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `belong`
--
ALTER TABLE `belong`
  ADD CONSTRAINT `belong_ibfk_1` FOREIGN KEY (`gameID`) REFERENCES `game` (`gameID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `belong_ibfk_2` FOREIGN KEY (`cName`) REFERENCES `category` (`cName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commentary`
--
ALTER TABLE `commentary`
  ADD CONSTRAINT `commentary_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `personaluser` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentary_ibfk_2` FOREIGN KEY (`rID`) REFERENCES `review` (`rID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `businessuser` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `personaluser` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`gameID`) REFERENCES `game` (`gameID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thumbup`
--
ALTER TABLE `thumbup`
  ADD CONSTRAINT `thumbup_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `personaluser` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thumbup_ibfk_2` FOREIGN KEY (`rID`) REFERENCES `review` (`rID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
