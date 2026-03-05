<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['admin'])){
    header("location: login.php");
    exit;
}

/* ================= TAMBAH ================= */
if(isset($_POST['simpan'])){
    $keterangan = $_POST['keterangan_kategori'];

    mysqli_query($conn, "INSERT INTO kategori (keterangan_kategori) 
                         VALUES ('$keterangan')");

    $_SESSION['pesan'] = "Kategori berhasil ditambahkan!";
    header("location: data-kategori.php");
    exit;
}

/* ================= EDIT ================= */
if(isset($_POST['update'])){
    $id = $_POST['id_kategori'];
    $keterangan = $_POST['keterangan_kategori'];

    mysqli_query($conn, "UPDATE kategori 
                         SET keterangan_kategori='$keterangan' 
                         WHERE id_kategori='$id'");

    $_SESSION['pesan'] = "Kategori berhasil diupdate!";
    header("location: data-kategori.php");
    exit;
}

/* ================= AMBIL DATA EDIT ================= */
$edit = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori='$id'");
    $edit = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
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

    <?php if(isset($_SESSION['pesan'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= $_SESSION['pesan']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php unset($_SESSION['pesan']); endif; ?>

    <!-- FORM -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <?= $edit ? "Edit Kategori" : "Tambah Kategori"; ?>
        </div>
        <div class="card-body">

            <form method="POST">

                <?php if($edit): ?>
                    <input type="hidden" name="id_kategori" value="<?= $edit['id_kategori']; ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label>Keterangan Kategori</label>
                    <input type="text" 
                           name="keterangan_kategori" 
                           class="form-control" 
                           required
                           value="<?= $edit ? $edit['keterangan_kategori'] : ''; ?>">
                </div>

                <?php if($edit): ?>
                    <button type="submit" name="update" class="btn btn-warning">
                        Update
                    </button>
                    <a href="data-kategori.php" class="btn btn-secondary">
                        Batal
                    </a>
                <?php else: ?>
                    <button type="submit" name="simpan" class="btn btn-primary">
                        Simpan
                    </button>
                <?php endif; ?>

            </form>

        </div>
    </div>

    <!-- TABEL DATA -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            Daftar Kategori
        </div>
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead class="table-secondary">
                    <tr class="text-center">
                        <th width="10%">No</th>
                        <th>Keterangan</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $no = 1;
                $query = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id_kategori DESC");

                if(mysqli_num_rows($query) > 0):
                    while($row = mysqli_fetch_assoc($query)):
                ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $row['keterangan_kategori']; ?></td>
                        <td class="text-center">
                            <a href="data-kategori.php?edit=<?= $row['id_kategori']; ?>" 
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                <?php 
                    endwhile;
                else:
                ?>
                    <tr>
                        <td colspan="3" class="text-center">Belum ada kategori</td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>

        </div>
    </div>

</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>