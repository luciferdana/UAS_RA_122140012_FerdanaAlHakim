<?php
// Koneksi ke database
require 'koneksi.php'; 
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID transaksi dari parameter URL
$id = $_GET["id"] ?? null;

// Validasi ID transaksi
if (!$id) {
    die("Error: ID transaksi tidak ditemukan.");
}

// Ambil data transaksi
$queryTransaksi = "SELECT id_trans_penjualan_produk, tgl_penjualan 
                   FROM transaksi_penjualan_produk 
                   WHERE id_trans_penjualan_produk = '$id'";
$resultTransaksi = mysqli_query($conn, $queryTransaksi);

if (!$resultTransaksi || mysqli_num_rows($resultTransaksi) == 0) {
    die("Error: Data transaksi tidak ditemukan.");
}

$dataTransaksi = mysqli_fetch_assoc($resultTransaksi);

// Ambil total transaksi dan detail transaksi
$nominal = GetTotalTransaksi($id);
$detail = GetDataDetailTransaksi($id); // Mengambil detail transaksi
?>
<html>
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">MyApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_transaksi.php">Lihat Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h3>Data Detail Transaksi Penjualan</h3>
        <div class="form-group">
            <label>No Transaksi</label>
            <input type="text" name="no_transaksi" class="form-control" 
                   value="<?= htmlspecialchars($dataTransaksi['id_trans_penjualan_produk']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Tanggal Transaksi</label>
            <input type="text" class="form-control" name="tgl" 
                   value="<?= htmlspecialchars($dataTransaksi['tgl_penjualan']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Total Transaksi</label>
            <input type="text" class="form-control" 
                   value="<?= formatRp($nominal); ?>" readonly>
        </div>
        <h4>Detail Transaksi</h4>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No Transaksi</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($detail)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada detail transaksi.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($detail as $data): ?>
                        <tr>
                            <td><?= htmlspecialchars($dataTransaksi['id_trans_penjualan_produk']); ?></td>
                            <td><?= htmlspecialchars($data['Id_produk']); ?></td>
                            <td><?= htmlspecialchars($data['Nama_produk']); ?></td>
                            <td><?= formatRp($data['Harga_Satuan']); ?></td>
                            <td><?= htmlspecialchars($data['Jumlah']); ?></td>
                            <td align="right"><?= formatRp($data['subtotal']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="view_transaksi.php" class="btn btn-info" role="button">Kembali</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" 
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" 
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" 
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
            crossorigin="anonymous"></script>
</body>
</html>
