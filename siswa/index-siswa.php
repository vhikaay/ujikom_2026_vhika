<?php
session_start();

if(!isset($_SESSION['siswa'])){
    header("location: login-siswa.php");
    exit;
}

$siswa = $_SESSION['siswa'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">

<style>
    body {
        background: linear-gradient(to right, #ffe6f0, #fff0f6);
    }

    .navbar {
        background: linear-gradient(90deg, #ff4da6, #ff80bf);
    }

    .card {
        border: none;
        border-radius: 15px;
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-body i {
        font-size: 45px;
        color: #ff4da6;
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

    .alert-pink {
        background-color: #ffd6eb;
        color: #b30059;
        border: none;
        border-radius: 10px;
    }
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container-fluid">
        
        <a class="navbar-brand fw-bold" href="#">
            <i class="fa-solid fa-graduation-cap me-2"></i>
            Siswa
        </a>

        <div class="d-flex align-items-center">
            <span class="text-white me-3">
                <i class="fa-solid fa-user"></i>
                <?= $siswa['nama']; ?>
            </span>

            <a href="../proses/logout-siswa.php" class="text-white text-decoration-none">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    <!-- Alert -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="alert alert-pink">
                <strong>Selamat Datang!</strong> Di Aplikasi Pengaduan Sarana SMK MUTU <b><?= $siswa['nama']; ?></b>.
            </div>
        </div>
    </div>

    <!-- Card Menu -->
    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <i class="fa-regular fa-comment mb-3"></i>
                    <h5 class="fw-bold">Buat Pengaduan</h5>
                    <p class="text-muted">Kirim laporan sarana sekolah</p>
                    <a href="input-pengaduan.php" class="btn btn-pink">
                        Buat
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <i class="fa-regular fa-file-lines mb-3"></i>
                    <h5 class="fw-bold">Riwayat Pengaduan</h5>
                    <p class="text-muted">Lihat laporan yang sudah dikirim</p>
                    <a href="riwayat-pengaduan.php" class="btn btn-pink">
                        Lihat
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>