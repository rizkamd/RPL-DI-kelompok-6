-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table carent.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `notelp` varchar(255) NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table carent.accounts: ~0 rows (approximately)
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- Dumping structure for table carent.data_mobil
CREATE TABLE IF NOT EXISTS `data_mobil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_polisi` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `jenis_mobil` varchar(50) NOT NULL,
  `harga_rental` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table carent.data_mobil: ~0 rows (approximately)
/*!40000 ALTER TABLE `data_mobil` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_mobil` ENABLE KEYS */;

-- Dumping structure for table carent.data_rental
CREATE TABLE IF NOT EXISTS `data_rental` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_acc` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `waktu_rental` datetime(6) NOT NULL,
  `total_harga` int(255) NOT NULL,
  `keterangan` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_data_rental_accounts` (`id_acc`),
  CONSTRAINT `FK_data_rental_accounts` FOREIGN KEY (`id_acc`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table carent.data_rental: ~0 rows (approximately)
/*!40000 ALTER TABLE `data_rental` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_rental` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
