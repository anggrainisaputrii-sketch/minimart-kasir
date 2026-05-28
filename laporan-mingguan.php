<?php
include 'koneksi.php';
error_reporting(0);

$bulan = isset($_GET['bulan']) ? intval($_GET['bulan']) : date('m');
$tahun = isset($_GET['tahun']) ? intval($_GET['tahun']) : date('Y');

$nama_bulan = ['','Januari','Februari','Maret','April','Mei','Juni',
               'Juli','Agustus','September','Oktober','November','Desember'];

$query = "SELECT 
    FLOOR((DAY(tanggal) - 1) / 7) + 1 as minggu_bulan,
    SUM(grandtotal) as total_penjualan,
    COUNT(no_transaksi) as jumlah_transaksi,
    MIN(DATE(tanggal)) as tgl_mulai,
    MAX(DATE(tanggal)) as tgl_akhir
FROM transaksi 
WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun
GROUP BY FLOOR((DAY(tanggal) - 1) / 7)
ORDER BY minggu_bulan";

$result = mysqli_query($conn, $query);

$labels = ['Minggu 1','Minggu 2','Minggu 3','Minggu 4','Minggu 5'];
$data_penjualan = [0, 0, 0, 0, 0];
$data_transaksi = [0, 0, 0, 0, 0];

while ($row = mysqli_fetch_assoc($result)) {
    $m = (int)$row['minggu_bulan'];
    if ($m >= 1 && $m <= 5) {
        $tgl_mulai = date('d/m', strtotime($row['tgl_mulai']));
        $tgl_akhir = date('d/m', strtotime($row['tgl_akhir']));
        $labels[$m-1] = "Minggu $m ($tgl_mulai-$tgl_akhir)";
        $data_penjualan[$m-1] = (int)$row['total_penjualan'];
        $data_transaksi[$m-1] = (int)$row['jumlah_transaksi'];
    }
}

$penjualan_json = json_encode($data_penjualan);
$transaksi_json = json_encode($data_transaksi);
$labels_json    = json_encode($labels);

$total_bulan     = array_sum($data_penjualan);
$total_transaksi = array_sum($data_transaksi);
?>

<div class="container-fluid">
  <div class="row mb-3">
    <div class="col-12">
      <h4 class="font-weight-bold" style="color:#be185d;">
        <i class="fas fa-chart-line mr-2"></i>Grafik Penjualan Mingguan
      </h4>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-5">
      <form method="GET" action="owner.php">
        <input type="hidden" name="page" value="laporan-mingguan">
        <div class="input-group">
          <select name="bulan" class="form-control">
            <?php for($i=1; $i<=12; $i++): ?>
              <option value="<?= $i ?>" <?= $i == $bulan ? 'selected' : '' ?>>
                <?= $nama_bulan[$i] ?>
              </option>
            <?php endfor; ?>
          </select>
          <input type="number" name="tahun" class="form-control" value="<?= $tahun ?>" min="2000" max="2099" style="max-width:100px;">
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
          <div class="text-muted" style="font-size:.85rem;">Total Penjualan <?= $nama_bulan[$bulan] ?> <?= $tahun ?></div>
          <div style="font-size:1.5rem;font-weight:700;color:#be185d;">
            Rp <?= number_format($total_bulan, 0, ',', '.') ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card" style="border-left:4px solid #f9a8c9;border-radius:10px;">
        <div class="card-body">
          <div class="text-muted" style="font-size:.85rem;">Total Transaksi <?= $nama_bulan[$bulan] ?> <?= $tahun ?></div>
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
            <i class="fas fa-chart-line mr-2"></i>Penjualan per Minggu — <?= $nama_bulan[$bulan] ?> <?= $tahun ?>
          </h5>
        </div>
        <div class="card-body">
          <canvas id="grafikMingguan" height="80"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  var ctx = document.getElementById('grafikMingguan').getContext('2d');
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