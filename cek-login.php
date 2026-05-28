<?php
session_start();
include 'library/koneksi.php'; 

$username = $_POST['username'];
$password = md5($_POST['password']); 

// 1. Ambil data dari tabel operator
$query = mysqli_query($conn, "SELECT * FROM operator WHERE username='$username' AND password='$password'");
$check = mysqli_num_rows($query);

if($check > 0){
    $login = mysqli_fetch_assoc($query);
    
    $_SESSION['username']      = $login['username'];
    $_SESSION['user_email']    = $login['email'];
    $_SESSION['hak_akses']     = $login['hak_akses'];
    $_SESSION['kode_operator'] = $login['kode_operator'];
    $_SESSION['status']        = "login";

    // Catat log login
    $username_log = $login['username'];
    $hak_akses_log = $login['hak_akses'];
    $aktivitas_log = "Login sebagai $hak_akses_log";
    mysqli_query($conn, "INSERT INTO log_aktivitas (username, aktivitas) VALUES ('$username_log', '$aktivitas_log')");

    if($login['hak_akses'] == "admin"){
        header("location:index.php");
    } else if($login['hak_akses'] == "owner"){
        header("location:owner.php");
    } else if($login['hak_akses'] == "operator"){
        header("location:operator.php");
    }
    exit();
} else {
    // Catat log gagal login
    $username_gagal = $_POST['username'];
    mysqli_query($conn, "INSERT INTO log_aktivitas (username, aktivitas) VALUES ('$username_gagal', 'Gagal login')");
    header("location:login.php?pesan=gagal");
}
?>