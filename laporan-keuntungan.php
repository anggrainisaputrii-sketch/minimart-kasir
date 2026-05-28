<?php
include "koneksi.php"; 
?>

<div class="row">
  <div class="col-12"> <div class="content-header px-0">
      <h3 class="m-0">Laporan Keuntungan (Profit)</h3>
    </div>

    <?php
    // Query buat nyari TOTAL UNTUNG BERSIH (Sum dari: (harga_jual - harga_beli) * jumlah)
    // Diambil dari tabel transaksi_detail
    $query_total = mysqli_query($conn, "SELECT SUM((harga_jual - harga_beli) * jumlah) AS total_untung FROM transaksi_detail");
    $data_total = mysqli_fetch_assoc($query_total);
    $total_untung = $data_total['total_untung'] ?? 0;
    ?>

    <div class="card bg-success col-md-4 pl-0 pr-0">
      <div class="card-body">
        <h2 class="font-weight-bold">Rp <?php echo number_format($total_untung, 0, ',', '.'); ?></h2>
        <p class="mb-0">Total Untung Bersih Hari Ini</p>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Detail Keuntungan...</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover table-bordered text-nowrap mb-0">
          <thead>
            <tr class="bg-light">
              <th>No. Transaksi</th>
              <th>Nama Barang</th>
              <th>Harga Beli</th>
              <th>Harga Jual</th>
              <th>Jumlah Belanja</th>
              <th>Untung Bersih Toko</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Query buat nampilin baris data detail transaksi
            // Kita hitung langsung untung bersih per baris di dalam SQL
            $query_detail = mysqli_query($conn, "SELECT *, (harga_jual - harga_beli) * jumlah AS untung_bersih FROM transaksi_detail ORDER BY no_transaksi DESC");
            
            // Perulangan/Looping biar data otomatis nambah pas di-input
            while ($row = mysqli_fetch_array($query_detail)) {
                // Sambil nunggu kamu bikin relasi nama_barang, sementara kita tampilin kode_barangnya dulu ya biar gak kosong
                $nama_barang = isset($row['nama_barang']) ? $row['nama_barang'] : $row['kode_barang'];
            ?>
            <tr>
              <td><?php echo $row['no_transaksi']; ?></td>
              <td><?php echo $nama_barang; ?></td>
              <td>Rp <?php echo number_format($row['harga_beli'], 0, ',', '.'); ?></td>
              <td>Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></td>
              <td><?php echo $row['jumlah']; ?></td>
              <td class="text-success font-weight-bold">
                Rp <?php echo number_format($row['untung_bersih'], 0, ',', '.'); ?>
              </td>
            </tr>
            <?php 
            } // Penutup Looping
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>