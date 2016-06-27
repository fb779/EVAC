<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$region = $_SESSION['region'];
	$vig = $_SESSION['vigencia'];
	if (isset($_POST['tipo']) AND $_POST['tipo'] == "asigtot") {
		$fuentesAsig = $_POST['fuentes'];
		$usuarioAsig = $_POST['usuario'];
		$activAsig = $_POST['activ'];
		if ($region != 99) {
			if($fuentesAsig == 0) {
				$qAsignar = $conn->prepare("UPDATE control SET usuarioss = '$usuarioAsig' WHERE codsede = $region AND ciiu3 = $activAsig AND usuarioss = '' AND vigencia = $vig");
				$qAsignar->execute();
			}
			else {
				$qAsignar = $conn->prepare("UPDATE control SET usuarioss = '$usuarioAsig' WHERE codsede = $region AND ciiu3 = $activAsig AND usuarioss = '' AND vigencia = $vig LIMIT $fuentesAsig");
				$qAsignar->execute();
			}
		}
		else {
			if($fuentesAsig == 0) {
				$qAsignar = $conn->prepare("UPDATE control SET usuario = '$usuarioAsig' WHERE ciiu3 = $activAsig AND usuario = '' AND vigencia = $vig");
				$qAsignar->execute();
			}
			else {
				$qAsignar = $conn->prepare("UPDATE control SET usuario = '$usuarioAsig' WHERE ciiu3 = $activAsig AND usuario = ''  AND vigencia = $vig LIMIT $fuentesAsig");
				$qAsignar->execute();
			}
		} 
	}
	if (isset($_POST['tipo']) AND $_POST['tipo'] == "asiguno") {
		$usuarioAsig = $_POST['usuario'];
		$activAsig = $_POST['activ'];
		$numeroAsig = $_POST['numero'];
		if ($region != 99) {
			$qAsignar = $conn->prepare("UPDATE control SET usuarioss = '$usuarioAsig' WHERE nordemp = $numeroAsig AND ciiu3 = $activAsig AND usuarioss = '' AND vigencia = $vig");
			$qAsignar->execute();
		}
		else {
			$qAsignar = $conn->prepare("UPDATE control SET usuario = '$usuarioAsig' WHERE nordemp = $numeroAsig AND ciiu3 = $activAsig AND usuario = '' AND vigencia = $vig");
			$qAsignar->execute();
		}
	}
	
	if (!isset($_POST['tipo'])) {
		$id_usu = $_SESSION['idusu'];
		$tipousu = $_SESSION['tipou'];
		$nombre = $_SESSION['nombreu'];
		$actividad = $_POST['activ'];
		$usuarioAsig = $_POST['usuario'];
		$pagina = "ASIGNACIÓN DE FUENTES";
		
		if ($region == 99) {
			$qActividad = $conn->prepare("SELECT a.nordemp, a.ciiu3, b.nombre  FROM control a,  caratula b WHERE a.vigencia =:periodo AND
				a.usuario = ''  AND a.ciiu3 = $actividad AND a.nordemp = b.nordemp");
			$qActividad->execute(array(':periodo'=>$vig));
		}
		else {
			$qActividad = $conn->prepare("SELECT a.nordemp, a.ciiu3, b.nombre FROM control a, caratula b WHERE a.vigencia =:periodo AND
				a.usuarioss = ''  AND a.ciiu3 = $actividad AND a.nordemp = b.nordemp AND a.codsede = :region");
				$qActividad->execute(array(':periodo'=>$vig, ':region'=>$region));
		}
		echo "<table class='table table-condensed table-hover table-bordered'>";
		while ($rowActividad = $qActividad->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr><td>" . $rowActividad['nordemp'] . "</td>";
			echo "<td>" . $rowActividad['nombre'] . "</td>";
			echo "<td><button type='button' class='btn btn-primary btn-sm' id='uno" . $rowActividad['nordemp'] . "' onClick='asigftesuno(this.id, " . $actividad . ", " . $rowActividad['nordemp'] . ", \"" . $usuarioAsig . "\")';>Asignar</button></td></tr>";
		}
		echo "</table>";
	}
?>
