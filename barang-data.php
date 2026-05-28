 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Barang</h1>
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
                <a href="?page=barang-tambah" class="btn btn-outline-primary btn-block">Tambah <i class="nav-icon fas fa-plus-square"></i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Kode barang</th>
                    <th>Nama barang</th>
					<th>Kategori</th>
					<th>Harga beli</th>
					<th>Harga jual</th>
					<th>tok</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                  </thead>
                  <tbody>
				  <?php
				  $title = "Kategori";
				  //memanggil koneksi
				  include('library/koneksi.php');
				  
				  //menampilkan data user
				  $sql="SELECT kode_barang, nama_barang, kategori.nama_kategori, harga_beli, harga_jual, stok FROM barang
                        LEFT JOIN kategori ON barang.kode_kategori = kategori.kode_kategori";
				  $query=mysqli_query($conn, $sql);
				  while($result=mysqli_fetch_array($query)){
					  $kode = $result['kode_barang'];
				  ?>
                  <tr>
                    <td><?php echo $result['kode_barang'];?></td>
                    <td><?php echo $result['nama_barang'];?></td>
                    <td><?php echo $result['nama_kategori'];?></td>
                    <td><?php echo $result['harga_beli'];?></td>
                    <td><?php echo $result['harga_jual'];?></td>
                    <td><?php echo $result['stok'];?></td>
                    <td><a href="?page=barang-edit&kode=<?php echo $kode; ?>" class="nav-link"><i class="nav-icon fas fa-pencil-alt"></i></a></td>
                    <td><a href="?page=barang-hapus&kode=<?php echo $kode; ?>" class="nav-link"><i class="nav-icon fas fa-trash-alt"></i></a></td>
                  </tr>
				  <?php
				  }
				  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Kode barang</th>
                    <th>Nama barang</th>
					<th>Kategori</th>
					<th>Harga beli</th>
					<th>Harga jual</th>
					<th>tok</th>
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