-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for perpustakaan
CREATE DATABASE IF NOT EXISTS `perpustakaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `perpustakaan`;

-- Dumping structure for table perpustakaan.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `jabatan` varchar(256) NOT NULL,
  `no_hp` varchar(256) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  PRIMARY KEY (`id_admin`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table perpustakaan.admin: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id_admin`, `email`, `password`, `nama`, `jabatan`, `no_hp`, `alamat`) VALUES
  (1, 'admin@admin.com', '$2y$12$gV9fhaXJweufSX7aSujLcuEqt08EUTFoyDg9taa38Qgo6m6NII7va', 'Admin Default', 'Admin', '0411-454123', 'Jl. Perintis'),
  (5, 'rhadi.indrawankkpi@gmail.com', '$2y$12$AmuatGLvupAxS0aA4Nk50O1O8rxZtI6HWQQ7ocfOuYmkBJnol0WdG', 'Rhadi Indrawan', 'Bos', '085255554789', 'Pongtiku');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table perpustakaan.tb_anggota
CREATE TABLE IF NOT EXISTS `tb_anggota` (
  `kode_agt` varchar(200) NOT NULL,
  `nama_agt` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `jkl_agt` varchar(200) DEFAULT NULL,
  `no_telp` varchar(200) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  PRIMARY KEY (`kode_agt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table perpustakaan.tb_anggota: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_anggota` DISABLE KEYS */;
INSERT INTO `tb_anggota` (`kode_agt`, `nama_agt`, `email`, `password`, `jkl_agt`, `no_telp`, `alamat`, `foto`) VALUES
  ('AGT1193917745', 'hulk', 'hulk.hulk@gmail.com', '$2y$12$/M9rbIboZHE9.bk8oHt5iuXBeAoK2zmNBjrYCemswXUa6FrME79Ii', 'L', '085255554789', 'Jl. pongtiku I', '262575709WhatsApp Image 2022-05-31 at 16.13.11.jpeg');
/*!40000 ALTER TABLE `tb_anggota` ENABLE KEYS */;

-- Dumping structure for table perpustakaan.tb_buku
CREATE TABLE IF NOT EXISTS `tb_buku` (
  `kode_buku` varchar(50) NOT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `penulis` varchar(50) DEFAULT NULL,
  `penerbit` varchar(50) DEFAULT NULL,
  `thn_terbit` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `id_rak` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table perpustakaan.tb_buku: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_buku` DISABLE KEYS */;
INSERT INTO `tb_buku` (`kode_buku`, `judul`, `penulis`, `penerbit`, `thn_terbit`, `stok`, `id_rak`) VALUES
  ('BOOK1277307004', 'Kapal Pecah', 'Rhadi', 'erlangga', 2020, 200, 5),
  ('BOOK628597328', 'pedoman manusia', 'rhadi', 'erlangga', 2020, 40, 6),
  ('BOOK79825963', 'Resep Makanan', 'Ahmad', 'erlangga', 2019, 50, 1);
/*!40000 ALTER TABLE `tb_buku` ENABLE KEYS */;

-- Dumping structure for table perpustakaan.tb_peminjaman
CREATE TABLE IF NOT EXISTS `tb_peminjaman` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `kode_buku` varchar(50) DEFAULT NULL,
  `kode_agt` varchar(200) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`),
  KEY `kode_buku` (`kode_buku`),
  KEY `kode_agt` (`kode_agt`),
  KEY `id_petugas` (`id_admin`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table perpustakaan.tb_peminjaman: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_peminjaman` DISABLE KEYS */;
INSERT INTO `tb_peminjaman` (`id_peminjaman`, `tgl_pinjam`, `tgl_kembali`, `kode_buku`, `kode_agt`, `id_admin`) VALUES
  (8, '2022-06-19', '2022-06-21', 'BOOK1277307004', 'AGT1193917745', 5),
  (9, '2022-06-19', '2022-06-21', 'BOOK628597328', 'AGT1193917745', 5),
  (10, '2022-06-19', '2022-06-21', 'BOOK79825963', 'AGT1193917745', 5);
/*!40000 ALTER TABLE `tb_peminjaman` ENABLE KEYS */;

-- Dumping structure for table perpustakaan.tb_pengembalian
CREATE TABLE IF NOT EXISTS `tb_pengembalian` (
  `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `tgl_dikembalikan` date DEFAULT NULL,
  `denda` double DEFAULT NULL,
  `kode_buku` varchar(50) DEFAULT NULL,
  `kode_agt` varchar(200) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pengembalian`),
  KEY `kode_buku` (`kode_buku`),
  KEY `kode_agt` (`kode_agt`),
  KEY `id_petugas` (`id_admin`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table perpustakaan.tb_pengembalian: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_pengembalian` DISABLE KEYS */;
INSERT INTO `tb_pengembalian` (`id_pengembalian`, `tgl_pinjam`, `tgl_kembali`, `tgl_dikembalikan`, `denda`, `kode_buku`, `kode_agt`, `id_admin`) VALUES
  (5, '2022-06-19', '2022-06-18', '2022-06-19', 1000, 'BOOK1277307004', 'AGT1193917745', 5),
  (6, '2022-06-19', '2022-06-21', '2022-06-19', 0, 'BOOK79825963', 'AGT1193917745', 5);
/*!40000 ALTER TABLE `tb_pengembalian` ENABLE KEYS */;

-- Dumping structure for table perpustakaan.tb_rak
CREATE TABLE IF NOT EXISTS `tb_rak` (
  `id_rak` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rak` varchar(150) DEFAULT NULL,
  `lokasi_rak` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_rak`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table perpustakaan.tb_rak: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_rak` DISABLE KEYS */;
INSERT INTO `tb_rak` (`id_rak`, `nama_rak`, `lokasi_rak`) VALUES
  (1, 'ilmu sains', 'di depan'),
  (5, 'ilmu geologi', 'di depan'),
  (6, 'ilmu agama', 'di depan');
/*!40000 ALTER TABLE `tb_rak` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
