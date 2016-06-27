<?php
	if (session_id() == "") {
		session_start();
	 }
	 
	ini_set('default_charset', 'UTF-8');
	 
	if (!isset($_SESSION['tipou'])) {
		echo "<h2 style='text-align: center; font-family: arial'>SESI�N HA FINALIZADO. DEBE AUTENTICARSE DE NUEVO</h2>";
		return;
	}	
	include '../conecta.php';
	$vig = $_SESSION['vigencia'];
	$select = $conn->prepare("SELECT * FROM hoja_casos ORDER BY nordemp");
	$select->execute();
	
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=hoja_casos.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	$cabeza = false;
	while ($tabla = $select->fetch(PDO::FETCH_ASSOC)) {
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
