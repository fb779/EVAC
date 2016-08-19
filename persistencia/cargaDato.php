<?php
	include '../conecta.php';
	if (isset($_GET['mpio'])) {
		$codigodep = $_GET['codep'];
		$qMpio = $conn->prepare("SELECT muni, nmuni FROM divipola WHERE dpto = :idDpto");
		$qMpio->execute(array('idDpto'=>$codigodep));
		echo "<select class='form-control' name = '" . $_GET['nomlista'] . "' id='" . $_GET['idlista'] . "'>";
		foreach($qMpio AS $lMpio) {
			echo "<option value='" . $lMpio['muni'] . "'>" . $lMpio['nmuni'] . "</option>";
		}
		echo "</select>";
	}

	if (isset($tabla)) {
		switch($tabla) {
			case "capitulo_i":
				$llave = "C1_nordemp";
				break;
// 			case "capitulo_ii":
// 				$llave = "C2_nordemp";
// 				break;
// 			case "capitulo_iii":
// 				$llave = "C3_nordemp";
// 				break;
// 			case "capitulo_iv":
// 				$llave = "C4_nordemp";
// 				break;
// 			case "capitulo_v":
// 				$llave = "C5_nordemp";
// 				break;
// 			case "capitulo_vi":
// 				$llave = "C6_nordemp";
// 				break;
// 			case "capitulo_vii":
// 				$llave = "C7_nordemp";
// 				break;
		}
		$qCapitulo = $conn->prepare("SELECT * FROM $tabla WHERE $llave = :nFuente AND vigencia = :periodo");
		$qCapitulo->execute(array('nFuente'=>$numero, 'periodo'=>$vig));
		$row = $qCapitulo->fetch(PDO::FETCH_ASSOC);
		if (!($row)) {
			$nrec = $conn->prepare("INSERT INTO $tabla ($llave, vigencia) VALUES (:numero, :periodo)");
			$nrec->execute(array(':numero'=>$numero, ':periodo'=>$vig));

			$qCapitulo = $conn->prepare("SELECT * FROM $tabla WHERE $llave= :idNumero AND vigencia = :periodo");
			$qCapitulo->execute(array(':idNumero'=>$numero, ':periodo'=>$vig));
			$row = $qCapitulo->fetch(PDO::FETCH_BOTH);
		}

		$qControl = $conn->prepare("SELECT a.*, b.desc_estado FROM control a, estados b WHERE a.nordemp = :nFuente AND a.vigencia = :periodo
			AND a.estado = b.idestados");
		$qControl->execute(array('nFuente'=>$numero, 'periodo'=>$vig));
		$rowCtl = $qControl->fetch(PDO::FETCH_ASSOC);

		$qEditEas = $conn->prepare("SELECT e.*, c.*, r.nombre nombre_regional
					    FROM edit_eas e
					    INNER JOIN caratula c ON e.nordemp = c.nordemp
					    INNER JOIN regionales r ON c.regional = r.codis
					    WHERE e.nordemp = :nFuente");
		$qEditEas->execute(array('nFuente'=>$numero));
		$rowEditEas = $qEditEas->fetch(PDO::FETCH_ASSOC);

		if ($tipousu == "FU" AND $rowCtl['acceso'] == "FU" AND $rowCtl['estado'] < 4) {
			$grabaOK = true;
		}
		if ($region != 99) {
			if ($tipousu == "CR" AND $rowCtl['acceso'] == "CR" AND $rowCtl['estado'] == 4) {
				$grabaOK = true;
			}
		}
		if ($region == 99) {
			if ($tipousu == "CR" AND $rowCtl['acceso'] == "DC" AND $rowCtl['estado'] > 4) {
				$grabaOK = true;
			}
		}
	}
?>
