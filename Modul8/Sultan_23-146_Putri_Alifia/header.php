<?php
// Ambil username dari session
$nama = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';

echo "
<div style='background:#004a8f; padding:10px; color:white; display:flex; justify-content:space-between; align-items:center;'>

    <div>
";

// LEVEL 1
if ($_SESSION['level'] == 1) {
    echo "
        <a href='index.php' style='color:white; margin-right:20px;'>Home</a>
        <a href='data_master.php' style='color:white; margin-right:20px;'>Data Master</a>
        <a href='transaksi.php' style='color:white; margin-right:20px;'>Transaksi</a>
        <a href='laporan.php' style='color:white;'>Laporan</a>
    ";
}

// LEVEL 2
elseif ($_SESSION['level'] == 2) {
    echo "
        <a href='index.php' style='color:white; margin-right:20px;'>Home</a>
        <a href='transaksi.php' style='color:white; margin-right:20px;'>Transaksi</a>
        <a href='laporan.php' style='color:white;'>Laporan</a>
    ";
}

echo "
    </div>

    <div style='font-weight:bold;'>
        $nama
    </div>

</div>
";
?>
