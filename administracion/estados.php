<?php
	if(session_id() == "") {
		session_start();
	}
	
	$mensaje = "";
	if (!isset($_SESSION['tipou'])) {
		echo "<h2 style='text-align: center; font-family: arial'>SESI&Oacute;N HA FINALIZADO. DEBE AUTENTICARSE DE NUEVO</h2>";
		return;
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$numero = $_GET['numero'];
	$pagina = "CAMBIO DE ESTADO";
	
	$qCtl = $conn->query("SELECT a.nordemp, b.nombre, c.desc_estado FROM control a, caratula b, estados c WHERE a.nordemp = $numero AND
		a.nordemp = b.nordemp AND a.estado = c.idestados");
	foreach ($qCtl AS $lCtl) {
		$a=1;
	}
	
	$qEstados = $conn->query("SELECT * FROM estados ORDER BY idestados");
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
		<link href="../bootstrap/css/bootstrap-dialog.css" rel="stylesheet">		
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<script type="text/javascript" src="../js/bootstrap-dialog.min.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<script type="text/javascript">
			$(function() {
	            $("#estados").submit(function(event) {
	                event.preventDefault();
	
	                $.ajax({
	                    url: "../persistencia/opFormulario.php",
	                    type: "POST",
	                    data: {accion: "cestado", numero: $("#numero").val(), nvoestado: $("#listaestados").val()},
	                    success: function(dato) {
	                    	$("#idcambio").text("Estado modificado");
							$("#idcambio").prop("disabled", true);
						}
					});
				});
			});
		</script>
	</head>
	<body>
		<?php 
			include 'menuRet.php';
		?>
			<div class="container" style="padding-top: 80px">
				<form role='form' id="estados">
					<input type="hidden" name="numero" id="numero" value="<?php echo $numero ?>" />
					<p>Cambiar Estado: <?php echo "<b>  " . $lCtl['nordemp'] . " - " . $lCtl['nombre'] . "</b>"?></p>
					<p>Estado Actual: <?php echo "<b>  " . $lCtl['desc_estado'] . "</b>"?></p>
					<fieldset>
						<div class='form-group form-group-sm'>
							<div class='col-sm-2 small text-right'>
								<label class='control-label' for='listareg'>Cambiar a:</label>
							</div>
							<div class='col-sm-5 small'>
								<select class='form-control' id='listaestados' name = 'nvoestado'>
									<option value='0'>Seleccione estado...</option>";
									<?php
										foreach($qEstados AS $lEstados) {
											echo "<option value='" . $lEstados['idestados'] . "'>" . $lEstados['desc_estado'] . "</option>";
										} 
									?>
								</select>
							</div>
						</div>
					</fieldset>
					<div class='form-group form-group-sm'>
						<div class='col-sm-1 small'>
							<button type='submit' class='btn btn-primary btn-md' id = 'idcambio'>Confirma Cambio</button>
						</div>
					</div>
				</form>
			</div>
 	</body>
 </html> 
