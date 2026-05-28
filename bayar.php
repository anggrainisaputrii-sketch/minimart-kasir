<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <?php
            include('library/koneksi.php');

            // FIX: cek dulu apakah kode ada
            $kode = isset($_GET['kode']) ? $_GET['kode'] : '';

            if ($kode != '') {
              $sql = "SELECT pelanggan.nama_pelanggan FROM transaksi
                      LEFT JOIN pelanggan ON transaksi.kode_pelanggan = pelanggan.kode_pelanggan
                      LEFT JOIN bayar ON transaksi.no_transaksi = bayar.no_transaksi
                      WHERE transaksi.no_transaksi = '$kode'
                      GROUP BY transaksi.no_transaksi;";
              $query  = mysqli_query($conn, $sql);
              $result = mysqli_fetch_array($query);
            } else {
              $result = null;
            }
          ?>
          <h1><?php echo $result ? $result['nama_pelanggan'] : 'Data tidak ditemukan'; ?></h1>
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
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Quick Example</h3>
            </div>

            <?php
              // FIX: pakai $kode yang sudah dicek sebelumnya
              if ($kode != '') {
                $sql = "SELECT transaksi.no_transaksi AS nota, transaksi.tanggal, transaksi.kode_pelanggan,
                               pelanggan.nama_pelanggan, transaksi.grandtotal,
                               transaksi.grandtotal-(SELECT SUM(jumlah) FROM bayar WHERE no_transaksi = nota) AS jumlah
                        FROM transaksi
                        LEFT JOIN pelanggan ON transaksi.kode_pelanggan = pelanggan.kode_pelanggan
                        LEFT JOIN bayar ON transaksi.no_transaksi = bayar.no_transaksi
                        WHERE transaksi.no_transaksi = '$kode'
                        GROUP BY transaksi.no_transaksi;";
                $query = mysqli_query($conn, $sql);
                $row   = mysqli_fetch_array($query);
              } else {
                $row = null;
              }
            ?>

            <form action="transaksi-belum-simpan.php" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label>No Transaksi</label>
                  <input type="text" name="no_transaksi" class="form-control" placeholder="no_transaksi"
                         value="<?php echo $row ? $row['nota'] : ''; ?>">

                  <label>Tanggal</label>
                  <input type="text" name="tanggal" class="form-control" placeholder="tanggal"
                         value="<?php echo $row ? $row['tanggal'] : ''; ?>">

                  <label>Jumlah</label>
                  <input type="text" name="jumlah" class="form-control" placeholder="jumlah"
                         value="<?php echo $row ? $row['jumlah'] : ''; ?>">

                  <label>Jenis Pembayaran</label>
                  <select class="custom-select rounded-0" name="jenis_bayar">
                    <option value="belum">Belum</option>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                    <option value="debit">Debit</option>
                  </select>

                  <label>Bayar</label>
                  <input type="text" name="bayar" class="form-control" placeholder="bayar" value="">
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>