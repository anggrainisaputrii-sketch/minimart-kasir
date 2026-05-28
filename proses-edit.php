<?php
	include('library/koneksi.php');
	
	$kode_operator	=  $_POST['kode_operator'];
	$nama 			=  $_POST['nama'];
	$alamat 		=  $_POST['alamat'];
	$no_hp 			=  $_POST['no_hp'];
	$username		=  $_POST['username'];
	$password 		=  $_POST['password'];
	$hak_akses 		=  $_POST['hak_akses'];
	
	$query = "UPDATE operator SET  nama = '$nama', alamat = '$alamat', no_hp = '$no_hp', username = '$username', password = '$password', hak_akses = '$hak_akses' WHERE kode_operator = '$kode_operator'";
	$input = mysqli_query($conn, $query);
	
	if($input){
		header("location: index.php?page=data-user");
	}else {
		header("location: ?page=user-tambah");
	}
?>