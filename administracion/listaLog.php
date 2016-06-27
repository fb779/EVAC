<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$vig = $_SESSION['vigencia'];
	$region = $_SESSION['region'];
	$pagina = "LISTA LOG MODIFICACIONES";
	$norden = $_GET['numfte'];
	ini_set('default_charset', 'UTF-8');
	
	$prefijo = $_GET['idl'];
	$longitud = strlen($prefijo);
	
	$qModif = $conn->query("SELECT * FROM auditoria WHERE substr(nom_var,1,$longitud) = '$prefijo' AND numemp = $norden ORDER BY nom_var, fec_mod, hora_mod");
	
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
				<table class='table table-condensed table-hover table-bordered' style='font-size: 13px'>
					<thead>
						<tr>
							<th class="text-center">N. Orden</th>
							<th class="text-center">Usuario</th>
							<th class="text-center">Fecha Modif.</th>
							<th class="text-center">Hora Modif.</th>
							<th class="text-center">Variable</th>
							<th class="text-center">Val. Anterior</th>
							<th class="text-center">Val. Actual</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($qModif AS $lModif) {
								echo "<tr><td style='text-align: center'>" . $lModif['numemp'] . "</td>";
								echo "<td>" . $lModif['usuario'] . "</td>";
								echo "<td>" . $lModif['fec_mod'] . "</td>";
								echo "<td>" . $lModif['hora_mod'] . "</td>";
								echo "<td>" . $lModif['nom_var'] . "</td>";
								echo "<td>" . $lModif['valor_anterior'] . "</td>";
								echo "<td>" . $lModif['valor_actual'] . "</td></tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
 	</body>
 </html> 
