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
        <div class="row">
          <div class="col-12">
                <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  <?php
				include('library/koneksi.php');
				
				$query 		  = mysqli_query($conn, "SELECT max(kode_pelanggan) as kodeterakhir FROM pelanggan");
				$isi 		  = mysqli_fetch_array($query);
				$Kode = $isi['kodeterakhir'];
				
				$KodeOtomatis = (int) substr($Kode, 2, 8);
				$KodeOtomatis++;
				
				$KodeData = "PL";
				$Kode = $KodeData . sprintf("%08s", $KodeOtomatis);

				?>
              <form action="pelanggan-simpan.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kode Pelanggan</label>
                    <input type="text" name="kode_pelanggan" class="form-control" id="exampleInputEmail1" placeholder="Nama" value="<?php echo $Kode; ?>">
					<label for="exampleInputEmail1">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control" id="exampleInputEmail1" placeholder="Nama Kategori">
					<label for="exampleInputEmail1">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="exampleInputEmail1" placeholder="Nama Kategori">
					<label for="exampleInputEmail1">No Hp</label>
                    <input type="text" name="no_hp" class="form-control" id="exampleInputEmail1" placeholder="Nama Kategori">
                  </div>
              </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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