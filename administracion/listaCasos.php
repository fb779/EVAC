<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$vig = $_SESSION['vigencia'];
	$region = $_SESSION['region'];
	$pagina = "LISTA CASOS";
	
	ini_set('default_charset', 'UTF-8');
	
	$qCasos = $conn->query("SELECT * FROM casos");
	
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
		<link href="../bootstrap/css/bootstrap-dialog.css" rel="stylesheet">
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<script type="text/javascript" src="../js/bootstrap-dialog.min.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<script type="text/javascript">
			function grabaHoja(numcaso) {
				document.getElementById(numcaso).innerHTML = "Grabando...";
				$(function() {
					$.ajax({
						url: "grabaHojaCasos.php",
						type: "POST",
						data: {caso: numcaso},
						success: function(dato) {
							alert(dato);
							document.getElementById(numcaso).disabled = true;
							document.getElementById(numcaso).innerHTML = "Grabado";
						}
					});
				});
			}

			function confirmar(id) {
				BootstrapDialog.show({
					type: BootstrapDialog.TYPE_WARNING,
					title: 'Eliminar Caso',
					message: 'CONFIRMA LA ELIMINACION DEL CASO '+id + '?',
					buttons: [{
						label: 'Confirmar',
							action: function(borra) {
								$.ajax({
									url: "../persistencia/grabarcasos.php",
									type: "POST",
									data: {borrar: "borrar", idBorrar: id},
									success: function(dato) {
										alert(dato);
										borra.setMessage('CASO '+id+' - ELIMINADO');
									}
								});
							}
					}, {
						label: 'Cancelar',
							action: function(cerrar) {
							cerrar.close();
						}
					}]
				});
			}
		</script>
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
							<th class="text-center">CASO</th>
							<th class="text-center">CONDICI&Oacute;N</th>
							<th class="text-center">DESCRIPCI&Oacute;N</th>
							<th class="text-center">GUARDAR</th>
							<th class="text-center">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($qCasos AS $lCasos) {
								echo "<tr><td style='text-align: center'><a href='casos.php?numcaso=" . $lCasos['caso'] . "'>" . $lCasos['caso'] . "</td>";
								echo "<td>" . $lCasos['condicion'] . "</td>";
								echo "<td>" . $lCasos['descripcion'] . "</td>";
								echo "<td style='text-align: center'><button id='" . $lCasos['caso'] . "' onClick='grabaHoja(this.id);' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-save'></span></button></td>";
								echo "<td><a href='#' id='" . $lCasos['caso'] . "' data-toggle='tooltip' title='Eliminar Caso' onClick='confirmar(this.id);'><span class='glyphicon glyphicon-remove' style='color: red'></span></a></td></tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
 	</body>
 </html> 
