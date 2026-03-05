<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['siswa'])){
    header ("location: ../siswa/login-siswa.php");
    exit;
}

$nis = $_SESSION['siswa']['nis'];

$id_kategori = mysqli_real_escape_string($conn, $_POST['id_kategori']);
$lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
$ket = mysqli_real_escape_string($conn, $_POST['ket']);

$tanggal = date("Y-m-d H:i:s");

/* 1️⃣ Simpan ke input_aspirasi */
mysqli_query($conn, "INSERT INTO input_aspirasi 
(nis, id_kategori, lokasi, ket, tanggal) 
VALUES 
('$nis','$id_kategori','$lokasi','$ket','$tanggal')");

/* 2️⃣ Ambil ID terakhir */
$id_pelaporan = mysqli_insert_id($conn);

/* 3️⃣ Simpan status default ke aspirasi */
mysqli_query($conn, "INSERT INTO aspirasi (id_pelaporan, status) 
VALUES ('$id_pelaporan', 'menunggu')");

header("location: ../siswa/index-siswa.php");
exit;
?>