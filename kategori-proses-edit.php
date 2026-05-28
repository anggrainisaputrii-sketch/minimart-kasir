<?php
	include('library/koneksi.php');
	
	$kode_kategori	=  $_POST['kode_kategori'];
	$nama_kategori 			=  $_POST['nama_kategori'];
	
	$query = "UPDATE kategori SET  nama_kategori = '$nama_kategori' WHERE kode_kategori = '$kode_kategori'";
	$input = mysqli_query($conn, $query);
	
	if($input){
		header("location: index.php?page=kategori-data");
	}else {
		header("location: ?page=kategori-tambah");
	}
?>