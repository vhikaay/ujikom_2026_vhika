<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['siswa'])){
    header("location: login-siswa.php");
    exit;
}

$siswa = $_SESSION['siswa'];

$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Input Pengaduan</title>

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
    }

    .card-header {
        background: linear-gradient(90deg, #ff4da6, #ff80bf);
        color: white;
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

    .btn-outline-pink {
        border: 2px solid #ff4da6;
        color: #ff4da6;
        border-radius: 8px;
    }

    .btn-outline-pink:hover {
        background-color: #ff4da6;
        color: white;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ff4da6;
        box-shadow: 0 0 0 0.2rem rgba(255, 77, 166, 0.25);
    }
</style>
</head>

<body>

<nav class="navbar navbar-dark shadow-sm">
    <div class="container-fluid">
        
        <a href="index-siswa.php" class="btn btn-light btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>

        <span class="navbar-text text-white">
            <?= $siswa['nama']; ?> - <?= $siswa['kelas']; ?>
        </span>
    </div>
</nav>

<div class="container mt-5">
    <div class="card shadow-lg">
        
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fa-solid fa-align-justify"></i> Form Pengaduan Siswa
            </h5>
        </div>

        <div class="card-body">
            <form method="POST" action="../proses/simpan-pengaduan.php">

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="id_kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori Pengaduan --</option>
                        <?php while ($k = mysqli_fetch_assoc($kategori)) { ?>
                            <option value="<?= $k['id_kategori']; ?>">
                                <?= $k['keterangan_kategori']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="ket" class="form-control" rows="4" required></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index-siswa.php" class="btn btn-outline-pink">
                        Batal
                    </a>

                    <button type="submit" name="kirim" class="btn btn-pink">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Pengaduan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>