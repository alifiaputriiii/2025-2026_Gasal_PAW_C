<?php
    $koneksi = mysqli_connect("localhost", "root", "", "store 1");

    if ($koneksi) {
        $query = "SELECT * FROM Transaksi";
        $hasil = mysqli_query($koneksi, $query);
    } else {
        echo "Connection Failed: " . mysqli_connect_error();
    }
?>
