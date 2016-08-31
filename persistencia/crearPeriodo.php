<?php
	//validamos que la peticion sea ajax
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		$jsondata = array();
		if (session_id() == "") {
			session_start();
		}
		include '../conecta.php';

		$namePeriodo = array(1=>'I trimestre de',2=>'II trimestre de',3=>'III trimestre de',4=>'IV trimestre de');
		$estPeriodo = array('ac' => 'ac', 'cr' => 'cr');
		$fecActual = getdate();
		//$numPeriodo = $_POS['var'];

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->beginTransaction();

		try {
			/** pendiente de evaluacion si envian el periodo por la interfaz solo se verifica el dato para que cumpla con la condicion de periodo */
			// $periodosActivo = $conn->query("SELECT id,codperiodo,estperiodo,nomperiodo,numperiodo,anioperiodo from periodoactivo where estperiodo = 'ac'")->fetch(PDO::FETCH_ASSOC);
			$periodosActivo = $conn->query("SELECT id,codperiodo,estperiodo,nomperiodo,numperiodo,anioperiodo from periodoactivo where estperiodo = 'ac'");

			if ($periodosActivo->rowCount() > 0 ){
				$periodoactivo = $periodosActivo->fetch(PDO::FETCH_ASSOC);
				$numPeriodo = $periodoactivo['numperiodo']+1;
				$año = $periodoactivo['anioperiodo'];
				if ($numPeriodo > 4){
					$numPeriodo = 1;
					$año = $periodoactivo['anioperiodo'] + 1;
				}
			}else{
				$numPeriodo = 1;
				$año = $fecActual['year'];
			}


			/** cambiamos el periodo activo para crear el nuevo periodo */
			$cabmiarPeriodos = $conn->query("UPDATE periodoactivo set estperiodo = '".$estPeriodo['cr']."', fecmodificacion = curdate() where estperiodo = '".$estPeriodo['ac']."'" ) ;
			/* Crear el nuevo periodo activo */
			// $qNewPeriodo = $conn->query("INSERT into periodoactivo (codperiodo,estperiodo,nomperiodo,numperiodo,anioperiodo,feccreacion,fecmodificacion) value ((select codPeriodo from tipoperiodo where codPeriodo = 02),'". $estPeriodo['ac'] ."','" . $namePeriodo[$numPeriodo] . " " . $fecActual['year'] ."'," . $numPeriodo .",". $fecActual['year'] .",CURDATE(),'0000-00-01')");

			$qNewPeriodo = $conn->query("INSERT into periodoactivo (codperiodo,estperiodo,nomperiodo,numperiodo,anioperiodo,feccreacion) value ((select codPeriodo from tipoperiodo where codPeriodo = 02),'". $estPeriodo['ac'] ."','" . $namePeriodo[$numPeriodo] . " " . $año ."'," . $numPeriodo .",". $año .",CURDATE())");

			// $qNewControl = $conn->query("INSERT into control (nordemp,vigencia,estado,usuario,usuariodt,usuarioss,ciiu3,m1, m2,m3,m4,m5,m6,m7,rese,prioridad,novedad,codsede,fecdist,fecdig,fecrev,fecacept,aceptadc,prio2,acceso) (SELECT nordemp, (SELECT id from periodoactivo where estperiodo = 'ac'),0,'','','',ciiu3,0,0,0,0,0,0,0,0,0,5,regional,'01-01-01','01-01-01','01-01-01','01-01-01','01-01-01',0,'FU' from caratula order by nordemp desc)");

			$qNewControl = $conn->query("INSERT into control (nordemp,vigencia,estado,usuario,usuariodt,usuarioss,ciiu3,m1, m2,m3,m4,m5,m6,m7,rese,prioridad,novedad,codsede,fecdist,fecdig,fecrev,fecacept,aceptadc,prio2,acceso) (SELECT nordemp, (SELECT id from periodoactivo where estperiodo = 'ac'),0,'','','',ciiu3,0,0,0,0,0,0,0,0,0,5,regional,'0000-00-00','0000-00-00','0000-00-00','0000-00-00','0000-00-00',0,'FU' from caratula order by nordemp desc)");


			$verificaPeriodosActivo = $conn->query("SELECT id,codperiodo,estperiodo,nomperiodo,numperiodo,anioperiodo from periodoactivo where estperiodo = 'ac'")->fetch(PDO::FETCH_ASSOC);

			$_SESSION['vigencia'] = $verificaPeriodosActivo['id'];
			$_SESSION['nomPeri'] = $verificaPeriodosActivo['nomperiodo'];
			$_SESSION['periodoAct'] = $verificaPeriodosActivo['id'];
			$_SESSION['nomPeriAct'] = $verificaPeriodosActivo['nomperiodo'];

			$jsondata['message'] = 'termino correctamente';
			$jsondata['success'] = true;
			$conn->commit();
		} catch (Exception $e) {
			$conn->rollBack();
			$jsondata['message_exception'] = $e->getMessage();
			$jsondata['message'] = 'Se presentaron dificultades tecnicas....';
			$jsondata['success'] = false;
		}
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
		exit();
	} else{
		$jsondata['message'] = 'No es una peticion valida....';
		$jsondata['success'] = false;
		//header('location: operativo.php');
		echo "No es una peticion valida....";
		exit();
	}


?>