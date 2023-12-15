<?php
$F=array();
$F[0]= 0;
$F[1]= 1;
for ($i=2; $i<400; $i++) {
$F[$i] = $F[$i-1] + $F[$i-2];
}
echo var_dump($F);
?>
