<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['admin'])){
    header("location: login.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT 
    ia.*, 
    s.nis, 
    s.kelas, 
    k.keterangan_kategori
FROM input_aspirasi ia
JOIN siswa s ON ia.nis = s.nis
JOIN kategori k ON ia.id_kategori = k.id_kategori
WHERE ia.id_pelaporan='$id'");

$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Data tidak ditemukan");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Pengaduan</title>
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
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Detail Pengaduan
        </div>
        <div class="card-body">

            <p><b>Tanggal:</b> <?= date('d-m-Y', strtotime($data['tanggal'])); ?></p>
            <p><b>NIS:</b> <?= $data['nis']; ?></p>
            <p><b>Kelas:</b> <?= $data['kelas']; ?></p>
            <p><b>Kategori:</b> <?= $data['keterangan_kategori']; ?></p>
            <p><b>Lokasi:</b> <?= $data['lokasi']; ?></p>
            <p><b>Deskripsi:</b><br><?= $data['ket']; ?></p>

            <hr>

            <form method="POST" action="../proses/update-pengaduan.php">
                <input type="hidden" name="id" value="<?= $data['id_pelaporan']; ?>">

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="menunggu" <?= ($data['status']=='menunggu')?'selected':''; ?>>Menunggu</option>
                        <option value="proses" <?= ($data['status']=='proses')?'selected':''; ?>>Proses</option>
                        <option value="selesai" <?= ($data['status']=='selesai')?'selected':''; ?>>Selesai</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Feedback</label>
                    <textarea name="feedback" class="form-control" rows="4"><?= $data['feedback']; ?></textarea>
                </div>

                <button type="submit" name="update" class="btn btn-success">
                    Simpan Perubahan
                </button>

                <a href="data_pengaduan.php" class="btn btn-secondary">
                    Kembali
                </a>
            </form>

        </div>
    </div>
</div>

</body>
</html>