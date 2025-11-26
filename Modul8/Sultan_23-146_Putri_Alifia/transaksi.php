<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal = $_POST['tanggal'];
    $username = $_SESSION['username'];

    mysqli_query($koneksi, "INSERT INTO transaksi (tanggal, username)
                            VALUES ('$tanggal', '$username')");

    $id_transaksi = mysqli_insert_id($koneksi);

    header("location:detail_transaksi.php?id_transaksi=$id_transaksi");
    exit();
}
?>

<h2>Input Transaksi</h2>

<form method="POST">
    <label>Tanggal</label><br>
    <input type="date" name="tanggal" required><br><br>

    <button type="submit">Lanjut Tambah Barang</button>
</form>
