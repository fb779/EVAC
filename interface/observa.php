<?php
	if (session_id() == "") {
		session_start();
	}
	ini_set('default_charset', 'UTF-8');
	include '../conecta.php';
	$id_usu = $_SESSION['idusu'];
	$vig=$_SESSION['vigencia'];
	$page = $_GET['capit'];
	switch ($page) {
		case "cap1":
			$capitulo = 1;
			break;
		case "cap2":
			$capitulo = 2;
			break;
		case "cap3":
			$capitulo = 3;
			break;
		case "cap4":
			$capitulo = 4;
			break;
		case "cap5":
			$capitulo = 5;
			break;
		case "cap6":
			$capitulo = 6;
			break;
	}
	if (substr($id_usu,2,2) == '99')
	$vig=$_SESSION['vigencia'];
	$numero = $_GET['numord'];
	$usucomp = substr($id_usu,2,2);

	if ($page != "cara") {
		if (substr($id_usu,2,2) == '99') {
			$qObserva = $conn->query("SELECT o. * , u.nombre FROM observaciones o left join usuarios  u on o.usuario=u.ident WHERE o.NORDEMP = $numero
				AND o.capitulo = $capitulo AND vigencia = $vig AND length(observacion)>0 ORDER BY o.usuario, o.fecha");
		}
		else {
			$qObserva = $conn->query("SELECT o. * , u.nombre FROM observaciones o left join usuarios  u on o.usuario=u.ident WHERE o.NORDEMP = $numero
				AND o.capitulo = $capitulo AND vigencia = $vig AND length(observacion)>0 AND usuario LIKE '%$usucomp%' ORDER BY o.usuario, o.fecha");
		}
	}
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
		<nav class="navbar navbar-default navbar-fixed-top small">
			<div class="container-fluid">
			    	<div class="navbar-header">
			        	<span class="navbar-brand">EDIT Servicios - OBSERVACIONES CRITICA</span>
			        </div>
			</div>
		</nav>
		<div class="container" style="padding-top: 60px;">
			<div class="col-md-12">
				<table class='table table-condensed table-hover table-bordered' style='font-size: 11px'>
					<tbody>
						<?php
							if ($qObserva->rowCount()>0) {
								$usu='';
								echo "<table>";
								foreach ($qObserva AS $lObserva) {
									if ($lObserva['usuario'] != $usu) {
										$usu = $lObserva['usuario'];
										echo "<tr><td>&nbsp;</td></tr>";
										echo "<tr>";
										echo "<td colspan='2' style = 'font-size: 12px; font-weight: bold'>";
										echo $lObserva['usuario'] . " - " . $lObserva['nombre'];
										echo "</tr>";
									}
									echo "<tr>";
									echo "<td>";
									echo $lObserva['fecha'];
									echo "</td>";
									echo "<td>&nbsp;</td>";
									echo "<td>";
									echo $lObserva['observacion'];
									echo "</td>";
									echo "</tr>";
								}
							}
							else {
								echo "NO SE ENCONTRARON OBSERVACIONES";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
 	</body>
 </html> 
