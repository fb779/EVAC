<?php

$jsondata = array();

if( isset($_POST['newPer']) ) {
	
	$newPer = $_POST['newPer'];
	
	if (session_id() == "") {
		session_start();
	}
	
	$_SESSION['vigencia'] = $newPer;
		
	$jsondata['success'] = true;
	$jsondata['message'] = 'Cambio de periodo correcto.';

}else{
	$jsondata['success'] = false;
	$jsondata['message'] = 'Error al cambiar el periodo.';
}

//Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();