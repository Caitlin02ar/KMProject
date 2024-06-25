-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 08:17 AM
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
-- Database: `km_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `nomor_induk` varchar(9) DEFAULT NULL,
  `nama_lengkap` varchar(7) DEFAULT NULL,
  `peran` varchar(9) DEFAULT NULL,
  `jabatan` varchar(14) DEFAULT NULL,
  `email` varchar(26) DEFAULT NULL,
  `password` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `nomor_induk`, `nama_lengkap`, `peran`, `jabatan`, `email`, `password`) VALUES
(1, '01-100', 'adi', 'staf', 'baka', 'adi@peter.petra.ac.id', 123),
(2, '01-101', 'budi', 'staf', 'baka', 'budi@peter.petra.ac.id', 123),
(3, 'c21210001', 'kevin', 'mahasiswa', 'bpmf', 'c21210001@john.petra.ac.id', 123),
(4, 'c21210002', 'laura', 'mahasiswa', 'ketua_lk', 'c21210002@john.petra.ac.id', 123),
(5, 'c21210003', 'michael', 'mahasiswa', 'sekretaris_lk', 'c21210003@john.petra.ac.id', 123),
(6, 'c21210004', 'nana', 'mahasiswa', 'ketua_kegiatan', 'c21210004@john.petra.ac.id', 123),
(7, 'c21210005', 'olivia', 'mahasiswa', 'ketua_kegiatan', 'c21210005@john.petra.ac.id', 123);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
