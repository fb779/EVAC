<?php
if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){ //validamos que la peticion sea ajax
	$jsondata = array();

	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';

	// $textos = array("tipodoc","numdoc","dv","ciiu3","registmat", "camara", "numero", "depto", "mpio", "depnotific", "munnotific", "capsocinpu", "capsocinpr", "capsociepu", "capsociepr", "estagrop", "estminero", "estind", "estservpub", "estconst", "estcom", "estreshot", "esttrans", "estcomunic", "estfinanc", "estservcom", "uniaux", "teler", "otro","faxr","fechadili","carresponde", "numeroreg","nompropie","nombre","sigla","direccion","telefono","fax","orgju","orgjucual","dirnotifi", "telenotific","faxnotific","repleg","responde","estadoact","otro","emailemp","web", "emailnotif","webnotif","emailres","lgg","fechaconst","fechahasta","fechadist");

	$emp = $_POST['emp'];
	$dtForm = json_decode($_POST['dtForm']);

	$qEmpresa = $conn->query("SELECT * FROM caratula WHERE nordemp = " . $emp)->fetch(PDO::FETCH_BOTH) ;

	$lineaMOD = 'UPDATE caratula SET ';
	$sets = '';

	foreach ($dtForm as $dt) {
		if (array_key_exists($dt->name, $qEmpresa) && $dt->value != $qEmpresa[$dt->name]  ){
			$variab = $dt->name;
			$valAnt = $qEmpresa[$dt->name];
			$valAct = $dt->value;

			/* Crear la auditoria de los campos que cambiaron de la caratula */
			$creaLog = $conn->prepare('INSERT INTO auditoria (numemp, tipo_usuario, usuario, fec_mod, hora_mod, nom_var, valor_anterior, valor_actual, tabla) VALUES (:numero, :tipo, :usuario, :fecha, :hora, :variable, :anterior, :actual, :tabla)');

			$creaLog->execute(array(':numero'=>$emp, ':tipo'=>$_SESSION['tipou'], ':usuario'=>$_SESSION['idusu'], ':fecha'=>date("Y-m-d"), 	'hora'=>date("h:i:sa"), ':variable'=>$variab, ':anterior'=>$valAnt, ':actual'=>$valAct, ':tabla'=>"caratula"));

			/* Creamos el set para la modificacion de los campos */
			$sets .= $variab ." = '" . $valAct . "',";
		}
	} /*end FOR */

	if ($sets != '') {
		$lineaMOD .= trim($sets, ',');
		try {
			$qUpdate = $conn->query($lineaMOD);
			$jsondata['updateCara'] = $lineaMOD;
			$jsondata['success'] = true;
		} catch (Exception $e) {
			$jsondata['success'] = false;
		}
	}else{ $jsondata['success'] = false; }

	/* PENDIENTE TERMINAR GUARDADO DE DATOS DE ACTIVIDADES ciiu PARA CARATULA */

	// $qActiEmpre = $conn->query('SELECT * FROM actiemp WHERE nordemp = ' . $emp)->fetch(PDO::FETCH_ASSOC);
	$qActiEmpre = $conn->query('SELECT actividad FROM actiemp WHERE nordemp = ' . $emp);
	if (isset($_POST['dtActi']) && $_POST['dtActi']!='' ) {
		$dtActi = json_decode($_POST['dtActi']);
		// print_r($dtActi);
	}
	$qAct = array();
	foreach ($qActiEmpre as $actiEmpre) {
		// echo $actiEmpre['actividad'];
		$qAct[] = $actiEmpre['actividad'];
	}
	print_r( key($qAct));
	$lineaINS = 'INSERT INTO actiemp (nordemp, actividad) VALUES ';
	$inse = '';
	// foreach ($qActiEmpre as $dt) {
	// 	echo json_encode($dt['actividad']);
	// 	if (array_key_exists($dt['actividad'], $dtActi)){
	// 		echo "Estamos en la lista de la consulta";
	// 		$inse .= "('" . $emp . "', '" . $dt->value . "'),";
	// 	}
	// }

	if ($inse != ''){
		$lineaINS .= trim($inse);
	}

	// foreach ($dtActi as $dt) {
	// 	$inse .= "('" . $emp . "', '" . $dt->value . "'),";
	// }

	$jsondata['qInsert'] = $lineaINS;





	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	exit();
} else {
	exit();
}


// if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){ //validamos que la peticion sea ajax
// 	$jsondata = array();

// 	if (session_id() == "") {
// 		session_start();
// 	}
// 	include '../conecta.php';
// 	$nombres = Array(); $valores = Array();
// 	$textos = array("tipodoc","numdoc","dv","ciiu3","registmat", "camara", "numero", "depto", "mpio", "depnotific", "munnotific",
// 					"capsocinpu", "capsocinpr", "capsociepu", "capsociepr", "estagrop", "estminero", "estind", "estservpub",
// 					"estconst", "estcom", "estreshot", "esttrans", "estcomunic", "estfinanc", "estservcom", "uniaux", "teler",
// 					"otro","faxr","fechadili","carresponde",
// 					"numeroreg","nompropie","nombre","sigla","direccion","telefono","fax","orgju","orgjucual","dirnotifi",
// 					"telenotific","faxnotific","repleg","responde","estadoact","otro","emailemp","web",
// 					"emailnotif","webnotif","emailres","lgg","fechaconst","fechahasta","fechadist");
// 	$i = 0;
// 	$lineaMOD = ""; $lineaEXE = "";
// 	foreach($_POST As $nombre => $valor) {
// 		$nombres[$i] = $nombre;
// 		$valores[$i] = $valor;
// 		$i++;
// 	}

// 	/** Consulta para validar los codigos de la CIIU */
// 	$qCiiu = $conn->query("select CODIGO from ciiu3 ");
// 	foreach ($qCiiu as $ciiu){
// 		$codigos[] = $ciiu['CODIGO'];
// 	}
// 	/***/

// 	$numero = $valores[0];
// 	$qCaratula = $conn->prepare("SELECT * FROM caratula WHERE nordemp= :idNumero");
// 	$qCaratula->execute(array('idNumero'=>$numero));
// 	$row = $qCaratula->fetch(PDO::FETCH_BOTH);

// 	//print_r($nombres);

// 	for($i=1; $i<=count($nombres); $i++) {
// 		$nomvar = $nombres[$i];
// 		if ( isset($nomvar) ){
// 			if ($valores[$i] != $row[$nomvar]) {
// 				$creaLog = $conn->prepare('INSERT INTO auditoria (numemp, tipo_usuario, usuario, fec_mod, hora_mod, nom_var, valor_anterior, valor_actual,
// 					tabla) VALUES (:numero, :tipo, :usuario, :fecha, :hora, :variable, :anterior, :actual, :tabla)');

// 				$creaLog->execute(array(':numero'=>$numero,
// 					':tipo'=>$_SESSION['tipou'],
// 					':usuario'=>$_SESSION['idusu'],
// 					':fecha'=>date("Y-m-d"),
// 					'hora'=>date("h:i:sa"),
// 					':variable'=>$nombres[$i],
// 					':anterior'=>$row[$nomvar],
// 					':actual'=>$valores[$i],
// 					':tabla'=>"caratula"));
// 			}
// 			$jsondata['auditoria'][] = $creaLog;
// 		}
// 	}

// 	$lineaMOD = 'UPDATE caratula SET ';
// 	$actemp = 'INSERT INTO actiemp (nordemp, actividad) VALUES ';
// 	$conAct=FALSE;
// 	for ($i=1; $i<count($nombres); $i++) {
// 		if (in_array($nombres[$i], $textos)) {
// 			$lineaMOD .= $nombres[$i] . '= "' . $valores[$i] . '", ';
// 		}elseif (in_array($nombres[$i], $codigos)) { /** Validacion de codigos de actividad */
// 			$conAct = TRUE;
// 			$actemp .= "('" . $numero . "', '" . $nombres[$i] . "'),";
// 		}
// 	}

// 	if (!in_array('otro', $nombres)){
// 		$lineaMOD .= 'otro = "' . NULL . '", ';
// 	}

// 	$lineaMOD = rtrim($lineaMOD, ", ");
// 	$lineaMOD .= ' WHERE nordemp = ' . $valores[0];
// //	print_r($lineaMOD);
// 	$actucara = $conn->exec($lineaMOD);
// 	$jsondata['caratula'] = $actucara;
// 	$jsondata['caratula_sql'] = $lineaMOD;

// 	$conn->query("delete from actiemp where nordemp = ".$numero."");
// 	if ($conAct){
// 		$activi = $conn->exec(rtrim($actemp,', '));
// 		$jsondata['actividades'] = $activi;
// 	}


// 	$jsondata['actividades_sql'] = $actemp;
// 	$jsondata['success'] = true;

// 	header('Content-type: application/json; charset=utf-8');
// 	echo json_encode($jsondata);
// 	//exit();

// // 	$insActivi = 'INSERT INTO actiemp (nordemp, actividad) values ';

// // 	foreach ($nombres as $clave){

// // 	}


// /*
// 	for ($i=1; $i<count($nombres); $i++) {
// 		if (in_array($nombres[$i], $textos)) {
// 			$lineaEXE .= "':" . $nombres[$i] . "' => \"" . $valores[$i] . "\", ";
// 		}
// 		else {
// 			$lineaEXE .= "':" . $nombres[$i] . "' => " . $valores[$i] . ", ";
// 		}
// 	}
// 	$lineaEXE .= "'nombre'=>\"".$valores[8] . "\", ";
// 	$lineaEXE .= "'sigla'=>\"".$valores[9] . "\", ";
// 	$lineaEXE .= "'nordemp' =>" . $valores[0];
// 	print_r($lineaEXE);

// 	$actucara = $conn->prepare($lineaMOD);
// 	print_r($actucara);
// 	$actucara->execute(array($lineaEXE));


// 	$nuevoprop = "Prueba de Modificaci�n";
// 	$actucara = $conn->prepare('UPDATE caratula SET nompropie=:nompropie WHERE nordemp = :nordemp');
// 	$actucara->execute(array(':nompropie'=>"OFFSET GRAFICO EDITORES S.A.", ':nordemp'=>$valores[0]));
// */

// 	//echo "{'success':'Transaccion correcta'}";
// }else{
// 	exit();
// }
// ?>
