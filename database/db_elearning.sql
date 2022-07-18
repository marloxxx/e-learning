-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 18, 2022 at 01:47 AM
-- Server version: 8.0.28
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_d_detail_soal`
--

CREATE TABLE `tb_d_detail_soal` (
  `id_detail_soal` bigint UNSIGNED NOT NULL,
  `id_soal` bigint UNSIGNED NOT NULL,
  `opsi_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_opsi_1` int DEFAULT NULL,
  `opsi_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_opsi_2` int DEFAULT NULL,
  `opsi_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_opsi_3` int DEFAULT NULL,
  `opsi_4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_opsi_4` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_d_jawaban`
--

CREATE TABLE `tb_d_jawaban` (
  `id_siswa` bigint UNSIGNED NOT NULL,
  `id_soal` bigint UNSIGNED NOT NULL,
  `jawaban` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_d_konten`
--

CREATE TABLE `tb_d_konten` (
  `id_konten` bigint UNSIGNED NOT NULL,
  `id_submateri` bigint UNSIGNED NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_d_nilai`
--

CREATE TABLE `tb_d_nilai` (
  `id_siswa` bigint UNSIGNED NOT NULL,
  `id_kuis` bigint UNSIGNED NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_admin`
--

CREATE TABLE `tb_m_admin` (
  `id_admin` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_m_admin`
--

INSERT INTO `tb_m_admin` (`id_admin`, `nama`, `email`, `username`, `password`, `photo`) VALUES
(1, 'Admin', 'admin@mail.com', 'admin', '$2y$10$9j/Jjl9.rVl5Xaln42dePOdUYSJ0sR4Ny0mZUEMT9L9AFyVx8KfUW', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_guru`
--

CREATE TABLE `tb_m_guru` (
  `id_guru` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_kelas`
--

CREATE TABLE `tb_m_kelas` (
  `id_kelas` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_kuis`
--

CREATE TABLE `tb_m_kuis` (
  `id_kuis` bigint UNSIGNED NOT NULL,
  `id_materi` bigint UNSIGNED NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_soal` int NOT NULL,
  `status` enum('acak','urut') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'acak',
  `waktu_mulai` datetime NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_mapel`
--

CREATE TABLE `tb_m_mapel` (
  `id_mapel` bigint UNSIGNED NOT NULL,
  `id_kelas` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_materi`
--

CREATE TABLE `tb_m_materi` (
  `id_materi` bigint UNSIGNED NOT NULL,
  `id_mapel` bigint UNSIGNED NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_siswa`
--

CREATE TABLE `tb_m_siswa` (
  `id_siswa` bigint UNSIGNED NOT NULL,
  `id_kelas` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nisn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_r_soal`
--

CREATE TABLE `tb_r_soal` (
  `id_soal` bigint UNSIGNED NOT NULL,
  `id_kuis` bigint UNSIGNED NOT NULL,
  `pertanyaan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_r_submateri`
--

CREATE TABLE `tb_r_submateri` (
  `id_submateri` bigint UNSIGNED NOT NULL,
  `id_materi` bigint UNSIGNED NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_d_detail_soal`
--
ALTER TABLE `tb_d_detail_soal`
  ADD PRIMARY KEY (`id_detail_soal`),
  ADD KEY `tb_d_detail_soal_id_soal_foreign` (`id_soal`);

--
-- Indexes for table `tb_d_jawaban`
--
ALTER TABLE `tb_d_jawaban`
  ADD KEY `tb_d_jawaban_siswa_id_siswa_foreign` (`id_siswa`),
  ADD KEY `tb_d_jawaban_siswa_id_soal_foreign` (`id_soal`);

--
-- Indexes for table `tb_d_konten`
--
ALTER TABLE `tb_d_konten`
  ADD PRIMARY KEY (`id_konten`),
  ADD KEY `tb_d_konten_id_submateri_foreign` (`id_submateri`);

--
-- Indexes for table `tb_d_nilai`
--
ALTER TABLE `tb_d_nilai`
  ADD KEY `tb_d_nilai_id_siswa_foreign` (`id_siswa`),
  ADD KEY `tb_d_nilai_id_kuis_foreign` (`id_kuis`);

--
-- Indexes for table `tb_m_admin`
--
ALTER TABLE `tb_m_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `tb_m_admin_email_unique` (`email`),
  ADD UNIQUE KEY `tb_m_admin_username_unique` (`username`);

--
-- Indexes for table `tb_m_guru`
--
ALTER TABLE `tb_m_guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `tb_m_guru_username_unique` (`username`),
  ADD UNIQUE KEY `tb_m_guru_nip_unique` (`nip`),
  ADD UNIQUE KEY `tb_m_guru_email_unique` (`email`);

--
-- Indexes for table `tb_m_kelas`
--
ALTER TABLE `tb_m_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_m_kuis`
--
ALTER TABLE `tb_m_kuis`
  ADD PRIMARY KEY (`id_kuis`),
  ADD KEY `tb_m_kuis_id_materi_foreign` (`id_materi`);

--
-- Indexes for table `tb_m_mapel`
--
ALTER TABLE `tb_m_mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `tb_m_mapel_id_kelas_foreign` (`id_kelas`);

--
-- Indexes for table `tb_m_materi`
--
ALTER TABLE `tb_m_materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `tb_m_materi_id_mapel_foreign` (`id_mapel`);

--
-- Indexes for table `tb_m_siswa`
--
ALTER TABLE `tb_m_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `tb_m_siswa_username_unique` (`username`),
  ADD UNIQUE KEY `tb_m_siswa_nisn_unique` (`nisn`),
  ADD UNIQUE KEY `tb_m_siswa_email_unique` (`email`),
  ADD KEY `tb_m_siswa_id_kelas_foreign` (`id_kelas`);

--
-- Indexes for table `tb_r_soal`
--
ALTER TABLE `tb_r_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `tb_r_soal_id_kuis_foreign` (`id_kuis`);

--
-- Indexes for table `tb_r_submateri`
--
ALTER TABLE `tb_r_submateri`
  ADD PRIMARY KEY (`id_submateri`),
  ADD KEY `tb_r_submateri_id_materi_foreign` (`id_materi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_d_detail_soal`
--
ALTER TABLE `tb_d_detail_soal`
  MODIFY `id_detail_soal` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_d_konten`
--
ALTER TABLE `tb_d_konten`
  MODIFY `id_konten` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_m_admin`
--
ALTER TABLE `tb_m_admin`
  MODIFY `id_admin` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_m_guru`
--
ALTER TABLE `tb_m_guru`
  MODIFY `id_guru` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_m_kelas`
--
ALTER TABLE `tb_m_kelas`
  MODIFY `id_kelas` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_m_kuis`
--
ALTER TABLE `tb_m_kuis`
  MODIFY `id_kuis` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_m_mapel`
--
ALTER TABLE `tb_m_mapel`
  MODIFY `id_mapel` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_m_materi`
--
ALTER TABLE `tb_m_materi`
  MODIFY `id_materi` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_m_siswa`
--
ALTER TABLE `tb_m_siswa`
  MODIFY `id_siswa` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_r_soal`
--
ALTER TABLE `tb_r_soal`
  MODIFY `id_soal` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_r_submateri`
--
ALTER TABLE `tb_r_submateri`
  MODIFY `id_submateri` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_d_detail_soal`
--
ALTER TABLE `tb_d_detail_soal`
  ADD CONSTRAINT `tb_d_detail_soal_id_soal_foreign` FOREIGN KEY (`id_soal`) REFERENCES `tb_r_soal` (`id_soal`) ON DELETE CASCADE;

--
-- Constraints for table `tb_d_jawaban`
--
ALTER TABLE `tb_d_jawaban`
  ADD CONSTRAINT `tb_d_jawaban_siswa_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `tb_m_siswa` (`id_siswa`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_d_jawaban_siswa_id_soal_foreign` FOREIGN KEY (`id_soal`) REFERENCES `tb_r_soal` (`id_soal`) ON DELETE CASCADE;

--
-- Constraints for table `tb_d_konten`
--
ALTER TABLE `tb_d_konten`
  ADD CONSTRAINT `tb_d_konten_id_submateri_foreign` FOREIGN KEY (`id_submateri`) REFERENCES `tb_r_submateri` (`id_submateri`) ON DELETE CASCADE;

--
-- Constraints for table `tb_d_nilai`
--
ALTER TABLE `tb_d_nilai`
  ADD CONSTRAINT `tb_d_nilai_id_kuis_foreign` FOREIGN KEY (`id_kuis`) REFERENCES `tb_m_kuis` (`id_kuis`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_d_nilai_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `tb_m_siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Constraints for table `tb_m_kuis`
--
ALTER TABLE `tb_m_kuis`
  ADD CONSTRAINT `tb_m_kuis_id_materi_foreign` FOREIGN KEY (`id_materi`) REFERENCES `tb_m_materi` (`id_materi`) ON DELETE CASCADE;

--
-- Constraints for table `tb_m_mapel`
--
ALTER TABLE `tb_m_mapel`
  ADD CONSTRAINT `tb_m_mapel_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `tb_m_kelas` (`id_kelas`) ON DELETE CASCADE;

--
-- Constraints for table `tb_m_materi`
--
ALTER TABLE `tb_m_materi`
  ADD CONSTRAINT `tb_m_materi_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `tb_m_mapel` (`id_mapel`) ON DELETE CASCADE;

--
-- Constraints for table `tb_m_siswa`
--
ALTER TABLE `tb_m_siswa`
  ADD CONSTRAINT `tb_m_siswa_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `tb_m_kelas` (`id_kelas`);

--
-- Constraints for table `tb_r_soal`
--
ALTER TABLE `tb_r_soal`
  ADD CONSTRAINT `tb_r_soal_id_kuis_foreign` FOREIGN KEY (`id_kuis`) REFERENCES `tb_m_kuis` (`id_kuis`) ON DELETE CASCADE;

--
-- Constraints for table `tb_r_submateri`
--
ALTER TABLE `tb_r_submateri`
  ADD CONSTRAINT `tb_r_submateri_id_materi_foreign` FOREIGN KEY (`id_materi`) REFERENCES `tb_m_materi` (`id_materi`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
