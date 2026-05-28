<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
		  <?php
		  //memanggil koneksi
		    include('library/koneksi.php');
			
		   $kode = $_GET['kode'];
				  $sql="SELECT * FROM pelanggan 
						WHERE kode_pelanggan='$kode';";
				  $query=mysqli_query($conn, $sql);
				  $result=mysqli_fetch_array($query);
			?>
            <h1><?php echo $result['nama_pelanggan']; ?></h1>
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
                    <th>Grandtotal</th>
                    <th>Terbayar</th>
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody>
				  <?php
				  $title = "Kategori";
				  
				  
				  //menampilkan data user
				  $kode = $_GET['kode'];
				  $sql="SELECT transaksi.no_transaksi, transaksi.tanggal, transaksi.kode_pelanggan, pelanggan.nama_pelanggan, transaksi.grandtotal, bayar.jumlah FROM transaksi
						LEFT JOIN pelanggan ON transaksi.kode_pelanggan=pelanggan.kode_pelanggan
						LEFT JOIN bayar ON transaksi.no_transaksi=bayar.no_transaksi
						WHERE transaksi.kode_pelanggan='$kode';";
				  $query=mysqli_query($conn, $sql);
				  while($result=mysqli_fetch_array($query)){
					  $kode = $result['kode_pelanggan'];
				  ?>
                  <tr>
                    <td><?php echo $result['no_transaksi'];?></td>
                    <td><?php echo $result['grandtotal'];?></td>
                    <td><?php echo $result['jumlah'];?></td>
                    <td><a href="?page=bayar&kode=<?php echo $kode; ?>" class="nav-link"><i class="nav-icon fas fa-pencil-alt"></i></a></td>
                  </tr>
				  <?php
				  }
				  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No Transaksi</th>
                    <th>Nama</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
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