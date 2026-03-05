<?php
session_start();
include "../koneksi.php";

$nis = mysqli_real_escape_string($conn, $_POST['nis']);
$password = md5(mysqli_real_escape_string($conn, $_POST['password']));

$query = mysqli_query($conn, 
    "SELECT * FROM siswa WHERE nis = '$nis' AND password = '$password'"
);

if(mysqli_num_rows($query) == 1){

    $data = mysqli_fetch_assoc($query);

    $_SESSION['siswa'] = [
        'nis' => $data['nis'],
        'nama' => $data['nama'],
        'kelas' => $data['kelas']
    ];

    header("Location: ../siswa/index-siswa.php");
    exit;

}else{
    echo "<script>
        alert('NIS atau Password salah');
        window.location='../siswa/login-siswa.php';
    </script>";
}
?>