<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store 1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$data = [];
$total_pembeli = 0;
$total_penjualan = 0;

if ($start_date && $end_date) {
    $sql = "SELECT waktu_transaksi, total FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
        $total_pembeli++;
        $total_penjualan += $row['total'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekap & Grafik Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container mt-4">

    <h3 class="mb-3">Rekap Penjualan</h3>

    <!-- Form Filter -->
    <form action="" method="GET" class="form-inline mb-4">
        <label class="mr-2">Tanggal Mulai:</label>
        <input type="date" name="start_date" value="<?= $start_date ?>" class="form-control mr-3" required>

        <label class="mr-2">Tanggal Selesai:</label>
        <input type="date" name="end_date" value="<?= $end_date ?>" class="form-control mr-3" required>

        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </form>

    <!-- Rekap Dalam Tabel -->
    <?php if (!empty($data)): ?>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Tanggal Transaksi</th>
                <th>Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $d): ?>
            <tr>
                <td><?= $d['waktu_transaksi'] ?></td>
                <td>Rp <?= number_format($d['total'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Rekap Angka -->
    <div class="alert alert-info">
        <b>Total Pembeli:</b> <?= $total_pembeli ?> <br>
        <b>Total Penjualan:</b> Rp <?= number_format($total_penjualan, 0, ',', '.') ?>
    </div>

    <!-- Grafik -->
    <canvas id="salesChart" height="150"></canvas>

    <script>
        const salesData = <?= json_encode($data) ?>;
        const labels = salesData.map(item => item.waktu_transaksi);
        const totals = salesData.map(item => item.total);

        new Chart(document.getElementById('salesChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Penjualan',
                    data: totals,
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0,0,255,0.2)'
                }]
            }
        });
    </script>

    <?php else: ?>
        <p>Tidak ada data pada rentang tanggal tersebut.</p>
    <?php endif; ?>
<!-- Export Buttons -->
    <div class="mt-3">
        <form id="pdfForm" action="cetak_pdf.php" method="POST" target="_blank">
    <input type="hidden" name="start_date" value="<?= $start_date ?>">
    <input type="hidden" name="end_date" value="<?= $end_date ?>">
    <input type="hidden" id="chartImage" name="chartImage">
    <button type="submit" class="btn btn-danger mt-3" onclick="prepareChart()">Cetak PDF</button>
</form>

<script>
function prepareChart() {
    const canvas = document.getElementById('salesChart');
    const imageData = canvas.toDataURL('image/png');
    document.getElementById('chartImage').value = imageData;
}
</script>

           <a href="cetak exel.php?start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>" class="btn btn-success">Simpan ke Excel</a>
    </div>
    <!-- Tombol Kembali -->
    <a href="indeks.php" class="btn btn-secondary mt-3">Kembali ke Halaman Index</a>

</div>

</body>
</html>
