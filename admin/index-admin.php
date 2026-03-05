<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/fontawesome/css/all.css">

<style>
body {
    background-color: #e7f1ff;
}

/* Card Style */
.card-menu {
    transition: 0.3s ease-in-out;
    border-radius: 18px;
    padding: 30px 20px;
}

.card-menu:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

/* Icon lebih besar */
.icon-dashboard {
    font-size: 55px;
}

/* Supaya jarak antar card lebih enak */
.row-dashboard {
    gap: 20px 0;
}
</style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-primary shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand text-white fw-bold">
            <i class="fa-solid fa-user-shield me-2"></i>
            Dashboard Admin
        </span>

        <div class="d-flex align-items-center">
            <span class="text-white me-3">
                <i class="fa-solid fa-user"></i>
                <?= $_SESSION['admin']; ?>
            </span>

            <a href="../proses/logout.php" class="btn btn-light btn-sm">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <!-- Welcome -->
    <div class="text-center mb-5">
        <h3 class="fw-bold text-primary">Selamat Datang, Admin 👋</h3>
        <p class="text-muted fs-5">SISTEM PENGADUAN SARANA SEKOLAH</p>
    </div>

    <!-- MENU CARDS -->
    <div class="row justify-content-center row-dashboard">

        <div class="col-md-4 col-lg-3">
            <div class="card card-menu shadow text-center">
                <i class="fa-regular fa-comment icon-dashboard text-primary mb-4"></i>
                <h5 class="fw-bold">Data Pengaduan</h5>
                <a href="data_pengaduan.php" class="btn btn-primary mt-3 px-4 py-2">Kelola</a>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <div class="card card-menu shadow text-center">
                <i class="fa-solid fa-hashtag icon-dashboard text-primary mb-4"></i>
                <h5 class="fw-bold">Kategori</h5>
                <a href="data-kategori.php" class="btn btn-primary mt-3 px-4 py-2">Kelola</a>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <div class="card card-menu shadow text-center">
                <i class="fa-solid fa-user-graduate icon-dashboard text-primary mb-4"></i>
                <h5 class="fw-bold">Akun Siswa</h5>
                <a href="tambah-siswa.php" class="btn btn-primary mt-3 px-4 py-2">Kelola</a>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <div class="card card-menu shadow text-center">
                <i class="fa-solid fa-list icon-dashboard text-primary mb-4"></i>
                <h5 class="fw-bold">Daftar Siswa</h5>
                <a href="data-siswa.php" class="btn btn-primary mt-3 px-4 py-2">Kelola</a>
            </div>
        </div>

    </div>

</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>