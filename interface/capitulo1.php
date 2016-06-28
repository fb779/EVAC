<?php
	if (session_id() == "") {
		session_start();
	}
	ini_set('default_charset', 'UTF-8');
	include '../conecta.php';
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$page='cap1';
	$vig=$_SESSION['vigencia'];
	$estadObs = ($tipousu != "FU" ? "readonly" : "");
	
	$consLog = ($region == 99 ? true : false);
	
	$cLog = "<span class='glyphicon glyphicon-time' style='color: blue; font-size: 14px;'></span>";

	$anterior = $vig-1;
	$tabla = 'capitulo_i';
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	$grabaOK = false;
	include '../persistencia/cargaDato.php';
	
	$estadoI1R4C2N = ''; $estadoI1R4C2M = ''; $estadoI2 = ''; $estadoI7 = ''; $estadoI9R1 = 'disabled'; $estadoI9R2 = 'disabled';
	$estadoI10 = 'disabled';
	
	$estadoI4R1C1 = ''; $estadoI4R2C1 = ''; $estadoI4R3C1 = ''; $estadoI4R4C1 = ''; $estadoI4R1C2 = ''; $estadoI4R2C2 = ''; $estadoI4R3C2 = ''; $estadoI4R4C2 = '';
	
	if ($row['I1R1C2N']+$row['I1R2C2N']+$row['I1R3C2N'] == 0) {$estadoI1R4C2N = 'disabled';}
	if ($row['I1R1C2M']+$row['I1R2C2M']+$row['I1R3C2M'] == 0) {$estadoI1R4C2M = 'disabled';}
	if ($row['I1R1C1N']!=1 AND $row['I1R2C1N']!=1 AND $row['I1R3C1N']!=1 AND $row['I1R1C1M']!=1 AND $row['I1R2C1M']!=1 AND $row['I1R3C1M']!= 1 AND $row['I1R4C1']!=1 AND 
		$row['I1R5C1']!=1 AND $row['I1R6C1']!=1) {
		$estadoI2 = 'disabled';
	}
	if ($row['I1R1C1N']==1 OR $row['I1R2C1N']==1 OR $row['I1R3C1N']==1 OR $row['I1R1C1M']==1 OR $row['I1R2C1M']==1 OR 
		$row['I1R3C1M']==1 OR $row['I1R5C1']==1 OR $row['I1R6C1']==1 OR $row['I5R1C1']==1 OR $row['I6R1C1']==1) {
			$estadoI7 = 'disabled';
	}
	if ($row['I1R1C1N']!=1 AND $row['I1R2C1N']!=1 AND $row['I1R3C1N']!=1 AND $row['I1R1C1M']!=1 AND $row['I1R2C1M']!=1 AND 
		$row['I1R3C1M']!=1 AND $row['I1R5C1']!=1 AND $row['I1R6C1']!=1 AND $row['I5R1C1']!=1 AND $row['I6R1C1']!=1) {
			$estadoI7 = '';
	}
	//ESTADOS NUMERAL 4
	if ($row['I3R2C1']==0) {
		$estadoI4R4C1 = 'disabled'; $estadoI4R1C1 = 'disabled'; $estadoI4R2C1 = 'disabled'; $estadoI4R3C1 = 'disabled';
	}
	else {
		if (($row['I1R1C1N']!=1 AND $row['I1R1C1M']!=1)) {
			$estadoI4R1C1 = 'disabled';
		}
		if (($row['I1R2C1N']!=1 AND $row['I1R1C1M']!=1)) {
			$estadoI4R2C1 = 'disabled';
		}
	
		if (($row['I1R3C1N']!=1 AND $row['I1R3C1M']!=1)) {
			$estadoI4R3C1 = 'disabled';
		}
	}
	
	if ($row['I3R2C1']==0) {
		$estadoI4R4C1 = 'disabled';
	}
	
	if ($row['I3R2C2']==0) {
		$estadoI4R4C2 = 'disabled'; $estadoI4R1C2 = 'disabled'; $estadoI4R2C2 = 'disabled'; $estadoI4R3C2 = 'disabled';
	}
	else {
		if (($row['I1R1C1N']!=1 AND $row['I1R1C1M']!=1)) {
			$estadoI4R1C2 = 'disabled';
		}
		if (($row['I1R2C1N']!=1 AND $row['I1R1C1M']!=1)) {
			$estadoI4R2C2 = 'disabled';
		}
	
		if (($row['I1R3C1N']!=1 AND $row['I1R3C1M']!=1)) {
			$estadoI4R3C2 = 'disabled';
		}
	}
	
	if (($row['I1R1C1N']==1 OR $row['I1R2C1N']==1 OR $row['I1R3C1N']==1 OR $row['I1R1C1M']==1 OR $row['I1R2C1M']==1 OR 
		$row['I1R3C1M']==1) AND ($row['I8R1C1']==1)) {
		$estadoI9R1 = '';
	}
	if (($row['I1R1C1N']==1 OR $row['I1R2C1N']==1 OR $row['I1R3C1N']==1 OR $row['I1R1C1M']==1 OR $row['I1R2C1M']==1 OR 
		$row['I1R3C1M']==1) AND ($row['I8R2C1']==1)) {
			$estadoI9R2 = '';
	}
	if ($row['I1R1C1N']==1 OR $row['I1R2C1N']==1 OR $row['I1R3C1N']==1 OR $row['I1R1C1M']==1 OR $row['I1R2C1M']==1 OR 
		$row['I1R3C1M']==1 OR $row['I1R4C1']==1 OR $row['I1R5C1']==1 OR $row['I1R6C1']==1 OR $row['I5R1C1']==1 OR $row['I6R1C1']==1 OR $row['I7R1C1']==1) {
			$estadoI10 = '';
	}
	
	if ($tipousu != "FU") {
		$txtEstado = " - estado - " . $rowCtl['desc_estado'];
	}
	else {
		$txtEstado = "";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
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
		<script type="text/javascript" src="../js/cargaDato.js"></script>
	 	<script type="text/javascript" src="../js/valida1.js"></script>
		<script type="text/javascript" src="../js/validaForm1.js"></script>
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<style>
			.modal-width {
				width: 90%;
			}
			.textoB {
				font-weight: bold;
			}
		</style>
		<script type="text/javascript">
			var retorno = "";
			$(function() {
	            $("#capitulo1").submit(function(event) {
	                event.preventDefault();
	
	                $.ajax({
	                    url: "../persistencia/grabacapi.php",
	                    type: "POST",
	                    beforeSend:  validaForm1,
	                    data: $(this).serialize(),
	                    success: function(dato) {
							if (retorno=="") {
								$("#btn_cont").show();
								$("#idmsg").show();
								$(function() {
									$.ajax({
									url: "../persistencia/grabactl.php",
									type: "POST",
									data: {modulo: "m1", estado: "2", numero: $("#numero").val(), capitulo: "C1"},
									success: function(dato) {
									}
								});
								});
								if ($("#idTipo").val() == "CR") {
									$("#idObs1").modal('show');
								}
							}
							else {
								retorno = "id"+retorno;
								document.getElementById(retorno).focus();
								$(function() {
									$.ajax({
									url: "../persistencia/grabactl.php",
									type: "POST",
									data: {modulo: "m1", estado: "1", numero: $("#numero").val(), capitulo: "C1"},
									success: function(dato) {
									}
								});
								});
							}
						}
	                });
	            });
				});
	
			$(document).ready(function(){
	    		$('[data-toggle="tooltip"]').tooltip();   
			});

			$(function() {
				$("#idi4r1c1,#idi4r2c1,#idi4r3c1,#idi4r4c1,#idi4r1c2,#idi4r2c2,#idi4r3c2,#idi4r4c2").blur(function() {
					if ($(this).val()>100 || $(this).val()<0) {
						alert("Debe ingresar valor Mayor o igual a cero y Menor o igual a cien");
						$(this).focus();
					}
				});
			});
			
			$(function() {
				$("#idi1r1c2n,#idi1r2c2n,#idi1r3c2n,#idi1r4c2n,#idi1r1c2m,#idi1r2c2m,#idi1r3c2m,#idi1r4c2m,#idi1r4c2,#idi1r5c2,#idi1r6c2,#idi3r1c1,#idi3r1c2,#idi3r2c1,#idi3r2c2,#idi4r1c1,#idi4r1c2,#idi4r2c1,#idi4r2c2,#idi4r3c1,#idi4r3c2,#idi4r4c1,#idi4r4c2,#idi4r5c1,#idi4r5c2").keyup(function(){
					if ($(this).val() != "")
						$(this).val( $(this).val().replace(/[^0-9]/g, '') );
				});
			});

			$(function() {
				$("#idi1r1c2n,#idi1r2c2n,#idi1r3c2n,#idi1r4c2n,#idi1r1c2m,#idi1r2c2m,#idi1r3c2m,#idi1r4c2m,#idi1r4c2,#idi1r5c2,#idi1r6c2,#idi3r1c1,#idi3r1c2,#idi3r2c1,#idi3r2c2,#idi4r1c1,#idi4r1c2,#idi4r2c1,#idi4r2c2,#idi4r3c1,#idi4r3c2,#idi4r4c1,#idi4r4c2,#idi4r5c1,#idi4r5c2").blur(function(){
					if ($(this).val()!='') {
						$(this).val(parseInt($(this).val()));
					}
				});
			});

			$(function() {
				var desactiva = true;
				$("#idi1r1c1n2,#idi1r2c1n2,#idi1r3c1n2,#idi1r1c1m2,#idi1r2c1m2,#idi1r3c1m2,#idi1r4c12,#idi1r5c12,#idi1r6c12").click(function(){
					$("#idi1r1c1n,#idi1r2c1n,#idi1r3c1n,#idi1r1c1m,#idi1r2c1m,#idi1r3c1m,#idi1r4c1,#idi1r5c1,#idi1r6c1").each(function(){
						if ($(this).is(":checked")) {
							desactiva = false;
						}
					});
					if (desactiva) {
						$("#idi2r1c1,#idi2r1c12,#idi2r1c13,#idi2r2c1,#idi2r2c12,#idi2r2c13,#idi2r3c1,#idi2r3c12,#idi2r3c13,#idi2r4c1,#idi2r4c12,#idi2r4c13,#idi2r5c1,#idi2r5c12,#idi2r5c13,#idi2r6c1,#idi2r6c12,#idi2r6c13,#idi2r7c1,#idi2r7c12,#idi2r7c13,#idi2r8c1,#idi2r8c12,#idi2r8c13,#idi2r9c1,#idi2r9c12,#idi2r9c13,#idi2r10c1,#idi2r10c12,#idi2r10c13,#idi2r11c1,#idi2r11c12,#idi2r11c13,#idi2r12c1,#idi2r12c12,#idi2r12c13,#idi2r13c1,#idi2r13c12,#idi2r13c13,#idi2r14c1,#idi2r14c12,#idi2r14c13,#idi2r15c1,#idi2r15c12,#idi2r15c13").each(function() {
							$(this).prop("checked", false);
						});
						$("#i2").prop("disabled", true);
						$("#i7r1c1").prop("disabled", false);
					}
					desactiva = true;
				});
			});

			$(function() {
				$("#idi1r4c2n").blur(function() {
					var Total = 0;
					$("#idi1r1c2n,#idi1r2c2n,#idi1r3c2n").each(function() {
						if ($(this).is(":disabled")) {
							Total = parseInt(Total)+0;
						}
						else {
							Total = parseInt(Total)+parseInt($(this).val());
						}
					});
					if(parseInt(Total) != parseInt($("#idi1r4c2n").val())) {
						alert("TOTAL DIGITADO INVALIDO, POR FAVOR REVISE");
					}
				});
			});

			$(function() {
				$("#idi1r4c2m").blur(function() {
					var Total = 0;
					$("#idi1r1c2m,#idi1r2c2m,#idi1r3c2m").each(function() {
						if ($(this).is(":disabled")) {
							Total = Total+0;
						}
						else {
							Total = Total+parseInt($(this).val());
						}
					}); 
					if(Total != parseInt($("#idi1r4c2m").val())) {
						alert("TOTAL DIGITADO INVALIDO, POR FAVOR REVISE");
					}
				});
			});

			$(function() {
				$("#idi4r5c1").blur(function() {
					var Total = 0;
					$("#idi4r1c1,#idi4r2c1,#idi4r3c1,#idi4r4c1").each(function() {
						if ($(this).is(":disabled")) {
							Total = parseInt(Total)+0;
						}
						else {
							Total = parseInt(Total)+parseInt($(this).val());
						}
					});
					if(parseInt(Total) != parseInt($("#idi4r5c1").val())) {
						alert("TOTAL DIGITADO INVALIDO O DIFERENTE DE 100");
					}
				});
			});

			$(function() {
				$("#idi4r5c2").blur(function() {
					var Total = 0;
					$("#idi4r1c2,#idi4r2c2,#idi4r3c2,#idi4r4c2").each(function() {
						if ($(this).is(":disabled")) {
							Total = parseInt(Total)+0;
						}
						else {
							Total = parseInt(Total)+parseInt($(this).val());
						}
					});
					if(parseInt(Total) != parseInt($("#idi4r5c2").val())) {
						alert("TOTAL DIGITADO INVALIDO O DIFERENTE DE 100");
					}
				});
			});
			
			$(function() {
			var activar = false;
				$("#idi8r1c1").click(function() {
					$("#idi1r1c1n,#idi1r2c1n,#idi1r3c1n,#idi1r1c1m,#idi1r2c1m,#idi1r3c1m").each(function(){
						if ($(this).is(":checked")) {
							activar = true;
						}
					});
					if (activar) {
						$("#idi9r1c1, #idi9r1c12").prop("disabled", false);
					}
					activar = false;
				});
			});
			
			$(function() {
				$("#idi8r1c12").click(function() {
					$("#idi9r1c1, #idi9r1c12").prop("disabled", true);
					$("#idi9r1c1").prop("checked", false);
					$("#idi9r1c12").prop("checked", false);
				});
			});
			
			$(function() {
				var activar = false;
				$("#idi8r2c1").click(function() {
					$("#idi1r1c1n,#idi1r2c1n,#idi1r3c1n,#idi1r1c1m,#idi1r2c1m,#idi1r3c1m").each(function(){
						if ($(this).is(":checked")) {
							activar = true;
						}
					});
					if (activar) {
						$("#idi9r2c1, #idi9r2c12").prop("disabled", false);
					}
					activar = false;
				});
			});
			
			$(function() {
				$("#idi8r2c12").click(function() {
					$("#idi9r2c1, #idi9r2c12").prop("disabled", true);
					$("#idi9r2c1").prop("checked", false);
					$("#idi9r2c12").prop("checked", false);
				});
			});
			
			$(window).on('hidden.bs.modal', function() {
				$.ajax({
					url: "../persistencia/grabactl.php",
		               type: "POST",
		               data: {obser: "obs", numero: $("#numero").val(), capit: "1", observa: $("#obscrit").val()},
		               success: function(dato) {
					}
				});
			});
			
			$(function() {
				$("#wc1").affix({
					offset: {top: 10}
				});
			});
		</script>
	</head>
	<body>
		<?php
			include 'menuFuente.php';
/*			if ($tipousu != "FU") {
				echo "<script type='text/javascript'>";
				echo "$(function() {";
				echo "$(window).load(function(){";
			    echo "$('#avisoCrit').modal('show');";
			    echo "});});";
			    echo "</script>";
			}
*/			
		?>
		<div class="well well-sm" style="font-size: 12px; padding-top: 60px; z-index: 1;" id="wc1">
 			<?php echo $numero . "-" . $nombre?> - CAP&Iacute;TULO I - CARACTERIZAC&Oacute;N DE VACANTES ABIERTAS <?php echo $anterior . "-" . $vig . " " . $txtEstado ?>
 		</div>
 		<div class="container text-justify" style="font-size: 12px">
			Una innovaci&oacute;n se define en esta encuesta como un producto (servicio o bien) nuevo o significativamente mejorado
			introducido en el mercado, o un proceso nuevo o significativamente mejorado introducido en la empresa, o un m&eacute;todo
			organizativo nuevo introducido en la empresa, o una t&eacute;cnica de comercializaci&oacute;n nueva introducida en la empresa. 
 			<ul>
 				<li>Una innovaci&oacute;n es siempre nueva para la empresa. No es necesario que sea nueva en el mercado en el que la empresa opera.</li>
 				<li>Los cambios de naturaleza est&eacute;tica, y los cambios simples de organizaci&oacute;n o gesti&oacute;n no cuentan como innovaci&oacute;n.</li>
 				<li>Tanto los servicios como los bienes que la empresa introduce al mercado, son considerados como productos.
 					Los servicios, a diferencia de los bienes, suelen ser productos intangibles o dif&iacute;cilmente almacenables y
 					sus procesos de producci&oacute;n y comercializaci&oacute;n pueden darse de manera simult&aacute;nea.</li>
 				<li> El suministro de un servicio puede tener como complemento, o requerir como soporte, el suministro de un bien; y a la inversa.</li>   
 			</ul>
 			<b>&iquest;Quien deber&iacute;a responder este cap&iacute;tulo?:</b>&nbsp;Personas con conocimiento de primera mano de las
 				 actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que lleva a cabo la empresa 
 		</div>

		<input type="hidden" name="tipousu" id="idTipo" value="<?php echo $tipousu ?>" />
		<form class='form-horizontal' role='form' data-toggle='validator' name="capitulo1" id="capitulo1" method="post">
			<div class='container'>
				<input type="hidden" name="C1_nordemp" id="numero" value="<?php echo $numero ?>" />
				<fieldset style='border-style: solid; border-width: 1px' id='i1'>
					<legend><h5 style='font-family: arial'><b><?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=i1&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> I.1 Indique si durante el per&iacute;odo <?php echo $anterior . "-" . $vig?> su empresa introdujo alguna de las siguientes innovaciones. Si su respuesta es afirmativa especifique el n&uacute;mero.</b></h5></legend>
					<div class='container-fluid bg-warning small'>
						<b>Tenga en cuenta:</b> Un servicio o bien nuevo, es un producto cuyas caracter&iacute;sticas fundamentales
							(especificaciones t&eacute;cnicas, componentes y materiales, software incorporado o usos previstos)
							revisten novedad con relaci&oacute;n a los correspondientes a productos anteriores producidos por la empresa.
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn11">
							<b>1. </b>Servicios o bienes nuevos &uacute;nicamente para su empresa (Ya exist&iacute;an en el mercado nacional y/o en el internacional).
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi1r1c1n' name='i1r1c1n' value = '1' onClick="activaTexto(this.id, 'idi1r1c2n', 'idi1r4c2n');" <?php echo ($row['I1R1C1N'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi1r1c1n2' name='i1r1c1n' value = '2' onClick="desactivaTexto(this.id, 'idi1r1c2n', 'idi1r4c2n');" <?php echo ($row['I1R1C1N'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idi1r1c2n' name='i1r1c2n' value = '<?php echo $row['I1R1C2N']?>' <?php echo ($row['I1R1C1N']!= 1) ? 'disabled' : '' ?> maxlength="3" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn12">
							<b>2. </b>Servicios o bienes nuevos en el mercado nacional (Ya exist&iacute;an en el mercado internacional).
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi1r2c1n' name='i1r2c1n' value = '1' onClick="activaTexto(this.id, 'idi1r2c2n', 'idi1r4c2n');" <?php echo ($row['I1R2C1N'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi1r2c1n2' name='i1r2c1n' value = '2' onClick="desactivaTexto(this.id, 'idi1r2c2n', 'idi1r4c2n');" <?php echo ($row['I1R2C1N'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idi1r2c2n' name='i1r2c2n' value = '<?php echo $row['I1R2C2N']?>' <?php echo ($row['I1R2C1N']!= 1) ? 'disabled' : ''?> maxlength="3" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn13">
							<b>3. </b>Servicios o bienes nuevos en el mercado internacional.
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi1r3c1n' name='i1r3c1n' value = '1' onClick="activaTexto(this.id, 'idi1r3c2n', 'idi1r4c2n');" <?php echo ($row['I1R3C1N'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi1r3c1n2' name='i1r3c1n' value = '2' onClick="desactivaTexto(this.id, 'idi1r3c2n', 'idi1r4c2n');" <?php echo ($row['I1R3C1N'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idi1r3c2n' name='i1r3c2n' value = '<?php echo $row['I1R3C2N']?>' <?php echo ($row['I1R3C1N']!= 1) ? 'disabled' : ''?> maxlength="3" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txttotal11">
							Total innovaciones de servicios o bienes nuevos
						</div>
						<div class='col-sm-2 small'></div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idi1r4c2n' name='i1r4c2n' value = '<?php echo $row['I1R4C2N']?>' <?php echo $estadoI1R4C2N ?> /> 
						</div>
					</div>
					<div class='container-fluid bg-warning small'>
						<b>Tenga en cuenta:</b> Un servicio o bien significativamente mejorado, es un producto cuyo desempe&ntilde;o ha sido
							mejorado o perfeccionado en gran medida. Puede darse por el uso de componentes o materiales de mejor desempe&ntilde;o,
							o por cambios en uno de los subsistemas t&eacute;cnicos que componen un producto complejo.
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn14">
							<b>4. </b>Servicios o bienes significativamente mejorados para su empresa (Ya exist&iacute;an en el mercado nacional y/o en el internacional).
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi1r1c1m' name='i1r1c1m' value = '1' onClick="activaTexto(this.id, 'idi1r1c2m', 'idi1r4c2m');" <?php echo ($row['I1R1C1M'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi1r1c1m2' name='i1r1c1m' value = '2' onClick="desactivaTexto(this.id, 'idi1r1c2m', 'idi1r4c2m');" <?php echo ($row['I1R1C1M'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idi1r1c2m' name='i1r1c2m' value = '<?php echo $row['I1R1C2M']?>' <?php echo ($row['I1R1C1M']!= 1) ? 'disabled' : ''?> maxlength="3" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn15">
							<b>5. </b>Servicios o bienes significativamente mejorados en el mercado nacional (Ya exist&iacute;an en el mercado internacional).
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi1r2c1m' name='i1r2c1m' value = '1' onClick="activaTexto(this.id, 'idi1r2c2m', 'idi1r4c2m');" <?php echo ($row['I1R2C1M'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi1r2c1m2' name='i1r2c1m' value = '2' onClick="desactivaTexto(this.id, 'idi1r2c2m', 'idi1r4c2m');" <?php echo ($row['I1R2C1M'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idi1r2c2m' name='i1r2c2m' value = '<?php echo $row['I1R2C2M']?>' <?php echo ($row['I1R2C1M']!= 1) ? 'disabled' : ''?> maxlength="3" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn16">
							<b>6. </b>Servicios o bienes significativamente mejorados en el mercado internacional.
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi1r3c1m' name='i1r3c1m' value = '1' onClick="activaTexto(this.id, 'idi1r3c2m', 'idi1r4c2m');" <?php echo ($row['I1R3C1M'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi1r3c1m2' name='i1r3c1m' value = '2' onClick="desactivaTexto(this.id, 'idi1r3c2m', 'idi1r4c2m');" <?php echo ($row['I1R3C1M'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idi1r3c2m' name='i1r3c2m' value = '<?php echo $row['I1R3C2M']?>' <?php echo ($row['I1R3C1M']!= 1) ? 'disabled' : ''?> maxlength="3" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txttotal12">
							Total innovaciones de servicios o bienes significativamente mejorados
						</div>
						<div class='col-sm-2 small'></div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idi1r4c2m' name='i1r4c2m' value = '<?php echo $row['I1R4C2M']?>' <?php echo $estadoI1R4C2M ?> /> 
						</div>
					</div>
					
					<div class='container-fluid bg-warning small'>
						<b>Otros tipos de Innovaciones</b>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn17">
							<b>7. </b>Introdujo procesos nuevos o significativamente mejorados, m&eacute;todos de prestaci&oacute;n de servicios,
								distribuci&oacute;n, entrega, o sistemas log&iacute;sticos en su empresa.
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi1r4c1' name='i1r4c1' value = '1' onClick="activaTexto(this.id, 'idi1r4c2', 'idi1r4c2');" <?php echo ($row['I1R4C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi1r4c12' name='i1r4c1' value = '2' onClick="desactivaTexto(this.id, 'idi1r4c2', 'idi1r4c2');" <?php echo ($row['I1R4C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idi1r4c2' name='i1r4c2' value = '<?php echo $row['I1R4C2']?>' <?php echo ($row['I1R4C1']!= 1) ? 'disabled' : ''?> maxlength="3" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn18">
							<b>8. </b>Introdujo nuevos m&eacute;todos organizativos implementados en el funcionamiento interno de la empresa,
								en el sistema de gesti&oacute;n del conocimiento, en la organizaci&oacute;n del lugar de trabajo, o 
								en la gesti&oacute;n de las relaciones externas de la empresa. 
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi1r5c1' name='i1r5c1' onClick="activaTexto(this.id, 'idi1r5c2', 'idi1r5c2');" value = '1' <?php echo ($row['I1R5C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi1r5c12' name='i1r5c1' onClick="desactivaTexto(this.id, 'idi1r5c2', 'idi1r5c2');" value = '2' <?php echo ($row['I1R5C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idi1r5c2' name='i1r5c2' value = '<?php echo $row['I1R5C2']?>' <?php echo ($row['I1R5C1']!= 1) ? 'disabled' : ''?> maxlength="3" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn19">
							<b>9. </b>Introdujo nuevas t&eacute;cnicas de comercializaci&oacute;n en su empresa (canales para promoci&oacute;n
								y venta, o modificaciones significativas en el empaque o dise&ntilde;o del producto), implementadas en la empresa
								con el objetivo de ampliar o mantener su mercado. (Se excluyen los cambios que afectan las funcionalidades
								del producto puesto que eso corresponder&iacute;a a un servicio o bien significativamente mejorado). 
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi1r6c1' name='i1r6c1' value = '1' onClick="activaTexto(this.id, 'idi1r6c2', 'idi1r6c2');" <?php echo ($row['I1R6C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi1r6c12' name='i1r6c1' value = '2' onClick="desactivaTexto(this.id, 'idi1r6c2', 'idi1r6c2');" <?php echo ($row['I1R6C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idi1r6c2' name='i1r6c2' value = '<?php echo $row['I1R6C2']?>' <?php echo ($row['I1R6C1']!= 1) ? 'disabled' : ''?> maxlength="3" /> 
						</div>
					</div>
					<div class='container-fluid bg-warning small'>
						<b>Si respondi&oacute; NO a todas las opciones (1 ,2, 3, 4, 5, 6, 7, 8 y 9) del numeral anterior (I.1), contin&uacute;e en el numeral (I.3)</b>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id='i2' <?php echo $estadoI2 ?>>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=i2&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> I.2 Se&ntilde;ale el grado de importancia del impacto, que tuvo sobre los siguientes
						aspectos de su empresa durante el per&iacute;odo <?php echo $anterior . " - " . $vig?>, la introducci&oacute;n de servicios
						o bienes nuevos o significativamente mejorados, y/o la implementaci&oacute;n de procesos nuevos o significativamente
						mejorados, de m&eacute;todos organizativos nuevos, o de t&eacute;cnicas de comercializaci&oacute;n nuevas.</b></h5>
					</legend>
					<div class='form-group form-group-sm' style='padding-left: 30px'>
						<div class='col-sm-6'><b>Producto</b></div>
						<div class='col-sm-4 pull-right'><b>Grado de Importancia</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn21">
							<b>1. </b>Mejora en la calidad de los servicios o bienes
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r1c1' name='i2r1c1' value = '1' <?php echo ($row['I2R1C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r1c12' name='i2r1c1' value = '2' <?php echo ($row['I2R1C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r1c13' name='i2r1c1' value = '3' <?php echo ($row['I2R1C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn22">
							<b>2. </b>Ampliaci&oacute;n en la gama de servicios o bienes
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r2c1' name='i2r2c1' value = '1' <?php echo ($row['I2R2C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r2c12' name='i2r2c1' value = '2' <?php echo ($row['I2R2C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r2c13' name='i2r2c1' value = '3' <?php echo ($row['I2R2C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm' style='padding-left: 30px'>
						<div class='col-sm-6'><b>Mercado</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn23">
							<b>3. </b>Ha mantenido su participaci&oacute;n en el mercado geogr&aacute;fico de su empresa
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r3c1' name='i2r3c1' value = '1' <?php echo ($row['I2R3C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r3c12' name='i2r3c1' value = '2' <?php echo ($row['I2R3C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r3c13' name='i2r3c1' value = '3' <?php echo ($row['I2R3C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn24">
							<b>4. </b>Ha ingresado a un mercado geogr&aacute;fico nuevo
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r4c1' name='i2r4c1' value = '1' <?php echo ($row['I2R4C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r4c12' name='i2r4c1' value = '2' <?php echo ($row['I2R4C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r4c13' name='i2r4c1' value = '3' <?php echo ($row['I2R4C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm' style='padding-left: 30px'>
						<div class='col-sm-6'><b>Proceso</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn25">
							<b>5. </b>Aumento de la productividad
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r5c1' name='i2r5c1' value = '1' <?php echo ($row['I2R5C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r5c12' name='i2r5c1' value = '2' <?php echo ($row['I2R5C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r5c13' name='i2r5c1' value = '3' <?php echo ($row['I2R5C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn26">
							<b>6. </b>Reducci&oacute;n de los costos laborales
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r6c1' name='i2r6c1' value = '1' <?php echo ($row['I2R6C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r6c12' name='i2r6c1' value = '2' <?php echo ($row['I2R6C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r6c13' name='i2r6c1' value = '3' <?php echo ($row['I2R6C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn27">
							<b>7. </b>Reducci&oacute;n en el uso de materias primas o insumos
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r7c1' name='i2r7c1' value = '1' <?php echo ($row['I2R7C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r7c12' name='i2r7c1' value = '2' <?php echo ($row['I2R7C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r7c13' name='i2r7c1' value = '3' <?php echo ($row['I2R7C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn28">
							<b>8. </b>Reducci&oacute;n en el consumo de energ&iacute;a el&eacute;ctrica u otros energ&eacute;ticos
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r8c1' name='i2r8c1' value = '1' <?php echo ($row['I2R8C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r8c12' name='i2r8c1' value = '2' <?php echo ($row['I2R8C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r8c13' name='i2r8c1' value = '3' <?php echo ($row['I2R8C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn29">
							<b>9. </b>Reducci&oacute;n en el consumo de agua
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r9c1' name='i2r9c1' value = '1' <?php echo ($row['I2R9C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r9c12' name='i2r9c1' value = '2' <?php echo ($row['I2R9C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r9c13' name='i2r9c1' value = '3' <?php echo ($row['I2R9C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn210">
							<b>10. </b>Reducci&oacute;n en costos asociados a comunicaciones
						</div>
						<div class='col-sm-4 small text-right' style='vertical-align: middle'>
							<label class='radio-inline'><input type='radio' id='idi2r10c1' name='i2r10c1' value = '1' <?php echo ($row['I2R10C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r10c12' name='i2r10c1' value = '2' <?php echo ($row['I2R10C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r10c13' name='i2r10c1' value = '3' <?php echo ($row['I2R10C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn211">
							<b>11. </b>Reducci&oacute;n en costos asociados a transporte
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r11c1' name='i2r11c1' value = '1' <?php echo ($row['I2R11C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r11c12' name='i2r11c1' value = '2' <?php echo ($row['I2R11C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r11c13' name='i2r11c1' value = '3' <?php echo ($row['I2R11C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn212">
							<b>12. </b>Reducci&oacute;n en costos de mantenimiento y reparaciones
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r12c1' name='i2r12c1' value = '1' <?php echo ($row['I2R12C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r12c12' name='i2r12c1' value = '2' <?php echo ($row['I2R12C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r12c13' name='i2r12c1' value = '3' <?php echo ($row['I2R12C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					
					<div class='form-group form-group-sm' style='padding-left: 30px'>
						<div class='col-sm-6'><b>Otros Impactos</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn213">
							<b>13. </b>Mejora en el cumplimiento de regulaciones, normas y reglamentos t&eacute;cnicos. Incluye cumplimiento
								de normas de reducci&oacute;n de vertimientos o emisiones t&oacute;xicas y de mejora de las condiciones de
								seguridad industrial 
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r13c1' name='i2r13c1' value = '1' <?php echo ($row['I2R13C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r13c12' name='i2r13c1' value = '2' <?php echo ($row['I2R13C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r13c13' name='i2r13c1' value = '3' <?php echo ($row['I2R13C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn214">
							<b>14. </b>Aprovechamiento de residuos en los procesos de la empresa
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r14c1' name='i2r14c1' value = '1' <?php echo ($row['I2R14C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r14c12' name='i2r14c1' value = '2' <?php echo ($row['I2R14C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r14c13' name='i2r14c1' value = '3' <?php echo ($row['I2R14C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn215">
							<b>15. </b>Disminuci&oacute;n en el pago de impuestos
						</div>
						<div class='col-sm-4 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi2r15c1' name='i2r15c1' value = '1' <?php echo ($row['I2R15C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi2r15c12' name='i2r15c1' value = '2' <?php echo ($row['I2R15C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi2r15c13' name='i2r15c1' value = '3' <?php echo ($row['I2R15C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=i3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> I.3 Indique el valor correspondiente a los ingresos o ventas operacionales nacionales y las
						exportaciones efectuadas por su empresa en los a&ntilde;os <?php echo $anterior . " y " . $vig?>. <mark>(En miles de pesos corrientes)</mark></b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<center><img src="../images/mensaje.png" alt="Smiley face" height="" width=""></center>
						<div class='col-sm-3 small text-right' id="txtn31">
							<label class='control-label' for='idi3r1c1'>Valor de ingresos o ventas nacionales durante el periodo <?php echo $anterior ?></label>
						</div>
						<div class='col-sm-2 small'>
							<input type="text" class='form-control input-sm text-right' id='idi3r1c1' name="i3r1c1" value="<?php echo $row['I3R1C1'] ?>" maxlength="11" />
						</div>
						<div class='col-sm-3 small text-right' id="txtn32">
							<label class='control-label' for='idi3r1c2'>Valor de Exportaciones totales durante el periodo <?php echo $anterior ?></label>
						</div>
						<div class='col-sm-2 small'>
							<input type="text" class='form-control input-sm text-right' id='idi3r1c2' name="i3r1c2" value="<?php echo $row['I3R1C2'] ?>" maxlength="11" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-3 small text-right' id="txtn33">
							<label class='control-label' for='idi3r1c1'>Valor de ingresos o ventas nacionales durante el periodo <?php echo $vig ?></label>
						</div>
						<div class='col-sm-2 small'>
							<input type="text" class='form-control input-sm text-right' id='idi3r2c1' name="i3r2c1" onBlur="veriIV(this.id);" value="<?php echo $row['I3R2C1'] ?>" maxlength="11" />
						</div>
						<div class='col-sm-3 small text-right' id="txtn34">
							<label class='control-label' for='idi3r1c2'>Valor de Exportaciones totales durante el periodo <?php echo $vig ?></label>
						</div>
						<div class='col-sm-2 small'>
							<input type="text" class='form-control input-sm text-right' id='idi3r2c2' name="i3r2c2" onBlur="veriIV(this.id);" value="<?php echo $row['I3R2C2'] ?>" maxlength="11" />
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=i4&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> I.4 Distribuya en porcentajes el valor de los ingresos o ventas operacionales nacionales y de las
							exportaciones del a&ntilde;o <?php echo $vig ?>, reportado en el numeral I.3, seg&uacute;n la siguiente clasificaci&oacute;n.
							Compruebe que la suma de cada columna es 100%.</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							&nbsp;
						</div>
						<div class='col-sm-1 small text-right'>
							<b>(%)Nacionales</b>
						</div>
						<div class='col-sm-1 small text-right'>
							<b>(%)Exportaciones</b>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn41">
							<b>1. </b>Servicios o bienes nuevos o mejorados significativamente para a la empresa (Ya exist&iacute;an en el mercado nacional y/o en el internacional)
						</div>
						<div class='col-sm-1 small text-right'>
							<input type="text" class='form-control input-sm text-right' id='idi4r1c1' name="i4r1c1" value="<?php echo $row['I4R1C1'] ?>" maxlength="3" <?php echo $estadoI4R1C1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type="text" class='form-control input-sm text-right' id='idi4r1c2' name="i4r1c2" value="<?php echo $row['I4R1C2'] ?>" maxlength="3" <?php echo $estadoI4R1C2 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn42">
							<b>2. </b>Servicios o bienes nuevos o mejorados significativamente en el mercado nacional (Ya exist&iacute;an en el mercado internacional)
						</div>
						<div class='col-sm-1 small text-right'>
							<input type="text" class='form-control input-sm text-right' id='idi4r2c1' name="i4r2c1" value="<?php echo $row['I4R2C1'] ?>" maxlength="3" <?php echo $estadoI4R2C1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type="text" class='form-control input-sm text-right' id='idi4r2c2' name="i4r2c2" value="<?php echo $row['I4R2C2'] ?>" maxlength="3" <?php echo $estadoI4R2C2 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn43">
							<b>3. </b>Servicios o bienes nuevos o mejorados significativamente en el mercado internacional
						</div>
						<div class='col-sm-1 small text-right'>
							<input type="text" class='form-control input-sm text-right' id='idi4r3c1' name="i4r3c1" value="<?php echo $row['I4R3C1'] ?>" maxlength="3" <?php echo $estadoI4R3C1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type="text" class='form-control input-sm text-right' id='idi4r3c2' name="i4r3c2" value="<?php echo $row['I4R3C2'] ?>" maxlength="3" <?php echo $estadoI4R3C2 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn44">
							<b>4. </b>Servicios o bienes que se mantuvieron sin cambios o cuyos cambios no fueron significativos (productos no innovadores) 
						</div>
						<div class='col-sm-1 small text-right'>
							<input type="text" class='form-control input-sm text-right' id='idi4r4c1' name="i4r4c1" value="<?php echo $row['I4R4C1'] ?>" maxlength="3" <?php echo $estadoI4R4C1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type="text" class='form-control input-sm text-right' id='idi4r4c2' name="i4r4c2" value="<?php echo $row['I4R4C2'] ?>" maxlength="3" <?php echo $estadoI4R4C2 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-right' style='margin-right: 30px' id="txtn45">
							<b>Total</b> 
						</div>
						<div class='col-sm-1 small text-right'>
							<input type="text" class='form-control input-sm text-right' id='idi4r5c1' name="i4r5c1" value="<?php echo $row['I4R5C1'] ?>" maxlength="3" <?php echo $estadoI4R4C1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type="text" class='form-control input-sm text-right' id='idi4r5c2' name="i4r5c2" value="<?php echo $row['I4R5C2'] ?>" maxlength="3" <?php echo $estadoI4R4C2 ?> />
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 class='col-sm-6 small' style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=i5&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> I.5</b></h5></legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn51">
							Al finalizar <?php echo $vig ?>, &iquest;ten&iacute;a su empresa alg&uacute;n
							proyecto en marcha, es decir, no finalizado, para la introducci&oacute;n de servicios o bienes nuevos o
							significativamente mejorados, y/o la implementaci&oacute;n de procesos nuevos o significativamente mejorados, de 
							m&eacute;todos organizativos nuevos, o de t&eacute;cnicas de comercializaci&oacute;n nuevas? 
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi5r1c1' name="i5r1c1" onClick="activaTexto(this.id, 'nada', 'nada');" value = '1' <?php echo ($row['I5R1C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi5r1c12' name="i5r1c1" onClick="desactivaTexto(this.id, 'nada', 'nada');" value = '2' <?php echo ($row['I5R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 class='col-sm-6 small' style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=i6&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> I.6</b></h5></legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn61">
							 Durante el per&iacute;odo <?php echo $anterior . " - " . $vig?>, &iquest;su empresa abandon&oacute; alg&uacute;n proyecto
							 para la introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados, o para la implementaci&oacute;n
							 de procesos nuevos o significativamente mejorados, de m&eacute;todos organizativos nuevos, o de t&eacute;cnicas de
							 comercializaci&oacute;n nuevas, ya sea que lo hubiese iniciado durante este per&iacute;odo o en per&iacute;odos anteriores? 
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi6r1c1' name='i6r1c1' onClick="activaTexto(this.id, 'nada', 'nada');" value = '1' <?php echo ($row['I6R1C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi6r1c12' name='i6r1c1' onClick="desactivaTexto(this.id, 'nada', 'nada');" value = '2' <?php echo ($row['I6R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 class='col-sm-6 small' style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=i7&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> I.7</b></h5></legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn71">
							 Durante el per&iacute;odo <?php echo $anterior . " - " . $vig?>, &iquest;tuvo su empresa la intenci&oacuten de realizar
							 alg&uacute;n proyecto para la introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados,
							 y/o la implementaci&oacute;n de procesos nuevos o significativamente mejorados, de m&eacute;todos organizativos 
							 nuevos, o de t&eacute;cnicas de comercializaci&oacute;n nuevas? 
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi7r1c1' name='i7r1c1' onClick="activaTexto(this.id, 'nada', 'nada');" value = '1' <?php echo ($row['I7R1C1'] == 1) ? 'checked' : ''?>  <?php echo $estadoI7 ?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi7r1c12' name='i7r1c1' onClick="desactivaTexto(this.id, 'nada', 'nada');" value = '2' <?php echo ($row['I7R1C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI7 ?> />NO</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=i8&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> I.8 En el per&iacute;odo <?php echo $anterior . " - " . $vig?>, su empresa obtuvo alg&uacute;n contrato para proveer servicios o bienes a...</b></h5></legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn81">
							 <b>1. </b>Entidades del sector p&uacute;blico nacional? 
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi8r1c1' name='i8r1c1' value = '1' <?php echo ($row['I8R1C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi8r1c12' name='i8r1c1' value = '2' <?php echo ($row['I8R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn82">
							 <b>2. </b>Entidades del sector p&uacute;blico extranjero? 
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi8r2c1' name='i8r2c1' value = '1' <?php echo ($row['I8R2C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi8r2c12' name='i8r2c1' value = '2' <?php echo ($row['I8R2C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=i9&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> I.9 Dentro de los contratos que su empresa realiz&oacute; con entidades del sector 
						p&uacute;blico (pregunta I.8) &iquest;se estableci&oacute; el suministro de alguno(s) de los servicios o bienes nuevos 
						o significativamente mejorados que su empresa introdujo durante el per&iacute;odo <?php echo $anterior . " - " . $vig?> 
						(pregunta I.1 opciones 1 a 6)...</b></h5></legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn91">
							 <b>1. </b>Con entidades del sector p&uacute;blico nacional? 
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi9r1c1' name='i9r1c1' value = '1' <?php echo ($row['I9R1C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI9R1 ?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi9r1c12' name='i9r1c1' value = '2' <?php echo ($row['I9R1C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI9R1 ?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn92">
							 <b>2. </b>Con entidades del sector p&uacute;blico extranjero? 
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi9r2c1' name='i9r2c1' value = '1' <?php echo ($row['I9R2C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI9R2 ?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idi9r2c12' name='i9r2c1' value = '2' <?php echo ($row['I9R2C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI9R2 ?> />NO</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id="i10" <?php echo $estadoI10 ?> >
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=i10&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> I.10 Se&ntilde;ale el grado de importancia que tuvieron los siguientes obst&aacute;culos,
						para la introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados, y/o la implementaci&oacute;n
						de procesos nuevos o significativamente mejorados, de m&eacute;todos organizativos nuevos, o de t&eacute;cnicas
						de comercializaci&oacute;n nuevas en su empresa, durante el per&iacute;odo <?php echo $anterior . " - " . $vig?>:</b></h5>
					</legend>
					<div class='form-group form-group-sm' style='padding-left: 30px'>
						<div class='col-sm-6'><b>Obst&aacute;culos asociados a informaci&oacute;n y capacidades internas</b></div>
						<div class='col-sm-3 text-center'><b>Grado de Importancia</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn101">
							<b>1. </b>Escasez de recursos propios
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r1c1' name='i10r1c1' value = '1' <?php echo ($row['I10R1C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r1c12' name='i10r1c1' value = '2' <?php echo ($row['I10R1C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r1c13' name='i10r1c1' value = '3' <?php echo ($row['I10R1C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn102">
							<b>2. </b>Falta de personal calificado
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r2c1' name='i10r2c1' value = '1' <?php echo ($row['I10R2C1'] == 1) ? 'checked' : ''?>  <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r2c12' name='i10r2c1' value = '2' <?php echo ($row['I10R2C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r2c13' name='i10r2c1' value = '3' <?php echo ($row['I10R2C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn103">
							<b>3. </b>Dificultad para el cumplimiento de regulaciones y reglamentos t&eacute;cnicos
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r3c1' name='i10r3c1' value = '1' <?php echo ($row['I10R3C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r3c12' name='i10r3c1' value = '2' <?php echo ($row['I10R3C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r3c13' name='i10r3c1' value = '3' <?php echo ($row['I10R3C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn104">
							<b>4. </b>Escasa informaci&oacute;n sobre mercados
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r4c1' name='i10r4c1' value = '1' <?php echo ($row['I10R4C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r4c12' name='i10r4c1' value = '2' <?php echo ($row['I10R4C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r4c13' name='i10r4c1' value = '3' <?php echo ($row['I10R4C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn105">
							<b>5. </b>Escasa informaci&oacute;n sobre tecnolog&iacute;a disponible
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r5c1' name='i10r5c1' value = '1' <?php echo ($row['I10R5C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r5c12' name='i10r5c1' value = '2' <?php echo ($row['I10R5C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r5c13' name='i10r5c1' value = '3' <?php echo ($row['I10R5C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn106">
							<b>6. </b>Escasa informaci&oacute;n sobre instrumentos p&uacute;blicos de apoyo
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r6c1' name='i10r6c1' value = '1' <?php echo ($row['I10R6C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r6c12' name='i10r6c1' value = '2' <?php echo ($row['I10R6C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r6c13' name='i10r6c1' value = '3' <?php echo ($row['I10R6C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm' style='padding-left: 30px'>
						<div class='col-sm-6'><b>Obst&aacute;culos asociados a riesgos</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn107">
							<b>7. </b>Incertidumbre frente a la demanda de servicios o bienes innovadores
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r7c1' name='i10r7c1' value = '1' <?php echo ($row['I10R7C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r7c12' name='i10r7c1' value = '2' <?php echo ($row['I10R7C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r7c13' name='i10r7c1' value = '3' <?php echo ($row['I10R7C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn108">
							<b>8. </b>Incertidumbre frente al &eacute;xito en la ejecuci&oacute;n t&eacute;cnica del proyecto
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r8c1' name='i10r8c1' value = '1' <?php echo ($row['I10R8C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r8c12' name='i10r8c1' value = '2' <?php echo ($row['I10R8C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r8c13' name='i10r8c1' value = '3' <?php echo ($row['I10R8C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn109">
							<b>9. </b>Baja rentabilidad de la innovaci&oacute;n
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r9c1' name='i10r9c1' value = '1' <?php echo ($row['I10R9C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r9c12' name='i10r9c1' value = '2' <?php echo ($row['I10R9C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r9c13' name='i10r9c1' value = '3' <?php echo ($row['I10R9C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm' style='padding-left: 30px'>
						<div class='col-sm-6'><b>Obst&aacute;culos asociados al entorno</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn1010">
							<b>10 </b>Dificultades para acceder a financiamiento externo a la empresa
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r10c1' name='i10r10c1' value = '1' <?php echo ($row['I10R10C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r10c12' name='i10r10c1' value = '2' <?php echo ($row['I10R10C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r10c13' name='i10r10c1' value = '3' <?php echo ($row['I10R10C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn1011">
							<b>11 </b>Escasas posibilidades de cooperaci&oacute;n con otras empresas o instituciones         				
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r11c1' name='i10r11c1' value = '1' <?php echo ($row['I10R11C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r11c12' name='i10r11c1' value = '2' <?php echo ($row['I10R11C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r11c13' name='i10r11c1' value = '3' <?php echo ($row['I10R11C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn1012">
							<b>12 </b>Facilidad de imitaci&oacute;n por terceros         				
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r12c1' name='i10r12c1' value = '1' <?php echo ($row['I10R12C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r12c12' name='i10r12c1' value = '2' <?php echo ($row['I10R12C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r12c13' name='i10r12c1' value = '3' <?php echo ($row['I10R12C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn1013">
							<b>13 </b>Insuficiente capacidad del sistema de propiedad intelectual para proteger la innovaci&oacute;n         				
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r13c1' name='i10r13c1' value = '1' <?php echo ($row['I10R13C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r13c12' name='i10r13c1' value = '2' <?php echo ($row['I10R13C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r13c13' name='i10r13c1' value = '3' <?php echo ($row['I10R13C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn1014">
							<b>14 </b>Baja oferta de servicios de inspecci&oacute;n, pruebas, calibraci&oacute;n, certificaci&oacute;n y verificaci&oacute;n         				
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idi10r14c1' name='i10r14c1' value = '1' <?php echo ($row['I10R14C1'] == 1) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idi10r14c12' name='i10r14c1' value = '2' <?php echo ($row['I10R14C1'] == 2) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idi10r14c13' name='i10r14c1' value = '3' <?php echo ($row['I10R14C1'] == 3) ? 'checked' : ''?> <?php echo $estadoI10 ?> />Nula</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h4 style='font-family: arial'>Observaciones</h4></legend>
					<div class='col-sm-6' style='padding-bottom: 10px'>
						<textarea class='form-control' rows='2' name='observaciones' id='obsfte' <?php echo $estadObs ?>><?php echo $row['OBSERVACIONES'] ?></textarea>
					</div>
				</fieldset>
				<?php if ($grabaOK) { ?>
				<div class='form-group form-group-sm'>
					<div class='col-md-8'>
						<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Cap&iacute;tulo I Actualizado Correctamente</p>
					</div>
					<div class='col-sm-1 small pull-right' id="btn_cont" style="display: none;" >
						<a href='capitulo2.php?numord=<?php echo $numero . "&nombre=" . $nombre?>' class='btn btn-default' data-toggle='tooltip' title='Ir a siguiente cap&iacute;tulo' >Continuar</a>
					</div>
					<div class='col-sm-1 small pull-right'>
						<button type='submit' class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar informaci&oacute;n Cap&iacute;tulo I'>Grabar</button>
					</div>
				</div>
				<?php } ?>
			</div>
 		</form>
		<div id="idObs1" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Observaciones</h4>
					</div>
					<div class="modal-body">
						<textarea class='form-control' rows='2' name='observaCrit' id='obscrit'></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" id="gObs">Grabar</button>
					</div>
				</div>
			</div>
		</div>
		
		<?php include 'modalediteas.php' ?>
				
		<div id="avisoCrit" class="modal fade" role="dialog">
  			<div class="modal-dialog modal-lg">
   				 <div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">&times;</button>
        					<h4 class="modal-title">RECOMENDACIONES PARA UN BUEN PROCESO DE CR&Iacute;TICA EN EL CAP&Iacute;TULO I</h4>
      				</div>
      				<div class="modal-body">
        				<p><b>NO ES UNA INNOVACI&Oacute;N:</b></p>
						<ul style='text-align: justify;'>
						<li>El aumento de la capacidad instalada no se considera innovaci&oacute;n, por ejemplo un nuevo punto de producci&oacute;n o una nueva sede
						  donde se ofrecen los mismos servicios o se fabrican los mismos productos con los mismos procesos.
						<li>El cambio  de maquinaria o de equipos de c&oacute;mputo por  reposici&oacute;n sin que estos permitan producir un bien o servicio  nuevo
						  o mejorado, o generen cambios en los procesos productivos, organizativos etc. no se consideran innovaci&oacute;n.
						<li>Los cambios en los empaques de  productos como color, tama&ntilde;o etc.
						<li>Las certificaciones de calidad no son consideradas por si mismas como innovaci&oacute;n, solamente si el proceso de dicha certificaci&oacute;n
						  conlleva a la obtenci&oacute;n de un producto o proceso nuevo o significativamente mejorado ser&aacute;n estos &uacute;ltimos los que se reporten como
						  innovaci&oacute;n y
						</ul>
						<p style='text-align: justify;'>Recuerde que la vigencia de la innovaci&oacute;n es de <b>UN A&Ntilde;O</b> y solo se registra en un periodo de
							referencia; es decir, la misma innovaci&oacute;n reportada en el periodo de referencia anterior ya no debe registrase en la presente encuesta.
						</p>
						<p style='text-align: justify;'>Para aquellas empresas que rindan las dos encuestas (EDIT servicios y EDIT industria) deben <b>&Uacute;NICAMENTE</b>
							rendir la informaci&oacute;n del sector que se le est&aacute; encuestando (actividades del sector servicios y/o comercio), para ello busque
							contactar al asistente y/o coordinador de campo para establecer si su empresa cumple con esta condici&oacute;n.</p>
						<p style='text-align: justify;'>Para el caso de las Cooperativas tenga en cuenta que si sus asociados prestan sus servicios en otras
							empresas no deben contarlos dentro del personal ocupado ya que su fuerza laboral la ejercen para otra empresa, cuando sus servicios
							se presten para la operaci&oacute;n de la cooperativa si deben incluirse.</p>
						<p style='text-align: justify;'>Las cajas de compensaci&oacute;n deben reportar sus ingresos y personal involucrado en la actividad por la cual
							ingresan a la investigaci&oacute;n.</p>
						<p><b>CRITICA</b></p>
						<ol style='text-align: justify;'>
						<li>Las fuentes que reportan <b>ALTOS N&Uacute;MEROS DE INNOVACIONES</b> para cualquier &iacute;tem, se recomienda indagar acerca de lo que est&aacute;n
							reportando como innovaci&oacute;n ya que en muchos casos reportan el n&uacute;mero de maquinas o de computadores que adquirieron como parte del
							proceso para innovar o muchas veces reportan cada referencia de un producto mejorado.
						<li>Las fuentes que reporten innovaciones por concepto de servicios o bienes nuevos y/o significativamente mejorados obtenidos para el
							<b>MERCADO INTERNACIONAL</b>, se recomienda indagar a que hace referencia estas innovaciones y JUSTIFICAR si es el caso.
						<li>Las fuentes que reporten <b>EL MISMO N&Uacute;MERO DE INNOVACIONES</b> tanto en servicios o bienes nuevos como en servicios o bienes
							significativamente mejorados para la empresa, el mercado nacional y/o el mercado internacional se recomienda revisar con  fin de
							confirmar que no est&eacute;n duplicando la informaci&oacute;n.
						<li>Las ventas y/o ingresos as&iacute; como las exportaciones deben venir reportadas en <b>MILES DE PESOS</b>.
						<li>Las fuentes que tengan <b>VENTAS TOTALES</b> en <b>CERO</b> (0), se recomienda indagar y JUSTIFICAR si es el caso.
						<li>Revisar las fuentes que reporten ventas y/o ingresos en <b>CERO</b> (0) (cap&iacute;tulo 1) pero que reporten personal para el mismo a&ntilde;o (cap&iacute;tulo 4).
						<li>Revisar las fuentes que registren <b>VENTAS TOTALES</b> en la <b>EDIT</b> (Suma de ventas nacionales y exportaciones), 
							<b>INFERIOR</b> al valor del a&ntilde;o anterior reportados en las anuales <b>(EAC O EAS)</b>.
						<li>Las fuentes que registren en <b>CERO</b> (0) el <b>PORCENTAJE</b> de ventas y/o ingresos nacionales e internacionales por servicios
							y/o bienes nuevos as&iacute; como significativamente mejorados para el mercado internacional se recomienda indagar por que no vendieron
							o exportaron dicho producto durante el periodo de referencia.
						<li>Revisar empresas que reporten <b>ALTO PORCENTAJE</b> en ventas y/o ingresos nacionales as&iacute; como exportaciones por concepto de
							servicios o bienes nuevos y/o mejorados para cualquiera de los impactos (empresa, nacional y/o internacional).
						<li>Las fuentes que para la presente encuesta son <b>NO INNOVADORAS</b> y en la versi&oacute;n  anterior reportaron un <b>PROYECTO EN MARCHA</b>
							se recomienda indagar con el fin de determinar en qu&eacute; culmino dicho proyecto.
						<li>Realizar observaciones claras, <b>NO DEJAR NOTAS</b> como datos ok, datos verificados, etc. en lo posible indicar el nombre y cargo
							de la persona que suministra la informaci&oacute;n, en los casos donde las cifras son muy grandes y se confirme que  est&aacute;n expresadas en
							miles de pesos hacer la aclaraci&oacute;n en  las observaciones.
						</ol>
      				</div>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      				</div>
    			</div>
  			</div>
		</div>
 	</body>
 </html> 
