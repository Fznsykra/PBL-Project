-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 02:49 PM
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
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absen` int(11) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `keterangan` enum('Hadir','Sakit','Izin','Absen') NOT NULL,
  `nim` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absen`, `waktu`, `keterangan`, `nim`) VALUES
(62, '2024-01-10', 'Hadir', '2201091002'),
(63, '2024-01-10', '', '2201092021'),
(64, '2024-01-10', '', '2201092044'),
(65, '2024-01-10', '', '2201092048'),
(66, '2024-01-10', '', '2201091002'),
(67, '2024-01-10', '', '2201092021'),
(68, '2024-01-10', '', '2201092044'),
(69, '2024-01-10', '', '2201092048');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` enum('Pria','Wanita') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `username`, `nama`, `jk`) VALUES
('12345', 'mar', 'mar', 'Wanita'),
('19700718 200801 2 010', 'Rita Afyenni', 'Rita Afyenni, S.Kom., M.Kom', 'Wanita'),
('19760719 200801 2 017', 'yulherniwati', 'Yulherniwati, S.Kom.,MT', 'Wanita'),
('19780928 200812 1 002', 'Deni Satria', 'Deni Satria, S.Kom., M.Kom\r\n', 'Pria'),
('19811207 200812 2 001', 'Defni', 'Defni, S.Si., M.Kom ', 'Wanita'),
('19860722 200912 1 004', 'roniputra', 'Roni Putra, S.Kom.,MT', 'Pria'),
('19880429 202203 1 005', 'Ardian Firosha', 'Ardian Firosha, S.S.T., M.Ds\r\n', 'Pria'),
('19880618 202203 1 003', 'Hendra Rotama', 'Hendra Rotama, S.Pd., M.Sn', 'Pria'),
('19880912 202203 1 006', 'Ideva Gaputra', 'Ideva Gaputra, S.Kom., M.Kom', 'Pria'),
('19890703 201903 1 015', 'aldoerianda', 'Aldo Erianda', 'Pria'),
('19900510 202203 1 002', 'Yori Adi Atma', 'Yori Adi Atma, S.Pd., M.Kom', 'Pria'),
('19900606 201903 2 026', 'fannisukma', 'Fanni Sukma, S.S.T.,M.T.', 'Wanita'),
('19910330 202203 1 004', 'Ulya Ilhami Arsyah', 'Ulya Ilhami Arsyah, S.Kom., M.Kom', 'Pria'),
('19911110 202203 1 008', 'harfebifryonanda', 'Harfebi Fryonanda, S.Kom., M.Kom', 'Pria'),
('19930827 202203 2 012', 'Rahmi Putri Kurnia', 'Rahmi Putri Kurnia, S.Kom., M.Kom', 'Wanita');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `id_hari` int(11) NOT NULL,
  `hari` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id_hari`, `hari`) VALUES
(1, 'senin'),
(2, 'selasa'),
(3, 'rabu'),
(4, 'kamis'),
(5, 'jumat'),
(6, 'sabtu');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_matdos` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_ruang` varchar(50) NOT NULL,
  `id_hari` int(11) NOT NULL,
  `jam_mulai` varchar(25) NOT NULL,
  `jam_berakhir` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_matdos`, `id_kelas`, `id_ruang`, `id_hari`, `jam_mulai`, `jam_berakhir`) VALUES
(12, 3, 4, 'E302', 1, '07:30', '10:00'),
(13, 4, 4, 'E302', 1, '07:30', '10:00'),
(14, 5, 4, 'E201', 1, '10:15', '13:50'),
(15, 6, 4, 'E201', 1, '10:15', '13:50'),
(16, 11, 4, 'E304', 2, '13:00', '16:35'),
(17, 14, 4, 'E304', 2, '13:00', '16:35'),
(18, 12, 4, 'E301', 3, '07:30', '10:00'),
(19, 13, 4, 'E301', 3, '07:30', '10:00'),
(20, 9, 4, 'E303', 3, '13:50', '16:35'),
(21, 1, 4, 'E301', 4, '07:30', '10:00'),
(22, 10, 4, 'E301', 4, '07:30', '10:00'),
(23, 5, 4, 'C102', 4, '10:15', '13:50'),
(24, 7, 4, 'E306', 4, '13:50', '16:35'),
(25, 8, 4, 'E306', 4, '13:50', '16:35'),
(26, 2, 4, 'C102', 5, '07:30', '10:00'),
(27, 15, 4, 'C102', 5, '10:15', '13:50'),
(28, 9, 4, 'E206', 6, '10:15', '13:50');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_thn_ajaran` int(11) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `nama_kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_thn_ajaran`, `prodi`, `nama_kelas`) VALUES
(1, 1, 'Manajemen Informatika', 'MI2B'),
(4, 1, 'Manajemen Informatika', 'MI2A'),
(5, 2, 'TRPL', 'TRPL 1A'),
(6, 1, 'Manajemen Informatika', 'MI2C'),
(7, 2, 'Manajemen Informatika', 'MI1A');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(30) NOT NULL,
  `username` varchar(255) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `jk` enum('Pria','Wanita') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `username`, `id_kelas`, `nama_mhs`, `jk`) VALUES
('2201091002', 'ariamardiah', 4, 'Aria Mardiah', 'Wanita'),
('2201091003', 'Basmida Laia', 1, 'Basmida Laia', 'Wanita'),
('2201091005', 'Fitratul Hayati', 1, 'Fitratul Hayati', 'Wanita'),
('2201091008', 'Linus Dimbau', 1, 'Linus Dimbau', 'Pria'),
('2201091015', 'Wirda Nissa', 1, 'Wirda Annisa', 'Wanita'),
('2201091020', 'Lili Nur Aulia', 1, 'Lili Nur Aulia', 'Wanita'),
('2201092021', 'Bimo Surya Prima', 4, 'Bimo Surya Prima', 'Pria'),
('2201092044', 'Larsa Zalona Illahi', 4, 'Larsa Zalona Illahi', 'Wanita'),
('2201092048', 'Nurul Iqma', 4, 'Nurul Iqma', 'Wanita');

-- --------------------------------------------------------

--
-- Table structure for table `matdos`
--

CREATE TABLE `matdos` (
  `id_matdos` int(11) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `id_matkul` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matdos`
--

INSERT INTO `matdos` (`id_matdos`, `nip`, `id_matkul`, `id_jadwal`) VALUES
(1, '19860722 200912 1 004', 1, 12),
(2, '19900606 201903 2 026', 1, 13),
(3, '19760719 200801 2 017', 2, 14),
(4, '19911110 202203 1 008', 2, 15),
(5, '19890703 201903 1 015', 3, 16),
(6, '19930827 202203 2 012', 3, 17),
(7, '19910330 202203 1 004', 4, 18);

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` int(30) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL,
  `sks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `nama_matkul`, `sks`) VALUES
(1, 'Pemograman Mobile ', 3),
(2, 'Rekayasa Perangkat Lunak', 4),
(3, 'Sistem Informasi Geografis', 2),
(4, 'Pemograman Desktop', 1),
(5, 'Jaringan Komputer', 3),
(6, 'Pemograman Web Dinamis', 1),
(7, 'Desain Antar Muka', 1),
(8, 'Interaksi Manusia dan Komputer', 3),
(9, 'Perancangan Sistem Informasi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` varchar(50) NOT NULL,
  `ruang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `ruang`) VALUES
('C101', 'A'),
('C102', 'A / B'),
('E201', 'LAB MOBILE'),
('E206', 'LAB SI'),
('E301', 'LAB P1'),
('E302', 'LAB 2'),
('E303', 'LAB JARINGAN 2'),
('E304', 'LAB.JARINGAN 1'),
('E306', 'LAB.MULTIMEDIA');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_thn_ajaran` int(11) NOT NULL,
  `thn_ajaran` varchar(255) NOT NULL,
  `semester` enum('genap','ganjil') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_thn_ajaran`, `thn_ajaran`, `semester`) VALUES
(1, '2022/2023', 'ganjil'),
(2, '2023/2024', 'genap');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `foto` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('pimpinan','adm','dosen','mhs') NOT NULL,
  `last_login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`foto`, `email`, `username`, `password`, `level`, `last_login`) VALUES
('', 'aldoerianda@gmail.com', 'aldoerianda', '202cb962ac59075b964b07152d234b70', 'dosen', ''),
('', 'anjelimasrizalputri@gmail.com', 'anjelimasrizalputri', '202cb962ac59075b964b07152d234b70', 'mhs', ''),
('', 'ArdianFirosha@gmail.com', 'Ardian Firosha', '202cb962ac59075b964b07152d234b70', 'dosen', ''),
('', 'ariamardiah@gmail.com', 'ariamardiah', '202cb962ac59075b964b07152d234b70', 'mhs', '2024-01-10 10:35:03'),
('', 'as@gmail.com', 'as', '202cb962ac59075b964b07152d234b70', 'dosen', ''),
('', 'basmida@gmail.com', 'Basmida Laia', '202cb962ac59075b964b07152d234b70', 'mhs', ''),
('', 'bimo@gmail.com', 'Bimo Surya Prima', '202cb962ac59075b964b07152d234b70', 'mhs', ''),
('', 'bintangsuhel@gmail.com', 'Bintang Suhel', '202cb962ac59075b964b07152d234b70', 'mhs', ''),
('', 'Defni@gmail.com', 'Defni', '202cb962ac59075b964b07152d234b70', 'dosen', ''),
('', 'DeniSatria@gmail.com', 'Deni Satria', '202cb962ac59075b964b07152d234b70', 'dosen', ''),
('', 'fannisukma@gmail.com', 'fannisukma', '202cb962ac59075b964b07152d234b70', 'dosen', '2024-01-10 10:53:31'),
('', 'fauzan@gmail.com', 'Fauzan Syakhira', '202cb962ac59075b964b07152d234b70', 'mhs', ''),
('', 'fitratul@gmail.com', 'Fitratul Hayati', '202cb962ac59075b964b07152d234b70', 'mhs', ''),
('', 'harfebifryonanda@gmail.com', 'harfebifryonanda', '202cb962ac59075b964b07152d234b70', 'dosen', ''),
('', 'HendraRotama@gmail.com', 'Hendra Rotama', '202cb962ac59075b964b07152d234b70', 'dosen', ''),
('', 'IdevaGaputra@gmail.com', 'Ideva Gaputra', '202cb962ac59075b964b07152d234b70', 'dosen', '2024-01-10 09:14:34'),
('', 'Larsa@gamil.com', 'Larsa Zalona Illahi', '202cb962ac59075b964b07152d234b70', 'mhs', ''),
('', 'lili@gmail.com', 'Lili Nur Aulia', '202cb962ac59075b964b07152d234b70', 'mhs', ''),
('', 'linus@gmail.com', 'Linus Dimbau', '202cb962ac59075b964b07152d234b70', 'mhs', ''),
('', 'mar@gmail.com', 'mar', 'c4ca4238a0b923820dcc509a6f75849b', 'adm', '2024-01-10 10:23:21'),
('', 'nuruliqma@gmail.com', 'Nurul Iqma', '202cb962ac59075b964b07152d234b70', 'mhs', ''),
('', 'RahmiPutriKurnia@gmail.com', 'Rahmi Putri Kurnia', '202cb962ac59075b964b07152d234b70', 'dosen', '2024-01-10 01:04:27'),
('', 'RitaAfyenni@gmail.com', 'Rita Afyenni', '202cb962ac59075b964b07152d234b70', 'dosen', ''),
('', 'ronalhadi@gmail.com', 'ronalhadi', '202cb962ac59075b964b07152d234b70', 'pimpinan', ''),
('', 'roniputra@gmail.com', 'roniputra', '202cb962ac59075b964b07152d234b70', 'dosen', '2024-01-10 07:52:25'),
('', 'UlyaIlhamiArsyah@gamil.com', 'Ulya Ilhami Arsyah', '202cb962ac59075b964b07152d234b70', 'dosen', ''),
('', 'wirda@gmail.com', 'Wirda Nissa', '202cb962ac59075b964b07152d234b70', 'mhs', ''),
('', 'YoriAdiAtma@gmail.com', 'Yori Adi Atma', '202cb962ac59075b964b07152d234b70', 'dosen', ''),
('', 'yulherniwati@gmail.com', 'yulherniwati', '202cb962ac59075b964b07152d234b70', 'dosen', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_ruang` (`id_ruang`),
  ADD KEY `id_hari` (`id_hari`),
  ADD KEY `id_matdos` (`id_matdos`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_thn_ajaran` (`id_thn_ajaran`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `username` (`username`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `matdos`
--
ALTER TABLE `matdos`
  ADD PRIMARY KEY (`id_matdos`),
  ADD KEY `id_matkul` (`id_matkul`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_thn_ajaran`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `matdos`
--
ALTER TABLE `matdos`
  MODIFY `id_matdos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id_matkul` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_thn_ajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`);

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_hari`) REFERENCES `hari` (`id_hari`),
  ADD CONSTRAINT `jadwal_ibfk_6` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`),
  ADD CONSTRAINT `jadwal_ibfk_7` FOREIGN KEY (`id_matdos`) REFERENCES `matdos` (`id_matdos`),
  ADD CONSTRAINT `jadwal_ibfk_8` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_thn_ajaran`) REFERENCES `tahun_ajaran` (`id_thn_ajaran`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `mahasiswa_ibfk_3` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `matdos`
--
ALTER TABLE `matdos`
  ADD CONSTRAINT `matdos_ibfk_1` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`),
  ADD CONSTRAINT `matdos_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`),
  ADD CONSTRAINT `matdos_ibfk_3` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
