-- phpMyAdmin SQL Dump
-- version 4.0.10.17
-- https://www.phpmyadmin.net
--
-- Host: studentdb-maria.gl.umbc.edu
-- Generation Time: Dec 20, 2016 at 03:52 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.4.44

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cmiller9`
--

-- --------------------------------------------------------

--
-- Table structure for table `Advisor`
--

CREATE TABLE IF NOT EXISTS `Advisor` (
  `advisorID` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL COMMENT 'active advising season toggle',
  `email` varchar(254) NOT NULL,
  `password` text NOT NULL,
  `firstName` text NOT NULL,
  `middleName` text,
  `lastName` text NOT NULL,
  `schoolID` varchar(20) NOT NULL,
  `birthCity` text NOT NULL COMMENT 'Password Reset Validation',
  `buildingName` text NOT NULL,
  `roomNumber` text NOT NULL,
  `notes` text COMMENT 'saved notes from the create.php page ',
  PRIMARY KEY (`advisorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `Advisor`
--

INSERT INTO `Advisor` (`advisorID`, `active`, `email`, `password`, `firstName`, `middleName`, `lastName`, `schoolID`, `birthCity`, `buildingName`, `roomNumber`, `notes`) VALUES
(1, 1, 'am30@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Amit', 'Kumar', 'Singh', '', '', 'ITE', '209', ';jklj;lkjl;kjl;kjlkj'),
(2, 1, 'test@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'christine', '', 'miller', '', '', 'ite', '100', NULL),
(3, 0, 'rabrew1@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Raymond', '', 'Brewer', '', '', 'ITE', '232', NULL),
(4, 0, 'amitkjadon@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Amir', '', 'SINGH', '', '', 'ITR', '123', NULL),
(5, 1, 'advisor1@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'advisor', '', 'advisor', '', '', 'aa', '123', 'eertret'),
(6, 0, 'testing@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'John', '', 'Doe', '', '', 'AAA', '000', NULL),
(7, 0, 'dcuocci11@umbc.edu', 'e886a26b23e43ab04f5af5ea0e4ac2cb', 'Dustin', '', 'Cuocci', '', '', 'ITE', '331', NULL),
(8, 0, 'gmane@umbc.edu', 'ae2b1fca515949e5d54fb22b8ed95575', 'gucci', '', 'mane', '', '', 'Guwop', '1017', NULL),
(10, 0, 'dcuocci12@umbc.edu', 'e886a26b23e43ab04f5af5ea0e4ac2cb', 'Dustin', '', 'Cuocci', 'dcuocci12', 'Baltimore', 'ITE', '331', NULL),
(11, 0, 'sdf@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'sfd', '', 'sdf', '', '', 'sfd', '123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `AdvisorMeeting`
--

CREATE TABLE IF NOT EXISTS `AdvisorMeeting` (
  `AdvisorMeetingID` int(11) NOT NULL AUTO_INCREMENT,
  `advisorID` int(7) NOT NULL,
  `meetingID` int(7) NOT NULL,
  PRIMARY KEY (`AdvisorMeetingID`),
  KEY `advisorID` (`advisorID`),
  KEY `meetingID` (`meetingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `AdvisorMeeting`
--

INSERT INTO `AdvisorMeeting` (`AdvisorMeetingID`, `advisorID`, `meetingID`) VALUES
(78, 1, 85),
(79, 1, 86),
(80, 1, 87),
(81, 1, 88),
(82, 1, 89),
(83, 1, 90),
(84, 1, 91),
(85, 1, 92),
(86, 1, 93),
(87, 1, 94),
(88, 1, 95),
(89, 1, 96),
(90, 3, 97);

-- --------------------------------------------------------

--
-- Table structure for table `Meeting`
--

CREATE TABLE IF NOT EXISTS `Meeting` (
  `meetingID` int(11) NOT NULL AUTO_INCREMENT,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `activeApt` tinyint(1) NOT NULL COMMENT 'if 0, the session is inactive but if 1, the session is active (and shows up in the student search page)',
  `buildingName` text NOT NULL,
  `roomNumber` text NOT NULL,
  `meetingType` tinyint(1) NOT NULL COMMENT 'FALSE is individual meeting, TRUE is group meeting',
  `specialGroup` tinyint(4) DEFAULT NULL COMMENT '0 for athlete, 1 for honors college, 2 for meyerhoff',
  `sessionLeaderID` int(11) NOT NULL COMMENT 'Meeting creator''s ID',
  `numStudents` tinyint(2) NOT NULL COMMENT 'Keeps track of number of students in the meeting',
  PRIMARY KEY (`meetingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `Meeting`
--

INSERT INTO `Meeting` (`meetingID`, `start`, `end`, `activeApt`, `buildingName`, `roomNumber`, `meetingType`, `specialGroup`, `sessionLeaderID`, `numStudents`) VALUES
(85, '2016-12-19 08:30:00', '2016-12-19 09:00:00', 1, 'ITE', '209', 1, 0, 0, 1),
(86, '2016-12-26 08:30:00', '2016-12-26 09:00:00', 1, 'ITE', '209', 1, 0, 0, 1),
(87, '2017-01-02 08:30:00', '2017-01-02 09:00:00', 1, 'ITE', '209', 1, 0, 0, 1),
(88, '2017-01-09 08:30:00', '2017-01-09 09:00:00', 1, 'ITE', '209', 1, 0, 0, 1),
(89, '2016-12-20 08:30:00', '2016-12-20 09:00:00', 1, 'ITE', '234', 0, 0, 0, 0),
(90, '2016-12-27 08:30:00', '2016-12-27 09:00:00', 1, 'ITE', '234', 0, 0, 0, 0),
(91, '2017-01-03 08:30:00', '2017-01-03 09:00:00', 1, 'ITE', '234', 0, 0, 0, 0),
(92, '2017-01-10 08:30:00', '2017-01-10 09:00:00', 1, 'ITE', '234', 0, 0, 0, 0),
(93, '2016-12-21 08:30:00', '2016-12-21 09:00:00', 1, 'ITE', '209', 2, 1, 0, 0),
(94, '2016-12-28 08:30:00', '2016-12-28 09:00:00', 1, 'ITE', '209', 2, 1, 0, 0),
(95, '2017-01-04 08:30:00', '2017-01-04 09:00:00', 1, 'ITE', '209', 2, 1, 0, 0),
(96, '2017-01-11 08:30:00', '2017-01-11 09:00:00', 1, 'ITE', '209', 2, 1, 0, 0),
(97, '2016-12-21 10:30:00', '2016-12-21 11:00:00', 0, 'ITE', '206', 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questionsAndPlans`
--

CREATE TABLE IF NOT EXISTS `questionsAndPlans` (
  `questionsplansID` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `futurePlans` text NOT NULL,
  `advisingQuestions` text NOT NULL,
  PRIMARY KEY (`questionsplansID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `questionsAndPlans`
--

INSERT INTO `questionsAndPlans` (`questionsplansID`, `email`, `futurePlans`, `advisingQuestions`) VALUES
(50, 'test1@umbc.edu', 'test', 'no'),
(51, 'test2@umbc.edu', 'N/A', 'N/A'),
(52, 'test3@umbc.edu', 'tesz', 'te'),
(53, 'test4@umbc.edu', 'N/A', 'N/A'),
(54, 'test5@umbc.edu', 'asdfasdf', 'asdfd'),
(55, 'greg4@umbc.edu', 'N/A', 'N/A'),
(56, 'cmiller9@umbc.edu', 'none', 'none'),
(57, 'test7@umbc.edu', 'daf', 'adsf'),
(58, 'dcuocci14@umbc.edu', 'tater', 'salad'),
(59, 'test9@umbc.edu', 'N/A', 'N/A'),
(60, 'test11@umbc.edu', 'asdf', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE IF NOT EXISTS `Student` (
  `StudentID` int(7) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `firstName` text NOT NULL,
  `preferredName` text NOT NULL,
  `lastName` text NOT NULL,
  `schoolID` varchar(30) NOT NULL,
  `major` text NOT NULL COMMENT 'Coming from a dropdown list',
  `careerTrack` varchar(18) NOT NULL,
  `birthCity` text NOT NULL COMMENT 'Password Reset Validation',
  `specialGroup` tinyint(1) DEFAULT NULL COMMENT 'int codes for special groups - 0 is Not Special, 1 is Athlete, 2 is Honors College, 3 is Meryerhoff',
  `approvedForReg` varchar(1) DEFAULT '0',
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`StudentID`, `email`, `password`, `firstName`, `preferredName`, `lastName`, `schoolID`, `major`, `careerTrack`, `birthCity`, `specialGroup`, `approvedForReg`) VALUES
(49, 'test1@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'test', '', 'test', 'te12345', 'BioInfoBS', 'Education', 't', 0, '0'),
(50, 'test2@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'test2', '', 'test', 'te23456', 'BioEdBA', 'Education', 'test', 0, '0'),
(51, 'test3@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'test3', '', 'test', 'te36457', 'BioChemBS', 'Health Profession', 'test', 0, '0'),
(52, 'test4@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'test4', '', 'test', 'te36458', 'BioInfoBS', 'Health Profession', 'test', 0, '0'),
(53, 'test5@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'test5', '', 'test', 'ab9876', 'BiologyBA', 'Uncertain', 'test', 2, '0'),
(54, 'greg4@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Greg', 'Greg', 'Hardy', 'ABC1234', 'BiologyBA', 'Health Profession', 'city', 0, '0'),
(55, 'cmiller9@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'christine', 'christie', 'miller', 'yz21656', 'BiologyBA', 'Research', 'columbia', 0, '0'),
(56, 'test7@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'test7', '', 'testing', '777abcd', 'BiologyBA', 'Health Profession', 'test', 3, '0'),
(57, 'dcuocci14@umbc.edu', 'e886a26b23e43ab04f5af5ea0e4ac2cb', 'Dustin', '', 'Cuocci', 'dcuocci14', 'BiologyBA', 'Research', 'Baltimore', 2, '0'),
(58, 'test9@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'test9', '', 'test', 'test999', 'ChemBS', 'Education', 'test', 2, '0'),
(59, 'test11@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'test11', '', 'test', 'test111', 'BioEdBA', 'Health Profession', 'test', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `StudentMeeting`
--

CREATE TABLE IF NOT EXISTS `StudentMeeting` (
  `StudentMeetingID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(7) NOT NULL,
  `MeetingID` int(7) NOT NULL,
  PRIMARY KEY (`StudentMeetingID`),
  KEY `StudentID` (`StudentID`),
  KEY `MeetingID` (`MeetingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `StudentMeeting`
--

INSERT INTO `StudentMeeting` (`StudentMeetingID`, `StudentID`, `MeetingID`) VALUES
(29, 49, 87),
(30, 52, 88),
(31, 50, 86),
(35, 55, 85);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `AdvisorMeeting`
--
ALTER TABLE `AdvisorMeeting`
  ADD CONSTRAINT `AdvisorMeeting_ibfk_1` FOREIGN KEY (`advisorID`) REFERENCES `Advisor` (`advisorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AdvisorMeeting_ibfk_2` FOREIGN KEY (`meetingID`) REFERENCES `Meeting` (`meetingID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `StudentMeeting`
--
ALTER TABLE `StudentMeeting`
  ADD CONSTRAINT `StudentMeeting_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `Student` (`StudentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `StudentMeeting_ibfk_2` FOREIGN KEY (`MeetingID`) REFERENCES `Meeting` (`meetingID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
