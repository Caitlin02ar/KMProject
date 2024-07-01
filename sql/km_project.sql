-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2024 pada 11.38
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `lembaga` varchar(100) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `jenis_kepanitiaan` varchar(50) NOT NULL,
  `lingkup` varchar(50) NOT NULL,
  `file_path_excel` varchar(255) NOT NULL,
  `status_bem` varchar(20) NOT NULL,
  `status_baka` varchar(20) NOT NULL,
  `file_path_surat` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama_kegiatan`, `lembaga`, `periode`, `jenis_kepanitiaan`, `lingkup`, `file_path_excel`, `status_bem`, `status_baka`, `file_path_surat`) VALUES
(1, 'Open House 2024', 'Badan Eksekutif Mahasiswa', '1-2024/2025', '1 tahun', 'Universitas', 'uploads/template_skkk.xlsx', 'disetujui', 'ditolak', 'uploads/contoh_surat.docx'),
(2, 'Seminar Mata Kulaih Umum Etika Profesi', 'Pelma', '2-2024/2025', '1 tahun', 'Nasional', 'uploads/dummy_data_skkk.xlsx', 'disetujui', 'ditolak', ''),
(3, 'Seminar Mata Kulaih Umum Servant Leadership', 'Pelma', '2-2024/2025', '1 tahun', 'Internasional', 'uploads/dummy_data_skkk.xlsx', 'disetujui', 'disetujui', ''),
(4, 'Seminar Mata Kulaih Umum Etika Profesi', 'Pelma', '2-2024/2025', '1 tahun', 'Nasional', 'uploads/dummy_data_skkk.xlsx', 'disetujui', 'diproses', ''),
(5, 'Seminar Mata Kulaih Umum Etika Profesi 2', 'BEM', '1-2024/2025', '1 tahun', 'Nasional', 'uploads/dummy_data_skkk.xlsx', 'disetujui', 'disetujui', ''),
(6, 'Seminar Mata Kulaih Umum Etika Profesi 3', 'BEM', '1-2024/2025', '1 tahun', 'Internasional', 'uploads/dummy_data_skkk.xlsx', 'disetujui', 'diproses', 'uploads/contoh_surat.docx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_table`
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
-- Dumping data untuk tabel `user_table`
--

INSERT INTO `user_table` (`id`, `nomor_induk`, `nama_lengkap`, `peran`, `jabatan`, `email`, `password`) VALUES
(1, '01-100', 'adi', 'staf', 'baka', 'adi@peter.petra.ac.id', 123),
(2, '01-101', 'budi', 'staf', 'baka', 'budi@peter.petra.ac.id', 123),
(3, 'c21210001', 'kevin', 'mahasiswa', 'ketua_kegiatan', 'c21210001@john.petra.ac.id', 123),
(4, 'c21210002', 'laura', 'mahasiswa', 'ketua_lk', 'c21210002@john.petra.ac.id', 123),
(5, 'c21210003', 'michael', 'mahasiswa', 'sekretaris_lk', 'c21210003@john.petra.ac.id', 123),
(6, 'c21210004', 'nana', 'mahasiswa', 'bpmf', 'c21210004@john.petra.ac.id', 123),
(7, 'c21210005', 'olivia', 'mahasiswa', 'ketua_kegiatan', 'c21210005@john.petra.ac.id', 123);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
