 <?php
	// validamos que la peticion sea ajax
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		$jsondata = array();
		if (session_id() == "") {
			session_start();
		}

		include '../conecta.php';

		$emp = $_POST['emp'];
		$lActiv = json_decode($_POST['dtActi']);
		$ciiu = array();

		if ( count($lActiv) == 0){
			$qlisActi = $conn->query ( "SELECT CODIGO, DESCRIP FROM ciiu3 WHERE CODIGO NOT IN (SELECT ci.CODIGO FROM actiemp AS ac INNER JOIN caratula AS ct ON ct.nordemp = ac.nordemp INNER JOIN ciiu3 AS ci ON ci.CODIGO = ac.actividad WHERE ac.nordemp = '" . $emp . "') ORDER BY CODIGO");
		}else if (count($lActiv) > 0) {
			$grupo = '';
			foreach ($lActiv as $dt) {
				$grupo .= "'" . $dt->name . "',";
			}
			$grupo = rtrim($grupo,',');
			$qlisActi = $conn->query ( "SELECT CODIGO, DESCRIP FROM ciiu3 WHERE CODIGO NOT IN ($grupo) ORDER BY CODIGO");
		}

		foreach ($qlisActi->fetchAll() as $value) {
			$ciiu[] = array('name' => $value['CODIGO'], 'value' => htmlentities($value['DESCRIP']) );
		}

		$jsondata['actividades'] = json_encode($ciiu);

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
		exit();
	} else{
		$jsondata['message'] = 'No es una peticion valida....';
		$jsondata['success'] = false;
		echo "No es una peticion valida....";
		exit();
	}
?>