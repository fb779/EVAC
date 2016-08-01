<?php 
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';

	try {
		$cabmiarPeriodos = $conn->query("UPDATE periodoactivo set estperiodo = 'cr', fecmodificacion = curdate() where estperiodo = 'ac'") ;
		$periodosActivo = $conn->query("SELECT id,codperiodo,estperiodo,nomperiodo,numperiodo,anioperiodo from periodoactivo where estperiodo = 'ac'")->fetch(PDO::FETCH_ASSOC);
		$qNewPeriodo = $conn->query("INSERT into periodoactivo (codperiodo,estperiodo,nomperiodo,numperiodo,anioperiodo,feccreacion) value ((SELECT codPeriodo from tipoperiodo where codPeriodo = 02),'ac','" . . "',3,2015,CURDATE());");
	} catch (Exception $e) {
		
	}



	//validamos que la peticion sea ajax
	// if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 

	// } else{
	// 	header('location: operativo.php');
	// }
?>