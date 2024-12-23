<?php
// Koneksi ke database
require 'koneksi.php';

// Ambil nomor transaksi saat ini
$id_transaksi = AmbilIdTransaksi();
if (isset($_POST["submit"])) {
    // Insert detail transaksi
    InsertDetail();
    echo "
    <script>
        alert('Barang berhasil ditambahkan!');
        document.location.href = 'formTransaksi.php';
    </script>
    ";
} else {

    $detail = GetDataDetailTransaksi($id_transaksi);
    echo "
    <script>
        alert('Tidak ada data yang ditambahkan!');
        document.location.href = 'form.php';
    </script>
    ";
}
?>