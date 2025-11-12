<?php 
include 'koneksi.php'; 
$id_transaksi = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi #<?php echo $id_transaksi; ?></title>
</head>
<body>

<h2>Detail Transaksi #<?php echo $id_transaksi; ?></h2>

<form method="post" action="">
    <label for="barang">Pilih Barang:</label>
    <select name="id_barang" id="barang" required>
        <option value="">--Pilih Barang--</option>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang NOT IN 
            (SELECT id_barang FROM detail_transaksi WHERE id_transaksi='$id_transaksi')");
        while ($b = mysqli_fetch_array($query)) {
            echo "<option value='$b[id_barang]'>$b[nama_barang] - Rp $b[harga]</option>";
        }
        ?>
    </select>

    <label for="jumlah">Jumlah:</label>
    <input type="number" name="jumlah" id="jumlah" min="1" required>
    <button type="submit" name="tambah">Tambah</button>
</form>

<?php
if (isset($_POST['tambah'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    $barang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang'"));
    $subtotal = $barang['harga'] * $jumlah;

    mysqli_query($koneksi, "INSERT INTO detail_transaksi (id_transaksi, id_barang, jumlah, subtotal)
                            VALUES ('$id_transaksi','$id_barang','$jumlah','$subtotal')");

    mysqli_query($koneksi, "UPDATE transaksi 
                            SET total=(SELECT SUM(subtotal) FROM detail_transaksi WHERE id_transaksi='$id_transaksi')
                            WHERE id_transaksi='$id_transaksi'");

    echo "<script>alert('Barang berhasil ditambahkan');window.location='detail.php?id=$id_transaksi';</script>";
}
?>

<hr>
<h3>Data Barang di Transaksi Ini</h3>
<table border="1" cellpadding="5">
<tr><th>Barang</th><th>Jumlah</th><th>Subtotal</th><th>Aksi</th></tr>

<?php
$data = mysqli_query($koneksi, "SELECT d.id_detail, b.nama_barang, d.jumlah, d.subtotal 
    FROM detail_transaksi d 
    JOIN barang b ON d.id_barang=b.id_barang
    WHERE d.id_transaksi='$id_transaksi'");

while ($d = mysqli_fetch_array($data)) {
    echo "<tr>
        <td>$d[nama_barang]</td>
        <td>$d[jumlah]</td>
        <td>Rp " . number_format($d['subtotal']) . "</td>
        <td><a href='hapus_detail.php?id=$d[id_detail]&trans=$id_transaksi' onclick='return confirm(\"Hapus?\")'>Hapus</a></td>
        </tr>";
}
?>
</table>

</body>
</html>
