<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$id_usu = $_SESSION['idusu'];
	$vig = $_SESSION['vigencia'];
	$tipousu = $_SESSION['tipou'];
	$region = $_SESSION['region'];
	$numero = $_POST['numero'];
	
	switch ($region) {
		case 1:
			$sedes = "(1,9,12,16,23,24)";
			break;
		case 2:
			$sedes = "(2,13,17,18)";
			break;
		case 3:
			$sedes = "(3,10)";
			break;
		case 4:
			$sedes = "(4,14,15)";
			break;
		case 5:
			$sedes = "(5,7,8,11)";
			break;
		case 6:
			$sedes = "(6)";
			break;
	}
	
	if ($_POST['accion'] == "limpiar") {
		$qLimpiaC1 = $conn->query("DELETE FROM capitulo_i WHERE C1_nordemp = $numero");
		$qLimpiaC2 = $conn->query("DELETE FROM capitulo_ii WHERE C2_nordemp = $numero");
		$qLimpiaC3 = $conn->query("DELETE FROM capitulo_iii WHERE C3_nordemp = $numero");
		$qLimpiaC4 = $conn->query("DELETE FROM capitulo_iv WHERE C4_nordemp = $numero");
		$qLimpiaC5 = $conn->query("DELETE FROM capitulo_v WHERE C5_nordemp = $numero");
		$qLimpiaC6 = $conn->query("DELETE FROM capitulo_vi WHERE C6_nordemp = $numero");
		$qlimCtl = $conn->query("UPDATE control SET estado = 1, acceso = 'FU', novedad = 5,m1=0,m2=0,m3=0,m4=0,m5=0,m6=0 WHERE nordemp = $numero AND vigencia = $vig");
	}
	if ($_POST['accion'] == "traslado") {
		if ($_POST['sede'] == 0) {
			echo "DEBE SELECCIONAR UNA SEDE";
		}
		else {
			$nvaSede = $_POST['sede'];
			$qTrasCara = $conn->query("UPDATE caratula SET regional = $nvaSede WHERE nordemp = $numero");
			$qTrasCtl = $conn->query("UPDATE control SET codsede = $nvaSede, usuarioss = '' WHERE nordemp = $numero AND vigencia = $vig");
			echo "TRASLADO REALIZADO";
		}
	}
	if ($_POST['accion'] == "novedad") {
		if ($_POST['nove'] == 0) {
			echo "DEBE SELECCIONAR UNA NOVEDAD";
		}
		else {
			$nvaNov = $_POST['nove'];
			$obser = $_POST['obsnov'];
			$qNovCtl = $conn->query("UPDATE control SET novedad = $nvaNov WHERE nordemp = $numero");
			$qCreaObs = $conn->prepare("INSERT INTO observaciones (vigencia,nordemp,usuario,capitulo,observacion,fecha) VALUES
				(:vige, :numer, :usu, :capi, :obse, curdate())");
			$qCreaObs->execute(array(':vige'=>$vig, ':numer'=>$numero, ':usu'=>$id_usu, ':capi'=>99, ':obse'=>$obser));
			echo "NOVEDAD ASIGNADA";
		}
	}
	if ($_POST['accion'] == "verifica") {
		if ($region == 99) {
			$qCaratula = $conn->query("SELECT nordemp FROM caratula WHERE nordemp = $numero");
			if($qCaratula->rowCount()==0) {
				echo "Numero de Orden NO EXISTE";
			}
		}
		else {
			if ($tipousu == "AT") {
				$qCaratula = $conn->query("SELECT nordemp FROM caratula WHERE nordemp = $numero AND regional IN $sedes");
				if($qCaratula->rowCount()==0) {
					echo "Numero de Orden NO EXISTE o no corresponde a la regional";
				}
			}
			if ($tipousu == "CO") {
				$qCaratula = $conn->query("SELECT nordemp FROM caratula WHERE nordemp = $numero AND regional = $region");
				if($qCaratula->rowCount()==0) {
					echo "Numero de Orden NO EXISTE o no corresponde a la Sede";
				}
			}
			if ($tipousu == "CR") {
				$qCaratula = $conn->query("SELECT nordemp FROM control WHERE nordemp = $numero AND usuarioss = '$id_usu'");
				if($qCaratula->rowCount()==0) {
					echo "Numero de Orden NO EXISTE o no ha sido asignado";
				}
			}
		}
	}
	if ($_POST['accion'] == "asigFecha") {
		$fechaOK = true;
		$fecha = $_POST['fecha'];
		$hoy = date("Y-m-d");
		$year = date("Y");
		$yearDist = date("Y", strtotime($fecha));
		if ($fecha > $hoy) {
			echo "Fecha de distribución no puede se mayor que fecha actual";
			$fechaOK = false;
		}
		if ($yearDist < $year) {
			echo "Fecha de distribución inválida";
			$fechaOK = false;
		}
		if ($fechaOK) {
			$qAsigna = $conn->query("UPDATE control SET fecdist = '$fecha', estado = 1 WHERE nordemp = $numero AND vigencia = $vig");
		}
	}
	
	if ($_POST['accion'] == "cestado") {
		$nvoestado = $_POST['nvoestado'];
		if ($nvoestado < 4) {
			$nvoacceso = "FU"; $nvanov = 5;
		}
		if ($nvoestado == 4) {
			$nvoacceso = "CR"; $nvanov = 99;
		}
		if ($nvoestado > 4) {
			$nvoacceso = "DC"; $nvanov = 99;
		}
		$cambiaEst = $conn->query("UPDATE control SET estado = $nvoestado, acceso = '$nvoacceso', novedad = $nvanov WHERE nordemp = $numero AND vigencia = $vig");
	}
?>
