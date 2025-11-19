<?php
$koneksi = new mysqli("localhost", "root", "", "store 1");

if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];
} else {
    die("ID Transaksi tidak ditemukan.");
}

// Ambil data transaksi + nama pelanggan
$sql_transaksi = "
    SELECT t.*, p.nama_pelanggan 
    FROM transaksi t
    JOIN pelanggan p ON t.id_pelanggan = p.id
    WHERE t.id_transaksi = ?
";

$stmt = $koneksi->prepare($sql_transaksi);
$stmt->bind_param("i", $id_transaksi);
$stmt->execute();
$result_trans = $stmt->get_result();
$transaksi = $result_trans->fetch_assoc();

// Jika transaksi tidak ditemukan
if (!$transaksi) {
    echo "<h3>Data transaksi tidak ditemukan!</h3>";
    echo "<a href='indeks.php' class='btn btn-secondary'>Kembali</a>";
    exit;
}

// Ambil detail transaksi
$sql_detail = "
    SELECT * FROM detail_transaksi
    WHERE id_transaksi = ?
";
$stmt2 = $koneksi->prepare($sql_detail);
$stmt2->bind_param("i", $id_transaksi);
$stmt2->execute();
$detail = $stmt2->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Detail Transaksi #<?php echo $transaksi['id_transaksi']; ?></h2>

    <table class="table table-bordered">
        <tr>
            <th>Nama Pelanggan</th>
            <td><?php echo $transaksi['nama_pelanggan']; ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td><?php echo $transaksi['waktu_transaksi']; ?></td>
        </tr>
        <tr>
            <th>Total</th>
            <td>Rp<?php echo number_format($transaksi['total'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td><?php echo $transaksi['keterangan']; ?></td>
        </tr>
    </table>

    <h4>Detail Pembelian</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1; 
            while ($row = $detail->fetch_assoc()): 
                $subtotal = $row['jumlah'] * $row['harga'];
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td><?php echo $row['jumlah']; ?></td>
                <td>Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                <td>Rp<?php echo number_format($subtotal, 0, ',', '.'); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="indeks.php" class="btn btn-primary">Kembali ke Halaman Utama</a>
</div>

</body>
</html>
