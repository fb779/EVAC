<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$page='cap2';
	$vig=$_SESSION['vigencia'];
	$estadObs = ($tipousu != "FU" ? "readonly" : "");
	$anterior = $vig-1;
	$tabla = 'capitulo_ii';
	$bloquear = "NO";
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	$grabaOK = false;
	include '../persistencia/cargaDato.php';
	
	$consLog = ($region == 99 ? true : false);
	
	$cLog = "<span class='glyphicon glyphicon-time' style='color: blue; font-size: 14px;'></span>";
	
	
	$estadoII31 = ''; $estadoII32 = ''; $estadoII2 = "";
	
	if($row['II1R10C1']==0 AND $row['II1R10C2']==0) {
		$estadoII2 = "disabled";
	}
	if ($row['II2R1C1']==2) {
		$estadoII31 = 'disabled'; $estadoII32 = 'disabled';
	}
	if ($row['II1R10C1']==0) {
		$estadoII31 = 'disabled';
	}
	if ($row['II1R10C2']==0) {
		$estadoII32 = 'disabled';
	}
	
	$qC1 = $conn->prepare("SELECT * FROM capitulo_i WHERE C1_nordemp = :nFuente AND vigencia = :periodo");
	$qC1->execute(array('nFuente'=>$numero, 'periodo'=>$vig));
	$rowC1 = $qC1->fetch(PDO::FETCH_ASSOC);
	if (!($rowC1)) {
		$bloquear = "SI";
	}
	else {
		if ($rowC1['I1R1C1N']!=1 AND $rowC1['I1R2C1N']!=1 AND $rowC1['I1R3C1N']!=1 AND $rowC1['I1R1C1M']!=1 AND $rowC1['I1R2C1M']!=1 AND $rowC1['I1R3C1M']!=1
			AND $rowC1['I1R4C1']!=1 AND $rowC1['I1R5C1']!=1 AND $rowC1['I1R6C1']!=1 AND $rowC1['I5R1C1']!=1 AND $rowC1['I6R1C1']!=1) {
			$bloquear = "SI";
		}
	}
	if ($bloquear == "SI") {
		$borraReg = $conn->prepare("DELETE FROM capitulo_ii WHERE C2_nordemp = :numero AND vigencia = :periodo");
		$borraReg->execute(array(':numero'=>$numero, ':periodo'=>$vig));
		
		if ($tipousu == "CR" AND $rowCtl['acceso'] == "CR" AND $rowCtl['estado'] == 4) {
			$actuCtl = $conn->prepare("UPDATE control set m2 = 3 WHERE nordemp = :numero AND vigencia = :periodo");
			$actuCtl->execute(array(':numero'=>$numero, ':periodo'=>$vig));
		}
		else {
			if ($tipousu == "FU" AND $rowCtl['acceso'] == "FU" AND $rowCtl['estado'] < 4) {
				$actuCtl = $conn->prepare("UPDATE control set m2 = 2 WHERE nordemp = :numero AND vigencia = :periodo");
				$actuCtl->execute(array(':numero'=>$numero, ':periodo'=>$vig));
			}
		}
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
		<script type="text/javascript" src="../js/cargaDato.js"></script>
		<script type="text/javascript" src="../js/validaForm2.js"></script>
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<style>
			.modal-width {
				width: 90%;
			}
		</style>
		<script type="text/javascript">
		$(document).ready(function(){

		});
		var retorno = "";
		$(function() {
            $("#capitulo2").submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: "../persistencia/grabacapi.php",
                    type: "POST",
                    data: $(this).serialize(),
					beforeSend:  validaForm2,
                    success: function(dato) {
					if (retorno=="") {
						$("#btn_cont").show();
						$("#idmsg").show();
						$(function() {
							$.ajax({
								url: "../persistencia/grabactl.php",
								type: "POST",
								data: {modulo: "m2", estado: "2", numero: $("#numero").val(), capitulo: "C2"},
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
							data: {modulo: "m2", estado: "1", numero: $("#numero").val(), capitulo: "C2"},
							success: function(dato) {
							}
						});
						});
					}
				}
                });
            });
			});
			
			$(function() {
				$("#idii1r1c1,#idii1r2c1,#idii1r3c1,#idii1r4c1,#idii1r5c1,#idii1r6c1,#idii1r7c1,#idii1r8c1,#idii1r9c1,#idii1r10c1,#idii1r1c2,#idii1r2c2,#idii1r3c2,#idii1r4c2,#idii1r5c2,#idii1r6c2,#idii1r7c2,#idii1r8c2,#idii1r9c2,#idii1r10c2,#idii3r1c1,#idii3r1c2").keyup(function(){
					if ($(this).val() != "")
						$(this).val( $(this).val().replace(/[^0-9]/g, '') );
				});
			});

			$(function() {
				$("#idii1r1c1,#idii1r2c1,#idii1r3c1,#idii1r4c1,#idii1r5c1,#idii1r6c1,#idii1r7c1,#idii1r8c1,#idii1r9c1,#idii1r10c1,#idii1r1c2,#idii1r2c2,#idii1r3c2,#idii1r4c2,#idii1r5c2,#idii1r6c2,#idii1r7c2,#idii1r8c2,#idii1r9c2,#idii1r10c2,#idii3r1c1,#idii3r1c2").blur(function(){
					if ($(this).val()!='') {
						$(this).val(parseInt($(this).val()));
					}
				});
			});
		
			$(function() {
				$("#idii2r1c1").click(function() {
					if($("#idii1r10c1").val()>0 && $("#idii1r10c2").val()>0) {
						$("#idii3r1c1,#idii3r1c2,#ii3").prop('disabled', false);
						$("#idii3r1c1").focus();
					}
					else {
						if ($("#idii1r10c1").val()>0) {
							$("#idii3r1c1,#ii3").prop('disabled', false);
							$("#idii3r1c1").focus();
						}
						else {
							if ($("#idii1r10c2").val()>0) {
								$("#idii3r1c2,#ii3").prop('disabled', false);
								$("#idii3r1c2").focus();
							}
						}
					}
				});
			});

			$(function() {
				$("#idii2r1c12").click(function() {
					$("#ii3").attr('disabled', 'disabled');
					$("#idii3r1c1, #idii3r1c2").val('');
				});
			});

			$(function() {
				$("#idii1r10c1").blur(function() {
					if(parseInt($("#idii1r1c1").val())+parseInt($("#idii1r2c1").val())+parseInt($("#idii1r3c1").val())+parseInt($("#idii1r4c1").val())+parseInt($("#idii1r5c1").val())+parseInt($("#idii1r6c1").val())+parseInt($("#idii1r7c1").val())+parseInt($("#idii1r8c1").val())+parseInt($("#idii1r9c1").val())!=parseInt($("#idii1r10c1").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
					if ($(this).val() == 0) {
						$("#idii3r1c1").prop("disabled", true);
					}
				});
			});

			$(function() {
				$("#idii1r10c2").blur(function() {
					if(parseInt($("#idii1r1c2").val())+parseInt($("#idii1r2c2").val())+parseInt($("#idii1r3c2").val())+parseInt($("#idii1r4c2").val())+parseInt($("#idii1r5c2").val())+parseInt($("#idii1r6c2").val())+parseInt($("#idii1r7c2").val())+parseInt($("#idii1r8c2").val())+parseInt($("#idii1r9c2").val())!=parseInt($("#idii1r10c2").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
					if ($(this).val() == 0) {
						$("#idii3r1c2").prop("disabled", true);
					}
				});
			});
			
			$(function() {
				$("#idii3r1c1").blur(function() {
					if(parseInt($("#idii3r1c1").val()) > parseInt($("#idii1r10c1").val())) {
						alert("Valor debe ser menor o igual que total numeral 1 columna 1");
					}
				});
			});
			
			$(function() {
				$("#idii3r1c2").blur(function() {
					if(parseInt($("#idii3r1c2").val()) > parseInt($("#idii1r10c2").val())) {
						alert("Valor debe ser menor o igual que total numeral 1 columna 2");
					}
				});
			});
			
			$(function() {
				$("#idii1r10c1, #idii1r10c2").blur(function() {
					if ($("#idii1r10c1").val()==0 && $("#idii1r10c2").val()==0) {
						$('input[name=ii2r1c1]').attr("disabled",true);
						$('input[name=ii2r1c1]').attr("checked",false);
						$("#ii3").prop("disabled", true);
						$("#idii3r1c1,#idii3r1c2").val("");
					}
					else {
						$('input[name=ii2r1c1]').attr("disabled",false);
					}
				});
			});
			
			$(function() {
				$("#idii3r1c1,#idii3r1c2").blur(function() {
					if ($("#idii3r1c1").val()== 0 && $("#idii3r1c2").val() == 0) {
						alert("VALOR DEBE SER MAYOR QUE CERO");
					}
				});
			});
		
			$(document).ready(function(){
    			$('[data-toggle="tooltip"]').tooltip();   
			});
			
			$(window).on('hidden.bs.modal', function() {
				$.ajax({
					url: "../persistencia/grabactl.php",
	                type: "POST",
	                data: {obser: "obs", numero: $("#numero").val(), capit: "2", observa: $("#obscrit").val()},
	                success: function(dato) {
					}
				});
			});
			
			$(function() {
				$("#wc2").affix({
					offset: {top: 10}
				});
			});
			
			$(document).ready(function(){
				$('[data-toggle="popover"]').popover();
			});
		</script>
	</head>
	<body>
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
 		</div>
 		
 		<div class="container text-justify" style="font-size: 12px">
			Este m&oacute;dulo  determina la cantidad de vacantes durante el "I trimestre del año <?php echo $vig;?>" e  identifica sus caracter&iacute;sticas. 
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
							  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1"> Si
							</label>
							<label class="radio-inline">
							  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2"> No
							</label>
						</div>
					</div>
					
					<div class="form-group form-group-sm col-xs-12 col-sm-11 col-sm-offset-1 ">
						<label class="col-xs-12 col-sm-4">Indique la  cantidad  de  vacantes abiertas</label>
						<div class='col-xs-12 col-sm-3 small'>
							<input type='text' class='form-control input-sm text-right' id='idii1r1c2' name='ii1r1c2' value = "<?php echo $row['II1R1C2']?>" maxlength="9" />
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
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">Cantidad de vacantes abiertas</label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idii1r1c2' name='ii1r1c2' value = "<?php echo $row['II1R1C2']?>" maxlength="9" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">&Aacute;rea funcional</label>
							<div class='small'>
								<select class='form-control input-sm'>
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
								<select class='form-control input-sm'>
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
								<select class='form-control input-sm'>
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
								<input type='text' class='form-control input-sm text-right' id='idii1r1c2' name='ii1r1c2' value = "<?php echo $row['II1R1C2']?>" maxlength="9" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">Modalidad de Contratación</label>
							<div class='small'>
								<select class='form-control input-sm'>
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
								<input type='text' class='form-control input-sm text-right' id='idii1r1c2' name='ii1r1c2' value = "<?php echo $row['II1R1C2']?>" maxlength="9" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">Edad</label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idii1r1c2' name='ii1r1c2' value = "<?php echo $row['II1R1C2']?>" maxlength="9" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">De las vacantes ¿Cuántas logró cubrir?</label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idii1r1c2' name='ii1r1c2' value = "<?php echo $row['II1R1C2']?>" maxlength="9" />
							</div>
						</div>
					</div>
					
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">De las vacantes cubiertas ¿cuantas se ocuparon con hombres?</label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idii1r1c2' name='ii1r1c2' value = "<?php echo $row['II1R1C2']?>" maxlength="9" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">De las vacantes cubiertas ¿Cuántas se ocuparon con mujeres?</label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idii1r1c2' name='ii1r1c2' value = "<?php echo $row['II1R1C2']?>" maxlength="9" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label class="">De las vacantes ¿Cuántas NO logró cubrir? </label>
							<div class='small'>
								<input type='text' class='form-control input-sm text-right' id='idii1r1c2' name='ii1r1c2' value = "<?php echo $row['II1R1C2']?>" maxlength="9" />
							</div>
						</div>
						
					</div>
					
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
							<label>De las vacantes NO cubiertas ¿Cuáles fueron las causas?</label>
							<div class="small">
								<select class='form-control input-sm'>
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
							<input type='text' class='form-control input-sm text-right' id='idii1r1c2' name='ii1r1c2' value = "<?php //echo $row['II1R1C2']?>" maxlength="9" />
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
							    <input type="checkbox" value="">
							    Option one is this and that&mdash;be sure to include why it's great
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" value="">
							    Option one is this and that&mdash;be sure to include why it's great
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" value="">
							    Option one is this and that&mdash;be sure to include why it's great
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" value="">
							    Option one is this and that&mdash;be sure to include why it's great
							  </label>
							</div>
						</div>
						
					</div>
						
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" value="">
							    Cambio de valor para saber cual carajoss es
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" value="">
							    Option one is this and that&mdash;be sure to include why it's great
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" value="">
							    Option one is this and that&mdash;be sure to include why it's great
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" value="">
							    Option one is this and that&mdash;be sure to include why it's great
							  </label>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-12">
							<label class="">Cual?</label>
							<input type='text' class='form-control input-sm' id='idii1r1c2' name='ii1r1c2' value = "<?php //echo $row['II1R1C2']?>" maxlength="9" />
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
							<input type='text' class='form-control input-sm' id='idii1r1c2' name='ii1r1c2' value = "<?php //echo $row['II1R1C2']?>" maxlength="9" />
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
</h6>