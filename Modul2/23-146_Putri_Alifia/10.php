<!DOCTYPE html>
<html>
<head>
    <title>Program Kasir Sederhana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffd6e7; 
            padding: 40px;
            text-align: center;
            color: #333;
        }
        .container {
            background-color: #ffd6e7;
            width: 400px;
            margin: 0 auto;
            padding: 25px;
            border-radius: 15px;
        }
        h2, h3, h4, p, label, li {
            color: #333;
        }
        ul {
            text-align: left;
            padding-left: 20px;
        }
        input[type=text], input[type=submit] {
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #aaa;
            margin: 5px;
            font-size: 15px;
        }
        input[type=submit] {
            background-color: #ffd6e7;
            color: #333;
            border: 1px solid #aaa;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #ffc3da; 
        }
        .total {
            border-radius: 10px;
            padding: 10px;
            margin-top: 15px;
            border: 1px solid #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>💸 Program Kasir Sederhana</h2>

        <?php
        $menu = array(
            "Nasi Goreng" => 15000,
            "Mie Ayam" => 12000,
            "Es Teh" => 5000,
            "Ayam Geprek" => 18000,
            "Jus Alpukat" => 10000
        );

        echo "<h3>Daftar Menu:</h3>";
        echo "<ul>";
        foreach ($menu as $item => $harga) {
            echo "<li>$item - Rp " . number_format($harga, 0, ',', '.') . "</li>";
        }
        echo "</ul>";

        if (!isset($_POST['pilih'])) {
        ?>
            <form method="post">
                <label>Masukkan nama menu yang ingin dibeli:</label><br>
                <input type="text" name="pilih" required>
                <input type="submit" value="Tambahkan">
                <input type="hidden" name="total" value="<?php echo isset($_POST['total']) ? $_POST['total'] : 0; ?>">
            </form>
        <?php
        } else {
            $pilih = $_POST['pilih'];
            $total = isset($_POST['total']) ? $_POST['total'] : 0;

            if (array_key_exists($pilih, $menu)) {
                $total += $menu[$pilih];
                echo "<p>Anda membeli: <b>$pilih</b> seharga Rp " . number_format($menu[$pilih], 0, ',', '.') . "</p>";
            } elseif ($pilih != "") {
                echo "<p style='color:red;'>Menu tidak ditemukan!</p>";
            }

            echo "<div class='total'><b>Total sementara: Rp " . number_format($total, 0, ',', '.') . "</b></div>";

            ?>
            <form method="post">
                <label>Ingin beli menu lain? (ketik nama menu atau kosongkan untuk selesai)</label><br>
                <input type="text" name="pilih">
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                <input type="submit" value="Lanjut">
            </form>
            <?php

            if ($_POST['pilih'] == "") {
                echo "<h3>Total Akhir yang harus dibayar: <b>Rp " . number_format($total, 0, ',', '.') . "</b></h3>";
                echo "<h4>Terima kasih sudah berbelanja 💖</h4>";
            }
        }
        ?>
    </div>
</body>
</html>
