<?php

if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){ //validamos que la peticion sea ajax
	$jsondata = array();
	//$jsondata['dtextra'] = 'si es ajax';
	try {
		if( isset($_POST['newPer'])) {

			$newPer = $_POST['newPer'];

			if (session_id() == "") {
				session_start();
			}

			$perAct = $_SESSION['vigencia'];

			if ($newPer != $perAct ){
				include '../conecta.php';
				$qPeriodoac = $conn->query("SELECT nomperiodo FROM periodoactivo where id = ". $newPer . " ;")->fetch(PDO::FETCH_ASSOC);

				$_SESSION['vigencia'] = $newPer;
				$_SESSION['nomPeri'] = $qPeriodoac['nomperiodo'];

				$jsondata['success'] = true;
				$jsondata['message'] = 'Cambio de periodo correcto.';
			}else{
				$jsondata['success'] = true;
				$jsondata['message'] = 'El periodo es el mismo.';
			}
		}else{
			$jsondata['success'] = false;
			$jsondata['message'] = 'Error al cambiar el periodo.';
		}
	} catch (Exception $e) {
		$jsondata['errorMessage'] = $e->getMessage();
	}

	//Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	exit();
}else{
	header('location: operativo.php');
}

