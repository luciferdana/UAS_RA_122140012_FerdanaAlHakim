<?php
require 'koneksi.php';

global $conn;

// Ambil input dari form
$id_transaksi = $_POST['id_transaksi'];
$id_produk = $_POST['id_produk'];
$jumlah = $_POST['jumlah'];

// Validasi input
if (empty($id_transaksi) || empty($id_produk) || empty($jumlah)) {
    echo json_encode(["success" => false, "error" => "Error: Pastikan semua data telah diisi."]);
    exit;
}

// Periksa apakah ID transaksi ada di tabel pembelian
$queryCheckPembelian = "SELECT Id_pembelian FROM pembelian WHERE Id_pembelian = '$id_transaksi'";
$resultCheckPembelian = mysqli_query($conn, $queryCheckPembelian);

if (!$resultCheckPembelian || mysqli_num_rows($resultCheckPembelian) == 0) {
    // Jika tidak ada, tambahkan data ke tabel pembelian
    $queryInsertPembelian = "INSERT INTO pembelian (Id_pembelian, Tgl_pembelian, total_bayar)
                             VALUES ('$id_transaksi', NOW(), 0)";
    if (!mysqli_query($conn, $queryInsertPembelian)) {
        echo json_encode(["success" => false, "error" => "Error: Gagal menambahkan data ke tabel pembelian. " . mysqli_error($conn)]);
        exit;
    }
}

// Ambil harga produk
$queryProduk = "SELECT Harga_produk FROM produk WHERE id_produk = '$id_produk'";
$resultProduk = mysqli_query($conn, $queryProduk);

if (!$resultProduk || mysqli_num_rows($resultProduk) == 0) {
    echo json_encode(["success" => false, "error" => "Error: Produk dengan ID '$id_produk' tidak ditemukan."]);
    exit;
}

$produk = mysqli_fetch_assoc($resultProduk);
$harga = $produk['Harga_produk'];
$subtotal = $jumlah * $harga;

// Masukkan detail transaksi
$queryInsertDetail = "INSERT INTO detail_pembelian (Id_pembelian, Harga_Satuan, Jumlah, tanggal, Id_produk)
                       VALUES ('$id_transaksi', '$harga', '$jumlah', NOW(), '$id_produk')";
if (!mysqli_query($conn, $queryInsertDetail)) {
    echo json_encode(["success" => false, "error" => "Error: Gagal memasukkan detail transaksi. " . mysqli_error($conn)]);
    exit;
}

// Perbarui total bayar di tabel pembelian
$queryUpdateTotal = "UPDATE pembelian
                     SET total_bayar = (SELECT SUM(Harga_Satuan * Jumlah) 
                                        FROM detail_pembelian WHERE Id_pembelian = '$id_transaksi')
                     WHERE Id_pembelian = '$id_transaksi'";
if (!mysqli_query($conn, $queryUpdateTotal)) {
    echo json_encode(["success" => false, "error" => "Error: Gagal memperbarui total bayar. " . mysqli_error($conn)]);
    exit;
}

// Jika semua sukses
echo json_encode(["success" => true, "message" => "Detail transaksi berhasil ditambahkan."]);
?>
