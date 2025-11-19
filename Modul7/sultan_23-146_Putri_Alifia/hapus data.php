<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store 1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if transaction ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete the transaction
    $sql = "DELETE FROM transaksi WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to transaksi.php with a success message
        header("Location: transaksi.php?status=deleted");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No transaction ID provided.";
}

$conn->close();
?>
