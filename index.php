

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
   <style>
     body {
        background-color: #f5f5f5;
     }
     .hero{
        min-height: 100vh;
        display: flex;
        align-items: center;
     }
     .icon-box{
        font-size: 25px;
        color: #71abfc;
     }
     .btn-pink {
    background-color: #ff4da6;
    color: white;
    border: none;
}

.btn-pink:hover {
    background-color: #e60073;
    color: white;
}
   </style>
</head>
<body>
   
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
        <i class="fa-solid fa-school"></i> PENGADUAN SARANA SMK MUTU
        </a>
    </div>
</nav>

<section class="hero">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6 mb-4">
                <h1 class="fw-bold">Sistem Pengaduan Sarana SMK MUTU</h1>
                <p class="text-muted mt-3">
                Aplikasi ini digunakan untuk melaporkan kerusakan atau masalah pada sarana dan prasarana sekolah agar dapat segera ditindaklanjuti oleh pihak terkait.
                </p>

                <div class="mt-4">
                    <a href="siswa/login-siswa.php" class="btn btn-pink btn-lg me-2">
                    <i class="fa-solid fa-graduation-cap"></i>Login siswa</a>
                    <a href="admin/login.php" class="btn btn-primary btn-lg me-2">
                    <i class="fa-solid fa-user"></i>Login admin</a>
                </div>
            </div>

            <div class="col-md-6 text-center">
                <div class="icon-box mb-3">
                    <i class="fa-regular fa-comment"></i>
                </div>
              
                <p class="text-muted">
                Semua laporan yang masuk akan dijaga kerahasiaannya dan hanya dapat dilihat oleh admin untuk proses penanganan lebih lanjut.
                    <br>
                    <strong>dibuat oleh VHIKA AZHARA</strong>
                </p>
            </div>

        </div>
    </div>
    </div>
</section>

<footer class="bg-light py-3 text-center">
    <small class="text-muted">
        &copy; <?php echo date('Y')?>
        APLIKASI PENGADUAN SARANA SMK MUTU
    </small>
</footer>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
