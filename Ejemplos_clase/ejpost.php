<!DOCTYPE html>
<html>
        <head>
                <title>ejemplo post</title>
        </head>
        <body>
<form action="ejpost.php" method="post">
	Nom: <input type="text" name="nom"><br>
	Email: <input type="text" name="email"><br>
	Enviame un archivo: <input type="file" name="img"><br>
	<input type="submit" value="Enviar">
</form>
Hola <?php isset($_POST["nom"]) ? print $_POST["nom"] : ""; ?><br>
Email: <?php isset($_POST["email"]) ? print $_POST["email"] : ""; ?>
<?php
$img=isset($_POST['img']) ? $_POST['img']:'';
$route="opt/lampp/htdocs";
if ($img=='') {

}
else {
move_uploaded_file($img, $route);
}
?>
</body>
</html>
