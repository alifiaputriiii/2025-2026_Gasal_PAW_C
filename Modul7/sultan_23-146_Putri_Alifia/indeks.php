<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store 1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM transaksi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .container {
            margin-top: 20px;
        }
        h2 {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }
        .header-buttons {
            margin: 15px 0;
            text-align: right;
        }
        .header-buttons .btn-blue {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 5px;
        }
        .header-buttons .btn-green {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
        .table-responsive {
            margin-top: 20px;
        }
        table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            border-radius: 5px;
            overflow: hidden;
        }
        table thead {
            background-color: #007bff;
            color: white;
        }
        table th, table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        table th {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #17a2b8;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Master Transaksi</h2>
    
    <div class="header-buttons">
        <a href="lihat laporan.php" class="btn-blue">Lihat Laporan Penjualan</a>
        <a href="Add Data.php" class="btn-green">Tambah Transaksi</a>

    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Waktu Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Keterangan</th>
                    <th>Total</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['id_transaksi'] . "</td>";
                        echo "<td>" . $row['waktu_transaksi'] . "</td>";
                        echo "<td>" . $row['id_pelanggan'] . "</td>";
                        echo "<td>" . $row['keterangan'] . "</td>";
                        echo "<td>Rp" . number_format($row['total'], 0, ',', '.') . "</td>";
                        echo "<td>";
                        echo "<a href='view_detail.php?id=" . $row['id_transaksi'] . "' class='btn-primary'>Lihat Detail</a> ";
                        echo "<a href='hapus data.php?id=" . $row['id_transaksi'] . "' class='btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus transaksi ini?\")'>Hapus</a>";

                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No transactions found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
    <div class="alert alert-success" role="alert">
        Transaksi berhasil dihapus.
    </div>
<?php endif; ?>

<?php if (isset($_GET['status']) && $_GET['status'] == 'added'): ?>
    <div class="alert alert-success" role="alert">
        Transaksi berhasil ditambahkan.
    </div>
<?php endif; ?>


</body>
</html>

<?php
$conn->close();
?>
