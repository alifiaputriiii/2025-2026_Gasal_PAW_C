<?php
// Data biodata (statis)
$nama   = "Putri";
$umur   = 20;
$alamat = "Jl.FC forsa, kamal";
$hobi   = "Membaca, Menulis, Coding";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Biodata</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Biodata Diri</h2>
    <table>
        <tr><th>Nama</th><td><?php echo $nama; ?></td></tr>
        <tr><th>Umur</th><td><?php echo $umur; ?> tahun</td></tr>
        <tr><th>Alamat</th><td><?php echo $alamat; ?></td></tr>
        <tr><th>Hobi</th><td><?php echo $hobi; ?></td></tr>
    </table>
</body>
</html>
