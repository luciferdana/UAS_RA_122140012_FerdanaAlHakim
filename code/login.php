<?php
// Include file koneksi
require 'koneksi.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Query untuk mendapatkan data pengguna berdasarkan email
    $query = "SELECT id, fullname, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #2575fc, #6a11cb);
            transform: scale(1.05);
        }

        .form-control {
            border-radius: 10px;
        }

        .input-group-text {
            border-radius: 0 10px 10px 0;
            background: #f1f1f1;
            border: none;
        }

        h1 {
            color: #333;
            font-weight: bold;
        }

        a {
            color: #2575fc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h1 class="text-center mb-4">Login</h1>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                    <form id="loginForm" method="POST" action="">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                            <div class="text-danger mt-1" id="emailError"></div>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                    <i class="fa fa-eye" id="toggleIcon"></i>
                                </span>
                            </div>
                            <div class="text-danger mt-1" id="passwordError"></div>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </div>
                        <p class="text-center">Don't have an account? <a href="signup.php">Sign up here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validasi form login
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            let isValid = true;

            // Validasi email
            const email = document.getElementById("email");
            const emailError = document.getElementById("emailError");
            if (email.value.trim() === "") {
                emailError.textContent = "Email cannot be empty.";
                isValid = false;
            } else {
                emailError.textContent = "";
            }

            // Validasi password
            const password = document.getElementById("password");
            const passwordError = document.getElementById("passwordError");
            if (password.value.trim() === "") {
                passwordError.textContent = "Password cannot be empty.";
                isValid = false;
            } else {
                passwordError.textContent = "";
            }

            // Jika validasi gagal, cegah form dikirim
            if (!isValid) {
                event.preventDefault();
            }
        });

        // Fitur toggle visibility password
        document.getElementById("togglePassword").addEventListener("click", function() {
            const passwordField = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");

            // Toggle visibility password
            const isPasswordVisible = passwordField.type === "password";
            passwordField.type = isPasswordVisible ? "text" : "password";

            // Toggle icon
            toggleIcon.classList.toggle("fa-eye", !isPasswordVisible);
            toggleIcon.classList.toggle("fa-eye-slash", isPasswordVisible);
        });
    </script>
</body>
</html>
