-- phpMyAdmin SQL Dump
-- version 4.0.10.17
-- https://www.phpmyadmin.net
--
-- Host: studentdb-maria.gl.umbc.edu
-- Generation Time: Dec 19, 2016 at 01:49 AM
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
  `buildingName` text NOT NULL,
  `roomNumber` text NOT NULL,
  PRIMARY KEY (`advisorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Advisor`
--

INSERT INTO `Advisor` (`advisorID`, `active`, `email`, `password`, `firstName`, `middleName`, `lastName`, `buildingName`, `roomNumber`) VALUES
(1, 0, 'am30@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Amit', 'Kumar', 'Singh', 'ITE', '209'),
(2, 1, 'test@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'christine', '', 'miller', 'ite', '100'),
(3, 0, 'rabrew1@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Raymond', '', 'Brewer', 'ITE', '232'),
(4, 0, 'amitkjadon@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Amir', '', 'SINGH', 'ITR', '123'),
(5, 0, 'advisor1@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'advisor', '', 'advisor', 'aa', '123'),
(6, 0, 'testing@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'John', '', 'Doe', 'AAA', '000'),
(7, 0, 'dcuocci11@umbc.edu', 'e886a26b23e43ab04f5af5ea0e4ac2cb', 'Dustin', '', 'Cuocci', 'ITE', '331');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `AdvisorMeeting`
--

INSERT INTO `AdvisorMeeting` (`AdvisorMeetingID`, `advisorID`, `meetingID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(19, 1, 24),
(28, 1, 33),
(31, 1, 36),
(32, 1, 37),
(36, 1, 43),
(37, 1, 44),
(39, 4, 46),
(40, 4, 47),
(41, 4, 48),
(45, 5, 52),
(46, 1, 53),
(47, 1, 54),
(48, 1, 55);

-- --------------------------------------------------------

--
-- Table structure for table `Meeting`
--

CREATE TABLE IF NOT EXISTS `Meeting` (
  `meetingID` int(11) NOT NULL AUTO_INCREMENT,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `buildingName` text NOT NULL,
  `roomNumber` text NOT NULL,
  `meetingType` tinyint(1) NOT NULL COMMENT 'FALSE is individual meeting, TRUE is group meeting',
  `meyerhoffMeeting` tinyint(1) DEFAULT NULL,
  `athleteMeeting` tinyint(1) DEFAULT NULL,
  `honorsMeeting` tinyint(1) DEFAULT NULL,
  `sessionLeaderID` int(11) NOT NULL COMMENT 'Meeting creator''s ID',
  `numStudents` tinyint(2) NOT NULL COMMENT 'Keeps track of number of students in the meeting',
  PRIMARY KEY (`meetingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `Meeting`
--

INSERT INTO `Meeting` (`meetingID`, `start`, `end`, `buildingName`, `roomNumber`, `meetingType`, `meyerhoffMeeting`, `athleteMeeting`, `honorsMeeting`, `sessionLeaderID`, `numStudents`) VALUES
(1, '2016-12-12 08:30:00', '2016-12-12 09:00:00', 'ITE', '900', 0, NULL, NULL, NULL, 1, 1),
(2, '2016-12-13 08:30:00', '2016-12-13 09:00:00', 'ITE', '900', 0, NULL, NULL, NULL, 1, 1),
(3, '2016-12-17 08:30:00', '2016-12-17 09:00:00', 'ITE', '900', 1, NULL, NULL, NULL, 1, 11),
(4, '2016-12-18 08:30:00', '2016-12-18 09:00:00', 'ITE', '209', 1, NULL, NULL, NULL, 1, 0),
(5, '2016-12-16 08:30:00', '2016-12-16 09:00:00', 'ITE', '209', 0, NULL, NULL, NULL, 1, 0),
(6, '2016-12-12 09:00:00', '2016-12-12 09:30:00', 'ITE', '209', 0, NULL, NULL, NULL, 1, 1),
(7, '2016-12-13 09:00:00', '2016-12-13 09:30:00', 'PUP', '290', 0, NULL, NULL, NULL, 1, 0),
(8, '2016-12-14 09:00:00', '2016-12-14 09:30:00', 'ABC', '209', 0, NULL, NULL, NULL, 1, 1),
(9, '2016-12-15 09:00:00', '2016-12-15 09:30:00', 'ABC', '123', 1, NULL, NULL, NULL, 1, 0),
(10, '2016-12-16 09:00:00', '2016-12-16 09:30:00', 'ABC', '321', 1, NULL, NULL, NULL, 1, 0),
(14, '2016-12-20 08:30:00', '2016-12-20 09:00:00', 'BBB', '222', 2, NULL, NULL, NULL, 0, 0),
(15, '2016-12-19 10:00:00', '2016-12-19 10:30:00', 'BAA', '123', 2, NULL, NULL, NULL, 0, 0),
(16, '2016-12-19 09:00:00', '2016-12-19 09:30:00', 'ABC', '123', 1, NULL, NULL, NULL, 0, 0),
(17, '2016-12-20 10:00:00', '2016-12-20 10:30:00', 'ABC', '123', 2, NULL, NULL, NULL, 0, 0),
(24, '2017-01-03 08:30:00', '2017-01-03 09:00:00', 'DDD', '123', 2, NULL, NULL, NULL, 0, 0),
(33, '2017-01-03 10:30:00', '2017-01-03 11:00:00', 'ZOO', '987', 2, NULL, NULL, 1, 0, 0),
(36, '2016-12-30 08:30:00', '2016-12-30 09:00:00', 'ABC', '123', 0, NULL, NULL, NULL, 0, 0),
(37, '2017-01-06 08:30:00', '2017-01-06 09:00:00', 'ABC', '123', 0, NULL, NULL, NULL, 0, 0),
(43, '2016-12-19 08:30:00', '2016-12-19 09:00:00', '0', '123', 0, NULL, NULL, NULL, 0, 0),
(44, '2016-12-26 08:30:00', '2016-12-26 09:00:00', 'HOL', '123', 0, NULL, NULL, NULL, 0, 0),
(46, '2017-01-16 10:00:00', '2017-01-16 10:30:00', 'ITE', '209', 2, NULL, 1, NULL, 0, 0),
(47, '2017-01-23 10:00:00', '2017-01-23 10:30:00', 'ITE', '209', 2, NULL, 1, NULL, 0, 0),
(48, '2017-01-30 10:00:00', '2017-01-30 10:30:00', 'ITE', '209', 2, NULL, 1, NULL, 0, 0),
(52, '2016-12-20 12:30:00', '2016-12-20 13:00:00', '0', '110', 2, NULL, 1, NULL, 0, 0),
(53, '0000-00-00 00:00:00', '2016-12-20 09:00:00', 'ITE', '222', 2, 1, NULL, NULL, 0, 0),
(54, '0000-00-00 00:00:00', '2016-12-27 09:00:00', 'ITE', '222', 2, 1, NULL, NULL, 0, 0),
(55, '2017-01-03 08:30:00', '2017-01-03 09:00:00', 'ITE', '222', 2, 1, NULL, NULL, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `questionsAndPlans`
--

INSERT INTO `questionsAndPlans` (`questionsplansID`, `email`, `futurePlans`, `advisingQuestions`) VALUES
(4, 'jharbaugh1@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(6, 'test_a@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(7, 'cmiller9@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(8, 'dcuocci44@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(9, 'testt@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(10, 'test_1@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(12, 'test_2@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(13, 'test_3@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(14, 'test_4@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(15, 'test_5@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(16, 'test_6@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(17, 'test_7@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(18, 'test_8@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(19, 'test_9@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(20, 'test_10@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(21, 'test_11@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(22, 'test_12@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(23, 'test_13@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(24, 'test_14@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(25, 'test_15@umbc.edu', 'This is a test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn', 'This is another test to see how well this shit formats the table. I thisadfsadfsad;jfnsadl;fkn'),
(27, 'rabrew1@umbc.edu', 'Research Career', 'None'),
(31, 'dcuocci1@umbc.edu', 'tater', 'salad'),
(42, 'dcuocci11@umbc.edu', 'tater', 'salad');

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
  `schoolID` varchar(20) NOT NULL,
  `major` text NOT NULL COMMENT 'Coming from a dropdown list',
  `meyerhoff` tinyint(1) DEFAULT NULL,
  `honors` tinyint(1) DEFAULT NULL,
  `athlete` tinyint(1) DEFAULT NULL,
  `careerTrack` varchar(18) NOT NULL,
  `birthCity` text NOT NULL COMMENT 'Password Reset Validation',
  `specialGroup` tinyint(1) NOT NULL COMMENT 'Boolean for special group membership',
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`StudentID`, `email`, `password`, `firstName`, `preferredName`, `lastName`, `schoolID`, `major`, `meyerhoff`, `honors`, `athlete`, `careerTrack`, `birthCity`, `specialGroup`) VALUES
(1, 'test_1@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'This', 'IsA', 'Test', 'AB12345', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(2, 'test_2@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Lloyd', '', 'Banks', 'GU12345', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(3, 'test_3@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Timmys', '', 'Dad', 'AA12345', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(4, 'test_4@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Timmys', '', 'Mom', 'HU12345', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(5, 'test_5@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Selina', '', 'Kyle', 'HA12345', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(6, 'test_6@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'OutOf', '', 'Names', 'PO12345', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(7, 'test_7@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Amit', '', 'Singh', 'OI09876', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(8, 'test_8@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Hercules', '', 'Something', 'AE12345', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(9, 'test_9@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Holy', '', 'Fuck', 'AB12345', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(10, 'test_10@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'ThereMustBe', '', 'ABetterWayToTestThis', 'PO12345', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(11, 'test_11@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Kanye', '', 'West', 'BO13579', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(12, 'test_12@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Gucci', '', 'Mane', 'AB12345', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(13, 'test_13@umbc.edu', 'e2a1715ac00b5e872a2191fb13f69a69', 'IThinkWeNeedToCheckIf', '', 'TheSchoolIDAlreadyExistsToo', 'GH12349', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(14, 'test_14@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Yung', '', 'Joc', 'HH12345', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(15, 'test_15@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'ThisShouldBe', '', 'MyLastTestAccount', 'FH12345', 'Bioeducation', NULL, NULL, NULL, '', '', 0),
(21, 'test_a@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'test', '', 'account', '123test', 'Chemistry', NULL, NULL, NULL, 'Industry', '', 0),
(22, 'cmiller9@umbc.edu', 'ae2b1fca515949e5d54fb22b8ed95575', 'christie', '', 'miller', 'ab31123', 'Biochemistry', NULL, NULL, NULL, 'Research', '', 0),
(24, 'testt@umbc.edu', '098f6bcd4621d373cade4e832627b4f6', 'test', 'name', 'case', 'test123', 'Biochemistry', NULL, NULL, NULL, 'Health Profession', '', 0),
(26, 'rabrew1@umbc.edu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Raymond', 'Raymond', 'Brewer', 'AAAAAAA', 'Biochemistry', NULL, NULL, NULL, 'Research', '', 0),
(30, 'dcuocci1@umbc.edu', 'e886a26b23e43ab04f5af5ea0e4ac2cb', 'Dustin', '', 'Cuocci', 'dcuocci1', 'ChemBA', NULL, NULL, NULL, 'Health Profession', 'Baltimore', 0),
(41, 'dcuocci11@umbc.edu', 'e886a26b23e43ab04f5af5ea0e4ac2cb', 'Dustin', '', 'Cuocci', 'dcuocci11', 'BiologyBA', NULL, NULL, NULL, 'Research', 'Baltimore', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `StudentMeeting`
--

INSERT INTO `StudentMeeting` (`StudentMeetingID`, `StudentID`, `MeetingID`) VALUES
(1, 1, 8),
(2, 2, 2),
(3, 3, 6),
(4, 4, 4),
(5, 5, 3),
(6, 6, 3),
(7, 7, 3),
(8, 8, 4),
(9, 9, 3),
(10, 10, 4),
(11, 11, 3),
(12, 12, 3),
(13, 14, 3),
(14, 15, 3),
(15, 24, 1);

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
