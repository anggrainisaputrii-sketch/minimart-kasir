<?php
	include('library/koneksi.php');
	
	$kode =  $_GET['kode'];
	
	$query = "DELETE FROM kategori WHERE kode_kategori = '$kode'";
	$input = mysqli_query($conn, $query);
	
	if($input){
		//header("location: index.php?page=data-user", true, 301);
		echo "<meta http-equiv='refresh' content='0;url=index.php?page=kategori-data'>";
	}else {
		header("location: ?page=user-tambah");
	}
?>