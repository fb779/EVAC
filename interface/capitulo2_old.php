 <?
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$page='cap2';
	$vig='2014';
	$anterior = $vig-1;
	$tabla = 'capitulo_ii';
	$bloquear = "NO";
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	include '../persistencia/cargaDato.php';
	
	$estadoII3 = '';
	if ($row['II2R1C1']!=1) {
		$estadoII3 = 'disabled';
	}
	
	$qC1 = $conn->prepare("SELECT * FROM capitulo_i WHERE C1_nordemp = :nFuente AND vigencia = :periodo");
	$qC1->execute(array('nFuente'=>$numero, 'periodo'=>$vig));
	$rowC1 = $qC1->fetch(PDO::FETCH_ASSOC);
	if (!($rowC1)) {
		$bloquear = "SI";
	}
	else {
		if ($rowC1['I1R1C1N']!=1 AND $rowC1['I1R2C1N']!=1 AND $rowC1['I1R3C1N']!=1 AND $rowC1['I1R1C1M']!=1 AND $rowC1['I1R2C1M']!=1 AND $rowC1['I1R3C1M']!=1
			AND $rowC1['I1R4C1']!=1 AND $rowC1['I1R5C1']!=1 AND $rowC1['I1R6C1']!=1) {
			$bloquear = "SI";
		}
	}
	
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
		<script type="text/javascript" src="../js/cargaDato.js"></script>
		<script type="text/javascript" src="../js/validaForm2.js"></script>
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
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
		              }
				else {
					retorno = "id"+retorno;
					document.getElementById(retorno).focus();
				}
			}
                });
            });
			});
			
			$(function() {
				$("#idii1r1c1,#idii1r2c1,#idii1r3c1,#idii1r4c1,#idii1r5c1,#idii1r6c1,#idii1r7c1,#idii1r8c1,#idii1r9c1,#idii1r10c1,#idii1r1c2,#idii1r2c2,#idii1r3c2,#idii1r4c2,#idii1r5c2,#idii1r6c2,#idii1r7c2,#idii1r8c2,#idii1r9c2,#idii1r10c2,#idii3r1c1,#idii3r2c2").keyup(function(){
					if ($(this).val() != "")
						$(this).val( $(this).val().replace(/[^0-9\.]/g, "") );
				});
			});
		
			$(function() {
				$("#idii2r1c1").click(function() {
					$("#ii3").removeAttr('disabled');
					$("#idii3r1c1").focus();
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
				});
			});

			$(function() {
				$("#idii1r10c2").blur(function() {
					if(parseInt($("#idii1r1c2").val())+parseInt($("#idii1r2c2").val())+parseInt($("#idii1r3c2").val())+parseInt($("#idii1r4c2").val())+parseInt($("#idii1r5c2").val())+parseInt($("#idii1r6c2").val())+parseInt($("#idii1r7c2").val())+parseInt($("#idii1r8c2").val())+parseInt($("#idii1r9c2").val())!=parseInt($("#idii1r10c2").val())) {
						alert("TOTAL DIGITADO INVALIDO");
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
				$("#idii1r10c2").blur(function() {
					if ($("#idii1r10c1").val()==0 && $("#idii1r10c2").val()==0) {
						$('input[name=ii2r1c1]').attr("disabled",true);
						$('input[name=ii2r1c1]').attr("checked",false);
						$("#ii3").prop("disabled", true);
						$("#ii3r1c1,#idii3r1c2").val("");
					}
				});
			});
		
			$(document).ready(function(){
    			$('[data-toggle="tooltip"]').tooltip();   
			});
		</script>
	</head>
	<body>
		<?php
			include 'menuFuente.php';
		?>
		<br><br><br>
		<div class="well well-sm" style="font-weight: bold">
 				CAP&Iacute;TULO II - INVERSI&Oacute;N EN ACTIVIDADES CIENT&Iacute;FICAS, TECNOL&Oacute;GICAS Y DE INNOVACI&Oacute;N EN LOS A&Ntilde;OS <?php echo $anterior . "-" . $vig?>
 		</div>
 		<?php
 			if ($bloquear == "SI") {
 				echo "<h3>BLOQUEO</h3>";
 			}
 			else {
 		?>
 		<div class="container-fluid text-justify">
			Las Actividades Cient&iacute;ficas, Tecnol&oacute;gicas y de Innovaci&oacute;n (ACTI) son todas aquellas actividades que la empresa
			realiza para producir, promover, difundir y/o aplicar conocimientos cient&iacute;ficos y t&eacute;cnicos; as&iacute; como tambi&eacute;n
			para el desarrollo o introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados, de procesos nuevos o
			significativamente mejorados, de m&eacute;todos organizativos nuevos, o de t&eacute;cnicas de comercialización nuevas.<br><br> 
 			<b>&iquest;Quien deber&iacute;a responder este cap&iacute;tulo?:</b>&nbsp;Personas del &aacute;rea financiera y que conozcan las
 				inversiones y gastos de la empresa en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n 
 		</div>

		<form class='form-horizontal' role='form' data-toggle='validator' name="capitulo2" id="capitulo2" method="post" disabled>
			<div class='container'>
				<input type="hidden" name="C2_nordemp" id="numero" value="<?php echo $numero ?>" />
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h4 style='font-family: arial'>II.1 Indique el valor invertido por su empresa en los a&ntilde;os
						<?php echo $anterior . "-" . $vig?>, en cada una de las siguientes actividades cient&iacute;ficas, tecnol&oacute;gicas
						y de innovaci&oacute;n, para la introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados,
						y/o la implementaci&oacute;n de procesos nuevos o significativamente mejorados, de m&eacute;todos organizativos nuevos,
						o de t&eacute;cnicas de comercializaci&oacute;n nuevas.</h4>
					</legend>
					
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small'>&nbsp;</div>
						<div class='col-sm-2 small text-right'><b>Monto invertido <?php echo $anterior?></b></div>
						<div class='col-sm-2 small text-right'><b>Monto invertido <?php echo $vig?></b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn11">
							<b>1. </b>Actividades de I+D Internas. <a href='#'><span class='glyphicon glyphicon-info-sign'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r1c1' name='ii1r1c1' value = "<?php echo $row['II1R1C1']?>" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r1c2' name='ii1r1c2' value = "<?php echo $row['II1R1C2']?>" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn12">
							<b>2. </b>Adquisici&oacute;n de I+D (externa). <a href='#'><span class='glyphicon glyphicon-info-sign'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r2c1' name='ii1r2c1' value = "<?php echo $row['II1R2C1']?>" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r2c2' name='ii1r2c2' value = "<?php echo $row['II1R2C2']?>" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn13">
							<b>3. </b>Adquisici&oacute;n de maquinaria y equipo. <a href='#'><span class='glyphicon glyphicon-info-sign'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r3c1' name='ii1r3c1' value = "<?php echo $row['II1R3C1']?>" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r3c2' name='ii1r3c2' value = "<?php echo $row['II1R3C2']?>" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn14">
							<b>4. </b>Tecnolog&iacute;as de informaci&oacute;n y telecomunicaciones. <a href='#'><span class='glyphicon glyphicon-info-sign'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r4c1' name='ii1r4c1' value = "<?php echo $row['II1R4C1']?>" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r4c2' name='ii1r4c2' value = "<?php echo $row['II1R4C2']?>" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn15">
							<b>5. </b>Mercadotecnia. <a href='#'><span class='glyphicon glyphicon-info-sign'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r5c1' name='ii1r5c1' value = "<?php echo $row['II1R5C1']?>" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r5c2' name='ii1r5c2' value = "<?php echo $row['II1R5C2']?>" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn16">
							<b>6. </b>Transferencia de tecnolog&iacute;a y/o adquisici&oacute;n de otros conocimientos externos. <a href='#'><span class='glyphicon glyphicon-info-sign'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r6c1' name='ii1r6c1' value = "<?php echo $row['II1R6C1']?>" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r6c2' name='ii1r6c2' value = "<?php echo $row['II1R6C2']?>" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn17">
							<b>7. </b>Asistencia t&eacute;cnica y consultor&iacute;a. <a href='#'><span class='glyphicon glyphicon-info-sign'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r7c1' name='ii1r7c1' value = "<?php echo $row['II1R7C1']?>" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r7c2' name='ii1r7c2' value = "<?php echo $row['II1R7C2']?>" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn18">
							<b>8. </b>Ingenier&iacute;a y dise&ntilde;o industrial. <a href='#'><span class='glyphicon glyphicon-info-sign'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r8c1' name='ii1r8c1' value = "<?php echo $row['II1R8C1']?>" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r8c2' name='ii1r8c2' value = "<?php echo $row['II1R8C2']?>" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn19">
							<b>9. </b>Formaci&oacute;n y capacitaci&oacute;n. <a href='#'><span class='glyphicon glyphicon-info-sign'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r9c1' name='ii1r9c1' value = "<?php echo $row['II1R9C1']?>" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r9c2' name='ii1r9c2' value = "<?php echo $row['II1R9C2']?>" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-right' id="txtn110">
							<b>TOTAL MONTO INVERTIDO.</b>
						</div>
						<div class='col-sm-2 small text-right' style='margin-left: 30px'>
							<input type='text' class='form-control input-sm text-right' id='idii1r10c1' name='ii1r10c1' value = "<?php echo $row['II1R10C1']?>" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii1r10c2' name='ii1r10c2' value = "<?php echo $row['II1R10C2']?>" />
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h4 style='font-family: arial'>II.2 &iquest;Su empresa realiz&oacute; actividades relacionadas con biotecnolog&iacute;a
						durante el per&iacute;odo <?php echo $anterior . "-" . $vig?>?								
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
							<label class='radio-inline'><input type='radio' id='idii2r1c1' name='ii2r1c1' value = '1' <?php echo ($row['II2R1C1'] == 1) ? 'checked' : ''?> /><b>SI</b>(Pase al numeral II.3)</label>
							<label class='radio-inline'><input type='radio' id='idii2r1c12' name='ii2r1c1' value = '2' <?php echo ($row['II2R1C1'] == 2) ? 'checked' : ''?> /><b>NO</b>(Pase al cap&iacute;tulo III)</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id="ii3" <?php echo $estadoII3 ?>>
					<legend><h4 style='font-family: arial'>II.3 Del valor total invertido en ACTI (pregunta II.1), indique el monto correspondiente
						a actividades relacionadas con Biotecnolog&iacute;a realizadas por su empresa en los a&ntilde;os <?php echo $anterior . "-" . $vig?>.</h4>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small'>&nbsp;</div>
						<div class='col-sm-2 small text-right' id="txtn31"><b>Monto invertido <?php echo $anterior?></b></div>
						<div class='col-sm-2 small text-right' id="txtn32"><b>Monto invertido <?php echo $vig?></b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small'>&nbsp;</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii3r1c1' name='ii3r1c1' value = "<?php echo $row['II3R1C1']?>" />
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idii3r1c2' name='ii3r1c2' value = "<?php echo $row['II3R1C2']?>" />
						</div>
					</div>
				</fieldset>
				<div class='form-group form-group-sm'>
					<div class='col-md-8'>
						<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Cap&iacute;tulo II Actualizado Correctamente</p>
					</div>
					<div class='col-sm-1 small pull-right' id="btn_cont" style="display: none;" >
						<a href='capitulo3.php?numord=<?php echo $numero . "&nombre=" . $nombre?>' class='btn btn-default' data-toggle='tooltip' title='Ir a siguiente capítulo'>Continuar</a>
					</div>
					<div class='col-sm-1 small pull-right'>
						<button type='submit' class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar informaci&oacute;n Cap&iacute;tulo II'>Grabar</button>
					</div>
				</div>
			</div>  
 		</form>
 		<?php }?>
 	</body>
 </html> 
