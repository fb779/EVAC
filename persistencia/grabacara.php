<?php
if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){ //validamos que la peticion sea ajax
	$jsondata = array();
	$jsondata['errors'] = array();
	$erAud = 0; $erMOD = 0; $erINS = 0; $erDEL = 0;
	$errors = array(); $mensajes = array();

	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';

	$emp = $_POST['emp'];
	$dtForm = json_decode($_POST['dtForm']);

	$qEmpresa = $conn->query("SELECT * FROM caratula WHERE nordemp = " . $emp)->fetch(PDO::FETCH_BOTH);
	// $qEmpresa = $conn->query("SELECT * FROM caratula WHERE nordemp = " . $emp)->fetch(PDO::FETCH_ASSOC);

	$lineaMOD = 'UPDATE caratula SET ';
	$sets = '';

	foreach ($dtForm as $dt) {
		if (array_key_exists($dt->name, $qEmpresa) && $dt->value != $qEmpresa[$dt->name]  ){
			$variab = $dt->name;
			$valAnt = $qEmpresa[$dt->name];
			$valAct = $dt->value;

			try {
				/* Crear la auditoria de los campos que cambiaron de la caratula */
				$creaLog = $conn->prepare('INSERT INTO auditoria (numemp, tipo_usuario, usuario, fec_mod, hora_mod, nom_var, valor_anterior, valor_actual, tabla) VALUES (:numero, :tipo, :usuario, :fecha, :hora, :variable, :anterior, :actual, :tabla)');
				// $creaLog->execute(array(':numero'=>$emp, ':tipo'=>$_SESSION['tipou'], ':usuario'=>$_SESSION['idusu'], ':fecha'=>date("Y-m-d"), 	'hora'=> "'".date("h:i:sa")."'", ':variable'=>$variab, ':anterior'=>$valAnt, ':actual'=>$valAct, ':tabla'=>"caratula"));
				/* Creamos el set para la modificacion de los campos */
				$sets .= $variab ." = '" . $valAct . "',";
			} catch (Exception $e) {
				$erAud ++;
				$jsondata['errors'][$erAud] = $e->getMessage();
			}
		}
	} /*end FOR */

	if ($sets != '' && $erAud == 0) {
		$lineaMOD .= trim($sets, ',');
		try {
			$qUpdate = $conn->query($lineaMOD);
		} catch (Exception $e) {
			$erMOD ++;
		}
	}

	/* GUARDADO DE DATOS DE ACTIVIDADES ADICIONALES ciiu PARA CARATULA */
	$qAtEm = $conn->query('SELECT actividad FROM actiemp WHERE nordemp = ' . $emp);
	if (isset($_POST['dtActi']) && $_POST['dtActi']!='' ) {
		$dtActi = json_decode($_POST['dtActi']);
	}

	$qAct = array(); $fAct = array();
	/* Arreglo de las actividades en la bd de la empresas */
	foreach ($qAtEm as $dt) {
		$qAct[] = $dt['actividad'];
		$jsondata['qAct'] = $qAct;
	}

	/* Arreglo de actividades que ingresa el usuario */
	foreach ($dtActi as $dt) {
		$fAct[] = $dt->name;
		$jsondata['fAct'] = $fAct;
	}

	/* Preparacion de elementos a eliminar */
	$dele = '';
	foreach ($qAct as $dt) {
		if ( !in_array( $dt, $fAct) ){
			$dele .= "'" . $dt . "',";
		}
	}

	/* Preparacion de elementos a insertar */
	$inse = '';
	foreach ($fAct as $dt) {
		if ( !in_array( $dt, $qAct) ){
			$inse .= "('" . $emp . "', '" . $dt . "'),";
		}
	}

	/* Ejecucion de querys si existen elementos */
	if ($dele != ''){
		try {
			$lineaDEL = 'DELETE FROM actiemp WHERE nordemp = '. $emp .' AND actividad IN ('. rtrim($dele,',') .')';
			$conn->query($lineaDEL);
		} catch (Exception $e) {
			$erDEL ++;
		}
	}

	if ($inse != ''){
		try {
			$lineaINS = 'INSERT INTO actiemp (nordemp, actividad) VALUES ' . rtrim($inse,',');
			$conn->query($lineaINS);
			$jsondata['qInsert'] = $lineaINS;
		} catch (Exception $e) {
			$erINS ++;
		}
	}

	if ( ($erAud + $erMOD + $erDEL + $erINS) == 0 ){
		$jsondata['success'] = true;
	}else{
		$jsondata['success'] = false;
	}

	$jsondata['erAud'] = $erAud;
	$jsondata['erMOD'] = $erMOD;
	$jsondata['erINS'] = $erINS;
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	exit();
} else {
	exit();
}
?>
