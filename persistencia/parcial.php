<?php
if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){ //validamos que la peticion sea ajax
	$jsondata = array();
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$vig = $_SESSION['vigencia'];
	$tvab = 0;
	$tvcb = 0;
	$tvnc = 0;

	if (isset($_POST['C1']) && isset($_POST['dtSe'])){
		$emp = $_POST['C1'];
		// $data = json_decode(stripslashes($_POST['dtSe']));
		$data = json_decode($_POST['dtSe']);
		$sv = count($data);
		// $jsondata['sv'] = $sv;
		$jsondata['data'] = $data;


		$sqlInsert = 'INSERT INTO capitulo_i_displab (C1_nordemp, vigencia, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14, i1r2c15, i1r2c16, i1r2c17, i1r2c18, i1r2c19, i1r2c20, i1r2c21) values ';
		// $sqlInsert = 'INSERT INTO capitulo_i_displab (C1_nordemp, vigencia, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14, i1r2c15) values ';
		$numCampos = 20; /* numero de campos a insetar a validar para la inserción (campos obligatorios i1r2c1 - i1r2c13) */
		$numCmpDif = 8; /* campos no obligatorios para las vacantes dinamicas (7 campos de checkbox y campo opcional cual) i1r2c14 - i1r2c21 */
		$tem = ''; /* estructura de los values a insertar en las vacantes */

		/* ciclo que itera los datos enviados del formulario para la incersion de las vacantes */
		foreach ($data as $key=>$dt){ /* se iteran sobre cada una de las vacantes enviadas */
			$tem1 = "('" . $emp . "','" . $vig . "',"; /* guarda los values para la inservion de cada vacante */

			/* ciclo que itera sobre los 21 campos de la vacante y verifica si son datos obligatorios o opcionales
			 * se consideran obligatorios los datos del campo 0 al campo i1r2c1 - i1r2c13
			 * se consideran opcionales los datos del campo i1r2c14 - i1r2c21
			*/
			for ($j=0; $j<=$numCampos; $j++){
				$nc = 'i1r2c'.($key+1).'_'.$j;

				if (isset($dt[$j]) && $dt[$j]->value != '' &&  $j<=($numCampos-$numCmpDif)){
					/* datos obligatorios de la vacante */
					$tem1 .= "'" . $dt[$j]->value . "',";
					$jsondata['campos'][$nc] = $dt[$j]->value;
				} else if ($j > ($numCampos-$numCmpDif)) {
					/* datos opcionales de la vacante */
					$tem2 = '';
					for ($i=13; $i <= $numCampos ; $i++) {
						if (isset($dt[$i]) && $dt[$i]->value != '' && $dt[$i]->name == $nc){
							$tem2 = "'" . $dt[$i]->value . "',";
							$jsondata['campos'][$nc] = $dt[$i]->value;
						}
					}

					if ($tem2 != ''){
						$tem1 .= $tem2;
					} else {
						$tem1 .= "NULL,";
					}
				} else {
					/* datos obligatorios que no vienen con la información generan error para la inserción */
					if ($j < ($numCampos-$numCmpDif)){
						$sv--;
						$j = $numCampos;
						$tem1 = '';
					}
				}
			}

			if ($tem1 != ''){
				$tvab += $dt[0]->value;
				$tvcb += $dt[9]->value;
				$tvnc += $dt[12]->value;
				$tem .= rtrim($tem1, ",") .  '),';
			}
		}

		$sqlInsert .= rtrim($tem, ",");
		$jsondata['sql'] = $sqlInsert;
		// $jsondata['guarda'] = $sv;

		if ($sv > 0){
			$conn->query("delete from capitulo_i_displab where C1_nordemp = '".$emp."' and vigencia = '".$vig."' ;");
			try {
				$actcapi = $conn->exec($sqlInsert);
				$conn->query("update capitulo_i set i1r1c2 ='". $tvab ."', i1r1c3 = '". $tvcb ."' , i1r1c4 = '". $tvnc ."' where C1_nordemp = '". $emp ."' and vigencia = '". $vig ."';");
				$jsondata['success'] = true;
			} catch (Exception $e) {
				$jsondata['errorInsert'] = $e;
				$jsondata['success'] = false;
			}
		}else{
			$conn->query("delete from capitulo_i_displab where C1_nordemp = '".$emp."' and vigencia = '".$vig."' ;");
			/*$actcapi = $conn->exec($sqlInsert);*/
			$jsondata['message'] = 'Se eliminaron las disponibilidades';
			$jsondata['success'] = false;
		}
	} elseif ((isset($_POST['C1']) && isset($_POST['dtDel']))) {
		$emp = $_POST['C1'];
		// $conn->query("delete from capitulo_i_displab where C1_nordemp = '".$emp."' and vigencia = '".$vig."' ;");
		$conn->query("update capitulo_i set i1r1c2 ='". $tvab ."', i1r1c3 = '". $tvcb ."' , i1r1c4 = '". $tvnc ."' where C1_nordemp = '". $emp ."' and vigencia = '". $vig ."';");
		$jsondata['success'] = true;
	} else {
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

