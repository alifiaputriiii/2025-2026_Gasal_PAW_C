<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665"),
    array("backy", "220404", "0812345599"),
    array("sisy", "220405", "0812345695"),
    array("nicholas", "220406", "0812825665"),
    array("justin", "220407", "0812987665"),
    array("megan", "220408", "0812342465"),
);

echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Name</th><th>ID</th><th>Phone</th></tr>"; // Header tabel

for ($row = 0; $row < count($students); $row++) {
    echo "<tr>"; // Awal baris baru
    for ($col = 0; $col < count($students[$row]); $col++) {
        echo "<td>" . $students[$row][$col] . "</td>"; // Sel tabel
    }
    echo "</tr>"; // Akhir baris
}

echo "</table>";
?>
