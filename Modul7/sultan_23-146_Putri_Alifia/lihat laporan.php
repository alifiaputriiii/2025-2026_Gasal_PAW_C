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

// Query to fetch sales data between the selected dates
if ($start_date && $end_date) {
    $sql = "SELECT waktu_transaksi, total FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">
    <h2>Laporan Penjualan</h2>
    
    <!-- Date Filter Form -->
    <form action="sales_report.php" method="GET" class="form-inline mb-3">
        <div class="form-group mr-2">
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" name="start_date" id="start_date" class="form-control ml-2" required>
        </div>
        <div class="form-group mr-2">
            <label for="end_date">Tanggal Selesai:</label>
            <input type="date" name="end_date" id="end_date" class="form-control ml-2" required>
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </form>

    <!-- Chart Display -->
    <?php if (!empty($data)): ?>
        <canvas id="salesChart" width="400" height="200"></canvas>
        <script>
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesData = <?php echo json_encode($data); ?>;
            const labels = salesData.map(item => item.waktu_transaksi);
            const totals = salesData.map(item => item.total);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Penjualan',
                        data: totals,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day'
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    <?php else: ?>
        <p>Tidak ada data untuk rentang tanggal yang dipilih.</p>
    <?php endif; ?>

    <!-- Export Buttons -->
    <div class="mt-3">
        <a href="cetak pdf.php?start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>" class="btn btn-danger">Cetak PDF</a>
        <a href="cetak exel.php?start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>" class="btn btn-success">Simpan ke Excel</a>
    </div>
    <div> <!-- Tombol Kembali -->
    <a href="indeks.php" class="btn btn-secondary mt-3">Kembali ke Halaman Index</a>
</div>
</div>

</body>
</html>
