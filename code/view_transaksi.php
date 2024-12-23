<?php
require 'koneksi.php';

// Ambil semua data transaksi
$query = "SELECT t.id_trans_penjualan_produk, t.tgl_penjualan, t.total_bayar, t.metode_penjualan 
          FROM transaksi_penjualan_produk t
          ORDER BY t.id_trans_penjualan_produk ASC";
$trns = tampil($query);
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

    <div class="container mt-4">
        <h3>Data Transaksi Penjualan</h3>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Transaksi</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($trns)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data transaksi</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($trns as $data): ?>
                        <tr>
                            <td><?= htmlspecialchars($data['id_trans_penjualan_produk']) ?></td>
                            <td><?= ($data['tgl_penjualan'] != '0000-00-00') ? date('d/m/Y', strtotime($data['tgl_penjualan'])) : '-' ?></td>
                            <td class="text-right"><?= formatRp($data['total_bayar']) ?></td>
                            <td><?= htmlspecialchars($data['metode_penjualan']) ?></td>
                            <td>
                                <?php if ($data['total_bayar'] > 0): ?>
                                    <a href="detailtransaksi.php?id=<?= $data['id_trans_penjualan_produk'] ?>" 
                                       class="btn btn-sm btn-info">Lihat Detail</a>
                                <?php else: ?>
                                    <span class="badge badge-warning">Belum Selesai</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="form.php" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
