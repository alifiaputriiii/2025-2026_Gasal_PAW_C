<?php
session_start();
include "koneksi.php";

// Jika belum login
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit();
}

$filter = "";
if (isset($_POST['cari'])) {
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];

    $filter = "WHERE tanggal BETWEEN '$awal' AND '$akhir'";
}
?>

<h2>Laporan Transaksi</h2>

<form method="POST">
    <label>Dari Tanggal:</label>
    <input type="date" name="awal" required>

    <label>Sampai Tanggal:</label>
    <input type="date" name="akhir" required>

    <button type="submit" name="cari">Tampilkan</button>
</form>

<hr>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Jumlah</th>
        <th>User</th>
    </tr>

    <?php
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM transaksi $filter ORDER BY tanggal ASC");

    $total = 0;

    while ($row = mysqli_fetch_assoc($data)) {
        echo "
        <tr>
            <td>$no</td>
            <td>{$row['tanggal']}</td>
            <td>{$row['keterangan']}</td>
            <td>{$row['jumlah']}</td>
            <td>{$row['username']}</td>
        </tr>";
        $total += $row['jumlah'];
        $no++;
    }
    ?>

    <tr>
        <th colspan='3'>TOTAL</th>
        <th colspan='2'><?php echo $total; ?></th>
    </tr>
</table>
