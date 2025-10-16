<?php
// Array awal
$students = array(
    array("name" => "Alex", "id" => "220401", "phone" => "0812345678"),
    array("name" => "Bianca", "id" => "220402", "phone" => "0812345687"),
    array("name" => "Candice", "id" => "220403", "phone" => "0812345665"),
);

// 1. Implementasi fungsi array_push()
$new_student = array("name" => "David", "id" => "220404", "phone" => "0812345698");
array_push($students, $new_student);

// 2. Implementasi fungsi array_merge()
$more_students = array(
    array("name" => "Eva", "id" => "220405", "phone" => "0812345700"),
);
$students = array_merge($students, $more_students);

// 3. Implementasi fungsi array_values()
$values = array_values($students);

// 4. Implementasi fungsi array_search()
$search_name = "Bianca";
$index = array_search($search_name, array_column($students, 'name'));

// 5. Implementasi fungsi array_filter()
$filtered_students = array_filter($students, function($student) {
    return strpos($student['phone'], '7') !== false; // Filter dengan nomor yang mengandung '7'
});

// 6. Implementasi berbagai fungsi sorting
// Sorting berdasarkan nama
usort($students, function($a, $b) {
    return strcmp($a['name'], $b['name']);
});

// Sorting berdasarkan ID
usort($students, function($a, $b) {
    return strcmp($a['id'], $b['id']);
});

// Menampilkan hasil
function displayTable($data, $title) {
    echo "<h3>$title</h3>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Name</th><th>ID</th><th>Phone</th></tr>";
    
    foreach ($data as $row) {
        echo "<tr>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo "</tr>";
    }
    
    echo "</table><br>";
}

// Tampilkan hasil
displayTable($students, "Daftar Siswa Setelah array_push dan array_merge");

echo "<h3>Index dari $search_name:</h3>";
echo $index !== false ? $index : "Nama tidak ditemukan.";

// Tampilkan hasil filter
displayTable($filtered_students, "Siswa dengan Nomor Telepon Mengandung '7'");

// Tampilkan hasil sorting berdasarkan nama
displayTable($students, "Daftar Siswa Setelah Sorting Berdasarkan Nama");

// Tampilkan hasil sorting berdasarkan ID
displayTable($students, "Daftar Siswa Setelah Sorting Berdasarkan ID");
?>
