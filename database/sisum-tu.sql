-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2026 at 09:15 PM
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
-- Database: `sisum-tu`
--

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `tujuan_surat` varchar(150) NOT NULL,
  `perihal` text NOT NULL,
  `tgl_surat` date NOT NULL,
  `file_surat` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_ttd` int(11) DEFAULT 0,
  `id_surat` int(11) GENERATED ALWAYS AS (`id_surat_keluar`) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id_surat_keluar`, `no_surat`, `tujuan_surat`, `perihal`, `tgl_surat`, `file_surat`, `id_user`, `status_ttd`) VALUES
(1, '003/D-SK/TU-KM/VII/2026', 'Kepala Dinas Pemuda dan Olahraga', 'Permohonan Peminjaman GOR Pemuda Untuk Kegiatan Turnamen Rektor Cup', '2026-07-02', 'sk_003.pdf', 1, 0),
(2, '004/D-SK/TU-KM/VII/2026', 'Orang Tua/Wali Mahasiswa Angkatan 2024', 'Surat Edaran Pelaksanaan Herregistrasi dan Pembayaran UKT Semester Ganjil', '2026-07-06', 'sk_004.pdf', 1, 1),
(3, '005/D-SK/TU-KM/VII/2026', 'Pimpinan PT. GoTo Gojek Tokopedia', 'Undangan Menjadi Pembicara Utama (Keynote Speaker) dalam Seminar Nasional', '2026-07-09', 'BIZLOGIC.png', 1, 1),
(4, '3D2Y/V/08/2026', 'Dekan Fakultas Ekonomi', 'Turunkan UKT', '2026-07-10', 'ETS_UI-UX TEORI.docx', 2, 1),
(5, '3D2Y/V/08/2026', 'Mahasiswa', 'smwnya diyam', '2026-07-10', 'Modul SD.png', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `no_agenda` varchar(50) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `asal_surat` varchar(150) NOT NULL,
  `perihal` text NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_terima` date NOT NULL,
  `file_surat` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_surat` int(11) GENERATED ALWAYS AS (`id_surat_masuk`) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_surat_masuk`, `no_agenda`, `no_surat`, `asal_surat`, `perihal`, `tgl_surat`, `tgl_terima`, `file_surat`, `id_user`) VALUES
(1, '003/TU-M/2026', '120/B/LLDIKTI4/V/2026', 'LLDIKTI Wilayah IV', 'Undangan Sosialisasi Klusterisasi Perguruan Tinggi Swasta Tahun 2026', '2026-05-10', '2026-05-14', 'sm_003.pdf', 1),
(2, '004/TU-M/2026', '088/SPM/BAN-PT/VI/2026', 'Badan Akreditasi Nasional Perguruan Tinggi', 'Penyampaian SK Akreditasi Program Studi Teknik Informatika', '2026-06-02', '2026-06-05', 'sm_004.pdf', 1),
(3, '005/TU-M/2026', '015/HRD-PST/BANK-BJB/VI/2026', 'PT. Bank BJB Tbk. (Kantor Pusat)', 'Persetujuan Proposal Pengajuan Sponsorship Kegiatan Dies Natalis', '2026-06-11', '2026-06-13', 'sm_005.pdf', 1),
(4, '006/TU-M/2026', '992/UN-SUR/KRE-REK/VI/2026', 'Universitas Suryakancana', 'Permohonan Pertukaran Dosen Pembimbing Utama Jurnal Ilmiah', '2026-06-25', '2026-06-28', 'sm_006.pdf', 1),
(5, '007/TU-M/2026', '004/LSM-P/I/VII/2026', 'Lembaga Swadaya Masyarakat Peduli Pendidikan', 'Undangan Audiensi Terkait Program Beasiswa Siswa Kurang Mampu', '2026-07-01', '2026-07-04', 'sm_007.pdf', 1),
(6, '008/TU-M/2026', '211/DIR-OPS/TELKOM/VII/2026', 'PT. Telkom Indonesia', 'Pemberitahuan Jadwal Maintenance Jaringan Internet Kampus Pusat', '2026-07-08', '2026-07-10', 'sm_008.pdf', 1),
(7, '009/TU-M/2026', '3D2Y/V/08/2026', 'Mahasiswa', 'Turunkan UKT', '2026-07-11', '2026-07-10', '6a513e73a92a5.jpeg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `nip`, `role`, `last_login`) VALUES
(1, 'admin', 'admin123', 'Administrator Utama', '192837465', 'pimpinan', NULL),
(2, 'ruw', '$2y$10$qpADEfQUfeqPCFPOYhMDu.8pmSjq0cvHW3nWB80a9i9C/eSlEnWnO', 'rwan', '023124057', 'admin', '2026-07-11 02:05:40'),
(3, 'awa', '$2y$10$3otPTw7N48zPpWh/VktnSeOlQTG8GtBaWWlv9ElwaImm/lBnCsd7a', 'salwa', '06041997', 'staff', '2026-07-11 02:07:30'),
(4, 'law', '$2y$10$EgItszzyE5u20SLCq1tSYuURe0.fG6axRJ8Yrmx0XxEM8dktKydHO', 'Trafalgar Law', '1234567', 'pimpinan', '2026-07-11 02:04:14'),
(5, 'ada', '$2y$10$qlNSZzgpsKoNfRvNIHGi4ug8tgEleTeBdcGAmGnvyCbgVHX3M8rum', 'adalah pokoknya', '00234122', 'staff', '2026-07-11 02:08:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id_surat_keluar`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`),
  ADD UNIQUE KEY `no_agenda` (`no_agenda`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `surat_keluar_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL;

--
-- Constraints for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `surat_masuk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
