<?php
	if (session_id() == "") {
		session_start();
	 }

	ini_set('default_charset', 'UTF-8');

	if (!isset($_SESSION['tipou'])) {
		echo "<h2 style='text-align: center; font-family: arial'>SESI&Oacute;N HA FINALIZADO. DEBE AUTENTICARSE DE NUEVO</h2>";
		return;
	}
	include '../conecta.php';
	$vig = $_SESSION['vigencia'];
	// $select = $conn->prepare("SELECT a.* FROM capitulo_i a WHERE a.C1_nordemp IN (SELECT b.nordemp FROM control b WHERE b.vigencia = $vig AND b.estado IN (4,5,6))");
	// $select = $conn->prepare("SELECT ci.C1_nordemp, ci.vigencia, ci.i1r1c1, ci.i1r1c2, ci.i1r1c3, ci.i1r1c4, ci_d.i1r2c1, ci_d.i1r2c2, ci_d.i1r2c3, ci_d.i1r2c4, ci_d.i1r2c5, ci_d.i1r2c6, ci_d.i1r2c7, ci_d.i1r2c8, ci_d.i1r2c9, ci_d.i1r2c10, ci_d.i1r2c11, ci_d.i1r2c12, ci_d.i1r2c13, ci_d.i1r2c14, ci.i1r3c1, ci.i1r3c2, ci.i1r3c3, ci.i1r3c4, ci.i1r3c5, ci.i1r3c6, ci.i1r3c7, ci.i1r3c8, ci.i1r3c9, ci.i1r4c1, OBSERVACIONES FROM capitulo_i AS ci INNER JOIN capitulo_i_displab AS ci_d ON ci.C1_nordemp = ci_d.C1_nordemp AND ci.vigencia = ci_d.vigencia INNER JOIN control AS ct on ct.nordemp = ci.C1_nordemp AND ct.vigencia = ci.vigencia WHERE ci.vigencia = :vigencia AND ct.estado IN (4,5,6)");
	$select = $conn->prepare("SELECT ci.C1_nordemp, ci.vigencia, ci.i1r1c1, ci.i1r1c2, ci.i1r1c3, ci.i1r1c4, ci_d.*, ci.i1r3c1, ci.i1r3c2, ci.i1r3c3, ci.i1r3c4, ci.i1r3c5, ci.i1r3c6, ci.i1r3c7, ci.i1r3c8, ci.i1r3c9, ci.i1r4c1, OBSERVACIONES FROM capitulo_i AS ci INNER JOIN capitulo_i_displab AS ci_d ON ci.C1_nordemp = ci_d.C1_nordemp AND ci.vigencia = ci_d.vigencia INNER JOIN control AS ct on ct.nordemp = ci.C1_nordemp AND ct.vigencia = ci.vigencia WHERE ci.vigencia = :vigencia AND ct.estado IN (4,5,6)");
	$select->execute(array(':vigencia' => $vig));

	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=capitulo_I.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	$cabeza = false;
	while ($tabla = $select->fetch(PDO::FETCH_ASSOC)) {
		if (!$cabeza) {
			echo implode("\t", array_keys($tabla)) . "\r\n";
			$cabeza = true;
		}
		$tabla['OBSERVACIONES'] = str_replace("\r\n", "", $tabla['OBSERVACIONES']);
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
