<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$id_usu = $_SESSION['idusu'];
	$vig = $_SESSION['vigencia'];
	$tipousu = $_SESSION['tipou'];
	$nombre = $_SESSION['nombreu'];
	$region = $_SESSION['region'];
	$pagina = "LISTA";
	
	ini_set('default_charset', 'UTF-8');
	
	$usuario = $_GET['usu'];
	if (substr($usuario,2,2) == "99") {
		$campoUsu = "usuario";
	}
	else {
		$campoUsu = "usuarioss";
	}
	if (isset($_GET['estado'])) {
		$estadoRep = $_GET['estado'];
		$qControl = $conn->query("SELECT a.nordemp, b.nombre, e.desc_novedad, f.nombre AS sede, a.fecdist, a.fecdig, a.fecrev, a.fecacept,
			a.aceptadc FROM control a LEFT JOIN caratula b ON a.nordemp = b.nordemp
			LEFT JOIN novedades e ON a.novedad = e.idnovedades
			LEFT JOIN regionales f ON a.codsede = f.codis
			WHERE a.estado $estadoRep
			AND $campoUsu = '$usuario'
			AND a.novedad NOT IN (1,2,3,4,6,10,12,13,41,19)
			ORDER BY a.nordemp");
	}
	if (isset($_GET['nove'])) {
		$qControl = $conn->query("SELECT a.nordemp, b.nombre, e.desc_novedad, f.nombre AS sede, a.fecdist, a.fecdig, a.fecrev, a.fecacept,
			a.aceptadc FROM control a LEFT JOIN caratula b ON a.nordemp = b.nordemp
			LEFT JOIN novedades e ON a.novedad = e.idnovedades
			LEFT JOIN regionales f ON a.codsede = f.codis
			WHERE $campoUsu = '$usuario'
			AND a.novedad IN (1,2,3,4,6,10,12,13,41,19)
			ORDER BY a.nordemp");
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
		<title>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - Formulario Electr&oacute;nico</title>
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
		<div class="container" style="padding-top: 60px;">
			<div class="col-md-12">
				<table class='table table-condensed table-hover table-bordered' style='font-size: 11px'>
					<thead>
						<tr>
							<th class="text-center">Sec.</th>
							<th class="text-center">Nordemp</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Novedad</th>
							<th class="text-center">Sede</th>
							<th class="text-center">Dist.</th>
							<th class="text-center">Digitado</th>
							<th class="text-center">Revisi&oacute;n</th>
							<th class="text-center">Enviado DC</th>
							<th class="text-center">Aceptado</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sec=0;
							foreach ($qControl AS $lControl) {
								$sec+=1;
								echo "<tr><td>" . $sec . "</td>";
								echo "<td style='text-align: right'>" . $lControl['nordemp'] . "</td>";
								echo "<td>" . $lControl['nombre'] . "</td>";
								echo "<td>" . $lControl['desc_novedad'] . "</td>";
								echo "<td>" . $lControl['sede'] . "</td>";
								echo "<td>" . $lControl['fecdist'] . "</td>";
								echo "<td>" . $lControl['fecdig'] . "</td>";
								echo "<td>" . $lControl['fecrev'] . "</td>";
								echo "<td>" . $lControl['fecacept'] . "</td>";
								echo "<td>" . $lControl['aceptadc'] . "</td>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
 	</body>
 </html> 
