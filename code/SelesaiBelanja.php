<?php
require 'koneksi.php';

$id_transaksi = $_GET['id_transaksi'] ?? null;

// Validasi ID transaksi
if (!$id_transaksi) {
    die("Error: ID transaksi tidak ditemukan.");
}

// Cek apakah transaksi dapat diselesaikan
if (SelesaiBelanja($id_transaksi) > 0) {
    // Redirect ke form.php untuk transaksi baru
    echo "
    <script>
        alert('Transaksi berhasil diselesaikan!');
        document.location.href = 'form.php?selesai=true';
    </script>";
} else {
    echo "
    <script>
        alert('Transaksi gagal diselesaikan! Pastikan transaksi memiliki detail.');
        document.location.href = 'form.php';
    </script>";
}
?>
