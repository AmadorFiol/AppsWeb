<?php
$edat = $_GET['edat'];
if ($edat >= 0 && $edat <= 3) {
print "Ets un infant";
}
elseif ($edat >= 4 && $edat <= 17) {
print "Ets un nin";
}
elseif ($edat >= 18 && $edat <=64) {
print "Ets un adult";
}
elseif ($edat >= 64) {
print "Ets un senior";
}
else {
print "Escriu un valor valid";
}
?>
