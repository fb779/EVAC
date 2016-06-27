<?php
	if(session_id()  == "") {
		session_start();
	}
	
	if (!isset($_SESSION['tipou'])) {
		echo "<h2 style='text-align: center; font-family: arial'>SESIÓN HA FINALIZADO. DEBE AUTENTICARSE DE NUEVO</h2>";
		return;
	}
	
	include '../conecta.php';
	$region = $_SESSION['region'];
	if (isset($_POST['caso'])) {
		$tipomant = $_POST['modo'];
	
		$caso = $_POST['caso'];
		$condicion= $_POST['condicion'];
		$descripcion = $_POST['descripcion'];
		
		$tipomant = ($caso == "" ? "ADIC" : "MOD");
		
		if ($tipomant=="MOD") {
			$lineactu = $conn->prepare("UPDATE casos SET condicion = '$condicion', descripcion = '$descripcion' WHERE caso = '$caso'");
			$lineactu->execute();
			echo "CASO ACTUALIZADO";
		}
		
		if ($tipomant == "ADIC") {
			$cadenains = $conn->prepare("INSERT INTO casos (condicion, descripcion) VALUES ('$condicion', '$descripcion')");
			$cadenains->execute();
			echo "CASO ADICIONADO";
		}
	}
	if (isset($_POST['borrar'])) {
		$idCaso = $_POST['idBorrar'];
		$cadenaborra = $conn->prepare("DELETE FROM casos WHERE caso = $idCaso");
		$cadenaborra->execute();
		echo "CASO ELIMINADO";
	}
?>
