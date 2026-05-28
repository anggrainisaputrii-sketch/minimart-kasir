<script type="text/javascript">
	document.onkeydown = function(teziger){
		switch(teziger.keyCode){
		case 81: //kode F1
		teziger.preventDefault(); //buat ngehapus tombol default
			document.getElementById('print').click();
		break;	
		case 87: //kode F2
		teziger.preventDefault(); //buat ngehapus tombol default
			document.getElementById('whatsapp').click();
		break;	
		}
	}
</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Minimart Gemas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Nota</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

                <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-shopping-cart"></i> Minimart Gemas
                    <small class="float-right">Date: 28/04/2026</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Admin, imut lucu</strong><br>
                    Sukodono, Denok<br>
                    Anggi Joy, lmj<br>
                    Phone: 085733685076<br>
                    Email: angrainisaputri123@gmail.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
				<?php
					include_once('library/koneksi.php');
						//menampilkan data grandtotal
						$kode = $_GET['kode'];
						$query = mysqli_query ($conn, "SELECT * FROM transaksi
														LEFT JOIN pelanggan ON transaksi.kode_pelanggan = pelanggan.kode_pelanggan
														WHERE transaksi.no_transaksi = '$kode';");
						$result=mysqli_fetch_array($query);
						$tanggal = $result['tanggal'];
						$no_handphone = $result['no_hp'];
					?>
                  <address>
                    <strong><?php echo $result['nama_pelanggan']; ?></strong><br>
					<?php echo $result['alamat']; ?><br>
                    Phone: <?php echo $result['no_hp']; ?><br>
                  </address>
                </div>
				<?php
					//include('library/koneksi.php');
						//menampilkan data grandtotal
						$kode = $_GET['kode'];
						$query = mysqli_query ($conn, "SELECT * FROM transaksi WHERE no_transaksi = '$kode';");
						$result=mysqli_fetch_array($query);
						$tanggal = $result['tanggal'];
					?>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #<?php echo $_GET['kode']; ?></b><br>
                  <br>
                  <b>Order ID:</b> <?php echo $_GET['kode']; ?><br>
                  <b>Payment Due:</b> <?php echo $tanggal; ?><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Code #</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
               <tbody>
		<?php
			$nomor_nota = $_GET['kode']; // Pakai nama variabel yang beda biar gak ketuker
			$grandtotal = 0; // PINDAH KE SINI: Di luar while biar gak reset jadi 0 terus

			$sql = "SELECT transaksi_detail.jumlah, barang.nama_barang, transaksi_detail.kode_barang, transaksi_detail.subtotal FROM transaksi_detail
					LEFT JOIN barang ON transaksi_detail.kode_barang=barang.kode_barang
					WHERE transaksi_detail.no_transaksi = '$nomor_nota'";
    
			$query = mysqli_query($conn, $sql);
			while($result = mysqli_fetch_array($query)){
			$grandtotal += $result['subtotal']; 
		?>
			<tr>
				<td><?php echo $result['jumlah'];?></td>
				<td><?php echo $result['nama_barang'];?></td>
				<td><?php echo $result['kode_barang'];?></td>
				<td><?php echo $result['subtotal'];?></td>
			</tr>
		<?php 
	   } 
		?>
			</tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="dist/img/credit/visa.png" alt="Visa">
                  <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="dist/img/credit/american-express.png" alt="American Express">
                  <img src="dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Terima kasih sudah berbelanja! Mohon cek kembali kondisi barang yang diterima. Kami tunggu pesanan Anda berikutnya.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due 28/04/2026</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Grandtotal:</th>
                        <td><?php echo $grandtotal; ?></td>
                      </tr>
                      
                      <?php
                      $kode = $_GET['kode'];
                      $query_bayar = mysqli_query($conn, "SELECT SUM(jumlah) as total_masuk FROM bayar WHERE no_transaksi = '$kode';");
                      $result_bayar = mysqli_fetch_array($query_bayar);
                      $jumlah_bayar = isset($result_bayar['total_masuk']) ? $result_bayar['total_masuk'] : 0;
                      ?>
                      <tr>
                        <th>Jumlah Bayar:</th>
                        <td><?php echo $jumlah_bayar; ?></td>
                      </tr>
                      
                      <?php
                      //rumus e susuk 
                      if ($jumlah_bayar > $grandtotal) {
                          $kembalian = $jumlah_bayar - $grandtotal;
                      } else {
                          $kembalian = 0; 
                      }
                      ?>
                      <tr>
                        <th>Kembalian:</th>
                        <td><?php echo $kembalian; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.php?kode=<?php echo $kode; ?>" rel="noopener" target="_blank" id="print" name="print" class="btn btn-default"><i class="fas fa-print"></i> Print(Q)</a>
				  <a href="https://wa.me/<?php echo $no_handphone; ?>?text=Minimart%20Gemas%0aNo%20Transaksi%20<?php echo $kode; ?>%0a<?php
				  $title = "Transaksi";
				  //memanggil koneksi
				  //include('library/koneksi.php');
				  
				  //menampilkan transaksi tmp
				  $kode = $_GET['kode'];
				  $sql="SELECT transaksi_detail.jumlah, barang.nama_barang, transaksi_detail.kode_barang, transaksi_detail.harga_jual, transaksi_detail.subtotal FROM transaksi_detail
						LEFT JOIN barang ON transaksi_detail.kode_barang=barang.kode_barang
						WHERE transaksi_detail.no_transaksi = '$kode'";
				  $query=mysqli_query($conn, $sql);
				  while($result=mysqli_fetch_array($query)){$kode = $result['kode_barang'];?><?php echo $result['nama_barang'];?>%20<?php echo $result['jumlah'];?>%20x%20<?php echo $result['harga_jual'];?>%0a<?php  $grandtotal = 0;
					$subtotal = $result['subtotal'];
					$grandtotal = $grandtotal + $result['subtotal'];} ?>%0asubtotal%20:%20<?php echo $grandtotal; ?>" rel="noopener" target="_blank" id="whatsapp" name="whatsapp" class="btn btn-default"><i class="fas fa-phone"></i> Whatsapp(W)</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
  </div>
  <!-- /.content-wrapper -->