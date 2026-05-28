<?php
include "library/koneksi.php";
$search = isset($_GET['term']) ? $_GET['term'] : '';

$sql = "SELECT * FROM barang WHERE nama_barang LIKE '%$search%' ORDER BY nama_barang ASC";
$hasil = mysqli_query($conn, $sql);

$data = array();
while ($row = mysqli_fetch_array($hasil)) {
    $data[] = array(
        'label' => $row['nama_barang'],
        'value' => $row['nama_barang'],
        'kode_barang' => $row['kode_barang'],
        'nama_barang' => $row['nama_barang'],
        'harga_jual' => $row['harga_jual'],
        'harga_beli' => $row['harga_beli']
    );
}
echo json_encode($data);
// ?>