<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['admin'])){
    header("location: login.php");
    exit;
}

if(isset($_GET['nis'])){

    $nis = $_GET['nis'];

    // hapus dulu pengaduan siswa
    mysqli_query($conn, "DELETE FROM input_aspirasi WHERE nis='$nis'");

    // baru hapus siswa
    $hapus = mysqli_query($conn, "DELETE FROM siswa WHERE nis='$nis'");

    if($hapus){
        echo "<script>
            alert('Data siswa berhasil dihapus!');
            window.location='data-siswa.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal dihapus!');
            window.location='data-siswa.php';
        </script>";
    }
}
?>