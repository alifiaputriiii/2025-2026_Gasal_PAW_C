<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Penjualan.xls");
header("Pragma: no-cache");
header("Expires: 0");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store 1";

$conn = new mysqli($servername, $username, $password, $dbname);

$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

$sql = "SELECT waktu_transaksi, total FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

echo "<table border='1'>";
echo "<tr><th colspan='2'><h3>Rekap Penjualan</h3></th></tr>";
echo "<tr><td>Tanggal Mulai</td><td>$start_date</td></tr>";
echo "<tr><td>Tanggal Selesai</td><td>$end_date</td></tr>";
echo "</table><br>";

echo "<table border='1'>
<tr style='background:#ccc;'>
    <th>Tanggal Transaksi</th>
    <th>Total</th>
</tr>
";

$total_penjualan = 0;

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>".$row['waktu_transaksi']."</td>
        <td>Rp ".number_format($row['total'])."</td>
    </tr>";

    $total_penjualan += $row['total'];
}

echo "</table><br>";

echo "<b>Total Penjualan: Rp ".number_format($total_penjualan)."</b>";

?>
