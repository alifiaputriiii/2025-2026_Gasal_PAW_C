<?php
require_once('tcpdf/tcpdf.php');

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

// Buat PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle("Rekap Penjualan");
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10);

$html = "
<h2>Rekap Penjualan</h2>
<p>Periode: $start_date s/d $end_date</p>
<table border='1' cellspacing='0' cellpadding='5'>
<thead>
<tr style='background-color:#f2f2f2;'>
    <th><b>Tanggal Transaksi</b></th>
    <th><b>Total</b></th>
</tr>
</thead>
<tbody>
";

$total_penjualan = 0;
while ($row = $result->fetch_assoc()) {
    $html .= "
    <tr>
        <td>".$row['waktu_transaksi']."</td>
        <td>Rp ".number_format($row['total'])."</td>
    </tr>
    ";
    $total_penjualan += $row['total'];
}

$html .= "
</tbody>
</table>

<br><b>Total Penjualan: Rp ".number_format($total_penjualan)."</b>
";

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output("Rekap_Penjualan.pdf", "I");
