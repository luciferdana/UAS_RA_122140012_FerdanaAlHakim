<?php
// Mulai sesi untuk autentikasi
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Include file koneksi
require 'koneksi.php';

// Query untuk mendapatkan semua data pengguna
$query = "SELECT id, fullname, email FROM users";
$result = $conn->query($query);

if (!$result) {
    die("Query error: " . $conn->error);
}

// Set cookie untuk nama pengguna
setcookie("username", $_SESSION['fullname'], time() + 3600, "/"); // Cookie berlaku 1 jam
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
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

    <div class="container mt-5">
        <h1 class="text-center mb-4">User List</h1>
        <div class="mb-3 text-end">
            <span class="welcome-message">Welcome, <strong><?= htmlspecialchars($_SESSION['fullname']) ?></strong></span>
        </div>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['fullname']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Script for Cookies and Local Storage -->
    <script>
        // Set localStorage for user full name
        localStorage.setItem('userFullName', '<?= $_SESSION['fullname'] ?>');

        // Get cookie for username
        const cookies = document.cookie.split('; ');
        const usernameCookie = cookies.find(cookie => cookie.startsWith('username='));
        const username = usernameCookie ? usernameCookie.split('=')[1] : null;

        // Display welcome message using localStorage or cookie
        document.addEventListener('DOMContentLoaded', () => {
            const fullName = localStorage.getItem('userFullName') || decodeURIComponent(username);
            if (fullName) {
                document.querySelector('.welcome-message').textContent = `Welcome back, ${fullName}`;
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
