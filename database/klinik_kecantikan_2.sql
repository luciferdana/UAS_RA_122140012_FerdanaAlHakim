/*
 Navicat Premium Data Transfer

 Source Server         : server-laragon
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : klinik_kecantikan_2

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 23/12/2024 20:55:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for coa
-- ----------------------------
DROP TABLE IF EXISTS `coa`;
CREATE TABLE `coa`  (
  `Kode_akun` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Nama_akun` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Kode_akun`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coa
-- ----------------------------
INSERT INTO `coa` VALUES ('101', 'kas');
INSERT INTO `coa` VALUES ('102', 'persediaan barang dagang');
INSERT INTO `coa` VALUES ('103', 'piutang usaha');
INSERT INTO `coa` VALUES ('104', 'penyisihan piutang usaha');
INSERT INTO `coa` VALUES ('106', 'Perlengkapan');
INSERT INTO `coa` VALUES ('107', 'sewa dibayar dimuka');
INSERT INTO `coa` VALUES ('108', 'asuransi di bayar dimuka');
INSERT INTO `coa` VALUES ('109', 'iklan di bayar dimuka');
INSERT INTO `coa` VALUES ('110', 'piutang dagang');
INSERT INTO `coa` VALUES ('111', 'peralatan');
INSERT INTO `coa` VALUES ('112', 'akumulasi peny peralatan');
INSERT INTO `coa` VALUES ('210', 'utang dagang');
INSERT INTO `coa` VALUES ('411', 'penjualan');
INSERT INTO `coa` VALUES ('413', 'diskon penjualan');
INSERT INTO `coa` VALUES ('414', 'retur penjualan');
INSERT INTO `coa` VALUES ('510', 'pembelian');
INSERT INTO `coa` VALUES ('511', 'retur pembelian');
INSERT INTO `coa` VALUES ('512', 'diskon pembelian');
INSERT INTO `coa` VALUES ('520', 'beban transportasi');
INSERT INTO `coa` VALUES ('521', 'beban transport penjualan');

-- ----------------------------
-- Table structure for detail_pembelian
-- ----------------------------
DROP TABLE IF EXISTS `detail_pembelian`;
CREATE TABLE `detail_pembelian`  (
  `Id_pembelian` int NOT NULL,
  `Harga_Satuan` int NULL DEFAULT NULL,
  `Jumlah` int NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `Id_produk` int NULL DEFAULT NULL,
  `Id_vendor` int NULL DEFAULT NULL,
  INDEX `fk_pembelian_produk`(`Id_produk` ASC) USING BTREE,
  INDEX `fk_pembelian_vendor`(`Id_vendor` ASC) USING BTREE,
  INDEX `fk_pembelian`(`Id_pembelian` ASC) USING BTREE,
  CONSTRAINT `fk_pembelian` FOREIGN KEY (`Id_pembelian`) REFERENCES `pembelian` (`Id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pembelian_produk` FOREIGN KEY (`Id_produk`) REFERENCES `produk` (`Id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pembelian_vendor` FOREIGN KEY (`Id_vendor`) REFERENCES `vendor` (`id_vendor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_pembelian
-- ----------------------------
INSERT INTO `detail_pembelian` VALUES (221, 2500000, 100, '2021-05-19', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (222, 3000000, 250, '2021-06-06', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (223, 3500000, 150, '2022-07-08', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (224, 4500000, 125, '2023-10-17', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (225, 5500000, 375, '2022-04-15', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (226, 6750000, 395, '2023-09-22', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (227, 8000000, 400, '2023-12-19', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (221, 2500000, 100, '2021-05-19', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (222, 3000000, 250, '2021-06-06', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (223, 3500000, 150, '2022-07-08', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (224, 4500000, 125, '2023-10-17', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (225, 5500000, 375, '2022-04-15', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (226, 6750000, 395, '2023-09-22', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (227, 8000000, 400, '2023-12-19', NULL, NULL);
INSERT INTO `detail_pembelian` VALUES (11125, 199000, 2, '2024-12-22', 1003, NULL);
INSERT INTO `detail_pembelian` VALUES (11127, 201000, 2, '2024-12-22', 1002, NULL);
INSERT INTO `detail_pembelian` VALUES (11128, 160000, 2, '2024-12-22', 1010, NULL);
INSERT INTO `detail_pembelian` VALUES (11145, 160000, 12, '2024-12-22', 1015, NULL);
INSERT INTO `detail_pembelian` VALUES (11145, 160000, 12, '2024-12-22', 1015, NULL);
INSERT INTO `detail_pembelian` VALUES (11147, 201000, 1, '2024-12-22', 1007, NULL);
INSERT INTO `detail_pembelian` VALUES (11168, 100000, 2, '2024-12-23', 1001, NULL);
INSERT INTO `detail_pembelian` VALUES (11168, 100000, 2, '2024-12-23', 1001, NULL);
INSERT INTO `detail_pembelian` VALUES (11168, 160000, 2, '2024-12-23', 1010, NULL);
INSERT INTO `detail_pembelian` VALUES (11175, 201000, 2, '2024-12-23', 1002, NULL);
INSERT INTO `detail_pembelian` VALUES (11175, 201000, 2, '2024-12-23', 1002, NULL);
INSERT INTO `detail_pembelian` VALUES (11175, 199000, 2, '2024-12-23', 1003, NULL);
INSERT INTO `detail_pembelian` VALUES (11175, 100000, 1, '2024-12-23', 1001, NULL);
INSERT INTO `detail_pembelian` VALUES (11175, 201000, 1, '2024-12-23', 1012, NULL);
INSERT INTO `detail_pembelian` VALUES (11178, 90000, 2, '2024-12-23', 1009, NULL);

-- ----------------------------
-- Table structure for jasaperawatan
-- ----------------------------
DROP TABLE IF EXISTS `jasaperawatan`;
CREATE TABLE `jasaperawatan`  (
  `id_jasa_perawatan` int NOT NULL AUTO_INCREMENT,
  `nama_perawatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_perawatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_perawatan` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_jasa_perawatan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jasaperawatan
-- ----------------------------
INSERT INTO `jasaperawatan` VALUES (201, 'Acne', 'Facial ', 6750000);
INSERT INTO `jasaperawatan` VALUES (202, 'Perawatan Rambut  ', 'Creambath', 2500000);
INSERT INTO `jasaperawatan` VALUES (204, 'Acne', 'Scar Treatment', 3450000);
INSERT INTO `jasaperawatan` VALUES (205, 'Acne', 'Comedo Peeling', 495000);
INSERT INTO `jasaperawatan` VALUES (206, 'Brightening', 'Glow Glam Program', 1800000);
INSERT INTO `jasaperawatan` VALUES (2024, 'brightening', 'crystal clear program', 1500000);
INSERT INTO `jasaperawatan` VALUES (2025, 'brightening', 'crystal glow peeling', 2000000);
INSERT INTO `jasaperawatan` VALUES (2026, 'anti aging', 'shape your love prorgram', 3487000);
INSERT INTO `jasaperawatan` VALUES (2027, 'perawatan rambut', 'anti hair fall program', 1700000);
INSERT INTO `jasaperawatan` VALUES (2028, 'perawatan rambut', 'DNA salmon therapy', 3500000);

-- ----------------------------
-- Table structure for jurnal_pembelian
-- ----------------------------
DROP TABLE IF EXISTS `jurnal_pembelian`;
CREATE TABLE `jurnal_pembelian`  (
  `id_jurnal_pembelian` int NOT NULL AUTO_INCREMENT,
  `id_pembelian` int NULL DEFAULT NULL,
  `posisi_dr_cr` enum('Debit','Kredit') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nominal` int NOT NULL,
  `kode_akun` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_jurnal_pembelian`) USING BTREE,
  INDEX `id_pembelian`(`id_pembelian` ASC) USING BTREE,
  INDEX `fk_kode_akun`(`kode_akun` ASC) USING BTREE,
  CONSTRAINT `fk_kode_akun` FOREIGN KEY (`kode_akun`) REFERENCES `coa` (`Kode_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jurnal_pembelian_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `detail_pembelian` (`Id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jurnal_pembelian
-- ----------------------------

-- ----------------------------
-- Table structure for jurnal_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `jurnal_penjualan`;
CREATE TABLE `jurnal_penjualan`  (
  `id_jurnal_penjualan` int NOT NULL AUTO_INCREMENT,
  `posisi_dr_cr` enum('Debit','Kredit') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nominal` int NOT NULL,
  `kode_akun` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_penjualan` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_jurnal_penjualan`) USING BTREE,
  INDEX `fk_kode_akun_penjualan`(`kode_akun` ASC) USING BTREE,
  INDEX `fk_penjualan`(`id_penjualan` ASC) USING BTREE,
  CONSTRAINT `fk_kode_akun_penjualan` FOREIGN KEY (`kode_akun`) REFERENCES `coa` (`Kode_akun`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jurnal_penjualan
-- ----------------------------

-- ----------------------------
-- Table structure for konsumen
-- ----------------------------
DROP TABLE IF EXISTS `konsumen`;
CREATE TABLE `konsumen`  (
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Nama_konsumen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Alamat` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `No_telepon` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of konsumen
-- ----------------------------
INSERT INTO `konsumen` VALUES ('alice.wong@email.com', 'Alice Wong', 'Jl. Mawar No. 10, Medan', '082334455667');
INSERT INTO `konsumen` VALUES ('jane.smith@email.com', 'Jane Smith', 'Jl. Melati No. 5, Bandung', '081987654321');
INSERT INTO `konsumen` VALUES ('john.doe@email.com', 'John Doe', 'Jl. Anggrek No. 12, Jakarta', '081234567890');
INSERT INTO `konsumen` VALUES ('mike.brown@email.com', 'Mike Brown', 'Jl. Cemara No. 3, Yogyakarta', '081556677889');
INSERT INTO `konsumen` VALUES ('tom.hardy@email.com', 'Tom Hardy', 'Jl. Kenanga No. 8, Surabaya', '082112345678');

-- ----------------------------
-- Table structure for pembelian
-- ----------------------------
DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian`  (
  `Id_pembelian` int NOT NULL AUTO_INCREMENT,
  `Tgl_pembelian` date NOT NULL,
  `total_bayar` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_pembelian`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11147 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pembelian
-- ----------------------------
INSERT INTO `pembelian` VALUES (221, '2022-01-25', 20000000);
INSERT INTO `pembelian` VALUES (222, '2022-01-25', 20000000);
INSERT INTO `pembelian` VALUES (223, '2022-06-09', 45000000);
INSERT INTO `pembelian` VALUES (224, '2023-06-19', 55600000);
INSERT INTO `pembelian` VALUES (225, '2023-08-29', 60000000);
INSERT INTO `pembelian` VALUES (226, '2024-07-25', 50000000);
INSERT INTO `pembelian` VALUES (227, '2024-11-17', 87000000);
INSERT INTO `pembelian` VALUES (228, '2024-12-12', 90000000);
INSERT INTO `pembelian` VALUES (11125, '2024-12-22', 398000);
INSERT INTO `pembelian` VALUES (11127, '2024-12-22', 402000);
INSERT INTO `pembelian` VALUES (11128, '2024-12-22', 320000);
INSERT INTO `pembelian` VALUES (11145, '2024-12-22', 3840000);
INSERT INTO `pembelian` VALUES (11147, '2024-12-22', 201000);
INSERT INTO `pembelian` VALUES (11168, '2024-12-23', 720000);
INSERT INTO `pembelian` VALUES (11175, '2024-12-23', 1503000);
INSERT INTO `pembelian` VALUES (11177, '2024-12-23', 900000);
INSERT INTO `pembelian` VALUES (11178, '2024-12-23', 381000);

-- ----------------------------
-- Table structure for penggajianperawat
-- ----------------------------
DROP TABLE IF EXISTS `penggajianperawat`;
CREATE TABLE `penggajianperawat`  (
  `id_gaji` int NOT NULL AUTO_INCREMENT,
  `id_perawat` int NULL DEFAULT NULL,
  `tanggal_pembayaran_gaji` date NULL DEFAULT NULL,
  `jumlah_gaji_pokok` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_gaji`) USING BTREE,
  INDEX `fk_penggajian_perawat`(`id_perawat` ASC) USING BTREE,
  CONSTRAINT `fk_penggajian_perawat` FOREIGN KEY (`id_perawat`) REFERENCES `perawat` (`Id_Perawat`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penggajianperawat
-- ----------------------------
INSERT INTO `penggajianperawat` VALUES (1101, 1, '2024-12-01', 5800000);
INSERT INTO `penggajianperawat` VALUES (1102, 2, '2024-12-02', 6000000);
INSERT INTO `penggajianperawat` VALUES (1103, 4, '2024-12-03', 7000000);
INSERT INTO `penggajianperawat` VALUES (1104, 4, '2024-12-04', 2500000);
INSERT INTO `penggajianperawat` VALUES (1105, 5, '2024-12-05', 2622040);

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan`  (
  `id_penjualan` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_trans_penjualan_produk` int NULL DEFAULT NULL,
  `Id_transperawatan` int NULL DEFAULT NULL,
  `total_jual` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`) USING BTREE,
  INDEX `fk_produk`(`id_trans_penjualan_produk` ASC) USING BTREE,
  INDEX `fk_perawatan`(`Id_transperawatan` ASC) USING BTREE,
  CONSTRAINT `fk_perawatan` FOREIGN KEY (`Id_transperawatan`) REFERENCES `transaksiperawatan` (`Id_transperawatan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_produk` FOREIGN KEY (`id_trans_penjualan_produk`) REFERENCES `transaksi_penjualan_produk` (`Id_trans_penjualan_produk`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penjualan
-- ----------------------------

-- ----------------------------
-- Table structure for perawat
-- ----------------------------
DROP TABLE IF EXISTS `perawat`;
CREATE TABLE `perawat`  (
  `Id_Perawat` int NOT NULL AUTO_INCREMENT,
  `Nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `No_telepon` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Gender` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Perawat`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of perawat
-- ----------------------------
INSERT INTO `perawat` VALUES (1, 'Lina Kartika', '081234567890', 'Perempuan');
INSERT INTO `perawat` VALUES (2, 'Dian Prasetyo', '081234567891', 'Laki-laki');
INSERT INTO `perawat` VALUES (3, 'Rina Saputri', '081234567892', 'Perempuan');
INSERT INTO `perawat` VALUES (4, 'Bayu Santoso', '081234567893', 'Laki-laki');
INSERT INTO `perawat` VALUES (5, 'Siti Nurhaliza', '081234567894', 'Perempuan');

-- ----------------------------
-- Table structure for presensi
-- ----------------------------
DROP TABLE IF EXISTS `presensi`;
CREATE TABLE `presensi`  (
  `id_Presensi` int NOT NULL AUTO_INCREMENT,
  `id_perawat` int NULL DEFAULT NULL,
  `tgl_presensi` date NULL DEFAULT NULL,
  `Keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_Presensi`) USING BTREE,
  INDEX `fk_presensi_perawat`(`id_perawat` ASC) USING BTREE,
  CONSTRAINT `fk_presensi_perawat` FOREIGN KEY (`id_perawat`) REFERENCES `perawat` (`Id_Perawat`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of presensi
-- ----------------------------

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `Id_produk` int NOT NULL AUTO_INCREMENT,
  `Nama_produk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Jenis_produk` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `satuan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Harga_produk` int NULL DEFAULT NULL,
  `Id_vendor` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_produk`) USING BTREE,
  INDEX `fk_id_vendor`(`Id_vendor` ASC) USING BTREE,
  CONSTRAINT `fk_id_vendor` FOREIGN KEY (`Id_vendor`) REFERENCES `vendor` (`id_vendor`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (1001, 'Acne Protection Sunscreen SPF 45 PA+++', 'Perawatan Wajah', '30g', 100000, 10113);
INSERT INTO `produk` VALUES (1002, 'Age Corrector Galatomyces & Prebiotic Essence', 'Perawatan Wajah', '100ml', 201000, 10111);
INSERT INTO `produk` VALUES (1003, 'ERHA Perfect Shield Active Light Sunscreen', 'Perawatan Wajah', '50ml', 199000, 10112);
INSERT INTO `produk` VALUES (1004, 'UltracalmPRO Multipurpose Calming Cream', 'Perawatan Rambu', '28g', 199000, 10113);
INSERT INTO `produk` VALUES (1005, 'Body Lotion', 'Perawatan Kulit', '100ml', 65000, 10112);
INSERT INTO `produk` VALUES (1006, 'Restore Damage Repair Hair Moisturizer', 'perawatan rambu', '200ml', 155000, 10112);
INSERT INTO `produk` VALUES (1007, 'Galactomyces & Prebiotic Essence', 'brightening', '100ml', 201000, 10113);
INSERT INTO `produk` VALUES (1008, 'Acne Guard Cream', 'acne', '20gr', 90000, 10111);
INSERT INTO `produk` VALUES (1009, 'Energy Bright Cream', 'brightening', '20gr', 90000, 10111);
INSERT INTO `produk` VALUES (1010, 'Acne Essence', 'acne', '20ml', 160000, 10112);
INSERT INTO `produk` VALUES (1011, 'Restore Damage Repair Hair Moisturizer', 'perawatan rambu', '200ml', 155000, 10113);
INSERT INTO `produk` VALUES (1012, 'Galactomyces & Prebiotic Essence', 'brightening', '100ml', 201000, 10111);
INSERT INTO `produk` VALUES (1013, 'Acne Guard Cream', 'acne', '20gr', 90000, 10113);
INSERT INTO `produk` VALUES (1014, 'Energy Bright Cream', 'brightening', '20gr', 90000, 10112);
INSERT INTO `produk` VALUES (1015, 'Acne Essence', 'acne', '20ml', 160000, 10111);

-- ----------------------------
-- Table structure for transaksi_penjualan_produk
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_penjualan_produk`;
CREATE TABLE `transaksi_penjualan_produk`  (
  `Id_trans_penjualan_produk` int NOT NULL AUTO_INCREMENT,
  `Metode_penjualan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Tgl_penjualan` date NULL DEFAULT NULL,
  `total_bayar` int NULL DEFAULT NULL,
  `Id_produk` int NULL DEFAULT NULL,
  `Jumlah` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_trans_penjualan_produk`) USING BTREE,
  INDEX `fk_transaksi_penjualan_produk`(`Id_produk` ASC) USING BTREE,
  CONSTRAINT `fk_transaksi_penjualan_produk` FOREIGN KEY (`Id_produk`) REFERENCES `produk` (`Id_produk`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 11155 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi_penjualan_produk
-- ----------------------------
INSERT INTO `transaksi_penjualan_produk` VALUES (11147, 'Tunai', '2024-12-22', 3000, 1010, 3);
INSERT INTO `transaksi_penjualan_produk` VALUES (11168, 'Tunai', '2024-12-23', 720000, NULL, NULL);
INSERT INTO `transaksi_penjualan_produk` VALUES (11175, 'Tunai', '2024-12-23', 1503000, NULL, NULL);
INSERT INTO `transaksi_penjualan_produk` VALUES (11178, 'Tunai', '2024-12-23', 0, NULL, NULL);

-- ----------------------------
-- Table structure for transaksiperawatan
-- ----------------------------
DROP TABLE IF EXISTS `transaksiperawatan`;
CREATE TABLE `transaksiperawatan`  (
  `Id_transperawatan` int NOT NULL AUTO_INCREMENT,
  `Tgl_Transaksi` date NOT NULL,
  `Subtotal` int NULL DEFAULT NULL,
  `Metode_Bayar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total_bayar` int NULL DEFAULT NULL,
  `Id_perawat` int NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Id_jasa_perawatan` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_transperawatan`) USING BTREE,
  INDEX `fk_perawat`(`Id_perawat` ASC) USING BTREE,
  INDEX `fk_konsumen`(`email` ASC) USING BTREE,
  INDEX `fk_jasaperawatan`(`Id_jasa_perawatan` ASC) USING BTREE,
  CONSTRAINT `fk_jasaperawatan` FOREIGN KEY (`Id_jasa_perawatan`) REFERENCES `jasaperawatan` (`id_jasa_perawatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_konsumen` FOREIGN KEY (`email`) REFERENCES `konsumen` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_perawat` FOREIGN KEY (`Id_perawat`) REFERENCES `perawat` (`Id_Perawat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksiperawatan
-- ----------------------------
INSERT INTO `transaksiperawatan` VALUES (1011, '2024-12-01', 50000, 'Debit', 50000, 1, 'john.doe@email.com', 201);
INSERT INTO `transaksiperawatan` VALUES (1012, '2024-12-02', 75000, 'Kredit', 75000, 5, 'jane.smith@email.com', 204);
INSERT INTO `transaksiperawatan` VALUES (1013, '2024-12-03', 100000, 'Debit', 100000, 3, 'alice.wong@email.com', 206);
INSERT INTO `transaksiperawatan` VALUES (1014, '2024-12-04', 45000, 'Kredit', 45000, 5, 'john.doe@email.com', 201);
INSERT INTO `transaksiperawatan` VALUES (1015, '2024-12-05', 120000, 'Kredit', 120000, 1, 'mike.brown@email.com', 201);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `terms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (6, 'Alfi Filsafalasafi', 'filsafalasafi@gmail.com', '$2y$10$LtQypYbjfKr1LmaksQXjAOb25VlYpxQAE4fevLrTUtSgwhMdSCA7.', 'Male', '1');
INSERT INTO `users` VALUES (7, 'Khusna', 'khusna@gmail.com', '$2y$10$hvw.24VsVlw23Sllk1msC.4D7.YAFu0NdWC42C26NiPcc7kGK1ciS', 'Male', '1');
INSERT INTO `users` VALUES (11, '', '', '$2y$10$plHvQPn1KOWZWtYBMpKRf.0hKD7Vn4CHFtjO651wrJCl3r5Kj7FWW', '', '0');
INSERT INTO `users` VALUES (14, 'Oi Capi Sayang', 'oicapisayang@gmail.com', '$2y$10$HQwt4SUnrmt7Lu7qDoDH6O5/mQBjbv0ylF2ZudJeOC9TI672awqqS', 'Male', '1');

-- ----------------------------
-- Table structure for vendor
-- ----------------------------
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor`  (
  `id_vendor` int NOT NULL AUTO_INCREMENT,
  `nama_vendor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_telepon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_vendor`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vendor
-- ----------------------------
INSERT INTO `vendor` VALUES (10111, 'PT. SKINSOL KOSMETIK INDUSTRI', 'Jl. Pahlawan No. 12, Bandung', '085678123456');
INSERT INTO `vendor` VALUES (10112, 'PT. ESTETIKA PRO INTERNASIONAL', 'Jl. Merdeka No. 99, Surabaya', '087654321098');
INSERT INTO `vendor` VALUES (10113, 'PT. ERHA CLINIC', 'Jl. Raya Kb. Jeruk No.25, Kota Jakarta Barat', '082112233445');

SET FOREIGN_KEY_CHECKS = 1;
