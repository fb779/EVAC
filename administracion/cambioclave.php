<?php
	if (session_id() == "") {
		session_start();
	}
	ini_set('default_charset', 'UTF-8');
	include '../conecta.php';
	$region = $_SESSION['region'];
	$id_usu = $_SESSION['idusu'];
	$tipousu = $_SESSION['tipou'];
	$nombre = $_SESSION['nombreu'];
	$vig = $_SESSION['vigencia'];
	$pagina = "MANTENIMIENTO USUARIOS";
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
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();   
			});

			$(function() {
				$("#idcambio").submit(function(event) {
					event.preventDefault();
					$.ajax({
		                url: "../persistencia/grabarusu.php",
		                type: "POST",
		                data: {cambio: "cambio", idUsuario: $("#idident").val(), actual: $("#clact").val(), nueva: $("#nva").val(), confirma: $("#conf").val()},
		                success: function(dato) {
		                    alert(dato);
		                }
					});
				});
			});
		</script>
	</head>
	<body>
		<div class='well well-sm' style='font-size: 12px'>
			EDIT -SERVICIOS - Cambio de clave usuarios
		</div>
		<form class='form-horizontal' role='form' data-toggle='validator' name="cambio" id="idcambio" style="padding-top:75px">
			<input type="hidden" name="ident" id="idident" value="<?php echo $id_usu ?>" />
			<div class='container'>
				<div class="col-md-8 col-md-offset-2">
					<fieldset>
						<legend><h4 style='font-family: arial'>Cambio de Clave - <?php echo $nombre ?></h4></legend>
						<p>Ingrese su clave actual, luego ingrese la nueva clave, esta puede ser de hasta 16 caracteres. Puede combinar
						alfab&eacute;ticos, may&uacute;sculas, min&uacute;sculas, num&eacute;ricos y caracteres especiales. Luego ingrese
						la confirmaci&oacute;n de la nueva clave y de click en el bot&oacute;n Cambiar Clave.</p>
					</fieldset>
					<fieldset>
						<div class='form-group form-group-sm'>
							<div class='col-sm-2 small text-right'>
								<label class='control-label' for='clact'>Clave actual:</label>
							</div>
							<div class='col-sm-8 small'>
								<input type='password' class='form-control input-sm' id='clact' name='actual' value='' required />
							</div>
						</div>
					</fieldset>
					<fieldset>
						<div class='form-group form-group-sm'>
							<div class='col-sm-2 small text-right'>
								<label class='control-label' for='nva'>Nueva clave:</label>
							</div>
							<div class='col-sm-8 small'>
								<input type='password' class='form-control input-sm' id='nva' name='nueva' value='' required />
							</div>
						</div>
					</fieldset>
					<fieldset>
						<div class='form-group form-group-sm'>
							<div class='col-sm-2 small text-right'>
								<label class='control-label' for='conf'>Confirmaci&oacute;n:</label>
							</div>
							<div class='col-sm-8 small'>
								<input type='password' class='form-control input-sm' id='conf' name='confirma' value='' required />
							</div>
						</div>
					</fieldset>
					<div class='form-group form-group-sm'>
						<div class='col-sm-1 small'>
							<button type='submit' class='btn btn-primary btn-md'>Cambiar Clave</button>
						</div>
						<div class='col-sm-1 small'></div>
						<div class='col-sm-1 small'>
							<?php
								if ($tipousu == "FU") {
									echo "<a href='../interface/caratula.php' class='btn btn-default' data-toggle='tooltip' title='Volver al formulario'>Volver</a>";
								}
								else {
									echo "<a href='operativo.php' class='btn btn-default' data-toggle='tooltip' title='Volver al operativo'>Volver</a>";
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</form>
	</body>
</html>