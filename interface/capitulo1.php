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
	//$tabla = 'capitulo_i';
	$tabla = 'capitulo_i_other';
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	$grabaOK = false;
	include '../persistencia/cargaDato.php';
	
// 	$estadoI1R4C2N = ''; $estadoI1R4C2M = ''; $estadoI2 = ''; $estadoI7 = ''; $estadoI9R1 = 'disabled'; $estadoI9R2 = 'disabled';
// 	$estadoI10 = 'disabled';
	
// 	$estadoI4R1C1 = ''; $estadoI4R2C1 = ''; $estadoI4R3C1 = ''; $estadoI4R4C1 = ''; $estadoI4R1C2 = ''; $estadoI4R2C2 = ''; $estadoI4R3C2 = ''; $estadoI4R4C2 = '';
	
	$row = ['i1r1c1' => 1, /*'i1r1c1' => 2,*/ 'i1r1c2' => 25,
			'i1r3c1' => 1,'i1r3c2' => 0,'i1r3c3' => 1,'i1r3c4' => 0,'i1r3c5' => 1,'i1r3c6' => 0,'i1r3c7' => 1,'i1r3c8' => 0, 'i1r3c9' => 'Medio de publicacion adicional',
			'i1r4c1' => 1,
			'OBSERVACIONES' => 'Observaciones de la fuente para el estado de la fuente'
	];
	
	
// 	if ($row['I1R1C2N']+$row['I1R2C2N']+$row['I1R3C2N'] == 0) {$estadoI1R4C2N = 'disabled';}
// 	if ($row['I1R1C2M']+$row['I1R2C2M']+$row['I1R3C2M'] == 0) {$estadoI1R4C2M = 'disabled';}
// 	if ($row['I1R1C1N']!=1 AND $row['I1R2C1N']!=1 AND $row['I1R3C1N']!=1 AND $row['I1R1C1M']!=1 AND $row['I1R2C1M']!=1 AND $row['I1R3C1M']!= 1 AND $row['I1R4C1']!=1 AND 
// 		$row['I1R5C1']!=1 AND $row['I1R6C1']!=1) {
// 		$estadoI2 = 'disabled';
// 	}
// 	if ($row['I1R1C1N']==1 OR $row['I1R2C1N']==1 OR $row['I1R3C1N']==1 OR $row['I1R1C1M']==1 OR $row['I1R2C1M']==1 OR 
// 		$row['I1R3C1M']==1 OR $row['I1R5C1']==1 OR $row['I1R6C1']==1 OR $row['I5R1C1']==1 OR $row['I6R1C1']==1) {
// 			$estadoI7 = 'disabled';
// 	}
// 	if ($row['I1R1C1N']!=1 AND $row['I1R2C1N']!=1 AND $row['I1R3C1N']!=1 AND $row['I1R1C1M']!=1 AND $row['I1R2C1M']!=1 AND 
// 		$row['I1R3C1M']!=1 AND $row['I1R5C1']!=1 AND $row['I1R6C1']!=1 AND $row['I5R1C1']!=1 AND $row['I6R1C1']!=1) {
// 			$estadoI7 = '';
// 	}
// 	//ESTADOS NUMERAL 4
// 	if ($row['I3R2C1']==0) {
// 		$estadoI4R4C1 = 'disabled'; $estadoI4R1C1 = 'disabled'; $estadoI4R2C1 = 'disabled'; $estadoI4R3C1 = 'disabled';
// 	}
// 	else {
// 		if (($row['I1R1C1N']!=1 AND $row['I1R1C1M']!=1)) {
// 			$estadoI4R1C1 = 'disabled';
// 		}
// 		if (($row['I1R2C1N']!=1 AND $row['I1R1C1M']!=1)) {
// 			$estadoI4R2C1 = 'disabled';
// 		}
	
// 		if (($row['I1R3C1N']!=1 AND $row['I1R3C1M']!=1)) {
// 			$estadoI4R3C1 = 'disabled';
// 		}
// 	}
	
// 	if ($row['I3R2C1']==0) {
// 		$estadoI4R4C1 = 'disabled';
// 	}
	
// 	if ($row['I3R2C2']==0) {
// 		$estadoI4R4C2 = 'disabled'; $estadoI4R1C2 = 'disabled'; $estadoI4R2C2 = 'disabled'; $estadoI4R3C2 = 'disabled';
// 	}
// 	else {
// 		if (($row['I1R1C1N']!=1 AND $row['I1R1C1M']!=1)) {
// 			$estadoI4R1C2 = 'disabled';
// 		}
// 		if (($row['I1R2C1N']!=1 AND $row['I1R1C1M']!=1)) {
// 			$estadoI4R2C2 = 'disabled';
// 		}
	
// 		if (($row['I1R3C1N']!=1 AND $row['I1R3C1M']!=1)) {
// 			$estadoI4R3C2 = 'disabled';
// 		}
// 	}
	
// 	if (($row['I1R1C1N']==1 OR $row['I1R2C1N']==1 OR $row['I1R3C1N']==1 OR $row['I1R1C1M']==1 OR $row['I1R2C1M']==1 OR 
// 		$row['I1R3C1M']==1) AND ($row['I8R1C1']==1)) {
// 		$estadoI9R1 = '';
// 	}
// 	if (($row['I1R1C1N']==1 OR $row['I1R2C1N']==1 OR $row['I1R3C1N']==1 OR $row['I1R1C1M']==1 OR $row['I1R2C1M']==1 OR 
// 		$row['I1R3C1M']==1) AND ($row['I8R2C1']==1)) {
// 			$estadoI9R2 = '';
// 	}
// 	if ($row['I1R1C1N']==1 OR $row['I1R2C1N']==1 OR $row['I1R3C1N']==1 OR $row['I1R1C1M']==1 OR $row['I1R2C1M']==1 OR 
// 		$row['I1R3C1M']==1 OR $row['I1R4C1']==1 OR $row['I1R5C1']==1 OR $row['I1R6C1']==1 OR $row['I5R1C1']==1 OR $row['I6R1C1']==1 OR $row['I7R1C1']==1) {
// 			$estadoI10 = '';
// 	}
	
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
				//$('input, textarea, button, select').attr('disabled','disabled');			
				
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

// 			$(function() {
// 				$("#idi4r1c1,#idi4r2c1,#idi4r3c1,#idi4r4c1,#idi4r1c2,#idi4r2c2,#idi4r3c2,#idi4r4c2").blur(function() {
// 					if ($(this).val()>100 || $(this).val()<0) {
// 						alert("Debe ingresar valor Mayor o igual a cero y Menor o igual a cien");
// 						$(this).focus();
// 					}
// 				});
// 			});
			
// 			$(function() {
// 				$("#idi1r1c2n,#idi1r2c2n,#idi1r3c2n,#idi1r4c2n,#idi1r1c2m,#idi1r2c2m,#idi1r3c2m,#idi1r4c2m,#idi1r4c2,#idi1r5c2,#idi1r6c2,#idi3r1c1,#idi3r1c2,#idi3r2c1,#idi3r2c2,#idi4r1c1,#idi4r1c2,#idi4r2c1,#idi4r2c2,#idi4r3c1,#idi4r3c2,#idi4r4c1,#idi4r4c2,#idi4r5c1,#idi4r5c2").keyup(function(){
// 					if ($(this).val() != "")
// 						$(this).val( $(this).val().replace(/[^0-9]/g, '') );
// 				});
// 			});

// 			$(function() {
// 				$("#idi1r1c2n,#idi1r2c2n,#idi1r3c2n,#idi1r4c2n,#idi1r1c2m,#idi1r2c2m,#idi1r3c2m,#idi1r4c2m,#idi1r4c2,#idi1r5c2,#idi1r6c2,#idi3r1c1,#idi3r1c2,#idi3r2c1,#idi3r2c2,#idi4r1c1,#idi4r1c2,#idi4r2c1,#idi4r2c2,#idi4r3c1,#idi4r3c2,#idi4r4c1,#idi4r4c2,#idi4r5c1,#idi4r5c2").blur(function(){
// 					if ($(this).val()!='') {
// 						$(this).val(parseInt($(this).val()));
// 					}
// 				});
// 			});

// 			$(function() {
// 				var desactiva = true;
// 				$("#idi1r1c1n2,#idi1r2c1n2,#idi1r3c1n2,#idi1r1c1m2,#idi1r2c1m2,#idi1r3c1m2,#idi1r4c12,#idi1r5c12,#idi1r6c12").click(function(){
// 					$("#idi1r1c1n,#idi1r2c1n,#idi1r3c1n,#idi1r1c1m,#idi1r2c1m,#idi1r3c1m,#idi1r4c1,#idi1r5c1,#idi1r6c1").each(function(){
// 						if ($(this).is(":checked")) {
// 							desactiva = false;
// 						}
// 					});
// 					if (desactiva) {
// 						$("#idi2r1c1,#idi2r1c12,#idi2r1c13,#idi2r2c1,#idi2r2c12,#idi2r2c13,#idi2r3c1,#idi2r3c12,#idi2r3c13,#idi2r4c1,#idi2r4c12,#idi2r4c13,#idi2r5c1,#idi2r5c12,#idi2r5c13,#idi2r6c1,#idi2r6c12,#idi2r6c13,#idi2r7c1,#idi2r7c12,#idi2r7c13,#idi2r8c1,#idi2r8c12,#idi2r8c13,#idi2r9c1,#idi2r9c12,#idi2r9c13,#idi2r10c1,#idi2r10c12,#idi2r10c13,#idi2r11c1,#idi2r11c12,#idi2r11c13,#idi2r12c1,#idi2r12c12,#idi2r12c13,#idi2r13c1,#idi2r13c12,#idi2r13c13,#idi2r14c1,#idi2r14c12,#idi2r14c13,#idi2r15c1,#idi2r15c12,#idi2r15c13").each(function() {
// 							$(this).prop("checked", false);
// 						});
// 						$("#i2").prop("disabled", true);
// 						$("#i7r1c1").prop("disabled", false);
// 					}
// 					desactiva = true;
// 				});
// 			});

// 			$(function() {
// 				$("#idi1r4c2n").blur(function() {
// 					var Total = 0;
// 					$("#idi1r1c2n,#idi1r2c2n,#idi1r3c2n").each(function() {
// 						if ($(this).is(":disabled")) {
// 							Total = parseInt(Total)+0;
// 						}
// 						else {
// 							Total = parseInt(Total)+parseInt($(this).val());
// 						}
// 					});
// 					if(parseInt(Total) != parseInt($("#idi1r4c2n").val())) {
// 						alert("TOTAL DIGITADO INVALIDO, POR FAVOR REVISE");
// 					}
// 				});
// 			});

// 			$(function() {
// 				$("#idi1r4c2m").blur(function() {
// 					var Total = 0;
// 					$("#idi1r1c2m,#idi1r2c2m,#idi1r3c2m").each(function() {
// 						if ($(this).is(":disabled")) {
// 							Total = Total+0;
// 						}
// 						else {
// 							Total = Total+parseInt($(this).val());
// 						}
// 					}); 
// 					if(Total != parseInt($("#idi1r4c2m").val())) {
// 						alert("TOTAL DIGITADO INVALIDO, POR FAVOR REVISE");
// 					}
// 				});
// 			});

// 			$(function() {
// 				$("#idi4r5c1").blur(function() {
// 					var Total = 0;
// 					$("#idi4r1c1,#idi4r2c1,#idi4r3c1,#idi4r4c1").each(function() {
// 						if ($(this).is(":disabled")) {
// 							Total = parseInt(Total)+0;
// 						}
// 						else {
// 							Total = parseInt(Total)+parseInt($(this).val());
// 						}
// 					});
// 					if(parseInt(Total) != parseInt($("#idi4r5c1").val())) {
// 						alert("TOTAL DIGITADO INVALIDO O DIFERENTE DE 100");
// 					}
// 				});
// 			});

// 			$(function() {
// 				$("#idi4r5c2").blur(function() {
// 					var Total = 0;
// 					$("#idi4r1c2,#idi4r2c2,#idi4r3c2,#idi4r4c2").each(function() {
// 						if ($(this).is(":disabled")) {
// 							Total = parseInt(Total)+0;
// 						}
// 						else {
// 							Total = parseInt(Total)+parseInt($(this).val());
// 						}
// 					});
// 					if(parseInt(Total) != parseInt($("#idi4r5c2").val())) {
// 						alert("TOTAL DIGITADO INVALIDO O DIFERENTE DE 100");
// 					}
// 				});
// 			});
			
// 			$(function() {
// 			var activar = false;
// 				$("#idi8r1c1").click(function() {
// 					$("#idi1r1c1n,#idi1r2c1n,#idi1r3c1n,#idi1r1c1m,#idi1r2c1m,#idi1r3c1m").each(function(){
// 						if ($(this).is(":checked")) {
// 							activar = true;
// 						}
// 					});
// 					if (activar) {
// 						$("#idi9r1c1, #idi9r1c12").prop("disabled", false);
// 					}
// 					activar = false;
// 				});
// 			});
			
// 			$(function() {
// 				$("#idi8r1c12").click(function() {
// 					$("#idi9r1c1, #idi9r1c12").prop("disabled", true);
// 					$("#idi9r1c1").prop("checked", false);
// 					$("#idi9r1c12").prop("checked", false);
// 				});
// 			});
			
// 			$(function() {
// 				var activar = false;
// 				$("#idi8r2c1").click(function() {
// 					$("#idi1r1c1n,#idi1r2c1n,#idi1r3c1n,#idi1r1c1m,#idi1r2c1m,#idi1r3c1m").each(function(){
// 						if ($(this).is(":checked")) {
// 							activar = true;
// 						}
// 					});
// 					if (activar) {
// 						$("#idi9r2c1, #idi9r2c12").prop("disabled", false);
// 					}
// 					activar = false;
// 				});
// 			});
			
// 			$(function() {
// 				$("#idi8r2c12").click(function() {
// 					$("#idi9r2c1, #idi9r2c12").prop("disabled", true);
// 					$("#idi9r2c1").prop("checked", false);
// 					$("#idi9r2c12").prop("checked", false);
// 				});
// 			});
			
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
	<?php
			include 'menuFuente.php';
/*			
			if ($tipousu != "FU") {
				echo "<script type='text/javascript'>";
				echo "$(function() {";
				echo "$(window).load(function(){";
			    echo "$('#avisoCrit').modal('show');";
			    echo "});});";
			    echo "</script>";
			}
*/			
		?>
		<div class="well well-sm" style="font-size: 12px; padding-top: 60px; z-index: 1;" id="wc2">
 			<?php echo $numero . "-" . $nombre?> - CAP&Iacute;TULO I - CARACTERIZAC&Oacute;N DE VACANTES ABIERTAS <?php echo $anterior . "-" . $vig . " . " . $txtEstado ?>
 			<?php echo '<br/>'; print_r($row); ?>
 		</div>
 		
 		<div class="container text-justify" style="font-size: 12px">
			Este m&oacute;dulo  determina la cantidad de vacantes durante el "I trimestre del año <?php echo $vig;?>" e  identifica sus caracter&iacute;sticas.s
 		</div>

		<input type="hidden" name="tipousu" id="idTipo" value="<?php echo $tipousu ?>" />
		<form class='form-horizontal' role='form' data-toggle='validator' name="capitulo2" id="capitulo2" method="post" disabled>
			<div class='container'>
				<input type="hidden" name="C2_nordemp" id="numero" value="<?php echo $numero ?>" />
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend>
						<h5 style='font-family: arial'><b>
							<?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii1&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?>
							1. Durante el periodo de referencia
						</b></h5> 
						
					</legend>
					
					<div class="form-group form-group-sm col-xs-12 col-sm-11 col-sm-offset-1">
						<label class="col-xs-12 col-sm-12" >¿tuvo alguna vacante abierta a candidatos no vinculados con la empresa?</label>
						<div class="col-xs-12 col-sm-2 col-sm-offset-1">
							<label class="radio-inline">
							  <input type="radio" name="i1r1c1" id="idi1r1c1si" value="1" <?php echo ($row['i1r1c1'] == 1) ? 'checked' : ''; ?> > Si
							</label>
							<label class="radio-inline">
							  <input type="radio" name="i1r1c1" id="idi1r1c1no" value="2" <?php echo ($row['i1r1c1'] == 2) ? 'checked' : ''; ?> > No
							</label>
						</div>
					</div>
					
					<div class="form-group form-group-sm col-xs-12 col-sm-11 col-sm-offset-1 ">
						<label class="col-xs-12 col-sm-4">Indique la  cantidad  de  vacantes abiertas</label>
						<div class='col-xs-12 col-sm-3 small'>
							<input type='text' class='form-control input-sm text-center' id='idi1r1c2' name='i1r1c2' value = "<?php echo $row['i1r1c2']; ?>" maxlength="9" />
						</div>
					</div>
				</fieldset>
				
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend>
						<h5 style='font-family: arial'><b><?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii2&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> 
							2. Clasifique las vacantes abiertas durante el trimestre de referencia de acuerdo a las siguientes caracter&iacute;sticas: </br>
						 		&Aacute;rea funcional, M&iacute;nimo nivel educativo requerido, &Aacute;rea de formaci&oacute;n, Experiencia en meses, Modalidad de contrataci&oacute;n, Salarios u honorarios y edad:
						 </b></h5>
						 <div style="color:red;"><h6 > Nota: Si más de una vacante presenta las mismas características relacionelas en una sola fila, si alguna de ellas difiere agregue otra. </h6></div>
					</legend>
					<div class="container-fluid">
						<div class="col-xs-12 col-sm-12">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Agregar Caracterizacion</button>
						</div>
						<div id="contenido" class="col-xs-12 col-sm-12">
							<h5>aqui insertaremos la caracterizacion de empleos</h5>
						</div>
						
						<div id="totales" class="col-xs-12 col-sm-12">
							<h5>Totales solicitados por la encuesta</h5>
						</div>
						
						
						
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">Cantidad de vacantes abiertas</label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='id1r2c1' name='i1r2c1' value = "<?php echo $row['d1r2c1']?>" maxlength="9" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">&Aacute;rea funcional</label>
							<div class='small'>
								<select class='form-control input-sm' id="idi1r2c2" name="i1r2c2">
									<option value=''>Descarga Documentos</option>
									<option value=''>Formulario Borrador</option>
									<option value=''>Maual de Diligenciamiento</option>
									<option value=''>Glosario de T&eacute;rminos</option>
								</select>								
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">Mínimo nivel educativo requerido</label>
							<div class='small'>
								<select class='form-control input-sm' id="idi1r2c3" name="i1r2c3">
									<option value=''>Descarga Documentos</option>
									<option value=''>Formulario Borrador</option>
									<option value=''>Maual de Diligenciamiento</option>
									<option value=''>Glosario de T&eacute;rminos</option>
								</select>
							</div>
						</div>
						
					</div>
					
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">Área de Formación</label>
							<div class='small'>
								<select class='form-control input-sm' id="idi1r2c4" name="i1r2c4">
									<option value=''>Descarga Documentos</option>
									<option value=''>Formulario Borrador</option>
									<option value=''>Maual de Diligenciamiento</option>
									<option value=''>Glosario de T&eacute;rminos</option>
								</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">Experiencia en meses</label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idi1r2c5' name='i1r2c5' value = "<?php echo $row['i1r2c5']?>" maxlength="9" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">Modalidad de Contratación</label>
							<div class='small'>
								<select class='form-control input-sm' id="idi1r2c6" name="i1r2c6">
									<option value=''>Descarga Documentos</option>
									<option value=''>Formulario Borrador</option>
									<option value=''>Maual de Diligenciamiento</option>
									<option value=''>Glosario de T&eacute;rminos</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">Salario u honorarios mensuales</label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idi1r2c7' name='i1r2c7' value = "<?php echo $row['i1r2c7']?>" maxlength="9" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">Edad</label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idi1r2c8' name='i1r2c8' value = "<?php echo $row['i1r2c8']?>" maxlength="9" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">De las vacantes ¿Cuántas logró cubrir?</label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idi1r2c9' name='i1r2c9' value = "<?php echo $row['i1r2c9']?>" maxlength="9" />
							</div>
						</div>
					</div>
					
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">De las vacantes cubiertas ¿cuantas se ocuparon con hombres?</label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idi1r2c10' name='i1r2c10' value = "<?php echo $row['i1r2c10']?>" maxlength="9" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">De las vacantes cubiertas ¿Cuántas se ocuparon con mujeres?</label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idi1r2c11' name='i1r2c11' value = "<?php echo $row['i1r2c11']?>" maxlength="9" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">De las vacantes ¿Cuántas NO logró cubrir? </label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idi1r2c12' name='i1r2c12' value = "<?php echo $row['i1r2c12']?>" maxlength="9" />
							</div>
						</div>
						
					</div>
					
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label>De las vacantes NO cubiertas ¿Cuáles fueron las causas?</label>
							<div class="small">
								<select class='form-control input-sm' id="idi1r2c13" name="idi1r2c13">
									<option value=''>Descarga Documentos</option>
									<option value=''>Formulario Borrador</option>
									<option value=''>Maual de Diligenciamiento</option>
									<option value=''>Glosario de T&eacute;rminos</option>
								</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-7">
							<label class="">Cual?</label>
							<input type='text' class='form-control input-sm text-right' id='idi1r2c14' name='i1r2c14' value = "<?php //echo $row['i1r2c14']?>" maxlength="9" />
						</div>
					</div>
				</fieldset>
				
				<fieldset style='border-style: solid; border-width: 1px' id="ii3" class="<?php //echo $estadoII3; ?>" >
					<legend>
						<h5 style='font-family: arial'><b>
							<?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> 
							3. Para  las <?php echo "XXX"; ?> vacantes mencionadas en el numeral 1, Seleccione  el (los) medio(s) de publicación utilizado(s):
						</b></h5>
					</legend>
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c1" name="i1r3c1" <?php echo ($row['i1r3c1'] == 1) ? 'checked' : ''?> >
							    Medios de comunicación (prensa,radio,tv)
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c2" name="i1r3c2" <?php echo ($row['i1r3c2'] == 1) ? 'checked' : ''?> >
							    Servicio Público de Empleo
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c3" name="i1r3c3" <?php echo ($row['i1r3c3'] == 1) ? 'checked' : ''?> >
							    Portales laborales WEB
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c4" name="i1r3c4" <?php echo ($row['i1r3c4'] == 1) ? 'checked' : ''?> >
							    Agencias / bolsas de empleo / headhunters / firmas cazatalentos
							  </label>
							</div>
						</div>
					</div>
						
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
							<div class="checkbox" >
							  <label>
							    <input type="checkbox" id="i1r3c5" name="i1r3c5" <?php echo ($row['i1r3c5'] == 1) ? 'checked' : ''?> >
							    Universidades  e  instituciones educativas (oficinas de egresados)
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c6" name="i1r3c6" <?php echo ($row['i1r3c6'] == 1) ? 'checked' : ''?> >
							     Contactos no  formales (colegas, amigos, empleados)
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c7" name="i1r3c7" <?php echo ($row['i1r3c7'] == 1) ? 'checked' : ''?> >
							    Redes sociales o aplicaciones
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c8" name="i1r3c8" <?php echo ($row['i1r3c8'] == 1) ? 'checked' : ''?> >
							    Otra no mencionada anteriormente
							  </label>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-12">
							<label class="">Cual?</label>
							<input type='text' class='form-control input-sm' id='idir3c9' name='i1r3c9' value = "<?php echo $row['i1r3c9']?>" maxlength="9" />
						</div>
					</div>
				</fieldset>
				
				<fieldset style='border-style: solid; border-width: 1px' id="ii3" class="<?php //echo $estadoII3; ?>" >
					<legend>
						<h5 style='font-family: arial'><b>
							<?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> 
							4. De las <?php echo "XXX"; ?> vacantes mencionadas en el numeral 1.
						</b></h5>
					</legend>
					
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12">
							<label class="">¿Cuántas requerían de una competencia certificada?</label>
							<input type='text' class='form-control input-sm' id='idi1r4c1' name='i1r4c1' value = "<?php echo $row['i1r4c1']?>" maxlength="9" />
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
						<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Cap&iacute;tulo II Actualizado Correctamente</p>
					</div>
					<div class='col-sm-1 small pull-right' id="btn_cont" style="display: none;" >
						<a href='capitulo3.php?numord=<?php echo $numero . "&nombre=" . $nombre?>' class='btn btn-default' data-toggle='tooltip' title='Ir a siguiente cap&iacute;tulo'>Continuar</a>
					</div>
					<div class='col-sm-1 small pull-right'>
						<button type='submit' class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar informaci&oacute;n Cap&iacute;tulo II'>Grabar</button>
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
						<button type="button" class="btn btn-default" data-dismiss="modal" id="conf">Grabar</button>
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
        					<h4 class="modal-title">RECOMENDACIONES PARA UN BUEN PROCESO DE CR&Iacute;TICA EN EL CAP&Iacute;TULO II</h4>
      				</div>
      				<div class="modal-body">
        				<ol style='text-align: justify; font-family: arial'>
						<li>Las cifras en este cap&iacute;tulo deben  registrarse en <b>MILES DE PESOS</b> y asegurarse  que sean <b>&Uacute;NICAMENTE</b> las inversiones
							relacionadas con las innovaciones, proyecto en marcha y/o abandonado del cap&iacute;tulo I,  se aconseja tener en cuenta el tama&ntilde;o de la
							empresa como referente para  los montos reportados.
						<li>Revisar las fuentes que registren un monto de inversi&oacute;n en <b>MAQUINARIA Y EQUIPO</b> en la EDIT, <b>SUPERIOR</b> a la inversi&oacute;n
							total en maquinaria y equipo, reportado en la <b>EAC</b> o <b>EAS</b> para cualquiera de los dos a&ntilde;os.
						<li>Revisar las fuentes que registren un monto de inversi&oacute;n en <b>TICS</b> en la EDIT, <b>SUPERIOR</b> a la inversi&oacute;n total en
							tecnolog&iacute;as de la informaci&oacute;n, reportado en la <b>EAC</b> o <b>EAS</b> para cualquiera de los dos a&ntilde;os.
						<li>Las fuentes que tengan para ambos a&ntilde;os el <b>MISMO MONTO</b> de inversi&oacute;n, se recomienda indagar que no sean presupuestos o gastos incurridos
							por la empresa.
						<li>Revisar las fuentes que registren un monto de <b>INVERSI&Oacute;N EN ACTI</b> en la EDIT para cualquiera de los dos a&ntilde;os <b>IGUAL O SUPERIOR</b>
							al <b>TOTAL DE VENTAS</b> reportados en el capitulo 1, JUSTIFICAR si es el caso.
						<li>Cuando la fuente registra valores de inversi&oacute;n en <b>BIOTECNOLOG&Iacute;A</b> (es una tecnolog&iacute;a que involucra t&eacute;cnicas cient&iacute;ficas que
							utilizan organismos vivos o sus partes para obtener o modificar productos, para mejorar plantas o animales o para desarrollar
							microorganismos con usos espec&iacute;ficos)  es necesario <b>VERIFICAR y JUSTIFICAR</b> que la actividad seg&uacute;n c&oacute;digo <b>CIIU</b>
							realmente est&eacute; relacionado con ese tipo de actividades. Por ejemplo,  en muchas ocasiones los concesionarios de veh&iacute;culos y/o
							empresas de transporte reportan  de manera incorrecta inversiones de este tipo; mientras que es posible que empresas que realicen
							tratamiento  de aguas o  realicen actividades relacionadas con la salud si presenten este tipo de inversi&oacute;n.
						<li>Revisar las fuentes que registren el <b>MISMO VALOR</b> invertido en <b>ACTI</b> para cualquiera de los dos a&ntilde;os en <b>BIOTECNOLOG&Iacute;A</b>
							(valor invertido en pregunta referente a montos de biotecnolog&iacute;a igual a valor invertido en actividades cient&iacute;ficas, tecnol&oacute;gicas
							y de innovaci&oacute;n para cada uno de los a&ntilde;os).
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
