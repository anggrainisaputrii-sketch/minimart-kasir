<?php session_start(); 
if(empty($_SESSION['kode_operator'])) {
    header('location: login.php');
    exit;
}
$kode_operator = $_SESSION['kode_operator'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Scan Barcode</title>
  <style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: sans-serif;
  }

  body {
    background: #1a1a2e;
    color: #fff;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
  }

  h2 {
    margin: 20px 0 10px;
    font-size: 20px;
    color: #a78bfa;
  }

  #reader {
    width: 100%;
    max-width: 400px;
    border-radius: 12px;
    overflow: hidden;
    border: 2px solid #a78bfa;
  }

  #result {
    margin-top: 16px;
    width: 100%;
    max-width: 400px;
  }

  .alert {
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 14px;
    margin-bottom: 10px;
  }

  .alert-success {
    background: #e1f5ee;
    color: #0F6E56;
  }

  .alert-danger {
    background: #fcebeb;
    color: #A32D2D;
  }

  #last-scan {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    padding: 12px 16px;
    margin-top: 10px;
    font-size: 13px;
    color: rgba(255,255,255,0.7);
  }

  .item-name {
    font-size: 16px;
    font-weight: 500;
    color: #fff;
    margin-top: 4px;
  }

  .btn-test {
    width: 100%;
    max-width: 400px;
    margin-top: 10px;
    padding: 12px;
    border-radius: 10px;
    border: none;
    background: #a78bfa;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
  }

  #manual-input {
    width: 100%;
    max-width: 400px;
    margin-top: 10px;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #a78bfa;
    background: rgba(255,255,255,0.07);
    color: #fff;
    font-size: 14px;
    text-align: center;
  }
</style>
</head>
<body>
  <h2>Scanner Barcode</h2>
  <p style="font-size:13px; color:rgba(255,255,255,0.5); margin-bottom:16px;">Arahkan kamera ke barcode produk</p>
  <div id="reader"></div>
  <input type="text" id="manual-input" placeholder="Atau ketik barcode manual...">
  <button class="btn-test" onclick="kirimBarcode(document.getElementById('manual-input').value)">Kirim Manual</button>
  <div id="result"></div>
  <div id="last-scan">Belum ada scan...</div>

  <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
  <script>
    var lastCode = "";
    var kodeOperator = "<?php echo $kode_operator; ?>";

    function kirimBarcode(code) {
      if (!code) return;
      document.getElementById('last-scan').innerHTML = 'Scanning: <span class="item-name">' + code + '</span>';
      var xhr = new XMLHttpRequest();
      xhr.open('POST', window.location.origin + '/kasir/scan-proses.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        var data = JSON.parse(xhr.responseText);
        var div = document.getElementById('result');
        if (data.status === 'success') {
          div.innerHTML = '<div class="alert alert-success">Berhasil: ' + data.nama_barang + ' ditambahkan!</div>';
          document.getElementById('last-scan').innerHTML = 'Terakhir: <span class="item-name">' + data.nama_barang + '</span>';
        } else {
          div.innerHTML = '<div class="alert alert-danger">Gagal: ' + data.message + '</div>';
        }
        setTimeout(function() { lastCode = ""; }, 3000);
      };
      xhr.send('barcode=' + encodeURIComponent(code) + '&kode_operator=' + encodeURIComponent(kodeOperator));
    }

    var html5QrCode = new Html5Qrcode("reader");
    html5QrCode.start(
      { facingMode: "environment" },
      { fps: 10, qrbox: { width: 250, height: 150 } },
      function(code) {
        if (code === lastCode) return;
        lastCode = code;
        kirimBarcode(code);
      },
      function(err) {}
    ).catch(function(err) {
      document.getElementById('result').innerHTML = '<div class="alert alert-danger">Kamera error: ' + err + '</div>';
    });
  </script>
</body>
</html>