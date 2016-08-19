<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$page='cap3';
	$vig=$_SESSION['vigencia'];
	$estadObs = ($tipousu != "FU" ? "readonly" : "");
	$anterior = $vig-1;
	$tabla = 'capitulo_iii';
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	$grabaOK = false;
	$bloquear = "NO";
	
	$consLog = ($region == 99 ? true : false);
	
	$cLog = "<span class='glyphicon glyphicon-time' style='color: blue; font-size: 14px;'></span>";
	
	$estadoIII2C1 = ''; $estadoIII2C2 = ''; $estadoIII3 = ''; $estadoIII6 = '';  $estadoIII4='';
	include '../persistencia/cargaDato.php';
	if ($row['III1R3C1']==0) {
		$estadoIII2C1 = 'disabled';
	}
	if ($row['III1R3C2']==0) {
		$estadoIII2C2 = 'disabled';
	}
	if ($row['III1R3C1']==0 AND $row['III1R3C2']==0 AND $row['III3R1C1'] != 1) {
		$estadoIII3 = ''; $estadoIII4='disabled';
	}
	if ($row['III1R3C1']>0 OR $row['III1R3C2']>0) {
		$estadoIII3 = 'disabled'; $estadoIII4='';
	}
	if ($row['III5R1C1']==4) {
		$estadoIII6 = 'disabled';
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
		$borraReg = $conn->prepare("DELETE FROM capitulo_iii WHERE C3_nordemp = :numero AND vigencia = :periodo");
		$borraReg->execute(array(':numero'=>$numero, ':periodo'=>$vig));
		
		if ($tipousu == "CR" AND $rowCtl['acceso'] == "CR" AND $rowCtl['estado'] == 4) {
			$actuCtl = $conn->prepare("UPDATE control set m3 = 3 WHERE nordemp = :numero AND vigencia = :periodo");
			$actuCtl->execute(array(':numero'=>$numero, ':periodo'=>$vig));
		}
		else {
			if ($tipousu == "FU" AND $rowCtl['acceso'] == "FU" AND $rowCtl['estado'] < 4) {
				$actuCtl = $conn->prepare("UPDATE control set m3 = 2 WHERE nordemp = :numero AND vigencia = :periodo");
				$actuCtl->execute(array(':numero'=>$numero, ':periodo'=>$vig));
			}
		}
	}
	else {
		$qC2 = $conn->prepare("SELECT II1R10C1, II1R10C2 FROM capitulo_ii WHERE C2_nordemp = :nFuente AND vigencia = :periodo");
		$qC2->execute(array('nFuente'=>$numero, 'periodo'=>$vig));
		$rowC2 = $qC2->fetch(PDO::FETCH_ASSOC);
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
		<script type="text/javascript" src="../js/validaForm3.js"></script>
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
            $("#capitulo3").submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: "../persistencia/grabacapi.php",
                    type: "POST",
                    data: $(this).serialize(),
					beforeSend:  validaForm3,
                    success: function(dato) {
                    	if (retorno=="") {
							$("#btn_cont").show();
							$("#idmsg").show();
							$(function() {
								$.ajax({
								url: "../persistencia/grabactl.php",
								type: "POST",
								data: {modulo: "m3", estado: "2", numero: $("#numero").val(), capitulo: "C3"},
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
								data: {modulo: "m3", estado: "1", numero: $("#numero").val(), capitulo: "C3"},
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
				$("#idiii1r1c1,#idiii1r1c2,#idiii1r2c1,#idiii1r2c2,#idiii1r3c1,#idiii1r3c2,#idiii1r4c1,#idiii1r4c2,#idiii1r4c3,#idiii1r4c4,#idiii1r5c1,#idiii1r5c2,#idiii1r5c3,#idiii1r5c4,#idiii1r6c1,#idiii1r6c2,#idiii1r6c3,#idiii1r6c4,#idiii1r7c1,#idiii1r7c2,#idiii1r7c3,#idiii1r7c4,#idiii1r8c1,#idiii1r8c2,#idiii2r1c1,#idiii2r2c1,#idiii2r3c1,#idiii2r4c1,#idiii2r5c1,#idiii2r6c1,#idiii2r7c1,#idiii2r8c1,#idiii2r9c1,#idiii2r10c1,#idiii2r1c2,#idiii2r2c2,#idiii2r3c2,#idiii2r4c2,#idiii2r5c2,#idiii2r6c2,#idiii2r7c2,#idiii2r8c2,#idiii2r9c2,#idiii2r10c2").keyup(function(){
					if ($(this).val() != "")
						$(this).val( $(this).val().replace(/[^0-9]/g, '') );
				});
			});

			$(function() {
				$("#idiii1r1c1,#idiii1r1c2,#idiii1r2c1,#idiii1r2c2,#idiii1r3c1,#idiii1r3c2,#idiii1r4c1,#idiii1r4c2,#idiii1r4c3,#idiii1r4c4,#idiii1r5c1,#idiii1r5c2,#idiii1r5c3,#idiii1r5c4,#idiii1r6c1,#idiii1r6c2,#idiii1r6c3,#idiii1r6c4,#idiii1r7c1,#idiii1r7c2,#idiii1r7c3,#idiii1r7c4,#idiii1r8c1,#idiii1r8c2,#idiii2r1c1,#idiii2r2c1,#idiii2r3c1,#idiii2r4c1,#idiii2r5c1,#idiii2r6c1,#idiii2r7c1,#idiii2r8c1,#idiii2r9c1,#idiii2r10c1,#idiii2r1c2,#idiii2r2c2,#idiii2r3c2,#idiii2r4c2,#idiii2r5c2,#idiii2r6c2,#idiii2r7c2,#idiii2r8c2,#idiii2r9c2,#idiii2r10c2").blur(function() {
					if ($(this).val()!='') {
						$(this).val(parseInt($(this).val()));
					}
				});
			});
			
			$(function() {
				$("#idiii1r3c1,#idiii1r3c2").blur(function() {
					if (this.id == "idiii1r3c1" && $(this).val() == 0) {
						$("#idiii2r1c1,#idiii2r2c1,#idiii2r3c1,#idiii2r4c1,#idiii2r5c1,#idiii2r6c1,#idiii2r7c1,#idiii2r8c1,#idiii2r9c1,#idiii2r10c1").attr('disabled', 'disabled');
						$("#idiii2r1c1,#idiii2r2c1,#idiii2r3c1,#idiii2r4c1,#idiii2r5c1,#idiii2r6c1,#idiii2r7c1,#idiii2r8c1,#idiii2r9c1,#idiii2r10c1").val('');
					}
					if (this.id == "idiii1r3c1" && $(this).val() > 0) {
						$("#idiii2r1c1,#idiii2r2c1,#idiii2r3c1,#idiii2r4c1,#idiii2r5c1,#idiii2r6c1,#idiii2r7c1,#idiii2r8c1,#idiii2r9c1,#idiii2r10c1,#iii4").removeAttr('disabled');
					}
					if (this.id == "idiii1r3c2" && $(this).val() == 0) {
						$("#idiii2r1c2,#idiii2r2c2,#idiii2r3c2,#idiii2r4c2,#idiii2r5c2,#idiii2r6c2,#idiii2r7c2,#idiii2r8c2,#idiii2r9c2,#idiii2r10c2").attr('disabled', 'disabled');
						$("#idiii2r1c2,#idiii2r2c2,#idiii2r3c2,#idiii2r4c2,#idiii2r5c2,#idiii2r6c2,#idiii2r7c2,#idiii2r8c2,#idiii2r9c2,#idiii2r10c2").val('');
					}
					if (this.id == "idiii1r3c2" && $(this).val() > 0) {
						$("#idiii2r1c2,#idiii2r2c2,#idiii2r3c2,#idiii2r4c2,#idiii2r5c2,#idiii2r6c2,#idiii2r7c2,#idiii2r8c2,#idiii2r9c2,#idiii2r10c2,#iii4").removeAttr('disabled');
					}
				}); 
			});

			$(function() {
				$("#idiii1r3c1,#idiii1r3c2").blur(function() {
					if ($(this).val()>0) {
						$("#idiii3r1c1,#idiii3r1c12").prop('checked', false);
						$("#idiii3r1c1,#idiii3r1c12").attr('disabled', 'disabled');
					}
					if ($("#idiii1r3c1").val()==0 && $("#idiii1r3c2").val()==0) {
						$("#idiii3r1c1,#idiii3r1c12").removeAttr('disabled');
						$("input[name='iii4r1c1']").prop("checked", false);
						$("input[name='iii4r2c1']").prop("checked", false);
						$("input[name='iii4r3c1']").prop("checked", false);
						$("input[name='iii4r4c1']").prop("checked", false);
						$("input[name='iii4r5c1']").prop("checked", false);
						$("input[name='iii4r6c1']").prop("checked", false);
						$("#iii4").attr('disabled', 'disabled');
					}
				}); 
			});

			$(function() {
				$("#idiii6r1c1,#idiii6r2c1,#idiii6r3c1,#idiii6r4c1,#idiii6r5c1,#idiii6r6c1,#idiii6r7c1").click(function() {
					if ($(this).prop('checked') == true) {
						$("#idiii6r8c1").attr('disabled', 'disabled');
					}
					else {
						var activar = true;
						$("#idiii6r1c1,#idiii6r2c1,#idiii6r3c1,#idiii6r4c1,#idiii6r5c1,#idiii6r6c1,#idiii6r7c1").each(function() {
							if ($(this).prop('checked') == true) {
								activar = false;
							}
						});
						if (activar) {
							$("#idiii6r8c1").removeAttr('disabled');
						}
					}
				}); 
			});

			$(function() {
				$("#idiii6r1c2,#idiii6r2c2,#idiii6r3c2,#idiii6r4c2,#idiii6r5c2,#idiii6r6c2,#idiii6r7c2").click(function() {
					if ($(this).prop('checked') == true) {
						$("#idiii6r8c2").attr('disabled', 'disabled');
					}
					else {
						var activar = true;
						$("#idiii6r1c2,#idiii6r2c2,#idiii6r3c2,#idiii6r4c2,#idiii6r5c2,#idiii6r6c2,#idiii6r7c2").each(function() {
							if ($(this).prop('checked') == true) {
								activar = false;
							}
						});
						if (activar) {
							$("#idiii6r8c2").removeAttr('disabled');
						}
					}
				}); 
			});

			$(function() {
				$("#idiii6r8c1,#idiii6r8c2").click(function() {
					if (this.id == "idiii6r8c1") {
						if ($(this).prop('checked') == true) {
							$("#idiii6r1c1,#idiii6r2c1,#idiii6r3c1,#idiii6r4c1,#idiii6r5c1,#idiii6r6c1,#idiii6r7c1").attr('disabled', 'disabled');
							$("#idiii6r1c1,#idiii6r2c1,#idiii6r3c1,#idiii6r4c1,#idiii6r5c1,#idiii6r6c1,#idiii6r7c1").prop('checked', false);
						}
						else {
							$("#idiii6r1c1,#idiii6r2c1,#idiii6r3c1,#idiii6r4c1,#idiii6r5c1,#idiii6r6c1,#idiii6r7c1").removeAttr('disabled');
						}
					}
					if (this.id == "idiii6r8c2") {
						if ($(this).prop('checked') == true) {
							$("#idiii6r1c2,#idiii6r2c2,#idiii6r3c2,#idiii6r4c2,#idiii6r5c2,#idiii6r6c2,#idiii6r7c2").attr('disabled', 'disabled');
							$("#idiii6r1c2,#idiii6r2c2,#idiii6r3c2,#idiii6r4c2,#idiii6r5c2,#idiii6r6c2,#idiii6r7c2").prop('checked', false);
						}
						else {
							$("#idiii6r1c2,#idiii6r2c2,#idiii6r3c2,#idiii6r4c2,#idiii6r5c2,#idiii6r6c2,#idiii6r7c2").removeAttr('disabled');
						}
					}
				}); 
			});

			$(function() {
				$("#idiii1r8c1").blur(function() {
					if(parseInt($("#idiii1r1c1").val())+parseInt($("#idiii1r2c1").val())+parseInt($("#idiii1r3c1").val())+parseInt($("#idiii1r4c1").val())+parseInt($("#idiii1r4c2").val())+parseInt($("#idiii1r5c1").val())+parseInt($("#idiii1r5c2").val())+parseInt($("#idiii1r6c1").val())+parseInt($("#idiii1r6c2").val())+parseInt($("#idiii1r7c1").val())+parseInt($("#idiii1r7c2").val())!=parseInt($("#idiii1r8c1").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});

			$(function() {
				$("#idiii1r8c2").blur(function() {
					if(parseInt($("#idiii1r1c2").val())+parseInt($("#idiii1r2c2").val())+parseInt($("#idiii1r3c2").val())+parseInt($("#idiii1r4c3").val())+parseInt($("#idiii1r4c4").val())+parseInt($("#idiii1r5c3").val())+parseInt($("#idiii1r5c4").val())+parseInt($("#idiii1r6c3").val())+parseInt($("#idiii1r6c4").val())+parseInt($("#idiii1r7c3").val())+parseInt($("#idiii1r7c4").val())!=parseInt($("#idiii1r8c2").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});

			$(function() {
				$("#idiii2r10c1").blur(function() {
					if(parseInt($("#idiii2r1c1").val())+parseInt($("#idiii2r2c1").val())+parseInt($("#idiii2r3c1").val())+parseInt($("#idiii2r4c1").val())+parseInt($("#idiii2r5c1").val())+parseInt($("#idiii2r6c1").val())+parseInt($("#idiii2r7c1").val())+parseInt($("#idiii2r8c1").val())+parseInt($("#idiii2r9c1").val())!=parseInt($("#idiii2r10c1").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
					if ($("#idiii2r10c1").val() != $("#idiii1r3c1").val()) {
						alert("VALOR DEBE SER IGUAL A RENGLON 3 NUMERAL 1");
					}
				});
			});

			$(function() {
				$("#idiii2r10c2").blur(function() {
					if(parseInt($("#idiii2r1c2").val())+parseInt($("#idiii2r2c2").val())+parseInt($("#idiii2r3c2").val())+parseInt($("#idiii2r4c2").val())+parseInt($("#idiii2r5c2").val())+parseInt($("#idiii2r6c2").val())+parseInt($("#idiii2r7c2").val())+parseInt($("#idiii2r8c2").val())+parseInt($("#idiii2r9c2").val())!=parseInt($("#idiii2r10c2").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
					if ($("#idiii2r10c2").val() != $("#idiii1r3c2").val()) {
						alert("VALOR DEBE SER IGUAL A RENGLON 3 NUMERAL 1");
					}
				});
			});
			
			$(function() {
				$("#idiii1r3c1,#idiii1r3c2").blur(function() {
					if(this.val()>0) {
						$("#idiii3r1c1").prop("disabled", true);
					}
					else {
						$("#idiii3r1c1").prop("disabled", false);
					}
				});
			});
			$(function() {
				$("#idiii3r1c12").click(function() {
					$("input[name='iii4r1c1']").prop("checked", false);
					$("input[name='iii4r2c1']").prop("checked", false);
					$("input[name='iii4r3c1']").prop("checked", false);
					$("input[name='iii4r4c1']").prop("checked", false);
					$("input[name='iii4r5c1']").prop("checked", false);
					$("input[name='iii4r6c1']").prop("checked", false);
					$("#iii4").prop("disabled", true);
				});
			});
			$(function() {
				$("#idiii3r1c1").click(function() {
					$("#iii4").prop("disabled", false);
				});
			});
			$(function() {
				$("#idiii5r1c14").click(function() {
					$("#iii6").prop("disabled", true);
					$("#idiii6r1c1,#idiii6r2c1,#idiii6r3c1,#idiii6r4c1,#idiii6r5c1,#idiii6r6c1,#idiii6r7c1,#idiii6r8c1,#idiii6r1c2,#idiii6r2c2,#idiii6r3c2,#idiii6r4c2,#idiii6r5c2,#idiii6r6c2,#idiii6r7c2,#idiii6r8c2").prop("checked", false);
				});
			});
			$(function() {
				$("#idiii5r1c1,#idiii5r1c12,#idiii5r1c13").click(function() {
					$("#iii6").prop("disabled", false);
					$("#idiii6r1c1,#idiii6r2c1,#idiii6r3c1,#idiii6r4c1,#idiii6r5c1,#idiii6r6c1,#idiii6r7c1,#idiii6r8c1,#idiii6r1c2,#idiii6r2c2,#idiii6r3c2,#idiii6r4c2,#idiii6r5c2,#idiii6r6c2,#idiii6r7c2,#idiii6r8c2").prop("disabled", false);
					$("#idiii6r1c1,#idiii6r2c1,#idiii6r3c1,#idiii6r4c1,#idiii6r5c1,#idiii6r6c1,#idiii6r7c1,#idiii6r8c1,#idiii6r1c2,#idiii6r2c2,#idiii6r3c2,#idiii6r4c2,#idiii6r5c2,#idiii6r6c2,#idiii6r7c2,#idiii6r8c2").prop("checked", false);
				});
			});
			
			$(document).ready(function(){
    			$('[data-toggle="tooltip"]').tooltip();   
			});
			
			$(window).on('hidden.bs.modal', function() {
				$.ajax({
					url: "../persistencia/grabactl.php",
	                type: "POST",
	                data: {obser: "obs", numero: $("#numero").val(), capit: "3", observa: $("#obscrit").val()},
	                success: function(dato) {
					}
				});
			});
			
			$(function() {
				$("#wc3").affix({
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
		<div class="well well-sm" style="font-size: 12px; padding-top: 60px; z-index: 1;" id="wc3">
 				<?php echo $numero . "-" . $nombre?> - CAP&Iacute;TULO III - FINANCIAMIENTO DE LAS ACTIVIDADES CIENT&Iacute;FICAS, TECNOL&Oacute;GICAS Y DE INNOVACI&Oacute;N EN LOS A&Ntilde;OS <?php echo $anterior . "-" . $vig . " . " . $txtEstado ?>
 		</div>
 		<?php
 			if ($bloquear == "SI") {
 				echo "<h3>No requiere diligenciamiento</h3>";
 			}
 			else {
 		?>
 		<div class="container text-justify" style="font-size: 12px">
			La empresa puede hacer uso de recursos propios, es decir, destinar fondos provenientes del ejercicio de su actividad para financiar
			inversiones en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n. Sin embargo, tambi&eacute;n puede financiar
			o cofinanciar dichas actividades por medio de recursos p&uacute;blicos, sean &eacute;stos reembolsables o no, o mediante el uso de
			recursos privados provenientes de terceros tales como el cr&eacute;dito, las inversiones de capital, la banca privada, las agencias
			u organizaciones privadas (nacionales e internacionales), entre otros.
		</div>
		<br>
		<div class='container md-danger text-justify' style="font-size: 12px">
			<b>Recuerde:</b> las Actividades Cient&iacute;ficas, Tecnol&oacute;gicas y de Innovaci&oacute;n <b>(ACTI)</b> son todas aquellas
			que la empresa realiza para producir, promover, difundir y aplicar conocimientos cient&iacute;ficos y t&eacute;cnicos; as&iacute;
			como tambi&eacute;n para el desarrollo o introducci&oacute;n de innovaciones.											
		</div>
		<br>  
		<div class="container text-justify" style="font-size: 12px">
 			<b>&iquest;Quien deber&iacute;a responder este cap&iacute;tulo?:</b>&nbsp;Personas del &aacute;rea financiera y que conozcan las
 				inversiones y gastos de la empresa en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n 
 		</div>
		<input type='hidden' id='idii1r10c1' name='ii1r10c1' value = "<?php echo $rowC2['II1R10C1']?>" />
		<input type='hidden' id='idii1r10c2' name='ii1r10c2' value = "<?php echo $rowC2['II1R10C2']?>" />
		
		<input type="hidden" name="tipousu" id="idTipo" value="<?php echo $tipousu ?>" />
		
		<center><img src="../images/mensaje.png" alt="Smiley face" height="" width=""></center>
		
		<form class='form-horizontal' role='form' data-toggle='validator' name="capitulo3" id="capitulo3" method="post">
			<div class='container'>
				<center><img src="../images/mensaje.png" alt="Smiley face" height="" width=""></center>
				<input type="hidden" name="C3_nordemp" id="numero" value="<?php echo $numero ?>" />
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iii1&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> III.1 Distribuya el total invertido en actividades cient&iacute;ficas, tecnol&oacute;gicas
						y de innovaci&oacute;n (total de la inversi&oacute;n del Cap&iacute;tulo II), seg&uacute;n la fuente original de los recursos
						usados para financiar dichas inversiones en los a&ntilde;os <?php echo $anterior . "-" . $vig?>. Debe distinguirse entre el
						uso de recursos propios de la empresa, recursos de otras empresas del grupo, recursos p&uacute;blicos, recursos de banca
						privada, recursos de otras empresas ajenas al grupo, fondos de capital privado y recursos de cooperaci&oacute;n o donaciones.</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small'>&nbsp;</div>
						<div class='col-sm-2 text-right'><b><?php echo $anterior?></b></div>
						<div class='col-sm-2 text-right'><b><?php echo $vig?></b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn11">
							<b>1. </b>Recursos propios de la empresa. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Recursos propios de la empresa.' data-content='Fondos pertenecientes a la empresa que provienen de sus ingresos operacionales y no operacionales, o de capitalizaci&oacute;n de acciones, destinados a financiar inversiones en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, y/o aquellos destinados a servir como contrapartida, en el caso de que la empresa sea beneficiaria de organizaciones nacionales e internacionales, ya sean p&uacute;blicas, privadas o mixtas.'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r1c1' name='iii1r1c1' value = "<?php echo $row['III1R1C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r1c2' name='iii1r1c2' value = "<?php echo $row['III1R1C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn12">
							<b>2. </b>Recursos de otras empresas del grupo. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Recursos de otras empresas del grupo.' data-content='Fondos pertenecientes a otras empresas del mismo grupo (con las cuales existe una estrecha relación jurídica o financiera), que se otorgan a la empresa en calidad de préstamo o donación para financiar inversiones en actividades científicas, tecnológicas y de innovación.'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r2c1' name='iii1r2c1' value = "<?php echo $row['III1R2C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r2c2' name='iii1r2c2' value = "<?php echo $row['III1R2C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn13">
							<b>3. </b>Recursos p&uacute;blicos para la realizaci&oacute;n de ACTI. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Recursos p&uacute;blicos para la realizaci&oacute;n de ACTI.' data-content='Fondos obtenidos por medio de alguna(s) de las líneas de financiamiento público para la realización de actividades científicas, tecnológicas y de innovación (listadas en el numeral III.2). Estos pueden ser recursos reembolsables (líneas de crédito) o no reembolsables que tuvieron contrapartida (líneas de cofinanciación).'></span></a>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r3c1' name='iii1r3c1' value = "<?php echo $row['III1R3C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r3c2' name='iii1r3c2' value = "<?php echo $row['III1R3C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small'>&nbsp;</div>
						<div class='col-sm-2 text-center'><b><?php echo $anterior?></b></div>
						<div class='col-sm-2 text-center'><b><?php echo $vig?></b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small'>&nbsp;</div>
						<div class='col-sm-1 text-right'><b>Nacional</b></div>
						<div class='col-sm-1 text-right'><b>Extranjero</b></div>
						<div class='col-sm-1 text-right'><b>Nacional</b></div>
						<div class='col-sm-1 text-right'><b>Extranjero</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn14">
							<b>4. </b>Recursos de banca privada. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Recursos de banca privada.' data-content='Fondos otorgados por parte de instituciones financieras de propiedad privada que realizan funciones de captación y financiamiento.'></span></a>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r4c1' name='iii1r4c1' value = "<?php echo $row['III1R4C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r4c2' name='iii1r4c2' value = "<?php echo $row['III1R4C2']?>" maxlength="9"/>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r4c3' name='iii1r4c3' value = "<?php echo $row['III1R4C3']?>" maxlength="9"/>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r4c4' name='iii1r4c4' value = "<?php echo $row['III1R4C4']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn15">
							<b>5. </b>Recursos de otras empresas. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Recursos de otras empresas.' data-content='Fondos pertenecientes a otras empresas que no hacen parte del mismo grupo que se otorgan a la empresa en calidad de préstamo o donación para financiar inversiones en actividades científicas, tecnológicas y de innovación'></span></a>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r5c1' name='iii1r5c1' value = "<?php echo $row['III1R5C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r5c2' name='iii1r5c2' value = "<?php echo $row['III1R5C2']?>" maxlength="9"/>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r5c3' name='iii1r5c3' value = "<?php echo $row['III1R5C3']?>" maxlength="9"/>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r5c4' name='iii1r5c4' value = "<?php echo $row['III1R5C4']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn16">
							<b>6. </b>Fondos de capital privado. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Fondos de capital privado.' data-content='Fondos provenientes de los aportes de inversionistas que se vinculan a la empresa a través de fondos de capital privado, fondos de capital de riesgo, operaciones en bolsa de valores, o inversiones específicas como las de ángeles inversionistas. Se excluye la capitalización por acciones descrita en el numeral III.1. opción 1.'></span></a>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r6c1' name='iii1r6c1' value = "<?php echo $row['III1R6C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r6c2' name='iii1r6c2' value = "<?php echo $row['III1R6C2']?>" maxlength="9"/>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r6c3' name='iii1r6c3' value = "<?php echo $row['III1R6C3']?>" maxlength="9"/>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r6c4' name='iii1r6c4' value = "<?php echo $row['III1R6C4']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn17">
							<b>7. </b>Recursos de cooperaci&oacute;n o donaciones. <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Recursos de cooperaci&oacute;n o donaciones.' data-content='Fondos no reembolsables, otorgados por organizaciones gubernamentales o no gubernamentales nacionales o de un país extranjero. Los fondos pueden ser en efectivo, bienes o servicios.  También se deben incluir donaciones hechas por organizaciones nacionales privadas u organizaciones  internacionales  públicas, privadas o mixtas. Incluya los recursos públicos que no provienen de líneas de financiamiento para la realización de actividades científicas, tecnológicas y de innovación que deben ir registrados en el numeral III.1 opción 3.'></span></a>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r7c1' name='iii1r7c1' value = "<?php echo $row['III1R7C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r7c2' name='iii1r7c2' value = "<?php echo $row['III1R7C2']?>" maxlength="9"/>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r7c3' name='iii1r7c3' value = "<?php echo $row['III1R7C3']?>" maxlength="9"/>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r7c4' name='iii1r7c4' value = "<?php echo $row['III1R7C4']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-right' id="txtn18">
							<b>TOTAL (debe ser IGUAL al total invertido).</b>
						</div>
						<div class='col-sm-2 small text-right' style='margin-left: 30px'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r8c1' name='iii1r8c1' value = "<?php echo $row['III1R8C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii1r8c2' name='iii1r8c2' value = "<?php echo $row['III1R8C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='container' style='font-size: 12px'>
						<b>Si NO utiliz&oacute; recursos p&uacute;blicos en <?php echo $anterior . "-" . $vig?>, es decir, si su respuesta fue 0 (cero) en las dos casillas
						de la opci&oacute;n 3 del numeral anterior (III.1), contin&uacute;e en el numeral (III.3).</b>											
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iii2&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> III.2 Distribuya el monto de recursos p&uacute;blicos utilizados en el a&ntilde;o
						<?php echo $anterior . "-" . $vig?> para financiar inversiones en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n
						(opci&oacute;n 3 del numeral III.1), de acuerdo a la l&iacute;nea de financiaci&oacute;n por la cual se obtuvieron
						los recursos.</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-justify'><b>L&iacute;neas de cofinanciaci&oacute;n: </b>Recursos no reembolsables que se otorgan para
							financiar un porcentaje (menor al 100%) del valor total de un proyecto de investigaci&oacute;n, desarrollo tecnol&oacute;gico
							e innovaci&oacute;n. Se exige en este tipo de financiaci&oacute;n una contrapartida en dinero o especie por parte de la
							empresa.							
						</div>
						<div class='col-sm-2 text-right'><b><?php echo $anterior?></b></div>
						<div class='col-sm-2 text-right'><b><?php echo $vig?></b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn21">
							<b>1. </b>BANCOLDEX - INNpulsa - MinComercio. Crecimiento extraordinario, MiPyme y Crecimiento regional.
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r1c1' name='iii2r1c1' <?php echo $estadoIII2C1 ?> value = "<?php echo $row['III2R1C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r1c2' name='iii2r1c2' <?php echo $estadoIII2C2 ?> value = "<?php echo $row['III2R1C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn22">
							<b>2. </b>SENA. Fomento de la innovaci&oacute;n y desarrollo tecnol&oacute;gico en las empresas y Corredores tecnol&oacute;gicos.
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r2c1' name='iii2r2c1' <?php echo $estadoIII2C1 ?> value = "<?php echo $row['III2R2C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r2c2' name='iii2r2c2' <?php echo $estadoIII2C2 ?> value = "<?php echo $row['III2R2C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn23">
							<b>3. </b>COLCIENCIAS.  Es tiempo de volver - Nodos de innovaci&oacute;n en TIC - APPS.co - Desarrollo de soluciones
							innovadoras de TI - Modelos de calidad - Apoyo a centros de desarrollo tecnol&oacute;gico para la transferencia de
							tecnolog&iacute;a e innovaci&oacute;n.						
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r3c1' name='iii2r3c1' <?php echo $estadoIII2C1 ?> value = "<?php echo $row['III2R3C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r3c2' name='iii2r3c2' <?php echo $estadoIII2C2 ?> value = "<?php echo $row['III2R3C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn24">
							<b>4. </b>COLCIENCIAS. Proyectos de investigaci&oacute;n aplicada - Desarrollo Tecnol&oacute;gico - Programas de
							I+D+I en eficiencia t&eacute;rmica - Proyectos de Pruebas de concepto - Talento humano.						
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r4c1' name='iii2r4c1' <?php echo $estadoIII2C1 ?> value = "<?php echo $row['III2R4C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r4c2' name='iii2r4c2' <?php echo $estadoIII2C2 ?> value = "<?php echo $row['III2R4C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn25">
							<b>5. </b>COLCIENCIAS. Locomotora de la innovaci&oacute;n para empresas (desarrollo tecnol&oacute;gico e innovaci&oacute;n).						
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r5c1' name='iii2r5c1' <?php echo $estadoIII2C1 ?> value = "<?php echo $row['III2R5C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r5c2' name='iii2r5c2' <?php echo $estadoIII2C2 ?> value = "<?php echo $row['III2R5C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-justify'><b>L&iacute;neas de cr&eacute;dito:</b> Recursos reembolsables que se otorgan para
							financiar hasta por el 100% del valor total de un proyecto de investigaci&oacute;n, desarrollo tecnol&oacute;gico e 
							Innovaci&oacute;n.							
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn26">
							<b>6. </b>BANCOLDEX - INNpulsa. Promover y dinamizar la innovaci&oacute;n de las grandes empresas y MiPymes.						
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r6c1' name='iii2r6c1' <?php echo $estadoIII2C1 ?> value = "<?php echo $row['III2R6C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r6c2' name='iii2r6c2' <?php echo $estadoIII2C2 ?> value = "<?php echo $row['III2R6C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn27">
							<b>7. </b>BANCOLDEX. Modernizaci&oacute;n empresarial.						
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r7c1' name='iii2r7c1' <?php echo $estadoIII2C1 ?> value = "<?php echo $row['III2R7C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r7c2' name='iii2r7c2' <?php echo $estadoIII2C2 ?> value = "<?php echo $row['III2R7C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-justify'><b>Otras l&iacute;neas</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn28">
							<b>8. </b>Fondos departamentales o municipales de ciencia y tecnolog&iacute;a.						
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r8c1' name='iii2r8c1' <?php echo $estadoIII2C1 ?> value = "<?php echo $row['III2R8C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r8c2' name='iii2r8c2' <?php echo $estadoIII2C2 ?> value = "<?php echo $row['III2R8C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn29">
							<b>9. </b>Fondo de ciencia, tecnolog&iacute;a e innovaci&oacute;n del sistema general de regal&iacute;as.						
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r9c1' name='iii2r9c1' <?php echo $estadoIII2C1 ?> value = "<?php echo $row['III2R9C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r9c2' name='iii2r9c2' <?php echo $estadoIII2C2 ?> value = "<?php echo $row['III2R9C2']?>" maxlength="9"/>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-right' id="txtn210">
							<b>Total (debe ser igual a la opci&oacute;n 3 del numeral III.1).</b>
						</div>
						<div class='col-sm-2 small text-right' style='margin-left: 30px'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r10c1' name='iii2r10c1' <?php echo $estadoIII2C1 ?> value = "<?php echo $row['III2R10C1']?>" maxlength="9"/>
						</div>
						<div class='col-sm-2 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiii2r10c2' name='iii2r10c2' <?php echo $estadoIII2C2 ?> value = "<?php echo $row['III2R10C2']?>" maxlength="9"/>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend id="txtn31"><h5 style='font-family: arial' id="txtn31"><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iii3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> III.3 &iquest;Tuvo su empresa la intenci&oacute;n de solicitar recursos p&uacute;blicos
						para financiar inversiones en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n en su empresa,
						durante <?php echo $anterior . "-" . $vig?>?</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>&nbsp;</div>
						<div class='col-sm-2 small text-right'>
							<label class='radio-inline'><input type='radio' id='idiii3r1c1' name='iii3r1c1' <?php echo $estadoIII3 ?> value = '1' <?php echo ($row['III3R1C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idiii3r1c12' name='iii3r1c1' <?php echo $estadoIII3 ?> value = '2' <?php echo ($row['III3R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id='iii4' <?php echo $estadoIII4 ?>>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iii4&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> III.4 Se&ntilde;ale el grado de importancia que tuvieron los siguientes obst&aacute;culos,
						en el acceso a recursos p&uacute;blicos para financiar inversiones en actividades cient&iacute;ficas, tecnol&oacute;gicas
						y de innovaci&oacute;n en su empresa, durante el per&iacute;odo <?php echo $anterior . "-" . $vig?></b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>&nbsp;</div>
						<div class='col-sm-3 small text-right'><b>Grado de Importancia</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn41">
							<b>1. </b>Desconocimiento de las l&iacute;neas de financiaci&iacute;n p&uacute;blicas existentes
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idiii4r1c1' name='iii4r1c1' value = '1' <?php echo ($row['III4R1C1'] == 1) ? 'checked' : ''?> />ALTA</label>
							<label class='radio-inline'><input type='radio' id='idiii4r1c12' name='iii4r1c1' value = '2' <?php echo ($row['III4R1C1'] == 2) ? 'checked' : ''?> />MEDIA</label>
							<label class='radio-inline'><input type='radio' id='idiii4r1c13' name='iii4r1c1' value = '3' <?php echo ($row['III4R1C1'] == 3) ? 'checked' : ''?> />NULA</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn42">
							<b>2. </b>Falta de informaci&oacute;n sobre requisitos y tr&aacute;mites
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idiii4r2c1' name='iii4r2c1' value = '1' <?php echo ($row['III4R2C1'] == 1) ? 'checked' : ''?> />ALTA</label>
							<label class='radio-inline'><input type='radio' id='idiii4r2c12' name='iii4r2c1' value = '2' <?php echo ($row['III4R2C1'] == 2) ? 'checked' : ''?> />MEDIA</label>
							<label class='radio-inline'><input type='radio' id='idiii4r2c13' name='iii4r2c1' value = '3' <?php echo ($row['III4R2C1'] == 3) ? 'checked' : ''?> />NULA</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn43">
							<b>3. </b>Dificultad para cumplir con los requisitos o completar los tr&aacute;mites
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idiii4r3c1' name='iii4r3c1' value = '1' <?php echo ($row['III4R3C1'] == 1) ? 'checked' : ''?> />ALTA</label>
							<label class='radio-inline'><input type='radio' id='idiii4r3c12' name='iii4r3c1' value = '2' <?php echo ($row['III4R3C1'] == 2) ? 'checked' : ''?> />MEDIA</label>
							<label class='radio-inline'><input type='radio' id='idiii4r3c13' name='iii4r3c1' value = '3' <?php echo ($row['III4R3C1'] == 3) ? 'checked' : ''?> />NULA</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn44">
							<b>4. </b>Tiempo del tr&aacute;mite excesivo			
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idiii4r4c1' name='iii4r4c1' value = '1' <?php echo ($row['III4R4C1'] == 1) ? 'checked' : ''?> />ALTA</label>
							<label class='radio-inline'><input type='radio' id='idiii4r4c12' name='iii4r4c1' value = '2' <?php echo ($row['III4R4C1'] == 2) ? 'checked' : ''?> />MEDIA</label>
							<label class='radio-inline'><input type='radio' id='idiii4r4c13' name='iii4r4c1' value = '3' <?php echo ($row['III4R4C1'] == 3) ? 'checked' : ''?> />NULA</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn45">
							<b>5. </b>Condiciones de financiaci&oacute;n y/o cofinanciaci&oacute;n poco atractivas			
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idiii4r5c1' name='iii4r5c1' value = '1' <?php echo ($row['III4R5C1'] == 1) ? 'checked' : ''?> />ALTA</label>
							<label class='radio-inline'><input type='radio' id='idiii4r5c12' name='iii4r5c1' value = '2' <?php echo ($row['III4R5C1'] == 2) ? 'checked' : ''?> />MEDIA</label>
							<label class='radio-inline'><input type='radio' id='idiii4r5c13' name='iii4r5c1' value = '3' <?php echo ($row['III4R5C1'] == 3) ? 'checked' : ''?> />NULA</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn46">
							<b>6. </b>Demora en la intermediaci&oacute;n entre la banca comercial y las l&iacute;neas p&uacute;blicas de cr&eacute;dito			
						</div>
						<div class='col-sm-3 small text-right'>
							<label class='radio-inline'><input type='radio' id='idiii4r6c1' name='iii4r6c1' value = '1' <?php echo ($row['III4R6C1'] == 1) ? 'checked' : ''?> />ALTA</label>
							<label class='radio-inline'><input type='radio' id='idiii4r6c12' name='iii4r6c1' value = '2' <?php echo ($row['III4R6C1'] == 2) ? 'checked' : ''?> />MEDIA</label>
							<label class='radio-inline'><input type='radio' id='idiii4r6c13' name='iii4r6c1' value = '3' <?php echo ($row['III4R6C1'] == 3) ? 'checked' : ''?> />NULA</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend id="txtn51"><h5 style='font-family: arial' id="txtn51"><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iii5&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> III.5 Seleccione una de las siguientes opciones, con relaci&oacute;n a beneficios
						tributarios (deducciones o exenciones) por inversiones en desarrollo cient&iacute;fico y tecnol&oacute;gico durante
						durante <?php echo $anterior . "-" . $vig?>:</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small col-sm-offset-4'>
							<label class='radio-inline'><input type='radio' id='idiii5r1c1' name='iii5r1c1' value = '1' <?php echo ($row['III5R1C1'] == 1) ? 'checked' : ''?> />Obtuvo beneficios tributarios</label></br>
							<label class='radio-inline'><input type='radio' id='idiii5r1c12' name='iii5r1c1' value = '2' <?php echo ($row['III5R1C1'] == 2) ? 'checked' : ''?> />Solicit&oacute; beneficios tributarios, pero no los obtuvo</label></br>
							<label class='radio-inline'><input type='radio' id='idiii5r1c13' name='iii5r1c1' value = '3' <?php echo ($row['III5R1C1'] == 3) ? 'checked' : ''?> />Tuvo la intenci&oacute;n de solicitar beneficios tributarios, pero no lo hizo</label></br>
							<label class='radio-inline'><input type='radio' id='idiii5r1c14' name='iii5r1c1' value = '4' <?php echo ($row['III5R1C1'] == 4) ? 'checked' : ''?> />No quiso solicitar beneficios tributarios</label></br>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id="iii6" <?php echo $estadoIII6 ?>>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iii6&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> III.6 Indique cu&aacute;les de los siguientes factores fueron un obst&aacute;culo para
						solicitar u obtener beneficios tributarios por inversiones en desarrollo cient&iacute;fico y tecnol&oacute;gico,
						durante el per&iacute;odo <?php echo $anterior . "-" . $vig?>:</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>&nbsp;</div>
						<div class='col-sm-2 small'>
							Deducci&oacute;n en renta por inversiones para proyectos de ciencia, tecnolog&iacute;a e innovaci&oacute;n
						</div>
						<div class='col-sm-2 small'>
							Exenciones de renta y/o de IVA por inversiones para proyectos de ciencia, tecnolog&iacute;a e innovaci&oacute;n
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn61">
							<b>1. </b>Falta de Informaci&oacute;n sobre beneficios y requisitos
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r1c1' name='iii6r1c1' value='1' <?php echo ($row['III6R1C1'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r1c2' name='iii6r1c2' value='1' <?php echo ($row['III6R1C2'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn62">
							<b>2. </b>Dificultades con la herramienta en l&iacute;nea para la solicitud a trav&eacute;s del Sistema Integral de
								Gesti&oacute;n de Proyectos (SIGP)
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r2c1' name='iii6r2c1' value='1' <?php echo ($row['III6R2C1'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r2c2' name='iii6r2c2' value='1' <?php echo ($row['III6R2C2'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn63">
							<b>3. </b>Dificultad para el diligenciamiento del formulario electr&oacute;nico
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r3c1' name='iii6r3c1' value='1' <?php echo ($row['III6R3C1'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r3c2' name='iii6r3c2' value='1' <?php echo ($row['III6R3C2'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn64">
							<b>4. </b>Requisitos y tr&aacute;mites excesivos y/o complejos
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r4c1' name='iii6r4c1' value='1' <?php echo ($row['III6R4C1'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r4c2' name='iii6r4c2' value='1' <?php echo ($row['III6R4C2'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn65">
							<b>5. </b>Tiempo excesivo de tr&aacute;mite de la aprobaci&oacute;n
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r5c1' name='iii6r5c1' value='1' <?php echo ($row['III6R5C1'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r5c2' name='iii6r5c2' value='1' <?php echo ($row['III6R5C2'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn66">
							<b>6. </b>Poca utilidad del beneficio tributario
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r6c1' name='iii6r6c1' value='1' <?php echo ($row['III6R6C1'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r6c2' name='iii6r6c2' value='1' <?php echo ($row['III6R6C2'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn67">
							<b>7. </b>La ley excluye parcialmente actividades y proyectos de innovaci&oacute;n que desarrolla la empresa		
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r7c1' name='iii6r7c1' value='1' <?php echo ($row['III6R7C1'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r7c2' name='iii6r7c2' value='1' <?php echo ($row['III6R7C2'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn68">
							<b>8. </b>No hall&oacute; obst&aacute;culos		
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r8c1' name='iii6r8c1' value='1' <?php echo ($row['III6R8C1'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
						</div>
						<div class='col-sm-2 small text-center'>
							<input type='checkbox' id='idiii6r8c2' name='iii6r8c2' value='1' <?php echo ($row['III6R8C2'] == 1) ? 'checked' : ''?> <?php echo $estadoIII6 ?> />
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
						<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Cap&iacute;tulo III Actualizado Correctamente</p>
					</div>
					<div class='col-sm-1 small pull-right' id="btn_cont" style="display: none;" >
						<a href='capitulo4.php?numord=<?php echo $numero . "&nombre=" . $nombre?>' class='btn btn-default' data-toggle='tooltip' title='Ir a siguiente cap&iacute;tulo'>Continuar</a>
					</div>
					<div class='col-sm-1 small pull-right'>
						<button type='submit' class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar informaci&oacute;n Cap&iacute;tulo III'>Grabar</button>
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
        					<h4 class="modal-title">RECOMENDACIONES PARA UN BUEN PROCESO DE CR&Iacute;TICA EN EL CAP&Iacute;TULO III</h4>
      				</div>
      				<div class="modal-body">
        				<ol style='text-align: justify; font-family: arial'>
						<li>Las cifras en este cap&iacute;tulo deben registrarse en <b>MILES DE PESOS</b> y asegurarse  que sean <b>&Uacute;NICAMENTE</b> los montos
							relacionados con las inversiones reportadas en el cap&iacute;tulo 2.
						<li>Revisar la composici&oacute;n de fuentes de financiaci&oacute;n seg&uacute;n tama&ntilde;o de la empresa.
						<li>Revisar fuentes que reporten <b>MONTOS PEQUE&Ntilde;OS</b> para el cualquiera de los dos a&ntilde;os en las fuentes de financiaci&oacute;n y/o l&iacute;neas
							de cr&eacute;dito y/o financiaci&oacute;n.
						<li>Realizar observaciones claras, <b>NO DEJAR NOTAS</b> como datos ok, datos verificados, etc. en lo posible indicar el nombre y 
							cargo de la persona que suministra la informaci&oacute;n, en los casos donde las cifras son muy grandes y se confirme que  est&aacute;n
							expresadas en miles de pesos hacer la aclaraci&oacute;n en  las observaciones.
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
