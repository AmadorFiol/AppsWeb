<?php
$op1check = 0;
while ($op1check == 0):
	$op1 = $_GET['op1'];
	if (is_numeric($op1)) {
	$op1check=1;
	}
	else {
	print "Porfavor, escriba un valor numerico en op1 y recarge para reintentar la operacion";
	die;
}
endwhile;
print "Esto no furula";
/*Por hacer: centrar resultado, tabla, control errores parametros extra */
?>
