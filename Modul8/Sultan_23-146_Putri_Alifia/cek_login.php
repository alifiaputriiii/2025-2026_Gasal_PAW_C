<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM nama_user WHERE username='$username' AND password='$password'";
$query = mysqli_query($koneksi, $sql);

// CEK APAKAH QUERY ERROR
if (!$query) {
    die("QUERY ERROR: " . mysqli_error($koneksi) . "<br>SQL: " . $sql);
}

$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    $_SESSION['username'] = $data['username'];
    $_SESSION['level'] = $data['level'];

    header("location:index.php");
} else {
    echo "<script>alert('Login gagal'); window.location='login.php';</script>";
}
?>
