<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$nombre = $_SESSION['nombreu'];
	$caso=""; $condicion=""; $descripcion=""; $tablas="";
	$pagina = "MANTENIMIENTO CASOS";
	if (isset($_GET['numcaso'])) {
		$numCaso = $_GET['numcaso'];
		$qCasos = $conn->query("SELECT * FROM casos WHERE caso = $numCaso");
		unset($_GET['numcaso']);
	}
	else {
		$qCasos = $conn->query("SELECT * FROM casos LIMIT 1");
	}
	
	if ($qCasos->rowCount() > 0) {
		foreach($qCasos AS $rowCasos) {
			$caso = $rowCasos['caso'];
			$condicion = $rowCasos['condicion'];
			$descripcion = $rowCasos['descripcion'];
		}
		$modo = "MOD";
	}
	else {
		$modo = "ADIC";
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
		<title>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - Formulario Electr&oacute;nico</title>
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
				$("#idcasos").submit(function(event) {
					event.preventDefault();
					$.ajax({
		            	url: "../persistencia/grabarcasos.php",
		                type: "POST",
		                data: $(this).serialize(),
		                success: function(dato) {
		                	alert(dato);
		                }
					});
				});
			});
			
			$(function() {
				$("#idReset").click(function() {
					$("#idcaso,#idcond,#iddesc").val("");
					$("#idcond").focus();
				});
			});
		</script>
	</head>
	<body>
		<?php
			include 'menuRet.php';
		?>
		<div class="container" style='padding-top: 60px; text-align: right'>
			<div class="col-md-8 col-md-offset-2">
				<a href='listaCasos.php'>Consultar</a>
			</div>
			<div class='col-sm-1 small'>
				<a href='xlsHojaCasos.php' class='btn btn-primary btn-md' id="idxls" data-toggle='tooltip' title='Decargar Casos'>
					<span class = "glyphicon glyphicon-download-alt"></span>
				</a>
			</div>
		</div>
		</form>
		<form role='form' data-toggle='validator' name="formcasos" id="idcasos" style="padding-top:10px">
			<div class='container'>
				<div class="col-md-8 col-md-offset-2">
					<input type="hidden" name="modo" id="idmodo" value="<?php echo $modo ?>" />
					<input type="hidden" name="caso" id="idcaso" value="<?php echo $caso ?>" />
					<label class='control-label' for='idcaso'>Caso: <?php echo $caso ?></label>
					<fieldset>
						<label class='control-label' for='idcond'>Condici&oacute;n:</label>
						<input type='text' class='form-control input-sm' style="width: 90%;" id='idcond' name='condicion' data-error='Ingrese la condición del caso' value='<?php echo $condicion ?>' required />
					</fieldset>
					<fieldset class="form-group">
						<label class='control-label' for='iddesc'>Descripci&oacute;n:</label>
						<textarea class='form-control' rows='6' style='width: 90%' id='iddesc' name='descripcion' required><?php echo $descripcion ?></textarea>
					</fieldset>
					<div class='form-group form-group-sm'>
						<div class='col-md-6'>
							<a href='execCaso.php?caso=<?php echo $caso ?>' class='btn btn-primary btn-md' data-toggle='tooltip' title='Ejecutar Caso' id='btnexec'>Ejecutar</a>
						</div>
						<div class='col-sm-4 small' style='text-align: right'>
							<input type='submit' class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar Caso' value="Actualizar" />
						</div>
						<div class='col-sm-1 small'>
							<button type='button' class='btn btn-primary btn-md' id="idReset" data-toggle='tooltip' title='Adicionar Caso'>
								<span class = "glyphicon glyphicon-plus"></span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</body>
</html>