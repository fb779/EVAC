<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$id_usu = $_SESSION['idusu'];
	$tipousu = $_SESSION['tipou'];
	$nombre = $_SESSION['nombreu'];
	$region = $_SESSION['region'];
	$pagina = "ASIGNACI&Oacute;N DE FUENTES";
	$vig = $_SESSION['vigencia'];

	if(!isset($_REQUEST['ident'])){
		exit;
	}

	$usuario=$_REQUEST['ident'];

	// if ($region == 99){
	// 	$campoUsuario = 'usuario';
	// }else{
	// 	$campoUsuario = 'usuarioss';
	// }

	$sql_fuentes=$conn->prepare("SELECT a.nordemp, nombre, a.ciiu3  FROM control a, caratula b WHERE (usuario = '".$usuario."' OR usuarioss = '".$usuario."' ) AND a.nordemp = b.nordemp AND vigencia = $vig");
	//var_dump($sql_fuentes);
	$sql_fuentes->execute();

	//var_dump($sql_fuentes);
	 //exit;

	/*if ($region == 99) {
		$qActividad = $conn->prepare("SELECT a.ciiu3, b.descrip, COUNT( a.ciiu3 ) AS asignar FROM control a, ciiu3 b WHERE a.vigencia =:periodo AND
			usuario = ''  AND a.ciiu3 = b.codigo GROUP BY a.ciiu3");
		$qActividad->execute(array(':periodo'=>$vig));
	}
	else {
		$qActividad = $conn->prepare("SELECT a.ciiu3, b.descrip, COUNT( a.ciiu3 ) AS asignar FROM control a, ciiu3 b WHERE a.vigencia =:periodo AND
			usuarioss = ''  AND a.ciiu3 = b.codigo AND a.codsede = :region GROUP BY a.ciiu3");
			$qActividad->execute(array(':periodo'=>$vig, ':region'=>$region));
	}*/


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
		<script type="text/javascript" src="../js/asignar.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
		<script type="text/javascript">
			function confirmar(id, nombre) {
				BootstrapDialog.show({
					type: BootstrapDialog.TYPE_WARNING,
					title: 'Eliminar Fuente',
					message: id+' - '+nombre,
					buttons: [{
						label: 'Confirmar',
						// alert("borrar");
							action: function(borra) {
								$.ajax({
									url: "../persistencia/grabarusu.php",
									type: "POST",
									data: {borrar: "borrar", idBorrar: id},
									success: function(dato) {
										alert(dato);
										borra.setMessage(id+' - '+nombre+' ELIMINADO');
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

			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});

			function generaClave() {
				$.ajax({
					url: "genfuente.php",
					type: "POST",
					success: function(dato) {
						alert(dato);
					}
				});
			}
		</script>
	</head>
	<body>
		<?php
			include 'menuRet.php';
		?>
		<div class="container" style="padding-top:60px">
			<h4 class="text-center" style="font-family: arial">Eliminar Fuente</h4>
				<table class='table table-condensed table-hover table-bordered'>
				<th>
					N&uacute;mero de &oacute;rden
				</th>
				<th>
					Nombre
				</th>
				<th>
					C&oacute;digo actividad
				</th>
				<th>
					Eliminar
				</th>
				<?php
				    while ($rowFuentes = $sql_fuentes->fetch(PDO::FETCH_ASSOC)) {
						echo "<tr>";
							echo "<td>";
								echo $rowFuentes['nordemp'];
							echo "</td>";
							echo "<td>";
								echo $rowFuentes['nombre'];
							echo "</td>";
							echo "<td>";
								echo $rowFuentes['ciiu3'];
							echo "</td>";
							echo "<td>";
								echo "<a href='borrarFuente.php?nordemp=".$rowFuentes['nordemp']."&ususario=".$usuario." 'data-toggle='tooltip' title='Eliminar Fuente' onClick='confirmar(this.id,\"" . $usuario . "\");'><span class='glyphicon glyphicon-remove' style='color: red'></span></a>";
							echo "</td>";
						echo "</tr>";
						/*echo "<div class='row'>";
						echo "<div class='col-md-8' style='font-size: 12px'>";
						echo "<a href='#' id='l" . $rowFuentes['nordemp'] . "' onClick='detalleActi(this.id, \"" .  $_GET['ident']  . "\")'>" .  $rowFuentes['nordemp'] . " - " . $rowFuentes['nombre'] . "</a>";
						echo "</div>";
						echo "<div class='col-md-8' style='font-size: 12px'>";
						echo "<a href='#' id='l" . $rowFuentes['ciiu3'] . "' onClick='detalleActi(this.id, \"" .  $_GET['ident']  . "\")'>" .  $rowFuentes['ciiu3'] . " </a>";
						echo "</div>";
						echo "<div class='col-md-1'>";
						echo "<input type='text' class='form-control text-right' id='n" . $rowFuentes['ciiu3'] . "' value='0' />";
						echo "</div>";
						echo "<div class='col-md-3'>";
						echo "<button type='button' class='btn btn-default btn-sm' id='asigtot' onClick='asigftestot(this.id, " . $rowFuentes['ciiu3'] . ", \"" .  $rowFuentes['ciiu3'] . "\")';>Asignar</button>";
						echo "</div>";
						echo "</div>";
						echo "<div class='col-md-8 col-md-offset-1' style='height: 15%; overflow: auto; display: none' id='det" . $rowActividad['ciiu3']  . "'>";
						echo "</div>";*/
					}
				?>
				</table>
		</div>
 	</body>
 </html>
