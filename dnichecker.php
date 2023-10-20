<?php
$numbercheck = 0;
while ($numbercheck == 0):
        $dninumber = $_GET['dninumber'];
        if (is_numeric($dninumber)) {
        $numbercheck=1;
        }
        else {
        print "Porfavor, escriba solamente los caracteres numericos del DNI";
        die;
}
	$digitos = strlen($dninumber);
	if ($digitos == 8) {
	print "";
	}
	else {
	print "Porfavor, revise los numeros del DNI";
	die;
	}


endwhile;
$restodivision = $dninumber % 23;
if  ($restodivision == 0) {
	$letradni = "T";
}

elseif ($restodivision == 1) {
	$letradni = "R";
}

elseif ($restodivision == 2) {
        $letradni = "W";
}

elseif ($restodivision == 3) {
        $letradni = "A";
}

elseif ($restodivision == 4) {
        $letradni = "G";
}

elseif ($restodivision == 5) {
        $letradni = "M";
}

elseif ($restodivision == 6) {
        $letradni = "Y";
}

elseif ($restodivision == 7) {
        $letradni = "F";
}

elseif ($restodivision == 8) {
        $letradni = "P";
}

elseif ($restodivision == 9) {
        $letradni = "D";
}

elseif ($restodivision == 10) {
        $letradni = "X";
}

elseif ($restodivision == 11) {
        $letradni = "B";
}

elseif ($restodivision == 12) {
        $letradni = "N";
}

elseif ($restodivision == 13) {
        $letradni = "J";
}

elseif ($restodivision == 14) {
        $letradni = "Z";
}

elseif ($restodivision == 15) {
        $letradni = "S";
}

elseif ($restodivision == 16) {
        $letradni = "Q";
}

elseif ($restodivision == 17) {
        $letradni = "V";
}

elseif ($restodivision == 18) {
        $letradni = "H";
}

elseif ($restodivision == 19) {
        $letradni = "L";
}

elseif ($restodivision == 20) {
        $letradni = "C";
}

elseif ($restodivision == 21) {
        $letradni = "K";
}

elseif ($restodivision == 22) {
        $letradni = "E";
}
elseif ($restodivision >= 23) {
	print "Revise el DNI indicado";
	die;
}
print "La letra de tu DNI es $letradni? Si no es asi revise el numero del DNI indicado"
?>
