<?php
	include('library/koneksi.php');
	
	$kode_pelanggan	=  $_POST['kode_pelanggan'];
	$nama_pelanggan	=  $_POST['nama_pelanggan'];
	$alamat			=  $_POST['alamat'];
	$no_hp			=  $_POST['no_hp'];
	
	$query = "UPDATE pelanggan SET  nama_pelanggan = '$nama_pelanggan', alamat = '$alamat', no_hp = '$no_hp' WHERE kode_pelanggan = '$kode_pelanggan'";
	$input = mysqli_query($conn, $query);
	
	if($input){
		header("location: index.php?page=pelanggan-data");
	}else {
		header("location: ?page=pelanggan-tambah");
	}
?>