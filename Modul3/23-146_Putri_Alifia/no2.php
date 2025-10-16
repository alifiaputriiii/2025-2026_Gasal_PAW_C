<?php
$fruit = array("Avocado","Bluberry","Cherry");
array_push($fruit,"Stoberry","Apel","Anggur","Melon","Mangga");
$vaggies = array("Tomat","Timun","Cabe");
$arrlenght = count($fruit);
$arrlenght = count($vaggies);
for ($x = 0; $x < $arrlenght; $x++){
    echo $fruit[$x];
    echo "<br>";
    echo $vaggies[$x];
    echo "<br>";
}
?>