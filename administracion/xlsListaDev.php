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
	
	if ($region == 99) {
		if ($tipousu == "CO" OR $tipousu == "AT" OR $tipousu == "TE") {
			$qDevueltos = $conn->prepare("SELECT a.vigencia, a.nordemp, c.nombre AS empresa, d.nombre AS Sede, b.nombre AS nombreusu, a.fecha,
				a.tipo, REPLACE(a.observa, '\n', '') AS observa FROM devoluciones a, usuarios b, caratula c, regionales d WHERE a.vigencia =$vig
				AND b.ident = a.codcrit AND c.nordemp = a.nordemp AND d.codis = a.codsede ORDER BY a.nordemp, a.fecha DESC");
		}
		else {
			if ($tipousu == "CR") {
				$qDevueltos = $conn->prepare("SELECT a.vigencia, a.nordemp, c.nombre AS empresa, d.nombre AS Sede, b.nombre AS nombreusu, a.fecha,
					a.tipo, REPLACE(a.observa, '\n', '') AS observa FROM devoluciones a, usuarios b, caratula c, regionales d WHERE a.vigencia =$vig
					AND a.coddev = '$id_usu' AND b.ident = a.codcrit AND c.nordemp = a.nordemp AND d.codis = a.codsede
					ORDER BY a.nordemp, a.fecha DESC");
			}
		}
	}
	else {
		if ($tipousu == "CO" OR $tipousu == "AT" OR $tipousu == "TE") {
			$qDevueltos = $conn->prepare("SELECT a.vigencia, a.nordemp, c.nombre AS empresa, d.nombre AS Sede, b.nombre AS nombreusu, a.fecha,
				a.tipo, REPLACE(a.observa, '\n', '') AS observa FROM devoluciones a, usuarios b, caratula c, regionales d WHERE a.vigencia =$vig
				AND b.ident = a.codcrit AND a.codsede = $region AND c.nordemp = a.nordemp AND d.codis = a.codsede ORDER BY a.nordemp, a.fecha DESC");
		}
		else {
			if ($tipousu == "CR") {
				$qDevueltos = $conn->prepare("SELECT a.vigencia, a.nordemp, c.nombre AS empresa, d.nombre AS Sede, b.nombre AS nombreusu, a.fecha,
				a.tipo, REPLACE(a.observa, '\n', '') AS observa FROM devoluciones a, usuarios b, caratula c, regionales d WHERE a.vigencia =$vig AND a.codcrit = '$id_usu'
				AND b.ident = a.codcrit AND a.codsede = $region AND c.nordemp = a.nordemp AND d.codis = a.codsede ORDER BY a.nordemp, a.fecha DESC");
			}
		}
	}
	$qDevueltos->execute();
	
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=devoluciones.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	$cabeza = false;
	while ($tabla = $qDevueltos->fetch(PDO::FETCH_ASSOC)) {
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
