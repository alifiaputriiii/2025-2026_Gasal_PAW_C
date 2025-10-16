<?php
$fruit = array("Avocado","Bluberry","Cherry");
$vaggies = array("Tomat","Timun","Cabe");
echo " I like ". $fruit[0]. " , " . $fruit[1]. " and " . $fruit[2] . ".". "<br>". "<br>";
array_push($fruit,"Stoberry","Apel","Anggur","Melon","Mangga");
echo " indeks tertinggi ada pada buah " . $fruit[7] . " adalah indeks 7". "<br>". "<br>";
unset($fruit[3]);
echo "indeks yang dihapus adalah indeks ke 3 yaitu stoberry dan indeks tertinggi tetap 7 ". "<br>". "<br>";
print_r($fruit);
echo "<br>". "<br>";
print_r($vaggies)

?>