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
	$pagina = "CONSULTA LOG DE MODIFICACIONES";
	if (isset($_GET['numero'])){
		$numero = $_GET['numero'];
	} else { $numero = ''; }

	$qLog = $conn->query("SELECT a.*, b.nombre
						  FROM auditoria a, usuarios b
						  WHERE a.usuario = b.ident
						  AND a.numemp LIKE '$numero'
						  ORDER BY a.numemp, a.fec_mod, hora_mod, tabla");

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
		<title> <?php echo $_SESSION['titulo'] . 'Reporte auditoria'; ?> </title>
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
									var newloc = "repaudit.php?numero="+$("#txtBusca").val();
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
						var newloc = "repaudit.php?numero=%";
						window.location = newloc;
					}
				});
			});

			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</head>
	<body style="padding-top: 60px; ">
		<?php
			include 'menuRet.php';
		?>
		<form class='form-horizontal' role='form' name="opera" id="idopera">
		<div class="container">
			<div class="col-md-12">
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
				<table class='table table-condensed table-hover table-bordered' style='font-size: 11px'>
					<thead>
						<tr>
							<th class="text-center">Nordemp.</th>
							<th class="text-right">Usuario</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Fecha</th>
							<th class="text-center">Hora</th>
							<th class="text-center">Tabla</th>
							<th class="text-center">Variable</th>
							<th class="text-center">Anterior</th>
							<th class="text-center">Actual</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($qLog AS $lLog) {
								echo "<tr><td style='text-align: right'>" . $lLog['numemp'] . "</td>";
								echo "<td>" . $lLog['usuario'] . "</td>";
								echo "<td>" . $lLog['nombre'] . "</td>";
								echo "<td>" . $lLog['fec_mod'] . "</td>";
								echo "<td>" . $lLog['hora_mod'] . "</td>";
								echo "<td>" . $lLog['tabla'] . "</td>";
								echo "<td>" . $lLog['nom_var'] . "</td>";
								echo "<td>" . $lLog['valor_anterior'] . "</td>";
								echo "<td>" . $lLog['valor_actual'] . "</td>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	 </form>
 	</body>
 </html>
