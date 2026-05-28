<?php
	include('library/koneksi.php');
	
	$kode_operator	=  $_GET['kode'];
	
	$query = "DELETE FROM operator WHERE kode_operator = '$kode_operator'";
	$input = mysqli_query($conn, $query);
	
	if($input){
		//header("location: index.php?page=data-user", true, 301);
		echo "<meta http-equiv='refresh' content='0;url=index.php?page=data-user'>";
	}else {
		header("location: ?page=user-tambah");
	}
?>