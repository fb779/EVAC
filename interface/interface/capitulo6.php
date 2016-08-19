<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$page='cap6';
	$vig=$_SESSION['vigencia'];
	$estadObs = ($tipousu != "FU" ? "readonly" : "");
	$anterior = $vig-1;
	$tabla = 'capitulo_vi';
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	$grabaOK = false;
	include '../persistencia/cargaDato.php';
	
	$consLog = ($region == 99 ? true : false);
	
	$cLog = "<span class='glyphicon glyphicon-time' style='color: blue; font-size: 14px;'></span>";
	
	$estadoVI4 = 'disabled'; $estadoVI5 = 'disabled'; $estadoVI9 = 'disabled'; $estadoVI1R6 = ""; $estadoVI2R6 = ""; $estadoVI3R5 = "";
	if ($row['VI2R1C1']!=1 AND $row['VI2R2C1']!=1 AND $row['VI2R3C1']!=1 AND $row['VI2R4C1']!=1 AND $row['VI2R5C1']!=1 AND $row['VI2R6C1']!=1 AND $row['VI2R7C1']!=1) {
		$estadoVI4 = ''; $estadoVI2R6 = "disabled";
	}
	if ($row['VI2R1C1']==1 OR $row['VI2R2C1']==1 OR $row['VI2R3C1']==1 OR $row['VI2R4C1']==1 OR $row['VI2R5C1']==1 OR $row['VI2R6C1']==1 OR $row['VI2R7C1']==1 OR $row['VI4R1C1']==1) {
		$estadoVI5 = '';
	}
	if ($row['VI6R1C1']==1 OR $row['VI7R1C1']==1) {
		$estadoVI9 = '';
	}
	if ($row['VI1R1C1']!=1 AND $row['VI1R2C1']!=1 AND $row['VI1R3C1']!=1 AND $row['VI1R4C1']!=1 AND $row['VI1R5C1']!=1 AND $row['VI1R6C1']!=1 AND $row['VI1R7C1']!=1) {
		$estadoVI1R6 = 'disabled';
	}
	if ($row['VI3R1C1']!=1 AND $row['VI3R2C1']!=1 AND $row['VI3R3C1']!=1 AND $row['VI3R4C1']!=1) {
		$estadoVI3R5 = 'disabled';
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
		<script type="text/javascript" src="../js/validaForm6.js"></script>
		<script type="text/javascript" src="../js/valida1.js"></script>
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
            	$("#capitulo6").submit(function(event) {
                	event.preventDefault();

                $.ajax({
                    url: "../persistencia/grabacapi.php",
                    type: "POST",
                    data: $(this).serialize(),
					beforeSend:  validaForm6,
                    success: function(dato) {
                    	if (retorno=="") {
							$("#btn_cont").show();
							$("#idmsg").show();
							$(function() {
								$.ajax({
								url: "../persistencia/grabactl.php",
								type: "POST",
								data: {modulo: "m6", estado: "2", numero: $("#numero").val(), capitulo: "C6"},
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
								data: {modulo: "m6", estado: "1", numero: $("#numero").val(), capitulo: "C6"},
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
				$("#idvi1r1c2,#idvi1r2c2,#idvi1r3c2,#idvi1r4c2,#idvi1r5c2,#idvi1r6c2,#idvi1r7c2,#idvi1r8c2,#idvi2r1c2,#idvi2r2c2,#idvi2r3c2,#idvi2r4c2,#idvi2r5c2,#idvi2r6c2,#idvi2r7c2,#idvi2r8c2,#idvi3r1c2,#idvi3r2c2,#idvi3r3c2,#idvi3r4c2,#idvi3r5c2,#idvi6r1c2,#idvi7r1c2").keyup(function(){
					if ($(this).val() != "")
						$(this).val( $(this).val().replace(/[^0-9]/g, '') );
				});
			});

			$(function() {
				$("#idvi1r1c2,#idvi1r2c2,#idvi1r3c2,#idvi1r4c2,#idvi1r5c2,#idvi1r6c2,#idvi1r7c2,#idvi1r8c2,#idvi2r1c2,#idvi2r2c2,#idvi2r3c2,#idvi2r4c2,#idvi2r5c2,#idvi2r6c2,#idvi2r7c2,#idvi2r8c2,#idvi3r1c2,#idvi3r2c2,#idvi3r3c2,#idvi3r4c2,#idvi3r5c2,#idvi6r1c2,#idvi7r1c2").blur(function(){
					$(this).val(parseInt($(this).val()));
				});
			});
			
			//TOTAL NUM 1
			$(function() {
				$("#idvi1r8c2").blur(function() {
					var Total = 0;
					$("#idvi1r1c2,#idvi1r2c2,#idvi1r3c2,#idvi1r4c2,#idvi1r5c2,#idvi1r6c2,#idvi1r7c2").each(function() {
						if ($(this).is(":disabled")) {
							Total = parseInt(Total)+0;
						}
						else {
							Total = parseInt(Total)+parseInt($(this).val());
						}
					});
					if(parseInt(Total) != parseInt($("#idvi1r8c2").val())) {
						alert("TOTAL DIGITADO INVALIDO, POR FAVOR REVISE");
					}
				});
			});
			//TOTAL NUM 2
			$(function() {
				$("#idvi2r8c2").blur(function() {
					var Total = 0;
					$("#idvi2r1c2,#idvi2r2c2,#idvi2r3c2,#idvi2r4c2,#idvi2r5c2,#idvi2r6c2,#idvi2r7c2").each(function() {
						if ($(this).is(":disabled")) {
							Total = parseInt(Total)+0;
						}
						else {
							Total = parseInt(Total)+parseInt($(this).val());
						}
					});
					if(parseInt(Total) != parseInt($("#idvi2r8c2").val())) {
						alert("TOTAL DIGITADO INVALIDO, POR FAVOR REVISE");
					}
					if ($(this).val() > 0) {
						$("#vi4").prop("disabled", true);
						$("#id65").prop("disabled", false);
					}
				});
			});
			//TOTAL NUM 3
			$(function() {
				$("#idvi3r5c2").blur(function() {
					var Total = 0;
					$("#idvi3r1c2,#idvi3r2c2,#idvi3r3c2,#idvi3r4c2").each(function() {
						if ($(this).is(":disabled")) {
							Total = parseInt(Total)+0;
						}
						else {
							Total = parseInt(Total)+parseInt($(this).val());
						}
					});
					if(parseInt(Total) != parseInt($("#idvi3r5c2").val())) {
						alert("TOTAL DIGITADO INVALIDO, POR FAVOR REVISE");
					}
				});
			});
			
			$(function() {
				$("#idvi4r1c1").click(function() {
					$("#id65").prop("disabled", false);
				});
			});
			
			$(function() {
				$("#idvi4r1c12").click(function() {
					$("input:radio[name='vi5r1c1']").attr("checked", false);
					$("input:radio[name='vi5r2c1']").attr("checked", false);
					$("input:radio[name='vi5r3c1']").attr("checked", false);
					$("input:radio[name='vi5r4c1']").attr("checked", false);
					$("input:radio[name='vi5r5c1']").attr("checked", false);
					$("input:radio[name='vi5r6c1']").attr("checked", false);
					$("input:radio[name='vi5r7c1']").attr("checked", false);
					$("#id65").prop("disabled", true);
				});
			});

//NUMERAL 1
			$(function() {
				 var todoNO = true; var chequeado = true;
				$("#idvi1r1c1,#idvi1r2c1,#idvi1r3c1,#idvi1r4c1,#idvi1r5c1,#idvi1r6c1,#idvi1r7c1,#idvi1r1c12,#idvi1r2c12,#idvi1r3c12,#idvi1r4c12,#idvi1r5c12,#idvi1r6c12,#idvi1r7c12").click(function() {
					var cierto=0;
					$("#idvi1r1c1,#idvi1r2c1,#idvi1r3c1,#idvi1r4c1,#idvi1r5c1,#idvi1r6c1,#idvi1r7c1").each(function() {
						if($(this).prop("checked")) {
							cierto=1;	
						}
						
					});
						
					if(cierto==1){
						$("#idvi1r8c2").val("");
						$("#idvi1r8c2").prop("disabled", false);
					}
					else{
						$("#idvi1r8c2").val("");
						$("#idvi1r8c2").prop("disabled", true);
					}
				});
			});			
			
//NUMERAL 2
			$(function() {
				var todoNO = true; var chequeado = true;
				$("#idvi2r1c1,#idvi2r2c1,#idvi2r3c1,#idvi2r4c1,#idvi2r5c1,#idvi2r6c1,#idvi2r7c1,#idvi2r1c12,#idvi2r2c12,#idvi2r3c12,#idvi2r4c12,#idvi2r5c12,#idvi2r6c12,#idvi2r7c12").click(function() {
					var cierto=0;
					$("#idvi2r1c1,#idvi2r2c1,#idvi2r3c1,#idvi2r4c1,#idvi2r5c1,#idvi2r6c1,#idvi2r7c1").each(function() {
						if($(this).prop("checked")) {
							cierto=1;
						}
					});
					if(cierto==1){
						$("#idvi2r8c2").val("");
						$("#idvi2r8c2").prop("disabled", false);
						$("input[name='vi4r1c1']").prop("disabled", true);
						$("input:radio[name='vi4r1c1']").attr("checked", false);
						$("input:radio[name='vi5r1c1']").attr("checked", false);
						$("input:radio[name='vi5r2c1']").attr("checked", false);
						$("input:radio[name='vi5r3c1']").attr("checked", false);
						$("input:radio[name='vi5r4c1']").attr("checked", false);
						$("input:radio[name='vi5r5c1']").attr("checked", false);
						$("input:radio[name='vi5r6c1']").attr("checked", false);
						$("input:radio[name='vi5r7c1']").attr("checked", false);
						$("#id65").prop("disabled", false);
					}
					else{
						$("#idvi2r8c2").val("");
						$("#idvi2r8c2").prop("disabled", true);
						$("input[name='vi4r1c1']").attr("disabled", false);
						$("#id65").prop("disabled", true);
					}
				});
			});
			
			$(function() {
				$("#idvi2r1c1,#idvi2r2c1,#idvi2r3c1,#idvi2r4c1,#idvi2r5c1,#idvi2r6c1,#idvi2r7c1").click(function() {
					$("input[name='vi4r1c1']").prop("disabled", true);
					$("#id65").prop("disabled", false);	
				});
			});

// NUMERAL 3

			$(function() {
				var todoNO = true; var chequeado = true;
				$("#idvi3r1c1,#idvi3r2c1,#idvi3r3c1,#idvi3r4c1,#idvi3r1c12,#idvi3r2c12,#idvi3r3c12,#idvi3r4c12").click(function() {
					var cierto=0;
					$("#idvi3r1c1,#idvi3r2c1,#idvi3r3c1,#idvi3r4c1").each(function() {
						if($(this).prop("checked")) {
							cierto=1;
						}
					});

					if(cierto==1){
						$("#idvi3r5c2").val("");
						$("#idvi3r5c2").prop("disabled", false);
					}
					else{
						$("#idvi3r5c2").val("");
						$("#idvi3r5c2").prop("disabled", true);
					}
				});
			});

			// Numeral 6 y7
			$(function() {
				var todoNO = true; var chequeado = true;
				$("#idvi6r1c1,#idvi7r1c1,#idvi6r1c12,#idvi7r1c12").click(function() {
					var cierto=0;
					$("#idvi6r1c1,#idvi7r1c1").each(function() {
						if($(this).prop("checked")) {
							//alert ("mmm");
							cierto=1;
						}
					});
					
					if(cierto==1){
						$("input:radio[name='vi9r1c1']").attr("disabled", false);
						$("input:radio[name='vi9r2c1']").attr("disabled", false);
						$("input:radio[name='vi9r3c1']").attr("disabled", false);
						$("input:radio[name='vi9r4c1']").attr("disabled", false);
						$("input:radio[name='vi9r5c1']").attr("disabled", false);
						$("input:radio[name='vi9r6c1']").attr("disabled", false);
						$("input:radio[name='vi9r7c1']").attr("disabled", false);
						
						$("#id69").attr("disabled", false);
					}
					else{
						$("input:radio[name='vi9r1c1']").attr("disabled", true);
						$("input:radio[name='vi9r2c1']").attr("disabled", true);
						$("input:radio[name='vi9r3c1']").attr("disabled", true);
						$("input:radio[name='vi9r4c1']").attr("disabled", true);
						$("input:radio[name='vi9r5c1']").attr("disabled", true);
						$("input:radio[name='vi9r6c1']").attr("disabled", true);
						$("input:radio[name='vi9r7c1']").attr("disabled", true);	
						
						$("input:radio[name='vi9r1c1']").attr('checked', false);
						$("input:radio[name='vi9r2c1']").attr("checked", false);
						$("input:radio[name='vi9r3c1']").attr("checked", false);
						$("input:radio[name='vi9r4c1']").attr("checked", false);
						$("input:radio[name='vi9r5c1']").attr("checked", false);
						$("input:radio[name='vi9r6c1']").attr("checked", false);
						$("input:radio[name='vi9r7c1']").attr("checked", false);
						$("#id69").attr("disabled", true);
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
	                data: {obser: "obs", numero: $("#numero").val(), capit: "6", observa: $("#obscrit").val()},
	                success: function(dato) {
					}
				});
			});
			
			$(function() {
				$("#wc6").affix({
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
		<div class="well well-sm" style="font-size: 12px; padding-top: 60px; z-index: 1;" id="wc6">
 			<?php echo $numero . "-" . $nombre?> - CAP&Iacute;TULO VI - PROPIEDAD INTELECTUAL, CERTIFICACIONES DE CALIDAD, NORMAS T&Eacute;CNICAS Y REGLAMENTOS T&Eacute;CNICOS EN EL PER&Iacute;ODO <?php echo $anterior . "-" . $vig . " . " . $txtEstado ?>
 		</div>
		<div class="container text-justify" style="font-size: 12px">
 			<b>&iquest;Quien deber&iacute;a responder este cap&iacute;tulo?:</b>&nbsp;Personas familiarizadas con conceptos de propiedad
 			intelectual, patentes, derechos de autor y sistemas de gesti&oacute;n de calidad implementados en la empresa. 
 		</div>
		
		<input type="hidden" name="tipousu" id="idTipo" value="<?php echo $tipousu ?>" />
		<form class='form-horizontal' role='form' data-toggle='validator' name="capitulo6" id="capitulo6" method="post">
			<div class='container'>
				<input type="hidden" name="C6_nordemp" id="numero" value="<?php echo $numero ?>" />
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=vi1&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> VI.1 Para cada uno de los siguientes m&eacute;todos de protecci&oacute;n, indique si su
						empresa es titular de derechos de propiedad intelectual vigentes a diciembre de <?php echo $vig?>, y especifique el n&uacute;mero
						de registros correspondiente.</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 text-center'><b>Registros de propiedad intelectual</b></div>
						<div class='col-sm-2 small text-right'></div>
						<div class='col-sm-1 small text-right'>
							Total de registros  vigentes a diciembre de <?php echo $vig?>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 20px'>
							<b>1. </b>Patentes
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn11">
							<b>1.1 </b>Patentes de invenci&oacute;n <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Patentes de Invenci&oacute;n.' data-content='T&iacute;tulo que protege todo nuevo procedimiento, m&eacute;todo de fabricaci&oacute;n, m&aacute;quina, aparato, producto o una nueva soluci&oacute;n, cumpliendo los criterios de novedad, altura inventiva y aplicaci&oacute;n industrial. Las solicitudes son presentadas en oficinas nacionales de propiedad industrial. En Colombia, la entidad competente es la Superintendencia de Industria y Comercio.'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi1r1c1' name='vi1r1c1' value = '1' onClick="activaTextoII(this.id, 'idvi1r1c2', 'idvi1r8c2');" <?php echo ($row['VI1R1C1'] == 1) ? 'checked' : ''?>  />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi1r1c12' name='vi1r1c1' value = '2' onClick="activaTextoII(this.id, 'idvi1r1c2', 'idvi1r8c2');" <?php echo ($row['VI1R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi1r1c2' name='vi1r1c2' value = "<?php echo $row['VI1R1C2']?>" <?php echo ($row['VI1R1C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn12">
							<b>1.2 </b>Patentes de modelo de utilidad <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Patentes de modelo de utilidad.' data-content='T&iacute;tulo que protege toda nueva forma, configuraci&oacute;n o disposici&oacute;n de elementos, de alg&uacute;n artefacto, herramienta, instrumento u otro objeto o de alguna parte del mismo, que permita un mejor o diferente funcionamiento, utilizaci&oacute;n o fabricaci&oacute;n del objeto que le incorpore o que le proporcione alguna utilidad, ventaja o efecto t&eacute;cnico que antes no ten&iacute;a, con novedad y aplicaci&oacute;n industrial. Las solicitudes son presentadas en oficinas nacionales de patentes. En Colombia, la entidad competente es la Superintendencia de Industria y Comercio.'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi1r2c1' name='vi1r2c1' value = '1' onClick="activaTextoII(this.id, 'idvi1r2c2', 'idvi1r8c2');" <?php echo ($row['VI1R2C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi1r2c12' name='vi1r2c1' value = '2' onClick="activaTextoII(this.id, 'idvi1r2c2', 'idvi1r8c2');" <?php echo ($row['VI1R2C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi1r2c2' name='vi1r2c2' value = "<?php echo $row['VI1R2C2']?>" <?php echo ($row['VI1R2C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 20px'>
							<b>2. </b>Derechos de autor
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn13">
							<b>2.1 </b>Derechos de autor de obras literarias, art&iacute;sticas, musicales, audiovisuales, arquitect&oacute;nicas o fonogramas <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Derechos de autor de obras literarias, art&iacute;sticas, musicales, audiovisuales, arquitect&oacute;nicas o fonogramas.' data-content='T&iacute;tulo que se concede a los creadores de obras literarias y art&iacute;sticas. Entre &eacute;stas figuran las obras escritas como novelas, poemas, obras de teatro; obras musicales, art&iacute;sticas como pinturas, esculturas, pel&iacute;culas y coreograf&iacute;as; obras arquitect&oacute;nicas como mapas y dibujos t&eacute;cnicos; fonogramas. En Colombia, estos derechos nacen con la creaci&oacute;n de las obras; sin embargo, por razones de seguridad jur&iacute;dica, para efectos probatorios las obras pueden registrarse en las oficinas nacionales de derecho de autor. En Colombia, la entidad competente es la Direcci&oacute;n Nacional de Derecho de Autor, Unidad Administrativa Especial del Ministerio del Interior y de Justicia. Se excluyen los registros de software.'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi1r3c1' name='vi1r3c1' value = '1' onClick="activaTextoII(this.id, 'idvi1r3c2', 'idvi1r8c2');" <?php echo ($row['VI1R3C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi1r3c12' name='vi1r3c1' value = '2' onClick="activaTextoII(this.id, 'idvi1r3c2', 'idvi1r8c2');"<?php echo ($row['VI1R3C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi1r3c2' name='vi1r3c2' value = "<?php echo $row['VI1R3C2']?>" <?php echo ($row['VI1R3C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn14">
							<b>2.2 </b>Derechos de autor de registros de software <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Derechos de autor de registros de software.' data-content='T&iacute;tulos que protegen, bajo la modalidad de derecho de autor, las aplicaciones y sistemas   inform&aacute;ticos, los cuales pueden formar parte de un computador u otro tipo de aparato. Al igual que los dem&aacute;s t&iacute;tulos de derecho de autor, las solicitudes de registro son presentadas en oficinas nacionales de derecho de autor. En Colombia, la entidad competente es la Direcci&oacute;n Nacional de Derecho de Autor.'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi1r4c1' name='vi1r4c1' value = '1' onClick="activaTextoII(this.id, 'idvi1r4c2', 'idvi1r8c2');" <?php echo ($row['VI1R4C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi1r4c12' name='vi1r4c1' value = '2' onClick="activaTextoII(this.id, 'idvi1r4c2', 'idvi1r8c2');" <?php echo ($row['VI1R4C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi1r4c2' name='vi1r4c2' value = "<?php echo $row['VI1R4C2']?>" <?php echo ($row['VI1R4C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 20px' id="txtn15">
							<b>3. </b>Registros de dise&ntilde;os industriales <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Registros de dise&ntilde;os industriales.' data-content='T&iacute;tulo que protege toda forma externa o de apariencia est&eacute;tica de elementos funcionales o decorativos que sirven de patr&oacute;n para su producci&oacute;n en la industria, manufactura o artesan&iacute;a. Las solicitudes son presentadas en oficinas nacionales de propiedad industrial. En Colombia, la entidad competente es la Superintendencia de Industria y Comercio.'></span></a>
						</div>
						<div class='col-sm-2 small text-right' style='margin-left: 10px'>
							<label class='radio-inline'><input type='radio' id='idvi1r5c1' name='vi1r5c1' value = '1' onClick="activaTextoII(this.id, 'idvi1r5c2', 'idvi1r8c2');" <?php echo ($row['VI1R5C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi1r5c12' name='vi1r5c1' value = '2' onClick="activaTextoII(this.id, 'idvi1r5c2', 'idvi1r8c2');" <?php echo ($row['VI1R5C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi1r5c2' name='vi1r5c2' value = "<?php echo $row['VI1R5C2']?>" <?php echo ($row['VI1R5C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 20px' id="txtn16">
							<b>4. </b>Registros de marcas y otros signos distintivos <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Registros de marcas y otros signos distintivos.' data-content='T&iacute;tulo que protege las  marcas, lemas comerciales y denominaciones de origen. Las solicitudes son presentadas en oficinas nacionales de propiedad industrial. En Colombia, la entidad competente es la Superintendencia de Industria y Comercio.'></span></a>
						</div>
						<div class='col-sm-2 small text-right' style='margin-left: 10px'>
							<label class='radio-inline'><input type='radio' id='idvi1r6c1' name='vi1r6c1' value = '1' onClick="activaTextoII(this.id, 'idvi1r6c2', 'idvi1r8c2');" <?php echo ($row['VI1R6C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi1r6c12' name='vi1r6c1' value = '2' onClick="activaTextoII(this.id, 'idvi1r6c2', 'idvi1r8c2');" <?php echo ($row['VI1R6C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi1r6c2' name='vi1r6c2' value = "<?php echo $row['VI1R6C2']?>" <?php echo ($row['VI1R6C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 20px' id="txtn17">
							<b>5. </b>Certificados de obtentor de variedades vegetales <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Certificados de obtentor de variedades vegetales.' data-content='T&iacute;tulos que protegen el mejoramiento de variedades de plantas usadas en la agricultura, las cuales pueden comprender caracter&iacute;sticas de mayor rendimiento y una mejor resistencia a plagas y enfermedades. Las solicitudes se presentan ante las oficinas nacionales de obtenciones vegetales. En Colombia, la entidad competente es el Instituto Colombiano Agropecuario.'></span></a>
						</div>
						<div class='col-sm-2 small text-right' style='margin-left: 10px'>
							<label class='radio-inline'><input type='radio' id='idvi1r7c1' name='vi1r7c1' value = '1' onClick="activaTextoII(this.id, 'idvi1r7c2', 'idvi1r8c2');" <?php echo ($row['VI1R7C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi1r7c12' name='vi1r7c1' value = '2' onClick="activaTextoII(this.id, 'idvi1r7c2', 'idvi1r8c2');" <?php echo ($row['VI1R7C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi1r7c2' name='vi1r7c2' value = "<?php echo $row['VI1R7C2']?>" <?php echo ($row['VI1R7C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-right' style='margin-left: 30px' id="txtn18">
							<b>Total de registros de propiedad intelectual vigentes a diciembre <?php echo $vig?></b>
						</div>
						<div class='col-sm-2 small text-right'></div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi1r8c2' name='vi1r8c2' value = "<?php echo $row['VI1R8C2']?>" <?php echo $estadoVI1R6 ?> maxlength="6" /> 
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=vi2&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> VI.2 Para cada uno de los siguientes m&eacute;todos de protecci&oacute;n, indique si su
						empresa obtuvo derechos de propiedad intelectual durante el per&iacute;odo <?php echo $anterior . "-" . $vig?>, y especifique
						el n&uacute;mero de registros correspondientes.</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 text-center'><b>Registros de propiedad intelectual (Ver definiciones en VI.1)</b></div>
						<div class='col-sm-2 small text-right'></div>
						<div class='col-sm-1 small text-right'>
							Total de registros obtenidos <?php echo $anterior . "-" . $vig?>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 20px'>
							<b>1. </b>Patentes
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn21">
							<b>1.1 </b>Patentes de invenci&oacute;n
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi2r1c1' name='vi2r1c1' value = '1' onClick="activaTextoII(this.id, 'idvi2r1c2', 'idvi2r8c2');" <?php echo ($row['VI2R1C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi2r1c12' name='vi2r1c1' value = '2' onClick="activaTextoII(this.id, 'idvi2r1c2', 'idvi2r8c2');" <?php echo ($row['VI2R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi2r1c2' name='vi2r1c2' value = "<?php echo $row['VI2R1C2']?>" <?php echo ($row['VI2R1C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn22">
							<b>1.2 </b>Patentes de modelo de utilidad
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi2r2c1' name='vi2r2c1' value = '1' onClick="activaTextoII(this.id, 'idvi2r2c2', 'idvi2r8c2');" <?php echo ($row['VI2R2C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi2r2c12' name='vi2r2c1' value = '2' onClick="activaTextoII(this.id, 'idvi2r2c2', 'idvi2r8c2');" <?php echo ($row['VI2R2C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi2r2c2' name='vi2r2c2' value = "<?php echo $row['VI2R2C2']?>" <?php echo ($row['VI2R2C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 20px'>
							<b>2. </b>Derechos de autor
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn23">
							<b>2.1 </b>Derechos de autor de obras literarias, art&iacute;sticas, musicales, audiovisuales, arquitect&oacute;nicas
							o fonogramas
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi2r3c1' name='vi2r3c1' value = '1' onClick="activaTextoII(this.id, 'idvi2r3c2', 'idvi2r8c2');" <?php echo ($row['VI2R3C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi2r3c12' name='vi2r3c1' value = '2' onClick="activaTextoII(this.id, 'idvi2r3c2', 'idvi2r8c2');" <?php echo ($row['VI2R3C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi2r3c2' name='vi2r3c2' value = "<?php echo $row['VI2R3C2']?>" <?php echo ($row['VI2R3C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn24">
							<b>2.2 </b>Derechos de autor de registros de software
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi2r4c1' name='vi2r4c1' value = '1' onClick="activaTextoII(this.id, 'idvi2r4c2', 'idvi2r8c2');" <?php echo ($row['VI2R4C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi2r4c12' name='vi2r4c1' value = '2' onClick="activaTextoII(this.id, 'idvi2r4c2', 'idvi2r8c2');" <?php echo ($row['VI2R4C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi2r4c2' name='vi2r4c2' value = "<?php echo $row['VI2R4C2']?>" <?php echo ($row['VI2R4C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 20px' id="txtn25">
							<b>3. </b>Registros de dise&ntilde;os industriales
						</div>
						<div class='col-sm-2 small text-right' style='margin-left: 10px'>
							<label class='radio-inline'><input type='radio' id='idvi2r5c1' name='vi2r5c1' value = '1' onClick="activaTextoII(this.id, 'idvi2r5c2', 'idvi2r8c2');" <?php echo ($row['VI2R5C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi2r5c12' name='vi2r5c1' value = '2' onClick="activaTextoII(this.id, 'idvi2r5c2', 'idvi2r8c2');" <?php echo ($row['VI2R5C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi2r5c2' name='vi2r5c2' value = "<?php echo $row['VI2R5C2']?>" <?php echo ($row['VI2R5C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 20px' id="txtn26">
							<b>4. </b>Registros de marcas y otros signos distintivos
						</div>
						<div class='col-sm-2 small text-right' style='margin-left: 10px'>
							<label class='radio-inline'><input type='radio' id='idvi2r6c1' name='vi2r6c1' value = '1' onClick="activaTextoII(this.id, 'idvi2r6c2', 'idvi2r8c2');" <?php echo ($row['VI2R6C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi2r6c12' name='vi2r6c1' value = '2' onClick="activaTextoII(this.id, 'idvi2r6c2', 'idvi2r8c2');" <?php echo ($row['VI2R6C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi2r6c2' name='vi2r6c2' value = "<?php echo $row['VI2R6C2']?>" <?php echo ($row['VI2R6C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 20px' id="txtn27">
							<b>5. </b>Certificados de obtentor de variedades vegetales
						</div>
						<div class='col-sm-2 small text-right' style='margin-left: 10px'>
							<label class='radio-inline'><input type='radio' id='idvi2r7c1' name='vi2r7c1' value = '1' onClick="activaTextoII(this.id, 'idvi2r7c2', 'idvi2r8c2');" <?php echo ($row['VI2R7C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi2r7c12' name='vi2r7c1' value = '2' onClick="activaTextoII(this.id, 'idvi2r7c2', 'idvi2r8c2');" <?php echo ($row['VI2R7C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi2r7c2' name='vi2r7c2' value = "<?php echo $row['VI2R7C2']?>" <?php echo ($row['VI2R7C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-right' style='margin-left: 30px' id="txtn28">
							<b>Total de registros de propiedad intelectual obtenidos en el per&iacute;odo <?php echo $anterior . "-" . $vig?></b>
						</div>
						<div class='col-sm-2 small text-right'></div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi2r8c2' name='vi2r8c2' value = "<?php echo $row['VI2R8C2']?>" <?php echo $estadoVI2R6 ?> maxlength="6" /> 
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=vi3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> VI.3 Para cada una de las siguientes opciones, indique si su empresa utiliz&oacute;
						otros m&eacute;todos de protecci&oacute;n durante el per&iacute;odo <?php echo $anterior . "-" . $vig ?>, y especifique
						el n&uacute;mero de casos en que utiliz&oacute; el m&eacute;todo correspondiente.</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 text-center'><b>Otros M&eacute;todos de Protecci&oacute;n</b></div>
						<div class='col-sm-2 small text-right'></div>
						<div class='col-sm-1 small text-right'>
							Total de casos en que utiliz&oacute; el m&eacute;todo <?php echo $anterior . "-" . $vig?>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn31">
							<b>1. </b>Secreto Industrial <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Secreto Industrial.' data-content='Es cualquier informaci&oacute;n no divulgada que una persona natural o jur&iacute;dica leg&iacute;timamente posea, que pueda usarse en alguna actividad productiva, industrial o comercial y que sea susceptible de transmitirse a un tercero.'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi3r1c1' name='vi3r1c1' value = '1' onClick="activaTextoII(this.id, 'idvi3r1c2', 'idvi3r5c2');" <?php echo ($row['VI3R1C1'] == 1) ? 'checked' : '' ?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi3r1c12' name='vi3r1c1' value = '2' onClick="activaTextoII(this.id, 'idvi3r1c2', 'idvi3r5c2');" <?php echo ($row['VI3R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi3r1c2' name='vi3r1c2' value = "<?php echo $row['VI3R1C2']?>" <?php echo ($row['VI3R1C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn32">
							<b>2. </b>Alta complejidad en el dise&ntilde;o <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Alta complejidad en el dise&ntilde;o.' data-content='La empresa puede elaborar, de manera estrat&eacute;gica, esquemas, bosquejos o prototipos que describen las ideas u objetos de alto valor industrial o comercial, con base en t&eacute;cnicas de dise&ntilde;o que dificultan su copia o reproducci&oacute;n por parte de los competidores.'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi3r2c1' name='vi3r2c1' value = '1' onClick="activaTextoII(this.id, 'idvi3r2c2', 'idvi3r5c2');" <?php echo ($row['VI3R2C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi3r2c12' name='vi3r2c1' value = '2' onClick="activaTextoII(this.id, 'idvi3r2c2', 'idvi3r5c2');" <?php echo ($row['VI3R2C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi3r2c2' name='vi3r2c2' value = "<?php echo $row['VI3R2C2']?>" <?php echo ($row['VI3R2C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn33">
							<b>3. </b>Acuerdos o contratos de confidencialidad con otras empresas <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Acuerdos o contratos de confidencialidad con otras empresas.' data-placement='left' data-content='Son aquellos en que dos o m&aacute;s empresas manifiestan su voluntad para mantener una informaci&oacute;n como confidencial, de tal manera que se comprometen a no divulgar, usar o explotar la informaci&oacute;n confidencial a la que tengan acceso en virtud de un contrato o una labor determinada. (Cuente los diferentes tipos de acuerdo o contrato y no el n&uacute;mero de veces que se ha suscrito un mismo acuerdo)'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi3r3c1' name='vi3r3c1' value = '1' onClick="activaTextoII(this.id, 'idvi3r3c2', 'idvi3r5c2');" <?php echo ($row['VI3R3C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi3r3c12' name='vi3r3c1' value = '2' onClick="activaTextoII(this.id, 'idvi3r3c2', 'idvi3r5c2');" <?php echo ($row['VI3R3C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi3r3c2' name='vi3r3c2' value = "<?php echo $row['VI3R3C2']?>" <?php echo ($row['VI3R3C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn34">
							<b>4. </b>Acuerdos o contratos de confidencialidad con los empleados <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Acuerdos o contratos de confidencialidad con los empleados.' data-placement='left' data-content='Son aquellos en que dos o m&aacute;s partes manifiestan su voluntad para mantener una informaci&oacute;n como confidencial, de tal manera que se comprometen a no divulgar, usar o explotar la informaci&oacute;n confidencial a la que tengan acceso en virtud de un contrato o una labor determinada. (Cuente los diferentes tipos de acuerdo o contrato y no el n&uacute;mero de veces que se ha suscrito un mismo acuerdo)'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi3r4c1' name='vi3r4c1' value = '1' onClick="activaTextoII(this.id, 'idvi3r4c2', 'idvi3r5c2');" <?php echo ($row['VI3R4C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi3r4c12' name='vi3r4c1' value = '2' onClick="activaTextoII(this.id, 'idvi3r4c2', 'idvi3r5c2');" <?php echo ($row['VI3R4C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi3r4c2' name='vi3r4c2' value = "<?php echo $row['VI3R4C2']?>" <?php echo ($row['VI3R4C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-right' style='margin-left: 30px' id="txtn35">
							<b>Total de otros m&eacute;todos de protecci&oacute;n utilizados en el per&iacute;odo <?php echo $anterior . "-" . $vig ?></b>
						</div>
						<div class='col-sm-2 small text-right'></div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi3r5c2' name='vi3r5c2' value = "<?php echo $row['VI3R5C2']?>" <?php echo $estadoVI3R5 ?> maxlength="6"/> 
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id="vi4">
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=vi4&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> VI.4</b></h5></legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn41">
							&iquest;Tuvo su empresa la intenci&oacute;n de solicitar registros de propiedad intelectual durante el per&iacute;odo <?php echo $anterior . "-" . $vig ?>
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi4r1c1' name='vi4r1c1' value = '1' <?php echo ($row['VI4R1C1'] == 1) ? 'checked' : ''?> <?php echo $estadoVI4 ?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi4r1c12' name='vi4r1c1' value = '2' <?php echo ($row['VI4R1C1'] == 2) ? 'checked' : ''?> <?php echo $estadoVI4 ?> />NO</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id="id65" <?php echo $estadoVI5 ?> >
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=vi5&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> VI.5 Se&ntilde;ale el grado de importancia que tuvieron los siguientes obst&aacute;culos,
						para la solicitud u obtenci&oacute;n de registros de propiedad intelectual por parte de su empresa, durante el per&iacute;odo <?php echo $anterior . "-" . $vig?>: </b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small'></div>
						<div class='col-sm-4 small'><b>Grado de importancia</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn51">
							<b>1. </b>Falta de informaci&oacute;n sobre beneficios y requisitos
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi5r1c1' name='vi5r1c1' value = '1' <?php echo ($row['VI5R1C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi5r1c12' name='vi5r1c1' value = '2' <?php echo ($row['VI5R1C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi5r1c13' name='vi5r1c1' value = '3' <?php echo ($row['VI5R1C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn52">
							<b>2. </b>Dificultad para cumplir con los requisitos o completar los tr&aacute;mites
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi5r2c1' name='vi5r2c1' value = '1' <?php echo ($row['VI5R2C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi5r2c12' name='vi5r2c1' value = '2' <?php echo ($row['VI5R2C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi5r2c13' name='vi5r2c1' value = '3' <?php echo ($row['VI5R2C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn53">
							<b>3. </b>Tiempo del tr&aacute;mite excesivo
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi5r3c1' name='vi5r3c1' value = '1' <?php echo ($row['VI5R3C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi5r3c12' name='vi5r3c1' value = '2' <?php echo ($row['VI5R3C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi5r3c13' name='vi5r3c1' value = '3' <?php echo ($row['VI5R3C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn54">
							<b>4. </b>Poca efectividad de los registros para proveer protecci&oacute;n a la propiedad intelectual
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi5r4c1' name='vi5r4c1' value = '1' <?php echo ($row['VI5R4C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi5r4c12' name='vi5r4c1' value = '2' <?php echo ($row['VI5R4C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi5r4c13' name='vi5r4c1' value = '3' <?php echo ($row['VI5R4C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn55">
							<b>5. </b>Balance costo - beneficio no favorable
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi5r5c1' name='vi5r5c1' value = '1' <?php echo ($row['VI5R5C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi5r5c12' name='vi5r5c1' value = '2' <?php echo ($row['VI5R5C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi5r5c13' name='vi5r5c1' value = '3' <?php echo ($row['VI5R5C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn56">
							<b>6. </b>No se generan ideas novedosas que sean susceptibles de obtener registros de propiedad intelectual
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi5r6c1' name='vi5r6c1' value = '1' <?php echo ($row['VI5R6C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi5r6c12' name='vi5r6c1' value = '2' <?php echo ($row['VI5R6C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi5r6c13' name='vi5r6c1' value = '3' <?php echo ($row['VI5R6C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn57">
							<b>7. </b>Escasa capacidad interna de gesti&oacute;n de la propiedad intelectual
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi5r7c1' name='vi5r7c1' value = '1' <?php echo ($row['VI5R7C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi5r7c12' name='vi5r7c1' value = '2' <?php echo ($row['VI5R7C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi5r7c13' name='vi5r7c1' value = '3' <?php echo ($row['VI5R7C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=vi6&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> VI.6</b></h5></legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'></div>
						<div class='col-sm-2 small text-right'></div>
						<div class='col-sm-1 small'>N&uacute;mero de Certificaciones</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn61">
							Durante el per&iacute;odo <?php echo $anterior . "-" . $vig ?>, &iquest;su empresa obtuvo certificaciones de calidad de
							proceso?. Si su respuesta es afirmativa, indique cu&aacute;ntas. (por ejemplo, si tiene 2 procesos con ISO-14040 y un
							proceso con ISO-9001, debe registrar 3 certificaciones)
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi6r1c1' name='vi6r1c1' value = '1' onClick="activaTextoII(this.id, 'idvi6r1c2', 'nada');" <?php echo ($row['VI6R1C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi6r1c12' name='vi6r1c1' value = '2' onClick="activaTextoII(this.id, 'idvi6r1c2', 'nada');" <?php echo ($row['VI6R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi6r1c2' name='vi6r1c2' value = "<?php echo $row['VI6R1C2']?>" <?php echo ($row['VI6R1C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=vi7&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> VI.7</b></h5></legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'></div>
						<div class='col-sm-2 small text-right'></div>
						<div class='col-sm-1 small'>N&uacute;mero de Certificaciones</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn71">
							Durante el per&iacute;odo <?php echo $anterior . "-" . $vig ?>, &iquest;su empresa obtuvo certificaciones de calidad de
							producto?. Si su respuesta es afirmativa, indique cu&aacute;ntas. (por ejemplo, si tiene 2 productos con ISO-9000, debe
							registrar 2 certificaciones)
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi7r1c1' name='vi7r1c1' value = '1' onClick="activaTextoII(this.id, 'idvi7r1c2', 'nada');" <?php echo ($row['VI7R1C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi7r1c12' name='vi7r1c1' value = '2' onClick="activaTextoII(this.id, 'idvi7r1c2', 'nada');" <?php echo ($row['VI7R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-1 small'>
							<input type="text" class='form-control input-sm text-right' id='idvi7r1c2' name='vi7r1c2' value = "<?php echo $row['VI7R1C2']?>" <?php echo ($row['VI7R1C1']!= 1) ? 'disabled' : '' ?> maxlength="4" /> 
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=vi8&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> VI.8</b></h5></legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn81">
							&iquest;Los servicios o bienes que produjo su empresa durante el per&iacute;odo <?php echo $anterior . "-" . $vig ?> est&aacute;n 
							sujetos al cumplimiento de reglamentos t&eacute;cnicos?
						</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idvi8r1c1' name='vi8r1c1' value = '1' <?php echo ($row['VI8R1C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idvi8r1c12' name='vi8r1c1' value = '2' <?php echo ($row['VI8R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id="id69" <?php echo $estadoVI9 ?> >
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=vi9&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> VI.9 Se&ntilde;ale el grado de importancia que tuvo sobre los siguientes aspectos de su
						empresa, la obtenci&oacute;n de certificaciones de calidad de producto o proceso durante el per&iacute;odo <?php echo $anterior . "-" . $vig ?>:</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small'></div>
						<div class='col-sm-4 small'><b>Grado de importancia</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn91">
							<b>1. </b>Generaci&oacute;n de ideas para innovar
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi9r1c1' name='vi9r1c1' value = '1' <?php echo ($row['VI9R1C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi9r1c12' name='vi9r1c1' value = '2' <?php echo ($row['VI9R1C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi9r1c13' name='vi9r1c1' value = '3' <?php echo ($row['VI9R1C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn92">
							<b>2. </b>Aumento de la productividad
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi9r2c1' name='vi9r2c1' value = '1' <?php echo ($row['VI9R2C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi9r2c12' name='vi9r2c1' value = '2' <?php echo ($row['VI9R2C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi9r2c13' name='vi9r2c1' value = '3' <?php echo ($row['VI9R2C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn93">
							<b>3. </b>Mayor acceso a mercados nacionales
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi9r3c1' name='vi9r3c1' value = '1' <?php echo ($row['VI9R3C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi9r3c12' name='vi9r3c1' value = '2' <?php echo ($row['VI9R3C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi9r3c13' name='vi9r3c1' value = '3' <?php echo ($row['VI9R3C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn94">
							<b>4. </b>Mayor acceso a mercados internacionales
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi9r4c1' name='vi9r4c1' value = '1' <?php echo ($row['VI9R4C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi9r4c12' name='vi9r4c1' value = '2' <?php echo ($row['VI9R4C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi9r4c13' name='vi9r4c1' value = '3' <?php echo ($row['VI9R4C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn95">
							<b>5. </b>Mayor actualizaci&oacute;n tecnol&oacute;gica
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi9r5c1' name='vi9r5c1' value = '1' <?php echo ($row['VI9R5C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi9r5c12' name='vi9r5c1' value = '2' <?php echo ($row['VI9R5C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi9r5c13' name='vi9r5c1' value = '3' <?php echo ($row['VI9R5C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn96">
							<b>6. </b>Mayor transferencia de tecnolog&iacute;a hacia la empresa
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi9r6c1' name='vi9r6c1' value = '1' <?php echo ($row['VI9R6C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi9r6c12' name='vi9r6c1' value = '2' <?php echo ($row['VI9R6C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi9r6c13' name='vi9r6c1' value = '3' <?php echo ($row['VI9R6C1'] == 3) ? 'checked' : ''?> />Nula</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn97">
							<b>7. </b>Mejor relaci&oacute;n con otras empresas del sector
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idvi9r7c1' name='vi9r7c1' value = '1' <?php echo ($row['VI9R7C1'] == 1) ? 'checked' : ''?> />Alta</label>
							<label class='radio-inline'><input type='radio' id='idvi9r7c12' name='vi9r7c1' value = '2' <?php echo ($row['VI9R7C1'] == 2) ? 'checked' : ''?> />Media</label>
							<label class='radio-inline'><input type='radio' id='idvi9r7c13' name='vi9r7c1' value = '3' <?php echo ($row['VI9R7C1'] == 3) ? 'checked' : ''?> />Nula</label>
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
						<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Cap&iacute;tulo VI Actualizado Correctamente</p>
					</div>
					<div class='col-sm-1 small pull-right' id="btn_cont" style="display: none;" >
						<a href='../administracion/envio.php?numord=<?php echo $numero . "&nombre=" . $nombre?>' class='btn btn-default' data-toggle='tooltip' title='Ir a siguiente cap&iacute;tulo'>Continuar</a>
					</div>
					<div class='col-sm-1 small pull-right'>
						<button type='submit' class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar informaci&oacute;n Cap&iacute;tulo III'>Grabar</button>
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
        					<h4 class="modal-title">RECOMENDACIONES PARA UN BUEN PROCESO DE CR&Iacute;TICA EN EL CAP&Iacute;TULO VI</h4>
      				</div>
      				<div class="modal-body">
        				<ol style='text-align: justify; font-family: arial'>
						<li>En las preguntas correspondientes a <b>REGISTROS DE PROPIEDAD INTELECTUAL</b> (tanto vigentes como obtenidas) confirmar  cuando
							se reporten <b>ALTO N&Uacute;MERO</b> de registros sobre todo en patentes  y registros de software, en este &iacute;tem es un error com&uacute;n que las
							fuentes reporten las licencias de antivirus,  Windows, office etc. Recuerde que  el registro de software es para quien lo desarrolla
							o para quien tenga los derechos sobre el mismo.
						<li>En las preguntas correspondientes a <b>CERTIFICADOS DE OBTENTOR DE VARIEDADES VEGETALES</b> tanto vigentes como obtenidas
							(los certificados de obtentor de variedades vegetales son t&iacute;tulos que protegen el mejoramiento de variedades de plantas usadas
							en la agricultura, las cuales pueden comprender caracter&iacute;sticas de mayor rendimiento y una mejor resistencia a plagas y enfermedades.
							Las solicitudes se presentan en  Colombia ante  el Instituto Colombiano Agropecuario-ICA) <b>VERIFICAR y JUSTIFICAR</b> que la
							actividad de la empresa seg&uacute;n c&oacute;digo <b>CIIU</b> realmente est&eacute; relacionado con la obtenci&oacute;n de este tipo de certificados.
						<li>Respecto a la <b>OTROS M&Eacute;TODOS DE PROTECCI&Oacute;N</b>, confirmar que se reporte <b>&Uacute;NICAMENTE</b> el <b>N&Uacute;MERO DE ACUERDOS O CONTRATOS
							DE CONFIDENCIALIDAD</b> ya sean con los empleados o las empresas,  puesto que muchas veces las fuentes reportan el n&uacute;mero de
							personas o compa&ntilde;&iacute;as con las cuales se sostienen dichos acuerdos. Por ejemplo, el DANE firma un &uacute;nico acuerdo de confidencialidad
							con cada uno de los empleados que ingresan a laborar en la entidad; para este caso se debe registrar solo uno.
						<li>Se debe tener cuidado en que las empresas no registren como <b>CERTIFICACIONES</b> (tanto de proceso como de producto) el nombre
							de la certificaci&oacute;n otorgada; es decir, muchas empresas digitan 9001 refiri&eacute;ndose al nombre de la certificaci&oacute;n obtenida, cuando
							deber&iacute;an registrar 1, es decir una certificaci&oacute;n; si se considera necesario en las observaciones las fuentes pueden explicar cu&aacute;l
							fue la certificaci&oacute;n.
						<li>Realizar observaciones claras, <b>NO DEJAR NOTAS</b> como datos ok, datos verificados, etc. en lo posible indicar el nombre y cargo
							de la persona que suministra la informaci&oacute;n.
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
