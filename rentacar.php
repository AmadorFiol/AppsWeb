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
var_dump($rellenar);
echo "<br>";

$municipio=isset($_POST["municipio"]) ? $_POST["municipio"] : "";
$postalcode=isset($_POST["codigo_postal"]) ? $_POST["codigo_postal"] : "";
$nombre=isset($_POST["nombre"]) ? $_POST["nombre"] : "";

ksort($rellenar)
?>

<form method="post" action="tu_pagina.php">
    <label for="municipio">Selecciona un municipio:</label>
    <select name="municipio" id="municipio">
        <!-- Opciones para seleccionar el municipio -->
    </select>
    <label for="codigo_postal">Introduce un código postal:</label>
    <input type="text" name="codigo_postal" id="codigo_postal">
    <input type="submit" value="Filtrar">
</form>
<br>
	Nombre de la empresa:<input type="text" name="nombre" value="<?php echo $nombre; ?>">
<?php
if (isset($_POST["municipio"])) {
    $municipioSeleccionado = $_POST["municipio"];
    $codigoPostal = $_POST["codigo_postal"];

    echo "<h2>Establecimientos en " . $municipioSeleccionado . " con código postal " . $codigoPostal . "</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Nombre Comercial</th><th>Cantidad de coches disponibles</th><th>Dirección</th></tr>";
    
    foreach ($rellenar[$municipioSeleccionado] as $establecimiento) {
        // Filtrar por municipio y código postal
        if ($establecimiento["codigo_postal"] == $codigoPostal) {
            echo "<tr><td>" . $establecimiento['nombre_comercial'] . "</td><td>" . $establecimiento['cantidad_coches'] . "</td><td>" . $establecimiento['direccion'] . "</td></tr>";
        }
    }

    echo "</table>";
}
?>
</body>
</html>
