<?php
$koneksi = mysqli_connect("localhost", "root", "", "store 1");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>

