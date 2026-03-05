<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['admin'])){
    header("location: login.php");
    exit;
}

if(isset($_POST['simpan'])){

    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $password = md5($_POST['password']);

    mysqli_query($conn, "INSERT INTO siswa 
        (nis, nama, kelas, password) 
        VALUES 
        ('$nis','$nama','$kelas','$password')
    ");

    echo "<script>
        alert('Siswa berhasil ditambahkan!');
        window.location='index-admin.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Siswa</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold">
            <i class="fa-solid fa-user-shield me-2"></i> Admin
        </span>

        <div class="d-flex align-items-center">
            <span class="text-white me-3">
                <i class="fa-solid fa-user"></i>
                <?= $_SESSION['admin']; ?>
            </span>

            <a href="index-admin.php" class="btn btn-light btn-sm">
                Kembali
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Tambah Siswa
        </div>
        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label>NIS</label>
                    <input type="text" name="nis" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" name="simpan" class="btn btn-primary">
                    Simpan
                </button>

                <a href="index-admin.php" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>
</div>

</body>
</html>