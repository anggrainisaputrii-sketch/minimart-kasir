<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data belum terbayar</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
              <br />
              <a href="?page=kategori-tambah" class="btn btn-outline-primary btn-block">Tambah <i class="nav-icon fas fa-plus-square"></i></a>
            </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No Transaksi</th>
                    <th>Nama</th>
                    <th>Grandtotal</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  include('library/koneksi.php');

                  $sql = "SELECT transaksi.no_transaksi, transaksi.kode_pelanggan, 
               pelanggan.nama_pelanggan, transaksi.grandtotal
        FROM transaksi
        LEFT JOIN pelanggan ON transaksi.kode_pelanggan = pelanggan.kode_pelanggan
        LEFT JOIN bayar ON transaksi.no_transaksi = bayar.no_transaksi
        WHERE (bayar.jenis_pembayaran = 'belum' OR bayar.no_transaksi IS NULL)
        GROUP BY transaksi.no_transaksi";

                  $query = mysqli_query($conn, $sql);
                  while ($result = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td><?php echo $result['no_transaksi']; ?></td>
                    <td><?php echo $result['nama_pelanggan']; ?></td>
                    <td><?php echo $result['grandtotal']; ?></td>
                    <td><a href="?page=bayar&kode=<?php echo $kode; ?>" class="nav-link">
                      <i class="nav-icon fas fa-pencil-alt"></i>
                    </a></td>
                  </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No Transaksi</th>
                    <th>Nama</th>
                    <th>Grandtotal</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>