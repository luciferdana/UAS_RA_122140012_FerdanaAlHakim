<?php
$conn = mysqli_connect("localhost", "root", "", "klinik_kecantikan_2");

if (!$conn) {
    die("Error: Koneksi ke database gagal. " . mysqli_connect_error());
}

function tampil($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function AmbilIdTransaksi() {
    global $conn;

    // Cari transaksi aktif (total_bayar = 0)
    $query = "SELECT id_trans_penjualan_produk 
              FROM transaksi_penjualan_produk 
              WHERE total_bayar = 0 
              LIMIT 1";
    $result = mysqli_query($conn, $query);

    // Jika ada transaksi aktif, gunakan ID tersebut
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['id_trans_penjualan_produk'];
    }

    // Jika tidak ada transaksi aktif, buat transaksi baru
    $tglTrans = date('Y-m-d');
    $queryInsert = "INSERT INTO transaksi_penjualan_produk (tgl_penjualan, total_bayar, metode_penjualan) 
                    VALUES ('$tglTrans', 0, 'Tunai')";
    if (!mysqli_query($conn, $queryInsert)) {
        die("Error: Gagal membuat transaksi baru. " . mysqli_error($conn));
    }

    return mysqli_insert_id($conn); // Kembalikan ID transaksi baru
}




function GetTotalTransaksi($id_transaksi) {
    global $conn;
    $query = "SELECT SUM(Harga_Satuan * Jumlah) AS totalTrans FROM detail_pembelian WHERE Id_pembelian = '$id_transaksi'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    $data = mysqli_fetch_assoc($result);
    return $data["totalTrans"] ?? 0;
}

function GetDataProduk() {
    global $conn;
    $query = "SELECT id_produk, Nama_produk, Harga_produk FROM produk";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}




function GetDataDetailTransaksi($id_transaksi) {
    global $conn;

    $query = "SELECT dp.Id_produk, p.Nama_produk, dp.Jumlah, dp.Harga_Satuan, 
                     (dp.Harga_Satuan * dp.Jumlah) AS subtotal
              FROM detail_pembelian dp
              JOIN produk p ON dp.Id_produk = p.Id_produk
              WHERE dp.Id_pembelian = '$id_transaksi'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error: Gagal mengambil data detail transaksi. " . mysqli_error($conn));
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function InsertDetail() {
    global $conn;

    // Ambil input dari form
    $id_transaksi = $_POST['id_transaksi'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];

    // Validasi input
    if (empty($id_transaksi) || empty($id_produk) || empty($jumlah)) {
        die("Error: Pastikan semua data telah diisi.");
    }

    // Periksa apakah ID transaksi ada di tabel pembelian
    $queryCheckPembelian = "SELECT Id_pembelian FROM pembelian WHERE Id_pembelian = '$id_transaksi'";
    $resultCheckPembelian = mysqli_query($conn, $queryCheckPembelian);

    if (!$resultCheckPembelian || mysqli_num_rows($resultCheckPembelian) == 0) {
        // Jika tidak ada, tambahkan data ke tabel pembelian
        $queryInsertPembelian = "INSERT INTO pembelian (Id_pembelian, Tgl_pembelian, total_bayar)
                                 VALUES ('$id_transaksi', NOW(), 0)";
        if (!mysqli_query($conn, $queryInsertPembelian)) {
            die("Error: Gagal menambahkan data ke tabel pembelian. " . mysqli_error($conn));
        }
    }

    // Ambil harga produk
    $queryProduk = "SELECT Harga_produk FROM produk WHERE id_produk = '$id_produk'";
    $resultProduk = mysqli_query($conn, $queryProduk);

    if (!$resultProduk || mysqli_num_rows($resultProduk) == 0) {
        die("Error: Produk dengan ID '$id_produk' tidak ditemukan.");
    }

    $produk = mysqli_fetch_assoc($resultProduk);
    $harga = $produk['Harga_produk'];
    $subtotal = $jumlah * $harga;

    // Masukkan detail transaksi
    $queryInsertDetail = "INSERT INTO detail_pembelian (Id_pembelian, Harga_Satuan, Jumlah, tanggal, Id_produk)
                           VALUES ('$id_transaksi', '$harga', '$jumlah', NOW(), '$id_produk')";
    if (!mysqli_query($conn, $queryInsertDetail)) {
        die("Error: Gagal memasukkan detail transaksi. " . mysqli_error($conn));
    }

    // Perbarui total bayar di tabel pembelian
    $queryUpdateTotal = "UPDATE pembelian
                         SET total_bayar = (SELECT SUM(Harga_Satuan * Jumlah) 
                                            FROM detail_pembelian WHERE Id_pembelian = '$id_transaksi')
                         WHERE Id_pembelian = '$id_transaksi'";
    if (!mysqli_query($conn, $queryUpdateTotal)) {
        die("Error: Gagal memperbarui total bayar. " . mysqli_error($conn));
    }
}




function formatRp($angka) {
    return "Rp " . number_format($angka, 2, ',', '.');
}

function SelesaiBelanja($id_transaksi) {
    global $conn;

    $query = "SELECT SUM(dp.Harga_Satuan * dp.Jumlah) AS total_bayar 
              FROM detail_pembelian dp 
              WHERE dp.Id_pembelian = '$id_transaksi'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    $data = mysqli_fetch_assoc($result);
    $total_bayar = $data['total_bayar'] ?? 0;

    if ($total_bayar > 0) {
        $queryUpdate = "UPDATE transaksi_penjualan_produk 
                        SET total_bayar = '$total_bayar', tgl_penjualan = NOW()
                        WHERE id_trans_penjualan_produk = '$id_transaksi'";
        if (!mysqli_query($conn, $queryUpdate)) {
            die("Error: " . mysqli_error($conn));
        }
        return mysqli_affected_rows($conn);
    }

    return 0; // Jika tidak ada total bayar
}


