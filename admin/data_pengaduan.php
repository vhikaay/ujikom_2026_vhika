<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("location: login.php");
    exit;
}

$no = 1;

/* ================== FITUR CARI ================== */
$keyword_nis = isset($_GET['nis']) ? $_GET['nis'] : '';
$keyword_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$where = "";

if ($keyword_nis != "") {
    $where .= " AND s.nis LIKE '%$keyword_nis%'";
}

if ($keyword_kategori != "") {
    $where .= " AND ia.id_kategori = '$keyword_kategori'";
}

/* ================== QUERY DATA ================== */
$query = mysqli_query($conn, "SELECT 
    ia.id_pelaporan,
    ia.tanggal,
    ia.lokasi,
    ia.ket,
    ia.status,
    s.nis,
    s.kelas,
    k.keterangan_kategori
FROM input_aspirasi ia
JOIN siswa s ON ia.nis = s.nis
JOIN kategori k ON ia.id_kategori = k.id_kategori
WHERE 1=1 $where
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
    <title>Data Pengaduan</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
</head>
<body>

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

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fa-solid fa-align-justify"></i> Data Pengaduan Sarana
            </h5>
        </div>

        <div class="card-body">

            <!-- ================= FORM CARI ================= -->
            <form method="GET" class="row mb-3">

                <div class="col-md-3">
                    <input type="text" 
                           name="nis" 
                           class="form-control"
                           placeholder="Cari NIS..."
                           value="<?= $keyword_nis ?>">
                </div>

                <div class="col-md-3">
                    <select name="kategori" class="form-select">
                        <option value="">-- Semua Kategori --</option>
                        <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM kategori");
                        while($k = mysqli_fetch_assoc($kategori)):
                        ?>
                        <option value="<?= $k['id_kategori']; ?>"
                            <?= ($keyword_kategori == $k['id_kategori']) ? 'selected' : '' ?>>
                            <?= $k['keterangan_kategori']; ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-search"></i> Cari
                    </button>

                    <a href="data_pengaduan.php" class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </form>
            <!-- ================= END FORM CARI ================= -->

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if (mysqli_num_rows($query) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                            <td class="text-center"><?= $row['nis']; ?></td>
                            <td class="text-center"><?= $row['kelas']; ?></td>
                            <td><?= $row['keterangan_kategori']; ?></td>
                            <td><?= $row['lokasi']; ?></td>
                            <td><?= $row['ket']; ?></td>
                            <td class="text-center">
                                <?php
                                $status = $row['status'];

                                if ($status == 'menunggu') {
                                    echo '<span class="badge bg-secondary">Menunggu</span>';
                                } elseif ($status == 'proses') {
                                    echo '<span class="badge bg-warning text-dark">Proses</span>';
                                } elseif ($status == 'selesai') {
                                    echo '<span class="badge bg-success">Selesai</span>';
                                } else {
                                    echo '<span class="badge bg-dark">Belum ada</span>';
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="lihat-pengaduan.php?id=<?= $row['id_pelaporan']; ?>" 
                                   class="btn btn-info btn-sm">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="hapus-pengaduan.php?id=<?= $row['id_pelaporan']; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin mau hapus data ini?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">
                                Data belum tersedia
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