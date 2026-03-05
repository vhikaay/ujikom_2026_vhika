<?php
session_start();
include "../koneksi.php";

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    $hapus = mysqli_query($conn, 
        "DELETE FROM input_aspirasi WHERE id_pelaporan='$id'"
    );

    if($hapus){
        $_SESSION['pesan'] = "Data berhasil dihapus!";
    } else {
        $_SESSION['pesan'] = "Data gagal dihapus!";
    }

    header("location: data_pengaduan.php");
    exit;
}
?>