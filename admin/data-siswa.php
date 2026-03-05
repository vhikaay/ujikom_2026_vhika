<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['admin'])){
    header("location: login.php");
    exit;
}

/* ======= tambah siswa ======= */
if(isset($_POST['update'])){

    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $password = $_POST['password'];

    if(!empty($password)){
        $password = md5($password);
        mysqli_query($conn, "UPDATE siswa SET 
            nama='$nama',
            kelas='$kelas',
            password='$password'
            WHERE nis='$nis'
        ");
    } else {
        mysqli_query($conn, "UPDATE siswa SET 
            nama='$nama',
            kelas='$kelas'
            WHERE nis='$nis'
        ");
    }

    echo "<script>
        alert('Data berhasil diupdate!');
        window.location='data-siswa.php';
    </script>";
}

/* ===== search ===== */
$keyword = "";

if(isset($_GET['cari'])){
    $keyword = $_GET['keyword'];
    $query = mysqli_query($conn, 
        "SELECT * FROM siswa WHERE nis LIKE '%$keyword%'"
    );
}else{
    $query = mysqli_query($conn, "SELECT * FROM siswa");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
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
            Data Siswa
        </div>

        <div class="card-body">

            <!-- FORM CARI -->
            <form method="GET" class="row mb-3">
                <div class="col-md-4">
                    <input type="text" name="keyword" 
                           class="form-control"
                           placeholder="Cari NIS..."
                           value="<?= $keyword; ?>">
                </div>

                <div class="col-md-2">
                    <button type="submit" name="cari" class="btn btn-primary">
                        Cari
                    </button>
                    <a href="data-siswa.php" class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </form>

            <a href="tambah-siswa.php" class="btn btn-success mb-3">
                Tambah Siswa
            </a>

            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php 
                $no = 1;
                while($data = mysqli_fetch_assoc($query)){
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nis']; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['kelas']; ?></td>
                        <td>
                            <!-- button edit -->
                            <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal<?= $data['nis']; ?>">
                                Edit
                            </button>

                            <!-- button hapus data -->
                            <a href="hapus-siswa.php?nis=<?= $data['nis']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin mau hapus?')">
                                Hapus
                           </a>
                        </td>
                    </tr>

                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="editModal<?= $data['nis']; ?>" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          
                          <form method="POST">
                            <div class="modal-header bg-warning">
                              <h5 class="modal-title">Edit Siswa</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                              <input type="hidden" name="nis" value="<?= $data['nis']; ?>">

                              <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama"
                                       class="form-control"
                                       value="<?= $data['nama']; ?>" required>
                              </div>

                              <div class="mb-3">
                                <label>Kelas</label>
                                <input type="text" name="kelas"
                                       class="form-control"
                                       value="<?= $data['kelas']; ?>" required>
                              </div>

                              <div class="mb-3">
                                <label>Password (Kosongkan jika tidak diubah)</label>
                                <input type="password" name="password"
                                       class="form-control">
                              </div>

                            </div>

                            <div class="modal-footer">
                              <button type="submit" name="update"
                                      class="btn btn-warning">
                                  Update
                              </button>
                            </div>

                          </form>

                        </div>
                      </div>
                    </div>

                <?php } ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>