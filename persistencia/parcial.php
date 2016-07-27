<?php

if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){ //validamos que la peticion sea ajax
	$jsondata = array();
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$vig = $_SESSION['vigencia'];
	
	if (isset($_POST['C1']) && isset($_POST['dtSe'])){
		$emp = $_POST['C1'];
		// 		$data = json_decode(stripslashes($_POST['dtSe']));
		$data = json_decode($_POST['dtSe']);
		$sv = count($data);
		$tvab = 0;
		$tvcb = 0;
		$tvnc = 0;
		
		$sqlInsert = 'INSERT INTO capitulo_i_displab (C1_nordemp, vigencia, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14) values ';
		$tem = '';
		foreach ($data as $key=>$dt){
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
			$jsondata['success'] = false;
		}
	}else{
		$jsondata['message'] = 'Error en los datos enviados No llegaron';
		$jsondata['error'] = $e->getMessage();
		$jsondata['success'] = false;
	}
	
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	exit();
}else{
	echo 'Fallo en la consulta';
	//header('location: operativo.php');
	exit();

}

