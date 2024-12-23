<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi = $_POST['id_transaksi'];
    $id_produk = $_POST['id_produk'];

    // Hapus data dari tabel detail pembelian
    $query = "DELETE FROM detail_pembelian WHERE Id_pembelian = '$id_transaksi' AND Id_produk = '$id_produk'";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Metode tidak didukung']);
}
?>
