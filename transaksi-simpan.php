<?php
	include ('library/koneksi.php');
	
	//simpan table transaksi
	
	$tanggal_sekarang = date("Y-m-D");
	
	// aktivasi session nama
	session_start();
						
	//session nama
	$kode_operator_session = $_SESSION['kode_operator'];
	
	
	$no_transaksi 	 =$_POST['no_transaksi'];
	$tanggal 		 =$tanggal_sekarang;
	$kode_operator 	 =$kode_operator_session ;
	$grandtotal		 =$_POST['grandtotal'];
							 
	$query = "INSERT into transaksi (no_transaksi, tanggal, kode_operator,grandtotal) VALUES ('$no_transaksi', '$tanggal', '$kode_operator', '$grandtotal')";
	$input = mysqli_query($conn, $query);
	
	  if ($input){
				//menampilkan data transaksi tmp
				$sql="SELECT tmp_transaksi.id, tmp_transaksi.kode_barang, barang.nama_barang, tmp_transaksi.harga_beli, tmp_transaksi.harga_jual, tmp_transaksi.jumlah, tmp_transaksi.subtotal, tmp_transaksi.kode_operator, operator.nama FROM tmp_transaksi 
					  LEFT JOIN barang ON tmp_transaksi.kode_barang = barang.kode_barang 
					  LEFT JOIN operator ON tmp_transaksi.kode_operator = operator.kode_operator;";
					  
				  $query=mysqli_query($conn, $sql);
						 while($result=mysqli_fetch_array($query)){
						 $kode = $result['id'];
								
					  $no_transaksi = $_POST['no_transaksi'];
					  $kode_barang 	= $result['kode_barang'];
					  $harga_beli 	= $result['harga_beli'];
					  $harga_jual 	= $result['harga_jual'];
					  $jumlah 		= $result['jumlah'];
					  $subtotal 	= $result['subtotal'];
					  
					  echo "DEBUG: Lagi proses kode $kode_barang | Jumlah beli: $jumlah <br>";
			
					 $query_detail = "INSERT into transaksi_detail (no_transaksi, kode_barang, harga_beli, harga_jual, jumlah, subtotal) VALUES ('$no_transaksi', '$kode_barang', '$harga_beli', '$harga_jual', '$jumlah', '$subtotal')";
					 $input_detail = mysqli_query($conn, $query_detail);
					mysqli_query($conn, "UPDATE barang SET stok = stok - $jumlah WHERE kode_barang = '$kode_barang'");
						}
						
		  }else {
			  header("location: ?page=kategori-tambah");
		  }
	
?>

