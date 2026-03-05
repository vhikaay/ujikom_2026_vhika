<?php
session_start();
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">

<style>
    body {
        background: linear-gradient(to right, #ffe6f0, #fff0f6);
    }

    .card {
        border: none;
        border-radius: 15px;
    }

    .card-header {
        background: linear-gradient(90deg, #ff4da6, #ff80bf);
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .btn-pink {
        background-color: #ff4da6;
        color: white;
        border-radius: 8px;
    }

    .btn-pink:hover {
        background-color: #e60073;
        color: white;
    }

    .form-control:focus {
        border-color: #ff4da6;
        box-shadow: 0 0 0 0.2rem rgba(255, 77, 166, 0.25);
    }

    .back-link {
        color: #ff4da6;
        font-weight: 500;
    }

    .back-link:hover {
        color: #e60073;
    }
</style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-4">
            <div class="card shadow-lg">
                
                <div class="card-header text-white text-center">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-graduation-cap"></i> Login Siswa
                    </h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="../proses/login-siswa.php">

                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="text" name="nis" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-pink">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="../index.php" class="text-decoration-none back-link">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>