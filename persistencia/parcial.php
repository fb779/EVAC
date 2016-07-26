<?php

if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){ //validamos que la peticion sea ajax
	$jsondata = array();
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$vig = $_SESSION['vigencia'];
	
	try {
		//
		$emp = $_POST['C1'];
// 		$data = json_decode(stripslashes($_POST['dtSe']));
		$data = json_decode($_POST['dtSe']);
		$sv = count($data);
		$tvab = 0;
		$tvcb = 0;
		$tvnc = 0;

		$sqlInsert = 'INSERT INTO capitulo_i_displab (C1_nordemp, vigencia, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14) values ';
		$tem = '';
		//print_r($data);
		foreach ($data as $key=>$dt){
			//$tem .= "('" . $emp . "','" . $vig . "',";
			$tem1 = "('" . $emp . "','" . $vig . "',";
			for ($j=0; $j<14; $j++){
				//$nc = 'i1r2c' . ($key+1). $j;
				if (isset($dt[$j]) && $dt[$j]->value != ''){
					$tem1 .= "'" . $dt[$j]->value . "',";
// 					$nombres[] = $dt[$j]->name;
// 					$valores[] = $dt[$j]->value;
				}else{
					$tem1 .= "NULL,";
// 					$nombres[] = $nc;
// 					$valores[] = 'NULL';
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
		
		$sqlInsert .= rtrim($tem, ",");
		$jsondata['sql'] = $sqlInsert;
		$jsondata['guarda'] = $sv;
		
		if ($sv > 0){
			$conn->query("delete from capitulo_i_displab where C1_nordemp = '".$emp."' and vigencia = '".$vig."' ;");
			$actcapi = $conn->exec($sqlInsert);
			$conn->query("update capitulo_i set i1r1c2 ='". $tvab ."', i1r1c3 = '". $tvcb ."' , i1r1c4 = '". $tvnc ."' where C1_nordemp = '". $emp ."' and vigencia = '". $vig ."';");
			$jsondata['success'] = true;
		}else{
			$jsondata['message'] = 'No hay datos para guardar';
			$jsondata['success'] = true;
		}
		
// 		try {
// 			$conn->query("delete from capitulo_i_displab where C1_nordemp = '".$emp."' and vigencia = '".$vig."' ;");
// 			$actcapi = $conn->exec($lineaINS);
// 			$jsondata['success'] = true;
// 		} catch (Exception $e) {
// 			$jsondata['sqlError'] = $e->getMessage();
// 			$jsondata['success'] = false;
// 		}
		
		
// 		$jsondata['emp'] = $emp;
// 		$jsondata['vig'] = $vig;
// 		$jsondata['numpanel'] = $panl;
// 		$jsondata['campos'] = (isset($data))?implode(' - ', $data):'No llegaron nombres';
// 		$jsondata['nombres'] = (isset($nombres))?implode(' - ', $nombres):'No llegaron nombres';
// 		$jsondata['valores'] = (isset($valores))?implode(' - ', $valores):'No llegaron valores';
// 		$jsondata['success'] = true;
	} catch (Exception $e) {
		$jsondata['error'] = $e->getMessage();
		$jsondata['success'] = false;
	}
	
	
	//$jsondata['dtextra'] = 'si es ajax';
// 	try {
// 		if( isset($_POST['newPer']) ) {
		
// 			$newPer = $_POST['newPer'];
		
// 			if (session_id() == "") {
// 				session_start();
// 			}
// 			include '../conecta.php';
// 			$qPeriodoac = $conn->query("SELECT nomperiodo FROM periodoactivo where id = ". $newPer . " ;")->fetch(PDO::FETCH_ASSOC);
			
// 			$_SESSION['vigencia'] = $newPer;
// 			$_SESSION['nomPeri'] = $qPeriodoac['nomperiodo'];
		
// 			$jsondata['success'] = true;
// 			$jsondata['message'] = 'Cambio de periodo correcto.';
		
// 		}else{
// 			$jsondata['success'] = false;
// 			$jsondata['message'] = 'Error al cambiar el periodo.';
// 		}
// 	} catch (Exception $e) {
// 		$jsondata['errorMessage'] = $e->getMessage();
// 	}

	//Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	exit();
}else{
	echo 'Fallo en la consulta';
	//header('location: operativo.php');
	exit();

}

