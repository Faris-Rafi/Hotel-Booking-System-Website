-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 03:47 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mfarisrafi_dbhotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `mfarisrafi_fasilitas_hotel`
--

CREATE TABLE `mfarisrafi_fasilitas_hotel` (
  `mfarisrafi_id_hotel` int(11) NOT NULL,
  `mfarisrafi_nama_fasilitas` varchar(255) NOT NULL,
  `mfarisrafi_keterangan` varchar(255) NOT NULL,
  `mfarisrafi_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mfarisrafi_fasilitas_hotel`
--

INSERT INTO `mfarisrafi_fasilitas_hotel` (`mfarisrafi_id_hotel`, `mfarisrafi_nama_fasilitas`, `mfarisrafi_keterangan`, `mfarisrafi_foto`) VALUES
(11, 'Restoran', 'Restoran Berada Di Lantai paling bawah hotel. Nikmati Restoran dengan Hidangan Bintang 5. Buka 24 Jam.', 'IMG62317632d245e3.61609308_restoran.jpg'),
(12, 'Kolam Renang', 'Kolam Renang Buka 24 Jam.', 'IMG62481e55682696.03266740_kolam-renang.jpg'),
(15, 'Free Wifi', 'Free Wifi disini.', '');

-- --------------------------------------------------------

--
-- Table structure for table `mfarisrafi_kamar`
--

CREATE TABLE `mfarisrafi_kamar` (
  `mfarisrafi_id_kamar` int(11) NOT NULL,
  `mfarisrafi_no_kamar` varchar(255) NOT NULL,
  `mfarisrafi_id_tipe` int(11) NOT NULL,
  `mfarisrafi_status` varchar(255) NOT NULL,
  `mfarisrafi_lantai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mfarisrafi_kamar`
--

INSERT INTO `mfarisrafi_kamar` (`mfarisrafi_id_kamar`, `mfarisrafi_no_kamar`, `mfarisrafi_id_tipe`, `mfarisrafi_status`, `mfarisrafi_lantai`) VALUES
(2, 'ROOM-002', 1, 'Tersedia', '2'),
(3, 'ROOM-003', 1, 'Tersedia', '2'),
(4, 'ROOM-004', 1, 'Tersedia', '2'),
(5, 'ROOM-005', 1, 'Tersedia', '2'),
(6, 'ROOM-006', 2, 'Tersedia', '3'),
(7, 'ROOM-007', 2, 'Tersedia', '3'),
(8, 'ROOM-008', 2, 'Tersedia', '3'),
(9, 'ROOM-009', 2, 'Tersedia', '3'),
(10, 'ROOM-010', 2, 'Tersedia', '3'),
(11, 'ROOM-011', 3, 'Tersedia', '4'),
(12, 'ROOM-012', 3, 'Tersedia', '4'),
(13, 'ROOM-013', 3, 'Tersedia', '4'),
(14, 'ROOM-014', 3, 'Tersedia', '4'),
(15, 'ROOM-015', 3, 'Tersedia', '4'),
(16, 'ROOM-016', 18, 'Tersedia', '5'),
(17, 'ROOM-017', 18, 'Tersedia', '5'),
(18, 'ROOM-018', 18, 'Tersedia', '5'),
(23, 'ROOM-001', 1, 'Tersedia', '2'),
(24, 'ROOM-019', 21, 'Tersedia', '6'),
(25, 'ROOM-020', 21, 'Tersedia', '6');

-- --------------------------------------------------------

--
-- Table structure for table `mfarisrafi_pertanyaan`
--

CREATE TABLE `mfarisrafi_pertanyaan` (
  `mfarisrafi_id_contact` int(11) NOT NULL,
  `mfarisrafi_nama` varchar(255) NOT NULL,
  `mfarisrafi_email` varchar(255) NOT NULL,
  `mfarisrafi_pertanyaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mfarisrafi_reservasi`
--

CREATE TABLE `mfarisrafi_reservasi` (
  `mfarisrafi_id_reservasi` int(11) NOT NULL,
  `mfarisrafi_no_reservasi` int(11) NOT NULL,
  `mfarisrafi_kode_reservasi` varchar(255) NOT NULL,
  `mfarisrafi_no_identitas` int(255) NOT NULL,
  `mfarisrafi_nama_pemesan` varchar(255) NOT NULL,
  `mfarisrafi_email_tamu` varchar(255) NOT NULL,
  `mfarisrafi_no_tlp_tamu` varchar(255) NOT NULL,
  `mfarisrafi_check_in` date NOT NULL,
  `mfarisrafi_check_out` date NOT NULL,
  `mfarisrafi_jumlah_kamar` int(11) NOT NULL,
  `mfarisrafi_jumlah_tamu` int(11) NOT NULL,
  `mfarisrafi_pesan` varchar(255) NOT NULL,
  `mfarisrafi_id_tipe` int(11) NOT NULL,
  `mfarisrafi_status` varchar(255) NOT NULL,
  `mfarisrafi_total` varchar(255) NOT NULL,
  `mfarisrafi_sisa_pembayaran` varchar(255) NOT NULL,
  `mfarisrafi_kembalian` varchar(255) NOT NULL,
  `mfarisrafi_status_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mfarisrafi_reservasi`
--

INSERT INTO `mfarisrafi_reservasi` (`mfarisrafi_id_reservasi`, `mfarisrafi_no_reservasi`, `mfarisrafi_kode_reservasi`, `mfarisrafi_no_identitas`, `mfarisrafi_nama_pemesan`, `mfarisrafi_email_tamu`, `mfarisrafi_no_tlp_tamu`, `mfarisrafi_check_in`, `mfarisrafi_check_out`, `mfarisrafi_jumlah_kamar`, `mfarisrafi_jumlah_tamu`, `mfarisrafi_pesan`, `mfarisrafi_id_tipe`, `mfarisrafi_status`, `mfarisrafi_total`, `mfarisrafi_sisa_pembayaran`, `mfarisrafi_kembalian`, `mfarisrafi_status_pembayaran`) VALUES
(212, 1534307231, 'RSV-001', 2147483647, 'rees', 'rees@gmail.com', '0896215372132', '2022-04-04', '2022-04-06', 1, 1, '', 1, 'Checked Out', '2400000', '0', '0', 'Sudah Bayar'),
(213, 760463883, 'RSV-002', 2147483647, 'Muhammad Faris Rafi', 'faris@gmail.com', '0896127632513', '2022-04-04', '2022-04-05', 1, 1, '', 1, 'Checked Out', '1200000', '0', '0', 'Sudah Bayar'),
(214, 1020280267, 'RSV-003', 2147483647, 'FarisRafi', 'rees@gmail.com', '0896128357123', '2022-04-04', '2022-04-05', 1, 1, '', 1, 'Checked Out', '1200000', '0', '0', 'Sudah Bayar'),
(215, 572530490, 'RSV-004', 2147483647, 'Muhammad Faris Rafi', 'farisrafi@gmail.com', '0896127352513', '2022-04-04', '2022-04-06', 2, 4, '', 3, 'Checked Out', '9600000', '0', '0', 'Sudah Bayar'),
(216, 572530490, 'RSV-004', 2147483647, 'Muhammad Faris Rafi', 'farisrafi@gmail.com', '0896127352513', '2022-04-04', '2022-04-06', 2, 4, '', 3, 'Checked Out', '9600000', '0', '0', 'Sudah Bayar');

-- --------------------------------------------------------

--
-- Table structure for table `mfarisrafi_reserved_room`
--

CREATE TABLE `mfarisrafi_reserved_room` (
  `mfarisrafi_id` int(11) NOT NULL,
  `mfarisrafi_id_reservasi` int(11) NOT NULL,
  `mfarisrafi_kode_reservasi` varchar(255) NOT NULL,
  `mfarisrafi_no_kamar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mfarisrafi_role`
--

CREATE TABLE `mfarisrafi_role` (
  `mfarisrafi_id_role` int(11) NOT NULL,
  `mfarisrafi_jenis_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mfarisrafi_role`
--

INSERT INTO `mfarisrafi_role` (`mfarisrafi_id_role`, `mfarisrafi_jenis_role`) VALUES
(1, 'Administrator'),
(2, 'Resepsionis');

-- --------------------------------------------------------

--
-- Table structure for table `mfarisrafi_site_settings`
--

CREATE TABLE `mfarisrafi_site_settings` (
  `mfarisrafi_id` int(11) NOT NULL,
  `mfarisrafi_foto1` varchar(255) NOT NULL,
  `mfarisrafi_foto2` varchar(255) NOT NULL,
  `mfarisrafi_foto3` varchar(255) NOT NULL,
  `mfarisrafi_cap1` varchar(255) NOT NULL,
  `mfarisrafi_cap2` varchar(255) NOT NULL,
  `mfarisrafi_cap3` varchar(255) NOT NULL,
  `mfarisrafi_about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mfarisrafi_site_settings`
--

INSERT INTO `mfarisrafi_site_settings` (`mfarisrafi_id`, `mfarisrafi_foto1`, `mfarisrafi_foto2`, `mfarisrafi_foto3`, `mfarisrafi_cap1`, `mfarisrafi_cap2`, `mfarisrafi_cap3`, `mfarisrafi_about`) VALUES
(1, 'SLIDE624ab4f8976dd9.90119809_restoran.jpg', 'SLIDE624ab4f897d009.98320093_standard-room.jpg', 'SLIDE624aa755b4a778.15496762_kolam-renang.jpg', 'Halo', 'Hebat', 'Hotel', '<h2><strong>Lorem Ipsum</strong></h2><p>lorem ipsum is simply dummy text</p>');

-- --------------------------------------------------------

--
-- Table structure for table `mfarisrafi_tamu`
--

CREATE TABLE `mfarisrafi_tamu` (
  `mfarisrafi_no_identitas` varchar(255) NOT NULL,
  `mfarisrafi_nama_tamu` varchar(255) NOT NULL,
  `mfarisrafi_email_tamu` varchar(255) NOT NULL,
  `mfarisrafi_username` varchar(255) NOT NULL,
  `mfarisrafi_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mfarisrafi_tamu`
--

INSERT INTO `mfarisrafi_tamu` (`mfarisrafi_no_identitas`, `mfarisrafi_nama_tamu`, `mfarisrafi_email_tamu`, `mfarisrafi_username`, `mfarisrafi_password`) VALUES
('1234567891011121', 'faris', 'faris@gmail.com', 'faris', '202cb962ac59075b964b07152d234b70'),
('1012983011222222', 'Muhammad Faris Rafi', 'farisrafi@gmail.com', 'rees', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `mfarisrafi_tipe_kamar`
--

CREATE TABLE `mfarisrafi_tipe_kamar` (
  `mfarisrafi_id_tipe` int(11) NOT NULL,
  `mfarisrafi_tipe_kamar` varchar(255) NOT NULL,
  `mfarisrafi_deskripsi` varchar(255) NOT NULL,
  `mfarisrafi_foto` varchar(255) NOT NULL,
  `mfarisrafi_fasilitas` varchar(255) NOT NULL,
  `mfarisrafi_harga` varchar(255) NOT NULL,
  `mfarisrafi_maksimal_tamu` int(11) NOT NULL,
  `mfarisrafi_jumlah_bed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mfarisrafi_tipe_kamar`
--

INSERT INTO `mfarisrafi_tipe_kamar` (`mfarisrafi_id_tipe`, `mfarisrafi_tipe_kamar`, `mfarisrafi_deskripsi`, `mfarisrafi_foto`, `mfarisrafi_fasilitas`, `mfarisrafi_harga`, `mfarisrafi_maksimal_tamu`, `mfarisrafi_jumlah_bed`) VALUES
(1, 'Single Room', 'Single room Adalah Ruangan bertipe single.', 'IMG62283ba4d68aa5.87165511.jpg', '- Single Bed - TV LED - Bathroom - Free Wifi -', '1200000', 2, 5),
(2, 'Standard Room', 'Standard Room Adalah Ruangan kedua diatas single room dengan kasur queen size.', 'IMG623172897f4988.55813117_standard-room.jpg', '- Queen Size Bed - TV LED - Bathroom - Free Wifi -', '1600000', 5, 5),
(3, 'Superior Room', 'Superior Room adalah ruangan diatas standard room dengan kasur king size.', 'IMG6231754e8c82b7.84394324_superior-room.jpg', '- King Size Bed - TV LED - Bathroom - Beautiful Scenery - Free Wifi -', '2400000', 8, 5),
(18, 'Deluxe Room', 'Deluxe Room adalah Ruangan Mewah diatas superior dengan 2 kasur king size', 'IMG62317557ccbfa1.81099144_Deluxe-room.jpg', '- 2 King Size Bed - TV LED - Bathroom - Beautiful Scenery - Refrigenerator - Free Wifi -', '3000000', 10, 3),
(21, 'Suite Room', 'Suite Room Adalah Ruangan Mewah diatas Deluxe dengan dapur dan 2 ruangan di satu kamar.', 'IMG6231756083c337.62610548_image3-slideshow.jpg', '- 2 Rooms - 2 King Size Bed - TV LED - Bathroom - Beautiful Scenery - Refrigenerator - Kitchen - Free Wifi -', '4000000', 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mfarisrafi_user`
--

CREATE TABLE `mfarisrafi_user` (
  `mfarisrafi_id_user` int(11) NOT NULL,
  `mfarisrafi_id_role` int(11) NOT NULL,
  `mfarisrafi_nama_user` varchar(255) NOT NULL,
  `mfarisrafi_email_user` varchar(255) NOT NULL,
  `mfarisrafi_username_user` varchar(255) NOT NULL,
  `mfarisrafi_password_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mfarisrafi_user`
--

INSERT INTO `mfarisrafi_user` (`mfarisrafi_id_user`, `mfarisrafi_id_role`, `mfarisrafi_nama_user`, `mfarisrafi_email_user`, `mfarisrafi_username_user`, `mfarisrafi_password_user`) VALUES
(1, 1, 'Muhammad Faris Rafi', 'mfarisrafi048@gmail.com', 'rees', '202cb962ac59075b964b07152d234b70'),
(6, 1, 'Elon Musk', 'elonmusk@gmail.com', 'elon', '20f0c1df4b5003502b57619fee44b169'),
(7, 2, 'Jeff Bezos', 'jeffbezos@gmail.com', 'jeff', '83b3335d71138a7d33a1d9ea63e19fba'),
(10, 2, 'Steve Jobs', 'stevejobs4@gmail.com', 'steve', '27a06a9e3d5e7f67eb604a39536208c9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mfarisrafi_fasilitas_hotel`
--
ALTER TABLE `mfarisrafi_fasilitas_hotel`
  ADD PRIMARY KEY (`mfarisrafi_id_hotel`);

--
-- Indexes for table `mfarisrafi_kamar`
--
ALTER TABLE `mfarisrafi_kamar`
  ADD PRIMARY KEY (`mfarisrafi_id_kamar`),
  ADD KEY `mfarisrafi_id_tipe` (`mfarisrafi_id_tipe`),
  ADD KEY `mfarisrafi_no_kamar` (`mfarisrafi_no_kamar`);

--
-- Indexes for table `mfarisrafi_pertanyaan`
--
ALTER TABLE `mfarisrafi_pertanyaan`
  ADD PRIMARY KEY (`mfarisrafi_id_contact`);

--
-- Indexes for table `mfarisrafi_reservasi`
--
ALTER TABLE `mfarisrafi_reservasi`
  ADD PRIMARY KEY (`mfarisrafi_id_reservasi`),
  ADD KEY `mfarisrafi_id_tipe` (`mfarisrafi_id_tipe`),
  ADD KEY `mfarisrafi_email_tamu` (`mfarisrafi_email_tamu`),
  ADD KEY `mfarisrafi_kode_reservasi` (`mfarisrafi_kode_reservasi`);

--
-- Indexes for table `mfarisrafi_reserved_room`
--
ALTER TABLE `mfarisrafi_reserved_room`
  ADD PRIMARY KEY (`mfarisrafi_id`),
  ADD UNIQUE KEY `mfarisrafi_no_kamar_2` (`mfarisrafi_no_kamar`),
  ADD KEY `mfarisrafi_kode_reservasi` (`mfarisrafi_kode_reservasi`),
  ADD KEY `mfarisrafi_no_kamar` (`mfarisrafi_no_kamar`),
  ADD KEY `mfarisrafi_id_reservasi` (`mfarisrafi_id_reservasi`);

--
-- Indexes for table `mfarisrafi_role`
--
ALTER TABLE `mfarisrafi_role`
  ADD PRIMARY KEY (`mfarisrafi_id_role`);

--
-- Indexes for table `mfarisrafi_site_settings`
--
ALTER TABLE `mfarisrafi_site_settings`
  ADD PRIMARY KEY (`mfarisrafi_id`);

--
-- Indexes for table `mfarisrafi_tamu`
--
ALTER TABLE `mfarisrafi_tamu`
  ADD PRIMARY KEY (`mfarisrafi_email_tamu`);

--
-- Indexes for table `mfarisrafi_tipe_kamar`
--
ALTER TABLE `mfarisrafi_tipe_kamar`
  ADD PRIMARY KEY (`mfarisrafi_id_tipe`);

--
-- Indexes for table `mfarisrafi_user`
--
ALTER TABLE `mfarisrafi_user`
  ADD PRIMARY KEY (`mfarisrafi_id_user`),
  ADD KEY `mfarisrafi_id_role` (`mfarisrafi_id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mfarisrafi_fasilitas_hotel`
--
ALTER TABLE `mfarisrafi_fasilitas_hotel`
  MODIFY `mfarisrafi_id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mfarisrafi_kamar`
--
ALTER TABLE `mfarisrafi_kamar`
  MODIFY `mfarisrafi_id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mfarisrafi_pertanyaan`
--
ALTER TABLE `mfarisrafi_pertanyaan`
  MODIFY `mfarisrafi_id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mfarisrafi_reservasi`
--
ALTER TABLE `mfarisrafi_reservasi`
  MODIFY `mfarisrafi_id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `mfarisrafi_reserved_room`
--
ALTER TABLE `mfarisrafi_reserved_room`
  MODIFY `mfarisrafi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `mfarisrafi_role`
--
ALTER TABLE `mfarisrafi_role`
  MODIFY `mfarisrafi_id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mfarisrafi_site_settings`
--
ALTER TABLE `mfarisrafi_site_settings`
  MODIFY `mfarisrafi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mfarisrafi_tipe_kamar`
--
ALTER TABLE `mfarisrafi_tipe_kamar`
  MODIFY `mfarisrafi_id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `mfarisrafi_user`
--
ALTER TABLE `mfarisrafi_user`
  MODIFY `mfarisrafi_id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mfarisrafi_kamar`
--
ALTER TABLE `mfarisrafi_kamar`
  ADD CONSTRAINT `mfarisrafi_kamar_ibfk_1` FOREIGN KEY (`mfarisrafi_id_tipe`) REFERENCES `mfarisrafi_tipe_kamar` (`mfarisrafi_id_tipe`);

--
-- Constraints for table `mfarisrafi_reservasi`
--
ALTER TABLE `mfarisrafi_reservasi`
  ADD CONSTRAINT `mfarisrafi_reservasi_ibfk_1` FOREIGN KEY (`mfarisrafi_id_tipe`) REFERENCES `mfarisrafi_tipe_kamar` (`mfarisrafi_id_tipe`);

--
-- Constraints for table `mfarisrafi_reserved_room`
--
ALTER TABLE `mfarisrafi_reserved_room`
  ADD CONSTRAINT `mfarisrafi_reserved_room_ibfk_2` FOREIGN KEY (`mfarisrafi_kode_reservasi`) REFERENCES `mfarisrafi_reservasi` (`mfarisrafi_kode_reservasi`),
  ADD CONSTRAINT `mfarisrafi_reserved_room_ibfk_3` FOREIGN KEY (`mfarisrafi_id_reservasi`) REFERENCES `mfarisrafi_reservasi` (`mfarisrafi_id_reservasi`),
  ADD CONSTRAINT `mfarisrafi_reserved_room_ibfk_4` FOREIGN KEY (`mfarisrafi_no_kamar`) REFERENCES `mfarisrafi_kamar` (`mfarisrafi_no_kamar`);

--
-- Constraints for table `mfarisrafi_user`
--
ALTER TABLE `mfarisrafi_user`
  ADD CONSTRAINT `mfarisrafi_user_ibfk_1` FOREIGN KEY (`mfarisrafi_id_role`) REFERENCES `mfarisrafi_role` (`mfarisrafi_id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
