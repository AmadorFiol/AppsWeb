<?php
$nom = $_GET['nom'];
$edat = $_GET['edat'];
$avui = date("Y/m/d");
$avuinum = strtotime($avui);
$inici2050 = strtotime('2050-01-01');
$ara = date("Y");
$edat2050 = 2050 - $ara + $edat;
$diff = $inici2050 - $avuinum;
$diesrestants = floor($diff/ (60*60*24));
print "En 2050 $nom tendra $edat2050 anys y queden $diesrestants dies restants dins 2050";
?>
