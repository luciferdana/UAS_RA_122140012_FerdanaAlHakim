<?php
require 'koneksi.php';
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Hapus transaksi kosong (tanpa detail)
$queryHapus = "DELETE FROM transaksi_penjualan_produk 
WHERE total_bayar = 0 
AND id_trans_penjualan_produk NOT IN 
(SELECT DISTINCT Id_pembelian FROM detail_pembelian)
AND TIMESTAMPDIFF(HOUR, tgl_penjualan, NOW()) > 1;
";
mysqli_query($conn, $queryHapus);

// Ambil ID transaksi aktif
$id_transaksi = AmbilIdTransaksi();

// Ambil data terkait transaksi
$nominal = GetTotalTransaksi($id_transaksi); // Total bayar transaksi
$produk = GetDataProduk(); // Data produk untuk dropdown
$detail = GetDataDetailTransaksi($id_transaksi); // Detail transaksi


?>


<html>
<head>
    <!-- Bootstrap CSS -->
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
        <h3>Transaksi Penjualan Produk</h3>
        <form id="formTambahDetail">
            <div class="form-group">
                <label>No Transaksi</label>
                <input type="text" name="id_transaksi" class="form-control" value="<?php echo $id_transaksi; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Tanggal Penjualan</label>
                <input type="text" class="form-control" name="tgl_penjualan" value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Nama Produk</label>
                <select name="id_produk" class="form-control" required id="produkDropdown">
    <option value="" disabled selected>Pilih Produk</option>
    <?php
    foreach ($produk as $data) {
        echo "<option value='" . $data['id_produk'] . "' data-harga='" . $data['Harga_produk'] . "'>" . $data['Nama_produk'] . "</option>";
    }
    ?>
</select>

            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" required min="1">
            </div>
            <div class="form-group">
                <label>Total Bayar</label>
                <input type="text" name="total_bayar" class="form-control" value="Rp 0" readonly>
            </div>
            <input type="submit" name="submit" value="Tambahkan" class="btn btn-primary">
        </form>

        <h4>Detail Transaksi</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>

</tbody>

        </table>
        <a href="SelesaiBelanja.php?id_transaksi=<?= $id_transaksi; ?>" class="btn btn-info" role="button">Selesai Belanja</a>
    </div>

    <script>
    document.querySelector('#produkDropdown').addEventListener('change', hitungTotal);
document.querySelector('input[name="jumlah"]').addEventListener('input', hitungTotal);

function hitungTotal() {
    const produk = document.querySelector('#produkDropdown');
    const hargaProduk = produk.selectedOptions[0]?.dataset.harga || 0;
    const jumlah = document.querySelector('input[name="jumlah"]').value;

    if (hargaProduk && jumlah) {
        const total = parseInt(hargaProduk) * parseInt(jumlah);
        document.querySelector('input[name="total_bayar"]').value = 'Rp ' + total.toLocaleString();
    } else {
        document.querySelector('input[name="total_bayar"]').value = 'Rp 0';
    }
}

    </script>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     function loadDetailTransaksi() {
            $.ajax({
                url: 'get_detail_transaksi.php', // Endpoint untuk mendapatkan detail transaksi
                type: 'GET',
                data: { id_transaksi: $('input[name="id_transaksi"]').val() },
                success: function (response) {
                    $('table tbody').html(response); // Perbarui isi tabel
                },
                error: function () {
                    alert('Gagal memuat detail transaksi.');
                }
            });
        }
    $(document).ready(function () {
        $('#formTambahDetail').on('submit', function (e) {
            e.preventDefault(); // Mencegah reload halaman
            const formData = $(this).serialize();

            $.ajax({
                url: 'api_tambah_detail.php', // Endpoint API
                type: 'POST',
                data: formData,
                success: function (response) {
                    const res = JSON.parse(response);
                    if (res.success) {
                        // Perbarui tabel detail
                        loadDetailTransaksi();
                    } else {
                        alert('Gagal menambahkan data: ' + res.error);
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan pada server.');
                }
            });
        });

        // Fungsi untuk memuat ulang tabel detail transaksi
       

        // Panggil fungsi loadDetailTransaksi pertama kali
        loadDetailTransaksi();
    });

    $(document).on('click', '.hapus', function () {
    const idProduk = $(this).data('id');
    const idTransaksi = $('input[name="id_transaksi"]').val();

    if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
        $.ajax({
            url: 'api_hapus_detail.php',
            type: 'POST',
            data: { id_transaksi: idTransaksi, id_produk: idProduk },
            success: function (response) {
                const res = JSON.parse(response);
                if (res.success) {
                    alert('Item berhasil dihapus.');
                    loadDetailTransaksi(); // Muat ulang tabel detail
                } else {
                    alert('Gagal menghapus item: ' + res.error);
                }
            },
            error: function () {
                alert('Terjadi kesalahan pada server.');
            }
        });
    }
});

</script>
</body>
</html>
