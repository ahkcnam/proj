-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2024 at 11:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `Cid` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `PostDate` date NOT NULL,
  `PostText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`Cid`, `MemberId`, `PostDate`, `PostText`) VALUES
(8, 9, '2024-05-12', 'super web site\r\n'),
(9, 9, '2024-05-12', 'can someone hear me'),
(11, 9, '2024-05-12', 'yep that is life');

-- --------------------------------------------------------

--
-- Table structure for table `Members`
--

CREATE TABLE `Members` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `BirthDate` date NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `ProfilePicture` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Members`
--

INSERT INTO `Members` (`Id`, `FirstName`, `LastName`, `UserName`, `Password`, `BirthDate`, `Email`, `Country`, `ProfilePicture`) VALUES
(9, 'Ahmad', 'Kheir eddine', 'ahmad', 'ahmad', '2004-12-25', 'ahmad@gmail.com', 'LB', 'ppic-9.jpg'),
(10, 'Yousefe', 'Kheir eddine', 'yousefe', 'OhGod', '2004-12-25', 'yousefe@yahoo.com', 'LB', 'ppic-10.jpg'),
(11, 'Macha', 'Kheir eddine', 'Macha7', 'Mariame', '2004-12-25', 'macha@gmail.com', 'LB', 'ppic-11.jpeg'),
(12, 'Huhu', 'Alpha', 'abc', 'abc', '2004-12-25', 'yep@super.com', 'LB', 'ppic-12.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`Cid`),
  ADD KEY `index_MemberId` (`MemberId`);

--
-- Indexes for table `Members`
--
ALTER TABLE `Members`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `unique_userName` (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `Cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Members`
--
ALTER TABLE `Members`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `Members` (`Id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
