-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2023 at 11:09 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `union_rep`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankofkolyo`
--

CREATE TABLE `bankofkolyo` (
  `IBAN` varchar(37) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `Balance` float NOT NULL,
  `Username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bankofkolyo`
--

INSERT INTO `bankofkolyo` (`IBAN`, `firstname`, `lastname`, `Balance`, `Username`) VALUES
('BG01BOKB69135922070967216063114602', 'Nikolay', 'Panev', 425.69, 'admin'),
('BG01BOKB97220547918541297117610528', 'Ivan', 'Ivanov', 0, 'vanko99'),
('BG01BOKB94479036828456773149723507', 'Вафличка', 'Тодорова', 0, 'fafla99'),
('BG01BOKB09121891405341192391034495', 'Константин', 'Илиев', 35, 'koceto99');

-- --------------------------------------------------------

--
-- Table structure for table `bankofveni`
--

CREATE TABLE `bankofveni` (
  `IBAN` varchar(37) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `Balance` float NOT NULL,
  `Username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bankofveni`
--

INSERT INTO `bankofveni` (`IBAN`, `firstname`, `lastname`, `Balance`, `Username`) VALUES
('BG02BOVB88420113679239919823552710', 'Veni', 'Dachev', 35, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(3, 'vanko99', 'vanko99'),
(4, '', ''),
(5, '', ''),
(6, '', ''),
(7, 'fafla99', 'fafla99'),
(8, 'koceto99', 'koceto99');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `SenderIBAN` varchar(37) NOT NULL,
  `RecipientIBAN` varchar(37) NOT NULL,
  `Amount` float NOT NULL,
  `Note` varchar(255) NOT NULL,
  `TransactionDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`SenderIBAN`, `RecipientIBAN`, `Amount`, `Note`, `TransactionDate`) VALUES
('BG01BOKB69135922070967216063114602', 'BG02BOVB88420113679239919823552710', 69, 'Duner Fund', '2022-11-30 08:44:47'),
('BG01BOKB69135922070967216063114602', 'BG02BOVB88420113679239919823552710', 42000, 'Memes', '2022-11-30 09:24:08'),
('BG02BOVB88420113679239919823552710', 'BG01BOKB69135922070967216063114602', 0.69, 'Nice', '2022-11-30 09:26:09'),
('BG02BOVB88420113679239919823552710', 'BG01BOKB69135922070967216063114602', 5, 'Подарък за Коледа', '2022-12-21 08:56:47'),
('BG02BOVB88420113679239919823552710', 'BG01BOKB09121891405341192391034495', 35, 'Happy new year', '2023-01-06 10:17:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
