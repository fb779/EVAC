<?php
if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){
	$jsondata = array();
	$jsondata['errosAU'] = array();
	$erAud = 0; $erMOD = 0; $erINS = 0; $erDEL = 0;
	$errors = array(); $mensajes = array();

	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$vig = $_SESSION['vigencia'];
	$tipousu = $_SESSION['tipou'];
	$region = $_SESSION['region'];

	$mod = $_POST['mod'];
	$emp = $_POST['emp'];
	$dtForm = json_decode($_POST['dtForm']);
	$jsondata['dtForm'] = $_POST['dtForm'];
	// $dtDisp =  json_decode($_POST['dtDisp']);


	switch (substr($mod,0,2)) {
		case 'C1':
			$tabla = "capitulo_i";
			$llave = "C1_nordemp";
			$modulo = "m1";

			if ( count($dtForm) == 1 ){
				$campos = ",{\"name\": \"i1r1c2\", \"value\": 0},{\"name\": \"i1r1c3\", \"value\": 0},{\"name\": \"i1r1c4\", \"value\": 0},{\"name\":\"i1r3c1\",\"value\":\"0\"},{\"name\":\"i1r3c2\",\"value\":\"0\"},{\"name\":\"i1r3c3\",\"value\":\"0\"},{\"name\":\"i1r3c4\",\"value\":\"0\"},{\"name\":\"i1r3c5\",\"value\":\"0\"},{\"name\":\"i1r3c6\",\"value\":\"0\"},{\"name\":\"i1r3c7\",\"value\":\"0\"},{\"name\":\"i1r3c8\",\"value\":\"0\"},{\"name\": \"i1r3c9\", \"value\": \"\"},{\"name\": \"i1r4c1\", \"value\": \"\"},{\"name\": \"OBSERVACIONES\", \"value\": \"\"}]";
				$dtForm = json_decode(rtrim($_POST['dtForm'], ']') . $campos);
			}
			break;
	}

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->beginTransaction();

	$qCap1 = $conn->query('SELECT * from '. $tabla .' where '. $mod .' = ' . $emp . ' AND vigencia = ' . $vig )->fetch(PDO::FETCH_ASSOC);

	$lineaMOD = 'UPDATE '. $tabla .' SET ';
	$sets = '';

	foreach ($dtForm as $dt) {
		if (array_key_exists($dt->name, $qCap1) && $dt->value != $qCap1[$dt->name]  ){
			$variab = $dt->name;
			$valAnt = $qCap1[$dt->name];
			$valAct = $dt->value;

			try {
				/* Crear la auditoria de los campos que cambiaron de la caratula */
				$creaLog = $conn->prepare('INSERT INTO auditoria (numemp, tipo_usuario, usuario, fec_mod, hora_mod, nom_var, valor_anterior, valor_actual, tabla) VALUES (:numero, :tipo, :usuario, :fecha, :hora, :variable, :anterior, :actual, :tabla)');
				$creaLog->execute(array(':numero'=>$emp, ':tipo'=>$_SESSION['tipou'], ':usuario'=>$_SESSION['idusu'], ':fecha'=>date("Y-m-d"), 	'hora'=>date("h:i:s a"), ':variable'=>$variab, ':anterior'=>$valAnt, ':actual'=>$valAct, ':tabla'=>$tabla));
				/* Creamos el set para la modificacion de los campos */
				$sets .= $variab ." = '" . $valAct . "', ";
			} catch (Exception $e) {
				$erAud ++;
				$jsondata['errosAU'][$erAud] = $e->getMessage();

			}
		}
	} /*end FOR */


	if ($sets != '' && $erAud == 0) {
		$lineaMOD .= trim($sets, ', ') .' where ' . $llave . ' = ' . $emp . ' AND vigencia = ' . $vig ;
		try {
			$qUpdate = $conn->query($lineaMOD);
		} catch (Exception $e) {
			$erMOD ++;
		}
	}
	$jsondata['qMOD'] = $lineaMOD;

	/* Auditoria y Guardado de disponibilidades */

	if ($modulo == 'm1'){
		$dtDisp = json_decode($_POST['dtDisp']);
		$sv = count($dtDisp);
		$tvab = 0;
		$tvcb = 0;
		$tvnc = 0;

		$lineaINS = 'INSERT INTO capitulo_i_displab (C1_nordemp, vigencia, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14) values ';
		$tem = '';
		foreach ($dtDisp as $key=>$dt){
			$tem1 = "('" . $emp . "','" . $vig . "',";
			for ($j=0; $j<14; $j++){
				//$nc = 'i1r2c' . ($key+1). $j;
				if (isset($dt[$j]) && $dt[$j]->value != ''){
					$tem1 .= "'" . $dt[$j]->value . "',";
				}else{
					$tem1 .= "NULL,";
					if ($j < 12){
						$sv--;
						$j = 14;
						$tem1 = '';
					}
				}
			}

			if ($tem1 != ''){
				$tvab += $dt[0]->value;
				$tvcb += $dt[8]->value;
				$tvnc += $dt[11]->value;
				$tem .= rtrim($tem1, ",") .  '),';
			}
		}

		// $jsondata['sql'] = $lineaINS;
		// $jsondata['guarda'] = $sv;

		if ($sv > 0 && $erMOD == 0){
			try {
				$conn->query("DELETE FROM capitulo_i_displab WHERE C1_nordemp = '".$emp."' AND vigencia = '".$vig."' ;");
			} catch (Exception $e) {
				$erDEL ++;
			}

			try {
				$lineaINS .= rtrim($tem, ",");
				$actcapi = $conn->exec($lineaINS);
			} catch (Exception $e) {
				$erINS ++;
			}
		}else{
			try {
				$conn->query("DELETE FROM capitulo_i_displab WHERE C1_nordemp = '".$emp."' AND vigencia = '".$vig."' ;");
			} catch (Exception $e) {
				$erDEL ++;
			}
			$jsondata['msDisp'] = 'No hay disponibilidades para guardar';
		}
	}

	if ( ($erAud + $erMOD + $erINS + $erDEL) == 0 ){
		$conn->commit();
		$jsondata['success'] = true;
	} else {
		$conn->rollBack();
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