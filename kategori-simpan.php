<?php
	include('library/koneksi.php');
	
	$kode_kategori	=  $_POST['kode_kategori'];
	$nama_kategori	=  $_POST['nama_kategori'];
	
	$query = "INSERT into kategori (kode_kategori, nama_kategori) VALUES ('$kode_kategori', '$nama_kategori')";
	$input = mysqli_query($conn, $query);
	
	if($input){
		header("location: index.php?page=kategori-data");
	}else {
		header("location: ?page=kategori-tambah");
	}
?>