<?php
require "koneksi.php";

$errors = [];

if (isset($_GET['id'])) {
    $supplier_id = $_GET['id'];
    $query = mysqli_query($con, "SELECT * FROM supplier WHERE id = '$supplier_id'");
    $supplier = mysqli_fetch_assoc($query);

    if (!$supplier) {
        echo "Supplier not found!";
        exit;
    }

    $originalData = [
        'nama' => $supplier['nama'],
        'telp' => $supplier['telp'],
        'alamat' => $supplier['alamat']
    ];
} else {
    echo "No supplier ID provided!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    if (empty($nama)) {
        $errors[] = "Nama tidak boleh kosong.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $errors[] = "Nama hanya boleh mengandung huruf dan spasi.";
    }

    if (empty($telp)) {
        $errors[] = "Telepon tidak boleh kosong.";
    } elseif (!preg_match("/^[0-9]+$/", $telp)) {
        $errors[] = "Telepon hanya boleh mengandung angka.";
    }

    if (empty($alamat)) {
        $errors[] = "Alamat tidak boleh kosong.";
    } elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d\s]+$/", $alamat)) {
        $errors[] = "Alamat harus berisi huruf dan angka.";
    }

    if (empty($errors) && 
        $nama === $originalData['nama'] &&
        $telp === $originalData['telp'] &&
        $alamat === $originalData['alamat']
    ) {
        $errors[] = "Data sudah ada, tidak ada perubahan yang dilakukan.";
    }

    if (empty($errors)) {
        $updateQuery = "UPDATE supplier SET nama = '$nama', telp = '$telp', alamat = '$alamat' WHERE id = '$supplier_id'";
        if (mysqli_query($con, $updateQuery)) {
            header("Location: suplier.php");
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($con);
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
    <title>Edit Supplier</title>
</head>
<body>
<div class="container mt-5">
    <h2>Edit Supplier</h2>
    
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($supplier['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="telp" class="form-label">Telepon</label>
            <input type="number" class="form-control" id="telp" name="telp" value="<?= htmlspecialchars($supplier['telp']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= htmlspecialchars($supplier['alamat']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="suplier.php" class="btn btn-danger">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
