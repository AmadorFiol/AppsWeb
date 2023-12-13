<?php
//yago
$code = $_GET['code'];
$fila = 0
$fila = 0
$array1 = []
$file = fopen('iata_airlines.csv', 'r');
while (($line = fgetcsv($file,2000, '^')) !== FALSE) {
$array1[$fila] = $line;
$fila ++;
}
fclose($file);

$array2 = [];
$file1 = fopen('airport.csv', 'r');
while (($line1 = fgetcsv($file1)) !== FALSE) {
$array2[$fila1] = $line1;
$fila1 ++;

//propio
for ($i=0,$i<count($array1),$i ++) {

}
?>
