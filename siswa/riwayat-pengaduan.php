<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['siswa'])){
    header("location: login-siswa.php");
    exit;
}

$siswa = $_SESSION['siswa'];
$nis = $siswa['nis'];

$no = 1;

$query = mysqli_query($conn, "SELECT 
    ia.id_pelaporan,
    ia.tanggal,
    ia.lokasi,
    ia.ket,
    ia.status,
    ia.feedback,
    k.keterangan_kategori
FROM input_aspirasi ia
JOIN kategori k ON ia.id_kategori = k.id_kategori
WHERE ia.nis = '$nis'
ORDER BY ia.tanggal DESC
");

if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Riwayat Pengaduan</title>
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

    .badge-menunggu {
        background-color: #ffb3d9;
        color: #800040;
    }

    .badge-proses {
        background-color: #ff80bf;
        color: white;
    }

    .badge-selesai {
        background-color: #e60073;
        color: white;
    }

    .table thead {
        background-color: #ffe6f2;
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
                <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Pengaduan Saya
            </h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Feedback Admin</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if (mysqli_num_rows($query) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                            <td><?= $row['keterangan_kategori']; ?></td>
                            <td><?= $row['lokasi']; ?></td>
                            <td><?= $row['ket']; ?></td>

                            <td>
                                <?php 
                                if (empty($row['feedback'])) {
                                    echo "<span class='text-muted'>Belum ada feedback</span>";
                                } else {
                                    echo $row['feedback'];
                                }
                                ?>
                            </td>

                            <td class="text-center">
                                <?php
                                $status = $row['status'];

                                if ($status == 'menunggu') {
                                    echo '<span class="badge badge-menunggu">Menunggu</span>';
                                } elseif ($status == 'proses') {
                                    echo '<span class="badge badge-proses">Proses</span>';
                                } elseif ($status == 'selesai') {
                                    echo '<span class="badge badge-selesai">Selesai</span>';
                                } else {
                                    echo '<span class="badge bg-dark">Belum ada</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                Belum ada pengaduan
                            </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>