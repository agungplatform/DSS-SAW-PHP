-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 05:17 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbcalon`
--

CREATE TABLE `tbcalon` (
  `idCalon` int(11) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbcalon`
--

INSERT INTO `tbcalon` (`idCalon`, `nama`) VALUES
(11111, 'MAHASISWA-AA'),
(22222, 'MAHASISWA-BB'),
(33333, 'MAHASISWA-CC'),
(44444, 'MAHASISWA-DD'),
(55555, 'MAHASISWA-EE'),
(66666, 'MAHASISWA-FF'),
(77777, 'MAHASISWA-GG'),
(88888, 'MAHASISWA-HH'),
(99999, 'MAHASISWA-II');

-- --------------------------------------------------------

--
-- Table structure for table `tbmatrik`
--

CREATE TABLE `tbmatrik` (
  `idMatrik` int(11) NOT NULL,
  `idCalon` int(11) NOT NULL,
  `Kriteria1` bigint(20) NOT NULL,
  `Kriteria2` text NOT NULL,
  `Kriteria3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbmatrik`
--

INSERT INTO `tbmatrik` (`idMatrik`, `idCalon`, `Kriteria1`, `Kriteria2`, `Kriteria3`) VALUES
(11111, 11111, 1000000, '3.25', 1),
(22222, 22222, 700000, '2.77', 3),
(33333, 33333, 850000, '3.3', 2),
(44444, 44444, 1500000, '3.1', 5),
(55555, 55555, 1000000, '2.88', 0),
(66666, 66666, 900000, '3.2', 5),
(77777, 77777, 1250000, '3.15', 3),
(88888, 88888, 1000000, '2.55', 4),
(99999, 99999, 850000, '2.75', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbcalon`
--
ALTER TABLE `tbcalon`
  ADD PRIMARY KEY (`idCalon`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
