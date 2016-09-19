<?php
	if(session_id()  == "") {
		session_start();
	}

	if (!isset($_SESSION['tipou'])) {
		echo "<h2 style='text-align: center; font-family: arial'>SESI�N HA FINALIZADO. DEBE AUTENTICARSE DE NUEVO</h2>";
		return;
	}

	include '../conecta.php';

	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$idusuario = $_SESSION['idusu'];
	$numero = $_POST['numero'];
	$vig = $_SESSION['vigencia'];

	// echo "REGIONAL " . $region;

	if (isset($_POST['envio'])) {
		$qControl = $conn->query("SELECT * FROM control WHERE nordemp = $numero AND vigencia = $vig");
		foreach($qControl AS $rowCtl) {
			if ($rowCtl['novedad'] == 0 OR $rowCtl['novedad'] == 5) {
				$novactu = 99;
			}
			else {
				$novactu = $rowCtl['novedad'];
			}
		}
		if ($region == 99) {
			$lineaCTL = $conn->prepare("UPDATE control SET estado = 6, aceptadc = curdate() WHERE nordemp = $numero AND vigencia = $vig");
			$lineaCTL->execute();
			echo "FORMULARIO ACEPTADO";
		}
		else {
			if ($tipousu != "FU") {
				$lineaCTL = $conn->prepare("UPDATE control SET estado = 5, acceso = 'DC', fecacept = curdate() WHERE nordemp = $numero AND vigencia = $vig");
				$lineaCTL->execute();
				echo "FORMULARIO ENVIADO CRITICO";
			}
			else {
				$lineaCTL = $conn->prepare("UPDATE control SET estado = 4, acceso = 'CR', novedad = $novactu, fecrev = curdate() WHERE nordemp = $numero AND vigencia = $vig");
				$lineaCTL->execute();
				echo "FORMULARIO ENVIADO FUENTE";
			}
		}
	}

	if (isset($_POST['capitulo'])) {
		$modulo = $_POST['modulo'];
		if (isset($_POST['dtGrabar'])){
			$graba = $_POST['dtGrabar'];
		} else {
			$graba = 0;
		}


		if ($tipousu == "CR") {
			$estado = 3;
		}
		else {
			$estado = $_POST['estado'];
		}
		$capitulo = $_POST['capitulo'];
		$qControl = $conn->query("SELECT * FROM control WHERE nordemp = $numero AND vigencia = $vig");
		foreach($qControl AS $rowCtl) {
			$m1 = $rowCtl['m1'];
// 			$m2 = $rowCtl['m2'];
// 			$m3 = $rowCtl['m3'];
// 			$m4 = $rowCtl['m4'];
// 			$m5 = $rowCtl['m5'];
// 			$m6 = $rowCtl['m6'];
		}
		if ($rowCtl['estado'] < 3) {
			//if ($m1+$m2+$m3+$m4+$m5+$m6 == 12) {
			if ($m1 == 2 && $graba == 1) {
				$estadoFor = 3;
			}
			else {
				$estadoFor = 2;
			}
		}
		else {
			$estadoFor = $rowCtl['estado'];
		}

		if ($tipousu == "FU") {
			$lineaCTL = $conn->prepare("UPDATE control SET $modulo = $estado, estado = $estadoFor, fecdig = curdate() WHERE nordemp = $numero AND vigencia = $vig");
		}
		else {
			$lineaCTL = $conn->prepare("UPDATE control SET $modulo = $estado, estado = $estadoFor WHERE nordemp = $numero AND vigencia = $vig");
		}
		$lineaCTL->execute();
	}

	if (isset($_POST['devol'])) {
		$qControl = $conn->query("SELECT * FROM control WHERE nordemp = $numero AND vigencia = $vig");
		foreach($qControl AS $rowCtl) {
			$codcrit = $rowCtl['usuarioss'];
			$sede = $rowCtl['codsede'];
		}
		$txtObser = $_POST['observa'];
		$creaDev = $conn->prepare("INSERT INTO devoluciones (vigencia,nordemp,observa,codsede,tipo,coddev,codcrit,fecha) VALUES
			($vig,$numero,'$txtObser',$sede,'DEV','$idusuario','$codcrit',curdate())");
		$creaDev->execute();
		$estadoDev = $conn->prepare("UPDATE control SET estado = 4, acceso = 'CR' WHERE nordemp = $numero AND vigencia = $vig");
		$estadoDev->execute();
		echo "FORMULARIO DEVUELTO";
	}

	if (isset($_POST['reenv'])) {
		$qControl = $conn->query("SELECT * FROM control WHERE nordemp = $numero AND vigencia = $vig");
		foreach($qControl AS $rowCtl) {
			$coddev = $rowCtl['usuario'];
			$sede = $rowCtl['codsede'];
		}
		//$txtObser = $_POST['observa'];
		$creaRev = $conn->prepare("INSERT INTO devoluciones (vigencia,nordemp,observa,codsede,tipo,coddev,codcrit,fecha) VALUES
			($vig,$numero,'',$sede,'RV','$coddev','$idusuario',curdate())");
		$creaRev->execute();

		$estadoDev = $conn->prepare("UPDATE devoluciones SET tipo = 'DVR' WHERE nordemp = $numero AND vigencia = $vig AND tipo = 'DEV'");
		$estadoDev->execute();

		$estadoRev = $conn->prepare("UPDATE control SET estado = 5, acceso = 'DC' WHERE nordemp = $numero AND vigencia = $vig");
		$estadoRev->execute();
		echo "FORMULARIO REENVIADO";
	}

	if (isset($_POST['obser'])) {
		$numero = $_POST['numero'];
		$capi = $_POST['capit'];
		$observa = $_POST['observa'];
		if (!empty($observa)) {
			$insObs = $conn->prepare("INSERT INTO observaciones (vigencia,nordemp,usuario,capitulo,observacion,fecha) VALUES
				($vig,$numero,'$idusuario',$capi,'$observa',curdate())");
			$insObs->execute();

			$jsondata['message'] = 'Guardado de la observacion';
			$jsondata['success'] = true;
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($jsondata);

		}
	}
?>
