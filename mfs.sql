-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2020 at 08:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mfs`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Account_No` bigint(200) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Balance` decimal(60,2) NOT NULL,
  `Creation_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Account_No`, `Email`, `Balance`, `Creation_Date`) VALUES
(128, 'arohi@gmail.com', '122183.84', '2020-07-13'),
(12345, 'dw@gmail.com', '50229.17', '2018-04-11'),
(1234567891, 'rick@gmail.com', '30000.00', '2020-02-14');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` bigint(200) NOT NULL,
  `Password` varchar(8) NOT NULL,
  `Type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `ID` int(100) NOT NULL,
  `Type` text NOT NULL,
  `Rate` decimal(60,2) NOT NULL,
  `Tenure` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`ID`, `Type`, `Rate`, `Tenure`) VALUES
(6, 'Savings', '5.50', 1),
(9, 'Term Deposit', '6.25', 3),
(11, 'Loan', '7.50', 12),
(13, 'Loan', '7.50', 36),
(15, 'Term Deposit', '6.75', 5),
(16, 'Term Deposit', '5.50', 3);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `Loan_Id` bigint(200) NOT NULL,
  `Account_No` bigint(200) NOT NULL,
  `Amount` decimal(60,2) NOT NULL,
  `Installments` int(100) NOT NULL,
  `income` int(11) NOT NULL,
  `Creation_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`Loan_Id`, `Account_No`, `Amount`, `Installments`, `income`, `Creation_Date`) VALUES
(1000, 1234567891, '1000000.00', 24, 0, '2020-04-23'),
(1001, 12345, '50000.00', 10, 0, '2019-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `td`
--

CREATE TABLE `td` (
  `TD_ID` bigint(200) NOT NULL,
  `Account_No` bigint(200) NOT NULL,
  `Creation_Date` date NOT NULL,
  `Amount` decimal(60,2) NOT NULL,
  `Tenure` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td`
--

INSERT INTO `td` (`TD_ID`, `Account_No`, `Creation_Date`, `Amount`, `Tenure`) VALUES
(2000, 128, '2020-05-01', '50000.00', 60),
(2001, 128, '2019-05-22', '10000.00', 24);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `Transaction_ID` bigint(200) NOT NULL,
  `Type` text NOT NULL,
  `Account_No` bigint(200) NOT NULL,
  `Date` date NOT NULL,
  `Amount` decimal(60,2) NOT NULL,
  `Status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`Transaction_ID`, `Type`, `Account_No`, `Date`, `Amount`, `Status`) VALUES
(1120, 'Savings Interest', 128, '2020-07-23', '183.84', 'Approved'),
(1121, 'Savings Interest', 12345, '2020-07-23', '229.17', 'Approved'),
(1122, 'Savings Interest', 1234567891, '2020-07-23', '36.67', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `Transfer_ID` bigint(200) NOT NULL,
  `Transferred_To` bigint(200) NOT NULL,
  `Transferred_From` bigint(200) NOT NULL,
  `Amount` decimal(60,2) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`Transfer_ID`, `Transferred_To`, `Transferred_From`, `Amount`, `Date`) VALUES
(1, 12432, 12345678, '2020.00', '0000-00-00'),
(2, 12, 12345678, '100000.00', '2020-06-25'),
(3, 12345, 1234567891, '19000.00', '2020-06-26'),
(4, 128, 1234567891, '32500.00', '2020-07-01'),
(5, 128, 1234567891, '1000.00', '2020-07-06'),
(17, 128, 1234567891, '10000.00', '2020-07-12'),
(18, 128, 1234567891, '1000.00', '2020-07-12'),
(19, 128, 1234567891, '1000.00', '2020-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Name` varchar(50) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(8) NOT NULL,
  `Phone_No` bigint(10) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `Govt_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `Email`, `Password`, `Phone_No`, `Address`, `DOB`, `Govt_ID`) VALUES
('Dw ArohiShirke', 'arohi@gmail.com', 'A123s', 9988776655, '10 8 18 Malibu Beach', '1997-07-25', '1234567890Arohi'),
('Death Whistle', 'dw@gmail.com', 'D123w', 8877665544, 'kolkata', '2018-04-11', '2345678901Death'),
('Dw Viper', 'rick@gmail.com', 'DW123vip', 7766554433, '10 8 18 Malibu Beach', '1997-10-15', '3456789012Viper');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Account_No`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`Loan_Id`);

--
-- Indexes for table `td`
--
ALTER TABLE `td`
  ADD PRIMARY KEY (`TD_ID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`Transaction_ID`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`Transfer_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `Account_No` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234567892;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `Loan_Id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT for table `td`
--
ALTER TABLE `td`
  MODIFY `TD_ID` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2005;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `Transaction_ID` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1124;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `Transfer_ID` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
