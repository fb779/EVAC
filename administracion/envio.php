<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$page='envio';
	$vig=$_SESSION['vigencia'];
	$envioOK = false; $reenv = false;
	$anterior = $vig-1;
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	//$qControl = $conn->query("SELECT * FROM control WHERE nordemp = $numero AND vigencia = $vig");
	
	
// 	foreach($qControl AS $rowCtl) {
// 		$m1 = $rowCtl['m1'];
// // 		$m2 = $rowCtl['m2'];
// // 		$m3 = $rowCtl['m3'];
// // 		$m4 = $rowCtl['m4'];
// // 		$m5 = $rowCtl['m5'];
// // 		$m6 = $rowCtl['m6'];
// 	}
	
// 	if ($region == 99) {
// 		$envioOK = true;
// 	} else {
// 		//if ($tipousu == "FU" AND $m1+$m2+$m3+$m4+$m5+$m6 == 12) {
// 		if ($tipousu == "FU" AND $m1 == 2) {
// 			$envioOK = true;
// 		}
// 		else {
// // 			if ($tipousu == "CR" AND $m1+$m2+$m3+$m4+$m5+$m6 == 18) {
// 			if ($tipousu == "CR" AND $m1 == 3) {
// 				$envioOK = true;
// 			}
// 		}
// 	}
	$qControl = $conn->query("SELECT * FROM control WHERE nordemp = $numero AND vigencia = $vig")->fetch(PDO::FETCH_ASSOC);
	$m1 = $qControl['m1'];
	$est = $qControl['estado'];
	if ($region == 99) {
		$envioOK = true;
	} else if ($tipousu == "FU" AND $m1 == 2) { //if ($tipousu == "FU" AND $m1+$m2+$m3+$m4+$m5+$m6 == 12) {
		$envioOK = true;
	}  else if ($tipousu == "CR" AND $m1 == 3) { //if ($tipousu == "CR" AND $m1+$m2+$m3+$m4+$m5+$m6 == 18) {
		$envioOK = true;
	}
	
	$qDevol = $conn->query("SELECT * FROM devoluciones WHERE nordemp = $numero AND vigencia = $vig");
	if ($qDevol->rowCount() > 0) {
		$reenv = true;
	}
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
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<script type="text/javascript">
			$(function() {
				$("#envio").submit(function(event) {
					event.preventDefault();

		            $.ajax({
		                url: "../persistencia/grabactl.php",
		                type: "POST",
		                data: {envio: "envfor", numero: $("#idnumero").val()},
		                success: function(dato) {
							$("#enviof").text("Form. Enviado");
							$("#enviof").prop("disabled", true);
							$("#idpdf").show();
		                }
		            });
		         });
			});
			
			$(function() {
				$("#reenvio").click(function(event) {
					event.preventDefault();

		            $.ajax({
		                url: "../persistencia/grabactl.php",
		                type: "POST",
		                data: {reenv: "envfor", numero: $("#idnumero").val()},
		                success: function(dato) {
		                	$("#reenvio").text("Form. Reenviado");
							$("#reenvio").prop("disabled", true);
							//$("#cntreenv").css("display", "none");
		                }
		            });
		         });
			});
			
			$(function() {
				$("#devolver").submit(function(event) {
					event.preventDefault();

		            $.ajax({
		                url: "../persistencia/grabactl.php",
		                type: "POST",
		                data: {devol: "devfor", numero: $("#idnumero").val(), observa: $("#iddev").val()},
		                success: function(dato) {
		                	$("#btndev").text("Form. Devuelto");
							$("#btndev").attr("disabled", true);
							$("#btnacep").prop("disabled", true);
							$("#cntdev").css("display", "none");
		                }
		            });
		         });
			});
			
			$(function() {
				$("#btndev").click(function() {
					$("#cntdev").show();
				});
			});
			
			$(function() {
				$("#btnreenv").click(function() {
					$("#cntreenv").show();
				});
			});

			$(function() {
				$("#btnacep").click(function() {
					$("#btnacep").text("Form. Aceptado");
					$("#btndev").prop("disabled", true);
					$("#btnacep").prop("disabled", true);
				});
			});
		</script>
	</head>
	<body>
		<div class="well well-sm text-center" style="font-weight: bold; padding-top: 60px">
			<div class="col-xs-12">
				<?php //print_r($rowCtl);?>
				</br>
				<?php print_r($_SESSION);?>
			</div>
 			<?php echo $numero . " - " . $nombre ?> - ENVIO DE INFORMACIÓN
 			<a href="../index.php" class='pull-right'>Finalizar Sesi&oacute;n <span class="sr-only">(current)</span></a>
 		</div>
		<div class="container">
			<form role='form' data-toggle='validator' id="envio" method="post">
				<input type="hidden" name="numero" id="idnumero" value="<?php echo $numero ?>" />
				<div class="container text-center">
					<?php
						if ($region != 99) {
							if ($envioOK) {
								if (!$reenv) {
									echo "FORMULARIO FINALIZADO PUEDE REALIZAR EL ENV&Iacute;O DE INFORMACI&Oacute;N";
									echo "<div class='form-group' style='padding-top: 60px'>";
									echo "<button type='submit' class='btn btn-primary btn-lg' id='enviof'>ENVIAR FORMULARIO</button>";
									echo "&nbsp;";
									if ($tipousu == "FU") {
										echo "<a href='../interface/caratula.php?numero=" . $numero . "' class='btn btn-default btn-lg' data-toggle='tooltip' title='Regresar al formulario'>Volver</a>";
									}
									else {
										echo "<a href='../administracion/operativo.php' class='btn btn-default btn-lg' data-toggle='tooltip' title='Volver a Inicio'>Volver</a>";
									}
									echo "</div>";
									echo "<div class='form-group' style='padding-top: 20px'>";
									echo "<a style='display: none' id='idpdf' href='../interface/formDili.php?numord=" . $numero . "&nombre=" . $nombre . "' class='btn btn-default btn-lg' data-toggle='tooltip' title='Descargar formulario diligenciado'>Descargar formulario</a>";
									echo "</div>";
								}
								else {
									echo "FORMULARIO FINALIZADO PUEDE REALIZAR EL ENV&Iacute;O DE INFORMACI&Oacute;N";
									echo "<div class='form-group' style='padding-top: 60px'>";
									echo "<button type='button' id='reenvio' class='btn btn-primary btn-lg'>REENVIAR FORMULARIO</button>";
									echo "&nbsp;";
									echo "<a href='../administracion/operativo.php' class='btn btn-default btn-lg' data-toggle='tooltip' title='Volver a Inicio'>Volver</a>";
									echo "</div>";
									echo "<div class='row' style='color: #F00'>NO olvide registrar las observaciones en los respectivos cap�tulos</div>";
								}
							}
							else {
								echo "EXISTEN CAP&Iacute;TULOS SIN TERMINAR DEBE TERMINARLOS PARA REALIZAR EL ENV&Iacute;O DE INFORMACI&Oacute;N";
								echo "<div class='form-group' style='padding-top: 60px'>";
								echo "<a href='../interface/capitulo1.php?numord=$numero&nombre=$nombre' class='btn btn-primary btn-lg'>VOLVER AL FORMULARIO</a>";
								echo "</div>";
							}
						}
						else {
							echo "FORMULARIO FINALIZADO";
							echo "<div class='form-group' style='padding-top: 60px'>";
							echo "<a href='#' class='btn btn-danger btn-md' id='btndev'>DEVOLVER FORMULARIO</a>";
							echo "&nbsp;&nbsp;&nbsp;&nbsp;";
							echo "<button type='submit' class='btn btn-primary btn-md' id='btnacep'>ACEPTAR FORMULARIO</button>";
							echo "<a href='../administracion/operativo.php' class='btn btn-default btn-lg' data-toggle='tooltip' title='Volver a Inicio'>Volver</a>";
							echo "</div>";
						}
					?>
				</div>
			</form>
		</div>
		<div class="container container-offset-1" style="display: none" id="cntdev">
			<form role='form' data-toggle='validator' id="devolver" method="post">
				<input type="hidden" name="numero" id="idnumero" value="<?php echo $numero ?>" />
				<fieldset class="form-group">
					<label class='control-label' for='iddev'>Observaci&oacute;n:</label>
					<textarea class='form-control' rows='3' style='width: 90%' id='iddev' name='observa' required></textarea>
					<button type='submit' class='btn btn-danger btn-md text-center'>CONFIRMA DEVOLUCI&Oacute;N</button>
				</fieldset>
			</form>
		</div>
<!--		
		<div class="container container-offset-1" style="display: none" id="cntreenv">
			<form role='form' data-toggle='validator' id="reenvio" method="post">
				<input type="hidden" name="numero" id="idnumero" value="<?php echo $numero ?>" />
				<fieldset class="form-group">
					<label class='control-label' for='idrev'>Observaci&oacute;n:</label>
					<textarea class='form-control' rows='3' style='width: 90%' id='idrev' name='observa' required></textarea>
					<button type='submit' class='btn btn-danger btn-md text-center'>CONFIRMA REENVIO</button>
				</fieldset>
			</form>
		</div>
-->		
 	</body>
 </html> 
