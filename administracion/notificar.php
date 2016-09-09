<?php
	 if (session_id() == "") {
		session_start();
	 }

	$ident_usu = $_SESSION['idusu'];
	$region = $_SESSION['region'];
	$nombre = $_SESSION['nombreu'];
	$pagina = "REPORTE NOTIFICACIONES";
	$vig = $_SESSION['vigencia'];

	include '../conecta.php';

	if ($region == 99) {
		$qCorreo = $conn->query("SELECT COUNT(CASE WHEN envcorr = 0 THEN 1 END) AS pendientes,
			COUNT(CASE WHEN envcorr = 1 THEN 1 END) AS enviados,
			COUNT(CASE WHEN envcorr = 2 THEN 1 END) AS errados,
			COUNT(CASE WHEN envcorr = 1 AND vericorr = 0 THEN 1 END) AS sinveri,
			COUNT(CASE WHEN envcorr = 1 AND vericorr = 1 THEN 1 END) AS verificados FROM caratula WHERE activa = 1");
	}
	else {
		$qCorreo = $conn->query("SELECT COUNT(CASE WHEN envcorr = 0 THEN 1 END) AS pendientes,
			COUNT(CASE WHEN envcorr = 1 THEN 1 END) AS enviados,
			COUNT(CASE WHEN envcorr = 2 THEN 1 END) AS errados,
			COUNT(CASE WHEN envcorr = 1 AND vericorr = 0 THEN 1 END) AS sinveri,
			COUNT(CASE WHEN envcorr = 1 AND vericorr = 1 THEN 1 END) AS verificados FROM caratula WHERE regional = $region AND activa = 1");
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
		<title> <?php echo $_SESSION['titulo'] . 'Reporte notificaciones'; ?> </title>
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
				$("button").click(function(event) {
					event.preventDefault();
					$.ajax({
						url: "../administracion/correos.php",
						type: "POST",
						success: function(dato) {
							alert(dato);
						}
					});
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
	<body>
		<div class='container' style='padding-top: 80px'>
			<div class="col-md-8 col-md-offset-2">
				<table class='table table-condensed table-hover table-bordered'>
					<thead>
						<tr>
							<th class="text-center">Estado</th>
							<th class="text-center">Cantidad</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($qCorreo AS $listaCorreo) {
								echo "<tr><td>Pendientes</td>";
								echo "<td class='text-right'>";
								if ($listaCorreo['pendientes'] == 0) {
									echo $listaCorreo['pendientes'] . "</td></tr>";
								}
								else {
									echo "<a href='listaCorreo.php?estadoEnv=0'>" . $listaCorreo['pendientes'] . "</a></td></tr>";
								}
								echo "<td>Enviados</td>";
								echo "<td class='text-right'>";
								if ($listaCorreo['enviados'] == 0) {
									echo $listaCorreo['enviados'] . "</td></tr>";
								}
								else {
									echo "<a href='listaCorreo.php?estadoEnv=1'>" . $listaCorreo['enviados'] . "</a></td></tr>";
								}
								echo "<td>Errados</td>";
								echo "<td class='text-right'>";
								if ($listaCorreo['errados'] == 0) {
									echo $listaCorreo['errados'] . "</td></tr>";
								}
								else {
									echo "<a href='listaCorreo.php?estadoEnv=2'>" . $listaCorreo['errados'] . "</a></td></tr>";
								}
								echo "<td>Sin Verificar</td>";
								echo "<td class='text-right'>";
								if ($listaCorreo['sinveri'] == 0) {
									echo $listaCorreo['sinveri'] . "</td></tr>";
								}
								else {
									echo "<a href='listaCorreo.php?estadoEnv=1&estadoVer=0'>" . $listaCorreo['sinveri'] . "</a></td></tr>";
								}
								echo "<td>Verificados</td>";
								echo "<td class='text-right'>";
								if ($listaCorreo['verificados'] == 0) {
									echo $listaCorreo['verificados'] . "</td></tr>";
								}
								else {
									echo "<a href='listaCorreo.php?estadoEnv=1&estadoVer=1'>" . $listaCorreo['verificados'] . "</a></td></tr>";
								}
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Usuario Actualizado</p>
				<div class='col-sm-1 small'>
					<button type='submit' class='btn btn-primary btn-md' data-toggle='tooltip' data-placement="right" title='Se envian correos a fuentes que resultaron errados en env&iacute;os anteriores y a fuentes sin verificar'>Enviar Correos</button>
				</div>
			</div>
		</div>
 	</body>
 </html>
