<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
include "header.php";
?>

<h1>Selamat Datang <?php echo $_SESSION['username']; ?></h1>
