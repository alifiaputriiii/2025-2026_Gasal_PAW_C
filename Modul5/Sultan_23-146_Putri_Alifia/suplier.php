<?php
require "koneksi.php";

$querysupplier = mysqli_query($con, "SELECT * FROM supplier");
$jumlahsupplier = mysqli_num_rows($querysupplier);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>Supplier List</title>
</head>
<body>
<div class="container mt-5">
    <div class="my-5 col-12 col-md-6">
    </form>
</div>
<div class="mt-3">
    <div class="table-responsive mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>List Supplier</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="add_supplier.php" class="btn btn-success">Tambahkan</a>
            </div>
        </div>
        <hr>
    </div>
        <table class="table border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Telp</th>
                    <th>Alamat</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($jumlahsupplier > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($querysupplier)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['telp'] . "</td>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "<td>
                                <a href='edit_supplier.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a>
                                <a href='delete_supplier.php?id=" . $row['id'] . "' onclick='return confirm(\"Yakin ingin menghapus data ini?\")' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i> Hapus</a>
                                </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data supplier</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
