<?php
include 'koneksi.php';
$id_detail = $_GET['id'];
$id_transaksi = $_GET['trans'];

// Hapus detail
mysqli_query($koneksi, "DELETE FROM detail_transaksi WHERE id_detail='$id_detail'");

// Update total lagi
mysqli_query($koneksi, "UPDATE transaksi 
    SET total=(SELECT IFNULL(SUM(subtotal),0) FROM detail_transaksi WHERE id_transaksi='$id_transaksi')
    WHERE id_transaksi='$id_transaksi'");

header("Location: detail.php?id=$id_transaksi");
?>
