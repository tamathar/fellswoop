-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2012 at 04:54 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `othello`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `Player1` varchar(11) NOT NULL,
  `Player2` varchar(11) NOT NULL,
  `turn` int(11) NOT NULL DEFAULT '0',
  `pieces` varchar(64) NOT NULL DEFAULT '---------------------------WB------BW---------------------------',
  `finished` int(11) NOT NULL DEFAULT '0',
  `gameId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`gameId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`Player1`, `Player2`, `turn`, `pieces`, `finished`, `gameId`) VALUES
('Fake', 'Fake', 0, '---------------------------WB------BW---------------------------', 0, 32),
('Tam', 'Mat', 1, '-------------------BW------WW----BBBW-----B---------------------', 0, 33),
('Tam', 'Frank', 1, '---------------------------WB------BBB--------------------------', 0, 34),
('Tam', 'Tam', 1, '---------------------------WB------BB-------B-------------------', 0, 35);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`) VALUES
('Frank', 'password', 'frank@acu.edu'),
('Joe', 'password', 'joe@acu.edu'),
('Mat', 'password', 'mat@acu.edu'),
('Tam', 'password', 'tam@acu.edu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
