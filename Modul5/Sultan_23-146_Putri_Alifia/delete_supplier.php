<?php
require "koneksi.php";

if (isset($_GET['id'])) {
    $supplier_id = $_GET['id'];

    $deleteQuery = "DELETE FROM supplier WHERE id = '$supplier_id'";
    
    if (mysqli_query($con, $deleteQuery)) {
        header("Location: suplier.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    header("Location: suplier.php");
    exit;
}
?>
