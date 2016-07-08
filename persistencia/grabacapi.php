<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$vig = $_SESSION['vigencia'];
	$tipousu = $_SESSION['tipou'];
	$region = $_SESSION['region'];
	$anterior = $vig-1;
	$nombres = Array(); $Valores = Array();
	$c1n1 = array('i1r1c1', 'i1r1c2', 'i1r1c3', 'i1r1c4', 'i1r3c1', 'i1r3c2', 'i1r3c3', 'i1r3c4', 'i1r3c5', 'i1r3c6', 'i1r3c7', 'i1r3c8', 'i1r3c9', 'i1r4c1', 'observaciones');
	
	$i = 0;
	$lineaMOD = ""; $lineaEXE = ""; $modo = "MODI";
	
	foreach($_POST As $nombre => $valor) {
		$nombres[$i] = $nombre;
		$valores[$i] = $valor;
		$i++;
	}
	
	$capitulo = substr($nombres[0],0,2);
	switch ($capitulo) {
		case 'C1':
			$tabla = "capitulo_i";
			$modulo = "m1";
			break;
// 		case 'C2':
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
// 			break;
	}
	
//	print_r($_POST);
/*
	$Nombrevar = $Prueba[1];
	if (!isset($_POST[$Prueba[1]])) {
		echo $Prueba[1] . " NO DEFINIDO";
	}
	echo "VALOR " . $Nombrevar . " = " . $_POST[$Prueba[1]];
*/	
	
	$numero = $valores[0];
	$qCapitulo = $conn->prepare("SELECT * FROM $tabla WHERE $nombres[0]= :idNumero AND vigencia = :periodo");
//	print_r($qCapitulo);
	$qCapitulo->execute(array(':idNumero'=>$numero, ':periodo'=>$vig));
	$row = $qCapitulo->fetch(PDO::FETCH_BOTH);
	
	for($i=1; $i<count($nombres); $i++) {
		//$nomvar = strtoupper($nombres[$i]);		// OJO VERIFICAR COINCIDENCIA DE LOS ARREGLOS
		$nomvar = $nombres[$i];		// OJO VERIFICAR COINCIDENCIA DE LOS ARREGLOS
//		echo $nombres[$i] . " - " . $nomvar . " - " . $valores[$i] . " - " . $row[$nomvar] . "\n";
		//if ($valores[$i] != $row[$nomvar]) {
		if ($valores[$i] != $row[$nombres[$i]]) {
			if (substr($nombres[$i], 0,4) != 'i1r2' ){ // retirar condicion para agregar caracterizaciones 
				$creaLog = $conn->prepare('INSERT INTO auditoria (numemp, tipo_usuario, usuario, fec_mod, hora_mod, nom_var, valor_anterior, valor_actual,
					tabla) VALUES (:numero, :tipo, :usuario, :fecha, :hora, :variable, :anterior, :actual, :tabla)');
				$creaLog->execute(array(':numero'=>$numero,
					':tipo'=>$_SESSION['tipou'],
					':usuario'=>$_SESSION['idusu'],
					':fecha'=>date("Y-m-d"),
					':hora'=>date("h:i:sa"),
					':variable'=>$nombres[$i],
					':anterior'=>$row[$nomvar],
					':actual'=>$valores[$i],
					':tabla'=>$tabla));
			}
		}
	}
	
	$lineaMOD = 'UPDATE ' . $tabla . ' SET ';
	for ($i=1; $i<count($nombres); $i++) {
		if (in_array($nombres[$i], $c1n1)){
			$lineaMOD .= $nombres[$i] . '= \'' . $valores[$i] . '\', ';
		}
	}
	
	if ($capitulo == 'C1') {
		$maxit = count($c1n1);
		for ($i=0; $i<$maxit; $i++) {
			if (!isset($_POST[$c1n1[$i]])) {
				$lineaMOD .= $c1n1[$i] . "=NULL, ";
			}
		}
		
// 		$maxit = count($c1n2);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c1n2[$i]])) {
// 				$lineaMOD .= $c1n2[$i] . "='', ";
// 			}
// 		}
		
// 		$maxit = count($c1n4);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c1n4[$i]])) {
// 				$lineaMOD .= $c1n4[$i] . "=NULL, ";
// 			}
// 		}
		
// 		$maxit = count($c1n567);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c1n567[$i]])) {
// 				$lineaMOD .= $c1n567[$i] . "='', ";
// 			}
// 		}
		
// 		$maxit = count($c1n10);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c1n10[$i]])) {
// 				$lineaMOD .= $c1n10[$i] . "='', ";
// 			}
// 		}
	}
	
// 	if ($capitulo == 'C2') {
// 		if (!isset($_POST['ii2r1c1'])) {
// 			$lineaMOD .= "ii2r1c1='', ";
// 		}
// 		$maxit = count($c2n3);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c2n3[$i]])) {
// 				$lineaMOD .= $c2n3[$i] . "=NULL, ";
// 			}
// 		}
// 	}

// 	if ($capitulo == 'C3') {
// 		$maxit = count($c3n2);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c3n2[$i]])) {
// 				$lineaMOD .= $c3n2[$i] . "=NULL, ";
// 			}
// 		}
// 		$maxit = count($c3n3n4);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c3n3n4[$i]])) {
// 				$lineaMOD .= $c3n3n4[$i] . "='', ";
// 			}
// 		}
// 		$maxit = count($c3n6);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c3n6[$i]])) {
// 				$lineaMOD .= $c3n6[$i] . "='', ";
// 			}
// 		}
// 	}
	
// 	if ($capitulo == 'C4') {
// 		$maxit = count($c4n1c1);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c4n1c1[$i]])) {
// 				$lineaMOD .= $c4n1c1[$i] . "=NULL, ";
// 			}
// 		}
// 		$maxit = count($c4n1c2);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c4n1c2[$i]])) {
// 				$lineaMOD .= $c4n1c2[$i] . "=NULL, ";
// 			}
// 		}
// 		$maxit = count($c4n1c3);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c4n1c3[$i]])) {
// 				$lineaMOD .= $c4n1c3[$i] . "=NULL, ";
// 			}
// 		}
// 		$maxit = count($c4n1c4);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c4n1c4[$i]])) {
// 				$lineaMOD .= $c4n1c4[$i] . "=NULL, ";
// 			}
// 		}
// 		$maxit = count($c4n2c1);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c4n2c1[$i]])) {
// 				$lineaMOD .= $c4n2c1[$i] . "=NULL, ";
// 			}
// 		}
// 		$maxit = count($c4n2c2);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c4n2c2[$i]])) {
// 				$lineaMOD .= $c4n2c2[$i] . "=NULL, ";
// 			}
// 		}
// 		$maxit = count($c4n4);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c4n4[$i]])) {
// 				$lineaMOD .= $c4n4[$i] . "=NULL, ";
// 			}
// 		}
// 		$maxit = count($c4n5);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c4n5[$i]])) {
// 				$lineaMOD .= $c4n5[$i] . "=NULL, ";
// 			}
// 		}
// 		$maxit = count($c4n6);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c4n6[$i]])) {
// 				$lineaMOD .= $c4n6[$i] . "=NULL, ";
// 			}
// 		}
// 		$maxit = count($c4n7);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c4n7[$i]])) {
// 				$lineaMOD .= $c4n7[$i] . "=NULL, ";
// 			}
// 		}
// 	}
	
// 	if ($capitulo == 'C5') {
// 		$maxit = count($c5n1c1);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n1c1[$i]])) {
// 				$lineaMOD .= $c5n1c1[$i] . "='', ";
// 			}
// 		}
		
// 		$maxit = count($c5n1c2);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n1c2[$i]])) {
// 				$lineaMOD .= $c5n1c2[$i] . "='', ";
// 			}
// 		}
		
// 		$maxit = count($c5n1c3);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n1c3[$i]])) {
// 				$lineaMOD .= $c5n1c3[$i] . "='', ";
// 			}
// 		}
		
// 		$maxit = count($c5n2);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n2[$i]])) {
// 				$lineaMOD .= $c5n2[$i] . "='', ";
// 			}
// 		}
		
// 		$maxit = count($c5n3r1);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n3r1[$i]])) {
// 				$lineaMOD .= $c5n3r1[$i] . "='', ";
// 			}
// 		}
// 		$maxit = count($c5n3r2);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n3r2[$i]])) {
// 				$lineaMOD .= $c5n3r2[$i] . "='', ";
// 			}
// 		}
// 		$maxit = count($c5n3r3);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n3r3[$i]])) {
// 				$lineaMOD .= $c5n3r3[$i] . "='', ";
// 			}
// 		}
// 		$maxit = count($c5n3r4);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n3r4[$i]])) {
// 				$lineaMOD .= $c5n3r4[$i] . "='', ";
// 			}
// 		}
// 		$maxit = count($c5n3r5);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n3r5[$i]])) {
// 				$lineaMOD .= $c5n3r5[$i] . "='', ";
// 			}
// 		}
// 		$maxit = count($c5n3r6);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n3r6[$i]])) {
// 				$lineaMOD .= $c5n3r6[$i] . "='', ";
// 			}
// 		}
// 		$maxit = count($c5n3r7);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n3r7[$i]])) {
// 				$lineaMOD .= $c5n3r7[$i] . "='', ";
// 			}
// 		}
// 		$maxit = count($c5n3r8);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n3r8[$i]])) {
// 				$lineaMOD .= $c5n3r8[$i] . "='', ";
// 			}
// 		}
// 		$maxit = count($c5n3r9);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n3r9[$i]])) {
// 				$lineaMOD .= $c5n3r9[$i] . "='', ";
// 			}
// 		}
// 		$maxit = count($c5n3r10);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n3r10[$i]])) {
// 				$lineaMOD .= $c5n3r10[$i] . "='', ";
// 			}
// 		}
// 		$maxit = count($c5n3r11);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c5n3r11[$i]])) {
// 				$lineaMOD .= $c5n3r11[$i] . "='', ";
// 			}
// 		}
// 	}
// 	if ($capitulo == 'C6') {
// 		$maxit = count($c6a1);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c6a1[$i]])) {
// 				$lineaMOD .= $c6a1[$i] . "=NULL, ";
// 			}
// 		}
// 		$maxit = count($c6a2);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c6a2[$i]])) {
// 				$lineaMOD .= $c6a2[$i] . "=NULL, ";
// 			}
// 		}
// 		$maxit = count($c6a3);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c6a3[$i]])) {
// 				$lineaMOD .= $c6a3[$i] . "=NULL, ";
// 			}
// 		}
// 	}
// 	if ($capitulo == 'C7') {
// 		$maxit = count($c7r6);
// 		for ($i=0; $i<$maxit; $i++) {
// 			if (!isset($_POST[$c7r6[$i]])) {
// 				$lineaMOD .= $c7r6[$i] . "=NULL, ";
// 			}
// 		}
// 	}
	$lineaMOD = rtrim($lineaMOD, ", ");
	
	$lineaMOD .= ' WHERE ' . $nombres[0] . ' = ' . $valores[0];
//	print_r($lineaMOD)."<br>";
	$actucapi = $conn->exec($lineaMOD);
	
	
	if ($modulo == 'm1'){
		$dt = $_POST;
		$lineaINS = 'INSERT INTO capitulo_i_displab (C1_nordemp, vigencia, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14) values ';
		
		if (isset($dt['C1_numdisp'])){
			$pnl = $valores[1];
		}else{
			$pnl = 0;
		}
			
		$tem = '';
		for ($i=1; $i<= $pnl; $i++){
			$tem .= "('" . $numero . "','" . $vig . "',";
			for ($j=0; $j<14; $j++){
				$nc = 'i1r2c' . $i . $j;
				$c1n2[] = $nc;
				//echo $nc . ' - ';
				if (isset($dt[$nc]) && $dt[$nc] != ''){
					$tem .= "'" . $dt[$nc] . "',";
				}else{
					$tem .= "NULL,";
				}
			}
			$tem = rtrim($tem, ",") .  '),';
		}
		
		$lineaINS .= rtrim($tem, ",");
		
		$conn->query("delete from capitulo_i_displab where C1_nordemp = '".$numero."' and vigencia = '".$vig."' ;");
		
		$actcapi = $conn->exec($lineaINS);
	}
	
	
//	print_r($lineaMOD);
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
// REVERSAR ESTADO DE CAPITULOS I, II, V SI SE MODIFICA EL CAPITULO I.

// 	if ($capitulo == "C1" AND ($tipousu == "FU" OR $tipousu == "CR") AND $region != 99) {
// 		$qControl = $conn->query("UPDATE control SET m2=1, m3=1, m5=1 WHERE nordemp = $valores[0] AND vigencia = $vig");
// 	}
?>
