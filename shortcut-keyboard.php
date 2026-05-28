<script type="text/javascript">
	document.onkeydown = function(teziger){
		switch(teziger.keyCode){
		case 112: //kode F1
		teziger.preventDefault(); //buat ngehapus tombol default
			window.location='http://localhost/kasir/?page=pelanggan-data';
		break;	
		case 113: //kode F2
		teziger.preventDefault(); //buat ngehapus tombol default
			window.location='http://localhost/kasir/?page=transaksi-belum';
		break;	
		case 114: //kode F3
		teziger.preventDefault(); //buat ngehapus tombol default
			window.location='http://localhost/kasir/?page=transaksi';	
		break;	
		case 115: //kode F4
		teziger.preventDefault(); //buat ngehapus tombol default
			window.location='http://localhost/kasir/?page=laporan-transaksi';	
		break;	
		}
	}
</script>