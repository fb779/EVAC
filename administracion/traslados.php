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
	$pagina = "TRASLADO DE SEDE";
	
	$qCaratula = $conn->prepare("SELECT a.nordemp, a.regional, a.nombre, b.nombre AS nomsede FROM caratula a, regionales b WHERE a.nordemp= :idNumero AND a.regional = b.codis");
	$qCaratula->execute(array(':idNumero'=>$numero));
	$row = $qCaratula->fetch(PDO::FETCH_ASSOC);
	$codSede = $row['regional'];
	
	$qSedes = $conn->query("SELECT codis, nombre FROM regionales WHERE codis != $codSede");
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
	            $("#traslado").submit(function(event) {
	                event.preventDefault();
	
	                $.ajax({
	                    url: "../persistencia/opFormulario.php",
	                    type: "POST",
	                    data: {accion: "traslado", numero: $("#numero").val(), sede: $("#listareg").val()},
	                    success: function(dato) {
							alert(dato);
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
				<form role='form' id="traslado">
					<input type="hidden" name="numero" id="numero" value="<?php echo $numero ?>" />
					<p>Traslado de fuente: <?php echo "<b>  " . $row['nordemp'] . " - " . $row['nombre'] . "</b>"?></p>
					<p>Sede actual: <?php echo "<b>  " . $row['nomsede'] . "</b>"?></p>
					<fieldset>
						<div class='form-group form-group-sm'>
							<div class='col-sm-2 small text-right'>
								<label class='control-label' for='listareg'>Trasladar a:</label>
							</div>
							<div class='col-sm-5 small'>
								<select class='form-control' id='listareg' name = 'sede'>
									<option value='0'>Seleccione una sede...</option>";
									<?php
										foreach($qSedes AS $lSedes) {
											echo "<option value='" . $lSedes['codis'] . "'>" . $lSedes['nombre'] . "</option>";
										} 
									?>
								</select>
							</div>
						</div>
					</fieldset>
					<div class='form-group form-group-sm'>
						<div class='col-sm-1 small'>
							<button type='submit' class='btn btn-primary btn-md'>Confirma Traslado</button>
						</div>
					</div>
				</form>
			</div>
 	</body>
 </html> 
