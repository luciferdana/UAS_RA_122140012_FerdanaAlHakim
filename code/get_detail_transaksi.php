<?php
require 'koneksi.php';

$id_transaksi = $_GET['id_transaksi'];

$query = "SELECT dp.Id_produk, p.Nama_produk, dp.Jumlah, dp.Harga_Satuan, (dp.Harga_Satuan * dp.Jumlah) AS subtotal
FROM detail_pembelian dp
JOIN produk p ON dp.Id_produk = p.id_produk
WHERE dp.Id_pembelian = '$id_transaksi'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: Gagal mengambil data detail transaksi. " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan='6' class='text-center'>Tidak ada detail transaksi.</td></tr>";
} else {
    while ($data = mysqli_fetch_assoc($result)) {
        echo "
        <tr>
          <td>" . htmlspecialchars($data['Id_produk']) . "</td>
          <td>" . htmlspecialchars($data['Nama_produk']) . "</td>
          <td align='right'>" . htmlspecialchars($data['Jumlah']) . "</td>
          <td align='right'>" . number_format($data['Harga_Satuan'], 2, ',', '.') . "</td>
          <td align='right'>" . number_format($data['subtotal'], 2, ',', '.') . "</td>
          <td>
            <button class='btn btn-danger btn-sm hapus' data-id='" . $data['Id_produk'] . "'>Hapus</button>
          </td>
        </tr>";
    }
}
?>
