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
//var_dump($rellenar);
echo "<br>";

$municipio=isset($_POST["municipio"]) ? $_POST["municipio"] : "";
$postalcode=isset($_POST["codigo_postal"]) ? $_POST["codigo_postal"] : "";
$nombre=isset($_POST["nombre"]) ? $_POST["nombre"] : "";

ksort($rellenar)
?>

<form action="rentacar.php" id="form" method="post">
<label for="postalcodes">Elige el código postal:</label>
<select id="postalcodes" name="postalcode">
<?php 
	foreach ($rellenar as $municipio => $establecimientos) {
		foreach ($establecimientos as $establecimiento) {
			echo "<option value=\"" . $establecimiento["codigo_postal"] . "\">" . $establecimiento["codigo_postal"] . "</option>";
		}
	}
?>
</select>
<br>
<fieldset>
	<legend>Selecciona un municipio:</legend>
	<?php
		foreach ($rellenar as $municipio => $establecimientos) {
			echo "<input type=\"radio\" id=\"" . $municipio . "\" name=\"municipio\" value=\"" . $municipio . "\">";
			echo "<label for=\"" . $municipio . "\">" . $municipio . "</label><br>";
		}
	?>
</fieldset>
<br>
	Nombre de la empresa:<input type="text" name="nombre" value="<?php echo $nombre; ?>">
<?php
if(isset($_POST["municipio"]) || isset($_POST["postalcode"])) {
	$municipioSeleccionado = $_POST["municipio"];
	$postalcodeSeleccionado = $_POST["postalcode"];
	echo "<h2>Establecimientos en " . $municipioSeleccionado . " con código postal " . $postalcodeSeleccionado . "</h2>";
	echo "<table border='1'>";
	echo "<tr><th>Nombre Comercial</th><th>Municipio</th></tr>";
	if (!empty($municipioSeleccionado)) {
		foreach ($rellenar[$municipioSeleccionado] as $establecimiento) {
			if ($establecimiento["codigo_postal"] == $postalcodeSeleccionado) {
				echo "<tr><td>" . $establecimiento["nombre_comercial"] . "</td><td>" . $municipioSeleccionado . "</td></tr>";
			}
		}
	} else {
		foreach ($rellenar as $municipio => $establecimientos) {
			foreach ($establecimientos as $establecimiento) {
				echo "<tr><td>" . $establecimiento["nombre_comercial"] . "</td><td>" . $municipio . "</td></tr>";
			}
		}
	}
	echo "</table>";
}
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
	document.getElementById('postalcodes').addEventListener('change', function() {
		document.getElementById('form').submit();
	});
	var radios = document.querySelectorAll('input[name="municipio"]');
	radios.forEach(function(radio) {
		radio.addEventListener('change', function() {
			document.getElementById('form').submit();
		});
	});
});
</script>

</body>
</html>
