-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2024 at 06:48 AM
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
-- Database: `bankdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transactionId` int(11) NOT NULL,
  `bankNumber` int(11) NOT NULL,
  `amount` float NOT NULL,
  `type` varchar(255) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `balance` float NOT NULL,
  `date` date NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `bankNumber` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `savings` float NOT NULL,
  `cryptosavings` float NOT NULL,
  `investStatus` int(11) NOT NULL,
  `investTarget` float NOT NULL,
  `investCurrent` float NOT NULL,
  `accountType` int(11) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `address`, `emailAddress`, `contactNumber`, `birthDate`, `gender`, `bankNumber`, `password`, `savings`, `cryptosavings`, `investStatus`, `investTarget`, `investCurrent`, `accountType`, `dateCreated`) VALUES
(1, 'Erwin', 'Esparto', 'Binan Laguna', 'eesparto@gmail.com', '09159185291', '2003-01-15', 'Male', 20240101, '1', 5000000, 2500000, 1, 30000, 0, 1, '2024-02-02'),
(2, 'Lilac', 'Goodrich', 'Binan Laguna', 'lilacgoodrich@gmail.com', '09275826475', '2003-07-28', 'Female', 20240102, '456', 2000, 0, 0, 0, 0, 2, '2024-02-02'),
(3, 'Joanvic', 'Vargas', 'Binan Laguna', 'vargasjoanvic@gmail.com', '09285963748', '2003-03-23', 'Male', 20240103, '789', 0, 0, 0, 0, 0, 2, '2024-02-02'),
(4, 'Jemen', 'Pastor', 'Binan Laguna', 'jemenpastor@gmail.com', '09219182710', '2003-05-12', 'Male', 20240104, '098', 0, 0, 0, 0, 0, 2, '2024-02-02'),
(5, 'Lorrea', 'Hugo', 'Binan Laguna', 'lorreahugo@gmail.com', '09194756283', '2003-07-17', 'Female', 20240105, '765', 0, 0, 0, 0, 0, 2, '2024-02-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactionId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transactionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
