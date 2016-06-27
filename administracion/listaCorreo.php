<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$id_usu = $_SESSION['idusu'];
	$tipousu = $_SESSION['tipou'];
	$nombre = $_SESSION['nombreu'];
	$region = $_SESSION['region'];
	$pagina = "CONSULTA NOTIFICACIONES";
	$vig=$_SESSION['vigencia'];
	if (isset($_GET['estadoEnv']) AND isset($_GET['estadoVer'])) {
		if ($region == 99) {
			$qListacorreo = $conn->query("SELECT nordemp, nombre FROM  caratula WHERE envcorr = " .  $_GET['estadoEnv'] . " AND vericorr = " . $_GET['estadoVer']);
		}
		else {
			$qListacorreo = $conn->query("SELECT nordemp, nombre FROM  caratula WHERE envcorr = " .  $_GET['estadoEnv'] . " AND vericorr = " . $_GET['estadoVer'] . " AND regional = " . $region);
		}
	}
	else {
		if ($region == 99) {
			$qListacorreo = $conn->query("SELECT nordemp, nombre FROM  caratula WHERE envcorr = " . $_GET['estadoEnv']);
		}
		else {
			$qListacorreo = $conn->query("SELECT nordemp, nombre FROM  caratula WHERE envcorr = " . $_GET['estadoEnv'] . " AND regional = " . $region);
		}
	}

	$qNregion = $conn->prepare("SELECT nombre FROM regionales WHERE codis = :nRegion");
	$qNregion->execute(array(':nRegion'=>$region));
	$rowRegion = $qNregion->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Encuesta de Desarrollo e Innovación Tecnológica - Formulario Electrónico</title>
		<link href="../bootstrap/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<!-- Bootstrap -->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../bootstrap/css/custom.css" rel="stylesheet">
		<link href="../bootstrap/css/sticky-footer.css" rel="stylesheet">		
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
	</head>
	<body>
		<?php 
			include 'menuRet.php';
		?>
		<br><br><br>
			<div class="container">
				<div class="col-md-8 col-md-offset-1">
					<table class='table table-condensed table-hover table-bordered'>
						<thead>
							<tr>
								<th class="text-center">Sec.</th>
								<th class="text-right">Numero</th>
								<th class="text-center">Nombre</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sec = 1;
								foreach ($qListacorreo AS $lCorreo) {
									echo "<tr><td style='text-align: right'>" . $sec . "</td>";
									echo "<td style='text-align: right'>" . $lCorreo['nordemp'] . "</td>";
									echo "<td>" . $lCorreo['nombre'] . "</td></tr>";
									$sec +=1;
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
 	</body>
 </html> 
