<?php
	if(session_id() == "") {
		session_start();
	}
	$mensaje = "";
	if (!isset($_SESSION['tipou'])) {
		echo "<h2 style='text-align: center; font-family: arial'>SESI�N HA FINALIZADO. DEBE AUTENTICARSE DE NUEVO</h2>";
		return;
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$id_usu = $_SESSION['idusu'];
	$tipousu = $_SESSION['tipou'];
	$nombre = $_SESSION['nombreu'];
	$region = $_SESSION['region'];
	$pagina = "ADMINISTRACI&Oacute;N USUARIOS";
	
	if ($region != 99) {
		$campoUsuario = "b.usuarioss";
	}
	else {
		$campoUsuario = "b.usuario";
	}
	
	if ($region != 99) {
		$qUsuario = $conn->prepare("SELECT a.ident, a.nombre, CASE a.tipo WHEN 'CO' THEN 'Coordinador' WHEN 'AT' THEN 'Asistente T&eacute;cnico' WHEN 'CR' THEN 'Cr&iacute;tico' 
			WHEN 'TE' THEN 'Tem�tico' END AS nivel, COUNT( $campoUsuario) AS fuentes FROM usuarios a LEFT OUTER JOIN control b ON a.ident = $campoUsuario
			WHERE a.region = :idRegion AND a.tipo != 'FU' GROUP BY a.ident");
		$qUsuario->execute(array(':idRegion'=>$region));
	}
	else {
		$qUsuario = $conn->prepare("SELECT a.ident, a.nombre, CASE a.tipo WHEN 'CO' THEN 'Coordinador' WHEN 'AT' THEN 'Asistente T&eacute;cnico' WHEN 'CR' THEN 'Cr&iacute;tico' 
			WHEN 'TE' THEN 'Tem�tico' END AS nivel, COUNT( $campoUsuario) AS fuentes FROM usuarios a LEFT OUTER JOIN control b ON a.ident = $campoUsuario
			WHERE a.tipo != 'FU' GROUP BY a.ident");
		$qUsuario->execute();
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
		<title>Encuesta de Desarrollo e Innovaci�n Tecnol�gica - Formulario Electr�nico</title>
		<link href="../bootstrap/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<!-- Bootstrap -->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../bootstrap/css/custom.css" rel="stylesheet">
		<link href="../bootstrap/css/sticky-footer.css" rel="stylesheet">
		<link href="../bootstrap/css/bootstrap-dialog.css" rel="stylesheet">		
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<script type="text/javascript" src="../js/bootstrap-dialog.min.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<script type="text/javascript">
			function confirmar(id, nombre) {
				BootstrapDialog.show({
					type: BootstrapDialog.TYPE_WARNING,
					title: 'Eliminar Usuario',
					message: id+' - '+nombre,
					buttons: [{
						label: 'Confirmar',
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
			<div class="container" style="padding-top: 80px">
				<div class="col-md-8 col-md-offset-2">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="musuarios.php?accion=AD">Crear Usuario</a></li>
						<?php if ($region == 99) { ?>
						<li><a href="#" onClick='generaClave();'>Generar Claves</a></li>
						<li><a href="xlsCOCR.php">Descargar CO/CR</a></li>
						<li><a href="xlsFtes.php">Descargar Fuentes</a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="col-md-8 col-md-offset-2">
					<table class='table table-condensed table-hover table-bordered'>
						<thead>
							<tr>
								<th class="text-center">Ident.</th>
								<th class="text-center">Nombre</th>
								<th class="text-center">Nivel</th>
								<th class="text-center">Fuentes</th>
								<th class="text-center">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sec = 1;
								while ($row = $qUsuario->fetch(PDO::FETCH_ASSOC)) {
									echo "<tr><td>" . $row['ident'] . "</td>";
									echo "<td>" . $row['nombre'] . "</td>";
									echo "<td>" . $row['nivel'] . "</td>";
									
									if($row['fuentes']==0){
										echo "<td class='text-center'>" . $row['fuentes'] . "</td>";
									}else{	
										echo "<td class='text-center'><a href='verFuentesAsignadas.php?ident=".$row['ident']. "&accion=MOD' data-toggle='tooltip' title='Ver fuentes asignadas'>". $row['fuentes'] ."</a></td>";
									}
									echo "<td ><a href='musuarios.php?ident=" . $row['ident'] . "&accion=MOD' data-toggle='tooltip' title='Modificar Usuario'><span class='glyphicon glyphicon-pencil'></span></a></td>";
									echo "<td><a href='#' id='" . $row['ident'] . "' data-toggle='tooltip' title='Eliminar Usuario' onClick='confirmar(this.id,\"" . $row['nombre'] . "\");'><span class='glyphicon glyphicon-remove' style='color: red'></span></a></td>";
									if (substr($row['ident'], 0, 2) == "CR") {
										echo "<td><a href='asignar.php?ident=" . $row['ident'] . "&nombre=" . $row['nombre'] . "' data-toggle='tooltip' title='Asignar Fuentes'><span class='glyphicon glyphicon-link'></span></a></td></tr>";
									}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
 	</body>
 </html> 
