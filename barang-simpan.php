<?php
	include('library/koneksi.php');
	
	$kode_barang 	=  $_POST['kode_barang'];
	$nama_barang  	=  $_POST['nama_barang'];
	$kode_kategori	=  $_POST['kode_kategori'];
	$harga_beli  	=  $_POST['harga_beli'];
	$harga_jual  	=  $_POST['harga_jual'];
	$stok   		=  $_POST['stok'];
	
	
	$query = "INSERT into barang (kode_barang, nama_barang, kode_kategori, harga_beli, harga_jual, stok) VALUES ('$kode_barang', '$nama_barang', '$kode_kategori', '$harga_beli','$harga_jual', '$stok')";
	$input = mysqli_query($conn, $query);
	
	if($input){
		//header("location: index.php?page=barang-data");
		echo "<meta http-equiv='refresh' content='0;url=index.php?page=barang-data'>";
	}else {
		header("location: ?page=barang-tambah");
	}