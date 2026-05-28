<?php
include 'koneksi.php';
?>

<div class="container-fluid">
  <div class="row mb-3">
    <div class="col-12">
      <h4 class="font-weight-bold" style="color:#be185d;">
        <i class="fas fa-chart-pie mr-2"></i>Laporan Penjualan
      </h4>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>
            <?php 
              $q = mysqli_query($conn, "SELECT SUM(grandtotal) AS total FROM transaksi");
              $d = mysqli_fetch_assoc($q);
              echo "Rp " . number_format($d['total'] ?? 0, 0, ',', '.');
            ?>
          </h3>
          <p>Total Pendapatan</p>
        </div>
        <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>
            <?php 
              $q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM transaksi");
              $d = mysqli_fetch_assoc($q);
              echo $d['total'] ?? 0;
            ?>
          </h3>
          <p>Jumlah Transaksi</p>
        </div>
        <div class="icon"><i class="fas fa-shopping-cart"></i></div>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>
            <?php 
              $q = mysqli_query($conn, "SELECT SUM(jumlah) AS jml FROM transaksi_detail");
              $d = mysqli_fetch_assoc($q);
              echo $d['jml'] ?? 0;
            ?>
          </h3>
          <p>Barang Terjual</p>
        </div>
        <div class="icon"><i class="fas fa-box"></i></div>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>
            <?php 
              $q = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM barang WHERE stok < 5");
              $d = mysqli_fetch_assoc($q);
              echo $d['jumlah'] ?? 0;
            ?>
          </h3>
          <p>Stok Menipis</p>
        </div>
        <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card" style="border-radius:12px;box-shadow:0 2px 16px rgba(236,72,153,.1);">
        <div class="card-header" style="background:linear-gradient(135deg,#f9a8c9,#f472b6);border-radius:12px 12px 0 0;">
          <h5 class="card-title mb-0" style="color:#fff;">
            <i class="fas fa-list mr-2"></i>Transaksi Terakhir
          </h5>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
                <tr>
                  <th>No. Transaksi</th>
                  <th>Kode Pelanggan</th>
                  <th>Total Belanja</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $tampil = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY tanggal DESC LIMIT 5");
                  while($r = mysqli_fetch_array($tampil)) {
                ?>
                <tr>
                  <td><a href="#" style="color:#ec4899;"><?= $r['no_transaksi'] ?></a></td>
                  <td><?= $r['kode_pelanggan'] ?></td>
                  <td>Rp <?= number_format($r['grandtotal'], 0, ',', '.') ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>