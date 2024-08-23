-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2023 at 11:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductId` int(11) NOT NULL,
  `Product_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductId`, `Product_Name`) VALUES
(4, 'Rice'),
(6, 'Cassava'),
(7, 'Flour');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `SI_Id` int(11) NOT NULL,
  `Product_Id` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Unit_Price` int(11) DEFAULT NULL,
  `Total_Price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_in`
--

INSERT INTO `stock_in` (`SI_Id`, `Product_Id`, `Date`, `Quantity`, `Unit_Price`, `Total_Price`) VALUES
(3, 4, '2023-06-03', 2, 100, 200),
(4, 6, '2023-06-16', 5, 1000, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

CREATE TABLE `stock_out` (
  `SO_Id` int(11) NOT NULL,
  `Product_Id` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_out`
--

INSERT INTO `stock_out` (`SO_Id`, `Product_Id`, `Date`, `Quantity`) VALUES
(3, 4, '2023-06-14', 100),
(4, 4, '2023-06-22', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_Id` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_Id`, `UserName`, `Password`) VALUES
(1, 'glodie', '123'),
(2, 'hussein', '45'),
(3, 'jean', '123'),
(4, 'Johne', '123'),
(5, 'admin', '123'),
(6, 'admin', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductId`);

--
-- Indexes for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`SI_Id`),
  ADD KEY `stock_in_ibfk_1` (`Product_Id`);

--
-- Indexes for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`SO_Id`),
  ADD KEY `stock_out_ibfk_1` (`Product_Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `SI_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `SO_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD CONSTRAINT `stock_in_ibfk_1` FOREIGN KEY (`Product_Id`) REFERENCES `products` (`ProductId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD CONSTRAINT `stock_out_ibfk_1` FOREIGN KEY (`Product_Id`) REFERENCES `products` (`ProductId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
