-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 07:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sablon_cal`
--

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `id` int(11) NOT NULL,
  `id_sablon` int(11) NOT NULL,
  `id_ukuran` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`id`, `id_sablon`, `id_ukuran`, `harga`) VALUES
(1, 1, 1, 5000),
(2, 1, 2, 8000),
(3, 1, 3, 12000),
(4, 1, 4, 20000),
(5, 1, 8, 24000),
(6, 1, 5, 30000),
(7, 1, 6, 40000),
(8, 1, 7, 50000),
(9, 2, 1, 5000),
(10, 2, 2, 15000),
(11, 2, 3, 20000),
(12, 2, 4, 30000),
(13, 2, 8, 35000),
(14, 2, 5, 60000),
(15, 2, 6, 75000),
(16, 2, 7, 90000),
(17, 3, 1, 5000),
(18, 3, 2, 15000),
(19, 3, 3, 25000),
(20, 3, 4, 40000),
(21, 3, 8, 50000),
(22, 3, 5, 80000),
(23, 3, 6, 110000),
(24, 3, 7, 140000),
(25, 4, 4, 35000),
(26, 4, 5, 50000),
(27, 4, 1, 35000),
(28, 4, 2, 35000),
(29, 4, 3, 35000),
(30, 4, 8, 50000),
(31, 1, 11, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `sablon`
--

CREATE TABLE `sablon` (
  `id` int(11) NOT NULL,
  `nama_sablon` varchar(50) NOT NULL,
  `calculate_size` varchar(5) NOT NULL,
  `min_charge` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sablon`
--

INSERT INTO `sablon` (`id`, `nama_sablon`, `calculate_size`, `min_charge`, `urutan`, `harga`) VALUES
(1, 'DTF (Direct Transfer Film)', 'No', 5000, 1, 0),
(2, 'Cutting Polyflex', 'No', 5000, 2, 0),
(3, 'P&C (Print and Cut)', 'No', 5000, 3, 0),
(4, 'DTG (Dengan tinta putih)', 'No', 35000, 4, 0),
(5, 'Cutting Flock (120/cm²)', 'Yes', 20000, 5, 120),
(6, 'Cutting Glow (165/cm²)', 'Yes', 20000, 6, 165),
(7, 'Cutting Spektrum (115/cm²)', 'Yes', 20000, 7, 115),
(8, 'Cutting Reflective (135/cm²)', 'Yes', 20000, 8, 135);

-- --------------------------------------------------------

--
-- Table structure for table `ukuran_sablon`
--

CREATE TABLE `ukuran_sablon` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `total_size` int(11) NOT NULL,
  `urutan` int(2) NOT NULL,
  `lebar` int(11) NOT NULL,
  `tinggi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ukuran_sablon`
--

INSERT INTO `ukuran_sablon` (`id`, `nama`, `total_size`, `urutan`, `lebar`, `tinggi`) VALUES
(1, 'Label', 25, 1, 5, 5),
(2, 'Logo', 100, 2, 10, 10),
(3, 'A5', 315, 3, 21, 15),
(4, 'A4', 630, 4, 30, 21),
(5, 'A3', 1260, 6, 42, 30),
(6, 'A3+', 1584, 7, 48, 33),
(7, 'A2', 2520, 8, 60, 42),
(8, 'A4+', 720, 5, 30, 24),
(11, '1/2 Meter', 2900, 9, 58, 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sablon`
--
ALTER TABLE `sablon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ukuran_sablon`
--
ALTER TABLE `ukuran_sablon`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sablon`
--
ALTER TABLE `sablon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ukuran_sablon`
--
ALTER TABLE `ukuran_sablon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
