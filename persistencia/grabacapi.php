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
	$cin1 = array('i1r1c1', 'i1r1c2', 'i1r3c1', 'i1r3c2', 'i1r3c3', 'i1r3c4', 'i1r3c5', 'i1r3c6', 'i1r3c7', 'i1r3c8', 'i1r3c9', 'i1r4c1');
	//$c1n1 = Array("i1r1c2n","i1r2c2n","i1r3c2n","i1r4c2n","i1r1c2m","i1r2c2m","i1r3c2m","i1r4c2m","i1r4c2","i1r5c2","i1r6c2");
	$c1n2 = Array("i2r1c1","i2r2c1","i2r3c1","i2r4c1","i2r5c1","i2r6c1","i2r7c1","i2r8c1","i2r9c1","i2r10c1","i2r11c1","i2r12c1","i2r13c1","i2r14c1","i2r15c1");
	$c1n4 = Array("i4r1c1","i4r2c1","i4r3c1","i4r4c1","i4r5c1","i4r1c2","i4r2c2","i4r3c2","i4r4c2","i4r5c2");
	$c1n567 = Array("i5r1c1","i6r1c1","i7r1c1","i8r1c1","i8r2c1","i9r1c1","i9r2c1");
	$c1n10 = Array("i10r1c1","i10r2c1","i10r3c1","i10r4c1","i10r5c1","i10r6c1","i10r7c1","i10r8c1","i10r9c1","i10r10c1","i10r11c1","i10r12c1","i10r13c1","i10r14c1");
	$c2n3 = Array("ii3r1c1","ii3r1c2");
// 	$c3n2 = Array("iii2r1c1","iii2r2c1","iii2r3c1","iii2r4c1","iii2r5c1","iii2r6c1","iii2r7c1","iii2r8c1","iii2r9c1","iii2r10c1","iii2r1c2","iii2r2c2","iii2r3c2","iii2r4c2","iii2r5c2","iii2r6c2","iii2r7c2","iii2r8c2","iii2r9c2","iii2r10c2");
// 	$c3n3n4 = Array("iii3r1c1","iii4r1c1","iii4r2c1","iii4r3c1","iii4r4c1","iii4r5c1","iii4r6c1","iii5r1c1");
// 	$c3n6 = Array("iii6r1c1","iii6r2c1","iii6r3c1","iii6r4c1","iii6r5c1","iii6r6c1","iii6r7c1","iii6r8c1","iii6r1c2","iii6r2c2","iii6r3c2","iii6r4c2","iii6r5c2","iii6r6c2","iii6r7c2","iii6r8c2");
// 	$c4n1c1 = Array("iv1r1c1","iv1r2c1","iv1r3c1","iv1r4c1","iv1r5c1","iv1r6c1","iv1r7c1","iv1r8c1","iv1r9c1","iv1r10c1","iv1r11c1");
// 	$c4n1c2 = Array("iv1r1c2","iv1r2c2","iv1r3c2","iv1r4c2","iv1r5c2","iv1r6c2","iv1r7c2","iv1r8c2","iv1r9c2","iv1r10c2","iv1r11c2");
// 	$c4n1c3 = Array("iv1r1c3","iv1r2c3","iv1r3c3","iv1r4c3","iv1r5c3","iv1r6c3","iv1r7c3","iv1r8c3","iv1r9c3","iv1r10c3","iv1r11c3");
// 	$c4n1c4 = Array("iv1r1c4","iv1r2c4","iv1r3c4","iv1r4c4","iv1r5c4","iv1r6c4","iv1r7c4","iv1r8c4","iv1r9c4","iv1r10c4","iv1r11c4");
// 	$c4n2c1 = Array("iv2r1c1","iv2r2c1","iv2r3c1","iv2r4c1","iv2r5c1","iv2r6c1","iv2r7c1","iv2r8c1","iv2r9c1","iv2r10c1","iv2r11c1","iv2r12c1","iv2r13c1","iv2r14c1","iv2r15c1","iv2r16c1","iv2r17c1","iv2r18c1","iv2r19c1","iv2r20c1","iv2r21c1","iv2r22c1","iv2r23c1","iv2r24c1","iv2r25c1","iv2r26c1","iv2r27c1","iv2r28c1","iv2r29c1","iv2r30c1","iv2r31c1","iv2r32c1","iv2r33c1","iv2r34c1");
// 	$c4n2c2 = Array("iv2r1c2","iv2r2c2","iv2r3c2","iv2r4c2","iv2r5c2","iv2r6c2","iv2r7c2","iv2r8c2","iv2r9c2","iv2r10c2","iv2r11c2","iv2r12c2","iv2r13c2","iv2r14c2","iv2r15c2","iv2r16c2","iv2r17c2","iv2r18c2","iv2r19c2","iv2r20c2","iv2r21c2","iv2r22c2","iv2r23c2","iv2r24c2","iv2r25c2","iv2r26c2","iv2r27c2","iv2r28c2","iv2r29c2","iv2r30c2","iv2r31c2","iv2r32c2","iv2r33c2","iv2r34c2");
// 	$c4n4 = Array("iv4r1c1","iv4r2c1","iv4r3c1","iv4r4c1","iv4r5c1","iv4r6c1","iv4r7c1","iv4r8c1","iv4r9c1","iv4r10c1","iv4r11c1","iv4r1c2","iv4r2c2","iv4r3c2","iv4r4c2","iv4r5c2","iv4r6c2","iv4r7c2","iv4r8c2","iv4r9c2","iv4r10c2","iv4r11c2","iv4r1c3","iv4r2c3","iv4r3c3","iv4r4c3","iv4r5c3","iv4r6c3","iv4r7c3","iv4r8c3","iv4r9c3","iv4r10c3","iv4r11c3");
// 	$c4n6 = Array("iv6r1c1","iv6r2c1","iv6r3c1","iv6r4c1","iv6r5c1","iv6r6c1","iv6r7c1","iv6r8c1","iv6r1c2","iv6r2c2","iv6r3c2","iv6r4c2","iv6r5c2","iv6r6c2","iv6r7c2","iv6r8c2","iv6r1c3","iv6r2c3","iv6r3c3","iv6r4c3","iv6r5c3","iv6r6c3","iv6r7c3","iv6r8c3");
// 	$c4n5 = Array("iv5r1c2","iv5r1c3");
// 	$c4n7 = Array("iv7r1c1","iv7r2c1","iv7r3c1","iv7r4c1","iv7r5c1","iv7r1c2","iv7r2c2","iv7r3c2","iv7r4c2","iv7r5c2");
// 	$c5n1c1 = Array("v1r1c1","v1r2c1","v1r3c1","v1r4c1","v1r5c1","v1r6c1","v1r7c1","v1r8c1","v1r9c1","v1r10c1","v1r11c1","v1r12c1","v1r13c1","v1r14c1","v1r15c1","v1r16c1","v1r17c1","v1r18c1","v1r19c1","v1r20c1","v1r21c1","v1r22c1","v1r23c1","v1r24c1","v1r25c1","v1r26c1","v1r27c1","v1r28c1","v1r29c1","v1r30c1","v1r31c1","v1r32c1");
// 	$c5n1c2 = Array("v1r9c2","v1r10c2","v1r11c2","v1r12c2","v1r13c2","v1r14c2","v1r15c2","v1r16c2","v1r17c2","v1r18c2","v1r19c2","v1r20c2","v1r21c2","v1r22c2","v1r23c2","v1r24c2","v1r25c2","v1r26c2","v1r27c2","v1r28c2","v1r29c2","v1r30c2","v1r31c2","v1r32c2");
// 	$c5n1c3 = Array("v1r9c3","v1r10c3","v1r11c3","v1r12c3","v1r13c3","v1r14c3","v1r15c3","v1r16c3","v1r17c3","v1r18c3","v1r19c3","v1r20c3","v1r21c3","v1r22c3","v1r23c3","v1r24c3","v1r25c3","v1r26c3","v1r27c3","v1r28c3","v1r29c3","v1r30c3","v1r31c3","v1r32c3");
// 	$c5n2 = Array("v2r1c1","v2r2c1","v2r3c1","v2r4c1","v2r5c1","v2r6c1","v2r7c1","v2r8c1","v2r9c1","v2r10c1","v2r11c1","v2r12c1","v2r13c1","v2r14c1","v2r15c1","v2r16c1","v2r17c1","v2r18c1","v2r19c1");
// 	$c5n3r1 = Array("v3r1c1","v3r1c2","v3r1c3","v3r1c4","v3r1c5","v3r1c6","v3r1c7","v3r1c8","v3r1c9","v3r1c10","v3r1c11");
// 	$c5n3r2 = Array("v3r2c1","v3r2c2","v3r2c3","v3r2c4","v3r2c5","v3r2c6","v3r2c7","v3r2c8","v3r2c9","v3r2c10","v3r2c11");
// 	$c5n3r3 = Array("v3r3c1","v3r3c2","v3r3c3","v3r3c4","v3r3c5","v3r3c6","v3r3c7","v3r3c8","v3r3c9","v3r3c10","v3r3c11");
// 	$c5n3r4 = Array("v3r4c1","v3r4c2","v3r4c3","v3r4c4","v3r4c5","v3r4c6","v3r4c7","v3r4c8","v3r4c9","v3r4c10","v3r4c11");
// 	$c5n3r5 = Array("v3r5c1","v3r5c2","v3r5c3","v3r5c4","v3r5c5","v3r5c6","v3r5c7","v3r5c8","v3r5c9","v3r5c10","v3r5c11");
// 	$c5n3r6 = Array("v3r6c1","v3r6c2","v3r6c3","v3r6c4","v3r6c5","v3r6c6","v3r6c7","v3r6c8","v3r6c9","v3r6c10","v3r6c11");
// 	$c5n3r7 = Array("v3r7c1","v3r7c2","v3r7c3","v3r7c4","v3r7c5","v3r7c6","v3r7c7","v3r7c8","v3r7c9","v3r7c10","v3r7c11");
// 	$c5n3r8 = Array("v3r8c1","v3r8c2","v3r8c3","v3r8c4","v3r8c5","v3r8c6","v3r8c7","v3r8c8","v3r8c9","v3r8c10","v3r8c11");
// 	$c5n3r9 = Array("v3r9c1","v3r9c2","v3r9c3","v3r9c4","v3r9c5","v3r9c6","v3r9c7","v3r9c8","v3r9c9","v3r9c10","v3r9c11");
// 	$c5n3r10 = Array("v3r10c1","v3r10c2","v3r10c3","v3r10c4","v3r10c5","v3r10c6","v3r10c7","v3r10c8","v3r10c9","v3r10c10","v3r10c11");
// 	$c5n3r11 = Array("v3r11c1","v3r11c2","v3r11c3","v3r11c4","v3r11c5","v3r11c6","v3r11c7","v3r11c8","v3r11c9","v3r11c10","v3r11c11");
// 	$c6a1 = Array("vi1r1c2","vi1r2c2","vi1r3c2","vi1r4c2","vi1r5c2","vi1r6c2","vi1r7c2","vi1r8c2","vi2r1c2","vi2r2c2","vi2r3c2","vi2r4c2","vi2r5c2","vi2r6c2","vi2r7c2","vi2r8c2","vi3r1c2","vi3r2c2","vi3r3c2","vi3r4c2","vi3r5c2","vi6r1c2","vi7r1c2");
// 	$c6a2 = Array("vi2r1c1","vi2r2c1","vi2r3c1","vi2r4c1","vi2r5c1","vi2r6c1","vi2r7c1","vi3r1c1","vi3r2c1","vi3r3c1","vi3r4c1","vi4r1c1");
// 	$c6a3 = Array("vi5r1c1","vi5r2c1","vi5r3c1","vi5r4c1","vi5r5c1","vi5r6c1","vi5r7c1","vi6r1c1","vi7r1c1","vi8r1c1","vi9r1c1","vi9r2c1","vi9r3c1","vi9r4c1","vi9r5c1","vi9r6c1","vi9r7c1");
// 	$c7r6 = Array("viir6c1","viir6c2","viir6c3","viir6c4","viir6c5","viir6c6","viir6c7");
	
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
		$nomvar = strtoupper($nombres[$i]);		// OJO VERIFICAR COINCIDENCIA DE LOS ARREGLOS
//		echo $nombres[$i] . " - " . $nomvar . " - " . $valores[$i] . " - " . $row[$nomvar] . "\n";
		if ($valores[$i] != $row[$nomvar]) {
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
	
	$lineaMOD = 'UPDATE ' . $tabla . ' SET ';
	for ($i=1; $i<count($nombres); $i++) {
		$lineaMOD .= $nombres[$i] . '= \'' . $valores[$i] . '\', ';
	}
	
	if ($capitulo == 'C1') {
		$maxit = count($c1n1);
		for ($i=0; $i<$maxit; $i++) {
			if (!isset($_POST[$c1n1[$i]])) {
				$lineaMOD .= $c1n1[$i] . "=NULL, ";
			}
		}
		
		$maxit = count($c1n2);
		for ($i=0; $i<$maxit; $i++) {
			if (!isset($_POST[$c1n2[$i]])) {
				$lineaMOD .= $c1n2[$i] . "='', ";
			}
		}
		
		$maxit = count($c1n4);
		for ($i=0; $i<$maxit; $i++) {
			if (!isset($_POST[$c1n4[$i]])) {
				$lineaMOD .= $c1n4[$i] . "=NULL, ";
			}
		}
		
		$maxit = count($c1n567);
		for ($i=0; $i<$maxit; $i++) {
			if (!isset($_POST[$c1n567[$i]])) {
				$lineaMOD .= $c1n567[$i] . "='', ";
			}
		}
		
		$maxit = count($c1n10);
		for ($i=0; $i<$maxit; $i++) {
			if (!isset($_POST[$c1n10[$i]])) {
				$lineaMOD .= $c1n10[$i] . "='', ";
			}
		}
	}
	
	if ($capitulo == 'C2') {
		if (!isset($_POST['ii2r1c1'])) {
			$lineaMOD .= "ii2r1c1='', ";
		}
		$maxit = count($c2n3);
		for ($i=0; $i<$maxit; $i++) {
			if (!isset($_POST[$c2n3[$i]])) {
				$lineaMOD .= $c2n3[$i] . "=NULL, ";
			}
		}
	}

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

	if ($capitulo == "C1" AND ($tipousu == "FU" OR $tipousu == "CR") AND $region != 99) {
		$qControl = $conn->query("UPDATE control SET m2=1, m3=1, m5=1 WHERE nordemp = $valores[0] AND vigencia = $vig");
	}
?>
