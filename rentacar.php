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
$municipio=array();
foreach($fulldata->row as $data) {
	$municipio[$i]=$data->municipi;
	$postalcode[$i]=$data->adre_a_de_l_establiment;
	$nombre[$i]=$data->denominacio_comercial;
	$i++;
}
var_dump($municipio);
echo "<br>";
//var_dump($postalcode);
echo "<br>";
//var_dump($nombre);

$municipio=isset($_GET["municipio"]) ? $_GET["municipio"] : "";
$postalcode=isset($_GET["codigo_postal"]) ? $_GET["codigo_postal"] : "";
$nombre=isset($_GET["nombre"]) ? $_GET["nombre"] : "";

ksort()
?>

<from action="rentacar.php" method="get">
	<label for="municipios">Elije el municipio:</label>
	<select id="municipios" name="municipios>
<?php
//echo "Municipio: ".$municipio."<br>";
//echo "Codigo postal: ".$postalcode."<br>";
//echo "Nombre: ".$nombre."<br>";
	?>

</body>
</html>
