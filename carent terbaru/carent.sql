-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2021 at 04:32 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carent`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `buktipembayaranrental`
--

CREATE TABLE `buktipembayaranrental` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `foto` varchar(1000) DEFAULT NULL,
  `metode` varchar(50) DEFAULT NULL,
  `uniqueid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buktipembayaranrental`
--

INSERT INTO `buktipembayaranrental` (`id`, `id_customer`, `foto`, `metode`, `uniqueid`) VALUES
(8, 1, 'fotobukti_599041gambar.gif', '', '4935814'),
(9, 1, 'fotobukti_577094fotobukti_599041gambar.gif', '', '9262802'),
(11, 2, 'fotobukti_424467fotobukti_577094fotobukti_599041gambar.gif', '', '1110227');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '0',
  `alamat` varchar(50) NOT NULL DEFAULT '0',
  `notelp` varchar(50) NOT NULL DEFAULT '0',
  `ktp` varchar(1000) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama`, `username`, `password`, `alamat`, `notelp`, `ktp`) VALUES
(1, 'User', 'user', 'user', 'Wall Rose', '8112238495', 'fotoktp_700119Levi_Ackermann_(Anime)_character_image.png'),
(2, 'User2', 'user2', 'user2', 'Wall Rose', '123123123', 'fotoktp_155267Mikasa_Ackermann_(Anime)_character_image_(850).png');

-- --------------------------------------------------------

--
-- Table structure for table `metodepembayaran`
--

CREATE TABLE `metodepembayaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `norek` varchar(50) NOT NULL DEFAULT '0',
  `foto` varchar(1000) NOT NULL DEFAULT '0',
  `atasnama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metodepembayaran`
--

INSERT INTO `metodepembayaran` (`id`, `nama`, `norek`, `foto`, `atasnama`) VALUES
(1, 'Bank Mandiri', '123123123123', 'mandiri 2.png', 'Saniyah Nabila'),
(2, 'Bank BCA', '321321321321', 'bca 2.png', 'Saniyah Nabila'),
(3, 'Bank BNI', '456456456456', 'bni 2.png', 'Salsabila Adityani');

-- --------------------------------------------------------

--
-- Table structure for table `mobilkopling`
--

CREATE TABLE `mobilkopling` (
  `id` int(11) NOT NULL,
  `nopolisi` varchar(50) NOT NULL DEFAULT '0',
  `merk` varchar(50) NOT NULL DEFAULT '0',
  `harga12jam` int(11) NOT NULL DEFAULT 0,
  `harga24jam` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `foto` varchar(1000) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mobilkopling`
--

INSERT INTO `mobilkopling` (`id`, `nopolisi`, `merk`, `harga12jam`, `harga24jam`, `nama`, `foto`) VALUES
(1, 'D 4646 JKT', 'Datsun', 150000, 250000, 'Datsun GO Panca', 'fotoktp_352382datsun 1.png');

-- --------------------------------------------------------

--
-- Table structure for table `mobilmatic`
--

CREATE TABLE `mobilmatic` (
  `id` int(11) NOT NULL,
  `nopolisi` varchar(50) NOT NULL DEFAULT '0',
  `merk` varchar(50) NOT NULL DEFAULT '0',
  `harga12jam` int(11) NOT NULL DEFAULT 0,
  `harga24jam` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `foto` varchar(1000) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobilmatic`
--

INSERT INTO `mobilmatic` (`id`, `nopolisi`, `merk`, `harga12jam`, `harga24jam`, `nama`, `foto`) VALUES
(1, 'D 4848 JKT', 'Honda', 100000, 200000, 'Honda Brio', 'fotoktp_683208Unit_Honda-009 1.png');

-- --------------------------------------------------------

--
-- Table structure for table `paketkopling`
--

CREATE TABLE `paketkopling` (
  `id` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL DEFAULT 0,
  `id_supir` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `harga` int(11) NOT NULL DEFAULT 0,
  `durasi` int(11) NOT NULL DEFAULT 0,
  `foto` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paketkopling`
--

INSERT INTO `paketkopling` (`id`, `id_mobil`, `id_supir`, `nama`, `harga`, `durasi`, `foto`) VALUES
(1, 1, 1, 'Paket 12 Jam Kopling + Supir', 175000, 12, 'fotopaket_709889fotoktp_352382datsun 1.png'),
(2, 1, 3, 'Paket 24 Jam Kopling + Supir', 275000, 24, 'fotopaket_408278fotoktp_352382datsun 1.png');

-- --------------------------------------------------------

--
-- Table structure for table `paketmatic`
--

CREATE TABLE `paketmatic` (
  `id` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL DEFAULT 0,
  `id_supir` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `harga` int(11) NOT NULL DEFAULT 0,
  `durasi` int(11) NOT NULL DEFAULT 0,
  `foto` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `paketmatic`
--

INSERT INTO `paketmatic` (`id`, `id_mobil`, `id_supir`, `nama`, `harga`, `durasi`, `foto`) VALUES
(1, 1, 2, 'Paket 12 Jam Matic + Supir', 125000, 12, 'fotopaket_969781fotoktp_683208Unit_Honda-009 1.png'),
(2, 1, 3, 'Paket 24 Jam Matic + Supir', 250000, 24, 'fotopaket_668521fotoktp_683208Unit_Honda-009 1.png');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL DEFAULT 0,
  `id_barang` int(11) DEFAULT NULL,
  `durasi` int(11) NOT NULL DEFAULT 0,
  `tanggal` date NOT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `jenis` varchar(50) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT '0',
  `uniqueid` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`id`, `id_customer`, `id_barang`, `durasi`, `tanggal`, `harga`, `jenis`, `status`, `uniqueid`) VALUES
(2, 1, 1, 24, '2021-04-03', 250000, 'kopling', '2', '2131073'),
(7, 2, 2, 24, '2021-06-05', 12312312, 'matic', '2', '4294108'),
(8, 1, 1, 12, '2021-06-05', 100000, 'matic', '2', '4935814'),
(9, 1, 1, 24, '2021-06-09', 200000, 'matic', '2', '9262802'),
(11, 2, 2, 12, '2021-06-13', 275000, 'paketkopling', '2', '1110227');

-- --------------------------------------------------------

--
-- Table structure for table `supir`
--

CREATE TABLE `supir` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `kelamin` varchar(50) DEFAULT NULL,
  `foto` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supir`
--

INSERT INTO `supir` (`id`, `nama`, `umur`, `kelamin`, `foto`) VALUES
(1, 'Djatnika Widia', 21, 'pria', 'fotosupir_93108DaHyAGNU8AAXwtd.jpg'),
(2, 'Agung Cesario', 21, 'pria', 'fotosupir_849500Eren_Jaeger_(Anime)_character_image.png'),
(3, 'Rizka Marina', 21, 'wanita', 'fotosupir_282325Armin_Arlelt_(Anime)_character_image.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buktipembayaranrental`
--
ALTER TABLE `buktipembayaranrental`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_buktipembayaranrental_customer` (`id_customer`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metodepembayaran`
--
ALTER TABLE `metodepembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobilkopling`
--
ALTER TABLE `mobilkopling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobilmatic`
--
ALTER TABLE `mobilmatic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paketkopling`
--
ALTER TABLE `paketkopling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_paketkopling_mobilkopling` (`id_mobil`),
  ADD KEY `FK_paketkopling_supir` (`id_supir`);

--
-- Indexes for table `paketmatic`
--
ALTER TABLE `paketmatic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_paketmatic_mobilmatic` (`id_mobil`),
  ADD KEY `FK_paketmatic_supir` (`id_supir`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_rental_customer` (`id_customer`);

--
-- Indexes for table `supir`
--
ALTER TABLE `supir`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buktipembayaranrental`
--
ALTER TABLE `buktipembayaranrental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `metodepembayaran`
--
ALTER TABLE `metodepembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mobilkopling`
--
ALTER TABLE `mobilkopling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobilmatic`
--
ALTER TABLE `mobilmatic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paketkopling`
--
ALTER TABLE `paketkopling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paketmatic`
--
ALTER TABLE `paketmatic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supir`
--
ALTER TABLE `supir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buktipembayaranrental`
--
ALTER TABLE `buktipembayaranrental`
  ADD CONSTRAINT `FK_buktipembayaranrental_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`);

--
-- Constraints for table `paketkopling`
--
ALTER TABLE `paketkopling`
  ADD CONSTRAINT `FK_paketkopling_mobilkopling` FOREIGN KEY (`id_mobil`) REFERENCES `mobilkopling` (`id`),
  ADD CONSTRAINT `FK_paketkopling_supir` FOREIGN KEY (`id_supir`) REFERENCES `supir` (`id`);

--
-- Constraints for table `paketmatic`
--
ALTER TABLE `paketmatic`
  ADD CONSTRAINT `FK_paketmatic_mobilmatic` FOREIGN KEY (`id_mobil`) REFERENCES `mobilmatic` (`id`),
  ADD CONSTRAINT `FK_paketmatic_supir` FOREIGN KEY (`id_supir`) REFERENCES `supir` (`id`);

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `FK_rental_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
