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
 			<?php echo $numero . "-" . $nombre?> - CAP&Iacute;TULO II - INVERSI&Oacute;N EN ACTIVIDADES CIENT&Iacute;FICAS, TECNOL&Oacute;GICAS Y DE INNOVACI&Oacute;N EN LOS A&Ntilde;OS <?php echo $anterior . "-" . $vig . " . " . $txtEstado ?>
 		</div>
 		<?php
 			if ($bloquear == "SI") {
 				echo "<h3>No requiere diligenciamiento</h3>";
 			}
 			else {
 		?>
 		<div class="container text-justify" style="font-size: 12px">
			Las Actividades Cient&iacute;ficas, Tecnol&oacute;gicas y de Innovaci&oacute;n (ACTI) son todas aquellas actividades que la empresa
			realiza para producir, promover, difundir y/o aplicar conocimientos cient&iacute;ficos y t&eacute;cnicos; as&iacute; como tambi&eacute;n
			para el desarrollo o introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados, de procesos nuevos o
			significativamente mejorados, de m&eacute;todos organizativos nuevos, o de t&eacute;cnicas de comercializaci&oacute;n nuevas.<br><br> 
 			<b>&iquest;Quien deber&iacute;a responder este cap&iacute;tulo?:</b>&nbsp;Personas del &aacute;rea financiera y que conozcan las
 				inversiones y gastos de la empresa en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n 
 		</div>

		<input type="hidden" name="tipousu" id="idTipo" value="<?php echo $tipousu ?>" />
		<form class='form-horizontal' role='form' data-toggle='validator' name="capitulo2" id="capitulo2" method="post" disabled>
			<div class='container'>
				<input type="hidden" name="C2_nordemp" id="numero" value="<?php echo $numero ?>" />
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii1&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> II.1 Indique el valor invertido por su empresa en los a&ntilde;os
						<?php echo $anterior . "-" . $vig?>, en cada una de las siguientes actividades cient&iacute;ficas, tecnol&oacute;gicas
						y de innovaci&oacute;n, para la introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados,
						y/o la implementaci&oacute;n de procesos nuevos o significativamente mejorados, de m&eacute;todos organizativos nuevos,
						o de t&eacute;cnicas de comercializaci&oacute;n nuevas.</b></h5>
					</legend>
					
					<center><img src="../images/mensaje.png" alt="Smiley face" height="" width=""></center>
					
					<div class='form-group form-group-sm'>
						<center><img src="../images/mensaje.png" alt="Smiley face" height="" width=""></center>
						<div class='col-sm-6 small'>&nbsp;</div>
						<div class='col-sm-2 small text-right'><b>Monto invertido <?php echo $anterior?></b></div>
						<div class='col-sm-2 small text-right'><b>Monto invertido <?php echo $vig?></b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn11">
							<b>1. </b>Actividades de I+D Internas. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Actividades de I+D Internas.' data-content='Trabajos de creación sistemáticos llevados a cabo dentro de la empresa con el fin de aumentar el volumen de conocimientos y su utilización para idear y validar servicios, bienes o procesos nuevos o significativamente mejorados. (Corresponde únicamente a los montos de inversión asociados a la etapa de investigación y desarrollo, previos a la de producción de los servicios, bienes o procesos nuevos o significativamente mejorados).'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r1c1' name='ii1r1c1' value = "<?php echo $row['II1R1C1']?>" maxlength="9" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r1c2' name='ii1r1c2' value = "<?php echo $row['II1R1C2']?>" maxlength="9" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn12">
							<b>2. </b>Adquisici&oacute;n de I+D (externa). <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Adquisici&oacute;n de I+D (externa).' data-content='Adquisición o financiación de las mismas actividades que las arriba indicadas (I+D) pero realizadas por otras organizaciones públicas o privadas (incluye organismos de investigación).'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r2c1' name='ii1r2c1' value = "<?php echo $row['II1R2C1']?>" maxlength="9" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r2c2' name='ii1r2c2' value = "<?php echo $row['II1R2C2']?>" maxlength="9" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn13">
							<b>3. </b>Adquisici&oacute;n de maquinaria y equipo. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Adquisici&oacute;n de maquinaria y equipo.' data-content='Maquinaria y equipo, específicamente comprada para la producción o introducción de servicios, bienes o procesos nuevos o significativamente mejorados. (No incluir maquinaria y equipo para I+D registrada en el ítem 1, ni la comprada simplemente para la reposición o ampliación de capacidad instalada, es decir, aquellos dedicados a la producción tradicional).'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r3c1' name='ii1r3c1' value = "<?php echo $row['II1R3C1']?>" maxlength="9" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r3c2' name='ii1r3c2' value = "<?php echo $row['II1R3C2']?>" maxlength="9" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn14">
							<b>4. </b>Tecnolog&iacute;as de informaci&oacute;n y telecomunicaciones. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Tecnolog&iacute;as de informaci&oacute;n y telecomunicaciones.' data-content='Adquisición, generación, outsourcing o arriendo de elementos de hardware, software y/o servicios para el manejo o procesamiento de la información, específicamente destinados a la producción o introducción de servicios, bienes o procesos nuevos o significativamente mejorados. (No incluir las tecnologías de información y telecomunicaciones  para I+D registradas en el ítem 1, ni las compradas simplemente para la reposición o ampliación de capacidad instalada, es decir, aquellas dedicadas a la producción tradicional).'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r4c1' name='ii1r4c1' value = "<?php echo $row['II1R4C1']?>" maxlength="9" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r4c2' name='ii1r4c2' value = "<?php echo $row['II1R4C2']?>" maxlength="9" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn15">
							<b>5. </b>Mercadotecnia. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Mercadotecnia.' data-content='Es la inversión en un nuevo método de comercialización que implica cambios significativos en el diseño o empaque de un producto -sea éste nuevo o no-, así como su posicionamiento, promoción o fijación de precios. Incluye las nuevas técnicas de investigación de mercados y publicidad de lanzamiento.'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r5c1' name='ii1r5c1' value = "<?php echo $row['II1R5C1']?>" maxlength="9" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r5c2' name='ii1r5c2' value = "<?php echo $row['II1R5C2']?>" maxlength="9" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn16">
							<b>6. </b>Transferencia de tecnolog&iacute;a y/o adquisici&oacute;n de otros conocimientos externos. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' data-placement='left' title='Transferencia de tecnolog&iacute;a y/o adquisici&oacute;n de otros conocimientos externos.' data-content='Adquisición o uso bajo licencia, de patentes u otros registros de propiedad intelectual, de inventos no patentados y conocimientos técnicos o de otro tipo; de otras empresas u organizaciones para utilizar en las innovaciones de su empresa. Incluye acceso a bases de resúmenes y referencias bibliográficas de literatura científica o de ingeniería, así como modalidades de transferencia de know-how, definida como aquella relacionada con conocimiento no escrito y no protegido por patentes. (No incluir los reportado en adquisición de I+D interna y externa).'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r6c1' name='ii1r6c1' value = "<?php echo $row['II1R6C1']?>" maxlength="9" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r6c2' name='ii1r6c2' value = "<?php echo $row['II1R6C2']?>" maxlength="9" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn17">
							<b>7. </b>Asistencia t&eacute;cnica y consultor&iacute;a. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Asistencia t&eacute;cnica y consultor&iacute;a.' data-content='Asesorías para la utilización de conocimientos tecnológicos aplicados, por medio del ejercicio de un arte o técnica, específicamente contratadas  para la producción o introducción de servicios, bienes o procesos nuevos o significativamente mejorados. Incluye procesos de sondeo, monitoreo o vigilancia tecnológica e inteligencia competitiva, entre otros. (No incluir los reportado en adquisición de I+D interna y externa).'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r7c1' name='ii1r7c1' value = "<?php echo $row['II1R7C1']?>" maxlength="9" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r7c2' name='ii1r7c2' value = "<?php echo $row['II1R7C2']?>" maxlength="9" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn18">
							<b>8. </b>Ingenier&iacute;a y dise&ntilde;o industrial. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Ingenier&iacute;a y dise&ntilde;o industrial.' data-content='Cambios en los métodos o patrones de producción y control de calidad, y elaboración de planos y diseños orientados a definir procedimientos técnicos, necesarios para la producción o introducción de servicios, bienes o procesos nuevos o significativamente mejorados en la empresa. (No incluir lo reportado en adquisición de I+D interna y externa).'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r8c1' name='ii1r8c1' value = "<?php echo $row['II1R8C1']?>" maxlength="9" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r8c2' name='ii1r8c2' value = "<?php echo $row['II1R8C2']?>" maxlength="9" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn19">
							<b>9. </b>Formaci&oacute;n y capacitaci&oacute;n. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Formaci&oacute;n y capacitaci&oacute;n.' data-content='Formación de su personal, sea interna o externa, destinada específicamente a la introducción de productos nuevos o significativamente mejorados, y/o la implementación de procesos nuevos o significativamente mejorados, de métodos organizativos nuevos, o de técnicas de comercialización nuevas. (No incluir lo reportado en adquisición de I+D interna y externa).'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r9c1' name='ii1r9c1' value = "<?php echo $row['II1R9C1']?>" maxlength="9" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r9c2' name='ii1r9c2' value = "<?php echo $row['II1R9C2']?>" maxlength="9" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-right' id="txtn110">
							<b>TOTAL MONTO INVERTIDO.</b>
						</div>
						<div class='col-sm-2 small text-right' style='margin-left: 30px'>
							<input type='text' class='form-control input-sm text-right' id='idii1r10c1' name='ii1r10c1' value = "<?php echo $row['II1R10C1']?>" maxlength="9" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r10c2' name='ii1r10c2' value = "<?php echo $row['II1R10C2']?>" maxlength="9" />
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii2&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> II.2 &iquest;Su empresa realiz&oacute; actividades relacionadas con biotecnolog&iacute;a
						durante el per&iacute;odo <?php echo $anterior . "-" . $vig?>?</b></h5>
					</legend>
					<div class='container-fluid text-justify' style='margin-left: 30px' id="txtn21">
						<p>Biotecnolog&iacute;a es la aplicaci&oacute;n de la ciencia y la tecnolog&iacute;a a organismos vivos, as&iacute; como
						partes, productos y modelos de los mismos, para alterar materiales vivos o no, con el fin de producir conocimientos,
						bienes o servicios.</p>
					</div>
					<div class='form-group form-group-sm'>
						<div class='form-group form-group-sm'>
						<div class='col-sm-6 small'>&nbsp;</div>
						<div class='col-sm-4 small text-right' id="ii2">
							<label class='radio-inline'><input type='radio' id='idii2r1c1' name='ii2r1c1' value = '1' <?php echo ($row['II2R1C1'] == 1) ? 'checked' : ''?> <?php echo $estadoII2 ?> /><b>SI</b>(Pase al numeral II.3)</label>
							<label class='radio-inline'><input type='radio' id='idii2r1c12' name='ii2r1c1' value = '2' <?php echo ($row['II2R1C1'] == 2) ? 'checked' : ''?> <?php echo $estadoII2 ?> /><b>NO</b>(Pase al cap&iacute;tulo III)</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id="ii3" <?php echo $estadoII3 ?>>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> II.3 Del valor total invertido en ACTI (pregunta II.1), indique el monto correspondiente
						a actividades relacionadas con Biotecnolog&iacute;a realizadas por su empresa en los a&ntilde;os <?php echo $anterior . "-" . $vig?>.</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small'>&nbsp;</div>
						<div class='col-sm-2 small text-right' id="txtn31"><b>Monto invertido <?php echo $anterior?></b></div>
						<div class='col-sm-2 small text-right' id="txtn32"><b>Monto invertido <?php echo $vig?></b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small'>&nbsp;</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii3r1c1' name='ii3r1c1' value = "<?php echo $row['II3R1C1']?>" <?php echo $estadoII31 ?> maxlength="9" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii3r1c2' name='ii3r1c2' value = "<?php echo $row['II3R1C2']?>" <?php echo $estadoII32 ?> maxlength="9" />
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
 		<?php }?>
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
