<?php
//	$con = mysql_connect("localhost", "root", "admin1");

	//Datos de conexion servidor de producci�n:
	/*$servidor ="192.168.1.121";
	$usuario  ="formulario_edit";
	$password ="F0Rm2009541";*/

//	$servidor ="localhost";
// 	$usuario  ="dimpe";
// 	$password ="D1mP3D3s4rr0ll0";
	$db = "dane_evac_mod";
	$usuario  ="root";
	$password ="toor";

	try {
		$conn = new PDO('mysql:host=localhost;dbname='.$db, $usuario, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->exec("SET CHARACTER SET UTF8");
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	/*Servidor de Prueba:
	$con = mysql_connect("localhost", "fvalencia", "fValencia547");*/
/*
	$con = mysql_connect("$servidor", "$usuario", "$password");
	if (!$con)
	{
		die("No se puede conectar: ". mysql_error());
	}
	mysql_select_db("dimpe_editi7", $con);
*/
//	mysql_select_db("bdeam", $con);
?>
