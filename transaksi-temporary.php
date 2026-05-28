<?php
    // Aktivasi session PHP
    session_start();
	
    include('library/koneksi.php');
	
	if($_POST['kode_barang'] == "")
	{
		//simpan table transaksi
	
		$tanggal_sekarang = date("Y-m-d");
								
		//session nama
		$kode_operator_session = $_SESSION['kode_operator'];
		
		$no_transaksi 	 =$_POST['no_transaksi'];
		$kode_pelanggan  =$_POST['kode_pelanggan'];
		$jenis_bayar  	 =$_POST['jenis_bayar'];
		$tanggal 		 =$tanggal_sekarang;
		$kode_operator 	 =$kode_operator_session ;
		$grandtotal		 =$_POST['grandtotal'];
		$jumlah_bayar	 =$_POST['jumlah_bayar'];
								 
		if($jumlah_bayar < $grandtotal)
		{
			echo "<meta http-equiv='refresh' content='0;url=index.php?page=transaksi'>";
		}else{
			$query = "INSERT into transaksi (no_transaksi, tanggal, kode_operator, kode_pelanggan, grandtotal) VALUES ('$no_transaksi', '$tanggal', '$kode_operator', '$kode_pelanggan', '$grandtotal')";
		$input = mysqli_query($conn, $query);
		
		  if ($input){
					//menampilkan data transaksi tmp
					$sql="SELECT tmp_transaksi.id, tmp_transaksi.kode_barang, barang.nama_barang, tmp_transaksi.harga_beli, tmp_transaksi.harga_jual, tmp_transaksi.jumlah, tmp_transaksi.subtotal, tmp_transaksi.kode_operator, operator.nama FROM tmp_transaksi 
						  LEFT JOIN barang ON tmp_transaksi.kode_barang = barang.kode_barang 
						  LEFT JOIN operator ON tmp_transaksi.kode_operator = operator.kode_operator;";
					  $query_tmp=mysqli_query($conn, $sql);
							 while($result=mysqli_fetch_array($query_tmp)){
							 $kode = $result['id'];
									
						  $no_transaksi = $_POST['no_transaksi'];
						  $kode_barang 	= $result['kode_barang'];
						  $harga_beli 	= $result['harga_beli'];
						  $harga_jual 	= $result['harga_jual'];
						  $jumlah 		= $result['jumlah'];
						  $subtotal 	= $result['subtotal'];
				
						  $query_detail = "INSERT into transaksi_detail (no_transaksi, kode_barang, harga_beli, harga_jual, jumlah, subtotal) VALUES ('$no_transaksi', '$kode_barang', '$harga_beli', '$harga_jual', '$jumlah', '$subtotal')";
						  $input = mysqli_query($conn, $query_detail);
							}
							
							if ($jenis_bayar == 'belum'){
							   $jumlah_bayar_fix = "0";
							}else {
								$jumlah_bayar_fix = $jumlah_bayar;
							}
							
							$query_bayar = "INSERT into bayar (no_transaksi, tanggal, jenis_pembayaran, jumlah) VALUES ('$no_transaksi', '$kode_barang', '$jenis_bayar', '$jumlah_bayar_fix')";
						    mysqli_query($conn, $query_bayar);
							
							
							$query_hapus = "DELETE FROM tmp_transaksi";
							mysqli_query($conn, $query_hapus);
							
							
							echo "<meta http-equiv='refresh' content='0;url=index.php?page=invoice&kode=" .$no_transaksi. "'>";
						
			  }else {
				   header("location: ?page=transaksi");
		  }
		  
		  }	
		  
		 
	}else
	{
		$kode_barang     = $_POST['kode_barang'];
		$nama_barang     = $_POST['nama'];
		$jumlah_karakter = $_POST['nama_barang'];
		$harga_beli      = $_POST['harga_beli'];
		$harga_jual      = $_POST['harga_jual'];
		$kode_operator   = $_POST['kode_operator'];
		
		
		
		
		
		
		
		$jumlah  = strlen($jumlah_karakter);
		$qty     = substr($nama_barang,$jumlah,5);
		
		
		$subtotal = (int)$harga_jual * (int)$qty;
		
		/*
		echo $kode_barang ."<br>";
		echo $nama_barang ."<br>";
		echo $jumlah_karakter ."<br>";
		echo $harga_beli ."<br>";
		echo $qty ."<br>";
		echo $subtotal ."<br>";
		echo $kode_operator ."<br>";
		*/
	   
		$query = "INSERT INTO tmp_transaksi (kode_barang, harga_beli, harga_jual, jumlah, subtotal, kode_operator) VALUES ('$kode_barang', '$harga_beli', '$harga_jual', '$qty', '$subtotal', '$kode_operator')";
		$input = mysqli_query($conn, $query);
		
		if ($input) {
			//header("location: index.php?page=transaksi");
			echo "<meta http-equiv='refresh' content='0;url=index.php?page=transaksi'>";
		} else {
			//header("location: ?page=kategori-tambah");
		}
	}