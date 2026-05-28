<?php
include 'koneksi.php';

$tahun = isset($_GET['tahun']) ? intval($_GET['tahun']) : date('Y');

$query = "SELECT 
    MONTH(tanggal) as bulan, 
    SUM(grandtotal) as total_penjualan,
    COUNT(no_transaksi) as jumlah_transaksi
FROM transaksi 
WHERE YEAR(tanggal) = $tahun
GROUP BY MONTH(tanggal)
ORDER BY MONTH(tanggal)";

$result = mysqli_query($conn, $query);

$nama_bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

$data_penjualan = array_fill(1, 12, 0);
$data_transaksi = array_fill(1, 12, 0);

while ($row = mysqli_fetch_assoc($result)) {
    $data_penjualan[$row['bulan']] = (int)$row['total_penjualan'];
    $data_transaksi[$row['bulan']] = (int)$row['jumlah_transaksi'];
}

$penjualan_json = json_encode(array_values($data_penjualan));
$transaksi_json = json_encode(array_values($data_transaksi));
$labels_json    = json_encode($nama_bulan);

$total_tahun     = array_sum($data_penjualan);
$total_transaksi = array_sum($data_transaksi);
?>

<div class="container-fluid">
  <div class="row mb-3">
    <div class="col-12">
      <h4 class="font-weight-bold" style="color:#be185d;">
        <i class="fas fa-chart-bar mr-2"></i>Grafik Penjualan Bulanan
      </h4>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-4">
      <form method="GET" action="owner.php">
        <input type="hidden" name="page" value="laporan-bulanan">
        <div class="input-group">
          <input type="number" name="tahun" class="form-control" value="<?= $tahun ?>" min="2000" max="2099">
          <div class="input-group-append">
            <button type="submit" class="btn" style="background:#f472b6;color:#fff;border:none;">
              <i class="fas fa-search"></i> Tampilkan
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-6">
      <div class="card" style="border-left:4px solid #f472b6;border-radius:10px;">
        <div class="card-body">
          <div class="text-muted" style="font-size:.85rem;">Total Penjualan <?= $tahun ?></div>
          <div style="font-size:1.5rem;font-weight:700;color:#be185d;">
            Rp <?= number_format($total_tahun, 0, ',', '.') ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card" style="border-left:4px solid #f9a8c9;border-radius:10px;">
        <div class="card-body">
          <div class="text-muted" style="font-size:.85rem;">Total Transaksi <?= $tahun ?></div>
          <div style="font-size:1.5rem;font-weight:700;color:#ec4899;">
            <?= number_format($total_transaksi, 0, ',', '.') ?> transaksi
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card" style="border-radius:12px;box-shadow:0 2px 16px rgba(236,72,153,.1);">
        <div class="card-header" style="background:linear-gradient(135deg,#f9a8c9,#f472b6);border-radius:12px 12px 0 0;">
          <h5 class="card-title mb-0" style="color:#fff;">
            <i class="fas fa-chart-bar mr-2"></i>Penjualan per Bulan — <?= $tahun ?>
          </h5>
        </div>
        <div class="card-body">
          <canvas id="grafikBulanan" height="80"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  var ctx = document.getElementById('grafikBulanan').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= $labels_json ?>,
      datasets: [
        {
          label: 'Total Penjualan (Rp)',
          data: <?= $penjualan_json ?>,
          backgroundColor: 'rgba(244,114,182,0.5)',
          borderColor: '#f472b6',
          borderWidth: 2
        },
        {
          label: 'Jumlah Transaksi',
          data: <?= $transaksi_json ?>,
          backgroundColor: 'rgba(190,24,93,0.3)',
          borderColor: '#be185d',
          borderWidth: 2,
          type: 'line',
          fill: false,
          pointBackgroundColor: '#be185d',
          pointRadius: 5
        }
      ]
    },
    options: {
      responsive: true,
      legend: { position: 'top' },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            callback: function(value) {
              return 'Rp ' + value.toLocaleString('id-ID');
            }
          },
          gridLines: { color: 'rgba(244,114,182,0.1)' }
        }],
        xAxes: [{
          gridLines: { color: 'rgba(244,114,182,0.05)' }
        }]
      },
      tooltips: {
        callbacks: {
          label: function(item, data) {
            var label = data.datasets[item.datasetIndex].label;
            if (item.datasetIndex === 0) {
              return label + ': Rp ' + item.yLabel.toLocaleString('id-ID');
            }
            return label + ': ' + item.yLabel + ' transaksi';
          }
        }
      }
    }
  });
})();
</script>