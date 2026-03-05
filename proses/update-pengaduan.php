<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['admin'])){
    header("location: ../admin/login.php");
    exit;
}

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $status = $_POST['status'];
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

    mysqli_query($conn, "UPDATE input_aspirasi 
    SET status='$status', feedback='$feedback' 
    WHERE id_pelaporan='$id'");

    header("location: ../admin/data_pengaduan.php");
    exit;
}
?>