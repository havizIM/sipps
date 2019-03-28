-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2019 at 06:56 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sk_sipps`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_siswa`
--

CREATE TABLE `akun_siswa` (
  `id_user` varchar(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `tgl_registrasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kapel`
--

CREATE TABLE `kapel` (
  `id_kapel` varchar(5) NOT NULL,
  `ketegori_pelanggaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kapres`
--

CREATE TABLE `kapres` (
  `id_kapres` varchar(5) NOT NULL,
  `kategori_prestasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas` varchar(10) NOT NULL,
  `wali_kelas` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maspel`
--

CREATE TABLE `maspel` (
  `id_maspel` varchar(6) NOT NULL,
  `deskripsi_pelanggaran` varchar(100) NOT NULL,
  `poin_pelanggaran` int(11) NOT NULL,
  `kapel` varchar(5) NOT NULL,
  `status` enum('Aktif','Nonaktif','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maspres`
--

CREATE TABLE `maspres` (
  `id_maspres` varchar(6) NOT NULL,
  `deskripsi_prestasi` varchar(100) NOT NULL,
  `poin_prestasi` int(11) NOT NULL,
  `kapres` varchar(5) NOT NULL,
  `status` enum('Aktif','Nonaktif','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `panggilan`
--

CREATE TABLE `panggilan` (
  `id_panggilan` varchar(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `nis` varchar(11) NOT NULL,
  `file` text NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id_pelanggaran` varchar(11) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `maspel` varchar(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` varchar(11) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `file` text NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id_prestasi` varchar(11) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `maspres` varchar(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `status` enum('Aktif','Nonaktif','','') NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` enum('Admin','Guru','Bpbk','Wali','Kepsek') NOT NULL,
  `foto` text NOT NULL,
  `tgl_registrasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Aktif','Nonaktif','','') NOT NULL,
  `token` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nip`, `nama`, `username`, `password`, `level`, `foto`, `tgl_registrasi`, `status`, `token`) VALUES
('7201160101', 'Dian Ratna Sari', 'dianrs', '0i1qs', 'Wali', 'user.jpg', '2019-03-28 17:51:57', 'Aktif', 'e2baa50d717f2e8'),
('7201160106', 'Kalyssa Innara Putri', 'kalyssaip', '1ixhd', 'Guru', 'user.jpg', '2019-03-28 17:38:51', 'Aktif', 'e2baa50d717f2e8'),
('admin', 'Administrator', 'admin', '4dm1n', 'Admin', 'user.jpg', '2019-03-28 10:55:33', 'Aktif', 'd033e22ae348aeb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_siswa`
--
ALTER TABLE `akun_siswa`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `kapel`
--
ALTER TABLE `kapel`
  ADD PRIMARY KEY (`id_kapel`);

--
-- Indexes for table `kapres`
--
ALTER TABLE `kapres`
  ADD PRIMARY KEY (`id_kapres`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas`),
  ADD KEY `wali_kelas` (`wali_kelas`);

--
-- Indexes for table `maspel`
--
ALTER TABLE `maspel`
  ADD PRIMARY KEY (`id_maspel`),
  ADD KEY `status` (`status`),
  ADD KEY `kapel` (`kapel`);

--
-- Indexes for table `maspres`
--
ALTER TABLE `maspres`
  ADD PRIMARY KEY (`id_maspres`),
  ADD KEY `kapres` (`kapres`);

--
-- Indexes for table `panggilan`
--
ALTER TABLE `panggilan`
  ADD PRIMARY KEY (`id_panggilan`),
  ADD KEY `id_panggilan` (`id_panggilan`),
  ADD KEY `nis` (`nis`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD KEY `nis` (`nis`),
  ADD KEY `maspel` (`maspel`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `nis` (`nis`),
  ADD KEY `maspres` (`maspres`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `kelas` (`kelas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun_siswa`
--
ALTER TABLE `akun_siswa`
  ADD CONSTRAINT `akun_siswa_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`wali_kelas`) REFERENCES `user` (`nip`) ON UPDATE CASCADE;

--
-- Constraints for table `maspel`
--
ALTER TABLE `maspel`
  ADD CONSTRAINT `maspel_ibfk_1` FOREIGN KEY (`kapel`) REFERENCES `kapel` (`id_kapel`) ON UPDATE CASCADE;

--
-- Constraints for table `maspres`
--
ALTER TABLE `maspres`
  ADD CONSTRAINT `maspres_ibfk_1` FOREIGN KEY (`kapres`) REFERENCES `kapres` (`id_kapres`) ON UPDATE CASCADE;

--
-- Constraints for table `panggilan`
--
ALTER TABLE `panggilan`
  ADD CONSTRAINT `panggilan_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `panggilan_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON UPDATE CASCADE;

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `pelanggaran_ibfk_1` FOREIGN KEY (`maspel`) REFERENCES `maspel` (`id_maspel`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pelanggaran_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pelanggaran_ibfk_3` FOREIGN KEY (`user`) REFERENCES `user` (`nip`) ON UPDATE CASCADE;

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`nip`) ON UPDATE CASCADE;

--
-- Constraints for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_ibfk_1` FOREIGN KEY (`maspres`) REFERENCES `maspres` (`id_maspres`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prestasi_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prestasi_ibfk_3` FOREIGN KEY (`user`) REFERENCES `user` (`nip`) ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`kelas`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
