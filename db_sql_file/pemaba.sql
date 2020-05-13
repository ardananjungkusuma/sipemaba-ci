-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2020 at 08:12 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemaba`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_daftar` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `perguruan_tinggi` varchar(25) NOT NULL,
  `jurusansatu` varchar(25) NOT NULL,
  `jurusandua` varchar(25) NOT NULL,
  `status_penerimaan` varchar(25) NOT NULL DEFAULT 'Menunggu Seleksi'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_daftar`, `id_siswa`, `perguruan_tinggi`, `jurusansatu`, `jurusandua`, `status_penerimaan`) VALUES
(4, 1, 'Universitas Bojonegoro', 'Teknik Sipil', 'Teknik Kimia', 'Menunggu Seleksi'),
(5, 4, 'Universitas Brawijaya', 'Dokter Umum', 'Pertanian', 'Menunggu Seleksi'),
(6, 5, 'Universitas Gadjah Mada', 'Teknik Industri', 'Teknik Elektro', 'Menunggu Seleksi'),
(7, 12, 'Politeknik Negeri Malang', 'Teknik Informatika', 'Manajemen Informatika', 'Menunggu Seleksi');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(50) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `kota_kabupaten` varchar(50) NOT NULL,
  `provinsi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `nama_sekolah`, `alamat_sekolah`, `kota_kabupaten`, `provinsi`) VALUES
(1, 'SMKN 2 Bojonegoro', 'Jl. Pattimura 04 Bojonegoro', 'Bojonegoro', 'Jawa Timur'),
(2, 'SMAN 2 Bojonegoro', 'Jl. Basuki Rahmat 13', 'Bojonegoro', 'Jawa Timur'),
(3, 'SMAN 3 Bojonegoro', 'Jl. Ahmad Yani 25', 'Bojonegoro', 'Jawa Timur'),
(4, 'SMAN 4 Surabaya', 'Jl. Veteran 4 ', 'Surabaya', 'Jawa Timur'),
(5, 'SMAN 1 Bojonegoro', 'Jl. Panglima Sudirman 54', 'Bojonegoro', 'Jawa Timur'),
(6, 'SMAN 2 Malang', 'Jl. Kedungbaru 15', 'Malang', 'Jawa Timur'),
(10, 'SMKN 2 Malang', 'Jl. Panglima Polim 65', 'Malang', 'Jawa Timur');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `nisn` varchar(15) NOT NULL,
  `nama_siswa` varchar(75) NOT NULL,
  `alamat_siswa` varchar(50) NOT NULL,
  `rata_rata_un` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_sekolah`, `nisn`, `nama_siswa`, `alamat_siswa`, `rata_rata_un`) VALUES
(1, 1, '0006712374', 'Fiatama Iqbal Mahendra', 'Jl. 15 Anggrek Campurjo Bojonegoro', '39.41'),
(2, 2, '0006712524', 'Andi Wijayanto', 'Jalan Kagengan 35 Balen ', '35.54'),
(3, 3, '0006782489', 'John Doe', 'Jl. 15 Mawar Merah Tuban', '33.55'),
(4, 2, '9998472362', 'Hermoine Granger', 'Jl. Pipit 26 Bojonegoro', '39.89'),
(5, 4, '0008172909', 'Novia Kusuma', 'Jl. Mawar 56 Surabaya', '38.75'),
(11, 6, '0004726364', 'M. Irfan Rafif', 'Jl. Kenari 25 Malang', '36.51'),
(12, 6, '9994824752', 'Dharma Yudhistira Eka Putra', 'Jl. Kenanga 25 Malang', '37.85');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_daftar`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_daftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
