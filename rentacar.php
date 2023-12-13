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
	preg_match('/\b\d{5}\b/', $adressa, $postalcode);
	$nombre = $data->denominaci_comercial;
	$cantidadCoches = (string) $data->nombre_de_vehicles;

	$establecimiento = array(
		"nombre_comercial" => $nombre,
		"codigo_postal" => $postalcode,
		"cantidad_coches" => $cantidadCoches,
		"direccion" => $adressa
	);
	if (isset($rellenar[$municipio])) {
		$rellenar[$municipio][] = $establecimiento;
	} else {
		$rellenar[$municipio] = array($establecimiento);
	}
}
//var_dump($rellenar);
echo "<br>";

$municipio=isset($_POST["municipio"]) ? $_POST["municipio"] : "";
$postalcode=isset($_POST["codigo_postal"]) ? $_POST["codigo_postal"] : "";
$nombre=isset($_POST["nombre"]) ? $_POST["nombre"] : "";

ksort($rellenar)
?>

<form method="post" action="rentacar.php">
    <fieldset>
        <legend>Selecciona un municipio:</legend>
        <?php
            foreach ($rellenar as $municipio => $establecimientos) {
                echo "<input type=\"radio\" id=\"" . $municipio . "\" name=\"municipio\" value=\"" . $municipio . "\">";
                echo "<label for=\"" . $municipio . "\">" . $municipio . "</label><br>";
            }
?>
</fieldset>
<?php
	$postalcodes = array();
		foreach ($rellenar as $municipio => $establecimientos) {
			foreach ($establecimientos as $establecimiento) {
				foreach ($establecimiento['codigo_postal'] as $cp) {
					$postalcodes[] = $cp;
				}
			}
		}
		sort($postalcodes, SORT_NUMERIC);
		echo "<label for=\"codigo_postal\">Selecciona un código postal:</label>";
		echo "<select name=\"codigo_postal\" id=\"codigo_postal\">";
		echo "<option value=\"\">Selecciona un código postal</option>";
		foreach ($postalcodes as $cp) {
			echo "<option value=\"$cp\">$cp</option>";
		}
		echo "</select>";
?>
<br>
<input type="submit" value="Filtrar">
</form>
<br>
	Nombre de la empresa:<input type="text" name="nombre" value="<?php echo $nombre; ?>">
<?php
if (isset($_POST["municipio"])) {
    $municipioSeleccionado = $_POST["municipio"];
    $postalcodeSeleccionado = $_POST["codigo_postal"];

    echo "<h2>Establecimientos en " . $municipioSeleccionado . "</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Nombre Comercial</th><th>Cantidad de coches disponibles</th><th>Dirección</th></tr>";
    
    foreach ($rellenar[$municipioSeleccionado] as $establecimiento) {
        echo "<tr><td>" . $establecimiento['nombre_comercial'] . "</td><td>" . $establecimiento['cantidad_coches'] . "</td><td>" . $establecimiento['direccion'] . "</td></tr>";
    }

    echo "</table>";
}
?>
</body>
</html>
