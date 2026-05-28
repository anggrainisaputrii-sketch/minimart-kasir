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
				
				$query 		  = mysqli_query($conn, "SELECT max(kode_kategori) as kodeterakhir FROM kategori");
				$isi 		  = mysqli_fetch_array($query);
				$Kode = $isi['kodeterakhir'];
				
				$KodeOtomatis = (int) substr($Kode, 2, 8);
				$KodeOtomatis++;
				
				$KodeData = "KT";
				$Kode = $KodeData . sprintf("%08s", $KodeOtomatis);

				?>
              <form action="kategori-simpan.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Kategori</label>
                    <input type="text" name="kode_kategori" class="form-control" id="exampleInputEmail1" placeholder="Nama" value="<?php echo $Kode; ?>">
                    <input type="text" name="nama_kategori" class="form-control" id="exampleInputEmail1" placeholder="Nama Kategori">
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