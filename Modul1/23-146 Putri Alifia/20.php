<!DOCTYPE html>
<html>
<head>
    <title>Form Biodata</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f8ff;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            width: 50%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        form input[type="text"], 
        form input[type="number"] {
            width: 95%;
            padding: 8px;
            margin: 6px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        form input[type="submit"] {
            background: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background: #45a049;
        }
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background: #4CAF50;
            color: white;
            text-align: center;
        }
        td {
            background: #f9f9f9;
        }
    </style>
</head>
<body>

<h2>Form Input Biodata</h2>
<form method="get" action="">
    Nama: <br><input type="text" name="nama"><br>
    Umur: <br><input type="number" name="umur"><br>
    Alamat: <br><input type="text" name="alamat"><br>
    Hobi: <br><input type="text" name="hobi"><br><br>
    <input type="submit" value="Tampilkan Biodata">
</form>

<?php
if (isset($_GET['nama']) && $_GET['nama'] != "") {
    $nama   = $_GET['nama'];
    $umur   = $_GET['umur'];
    $alamat = $_GET['alamat'];
    $hobi   = $_GET['hobi'];
    echo "<h2>Biodata Anda</h2>";
    echo "<table>
            <tr><th>Nama</th><td>$nama</td></tr>
            <tr><th>Umur</th><td>$umur</td></tr>
            <tr><th>Alamat</th><td>$alamat</td></tr>
            <tr><th>Hobi</th><td>$hobi</td></tr>
          </table>";
}
?>

</body>
</html>
