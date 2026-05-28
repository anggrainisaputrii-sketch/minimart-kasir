<?php
session_start();
include('library/koneksi.php');
header('Content-Type: application/json');

$barcode = $_POST['barcode'] ?? '';
$kode_operator = $_SESSION['kode_operator'] ?? $_POST['kode_operator'] ?? '';

if (empty($barcode)) {
    echo json_encode(['status' => 'error', 'message' => 'Barcode kosong']);
    exit;
}

$barcode = mysqli_real_escape_string($conn, $barcode);
$query = mysqli_query($conn, "SELECT * FROM barang WHERE barcode = '$barcode' LIMIT 1");

if (mysqli_num_rows($query) == 0) {
    echo json_encode(['status' => 'error', 'message' => 'Barang tidak ditemukan']);
    exit;
}

$barang = mysqli_fetch_array($query);
$kode_barang = $barang['kode_barang'];
$nama_barang = $barang['nama_barang'];
$harga_beli  = $barang['harga_beli'];
$harga_jual  = $barang['harga_jual'];
$jumlah      = 1;
$subtotal    = $harga_jual * $jumlah;

$cek = mysqli_query($conn, "SELECT * FROM tmp_transaksi WHERE kode_barang = '$kode_barang' AND kode_operator = '$kode_operator'");
if (mysqli_num_rows($cek) > 0) {
    $existing = mysqli_fetch_array($cek);
    $jumlah_baru = $existing['jumlah'] + 1;
    $subtotal_baru = $jumlah_baru * $harga_jual;
    mysqli_query($conn, "UPDATE tmp_transaksi SET jumlah = '$jumlah_baru', subtotal = '$subtotal_baru' WHERE kode_barang = '$kode_barang' AND kode_operator = '$kode_operator'");
} else {
    mysqli_query($conn, "INSERT INTO tmp_transaksi (kode_barang, harga_beli, harga_jual, jumlah, subtotal, kode_operator) VALUES ('$kode_barang', '$harga_beli', '$harga_jual', '$jumlah', '$subtotal', '$kode_operator')");
}

echo json_encode([
    'status'      => 'success',
    'nama_barang' => $nama_barang,
    'harga_jual'  => $harga_jual
]);