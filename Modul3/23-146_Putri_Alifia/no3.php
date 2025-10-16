<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
$weight = array("kubus" => "20", "lingkaran" => "21", "persegi panjang" => "40");
echo "Andy is " . $height["Andy"] . " cm tall". "<br>";
$height += ["Sella" => "170","Tiara" => "164", "Putri" => "162", "Bila" => "163", "Tina" => "172"];
unset($height[2]);
print_r($height);
echo "<br>";
print_r($weight)
?>