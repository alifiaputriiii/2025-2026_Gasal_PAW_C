<?php
require "koneksi.php";

$errors = []; // Array to store error messages

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    // Validasi Nama
    if (empty($nama)) {
        $errors[] = "Nama tidak boleh kosong.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $errors[] = "Nama hanya boleh berisi huruf dan spasi.";
    }

    // Validasi Telepon
    if (empty($telp)) {
        $errors[] = "Telepon tidak boleh kosong.";
    } elseif (!preg_match("/^[0-9]+$/", $telp)) {
        $errors[] = "Telepon hanya boleh berisi angka.";
    }

    // Validasi Alamat
    if (empty($alamat)) {
        $errors[] = "Alamat tidak boleh kosong.";
    } elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])/", $alamat)) {
        $errors[] = "Alamat harus mengandung minimal satu huruf dan satu angka.";
    }

    // Jika tidak ada error, lakukan penyimpanan data
    if (empty($errors)) {
        $insertQuery = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
        if (mysqli_query($con, $insertQuery)) {
            header("Location: suplier.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Tambah Supplier</title>
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Supplier Baru</h2>
    
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= isset($nama) ? $nama : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="telp" class="form-label">Telepon</label>
            <input type="number" class="form-control" id="telp" name="telp" value="<?= isset($telp) ? $telp : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= isset($alamat) ? $alamat : '' ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="suplier.php" class="btn btn-danger">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
