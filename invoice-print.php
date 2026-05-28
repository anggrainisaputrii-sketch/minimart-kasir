<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Invoice Print</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-shopping-cart"></i> Minimart Gemas.
          <small class="float-right">Date: 01/05/2026</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>Admin, imut lucu</strong><br>
          sukodono,denok<br>
          Anggi,Joy, Lmj<br>
          Phone: 6285880538948<br>
          Email: angrainisaputri123gmail.com
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
     <?php
					//include('library/koneksi.php');
						//menampilkan data grandtotal
						$kode 	= $_GET['kode'];
						$query = mysqli_query ($conn, "SELECT * FROM transaksi WHERE no_transaksi = '$kode';");
						$result=mysqli_fetch_array($query);
						$tanggal = $result['tanggal'];
					?>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #<?php echo  $_GET['kode']; ?></b><br>
                  <br>
                  <b>Order ID:</b> <?php echo  $_GET['kode']; ?><br>
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

    $sql = "SELECT transaksi_detail.jumlah, barang.nama_barang, transaksi_detail.kode_barang, transaksi_detail.subtotal 
            FROM transaksi_detail
            LEFT JOIN barang ON transaksi_detail.kode_barang=barang.kode_barang
            WHERE transaksi_detail.no_transaksi = '$nomor_nota'";
    
    $query = mysqli_query($conn, $sql);

    while($result = mysqli_fetch_array($query)){
        // Tambahkan subtotal barang ini ke grandtotal (pakai += biar nambah terus)
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
        <p class="lead">Amount Due 2/22/2014</p>

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
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>