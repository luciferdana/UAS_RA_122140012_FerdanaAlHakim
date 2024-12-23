<?php
// Include file koneksi
require 'koneksi.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $gender = htmlspecialchars($_POST['gender']);
    $terms = isset($_POST['terms']) ? 1 : 0;

    // Validasi password dan konfirmasi password di server
    if ($password !== $confirmPassword) {
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Encrypt password

        // Insert data into the database
        $query = "INSERT INTO users (fullname, email, password, gender, terms) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $fullname, $email, $hashedPassword, $gender, $terms);

        if ($stmt->execute()) {
            $success = true; // Menandakan pendaftaran berhasil
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
                    <h1 class="text-center mb-4">Sign Up</h1>
                    <?php if (isset($success) && $success): ?>
                        <div class="alert alert-success mt-3 text-center" id="successMessage">
                            Registration successful! Redirecting to login page...
                        </div>
                    <?php endif; ?>
                    <form id="signupForm" method="POST" action="">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name">
                            <div class="text-danger mt-1" id="fullnameError"></div>
                        </div>
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
                            <div id="passwordStrength" class="mt-2"></div>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
                            <div class="text-danger mt-1" id="confirmPasswordError"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="male" name="gender" value="Male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="female" name="gender" value="Female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            <div class="text-danger mt-1" id="genderError"></div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" name="terms">
                            <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
                            <div class="text-danger mt-1" id="termsError"></div>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                            <p class="text-center mt-3">Do you have an account? <a href="login.php">Login here</a></p>
                        </div>
                    </form>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("signupForm").addEventListener("submit", function(event) {
            let isValid = true;

            // Validasi Full Name
            const fullname = document.getElementById("fullname");
            const fullnameError = document.getElementById("fullnameError");
            if (fullname.value.trim() === "") {
                fullnameError.textContent = "Full name cannot be empty.";
                isValid = false;
            } else {
                fullnameError.textContent = "";
            }

            // Validasi Email
            const email = document.getElementById("email");
            const emailError = document.getElementById("emailError");
            if (email.value.trim() === "") {
                emailError.textContent = "Email cannot be empty.";
                isValid = false;
            } else {
                emailError.textContent = "";
            }

            // Validasi Password
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("confirm_password");
            const passwordError = document.getElementById("passwordError");
            const confirmPasswordError = document.getElementById("confirmPasswordError");

            if (password.value.trim() === "") {
                passwordError.textContent = "Password cannot be empty.";
                isValid = false;
            } else {
                passwordError.textContent = "";
            }

            if (confirmPassword.value.trim() == "") {
                confirmPasswordError.textContent = "Password confirmation cannot be empty.";
                isValid = false;
            } else if (password.value !== confirmPassword.value) {
                confirmPasswordError.textContent = "Passwords do not match.";
                isValid = false;
            } else {
                confirmPasswordError.textContent = "";
            }

            // Validasi Gender
            const genderError = document.getElementById("genderError");
            const genderSelected = document.querySelector("input[name='gender']:checked");
            if (!genderSelected) {
                genderError.textContent = "Please select a gender.";
                isValid = false;
            } else {
                genderError.textContent = "";
            }

            // Validasi Terms
            const terms = document.getElementById("terms");
            const termsError = document.getElementById("termsError");
            if (!terms.checked) {
                termsError.textContent = "You must agree to the terms and conditions.";
                isValid = false;
            } else {
                termsError.textContent = "";
            }

            // Prevent form submission jika validasi gagal
            if (!isValid) {
                event.preventDefault();
            }
        });

        document.getElementById("togglePassword").addEventListener("click", function() {
            const passwordField = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");

            // Toggle the password visibility
            const isPasswordVisible = passwordField.type === "password";
            passwordField.type = isPasswordVisible ? "text" : "password";

            // Toggle the icon
            toggleIcon.classList.toggle("fa-eye", !isPasswordVisible);
            toggleIcon.classList.toggle("fa-eye-slash", isPasswordVisible);
        });

        document.getElementById("password").addEventListener("input", function() {
            const strength = document.getElementById("passwordStrength");
            const password = this.value;
            let message = "";
            let strengthClass = "";

            if (password.length < 6) {
                message = "Weak";
                strengthClass = "text-danger";
            } else if (/[A-Za-z]/.test(password) && /[0-9]/.test(password)) {
                message = "Strong";
                strengthClass = "text-success";
            } else {
                message = "Moderate";
                strengthClass = "text-warning";
            }

            strength.textContent = message;
            strength.className = strengthClass;
        });

        const successMessage = document.getElementById("successMessage");
        if (successMessage) {
            setTimeout(() => {
                window.location.href = "login.php"; // Halaman login
            }, 1600); // Tunggu 3 detik sebelum mengalihkan
        }
    </script>
</body>
</html>
