-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 23, 2021 at 11:34 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs230`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `pid` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `descript` text NOT NULL,
  `picpath` varchar(80) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`pid`, `title`, `descript`, `picpath`, `upload_date`, `rating`) VALUES
(4, 'test1', 'test1', '../gallery/604ae8d584bf83.10680421.jpg', '2021-03-11 23:06:45', NULL),
(5, 'test2', 'test2', '../gallery/604ae8e2133744.25459608.jpg', '2021-03-11 23:06:58', NULL),
(6, 'test3', 'test3', '../gallery/604bd9341ec225.51690141.jpg', '2021-03-12 16:12:20', NULL),
(7, 'test4', 'test4', '../gallery/604c30f502ddf1.51256072.jpg', '2021-03-12 22:26:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `pid` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `uname` varchar(50) DEFAULT NULL,
  `profpic` varchar(50) NOT NULL DEFAULT '../images/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`pid`, `fname`, `uname`, `profpic`) VALUES
(5, 'Ram', 'rz0012', '../profiles/604ae502a03b79.03355000.jpg'),
(6, 'rr', 'rz0012345', '../images/default.jpg'),
(7, 'Raju', 'rg0012', '../images/default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `revid` int(11) NOT NULL COMMENT 'id for each review',
  `itemid` int(11) NOT NULL COMMENT 'id for item being reviewed',
  `uname` varchar(80) NOT NULL COMMENT 'user reviewing item',
  `title` varchar(60) NOT NULL,
  `reviewtext` text NOT NULL,
  `revdate` datetime NOT NULL,
  `ratingnum` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT 'Is there at least 1 review'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`revid`, `itemid`, `uname`, `title`, `reviewtext`, `revdate`, `ratingnum`, `status`) VALUES
(1, 7, 'rz0012', 'd', 'dd', '2021-03-18 23:23:17', 3, 1),
(2, 7, 'rz0012', 'nice', 'nice', '2021-03-18 23:25:47', 5, 1),
(3, 7, 'rz0012', 'BS', 'BS', '2021-03-18 23:25:59', 1, 1),
(4, 7, 'rz0012', '', '', '2021-03-19 00:24:01', 3, 1),
(5, 7, 'rz0012', 'avg', 'avg', '2021-03-19 00:27:47', 3, 1),
(6, 7, 'rz0012', '5', '', '2021-03-19 00:27:54', 3, 1),
(7, 7, 'rz0012', '5', '', '2021-03-19 00:28:00', 3, 1),
(8, 7, 'rz0012', '1', '', '2021-03-19 00:28:03', 3, 1),
(9, 7, 'rz0012', '1', '', '2021-03-19 00:28:05', 3, 1),
(10, 7, 'rz0012', '', '', '2021-03-19 00:28:08', 1, 1),
(11, 6, 'rz0012', 'nice', 'nice', '2021-03-19 20:19:19', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `uname` varchar(50) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COMMENT='user database for signup and signin';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `fname`, `lname`, `uname`, `password`, `email`) VALUES
(5, 'Ram', 'Zaveri', 'rz0012', '$2y$10$PKNvaw/MnLKPjb3sUl3A8enN.YcH00WrLqPYc5HPEnvT5VTdYq9C.', 'rz@rz.com'),
(6, 'rr', 'ee', 'rz0012345', '$2y$10$C0CWM4TfoR9kwQQkz8rOSu0aW3.uC3lUmqZQbv5pIq39Jw30zjXgC', 'ro@rz.com'),
(7, 'Raju', 'Ganta', 'rg0012', '$2y$10$khS2CdX4QPh7bvqXv.b9kORy2WdhCkpHHxCAKlLo56Cv213wiHL6u', 'rg@rg.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`revid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `revid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id for each review', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
