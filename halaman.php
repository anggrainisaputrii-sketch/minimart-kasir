<?php
	if($_GET) {
		switch($_GET['page']){
		case '';
		if(!file_exists ("main-page.php")) die ("main tidak di temukan!");
		include "main-page.php";
		break;
		
		//data user
		case 'data-user';
		if(!file_exists ("data-user.php")) die ("main tidak di temukan!");
		include "data-user.php";
		break;
		
		//data user-tambah
		case 'user-tambah';
		if(!file_exists ("user-tambah.php")) die ("main tidak di temukan!");
		include "user-tambah.php";
		break;
		
		//data user-edit
		case 'user-edit';
		if(!file_exists ("user-edit.php")) die ("main tidak di temukan!");
		include "user-edit.php";
		break;
		
		//data user-hapus
		case 'user-hapus';
		if(!file_exists ("user-hapus.php")) die ("main tidak di temukan!");
		include "user-hapus.php";
		break;
		
		//pelanggan-data
		case 'pelanggan-data';
		if(!file_exists ("pelanggan-data.php")) die ("main tidak di temukan!");
		include "pelanggan-data.php";
		break;
		
		//pelanggan-tambah
		case 'pelanggan-tambah';
		if(!file_exists ("pelanggan-tambah.php")) die ("main tidak di temukan!");
		include "pelanggan-tambah.php";
		break;
		
		//pelanggan-edit
		case 'pelanggan-edit';
		if(!file_exists ("pelanggan-edit.php")) die ("main tidak di temukan!");
		include "pelanggan-edit.php";
		break;
		
		//pelanggan-hapus
		case 'pelanggan-hapus';
		if(!file_exists ("pelanggan-hapus.php")) die ("main tidak di temukan!");
		include "pelanggan-hapus.php";
		break;
		
		//kategori-data
		case 'kategori-data';
		if(!file_exists ("kategori-data.php")) die ("main tidak di temukan!");
		include "kategori-data.php";
		break;

		//kategori-tambah
		case 'kategori-tambah';
		if(!file_exists ("kategori-tambah.php")) die ("main tidak di temukan!");
		include "kategori-tambah.php";
		break;
		
		//kategori-edit
		case 'kategori-edit';
		if(!file_exists ("kategori-edit.php")) die ("main tidak di temukan!");
		include "kategori-edit.php";
		break;
		
		//kategori-hapus
		case 'kategori-hapus';
		if(!file_exists ("kategori-hapus.php")) die ("main tidak di temukan!");
		include "kategori-hapus.php";
		break;
		
		//barang-data
		case 'barang-data';
		if(!file_exists ("barang-data.php")) die ("main tidak di temukan!");
		include "barang-data.php";
		break;
		
		//barang-tambah
		case 'barang-tambah';
		if(!file_exists ("barang-tambah.php")) die ("main tidak di temukan!");
		include "barang-tambah.php";
		break;
		
		//barang-edit
		case 'barang-edit';
		if(!file_exists ("barang-edit.php")) die ("main tidak di temukan!");
		include "barang-edit.php";
		break;
		
		//barang-hapus
		case 'barang-hapus';
		if(!file_exists ("barang-hapus.php")) die ("main tidak di temukan!");
		include "barang-hapus.php";
		break;
		
		//transaksi
		case 'transaksi';
		if(!file_exists ("transaksi.php")) die ("main tidak di temukan!");
		include "transaksi.php";
		break;
		
		//transaksi temporary hapus
		case 'transaksi-temporary-hapus';
		if(!file_exists ("transaksi-temporary-hapus.php")) die ("main tidak di temukan!");
		include "transaksi-temporary-hapus.php";
		break;
		
		//transaksi belum
		case 'transaksi-belum';
		if(!file_exists ("transaksi-belum.php")) die ("main tidak di temukan!");
		include "transaksi-belum.php";
		break;
		
		//transaksi detail
		case 'transaksi-detail';
		if(!file_exists ("transaksi-detail.php")) die ("main tidak di temukan!");
		include "transaksi-detail.php";
		break;
		
		//bayar
		case 'bayar';
		if(!file_exists ("bayar.php")) die ("main tidak di temukan!");
		include "bayar.php";
		break;
		
		//autocomplete
		case 'autocomplete';
		if(!file_exists ("home.php")) die ("main tidak di temukan!");
		include "home.php";
		break;
		
		//invoice
		case 'invoice';
		if(!file_exists ("invoice.php")) die ("main tidak di temukan!");
		include "invoice.php";
		break;
		
		//invoice
		case 'laporan-transaksi';
		if(!file_exists ("laporan-transaksi.php")) die ("main tidak di temukan!");
		include "laporan-transaksi.php";
		break;
		
		//laporan
		case 'laporan';
		if(!file_exists ("laporan.php")) die ("main tidak di temukan!");
		include "laporan.php";
		break;
		
		//laporan
		case 'laporan-bulanan';
		if(!file_exists ("laporan-bulanan.php")) die ("main tidak di temukan!");
		include "laporan-bulanan.php";
		break;
		
		//laporan
		case 'laporan-mingguan';
		if(!file_exists ("laporan-mingguan.php")) die ("main tidak di temukan!");
		include "laporan-mingguan.php";
		break;
		
		//laporan keuntungan
		case 'laporan-keuntungan';
		if(!file_exists ("laporan-keuntungan.php")) die ("main tidak di temukan!");
		include "laporan-keuntungan.php";
		break;
		
		// FITUR 5: Log Aktivitas Operator (Baru Ditambahin)
		case 'log-data';
		if(!file_exists ("log-data.php")) die ("main tidak di temukan!");
		include "log-data.php";
		break;
	}
	
	} else {
		if(!file_exists ("main-page.php")) die ("main tidak di temukan!");
		include "main-page.php";
	}
	
?>