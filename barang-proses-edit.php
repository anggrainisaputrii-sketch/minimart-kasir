<?php
include('library/koneksi.php');

$kode_barang   = $_POST['kode_barang'];
$nama_barang   = $_POST['nama_barang'];
$kode_kategori = $_POST['kode_kategori'];
$harga_beli    = $_POST['harga_beli'];
$harga_jual    = $_POST['harga_jual'];
$stok          = $_POST['stok'];

// NAH, CEK URUTAN DI SINI:
$query = "UPDATE barang SET 
          nama_barang = '$nama_barang', 
          kode_kategori = '$kode_kategori', 
          harga_beli = '$harga_beli', 
          harga_jual = '$harga_jual', 
          stok = '$stok' 
          WHERE kode_barang = '$kode_barang'";

$update = mysqli_query($conn, $query);

if($update){
    echo "<meta http-equiv='refresh' content='0;url=index.php?page=barang-data'>";
} else {
    echo "Gagal update data!";
}
?>