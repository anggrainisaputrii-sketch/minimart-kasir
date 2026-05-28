<?php
	include('library/koneksi.php');
	
	$kode_operator	=  $_POST['kode_operator'];
	$nama 			=  $_POST['nama'];
	$alamat 		=  $_POST['alamat'];
	$no_hp 			=  $_POST['no_hp'];
	$username		=  $_POST['username'];
	$password 		=  $_POST['password'];
	$hak_akses 		=  $_POST['hak_akses'];
	
	$query = "INSERT into operator (kode_operator, nama, alamat, no_hp, username, password, hak_akses) VALUES ('$kode_operator', '$nama', '$alamat', '$no_hp', '$username', '$password', '$hak_akses')";
	$input = mysqli_query($conn, $query);
	
	if($input){
		header("location: index.php?page=data-user");
	}else {
		header("location: ?page=user-tambah");
	}
?>