<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
</head>
<body>

<h2>Input Transaksi Baru</h2>

<form method="post" action="">
    <label>Tanggal:</label>
    <input type="date" name="tanggal" required>
    <button type="submit" name="buat">Buat Transaksi</button>
</form>

<?php
// Jika tombol "Buat Transaksi" ditekan
if (isset($_POST['buat'])) {
    $tanggal = $_POST['tanggal'];

    // Masukkan data transaksi baru ke tabel
    mysqli_query($koneksi, "INSERT INTO transaksi (tanggal, total) VALUES ('$tanggal', 0)");

    echo "<p>Transaksi baru telah dibuat.</p>";
}
?>

<hr>
<h3>Daftar Transaksi</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>

    <?php
    // Ambil semua data transaksi dari database
    $data = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
    while ($d = mysqli_fetch_array($data)) {
        echo "<tr>
                <td>{$d['id_transaksi']}</td>
                <td>{$d['tanggal']}</td>
                <td>Rp " . number_format($d['total'], 0, ',', '.') . "</td>
                <td><a href='detail.php?id={$d['id_transaksi']}'>Detail</a></td>
              </tr>";
    }
    ?>
</table>

</body>
</html>