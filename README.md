# README

## Ferdana Al Hakim
## 122140012
## RA

## UAS PEMWEB RA
Proyek  ini adalah aplikasi web sederhana untuk mengelola akun pengguna dan transaksi. Proyek ini dibangun menggunakan PHP dan MySQL, mencakup berbagai fungsi seperti login, pendaftaran, dan manajemen transaksi. Websitet sederhana ini dibuat untuk memenuhi tugas akhir Mata Kuliah Pemrograman Web Institut Teknologi Sumatera.

## File Proyek

- `api_hapus_detail.php`: Menghapus detail transaksi melalui API.
- `api_tambah_detail.php`: Menambahkan detail transaksi melalui API.
- `DetailTransaksi.php`: Menampilkan detail transaksi.
- `form.php`: Formulir untuk input data.
- `get_detail_transaksi.php`: Mengambil data detail transaksi.
- `index.php`: Halaman utama dashboard.
- `koneksi.php`: Mengelola koneksi database.
- `login.php`: Halaman login pengguna.
- `logout.php`: Mengelola logout pengguna.
- `SelesaiBelanja.php`: Menandai akhir sesi belanja.
- `signup.php`: Halaman pendaftaran pengguna.
- `tambahBarang.php`: Menambahkan barang ke dalam inventaris.
- `view_transaksi.php`: Menampilkan semua transaksi.

## Langkah-Langkah Hosting dan Deployment

### 1. Persiapan
- Pastikan aplikasi web berjalan dengan baik di lingkungan lokal.
- Verifikasi semua dependensi, file, dan folder (contoh: CSS, JavaScript, database).

### 2. Platform Hosting
- Pilih InfinityFree sebagai platform hosting.
- Buat akun dan akses panel kontrol hosting (vPanel).

### 3. Unggah File
- Masuk ke panel kontrol hosting.
- Gunakan File Manager atau FTP (misalnya, FileZilla) untuk mengunggah file proyek ke direktori `htdocs`.

### 4. Konfigurasi Database
- Buat database MySQL melalui panel hosting.
- Perbarui file konfigurasi (contoh: `koneksi.php`) dengan kredensial database hosting.

### 5. Pengujian
- Akses domain/subdomain yang disediakan untuk menguji aplikasi.
- Debug dan perbaiki jika ada masalah selama proses hosting.

## Penyedia Hosting
### Platform Pilihan: InfinityFree

**Alasan:**
- Gratis dengan fitur dasar yang cukup untuk proyek kecil.
- Mendukung PHP dan MySQL.
- Menyediakan subdomain gratis.
- Ruang penyimpanan dan bandwidth tanpa batas untuk aplikasi sederhana.
- Panel kontrol yang mudah digunakan.

## Langkah-Langkah Keamanan

- **Validasi Input:** Memastikan semua input pengguna divalidasi untuk mencegah serangan SQL Injection dan XSS.
- **HTTPS:** Mengaktifkan sertifikat SSL untuk komunikasi yang aman.
- **Proteksi File Sensitif:** Gunakan `.htaccess` untuk membatasi akses ke file konfigurasi.
- **Pembaruan dan Backup Rutin:** Lakukan pembaruan dan backup data secara rutin.
- **Keamanan Upload File:** Batasi tipe file yang dapat diunggah dan gunakan direktori terisolasi untuk menyimpan file.

### Contoh `.htaccess` untuk Melindungi File
```apache
<Files "config.php">
    Order Allow,Deny
    Deny from all
</Files>
```

## Konfigurasi Server

- **Struktur File:** Tempatkan file proyek utama di direktori `htdocs`.
- **Database:** Konfigurasi database di panel hosting dan perbarui aplikasi:
  ```php
  $host = "sqlXXX.infinityfree.com";
  $user = "epiz_XXXXXXX";
  $password = "your_password";
  $db = "epiz_XXXXXXX_database";
  ```

- **SSL:** Gunakan SSL gratis dari InfinityFree.
- **Penanganan Error:** Log error ke file, bukan ditampilkan di browser:
  ```php
  ini_set('display_errors', 0);
  ini_set('log_errors', 1);
  error_log('/path_to_your_error_log/php-error.log');
  ```

## Catatan Tambahan
- Aplikasi ini mencakup halaman interaktif untuk login dan pendaftaran dengan desain responsif.
- Pastikan untuk menguji semua fitur setelah deployment untuk memastikan stabilitas.

---
Untuk informasi lebih lanjut, silakan merujuk ke kode sumber atau hubungi pengembang.

