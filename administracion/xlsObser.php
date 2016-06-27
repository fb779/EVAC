<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$id_usu = $_SESSION['idusu'];
	$vig = $_SESSION['vigencia'];
	$tipousu = $_SESSION['tipou'];
	$nombre = $_SESSION['nombreu'];
	$region = $_SESSION['region'];
	$pagina = "CONSULTA DEVOLUCIONES";

	$qNregion = $conn->prepare("SELECT nombre FROM regionales WHERE codis = :nRegion");
	$qNregion->execute(array(':nRegion'=>$region));
	$rowRegion = $qNregion->fetch(PDO::FETCH_ASSOC);
	
	$qObserva = $conn->prepare("SELECT vigencia,nordemp,usuario,capitulo,REPLACE(observacion, '\n', '') AS observacion, fecha FROM observaciones
		WHERE vigencia = $vig AND LENGTH(observacion)>0");

	$qObserva->execute();
	
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=observaciones.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	//echo "\xEF\xBB\xBF"; //Para manejar los acentos al pasar textos a Excel.
	//print chr(255) . chr(254) . mb_convert_encoding('UTF-16LE', 'UTF-8'); // Sale en chino
	
	$cabeza = false;
	while ($tabla = $qObserva->fetch(PDO::FETCH_ASSOC)) {
		if (!$cabeza) {
			echo implode("\t", array_keys($tabla)) . "\r\n";
			$cabeza = true;
		}
		echo implode("\t", array_values($tabla)) . "\r\n";
	}
	exit;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>EDIT - Descarga de Archivos</title>
</head>
<body>

</body>
</html>
