<?php
if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){ //validamos que la peticion sea ajax
	$jsondata = array();
	
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$nombres = Array(); $Valores = Array();
	$textos = array("tipodoc","numdoc","dv","ciiu3","registmat", "camara", "numero", "depto", "mpio", "depnotific", "munnotific", 
					"capsocinpu", "capsocinpr", "capsociepu", "capsociepr", "estagrop", "estminero", "estind", "estservpub",
					"estconst", "estcom", "estreshot", "esttrans", "estcomunic", "estfinanc", "estservcom", "uniaux", "teler",
					"otro","faxr","fechadili","carresponde",

					"numeroreg","nompropie","nombre","sigla","direccion","telefono","fax","orgju","orgjucual","dirnotifi",
					"telenotific","faxnotific","repleg","responde","estadoact","otro","emailemp","web",
					"emailnotif","webnotif","emailres","lgg","fechaconst","fechahasta","fechadist");
	$i = 0;
	$lineaMOD = ""; $lineaEXE = "";
	foreach($_POST As $nombre => $valor) {
		$nombres[$i] = $nombre;
		$valores[$i] = $valor;
		$i++;
	}
	
	/** Consulta para validar los codigos de la CIIU */
	$qCiiu = $conn->query("select CODIGO from ciiu3 ");
	foreach ($qCiiu as $ciiu){
		$codigos[] = $ciiu['CODIGO'];
	}
	/***/
	
	$numero = $valores[0];
	$qCaratula = $conn->prepare("SELECT * FROM caratula WHERE nordemp= :idNumero");
	$qCaratula->execute(array('idNumero'=>$numero));
	$row = $qCaratula->fetch(PDO::FETCH_BOTH);
	
	//print_r($nombres);

// 	for($i=1; $i<=count($nombres); $i++) {
// 		$nomvar = $nombres[$i];
// 		if ( isset($nomvar) ){
// 		if ($valores[$i] != $row[$nomvar]) {
// 			$creaLog = $conn->prepare('INSERT INTO auditoria (numemp, tipo_usuario, usuario, fec_mod, hora_mod, nom_var, valor_anterior, valor_actual,
// 				tabla) VALUES (:numero, :tipo, :usuario, :fecha, :hora, :variable, :anterior, :actual, :tabla)');
			
// 			$creaLog->execute(array(':numero'=>$numero,
// 				':tipo'=>$_SESSION['tipou'],
// 				':usuario'=>$_SESSION['idusu'],
// 				':fecha'=>date("Y-m-d"),
// 				'hora'=>date("h:i:sa"),
// 				':variable'=>$nombres[$i],
// 				':anterior'=>$row[$nomvar],
// 				':actual'=>$valores[$i],
// 				':tabla'=>"caratula"));
// 		}
// 		$jsondata['auditoria'][] = $creaLog;
// 		}
// 	}
	
	$lineaMOD = 'UPDATE caratula SET ';
	$actemp = 'INSERT INTO actiemp (nordemp, actividad) VALUES ';
	
	for ($i=1; $i<count($nombres); $i++) {
		if (in_array($nombres[$i], $textos)) {
			$lineaMOD .= $nombres[$i] . '= "' . $valores[$i] . '", ';
		}elseif (in_array($nombres[$i], $codigos)) { /** Validacion de codigos de actividad */
			$actemp .= "('" . $numero . "', '" . $nombres[$i] . "'),";
		}
	}
	
	if (!in_array('otro', $nombres)){
		$lineaMOD .= 'otro = "' . NULL . '", ';
	}
	
	$lineaMOD = rtrim($lineaMOD, ", ");
	$lineaMOD .= ' WHERE nordemp = ' . $valores[0];
//	print_r($lineaMOD);
	$actucara = $conn->exec($lineaMOD);
	$jsondata['caratula'] = $actucara;
	$jsondata['caratula_sql'] = $lineaMOD;
	
	$conn->query("delete from actiemp where nordemp = ".$numero."");
	$activi = $conn->exec(rtrim($actemp,', '));
	$jsondata['actividades'] = $activi;
	$jsondata['actividades_sql'] = $actemp;
	$jsondata['success'] = true;

	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	//exit();
	
// 	$insActivi = 'INSERT INTO actiemp (nordemp, actividad) values ';
	
// 	foreach ($nombres as $clave){
		
// 	}
	
			
/*	
	for ($i=1; $i<count($nombres); $i++) {
		if (in_array($nombres[$i], $textos)) {
			$lineaEXE .= "':" . $nombres[$i] . "' => \"" . $valores[$i] . "\", ";
		}
		else {
			$lineaEXE .= "':" . $nombres[$i] . "' => " . $valores[$i] . ", ";
		}
	}
	$lineaEXE .= "'nombre'=>\"".$valores[8] . "\", ";
	$lineaEXE .= "'sigla'=>\"".$valores[9] . "\", ";
	$lineaEXE .= "'nordemp' =>" . $valores[0];
	print_r($lineaEXE);
	
	$actucara = $conn->prepare($lineaMOD);
	print_r($actucara);
	$actucara->execute(array($lineaEXE));


	$nuevoprop = "Prueba de Modificaci�n";
	$actucara = $conn->prepare('UPDATE caratula SET nompropie=:nompropie WHERE nordemp = :nordemp');
	$actucara->execute(array(':nompropie'=>"OFFSET GRAFICO EDITORES S.A.", ':nordemp'=>$valores[0]));
*/	
	
	//echo "{'success':'Transaccion correcta'}";
}else{
	exit();
}
?>
