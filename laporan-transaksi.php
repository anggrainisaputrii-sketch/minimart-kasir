 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
	  <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
	   <?php
		$title = "Kategori";
		//memanggil koneksi
			include('library/koneksi.php');
			
		$tanggal = date('Y-m-d');
				  
		//menampilkan data user
		$sql="SELECT SUM(transaksi_detail.harga_jual*transaksi_detail.jumlah) AS omzet, SUM(transaksi_detail.harga_beli*transaksi_detail.jumlah) AS jumlah_beli FROM transaksi
			 LEFT JOIN transaksi_detail ON transaksi.no_transaksi=transaksi_detail.no_transaksi
			 WHERE transaksi.tanggal='$tanggal';";
		$query=mysqli_query($conn, $sql);
		$result=mysqli_fetch_array($query);
		
		$omzet = $result['omzet'];
		$jumlah_beli = $result['jumlah_beli'];
		$laba = $omzet - $jumlah_beli;
		?>
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Omzet</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $result['omzet']; ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
				 <div class="info-box bg-light">
				  <div class="info-box-content">
					<span class="info-box-text text-center text-muted">Laba</span>
					  <span class="info-box-number text-center text-muted mb-0">
					   <?php echo number_format($laba, 0, ',', '.'); ?>
						</span>
				</div>
				</div>
				</div>

		<?php
			$sql = "SELECT SUM(transaksi_detail.harga_jual * transaksi_detail.jumlah) AS belum FROM transaksi
					LEFT JOIN transaksi_detail ON transaksi.no_transaksi = transaksi_detail.no_transaksi
					LEFT JOIN bayar ON transaksi.no_transaksi = bayar.no_transaksi
					WHERE transaksi.tanggal='$tanggal' AND bayar.jenis_pembayaran = 'belum'";
			$query = mysqli_query($conn, $sql);
			$result = mysqli_fetch_array($query);
		?>
			   <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Belum Terbayar</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $result['belum']; ?></span>
                    </div>
                  </div>
                </div>
				
		<?php
			$sqlcash= "SELECT SUM(transaksi_detail.harga_jual * transaksi_detail.jumlah) AS cash FROM transaksi
						LEFT JOIN transaksi_detail ON transaksi.no_transaksi = transaksi_detail.no_transaksi
						LEFT JOIN bayar ON transaksi.no_transaksi = bayar.no_transaksi
						WHERE transaksi.tanggal='$tanggal' AND bayar.jenis_pembayaran = 'cash'";
			$querycash= mysqli_query($conn, $sqlcash);
			$resultcash= mysqli_fetch_array($querycash);
		?>
					
			   <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">cash</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $resultcash['cash']; ?></span>
                    </div>
                  </div>
                </div>
				
				
		<?php
			$sqltransfer= "SELECT SUM(transaksi_detail.harga_jual * transaksi_detail.jumlah) AS transfer FROM transaksi
							LEFT JOIN transaksi_detail ON transaksi.no_transaksi = transaksi_detail.no_transaksi
							LEFT JOIN bayar ON transaksi.no_transaksi = bayar.no_transaksi
							WHERE transaksi.tanggal='$tanggal' AND bayar.jenis_pembayaran = 'transfer'";
			$querytransfer= mysqli_query($conn, $sqltransfer);
			$resulttransfer= mysqli_fetch_array($querytransfer);
		?>
			   <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">transfer</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $resulttransfer['transfer']; ?></span>
                    </div>
                  </div>
                </div>
				
		<?php
			$sqldebit= "SELECT SUM(transaksi_detail.harga_jual * transaksi_detail.jumlah) AS debit FROM transaksi
						LEFT JOIN transaksi_detail ON transaksi.no_transaksi = transaksi_detail.no_transaksi
						LEFT JOIN bayar ON transaksi.no_transaksi = bayar.no_transaksi
						WHERE transaksi.tanggal='$tanggal' AND bayar.jenis_pembayaran = 'debit'";
			$querydebit= mysqli_query($conn, $sqldebit);
			$resultdebit= mysqli_fetch_array($querydebit);
		?>
		<div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">debit</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $resultdebit['debit']; ?></span>
                    </div>
                  </div>
                </div>
            </div>
		  </div>
        <div class="row">
		
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
				<br />
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No Transaksi</th>
                    <th>Nama</th>
                    <th>grandtotal</th>
                  </tr>
                  </thead>
                  <tbody>
				  <?php
				  $title = "Kategori";
				  //memanggil koneksi
				  //include('library/koneksi.php');
				  
				  $tanggal = date('Y-m-d');
				  
				  //menampilkan data user
				  $sql="SELECT transaksi.no_transaksi, operator.nama, pelanggan.nama_pelanggan, transaksi.grandtotal FROM transaksi
						LEFT JOIN operator ON transaksi.kode_operator=operator.kode_operator
						LEFT JOIN pelanggan ON transaksi.kode_pelanggan= pelanggan.kode_pelanggan
						 WHERE transaksi.tanggal='$tanggal'";
				  $query=mysqli_query($conn, $sql);
				  while($result=mysqli_fetch_array($query)){
					  $kode = $result['no_transaksi'];
				  ?>
                  <tr>
                    <td><?php echo $result['no_transaksi'];?></td>
                    <td><?php echo $result['nama_pelanggan'];?></td>
                    <td><?php echo $result['grandtotal'];?></td>
                  </tr>
				  <?php
				  }
				  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Kode Operator</th>
                    <th>Nama</th>
                    <th>grandtotal</th>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->