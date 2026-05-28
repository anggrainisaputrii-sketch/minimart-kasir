<?php
	include('library/koneksi.php');
	
	$no_transaksi	=  $_POST['no_transaksi'];
	$tanggal		=  $_POST['tanggal'];
	$terbayar		=  $_POST['jenis_bayar'];
	$bayar			=  $_POST['bayar'];
	
	$query = "INSERT into bayar (no_transaksi, tanggal, jenis_pembayaran, jumlah) VALUES ('$no_transaksi', '$tanggal', '$jenis_bayar', '$bayar')";
	$input = mysqli_query($conn, $query);
	
	$sql="SELECT transaksi.grandtotal as grandtotal, SUM(bayar.jumlah) as jumlah FROM transaksi
		  LEFT JOIN pelanggan ON transaksi.kode_pelanggan = pelanggan.kode_pelanggan
          LEFT JOIN bayar ON transaksi.no_transaksi = bayar.no_transaksi
          WHERE transaksi.no_transaksi = '$no_transaksi'
		  GROUP BY transaksi.no_transaksi;";
	$query=mysqli_query($conn, $sql);
	$result=mysqli_fetch_array($query);

	if ($result['grandtotal'] == $result['jumlah']) {
		
	$query_update = "UPDATE bayar SET terbayar = 'y' WHERE no_transaksi = '$no_transaksi'";
	$input = mysqli_query($conn, $query_update);
	}
	
	if($input){
		header("location: index.php?page=transaksi-belum");
	}else {
		header("location: ?page=transaksi-belum");
	}
?>