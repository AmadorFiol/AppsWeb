<?php
$Precio = 283;
$Rebaja = 15;
$restarebaja = $Precio*$Rebaja/100;
$Preciofinal = $Precio-$restarebaja;
echo "R1/", $Preciofinal;

$PC = 635;
$IVA = 21;
$precioiva = $PC*$IVA;
$PrecioPC = $PC+$precioiva;
echo "  R2/ ", $PrecioPC;
?>
