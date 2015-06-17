-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2014 at 04:00 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `uhitch`
--

-- --------------------------------------------------------

--
-- Table structure for table `deleted_user`
--

CREATE TABLE `deleted_user` (
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Account_Creation_Date` datetime NOT NULL,
  `Account_Termination_Date` datetime DEFAULT NULL,
  `First_Name` char(25) NOT NULL,
  `Middle_Name` char(25) DEFAULT NULL,
  `Last_Name` char(25) NOT NULL,
  `Gender` int(11) NOT NULL,
  `Email_Address` char(50) NOT NULL,
  `School_Name` char(50) NOT NULL,
  `Phone_Number` char(50) NOT NULL,
  `Address` char(100) NOT NULL,
  `City` char(20) NOT NULL,
  `State` char(15) NOT NULL,
  `Zip_Code` char(10) NOT NULL,
  `Account_Type` int(11) NOT NULL,
  `User_Name` char(20) NOT NULL,
  `Hashed_Password` char(50) NOT NULL,
  `Driver_Rating` double NOT NULL,
  `Driver_Count` int(11) NOT NULL,
  `Rider_Rating` double NOT NULL,
  `Rider_Count` int(11) NOT NULL,
  `Account_Status` int(11) NOT NULL,
  `Question` varchar(255) DEFAULT NULL,
  `Answer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `driver_feedback`
--

CREATE TABLE `driver_feedback` (
  `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ride_ID` int(11) NOT NULL,
  `Driver_ID` int(11) NOT NULL,
  `Passenger_ID` int(11) NOT NULL,
  `Ride_Rating` int(11) NOT NULL,
  `Ride_Notes` char(255) DEFAULT NULL,
  PRIMARY KEY (`Feedback_ID`),
  KEY `Driver_ID` (`Driver_ID`),
  KEY `Passenger_ID` (`Passenger_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Location` varchar(150) NOT NULL,
  `City` varchar(60) NOT NULL,
  `State` varchar(2) NOT NULL,
  `Zip` int(6) NOT NULL,
  `Lat` decimal(10,7) DEFAULT NULL,
  `Lon` decimal(10,7) DEFAULT NULL,
  `Photo` varchar(50) NOT NULL,
  `Comments` varchar(255) NOT NULL,
  `CreatedByName` varchar(75) NOT NULL,
  `CreatedById` varchar(55) NOT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EventId` varchar(45) NOT NULL,
  `Reviewed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `msgId` varchar(55) NOT NULL,
  `to_userName` varchar(100) NOT NULL,
  `to_UserId` varchar(45) NOT NULL,
  `from_userName` varchar(100) NOT NULL,
  `from_userId` varchar(45) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `sent_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `message` varchar(1000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `retrieval`
--

CREATE TABLE `retrieval` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `Value` varchar(35) NOT NULL,
  `UserEmail` varchar(50) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Expiration` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE `ride` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `Ride_ID` varchar(45) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Departs` varchar(255) NOT NULL,
  `DepartShort` varchar(50) NOT NULL,
  `Lat_Dep` decimal(10,7) NOT NULL,
  `Lon_Dep` decimal(10,7) NOT NULL,
  `DepartTime` time NOT NULL,
  `DepartDate` date NOT NULL,
  `Arrival` varchar(255) NOT NULL,
  `ArriveShort` varchar(50) NOT NULL,
  `Lat_Arr` decimal(10,7) NOT NULL,
  `Lon_Arr` decimal(10,7) NOT NULL,
  `Distance` double NOT NULL,
  `Driver_Name` varchar(100) NOT NULL,
  `Driver_ID` varchar(35) NOT NULL,
  `Passenger1_ID` varchar(35) NOT NULL,
  `Passenger2_ID` varchar(35) NOT NULL,
  `Passenger3_ID` varchar(35) NOT NULL,
  `Passenger4_ID` varchar(35) NOT NULL,
  `Passenger5_ID` varchar(35) NOT NULL,
  `Notes` varchar(255) NOT NULL,
  `Passengers` int(11) NOT NULL,
  `Price` int(5) DEFAULT '0',
  `Vehicle_ID` varchar(35) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Notified` tinyint(1) NOT NULL DEFAULT '0',
  `Status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `rider_feedback`
--

CREATE TABLE `rider_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Ride_ID` varchar(45) NOT NULL,
  `Driver_Name` varchar(100) NOT NULL,
  `DriverId` varchar(40) NOT NULL,
  `Rating` varchar(35) NOT NULL,
  `Notes` varchar(255) NOT NULL,
  `Passenger_ID` varchar(40) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(128) NOT NULL,
  `ShortName` varchar(30) NOT NULL,
  `Abbr` varchar(16) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` char(2) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `ZipCode` int(5) NOT NULL,
  `County` varchar(65) NOT NULL,
  `Timezone` varchar(5) NOT NULL DEFAULT '0',
  `Latitude` decimal(10,7) NOT NULL,
  `Longitude` decimal(10,7) NOT NULL,
  `Email` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `abbreviation` (`Abbr`),
  KEY `name` (`Name`(15)),
  KEY `state` (`State`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=397 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Full_Name` varchar(100) NOT NULL,
  `First_Name` varchar(25) NOT NULL,
  `Middle_Name` varchar(25) NOT NULL,
  `Last_Name` varchar(25) NOT NULL,
  `Month` varchar(15) NOT NULL,
  `Day` int(2) NOT NULL,
  `Year` int(4) NOT NULL,
  `Gender` varchar(7) NOT NULL,
  `Email_Address` char(50) NOT NULL,
  `School_Name` varchar(50) NOT NULL,
  `Phone_Number` varchar(10) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(3) NOT NULL,
  `Zip_Code` int(6) NOT NULL,
  `CurrentCity` varchar(20) DEFAULT NULL,
  `CurrentState` varchar(20) DEFAULT NULL,
  `Driver` text NOT NULL,
  `Salt` varchar(50) NOT NULL,
  `Hashed_Password` char(50) NOT NULL,
  `Driver_Rating` double NOT NULL,
  `Driver_Count` int(11) NOT NULL,
  `Rider_Rating` double DEFAULT NULL,
  `Rider_Count` int(11) NOT NULL DEFAULT '0',
  `Photo` varchar(255) NOT NULL DEFAULT 'assets/photos/default.png',
  `Bio` varchar(255) NOT NULL,
  `Major` varchar(100) NOT NULL,
  `Classification` varchar(25) NOT NULL,
  `Living` varchar(255) NOT NULL,
  `Activities` varchar(255) NOT NULL,
  `Sports` varchar(255) NOT NULL,
  `Music` varchar(250) NOT NULL,
  `Organizations` varchar(255) NOT NULL,
  `Greek` varchar(100) NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0',
  `Account_Status` tinyint(1) NOT NULL DEFAULT '0',
  `AccountCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastLogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UserID` varchar(35) NOT NULL,
  `User_ID` int(20) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `User_ID` (`User_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `VehicleId` varchar(65) NOT NULL,
  `OwnerName` varchar(50) NOT NULL,
  `DriverId` varchar(40) NOT NULL,
  `Make` varchar(50) NOT NULL,
  `Model` varchar(50) NOT NULL,
  `Year` varchar(4) NOT NULL,
  `Color` varchar(20) NOT NULL,
  `Notes` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driver_feedback`
--
ALTER TABLE `driver_feedback`
  ADD CONSTRAINT `driver_feedback_ibfk_1` FOREIGN KEY (`Driver_ID`) REFERENCES `user` (`User_ID`),
  ADD CONSTRAINT `driver_feedback_ibfk_2` FOREIGN KEY (`Passenger_ID`) REFERENCES `user` (`User_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
