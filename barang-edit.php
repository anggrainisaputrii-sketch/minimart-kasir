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
				
				 //menampilkan data user
				  $kode 	= $_GET['kode'];
				  $sql 		= "SELECT * FROM barang WHERE kode_barang = '$kode'";
				  $query 	= mysqli_query($conn, $sql);
				  $edit 	= mysqli_fetch_array($query);

				?>
              <form action="barang-proses-edit.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama barang</label>
                    <input type="hidden" name="kode_barang" class="form-control" id="exampleInputEmail1" placeholder="Nama" value="<?php echo $edit['kode_barang']; ?>">
                    <input type="text" name="nama_barang" class="form-control" id="exampleInputEmail1" placeholder="Nama barang" value="<?php echo $edit['nama_barang']; ?>">
					</div>
                 <div class="form-group">
                  <label for="exampleSelectRounded0">Nama Kategori</label>
                     <select class="custom-select rounded-0" name="kode_kategori" id="exampleSelectRounded0">
                     <option value = "kosong">....</option>
					   <?php 
					  $kategori = $edit['kode_kategori'];
					  //menampilkan data user
					  $sql="SELECT * FROM kategori";
					  $query=mysqli_query($conn, $sql);
					  while($result=mysqli_fetch_array($query)){
					  $kode_kategori = $result['kode_kategori'];
					  if($kategori == $kode_kategori){
						$cek="selected";
					}else {
						$cek= "";
					}
					echo "<option value = '$result[kode_kategori]' $cek> $result[nama_kategori] </option>";
					}
					 ?>
                  </select>
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">harga beli</label>
                    <input type="text" name="harga_beli" class="form-control" id="exampleInputEmail1" placeholder="harga beli" value="<?php echo $edit['harga_beli']; ?>">
					</div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">harga jual</label>
                    <input type="text" name="harga_jual" class="form-control" id="exampleInputEmail1" placeholder="harga jual" value="<?php echo $edit['harga_jual']; ?>">
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">stok</label>
                    <input type="text" name="stok" class="form-control" id="exampleInputEmail1" placeholder="stok" value="<?php echo $edit['stok']; ?>">
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