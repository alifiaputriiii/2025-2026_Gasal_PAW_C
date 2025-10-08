<!DOCTYPE html>
<html>
<head>
    <title>Program Grade Nilai Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffd6e7; 
            text-align: center;
            padding: 40px;
        }
        h2 {
            color: #333;
        }
        input[type=number], input[type=submit] {
            padding: 8px;
            margin: 5px;
            border-radius: 8px;
            border: 1px solid #aaa;
        }
        input[type=submit] {
            background-color: #ffd6e7;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #ffc3da;
        }
    </style>
</head>
<body>
    <h2>Program Penilaian Mahasiswa</h2>

    <form method="post">
        <label>Masukkan Nilai Anda:</label><br>
        <input type="number" name="nilai" min="0" max="100" required>
        <input type="submit" value="Cek Grade">
    </form>

    <?php
    if (isset($_POST['nilai'])) {
        $nilai = $_POST['nilai'];

        if ($nilai >= 90 && $nilai <= 100) {
            $grade = "A";
        } elseif ($nilai >= 80) {
            $grade = "B";
        } elseif ($nilai >= 70) {
            $grade = "C";
        } elseif ($nilai >= 60) {
            $grade = "D";
        } else {
            $grade = "E";
        }

        echo "<p>Nilai Anda: <b>$nilai</b></p>";
        echo "<p>Grade: <b>$grade</b></p>";
    }
    ?>
</body>
</html>
