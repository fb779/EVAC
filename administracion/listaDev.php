<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$id_usu = $_SESSION['idusu'];
	$vig = $_SESSION['vigencia'];
	$tipousu = $_SESSION['tipou'];
	$nombre = $_SESSION['nombreu'];
	$region = $_SESSION['region'];
	$pagina = "CONSULTA DEVOLUCIONES";

	$qNregion = $conn->prepare("SELECT nombre FROM regionales WHERE codis = :nRegion");
	$qNregion->execute(array(':nRegion'=>$region));
	$rowRegion = $qNregion->fetch(PDO::FETCH_ASSOC);
	
	if ($region == 99) {
		if ($tipousu == "CO" OR $tipousu == "AT" OR $tipousu == "TE") {
			$qDevueltos = $conn->query("SELECT a.*, b.nombre AS nombreusu, c.nombre AS empresa, d.nombre AS region, e.estado FROM devoluciones a,
				usuarios b, caratula c, regionales d, control e WHERE a.vigencia = $vig AND b.ident = a.codcrit AND c.nordemp = a.nordemp 
				AND d.codis = a.codsede AND e.estado = 4 AND e.nordemp = a.nordemp AND a.tipo = 'DEV' ORDER BY a.nordemp, a.fecha");
		}
		else {
			if ($tipousu == "CR") {
				$qDevueltos = $conn->query("SELECT a.*, b.nombre AS nombreusu, c.nombre AS empresa, d.nombre AS region FROM
					devoluciones a, usuarios b, caratula c, regionales d, control e
					WHERE a.vigencia = $vig AND a.coddev = '$id_usu' AND b.ident = a.codcrit AND c.nordemp = a.nordemp AND
					d.codis = a.codsede AND e.estado = 4 AND e.nordemp = a.nordemp AND a.tipo = 'DEV' ORDER BY a.nordemp, a.fecha");
			}
		}
	}
	else {
		if ($tipousu == "CO" OR $tipousu == "AT" OR $tipousu == "TE") {
			$qDevueltos = $conn->query("SELECT a.*, b.nombre AS nombreusu, c.nombre AS empresa, d.nombre AS region
				FROM devoluciones a, usuarios b, caratula c, regionales d, control e
				WHERE a.vigencia = $vig AND b.ident = a.codcrit AND a.codsede = $region AND c.nordemp = a.nordemp AND
				d.codis = a.codsede AND e.estado = 4 AND e.nordemp = a.nordemp AND a.tipo = 'DEV' ORDER BY a.nordemp, a.fecha");
		}
		else {
			if ($tipousu == "CR") {
				$qDevueltos = $conn->query("SELECT a.*, b.nombre AS nombreusu, c.nombre AS empresa, d.nombre AS region
					FROM devoluciones a, usuarios b, caratula c, regionales d, control e
					WHERE a.vigencia = $vig AND a.codcrit = '$id_usu' AND b.ident = a.codcrit AND a.codsede = $region AND
					c.nordemp = a.nordemp AND d.codis = a.codsede AND e.estado = 4 AND e.nordemp = a.nordemp AND a.tipo = 'DEV' ORDER BY a.nordemp, a.fecha");
			}
		}
	}
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
		<div class="container" style="padding-top: 60px;">
			<div class="col-md-12">
				<table class='table table-condensed table-hover table-bordered' style='font-size: 11px'>
					<thead>
						<tr>
							<th class="text-center">Vig.</th>
							<th class="text-right">Numero</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Sede</th>
							<th class="text-center">Observaci&oacute;n</th>
							<th class="text-center">Cr&iacute;tico</th>
							<th class="text-center">Fecha</th>
							<th class="text-center">Tipo</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($qDevueltos AS $ldevol) {
								echo "<tr><td style='text-align: right'>" . $ldevol['vigencia'] . "</td>";
								echo "<td style='text-align: right'>" . $ldevol['nordemp'] . "</td>";
								echo "<td>" . $ldevol['empresa'] . "</td>";
								echo "<td>" . $ldevol['region'] . "</td>";
								echo "<td>" . $ldevol['observa'] . "</td>";
								echo "<td>" . $ldevol['nombreusu'] . "</td>";
								echo "<td>" . $ldevol['fecha'] . "</td>";
								if ($ldevol['tipo'] == "RV") {
									echo "<td style='color: green'>" . $ldevol['tipo'] . "</td>";
								}
								else {
									echo "<td>" . $ldevol['tipo'] . "</td>";
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
 	</body>
 </html> 
