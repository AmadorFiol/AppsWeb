<!DOCTYPE html>

<html>
	<title>Ejercicio XML</title>

<body>
	<?php
$url = "https://catalegdades.caib.cat/resource/rjfm-vxun.xml";
if (!$xml = file_get_contents($url)) {
	echo "No se ha podido cargar la url";
} else {
	//echo "Se ha podido cargar la url <br>";
	$xml = simplexml_load_string($xml);
	//var_dump($xml);
}

$fulldata=$xml->rows;
//var_dump($fulldata);
$i=0;
$rellenar = array();
foreach ($fulldata->row as $data) {
	$municipio = (string) $data->municipi;
	$adressa = $data->adre_a_de_l_establiment;
	$postalcode = intval(preg_replace('/[^0-9]+/', '', $adressa), 10);
	$nombre = $data->denominaci_comercial;
	if (isset($rellenar[$municipio])) {
		$rellenar[$municipio][] = array("nombre_comercial" => $nombre, "codigo_postal" => $postalcode);
	} else {
		$rellenar[$municipio] = array(array("nombre_comercial" => $nombre, "codigo_postal" => $postalcode));
	}
}
var_dump($rellenar);
echo "<br>";

$municipio=isset($_GET["municipio"]) ? $_GET["municipio"] : "";
$postalcode=isset($_GET["codigo_postal"]) ? $_GET["codigo_postal"] : "";
$nombre=isset($_GET["nombre"]) ? $_GET["nombre"] : "";

ksort($rellenar)
?>

<from action="rentacar.php" method="get">
	<label for="municipios">Elije el municipio:</label>
	<select id="municipios" name="municipio">
    <?php 
    foreach ($rellenar as $municipio => $codigosPostales) {
        echo "<option value=\"$municipio\">$municipio</option>";
    }
    ?>
</select>
<?php
//echo "Municipio: ".$municipio."<br>";
//echo "Codigo postal: ".$postalcode."<br>";
//echo "Nombre: ".$nombre."<br>";
	?>

</body>
</html>
