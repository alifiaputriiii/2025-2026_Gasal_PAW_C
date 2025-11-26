<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit();
}

$id_transaksi = $_GET['id_transaksi'];

// Proses tambah item
if (isset($_POST['tambah'])) {
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];

    mysqli_query($koneksi, "INSERT INTO detail_transaksi 
        (id_transaksi, nama_barang, jumlah, harga)
        VALUES ('$id_transaksi', '$nama_barang', '$jumlah', '$harga')");
}
?>

<h2>Detail Transaksi</h2>

<!-- Form Tambah Item -->
<form method="POST">
    <label>Nama Barang</label><br>
    <input type="text" name="nama_barang" required><br><br>

    <label>Jumlah</label><br>
    <input type="number" name="jumlah" required><br><br>

    <label>Harga</label><br>
    <input type="number" name="harga" required><br><br>

    <button type="submit" name="tambah">Tambah Item</button>
</form>

<hr>

<!-- Tabel Item -->
<h3>Daftar Item</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Subtotal</th>
    </tr>

    <?php
    $no = 1;
    $total = 0;

    $query = mysqli_query($koneksi,
        "SELECT * FROM detail_transaksi WHERE id_transaksi='$id_transaksi'");

    while ($row = mysqli_fetch_assoc($query)) {
        $subtotal = $row['jumlah'] * $row['harga'];
        $total += $subtotal;

        echo "
        <tr>
            <td>$no</td>
            <td>{$row['nama_barang']}</td>
            <td>{$row['jumlah']}</td>
            <td>{$row['harga']}</td>
            <td>$subtotal</td>
        </tr>
        ";
        $no++;
    }
    ?>
    <tr>
        <th colspan="4">Total</th>
        <th><?php echo $total; ?></th>
    </tr>
</table>

<br>
<a href="index.php">Selesai</a>
