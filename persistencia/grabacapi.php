<?php
if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){
	$jsondata = array();
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
	$dtDisp =  json_decode($_POST['dtDisp']);

	switch (substr($mod,0,2)) {
		case 'C1':
			$tabla = "capitulo_i";
			$modulo = "m1";
			break;
	}
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
				// $creaLog->execute(array(':numero'=>$emp, ':tipo'=>$_SESSION['tipou'], ':usuario'=>$_SESSION['idusu'], ':fecha'=>date("Y-m-d"), 	'hora'=>date("h:i:sa"), ':variable'=>$variab, ':anterior'=>$valAnt, ':actual'=>$valAct, ':tabla'=>$tabla));
				/* Creamos el set para la modificacion de los campos */
				$sets .= $variab ." = '" . $valAct . "', ";
			} catch (Exception $e) {
				$erAud ++;
				$jsondata['errors']['auditoria'] = true;
			}
		}
	} /*end FOR */

	if ($sets != '' && $erAud == 0) {
		$lineaMOD .= trim($sets, ', ');
		try {
			$jsondata['qMOD'] = $lineaMOD;
			// $qUpdate = $conn->query($lineaMOD);
		} catch (Exception $e) {
			$erMOD ++;
		}
	}

	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	exit();
} else {
	exit();
}





// if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){
// 	/*validamos que la peticion sea ajax*/
// 	$jsondata = array();
// 	if (session_id() == "") {
// 		session_start();
// 	}
// 	include '../conecta.php';
// 	$vig = $_SESSION['vigencia'];
// 	$tipousu = $_SESSION['tipou'];
// 	$region = $_SESSION['region'];
// 	$anterior = $vig-1;
// 	$nombres = Array(); $Valores = Array();
// 	$c1n1 = array('i1r1c1', 'i1r1c2', 'i1r1c3', 'i1r1c4', 'i1r3c1', 'i1r3c2', 'i1r3c3', 'i1r3c4', 'i1r3c5', 'i1r3c6', 'i1r3c7', 'i1r3c8', 'i1r3c9', 'i1r4c1', 'observaciones');

// 	$i = 0;
// 	$lineaMOD = ""; $lineaEXE = ""; $modo = "MODI";

// 	foreach($_POST As $nombre => $valor) {
// 		$nombres[$i] = $nombre;
// 		$valores[$i] = $valor;
// 		$i++;
// 	}

// 	$capitulo = substr($nombres[0],0,2);
// 	switch ($capitulo) {
// 		case 'C1':
// 			$tabla = "capitulo_i";
// 			$modulo = "m1";
// 			break;
// 		/*case 'C2':
// 			$tabla = "capitulo_ii";
// 			$modulo = "m2";
// 			break;
// 		case 'C3':
// 			$tabla = "capitulo_iii";
// 			$modulo = "m3";
// 			break;
// 		case 'C4':
// 			$tabla = "capitulo_iv";
// 			$modulo = "m4";
// 			break;
// 		case 'C5':
// 			$tabla = "capitulo_v";
// 			$modulo = "m5";
// 			break;
// 		case 'C6':
// 			$tabla = "capitulo_vi";
// 			$modulo = "m6";
// 			break;
// 		case 'C7':
// 			$tabla = "capitulo_vii";
// 			$modulo = "m7";
// 			break;*/
// 	}

// 	/*print_r($_POST);
// 	$Nombrevar = $Prueba[1];
// 	if (!isset($_POST[$Prueba[1]])) {
// 		echo $Prueba[1] . " NO DEFINIDO";
// 	}
// 	echo "VALOR " . $Nombrevar . " = " . $_POST[$Prueba[1]];*/

// 	$numero = $valores[0];
// 	$qCapitulo = $conn->prepare("SELECT * FROM $tabla WHERE $nombres[0]= :idNumero AND vigencia = :periodo");
// 	// print_r($qCapitulo);
// 	$qCapitulo->execute(array(':idNumero'=>$numero, ':periodo'=>$vig));
// 	$row = $qCapitulo->fetch(PDO::FETCH_BOTH);

// 	// for($i=1; $i<count($nombres); $i++) {
// 	// 	//$nomvar = strtoupper($nombres[$i]);		// OJO VERIFICAR COINCIDENCIA DE LOS ARREGLOS
// 	// 	$nomvar = $nombres[$i];		// OJO VERIFICAR COINCIDENCIA DE LOS ARREGLOS
// 	// 	// echo $nombres[$i] . " - " . $nomvar . " - " . $valores[$i] . " - " . $row[$nomvar] . "\n";
// 	// 	//if ($valores[$i] != $row[$nomvar]) {
// 	// 	if ($valores[$i] != $row[$nombres[$i]]) {
// 	// 		if (substr($nombres[$i], 0,4) != 'i1r2' ){ // retirar condicion para agregar caracterizaciones
// 	// 			$creaLog = $conn->prepare('INSERT INTO auditoria (numemp, tipo_usuario, usuario, fec_mod, hora_mod, nom_var, valor_anterior, valor_actual,
// 	// 				tabla) VALUES (:numero, :tipo, :usuario, :fecha, :hora, :variable, :anterior, :actual, :tabla)');
// 	// 			$creaLog->execute(array(':numero'=>$numero,
// 	// 				':tipo'=>$_SESSION['tipou'],
// 	// 				':usuario'=>$_SESSION['idusu'],
// 	// 				':fecha'=>date("Y-m-d"),
// 	// 				':hora'=>date("h:i:sa"),
// 	// 				':variable'=>$nombres[$i],
// 	// 				':anterior'=>$row[$nomvar],
// 	// 				':actual'=>$valores[$i],
// 	// 				':tabla'=>$tabla));
// 	// 		}
// 	// 	}
// 	// }

// 	$lineaMOD = 'UPDATE ' . $tabla . ' SET ';
// 	for ($i=1; $i<count($nombres); $i++) {
// 		if (in_array($nombres[$i], $c1n1)){
// 			$lineaMOD .= $nombres[$i] . '= \'' . $valores[$i] . '\', ';
// 		}
// 	}

// 	if ($capitulo == 'C1') {
// 		$maxit = count($c1n1);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c1n1[$i]])) {
// 				$lineaMOD .= $c1n1[$i] . "=NULL, ";
// 			}
// 		}
// 	}

// 	$lineaMOD = rtrim($lineaMOD, ", ");

// 	$lineaMOD .= ' WHERE ' . $nombres[0] . ' = ' . $valores[0] . ' AND vigencia = \''. $vig . '\';';

// 	$actucapi = $conn->exec($lineaMOD);

// 	if ($modulo == 'm1'){
// 		$dt = $_POST;
// 		$lineaINS = 'INSERT INTO capitulo_i_displab (C1_nordemp, vigencia, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14) values ';

// 		if (isset($dt['C1_numdisp'])){
// 			$pnl = $valores[1];
// 			$sv = $valores[1];
// 			$tvab = 0;
// 			$tvcb = 0;
// 			$tvnc = 0;
// 		}else{
// 			$pnl = 0;
// 		}

// 		$tem = '';
// 		for ($i=1; $i<= $pnl; $i++){
// 			//$tem .= "('" . $numero . "','" . $vig . "',";
// 			$tem1 = "('" . $numero . "','" . $vig . "',";
// 			$nct = 'i1r2c' . $i;
// 			for ($j=0; $j<14; $j++){
// 				$nc = 'i1r2c' . $i . $j;
// 				$c1n2[] = $nc;
// 				if (isset($dt[$nc]) && $dt[$nc] != ''){
// 					$tem1 .= "'" . $dt[$nc] . "',";
// 				}else{
// 					$tem1 .= "NULL,";
// 					if ($j < 12){
// 						$sv--;
// 						$j = 14;
// 						$tem1 = '';
// 					}
// 				}
// 			}

// 			if ($tem1 != ''){
// 				$tvab += $dt[ $nct .'0'];
// 				$tvcb += $dt[ $nct .'8'];
// 				$tvnc += $dt[ $nct .'11'];
// 				$tem .= rtrim($tem1, ",") .  '),';
// 			}
// 		}

// 		$lineaINS .= rtrim($tem, ",");
// 		$conn->query("delete from capitulo_i_displab where C1_nordemp = '".$numero."' and vigencia = '".$vig."' ;");
// 		if ($pnl > 0 && $sv > 0){
// 			//echo 'si grabamos disponibilidades laborales';
// 			//$conn->query("delete from capitulo_i_displab where C1_nordemp = '".$numero."' and vigencia = '".$vig."' ;");
// 			$actcapi = $conn->exec($lineaINS);
// 		}
// 	}
// 	$jsondata['cap_i_act'] = $lineaINS;
// 	$jsondata['success'] = true;
// 	header('Content-type: application/json; charset=utf-8');
// 	echo json_encode($jsondata);
// }else{
// 	exit();
// }
// ?>
