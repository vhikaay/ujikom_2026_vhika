\<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
</head>

<body style="background-color: #e7f1ff;"> <!-- biru soft -->

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">

                <!-- Header -->
                <div class="card-header bg-primary-subtle text-primary text-center">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-user"></i> Login Admin
                    </h5>
                </div>

                <!-- Form -->
                <div class="card-body">
                    <form method="POST" action="../proses/login-admin.php">

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-primary">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="../index.php" class="text-decoration-none text-primary">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke beranda
                </a>
            </div>

        </div>
    </div>
</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>