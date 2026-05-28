<?php
    include('library/koneksi.php');
    
    $kode = $_GET['kode'];
    $query = "DELETE FROM tmp_transaksi WHERE id = '$kode'";
    $input = mysqli_query($conn, $query);
    
    if($input) {
        echo "<meta http-equiv='refresh' content='0;url=index.php?page=transaksi'>";
    } else {
        header("location: ?page=user-tambah");
    }
?>