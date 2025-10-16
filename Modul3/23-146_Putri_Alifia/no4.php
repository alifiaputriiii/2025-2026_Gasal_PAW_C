<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
$weight = array("kubus" => "20", "lingkaran" => "21", "persegi panjang" => "40");
$height += ["Dina" => "170","Malika" => "164", "Bila" => "162", "Atun" => "163", "Salsa" => "172"];

foreach ($height as $x => $x_value){
    echo "Key " . $x . ", Value=" . $x_value;
    echo "<br>";
}
echo "<br>";
foreach ($weight as $x => $x_value){
    echo "Key " . $x . ", Value=" . $x_value;
    echo "<br>";
}
?>