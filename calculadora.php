<?php
$op1check = 0;
while ($op1check == 0):
        $op1 = $_GET['op1'];
        if (is_numeric($op1)) {
        $op1check=1;
        }
        else {
        print "Porfavor, escriba un valor numerico en op1 y recarge para reintar la operacion";
	die;
	}
endwhile;

$op2check = 0;
while ($op2check == 0):
        $op2 = $_GET['op2'];
        if (is_numeric($op2)) {
        $op2check=1;
        }
        else {
        print "Porfavor, escriba un valor numerico en op2 y recarge para reintentar la operacion";
        die;
	}
endwhile;

$operador = $_GET['operador'];
$resultado = 0;
if ($operador == 'sumar') {
	$resultado = $op1 + $op2;
	print "op1 mas $op2 es $resultado";
}
elseif ($operador == 'restar') {
	$resultado = $op1 - $op2;
	print "$op1 menos $op2 es $resultado";
}
elseif ($operador == 'multiplicar') {
	$resultado = $op1 * $op2;
	print "$op1 por $op2 es $resultado";
}
elseif ($operador == 'dividir' && $op2 == 0) {
	print "No es posible dividir entre 0";
}

elseif ($operador == 'dividir') {
	$resultado = $op1 / $op2;
	print "$op1 entre $op2 es $resultado";
}
elseif ($operador != 'sumar' or 'restar' or 'multiplicar' or 'dividir') {
	print "Porfavor escriba alguno de estos valores en el operador: sumar, restar, multiplicar, dividir";
}
?>
