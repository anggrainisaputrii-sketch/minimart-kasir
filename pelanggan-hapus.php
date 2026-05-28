<?php
	include('library/koneksi.php');
	
	$kode =  $_GET['kode'];
	
	$query = "DELETE FROM pelanggan WHERE kode_pelanggan = '$kode'";
	$input = mysqli_query($conn, $query);
	
	if($input){
		//header("location: index.php?page=data-user", true, 301);
		echo "<meta http-equiv='refresh' content='0;url=index.php?page=pelanggan-data'>";
	}else {
		header("location: ?page=pelanggan-tambah");
	}
?>