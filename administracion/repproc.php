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
	$pagina = "CONSULTA PROCESOS";
	$numero = $_GET['numero'];
	
	$qControl = $conn->query("SELECT a.nordemp, a.ciiu3, b.nombre, c.desc_estado, IFNULL(d.nombre, 'No asignado') AS ususede, e.desc_novedad,
		f.nombre AS sede, a.fecdist, a.fecdig, a.fecrev, a.fecacept, a.aceptadc FROM control a LEFT JOIN caratula b ON a.nordemp = b.nordemp
		LEFT JOIN estados c ON a.estado = c.idestados
		LEFT JOIN usuarios d ON a.usuarioss = d.ident
		LEFT JOIN novedades e ON a.novedad = e.idnovedades
		LEFT JOIN regionales f ON a.codsede = f.codis
		WHERE a.nordemp LIKE '$numero' 
		ORDER BY a.nordemp
		");
	
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
		<script type="text/javascript">
			$(function() {
	            $("#idopera").submit(function(event) {
	                event.preventDefault();
					if ($.isNumeric($("#txtBusca").val()))
					{
						$.ajax({
							url: "../persistencia/opFormulario.php",
							type: "POST",
							data: {accion: "verifica", numero: $("#txtBusca").val()},
							success: function(dato) {
								if (dato=="") {
									var newloc = "repproc.php?numero="+$("#txtBusca").val();
									window.location = newloc;
								}
								else {
									alert(dato);
								}
							}
						});
					}
					else {
						//alert(dato);
						var newloc = "repproc.php?numero=%";
						window.location = newloc;
					}
				});
			});
			
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();   
			});
		</script>
	</head>
	<body>
		<?php 
			include 'menuRet.php';
		?>
		<form class='form-horizontal' role='form' name="opera" id="idopera">
		<div class="container" style="padding-top: 60px;">
		<div class="row">
			<div class="col-md-12">
				<div class="col-lg-6">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Buscar..." id="txtBusca">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">Buscar</button>
							</span>
						</div>
				</div>
			</div>				
			<table class='table table-condensed table-hover table-bordered' style='font-size: 11px; margin-top: 15px;'>
				<thead>
					<tr>
						<th class="text-center">Nordemp</th>
						<th class="text-center">CIIU</th>
						<th class="text-center">Nombre</th>
						<th class="text-right">Estado</th>
						<th class="text-center">Asignado</th>
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
						foreach ($qControl AS $lControl) {
							echo "<tr><td style='text-align: right'>" . $lControl['nordemp'] . "</td>";
							echo "<td style='text-align: right'>" . $lControl['ciiu3'] . "</td>";
							echo "<td>" . $lControl['nombre'] . "</td>";
							echo "<td>" . $lControl['desc_estado'] . "</td>";
							echo "<td>" . $lControl['ususede'] . "</td>";
							echo "<td>" . $lControl['desc_novedad'] . "</td>";
							echo "<td>" . $lControl['sede'] . "</td>";
							echo "<td>" . $lControl['fecdist'] . "</td>";
							echo "<td>" . $lControl['fecdig'] . "</td>";
							echo "<td>" . $lControl['fecrev'] . "</td>";
							echo "<td>" . $lControl['fecacept'] . "</td>";
							echo "<td>" . $lControl['aceptadc'] . "</td></tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</form>
 	</body>
 </html> 
