-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2018 at 12:13 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books`
--

-- --------------------------------------------------------

--
-- Table structure for table `booksb`
--

CREATE TABLE `booksb` (
    `id` int(11) NOT NULL,
    `nameBo` varchar(100) NOT NULL,
    `authorBo` varchar(500) NOT NULL,
    `descriptionBo` varchar(500) NOT NULL,
    `idUserBo` int(11) NOT NULL,
    `dateB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booksb`
--

INSERT INTO `booksb` (`id`, `nameBo`, `authorBo`, `descriptionBo`, `idUserBo`, `dateB`) VALUES
    (14, 'knjiga3', 'autor3', 'opis2', 32, '2018-01-22 10:19:04'),
    (15, 'knjiga 8', 'autor8', 'opis8', 32, '2018-01-22 11:54:36'),
    (17, 'knjiga3', 'autor1', 'vsfdvs', 33, '2018-01-22 15:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `groupsb`
--

CREATE TABLE `groupsb` (
    `id` int(11) NOT NULL,
    `nameG` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupsb`
--

INSERT INTO `groupsb` (`id`, `nameG`) VALUES
    (1, 'HEXIS'),
    (2, 'Obitelj'),
    (3, 'Prijatelji');

-- --------------------------------------------------------

--
-- Table structure for table `ratingsb`
--

CREATE TABLE `ratingsb` (
    `id` int(11) NOT NULL,
    `userIdR` int(11) NOT NULL,
    `ratingR` int(11) NOT NULL,
    `bookIdR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratingsb`
--

INSERT INTO `ratingsb` (`id`, `userIdR`, `ratingR`, `bookIdR`) VALUES
    (10, 32, 5, 14),
    (12, 32, 5, 15),
    (13, 33, 2, 14);

-- --------------------------------------------------------

--
-- Table structure for table `usersb`
--

CREATE TABLE `usersb` (
    `id` int(10) NOT NULL,
    `username` varchar(15) NOT NULL,
    `email` varchar(50) NOT NULL,
    `name` varchar(50) NOT NULL,
    `surname` varchar(50) NOT NULL,
    `password` varchar(150) NOT NULL,
    `groupId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersb`
--

INSERT INTO `usersb` (`id`, `username`, `email`, `name`, `surname`, `password`, `groupId`) VALUES
    (32, 'pero', 'mariopetrovic999@gmail.com', 'Pero', 'Peric', 'pero', 1),
    (33, 'mario', 'mariopetrovic99999@gmail.com', 'Mario', 'Petrovic', 'mario', 1),
    (34, 'novi', 'novi@novi.hr', 'novi', 'novi', 'novi', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booksb`
--
ALTER TABLE `booksb`
    ADD PRIMARY KEY (`id`),
    ADD KEY `bookuserFK` (`idUserBo`);

--
-- Indexes for table `groupsb`
--
ALTER TABLE `groupsb`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratingsb`
--
ALTER TABLE `ratingsb`
    ADD PRIMARY KEY (`id`),
    ADD KEY `ratingFK1` (`userIdR`),
    ADD KEY `ratingFK2` (`bookIdR`);

--
-- Indexes for table `usersb`
--
ALTER TABLE `usersb`
    ADD PRIMARY KEY (`id`),
    ADD KEY `groupFK` (`groupId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booksb`
--
ALTER TABLE `booksb`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `groupsb`
--
ALTER TABLE `groupsb`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ratingsb`
--
ALTER TABLE `ratingsb`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `usersb`
--
ALTER TABLE `usersb`
    MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `booksb`
--
ALTER TABLE `booksb`
    ADD CONSTRAINT `bookuserFK` FOREIGN KEY (`idUserBo`) REFERENCES `usersb` (`id`);

--
-- Constraints for table `ratingsb`
--
ALTER TABLE `ratingsb`
    ADD CONSTRAINT `ratingFK1` FOREIGN KEY (`userIdR`) REFERENCES `usersb` (`id`),
    ADD CONSTRAINT `ratingFK2` FOREIGN KEY (`bookIdR`) REFERENCES `booksb` (`id`);

--
-- Constraints for table `usersb`
--
ALTER TABLE `usersb`
    ADD CONSTRAINT `groupFK` FOREIGN KEY (`groupId`) REFERENCES `groupsb` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
