-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2022 at 08:36 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--
CREATE DATABASE IF NOT EXISTS `app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `app`;

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

DROP TABLE IF EXISTS `friend`;
CREATE TABLE `friend` (
  `USER_ID` int(11) NOT NULL,
  `FRIEND_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `palette`
--

DROP TABLE IF EXISTS `palette`;
CREATE TABLE `palette` (
  `PALETTE_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `PALETTE_NAME` varchar(255) NOT NULL,
  `HEXCODE1` int(11) NOT NULL,
  `HEXCODE2` int(11) NOT NULL,
  `HEXCODE3` int(11) NOT NULL,
  `HEXCODE4` int(11) NOT NULL,
  `HEXCODE5` int(11) NOT NULL,
  `DATE_CREATED` datetime NOT NULL,
  `NUM_VIEWS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `saved_palette`
--

DROP TABLE IF EXISTS `saved_palette`;
CREATE TABLE `saved_palette` (
  `USER_ID` int(11) NOT NULL,
  `PALETTE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `USER_ID` int(11) NOT NULL,
  `USER_NAME` varchar(255) NOT NULL,
  `USER_PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`USER_ID`,`FRIEND_ID`),
  ADD KEY `FriendFK2` (`FRIEND_ID`);

--
-- Indexes for table `palette`
--
ALTER TABLE `palette`
  ADD PRIMARY KEY (`PALETTE_ID`),
  ADD KEY `FK` (`USER_ID`);

--
-- Indexes for table `saved_palette`
--
ALTER TABLE `saved_palette`
  ADD PRIMARY KEY (`USER_ID`,`PALETTE_ID`),
  ADD KEY `FK2` (`PALETTE_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `USER_NAME` (`USER_NAME`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `palette`
--
ALTER TABLE `palette`
  MODIFY `PALETTE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `FriendFK1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`),
  ADD CONSTRAINT `FriendFK2` FOREIGN KEY (`FRIEND_ID`) REFERENCES `user` (`USER_ID`);

--
-- Constraints for table `palette`
--
ALTER TABLE `palette`
  ADD CONSTRAINT `FK` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);

--
-- Constraints for table `saved_palette`
--
ALTER TABLE `saved_palette`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`),
  ADD CONSTRAINT `FK2` FOREIGN KEY (`PALETTE_ID`) REFERENCES `palette` (`PALETTE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
