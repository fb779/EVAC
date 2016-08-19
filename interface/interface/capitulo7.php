<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$page='cap7';
	$vig=$_SESSION['vigencia'];
	$tabla = 'capitulo_vii';
	$grabaOK = false; $estado6="";
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	include '../persistencia/cargaDato.php';
	$tiempo = array("Seleccione..."=>0,"Un día"=>1, "Tres días"=>2, "Cinco días"=>3, "Siete o más días"=>4);
	if ($tipousu == "FU") {
		$grabaOK = true;
	}
	if ($row['VIIR6C7'] == 1) {
		$estado6 = "disabled";
	}
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
		<link href="../js/anytime.5.1.2.css" rel="stylesheet">
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/cargaDato.js"></script>
		<script type="text/javascript" src="../js/validaForm2.js"></script>
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<script type="text/javascript" src="../js/anytime.5.1.2.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<script type="text/javascript">
			$(function() {
				$("#capitulo7").submit(function(event) {
					event.preventDefault();
					$.ajax({
						url: "../persistencia/grabacapi.php",
						type: "POST",
						data: $(this).serialize(),
						success: function(dato) {
							$("#idmsg").show();
							$(function() {
								$.ajax({
									url: "../persistencia/grabactl.php",
									type: "POST",
									data: {modulo: "m7", estado: "1", numero: $("#numero").val(), capitulo: "C7"},
									success: function(dato) {
									}
								});
							});
						}
					});
				});
			});
			
			$(document).ready(function(){
    			$('[data-toggle="tooltip"]').tooltip();   
			});
			$(function() {
				$("#wc7").affix({
					offset: {top: 10}
				});
			});
			
			$(document).ready(function(){
				$('[data-toggle="popover"]').popover();
			});
			$(document).ready(function() {
				$("#idviir2c1").AnyTime_picker(
					{ format: "%H:%i", labelTitle: "TIEMPO",
					labelHour: "Hora", labelMinute: "Minuto"
				});
			});
			
			$(function() {
				$("#idviir6c1,#idviir6c2,#idviir6c3,#idviir6c4,#idviir6c5,#idviir6c6").click(function() {
					if ($(this).prop('checked') == true) {
						$("#idviir6c7").attr('disabled', 'disabled');
					}
					else {
						var activar = true;
						$("#idviir6c1,#idviir6c2,#idviir6c3,#idviir6c4,#idviir6c5,#idviir6c6").each(function() {
							if ($(this).prop('checked') == true) {
								activar = false;
							}
						});
						if (activar) {
							$("#idviir6c7").removeAttr('disabled');
						}
					}
				}); 
			});
			
			$(function() {
				$("#idviir6c7").click(function() {
					if ($(this).prop('checked') == true) {
						$("#idviir6c1,#idviir6c2,#idviir6c3,#idviir6c4,#idviir6c5,#idviir6c6").attr('disabled', 'disabled');
						$("#idviir6c1,#idviir6c2,#idviir6c3,#idviir6c4,#idviir6c5,#idviir6c6").prop('checked', false);
					}
					else {
						$("#idviir6c1,#idviir6c2,#idviir6c3,#idviir6c4,#idviir6c5,#idviir6c6").removeAttr('disabled');
					}
				});
			}); 
		</script>
	</head>
	<body>
		<?php
			include 'menuFuente.php';
		?>
		<div class="well well-sm" style="font-size: 12px; padding-top: 60px; z-index: 1;" id="wc7">
 			<?php echo $numero . "-" . $nombre?> - EVALUACI&Oacute;N AL INSTRUMENTO DE RECOLECCI&Oacute;N ENCUESTA DE DESARROLLO E INNOVACI&Oacute;N TECNOL&Oacute;GICA
 		</div>
 		<form class='form-horizontal' role='form' data-toggle='validator' name="capitulo7" id="capitulo7" method="post">
			<div class='container'>
				<input type="hidden" name="C7_nordemp" id="numero" value="<?php echo $numero ?>" />
				<fieldset style='border-style: solid; border-width: 1px; padding-top: 10px'>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>1. </b>Despu&eacute;s de conocer el cuestionario y los manuales. &iquest;Cu&aacute;nto tiempo invirti&oacute; en conseguir la informaci&oacute;n requerida?.
						</div>
						<div class='col-sm-3 small'>
							<select class='form-control' id='idviir1c1' name = 'viir1c1'>
								<?php
									foreach ($tiempo AS $desc=>$valor) {
										if ($row['VIIR1C1'] == $valor) {
											echo "<option value='" . $valor . "' selected>" . $desc . "</option>";
										}
										else {
											echo "<option value='" . $valor . "'>" . $desc . "</option>";
										}
									}
								?>
							</select>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px; padding-top: 10px'>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>2. </b>Despu&eacute;s de obtenida la informaci&oacute;n. &iquest;Cu&aacute;nto tiempo (horas/hombre) utilizo en diligenciar el cuestionario?
						</div>
						<div class='col-sm-2 small time'>
							<div class='input-group input-append time' id='idTiempo'>
								<input type="text" class="form-control" name="viir2c1" id="idviir2c1" value="<?php echo $row['VIIR2C1'] ?>" />
								<span class="input-group-addon add-on"><span class="glyphicon glyphicon-time"></span></span>
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px; padding-top: 10px'>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>3. </b>Se&ntilde;ale el grado de ayuda que prestaron los Manuales de Diligenciamiento y de Conceptos B&aacute;sicos,
								en el momento en que se presentaron dudas o confusiones al responder las preguntas del cuestionario, siendo 5 el nivel m&aacute;s alto y 1 el nivel m&aacute;s bajo.
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idviir3c1' name='viir3c1' value = '1' <?php echo ($row['VIIR3C1'] == 1) ? 'checked' : ''?> />1</label>
							<label class='radio-inline'><input type='radio' id='idviir3c12' name='viir3c1' value = '2' <?php echo ($row['VIIR3C1'] == 2) ? 'checked' : ''?> />2</label>
							<label class='radio-inline'><input type='radio' id='idviir3c13' name='viir3c1' value = '3' <?php echo ($row['VIIR3C1'] == 3) ? 'checked' : ''?> />3</label>
							<label class='radio-inline'><input type='radio' id='idviir3c14' name='viir3c1' value = '4' <?php echo ($row['VIIR3C1'] == 4) ? 'checked' : ''?> />4</label>
							<label class='radio-inline'><input type='radio' id='idviir3c15' name='viir3c1' value = '5' <?php echo ($row['VIIR3C1'] == 5) ? 'checked' : ''?> />5</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px; padding-top: 10px'>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>4. </b>&iquest;Considera usted que el formulario dise&ntilde;ado para la encuesta cumple con los objetivos de dar a
								conocer las tendencias relacionadas con los procesos innovadores que podr&iacute;a emprender o est&aacute;
								realizando su empresa?, Se&ntilde;ale siendo 5 el nivel m&aacute;s alto y 1 el nivel m&aacute;s bajo.
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idviir4c1' name='viir4c1' value = '1' <?php echo ($row['VIIR4C1'] == 1) ? 'checked' : ''?> />1</label>
							<label class='radio-inline'><input type='radio' id='idviir4c12' name='viir4c1' value = '2' <?php echo ($row['VIIR4C1'] == 2) ? 'checked' : ''?> />2</label>
							<label class='radio-inline'><input type='radio' id='idviir4c13' name='viir4c1' value = '3' <?php echo ($row['VIIR4C1'] == 3) ? 'checked' : ''?> />3</label>
							<label class='radio-inline'><input type='radio' id='idviir4c14' name='viir4c1' value = '4' <?php echo ($row['VIIR4C1'] == 4) ? 'checked' : ''?> />4</label>
							<label class='radio-inline'><input type='radio' id='idviir4c15' name='viir4c1' value = '5' <?php echo ($row['VIIR4C1'] == 5) ? 'checked' : ''?> />5</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px; padding-top: 10px'>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>5. </b>&iquest;Las preguntas planteadas en el formulario se entienden claramente? Se&ntilde;ale siendo 5 el nivel m&aacute;s alto y 1 el nivel m&aacute;s bajo.
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idviir5c1' name='viir5c1' value = '1' <?php echo ($row['VIIR5C1'] == 1) ? 'checked' : ''?> />1</label>
							<label class='radio-inline'><input type='radio' id='idviir5c12' name='viir5c1' value = '2' <?php echo ($row['VIIR5C1'] == 2) ? 'checked' : ''?> />2</label>
							<label class='radio-inline'><input type='radio' id='idviir5c13' name='viir5c1' value = '3' <?php echo ($row['VIIR5C1'] == 3) ? 'checked' : ''?> />3</label>
							<label class='radio-inline'><input type='radio' id='idviir5c14' name='viir5c1' value = '4' <?php echo ($row['VIIR5C1'] == 4) ? 'checked' : ''?> />4</label>
							<label class='radio-inline'><input type='radio' id='idviir5c15' name='viir5c1' value = '5' <?php echo ($row['VIIR5C1'] == 5) ? 'checked' : ''?> />5</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px; padding-top: 10px'>
					<legend><h5 style='font-family: arial'><b><b>6. </b>Cual (es) tema (s) planteado (s) en el formulario genero m&aacute;s
						dificultad al momento de obtener la informaci&oacute;n?</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>a. </b>Innovaci&oacute;n y su impacto en la empresa
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idviir6c1' name='viir6c1' value='1' <?php echo ($row['VIIR6C1'] == 1) ? 'checked' : ''?> <?php echo $estado6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>b. </b>Inversi&oacute;n en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n.
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idviir6c2' name='viir6c2' value='1' <?php echo ($row['VIIR6C2'] == 1) ? 'checked' : ''?> <?php echo $estado6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>c. </b>Financiamiento de las actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idviir6c3' name='viir6c3' value='1' <?php echo ($row['VIIR6C3'] == 1) ? 'checked' : ''?> <?php echo $estado6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>d. </b>Personal ocupado por la empresa y personal involucrado en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idviir6c4' name='viir6c4' value='1' <?php echo ($row['VIIR6C4'] == 1) ? 'checked' : ''?> <?php echo $estado6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>e. </b>Relaciones con actores del sistema nacional de ciencia, tecnolog&iacute;a e innovaci&oacute;n y cooperaci&oacute;n para la innovaci&oacute;n
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idviir6c5' name='viir6c5' value='1' <?php echo ($row['VIIR6C5'] == 1) ? 'checked' : ''?> <?php echo $estado6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>f. </b>Propiedad intelectual, certificaciones de calidad, normas t&eacute;cnicas y reglamentos t&eacute;cnicos
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idviir6c6' name='viir6c6' value='1' <?php echo ($row['VIIR6C6'] == 1) ? 'checked' : ''?> <?php echo $estado6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>g. </b>Ningun tema le presento dificultad
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idviir6c7' name='viir6c7' value='1' <?php echo ($row['VIIR6C7'] == 1) ? 'checked' : ''?> />
						</div>
					</div>
				</fieldset>
			</div>
			<?php if ($grabaOK) { ?>
				<div class='form-group form-group-sm'>
					<div class='col-md-8'>
						<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Evaluaci&oacute;n de la Encuesta actualizada correctamente</p>
					</div>
					<div class='col-sm-1 small pull-right'>
						<button type='submit' class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar Evaluaci&oacute;n Encuesta'>Grabar</button>
					</div>
				</div>
			<?php } ?>
 		</form>
 	</body>
 </html> 
