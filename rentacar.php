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
$datos = array();
foreach ($fulldata->row as $data) {
    $municipio = (string) $data->municipi;
    $adressa = $data->adre_a_de_l_establiment;
    $codigoPostal = intval(preg_replace('/[^0-9]+/', '', $adressa), 10);
    
    if (isset($datos[$municipio])) {
        $datos[$municipio][] = $codigoPostal;
    } else {
        $datos[$municipio] = array($codigoPostal);
    }
}
var_dump($datos);
var_dump($rellenar);
echo "<br>";
//var_dump($postalcode);
echo "<br>";
//var_dump($nombre);

$municipio=isset($_GET["municipio"]) ? $_GET["municipio"] : "";
$postalcode=isset($_GET["codigo_postal"]) ? $_GET["codigo_postal"] : "";
$nombre=isset($_GET["nombre"]) ? $_GET["nombre"] : "";

//ksort($municipio)
?>

<from action="rentacar.php" method="get">
	<label for="municipios">Elije el municipio:</label>
	<select id="municipios" name="municipios">
		<?php foreach($data->municipi as $relleno[$municipio]){
			echo "<option value=".$relleno[$municipio].">".$relleno[$municipio]."</option>";
			}?>
	</select>
<?php
//echo "Municipio: ".$municipio."<br>";
//echo "Codigo postal: ".$postalcode."<br>";
//echo "Nombre: ".$nombre."<br>";
	?>

</body>
</html>
