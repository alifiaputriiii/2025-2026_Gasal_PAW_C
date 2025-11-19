<?php
require "koneksi.php";
function validateTransaction($field_list) {
    $error = [];
    
    $currentDate = date("Y-m-d");
    if (trim($field_list['transaksi']) == "") {
        array_push($error, "Tanggal transaksi harus diisi.");
    } elseif ($field_list['transaksi'] < $currentDate) {
        array_push($error, "Tanggal transaksi tidak boleh sebelum hari ini.");
    }

    if (trim($field_list['keterangan']) == "") {
        array_push($error, "Keterangan harus diisi.");
    } elseif (strlen($field_list['keterangan']) < 3) {
        array_push($error, "Keterangan minimal harus 3 karakter.");
    }

    if (empty($field_list['id_pelanggan'])) {
        array_push($error, "Pelanggan harus dipilih.");
    }

    return $error;
}

$errors = [];
if (isset($_POST['submit'])) {
    $transaksi = $_POST['transaksi'];
    $keterangan = $_POST['keterangan'];
    $total = $_POST['total'];
    $pelangganid = $_POST['pelangganid'];

    $field_list = [
        'transaksi' => $transaksi,
        'keterangan' => $keterangan,
        'total' => $total,
        'pelangganid' => $pelangganid
    ];

    $errors = validateTransaction($field_list);
    
    if (empty($errors)) {
        $insert = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES ('$transaksi', '$keterangan', '$total', '$pelangganid')";
        if (mysqli_query($koneksi, $insert)) {
            $transaksi = '';
            $keterangan = '';
            $total = 0;
            $pelangganid = '';
            header("Location: index.php");
            exit();
        } else {
            $errors[] = "Gagal menambahkan transaksi: " . mysqli_error($koneksi);
        }
    }
}

$pelangganQuery = "SELECT id, nama FROM pelanggan";
$pelangganResult = mysqli_query($koneksi, $pelangganQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 20px;
        }
        .card {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Transaksi</h2>
    
    <div class="card">
        <form action="Add Data.php" method="POST">
            <div class="form-group">
                <label for="waktu_transaksi">Waktu Transaksi</label>
                <input type="date" class="form-control" id="waktu_transaksi" name="waktu_transaksi" required>
            </div>
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" required>
            </div>
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" class="form-control" id="total" name="total" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah Transaksi</button>
            <a href="indeks.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
